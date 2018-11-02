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
Route::get( '/', 'Web\AppController@getApp' );

Route::get( '/logout', 'Web\AppController@getLogout' )
    ->name('logout');

Route::get('/privacy-policy', function () {
    return view('privacy');
});

Route::get('/login', 'Web\AppController@getLogin' )
    ->name('login')
    ->middleware('guest');

Route::get( '/login/{social}', 'Web\AuthenticationController@getSocialRedirect' )
    ->middleware('guest');

Route::get( '/login/{social}/callback', 'Web\AuthenticationController@getSocialCallback' )
    ->middleware('guest');