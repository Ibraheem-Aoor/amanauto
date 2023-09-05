<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\OtpVerfiyRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Validation\ValidationException;
use Throwable;
use Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');
        $phone = $request->session()->get('phone');
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'phone' => $phone]
        );
    }




    public function verifyOtpForPasswordReset(OtpVerfiyRequest $request)
    {
        try {
            $phone = $request->session()->get('phone');
            $incoming_otp = implode('', $request->otp ?? []);
            if (Cache::has($phone . '-otp')) {
                $otp = Cache::get($phone . '-otp');
                if ($incoming_otp == $otp) {
                    $status = true;
                    $message = __('general.response_messages.success');
                    Cache::forget($phone . '-otp');
                    Cache::forget('phone-user-' . $request->phone);
                    $redirect = route('password.reset', encrypt(Str::random(10)));
                } else {
                    $status = false;
                    $message = __('general.response_messages.otp_not_match');
                }
            } else {
                $status = false;
                $redirect = route('home');
                $message = __('general.response_messages.error');
            }
            $response = generateResponse(status: $status, message: $message, redirect: $redirect ?? null);
        } catch (Throwable $e) {
            dd($e);
            info('verifyOtpForPasswordReset Error:');
            info($e);
            $message = __('general.response_messages.error');
            $response = generateResponse(status: false, message: $message);
        }
        return $response;
    }




    /**
     * Reset the given user's password after verifying otp
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(ResetPasswordRequest $request)
    {

        try {
            $user = User::query()->phone($request->phone)->first();
            $user->password = makeHash($request->password);
            $user->save();
            $response = generateResponse(status:true , redirect:route('login'));
        } catch (Throwable $e) {
            info('RESET PASSWORD LAST STEP ERROR: ');
            info($e);
            $response = generateResponse(status:false);
        }
        return response()->json($response);
    }



}
