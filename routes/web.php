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

    Route::get('/zen', 'Admin\AdminDashboardController@index')->name('dashboard');

    Route::resource('/zen/menus', 'Admin\AdminMenusController');
    Route::resource('/zen/maincategories', 'Admin\AdminMaincategoriesController');
    Route::resource('/zen/subcategories', 'Admin\AdminSubcategoriesController');

    Route::get('/zan/users/vip', 'Admin\AdminUsersController@vip')->name('users.vips');
    Route::get('/zan/users/admin', 'Admin\AdminUsersController@admin')->name('users.admins');
    Route::resource('/zen/users', 'Admin\AdminUsersController');

    Route::resource('/zen/products/colors', 'Products\ProductColorsController');
    Route::resource('/zen/products/sizes', 'Products\ProductSizesController');
    Route::resource('/zen/products/materials', 'Products\ProductMaterialsController');

    Route::resource('/zen/locations/countries', 'Admin\CountriesController');
    Route::resource('/zen/locations/cities', 'Admin\CitiesController');
    Route::resource('/zen/manufactors', 'Admin\ManufactorController');

    Route::get('/zen/menu/{id}/products', [
        'as' => 'products_main.index',
        'uses' => 'Admin\ProductsController@index'
    ]);
    Route::resource('zen/products_main', 'Admin\ProductsController', ['except' => 'index']);

    Route::get('/zen/menu/{id}/product_details', [
        'as' => 'products_detail.products',
        'uses' => 'Admin\ProductDetailsController@products'
    ]);
    Route::resource('zen/products_detail', 'Admin\ProductDetailsController');

    Route::get('/zen/menu/{id}/product_medias', [
        'as' => 'products_media.products',
        'uses' => 'Products\ProductMediasController@products'
    ]);
    Route::resource('zen/product_medias', 'Products\ProductMediasController');

    Route::resource('/zen/comments', 'Admin\CommentsController');
    Route::resource('/zen/comment_replies', 'Admin\CommentRepliesController');

});
