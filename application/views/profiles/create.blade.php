<div class="span16">
	<ul class="breadcrumb span6">
		<li>
			<a href="{{URL::to('users')}}">Users</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="{{URL::to('profiles')}}">Profiles</a> <span class="divider">/</span>
		</li>
		<li class="active">New Profile</li>
	</ul>
</div>

{{Form::open(null, 'post', array('class' => 'form-stacked span16'))}}
	<fieldset>
		<div class="clearfix">
			{{Form::label('user_id', 'User Id')}}

			<div class="input">
				{{Form::text('user_id', Input::old('user_id', $user_id), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('name', 'Name')}}

			<div class="input">
				{{Form::text('name', Input::old('name'), array('class' => 'span6'))}}
			</div>
		</div>
		<div class="clearfix">
			{{Form::label('email', 'Email')}}

			<div class="input">
				{{Form::text('email', Input::old('email'), array('class' => 'span6'))}}
			</div>
		</div>

		<div class="actions">
			{{Form::submit('Save', array('class' => 'btn primary'))}}

			or <a href="{{URL::to(Request::referrer())}}">Cancel</a>
		</div>
	</fieldset>
{{Form::close()}}