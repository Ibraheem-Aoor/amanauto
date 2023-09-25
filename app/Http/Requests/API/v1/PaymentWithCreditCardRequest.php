<?php

namespace App\Http\Requests\API\v1;

// use App\Rules\User\ValidCouponCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardExpirationMonth;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardNumber;

class PaymentWithCreditCardRequest extends FormRequest
{

    // protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // get expire date.
        return [
            'img_vehicle' => 'required|file|mimes:jpeg,jpg,png,webp',
            'card_number' => ['required', new CardNumber],
            'expiration_month' => ['required', new CardExpirationMonth($this->get('expiration_year'))],
            'expiration_year' => ['required', new CardExpirationYear($this->get('expiration_month'))],
            'cvc' => ['required', new CardCvc($this->get('card_number'))],
            'payment_method'=>'required|in:credit_card'
            // 'coupon_code' => ['sometimes', new ValidCouponCode],
        ];
    }
}
