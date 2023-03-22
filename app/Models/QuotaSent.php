<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotaSent extends Model
{
    use HasFactory;
    public $table = 'quotas_sent';
    public $timestamps = false;

    public function scopeRegion($query, $region)
    {
        if(!empty($region))
            return $query->where('region', $region);
    }
}
