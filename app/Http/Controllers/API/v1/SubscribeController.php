<?php

namespace App\Http\Controllers\API\v1;

use App\Enums\VatType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\v1\CheckIsValidCouponCodeRequest;

use App\Models\Coupon;

class SubscribeController extends Controller
{
    //

    public function checkCouponCode(CheckIsValidCouponCodeRequest $request)
    {
        try {
            $coupon = Coupon::query()->whereCode($request->coupon_code)->first();
            $is_valid=isValidCouponCode($request->coupon_code);
            $data=[
                'is_valid'=>$is_valid,
                'discount_value'=>$coupon->discount_value,
                'discount_type'=>$coupon->discount_type == VatType::PERCENT->value ? '%' : getSystemCurrency(),
            ];
            $code = 200;
            $message = $is_valid == true ? __('general.valid_coupon_code') : __('general.invalid_coupon_code');
            $response = generateApiResoponse(true, $code, $data, $message);

        } catch (Throwable $e) {
            $data = [];
            $message = __('general.response_messages.error');
            $code = 500;
            $response = generateApiResoponse(false, $code, $data, $message);
        }
        return $response;
    }





}
