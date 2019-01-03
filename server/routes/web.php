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

Route::get('/', 'MainController@index');
Route::get('/accessori_type',           'MainController@accessori_type');
Route::get('/accessori_group',          'MainController@accessori_group');
Route::get('/accessori_item',           'MainController@accessori_item');
Route::get('/accessori_item_detail',    'MainController@accessori_item_detail');
Route::get('/test', 'MainController@test');


