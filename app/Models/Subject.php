<?php

namespace App\Models;

use App\Traits\HasStatus;
use App\Traits\Trackable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model implements  TranslatableContract
{
    use HasFactory ,  Translatable , HasStatus , Trackable;
    protected $fillable = [
        'status',
        'added_by'
    ];
    protected $with = ['translations'];
    public $translatedAttributes  = [
        'name',
    ];
}
