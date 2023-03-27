<?php

namespace App\Http\Controllers;

use App\Exports\ModelloMinCredits;
use App\Exports\ModelloMinCreditsTotal;
use App\Exports\ModelloMinNoCredits;
use App\Models\Accreditor;
use App\Models\Company;
use App\Models\Course;
use App\Models\EventType;
use App\Models\Frequency;
use App\Models\Goal;
use App\Models\Member;
use App\Models\MemberCertificate;
use App\Models\MemberReceipt;
use App\Models\Sign;
use App\Models\Sponsor;
use App\Models\User;
use App\Permissions\Permission;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Custom\NumberToLetterConverter;

class CourseController extends Controller
{
    private array $customMessages  = [
        'required' => 'Il campo :attribute è obbligatorio',
        'date' => 'La data inserita non è valida',
        'max' => 'Il campo :attribute deve essere lungo massimo 16 caratteri',
        'min' => 'Il campo :attribute deve essere lungo almeno 16 caratteri',
        'unique' => 'Un utente con questo :attribute esiste già'
    ];

    private array $customAttributes = [
        'event_code' => 'codice evento',
        'course' => 'corso',
        'start' => 'data di inizio',
        'goal_id' => 'ambito/obiettivo',
        'scientific_head_member_id' => 'responsabile scientifico',
        'amount' => 'importo'
    ];

    public function index(Request $request)
    {
        $courses = Course::orderBy('start', 'desc')

            ->paginate(15);
        return view('courses.courses-list', [
            'courses' => $courses,
//            'types'=>$types,
        ]);
    }

    public function detailPage($id)
    {
        $course = Course::find($id);
        $goals = Goal::all();
        $accreditors = Accreditor::all();
        $companies = Company::all();
        $eventTypes = EventType::all();
        $sign = Sign::where('course_id','=', $id)->first();
        $ordinaryMembers = 0;
        $ecmMembers = 0;
        $teacher = 0;

        foreach($course->frequencies as $frequency){

            if($frequency->value > 0 && $frequency->value == $course->course_credits) {

            }

            if($frequency->value > 0 && $frequency->value < $course->course_credits) {
                $teacher += 1;
            }

            if(!is_null($frequency->member)){
                if($frequency->member->position->member_type == 'Partecipante ECM'){
                    $ecmMembers += 1;
                }else{
                    $ordinaryMembers += 1;
                }
            }
        }

        return view('courses.course-detail', [
            'course'=>$course,
            'ordinaryMembers' => $ordinaryMembers,
            'ecmMembers' => $ecmMembers,
            'goals' => $goals,
            'companies' => $companies,
            'accreditors' => $accreditors,
            'eventTypes' => $eventTypes,
            'sign' => $sign,
            'teacher' => $teacher
        ]);
    }

    public function detail($id)
    {
        $course = Course::find($id);

        return $course;
    }

    public function new()
    {
        $goals = Goal::all();
        $accreditors = Accreditor::all();
        $eventTypes = EventType::all();

        return view('courses.add-course',[
            'goals'=>$goals,
            'accreditors' => $accreditors,
            'eventTypes' => $eventTypes
        ]);
    }

