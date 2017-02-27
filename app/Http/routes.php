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
    return view('errors.permission');
});

/* admin panel */

Route::get('dashboard', 'ScripterController@index');
Route::get('users', 'UserController@index');
Route::get('user/register', 'UserController@register');
Route::get('user/login', 'UserController@login');
Route::get('user/roles', 'UserController@role_index');

Route::get('user/profile/{id}', 'UserController@profile');

/**
 * API
 * process data and send to the web view
 */

/* admin panel */
Route::post('users', 'UserController@index');
Route::get('user/logout', 'UserController@logout');
Route::post('user/register', 'UserController@register');
Route::post('user/login', 'UserController@login');
Route::post('user/delete', 'UserController@delete');
Route::post('user/roles', 'UserController@role_index');
Route::post('user/role/add', 'UserController@role_add');
Route::post('user/role/delete', 'UserController@role_delete');

Route::get('api/user/profile/{id}', 'UserController@api_profile');
Route::post('api/user/profile/update/{id}', 'UserController@profile');
Route::post('api/user/profile/update-image/{id}', 'UserController@update_image');


