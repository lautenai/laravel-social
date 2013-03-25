<?php

class Relations_Controller extends Base_Controller {

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
	 * View all of the relations.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$relations = Relation::all();

		$this->layout->title   = 'Relations';
		$this->layout->content = View::make('relations.index')->with('relations', $relations);
	}

	/**
	 * Show the form to create a new relation.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$this->layout->title   = 'New Relation';
		$this->layout->content = View::make('relations.create');
	}

	/**
	 * Create a new relation.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'leader' => array('required', 'integer'),
			'follower' => array('required', 'integer'),
		));

		if($validation->valid())
		{
			$relation = new Relation;

			$relation->leader = Input::get('leader');
			$relation->follower = Input::get('follower');

			$relation->save();

			Session::flash('message', 'Added relation #'.$relation->id);

			return Redirect::to('relations');
		}

		else
		{
			return Redirect::to('relations/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific relation.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$relation = Relation::find($id);

		if(is_null($relation))
		{
			return Redirect::to('relations');
		}

		$this->layout->title   = 'Viewing Relation #'.$id;
		$this->layout->content = View::make('relations.view')->with('relation', $relation);
	}

	/**
	 * Show the form to edit a specific relation.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$relation = Relation::find($id);

		if(is_null($relation))
		{
			return Redirect::to('relations');
		}

		$this->layout->title   = 'Editing Relation';
		$this->layout->content = View::make('relations.edit')->with('relation', $relation);
	}

	/**
	 * Edit a specific relation.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'leader' => array('required', 'integer'),
			'follower' => array('required', 'integer'),
		));

		if($validation->valid())
		{
			$relation = Relation::find($id);

			if(is_null($relation))
			{
				return Redirect::to('relations');
			}

			$relation->leader = Input::get('leader');
			$relation->follower = Input::get('follower');

			$relation->save();

			Session::flash('message', 'Updated relation #'.$relation->id);

			return Redirect::to('relations');
		}

		else
		{
			return Redirect::to('relations/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific relation.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$relation = Relation::find($id);

		if( ! is_null($relation))
		{
			$relation->delete();

			Session::flash('message', 'Deleted relation #'.$relation->id);
		}

		return Redirect::to('relations');
	}


	public function get_leaders($id)
	{
		$users = User::with(array('followers' => function($query) use ($id)
		{
			$query->where('leader', '=', $id);
		}, 'leaders' => function($query) use ($id)
		{
			$query->where('leader', '=', $id);
		}))->get();


		foreach ($users as $user)
		{
			foreach ($user->leaders as $leader)
			{
				echo 'leader: ' . $leader->username . '<br />';
			}
		}

		echo "<hr />";
		
		foreach ($users as $user)
		{
			foreach ($user->followers as $follower)
			{
				echo 'follower: ' . $follower->username . '<br />';
			}
		}

		die();
	}

	public function get_followers($id)
	{
		$users = User::with(array('leaders' => function($query) use ($id)
		{
			$query->where('leader', '=', $id);
		}, 'followers' => function($query) use ($id)
		{
			$query->where('leader', '=', $id);
		}))->get();


		foreach ($users as $user)
		{
			foreach ($user->leaders as $leader)
			{
				echo 'leader: ' . $leader->username . '<br />';
			}
		}

		echo "<hr />";
		
		foreach ($users as $user)
		{
			foreach ($user->followers as $follower)
			{
				echo 'follower: ' . $follower->username . '<br />';
			}
		}

		die();
	}
}