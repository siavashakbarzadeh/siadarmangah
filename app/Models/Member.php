<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToManyRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;
    public $sortable = [
        'surname',
        'name'
    ];

    public function scopeSearchByString($query, $string)
    {
        $nameSurname = explode(" ", $string);

        if(!empty($nameSurname[1])){
            return $query->where('members.surname','like', '%'.$nameSurname[0].'%')
                ->orWhere('members.name','like', '%'.$nameSurname[1].'%')
            ->orWhere('members.surname','like', '%'.$nameSurname[1].'%')
            ->orWhere('members.name','like', '%'.$nameSurname[0].'%');
        } else {
            return $query->where('members.surname','like', '%'.$string.'%')
                ->orWhere('members.name','like', '%'.$string.'%')
                ->orWhere('members.email','like', '%'.$string.'%')
                ->orWhere('members.fiscal_code','like', '%'.$string.'%');
        }
    }

    public function scopeSearchBySurname($query, $string)
    {
        return $query->where('members.surname','like', '%'.$string.'%');
    }

    public function position(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Position::class);
    }

    public function job(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Job::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class)->orderBy('date', 'ASC');
    }

    public function PaymentHistory(): HasMany
    {
        return $this->hasMany(PaymentHistory::class);
    }

    public function frequencies(): HasMany
    {
        return $this->hasMany(Frequency::class);
    }

    public function category(): HasOne
    {
        return $this->hasOne(MemberCategory::class, 'id');
    }

    public function disciplines(): BelongsToMany
    {
        return $this->belongsToMany(Discipline::class);
    }

    public function residence(): HasOne
    {
        return $this->hasOne(Residence::class);
    }

    public function studyGroups(): BelongsToMany
    {
        return $this->belongsToMany(StudyGroup::class, 'study_groups_membership')->withPivot('charge_type_id');
    }

    public function charges(): BelongsToMany
    {
        return $this->belongsToMany(CommissionCharge::class, 'study_groups_membership');
    }

    public function committees(): BelongsToMany
    {
        return $this->belongsToMany(CommissionCharge::class, 'committee_membership');
    }

    public function county(): HasOne
    {
        return $this->hasOne(County::class, 'id', 'birth_place');
    }

    public function receipts(): HasMany
    {
        return $this->hasMany(MemberReceipt::class);
    }

    public function directedCourses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function certificates():HasMany
    {
        return $this->hasMany(MemberCertificate::class);
    }

}
