<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\OtpRequest;
use App\Http\Requests\User\ForgetPasswordOtpRequest;
use App\Http\Requests\User\OtpRequest as UserOtpRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Throwable;

class ForgotPasswordController extends BaseAuthController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;



    /**
     * Send a otp code to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(ForgetPasswordOtpRequest $request)
    {
        try
        {
            $request->session()->put('phone' , $request->phone);
            $this->sendOtpCode($request);
            $response = generateResponse(status:true , redirect:route('user.otp.form' , 'password_reset') , message:__('general.response_messages.otp_sent_success') );
        }catch(Throwable $e)
        {
            $response      =     generateResponse(status:false);
        }
        return response()->json($response);
    }

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $request->validate(['phone' => 'required|email']);
    }

}
