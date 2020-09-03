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


Route::get('/','InicioController@index')->name('inicio');

Auth::routes(['verify' => true]);

Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::get('/users', 'HomeController@users')->name('users');
    Route::get('/valor_uf', 'HomeController@valor_uf')->name('valor_uf');
});
