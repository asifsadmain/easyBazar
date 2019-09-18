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

Route::get('/editAd/{id}', 'profileController@editAd');
Route::get('/deleteAd/{id}', 'profileController@deleteAd');
Route::get('/markSold/{id}', 'profileController@markSold');
Route::get('/deleteDisplayImage/{id}', 'profileController@deleteDisplayImage');
Route::get('/deleteImg1/{id}', 'profileController@deleteImg1');
Route::get('/deleteImg2/{id}', 'profileController@deleteImg2');
Route::get('/deleteImg3/{id}', 'profileController@deleteImg3');
Route::get('/deleteImg4/{id}', 'profileController@deleteImg4');

Route::put('/postAd/update/{id}/{pid}', 'profileController@updateProduct');

Route::get('/profile', 'profileController@index');

Route::get('/', 'HomeController@index')->name('index');

Route::get('/test', function () {
    return view('test');
});

Route::get('/test2', function () {
    return view('test2');
});

Route::get('/notifyDM/{oid}', 'HomeController@notifyDM')->name('notifyDM');
Route::get('/requestSeller/{uid}/{pid}', 'NotificationController@requestSeller');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/postAd', function () {
    return view('postAd');
});

Route::get('/admin', function() {
    return view('admin');
});

Route::post('/admin/submit', 'AdminController@submit');

Route::post('/postAd/submit', 'PostAdController@submit');

Route::get('/categories/{id}', 'ShowProductsController@index');
Route::get('/advertisements/search/{name}', 'ShowProductsController@showSearchedProducts');

Route::get('/advertisements/{id}', 'ShowAdController@index');
Route::post('/showAd/sendMessage/{id}', 'ShowAdController@sendMessage');

Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');

Route::get('/conversations', function() {
    return view('conversation');
});

Route::get('/user/orderStatus', 'TransactionController@orderStatus');
Route::get('/user/viewProfile/{id}', 'profileController@viewProfile');

Route::get('/userDashboard', 'profileController@index');
Route::get('/editProfile', function() {
    return view('editProfile');
});
Route::post('/editProfile/submit', 'profileController@edit');
Route::get('/userDashboard/activities', 'profileController@activity');
Route::post('/activities/updateqty/{id}/{pid}', 'ActivityController@updateQuantity');

Route::get('/autocomplete', 'AutocompleteController@index');
Route::post('/autocomplete/fetch', 'AutocompleteController@fetch')->name('autocomplete.fetch');

Route::get('/dm/register', 'DMRegisterController@index')->name('dm.register');
Route::post('/dm/register/submit', 'DMRegisterController@register');

// Route::get('/dm/login', 'DMLoginController@index');
// Route::post('/dm/loginSubmit', 'DMLoginController@checkLogin');

Route::get('/dm/login', 'Auth\DMLoginController@showLoginForm')->name('dm.login');
Route::post('/dm/login', 'Auth\DMLoginController@login')->name('dm.login.post');
Route::post('/dm/logout', 'Auth\DMLoginController@logout')->name('dm.logout');
Route::get('showRoute/{oid}', 'DeliveryManController@showRoute');

Route::group(['middleware'=>'dm'], function() {
    Route::get('/dm/home', 'dm\HomeController@index');
});

Route::get('/dm/home', function() {
    return view('dm.home');
});

Route::get('/dm/changeStatus', 'DeliveryManController@changeStatus');
Route::get('/dm/viewProfile/{id}', 'DeliveryManController@viewProfile');

Route::get('/dm/markAsRead', function () {
    auth('dm')->user()->unreadNotifications->markAsRead();
});

Route::get('/markAsRead', function () {
    auth()->user()->unreadNotifications->markAsRead();
});

Route::get('/transactionDetails/{oid}', 'TransactionController@index');
Route::get('/acceptOrder/{oid}', 'NotificationController@acceptOrder');
Route::get('/dm/orderStatus', 'DeliveryManController@orderStatus');

Route::get('/receiveProduct', 'NotificationController@receiveProduct');
Route::get('/paySeller', 'NotificationController@paySeller');
Route::get('/deliverProduct', 'NotificationController@deliverProduct');
Route::get('/receivePayment', 'NotificationController@receivePayment');
