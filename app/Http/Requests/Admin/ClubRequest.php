<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ClubRequest extends BaseAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'services' => 'required|array',
            'price' => 'required|numeric',
            'color' => 'required',
            'duration' => 'required',
            'duration_type' => 'required',
            'times' => 'required|numeric',
            'description_ar' => 'required',
            'description_en' => 'required',
        ];
    }


}
