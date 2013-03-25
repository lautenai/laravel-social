<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('relationships')}}">Relations</a> <span class="divider">/</span>
		</li>
		<li class="active">New Relationship</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('follower_id', 'Leader')}}

			<div class="input">
				{{Form::text('follower_id', Input::old('follower_id'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('followed_id', 'Follower')}}

			<div class="input">
				{{Form::text('followed_id', Input::old('followed_id'), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}