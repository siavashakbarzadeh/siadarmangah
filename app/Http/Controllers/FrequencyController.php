<?php

namespace App\Http\Controllers;

use App\Models\Frequency;
use App\Models\Member;
use Flasher\Prime\FlasherInterface;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FrequencyController extends Controller
{
    private $customMessages = [
        'numeric' => 'Il campo :attribute deve essere un numero',
        'string' => 'Il campo :attribute non è valido',
        'exists' => 'Non è stato ancora creato un nuovo socio. Sarà possibile aggiungere i corsi dopo aver creato il socio',
        'date' => 'Il campo :attribute è obbligatorio',
        'required' => 'Il campo :attribute è obbligatorio'
    ];
    private $customAttributes = [
        'course_id' => 'id corso',
        'member_type' => 'tipo di ruolo',
        'value' => 'valore',
        'member_id' => 'id socio',
        'credits_earned_date' => 'data',
        'place' => 'luogo'
    ];

    public function detail()
    {

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => [
                'required',
                Rule::exists('members')->where(function($query){
                    $query->where('id', request()->get('id'));
                })
            ],
            'course_id' => 'required',
            'member_type' => 'required',
            'value' => 'required',
            'credits_earned_date' => 'required'
        ], $this->customMessages, $this->customAttributes);

        if($validator->fails()){
            return $validator->messages();
        }

        $frequency = new Frequency();
        $frequency->member_id = $request->id;
        $frequency->course_id = $request->course_id;
        $frequency->credit_type = 1;
        $frequency->member_type = $request->member_type;
        $frequency->value = $request->value;
        $frequency->sponsor = $request->sponsor;
        $frequency->credits_earned_date = $request->credits_earned_date;
        $frequency->notes = $request->notes;
        $result = $frequency->save();

        return $result;
    }

    public function delete(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(),[
            'frequency_id' => 'required'
        ], $this->customMessages, $this->customAttributes);

        if($validator->fails()){
            return $validator->messages();
        }
        $frequency = Frequency::find($request->frequency_id);
        $result = $frequency->delete();

        if($result){
            $flasher->addSuccess('Corso eliminato', 'Operazione conclusa');
            return $result;
        } else {
            $flasher->error('Qualcosa è andato storto', 'Ops, si è verificato un errore');
            return $result;
        }
    }
}
