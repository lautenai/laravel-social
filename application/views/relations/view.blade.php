<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('relations')}}">Relations</a> <span class="divider">/</span>
		</li>
		<li class="active">Viewing Relation</li>
	</ul>
</div>

<div class="span16">
<p>
	<strong>Leader:</strong>
	{{$relation->leader}}
</p>
<p>
	<strong>Follower:</strong>
	{{$relation->follower}}
</p>

<p><a href="{{URL::to('relations/edit/'.$relation->id)}}" class="btn">Edit</a> <a href="{{URL::to('relations/delete/'.$relation->id)}}" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a></p>
