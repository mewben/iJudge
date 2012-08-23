@if (Session::has('message'))
	<div class="alert alert-success">
		<i class="icon-ok"></i>
		{{ Session::get('message') }}	
	</div>
@endif
@if (Session::has('error'))
	<div class="alert alert-error">
		<i class="icon-remove"></i>
		{{ Session::get('error') }}	
	</div>
@endif