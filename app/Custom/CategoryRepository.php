<?php

namespace App\Custom;

use App\Models\Position;

class CategoryRepository
{
    public function getCategory($category_id){
        return Position::where('member_category','=',$category_id)
            ->where('member_type','<>','Partecipante ECM')
            ->count();
    }
}
