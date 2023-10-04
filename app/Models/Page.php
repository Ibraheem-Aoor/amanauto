<?php

namespace App\Models;

use App\Traits\HasStatus;
use App\Traits\Trackable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Page extends Model implements TranslatableContract
{
    use HasFactory , Translatable , Trackable;
    protected $fillable = [
        'type' ,
        'slug',
        'added_by',
    ];

    protected $with = ['translations'];
    public $translatedAttributes = [
        'title',
        'content',
        'meta_title',
        'meta_description',
        'meta_image',
        'meta_keywords',
    ];
}
