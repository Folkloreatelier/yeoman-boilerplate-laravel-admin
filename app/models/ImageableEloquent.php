<?php

class ImageableEloquent extends Eloquent {

	protected $photosOrderable = true;

	public function photos()
	{
		$query = $this->morphMany('Photo','imageable');

		if($this->photosOrderable)
		{
			$query->orderBy('imageable_order','asc');
		}

		return $query;
	}


	public function savePhotos($photos = array()) {

		if(!empty($photos)) {
			$photoIds = array();
			$photoOrder = 0;
			foreach($photos as $photo) {
				$photo = Photo::find($photo);
				if($this->photosOrderable && (int)$photo->imageable_order != $photoOrder) {
					$photo->fill(array(
						'imageable_order' => $photoOrder
					));
					$photo->save();
				}
				$this->photos()->save($photo);
				$photoIds[] = $photo->id;
				$photoOrder++;
			}
			$photosToDelete = $this->photos()
									->whereNotIn('id',$photoIds)
									->get();
			foreach($photosToDelete as $photo) {
				$photo->delete();
			}
		} else {
			foreach($this->photos as $photo) {
				$photo->delete();
			}
		}

	}

}