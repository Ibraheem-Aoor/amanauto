<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;


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
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string' , 'phone:INTERNATIONAL', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
