<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function courses():BelongsTo
    {
        return $this->belongsToMany(Company::class);
    }
}
