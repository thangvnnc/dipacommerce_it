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
    Route::post('/admin/types/add',     'AdminController@post_type_add')            ->name('admin.types.post.add');
    Route::get('/admin/types/add',      'AdminController@type_add')                 ->name('admin.types.add');
    Route::post('/admin/types/edit',    'AdminController@post_type_edit')           ->name('admin.types.post.edit');
    Route::get('/admin/types/edit',     'AdminController@type_edit')                ->name('admin.types.edit');
    Route::post('/admin/types/del',    'AdminController@post_type_del')             ->name('admin.types.post.del');
    Route::get('/admin/types/del',     'AdminController@type_del')                  ->name('admin.types.del');

    Route::get('/admin/groups',         'AdminController@groups')                   ->name('admin.groups');
    Route::post('/admin/groups/add',     'AdminController@post_group_add')          ->name('admin.groups.post.add');
    Route::get('/admin/groups/add',      'AdminController@group_add')               ->name('admin.groups.add');
    Route::post('/admin/groups/edit',    'AdminController@post_group_edit')         ->name('admin.groups.post.edit');
    Route::get('/admin/groups/edit',     'AdminController@group_edit')              ->name('admin.groups.edit');
    Route::post('/admin/groups/del',    'AdminController@post_group_del')           ->name('admin.groups.post.del');
    Route::get('/admin/groups/del',     'AdminController@group_del')                ->name('admin.groups.del');

    Route::get('/admin/group_items',            'AdminController@group_items')           ->name('admin.group_items');
    Route::post('/admin/group_items/add',       'AdminController@post_group_item_add')   ->name('admin.group_item.post.add');
    Route::get('/admin/group_items/add',        'AdminController@group_item_add')        ->name('admin.group_item.add');
    Route::post('/admin/group_items/edit',      'AdminController@post_group_item_edit')  ->name('admin.group_item.post.edit');
    Route::get('/admin/group_items/edit',       'AdminController@group_item_edit')       ->name('admin.group_item.edit');
    Route::post('/admin/group_items/del',       'AdminController@post_group_item_del')   ->name('admin.group_item.post.del');
    Route::get('/admin/group_items/del',        'AdminController@group_item_del')        ->name('admin.group_item.del');

    Route::get('/admin/items',          'AdminController@items')                  ->name('admin.items');
    Route::post('/admin/items/add',     'AdminController@post_item_add')          ->name('admin.items.post.add');
    Route::get('/admin/items/add',      'AdminController@item_add')               ->name('admin.items.add');
    Route::post('/admin/items/edit',    'AdminController@post_item_edit')         ->name('admin.items.post.edit');
    Route::get('/admin/items/edit',     'AdminController@item_edit')              ->name('admin.items.edit');
    Route::post('/admin/items/del',    'AdminController@post_item_del')           ->name('admin.items.post.del');
    Route::get('/admin/items/del',     'AdminController@item_del')                ->name('admin.items.del');
});


Route::get('/test', 'MainController@test');


