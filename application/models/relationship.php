<?php

class Relationship extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'relationships';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = true;

	/**
	 * Check reverse relationship between a user and friend.
	 *
	 * @return 
	 */
	public static function exists($follower_id, $followed_id)
	{
    	$inverse = Relationship::where('followed_id', '=', $followed_id)->where('follower_id', '=', $follower_id)->first();

    	$reverse = Relationship::where('follower_id', '=', $followed_id)->where('followed_id', '=', $follower_id)->first();

    	if ($inverse OR $reverse) {
    		return true;
    	}
	}
	
}