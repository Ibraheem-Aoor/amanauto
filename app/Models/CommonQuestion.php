<?php

namespace App\Models;

use App\Traits\Trackable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonQuestion extends Model implements TranslatableContract
{
    use HasFactory, Translatable , Trackable;

    protected $fillable = ['added_by'];
    protected $with = ['translations'];

    public $translatedAttributes = ['question', 'answer'];

}
