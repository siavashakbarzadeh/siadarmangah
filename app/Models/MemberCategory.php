<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberCategory extends Model
{
    use HasFactory;
    protected $table = 'members_category';

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_category');
    }
}
