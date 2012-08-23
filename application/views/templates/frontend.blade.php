<!-- MAIN -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title>{{ isset($title) ? $title : '' }}</title>
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/bootstrap-responsive.min.css') }}
		{{ HTML::style('css/main.css') }}
		{{ HTML::script('js/jquery-1.7.2.min.js') }}
	</head>
	<body>
		<div class="container-fluid">
			<div class="row-fluid">
				{{ isset($content) ? $content : '' }}
			</div>
		</div>
	{{ HTML::script('js/bootstrap.min.js') }}
	</body>
</html>