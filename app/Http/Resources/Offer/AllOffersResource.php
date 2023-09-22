<?php

namespace App\Http\Resources\Offer;

use Illuminate\Http\Resources\Json\JsonResource;

class AllOffersResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getEncryptedId(),
            'name' => $this->name,
            'discount' => getFormattedDiscountText($this->discount_value, $this->discount_type),
            'company' => $this->company->name,
            'end_date' => $this->end_date,
            'download_url' => 'google.com',
        ];
    }

}
