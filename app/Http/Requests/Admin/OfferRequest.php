<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends BaseAdminRequest
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
            'company_id' => 'required',
            'discount_value' => 'required|numeric',
            'discount_type' => 'required',
            'end_date' => 'required|date',
            'description_ar' => $name_validation,
            'description_en' => $name_validation,
        ];
    }



}
