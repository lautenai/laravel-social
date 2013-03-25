<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('relations')}}">Relations</a> <span class="divider">/</span>
		</li>
		<li class="active">New Relation</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('leader', 'Leader')}}

			<div class="input">
				{{Form::text('leader', Input::old('leader'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('follower', 'Follower')}}

			<div class="input">
				{{Form::text('follower', Input::old('follower'), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}