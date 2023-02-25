<div class="" style="margin-left: 15px;">
  <div class="row">
    <div class="col-md-4">
      <?php echo $leftnav ?>
    </div>

    <?php if ($this->session->flashdata('success_msg')) :?>
      <div class="col-md-8" id="flashmsg">
        <div class="alert alert-success" role="alert">
          <?php echo $this->session->flashdata('success_msg'); ?>
        </div>
      </div>
    <?php endif; ?>
    
    <div class="col-md-8 user_list">
      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title text-center">
              <a class="allFaq" role="button" data-toggle="collapse" href=".faqsTable" aria-controls="faqsTable"> 
                <strong><span style="font-size : 18px; ">  ALL Groupboard </span></strong>
              </a>
            </h4>
          </div>
          <div class="row panel-body faqsTable">
            <div class="sign_up_menu">
              <div class="table-responsive">
                <table class="table-bordered c_shcedule" id="table2">
                  <thead>
                    <tr>
                      <th>Serial</th>
                      <th>Groupboard ID</th>
                      <th>User Name</th>
                      <th>User Type</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- groupboard purchase -->
                    <?php  foreach ($glist as $key => $value) { ?>
                       <tr>
                        <td> <?=  $value['id']; ?> </td> 
                        <td> 

                          <div class="row">
                            <div class="col-md-8"><span style="color: blue;"><?= $value['room_id'] ?></div>
                            <div class="col-md-4"><span style="color: blue;">

                                <input type="checkbox" class="" <?= $value['checked'] == 1 ? "checked": ""; ?> onclick="groupboard_assign('<?= $value['room_id']; ?>')" >

                           </div>
                           <?php 
                           $end_subs = $this->db->where('user_email',$value['user_email'])->get('tbl_useraccount')->row('end_subscription');
                           if (isset($end_subs)) {
                               $d1 = date('Y-m-d',strtotime($end_subs));
                               $d2 = date('Y-m-d');
                               $diff = strtotime($d1) - strtotime($d2);
                               $days = floor($diff/(60*60*24));
                            }
                           if (isset($end_subs)): ?>
                            <?php if ($days < 0): ?>
                              <p style="color: blue;font-weight: bold;width: 50%;margin-left: 12px"><u>Available</u></p>
                            <?php endif ?>
                             
                           <?php endif ?>
                          </div>

                          </span>
                        </td>

                        <td> 
                          <a href="<?= base_url('/Faq/assignGroupBoard/'.$value['room_id']) ?>"><?= $value['user_email'] ?> </a>
                        
                        </td>
                        <td>
                          <?= $value['subscription_type'] ?>
                        </td>

                        <td><a href="edit-groupboard/<?= $value['id']; ?>"><i class="fa fa-pencil" style="color:#4c8e0c;"></i></a></td>
                        
                        <td><i data-toggle="modal" data-target="#myModal" onclick="functionDelte('<?= $value['id']; ?>')" class="fa fa-times faqDeleteIcon" style="color:#4c8e0c;"></i></td>
                      </tr>
                    <?php  } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>




      </div>
    </div>

  </div>

</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Really want to delete this </h5>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <button type="button" class="btn btn-danger faqDelBtn" >YES</button>
          <button type="button" class="btn btn-success" data-dismiss="modal">NO</button>
          <input type="hidden" name="faqToDel" id="faqToDel"> 
        </div>
      </div>
      <div class="modal-footer">  
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>

  $(document).ready(function(){
    $('#table2').DataTable({
     "searching": false
   });
  });

  $(document).ready(function () {
    $("a.allFaq").click(function () {
      $(".panel-body").collapse({
        toogle:true
      });
    });
  });

  function functionDelte(argument) {
    $('#faqToDel').val(argument);
  }


  $(document).on('click','.faqDelBtn', function(){
    var faqId = $('#faqToDel').val();
    $.ajax({
      url:'faq/deleteGroupboard/'+faqId,
      mehtod:'GET',
      success: function(data){
        alert(' deleted successfully');
        location.reload();
      }
    })
  });

  function groupboard_assign(room_id) {
    base_url = '<?= base_url('/Faq/assignGroupBoard/') ?>'+'/'+room_id;
    window.location.href  = base_url
  }


</script>
