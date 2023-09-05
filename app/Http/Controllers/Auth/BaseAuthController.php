<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\OtpVerfiyRequest;
use App\Http\Requests\API\v1\OtpRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\UltraMsgService;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BaseAuthController extends Controller
{

    public function showOtpForm(Request $request , $type)
    {
        $data['form_action']        =   $type == 'register' ?   route('user.otp.submit_for_register') : route('user.otp.submit_for_pw_reset');
        return view('auth.otp' , $data);
    }



    /**
     * Send Otp For Customers using whatsapp and cache phone => otp values for later check
     */
    protected function sendOtpCode($request)
    {
        $otp_code = generateRandomDigits(5);
        $otp_data = [
            'to' => $request->phone,
            'body' => 'AMAN AUTO OTP:' . $otp_code,
        ];
        $ultramsg_service = new UltraMsgService();
        $ultramsg_service->sendWaMessage($otp_data);
        Cache::put($request->phone . '-otp', $otp_code, Carbon::now()->addMinutes(20));
    }


}
