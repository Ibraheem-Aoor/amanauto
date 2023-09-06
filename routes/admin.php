<?php

use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\CommonCrudController;
use App\Http\Controllers\Admin\CommonQuestionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\Admin\LoginController;
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






Route::redirect('/', 'admin/dashboard');
// ADmin Auth roues
Route::group(['as' => 'admin.'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    //common crud for services and clients.
    Route::resource('crud', CommonCrudController::class);
    Route::get('crud-table-data', [CommonCrudController::class, 'getTableData'])->name('crud.table_data');
    // faqs
    Route::resource('faqs', CommonQuestionController::class);
    Route::get('faqs-table-data', [CommonQuestionController::class, 'getTableData'])->name('faqs.table_data');
    // clubs
    Route::resource('clubs', ClubController::class);
    Route::get('clubs-table-data', [ClubController::class, 'getTableData'])->name('clubs.table_data');
});
