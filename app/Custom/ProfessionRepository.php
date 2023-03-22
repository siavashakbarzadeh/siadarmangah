<?php

namespace App\Custom;

use App\Models\Position;

class ProfessionRepository
{
    public function getProfession($profession_id)
    {
        return Position::where('profession_id','=',$profession_id)
            ->where('member_type','<>','Partecipante ECM')
            ->count();
    }
}
