<h1>Contestants</h1>
<hr>
@include ('partials.messages')

<div class="form-actions2">
	{{ Form::select('contest_id', $contests, $contest_id) }}
	{{ HTML::link('/admin/contestants/add/' . $contest_id, 'Add', array('class'=>'btn btn-success ajax', 'title'=>'Add Contestant', 'data-toggle'=>'modal', 'data-tasrget'=>'#myModal', 'data-backdrop'=>'static'))}}
</div>
<div class="clear"></div>
<ul class="thumbnails">
	@forelse ($data as $key => $value)
		<li class="span2">
			<div class="thumbnail">
				{{ HTML::image('thumbnails/' . $value->photo, '', array('class'=>'img-polaroid'))}}
				<p class="center"><span class="badge badge-success">{{$value->number}}</span> {{$value->fullname}}</p>
				<p class="center form-actions">
					{{ HTML::decode(HTML::link('admin/contestants/edit/' . $value->id, '<i class="icon icon-pencil"></i>', array('class'=> 'btn btn-mini ajax', 'title'=>'Edit Contestant', 'data-toggle'=>'modal', 'data-tasrget'=>'#myModal', 'data-backdrop'=>'static'))) }}
					{{ HTML::decode(HTML::link('admin/contestants/delete/'. $value->id, '<i class="icon icon-trash icon-white"></i>', array('class'=>'btn btn-mini btn-danger ajaxrequest', 'title'=>'Delete'))) }}
					@if ($value->active)
						{{ HTML::decode(HTML::link('admin/contestants/active/'. $value->id . '/0', '<i class="icon-star-empty icon-white"></i>', array('class'=>'btn btn-mini btn-success ajaxrequest', 'title'=>'Deactivate'))) }}
					@else
						{{ HTML::decode(HTML::link('admin/contestants/active/'. $value->id, '<i class="icon-star-empty"></i>', array('class'=>'btn btn-mini ajaxrequest', 'title'=>'Activate'))) }}
					@endif
				</p>
			</div>
		</li>
	@empty
		<li>Empty</li>
	@endforelse
</ul>

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

		$('select[name=contest_id]').on('change', function() {
			location.href = '/admin/contestants/view/' + $(this).val();
		});

		$('.ajaxrequest').on('click', function(e) {
	      	e.preventDefault();
	      	$.ajax({
	        	type: 'GET',
	        	url: $(this).attr('href'),
	        	success: function(data) {
		          	if (data == true) {
		            	location.href = '/admin/contestants/view/' + {{ $contest_id }};
		          	} else {
		            	alert('Error.. Something must have gone wrong.');
			        };
	        	}
	      	});
	    });
	});
</script>