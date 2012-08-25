<?php 

	$id = isset($data->id) ? $data->id : 0; 
	$target = $id ? '/admin/contestants/edit' : '/admin/contestants/add';

?>
@include ('partials.messages')

{{ Form::open( $target , '', array('class'=>'form-horizontal'))}}
<legend>&nbsp;</legend>
<div class="form-actions2">
	{{ Form::button('Save changes', array('class'=>'btn btn-success', 'type'=>'submit'))}}
	{{ HTML::link('#', 'Cancel', array('class'=>'btn ajax', 'data-dismiss' => 'modal')) }}
</div>

{{ Form::hidden('id', ($id) ? $id : '' )}}
{{ Form::hidden('contest_id', $contest->id) }}

<?php

if (isset($data->photo)) {
	$photo = 'style="background-repeat:no-repeat;background-image:url(' . "'" . URL::base() . '/files/' . $data->photo . "'" . ')"';
}
 ?>
<div class="control-group banner" {{ isset($photo) ? $photo : ''}}>
	<span class="btn btn-warning fileinput-button">
		<i class="icon-plus icon-white"></i>
		<span>Upload Photo</span>
		<input id="fileupload" type="file" name="files[]" data-url="/server/php/">
	</span>
	{{ Form::hidden('photo', '')}}
</div>


<div class="control-group">
	{{ Form::label('contest_name', 'Contest Name', array('class'=>'control-label'))}}
	<div class="controls">
		{{ Form::text('contest_name', (isset($contest->name))  ? $contest->name : Input::old('contest_name'), array('class'=>'input-xlarge', 'disabled'=>'disabled'))}}
	</div>
</div>

<div class="control-group">
	{{ Form::label('number', 'Contestant Number *', array('class'=>'control-label'))}}
	<div class="controls">
		{{ Form::text('number', (isset($data->number))  ? $data->number : Input::old('number'), array('class'=>'input-small'))}}
	</div>
</div>

<div class="control-group">
	{{ Form::label('fullname', 'Full Name *', array('class'=>'control-label'))}}
	<div class="controls">
		{{ Form::text('fullname', (isset($data->fullname))  ? $data->fullname : Input::old('fullname'), array('class'=>'input-large'))}}
	</div>
</div>


{{ Form::close()}}

{{ HTML::script('js/jfileupload/vendor/jquery.ui.widget.js')}}
{{ HTML::script('js/jfileupload/jquery.iframe-transport.js')}}
{{ HTML::script('js/jfileupload/jquery.fileupload.js')}}
<script type="text/javascript">
	$(document).ready(function() {
		var uploadbtn = $('.fileinput-button');
		uploadbtn.hide();
			
		$('.banner').hover(function() {
			uploadbtn.show();
		}, function() {
			uploadbtn.hide();
		});

	});
	$('#fileupload').fileupload({
		dataType: 'json',
		done: function(e, data) {
			$.each(data.result, function(index, file) {
				$('.banner').css('background-image', 'url('+file.url+')');
				$('input[name="photo"]').val(file.name);
				$('.fileinput-button').hide();
			});
		},
		progressall: function(e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress .bar').css(
				'width',
				progress + '%'
			);
		}
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('form').submit(function() {
			console.log($(this).serialize());
			$.ajax({
				type: 'POST',
				url: '{{$target}}',
				data: $(this).serialize(),
				success: function(data) {
					if (data == true) {
						location.href = '/admin/contestants/view/' + {{$contest->id}};
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

