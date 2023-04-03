<?php

namespace App\Http\Controllers;


use App\Jobs\SendQuotas;
use App\Models\Committee;
use App\Models\Course;
use App\Models\Member;
use App\Models\MemberCertificate;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\PaymentTypePivot;
use App\Models\QuotaSent;
use App\Models\Region;
use App\Models\StudyGroup;
use App\Permissions\Permission;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use function Termwind\render;

class QuotaController extends Controller
{
    private $customMessages = [
        'numeric' => 'Il campo :attribute deve essere un numero',
        'string' => 'Il campo :attribute non è valido',
        'required_without' => 'Almeno uno tra i campi quota e pagamenti devono essere compilati',
        'date' => 'Il campo :attribute è obbligatorio'
    ];
    private $customAttributes = [
        'payment_reason' => 'descrizione movimento',
        'paid_amount' => 'pagamento',
        'amount' => 'quota',
        'member_id' => 'id socio',
        'date' => 'data'
    ];

    public function list(Request $request)
    {
        if(!auth()->user()->can(Permission::CAN_SEND_QUOTA)){
            abort(403);
        }
        $filters['region'] = $request->query('region');
        $quotasSent = QuotaSent::where('year', (Carbon::now()->format('Y')))
            ->region($request->query('region'))
            ->orderBy('year', 'DESC')
            ->paginate(30);

        $regions = Region::orderBy('region', 'asc')->get();
        $members = Member::whereHas('position', function($query) use($request){
            $query->where('member_type','<>','Partecipante ECM');
            $query->where('region_id',$request->region);
        })->where('members.status',0)->count();
        //dd(storage_path(env('DOWNLOAD_URL')."attachments/2023/corsi_Domenica_TORRE.pdf"));
        return view('quota.list', [
            'regions'=>$regions,
            'quotasSent' => $quotasSent,
            'filters'=>$filters,
            'members' => $members
        ]);
    }

    public function send(\Illuminate\Http\Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(),[
           'region' => 'required'
        ]);
        if($validator->fails())
        {
            $flasher->addError($validator->messages(), 'Ops, si è verificato un errore');
            return redirect(route('dashboard.dashboard'));
        }
        $flasher->addSuccess('Operazione di invio iniziata');

        $frequencies = [];
        $members = Member::whereHas('position', function($query) use($request){
            $query->where('member_type','<>','Partecipante ECM');
            $query->where('region_id',$request->region);
        })->where('members.status',0)->get();
//        dd($members->toArray());
        $studyGroups = StudyGroup::all();
        $committess = Committee::all();

        foreach($members as $member) {
            if ($member->year_sent != 0) {

                $privacyPath = null;
                if($member->consent == 0)
                {
                    //Invia modulo privacy
                    //storage_path('app/public/attachments/Informativa.pdf');
                    //creates member card
                    $pdf = pdf::loadView('pdf.privacy', compact('member'))
                        ->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);
                    //Check if folder exists
                    $path = storage_path('app/public/attachments/'.(Carbon::now()->format('Y')));
                    $privacyPath = 'attachments/'.(Carbon::now()->format('Y')).'/privacy_'. $member->name . '_' .$member->surname. '.pdf';
                    if(!File::isDirectory($path))
                    {
                        File::makeDirectory($path,0777,true,true);
                    }

                    $pdf->save(storage_path('app/public/attachments/'.(Carbon::now()->format('Y')).'/privacy_' . $member->name . '_' .$member->surname. '.pdf'));
                    //
                }

                //creates member card
                $balance = Payment::selectRaw('amount - payed_amount as balance')
                    ->where('member_id', $member->id)
                    ->first()
                    ->balance;

                $pdf = pdf::loadView('pdf.member-card', compact('member', 'studyGroups', 'committess','balance'))
                    ->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);
                //Check if folder exists
                $path = storage_path('app/public/attachments/'.(Carbon::now()->format('Y')));
                if(!File::isDirectory($path))
                {
                    File::makeDirectory($path,0777,true,true);
                }

                $pdf->save(storage_path('app/public/attachments/'.(Carbon::now()->format('Y')).'/scheda_' . $member->name . '_' .$member->surname. '.pdf'));
                //

