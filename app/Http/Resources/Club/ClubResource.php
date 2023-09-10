<?php

namespace App\Http\Resources\Club;

use App\Enums\VatType;
use App\Http\Resources\ServiceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClubResource extends JsonResource
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
            'name' => $this->translate($locale)->name,
            'duration' => $this->duration,
            'times' => $this->times,
            'price' => $this->price,
            'prev_price' => $this->prev_price,
            'discount' => getClubDiscountedPrice(
                $this,
                return_type: VatType::FLAT->value,
                with_currency: true
            ),
            'vat_text' => $this->getTotalVatText(),
            'total_price_with_vat' => $this->getTotalPrice(),
            'color' => $this->color,
            'description' => $this->description,
            'subscribe_text' => getClubSubscribeText($this),
            'services' => ServiceResource::collection($this->whenLoaded('services')),
        ];
    }
}
