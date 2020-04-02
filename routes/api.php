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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', 'UserController@index')->name('user.index');
Route::get('/test',function (Request $request){

    dd($request->headers->all());

    $response= new \Illuminate\Http\Response(json_encode(['msg'=>'teste']));
    return $response;


});


Route::namespace('Api')->name('api.')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@index')->name('user.index');
        Route::get('/{id}', 'UserController@show')->name('user.show');
        Route::post('/', 'CompanyController@add')->name('user.add');
        Route::put('/{id}', 'UserController@update')->name('user.update');
    });
    Route::prefix('company')->group(function () {
        Route::get('/', 'CompanyController@index')->name('company.index');
        Route::get('/{id}', 'CompanyController@show')->name('company.show');
        Route::post('/', 'CompanyController@add')->middleware('auth.basic')->name('company.add');
        Route::put('/{id}', 'CompanyController@update')->name('company.update');
    });
});