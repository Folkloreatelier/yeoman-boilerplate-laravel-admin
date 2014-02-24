<?php

class Page extends ImageableEloquent {

	protected $table = 'pages';

	protected $fillable = array(
		'parent_id',
		'title_fr',
		'title_en',
		'slug_fr',
		'slug_en',
		'body_fr',
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