<?php

namespace App\Http\Controllers;

use App\Models\DisciplineMember;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DisciplineController extends Controller
{
    private $customMessages = [
        'not_in' => 'Seleziona almeno una :attribute',
        'min' => 'Seleziona almeno una :attribute'
    ];
    private $customAttributes = [
        'discipline_id' => 'disciplina'
    ];

    public function store(Request $request, FlasherInterface $flasher)
    {
        $validator  = Validator::make($request->all(), [
            'member_id' => 'required',
            'discipline_id' => 'required'
        ], $this->customMessages, $this->customAttributes);

        if($validator->fails()){
            return $validator->messages();
        }

        $discipline = new DisciplineMember();
        $discipline->member_id = $request->member_id;
        $discipline->discipline_id = $request->discipline_id;
        $result = $discipline->save();

        if($result)
            $flasher->addSuccess('Disciplina aggiunta', 'Operazione conclusa con successo');
        else
            $flasher->addError('Per favore ricarica la pagina e riprova', 'Ops, si è verificato un errore');

        return $result;
    }

    public function delete(Request $request, FlasherInterface $flasher)
    {
        $validator  = Validator::make($request->all(), [
            'member_id' => 'required',
            'discipline_id' => 'required'
        ], $this->customMessages, $this->customAttributes);

        if($validator->fails()){
            return $validator->messages();
        }

        $member_id = $request->member_id;
        $discipline_id = $request->discipline_id;

        $discipline = DisciplineMember::where('discipline_id','=',$discipline_id)->where('member_id', '=',$member_id);
        $result = $discipline->delete();

        $flasher->addSuccess('Disciplina rimossa', 'Operazione conclusa con successo');
        return $result;
    }
}
