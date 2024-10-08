<?php

use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);

    });


    Route::prefix('attendances')->middleware('auth:sanctum')->group(function () {
        Route::post('check-in', [AttendanceController::class, 'checkIn']);
        Route::patch('check-out', [AttendanceController::class, 'checkOut']);

        Route::post('get-total-hours-between-two-dates',[AttendanceController::class, 'getTotalHoursBetweenTwoDates']);


    });
});