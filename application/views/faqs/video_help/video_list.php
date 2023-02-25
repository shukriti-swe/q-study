<?php 

$files = json_decode($videoList[0]['userfile'] , true);

$title_num  = count($files) / 2 ;

foreach ($files as $key => $value) {
    if ($key < $title_num) {
        $title[] = $value;
    }else{
        $videos[] = $value;
    }
}

 ?>


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
                <strong><span style="font-size : 18px; ">  ALL VIDEO </span></strong>
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
                      <th>File</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  foreach ($videoList as $key => $value) { ?>
                       <tr>
                        <td> <?=  $value['serial_num'] ?> </td>
                        <td> 
                          <span style="padding: 5px;color: blue;" onclick="open_videoHelp('<?= $value['id']; ?>')">See Titles</span>
                        </td>

                        <td><a href="faq/videoEdit/<?= $value['id']; ?>"><i class="fa fa-pencil" style="color:#4c8e0c;"></i></a></td>
                        
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

<div class="modal fade" id="open_videoHelp_" role="dialog">
      <div class="modal-dialog" style="margin-right: 1%;margin-top: 5%;">
          <div class="modal-content" style="margin: 45px 100px;">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="close_btn" onclick="pauseVid()">&times;</button>
              </div>
              <div class="modal-body">

                <div class="video_helpsss"> </div>

              </div>
              <div class="modal-footer"> 
              </div>
          </div>

      </div>
  </div>

  <div class="modal fade" id="show_videoHelp" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="close_btn" onclick="pauseVid()">&times;</button>
              </div>
              <div class="modal-body">

                <span id="show_video"></span>

              </div>
              <div class="modal-footer"> 
              </div>
          </div>

      </div>
  </div>


  <script type="text/javascript">
    function open_videoHelp(faqId){

        $.ajax({
            url:'faq/ShowVideo/'+faqId,
            mehtod:'GET',
            success: function(data){
              $('.video_helpsss').html(data)
              $('#open_videoHelp_').modal('show');
            }
          })
        }

      function videoShow(videoLink){
        console.log(videoLink)
        $("#show_video").html('<video id="myVideo" controls preload="auto" width="570" height="300"><source src="'+videoLink+'" type="video/mp4" >');
        $('#show_videoHelp').modal('show');
    }
  </script>

  <script type="text/javascript">
    var vid = document.getElementById("myVideo"); 
    function pauseVid() { 
           vid.pause(); 
         }
  </script>


<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Really want to delete this video</h5>
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
    console.log(argument);
    $('#faqToDel').val(argument);
  }


  /*delete faq icon(from table) click*/
  // $(document).on('click','.faqDeleteIcon', function(){
  //   var faqId = $(this).closest('tr').attr('id');
  //   console.log(faqId);
  //   $('#faqToDel').val(faqId);
  // });

  /*modal delete button click*/
  $(document).on('click','.faqDelBtn', function(){
    var faqId = $('#faqToDel').val();
    $.ajax({
      url:'faq/deleteVideo/'+faqId,
      mehtod:'GET',
      success: function(data){
        alert('Video  deleted successfully');
        location.reload();
      }
    })
  });


</script>
