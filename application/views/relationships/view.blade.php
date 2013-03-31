<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('relationships')}}">Relationships</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Relationship</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Leader:</strong>
	{{$relationships->follower_id}}
</p>
<p>
	<strong>Follower:</strong>
	{{$relationships->followed_id}}
</p>

<p><a href="{{URL::to('relationships/edit/'.$relationships->id)}}" class="btn">Edit</a> <a href="{{URL::to('relationships/delete/'.$relationships->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
