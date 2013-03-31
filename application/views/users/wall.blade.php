<?php
echo "<p>Username: "; echo $user->username; echo "</p>";
echo "<p>Name: "; echo $user->profile->name; echo "</p>";

echo Gravitas\API::image($user->profile->email, NULL, $user->profile->name);

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