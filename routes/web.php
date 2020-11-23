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

Route::get('/', 'HomeController@index')->name('home');

Route::post('/testdb','ProductsController@index');
Route::get('/refresh_captcha','Auth\RegisterController@refreshCaptcha')->name('refresh');
Route::get('/address/edit','AddressesController@edit')->name('address.edit');
Route::get('/change-password', 'Auth\ChangePasswordController@index')->name('password.change');
Route::post('/change-password', 'Auth\ChangePasswordController@changepassword')->name('password.updated');
Route::get('/pays/page/{page}', 'PaysController@index')->middleware('auth');
Route::get('/orders/page/{page}', 'OrdersController@index')->name('order')->middleware('auth');
Route::POST('/orders/search/{page}', 'OrdersController@search')->middleware('auth');
Route::resource('/orders', 'OrdersController');
Route::resource('/reports', 'ReportsController');
Auth::routes();
Route::POST('/report/search', 'ReportsController@search')->name('search')->middleware('auth');
Route::get('/report/search', 'ReportsController@search')->name('search')->middleware('auth');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/payments', 'PaymentsController@index')->name('payments');

Route::get('/products/add', 'ProductsController@add')->name('products.add');
Route::resource('/products','ProductsController');

Route::resource('/addresses','AddressesController')->middleware('auth');

Route::get('/cart/checkout','CartsController@checkout')->name('cart.checkout');
Route::post('/cart/edit','CartsController@edit')->name('carts.edit');
Route::resource('/cart','CartsController')->middleware('auth');


Route::resource('/pays', 'PaysController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile','UsersController@profile')->name('profile');
Route::get('/profile/edit','UsersController@edit')->name('profile.edit');
Route::post('/profile/update', 'UsersController@update')->name('profile.update');
Route::get('/users/page/{page}','UsersController@index')->name('users.index');
Route::get('/users','UsersController@destroy')->name('users.destroy');


Route::resource('/users','UsersController');
