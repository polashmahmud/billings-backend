<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CustomerBillController;
use App\Http\Controllers\CustomerChangePasswordController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\UserLoginController;
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
Route::post('/login', UserLoginController::class);
Route::post('/login-customer', CustomerLoginController::class);

Route::group(['middleware' => ['api','manage_customer_token']], function () {
    Route::get('/customer/bills', CustomerBillController::class);
});

Route::group(['middleware' => ['api', 'manage_user_token']], function ($router) {
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
    Route::apiResource('/customers', CustomerController::class);
    Route::put('/customers/{customer}/password', CustomerChangePasswordController::class);
    Route::apiResource('/customers/{customer}/bills', BillController::class)
        ->only(['index', 'store', 'destroy']);
    Route::post('/customers/{customer}/bills/{bill}/pay', BillController::class . '@pay');
});
