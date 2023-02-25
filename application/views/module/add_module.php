<?php

  $subcription = $user_info[0]['end_subscription'];
  if (isset($subcription) && !empty($subcription)) {
    $end_subscription = $user_info[0]['end_subscription'];
    $date1 = date('Y-m-d',strtotime($end_subscription));
    $date2 = date('Y-m-d');
  }

?>
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


<input type="hidden" id="userType" value="<?php echo $loggedUserType; ?>">
<form action="Module/saveModuleQuestion" method="post" id="addModuleForm">
  <input type="hidden" name="startTime" id="modStartTime" value=""> 
  <input type="hidden" name="endTime" id="modEndTime" value="">
  <input type="hidden" name="optTime" id="modOptTime" value="">
  <div class="container top100">
    <div class="row">

      <div class="col-md-8 upperbutton" style="text-align: right;">
        <div class="blue_photo bottom10">
          <button class="btn btn-primary" type="submit" id="saveBtn">Save</button>
        </div>

        <div class="blue_photo bottom10">
          <!--  <button class="btn btn-primary" type="button" id="modulePrevBtn" disabled="true">Preview</button> -->
          <a class="btn btn-primary" type="button" id="modulePrevBtn" disabled="true" style="width: 95px;padding: 6px 0px;">Preview</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="bottom10" style="margin:5px">
         <strong><a style="text-decoration: underline;" href="question-list">All question</a></strong>
        </div>
      </div>
    </div>

    
    <div class="row">

      <div class="col-md-4 col-md-offset-4 upperbutton">

      </div>

    </div>

    <div class="row">

      <div class="col-md-2">

        <input type="hidden" class="form-control" name="instruction">

        <div class="form-group color_btn top10">
          <label for="exampleInputName2" >Module Name</label>
          <input type="text" class="form-control" name="moduleName" required>
        </div>

        <div class="form-group color_btn top10">
          <label for="exampleInputName2" >Tracker Name</label>
          <input type="text" class="form-control" name="trackerName" required>
        </div>

        <div class="form-group color_btn top10">
          <label for="exampleInputName2" >Individual Name</label>
          <input type="text" class="form-control" name="individualName">
        </div>

        <div class="form-group color_btn top10">
          <div id="hide_date">
      <label for="exampleInputName2" >Date</label>
          <div class="form-group color_btn">
            <div class="input-group date" id="datetimepicker1">
              <input type="text" class="form-control enterDate" id="enterDate" name="dateCreated" autocomplete="off">
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
            <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="isSMS">
          </div>

          
          <?php
            $user_type = $user_info[0]['user_type'];
            $parent_id = $user_info[0]['parent_id'];
            $unlimited = $user_info[0]['unlimited'];
            $subcription = $user_info[0]['end_subscription'];
            $subscription_type = $user_info[0]['subscription_type'];
            if ($subscription_type == 'trial') {

              $tbl_setting = $this->db->where('setting_key','days')->get('tbl_setting')->row();
              $duration = $tbl_setting->setting_value;
              $trail_start_date = date('Y-m-d',$user_info[0]['created']);
              $trail_end_date  = date('Y-m-d', strtotime('+'.$duration.' days', strtotime($trail_start_date)));
              $today = date('Y-m-d');
              $diff = strtotime($trail_end_date) - strtotime($today);
              $days = floor($diff/(60*60*24));
            }
			       // echo $subcription;
            if (isset($subcription) && !empty($subcription)) {
              $end_subscription = $user_info[0]['end_subscription'];
              $date1 = date('Y-m-d',strtotime($end_subscription));
              $date2 = date('Y-m-d');
            }

           if (isset($user_type) && $user_type == 7) { ?>
            <div class="form-check  sms_check" style=" padding-top: 20px; ">
              <label class="form-check-label" for="defaultCheck1" style=" font-size: 13px; ">
                Assign for all student
              </label>
              <input class="form-check-input" type="checkbox" value="1" id="isAllStudent" name="isAllStudent">
            </div>
		 <?php }else if($parent_id != null){ ?>
            <div class="form-check  sms_check" style=" padding-top: 20px; ">
              <label class="form-check-label" for="defaultCheck1" style=" font-size: 13px; ">
                Assign for all student
              </label>
              <input class="form-check-input" type="checkbox" value="1" id="isAllStudent" name="isAllStudent">
            </div>
		      <?php }else if($unlimited == 1){ ?>
            <div class="form-check  sms_check" style=" padding-top: 20px; ">
              <label class="form-check-label" for="defaultCheck1" style=" font-size: 13px; ">
                Assign for all student
              </label>
              <input class="form-check-input" type="checkbox" value="1" id="isAllStudent" name="isAllStudent">
            </div>
          <?php }else if($days > 0){ ?>
            <div class="form-check  sms_check" style=" padding-top: 20px; ">
              <label class="form-check-label" for="defaultCheck1" style=" font-size: 13px; ">
                Assign for all student
              </label>
              <input class="form-check-input" type="checkbox" value="1" id="isAllStudent" name="isAllStudent">
            </div>
          <?php }else{ ?>
            <?php if (isset($subcription) && !empty($subcription)){ ?>
              <div class="form-check  sms_check" style=" padding-top: 20px; ">
                <label class="form-check-label" for="defaultCheck1" style=" font-size: 13px; ">
                  Assign for all student
                </label>
                <input class="form-check-input" type="checkbox" value="1" id="isAllStudent" name="isAllStudent" <?=($date1 < $date2)?"disabled":"";?>>
              </div>
            <?php }else{ ?>
              <div class="form-check  sms_check" style=" padding-top: 20px; ">
                <label class="form-check-label" for="defaultCheck1" style=" font-size: 13px; ">
                  Assign for all student 

                </label>
                <input class="form-check-input" type="checkbox" value="1" id="isAllStudent" name="isAllStudent" disabled>
              </div>
            <?php }?>
          <?php }?>



          <?php
            $user_type = $user_info[0]['user_type'];
            $parent_id = $user_info[0]['parent_id'];
            $subcription = $user_info[0]['end_subscription'];
            $unlimited = $user_info[0]['unlimited'];
            if (isset($subcription) && !empty($subcription)) {
              $end_subscription = $user_info[0]['end_subscription'];
              $date1 = date('Y-m-d',strtotime($end_subscription));
              $date2 = date('Y-m-d');
            }
           if (isset($user_type) && $user_type == 7) { ?>

              <div class="form-group color_btn" style=" padding-top: 20px; ">
                <label for="exampleInputEmail2">Assign for individual</label>
                <div class="select" id="indivStdDiv">
                  <div style="display: none;" id="hiddenAllStds"><?php echo $allStudents; ?></div>
                  <select class="form-control select2" multiple="multiple" name='individualStudent[]' id="individualStudent">
                    <?php echo $allStudents; ?>
                  </select>
                </div>
              </div>
           <?php }else if($parent_id != null){ ?>
            <div class="form-group color_btn" style=" padding-top: 20px; ">
                <label for="exampleInputEmail2">Assign for individual</label>
                <div class="select" id="indivStdDiv">
                  <div style="display: none;" id="hiddenAllStds"><?php echo $allStudents; ?></div>
                  <select class="form-control select2" multiple="multiple" name='individualStudent[]' id="individualStudent">
                    <?php echo $allStudents; ?>
                  </select>
                </div>
              </div>
		 <?php }else if($unlimited == 1){ ?>
            <div class="form-group color_btn" style=" padding-top: 20px; ">
                <label for="exampleInputEmail2">Assign for individual</label>
                <div class="select" id="indivStdDiv">
                  <div style="display: none;" id="hiddenAllStds"><?php echo $allStudents; ?></div>
                  <select class="form-control select2" multiple="multiple" name='individualStudent[]' id="individualStudent">
                    <?php echo $allStudents; ?>
                  </select>
                </div>
              </div>
     <?php }else if($days > 0){ ?>
            <div class="form-group color_btn" style=" padding-top: 20px; ">
                <label for="exampleInputEmail2">Assign for individual</label>
                <div class="select" id="indivStdDiv">
                  <div style="display: none;" id="hiddenAllStds"><?php echo $allStudents; ?></div>
                  <select class="form-control select2" multiple="multiple" name='individualStudent[]' id="individualStudent">
                    <?php echo $allStudents; ?>
                  </select>
                </div>
              </div>
          <?php }else{ ?>
            <?php if (isset($subcription) && !empty($subcription)){ ?>
                <div class="form-group color_btn" style=" padding-top: 20px; ">
                  <label for="exampleInputEmail2">Assign for individual</label>
                  <div class="select" id="indivStdDiv">
                    <div style="display: none;" id="hiddenAllStds"><?php echo $allStudents; ?></div>
                    <select class="form-control select2" multiple="multiple" name='individualStudent[]' id="individualStudent" <?=($date1 < $date2)?"disabled":"";?>>
                      <?php echo $allStudents; ?>
                    </select>
                  </div>
                </div>
            <?php }else{ ?>
              <div class="form-group color_btn" style=" padding-top: 20px; ">
                <label for="exampleInputEmail2">Assign for individual</label>
                <div class="select" id="indivStdDiv">
                  <div style="display: none;" id="hiddenAllStds"><?php echo $allStudents; ?></div>
                  <select class="form-control select2" multiple="multiple" name='individualStudent[]' id="individualStudent" disabled>
                    <?php echo $allStudents; ?>
                  </select>
                </div>
              </div>
            <?php } ?>
          <!-- chec subscription -->
          <?php } ?>
          <!-- chec usertype -->


          <!-- <div class="form-check" style=" padding-top: 20px; ">
            <label class="form-check-label"  for="" style=" font-size: 13px; ">
              Choose questions
            </label>
            <input class="form-check-input chooseQues" type="checkbox" value="" id="chooseQues">
          </div> -->

          <div class="form-check" style=" padding-top: 20px;cursor: pointer;">
            <a onclick="show_video_link()" style="font-size: 13px;font-weight: 600;">Video Link & Instruction</a>
          </div>

        </div>
      </div>
      <div class="col-md-10">
        <div class="row">
         <div class="col-md-2">
          <div class="form-group color_btn">
           <label for="exampleInputName2">Country</label>
           <div class="select">
            <select class="form-control select-hidden" name="country" required id="country_id" onchange="individual_student()">
              <?php echo $all_country; ?>
            </select>
          </div>
        </div>

      </div>

      <div class="col-md-2">
        <div class="form-group color_btn">
          <label for="exampleInputEmail2">Grade/Year/Level</label>
          <div class="select">
            <select class="form-control select-hidden select2" id="studentGrade" name="studentGrade" required onchange="individual_student();<?php if ($loggedUserType == 7) {
              ?>get_course(this)<?php
            }?>">
            <?php for ($a = 1; $a <= 13; $a++) : ?>
              <?php if ($a >= 13) : ?>
                <option value="<?php echo $a ?>">Upper Level</option>
                <?php else : ?>
                  <option value="<?php echo $a ?>"><?php echo $a; ?></option>
                <?php endif; ?>
              <?php endfor; ?>
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
            <!-- <select class="form-control select-hidden select2" name="subject" id="subject" required  onchange="individual_student()"> -->
              <select class="form-control select-hidden select2" name="subject" id="subject" required>
                <?php if ($loggedUserType != 7){?>
                    <?php echo $all_subjects; ?>
                  <?php }?>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group color_btn">
            <label for="exampleInputEmail2">Chapter</label>
            <div class="select">
              <select class="form-control select-hidden select2" name='chapter'  id="chapter">
                <?php //echo $all_chapters ?>
              </select>  
            </div>
          </div>
        </div>

        <?php if ($loggedUserType == 7) {?>
          <div class="col-md-2">
            <div class="form-group color_btn">
              <label for="exampleInputEmail2">Course</label>
              <div class="select">
                <select class="form-control select-hidden select2" style="width: 225px;" name='course_id' id="course_id" onchange="individual_student()" required>

                </select>  
              </div>
            </div>
          </div>
        <?php }?>

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
                      <span>Video</span>
                    <!--<span style="float:right;">
                      <a href="#" style=" color: #fff;" data-toggle="modal" data-target="#exampleModal">Link 
                        <i class="fa fa-film"></i>
                      </a>
                    </span>-->
                  </h4>
                </div>
                <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <textarea class="video_textarea" name="video_link_1[]" id="editor_1"></textarea>
                </div>
              </div>
            </div>

            <div class="col-md-5 top10">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne" style="color: #fff;background-color: #1f3366;padding: 2px 8px;">
                  <h4 class="panel-title">
                      <span>Instruction</span>
                    <!--<span style="float:right;">
                      <a href="#" style=" color: #fff;" data-toggle="modal" data-target="#exampleModal">Link 
                        <i class="fa fa-film"></i>
                      </a>
                    </span>-->
                  </h4>
