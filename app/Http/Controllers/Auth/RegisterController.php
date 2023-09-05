<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\OtpVerfiyRequest;
use App\Http\Requests\User\RegisterRequest;
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
use Throwable;

class RegisterController extends BaseAuthController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'ams' => generateUniqueRandomNumber(User::class, 'ams', 10),
            'password' => Hash::make($data['password']),
        ]);
    }


    /**
     * Handle a registration request for the application.
     * this is the first step of register where otp is sent to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $this->sendOtpCode($request);
            $request->session()->put('phone', $request->phone);
            Cache::put('phone-user-' . $request->phone, $request->toArray(), Carbon::now()->addMinutes(20));
            $message = __('general.response_messages.otp_sent_success');
            $response = generateResponse(status: true, message: $message, redirect: route('user.otp.form' , 'register'));
        } catch (Throwable $e) {
            dd($e);
            info('WEB USER REGISER ERROR:');
            info($e);
            $message = __('general.response_messages.error');
            $response = generateResponse(status: false, message: $message);
        }
        return response()->json($response);
    }


    /**
     * second and the last step of registration.
     */
    public function verifyOtpForRegister(OtpVerfiyRequest $request)
    {
        try {
            $phone = $request->session()->get('phone');
            $incoming_otp = implode('' , $request->otp ?? []);
            if (Cache::has($phone. '-otp')) {
                $otp = Cache::get($phone. '-otp');
                if ($incoming_otp == $otp) {
                    $user_data = Cache::get('phone-user-' . $phone);
                    event(new Registered($user = $this->create($user_data)));
                    auth()->login($user);
                    $status = true;
                    $message = __('general.response_messages.success');
                    Cache::forget($phone. '-otp');
                    Cache::forget('phone-user-' . $request->phone);
                    $redirect = route('home');
                } else {
                    $status = false;
                    $message = __('general.response_messages.otp_not_match');
                }
            } else {
                $status = false;
                $redirect = route('register');
                $message = __('general.response_messages.error');
            }
            $response = generateResponse(status: $status, message: $message, redirect: $redirect ?? null);
        } catch (Throwable $e) {
            info('verifyOtpForRegister Error:');
            info($e);
            $message = __('general.response_messages.error');
            $response = generateResponse(status: false, message: $message);
        }
        return $response;
    }


}
