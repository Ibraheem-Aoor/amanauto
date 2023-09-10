<?php

namespace App\Http\Resources\Club;

use Illuminate\Http\Resources\Json\JsonResource;

class AllClubResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $locale = app()->getLocale();
        return [
            'id'   =>   $this->getEncryptedId(),
            'name' => $this->translate($locale)->name,
            'duration' => $this->duration,
            'times' => $this->times,
            'price' => $this->price,
            'color' => $this->color,
            'is_coming_soon' => $this->is_coming_soon,
        ];
    }
}
