<?php

namespace App\Http\Controllers\User;

use App\Enums\ClubStatus;
use App\Enums\VatType;
use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Coupon;
use App\Models\CouponUsage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;

class SubscribeController extends Controller
{
    public function index(Request $request, $club)
    {
        $data['club'] = Club::query()->findOrFail(decrypt($club));
        return view('user.subscribe.index_test', $data);
    }

    /**
     * Check if coupon code valid or not
     */
    public function checkCouponCode(Request $request)
    {
        try {
            $response['is_valid'] = isValidCouponCode($request->coupon_code);
            $coupon = Coupon::query()->whereCode($request->coupon_code)->first();
            $response['discount_value'] = $coupon->discount_value;
            $response['discount_type'] = $coupon->discount_type == VatType::PERCENT->value ? '%' : getSystemCurrency();
            $response['message'] = $response['is_valid'] == true ? __('general.valid_coupon_code') : __('general.invalid_coupon_code');
        } catch (Throwable $e) {
            $response['is_valid'] = false;
            $response['message'] = __('general.invalid_coupon_code');
        }
        return response()->json($response);
    }
}
