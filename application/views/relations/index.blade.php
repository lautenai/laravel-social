@if(count($relations) == 0)
	<p>No relations.</p>
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
			@foreach($relations as $relation)
				<tr>
					<td>{{$relation->leader}}</td>
					<td>{{$relation->follower}}</td>
					<td>
						<a href="{{URL::to('relations/view/'.$relation->id)}}" class="btn">View</a>
						<a href="{{URL::to('relations/edit/'.$relation->id)}}" class="btn">Edit</a>
						<a href="{{URL::to('relations/delete/'.$relation->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

<p><a class="btn success" href="{{URL::to('relations/create')}}">Create new Relation</a></p>