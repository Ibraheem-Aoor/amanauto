<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    ];



    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
