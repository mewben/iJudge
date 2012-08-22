<?php $id = isset($data->id) ? $data->id : 0; ?>
<h3>@if ($id)
		Edit Criteria
	@else
		Add Criteria
	@endif
</h3>
<hr>

@include ('partials.messages')

{{ Form::open( ($id) ? 'admin/criteria/edit' : 'admin/criteria/add', '', array('class'=>'form-horizontal'))}}
{{ Form::hidden('id', ($id) ? $id : '' )}}

<div class="control-group@if($errors->first('name')) error@endif">
	{{ Form::label('name', 'Criteria Name *', array('class'=>'control-label'))}}
	<div class="controls">
		{{ Form::text('name', (isset($data->name))  ? $data->name : Input::old('name'), array('class'=>'input-xlarge'))}}
		{{ $errors->first('name', '<span class="help-inline">:message</span>')}}
	</div>
</div>

<div class="control-group@if($errors->first('description')) error@endif">
	{{ Form::label('description', 'Criteria Description', array('class'=>'control-label'))}}
	<div class="controls">
		{{ Form::textarea('description', (isset($data->description))  ? $data->description : Input::old('description'), array('class'=>'input-xlarge', 'rows'=>'2'))}}
		{{ $errors->first('description', '<span class="help-inline">:message</span>')}}
	</div>
</div>

<div class="control-group@if($errors->first('percentage')) error@endif">
	{{ Form::label('percentage', 'Percentage *', array('class'=>'control-label'))}}
	<div class="controls">
		{{ Form::text('percentage', (isset($data->percentage))  ? $data->percentage : Input::old('percentage'), array('class'=>'input-small'))}}
		{{ $errors->first('percentage', '<span class="help-inline">:message</span>')}}
	</div>
</div>

<div class="form-actions">
	{{ Form::submit('Save changes', array('class'=>'btn btn-success'))}}
	@if($ajax)
		{{ HTML::link('admin/criteria', 'Cancel', array('class'=>'btn ajax')) }}
	@else
		{{ HTML::link('admin/criteria', 'Cancel', array('class'=>'btn')) }}
	@endif
</div>
{{ Form::close()}}

<script type="text/javascript">
	$(document).ready(function() {
		$('form').submit(function() {
			$.ajax({
				type: 'POST',
				url: '{{HTML::link("admin/criteria/add")}}',
			});
			alert($(this).serialize());
			return false;
		});
	});
</script>