<?php

class Page extends ImageableEloquent {

	protected $table = 'pages';

	protected $fillable = array(
		'parent_id',

		'title_fr',
		'slug_fr',
		'body_fr',

		'title_en',
		'slug_en',
		'body_en'
	);

	/*
	 *
	 * Relationships
	 *
	 */
	public function parent()
	{
		return $this->belongsTo('Page','parent_id');
	}
	public function children()
	{
		return $this->hasMany('Page','parent_id');
	}
	public function blocks()
	{
		return $this->hasMany('PageBlock','page_id')->orderBy('order','asc');
	}

	/*
	 *
	 * Sync methods
	 *
	 */
	public function syncBlocks($blocks = array())
	{
		//Save blocks
		$blocks = array();
		if(is_array($blocks) && sizeof($blocks)) {
			$ids = array();
			foreach($blocks as $block)
			{
				$blockModel = (int)$block['id'] > 0 ? PageBlock::find($block['id']):new PageBlock();
				if(!$blockModel)
				{
					continue;
				}
				$blockModel->fill($block);
				$blockModel->order = sizeof($ids);
				$blockModel->save();
				$this->blocks()->save($blockModel);
				$ids[] = $blockModel->id;

				//Sync block photos
				$blockModel->syncPhotos(isset($block['photos']) ? $block['photos']:array());
			}
			$this->blocks()
					->whereNotIn('id',$ids)
					->delete();
		} else {
			foreach($this->blocks as $block) {
				$block->delete();
			}
		}
	}

	/*
	 *
	 * Accessors and Mutators
	 *
	 */
	protected function setTitleFrAttribute($value) {
    	$this->attributes['title_fr'] = $value;
    	$this->attributes['slug_fr'] = Str::slug($value);
	}
	protected function setTitleEnAttribute($value) {
    	$this->attributes['title_en'] = $value;
    	$this->attributes['slug_en'] = Str::slug($value);
	}

}

Page::deleting(function($item)
{
	if($item->photos) {
		foreach($item->photos as $item) {
			$item->delete();
		}
	}
	return true;
});