<!--                    <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne" style="color: #fff;">Instruction</a>
                  </h4>-->
                </div>
                <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <textarea class="instruction_textarea" name="instruction_1[]" id="instruct_1"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 top10">
              <label for="videoName">Video Name:</label>
            </div>
            <div class="col-md-5 top10">
              <div class="panel panel-default">
                <input type="text" name="videoName" id="videoName" style="background-color: none;">
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
              <span>Instruction</span>
              <!--<a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne" style="color: #fff;">Instruction</a>-->
            </h4>
            </div>
            <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <textarea class="instruction_textarea" name="instruction_<?php echo $desired_i; ?>[]" id="instruct_<?php echo $desired_i; ?>"></textarea>
            </div>
          </div>
        </div>
            </div>
          <?php }?>
        </div>

        

      </div>


      <!--End Video Link-->

      <input type="hidden" name="image_quantity" id="image_quantity" value="">

    </div>
  </div>


</div>
</div>
</form>

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
                <input type="text" class="form-control enterDate" id="timeStart" name="dateCreated" autocomplete="off">
                <span class="input-group-addon">
                  <span class="fa fa-clock-o"></span>
                </span>
              </div>
            </div>
            <label  class="control-label small text-muted col-md-1">To</label>
            <div class="col-md-3">
              <div class="input-group date" id="datetimepicker1">
                <input type="text" class="form-control enterDate" id="timeEnd" name="dateCreated" autocomplete="off">
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
                <input type="text" class="form-control enterDate" id="optTime" name="dateCreated" autocomplete="off">
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

