<?php

namespace App\Models;

use App\Traits\HasEncryptedId;
use App\Traits\HasStatus;
use App\Traits\Trackable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model implements TranslatableContract
{
    use HasFactory, Translatable, Trackable, HasStatus, HasEncryptedId;
    protected $fillable = [
        'added_by',
        'web_img',
        'mobile_img',
        'status',
    ];

    protected $with = ['translations'];
    public $translatedAttributes = ['name'];


    ######### START RELATIONS ##########
    public function clubs(): BelongsToMany
    {
        return $this->belongsToMany(Club::class, 'club_services');
    }
    ######### END RELATIONS ##########






}