    public function edit(Request $request, FlasherInterface $flasher, $id)
    {
        $course = Course::find($id);
        $validator = Validator::make($request->all(),[
            'event_code' => 'required',
            'course' => 'required',
            'start' => 'required',
            'goal_id' => 'required|integer',
            'scientific_head_member_id' => 'required',
            'amount' => 'required',
            'sign' => 'mimes:pdf,xlx,csv,jpeg,jpg,png|max:2048'

        ], $this->customMessages, $this->customAttributes);

        if($validator->fails()){
            return redirect(route('course-detail-page', $id))
                ->withInput()
                ->withErrors($validator);
        };

        if(!empty($request->sign)){
            $existingSigns = Sign::where('course_id', $course->id)->get();

            if(count($existingSigns) > 0){
                foreach ($existingSigns as $sign) {
                    $sign->delete();
                }
            }

            $fileModel = new Sign();
            $fileName = time().'.'.$request->sign->extension();

            $request->sign->move(storage_path('app/public/img'), $fileName);

            $fileModel->course_id = $id;
            $fileModel->name = time().'_'.$fileName;
            $fileModel->file_path = $fileName;
            $fileModel->save();
        }

        $course->event_code = $request->event_code;
        $course->edition_code = $request->edition_code;
        $course->organizer_code = $request->organizer_code;
        $course->accreditor_code = $request->accreditor_code;
        $course->course = $request->course;
        $course->start = Carbon::parse($request->start)->format('Y-m-d');
        $course->end = Carbon::parse($request->end)->format('Y-m-d');
        $course->place = $request->place;
        $course->event_type = $request->education;
        $course->course_hours = $request->course_hours;
        $course->course_credits = $request->course_credits;
        $course->education = $request->education;
        $course->goal_id = $request->goald_id;
        $course->attendees_number = $request->attendees_number;
        $course->scientific_head = $request->scientific_head_member_id;
        $course->amount = $request->amount;
        $course->letter_amount = $request->letter_amount;
        $course->organizational_secretariat = $request->organizational_secretariat;
        $course->reference_name = $request->reference_name;
        $course->reference_telephone_number = $request->reference_telephone_number;
        $result = $course->save();
        $course->goal()->sync($request->goal_id);
        if($result){
            activity()->log(Auth::user()->name. ' ' .Auth::user()->surname.' ha modificato il corso '.$course->course);
            $flasher->addSuccess('Corso modificato', 'Operazione conclusa con successo');
            return redirect(route('course-detail-page', $course->id));
        } else {
            $flasher->addError('Operazione non conclusa', 'Ops, si è verificato un problema');
            return redirect(route('course-list'));
        }
    }

