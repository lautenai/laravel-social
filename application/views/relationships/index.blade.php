@if(count($relationships) == 0)
	<p>No relationships.</p>
@else
	<table>
		<thead>
			<tr>
				<th>Leader</th>
				<th>Follower</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach($relationships as $relationships)
				<tr>
					<td>{{$relationships->follower_id}}</td>
					<td>{{$relationships->followed_id}}</td>
					<td>
						<a href="{{URL::to('relationships/view/'.$relationships->id)}}" class="btn">View</a>
						<a href="{{URL::to('relationships/edit/'.$relationships->id)}}" class="btn">Edit</a>
						<a href="{{URL::to('relationships/delete/'.$relationships->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('relationships/create')}}">Create new Relationship</a></p>