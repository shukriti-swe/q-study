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
  .question-list-header{
    color: #888;
    text-decoration: underline;
    margin-right: 10px;
 }
</style>
<div class="row" style="margin-bottom: 20px;">
  <div class="col-md-12">
    <a  class="question-list-header text-center" href="tutor/store_subject_chapter">Delete Subject & Chapter</a>
  </div>
  </div>
<form class="form-inline" id="question_store_form" method="post" enctype="multipart/form-data">
  <input type="hidden" name="submit_check" id="submit_check">
<div class="row">
  <div class="col-md-12">
    <div class="search_filter">
       <div class="form-group">
          <span id="amount_error" class="color-red"></span>
        <div class="select-amount" style="padding-top: 20px;">
            <span style="font-size: 23px;color: #b9a6cb;">$</span> <input class="form-control type="number" name="amount" id="amount" style="width: 58px;" value="">
        </div>
      </div>
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
            <label for="exampleInputEmail2">Subject <span id="add_new_subject" style="font-weight: bold;color: #337ab7;cursor: pointer;">New</span></label>
            <div class="select">
              <select class="form-control select-hidden" style="min-width: 150px;" id="subject" name="subject">
                <option value="">Select Subject</option>
                    <?php foreach ($all_subject as $subject) {?>
                    <option value="<?php echo $subject['id']?>" >
                        <?php echo $subject['subject_name'];?>
                    </option>
                    <?php }?>
              </select>
              <span id="subject_error" class="color-red"></span>
            </div>
          </div>

            <div class="form-group">
              <label for="exampleInputEmail2">Chapter <span id="add_new_chapter" style="font-weight: bold;color: #337ab7;cursor: pointer;">New</span></label>
              <div class="select">
                <select class="form-control select-hidden" name="chapter" id="chapter">
                  <option value="">Select Chapter</option>
                    <?php if (isset($_SESSION['modInfo']['chapter'])) : ?>
                        <?php echo $_SESSION['modInfo']['chapter']; ?>
                    <?php endif; ?>
                </select>
                <span id="chapter_error" class="color-red"></span>
              </div>
            </div>
            <div class="form-group"  style="">
              <button type="submit" class="btn btn-primary" id="store_save_btn" style="background: #fff !important;color: #337ab7 !important;margin-top:20px !important">Save</button>
            </div>
            <div class="form-group"  style="">
              <!-- <button type="submit" id="store_search_btn" class="btn btn-primary" style="margin-top:20px !important">search</button> -->
              <a href="tutor/search_store_view" class="btn btn-primary" style="margin-top:20px !important">search</a>
            </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-2">
  </div>
  <div class="col-md-8 stroe-box">
    <div class="row"  >
        <div class="progress" id="progress" style="display: none;">
          <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="">
          </div>
        </div>
    </div>
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label class="serial-label" for="pdf_serial">PDF Serial</label>
            <input type="number" required="required" id="pdf_serial" name="pdf_order" class="form-control">
            <span class="color-red" id="pdf_serial_error"></span>
          </div>
        </div>
        <div class="col-md-3">
          <!-- <div class="form-group">
            <label class="serial-label" for="chapter_serial">Chapter Serial</label>
            <input type="number" id="chapter_serial" class="form-control">
          </div> -->
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
            <!-- <i class="fa fa-times" onclick="" ></i> -->
            <span class="color-red" id="student_title_error"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="form-check  col-md-2">
          <input class="form-check-input" type="radio" name="questionStoreStatus" id="questionStoreStatus1" value="free" checked>
          <label class="form-check-label" for="questionStoreStatus1">
            Free
          </label>
        </div>
        <div class="form-check col-md-2">
          <input class="form-check-input" type="radio" name="questionStoreStatus" id="questionStoreStatus2" value="paid">
          <label class="form-check-label" for="questionStoreStatus2">
            Paid
          </label>
        </div>
      </div>
  </div>
  <div class="col-md-2">
  </div>
</div>
</form>
<!-- Modal -->
<div class="modal fade add_subject_modal" id="add_subject_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:350px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form id="add_subject_form">
          <div class="form-group">
            <label class="serial-label" for="new_subject">New Subject</label>
            <input type="text" required="required" id="new_subject" name="new_subject" class="form-control">
            <span class="color-red" id="new_subject_error"></span>
          </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" id="add_subject_btn">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade add_chapter_modal" id="add_chapter_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:350px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form id="add_chapter_form">
          <div class="form-group">
            <label class="serial-label" for="new_chapter">New Chapter</label>
            <input type="text" required="required" id="new_chapter" name="new_chapter" class="form-control">
            <span class="color-red" id="new_chapter_error"></span>
          </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" id="add_chapter_btn">Save</button>
      </div>
    </div>
  </div>
