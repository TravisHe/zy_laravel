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
Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');

Route::group(['prefix' => 'ZanYiuAdminCenter'], function(){
    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');
    Route::get('/password/reset', 'AuthAdmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'AuthAdmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'AuthAdmin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'AuthAdmin\ResetPasswordController@reset');
});

Route::group(['middleware'=>'admin', 'as'=>'admin.', 'prefix' => 'ZanYiuAdminCenter'], function(){

    Route::get('/zen', 'Admin\AdminDashboardController@index')->name('dashboard');

    // Product menus and submenus inside admin center
    Route::resource('/zen/menus', 'Admin\AdminMenusController');
    Route::resource('/zen/maincategories', 'Admin\AdminMaincategoriesController');
    Route::resource('/zen/subcategories', 'Admin\AdminSubcategoriesController');

    // Admins|job titles && users|roles routes inside admin center
    Route::get('/zen/role/{id}/users', [
        'as' => 'users.roles',
        'uses' => 'Admin\AdminUsersController@roles'
    ]);
    Route::resource('zen/users', 'Admin\AdminUsersController');
    Route::resource('zen/roles', 'Admin\AdminRolesController');
    Route::resource('zen/admins', 'Admin\AdminManagersController');
    Route::resource('zen/jobs', 'Admin\AdminJobsController');

    Route::resource('/zen/products/colors', 'Products\ProductColorsController');
    Route::resource('/zen/products/sizes', 'Products\ProductSizesController');
    Route::resource('/zen/products/materials', 'Products\ProductMaterialsController');

    Route::resource('/zen/locations/countries', 'Admin\CountriesController');
    Route::resource('/zen/locations/cities', 'Admin\CitiesController');
    Route::resource('/zen/manufactors', 'Admin\ManufactorController');

    Route::get('/zen/menu/{id}/products', [
        'as' => 'products_main.products',
        'uses' => 'Admin\ProductsController@products'
    ]);
    Route::resource('zen/products_main', 'Admin\ProductsController');

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
