<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/
Route::controller(Controller::detect());

Route::get('/', function()
{
	echo HTML::link('wall/101', 'Wall');
	echo "<br />";
	echo HTML::link('user/101', 'User');
	echo "<br />";
	echo HTML::link('profile/101', 'Profile');
	echo "<br />";
	echo HTML::link('following/101', 'Following');
	echo "<br />";
	echo HTML::link('followers/101', 'Followers');
	echo "<br />";
	echo HTML::link('router_relationships', 'Relationships');


	echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
});

/*
Route::get('/', function()
{
	foreach (User::with(array('followers', 'following'))->get() as $user)
	{
		// echo $user->following->username;
		// echo $user->followers->username;
		echo "<pre>";
		var_dump($user);
		echo "</pre>";
	}
});
*/

Route::get('/router_relationships', function()
{
	echo "<table><tr><td>";
	$users = User::with(array('followers', 'following'))->get();

	foreach ($users as $user)
	{
		foreach ($user->followers as $follower_id)
		{
			echo 'followers: ' . $follower_id->username . '<br />';
		}
	}

	echo "</td><td>";
	
	foreach ($users as $user)
	{
		foreach ($user->following as $followed_id)
		{
			echo 'following: ' . $followed_id->username . '<br />';
		}
	}

	echo "</td></tr></table>";

	echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
});

// Route::get('/(:num)', function($id)
// {
// 	// $users = User::with(array('followers' => function($query) use ($id)
// 	// {
// 	// 	$query->where('follower_id', '=', $id);
// 	// }, 'following' => function($query) use ($id)
// 	// {
// 	// 	$query->where('follower_id', '=', $id);
// 	// }))->get();

// 	$users = User::with(array('following' => function($query) use ($id)
// 	{
// 		$query->where('follower_id', '=', $id);
// 	}))->get();

// 	echo User::find($id)->username . '<br />';

// 	echo "<hr />";

// 	// foreach ($users as $user)
// 	// {
// 	// 	foreach ($user->followers as $follower_id)
// 	// 	{
// 	// 		echo '
// 	// 		follower_id: ' . $follower_id->username . '<br />';
// 	// 	}
// 	// }

// 	echo "<hr />";
	
// 	$following[] = $id;
// 	foreach ($users as $user)
// 	{
// 		foreach ($user->following as $followed_id)
// 		{
// 			echo 'followed_id: ' . $followed_id->username . '<br />';
// 			$following[] = $followed_id->id;
// 		}

// 		// echo "<pre>";
// 		// print_r($user->following);
// 		// echo "</pre>";
// 	}
// 	echo "<hr />";

// 	/*
// 	foreach ($users as $user) {
// 		foreach ($user->messages as $message) {
// 			echo $message->message . '<br />';
// 		}
// 	}	
// 	*/

// 	$messages = Message::where_in('user_id', $following)->order_by('created_at', 'desc')->get();

// 	foreach ($messages as $message) {
// 		echo $message->message.'<br />';
// 	}

// 	echo "<hr />";

// });

Route::get('/user/(:num)', function($id)
{
	//$user = User::with('following')->find($id);
	
	$user = User::with('followers', '$following')->find($id);

	echo "<p>Me: "; echo $user->username; echo "</p>";

	echo "<hr /><h1>Followers</h1>";

	foreach ($user->following as $followed_id)
	{
		echo '<p>Follower: ' . $followed_id->username . '</p>';
	}

	echo "<hr /><h1>Following</h1>";

	//$user = User::with('followers')->find($id);

	foreach ($user->followers as $follower_id)
	{
		echo '<p>Leader: ' . $follower_id->username . '</p>';
	}

	echo "<hr /><h1>Messages</h1>";
	//all following messages
	$followers[] = $id;
	foreach ($user->followers as $follower_id) {
		$followers[] = $follower_id->id;
	}

	foreach (Message::where_in('user_id', $followers)->order_by('created_at', 'desc')->get() as $message) {
		echo "<p>";
		echo $message->message . ' ' . $message->created_at;
		echo "</p>";
	}

	echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
});

Route::get('/wall/(:num)', function($id)
{
	$user = User::find($id);
	
	echo "<p>Me: "; echo $user->username; echo "</p>";

	echo "<hr /><h1>Following</h1>";
	echo "Total: ". count($user->followers);

	echo "<hr /><h1>Followers</h1>";
	echo "Total: ". count($user->following);
	
	echo "<hr /><h1>Messages</h1>";
	//all own and following messages
	$followers[] = $id;
	foreach ($user->followers as $follower_id) {
		$followers[] = $follower_id->id;
	}

	foreach (Message::where_in('user_id', $followers)->order_by('created_at', 'desc')->get() as $message) {
		echo "<p>";
		echo $message->message . ' ' . $message->created_at;
		echo "</p>";
	}

	echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
});

Route::get('/profile/(:num)', function($id)
{
	$user = User::find($id);

	echo Gravitas\API::image('me@phills.me.uk', NULL, 'Phill Sparks');

	echo "<p>Me: "; echo $user->username; echo "</p>";

	echo "<hr /><h1>My Messages</h1>";

	foreach ($user->messages as $message)
	{
		echo '<p>Message: ' . $message->message . '</p>';
	}

	echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
});

Route::get('/following/(:num)', function($id)
{
	$user = User::with('followers')->find($id);

	echo "<p>Me: "; echo $user->username; echo "</p>";

	echo "<hr /><h1>Following</h1>";

	foreach ($user->followers as $follower_id)
	{
		echo '<p>Followed: ' . $follower_id->username . '</p>';
	}

	echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
});

Route::get('/followers/(:num)', function($id)
{
	$user = User::with('following')->find($id);

	echo "<p>Me: "; echo $user->username; echo "</p>";

	echo "<hr /><h1>Followers</h1>";

	foreach ($user->following as $followed_id)
	{
		echo '<p>Follower: ' . $followed_id->username . '</p>';
	}

	echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
});

Route::get('/data', function()
{
	
	//add users
	for ($i=1; $i < 101; $i++) { 
		$user = new User;

		$user->username = 'username'.$i;

		$user->save();
	}
	
	
	//add messages
	for ($i=1; $i < 101; $i++) { 
		$message = new Message;

		$message->user_id = $i;
		$message->message = 'Message_'.$i;

		$message->save();
	}
	

	
	//add relationships
	for ($i=1; $i < 101; $i++) {
		$relationships = new Relationship;
		$relationships->follower_id = $i++;
		$relationships->followed_id = $i++;
		$relationships->save();
	}
	
	
	/*
	$following = Relationship::where('follower_id', '=', 1)->get();

	$fs = '';
	foreach ($following as $f) {
		$fs .= $f->followed_id. ',';
	}
	$fs = rtrim($fs, ',');

	$users = User::where_in('id', explode(',', $fs))->get();
	*/
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});