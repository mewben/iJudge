<h1>Contests</h1>
{{ Form::open('admin/contests/action', '', array('class'=>'form-inline')) }}
<table class="table table-striped">
	<thead>
		<th>{{ Form::checkbox('selectall', '', false, array('class'=>'checkall')) }}</th>
		<th>Contest</th>
		<th width="95">Actions</th>
	</thead>
	<tbody>
		@forelse ($data as $d)
			<tr>
				<td>{{ Form::checkbox('id[]', $d->id) }}</td>
				<td>{{ HTML::link_to_action('admin.questions@edit/' . $d->id, Str::limit($d->question, 150)) }}</td>
				<td>{{ HTML::decode(HTML::link('admin/questions/edit/' . $d->id, '<i class="icon-pencil"></i>', array('class'=> 'btn btn-mini', 'title'=>'Edit'))) }}
					{{ HTML::decode(HTML::link('admin/questions/delete/'. $d->id, '<i class="icon-trash icon-white"></i>', array('class'=>'btn btn-mini btn-danger confirm', 'title'=>'Delete'))) }}

					@if ($d->published)
						{{ HTML::decode(HTML::link('admin/questions/publish/'. $d->id . '/0', '<i class="icon-star-empty icon-white"></i>', array('class'=>'btn btn-mini btn-success', 'title'=>'Unpublish'))) }}
					@else
						{{ HTML::decode(HTML::link('admin/questions/publish/'. $d->id, '<i class="icon-star-empty"></i>', array('class'=>'btn btn-mini', 'title'=>'Publish'))) }}
					@endif
				</td>
			</tr>
		@empty
			<tr><td colspan="5">No Questions</td></tr>
		@endforelse
	</tbody>
</table>