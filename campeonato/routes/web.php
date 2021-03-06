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
Route::get('/home/{id_champioship?}/{key?}', 'HomeController@index')->name('home');

//championship
Route::get('/championship/index', 'ChampionshipController@index')->name('championship/index');
Route::get('/championship/edit/{id_championship}', 'ChampionshipController@edit')->name('championship/edit');
Route::post('/championship/update/{id_champioship}', 'ChampionshipController@update')->name('update');
Route::get('/championship/create/', 'ChampionshipController@create')->name('championship/create');
Route::post('/championship/storage/', 'ChampionshipController@storage')->name('storage');
Route::delete('/championship/{id_championship}', 'ChampionshipController@destroy')->name('destroy');


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

//Calendar
Route::get('/calendar/index/', 'CalendarController@index')->name('calendar/index');
Route::get('/calendar/show/{id_champioship?}/{key?}', 'CalendarController@show')->name('calendar/show');
Route::get('/calendar/create/{id_champioship}', 'CalendarController@create')->name('calendar/create');
Route::post('/calendar/storage', 'CalendarController@store')->name('calendar/storage');
Route::get('/calendar/edit/{id_champioship}', 'CalendarController@edit')->name('calendar/edit');
Route::post('/calendar/update/{id_calendar}', 'CalendarController@update')->name('calendar/update');
Route::get('/calendar/get_match/{id_champioship}', 'CalendarController@get_match')->name('calendar/get_match');
Route::delete('/calendar/{id_championship}', 'CalendarController@destroy')->name('calendar/destroy');

//position table
Route::get('/table/index', 'TableController@index')->name('table/index');
Route::get('/table/show/{id_championship?}/{key?}', 'TableController@show')->name('table/show');
Route::get('/table/edit/{id_table}', 'TableController@edit')->name('table/edit');
Route::post('/table/update/{id_table}', 'TableController@update')->name('table/update');

//breaches
Route::get('/breach/index', 'BreachController@index')->name('breach/index');
Route::get('/breach/create/{id_championship}', 'BreachController@create')->name('breach/create');
Route::get('/breach/get_players/{id_team}', 'BreachController@get_list_players')->name('breach/get_players');
Route::post('/breach/storage', 'BreachController@store')->name('breach/storage');
Route::get('/breach/show/{id_championship}', 'BreachController@show')->name('breach/show');
Route::get('/breach/edit/{id_breach}', 'BreachController@edit')->name('breach/edit');
Route::post('/breach/update/{id_breach}', 'BreachController@update')->name('breach/update');
Route::delete('/breach/{id_breach}', 'BreachController@destroy')->name('breach/destroy');