</div>
<script>

  $("#add_new_subject").click(function(e){
    e.preventDefault();
    $(".add_subject_modal").modal('show');
  });
  $("#add_new_chapter").click(function(e){
    e.preventDefault();
    $(".add_chapter_modal").modal('show');
  });
  $("#add_chapter_btn").click(function(e){
    e.preventDefault();
    var subject = $("#subject").val();
    if(subject == '')
    {
      $("#new_chapter_error").html('Subject is required');
      return false;
    }else{

      $("#new_chapter_error").html();
    }
    var new_chapter = $("#new_chapter").val();
    if(new_chapter == '')
    {
      $("#new_chapter_error").html('Chapter is required');
      return false;
    }else{

      $("#new_chapter_error").html();
    }
    var form = $("#add_chapter_form");
     $.ajax({
            type:"POST",
            url: 'tutor/save_store_chapter',
            dataType:'json',
            data:{subject:subject,new_chapter:new_chapter},
            beforeSend:function()
             {
              $('#add_chapter_btn').attr('disabled', 'disabled');
             },
            success:function(data){
              if(data.success == 1)
              {
                $("#chapter").html(data.html);
                $('#add_chapter_form')[0].reset();
                $('#add_chapter_btn').attr('disabled',false);
                $(".add_chapter_modal").modal('hide');
                alert('Successfully added');
                
              }else{
                $("#new_chapter_error").html(data.msg);
              }
            }
        });
  });
  $("#add_subject_btn").click(function(e){
    e.preventDefault();
    var new_subject = $("#new_subject").val();
    if(new_subject == '')
    {
      $("#new_subject_error").html('Subject is required');
      return false;
    }else{

      $("#new_subject_error").html();
    }
    var form = $("#add_subject_form");
     $.ajax({
            type:"POST",
            url: 'tutor/save_store_subject',
            dataType:'json',
            data:form.serialize(),
            beforeSend:function()
             {
              $('#add_subject_btn').attr('disabled', 'disabled');
             },
            success:function(data){
              if(data.success == 1)
              {
                $("#subject").html(data.html);
                $('#add_subject_form')[0].reset();
                $('#add_subject_btn').attr('disabled',false);
                $(".add_subject_modal").modal('hide');
                alert('Successfully added');
                
              }else{
                $("#new_subject_error").html('Subject is required');
              }
            }
        });
  });
  $("#store_save_btn").click(function(){
    
    $('#submit_check').val(1);
  });
  $("#store_search_btn").click(function(){
    
    $('#submit_check').val(0);
  });
  $("#question_store_form").on('submit', function(e) {
        e.preventDefault();
        var submit_check = $('#submit_check').val();
         console.log(submit_check);
        if(submit_check == 1)
        {
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
          var amount = $('#amount').val();
          if(amount == '' || amount == 0)
          {
              $("#amount_error").html("Please input valid amount");
              return false;
          }else{
               $("#amount_error").html("");
          }  
          var chapter = $('#chapter').val();
          if(chapter == '')
          {
              $("#chapter_error").html("Chapter field is required");
              return false;
          }else{
               $("#chapter_error").html("");
          }
          var tutor_file = $('#tutor_file').val();
          if(tutor_file == '')
          {
              $("#tutor_file_error").html("Tutor field is required");
              return false;
          }else{
               $("#tutor_file_error").html("");
          }
          var student_file = $('#student_file').val();
          if(student_file == '')
          {
              $("#student_file_error").html("Student field is required");
              return false;
          }else{

              $("#student_file_error").html("");
          }

          $("#progress").show();
          $.ajax({
            type:"POST",
            url: 'save_question_store_data',
            dataType:'json',
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
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
                console.log(data);
                
            }
        });
        }
       
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
            $('#question_store_form')[0].reset();
            alert(data.success);
            location.reload();
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
  $(document).on('change', '#subject', function(){
        var country = $("#country").val();
        var grade   = $("#grade").val();
        var subject = $(this).val();

        if(country == '')
          {
             alert("Select Country");
              return false;
          }
          if(grade == '')
          {
              alert("Select grade");
              return false;
          }
          
        $.ajax({
          url:'Tutor/get_store_subject_amount',
          method:'post',
          data:{'subject_id':subject},
          success: function(response){
            console.log(response);
            $('#amount').val(response);
          }
        });
        
        $.ajax({
          url:'Tutor/get_store_chapter_name',
          method:'post',
          data:{'subject_id':subject},
          success: function(response){
            $('#chapter').html(response);
          }
        });

        $.ajax({
          url:'Tutor/get_pdf_serial',
          method:'post',
          data:{country:country,grade:grade,'subject_id':subject},
          success: function(response){
            $('#pdf_serial').val(response);
          }
        })
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
</script>