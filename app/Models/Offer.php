<?php

namespace App\Models;

use App\Traits\HasStatus;
use App\Traits\Trackable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model implements TranslatableContract
{
    use HasFactory , Trackable , Translatable , HasStatus;
    protected $fillable = [
        'added_by',
        'end_date',
        'discount_value',
        'discount_type',
        'status',
        'offer_company_id',
    ];

    protected $with = ['translations'];

    public $translatedAttributes = ['name' , 'description'];


    public function company() : BelongsTo
    {
        return $this->belongsTo(OfferCompany::class , 'offer_company_id');
    }
}
