<?php

namespace App\Http\Controllers;


use App\Exports\MembersExport;
use App\Jobs\AddQuotas;
use App\Jobs\StatisticsExport;
use App\Models\Commission;
use App\Models\CommissionCharge;
use App\Models\Committee;
use App\Models\CommitteeMembership;
use App\Models\CouncilCharge;
use App\Models\County;
use App\Models\Course;
use App\Models\Discipline;
use App\Models\Job;
use App\Models\JobType;
use App\Models\JuniorCategory;
use App\Models\Member;
use App\Models\MemberCategory;
use App\Models\MemberType;
use App\Models\ParticipantRole;
use App\Models\Payment;
use App\Models\Position;
use App\Models\Profession;
use App\Models\Region;
use App\Models\Residence;
use App\Models\StudyGroup;
use App\Models\Title;
use App\Permissions\Permission;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use CodiceFiscale\Calculator;
use CodiceFiscale\Subject;
use Flasher\Prime\FlasherInterface;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use function PHPUnit\Framework\isNull;


class MemberController extends Controller
{
     private array $customMessages  = [
        'required' => 'Il campo :attribute è obbligatorio',
        'date' => 'La data inserita non è valida',
        'max' => 'Il campo :attribute deve essere lungo massimo 16 caratteri',
        'min' => 'Il campo :attribute deve essere lungo almeno 16 caratteri',
        'unique' => 'Un utente con questo :attribute esiste già'
    ];

     private array $customAttributes = [
         'qualification' => 'titolo',
         'name' => 'nome',
         'surname' => 'cognome',
         'gender' => 'sesso',
         'birth_place' => 'luogo di nascita',
         'birth_date' => 'data di nascita',
         'fiscal_code' => 'codice fiscale',
         'status' => 'stato',
         'consent' => 'consenso',
         'notes' =>  'note'
     ];

    public function index(Request $request)
    {
//        dd($request->all());
        $members = Member::join('positions', 'members.id', '=', 'positions.member_id')
            ->select('members.*', 'positions.member_type')
            ->where('positions.member_type', '<>', 'Partecipante ECM')
            ->searchByString($request->query('q'))
            ->whereNull('members.deleted_at')
            ->sortable()
            ->paginate(35);
        $types = [
            'underForty' => [0,1],
            'yosid' => [0,1],
            'member_type' => ['Ordinario', 'Partecipante ECM']
        ];
        return view('member.member', [
            'members' => $members,
            'type'=>'members',
            'types'=>$types,
            'title' => 'Anagrafica Soci',
            'add_title' => 'Aggiungi Socio',
        ]);
    }

