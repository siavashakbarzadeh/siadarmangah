<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplineMember extends Model
{
    use HasFactory;
    protected $table = 'discipline_member';
    public $timestamps = false;
}
