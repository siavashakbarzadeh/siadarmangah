<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Frequency extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function role():BelongsToMany
    {
        return $this->belongsToMany(ParticipantRole::class, 'frequencies', 'id', 'member_type');
    }

}
