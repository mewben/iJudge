<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Admin Login</title>
	<meta name="author" content="Melvin Soldia">

	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>

	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap-responsive.min.css') }}

	{{ HTML::style('css/style-login.css') }}
	
	{{ HTML::script('js/placeholder.js') }}

</head>

<body>

	<div class="banner">
		{{ HTML::image('img/banner.png')}}
	</div>
	
	{{Form::open('admin/login', '', array('id' => 'slick-login'))}}
		@if (Session::has('error'))
		<div class="prompt">
			<i class="icon-remove"></i>
			{{ Session::get('error') }}	
		</div>
		@endif

		{{Form::text('username', '', array('class'=>'placeholder', 'placeholder'=>'username'))}}<label for="username">username</label>
		{{Form::password('password', array('class'=>'placeholder', 'placeholder'=>'password'))}}<label for="password">password</label>
		{{Form::submit('Log In', array('class'=>'btn'))}}

	{{Form::close()}}	
	

{{ HTML::script('js/bootstrap.min.js') }}

</body>
</html>