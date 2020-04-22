<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/logout', function () {
  Session::flush();
  Auth::logout();
  return Redirect::to('home');
});
Auth::routes();
Route::get('/home/{key_share?}', 'HomeController@index')->name('home');

//championship
Route::get('/championship/index', 'ChampionshipController@index')->name('championship/index');
Route::get('/championship/edit/{id_championship}', 'ChampionshipController@edit')->name('championship/edit');
Route::post('/championship/update/{id_champioship}', 'ChampionshipController@update')->name('update');
Route::get('/championship/create/', 'ChampionshipController@create')->name('championship/create');
Route::post('/championship/storage/', 'ChampionshipController@storage')->name('storage');
Route::delete('/championship/{id_championship}', 'ChampionshipController@destroy')->name('destroy');
//share page
Route::get('/user/share/', 'UserController@share_page')->name('share');

//team
Route::get('/team/index', 'TeamController@index')->name('team/index');
Route::get('/team/create', 'TeamController@create')->name('team/create');
Route::post('/team/storage', 'TeamController@storage')->name('team/storage');
Route::get('/team/edit/{id_team}', 'TeamController@edit')->name('team/edit');
Route::post('/team/update/{id_team}', 'TeamController@update')->name('team/update');
Route::delete('/team/{id_team}', 'TeamController@destroy')->name('team/destroy');

//player
Route::get('/player/index/', 'PlayerController@index')->name('player/index');
Route::post('/player/getPlayer', 'PlayerController@get_player')->name('/player/getPlayer');
Route::get('/player/create', 'PlayerController@create')->name('player/create');
Route::post('/player/storage', 'PlayerController@store')->name('player/storage');
Route::get('/player/edit/{id_player}', 'PlayerController@edit')->name('player/edit');
Route::post('/player/update/{id_player}', 'PlayerController@update')->name('player/update');
Route::post('/player/destroy/{id_player}', 'PlayerController@destroy')->name('player/destroy');
Route::get('/player/get_teams/{id_championship}', 'PlayerController@get_teams')->name('player/get_teams');
