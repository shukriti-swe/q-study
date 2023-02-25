<style>

  .select2-container .select2-selection--single {
    height: 33px;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 30px;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 33px;
  }

  .group_cls {
    display: block;
    background: #eeeeee;
    text-align: center;
    min-height: 159px;
    line-height: 159px;
    font-size: 30px;
    text-transform: uppercase;
  }

</style>
<?php if($loggedUserType == 7){?>
<div class="row">
  <div class="col-md-12 upperbutton" style="text-align: center;">
     <a href="all-module" style="font-size:20px;font-weight: bold;display: inline-block;">Module Inbox</a>
  </div>
</div>          
<?php }?>

<form action="" method="post" id="editModuleForm">
  <input type="hidden" name="startTime" id="modStartTime" value="">
  <input type="hidden" name="endTime" id="modEndTime" value="">
  <input type="hidden" name="optTime" id="modOptTime" value="">

  <input type="hidden" name="moduleId" id="moduleId" value="<?php echo $module_info['id']; ?>">

  <div class="container top100" style="margin-top: 45px;">
    <div class="row">

      <div class="col-md-7 upperbutton" style="text-align: right;">
        <div class="blue_photo bottom10">
          <button class="btn btn-primary" type="submit">Update</button>
        </div>

        <div class="blue_photo bottom10">
          <button class="btn btn-primary" type="button" id="modulePrevBtn" onclick="document.location.href = 'module_preview/<?php echo $module_info['id']; ?>/1'">Preview</button>
        </div>
      </div>
      <div class="col-md-5">
        <div class="bottom10" style="margin:5px">
         <strong><a style="text-decoration: underline;" href="question-list/?type=edit&mId=<?php echo $module_info['id']; ?>">All question</a></strong>
       </div>
     </div>
   </div>

   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body" style=" padding: 62px 0; text-align: center; border-top: 43px solid #0663a0; ">
          <b>Successful !!</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ok</button>
        </div>
      </div>
    </div>
  </div>

  <div class="row">

    <div class="col-md-4 col-md-offset-4 upperbutton">

    </div>

  </div>

  <div class="row">

    <div class="col-md-2">

      <div class="form-group color_btn top10">
        <label for="exampleInputName2" >Module Name</label>
        <input type="text" class="form-control" name="moduleName" value="<?php echo $module_info['moduleName']; ?>" required>
      </div>

      <div class="form-group color_btn top10">
        <label for="exampleInputName2" >Tracker Name</label>
        <input type="text" class="form-control" name="trackerName" value="<?php echo $module_info['trackerName']; ?>" required>
      </div>

      <div class="form-group color_btn top10">
        <label for="exampleInputName2" >Individual Name</label>
        <input type="text" value="<?php echo $module_info['individualName']; ?>" class="form-control" name="individualName">
      </div>

      <div class="form-group color_btn top10">
    <div id="hide_date">
       <label for="exampleInputName2" >Date</label>
       <div class="form-group color_btn">
        <div class="input-group date" id="datetimepicker1">
          <input type="text" class="form-control enterDate" id="enterDate" name="dateCreated" value="<?php echo date('m/d/Y', $module_info['exam_date']); ?>" autocomplete="off">
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>

      <div class="form-check" id="time">
        <label for="exampleInputName2" >Time</label>
        <i class="fa fa-clock-o" style="font-size:20px;" data-toggle="modal" data-target="#setTime"></i>
      </div>

      <div class="form-check  sms_check top10">
        <label class="form-check-label" for="defaultCheck1">
          Response to sms
        </label>
        <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="isSMS" <?php echo $module_info['isSMS'] ? ' checked' : ''; ?>>
      </div>

      <div class="form-check  sms_check" style=" padding-top: 20px; ">
        <label class="form-check-label" for="defaultCheck1" style=" font-size: 13px; ">
          Assign for all student
        </label>
        <input class="form-check-input" type="checkbox" value="1" id="isAllStudent" name="isAllStudent" <?php echo $module_info['isAllStudent'] ? ' checked' : ''; ?>>
      </div>

      <div class="form-group color_btn" style=" padding-top: 20px; ">
        <label for="exampleInputEmail2">Assign for individual</label>
        <div class="select22">
          <select class="form-control select2" multiple="multiple" name='individualStudent[]' id="individualStudent">
            <?php echo $allStudents; ?>
          </select>

        </div>
      </div>

        <!-- <div class="form-check  sms_check" style=" padding-top: 20px; ">
          <label class="form-check-label" for="defaultCheck1" style=" font-size: 13px; ">
            Choose questions
          </label>
          <input class="form-check-input chooseQues" type="checkbox" value="" id="chooseQues" <?php if ($qoMap) {echo 'checked';}?>>
        </div> -->
    <div class="form-check text-center" style=" padding-top: 20px; cursor: pointer;">
          <?php if($loggedUserType == 7){?>
            <a onclick="show_video_link()" style="text-decoration: underline;margin-bottom: 8px;">Subject Video</a>
            <a style="text-decoration: underline;margin-bottom: 8px;" href="module_instruction_video/<?php echo $module_info['id']?>">Instruction Video</a>
            <?php }else{?>
          <a onclick="show_video_link()" style="font-size: 13px;font-weight: 600;">Video Link & Instruction</a>
        <?php }?>
        </div>

      </div>
    </div>
    <div class="col-md-10">
      <div class="row">
        <div class="col-md-2">
          <div class="form-group color_btn">
            <label for="exampleInputName2">Country</label>
            <div class="select">
              <select class="form-control select-hidden" id="country_id" name="country" required onchange="individual_student()">
                <?php echo $all_country; ?>
              </select>
            </div>
          </div>

        </div>

        <div class="col-md-2">
          <div class="form-group color_btn">
            <label for="exampleInputEmail2">Grade/Year/Lavel</label>
            <div class="select">
              <select class="form-control select-hidden select2" name="studentGrade" id="studentGrade" 
              onchange="individual_student();<?php if($loggedUserType == 7){?>get_course(this)<?php }?>">
              <?php for ($a = 1; $a <= 13; $a++): ?>
                <?php $selStGrade = ($module_info['studentGrade'] == $a) ? 'selected' : '';?>
                <?php if ($a >= 13): ?>
                  <option value="<?php echo $a ?>" <?php echo $selStGrade; ?>>Upper Level</option>
                  <?php else: ?>
                    <option value="<?php echo $a ?>" <?php echo $selStGrade; ?>><?php echo $a; ?></option>
                  <?php endif;?>
                <?php endfor;?>
              </select>

            </div>
          </div>

        </div>

        <div class="col-md-2">
          <div class="form-group color_btn">
            <label for="exampleInputEmail2">Module Type</label>
            <div class="select">
              <select class="form-control select-hidden" name="moduleType" required onchange="getModuleType(this)">
                <?php echo $all_module_type; ?>
              </select>
            </div>
          </div>

        </div>

        <div class="col-md-2">
          <div class="form-group color_btn">
            <label for="exampleInputEmail2">Subject</label>
            <div class="select">
              <select class="form-control select-hidden select2" name="subject" id="subject" required onchange="individual_student()">
                <?php echo $all_subjects; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group color_btn">
            <label for="exampleInputEmail2">Chapter</label>
            <div class="select">
              <select class="form-control select-hidden" name='chapter' id="chapter">
                <?php echo $all_chapters ?>
              </select>
            </div>
          </div>
        </div>

        <?php if($loggedUserType == 7) {?>
          <div class="col-md-2">
            <div class="form-group color_btn">
              <label for="exampleInputEmail2">Course</label>
              <div class="select">
                <select class="form-control select-hidden select2" style="width: 225px;" name='course_id' id="course_id" onchange="individual_student()">
                  <?php foreach ($get_course as $course){?>
                    <option value="<?php echo $course['id'];?>" <?php if($course['id'] == $module_info['course_id']){echo 'selected';}?>>
                      <?php echo $course['courseName']?>
                    </option>
                  <?php }?>
                </select>  
              </div>
            </div>
          </div>
        <?php }?>

        <div class="col-md-2">
          <div class="form-group color_btn">
            <label for="exampleInputEmail2"></label>
            <div class="select" style="display: none;" id="repeated_div">
              <strong>
                <a id="repeatWrong" style="text-decoration: underline;" href="">Repeat wrong question</a>
              </strong>
            </div>
          </div>
        </div>

        <div class="ss_student_progress">
          <div class="search_filter">
          </div>
        </div>

        <div class="sign_up_menu">
          <div class="table-responsive" id="allQuestion">

          </div>
        </div>


        <!--Start Video Link-->

        <div id="dialog" title="Basic dialog" style="display: none;">
          <div class="col-md-3 top10">

          </div>
          <div class="col-md-9 top10">
            <div class="">
              <div class="h_m_r">
                <label style="padding: 3px 0;color: #1f3366; ">How Many Rows</label>
                <input class="form-control" type="number" value="1" id="box_qty" onclick="getImageBox(this)">
              </div>  

            </div>  
          </div>

          <div class="col-md-12">
            <div class="row editor_hide" id="list_box_1">
              <div class="col-md-2 group_cls top10">
                A
              </div>
              <div class="col-md-5 top10">
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne" style="color: #fff;background-color: #1f3366;padding: 2px 8px;">
                    <h4 class="panel-title">
                      <span> Subject Video</span>
                    <!--<span style="float:right;">
                      <a href="#" style=" color: #fff;" data-toggle="modal" data-target="#exampleModal">Link 
                        <i class="fa fa-film"></i>
                      </a>
                    </span>-->
                  </h4>
                </div>
                <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <textarea class="video_textarea" name="video_link_1[]" id="editor_1"><?php echo $instruction_video; ?></textarea>
                </div>
              </div>
            </div>

            <?php if ($loggedUserType != 7) {?>

            <div class="col-md-5 top10">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne" style="color: #fff;background-color: #1f3366;padding: 2px 8px;">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne" style="color: #fff;">Instruction</a>
                  </h4>
                </div>
                <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <textarea class="instruction_textarea" name="instruction[]" id="inseditor_1"><?php echo $ins; ?></textarea>
                </div>
              </div>
            </div>

            <?php } ?>

          </div>
          <div class="row">
            <div class="col-md-2 top10">
              <label for="videoName">Video Name:</label>
            </div>
            <div class="col-md-5 top10">
              <div class="panel panel-default">
                <input type="text" name="videoName" id="videoName" style="background-color: none;" value="<?php echo isset($module_info['video_name'])?$module_info['video_name']:''; ?>">
              </div>
            </div>
          </div>

          <?php
          $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
          $desired_i = 2;
          ?>
          <?php for ($desired_i; $desired_i <= 20; $desired_i++) { ?>
            <div class="row editor_hide" id="list_box_<?php echo $desired_i; ?>" style="display:none; margin-bottom:5px">
              <div class="col-md-2 group_cls top10">
                <?php echo $lettry_array[$desired_i - 1]; ?>
              </div>
              <div class="col-md-5 top10">
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne" style="color: #fff;background-color: #1f3366;padding: 2px 8px;">
                    <h4 class="panel-title">
                      <span>Video</span>
                      <!--<span style="float:right;">
                        <a href="#" style=" color: #fff;" data-toggle="modal" data-target="#exampleModal">Link 
                          <i class="fa fa-film"></i>
                        </a>
                      </span> -->
                    </h4>
                  </div>
                  <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <textarea class="video_textarea" name="video_link_<?php echo $desired_i; ?>[]" id="editor_<?php echo $desired_i; ?>"></textarea>
                  </div>
                </div>
              </div>

              <div class="col-md-5 top10">
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne" style="color: #fff;background-color: #1f3366;padding: 2px 8px;">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne" style="color: #fff;">Instruction</a>
                    </h4>
                  </div>
                  <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <textarea class="instruction_textarea" name="instruction[]" id="inseditor_<?php echo $desired_i; ?>"></textarea>
                  </div>
                </div>
              </div>
            </div>
          <?php }?>
        </div>

        

      </div>


      <!--End Video Link-->

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!--End Video Link-->

    <input type="hidden" name="image_quantity" id="image_quantity" value="<?php echo isset($video_link) ?count((array) $video_link) : 0; ?>">

  </div>
