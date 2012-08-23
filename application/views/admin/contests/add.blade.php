<?php $id = isset($data->id) ? $data->id : 0; ?>
<h3>@if ($id)
		Edit Contest
	@else
		Add Contest
	@endif
</h3>
<hr>

@include ('partials.messages')

{{ Form::open_for_files( ($id) ? 'admin/contests/edit' : 'admin/contests/add', '', array('class'=>'form-horizontal'))}}
{{ Form::hidden('id', ($id) ? $id : '' )}}

<?php

if (isset($data->banner)) {
	$banner = 'style="background-image:url(' . "'" . URL::base() . '/files/' . $data->banner . "'" . ')"';
}
 ?>
<div class="control-group banner" {{ isset($banner) ? $banner : ''}}>
	<span class="btn btn-warning fileinput-button">
		<i class="icon-plus icon-white"></i>
		<span>Upload Banner</span>
		<input id="fileupload" type="file" name="files[]" data-url="/server/php/">
	</span>
	<div id="progress">
		<div class="bar" style="width:0%"></div>
	</div>
	{{ Form::hidden('banner', '')}}
</div>

<div class="control-group@if($errors->first('name')) error@endif">
	{{ Form::label('name', 'Contest Name *', array('class'=>'control-label'))}}
	<div class="controls">
		{{ Form::text('name', (isset($data->name))  ? $data->name : Input::old('name'), array('class'=>'input-xlarge'))}}
		{{ $errors->first('name', '<span class="help-inline">:message</span>')}}
	</div>
</div>
<div class="control-group">
	{{ Form::label('dependent', '', array('class'=>'control-label'))}}
	<div class="controls">
		<label for="dependent" class="checkbox">
			{{ Form::checkbox('dependent', '1', (isset($data->dependent) && $data->dependent == 1) ? true : false)}}
			Dependent <sub>- means that this contest is depending other contest for its criteria</sub>
		</label>
	</div>
</div>

<div class="form-actions">
	{{ Form::submit('Save changes', array('class'=>'btn btn-success'))}}
	{{ HTML::link('admin/contests', 'Cancel', array('class'=>'btn'))}}
</div>
{{ Form::close()}}
<hr>
<div><small>* - Required</small></div>
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
				$('input[name="banner"]').val(file.name);
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