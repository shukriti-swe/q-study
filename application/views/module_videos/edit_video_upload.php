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
                            <strong><span style="font-size : 18px; ">  EDIT VIDEO </span></strong>
                          </a>
                        </h3>
                      </div>


                      <?php if (!empty( $this->session->flashdata('Failed') )) { ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('Failed'); ?></div>
                      <?php  } ?>

                      <?php if (!empty( $this->session->flashdata('message') )) { ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('message'); ?> </div>
                      <?php  } ?>


                      <form class="form-horizontal" id="module_video_form" method="POST" enctype="multipart/form-data">
                          
                        <!-- faq submit form -->  
                        <div class="row panel-body">
                          <div class="col-sm-8">
                            
                            <div class="form-group" id="process" style="display:none;">
                                <div class="progress">
                                   <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="">
                                   </div>
                                </div>
                            </div>

                            <div class="form-group">
                              <label for="name" class="col-sm-3 control-label">Name:</label>
                              <div class="col-sm-9">
                                <?php 
                                  $name = isset($video[0]['name']) ? $video[0]['name'] : '' ;
                                  $module_id = isset($video[0]['module_id']) ? $video[0]['module_id'] : '' ;
                                  $id = isset($video[0]['id']) ? $video[0]['id'] : '' ;
                                  $serial_num = isset($video[0]['serial_num']) ? $video[0]['serial_num'] : '' ;
                                  $video = isset($video[0]['video']) ? $video[0]['video'] : '' ;
                                  
                                ?>
                                  <input type="text" value="<?php echo $name ; ?>" class="form-control" id="name"  placeholder="video name" name="name">
                                  <input type="hidden" name="module_id" value="<?php echo $module_id?>">
                                  <input type="hidden" name="video_id" value="<?php echo $id?>">
                                    <span id="name_error" class="required"></span>
                                    <span id="module_id_error" class="required"></span>
                                    <span id="video_id_error" class="required"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="serial_num" class="col-sm-3 control-label">Serial NO:</label>
                              <div class="col-sm-9">
                                  <input type="number" readonly="readonly" value="<?php echo $serial_num; ?>" class="form-control">
                                  <input type="number" minimum="1" class="form-control"  placeholder="serial number" name="serial_num" id="serial_num">
                                  <span id="serial_num_error" class="required"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="video" class="col-sm-3 control-label">File : </label>
                              <div class="col-sm-9">
                                    <input type="file" name="video" id="video"  accept=".mp4"/>
                                    <span id="video_error" class="required"></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4 text-right">
                            <!-- <button type="button" class="btn btn_next" id="" onclick = "location.reload(true)"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button> -->
                            <button type="submit"  class="btn btn_next" id=""><i class="fa fa-plus" style="padding-right: 5px;" id="save_video"></i>Save</button>
                          </div>
                        </div>
                      </form>


                    </div>

                  </div>
            </div>
        </div>
    </div>
</div>
<script>
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
        $("#process").show();
        $.ajax({
            type:"POST",
            url: 'update_module_instract_video',
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
            alert(data.success);
            location.reload();
        }else{

            printErrorMsg(data.error);
        } 
   }
  }
</script>