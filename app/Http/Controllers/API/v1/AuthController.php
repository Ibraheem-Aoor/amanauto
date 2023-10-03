<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\ChangePasswordRequest;
use App\Http\Requests\API\v1\LoginRequest;
use App\Http\Requests\API\v1\OtpRequest;
use App\Http\Requests\API\v1\OtpVerfiyRequest;
use App\Http\Requests\API\v1\RegisterRequest;
use App\Models\User;
use App\Services\UltraMsgService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Throwable;
use Str;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        try {
            $this->sendOtpCode($request);
            // put user in cache to retrive him when verfiy
            Cache::put('phone-user-' . $request->phone, $request->toArray(), Carbon::now()->addMinutes(20));
            $data['phone'] = $request->phone;
            $message = __('general.response_messages.otp_sent_success');
            $response = generateApiResoponse(true, 201, $data, $message);
        } catch (Throwable $e) {
            $data = [];
            $message = $e->getMessage();
            $code = 500;
            $response = generateApiResoponse(false, $code, $data, $message);
        }
        return $response;
    }

    /**
     * Verify OTP For User Register module.
     */
    public function verifyOtpForRegister(OtpVerfiyRequest $request)
    {
        try {
            if (Cache::has($request->phone . '-otp')) {
                $otp = Cache::get($request->phone . '-otp');
                if ($request->otp == $otp) {
                    $user_data = Cache::get('phone-user-' . $request->phone);
                    $data['user'] = $this->createUser($user_data ?? []);
                    $data['user']['has_subscription'] = !is_null($data['user']->getCurrentSubscription());
                    $data['token'] = $data['user']->createToken($request->userAgent())?->plainTextToken;
                    $code = 201;
                    $status = true;
                    $message = __('general.response_messages.success');
                    Cache::forget($request->phone . '-otp');
                    Cache::forget('phone-user-' . $request->phone);
                } else {
                    $data = [];
                    $code = 500;
                    $status = false;
                    $message = __('general.response_messages.otp_not_match');
                }
            }
            $response = generateApiResoponse($status, $code, $data, $message);
        } catch (Throwable $e) {
            $data = [];
            $message = $e->getMessage();
            $code = 500;
            $response = generateApiResoponse(false, $code, $data, $message);
        }
        return $response;
    }


    /**
     * Send Otp Code for customer
     */
    public function resendOTP(OtpRequest $request)
    {
        try {
            $this->sendOtpCode($request);
            $data['phone'] = $request->phone;
            $message = __('general.response_messages.otp_sent_success');
            $code = 201;
            $status = true;
            $response = generateApiResoponse($status, $code, $data, $message);
        } catch (Throwable $e) {
            $message = __('general.response_messages.error');
            $code = 500;
            $status = false;
            $response = generateApiResoponse($status, $code, [], $message);
        }
        return $response;
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
        if(getAppEnv() != 'local')
        {
            $ultramsg_service = new UltraMsgService();
            $ultramsg_service->sendWaMessage($otp_data);
        }else{
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($otp_code);
        }
        Cache::put($request->phone . '-otp', $otp_code, Carbon::now()->addMinutes(20));
    }



    /**
     * create new user
     */
    protected function createUser(array $data)
    {
        $data['ams'] = generateUniqueRandomNumber(User::class, 'ams', 10);
        $data['password'] = makeHash($data['password']);
        return User::query()->create($data);
    }




    public function login(LoginRequest $request)
    {
        try {
            $data['user'] = User::query()->where('phone', $request->phone)->with('club')->first();
            if ($data['user'] && Hash::check($request->password, $data['user']->password)) {
                $data['user']['vin'] = $data['user']->vin;
                $data['user']['has_subscription'] = !is_null($data['user']->getCurrentSubscription());
                $data['user']['subscription_expire_date'] =   $data['user']->getCurrentSubscription()?->end_date;
                $data['token'] = $data['user']->createToken($request->userAgent())?->plainTextToken;
                $code = 201;
                $status = true;
            } else {
                unset($data['user']);
                $code = 401;
                $status = false;
                $message = __('auth.failed');
            }
        } catch (Throwable $e) {
            $code = 500;
            $status = false;
            $message = __('general.response_messages.error');
        }
        return generateApiResoponse($status, $code, $data ?? [], $message ?? '');
    }



    public function logout(Request $request)
    {
        try {
            if ($request->user()->currentAccessToken()?->delete()) {
                $code = 201;
                $status = true;
                $message = __('auth.logout_success');
            } else {
                $code = 404;
                $status = false;
            }
        } catch (Throwable $e) {
            $code = 500;
            $status = false;
            $message = __('general.response_messages.error');
        }
        return generateApiResoponse($status, $code, [], $message);
    }


    /**
     * reset password request in order to pass to acutal password change/reset
     */
    public function resetPasswordRequest(OtpVerfiyRequest $request)
    {
        try {
            if (Cache::has($request->phone . '-otp')) {
                $otp = Cache::get($request->phone . '-otp');
                if ($request->otp == $otp && User::query()->where('phone', $request->phone)->exists()) {
                    $data['phone'] = $request->phone;
                    $data['token'] = Cache::remember('reset-password-token-' . $data['phone'], Carbon::now()->addMinutes(10), function () {
                        return Str::random(40);
                    });
                    $code = 201;
                    $status = true;
                    $message = __('general.response_messages.success');
                    Cache::forget($request->phone . '-otp');
                    Cache::forget('phone-user-' . $request->phone);
                } else {
                    $data = [];
                    $code = 500;
                    $status = false;
                    $message = __('general.response_messages.otp_not_match');
                }
            }
            $response = generateApiResoponse($status, $code, $data, $message);
        } catch (Throwable $e) {
            $status = false;
            $data = [];
            $message = $e->getMessage();
            $code = 500;
            $response = generateApiResoponse($status, $code, $data, $message);
        }
        return $response;
    }


    /**
     * Change User Password.
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            if (
                User::query()->where('phone', $request->phone)->exists()
                && Cache::has('reset-password-token-' . $request->phone)
                && Cache::get('reset-password-token-' . $request->phone) == $request->token
            ) {
                $data['user'] = User::query()->where('phone', $request->phone)->firstOrFail();
                $data['user']->update(['password' => makeHash($request->password)]);
                $code = 201;
                $status = true;
                $message = __('general.response_messages.success');
                Cache::forget('reset-password-token-' . $request->phone);
            } else {
                $data = [];
                $code = 500;
                $status = false;
                $message = __('general.response_messages.error');
            }
            $response = generateApiResoponse($status, $code, $data, $message);
        } catch (Throwable $e) {
            $data = [];
            $message = $e->getMessage();
            $code = 500;
            $response = generateApiResoponse(false, $code, $data, $message);
        }
        return $response;
    }



}
