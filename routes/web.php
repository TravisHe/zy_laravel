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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'admin', 'as'=>'admin.'], function(){

    Route::get('/zen', function(){
      return view('admin.index');
    })->name('dashboard');

    Route::resource('/zen/menus', 'Admin\AdminMenusController');
    Route::resource('/zen/maincategories', 'Admin\AdminMaincategoriesController');
    Route::resource('/zen/subcategories', 'Admin\AdminSubcategoriesController');

    Route::get('/zan/users/vip', 'Admin\AdminUsersController@vip')->name('users.vips');
    Route::get('/zan/users/admin', 'Admin\AdminUsersController@admin')->name('users.admins');
    Route::resource('/zen/users', 'Admin\AdminUsersController');


});
