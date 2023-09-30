<?php

namespace App\Models;

use App\Enums\Duration;
use App\Enums\VatType;
use App\Traits\Trackable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Club extends Model implements TranslatableContract
{
    use HasFactory, Translatable, Trackable;

    protected $fillable = [
        'duration',
        'duration_type',
        'times',
        'status',
        'added_by',
        'price',
        'prev_price',
        'color',
        'added_by',
        'is_coming_soon',
        'vat',
        'vat_type',
    ];

    protected $with = ['translations'];

    public $translatedAttributes = ['name', 'description'];


    ######### START RELATIONS ##########
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'club_services')->withTimestamps();
    }
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'club_id');
    }
    ######### END RELATIONS ##########

    ######### START SCOPES ##########
    public function scopeStatus($query, $value)
    {
        return $query->whereStatus($value);
    }
    ######### END  SCOPES ##########


    public function getServicesIds(): array
    {
        return $this->services->pluck('id')?->toArray() ?? [];
    }

    public function getTimesAttribute()
    {
        return $this->attributes['times'] == -1 ? (__('general.unlimited')) : $this->attributes['times'];
    }
    /**
     * return origianal attribute regard custom above getter.
     * used to display well for admin panel
     */
    public function getTimesOriginalAttribute()
    {
        return $this->attributes['times'];
    }

    public function getDurationAttribute()
    {
        return $this->attributes['duration'] . ' ' . __('general.' . $this->attributes['duration_type']);
    }

    /**
     * return origianal attribute regard custom above getter.
     * used to display well for admin panel
     */
    public function getDurationOriginalAttribute()
    {
        return $this->attributes['duration'];
    }


    /**
     * Get Encrypted Id
     */
    public function getEncryptedId()
    {
        return encrypt($this->id);
    }


    /**
     * get total price
     */
    public function getTotalPrice($with_currency = false)
    {
        if ($this->vat_type == VatType::PERCENT->value) {
            $total_vat = ($this->vat / 100) * $this->price;
        } else {
            $total_vat = $this->vat;
        }
        return formatPrice($this->price + $total_vat, $with_currency);
    }

    /**
     * return total vat in text format to display in order page
     */
    public function getTotalVatText()
    {
        return __('general.total_with_vat') . ' ' . getFormatedClubVat($this);
    }
}
