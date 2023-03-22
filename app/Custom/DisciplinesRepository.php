<?php

namespace App\Custom;

use App\Models\Member;

class DisciplinesRepository
{

    public function getDiscipline($discipline_id)
    {
        return Member::join('positions', 'members.id','=','positions.member_id')
            ->join('discipline_member', 'members.id', '=', 'discipline_member.member_id')
            ->where('positions.member_type','<>','Partecipante ECM')
            ->where('discipline_member.discipline_id','=',$discipline_id)
            ->orderBy('id','DESC')
            ->count();
    }

}