    public function addSponsor(Request $request, FlasherInterface $flasher)
    {
        $course = Course::find($request->course_id);

        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer',
            'company_id' => 'required|integer',
            'amount' => 'required'
        ]);

        if($validator->fails()){
            return redirect(route('course-detail', $course->id))
                ->withInput()
                ->withErrors($validator);
        }
        $course->sponsors()->attach($request->course_id, ['company_id'=>$request->company_id, 'amount'=>$request->amount]);

        $sponsor = Sponsor::where('course_id',$course->id)
            ->where('company_id', $request->company_id);

        if(!is_null($sponsor)){
            activity()->log(Auth::user()->name.' '.Auth::user()->surname.' ha aggiunto uno sponsor al corso '.$course->course);
            $flasher->addSuccess('Sponsor aggiunto', 'Operazione conclusa con successo');
            return redirect(route('course-detail-page', $course->id));
        } else {
            $flasher->addError('Operazione non conclusa', 'Ops, si è verificato un problema');
            return redirect(route('course-list'));
        }
    }

    public function deleteSponsor(Request $request, FlasherInterface $flasher)
    {
        $sponsor = Sponsor::find($request->sponsor_id);
        $result = $sponsor->delete();
        if($result){
            $company = Company::find($sponsor->company_id);
            $course = Course::find($sponsor->course_id);
            activity()->log(Auth::user()->name.' '.Auth::user()->surname.' ha rimosso lo sponsor '.$company->companyName.' dal corso '.$course->course);
            $flasher->addSuccess('Sponsor eliminato', 'Operazione conclusa con successo');
            return redirect(route('course-detail-page', $sponsor->course_id));
        } else {
            $flasher->addError('Operazione non conclusa', 'Ops, si è verificato un problema');
            return redirect(route('course-detail-page', $sponsor->course_id));
        }
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(),[
            'event_code' => 'required',
            'course' => 'required',
            'start' => 'required',
            'goal_id' => 'required|integer',
            'scientific_head_member_id' => 'required',
            'amount' => 'required',
            'sign' => 'image'
        ], $this->customMessages, $this->customAttributes);

        if($validator->fails()){
            return redirect(route('new-course'))
                ->withInput()
                ->withErrors($validator);
        };
        $course = new Course();
        $course->event_code = $request->event_code;
        $course->edition_code = $request->edition_code;
        $course->organizer_code = $request->organizer_code;
        $course->accreditor_code = $request->accreditor_code;
        $course->course = $request->course;
        $course->event_type = $request->education;
        $course->start = $request->start;
        $course->end = $request->end;
        $course->place = $request->place;
        $course->course_hours = $request->course_hours;
        $course->course_credits = $request->course_credits;
        $course->education = $request->education;
        $course->goal_id = $request->goald_id;
        $course->attendees_number = $request->attendees_number;
        $course->scientific_head = $request->scientific_head_member_id;
        $course->amount = $request->amount;
        $course->letter_amount = $request->letter_amount;
        $course->organizational_secretariat = $request->organizational_secretariat;
        $course->reference_name = $request->reference_name;
        $course->reference_telephone_number = $request->reference_telephone_number;
        $result = $course->save();
        $course->goal()->attach($course->id,['goal_id'=> $request->goal_id]);

        if(!$result){
            $flasher->addError('Il corso non è stato aggiunto', 'Ops, si è verificato un errore');
            return redirect(route('new-course'))->withInput();
        }
        activity()->log(Auth::user()->name.' '.Auth::user()->surname.' ha aggiunto il corso '.$course->course);
        $flasher->addSuccess('Corso aggiunto', 'Operazione conclusa con successo');
        return redirect(route('course-detail-page', $course->id));
    }

    public function delete(Request $request, FlasherInterface $flasher)
    {
        $course = Course::find($request->course_id)->goal()->detach();
        $course = Course::find($request->course_id);
        $result = $course->delete();
        if(!$result){
            $flasher->addError('Il corso non è stato eliminato', 'Ops, si è verificato un errore');
            return redirect(route('course-list'))->withInput();
        }
        activity()->log(Auth::user()->name.' '.Auth::user()->surname.' ha rimosso il corso '.$course->course);
        $flasher->addSuccess('Corso eliminato', 'Operazione conclusa con successo');
        return redirect(route('course-list'));
    }

    public function search(Request $request)
    {
        $courses = Course::query()
            ->when($request->filled('q'),function ($query)use ($request){
                $query->where('course','LIKE','%'.$request->get('q').'%');
            })->limit(20)
            ->get();
        return response()->json(['courses'=>$courses]);
    }

    public function deleteCertificate(Request $request, FlasherInterface $flasher)
    {
        $frequency = MemberCertificate::find($request->certificate_id);
        $result = $frequency->delete();
        if(!$result){
            $flasher->addError('L\'Attestato non è stato eliminato', 'Ops, si è verificato un errore');
            return redirect(route('course-detail-page'))->withInput();
        }
//
        File::delete(storage_path(env('DOWNLOAD_URL').'certificates/'.$frequency->course_id.'/attestato_'.$frequency->member->surname.'.pdf'));
        activity()->log(Auth::user()->name.' '.Auth::user()->surname.' ha eliminato l\'attestato');
        $flasher->addSuccess('Attestato eliminato', 'Operazione conclusa con successo');
        return redirect(route('course-certificates-list', $frequency->course_id));
    }

    public function compile(Request $request){
        $courses = Course::where('course', 'like', '%'.$request->get('q').'%')
            ->limit(15)
            ->orderBy('start', 'DESC')
            ->get();
        return response()->json($courses);
    }

    public function certificate($id, FlasherInterface $flasher)
    {
        $base64Sign = "";
        $course = Course::find($id);
        $sign = Sign::where('course_id', $course->id)
            ->first();

        if($sign){
            $base64Sign = "data:image/png;base64,".base64_encode(file_get_contents(storage_path('app/public/img/'.$sign->file_path)));
        }

        $member = [];
        foreach($course->frequencies as $frequency){
            if($frequency->value > 0) {
                $member['qualification'] = $frequency->member->qualification;
                $member['name'] = $frequency->member->name;
                $member['surname'] = $frequency->member->surname;
                $member['fiscal_code'] = $frequency->member->fiscal_code;
                $member['jobType'] = $frequency->member->position->profession->profession;
                $member['disciplines'] = $frequency->member->disciplines;
                $member['credits_earned_date'] = substr($frequency->credits_earned_date,0,10);

                if($frequency->value > 0 && $frequency->value == $course->course_credits) {
                    $member['role'] = ' partecipante';
                } else {
                    $member['role'] = ' docente';
                }


                $pdf = pdf::loadView('pdf.member-certificate', compact('course', 'member','base64Sign'))
                    ->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);
                $path = storage_path('app/public/certificates/'.$course->id);
                if(!File::isDirectory($path))
                {
                    File::makeDirectory($path,0777,true,true);
                }

                $pdf->save(storage_path('app/public/certificates/'.$course->id.'/attestato_' . $frequency->member->surname . '.pdf'));
                $member = [];
                $memberCertificate = new MemberCertificate();
                $memberCertificate->member_id = $frequency->member->id;
                $memberCertificate->course_id = $course->id;
                $memberCertificate->path = 'certificates/'.$course->id.'/attestato_' . $frequency->member->surname . '.pdf';
                $memberCertificate->sent = 0;
                $memberCertificate->save();
            }
        }
        return redirect(route('course-detail-page',$course->id));
    }

    public function convertToLetter(Request $request)
    {
        $converter = new NumberToLetterConverter();
        $converted = $converter->to_word($request->amount,"EUR");
        return strval($converted);
    }

    public function certificateDetail($id)
    {
        $certificates = MemberCertificate::where('course_id', $id)
            ->paginate(20);
        $course = Course::where('id', $id)
            ->first();

        return view('courses.certificate-list', ['certificates' => $certificates,'course'=> $course]);
    }

    public function download($certificate_id)
    {
        $frequency = MemberCertificate::find($certificate_id);

        return response()->download(storage_path(env('DOWNLOAD_URL').'certificates/'.$frequency->course_id.'/attestato_'.$frequency->member->surname.'.pdf'));
    }

    public function export(int $id)
    {
        return Excel::download(new ModelloMinCredits($id), 'modello-min.xlsx');
    }

    public function exportNoCredits(int $id)
    {
        return Excel::download(new ModelloMinNoCredits($id), 'modello-min-no-crediti.xlsx');
    }

    public function exportTotal(int $id)
    {
        return Excel::download(new ModelloMinCreditsTotal($id), 'modello-min-totale.xlsx');
    }


    public function send(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'course_id' => 'required',
            'member_id' => 'required'
        ]);

        if($validator->fails()){
            return $validator->messages();
        }
        $data['course_id'] = $request->course_id;
        $data['member_id'] = $request->member_id;

        $course = Course::where('id','=',$request->course_id)->first();
        $certificate = MemberCertificate::where('member_id','=',$request->member_id)->where('course_id','=',$request->course_id)->first();
        $member = Member::find($request->member_id);

        Mail::mailer('mailgun-luisa')->send('email.course', $data, function($message)use($data, $certificate, $course) {
            $message->to('l.perrupane@siditalia.it')
                ->subject($course->course);
            $message->attach(storage_path(env('DOWNLOAD_URL').$certificate->path));
        });
        $certificate->sent = 1;
        $certificate->save();
    }

    public function massiveSend(Request $request)
    {
        $data['course_id'] = $request->course_id;

        $course = Course::where('id','=', $request->course_id)->first();
        $certificates = MemberCertificate::where('course_id','=',$request->course_id)->get();

        foreach ($certificates as $certificate){
            if($certificate->sent == 0){
                $member = Member::find($certificate->member_id);

                Mail::mailer('mailgun-luisa')->send('email.course', $data, function($message)use($data, $certificate, $course, $member) {
                    $message->to('l.perrupane@siditalia.it')
                        ->subject($course->course);
                    $message->attach(storage_path(env('DOWNLOAD_URL').$certificate->path));
                });
                $certificate->sent = 1;
                $certificate->save();
            }
        }
    }

}
