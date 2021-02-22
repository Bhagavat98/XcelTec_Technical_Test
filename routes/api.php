<?php

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

//login
Route::post('/login', [App\Http\Controllers\ApiController::class, 'login']);

//register
Route::post('/register', [App\Http\Controllers\ApiController::class, 'register']);


// ******  Passport auth token valdtion  ****** //
Route::middleware('auth:api')->group(function () {
    //logout
	Route::post('/logout', [App\Http\Controllers\ApiController::class, 'logout']);
});