                $sent = new QuotaSent();
                $sent->member_id = $member->id;
                $sent->name = $member->name;
                $sent->surname = $member->surname;
                $sent->email = $member->email;
                $sent->scheda_path = 'attachments/'.(Carbon::now()->format('Y')).'/scheda_'. $member->name . '_' .$member->surname. '.pdf';
                $sent->privacy_path = $privacyPath;
                $sent->payment_path = 'attachments/'.(Carbon::now()->format('Y')).'/scheda_'. $member->name . '_' .$member->surname. '.pdf';
                $sent->courses_path = NULL;
                $sent->year = (Carbon::now()->format('Y'));
                $sent->region = $request->region;
                $member = Member::where('id', $member->id)->first();
                $member->year_sent = 1;
                $member->save();

                $creditsTotal = 0;
                if($member->frequencies->isNotEmpty())
                {
                    foreach($member->frequencies as $frequency)
                    {
                        if(Carbon::parse($frequency->credits_earned_date)->format('Y') == (Carbon::now()->format('Y')-1) && $frequency->credits_earned_date != NULL)
                        {
                            $creditsTotal += $frequency->value;

                            $frequencies [] = [
                                'place' => $frequency->course->place,
                                'start' => $frequency->course->start,
                                'course' => $frequency->course->course,
                                'value' => $frequency->value,
                            ];
                        }
                    }
                    if(!empty($frequencies)){
                        $pdf = pdf::loadView('pdf.courses-list', compact('member', 'frequencies', 'creditsTotal'))
                            ->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);
                        $pdf->save(storage_path('app/public/attachments/'.(Carbon::now()->format('Y')).'/corsi_' . $member->name . '_' .$member->surname. '.pdf'));
                        $sent->courses_path = 'attachments/'.(Carbon::now()->format('Y')).'/corsi_'. $member->name . '_' .$member->surname. '.pdf';
                    }
                    $frequencies = [];
                }

                $sent->save();
            }
            /*Bus::batch([
                new SendQuotas($request->region)
            ])->dispatch();*/
        }
        return redirect((route('quota-list')));
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'payment_reason' => 'string',
            'member_id' => 'required|numeric',
            'date' => 'required',
            'amount' => 'required'
        ], $this->customMessages, $this->customAttributes);

        if($validator->fails()){
            return $validator->messages();
        };

        $payment = new Payment();
        $payment->member_id = $request->member_id;
        $payment->date = $request->date;
        $payment->payment_reason = $request->payment_reason;
        $payment->amount = $request->amount;
        $payment->payed_amount = 0;
        $payment->payment_type_id = 6;
        $result = $payment->save();

        if($result)
        {
            $member = Member::find($request->member_id);
            activity()->log(Auth::user()->name. ' ' .Auth::user()->surname.' ha aggiunto una quota a '.$member->name.' '.$member->surname);
            $flasher->addSuccess('Quota aggiunta', 'Operazione conclusa con successo');
        }
        else{
            $flasher->addError('Ops, qualcosa è andato storto', 'Per favore riprova');
        }

        return $result;
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|int'
        ], $this->customMessages, $this->customAttributes);

        if($validator->fails()){
            return $validator->messages();
        };
        $paymentType = PaymentTypePivot::where('payment_id', $request->payment_id)->first();
        if($paymentType)
            $paymentType->delete();

        $payment = Payment::find($request->payment_id);
        return $payment->delete();
    }


    public function sendEmail(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'member_id' => 'required'
        ]);

        if($validator->fails()){
            return $validator->messages();
        }

        $data['member_id'] = $request->member_id;

        $quota = QuotaSent::where('member_id', $request->member_id)->first();
        if($quota){
            $coursePath = $quota->courses_path;
            $schedaPath = $quota->scheda_path;
            $privacyPath = $quota->privacy_path;
            $paymentPath = $quota->payment_path;
        }

        Mail::mailer('mailgun-luisa')->send('email.quota', $data, function($message)use($data, $coursePath, $schedaPath, $privacyPath,$paymentPath) {
            $message->to('l.perrupane@siditalia.it')
                ->subject("Quota Associativa SID ".Carbon::today()->format("Y"));
            if($coursePath !== NULL)
            {
                $message->attach(storage_path(env('DOWNLOAD_URL').$coursePath));
            }
            if($schedaPath !== NULL)
            {
                $message->attach(storage_path(env('DOWNLOAD_URL').$schedaPath));
            }
            if($privacyPath !== NULL)
            {
                $message->attach(storage_path(env('DOWNLOAD_URL').$privacyPath));
            }
            if($paymentPath !== NULL)
            {
                $message->attach(storage_path(env('DOWNLOAD_URL').$paymentPath));
            }
        });
    }

}
