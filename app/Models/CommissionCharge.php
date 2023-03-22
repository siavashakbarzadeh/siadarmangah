<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class CommissionCharge extends Model
{
    use HasFactory;

    public function studyGroup(): BelongsToMany
    {
        return $this->belongsToMany(StudyGroup::class, 'study_groups_membership');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'study_groups_membership');
    }

}
