<?php

class PageBlock extends ImageableEloquent {

	protected $table = 'pages_blocks';

	protected $fillable = array(
		'type',
		'area',
		'order',
		'data'
	);

	public static $types = array(
		'text' => 'admin.pages_block_type_text',
		'photos' => 'admin.pages_block_type_photos'
	);

	/*
	 *
	 * Relationships
	 *
	 */
	public function page()
	{
		return $this->belongsTo('Page','page_id');
	}

	/*
	 *
	 * Accessors and Mutators
	 *
	 */
	protected function setDataAttribute($value) {
    	$this->attributes['data'] = is_array($value) ? json_encode($value):$value;
	}
	protected function getDataAttribute($value) {
    	return is_string($value) && !empty($value) ? json_decode($value,false):$value;
	}

}

PageBlock::deleting(function($item)
{
	if($item->photos) {
		foreach($item->photos as $item) {
			$item->delete();
		}
	}
	return true;
});
