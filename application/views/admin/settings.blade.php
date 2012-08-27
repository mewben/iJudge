<h1>Settings</h1>
@include ('partials.messages')

<ul class="nav nav-tabs">
	<li class="active"><a href="#type" data-toggle="tab">Judging Type</a></li>
	<li><a href="#resultform" data-toggle="tab">Result Form</a></li>
</ul>
{{ Form::open('/admin/settings/save','POST', array('class'=>'form-horizontal'))}}
	<div class="tab-content">
		<div class="tab-pane active" id="type">
			<legend>Judging Type</legend>
			<div class="btn-group" data-toggle="buttons-radio">
				<button class="btn btn-large btn-success {{$data['type'] == 'rank' ? 'active':''}}" type="submit" name="type" value="rank">Ranking System</button>
				<button class="btn btn-large btn-success {{$data['type'] == 'point' ? 'active':''}}" type="submit" name="type" value="point">Point System</button>
				<button class="btn btn-large btn-success {{$data['type'] == 'pointrank' ? 'active':''}}" type="submit" name="type" value="pointrank">Point-Rank System</button>
			</div>
		</div>
		<div class="tab-pane" id="resultform">
			<legend>Result Form</legend>
			{{ Form::submit('Save', array('class'=>'btn btn-success'))}} <br><br>	
			<textarea name="result_form" id="redactor_content">{{$data['resultform']}}</textarea>
		</div>
	</div>
{{ Form::close()}}
<script type="text/javascript">
	$(document).ready(function() {
		$('#redactor_content').redactor({
			wym: true,
			imageUpload: '/file_upload.php'
		});
	});
</script>