<?php

namespace App\Models;

use App\Traits\HasStatus;
use App\Traits\Trackable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class CommonQuestion extends Model implements TranslatableContract
{
    use HasFactory, Translatable, Trackable , HasStatus;

    protected $fillable = ['added_by' , 'status'];
    protected $with = ['translations'];

    public $translatedAttributes = ['question', 'answer'];



    /**
     * Get Attribute limited str to display
     */
    public function getDisplayQuestionOrAnswer($attribute = 'question')
    {
        return Str::limit($this->$attribute, 40, '...');
    }

}
