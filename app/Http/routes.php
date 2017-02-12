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

Route::get('author', 'ScripterController@index');
Route::get('author/register', 'UserController@register');
Route::get('author/login', 'UserController@login');
Route::get('author/profile', 'UserController@profile');

/**
 * API
 * process data and send to the web view
 */

/* admin panel */
Route::get('author/logout', 'UserController@logout');
Route::post('author/register', 'UserController@register');
Route::post('author/login', 'UserController@login');
Route::get('api/author/profile/{id}', 'UserController@api_profile');
Route::post('api/author/profile/update', 'UserController@profile');
Route::post('api/author/profile/update-image', 'UserController@update_image');

