<?php

class AdminController extends AdminBaseController {

	public function index()
	{

		return $this->layout->nest('content','admin.index');
	}

}