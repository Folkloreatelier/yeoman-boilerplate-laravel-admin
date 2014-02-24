<?php

class AdminUploadController extends AdminBaseController {

	public $layout = null;

	public function postFile()
	{

		if(Input::hasFile('file')) {
			return array(
				'success' => true,
				'response' => $_FILES['file']
			);
		}

		return array(
			'success' => false
		);
	}

	public function postPhoto()
	{

		if(Input::hasFile('file')) {
			$photo = Photo::upload(Input::file('file'));
			return array(
				'success' => true,
				'response' => $photo->toArray()
			);
		}

		return array(
			'success' => false
		);
	}

}