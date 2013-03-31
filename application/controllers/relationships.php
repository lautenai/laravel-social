<?php

class Relationships_Controller extends Base_Controller {

	/**
	 * The layout being used by the controller.
	 *
	 * @var string
	 */
	public $layout = 'layouts.scaffold';

	/**
	 * Indicates if the controller uses RESTful routing.
	 *
	 * @var bool
	 */
	public $restful = true;

	/**
	 * View all of the relationships.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$relationships = Relationship::all();

		$this->layout->title   = 'Relationships';
		$this->layout->content = View::make('relationships.index')->with('relationships', $relationships);
	}

	/**
	 * Show the form to create a new relationships.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$this->layout->title   = 'New Relationship';
		$this->layout->content = View::make('relationships.create');
	}

	/**
	 * Create a new relationships.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'follower_id' => array('required', 'integer'),
			'followed_id' => array('required', 'integer'),
		));

		if($validation->valid())
		{
			$relationships = new Relationship;

			$relationships->follower_id = Input::get('follower_id');
			$relationships->followed_id = Input::get('followed_id');

			$relationships->save();

			Session::flash('message', 'Added relationships #'.$relationships->id);

			return Redirect::to('relationships');
		}

		else
		{
			return Redirect::to('relationships/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific relationships.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$relationships = Relationship::find($id);

		if(is_null($relationships))
		{
			return Redirect::to('relationships');
		}

		$this->layout->title   = 'Viewing Relationship #'.$id;
		$this->layout->content = View::make('relationships.view')->with('relationships', $relationships);
	}

	/**
	 * Show the form to edit a specific relationships.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$relationships = Relationship::find($id);

		if(is_null($relationships))
		{
			return Redirect::to('relationships');
		}

		$this->layout->title   = 'Editing Relationship';
		$this->layout->content = View::make('relationships.edit')->with('relationships', $relationships);
	}

	/**
	 * Edit a specific relationships.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'follower_id' => array('required', 'integer'),
			'followed_id' => array('required', 'integer'),
		));

		if($validation->valid())
		{
			$relationships = Relationship::find($id);

			if(is_null($relationships))
			{
				return Redirect::to('relationships');
			}

			$relationships->follower_id = Input::get('follower_id');
			$relationships->followed_id = Input::get('followed_id');

			$relationships->save();

			Session::flash('message', 'Updated relationships #'.$relationships->id);

			return Redirect::to('relationships');
		}

		else
		{
			return Redirect::to('relationships/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific relationships.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$relationships = Relationship::find($id);

		if( ! is_null($relationships))
		{
			$relationships->delete();

			Session::flash('message', 'Deleted relationships #'.$relationships->id);
		}

		return Redirect::to('relationships');
	}


	public function get_followers($id)
	{
		$users = User::with(array('following' => function($query) use ($id)
		{
			$query->where('follower_id', '=', $id);
		}, 'followers' => function($query) use ($id)
		{
			$query->where('follower_id', '=', $id);
		}))->get();


		foreach ($users as $user)
		{
			foreach ($user->followers as $follower_id)
			{
				echo 'follower_id: ' . $follower_id->username . '<br />';
			}
		}

		echo "<hr />";
		
		foreach ($users as $user)
		{
			foreach ($user->following as $followed_id)
			{
				echo 'followed_id: ' . $followed_id->username . '<br />';
			}
		}

		die();
	}

	public function get_following($id)
	{
		$users = User::with(array('followers' => function($query) use ($id)
		{
			$query->where('follower_id', '=', $id);
		}, 'following' => function($query) use ($id)
		{
			$query->where('follower_id', '=', $id);
		}))->get();


		foreach ($users as $user)
		{
			foreach ($user->followers as $follower_id)
			{
				echo 'follower_id: ' . $follower_id->username . '<br />';
			}
		}

		echo "<hr />";
		
		foreach ($users as $user)
		{
			foreach ($user->following as $followed_id)
			{
				echo 'followed_id: ' . $followed_id->username . '<br />';
			}
		}

		die();
	}
}