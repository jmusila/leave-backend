<?php

use App\Http\Controllers\LeaveCalculatorController;
use App\Http\Controllers\UserController;
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

Route::controller(LeaveCalculatorController::class)->group(function () {
    Route::get('annual-leave', 'annualLeaveCalculator');
});

Route::controller(UserController::class)->group(function () {
    Route::post('create-user', 'register');
    Route::get('list-users', 'index');
});
