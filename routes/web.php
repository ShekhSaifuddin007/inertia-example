<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'foo' => 'bar'
    ]);
});
Route::get('/about', function () {
    return Inertia::render('About');
});
Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact.index');

Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::post('/users', 'UsersController@store')->name('users.store');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');
Route::get('/users/{query}', 'UsersController@search')->name('users.search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
