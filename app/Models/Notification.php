<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Notification extends DatabaseNotification 
{
    use HasFactory,Translatable;

    protected $casts = [
        'read_at' => 'datetime',
    ];
    // protected $with = ['translations'];

    // public function translations()
    // {
    //     return $this->hasMany(NotificationTranslation::class);
    // }
    


    // public function getTranslation()
    // {
    //     $currentLocale = app()->getLocale();
    //     return $this->translations->where('locale', 'en')->first();
    // }
    


}
