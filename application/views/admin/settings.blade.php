<h1>Settings</h1>
@include ('partials.messages')

<ul class="nav nav-tabs">
	<li class="active"><a href="#type" data-toggle="tab">Judging Type</a></li>
	<li><a href="#resultform" data-toggle="tab">Result Form</a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane active" id="type">
		{{ Form::open('/admin/settings/type','POST', array('class'=>'form-horizontal'))}}
			<legend>Judging Type</legend>
			<div class="btn-group" data-toggle="buttons-radio">
				<button class="btn btn-large btn-success" type="submit" name="type" value="rank">Ranking System</button>
				<button class="btn btn-large btn-success" type="submit" name="type" value="point">Point System</button>
				<button class="btn btn-large btn-success" type="submit" name="type" value="pointrank">Point-Rank System</button>
			</div>
		{{ Form::close() }}
	</div>
	<div class="tab-pane" id="resultform">
		{{ Form::open('/admin/settings/type','POST', array('class'=>'form-horizontal'))}}
		<legend>Result Form</legend>
		<textarea name="result_form" id="redactor_content"></textarea>
		{{ Form::close()}}
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#redactor_content').redactor({
			wym: true,
			imageUpload: '/file_upload.php'
		});
	});
</script>