<!-- question preview modal -->
<div class="modal fade question-preview-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h6 class="modal-title" id="modal-title"></h6>
      </div>
      <div class="modal-body">
       
      </div>
    </div>
  </div>
</div> <!-- modal end -->

<script>
  var qtye = $("#box_qty").val();
//    alert(qtye);
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
      get_course($("#studentGrade").val());

//        $("#enterDate").on('click', function () {
  $("#enterDate").datepicker({
    autoclose: true,
    todayHighlight: true,
    format: "yyyy/mm/dd",
    orientation: 'bottom',
                // onClose: function () {
                    // $(this).blur()
                // }
              });
//        })
});

    //time picker
    var startTimeTextBox = $('#timeStart');
    var endTimeTextBox = $('#timeEnd');
    $.timepicker.timeRange(
      startTimeTextBox,
      endTimeTextBox,
      {
            minInterval: (1000 * 60), // 1hr
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


    /*select2 on all students*/
    // $(document).ready(function () {
        // $('.allStudents').select2();
    // });

    /*prevent duplicate ordering*/
    $(document).ready(function () {
      $(document).on('focusout', '.questionOrder', function (e) {
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
        //generate order automatically
        var ordr = 1;
        $(document).on('change', '#quesChecked', function () {
            //console.log('hit');
            var x = $(this).siblings('#qOrdr');
            if (this.checked) {
              $(this).siblings('#qOrdr').prop('disabled', false);
              $(this).siblings('#qOrdr').prop('required', true);

              var qId = $(this).siblings('#qId').val();
              $(this).siblings('input#qId_ordr').val(qId + '_' + ordr);
              x.val(ordr++);

            } else {
              $(this).siblings('#qOrdr').prop('disabled', true);
              ordr--;
              x.val('');
            }
          });

      })


    //module save form submit & preview button enable
    $(document).on('submit', '#addModuleForm', function (e) {

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

        
        
        var text = '';
        var instruction = '';
        for (var i = 1; i <= image_quantity; i++) {

            var editor_cnt = 'editor'+'_'+i;
            //console.log(editor_cnt);
           
            text += $('#editor'+'_'+i).val();
            instruction += $('#instruct'+'_'+i).val();
            alert(text);
        } 

 
          e.preventDefault();
          if(flag == 0){

            var pathname = '<?php echo base_url(); ?>';
            var instructVideoName = $('#videoName').val();
            $.ajax({
        url: 'Module/saveModuleQuestion',
        method: 'POST',
        data: $(this).serialize()+ "&video_link="+text + "&video_name="+ instructVideoName +"&instruction="+ instruction,
        success: function (data) {
                //console.log(data);
          if (data == 'false') {
            alert('Something is wrong.');
          } else {
            alert('Module added successfully.');
            $('#modulePrevBtn').attr('disabled', false);
            $("#modulePrevBtn").attr("href", pathname + 'module_preview/' + data + '/1');
            $('#saveBtn').attr('disabled', true);
                    } //end else
                } //end success
            });
            
          } if(flag == 1){
            alert('You Need to Maintain the Sequence of Question Order');
          }
        });

    /*work as a  question search function*/
    function getQuestion() {
      var studentGrade = $("#studentGrade :selected").val();
      var subject = $("#subject :selected").val();
      var chapter = $("#chapter :selected").val();
      console.log(studentGrade);
      console.log(subject);
      console.log(chapter);
      $.ajax({
        url: 'Module/quesSearch',
        method: 'POST',
        dataType:'json',
        data: {studentGrade: studentGrade, subject: subject, chapter: chapter},
        success: function (data) {
          data = JSON.stringify(data);
          data = JSON.parse(data);
          $('#allQuestion').html(data.row);
        }
      })
    }

    /*get all question by search params on check choose question*/
    $(document).on('change', '.chooseQues', function () {
      if (this.checked) {
        getQuestion();
      } else {
        $('#allQuestion').html('');
      }
    });

    //after change on each params(student grade/subject/chapter) on search update question items
    $(document).on('change', '#studentGrade', function(){
      getQuestion();    
    });

    $(document).on('change', '#subject', function(){
     getQuestion();   
   });

    $(document).on('change', '#chapter', function(){
      getQuestion();
    });

    /*assign all student checkbox check*/
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

    //prevent assigning indiv student without subject
    $(document).on('click', '#indivStdDiv', function () {
      var userType = $('#userType').val();
      var selectedSub = $("#subject :selected").val();
      if (userType == 7 && selectedSub.length == 0) {
            // alert('Pleased choose a subject first');
          }
        });

    //get chapters of subject
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

        //get all student form a course that matched with the subject selected
        // $.ajax({
            // url: 'Module/getStudentByCourse',
            // method: 'POST',
            // data: {subjectId: subjectId},
            // success: function (data) {
                // $('#individualStudent').html(data);
            // }
        // })
      });


    function  individual_student(){
      var studentGrade = $("#studentGrade :selected").val();
      var subject = $("#subject :selected").val();
      var country_id = $("#country_id").val();
      var tutor_type = '<?php echo $loggedUserType?>';
      <?php if ($loggedUserType == 7) {?>
        var course_id = $("#course_id :selected").val();
      <?php }?>

      //if(studentGrade != '' && country_id != ''){
        $.ajax({

          url: 'getIndividualStudent',
          method: 'POST',
          data: {
            studentGrade: studentGrade,
            country_id: country_id,
            subject: subject,
            tutor_type: tutor_type,
            <?php if ($loggedUserType == 7) {?>
              course_id : course_id
            <?php }?>
          },
          success: function (data) {
            //console.log(data);
            $('#individualStudent').html(data);
          }
        });
    
    
    <?php if ($loggedUserType == 7) {?>
        var html = '';
        $.ajax({
            type: 'POST',
            url: 'Module/assign_subject_by_course',
            data: {course_id:course_id},
            dataType: 'html',
            success: function (results) {
                html = results;
                $("#subject").html(html);
            }
        });
        <?php }?>
      //}
    }
    
    function get_course(e) {
      $.ajax({
        url: 'get_course',
        method: 'POST',
        data: {
          studentGrade: e.value
        },
        success: function (data) {
          console.log(data);
          $('#course_id').html(data);
        }
      });

    }

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
          '/',
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

    })


  </script>


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
            $("#time_ranger").show();
        }
        if(e.value == '2')
        {
            $("#hide_date").show();
            $("#time").show();
            $("#time_ranger").hide();
        }
    }
</script>