</div>
</div>
</div>
</form>

<!-- question preview modal -->
<div class="modal fade question-preview-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h6 class="modal-title" id="modal-title"></h6>
      </div>
      <div class="modal-body">
        <h4>hello there</h4>
      </div>
    </div>
  </div>
</div> <!-- modal end -->

<!--modal add time optional and specific-->
<div class="modal fade" id="setTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Set Time</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group row" id="time_ranger">
            <label for="recipient-name" class="control-label col-md-3">Time Range:</label>
            <div class="col-md-3">
              <div class="input-group date" id="datetimepicker1">
                <?php  if ($optionalTime != '00:00') { ?>
                 <input type="text" class="form-control enterDate" id="timeStart" name="startTime" autocomplete="off" value="">
                <?php }else{ ?>

                  <?php if ( date('h:i A',strtotime($module_info['exam_start']) )  != "12:00 AM" ) {  ?>
                     <input type="text" class="form-control enterDate" id="timeStart" name="startTime" autocomplete="off" value="<?php echo date('h:i A',strtotime($module_info['exam_start']) ); ?>">
                  <?php }else{ ?>
                    <input type="text" class="form-control enterDate" id="timeStart" name="startTime" autocomplete="off" value="">
                  <?php  } ?>

                <?php } ?>
                <span class="input-group-addon">
                  <span class="fa fa-clock-o"></span>
                </span>
              </div>
            </div>
            <label  class="control-label small text-muted col-md-1">To</label>
            <div class="col-md-3">
              <div class="input-group date" id="datetimepicker1">
                <?php  if ($optionalTime != '00:00') { ?>
                 <input type="text" class="form-control enterDate" id="timeEnd" name="endTime" autocomplete="off" value="">
                <?php }else{ ?>

                  <?php if ( date('h:i A',strtotime($module_info['exam_end']) )  != "12:00 AM" ) {  ?>
                     <input type="text" class="form-control enterDate" id="timeEnd" name="endTime" autocomplete="off" value="<?php echo date('h:i A',strtotime($module_info['exam_end'])); ?>">
                  <?php }else{ ?>
                    <input type="text" class="form-control enterDate" id="timeEnd" name="endTime" autocomplete="off" value="">
                  <?php  } ?>
                  
                <?php } ?>
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="recipient-name" class="control-label col-md-3">Optional Time:</label>
            <div class="col-md-4">
              <div class="input-group date" id="datetimepicker1">
                <?php  if ($optionalTime == '00:00') { ?>
                 <input type="text" class="form-control enterDate" id="optTime" name="optTime" autocomplete="off" value="">
                <?php }else{ ?>
                  <input type="text" class="form-control enterDate" id="optTime" name="optTime" autocomplete="off" value="<?php echo $optionalTime; ?>">
                <?php } ?>
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modTimeSetBtn">OK</button>
      </div>
    </div>
  </div>
