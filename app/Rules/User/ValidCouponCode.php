<?php

namespace App\Rules\User;

use Illuminate\Contracts\Validation\Rule;
use Throwable;

class ValidCouponCode implements Rule
{

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {

            if (isset($value) && $value != null) {
                return isValidCouponCode($value);
            } elseif (isset($attribute) && is_null($value)) {
                return false;
            }
        } catch (Throwable $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('general.invalid_coupon_code');
    }
}
