<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ForgetPasswordOtpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::guard('web')->check();
    }

    /** 
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $data = $this->toArray();
        $this['phone'] = "+" . @$data['country_code'] . @$data['phone'];
        return [
            'phone' => ['required', 'string' , 'phone:INTERNATIONAL' , 'exists:users,phone'],
        ];
    }
}
