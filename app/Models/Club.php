<?php

namespace App\Models;

use App\Traits\Trackable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Club extends Model implements TranslatableContract
{
    use HasFactory, Translatable, Trackable;

    protected $fillable = ['duration', 'duration_type', 'times', 'status', 'added_by', 'price', 'color', 'added_by'];

    protected $with = ['translations'];

    public $translatedAttributes = ['name', 'description'];


    ######### START RELATIONS ##########
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'club_services')->withTimestamps();
    }
    ######### END RELATIONS ##########



    public function getServicesIds(): array
    {
        return $this->services->pluck('id')?->toArray() ?? [];
    }

    public function getTimesAttribute()
    {
        return $this->attributes['times'] == -1 ? (__('general.unlimited')) : $this->attributes['times'];
    }

    public function getTimesOriginalAttribute()
    {
        return $this->attributes['times'];
    }
}
