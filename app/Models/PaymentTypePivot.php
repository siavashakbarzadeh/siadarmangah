<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTypePivot extends Model
{
    use HasFactory;
    protected $table = 'payment_type';
}
