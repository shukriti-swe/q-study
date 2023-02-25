<style>

  label {
    font-size: 13px;
  }

  .user_list {
    border-color: #2F91BA;
  }

  .panel-default > .panel-heading{
    background-color: #FCF8E3 !important;
  }

</style>

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
                <strong><span style="font-size : 18px; ">  ALL FAQ </span></strong>
              </a>
            </h4>
          </div>
          <div class="row panel-body faqsTable">
            <div class="sign_up_menu">
              <div class="table-responsive">
                <table class="table-bordered c_shcedule" id="table2">
                  <thead>
                    <tr>
                      <th>Serial no</th>
                      <th>Topic</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($allFaqs as $key=> $faq) : ?>
                      <tr id="<?php echo $faq['id']; ?>">  
                        <td>  <button onclick="myFunction(<?= $faq['id'] ?> , <?= $key+1 ?>  )"  > <?= $key+1; ?> </button>   </td>
                        <td><a href="faq/edit/<?php echo $faq['id']; ?>"><?php echo $faq['title']; ?></a></td>                        <td><a href="faq/edit/<?php echo $faq['id']; ?>"><i class="fa fa-pencil" style="color:#4c8e0c;"></i></a></td>
                        <td><i data-toggle="modal" data-target="#myModal" class="fa fa-times faqDeleteIcon" style="color:#4c8e0c;"></i></td>
                      </tr>
                    <?php endforeach; ?>
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
        <h5 class="modal-title">Really want to delete this faq</h5>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <button type="button" class="btn btn-danger faqDelBtn" >YES</button>
          <button type="button" class="btn btn-success" data-dismiss="modal">NO</button>
          <input type="hidden" name="" id="faqToDel" value="">
        </div>
      </div>
      <div class="modal-footer">  
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="myModal_two" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Number Serialize</h5>
      </div>
      <div class="modal-body">
        <span id="serialized_show"></span> <br>
        <button id="serialize_submit" class="btn btn-success" >Add Change </button>
      </div>
      <div class="modal-footer">  
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
  function myFunction(id, serial_id) {
    $('#myModal_two').modal('show');
    $("#serialized_show").html(" <input type='number' class='form-control' id='serialized_num' value="+serial_id+"  /> ");

    $("#serialize_submit").click(function () {

      $.ajax({
        url:'faq/serialize/'+id+"/"+serial_id+"/"+$('#serialized_num').val(),
        mehtod:'GET',
        success: function(data){
          alert(data)
          window.location.reload();
        }
      })

    });
}
</script>
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


  /*delete faq icon(from table) click*/
  $(document).on('click','.faqDeleteIcon', function(){
    var faqId = $(this).closest('tr').attr('id');
    console.log(faqId);
    $('#faqToDel').val(faqId);
  });

  /*modal delete button click*/
  $(document).on('click','.faqDelBtn', function(){
    var faqId = $('#faqToDel').val();
    $.ajax({
      url:'faq/delete/'+faqId,
      mehtod:'POST',
      success: function(data){
        alert('Faq deleted successfully');
        $('#myModal').modal('toggle');
        $('tr#'+faqId).fadeOut(2000);
      }
    })
  });


</script>
