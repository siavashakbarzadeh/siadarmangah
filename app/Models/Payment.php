<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Payment extends Model
{
    use HasFactory;
    use Sortable;

    public $timestamps = false;
    protected $table = 'member_payments';
    public array $sortable = ['name','surname'];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function paymentType(): BelongsToMany
    {
        return $this->belongsToMany(PaymentType::class, 'payment_type');
    }

    public function receipt(): HasOne
    {
        return $this->hasOne(MemberReceipt::class, 'member_payment_id');
    }

    public function scopeDateEnd($query, $date){
        if(!empty($date))
            return $query->whereDate('member_payments.payment_date','<=', $date)
                ->orWhereYear('date','=',Carbon::parse($date)->format('Y'));;
    }

    public function scopePaymentMethod($query, $paymentMethod){
        if(!empty($paymentMethod))
            return $query->where('payment_type_id','=', $paymentMethod);
    }

    public function scopeRegion($query, $region)
    {
        if(!empty($region))
            return $query->where('positions.region_id',$region);
    }
}
