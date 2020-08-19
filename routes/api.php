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
// User login
Route::post('/user/login','Auth\LoginController@Login');
Route::post('/user/getProfile','Auth\LoginController@getProfileUser');
// Register
Route::post('/user/register','Auth\RegisterController@register');
//User
Route::post('/keeper/addparking','User\KeeperController@addParking');
Route::post('/keeper/getparking','User\KeeperController@getAllParks');
Route::delete('/keeper/parking/{id}/delete','User\KeeperController@deleteParking');
Route::get('/getAllData','Admin\IndexController@getAllDataParks');
Route::get('/park/{id}/get','User\KeeperController@getParkUpdate');
Route::Patch('/park/{id}/edit','User\KeeperController@updatePark');
