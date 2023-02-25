<style>
    .video-menu a{
        margin-bottom: 8px;
        text-decoration: underline;
        font-size: 18px;
    }
    .required{
        color: red;
    }
    .required p{
        color:red;
    }
</style>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-2 video-menu">
                <a  href="module_instruction_video/<?php echo $module_id?>">Video Upload</a>
                <a  href="module_instruction_video_list/<?php echo $module_id?>">Video List</a>
            </div>
            <div class="col-md-10">
                 <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h3 class="panel-title text-center" style="line-height: 20px;">
                          <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                            <strong><span style="font-size : 18px; ">  ADD VIDEO </span></strong>
                          </a>
                        </h3>
                      </div>


                      <?php if (!empty( $this->session->flashdata('Failed') )) { ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('Failed'); ?></div>
                      <?php  } ?>

                      <?php if (!empty( $this->session->flashdata('message') )) { ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('message'); ?> </div>
                      <?php  } ?>


                      <form class="form-horizontal" action="save_module_instract_video" method="POST" enctype="multipart/form-data" id="myform_add" onsubmit="return validate()">

                        <input type="hidden" name="module_id" value="<?= $module_id; ?>">

                        <div class="row panel-body">
                            <div class="col-sm-12 text-right">
                              <button type="button" class="btn btn_next" id="" onclick = "location.reload(true)"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                              <button type="submit"  class="btn btn_next" id=""><i class="fa fa-plus" style="padding-right: 5px;"></i>Save</button>
                            </div>
                          </div>

                        <div class="row panel-body">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-5 control-label">Add Multiple videos</label>
                              <div class="col-sm-6">

                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6" style="margin: -14px;">
                            <label for="exampleInputiamges1">How many Videos</label>
                            <div class="select">
                                <input class="form-control" type="number" id="box_qty" onclick="getImageBox(this)">
                                <span id="box_qty_err" style="color: red;"></span>
                            </div>
                          </div>

                          <span id="XXxx"></span>

                        </div>


                      </form>


                    </div>

                  </div>
            </div>
        </div>
    </div>
</div>


<script>

    function getImageBox() {
      
        var qty = $("#box_qty").val();
        common(qty);
    }
    function common(quantity)
    {
      $('#XXxx').html('');

        for (var i = 1; i <= quantity; i++)
        {
            $('#XXxx').append('<tr><td> <input class="form-control" type="file" name="video_file[]" accept=".mp4" required style="margin: 5px 0;" /> </td><td> <input class="form-control" type="text" name = title[] required style="margin: 0 109px;" /> </td></tr>');
        }
    }
</script>

<script>
  function validate() {
    var box_qty = document.forms["myform_add"]["box_qty"].value;

    if (box_qty == "" ) {

      document.getElementById("box_qty_err").innerHTML = "Number can not empty. ";
      return false;
    }

    
  }
  </script>

<!-- <script>
$("#module_video_form").on('submit', function(e) {
        e.preventDefault();
        var name = $('#name').val();
        if(name == '')
        {
            $("#name_error").html("can't empty field");
            return false;
        }else{
             $("#name_error").html("");
        }
        var serial_num = $('#serial_num').val();
        if(serial_num == '')
        {
            $("#serial_num_error").html("can't empty field");
            return false;
        }else{

            $("#serial_num_error").html("");
        }
        var video = $('#video').val();
        if(video == '')
        {
            $("#video_error").html("can't empty field");
            return false;
        }else{

            $("#video_error").html("");
        }
        
        $("#process").show();
        $.ajax({
            type:"POST",
            url: 'save_module_instract_video',
            dataType:'json',
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            beforeSend:function()
             {
              $('#save_video').attr('disabled', 'disabled');
              $('#process').css('display', 'block');
             },
            success:function(data){

                var percentage = 0;

                var timer = setInterval(function(){
                   percentage = percentage + 20;
                   progress_bar_process(percentage, timer,data);
                  }, 1000);
                console.log(data);
                
            }
        });
    });
function printErrorMsg (msg) {

            $.each( msg, function( key, value ) {
                $('#'+key).html(value);
                //$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
function progress_bar_process(percentage, timer,data){

   $('.progress-bar').css('width', percentage + '%');
   if(percentage > 100)
   {
        clearInterval(timer);
        $('#process').css('display', 'none');
        $('.progress-bar').css('width', '0%');
        $('#save').attr('disabled', false);
        if($.isEmptyObject(data.error)){
            $(".required").html('');
            $('#module_video_form')[0].reset();
            alert(data.success);
        }else{

            printErrorMsg(data.error);
        } 
   }
  }
</script> -->