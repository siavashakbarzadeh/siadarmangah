<?php

namespace App\Custom;

use App\Models\Position;

class YoSidRepository
{
    public function getYoSid($category){
        return Position::where('sub_category','=',$category)
            ->where('member_type','<>','Partecipante ECM')
            ->count();
    }
}
