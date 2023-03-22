<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobType extends Model
{
    use HasFactory;

    public function position()
    {
        return $this->hasMany(Position::class);
    }
}
