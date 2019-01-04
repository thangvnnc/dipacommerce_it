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
Route::get('/accessori_type',           'MainController@accessori_type')            ->name('accessori_type');
Route::get('/accessori_group',          'MainController@accessori_group')           ->name('accessori_group');
Route::get('/accessori_item',           'MainController@accessori_item')            ->name('accessori_item');
Route::get('/accessori_item_detail',    'MainController@accessori_item_detail')     ->name('accessori_item_detail');


// admin
Route::get('/admin',                    'AdminController@index')                    ->name('admin.index');
Route::get('/admin/login',              'AdminController@login')                    ->name('admin.login');
Route::get('/admin/home',               'AdminController@home')                     ->name('admin.home');

Route::get('/test', 'MainController@test');


