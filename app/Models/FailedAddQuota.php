<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedAddQuota extends Model
{
    use HasFactory;
    protected $table = 'failed_add_quota';
    public $timestamps = false;
}
