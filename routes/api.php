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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(\App\Http\Controllers\Api\WorlController::class)
    ->middleware('auth:sanctum')
    ->name('api.world.')
    ->group(function () {
        Route::get('countries', 'countries')->name('countries');
        Route::get('states', 'states')->name('states');
        Route::get('cities', 'cities')->name('cities');
        Route::get('zipcodes', 'zipcodes')->name('zipcodes');
});
