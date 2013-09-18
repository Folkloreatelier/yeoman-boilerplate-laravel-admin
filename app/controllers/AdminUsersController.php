<?php

class AdminUsersController extends \BaseController {

	protected $layout = 'layouts.admin';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = User::orderBy('id','asc')->get();

		return $this->layout->nest('content','admin.users.index',array(
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
		return $this->layout->nest('content','admin.users.form');
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
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item = User::find($id);

		return $this->layout->nest('content','admin.users.form',array(
			'item' => $item
		));
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

		$validator = Validator::make($input,array(
			'email' => array('required','email'),
			'password' => array('confirmed')
		));
		if($validator->fails()) {
			$redirect = $isNew ? Redirect::route('admin.users.create'):Redirect::route('admin.users.edit',array($id));
		    return $redirect->withErrors($validator);
		}

		if($id) {
			$item = User::find($id);
		} else {
			$item = new User();
		}

		$item->fill($input);
		$item->save();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}