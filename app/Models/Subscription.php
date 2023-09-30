<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    /**
     * This Model Represnests  User Club Subscriptions.
     */
    protected $fillable = [
        'user_id',
        'club_id',
        'type',
        'duration',
        'status',
        'img_vehicle',
        'end_date',
        'vin',
    ];



    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Each Subscribtion might have one or more paymenty according to payment_type attribute.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'subscription_id');
    }

    public function getPayment()
    {
        // add condition here for payment_type => ['invoice'   , 'direct_payment']
        if (true) {
            return $this->payments()->orderByDesc('created_at')->first();
        }
    }
}
