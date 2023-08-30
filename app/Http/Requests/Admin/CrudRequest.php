<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CrudRequest extends BaseAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'web_img' => 'required|file|mimes:jpeg,jpg,png,webp',
            'mobile_img' => 'required|file|mimes:jpeg,jpg,png,webp',
        ];
    }
}
