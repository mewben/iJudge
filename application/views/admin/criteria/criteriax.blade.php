<h3 class="floatleft">{{ $data->name }}</h3>
  {{ HTML::decode(HTML::link('admin/criteria/add/'. $data->id, '<i class="icon icon-plus icon-white"></i> Add Criteria', array('class'=>'btn btn-info floatright ajax'))) }}
<div class="clear"></div>

<table class="table table-bordered" style="margin-top:10px;">
<?php $total = 0; ?>
@forelse($criteria as $key => $value)
  <?php $total += $value->percentage; ?>
  <tr>
    <td>{{ HTML::link('admin/criteria/edit/'. $value->id , $value->name, array('class'=>'ajax'))}}</td>
    <td width="60">
      {{ HTML::decode(HTML::link('admin/criteria/edit/' . $value->id, '<i class="icon icon-pencil"></i>', array('class'=> 'btn btn-mini ajax', 'title'=>'Edit'))) }}
      {{ HTML::decode(HTML::link('admin/criteria/delete/'. $value->id, '<i class="icon icon-trash icon-white"></i>', array('class'=>'btn btn-mini btn-danger ajaxrequest', 'title'=>'Delete'))) }}
    </td>
    <td class="right">{{ $value->percentage }}%</td>
  </tr>
@empty
  <tr>
    <td>No Criteria</td>
  </tr>
@endforelse
<tfoot>
  <tr>
    <th colspan="2"> ---- Total</th>
    <th width="50" class="right">{{ $total }}%</th>
  </tr>
</tfoot>
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
            $('.content').load('/admin/criteria/contest/' + {{ $data->id }});
          } else {
            alert('Error Deleting.. Something must have gone wrong.');
          };
        }
      });
    });
  });
</script>