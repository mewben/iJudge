<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<meta name="author" content="Melvin Soldia">

	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>

	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap-responsive.min.css') }}

	{{ HTML::style('css/style-login.css') }}

	
	{{ HTML::script('js/placeholder.js') }}
	{{ HTML::script('js/supersized.core.3.2.1.min.js') }}
</head>

<body>

	<div id="supersize">
		<img src="img/warty-final-ubuntu.png" alt="" class="activeslide">
	</div>
	
	{{Form::open('', '', array('id' => 'slick-login'))}}
		<div class="prompt">Invalid</div>
		{{Form::text('username', '', array('class'=>'placeholder', 'placeholder'=>'me@aljdf.com'))}}<label for="username">username</label>
		{{Form::password('password', array('class'=>'placeholder', 'placeholder'=>'password'))}}<label for="password">password</label>
		{{Form::submit('Log In', array('class'=>'btn'))}}

	{{Form::close()}}	
	
<script type="text/javascript">
$(function() {
	$.fn.supersized.options = {
		slideshow: -1
	}
	$('#supersize').supersized();
});
</script>
{{ HTML::script('js/bootstrap.min.js') }}

</body>
</html>