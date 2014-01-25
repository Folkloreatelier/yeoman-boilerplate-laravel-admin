<?php

View::creator(array('layouts.main'), function($view)
{

	$headContainer = Asset::container('head');
	$headContainer->add('modernizr','js/components/modernizr/modernizr.js');
	$headContainer->add('styles','css/main.css');

	//Footer Assets
	$footerContainer = Asset::container('footer');
	$footerContainer->add('utils','js/utils.js');
	if(App::environment() == 'local') {
		$footerContainer->add('main','js/components/requirejs/require.js',array(),array('data-main'=>'/js/main'));
	} else {
		$footerContainer->add('main','js/main.build.js');
	}

	$view->with(array(
		'title' => trans('meta.title'),
		'description' => trans('meta.description'),
		'route' => Route::current() ? Route::current()->getName():'errors.404'
	));

});

View::creator(array('admin.layout'), function($view)
{

	$headContainer = Asset::container('head');
	$headContainer->add('modernizr','js/components/modernizr/modernizr.js');
	$headContainer->add('styles','css/admin/main.css');

	//Footer Assets
	$footerContainer = Asset::container('footer');
	if(Auth::check())
	{
		$footerContainer->add('utils','js/admin/utils.js');
		if(App::environment() == 'local') {
			$footerContainer->add('admin','js/components/requirejs/require.js',array(),array('data-main'=>'/js/admin/main'));
		} else {
			$footerContainer->add('admin','js/admin/main.build.js');
		}
	}

	$view->with(array(
		'title' => 'Administration',
		'route' => Route::current() ? Route::current()->getName():'errors.404'
	));

});