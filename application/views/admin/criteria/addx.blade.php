<?php 

	$id = isset($data->id) ? $data->id : 0; 
	$target = $id ? '/admin/criteria/edit' : '/admin/criteria/add';

?>
@include ('partials.messages')

{{ Form::open( $target , '', array('class'=>'form-horizontal'))}}
<legend>{{ $id ? 'Edit Criteria' : 'Add Criteria' }}</legend>
<div class="form-actions2">
	{{ Form::button('Save changes', array('class'=>'btn btn-success', 'type'=>'submit'))}}
	@if($ajax)
		{{ HTML::link('admin/criteria/contest/'. $contest->id, 'Cancel', array('class'=>'btn ajax')) }}
	@else
		{{ HTML::link('admin/criteria', 'Cancel', array('class'=>'btn')) }}
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
	{{ HTML::decode(Form::label('select_criteria', 'Contest as Criteria: <br /><sub>(or add Criteria Name below)</sub>', array('class'=>'control-label')))}}
	<div class="controls">
		{{ Form::select('select_criteria', $contests, $data->criteria_contest_id)}}	
	</div>
</div>

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
						$('.content').load('/admin/criteria/contest/' + {{ $contest->id }});
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

	    $('#select_criteria').on('change', function() {
	    	if ($(this).val() != 0 ) {
	    		$('#name').val($('#select_criteria option:selected').text());
	    	} else {
	    		$('#name').val('');
	    	};

	    });
	});
</script>
