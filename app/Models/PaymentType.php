<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentType extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function payment()
    {
        return $this->belongsToMany(Payment::class, 'payment_type');
    }
}
