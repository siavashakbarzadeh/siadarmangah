<?php

namespace App\Http\Controllers;

use App\Models\CommissionCharge;
use App\Models\CommitteeMembership;
use App\Models\StudyGroupMembership;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommitteeController extends Controller
{
    public function store(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'committee_id' => 'required',
            'charge_type_id' => 'required'
        ]);
        if($validator->fails()){
            return $validator->messages();
        }

        $committee = new CommitteeMembership();
        $committee->member_id = $request->member_id;
        $committee->committee_id = $request->committee_id;
        $committee->commission_charge_id = $request->charge_type_id;
        $result = $committee->save();

        if($result)
            $flasher->addSuccess('Comitato aggiunto', 'Operazione conclusa con successo');
        else
            $flasher->error('Qualcosa è andato storto', 'Ops, si è verificato un errore');

        return $result;
    }

    public function delete(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'committee_id' => 'required'
        ]);
        if($validator->fails()){
            return $validator->messages();
        }

        $committee_id = $request->committee_id;
        $member_id = $request->member_id;
        $committeeMembership = CommitteeMembership::where('member_id', '=', $member_id)->where('committee_id','=',$committee_id);
        $result = $committeeMembership->delete();

        if($result != 0){
            $flasher->addSuccess('Membro rimosso dal comitato', 'Operazione conclusa con successo');
            return $result;
        }
        else{
            $flasher->error('Qualcosa è andato storto', 'Ops, si è verificato un errore');
            return $result;
        }
    }
}
