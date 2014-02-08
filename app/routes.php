<?php

/*
 *
 * Normal routes
 *
 */
Route::get('/', array(
	'before' => 'locale:fr',
	'as' => 'home',
	'uses' => 'HomeController@index'
));

/*
 *
 * Admin routes
 *
 */
Route::controller('login', 'AdminLoginController');
Route::group(array(
	'prefix' => 'admin',
	'before' => array('auth','locale:en'),
), function() {

	Route::get('/', array(
		'as' => 'admin',
		'uses' => 'AdminController@index'
	));
	
	Route::controller('upload', 'AdminUploadController');
	Route::resource('pages', 'AdminPagesController');
	Route::resource('users', 'AdminUsersController');

});


/*
 *
 * 404 errors
 *
 */
App::missing(function($exception)
{
	$view = View::make('layouts.main')
    			->nest('content','errors.404');
	$response = Response::make($view,404);
	return $response;
});