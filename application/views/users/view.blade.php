<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users')}}">Users</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing User</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Username:</strong>
	{{$user->username}}
</p>

<p><a href="{{URL::to('users/edit/'.$user->id)}}" class="btn">Edit</a> <a href="{{URL::to('users/delete/'.$user->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
<h2>Messages</h2>

@if(count($user->messages) == 0)
	<p>No messages.</p>
@else
	<table>
		<thead>
			<th>Message</th>
			<th>Created At</th>
			<th>Updated At</th>
			<th></th>
		</thead>

		<tbody>
			@foreach($user->messages as $message)
				<tr>
					<td>{{$message->message}}</td>
					<td>{{$message->created_at}}</td>
					<td>{{$message->updated_at}}</td>
					<td><a href="{{URL::to('messages/view/'.$message->id)}}">View</a> <a href="{{URL::to('messages/edit/'.$message->id)}}">Edit</a> <a href="{{URL::to('messages/delete/'.$message->id)}}">Delete</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('messages/create/'.$user->id)}}">Create new message</a></p>
