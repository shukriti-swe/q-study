<style>
  .serial-label{
    color: #337ab7;
    margin-bottom: 5px;
    display: block;
  }
  #pdf_serial{
    width:50px;
    border-radius: 0px;
  }
  #chapter_serial{
    width:50px;
    border-radius: 0px;
  }
  .stroe-box{
    border:1px solid #ccc;
    padding: 15px;
    min-height: 250px;
  }
  .file-field{
    border: none;
    border-radius: 0px;
    box-shadow: none;
  }
  .person{
    height: 25px;
    align-items: center;
    margin-top: 8px;
    color: #555555;
    text-decoration: underline;
  }
  .title-text{
    box-shadow: none;
    margin-bottom: 5px;
  }
  .title-content-one{

    position: relative;
  }
  .title-content-two{
    
    position: relative;
  }
  .title-content-one .form-control{
    width:100%;
  }
  .title-content-two .form-control{
    width:100%;
  }
  .title-content-one i{
    color: #4c8e0c;
    cursor: pointer;
    position: absolute;
    top: 8px;
    right: -35px;
  }
  .title-content-two i{
    color: #4c8e0c;
    cursor: pointer;
    position: absolute;
    top: 8px;
    right: -35px;
  }
  .color-red{
    color:red;
  }
  .record-img-li{
    padding: 3px 10px;
    border: 1px solid #ccc;
  }
</style>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      $( function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
      } );
    </script>
<form class="form-inline" id="question_store_form" method="post" enctype="multipart/form-data">
  <input type="hidden" name="submit_check" id="submit_check">
<div class="row">
  <div class="col-md-12">
    <div class="search_filter">
       <div class="form-group">
            <label for="exampleInputEmail2">Country</label>
            <div class="select">
              <select class="form-control select-hidden" id="country" name="country">
                <option value="">Select Country</option>
                    <?php foreach ($allCountry as $country) {?>
                    <option value="<?php echo $country['id']?>">
                        <?php echo $country['countryName'];?>
                    </option>
                    <?php }?>
              </select>
              <span id="country_error" class="color-red"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputName2">Grade/Year/Level</label>
              <div class="select">
                <select class="form-control select-hidden" name="grade" id="grade">
                  <option value="">Select Grade/Year/Level</option>
                    <?php $grades = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; ?>
                    <?php foreach ($grades as $stGrade) { ?>
                        <?php $sel = isset($_SESSION['modInfo']['studentGrade'])&&($stGrade==$_SESSION['modInfo']['studentGrade']) ? 'selected' : '';?>
                    <option value="<?php echo $stGrade; ?>" <?php echo $sel; ?>>
                        <?php echo $stGrade; ?>
                    </option>
                    <?php } ?>
                  <option value="13">Upper Level</option>
                </select>
                <span id="grade_error" class="color-red"></span>
              </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail2">Subject New</label>
            <div class="select">
              <select class="form-control select-hidden" id="subject" name="subject">
                <option value="">Select Subject</option>
                    <?php foreach ($all_subject as $subject) {?>
                        <?php $sel = isset($_SESSION['modInfo']['subject'])&&($subject['id']==$_SESSION['modInfo']['subject']) ? 'selected' : '';?>
                    <option value="<?php echo $subject['id']?>" <?php echo $sel; ?>>
                        <?php echo $subject['subject_name'];?>
                    </option>
                    <?php }?>
              </select>
              <span id="subject_error" class="color-red"></span>
            </div>
          </div>

           <!--  <div class="form-group">
              <label for="exampleInputEmail2">Chapter New</label>
              <div class="select">
                <select class="form-control select-hidden" name="chapter" id="chapter">
                  <option value="">Select Chapter</option>
                    <?php if (isset($_SESSION['modInfo']['chapter'])) : ?>
                        <?php echo $_SESSION['modInfo']['chapter']; ?>
                    <?php endif; ?>
                </select>
                <span id="chapter_error" class="color-red"></span>
              </div>
            </div> -->
            <div class="form-group"  style="">
              <button type="submit" disabled="disabled" class="btn btn-primary" id="store_save_btn" style="background: #fff !important;color: #337ab7 !important;margin-top:20px !important">Save</button>
            </div>
            <div class="form-group"  style="">
              <button type="submit" id="store_search_btn" class="btn btn-primary" style="margin-top:20px !important">search</button>
            </div>
            <div class="form-group"  style="">
              <a href="question-store" class="btn btn-primary" style="margin-top:20px !important">Add</a>
            </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-10 stroe-box">
    <div class="row"  >
        <div class="progress" id="progress" style="display: none;">
          <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="">
          </div>
        </div>
    </div>
    <div class="table-responsive">
                <table class="table table-bordered" id="module_setting">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Chapter</th>
                            <th>Tutor</th>
                            <th>Student</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                       
                    </tbody>
                </table>
    </div>
  </div>
  <div class="col-md-1">
  </div>
