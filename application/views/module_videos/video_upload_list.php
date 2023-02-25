<style>

  .videoList {
      padding: 0 50px;
  }

  .titleList {
    margin: 12px 47px;
}

  label {
    font-size: 13px;
  }

  .user_list {
    border-color: #2F91BA;
  }

  .panel-default > .panel-heading{
    background-color: #FCF8E3 !important;
  }
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
    .table td{
      border:2px solid #f68d20 !important;
    }
</style>

<div class="" style="margin-left: 15px;">
  <div class="row">
    <div class="col-md-2">
                
    </div>
    <div class="col-md-10 user_list">
      <div class="row">
        <div class="col-md-2 video-menu">

          <a  href="module_instruction_video/<?php echo $module_id?>">Video Upload</a>
          <a  href="module_instruction_video_list/<?php echo $module_id?>">Video List</a>
        </div>
        <div class="col-md-10">
          <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title text-center" style="line-height: 22px;">
                  <a class="allFaq" > 
                    <strong><span style="font-size : 18px; ">  All List </span></strong>

                    <form class="form-horizontal" action="update_module_instract_video" method="POST" enctype="multipart/form-data" id="myform_add" onsubmit="return validate()">
                        <input type="hidden" name="module_id" value="<?= $module_id; ?>">

                        <div class="row panel-body">
                            <div class="col-sm-12 text-right">
                              <button type="button" class="btn btn-danger" id="" onclick ="deleteAll('<?= $module_id; ?>')"><i class="fa fa-times" style="padding-right: 5px;"></i>Remove</button>
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
                            <?php if (isset($video)) { ?>
                            <label for="exampleInputiamges1">How many Videos</label>
                            <div class="select">
                                <input class="form-control" type="number" id="box_qty" onclick="getImageBoxsss(this)">
                            </div>
                          <?php } ?>
                          </div>
                        </div>

                        <span id="XXxx"></span>

                      </form>


                  </a>
                </h4>
              </div>
              <div class="row panel-body faqsTable">
                <div class="sign_up_menu">
                  
                  <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Name</th>
                            <th scope="col">Video</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <!-- //f68d20  -->
                        <tbody>
                           <?php
                           if (isset($video)) {
                            foreach ($video as $key=> $video) : ?>
                          <tr>
                            <th scope="row"><?php echo $key+1; ?></th>
                            <th scope="row"><?php echo $title[$key]; ?></th>
                            <th scope="row">
                              <video controls muted loop style="height:150px;">
                                <source src="<?php echo base_url('/')?><?php echo $video; ?>" type="video/mp4">
                              </video>
                            </th>
                            <th>
                              <a onclick="EditVideo('<?php echo $module_id; ?>' , '<?= $key; ?>' , '<?= $video; ?>' , '<?= $title[$key] ?>')" ><i class="fa fa-pencil" style="color:#4c8e0c;"></i></a>
                              <i class="fa fa-times" onclick="deleteVideo('<?php echo $module_id; ?>' , '<?= $key; ?>' )" style="color:#4c8e0c; cursor: pointer;"></i>
                            </th>
                          </tr>
                          <?php endforeach; } ?>
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
  </div>
</div>

<div class="modal fade" id="PicList" role="dialog">
    <div class="modal-dialog ui-draggable" style=" width: 48%;">

        <div class="modal-content" style="width: 100%;height: 64%;">
            <div class="modal-header ui-draggable-handle">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Update data</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                  <form enctype="multipart/form-data" method="post" id="update_instruction">
                    
                    <div class="videoList"></div>
                    <div class="titleList"></div>
                    <div class="hiddenList"></div>
                    <input type="file" class="form-control" id="video" name="video" placeholder="Upload Video" accept="video/mp4">

                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn_blue"  >Update</button>   
                <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>   
            </div>

            </form>
        </div>

    </div>
</div>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
       var Serial_num_;
       var module_id_;
       function EditVideo(module_id , Serial_num , video , titles){

        Serial_num_ = Serial_num;
        module_id_  = module_id;

        $(".videoList").html('<video controls muted loop style="height:150px;"><source src="'+video+'" type="video/mp4"></video>');
        $(".titleList").html(' <input class="form-control" name="title" type="text" id="titles" value="'+titles+'" /> ');

        $(".hiddenList").html(' <input name="module_id" type="hidden"  value="'+module_id_+'" /> <input name="Serial_num" type="hidden" id="titles" value="'+Serial_num_+'" />');
        $('#PicList').modal('show');

         }

         $("#update_instruction").on('submit', function(e){
          e.preventDefault();

          $.ajax({
              url: "module/update_instruction",
              type: "POST",
              data: new FormData(this),
              processData:false,
              contentType:false,
              cache:false,

              success: function (response) {
                if (response == 1) {
                  alert("Updated successfully");
                  location.reload();
                }
              }
            });


         });
    </script>

    <script>
        function deleteVideo(module_id , Serial_num){
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Video info!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "post",
                            url: "delete_module_instruction_video",
                            data: {module_id:module_id, Serial_num:Serial_num},
                            dataType: "html",
                            cache: false,
                            success:
                                function (data) {
                                    if(data==1){
                                        swal("Video deleted successfully!", {
                                            icon: "success",
                                        }).then(function(){
                                            location.reload();
                                        });
                                    }
                                }
                        });

                    } else {
                        swal("The Video is not deleted!");
                    }
                });
        }

        function deleteAll(module_id){
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Video info!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "post",
                            url: "module/instract_videoDelete",
                            data: {module_id:module_id},
                            dataType: "html",
                            cache: false,
                            success:
                                function (data) {
                                    if(data==1){
                                        swal("Video deleted successfully!", {
                                            icon: "success",
                                        }).then(function(){
                                            location.reload();
                                        });
                                    }
                                }
                        });

                    } else {
                        swal("The Video is not deleted!");
                    }
                });
        }
    </script>

    <script>

    function getImageBoxsss() {
      
        var qty = $("#box_qty").val();
        common(qty);
    }
    function common(quantity)
    {
      $('#XXxx').html('');

        for (var i = 1; i <= quantity; i++)
        {
            $('#XXxx').append('<tr><td> <input class="form-control" type="file" name="video_file[]" accept=".mp4" required style="margin: 5px 0;" /> </td><td> <input class="form-control" type="text" name = title[] required style="margin: 0 67px;" /> </td></tr>');
        }
    }
</script>
