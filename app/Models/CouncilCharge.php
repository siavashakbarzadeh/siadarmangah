<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CouncilCharge extends Model
{
    use HasFactory;

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'council_charge_id');
    }
}
