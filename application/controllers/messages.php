<?php

class Messages_Controller extends Base_Controller {

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
	 * View all of the messages.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$messages = Message::with(array('user'))->get();

		$this->layout->title   = 'Messages';
		$this->layout->content = View::make('messages.index')->with('messages', $messages);
	}

	/**
	 * Show the form to create a new message.
	 *
	 * @return void
	 */
	public function get_create($user_id = null)
	{
		$this->layout->title   = 'New Message';
		$this->layout->content = View::make('messages.create', array(
									'user_id' => $user_id,
								));
	}

	/**
	 * Create a new message.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'user_id' => array('required', 'integer'),
			'message' => array('required'),
		));

		if($validation->valid())
		{
			$message = new Message;

			$message->user_id = Input::get('user_id');
			$message->message = Input::get('message');

			$message->save();

			Session::flash('message', 'Added message #'.$message->id);

			return Redirect::to('messages');
		}

		else
		{
			return Redirect::to('messages/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific message.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$message = Message::with(array('user'))->find($id);

		if(is_null($message))
		{
			return Redirect::to('messages');
		}

		$this->layout->title   = 'Viewing Message #'.$id;
		$this->layout->content = View::make('messages.view')->with('message', $message);
	}

	/**
	 * Show the form to edit a specific message.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$message = Message::find($id);

		if(is_null($message))
		{
			return Redirect::to('messages');
		}

		$this->layout->title   = 'Editing Message';
		$this->layout->content = View::make('messages.edit')->with('message', $message);
	}

	/**
	 * Edit a specific message.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'user_id' => array('required', 'integer'),
			'message' => array('required'),
		));

		if($validation->valid())
		{
			$message = Message::find($id);

			if(is_null($message))
			{
				return Redirect::to('messages');
			}

			$message->user_id = Input::get('user_id');
			$message->message = Input::get('message');

			$message->save();

			Session::flash('message', 'Updated message #'.$message->id);

			return Redirect::to('messages');
		}

		else
		{
			return Redirect::to('messages/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific message.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$message = Message::find($id);

		if( ! is_null($message))
		{
			$message->delete();

			Session::flash('message', 'Deleted message #'.$message->id);
		}

		return Redirect::to('messages');
	}
}