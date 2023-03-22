<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToManyRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Reliese\Coders\Model\Relations\BelongsToMany;

class StudyGroup extends Model
{
    use HasFactory;

    public function members(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'study_groups_membership')->withPivot('charge_type_id');
    }

    public function charges(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(CommissionCharge::class, 'study_groups_membership', 'study_group_id','charge_type_id');
    }

    public static function getCharges($member_id, $study_group_id){

        return DB::table('commission_charges')
            ->join('study_groups_membership', 'study_groups_membership.charge_type_id','=', 'commission_charges.id')
            ->join('study_groups', 'study_groups.id', '=', 'study_groups_membership.study_group_id')
            ->select('commission_charges.*', 'study_groups.id', 'study_groups_membership.member_id')
            ->where('study_groups_membership.member_id', '=', $member_id)
            ->where('study_groups.id', '=', $study_group_id);
    }

}
