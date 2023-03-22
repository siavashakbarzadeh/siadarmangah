<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MemberCertificate extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function member(): HasOne
    {
        return $this->hasOne(Member::class,'id', 'member_id');
    }

    public function course(): HasOne
    {
        return $this->hasOne(Course::class,'id', 'course_id');
    }
}
