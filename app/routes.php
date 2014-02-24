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
	'before' => array('auth','locale:fr'),
), function() {

	Route::get('/', array(
		'as' => 'admin',
		'uses' => 'AdminController@index'
	));
	
	//Upload
	Route::controller('upload', 'AdminUploadController');

	//Resources
	Route::resource('pages', 'AdminPagesController',array(
		'except' => array('show')
	));
	Route::resource('users', 'AdminUsersController',array(
		'except' => array('show')
	));

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