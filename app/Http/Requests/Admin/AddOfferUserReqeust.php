<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddOfferUserReqeust extends BaseAdminRequest
{

    /**
     * Get the validation rules that apply to the request. 
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
        ];
    }



}
