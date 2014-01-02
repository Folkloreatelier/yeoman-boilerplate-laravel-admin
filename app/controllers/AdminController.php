<?php

class AdminController extends BaseController {

	public $layout = 'admin.layout';

	public function index()
	{

		return $this->layout->nest('content','admin.index');
	}

}