<?php

class AdminBaseController extends BaseController {

	protected $layout = 'admin.layout';
	protected $language;

	public function __construct()
	{
		$this->language = Config::get('app.locale');
	}

}