</div>

<script>
  var qtye = $("#box_qty").val();

  document.getElementById("image_quantity").value = qtye;
  common(qtye);
  function getImageBox() {
    var qty = $("#box_qty").val();
    if (qty < 1) {
      $("#box_qty").val(1);
    } else if (qty > 20) {
      $("#box_qty").val(20);
    } else {
      $('.editor_hide').hide();
      document.getElementById("image_quantity").value = qty;
      common(qty);
    }

  }
  function common(quantity)
  {
    for (var i = 1; i <= quantity; i++)
    {
      $('#list_box_' + i).show();
    }
  }

    //datepicker
    $(document).ready(function () {
      var module_type = ($("[name=moduleType]").val());
      if(module_type == 2){
        $("#repeated_div").show();
      }

      $("#enterDate").on('click', function () {
        $("#enterDate").datepicker({
          autoclose: true,
          todayHighlight: true,
          format: "yyyy/mm/dd",
          orientation: 'bottom',
          onClose: function () {
            $(this).blur();
          }
        });
      })
    })

    //time picker
    var startTimeTextBox = $('#timeStart');
    var endTimeTextBox = $('#timeEnd');
    $.timepicker.timeRange(
      startTimeTextBox,
      endTimeTextBox,
      {
        // 1hr
        minInterval: (1000 * 60),
        //timeFormat: 'HH:mm',
        timeFormat: 'hh:mm tt',
        start: {}, // start picker options
        end: {} // end picker options
      },
      );

    $('#optTime').timepicker();
    //set hidden field on time set
    $(document).on('click', '#modTimeSetBtn', function () {
      var timeStart = $('#timeStart').val();
      var timeEnd = $('#timeEnd').val();
      var optTime = $('#optTime').val();
      $('#modStartTime').val(timeStart);
      $('#modEndTime').val(timeEnd);
      $('#modOptTime').val(optTime);
      console.log(timeStart);
      $('#setTime').modal('toggle');
    })


    
    $("[name='moduleType']").change(function() {
      var module_type = ($("[name=moduleType]").val());
      if(module_type == 2){
        $("#repeated_div").show();
      } else {
        $("#repeated_div").hide();
      }
    });

    /*select2 on all students*/
    $(document).ready(function () {
      //$('.individualStudent').select2();
      //get_question();
    });

    $(document).ready(function () {
      $(document).on('change', '.questionOrder', function (e) {
            //e.stopPropagation();
            var temp = 0;
            var inp = this.value;

            $('.questionOrder').not(this).each(function () {
              if (inp == this.value) {
                temp = 1;
              }
            });

            if (temp) {
              alert('Order Overlaping, Please fix');
              $(this).val('');
            } else {
              var qId = $(this).siblings('#qId').val();
              $(this).siblings('input#qId_ordr').val(qId + '_' + inp);
            }

          });


        //question checkbox check functionality
        $(document).on('change', '#quesChecked', function () {
          var x = $(this).siblings('#qOrdr');
      var order_value = $(this).siblings('#qOrdr').val();
          if (this.checked) {
            $(this).siblings('#qOrdr').prop('disabled', false);
            $(this).siblings('#qOrdr').prop('required', true);

            var qId = $(this).siblings('#qId').val();
            $(this).siblings('input#qId_ordr').val(qId + '_' + maxOrder);
            x.val(maxOrder++);

          } else {
        maxOrder--;
        var inputs = $(".questionOrder");
              var inputs_qId_order = $(".qId_order");
              var inputs_qId = $(".qId");
         showValue(inputs,order_value,inputs_qId_order,inputs_qId);
            $(this).siblings('#qOrdr').prop('disabled', true);
            x.val('');
            $(this).siblings('#qId_ordr').val('');
          }
        });

      });
    
   function showValue(inputs,order_value,inputs_qId_order,inputs_qId)
    {
        var id_value;
        for(var i = 0; i < inputs.length; i++){

            if ($(inputs[i]).val() != '' && $(inputs[i]).val() != 0)
            {

                var orderValue = parseInt($(inputs[i]).val());
                if (orderValue > order_value)
                {
                    $(inputs[i]).val(orderValue-1);
                   // var qid= $(inputs_qId[i].val();
                    var idddd = $(inputs_qId_order[i]).val();
                    var datadd = idddd.split(('_')[0]);
                    var qusId = parseInt(datadd[0]);
                    var orderqq = orderValue-1;
                    $(inputs_qId_order[i]).val(qusId+'_'+orderqq);

                }
            }
        }
    }

    /*get all question by search params on check choose question*/
    $(document).on('change', '.chooseQues', function () {
      if (this.checked) {
        get_question();

      } else {
        $('#allQuestion').html('');
      }
    });

    //initially load all question based on which params set for current module
    $(document).ready(function(){
      get_question();
      //individual_student();
    });
    //search question based on params
    var maxOrder = 0;
    function get_question(){
      var studentGrade = $("#studentGrade :selected").val();
      var subject = $("#subject :selected").val();
      var chapter = $("#chapter :selected").val();
      var moduleId = $("#moduleId").val();

      $.ajax({
        url: 'Module/quesSearch',
        method: 'POST',
        dataType:'json',
        data: {studentgrade: studentGrade, subject: subject, chapter: chapter, reqType:'edit', moduleId:moduleId},
        success: function (data) {
          data = JSON.stringify(data);
          data = JSON.parse(data);
          $('#allQuestion').html(data.row);
          maxOrder = parseInt(data.maxOrder) + 1;
              //console.log(maxOrder);
            }
          });
    }

    //ques order checkbox check functionality
    /*$(document).on('change', '#quesChecked', function () {
      var x = $(this).siblings('#qOrdr');
      if (this.checked) {
        $(this).siblings('#qOrdr').prop('disabled', false);
        $(this).siblings('#qOrdr').prop('required', true);
        x.val(maxOrder++);
      } else {
        $(this).siblings('#qOrdr').prop('disabled', true);
        maxOrder--;
        x.val('');
      }
    })*/

    //module save form submit & preview button enable
    $(document).on('submit', '#editModuleForm', function (e) {
      var new_array = [];
      var image_quantity = $('#image_quantity' ).val();
      var flag = 0;

      var all_question_order = $('.questionOrder');
      var max_qestion_order = $(all_question_order[0]).val();

      var value = $("[name='moduleType']").val();

      if (value == 3) {
        var value_start = $("#modStartTime").val();
        var value_end = $("#modEndTime").val();
        var value_optional = $("#optTime").val();
        

        if ( (value_start == ''  && value_end == '') && value_optional =='') {
          alert('Time is required');
          return false;
        }

      }

        //Store value in an array and Get Maximum value
        for(var i = 0; i < all_question_order.length; i++) {
          var question_order = $(all_question_order[i]).val();
            new_array.push(question_order);//Store values in array

            if(question_order > max_qestion_order) {
                max_qestion_order = question_order;//Get Maximum value
              }
            }

            var sorted_arr = new_array.slice().sort();

            for (var i = 0; i < sorted_arr.length - 1; i++) {
              if (sorted_arr[i + 1] == sorted_arr[i] && sorted_arr[i + 1] != '') {
                flag = 1;
              }
            }

          //Check the input value in an array and change the flag value
          for(var j=1; j <= max_qestion_order; j++) {

            if($.inArray(j.toString(), new_array) == '-1'){
              flag = 1;
            }

          }

          x = sorted_arr.sort(function(a, b){return a - b});
          
          var y = [];
          for (var i = 0; i < x.length; i++) {
            if (x[i] != '' ) {
              // here push input er qustion
              y.push(x[i]);

            }
          }

          for (var s = 1; s < y.length; s++) {
            if (y[s -1] != s) {
              flag = 1;
            }
          }

          var text = '';
          var ins = '';


          for (var i = 1; i <= image_quantity; i++) {


            text += $('#editor'+'_'+i).val();
            ins += $('#inseditor'+'_'+i).val();
          }

          var instructVideoName = $('#videoName').val();
          e.preventDefault();
          if(flag == 0) {
            $.ajax({
              url: 'Module/updateRequestedModule',
              method: 'POST',
              data: $(this).serialize()+ "&video_link="+text+ "&video_name="+instructVideoName+"&instruction="+ins,
              success: function (data) {
                if (data == 'true') {
                  alert('Module Updated Successfully.');
                } else {
                  console.log('Something is wrong.');
                    } //end else
                } //end success
              });
          } if(flag == 1) {
            alert('You Need to Maintain the Sequence of Question Order And Can Not Order Overlaping');
          }
        });

    $(document).on('change', '#isAllStudent', function () {

      if (this.checked) {
        $('#individualStudent :selected').removeAttr("selected");
        $('#individualStudent').html('');
        $('#individualStudent').attr('disabled', true);
      } else {
        $('#individualStudent').attr('disabled', false);
        $($('#individualStudent')).html($('#hiddenAllStds').html());
      }
    });

    //get student by subject,country,grade initially
    /*$(document).ready(function(){
      causing problem while selecting student
      individual_student();
    })*/

    function  individual_student(){

      var studentGrade = $("#studentGrade :selected").val();
      var subject = $("#subject :selected").val();
      var country_id = $("#country_id").val();
      var tutor_type = '<?php echo $loggedUserType ?>';

      <?php if($loggedUserType == 7){?>
        var course_id = $("#course_id :selected").val();
      <?php }?>
      //if(studentGrade != '' && country_id != ''){
        $.ajax({
          //url: 'getStudentByGradeCountry',
          url: 'getIndividualStudent',
          method: 'POST',
          data: {
            studentGrade: studentGrade,
            country_id: country_id,
            subject: subject,
            tutor_type: tutor_type,
            <?php if($loggedUserType == 7){?>
              course_id : course_id
            <?php }?>
          },
          success: function (data) {
            //console.log(data);
            $('#individualStudent').html(data);
          }
        });
//        }
}

