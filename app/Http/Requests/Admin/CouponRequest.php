<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends BaseAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $code_validation = 'required|string|unique:coupons,code';
        if ($this->coupon) {
            $code_validation .= ',' . $this->coupon;
        }
        return [
            'code' => $code_validation,
            'discount_value' => 'required|numeric',
            'discount_type' => 'required|string',
            'times' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }


}
