<h3 class="floatleft">{{ $data->name }}</h3>
  {{ HTML::decode(HTML::link('admin/criteria/add/'. $data->id, '<i class="icon icon-plus icon-white"></i> Add Criteria', array('class'=>'btn btn-info floatright ajax'))) }}
<div class="clear"></div>

<table class="table table-bordered" style="margin-top:10px;">
<tr>
  <td>Talent</td> 
  <td class="right">15%</td>
</tr>
<tr>
  <td>Talent</td> 
  <td class="right">15%</td>
</tr>
<tfoot>
  <tr>
    <th>Total</th>
    <th width="50" class="right">100%</th>
  </tr>
</tfoot>
</table>

<script type="text/javascript">
  $(document).ready(function() {
    $('.ajax').on('click', function(e) {
      e.preventDefault();
      $('.content').load($(this).attr('href'))
    });
  });
</script>