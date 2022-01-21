<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    Log::debug('User:' . serialize($request->user()));
    return $request->user();
});


Route::namespace('App\\Http\\Controllers\\API\V1')->group(function () {
    Route::get('district/list', 'DistrictController@list');
    Route::get('ulb/list', 'UlbController@list');
    Route::get('suh/lastId', 'SuhController@lastId');
    Route::post('suh/upload', 'SuhController@destroy');

    Route::apiResources([
        'suh' => 'SuhController',
    ]);
});