</div>
</form>
<!-- Modal -->
<div class="modal fade edit_store_modal" id="edit_store_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 60%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_store_form" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-12">
              <div class="row"  >
                  <div class="progress" id="progress" style="display: none;">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="">
                    </div>
                  </div>
              </div>
                <div class="row" style="padding-top: 15px;">
                  <div class="col-md-2">
                    <a class="person">Tutor</a>
                    <a class="person">Student</a>
                  </div>
                  <div class="col-md-4">
                    <input type="file"   class="form-control file-field" name="tutor_file" id="tutor_file" accept="application/pdf">
                    <span class="color-red" id="tutor_file_error"></span>
                    <input type="file"  class="form-control file-field" name="student_file" id="student_file" accept="application/pdf">
                    <span class="color-red" id="student_file_error"></span>
                  </div>
                  <div class="col-md-5">
                    <div class="title-content-one">
                      <input type="text" required="required" autocomplete="off" class="form-control title-text" id="tutor_title" name="tutor_title"> 
                    <!--   <i class="fa fa-times" onclick="" ></i> -->
                       <span class="color-red" id="tutor_title_error"></span>
                    </div>
                    <div class="title-content-two">
                      <input type="text" autocomplete="off"  required="required" class="form-control title-text" id="student_title" name="student_title"> 
                      <input type="hidden" name="store_id" id="store_id" value="">
                      <!-- <i class="fa fa-times" onclick="" ></i> -->
                      <span class="color-red" id="student_title_error"></span>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div style="text-align: right;">
            <button type="submit" class="btn btn-primary" id="update_btn">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

  $("#store_save_btn").click(function(){
    
    $('#submit_check').val(1);
  });
  $("#store_search_btn").click(function(){
    
    $('#submit_check').val(0);
  });
  // $(document).on('change', '#subject', function(){
       
  //       var subject = $(this).val();
  //       $.ajax({
  //         url:'Tutor/get_chapter_name',
  //         method:'post',
  //         data:{'subject_id':subject},
  //         success: function(response){
  //           $('#chapter').html(response);
  //         }
  //       });
  //     });

  $("#store_search_btn").click(function(e){
    e.preventDefault();
    var country = $('#country').val();
          if(country == '')
          {
              $("#country_error").html("Grade field is required");
              return false;
          }else{
               $("#country_error").html("");
          }
           var grade = $('#grade').val();
          if(grade == '')
          {
              $("#grade_error").html("Grade field is required");
              return false;
          }else{
               $("#grade_error").html("");
          }

          var subject = $('#subject').val();
          if(subject == '')
          {
              $("#subject_error").html("Subject field is required");
              return false;
          }else{
               $("#subject_error").html("");
          }
          $("#progress").show();
          $.ajax({
            type:"POST",
            url: 'search_question_store_info',
            dataType:'json',
            data:{country:country,grade:grade,subject:subject},
            beforeSend:function()
             {
              $('#store_save_btn').attr('disabled', 'disabled');
              $('#progress').css('display', 'block');
             },
            success:function(data){

                var percentage = 0;

                var timer = setInterval(function(){
                   percentage = percentage + 20;
                   progress_bar_process(percentage, timer,data);
                  }, 1000); 
            }
        });

  });
  function progress_bar_process(percentage, timer,data){

   $('.progress-bar').css('width', percentage + '%');
   if(percentage > 100)
   {
        clearInterval(timer);
        $('#process').css('display', 'none');
        $('.progress-bar').css('width', '0%');
        $('#store_save_btn').attr('disabled', false);
        if($.isEmptyObject(data.error)){
          $("#progress").hide();
            $("#sortable").html(data.success);
        }else{

            printErrorMsg(data.error);
        } 
   }
  }
  function printErrorMsg (msg) {

            $.each( msg, function( key, value ) {
                $('#'+key).html(value);
                
            });
        }