function get_course(e) {
  $.ajax({
    url: 'get_course',
    method: 'POST',
    data: {
      studentGrade: e.value
    },
    success: function (data) {
      $('#course_id').html(data);
    }
  });

}


/*function show_video_link(){
  var extra_plugin = '<?php if ($loggedUserType == 7) {echo 'svideo';} else {echo 'youtube';}?>';

  var item = '<?php if ($loggedUserType == 7) {echo 'SVideo';} else {echo 'Youtube';}?>';

  $( "#dialog" ).dialog({
    width: 600,
    open: function(event,ui) {
      $('.video_textarea').ckeditor({
        height: 60,
        extraPlugins : extra_plugin,
        filebrowserBrowseUrl: '/assets/uploads?type=Images',
        filebrowserUploadUrl: 'imageUpload',
        toolbar: [
        { name: 'document', items: [item] },
        ]
      });

      $('.instruction_textarea').ckeditor({
        height: 60,
        extraPlugins : 'spdf,simage,sdoc',
        filebrowserBrowseUrl: '/assets/uploads?type=Images',
        filebrowserUploadUrl: 'imageUpload',
        toolbar: [
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        { name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage','SPdf','SDoc' ] },
        '/',
        { name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'Image', 'addFile'] }, '/',
        { name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] }
        ]
      });
    },

  });
}*/

