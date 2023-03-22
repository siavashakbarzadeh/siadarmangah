<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Goal extends Model
{
    use HasFactory;

    public function course(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)->withPivot('id');
    }
}
