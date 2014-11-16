<?php

use Folklore\EloquentPicturable\Models\Picture;

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
			$photo = Picture::upload(Input::file('file'));
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
