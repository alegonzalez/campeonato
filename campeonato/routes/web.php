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

Route::get('/home', function () {
    return view('welcome');
});
Route::get('/logout', function () {
    Auth::logout();
    return Redirect::to('home');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//championship
Route::get('/championship/index', 'ChampionshipController@index')->name('championship/index');
Route::get('/championship/edit/{id_championship}', 'ChampionshipController@edit')->name('championship/edit');
Route::post('/championship/update', 'ChampionshipController@update')->name('update');
Route::get('/championship/create/', 'ChampionshipController@create')->name('championship/create');
Route::post('/championship/storage/', 'ChampionshipController@storage')->name('storage');
Route::delete('/championship/{id_championship}', 'ChampionshipController@destroy')->name('destroy');;