<h1>Contests</h1>
@include ('partials.messages')
{{ Form::open('admin/contests/action', '', array('class'=>'form-inline')) }}
<table class="table table-striped">
	<thead>
		<th width="10">{{ Form::checkbox('selectall', '', false, array('class'=>'checkall')) }}</th>
		<th width="100">Banner</th>
		<th>Contest</th>
		<th width="125">Actions</th>
	</thead>
	<tbody>
		@forelse ($data as $d)
			<tr>
				<td>{{ Form::checkbox('id[]', $d->id) }}</td>
				<td>{{ HTML::image('thumbnails/' . $d->banner) }}</td>
				<td>{{ HTML::link_to_action('admin.contests@edit/' . $d->id, $d->name) }}</td>
				<td>{{ HTML::decode(HTML::link('admin/criteria/contest/' . $d->id, '<i class="icon icon-th-list"></i>', array('class'=>'btn btn-mini criteria', 'title'=>'Criteria', 'data-toggle'=>'modal', 'data-target'=>'#myModal', 'data-backdrop'=>'static')))}}
					{{ HTML::decode(HTML::link('admin/contests/edit/' . $d->id, '<i class="icon icon-pencil"></i>', array('class'=> 'btn btn-mini', 'title'=>'Edit'))) }}
					{{ HTML::decode(HTML::link('admin/contests/delete/'. $d->id, '<i class="icon icon-trash icon-white"></i>', array('class'=>'btn btn-mini btn-danger confirm', 'title'=>'Delete'))) }}

					@if ($d->active)
						{{ HTML::decode(HTML::link('admin/contests/active/'. $d->id . '/0', '<i class="icon-star-empty icon-white"></i>', array('class'=>'btn btn-mini btn-success', 'title'=>'Unpublish'))) }}
					@else
						{{ HTML::decode(HTML::link('admin/contests/active/'. $d->id, '<i class="icon-star-empty"></i>', array('class'=>'btn btn-mini', 'title'=>'Publish'))) }}
					@endif
				</td>
			</tr>
		@empty
			<tr><td colspan="5">No contests</td></tr>
		@endforelse
	</tbody>
</table>

<div class="modal hide fade" id="confirm">
    <div class="modal-header">
    	<a class="close" data-dismiss="modal">×</a>
    	<h3>Criteria</h3>
    </div>
  <div class="modal-body">
    	<p>Please wait...</p>
  </div>
  <div class="modal-footer">
  		{{ Form::submit('Yes', array('class'=>'btn btn-danger'))}}
        <a href='#' data-dismiss="modal" class="btn">No</a>
  </div>
</div>

<div class="modal fade" id="myModal"></div>

 <script>
	$('document').ready(function() {

		$('a[data-toggle=modal]').on('click', function(e) {
			e.preventDefault();
			var lv_target = $(this).attr('data-target');
			var lv_url = $(this).attr('href');
			$(lv_target).load(lv_url);
		});

/*      	$('#delete_user').modal({
        	show:false
      	}); // Start the modal
      	


      	$('.critseria').on('click', function(e) {
      		e.preventDefault();
      		$('#confirm').modal({backdrop:'static'});
      	});

      	$('.confirm').on('click', function(e) {
      		if(!confirm('Are you sure you want to delete?')) {
      			e.preventDefault();
      		} 
      	});

      	$('.checkall').on('click', function() {
      		$(this).parents('table').find(':checkbox').attr('checked', this.checked);
      	});*/
	});
</script>