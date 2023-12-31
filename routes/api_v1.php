<?php

use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\ClubController;
use App\Http\Controllers\API\v1\HomeController;
use App\Http\Controllers\API\v1\OfferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::prefix(['auth:sanctum'])->group(function () {
// });



// Auth Routes
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('register/verfiy', [AuthController::class, 'verifyOtpForRegister']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('otp/resend', [AuthController::class, 'resendOTP']);
    Route::post('password/otp/request', [AuthController::class, 'resendOTP']);
    Route::post('password/change/request', [AuthController::class, 'resetPasswordRequest']);
    Route::post('password/change', [AuthController::class, 'changePassword']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

// home data
Route::get('home', [HomeController::class, 'index']);

// club routes
Route::group(['prefix' => 'clubs'], function () {
    Route::get('index', [ClubController::class, 'index']);
    Route::get('show/{id}', [ClubController::class, 'show']);
});
// offer routes
Route::group(['prefix' => 'offers' , 'middleware' => 'auth:sanctum'], function () {
    Route::get('index', [OfferController::class, 'index']);
    Route::get('show/{id}', [OfferController::class, 'show']);
});
