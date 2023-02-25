<style>
.table-bordered2 thead{
  background-color:#D6E4F6;
}
</style>
<div class="row">
  <div class="ss_question_add">
    <div class="ss_s_b_main  " style="min-height: 100vh">

      <div class="dictionary_admin_word_list">

        <table class="table table-bordered2" id="table">
          <thead>

            <tr>
              <th scope="col">Serial</th>
              <th scope="col">Show Dialogue</th>
              <th scope="col">Created Date</th>
              <th scope="col">Date to Show</th>
              <th scope="col">Action</th>
			  <th scope="col">Auto repeat</th>
            </tr>
          </thead>
          <tbody>
            <?php $serial = 1; ?>
            <?php foreach ($allDialogue as $dialogue) : ?>
			<?php
                if($dialogue['auto_repeat'] == 1)
                {
                    $checked = "checked";
                }else{
                    $checked = '';
                }
                ?>
              <tr id="<?php echo  $dialogue['id'];?>">
                
                <td ><?php echo $serial++; ?></td>

                <td>
                  <button class="btn btn-success showDialogue" id="" data-toggle="modal" data-target="#myModal">Show</button>
                 <div class="diaBody" id="div<?php echo  $dialogue['id'];?>" style="display: none;"><?php echo $dialogue['body']; ?></div>
                  <!-- <input type="hidden" name="" id="inp<?php echo  $dialogue['id'];?>" class="diaBody" value="123"> -->
                </td>
                <td>
                  <?php echo date('d M Y', strtotime($dialogue['created_at'])) ?>
                </td>
                <td>
                  <?php echo $dialogue['date_to_show'] ?>
                </td>  
                <td>
                  <i class="fa fa-times delDialogue"></i>
                </td>
				<td style="text-align: center;">
                      <input class="form-check-input auto_repeat" value="<?php echo  $dialogue['id'];?>" type="checkbox" name="auto-repeat-<?php echo  $dialogue['id'];?>" <?php echo $checked?> >
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Dialogue</h4>
      </div>
      <div class="modal-body">
        <!-- <p name=""  id="modalTextarea"></p> -->
        <div name=""  id="modalTextarea" cols="10" rows="8"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script type="text/javascript" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="assets/js/sweet_alert.js"></script>

<script>
  //datatable
  jQuery(document).ready(function() {
    $('#table').dataTable({});
  });

  //show dialogue button click
  jQuery(document).on('click', '.showDialogue', function(){
    var id = $(this).closest('tr').attr('id');
    var diaBody = $('#div'+id).html();
    $('#modalTextarea').html(diaBody);
    
  })

  //delete a dialogue
  $(".delDialogue").on('click', function(){
    var diaId = $(this).closest('tr').attr('id');
    swal({
      text: 'Really want to delete this',
      button: {
        text: "Yes",
        closeModal: true,
      },
    })
    .then(name => {
      if (!diaId) throw null;
      return fetch("dialogue/delete/"+diaId);
      
    }).then(results => {
      window.location.reload()
    })
  });
  $(".auto_repeat").on('click', function(){
      var diaId = $(this).closest('tr').attr('id');
      var auto_repeat = $(this).prop('checked');
      if (auto_repeat == true)
      {
          auto_repeat=1;
      }else
      {
          auto_repeat = 0;
      }
      $.ajax({
          method: 'POST',
          url:'add-auto-repeat',
          data: {'diaId':diaId,'autoRepeat':auto_repeat},
          success: function(response){
              swal('Updated',response,'success');
              window.location.reload();
          },
          error: function(){
              alert('Could not add data');
          }
      });
  });
  
</script>
