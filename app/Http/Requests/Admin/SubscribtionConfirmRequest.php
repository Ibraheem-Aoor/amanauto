<?php

namespace App\Http\Requests\Admin;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class SubscribtionConfirmRequest extends BaseAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'vin' => 'required',
        ];
    }



}
