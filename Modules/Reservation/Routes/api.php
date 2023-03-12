<?php

use Illuminate\Http\Request;
use Modules\Reservation\Http\Controllers\ReservationController;

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

Route::middleware('auth:api')->get('/reservation', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->prefix('reserve')->group(function() {
    Route::post('/', [ReservationController::class, 'reserve']);
    Route::get('/export/{id}', [ReservationController::class, 'export']);
    Route::get('/unavailable-dates', [ReservationController::class, 'unavailableDates']);
});