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
		<li class="span3">
			<a href="#" class="thumbnail">
				{{ HTML::image('portrait/' . $value->photo)}}
			</a>
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
	});
</script>