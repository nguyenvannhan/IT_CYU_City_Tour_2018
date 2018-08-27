<?php

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

Route::get('/', 'HomeController@getLogin');

Route::get('/login', 'HomeController@getLogin')->name('get_login_route');
Route::post('/login', 'HomeController@postLogin')->name('post_login_route');
Route::get('/logout', 'HomeController@getLogout')->name('get_logout_route');


Route::prefix('admin')->group(function() {
    Route::get('/danh-oc-cho', 'AdminController@index');

});

Route::middleware('station_login')->prefix('tram-truong')->group(function() {
    Route::get('/thong-tin/{team_id?}', 'StationController@index')->name('get_station_route');

    Route::post('/open-suggestion', 'StationController@apiPostOpenSuggestion');
    Route::post('/save-mark', 'StationController@apiPostSaveMark');
    Route::get('/getContent/{team_id}', 'StationController@apiGetContent');
});

Route::middleware('team_login')->prefix('doi-choi')->group(function() {
    Route::get('/', 'TeamController@index')->name('get_team_route');

    Route::post('/get-question', 'TeamController@apiGetQuestion');
    Route::post('/check-answer', 'TeamController@apiCheckAnswer');
    Route::post('/expired-question', 'TeamController@apiExpiredQuestion');
});