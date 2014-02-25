<?php

class AdminPagesController extends AdminBaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Page::with('parent')
						->orderBy('id','asc')
						->get();

		return $this->layout->nest('content','admin.pages.index',array(
			'items' => $items
		));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->layout->nest('content','admin.pages.form',array(
			'parentPagesOptions' => $this->getParentPagesOptions()
		));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item = Page::with('blocks','blocks.photos')
						->find($id);
		if(!$item) return App::abort(404);

		return $this->layout->nest('content','admin.pages.form',array(
			'item' => $item,
			'parentPagesOptions' => $this->getParentPagesOptions()
		));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return $this->update(null);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$input = Input::all();

		$isNew = true;
		if($id) {
			$item = Page::find($id);
			$isNew = false;
			if(!$item) return App::abort(404);
		} else {
			$item = new Page();
		}

		//Validate
		$rules = array(
			'parent_id' => array('exists:pages,id'),
			'title_'.$this->language => array('required')
		);
		$messages = array(
			'title_'.$this->language.'.required' => 'Vous devez entrer un titre'
		);
		$validator = Validator::make($input,$rules,$messages);
		if($validator->fails()) {
			$redirect = $isNew ? Redirect::route('admin.pages.create'):Redirect::route('admin.pages.edit',array($id));
		    return $redirect->withInput()
		    				->withErrors($validator);
		}

		$item->fill($input);
		$item->save();

		//Save blocks
		$item->syncBlocks(Input::get('blocks',array()));

		//Sync page photos
		$item->syncPhotos(Input::get('photos',array()));

		return Redirect::route('admin.pages.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = Post::find($id);
		if(!$item) return App::abort(404);

		$item->delete();

		return Redirect::route('admin.news.index');
	}



	protected function getParentPagesOptions()
	{
		$parentPagesOptions = array(''=>'Sélectionnez une page parente...');
		$pages = Page::all();
		foreach($pages as $page) {
			$parentPagesOptions[$page->id] = $page->{'title_'.$this->language};
		}

		return $parentPagesOptions;
	}

}