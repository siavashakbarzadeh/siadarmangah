<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Region extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
}
