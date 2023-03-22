<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyGroupMembership extends Model
{
    use HasFactory;
    protected $table = 'study_groups_membership';
    public $timestamps = false;
}
