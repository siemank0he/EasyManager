<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel', function () {
    if ((Auth::user()->is_admin) == true){
        return view('panel');
    } else {
        return redirect()->back();
    }
    
});

Auth::routes();

Route::get('/panel', 'UserController@create');
Route::post('panel', 'UserController@store');


Route::get('/vacation', 'UserController@vacation');
Route::post('/vacation', 'UserController@vacation_proposal');

Route::post('/vacation/{id}', 'UserController@updateVacation');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/hours', 'easyController@hours');
//widok dodawania godzin
// Route::get('/hours', 'easyController@add');
//zapisywanie do bazy danych
Route::post('/hours', 'easyController@save');
//usuwanie z bazy danych
Route::delete('/hours/{id}', 'easyController@delete');
Route::delete('/panel/{id}', 'UserController@deleteUser');
Route::delete('/vacation/{id}', 'UserController@deleteVacation');

Route::get('/user/{id}','UserController@profile')->name('user.profile');
Route::get('/panel','UserController@AdminPanelindex');
// Route::get('/panel', 'UserController@showHours');

Route::get('/edit/user/','UserController@edit')->name('user.edit');
Route::post('/edit/user/','UserController@update')->name('user.update');

Route::get('/edit/password/user/','UserController@passwordEdit')->name('password.edit');
Route::post('/edit/password/user/','UserController@passwordUpdate')->name('password.update');
