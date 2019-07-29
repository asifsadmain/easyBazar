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

Route::get('/', 'IndexPageController@index')->name('index');

Route::get('/test', function () {
    return view('test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/editAd/{id}', 'profileController@editAd');

Route::get('/postAd', function () {
    return view('postAd');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::post('/admin/submit', 'AdminController@submit');

Route::post('/postAd/submit', 'PostAdController@submit');
Route::post('/postAd/update/{id, pid}', 'PostAdController@update');

Route::get('/categories/{id}', 'ShowProductsController@index');

Route::get('/advertisements/{id}', 'ShowAdController@index');
Route::post('/showAd/sendMessage/{id}', 'ShowAdController@sendMessage');

Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');

Route::get('/conversations', function () {
    return view('conversation');
});

Route::get('/profile', 'profileController@index');
