<?php 
	$id = isset($data->id) ? $data->id : 0; 
	$target = $id ? '/admin/judges/edit' : '/admin/judges/add';
?>

{{ Form::open( $target , '', array('class'=>'form-horizontal'))}}
<legend>{{ $id ? 'Edit Judge' : 'Add Judge' }}</legend>
<div class="form-actions2">
	{{ Form::button('Save changes', array('class'=>'btn btn-success', 'type'=>'submit'))}}
	@if($ajax)
		{{ HTML::link('admin/judges/contest/'. $contest->id, 'Cancel', array('class'=>'btn ajax')) }}
	@else
		{{ HTML::link('admin/judges', 'Cancel', array('class'=>'btn')) }}
	@endif
</div>

{{ Form::hidden('id', ($id) ? $id : '' )}}
{{ Form::hidden('contest_id', $contest->id) }}

<div class="control-group">
	{{ Form::label('contest_name', 'Contest Name', array('class'=>'control-label'))}}
	<div class="controls">
		{{ Form::text('contest_name', (isset($contest->name))  ? $contest->name : Input::old('contest_name'), array('class'=>'input-xlarge', 'disabled'=>'disabled'))}}
	</div>
</div>

<div class="control-group">
	{{ Form::label('number', 'Judge Number *', array('class'=>'control-label'))}}
	<div class="controls">
		{{ Form::text('number', (isset($data->number))  ? $data->number : Input::old('number'), array('class'=>'input-small'))}}
	</div>
</div>

<div class="control-group">
	{{ Form::label('username', 'Username *', array('class'=>'control-label'))}}
	<div class="controls">
		{{ Form::text('username', (isset($data->username))  ? $data->username : Input::old('username'), array('class'=>'input-medium'))}}
	</div>
</div>
<div class="control-group">
	{{ Form::label('password', 'Password *', array('class'=>'control-label'))}}
	<div class="controls">
		{{ Form::text('password', '', array('class'=>'input-medium'))}}
	</div>
</div>
<div class="control-group">
	{{ Form::label('fullname', 'Full Name *', array('class'=>'control-label'))}}
	<div class="controls">
		{{ Form::text('fullname', (isset($data->fullname))  ? $data->fullname : Input::old('fullname'), array('class'=>'input-medium'))}}
	</div>
</div>
{{ Form::close()}}

<script type="text/javascript">
	$(document).ready(function() {
		$('form').submit(function() {
			$.ajax({
				type: 'POST',
				url: '{{$target}}',
				data: $(this).serialize(),
				success: function(data) {
					if (data == true) {
						$('.content').load('/admin/judges/contest/' + {{ $contest->id }});
					} else {
						alert('Error Saving.. Please check your inputs.');
					};
				}
			});
			return false;
		});

	    $('.ajax').on('click', function(e) {
	      	e.preventDefault();
	      	$('.content').load($(this).attr('href'))
	    });
	});
</script>
