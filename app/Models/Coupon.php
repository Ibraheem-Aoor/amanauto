<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_value',
        'discount_type',
        'times',
        'status',
        'start_date',
        'end_date',
    ];


    ####### START RELATIONS ######
    public function usages(): HasMany
    {
        return $this->hasMany(CouponUsage::class);
    }
    ####### END RELATIONS ######
}
