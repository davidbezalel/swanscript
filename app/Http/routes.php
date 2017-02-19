<?php
/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * @copyright: Jan 2017
 */

/**
 * web view
 */

/* error */
Route::get('oops/permission', function () {
    return view('error.permission');
});
Route::get('oops/404', function () {
    return view('error.404');
});

/* admin panel */

Route::get('dashboard', 'ScripterController@index');
Route::get('user/register', 'UserController@register');
Route::get('user/login', 'UserController@login');

Route::get('user/profile/{id}', 'UserController@profile');
Route::get('users', 'UserController@index');

/**
 * API
 * process data and send to the web view
 */

/* admin panel */
Route::get('user/logout', 'UserController@logout');
Route::post('user/register', 'UserController@register');
Route::post('user/login', 'UserController@login');

Route::get('api/user/profile/{id}', 'UserController@api_profile');
Route::post('api/user/profile/update/{id}', 'UserController@profile');
Route::post('api/user/profile/update-image/{id}', 'UserController@update_image');

Route::post('users', 'UserController@index');

