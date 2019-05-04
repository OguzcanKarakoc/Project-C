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

// region: Admin routes
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('dashboard', 'admin\AdminController@dashboard');
    Route::get('settings', 'admin\AdminController@settings');

    Route::resource('tags', 'admin\TagController');
    Route::resource('suppliers', 'admin\SupplierController');
    Route::resource('categories', 'admin\CategoryController');
    Route::resource('products', 'admin\ProductController');
    Route::resource('roles', 'admin\RoleController');
    Route::resource('productStatuses', 'admin\ProductStatusController');
    Route::resource('orderStatuses', 'admin\OrderStatusController');
    Route::resource('formTypes', 'admin\FormTypeController');
    Route::resource('users', 'admin\UserController');
    Route::resource('shipments', 'admin\ShipmentController');
    Route::resource('orders', 'admin\OrdersController')->except([
        'store', 'create'
    ]);

//    Route::resource('users/{id}/addresses', 'admin\AddressController');
});
// endregion:

// region: User routes
Route::group(['prefix' => 'user', 'middleware' => 'auth:user'], function () {
    Route::get('/profile/', 'UserController@index')->name('profile.index');
    Route::get('/order/{id}', 'CheckoutController@show')->name('order.show');
    Route::get('/order', 'CheckoutController@orderIndex')->name('order.orderIndex');
    Route::resource('/{id}/addresses', 'AddressController')->except(['index', 'show']);
    Route::get('/profile/edit/{id}', 'UserController@edit')->name('front.user.edit');
    Route::put('/profile/edit/{id}', 'UserController@update')->name('front-user.update');

});
// endregion:

Auth::routes();


Route::get('/getchartquantity', 'admin\ChartController@getChartQuantity');
Route::get('/getchartprofit', 'admin\ChartController@getChartProfit');


Route::get('/products', 'ProductController@ajaxPagination')->name('ajax-paginate');
Route::get('/products/{product}', 'ProductController@show')->name('products.show');

Route::match(['get', 'post'], '/admin', 'admin\AdminController@login');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/add-to-cart', 'CartController@addToCart')->name('ajax-addToCart');
Route::post('/update-cart', 'CartController@updateCart')->name('ajax-updateCart');
Route::get('/get-cart', 'CartController@getCart')->name('ajax-getCart');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::delete('/cart/delete/{id}', 'CartController@destroy');

Route::post('/updateRating', 'RatingController@store');
Route::delete('/deleteProsCons', 'RatingController@deleteProsCons');
//Route::post('/addRating', 'RatingController@rate');

Route::post('/addToFavorites', 'HomeController@add')->name('favorites.add');
Route::get('/favorites', 'HomeController@getFavorites')->name('favorites.index');
Route::get('favorites/delete/{favorite}', ['as' => 'favorite.delete', 'uses' => 'HomeController@destroy']);

Route::get('/', 'HomeController@index')->name('home.index');

Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');

// Register/Sign-in
Route::match(['get', 'post'], '/registration', 'UserController@register');
Route::get('/registration', 'UserController@register')->name('user.register');

Route::match(['get', 'post'], '/signin', 'UserController@signin');
Route::get('/signin', 'UserController@signin')->name('user.signin');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


Route::post('/checkout/order', 'CheckoutController@store')->name('checkout.store');
Route::get('/checkout/order', 'CheckoutController@index')->name('order.index');
Route::post('/checkout/order', 'OrderController@store')->name('order.store');


// old email
Route::get('/contact', 'ContactController@index')->name('contact.index');
Route::post('/contact', 'ContactController@sendEmail')->name('contact.sendmail');