/*may be video preview modal*/
function show_video_link(){
  var extra_plugin = '<?php if ($loggedUserType == 7) {
    echo 'svideo';
  } else {
    echo 'youtube';
  }?>';

  var item = '<?php if ($loggedUserType == 7) {
    echo 'SVideo';
  } else {
    echo 'Youtube';
  }?>';

  <?php if ($loggedUserType == 7) {?>
    $( "#dialog" ).dialog({
      width: 600,
      open: function(event,ui) {
        $('.video_textarea').ckeditor({
          height: 60,
          extraPlugins : 'svideo,youtube',
          filebrowserBrowseUrl: '/assets/uploads?type=Images',
          filebrowserUploadUrl: 'imageUpload_two',
          toolbar: [
          { name: 'document', items: ['SVideo', 'Youtube'] }, 

          ]
        });

        $('.instruction_textarea').ckeditor({
          height: 60,
          extraPlugins : 'spdf,simage,sdoc,svideo',
          filebrowserBrowseUrl: '/assets/uploads?type=Images',
          filebrowserUploadUrl: 'imageUpload',
          toolbar: [
          { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
          { name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage','SPdf','SDoc', 'SVideo' ] },
          '/'
          ,
          { name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'Image', 'addFile'] }, 
          '/',
          { name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] }
          ]
        });
      },

    });
  <?php } else {?>
    $( "#dialog" ).dialog({
      width: 600,
      open: function(event,ui) {
        $('.video_textarea').ckeditor({
          height: 60,
          extraPlugins : 'youtube',
          filebrowserBrowseUrl: '/assets/uploads?type=Images',
          filebrowserUploadUrl: 'imageUpload_two',
          toolbar: [
          { name: 'document', items: ['Youtube'] },  

          ]
        });

        $('.instruction_textarea').ckeditor({
          height: 60,
          extraPlugins : 'spdf,simage,sdoc',
          filebrowserBrowseUrl: '/assets/uploads?type=Images',
          filebrowserUploadUrl: 'imageUpload',
          toolbar: [
          { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
          { name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage','SPdf','SDoc' ] },
          '/',
          { name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'Image', 'addFile'] }, 
          '/',
          { name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] }
          ]
        });
      },

    });
  <?php }?>   
}

