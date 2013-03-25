@if(count($messages) == 0)
	<p>No messages.</p>
@else
	<table>
		<thead>
			<tr>
				<th>User Id</th>
				<th>Message</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($messages as $message)
				<tr>
					<td><a href="{{URL::to('users/view/'.$message->id)}}">User #{{$message->user_id}}</a></td>
					<td>{{$message->message}}</td>
					<td>
						<a href="{{URL::to('messages/view/'.$message->id)}}" class="btn">View</a>
						<a href="{{URL::to('messages/edit/'.$message->id)}}" class="btn">Edit</a>
						<a href="{{URL::to('messages/delete/'.$message->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('messages/create')}}">Create new Message</a></p>