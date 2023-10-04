<?php

namespace App\Http\Requests\Admin\Pages;

use App\Http\Requests\Admin\BaseAdminRequest;
use Illuminate\Foundation\Http\FormRequest;

class AboutPageRequest extends BaseAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'content_ar' => 'required',
            'content_en' => 'required',
        ];
    }


}
