<style>
  .ss_q_btn {
    margin-top: 21px;
  }

  .checkbox,.form-group{
    display: block !important;
    margin-bottom: 10px !important;
  }

  .form-control {
    width: 100% !important;
  }

  .createQuesLabel{
    margin-top: 5px;
  }

  .select2-container .select2-selection--single {
    height: 33px;
    margin-top: 6px;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 30px;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px;
  }
  .question_tutorial:hover{
        background: transparent !important;
    }
    .sss_ans_set{
        position: absolute;bottom: -158px;width: 30%;margin-top: 16px;
    }
</style>

    <div class="col-md-12 upperbutton" style="text-align: center;margin-bottom: 10px;">
      <a href="create-module" style="font-size:22px;color:#8e9295;text-decoration:underline;display: inline-block;">Module Inbox</a>
      <a href="details-module" style="font-size:22px;color:#8e9295;text-decoration:underline;display: inline-block;margin-left:10px;">Question Inbox</a>
    </div>

<div id="add_ch_success" style="text-align:center;"></div>

<form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data">
  <input type="hidden" id="question_item" name="questionType" value="<?php echo $question_item; ?>">
  <input type="hidden" name="attached_subject" id="get_subject_value">
  <input type="hidden" name="chapter" id="get_chapter_value">
  <input type="hidden" id="dup_ques_chapter">

  <div class="row" >
    <div class="col-sm-1"></div>
    <div class="col-sm-11 ">
      <div class="ss_question_add_top">

        

        <div class="form-group" style="float: left;margin-right: 10px;">
          <label for="exampleInputName2">Grade/Year/Level</label>
          <select class="form-control createQuesLabel" name="studentgrade">
            <option value="">Select Grade/Year/Level</option>
            <?php $grades = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]; ?>
            <?php foreach ($grades as $grade) { ?>
              <option value="<?php echo $grade ?>">
                <?php echo $grade; ?>
              </option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group" style="float: left;margin-right: 10px;">
          <label>Subject 
            <span data-toggle="modal" data-target="#add_subject"><img src="assets/images/icon_new.png"> New</span> 
          </label>
          
          <select class="form-control createQuesLabel subject select2" name="subject" id="subject" onchange="getChapter(this)">
            <option value="">Select Subject</option>
            <?php foreach ($all_subject as $subject) { ?>
              <option class="option" value="<?php echo $subject['subject_id'] ?>">
                <?php echo $subject['subject_name']; ?>
              </option>
            <?php } ?>
          </select>
          
        </div>

        <div class="form-group" style="float: left;margin-right: 10px;">
          <label>Chapter <span id="get_subject"><img src="assets/images/icon_new.png"> New</span></label>
          <i class="fa fa-clone module_chapter_copy" aria-hidden="true" style="color:#ffa500;"></i>
          <i class="fa fa-clipboard module_chapter_paste" aria-hidden="true" style="color:#ffa500;"></i>
          <select class="form-control createQuesLabel select2" name="chapter" id="subject_chapter">
            <option value="">Select Chapter</option>
          </select>
        </div>
        
                
        <div class="form-group" style="float: left;margin-right: 10px;">
          <label>Country</label>
          <select class="form-control createQuesLabel select2" name="country" id="quesCountry">
            <option value="">Select Country</option>
            <?php foreach ($allCountry as $country) : ?>
                <?php $sel = strlen($selCountry)&&($country['id']==$selCountry) ? 'selected' : ''; ?>
              <option value="<?php echo $country['id'] ?>" <?php echo $sel; ?>><?php echo $country['countryName'] ?></option>
            <?php endforeach ?>  
          </select>
        </div>


        <?php if (!empty($for_disable_button)) { ?>
          <a disabled class="ss_q_btn btn btn_red pull-left ">
          Question setting
          </a>
        <?php }else{ ?>
          <a class="ss_q_btn btn btn_red pull-left " onclick="open_question_setting()">
          Question setting
          </a>
        <?php } ?>
        
        <input type="submit" name="submit" class="btn btn-danger ss_q_btn " value="Save"/> 

        <a class="ss_q_btn btn pull-left " href="#"><i class="fa fa-remove" aria-hidden="true"></i> Cancel</a>
        
        <a class="ss_q_btn btn pull-left " href="" id="preview_btn" style="display: none;">
          <i class="fa fa-file-o" aria-hidden="true"></i> Preview
        </a>
               <!-- <?php if ($question_item == 4) {?>
              <a class="btn btn-danger ss_q_btn question_tutorial" title="You can click when edit a question." href="#" disabled="disabled" style="text-decoration: underline;font-size: medium; font-weight: 600;">

                  <img src="<?php echo base_url('/')?>assets/images/question_tutorial_icon.png" width="46">
              </a>
          <?php }?> -->

          <?php if ($question_item == 4) {?>
            <a class="btn btn-danger ss_q_btn question_tutorial pull-left" style="text-decoration: underline;border: none;font-size: medium; font-weight: 600;">
                Tutorial Image <div class="uploadsMsg_"> </div>
            </a>
            
        <?php }?>
      </div>
      <p id="error_msg" style="color:red;text-align: center;"></p>

    </div>

  </div>
  <div class="row">
    <div class="ss_question_add">
     <div class="ss_s_b_main" style="min-height: 100vh">

        <?php echo $question_box; ?>
        
        
      <div class="col-sm-4">
       <div class="panel-group ss_edit_q" id="raccordion" role="tablist" aria-multiselectable="true" style="display: none;">
        <div class="panel panel-default">
         <div class="panel-heading" role="tab" id="headingOne" style="padding: 0;">
          <h4 class="panel-title">
           <a> 
            <label class="form-check-label" for="question_time">Question Time</label> 
            <input type="checkbox" id="question_time" name="question_time">  
            Calculator Required <input type="checkbox" name="isCalculator" value="1"> 
            <!-- Score <input type="checkbox" name=""> -->
            <?php if ($this->session->userdata('userType') == 7) : ?>
              <strong style="text-decoration: underline; cursor:pointer;" data-toggle="modal" data-target="#ss_instruction_model">Instruction</strong>
              <strong style="text-decoration: underline; cursor:pointer;" data-toggle="modal" data-target="#ss_video_model">Video</strong>
            <?php endif; ?>
          </a>
        </h4>
      </div>

      <div id="collapsethree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

        <div class="panel-body">
         <div class=" ss_module_result">
          <p>Module Name:</p>
          <div class="table-responsive">
           <table class="table table-bordered">
            <thead>    
             <tr>
              <th></th>
              <th>SL</th>
              <th>Mark</th>
              <!--<th>Obtained</th>-->
              <th>Description / Video </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td> </td>
              <td>1</td>
              <input type="hidden" class="form-control" id="marks_value" name="questionMarks" value="">
              <td onclick="setMark()" class="inner" id="marks">
                <img src="assets/images/icon_mark.png" id="mark_icon">
              </td>
              <!--<td>5.0</td>-->
              <td style="text-align: center;">
                <a data-toggle="modal" data-target="#ss_description_model" class="text-center" style="display: inline-block;">
                  <img src="assets/images/icon_details.png">
                </a>
              
                <a data-toggle="modal" data-target="#ss_video_model" class="text-center" style="display: inline-block;">
                  <img src="/assets/ckeditor/plugins/svideo/icons/svideo.png">
                </a>

              </td>
            </tr>
          </tbody>
        </table>

      </div>
      <!-- Modal -->
      <div class="modal fade ss_modal ew_ss_modal" id="ss_description_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
       <div class="modal-dialog" role="document">
        <div class="modal-content">
         <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
        </div>
        <div class="modal-body">
          <textarea class="form-control" name="questionDescription"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Start Instruction Modal -->
  <div class="modal fade ss_modal ew_ss_modal" id="ss_instruction_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"> Question Instruction </h4>
        </div>
        <div class="modal-body">
          <textarea class="form-control instruction" name="question_instruction"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Instruction Modal -->
<!-- Start video Modal -->
  <div class="modal fade ss_modal ew_ss_modal" id="ss_video_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"> Question Video </h4>
        </div>
        <div class="modal-body">
          <textarea class="form-control question_video" name="question_video"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Instruction Modal -->
  <p><strong> Time To Answer:</strong></p>
  <!--<form class="form-inline ss_common_form" id="set_time" style="display: none">-->
    <div class="form-inline" id="set_time" style="display: none">
     <div class="form-group" style="display: inline-block !important;">
      <select class="form-control" name="hour">
       <option>HH</option>
        <?php for ($i = 0; $i < 24; $i++) { ?>
        <option>
            <?php
            $value = $i;
            if ($i < 24) {
                echo str_pad($i, 2, "0", STR_PAD_LEFT);
            }
            ?>
        </option>
        <?php } ?>
    </select>
  </div>
  <div class="form-group" style="display: inline-block !important;">
    <select class="form-control" name="minute">
     <option>MM</option>
        <?php for ($i = 0; $i < 60; $i++) { ?>
      <option>
            <?php
            if ($i < 60) {
                echo str_pad($i, 2, "0", STR_PAD_LEFT);
            }
            ?>
      </option>
        <?php } ?>
  </select>
</div>
<div class="form-group" style="display: inline-block !important;">
  <select class="form-control" name="second">
    <option>SS</option>
    <?php for ($i = 0; $i < 60; $i++) { ?>
     <option>
        <?php
        if ($i < 60) {
            echo str_pad($i, 2, "0", STR_PAD_LEFT);
        }
        ?>
    </option>
    <?php } ?>

</select>
</div>
</div>

<br/>

</div>
</div>
</div>
</div>
</div>
</div>

<?php if ($question_item == 11) {?>
  <div class="col-sm-12">
    <div class="row htm_r" style="margin: 10px 0px;">


    </div>

    <div class="col-sm-2"></div>
    <div class="skip_box col-sm-4">
      <div class="table-responsive">
        <table class="dynamic_table_skpi table table-bordered">
          <tbody class="dynamic_table_skpi_tbody">

          </tbody>
        </table>

        <!-- may be its a draggable modal -->
        <div id="skiping_question_answer" style="display:none">
          <input type="text" name="set_skip_value" class="input-box form-control rs_set_skipValue">
        </div>
      </div>

    </div>
    <div class="col-sm-4">
      <div class="table-responsive">
        <table class="dynamic_table_dividend table table-bordered">
          <tbody class="dynamic_table_dividend_tbody">

          </tbody>
        </table>
      </div>
    </div>
    <div class="col-sm-2 quotient_block">

    </div>
  </div>
<?php }?>

</div>
</div>
</div>


<!--Set Question Solution on jquery ui-->
<div id="dialog">
  <textarea  id="setSolution" style="display:none;"></textarea>
</div>
<!-- <div id="dialog2">
  <textarea  id="setSolution2" style="display:none;"></textarea>
  <input type="text" id="setSolution2" style="display:none;">
</div> -->
<input type="hidden" name="question_solution" id="setSolutionHidden" value="">


<!--Set Question Solution modal-->
<!--   <div class="modal fade ss_modal" id="set_solution" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="max-width: 400px;">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">Solution</h4>
      </div>
      <div class="modal-body row">
        <textarea class="mytextarea" name="question_solution"></textarea>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div> -->


</form>



<!--Set Question Marks-->
<div class="modal fade ss_modal" id="set_marks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <form id="marksValue">
          <div class="row">
            <div class="col-xs-4 sh_input">
              <!-- <input type="number" class="form-control" name="first_digit"> -->
              <input type="hidden" class="form-control" name="first_digit" value="0">
            </div>
            <div class="col-xs-4 sh_input">
              <input type="number" class="form-control" name="second_digit">
            </div>
            <div class="col-xs-4">
              <input type="number" class="form-control" name="first_fraction_digit">
              <input type="number" class="form-control" name="second_fraction_digit">
            </div>
          </div>
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" onclick="markData()">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade ss_modal" id="ss_sucess_mess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <img src="assets/images/icon_info.png" class="pull-left"> <span class="ss_extar_top20">Save Sucessfully</span> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" id="save_success_button" data-dismiss="modal">Ok</button>
        <a style="display:none;" class="btn btn_blue" id="save_success_button_with_url">Ok</a>
      </div>
    </div>
  </div>
</div>

<!--Add Chapter Modal-->

<div class="modal fade ss_modal" id="add_chapter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add Chapter</h4>
      </div>
      <div id="chapter_error"></div>
      
      <div class="modal-body">
        <form class="" id="add_subject_wise_chapter">

          <div class="form-group">
            <label for="attached_subject"></label>
            <input type="hidden" class="form-control" name="attached_subject" id="attached_subject">
          </div>
          <div class="form-group">
            <label for="chapter">Chapter Name</label>
            <input class="form-control" name="chapter" id="chapter">
          </div>

        </form>
      </div>
      
      <div class="modal-footer">
        <button type="button" onclick="add_chapter()" class="btn btn_blue">Save</button>
        <button type="button" class="btn btn_blue" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!--Add Subject Modal-->

<div class="modal fade ss_modal" id="add_subject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add New Subject</h4>
      </div>
      <form class="" id="add_subject_name">
        <div class="modal-body">
          <div class="form-group">
            <label>Add Subject</label>
            <input type="text" class="form-control wordSearch" name="subject_name">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" onclick="add_subject()" class="btn btn_blue">Save</button>
          <button type="button" class="btn btn_blue" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade ss_modal" id="copy_chapter_success_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body">

        <h6 style="color:green">Successfully copy chapter name</h6>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>



<script>
  function setSolution() {
    //$("#set_solution").modal('show');
    $( "#dialog" ).dialog({
      height: 400,
      width: 600,
      buttons: [
      {
        text:"Close",
        icon: "ui-icon-heart",
        click: function() {

          $( this ).dialog( "close" );
        }
      },
      {
        text:"Save",
        click: function() {
          var solution = ($('#setSolution').val());
          ($('#setSolutionHidden').val(solution));
          $( this ).dialog( "close" );
        }
      }
      ]
    });
    $('#setSolution').ckeditor({
      height: 200,
      extraPlugins : 'simage,ckeditor_wiris',
      filebrowserBrowseUrl: '/assets/uploads?type=Images',
      filebrowserUploadUrl: 'imageUpload',
      toolbar: [
      { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
      { name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
      '/',
      { name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'addFile'] }, 
      '/',
      { name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
      { name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
      ],
      allowedContent: true
    });
  }


  
</script>


<script>
  $(document).ready(function(e){
    $(".module_chapter_copy").click(function() {
        var copy_chapter_id = $("#subject_chapter").val();
   
        if(copy_chapter_id != ''){
          CopyToClipboard(copy_chapter_id);
          $("#copy_chapter_success_modal").modal("show");
        }else{
          alert('Please Select chapter First !!');
        }
        // alert(chapter);
        

    });

    $('.module_chapter_paste').click(function(){

        navigator.clipboard
        .readText()
        .then((cliptext) =>
                {
                  console.log(cliptext);
                  $('#get_chapter_value').val(cliptext);
                  var get_subject_value = $('#subject').val();
                  var get_chapter_id = $('#get_chapter_value').val();
                

                  if (get_subject_value == '') {

                    var response = '<p style="color: red;">Please Select Subject</p>';
                    $('#add_ch_success').html(response);

                  }else if (get_chapter_id == '') {

                    var response = '<p style="color: red;">Chapter Field Can Not Be Empty</p>';
                    $('#add_ch_success').html(response);

                  }else {

                    $('#subject_chapter').val(get_chapter_id).change();

                  }
                },
                err => console.log(err)
        );
        


        

    });

    $('.instruction').ckeditor({
      height: 60,
      extraPlugins : 'svideo,youtube',
      filebrowserBrowseUrl: '/assets/uploads?type=Images',
      filebrowserUploadUrl: 'imageUpload',
      toolbar: [
      { name: 'document', items: ['SVideo', 'Youtube'] }, 

      ]
    });

    $('.question_video').ckeditor({
      height: 60,
      extraPlugins : 'svideo,youtube',
      filebrowserBrowseUrl: '/assets/uploads?type=Images',
      filebrowserUploadUrl: 'imageUpload',
      toolbar: [
      { name: 'document', items: ['SVideo', 'Youtube'], }, 

      ],
    });
   

        // Variable to store your files
        var files;

        // Add events
        $('input[type=file]').on('change', prepareUpload);

        // Grab the files and set them to our variable
        function prepareUpload(event) {
          files = event.target.files;
        }

        $("#question_form").on('submit', function(e){
      e.preventDefault();
     <?php if($question_item == 14){?>
                $(".progress").show();
            <?php }?>
      var is_submit = 1;
//          var list = [];
            //Check for Creative Quiz
            var paragraph_order = $("input[name='paragraph_order[]']").map(function(){return $(this).val();}).get();
            var list = $(".sentence input:checked").map(function(){
                                                                return $(this).attr("checkboxid");
                                                            }).get().join();
            
            var arr = list.split(',');
            paragraph_order = paragraph_order.filter(function (el) {
                                                        return el != '';
                                                    });
            console.log(arr);
            console.log(paragraph_order);
            if(paragraph_order.length > 0){
                for(var i = 0;i < arr.length; i++){
//                    
                    if(paragraph_order[i] == ''){
                        is_submit = 0;
                    }
                }
                
                if(arr.length != paragraph_order.length){
                    is_submit = 0;
                }
            }
      
      var pathname = '<?php echo base_url(); ?>';
      var question_item = document.getElementById('question_item').value;

      if (question_item == 4) {
          
        if ($('input:checkbox[name=questionName_1_checkbox]:checked').val() == 1) {
          var first_question = $('input:checkbox[name=questionName_1_checkbox]:checked').val();

        }

        if ($('input:checkbox[name=questionName_2_checkbox]:checked').val() == 1) {
          var second_question = $('input:checkbox[name=questionName_2_checkbox]:checked').val();

        }

        if ($('#questionName_1').val() =='') {
          $('#question_name_type').val(0)
        }else{
          $('#question_name_type').val(1)
        }

        if (first_question == 1 && second_question == 1) {
          
        }else{

          if ($('#questionName_1').val() !='' && $('#questionName_2').val() !='') {
            alert('You can not use at a time two question ')
            return ;
          }
          
        }
      }

      // if(is_submit == 1) {
        CKupdate();
        $.ajax({
          url: "save_question_data",
          type: "POST",
          data: new FormData(this),
          processData:false,
          contentType:false,
          cache:false,

          success: function (response) {
            <?php 
              if(!empty($this->session->userdata('module_status'))){
            ?>
            var module_status = <?php echo $this->session->userdata('module_status'); ?>;
            <?php 
              if(!empty($this->session->userdata('module_edit_id'))){
            ?>
            var module_edit_id = <?php echo $this->session->userdata('module_edit_id'); ?>;
            <?php }?>
            <?php 
              if(!empty($this->session->userdata('param_module_id'))){
            ?>
              var param_module_id = <?php echo $this->session->userdata('param_module_id'); ?>;
            <?php }?>

            if (module_status == 1) {
              var get_url = "<?=base_url()?>/create-module/1";
               
              $("#save_success_button").hide();
              $("#save_success_button_with_url").css('display','inline-block');
              $("#save_success_button_with_url").attr('href',get_url);
            }else if (module_status == 2) {
              var get_url = "<?=base_url()?>/new-edit-module/"+param_module_id+"/1";

              $("#save_success_button").hide();
              $("#save_success_button_with_url").css('display','inline-block');
              $("#save_success_button_with_url").attr('href',get_url);
            }
            <?php }?>
            console.log(response);
            $(".progress").hide();
            var data = jQuery.parseJSON(response);
            console.log(data.flag);
            $("#error_msg").text('');
            // if(data.chk_duplicate!=1){
              if(data.flag == 1){
                $("#preview_btn").show();
                $("#preview_btn").attr("href", pathname+'question_preview/'+question_item+'/'+data.question_id);
                $(".uploadsMsg_").html('');
                $("#ss_sucess_mess").modal('show');
              }if(data.flag == 0){
                $("#error_msg").text(data.msg);
                <?php if($question_item==20){?>
                alert('Sorry, You have to select answer !!');
                <?php }?>
              }
            // }else{
            //   alert("Duplicate found");
            // }
          }
        });
      // } else {
                // alert('Please set all sentence to any paragraph');
            // }
        });
      });

  function CKupdate() {
    for (instance in CKEDITOR.instances)
      CKEDITOR.instances[instance].updateElement();
  }

  function add_subject() {
    $.ajax({
     url: "add_subject_name",
     method: "POST",
     data: $("#add_subject_name").serialize(),
     success: function (response) {
      $('#add_subject').modal('hide');

      $('#subject').html(response);
    }
  });
  }

  function getChapter(e) {
    var subject_id = e.value;
    $('#get_subject_value').val(subject_id);
    $.ajax({
     url: "get_chapter_name",
     method: "POST",
     data: {
      subject_id: subject_id
    },
    success: function (response) {
      
      $('#subject_chapter').html(response);
      var get_dup_ques_chapter = $('#dup_ques_chapter').val();
      if(get_dup_ques_chapter!=''){
        $('#subject_chapter').val(get_dup_ques_chapter).trigger('change');
      }
    }
  });
  }

  function open_question_setting() {
    $("#raccordion").show();
  }
  
  $('#get_subject').click(function () {

    var subject_id = document.getElementById('subject').value;
    document.getElementById("attached_subject").value = subject_id;
    $('#add_chapter').modal('show');
  });

  function add_chapter() {
    var data = $("#add_subject_wise_chapter").serializeArray();
    console.log(data[0].value);
    if(data[0].value == ''){
     var response = '<p style="color: red;">Please Select Subject</p>';
     $('#chapter_error').html(response);
   } else if(data[1].value == '') {
     var response = '<p style="color: red;">Chapter Field Can Not Be Empty</p>';
     $('#chapter_error').html(response);
   } else {
     $.ajax({
      url: "add_chapter",
      method: "POST",
      dataType: 'html',
      data: data,
      success: function (response) {

       $('#add_ch_success').html('Chapter added successfully');
       $('#add_chapter').modal('hide');
       $('#subject_chapter').html(response);

     }
   });
   }
 }


 function setMark(){
  $("#set_marks").modal('show');
}

function markData(){
  var marks = $("#marksValue").serializeArray();

  var first_digit = marks[0].value;
  var second_digit = marks[1].value;
  first_digit = first_digit.length ? first_digit : 0;
  second_digit = second_digit.length ? second_digit : 0;
  var number = "" + first_digit + second_digit;

  var first_fraction_digit = marks[2].value;
  var second_fraction_digit = marks[3].value;
  first_fraction_digit = first_fraction_digit.length ? first_fraction_digit : 1;
  second_fraction_digit = second_fraction_digit.length ? second_fraction_digit : 1;

  if(first_fraction_digit > second_fraction_digit) {
    alert('Numerator can not be bigger than denominator');
  } else {
    var decimal_digit = parseInt(number) + parseFloat(first_fraction_digit / second_fraction_digit);
    if(first_fraction_digit == second_fraction_digit) {
      decimal_digit = parseInt(number) * parseFloat(first_fraction_digit / second_fraction_digit);
    }
    decimal_digit = decimal_digit.toFixed(2);
    $("#marks").html(decimal_digit) ;
    $("#marks_value").val(decimal_digit) ;
    $("#mark_icon").hide() ;
    $("#marks").show() ;

    $('#set_marks').modal('hide');
  }
}

  //context menu on subject
  $(function($){
    var selector = $('#subject');
    $(document).on('change', '#subject', function(){
      var selItem = $("#subject :selected");
      console.log('hit');
      selItem.mousedown(function(e){
        console.log(e);
      })
    })
  })

  /*autocomplete*/
  $(document).ready(function(){ 
    $('.wordSearch').devbridgeAutocomplete({
      serviceUrl: 'Subject/suggestSubject',
      onSelect: function (suggestions) {
        console.log(suggestions.answer);
      }
    });
  })

</script>
