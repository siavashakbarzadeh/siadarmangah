<?php

namespace App\Http\Controllers;

use App\Models\StudyGroup;
use App\Models\StudyGroupMembership;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudyGroupController extends Controller
{
    public function store(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'study_group_id' => 'required',
            'charge_type_id' => 'required'
        ]);
        if($validator->fails()){
            return $validator->messages();
        }

        $studyGroup = new StudyGroupMembership();
        $studyGroup->member_id = $request->member_id;
        $studyGroup->study_group_id = $request->study_group_id;
        $studyGroup->charge_type_id = $request->charge_type_id;
        $result = $studyGroup->save();

        if($result)
            $flasher->addSuccess('Gruppo di studio aggiunto', 'Operazione conclusa con successo');
        else
            $flasher->error('Qualcosa è andato storto', 'Ops, si è verificato un errore');

        return $result;
    }

    public function delete(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'study_group_id' => 'required'
        ]);
        if($validator->fails()){
            return $validator->messages();
        }

        $study_group_id = $request->study_group_id;
        $member_id = $request->member_id;
        $studyGroupMembership = StudyGroupMembership::where('member_id', '=', $member_id)->where('study_group_id','=',$study_group_id);
        $result = $studyGroupMembership->delete();

        if($result != 0){
            $flasher->addSuccess('Gruppo di studio rimosso', 'Operazione conclusa con successo');
            return $result;
        }
        else{
            $flasher->error('Qualcosa è andato storto', 'Ops, si è verificato un errore');
            return $result;
        }
    }

    public function addSetting(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'study_group' => 'required'
        ]);
        if($validator->fails()){
            return $validator->messages();
        }

        $studyGroup = new StudyGroup();
        $studyGroup->group = $request->study_group;
        $result = $studyGroup->save();

        if($result){
            $flasher->addSuccess('Gruppo di studio aggiunto', 'Operazione conclusa con successo');
            return $result;
        }
        else{
            $flasher->error('Qualcosa è andato storto', 'Ops, si è verificato un errore');
            return $result;
        }
    }

    public function deleteSetting(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'study_group_id' => 'required'
        ]);
        if($validator->fails()){
            return $validator->messages();
        }
        $study_group_id = $request->study_group_id;
        $studyGroup = StudyGroup::where('id','=',$study_group_id);
        $studyGroupMembership = StudyGroupMembership::where('study_group_id', $study_group_id);
        $studyGroupMembership->delete();
        $result = $studyGroup->delete();

        if($result != 0){
            $flasher->addSuccess('Gruppo di studio rimosso', 'Operazione conclusa con successo');
            return $result;
        }
        else{
            $flasher->error('Qualcosa è andato storto', 'Ops, si è verificato un errore');
            return $result;
        }
    }
}
