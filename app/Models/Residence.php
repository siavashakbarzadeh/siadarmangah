<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Residence extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
