<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@welcome');

Route::auth();

Route::get('/monitor', 'MonitorController@index');
Route::get('/monitor/ajax-list', 'MonitorController@ajaxList');
Route::get('/monitor/ajax-get', 'MonitorController@ajaxGet');
Route::get('/monitor/ajax-get-measures', 'MonitorController@ajaxGetMeasures');
Route::get('/monitor/{id}', 'MonitorController@show');

// TODO: create route inside the package!
// HACK: route created here so the authentication can protect the URL
Route::resource('photoresistor', '\Fidias\Photoresistor\Http\Controllers\PhotoresistorController');
Route::resource('blinkleds', '\Fidias\Blinkleds\Http\Controllers\BlinkledsController');
Route::resource('temperature', '\Fidias\Temperature\Http\Controllers\TemperatureController');
Route::resource('sound', '\Fidias\Sound\Http\Controllers\SoundController');

Route::group(['prefix' => 'api', 'middleware' => ['throttle']], function()
{
	Route::resource('authenticate', 'JWTAuthController', ['only' => ['index']]);
	Route::post('authenticate', 'JWTAuthController@authenticate');
	Route::get('refresh-token', 'JWTAuthController@refreshToken');
    Route::resource('send', 'Api\SendController', ['only' => ['store']]);
});