/*question preview in modal*/
$(document).on('click', '.quesInfoIcon', function(){
  var questionId = $(this).closest('tr').find('.questionId').val();
  var questionType = $(this).closest('tr').find('.questionType').val();
  $.ajax({
    url: 'Module/quesInfoForModal',
    type: 'POST',
    data: {questionId: questionId},
  })
  .done(function(data) {
    $('.question-preview-modal').find('.modal-body').html(data);
    $('.question-preview-modal').find('.modal-title').html(questionType);
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log(questionId);
  });

})

    //on click repeat wrong question link
    $(document).on('click', '#repeatWrong', function(e){
      e.preventDefault();
      var modId = <?php echo $module_info['id']; ?>;
      window.open("module/repetition/"+modId, '_blank');
    })

  //get chapters of subject while on change subject
  $(document).on('change', '#subject', function () {
    var subjectId = $(this, ':selected').val();
    var subjectName = $(this, ':selected').html();
    $.ajax({
      url: 'Student/renderedChapters/' + subjectId,
      method: 'POST',
      success: function (data) {
        $('#chapter').html(data);
      }
    });
  });


  //after change on each params(student grade/) on search update question items
  $(document).on('change', '#studentGrade', function(){
    get_question();    
  });

  $(document).on('change', '#subject', function(){
    get_question();   
  });

  $(document).on('change', '#chapter', function(){
    get_question();
  });
