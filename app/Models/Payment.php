<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'status',
        'method',
        'amount',
        'description',
        'metadata',
        'subscription_id',
        'user_id',
    ];



    ######## START RELATION #########

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Club::class, 'product_id');
    }


    public function subscriptions()
    {
        return $this->belongsTo(Subscription::class , 'subscription_id');
    }
    ######## END  RELATION #########

}
