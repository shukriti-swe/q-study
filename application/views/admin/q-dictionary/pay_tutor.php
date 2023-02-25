<style>
  .table-bordered2 thead{
    background-color:#D6E4F6;
  }
</style>
<div class="row">

  <div class="col-md-4">
      <?php echo $leftnav ?>
  </div>
  <div class="col-md-8">
  <div class="ss_question_add" style="margin-top: 0">
    <div class="ss_s_b_main  " style="min-height: 100vh">

      <div class="dictionary_admin_word_list">

        <table class="table table-bordered2" id="table">
          <thead>

            <tr>
              <th scope="col">Tutor Name</th>
              <th scope="col">Total Approved</th>
              <!-- <th scope="col">Total Created</th> -->
              <th scope="col">Total Paid</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            
            <?php foreach ($toPay as $user) : ?>
              <tr id="<?php echo  $user['word_creator'];?>">
                <td ><?php echo $user['name']; ?></td>
                <td><?php echo $user['total_approved']; ?></td>
                <!-- <td><?php echo $user['total_created']; ?></td> -->
                <td><?php echo $user['total_paid']; ?></td>
                <td>
                  <?php if ($user['total_approved'] >= ($user['total_paid'] + VOCABULARY_PAYMENT)){ ?>
                    <a style="display: inline-block;margin-right: 10px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                    <input type="checkbox" name="payTutorCheck" id="payTutorCheck" value="1">
                  <?php }else{ ?>
                    <!-- <a style="display: inline-block;margin-right: 10px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a> -->
                    <input type="checkbox" name="payTutorCheck" value="1" checked disabled>
                  <?php } ?>
                  <!-- <button class="btn btn-success" id="payTutor">Pay</button> -->
                </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
  </div>
</div>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script type="text/javascript" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="assets/js/sweet_alert.js"></script>

<script>
  jQuery(document).ready(function() {
    $('#table').dataTable({});
  });
  /*$(document).ready(function(){
    $("#table").DataTable({
      "serverSide": true,
      "ajax": "<?php echo base_url(); ?>Admin/wordForDataTable",
      "dataSrc": "tableData",
      "columns":[
        {'data':'ques_created_at'},
        {'data':'creator_type'},
        {'data':'creator_country'},
        {'data':'word_creator'},
        {'data':'word'},
        {'data':'sl'},
        {'data':'view'},
        {'data':'select'},
        {'data':'delete'},
      ]
    });
  });
  */

$(document).on('click', '#payTutor', function(){
  var creator = $(this).closest('tr').attr('id');
  var tr = $(this).closest('tr');
  $.ajax({
    url: 'Admin/payTutor',
    type: 'POST',
    data: {creator: creator},
  })
  .done(function(data) {
    if(data=='true'){
      swal('Tutor get paid');
      //tr.fadeOut(4000);
      location.reload();
    } else {
      swal('Payment failed');
      location.reload();
    }
  });

})

$(document).on('change', '#payTutorCheck', function(){
  var val = $(this).val();
  var creator = $(this).closest('tr').attr('id');
  if (this.checked) {
    $.ajax({
        url: 'Admin/payTutor',
        type: 'POST',
        data: {creator: creator},
      })
      .done(function(data) {
        if(data=='true'){
          swal('Tutor get paid');
          //tr.fadeOut(4000);
          location.reload();
        } else {
          swal('Payment failed');
          location.reload();
        }
      });

    }

})
  
</script>
