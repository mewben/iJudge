<h3 class="floatleft">{{ $data->name }}</h3>
  {{ HTML::decode(HTML::link('admin/judges/add/'. $data->id, '<i class="icon icon-plus icon-white"></i> Add Judge', array('class'=>'btn btn-info floatright ajax'))) }}
<div class="clear"></div>

<table class="table table-bordered" style="margin-top:10px;">
@forelse($judges as $key => $value)

  <tr>
  	<td width="10">{{ $value->number }}</td>
    <td>{{ HTML::link('admin/judges/edit/'. $value->id , $value->fullname, array('class'=>'ajax'))}}</td>
    <td width="60">
      {{ HTML::decode(HTML::link('admin/judges/edit/' . $value->id, '<i class="icon icon-pencil"></i>', array('class'=> 'btn btn-mini ajax', 'title'=>'Edit'))) }}
      {{ HTML::decode(HTML::link('admin/judges/delete/'. $value->id, '<i class="icon icon-trash icon-white"></i>', array('class'=>'btn btn-mini btn-danger ajaxrequest', 'title'=>'Delete'))) }}
    </td>
  </tr>
@empty
  <tr>
    <td>No Judges</td>
  </tr>
@endforelse
</table>

<script type="text/javascript">
$(document).ready(function() {
    $('.ajax').on('click', function(e) {
      	e.preventDefault();
      	$('.content').load($(this).attr('href'))
    });

    $('.ajaxrequest').on('click', function(e) {
      	e.preventDefault();
      	$.ajax({
        	type: 'GET',
        	url: $(this).attr('href'),
        	success: function(data) {
	          	if (data == true) {
	            	$('.content').load('/admin/judges/contest/' + {{ $data->id }});
	          	} else {
	            	alert('Error Deleting.. Something must have gone wrong.');
		        };
        	}
      	});
    });
});
</script>