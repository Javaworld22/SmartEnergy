<?php

//use DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::middleware(['basicAuth_route'])->prefix('api/smartenergy')->group(function () {
    Route::post('/signup', 'Auth\ApiRegisterController@apiregisteruser')->name('api.reg');
    Route::post('/basiclogin', 'Auth\ApiLoginController@basicauth')->name('api.basiclogin');

    //endpoints for request
    //Route::get('/consumption/list', 'CurrentReadingsController@list')->name('api.c_list');
    //Route::get('/consumption/add', 'CurrentReadingsController@add')->name('api.c_add');
});
Route::prefix('api/smartenergy')->group(function () {
    
    //endpoints for request
    Route::get('/consumption/list', 'CurrentReadingsController@list')->name('api.c_list');
    Route::get('/consumption/last', 'CurrentReadingsController@last')->name('api.c_last');
    Route::post('/consumption/add', 'CurrentReadingsController@add')->name('api.c_add');

    Route::post('/consumption/pay/create', 'CurrentReadingsController@payment')->name('api.c_add');
    Route::get('/consumption/pay/list', 'CurrentReadingsController@paymentList')->name('api.c_list');
    Route::get('/consumption/energy/used', 'CurrentReadingsController@used_energy')->name('api.e_used');
    Route::get('/consumption/energy/remaining', 'CurrentReadingsController@energy_remaining')->name('api.e_rem');
});
