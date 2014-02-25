<?php

class ImageableEloquent extends Eloquent {

	protected $imageable_order = true;

	/*
	 *
	 * Relationships
	 *
	 */
	public function photos()
	{
		$query = $this->morphMany('Photo','imageable');

		if($this->imageable_order)
		{
			$query->orderBy('imageable_order','asc');
		}

		return $query;
	}

	/*
	 *
	 * Sync methods
	 *
	 */
	public function syncPhotos($photos = array()) {

		if(is_array($photos) && sizeof($photos))
		{
			$ids = array();
			$photoOrder = 0;
			foreach($photos as $photo)
			{
				$photo = Photo::find($photo);

				if(!$photo)
				{
					continue;
				}

				//Update order
				if($this->imageable_order && (int)$photo->imageable_order != $photoOrder)
				{
					$photo->fill(array(
						'imageable_order' => $photoOrder
					));
					$photo->save();
				}

				$this->photos()->save($photo);

				$ids[] = $photo->id;
				$photoOrder++;
			}

			//Delete other photos
			$photosToDelete = $this->photos()
									->whereNotIn('id',$ids)
									->get();
			foreach($photosToDelete as $photo)
			{
				$photo->delete();
			}
		}
		else
		{
			foreach($this->photos as $photo)
			{
				$photo->delete();
			}
		}

	}

}