$("#store_save_btn").click(function(e){
  e.preventDefault();
  var order_number =  $('.order_number').val();
  if(order_number != '')
    {
      $("#progress").show();
      var form = $("#question_store_form");
          $.ajax({
            type:"POST",
            url: 'order_question_store',
            dataType:'json',
            data:form.serialize(),
            beforeSend:function()
             {
              $('#store_save_btn').attr('disabled', 'disabled');
              $('#progress').css('display', 'block');
             },
            success:function(data){

                var percentage = 0;

                var timer = setInterval(function(){
                   percentage = percentage + 20;
                   progress_bar_process(percentage, timer,data);
                  }, 1000);  
            }
        });
    }else{
      alert('No data fund!');
    }

});
    $( "body" ).delegate(".store_edit","click", function(e) {
      e.preventDefault();
       var store_id = $(this).attr('store_id');
       $("#edit_store_form #store_id").val(store_id);
       console.log(store_id);
        $.ajax({
            type:"POST",
            url: 'edit_question_store',
            dataType:'json',
            data:{store_id:store_id},
            success:function(data){
              $("#edit_store_form #tutor_title").val(data.tutor_title);
              $("#edit_store_form #student_title").val(data.student_title);
              $(".edit_store_modal").modal('show');
            }
        });
       
    });

$("#edit_store_form").on('submit', function(e) {
  e.preventDefault();
    var store_id = $('#store_id').val();
    if(store_id == '')
      {
       alert('store id is missing!');
       $(".edit_store_modal").modal('hide');
       return false;
      }
      var tutor_file = $('#tutor_file').val();
      var student_file = $('#student_file').val();
    if(tutor_file == '' && student_file == '')
      {
        $("#tutor_file_error").html("Provide Tutor or Student file");
        return false;
      }else{
        $("#tutor_file_error").html("");
      }

        $("#edit_store_form #progress").show();
        $.ajax({
            type:"POST",
            url: 'update_question_store_data',
            dataType:'json',
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            beforeSend:function()
             {
              $('#update_btn').attr('disabled','disabled');
              $('#edit_store_form #progress').css('display', 'block');
             },
            success:function(data){
              $('#update_btn').attr('disabled',false);
              $('#edit_store_form #progress').css('display', 'none');
              alert(data.success);
              $(".edit_store_modal").modal('hide');
              console.log(data);
            }
        });
  });

 $(function(){
        $("#tutor_file").on('change', function(event) {
            var file = event.target.files[0];
            console.log(file.name);
            if(!file.type.match('application/pdf')) {
                alert("only PDF file");
                $(this).val('');
                $("#tutor_title").val('');
                return;
            }else{
              $("#tutor_title").val(file.name);
            }
        });
    });
   $(function(){
        $("#student_file").on('change', function(event) {
            var file = event.target.files[0];
            console.log(file.name);
            if(!file.type.match('application/pdf')) {
                alert("only PDF file");
                $(this).val('');
                $("#student_title").val('');
                return;
            }else{
              $("#student_title").val(file.name);
            }
        });
    });
   $('#edit_store_modal').on('hidden.bs.modal', function (e) {
      $('#update_btn').attr('disabled',false);
      $('#edit_store_form #progress').css('display', 'none');
    });
   function deleteStore(id)
    {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this store info!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "post",
                            url: "delete-store",
                            data: {id:id},
                            dataType: "json",
                            cache: false,
                            success:
                                function (data) {
                                    if(data==1){
                                        swal("Store deleted successfully!", {
                                            icon: "success",
                                        }).then(function(){
                                            location.reload();
                                        });
                                    }
                                }
                        });

                    } else {
                        swal("The store is not deleted!");
                    }
                });
    }
</script>