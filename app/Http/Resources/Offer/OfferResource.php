<?php

namespace App\Http\Resources\Offer;

use Illuminate\Http\Resources\Json\JsonResource;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = getAuthUser('sanctum');
        $qrcode = QrCode::size(150)->generate('www.google.com');
        $code = (string) $qrcode;
        $qr_code = substr($code, 38);
        return [
            'id' => $this->getEncryptedId(),
            'name' => $this->name,
            'ams' => $user->ams,
            'vin' => 'WBAYG01256EDE597',
            'company' => $this->company->name,
            'end_date' => $this->end_date,
            'qr_code' =>  $qr_code,
            'description' => $this->description,
        ];
    }
}
