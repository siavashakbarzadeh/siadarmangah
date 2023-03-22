<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Course extends Model
{
    use HasFactory;

    public function frequencies(): HasMany
    {
        return $this->hasMany(Frequency::class);
    }

    public function goal(): BelongsToMany
    {
        return $this->belongsToMany(Goal::class)->withPivot('id');
    }

    public function scientificHead():BelongsTo
    {
        return $this->belongsTo(Member::class, 'scientific_head');
    }

    public function sponsors():BelongsToMany
    {
        return $this->belongsToMany(Company::class,'sponsors')->withPivot('id','amount');
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(MemberCertificate::class);
    }
}
