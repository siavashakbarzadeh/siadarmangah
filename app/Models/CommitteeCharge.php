<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommitteeCharge extends Model
{
    use HasFactory;
    public function members(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'committee_membership');
    }
}
