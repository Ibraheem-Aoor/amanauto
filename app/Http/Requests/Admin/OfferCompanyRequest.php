<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OfferCompanyRequest extends BaseAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $name_validation = 'required|string';
        return [
            'name_ar' => $name_validation,
            'name_en' => $name_validation,
            'location_url' => 'nullable|url',
        ];
    }


}
