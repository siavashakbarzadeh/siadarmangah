<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Reliese\Coders\Model\Relations\HasOneOrMany;

class County extends Model
{
    use HasFactory;
    public $incrementing = false;

    public function member(): HasOne
    {
        return $this->belongsToMany(Member::class);
    }
}
