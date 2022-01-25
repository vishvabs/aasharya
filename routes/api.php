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
    Route::get('suh/list', 'SuhController@list');
    Route::get('suh/editdata/{id}', 'SuhController@editdata');
    Route::get('inmate/lastId', 'InmateController@lastId');
    Route::post('suh/upload', 'SuhController@destroy');
    Route::get('suh/{dis}/{ulb}', 'Suhcontroller@filterSuh');
    Route::get('filtersuh/{dis}/{ulb}/{from}/{to}', 'SuhController@filterby');
    Route::get('filterinmate/{suh}/{from}/{to}', 'InmateController@filterInmate');
    Route::get('inmatefilter/{suh}', 'InmateController@filterInmatesuh');
    Route::get('getAttendance/{id}', 'AttendanceController@filterAttendance');
    Route::get('filterattendance/{id}/{from}/{to}', 'AttendanceController@filterReport');
    
    Route::get('getinmate/{id}', 'Inmatecontroller@filterbyId');
   
    

    Route::apiResources([
        'suh' => 'SuhController',
        'inmate' => 'InmateController',
        'attendance' => 'AttendanceController',
        
    ]);
});