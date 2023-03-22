<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kyslik\ColumnSortable\Sortable;

class MemberReceipt extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'member_payment_id');
    }

    public function scopeDateStart($query, $date){
        if(!empty($date))
            return $query->whereDate('member_payments.payment_date','>=', $date);
    }

    public function scopeDateEnd($query, $date){
        if(!empty($date))
            return $query->whereDate('member_payments.payment_date','<=', $date);
    }

    public function scopePaymentMethod($query, $paymentMethod){
        if(!empty($paymentMethod))
            return $query->where('member_payments.payment_type_id','=', $paymentMethod);
    }

    public function scopeRegion($query, $region)
    {
        if(!empty($region))
            return $query->where('positions.region_id',$region);
    }
}
