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
/*
Route::get('/home/{key_share?}', function () {
    return view('welcome');
})->name('home');
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
Route::post('/championship/update', 'ChampionshipController@update')->name('update');
Route::get('/championship/create/', 'ChampionshipController@create')->name('championship/create');
Route::post('/championship/storage/', 'ChampionshipController@storage')->name('storage');
Route::delete('/championship/{id_championship}', 'ChampionshipController@destroy')->name('destroy');
//share page
Route::get('/user/share/', 'UserController@share_page')->name('share');

//team
Route::get('/team/index/{key_share?}', 'TeamController@index')->name('team/index');
Route::get('/team/create', 'TeamController@create')->name('team/create');
Route::post('/team/storage', 'TeamController@storage')->name('team/storage');
Route::get('/team/edit/{id_team}', 'TeamController@edit')->name('team/edit');
Route::delete('/team/{id_team}', 'TeamController@destroy')->name('team/destroy');
