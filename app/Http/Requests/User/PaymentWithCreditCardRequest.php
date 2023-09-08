<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardExpirationMonth;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardNumber;

class PaymentWithCreditCardRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // get expire date.
        $epire_date = explode('/', $this->card_date);
        $this['expiration_month'] = @$epire_date[0];
        $this['expiration_year'] = @$epire_date[1];
        return [
            'img_vehicle'       =>  'required|file|mimes:jpeg,jpg,png,webp',
            'card_number' => ['required' , new CardNumber],
            'expiration_year' => ['required', new CardExpirationYear($this->get('expiration_month'))],
            'expiration_month' => ['required', new CardExpirationMonth($this->get('expiration_year'))],
            'cvc' => ['required', new CardCvc($this->get('card_number'))],
        ];
    }
}
