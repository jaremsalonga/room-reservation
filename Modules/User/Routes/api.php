<?php

use Illuminate\Http\Request;
use Modules\User\Http\Controllers\AuthController;
use Modules\User\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/health-check', function (Request $request) {
    return 'Server is online!';
});

Route::prefix('user')->group(function() {
    Route::post('/register', [UserController::class, 'store']);
    Route::post('/login', [UserController::class, 'logIn']);
});

