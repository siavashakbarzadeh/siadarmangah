<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantRole extends Model
{
    use HasFactory;
    protected $table = 'participant_role';

    public function frequency():\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Frequency::class);
    }
}
