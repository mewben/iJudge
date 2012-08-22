<div class="modal-header">
  <a class="close" data-dismiss="modal">×</a>
	<strong>Criteria</strong>
</div>
<div class="modal-body">
    <div class="content">
        <h3 class="floatleft">Contest Name</h3>
        {{ HTML::decode(HTML::link('admin/criteria/add/1', '<i class="icon icon-plus icon-white"></i> Add Criteria', array('class'=>'btn btn-info floatright ajax'))) }}
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
    </div>    
</div>
<div class="modal-footer">
  <a href='#' data-dismiss="modal" class="btn">Close</a>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.ajax').on('click', function(e) {
      e.preventDefault();
      $('.content').load($(this).attr('href'))
    });
  });
</script>