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


Route::get('login','testController@login')->name('login');
Route::post('login','testController@loginPost')->name('loginPost');

Route::get('register','testController@register')->name('register');
Route::post('register','testController@registerPost')->name('registerPost');

Route::get('','testController@index')->name('index');
Route::post('indexPost','testController@indexPost')->name('indexPost');

Route::get('detail','testController@detail')->name('detail');

Route::get('action','testController@action')->name('action');
Route::post('actionPost','testController@actionPost')->name('actionPost');
