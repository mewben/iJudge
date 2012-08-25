<h1>Contests</h1>
@include ('partials.messages')
<table class="table table-striped table-hover">
	<thead>
		<th width="100">Banner</th>
		<th>Contest</th>
		<th width="200">Actions</th>
	</thead>
	<tbody>
		@forelse ($data as $d)
			<tr>
				<td>{{ HTML::image('thumbnails/' . $d->banner, '', array('width' => '70')) }}</td>
				<td>{{ HTML::link_to_action('admin.contests@edit/' . $d->id, $d->name) }}</td>
				<td>
					{{ HTML::decode(HTML::link('admin/criteria/contest/' . $d->id, '<i class="icon icon-th-list"></i>', array('class'=>'btn btn-mini criteria', 'title'=>'Criteria', 'data-toggle'=>'modal', 'data-tasrget'=>'#myModal', 'data-backdrop'=>'static')))}}

					{{ HTML::decode(HTML::link('admin/judges/contest/' . $d->id, '<i class="icon icon-briefcase"></i>', array('class'=>'btn btn-mini criteria', 'title'=>'Judges', 'data-toggle'=>'modal', 'data-tasrget'=>'#myModal', 'data-backdrop'=>'static')))}}

					{{ HTML::decode(HTML::link('admin/contestants/view/' . $d->id, '<i class="icon icon-bookmark"></i>', array('class'=>'btn btn-mini criteria', 'title'=>'Contestants')))}}

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

<div class="modal hide fade" id="myModal">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
    	<h3 id="mtitle">Criteria</h3>
	</div>
	<div class="modal-body">
		<div class="content">
			
		</div>
  	</div>
  	<div class="modal-footer">
  	</div>
</div>

 <script>
	$('document').ready(function() {

		$('a[data-toggle=modal]').on('click', function(e) {
			e.preventDefault();
			$('#myModal').modal({
				backdrop: 'static',
			});
			//var lv_target = $(this).attr('data-target');
			var lv_url = $(this).attr('href');
			$('#mtitle').text($(this).attr('title'));
			$('.content').load(lv_url);
		});
	});
</script>