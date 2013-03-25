<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users/view/'.$message->user->id)}}">User</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('messages')}}">Messages</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Message</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>User id:</strong>
	{{$message->user_id}}
</p>
<p>
	<strong>Message:</strong>
	{{$message->message}}
</p>

<p><a href="{{URL::to('messages/edit/'.$message->id)}}" class="btn">Edit</a> <a href="{{URL::to('messages/delete/'.$message->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
