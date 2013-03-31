<?php

class User extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'users';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = true;

	/**
	 * Establish the relationship between a user and profile.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_One
	 */
	public function profile()
	{
		return $this->has_one('Profile');
	}

	/**
	 * Establish the relationship between a user and messages.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many
	 */
	public function messages()
	{
		return $this->has_many('Message');
	}

	public function followers()
	{
		return $this->has_many_and_belongs_to('User', 'relationships', 'follower_id', 'followed_id');
	}

	public function following()
	{
		return $this->has_many_and_belongs_to('User', 'relationships', 'followed_id', 'follower_id');
	}
	
}