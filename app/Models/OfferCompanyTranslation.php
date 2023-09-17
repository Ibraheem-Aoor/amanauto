<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferCompanyTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'locale' , 'offer_company_id'];
}
