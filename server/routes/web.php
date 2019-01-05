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
Route::get('/types',           'MainController@types')             ->name('types');
Route::get('/groups',          'MainController@groups')            ->name('groups');
Route::get('/items',           'MainController@items')             ->name('items');
//Route::get('/accessori_item_detail',    'MainController@accessori_item_detail')     ->name('accessori_item_detail');

// admin
Route::get('/admin',                    'AdminController@index')                    ->name('admin.index');
Route::get('/admin/login',              'AdminController@login')                    ->name('admin.login');
Route::post('/admin/login',             'AdminController@postLogin')                ->name('admin.post.login');
Route::get('/admin/logout',             'AdminController@logout')                   ->name('admin.logout');

Route::group(['middleware' => 'session'], function () {
    Route::get('/admin/home',           'AdminController@home')                     ->name('admin.home');
    Route::get('/admin/menus',          'AdminController@menus')                    ->name('admin.menus');
    Route::get('/admin/types',          'AdminController@types')                    ->name('admin.types');
    Route::get('/admin/groups',         'AdminController@groups')                   ->name('admin.groups');
    Route::get('/admin/group_items',    'AdminController@group_items')              ->name('admin.group_items');
    Route::get('/admin/items',          'AdminController@items')                    ->name('admin.items');
});


Route::get('/test', 'MainController@test');


