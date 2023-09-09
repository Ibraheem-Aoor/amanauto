<?php

use App\Http\Controllers\Auth\BaseAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\User\ClubController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\SubscribeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('change-lang/{locale}', [LanguageController::class, 'changeLanguage'])->middleware('locale')->name('change_language');
Route::redirect('/home', '/');
Route::get('/', [HomeController::class, 'index'])->name('home');

// otp
Route::group(['prefix' => 'opt', 'middleware' => 'guest', 'as' => 'user.otp.'], function () {
    Route::get('/{type}', [BaseAuthController::class, 'showOtpForm'])->name('form');
    Route::post('/submit-for-register', [RegisterController::class, 'verifyOtpForRegister'])->name('submit_for_register');
    Route::post('/submit-for-pw-reset', [ResetPasswordController::class, 'verifyOtpForPasswordReset'])->name('submit_for_pw_reset');
});


//Club Routes
Route::group(['prefix' => 'club', 'as' => 'clubs.'], function () {
    Route::get('', [ClubController::class, 'index'])->name('index');
    Route::get('show/{id}', [ClubController::class, 'show'])->name('show');
});


// auth user routes
// Route::group(['middleware' => 'auth'], function () {
    // subscribe
    Route::group(['prefix' => 'subscribe', 'as' => 'subscribe.'], function () {
        Route::get('{club}/club', [SubscribeController::class, 'index'])->name('index');
        Route::get('check-coupon-code' , [SubscribeController::class, 'checkCouponCode'])->name('check_coupon_code');
        Route::post('/{club}/payment/make', [PaymentController::class, 'makePayment'])->name('make_payment');
        Route::get('/payment/cc/callback', [PaymentController::class, 'paymentCreditCardCallback'])->name('payment.credit_card_callback');
    });



// });