    public function ecmMembers(Request $request)
    {

        $members = Member::join('positions', 'members.id', '=', 'positions.member_id')
            ->select('members.*', 'positions.member_type')
            ->where('positions.member_type', '=', 'Partecipante ECM')
            ->searchByString($request->query('q'))
            ->whereNull('members.deleted_at')
            ->paginate(35);
        $types = [
            'underForty' => [0,1],
            'yosid' => [0,1],
            'member_type' => ['Ordinario', 'Partecipante ECM'],
        ];
        return view('member.member', [
            'members' => $members,
            'type'=>'ecm',
            'types'=>$types,
            'title' => 'Anagrafica Partecipanti ECM',
            'add_title' => 'Aggiungi partecipante ECM',
        ]);
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(),[
            ['q'=>'required|text']
        ]);
        if($validator->fails()){
            return $validator->messages();
        }
        if($request->type == 'members')
        {
            $members = Member::join('positions', 'members.id', '=', 'positions.member_id')
                ->select('members.*', 'positions.member_type')
                ->where('positions.member_type', '<>', 'Partecipante ECM')
                ->whereRaw("concat(surname, ' ', name) like '%" .$request->q. "%' ")
                ->whereNull('members.deleted_at')
                ->limit(20)
                ->get();
        } else {
            $members = Member::join('positions', 'members.id', '=', 'positions.member_id')
                ->select('members.*', 'positions.member_type')
                ->where('positions.member_type', '=', 'Partecipante ECM')
                ->whereRaw("concat(surname, ' ', name) like '%" .$request->q. "%' ")
                ->whereNull('members.deleted_at')
                ->limit(20)
                ->get();
        }
        return response()->json(['members'=>$members]);
    }

    public function compile(Request $request){
        $members = Member::join('positions', 'members.id', '=', 'positions.member_id')
            ->select('members.*', 'positions.member_type')
            ->where('positions.member_type', '<>', 'Partecipante ECM')
            ->where('members.status', FALSE)
            ->where('members.surname', 'like', '%'.$request->get('q').'%')
            ->whereNull('members.deleted_at')
            ->limit(15)
            ->get();
        return response()->json($members);
    }


    public function deletedMemberList()
    {
        $members = DB::table('members')->whereNotNull('deleted_at', null)->paginate(35);
        return view('member.deleted-member', ['members' => $members]);
    }

    public function restoreMember($id, FlasherInterface $flasher)
    {
        $result = Member::withTrashed()
            ->where('id', $id)
            ->restore();
        if($result){
            $flasher->addSuccess('Socio ripristinato con successo', 'Operazione conclusa');
            return redirect()->route('deleted-member');
        } else {
            $flasher->error('Qualcosa è andato storto', 'Ops, si è verificato un errore');
            return redirect()->route('deleted-member');
        }
    }

    public function hardDeleteMember($id, FlasherInterface $flasher)
    {
        $result = Member::withTrashed()
            ->where('id', $id)
            ->forceDelete();

        if($result){
            $flasher->addSuccess('Socio eliminato definitivamente', 'Operazione conclusa');
            return redirect()->route('deleted-member');
        } else {
            $flasher->error('Qualcosa è andato storto', 'Ops, si è verificato un errore');
            return redirect()->route('deleted-member');
        }
    }

    public function calculateCF(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name" => 'required',
            "surname" => 'required',
            "birth_date" => 'required',
            "gender" => 'required',
            "birth_place" => 'required'
        ]);

        if($validator->fails()){
            return $validator->messages();
        }
        $subject = new Subject(
            array(
                "name" => $request->name,
                "surname" => $request->surname,
                "birthDate" => Carbon::parse($request->birth_date)->format('Y-m-d'),
                "gender" => $request->gender,
                "belfioreCode" => $request->birth_place
            )
        );
        $calculator = new Calculator($subject);
        return $calculator->calculate();
    }

    public function newMember()
    {
        $studyGroups = StudyGroup::all();
        $memberTypes = MemberType::all();
        $titles = Title::all();
        $councilCharges = CouncilCharge::all();
        $regions = Region::all()->sortBy('region');;
        $jobTypes = JobType::all();
        $categories = MemberCategory::all();
        $disciplines = Discipline::all();
        $professions = Profession::all();
        $committees = Committee::all();
        $roles = ParticipantRole::all();
        $commissionCharges = CommissionCharge::all();
        $juniorCategory = JuniorCategory::all();
        $counties = County::all()->sortBy('id');
        return view('member.new-member',[
                'memberTypes' => $memberTypes,
                'roles' => $roles,
                'councilCharges' => $councilCharges,
                'commissionCharges' => $commissionCharges,
                'regions' => $regions,
                'jobTypes' => $jobTypes,
                'categories' => $categories,
                'juniorCategory' => $juniorCategory,
                'disciplines' => $disciplines,
                'professions' => $professions,
                'committees' => $committees,
                'studyGroups' => $studyGroups,
                'counties' => $counties,
                'titles' => $titles,
            ]);
    }

    public function persistMember(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'qualification' => 'max:10',
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|max:255',
            'gender' => 'required|max:1',
            'birth_place' => 'required|max:60',
            'birth_date' => 'date',
            'fiscal_code' => 'unique:members,fiscal_code|required|max:16|min:16',
            'status' => 'required|max:1',
            'consent' => 'required|max:1',
            'notes' =>  'max:300',
            'yo_sid' => 'max:1',
            'subscription_date' => 'date',
            'member_type' => 'required|max:20',
            'council_charge' => 'integer|numeric',
            'region' => 'integer|numeric',
            'job_type' => 'integer|numeric',
            'member_category' => 'integer|numeric',
            'expire_no_time' => 'date',
            'quota' => 'integer|numeric',
            'professions' => 'integer|numeric',
            'disciplines' => 'integer|numeric'
        ], $this->customMessages, $this->customAttributes);

        if($validator->fails()) {
            return redirect('/member/new')
                ->withInput()
                ->withErrors($validator);
        }

        $member = new Member;
        $member->qualification = $request->qualification;
        $member->name = $request->name;
        $member->surname = $request->surname;
        $member->email = $request->email;
        $member->gender = $request->gender;
        $member->birth_place = $request->birth_place;
        $member->birth_date = $request->birth_date;
        $member->fiscal_code = $request->fiscal_code;
        $member->status = 0;
        $member->consent = $request->consent;
        $member->notes = $request->notes;
        $member->yo_sid = $request->yo_sid;
        $result = $member->save();
        if(!is_null($member))
        {
            $position = new Position();
            $position->member_id = $member->id;
            $position->subscription_date = $request->subscription_date;
            $position->member_type = $request->member_type;
            $position->profession_id = $request->profession_id;
            $position->region_id = $request->region_id;
            $position->council_charge_id = $request->council_charge_id;
            $position->cd_regionale = $request->cd_regionale;
            $position->member_category = $request->member_category;
            $position->sub_category = $request->sub_category;
            if($request->member_category == 6) {
                $position->expire = (Carbon::parse($request->birth_date)->format("Y") + 40) . "-" . Carbon::parse($request->birth_date)->format("m") . "-" . Carbon::parse($request->birth_date)->format("d");
            } else {
                $position->expire = $request->expire;
            }

            $position->quota = $request->quota;
            $position->job_type_id = $request->job_type_id;
            $position->biennial = $request->biennial;
            $position->year_paid = $request->year_paid;
            $position->save();
        }

        if(!is_null($position->quota))
        {
            if($request->member_category != 'Partecipante ECM'){
                $payment = new Payment();
                $payment->member_id = $member->id;
                $payment->date = Carbon::now()->format('Y-m-d');
                $payment->payment_reason = "Quota anno ".Carbon::now()->format('Y');
                $payment->amount = $position->quota;
                $payment->payed_amount = 0;
                $payment->payment_type_id = 1;
                $payment->year = Carbon::now()->format('Y');
                $payment->save();
            }
        }

        if(!is_null($member))
        {
            $residence = new Residence();
            $residence->member_id = $member->id;
            $residence->residence = $request->address;
            $residence->city = strtoupper($request->city);
            $residence->cap = $request->cap;
            $residence->province = strtoupper($request->province);
            $residence->telephone1 = $request->telephone1;
            $residence->telephone2 = $residence->telephone2;
            $residence->save();
        }
        if(!is_null($member))
        {
            $job = new Job();
            $job->member_id = $member->id;
            $job->office = $request->office;
            $job->head_quarters = $request->head_quarters;
            $job->office_city = $request->office_city;
            $job->cap_office_city = strtoupper($request->cap_office_city);
            $job->province_office_city = strtoupper($request->province_office_city);
            $job->telephone_3 = $request->telephone_3;
            $job->telephone_4 = $request->telephone_4;
            $job->save();
        }
        if($result) {
            activity()->log(Auth::user()->name. ' ' .Auth::user()->surname.' ha aggiunto il socio '.$member->name.' '.$member->surname);
            $flasher->addSuccess('Socio modificato con successo', 'Operazione conclusa');
            return redirect('/member/detail/'.$member->id);
        }
        else {
            return redirect('member/new')
                ->withInput();
        }
    }

    public function editMember(Request $request, $id, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'qualification' => 'max:10',
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|max:255',
            'gender' => 'required|max:1',
            'birth_place' => 'required|max:60',
            'birth_date' => 'date',
            'fiscal_code' => 'required|max:16|min:16',
            'status' => 'required|max:1',
            'consent' => 'required|max:1',
            'notes' =>  'max:300',
            'yo_sid' => 'max:1',
            'subscription_date' => 'date',
            'member_type' => 'required|max:20',
            'council_charge' => 'integer|numeric',
            'region' => 'integer|numeric',
            'job_type' => 'integer|numeric',
            'member_category' => 'integer|numeric',
            'expire_no_time' => 'date',
            'quota' => 'integer|numeric',
            'professions' => 'integer|numeric',
            'disciplines' => 'integer|numeric'
        ], $this->customMessages, $this->customAttributes);

        if($validator->fails()) {
            return redirect()->route('member-detail', $id)
                ->withInput()
                ->withErrors($validator);
        }

        $member = Member::find($id);

        if(!is_null($member))
        {
            $member->qualification = $request->qualification;
            $member->name = $request->name;
            $member->surname = strtoupper($request->surname);
            $member->email = $request->email;
            $member->gender = $request->gender;
            $member->birth_place = $request->birth_place;
            $member->birth_date = $request->birth_date;
            $member->fiscal_code = $request->fiscal_code;
            $member->status = $request->status;
            $member->consent = $request->consent;
            $member->notes = $request->notes;
            $member->yo_sid = $request->yo_sid;
            $result = $member->save();

            $position = Position::where('member_id',$id)->first();
            if(is_null($position))
                $position = new Position();

            $position->member_id = $member->id;
            $position->member_type = $request->member_type;
            $position->profession_id = $request->profession;
            $position->region_id = $request->region;
            $position->council_charge_id = $request->council_charge;
            $position->cd_regionale = $request->cd_regionale;
            $position->member_category = $request->member_category;
            $position->sub_category = $request->sub_category;

            if($request->member_category == 6) {
                $position->expire = (Carbon::parse($member->birth_date)->format("Y") + 40) . "-" . Carbon::parse($member->birth_date)->format("m") . "-" . Carbon::parse($member->birth_date)->format("d");
            } else {
                $position->expire = $request->expire;
            }

            $position->quota = $request->quota;
            $position->job_type_id = $request->job_type;
            $position->biennial = $request->biennial;
            $position->year_paid = $request->year_paid;
            $position->save();


            if($request->quota != 0 || $request->quota != '')
            {
                if($request->member_type != 'Partecipante ECM'){
                    $payment = new Payment();
                    $payment->member_id = $member->id;
                    $payment->date = Carbon::now()->format('Y-m-d');
                    $payment->payment_reason = "Quota anno ".Carbon::now()->format('Y');
                    $payment->amount = $position->quota;
                    $payment->payed_amount = 0;
                    $payment->payment_type_id = 1;
                    $payment->year = Carbon::now()->format('Y');
                    $payment->save();
                }
            }

            if($request->member_type == 'Partecipante ECM'){
                $position->quota = 0;
                $position->member_category = null;
                $position->save();
            }


            $residence = Residence::where('member_id',$id)->first();
            if(is_null($residence))
                $residence = new Residence();

            $residence->member_id = $member->id;
            $residence->residence = $request->address;
            $residence->city = strtoupper($request->city);
            $residence->cap = $request->cap;
            $residence->province = strtoupper($request->province);
            $residence->telephone1 = $request->telephone1;
            $residence->telephone2 = $request->telephone2;
            $residence->save();

            $job = Job::where('member_id',$id)->first();
            if(is_null($job))
                $job = new Job();

            $job->member_id = $member->id;
            $job->office = $request->office;
            $job->head_quarters = $request->head_quarters;
            $job->office_city = strtoupper($request->office_city);
            $job->cap_office_city = $request->cap_office_city;
            $job->province_office_city = strtoupper($request->province_office_city);
            $job->telephone_3 = $request->telephone_3;
            $job->telephone_4 = $request->telephone_4;
            $job->save();

            if($result) {
                activity()->log(Auth::user()->name. ' ' .Auth::user()->surname.' ha modificato il socio '.$member->name.' '.$member->surname);
                $flasher->addSuccess('Socio modificato con successo', 'Operazione conclusa');
                return redirect(route('member-detail', $id));
            }
            else {
                return redirect('member/new')
                    ->withInput();
            }
        }

        return redirect(route('member_detail', $id));
    }

    public function memberDetail($id)
    {

        $member = Member::findOrFail($id);
        $studyGroups = StudyGroup::all();
        $memberTypes = MemberType::all();
        $councilCharges = CouncilCharge::all();
        $regions = Region::all()->sortBy('region');
        $counties = County::all();
        $jobTypes = JobType::all();
        $categories = MemberCategory::all();
        $juniorCategory = JuniorCategory::all();
        $disciplines = Discipline::all();
        $professions = Profession::all();
        $committees = Committee::all();
        $committeCharges = CommitteeMembership::where('member_id', $member->id)->get();
        $commissions = Commission::all();
        $courses = Course::all();
        $roles = ParticipantRole::all();
        $commissionCharges = CommissionCharge::all();

        $paidQuota = Payment::where('member_id',$id)
            ->sum('payed_amount');
        $unpaidQuotas = Payment::where('member_id',$id)
            ->sum('amount');

        return view('member.edit-member',
            [
                'member' => $member,
                'memberTypes' => $memberTypes,
                'roles' => $roles,
                'councilCharges' => $councilCharges,
                'commissionCharges' => $commissionCharges,
                'regions' => $regions,
                'counties' => $counties,
                'jobTypes' => $jobTypes,
                'categories' => $categories,
                'juniorCategory' => $juniorCategory,
                'disciplines' => $disciplines,
                'professions' => $professions,
                'committees' => $committees,
                'committeCharges' => $committeCharges,
                'commissions' => $commissions,
                'studyGroups' => $studyGroups,
                'courses' => $courses,
                'paidQuota' => $paidQuota,
                'unpaidQuotas' => $unpaidQuotas
            ]);
    }

    public function createScheda($id)
    {
        $member = Member::findOrFail($id);
        //creates member card
        $quotas = $member->payments->sum('amount');
        $paidAmount = $member->payments->sum('payed_amount');

        $balance = $quotas - $paidAmount;
        $studyGroups = StudyGroup::all();
        $committess = Committee::all();

        $pdf = pdf::loadView('pdf.member-card', compact('member', 'studyGroups', 'committess','balance'))
            ->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true,]);
        //Check if folder exists
        $path = storage_path('app/public/attachments/'.(Carbon::now()->format('Y')));
        if(!File::isDirectory($path))
        {
            File::makeDirectory($path,0777,true,true);
        }

        $pdf->save(storage_path('app/public/attachments/'.(Carbon::now()->format('Y')).'/scheda_' . $member->name . '_' .$member->surname. '.pdf'));

        return redirect('storage/attachments/'.(Carbon::now()->format('Y')).'/scheda_' . $member->name . '_' .$member->surname. '.pdf');
    }
    public function createBolletino($id)
    {
        $member = Member::findOrFail($id);
//        dd($member);
        //creates member bolletino
        $quotas = $member->payments->sum('amount');
        $paidAmount = $member->payments->sum('payed_amount');

        $balance = $quotas - $paidAmount;
        $studyGroups = StudyGroup::all();
        $committess = Committee::all();

        $pdf = pdf::loadView('pdf.member-payment', compact('member', 'studyGroups', 'committess','balance'))->setPaper('a4', 'landscape')
            ->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);
        //Check if folder exists
        $path = storage_path('app/public/attachments/'.(Carbon::now()->format('Y')));
        if(!File::isDirectory($path))
        {
            File::makeDirectory($path,0777,true,true);
        }

        $pdf->save(storage_path('app/public/attachments/'.(Carbon::now()->format('Y')).'/bolletino_' . $member->name . '_' .$member->surname. '.pdf'));

        return redirect('storage/attachments/'.(Carbon::now()->format('Y')).'/bolletino_' . $member->name . '_' .$member->surname. '.pdf');
    }

    public function deleteMember($id, FlasherInterface $flasher)
    {
        $member = Member::find($id);
        $result = $member->delete();
        if($result){
            activity()->log(Auth::user()->name. ' ' .Auth::user()->surname.' ha eliminato il socio '.$member->name.' '.$member->surname);
            $flasher->addSuccess('Socio eliminato con successo', 'Operazione conclusa');
        }
        else{
            $flasher->addError('Qualcosa è andato storto, per favore riprova', 'Errore');
        }

        return redirect()->route('member');
    }

    public function addQuotas(FlasherInterface $flasher)
    {
        $bus = Bus::batch([
            new AddQuotas()
        ])->dispatch();
        $flasher->addSuccess('In processo di addebito quote è iniziato', 'Operazione conclusa con successo');
        return redirect(route('dashboard'));
    }


    public function selectCityDetail(Request $request)
    {
        $county = County::where('id', $request->id)
            ->first();
        if($county)
            return $county;
    }

}
