<!-- MAIN -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title>{{ isset($title) ? $title : '' }}</title>
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/bootstrap-responsive.min.css') }}
		{{ HTML::style('fonts/open-sans-fontfacekit/stylesheet.css')}}
		{{ HTML::style('css/backend.css') }}
		{{ HTML::script('js/jquery-1.7.2.min.js') }}
		@if(isset($otherhead))
			{{ HTML::style('js/redactor/redactor.css') }}
			{{ HTML::script('js/redactor/redactor.min.js') }}
		@endif
	</head>
	<body>
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a href="{{ URL::base() }}" class="brand">{{ HTML::image('img/logo.png')}}</a>
					<div class="nav-collapse">
						{{ isset($topmenu) ? $topmenu : '' }}
					</div>
				</div>

			</div>
		</div>

		<div class="container-fluid">
			<div class="row-fluid">
				@if(isset($sidemenu))
					<div class="span2">
						{{ $sidemenu }}
					</div>
					<div class="span10">
						{{ isset($content) ? $content : '' }}		
					</div>
				@else
					<div class="span12">
						{{ isset($content) ? $content : '' }}		
					</div>
				@endif
			</div>
		</div>
	{{ HTML::script('js/bootstrap.min.js') }}
	</body>
</html>