</script>

<?php  if ($module_info['moduleType'] == 1) { ?>
  <script type="text/javascript">
    $("#hide_date").hide();
    $("#time").hide();
    $("#time_ranger").hide();
  </script>
<?php } ?>

<script>
    function getModuleType(e){
        if( e.value == '3'){
            $("#hide_date").show();
            $("#time").show();
            $("#hide_date").show();
            $("#time_ranger").show();
        }
        if (e.value == '4')
        {
            $("#hide_date").show();
            $("#time").hide();
            $("#hide_date").show();
            $("#time_ranger").show();
        }
        if (e.value == '5' || e.value == '1')
        {
            $("#hide_date").hide();
            $("#time").hide();
            $("#time_ranger").hide();
        }
        if(e.value == '2')
        {
            $("#hide_date").show();
            $("#time").show();
            $("#time_ranger").hide();
        }
    }
    
    
    $(document).on('click','.delete-question',function(){
        var x = $(this).siblings('#qOrdr');
        var order_value = $(this).siblings('#qOrdr').val();
        //alert(order_value);return;
        var qustion = $(this);
        var qId = $(this).attr('data-id');
        var mId = $(this).attr('module-id');
        if (!confirm("Do you want to delete")){
          return false;
        }else{
          $.ajax({
            url: "Module/question_delete/"+qId+'/'+mId,
            method : 'POST',
            success: function(data){
              if(data=='true'){ 
                alert('Question deleted successfully.'); 
                qustion.closest('tr').fadeOut("slow"); 
                location.reload();
              }else{ alert('Somethings wrong.'); }
            }
          })

        }
    })


    $(document).on('click','.duplicate-question',function(){
        var qustion = $(this);
        var qId = $(this).attr('data-id');
        var user_id =  $(this).attr('user-id');
        if (!confirm("Do you want to duplicate")){
          return false;
        }else{

          $.ajax({
            url:"<?php echo base_url(); ?>question_duplicate",
            method : 'POST',
            data:{qId:qId , user_id:user_id },
            success: function(data){
              alert('Question duplicated successfully.');
            }
          })

        }
    })
</script>
