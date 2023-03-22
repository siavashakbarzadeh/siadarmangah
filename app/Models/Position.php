<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Reliese\Coders\Model\Relations\BelongsTo;

class Position extends Model
{
    use HasFactory;

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Members::class);
    }

    public function charge(): HasOne
    {
        return $this->hasOne(CouncilCharge::class, 'id');
    }

    public function region(): HasOne
    {
        return $this->hasOne(Region::class,'id');
    }

    public function jobType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(JobType::class);
    }

    public function profession(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }
}
