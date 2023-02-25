<style>
  .bluebutton,
  .bluebutton:hover {
    background: #00a2e8;
    padding: 2px 6px 2px 4px;
  }

  .bluebutton label {
    display: flex;
    align-items: center;
    color: #fff;
    flex-direction: row;
  }

  .ss_q_btn {
    margin-top: 21px;
  }

  .ml-auto {
    margin-left: auto;
  }

  .checkbox,
  .form-group {
    display: block !important;
    margin-bottom: 10px !important;
  }

  .form-control {
    width: 100% !important;
  }

  .createQuesLabel {
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

  .question_tutorial:hover {
    background: transparent !important;
  }

  .sss_ans_set {
    position: absolute;
    bottom: -158px;
    width: 30%;
    margin-top: 16px;
  }

  .select2-container {
    max-width: 150px;
  }

  .question_heading {
    display: flex;
    align-items: center;
    background: #808080;
    font-size: 16px;
    padding: 5px;
  }

  .question_body {
    display: flex;
    align-items: center;
    border: 1px solid #808080;
    font-size: 16px;
    padding: 5px;
    gap:20px;
  }

  .question_body .btn {
    background: #808080;
    color: #fff;
    border-radius: 0;
    border: none;
  }

  .question_heading a {
    color: #fff;
  }

  .question_heading_right {
    margin-left: auto;
    color: #fff;
  }

  .question_heading_right input {
    margin-left: 5px;
    background: #fff;
    color: #000;
    border: none;
  }

  .question_footer .btn {
    display: block;
    width: 100%;
    border-radius: 0;
    border: none;
    background: #4bbcc0;
    padding: 10px 5px;
  }

  #login_form .modal-dialog, .ss_modal .modal-dialog {
    margin-top: 16%;
    max-width: 400px;
  }

  .col-sm-2.panel-box {
    min-height: 136px;
  }
  .container-fluid {
    width: 99%;
  }
  .changeWithIcon{
    position: relative;
  }
  .icon_change{
    display:none;
    /* position: absolute;
    bottom: 15px;
    left: 0;
    width: 100%;
    z-index: 10; */
  }
  .icon_change_chapter{
    display:none;
    /* position: absolute;
    bottom: 15px;
    left: 0;
    width: 100%;
    z-index: 10; */
  }
  .icon_change_hidden{
    display:flex;
    position:absolute;
    bottom: 60px;
    left: 0;
  }
</style>

<!-- <div class="container top100"> -->
<input type="hidden" name="chapter" id="get_chapter_value">
<div>
  <div class="row">
    <div class="col-md-12 text-center">
      <?php if ($this->session->userdata('success_msg')) : ?>
        <div class="alert alert-success alert-dismissible show" role="alert">
          <strong><?php echo $this->session->userdata('success_msg'); ?></strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php elseif ($this->session->userdata('error_msg')) : ?>
        <div class="alert alert-danger alert-dismissible show" role="alert">
          <strong><?php echo $this->session->userdata('error_msg'); ?></strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

    </div>
    <?php if ($_SESSION['userType'] == 7) { ?>
      <div class="col-md-12 upperbutton" style="text-align: center;margin-bottom: 10px;">
        <a href="view-course" style="font-size:22px;color:#8e9295;display: inline-block;">Module Inbox</a>
      </div>
    <?php } ?>
    <div class="col-md-12 upperbutton" style="text-align: center;margin-bottom: 10px;">
      <a href="create-module" style="font-size:22px;color:#4bbcc0;text-decoration:underline;display: inline-block;">Create Module</a>
      <a href="details-module" style="font-size:22px;color:#8e9295;text-decoration:underline;display: inline-block;margin-left:10px;">Module Details</a>
    </div>
  </div>
   <?php 
   //echo $module_cre_info['module_name'];
   //print_r($module_cre_info);die();
   ?>
  <div class="">
    <!--============================================
                  new module start
    ==============================================-->
    <input type="hidden" id="userType" value="<?php echo $loggedUserType; ?>">

    <form action="save_new_module_question" method="post" onkeydown="return event.key != 'Enter';" id="moduleCreate">

 

      <div class="row"  id="main_css">

        <div class="col-sm-12">

          <div class="ss_question_add_top" style="overflow: inherit;">
            <p id="error_msg" style="color:red"></p>
            <input type="hidden" class="form-control" name="instruction">

          <div class="form-group" style="float: left;margin-right: 10px;">
            <button type="button" class="btn btn-default" style="margin-top: 18px;">
              <label for="formInputButton">Show <span><input type="checkbox" name="show_student" id="formInputButton" value="1" <?php if(!empty($module_cre_info['show_student'])){if($module_cre_info['show_student']==1){echo "checked";}}?>></span> </label>
            </button>
          </div>
            

            <div class="form-group" style="float: left;margin-right: 10px">
              <button type="button" class="btn btn-default bluebutton" style="margin-top: 18px;">
                <label for="formInputButton1">SL

                  <select name="serial" id="formInputButton1" class="form-control" style="height: 31px; margin-left: 4px;" >
                    <?php for ($i = 1; $i < 100; $i++) { ?>
                      <option value="<?= $i ?>" <?php if(!empty($module_cre_info['serial'])){if($module_cre_info['serial']==$i){echo "selected";}}?>><?= $i ?></option>
                    <?php } ?>
                  </select>

                </label>
              </button>
            </div>

            <div class="form-group" style="float: left;margin-right: 10px;">

              <label for="exampleInputName2">
                Module Name
                <span data-toggle="modal" data-target="#add_subject"><img src="assets/images/icon_new.png"> <i class="fa fa-info-circle module_name_icon" aria-hidden="true" style="color:#ffa500;"></i></span>
              </label>

              <?php $modName = isset($_SESSION['modInfo']['moduleName']) ? $_SESSION['modInfo']['moduleName'] : ''; ?>
              <input type="text" class="form-control createQuesLabel " style="max-width:150px" name="moduleName" id="moduleName" value="<?php if(!empty($module_cre_info['module_name'])){echo $module_cre_info['module_name'];}?>" required>
            </div>

            <div class="form-group changeWithIcon" style="float: left;margin-right: 10px;max-width: 125px;<?php if(empty($module_cre_info['subject_id'])){echo "display:none !important;";}?>" id="subject_show">

              <div class="icon_change">
                  <a class="ss_q_btn btn pull-left " type="button" id="edit_subject" style="display: block;">
                  <i class="fa fa-file-o" aria-hidden="true"></i> Rename</a>

                  <a class="ss_q_btn btn pull-left subject_delete" href="javascript:void(0)"><i class="fa fa-trash" aria-hidden="true"></i></a>
              </div>

              <label for="exampleInputName2">Subject<span id="addNewSubject"><img src="assets/images/icon_new.png"> New </span><i class="fa fa-info-circle module_subject_icon" aria-hidden="true" style="color:#ffa500;"></i></label>
              <select class="form-control createQuesLabel" name="subject" id="subject_id">
                <option value="">---Select one---</option>
                <?php foreach($allsubjects as $subject){?>
                  <option class="subject<?=$subject['subject_id']?>" value="<?=$subject['subject_id']?>"<?php if(!empty($module_cre_info['subject_id'])){if($module_cre_info['subject_id']==$subject['subject_id']){echo "selected";}}?>><?=$subject['subject_name']?></option>
                <?php }?>
                
              </select>
            </div>
            
            <div class="form-group changeWithIcon" style="float: left;margin-right: 20px;max-width: 175px;<?php if(empty($module_cre_info['chapter_id'])){echo "display:none !important;";}?>" id="chapter_show">
             
                <div class="icon_change_chapter">
                    <a class="ss_q_btn btn pull-left " type="button" id="edit_chapter" style="display: block;">
                    <i class="fa fa-file-o" aria-hidden="true"></i> Rename</a>

                    <a class="ss_q_btn btn pull-left chapter_delete" href="javascript:void(0)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </div>

              <label for="exampleInputName2">Chapter<span id="addNewChapter">
                <img src="assets/images/icon_new.png"> New </span>
                <i class="fa fa-info-circle module_chapter_icon" aria-hidden="true" style="color:#ffa500;"></i>
                <i class="fa fa-clone module_chapter_copy" aria-hidden="true" style="color:#ffa500;"></i>
                <i class="fa fa-clipboard module_chapter_paste" aria-hidden="true" style="color:#ffa500;"></i>
              </label>
              <select class="form-control createQuesLabel" name="chapter" id="chapter_id">
                <option value="">---Select one---</option>
                <?php foreach($allchapters as $chapter){?>
                  <option class="chapter<?=$chapter['id']?>" value="<?=$chapter['id']?>" <?php if(!empty($module_cre_info['chapter_id'])){if($module_cre_info['chapter_id']==$chapter['id']){echo "selected";}}?>><?=$chapter['chapterName']?></option>
                <?php }?>
              </select>
            </div>

            <div class="form-group" style="float: left;margin-right: 10px;">
              <label for="exampleInputName2">Grade</label>
              <select class="form-control createQuesLabel" name="studentGrade" id="grade_id">
                <option value="">Grade</option>
                <?php $grades = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]; ?>
                <?php foreach ($grades as $grade) { ?>
                  <option value="<?php echo $grade ?>" <?php if(!empty($module_cre_info['grade_id'])){if($module_cre_info['grade_id']==$grade){echo "selected";}}?>>
                    <?php echo $grade; ?>
                  </option> 
                <?php } ?>
              </select>
            </div>

            <div class="form-group" style="float: left;margin-right: 10px;max-width: 110px;">
              <label>Module Type</label>

              <select class="form-control createQuesLabel subject select2" name="moduleType" id="module_type">
                <option value="">---Select---</option>
                <?php foreach ($module_types as $module_type) { ?>
                  <option class="option" value="<?php echo $module_type['id'] ?>" <?php if(!empty($module_cre_info['module_type'])){if($module_cre_info['module_type']==$module_type['id']){echo "selected";}}?>>
                    <?php echo $module_type['module_type']; ?>
                  </option>
                <?php } ?>
              </select>
            </div>

            <?php if($_SESSION['userType'] != 3){ ?>
              <div class="form-group" style="float: left;margin-right: 10px;max-width: 145px;">
                <label>Course Name<span data-toggle="modal" data-target="#add_course"><img src="assets/images/icon_new.png"> New</span></label>
                <select class="form-control createQuesLabel select2" name="course_id" id="subject_chapter" onchange="individual_student()">
                  <option value="">---Select---</option>
                  <?php foreach ($courses as $course) { ?>
                    <option class="option" value="<?php echo $course['id'] ?>" <?php if(!empty($module_cre_info['module_type'])){if($module_cre_info['course_id']==$course['id']){echo "selected";}}?>>
                      <?php echo $course['courseName']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            <?php }?>

            <a class="ss_q_btn btn btn_red pull-left " id="questionSetting">
              Question
            </a>

            <a class="ss_q_btn btn pull-left " href="javascript:void(0)"><i class="fa fa-remove" aria-hidden="true"></i> Cancel</a>
            <input type="button" class="btn btn-danger ss_q_btn module_submit" value="Save"/>

            <a class="ss_q_btn btn pull-left " href="javascript:void(0)" id="preview_btn" style="display: none;">
              <i class="fa fa-file-o" aria-hidden="true"></i> Preview
            </a>

            <a class="ss_q_btn btn pull-left " href="javascript:void(0)"><i class="fa fa-clipboard" aria-hidden="true"></i></a>
            <a class="ss_q_btn btn pull-left " href="javascript:void(0)"><i class="fa fa-trash" aria-hidden="true"></i></a>

          </div>
          <div style="clear:both">

          </div>
          <div class="row">
          <?//php if ($_SESSION['userType'] == 3) { ?>
            <div class="col-md-2">
              
            <div class="form-group color_btn top10">
          <label for="exampleInputName2" >Tracker Name</label>
          <input type="text" class="form-control" name="trackerName" id="trackerName" required value="<?php if(!empty($module_cre_info['trackerName'])){echo $module_cre_info['trackerName'];}?>">
        </div>

        <div class="form-group color_btn top10">
          <label for="exampleInputName2" >Individual Name</label>
          <input type="text" class="form-control" name="individualName" id="individualName" value="<?php if(!empty($module_cre_info['individualName'])){echo $module_cre_info['individualName'];}?>">
        </div>

        <div class="form-group color_btn top10">
          <div id="hide_date">
          <label for="exampleInputName2" >Date</label>
          <div class="form-group color_btn">
            <div class="input-group date" id="datetimepicker1">
              <input type="text" class="form-control enterDate" id="enterDate" name="dateCreated" autocomplete="off"  value="<?php if(!empty($module_cre_info['enterDate'])){echo $module_cre_info['enterDate'];}?>">
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
            <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="isSMS"  <?php if(!empty($module_cre_info['isSms'])){if($module_cre_info['isSms']==1){echo "checked";}}?>>
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
              <input class="form-check-input" type="checkbox" value="1" id="isAllStudent" name="isAllStudent" <?php if(!empty($module_cre_info['isAllStudent'])){if($module_cre_info['isAllStudent']==1){echo "checked";}}?>>
            </div>
		 <?php }else if($parent_id != null){ ?>
            <div class="form-check  sms_check" style=" padding-top: 20px; ">
              <label class="form-check-label" for="defaultCheck1" style=" font-size: 13px; ">
                Assign for all student
              </label>
              <input class="form-check-input" type="checkbox" value="1" id="isAllStudent" name="isAllStudent" <?php if(!empty($module_cre_info['isAllStudent'])){if($module_cre_info['isAllStudent']==1){echo "checked";}}?>>
            </div>
		      <?php }else if($unlimited == 1){ ?>
            <div class="form-check  sms_check" style=" padding-top: 20px; ">
              <label class="form-check-label" for="defaultCheck1" style=" font-size: 13px; ">
                Assign for all student
              </label>
              <input class="form-check-input" type="checkbox" value="1" id="isAllStudent" name="isAllStudent" <?php if(!empty($module_cre_info['isAllStudent'])){if($module_cre_info['isAllStudent']==1){echo "checked";}}?>>
            </div>
          <?php }else if($days > 0){ ?>
            <div class="form-check  sms_check" style=" padding-top: 20px; ">
              <label class="form-check-label" for="defaultCheck1" style=" font-size: 13px; ">
                Assign for all student
              </label>
              <input class="form-check-input" type="checkbox" value="1" id="isAllStudent" name="isAllStudent" <?php if(!empty($module_cre_info['isAllStudent'])){if($module_cre_info['isAllStudent']==1){echo "checked";}}?>>
            </div>
          <?php }else{ ?>
            <?php if (isset($subcription) && !empty($subcription)){ ?>
              <div class="form-check  sms_check" style=" padding-top: 20px; ">
                <label class="form-check-label" for="defaultCheck1" style=" font-size: 13px; ">
                  Assign for all student
                </label>
                <input class="form-check-input" type="checkbox" value="1" id="isAllStudent" name="isAllStudent" <?=($date1 < $date2)?"disabled":"";?> <?php if(!empty($module_cre_info['isAllStudent'])){if($module_cre_info['isAllStudent']==1){echo "checked";}}?>>
              </div>
            <?php }else{ ?>
              <div class="form-check  sms_check" style=" padding-top: 20px; ">
                <label class="form-check-label" for="defaultCheck1" style=" font-size: 13px; ">
                  Assign for all student 

                </label>
                <input class="form-check-input" type="checkbox" value="1" id="isAllStudent" name="isAllStudent" disabled <?php if(!empty($module_cre_info['isAllStudent'])){if($module_cre_info['isAllStudent']==1){echo "checked";}}?>>
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
            <?//php  }else{ ?>
              <!-- <div class="col-md-12"> -->
            <?//php  } ?>  
            <div class="row panel-box1 question_drag">
            <?php $i = $question_list[0]['count'];
            $j = 1;
            // echo "<pre>"; print_r($question_list);die();
            foreach ($question_list as $key => $list) : ?>
              <div class="col-sm-2 question_box box box_<?= $key; ?>" data-id="<?= $list['tbl_id'] ?>" data-type="<?= $list['questionType']; ?>" data-qid="<?= $list['id']; ?>">

                <div class="question_list" style="margin-top:20px">
                  <div class="question_heading">
                    <a href="<?php echo base_url('question-list/1/0/') . $list['tbl_id'] ?>">Edit</a>
                    <div class="question_heading_right">
                      Q<input type="text" data-questionOrder="<?=$list['question_order']?>" data-question="<?=$list['id']?>" style="width: 50px;" class="text-center question_sorting_create" value="<?= $list['question_order']; ?>" data-tblid="<?= $list['tbl_id']; ?>">
                    </div>
                  </div>
                  <div class="question_body">
                    <a href="<?php echo base_url('question_edit/' . $list['questionType'] . '/' . $list['id']); ?>/1" class="btn btn-default">
                      Q <?= $list['order']; ?>
                    </a>
                    <a class="ml-auto" href="javascript:;">
                      <img src="assets/images/question.png">
                    </a>
                  </div>
                  <div class="question_footer">
                    <button class="btn btn-primary" style="<?php if($list['questionType']==22){echo "background-color:#ff7f27";}?>"><?= $list['question_name']['questionType'] ?></button>
                  </div>
                </div>

              </div>
            <?php $i++;
              $j++;
            endforeach; ?>
          </div>
            </div>

          </div>

        </div>

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
                  <textarea class="video_textarea" name="video_link_1[]" id="video_link_1"><?php if(!empty($module_cre_info['video_link_1'])){echo $module_cre_info['video_link_1'];}?></textarea>
                </div>
              </div>
            </div>

            <div class="col-md-5 top10">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne" style="color: #fff;background-color: #1f3366;padding: 2px 8px;">
                  <h4 class="panel-title">
                      <span>Instruction</span>
                  </h4>
                </div>
                <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <textarea class="instruction_textarea" name="instruction_1[]" id="instruct_1"><?php if(!empty($module_cre_info['instruct_1'])){echo $module_cre_info['instruct_1'];}?></textarea>
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
                <input type="text" name="videoName" id="videoName" style="background-color: none;" value="<?php if(!empty($module_cre_info['videoName'])){echo $module_cre_info['videoName'];}?>">
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
<!--modal add time optional and specific-->
<div class="modal fade" id="setTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Set Time</h4>
      </div>
      <div class="modal-body">
       
          <div class="form-group row" id="time_ranger">
            <label for="recipient-name" class="control-label col-md-3">Time Range:</label>
            <div class="col-md-3">
              <div class="input-group date" id="datetimepicker1">

                <input type="text" class="form-control enterDate" id="timeStart" name="startTime" autocomplete="off" value="<?php if(!empty($module_cre_info['timeStart'])){echo $module_cre_info['timeStart'];}?>">
                
                <span class="input-group-addon">
                  <span class="fa fa-clock-o"></span>
                </span>
              </div>
            </div>
            <label class="control-label small text-muted col-md-1">To</label>
            <div class="col-md-3">
              <div class="input-group date" id="datetimepicker1">

                <input type="text" class="form-control enterDate" id="timeEnd" name="endTime" autocomplete="off" value="<?php if(!empty($module_cre_info['timeEnd'])){echo $module_cre_info['timeEnd'];}?>">

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

                <input type="text" class="form-control enterDate" id="optTime" name="optTime" autocomplete="off" value="<?php if(!empty($module_cre_info['optTime'])){echo $module_cre_info['optTime'];}?>">

                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>

       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modTimeSetBtn">OK</button>
      </div>
    </div>
  </div>
</div>

  <input type="hidden" name="video_name" id="video_name" value="">
  <input type="hidden" name="video_link" id="video_link" value="">
  <input type="hidden" name="instruction" id="instruction" value="">
</form>

</div>

<div class="modal fade ss_modal" id="add_course" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel" style="text-align:center;">ADD COURSE</h4>
      </div>
      <div class="modal-body row">
        <label>Course Name</label> <br><br>
        <input type="text" id="course_name" class="form-control">
        <div id="qPasswordErr" style="color: red;font-weight: 800"></div>

        <br>
        <label>Course Cost ($)</label> <br><br>
        <input type="number" id="course_cost" class="form-control">
        <div id="qPasswordErr" style="color: red;font-weight: 800"></div>

      </div>
      <div class="modal-footer">
        <button  data-dismiss="modal"  type="button" class="btn btn_blue" id="save_course">ADD</button>
      </div>
    </div>
  </div>
</div>

<!-- qstudyPassword -->

<div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <label>Enter your q-study password</label> <br>
        <input type="password" id="qPassword" class="form-control" placeholder="Enter your q-study password">
        <div id="qPasswordErr" style="color: red;font-weight: 800"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" onclick="qPassword()">Submit</button>
      </div>
    </div>
  </div>
</div>

<!-- delete module -->
<div class="modal fade" tabindex="-1" role="dialog" id="moduleDelModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Really want to delete module?</h5>
      </div>
      <div class="modal-body text-center">
        <input type="hidden" value="" id="moduleToDel">
        <button type="button" class="btn btn-danger" id="moduleDltBtn">YES</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- duplicate module -->
<div class="modal fade" tabindex="-1" role="dialog" id="moduleDuplicateModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Really want to duplicate module?</h5>
      </div>

      <div class="modal-body text-center">


        <div class="row">

          <form class="form-horizontal" id="moduleDuplicateForm">
            <div class="col-md-10">
              <input type="hidden" name="origModId" id="origModId" val="">
              <!-- <input type="hidden" name="subject" id="subject" val=""> -->
              <input type="hidden" name="course" id="course" val="">
              <input type="hidden" name="country" id="country" val="">

              <input type="hidden" name="startTime" id="modStartTime" value="">
              <input type="hidden" name="endTime" id="modEndTime" value="">
              <input type="hidden" name="optTime" id="modOptTime" value="">

              <div class="form-group row">
                <label for="exampleInputEmail1" class="col-sm-4">Module Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="moduleName" id="duplicateModName" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputEmail1" class="col-sm-4">Subject</label>
                <div class="col-sm-6">
                  <select class="form-control select-hidden" id="dup_moduleSubject" name="subject" onChange="dup_moduleSearchSub()" style="width: 250px;">
                    <option value="">Select....</option>
                    <?php foreach ($all_subject as $subject) { ?>
                      <?php $sel = isset($_SESSION['modInfo']['subject']) && ($subject['subject_id'] == $_SESSION['modInfo']['subject']) ? 'selected' : ''; ?>
                      <option value="<?php echo $subject['subject_id'] ?>" <?php echo $sel; ?>>
                        <?php echo $subject['subject_name']; ?>
                      </option>
                    <?php } ?>
                  </select>
                  <input type="text" class="form-control" name="subject_name" id="duplicateModSubName" style="display: none">
                </div>
                <div class="col-sm-2">
                  <button type="button" class="btn btn-sm btn-danger" id="showduplicateModSubName" value="new">New</button>
                </div>
              </div>
              <div class="form-group row"> 
                <label for="exampleInputEmail1" class="col-sm-4">Chapter</label>
                <div class="col-sm-6">
                  <div class="select">
                    <select class="form-control select-hidden" name="chapter" id="dup_moduleChapter" onChange="dup_moduleSearch()" style="width: 250px;">
                      <option value="">Select....</option>
                      <?php if (isset($_SESSION['modInfo']['chapter'])) : ?>
                        <?php echo $_SESSION['modInfo']['chapter']; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                  <input type="text" class="form-control" name="chapterName" id="duplicateModChapName" style="display: none">
                </div>
                <div class="col-sm-2">
                  <!-- <button type="button" class="btn btn-sm btn-danger" id="showduplicateModChapName">New</button> -->
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-4">Grade/Year/Level</label>
                <div class="col-sm-8">
                  <!--<input type="text" class="form-control" id="studentGrade" name="studentGrade" required readonly>-->
                  <select class="form-control" id="studentGrade" name="studentGrade">
                    <?php foreach ($grades as $stGrade) { ?>
                      <option value="<?php echo $stGrade; ?>" <?php echo $sel; ?>>
                        <?php echo $stGrade; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4">Date</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="enterDate" name="examDate" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-4">Module Type</label>
                <div class="col-sm-8">
                  <select id="select_module_type" class="form-control" name="moduleType" required>
                    <option value="">SELECT MODULE TYPE</option>
                    <?php echo $allRenderedModType; ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-4"></label>
                <div class="col-sm-4">
                  <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox1" value="1" name="respToSMS"> Respond to SMS
                  </label>
                </div>
                <div class="col-sm-4">
                  <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox2" value="1" name="isAllStudent"> For all student
                  </label>
                </div>
              </div>

              <div class="form-group row" id="time" style="display: none;">
                <label for="exampleInputName2">Time</label>
                <i class="fa fa-clock-o" style="font-size:20px;" data-toggle="modal" data-target="#setTime"></i>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-4">For individual student</label>
                <div class="col-sm-8">
                  <select id="individualStudent" class="form-control select2" name="indivStIds[]" multiple="">
                    <?php echo $allStudents; ?>
                  </select>
                  <!--                    <select id="indivStIds" class="form-control select2" name="indivStIds[]" multiple="">
                       <?php //echo $allStudents; 
                        ?> 
                      <option value="">--Student--</option>
                    </select>-->
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-4"></label>
                <div class="col-sm-2">
                  <button type="submit" class="btn btn-primary btn-sm">YES</button>
                </div>
                <div class="col-sm-2">
                  <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">NO</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div><!-- /.modal-content -->

    <div class="modal-footer">
    </div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade ss_modal" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <label>Add Subject</label> <br><br>
        <input type="text" id="subjectName" class="form-control" placeholder="Enter your Subject Name">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" onclick="saveSubject()">Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal" id="editSubjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <label>Edit Subject</label> <br><br>
        <input type="text" id="editsubjectName" class="form-control" placeholder="Enter your Subject Name">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" onclick="editSubject()">Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal" id="addChapterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <label>Add Chapter</label> <br><br>
        <input type="text" id="chapterName" class="form-control" placeholder="Enter your Chapter Name">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" onclick="saveChapter()">Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal" id="editChapterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <label>Edit Chapter</label> <br><br>
        <input type="text" id="editChapterName" class="form-control" placeholder="Enter your Chapter Name">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-id="" onclick="editChapter()">Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="copy_module_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">

        <form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="questionType" value="<?php echo $question_type ?>">
          <input type="hidden" name="module_id" value="<?php echo $module_info['id']; ?>">

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

          <div class="form-group changeWithIcon" style="float: left;margin-right: 5px;max-width: 125px;">
            <label>QuestionType

            <select class="form-control createQuesLabel subject" name="question_type">
              <option value="">Select Question</option>
              <?php foreach ($allquestiontype as $questiontype) { ?>
                <option class="option" value="<?php echo $questiontype['id'] ?>">
                  <?php echo $questiontype['questionType']; ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group changeWithIcon" style="float: left;margin-right: 5px;max-width: 125px;">
            <label>Subject

            <select class="form-control createQuesLabel subject" name="subject" id="bar_subject">
              <option value="">Select Subject</option>
              <?php foreach ($allsubjects as $subject) { ?>
                <option class="option" value="<?php echo $subject['subject_id'] ?>">
                  <?php echo $subject['subject_name']; ?>
                </option>
              <?php } ?>
            </select>

          </div>

          <div class="form-group changeWithIcon" style="float: left;margin-right: 5px;max-width: 170px;">
            <label>Chapter <span id="get_subject"><img src="assets/images/icon_new.png"> New</span>
                <i class="fa fa-clone bar_module_chapter_copy" aria-hidden="true" style="color:#ffa500;"></i>
                <i class="fa fa-clipboard bar_module_chapter_paste" aria-hidden="true" style="color:#ffa500;"></i>
            </label>

            <select class="form-control createQuesLabel" name="chapter" id="bar_chapter">
              <option value="">---Select one---</option>
              <?php foreach ($allchapters as $chapter) { ?>
                <option class="chapter<?= $chapter['id'] ?>" value="<?php echo $chapter['id'] ?>">
                  <?php echo $chapter['chapterName']; ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group" style="float: left;margin-right: 5px;max-width: 125px;">
            <label>Question</label>
            <input type="text" class="form-control createQuesLabel question_id" name="question_number" value="">

            <!-- <select class="form-control createQuesLabel question_id" name="chapter">
              <option value="">---Select one---</option>
            </select> -->

          </div>

          <input type="submit" name="submit" class="btn btn-danger ss_q_btn" value="Save" />

        </form>

      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn_blue search_module_add">OK</button>
      </div> -->
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
  $(document).ready(function() {
    $(".module_chapter_copy").click(function() {
        var copy_chapter_id = $("#chapter_id").val();
          if(copy_chapter_id != ''){
            CopyToClipboard(copy_chapter_id);
            $("#copy_chapter_success_modal").modal("show");
          }else{
            alert('Please Select chapter First !!');
          }
    });

    $('.module_chapter_paste').click(function(){

          navigator.clipboard
          .readText()
          .then((cliptext) =>
                {
                  $('#get_chapter_value').val(cliptext);
                  var get_subject_value = $('#subject_id').val();
                  var get_chapter_id = $('#get_chapter_value').val();

                  if (get_subject_value == '') {

                    var response = '<p style="color: red;">Please Select Subject</p>';
                    $('#add_ch_success').html(response);

                  }else if (get_chapter_id == '') {
                    var response = '<p style="color: red;">Chapter Field Can Not Be Empty</p>';
                    $('#add_ch_success').html(response);

                  }else {

                    $('#chapter_id').val(get_chapter_id).change();

                  }
                },
                err => console.log(err)
          );

    });

    $(".bar_module_chapter_copy").click(function() {
        var copy_chapter_id = $("#bar_chapter").val();
        if(copy_chapter_id!=''){
          CopyToClipboard(copy_chapter_id);
          $("#copy_chapter_success_modal").modal("show");
        }else{
          alert('Please select Chapter first !!');
        }
        
    });

    $('.bar_module_chapter_paste').click(function(){

        navigator.clipboard
        .readText()
        .then(cliptext =>
            {
              $('#get_chapter_value').val(cliptext);
              var get_subject_value = $('#subject_id').val();
              var get_chapter_id = $('#get_chapter_value').val();

              if (get_subject_value == '') {

                var response = '<p style="color: red;">Please Select Subject</p>';
                $('#add_ch_success').html(response);

              }else if (get_chapter_id == '') {
                var response = '<p style="color: red;">Chapter Field Can Not Be Empty</p>';
                $('#add_ch_success').html(response);

              }else {

                $('#bar_chapter').val(get_chapter_id).change();

              }
            }
            ,err => console.log(err)
        );

    });

    $(document).delegate(".copy_module", "click", function() {
        $("#copy_module_question").modal("show");
    });

    $("#question_form").on('submit', function(e){
      e.preventDefault();
      
      $.ajax({
        url: "Module/get_question_data",
        type: "POST",
        data: new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        dataType:'json',
        success: function (response) {
          check_question_module_submit(response);
        }
      });

    });

    function check_question_module_submit(response){
      // alert(response);
      var questionId = response.id;
      var questionType = response.questionType;
      var studentgrade = response.studentgrade;
      var subject = response.subject;
      var chapter = response.chapter;
      var country = response.country;
      var module_create = 1;

      $.ajax({
        url: "Module/module_insert_question_data",
        type: "POST",
        data: {
          question_id : questionId,
          question_type : questionType,
          student_grade : studentgrade,
          subject : subject,
          chapter : chapter,
          country : country,
          module_create:module_create,
        },
        dataType:'html',
        success: function (response) {

          console.log(response);
          window.location.reload();
          
        }
      });

    }


      
      
    $("#moduleName").keyup(store_module_info);

    $("#grade_id").change(store_module_info);

    $("#module_type").change(store_module_info);

    $("#subject_chapter").change(store_module_info);

    $("#formInputButton").change(store_module_info);

    $("#formInputButton1").change(store_module_info);
    
    $("#trackerName").change(store_module_info);

    $("#individualName").change(store_module_info);

    $("#defaultCheck1").change(store_module_info);

    $("#enterDate").change(store_module_info);

    $("#isAllStudent").change(store_module_info);

    $("#video_link_1").change(store_module_info);

    $('#instruct_1').change(store_module_info);

    $('#videoName').change(store_module_info);

    $('#timeStart').change(store_module_info);

    $('#timeEnd').change(store_module_info);

    $('#optTime').change(store_module_info);

    $('#subject_id').change(store_module_info); 

    $('#chapter_id').change(store_module_info); 

    $('.module_subject_icon').click(function(){
        
        $(".icon_change").toggleClass('icon_change_hidden');
      }); 

      $('.module_chapter_icon').click(function(){
        $(".icon_change_chapter").toggleClass('icon_change_hidden');
      });

      $('.subject_delete').click(function(){
        var subject_id = $('#subject_id').val();
        if(subject_id!=''){
          // alert(subject);
          $.ajax({   
          url: "deleteSubjectByModule",
          method: 'POST',
          data: {
            subject_id: subject_id
          },
          success: function(data) {
            if(data==1){
              $('.subject'+subject_id).hide();
              $('option:selected', '#subject_id').remove();
              alert('Subject Deleted Successfully');
            }
          }
          });
        }else{
          alert('At first you need to select Subject.');
        }
      }); 

      $('.chapter_delete').click(function(){
        var chapter_id = $('#chapter_id').val();
        if(chapter_id!=''){
          // alert(subject);
          $.ajax({   
          url: "deleteChapterByModule",
          method: 'POST',
          data: {
            chapter_id: chapter_id
          },
          success: function(data) {
            if(data==1){
              $('.chapter'+chapter_id).hide();
              $('option:selected', '#chapter_id').remove();
              alert('Chapter Deleted Successfully');
            }
          }
          });
        }else{
          alert('At first you need to select Subject.');
        }
      }); 

      $('#edit_subject').click(function(){
        var subject_id = $('#subject_id').val();

        if(subject_id!=''){
          var subject_name = $('#subject_id option:selected').text();
          name = subject_name.trim();
          // alert(name);
          $('#editsubjectName').val(name);
          $('#editsubjectName').attr('data-id',subject_id);
          $('#editSubjectModal').modal('show');
        }else{
          alert('At first you need to select Subject.');
        }
      }); 

      $('#edit_chapter').click(function(){
        var chapter_id = $('#chapter_id').val();

        if(chapter_id!=''){
          var chapter_name = $('#chapter_id option:selected').text();
          name = chapter_name.trim()
          // alert(name);
          $('#editChapterName').val(name);
          $('#editChapterName').attr('data-id',chapter_id);
          $('#editChapterModal').modal('show');
        }else{
          alert('At first you need to select Chapter.');
        }
      });
  });

  $('.module_submit').click(function(){
    //instruct_1 // videoName // video_link_1
    var instraction = $('#instruct_1').val();
    var videolink = $('#video_link_1').val();
    var videoName = $('#videoName').val();    

    $('#video_name').val(videoName);
    $('#video_link').val(videolink);
    $('#instruction').val(instraction);

    $('#moduleCreate').submit();


  });

  $("#module_type").change(function(){
    var module_type = $(this).val();
    if(module_type == 1){
        $('#subject_show').css('display','block');
        $('#subject_show').css('float','left');
        $('#subject_show').css('margin-right','10px');
        $('.container-fluid').css('width','99%');

        $('#chapter_show').css('display','block');
        $('#chapter_show').css('max-width','175px');
        $('#chapter_show').css('float','left');
        $('#chapter_show').css('margin-right','10px');
       }else if(module_type != 1){
        $('.container-fluid').css('width','90%');

        $("#subject_show").prop("style", "display: block !important");
        $("#subject_show").attr("style", "display: none !important");

        $("#chapter_show").prop("style", "display: block !important");
        $("#chapter_show").attr("style", "display: none !important");
        $("#subject_id option:selected").prop("selected", false);
        $("#chapter_id option:selected").prop("selected", false);
       }


       if( module_type == '3'){
            $("#hide_date").show();
            $("#time").show();
            $("#hide_date").show();
            $("#time_ranger").show();
        }
        if (module_type == '4')
        {
            $("#hide_date").show();
            $("#time").hide();
            $("#hide_date").show();
            $("#time_ranger").show();
        }
        if (module_type == '5' || module_type == '1')
        {
            $("#hide_date").hide();
            $("#time").hide();
            $("#time_ranger").show();
        }
        if(module_type == '2')
        {
            $("#hide_date").show();
            $("#time").show();
            $("#time_ranger").hide();
        }
  });

  function store_module_info(){
       var module_name = $("#moduleName").val();
       var grade_id = $("#grade_id").val();
       var module_type = $("#module_type").val();
       var course_id = $("#subject_chapter").val();
       var serial = $("#formInputButton1").val();
       var trackerName = $("#trackerName").val();
       var individualName = $("#individualName").val();
       var enterDate = $("#enterDate").val();
       var isSms = $("#defaultCheck1").val();
       var isAllStudent = $("#isAllStudent").val();
       var video_link_1 = $("#video_link_1").val();
       var instruct_1 = $("#instruct_1").val();
       var videoName = $("#videoName").val();
       var timeStart = $("#timeStart").val();
       var timeEnd = $("#timeEnd").val();
       var optTime = $("#optTime").val();
       var subject_id = $("#subject_id").val();
       var chapter_id = $("#chapter_id").val();

       
       if($("#formInputButton").is(':checked')){
        var show_student = $("#formInputButton").val();
       }else{
        var show_student = null;
       }
       if(module_name==''){
        module_name=null;
       }
       if(grade_id==''){
        grade_id=null;
       }
       if(module_type==''){
        module_type=null;
       }
       if(course_id==''){
        course_id=null;
       }
       if(trackerName==''){
        trackerName=null;
       }
       if(individualName==''){
        individualName=null;
       }
       if(enterDate==''){
        enterDate=null;
       }
       if(isSms==''){
        isSms=null;
       }
       if(isAllStudent==''){
        isAllStudent=null;
       }
       if(video_link_1==''){
        video_link_1=null;
       }
       if(instruct_1==''){
        instruct_1=null;
       }
       if(videoName==''){
        videoName=null;
       }
       if(timeStart==''){
        timeStart=null;
       }
       if(timeEnd==''){
        timeEnd=null;
       }
       if(optTime==''){
        optTime=null;
       }
       if(subject_id==''){
        subject_id=null;
       }
       if(chapter_id==''){
        chapter_id=null;
       }

       $.ajax({   
        url: "save_module_info",
        method: 'POST',
        data: {
          module_name: module_name,grade_id:grade_id,module_type:module_type,course_id:course_id,show_student:show_student,serial:serial,trackerName:trackerName,individualName:individualName,enterDate:enterDate,isSms:isSms,isAllStudent:isAllStudent,video_link_1:video_link_1,instruct_1:instruct_1,videoName:videoName,timeStart:timeStart,timeEnd:timeEnd,optTime:optTime,subject_id:subject_id,chapter_id:chapter_id
        },
        success: function(data) {
        
        }
      });
  }

  $(document).on('click', '#questionSetting', function() {

    var question_length = $('.question_list').length + 1;

    $('.panel-box1').append('<div class="col-sm-2 panel-box"><div class="question_list" style="margin-top:20px"><div class="question_heading"><a href="javascript:void(0)">Edit</a><div class="question_heading_right">Q<input type="text" style="width: 50px;" class="text-center question_sorting" value="' + question_length + '"data-tblid=""></div></div><div class="question_body"><a href="<?php echo base_url('question-list/1'); ?>"><img src="assets/images/question.png" class="pull-right"></a><a href="javascript:void(0)" class="copy_module"><img src="assets/images/copy_module.png" width="50"></a><button type="button" class="btn btn-danger removecontentsection ml-auto" style="margin-top: 10px;"><i class="fa fa-trash"></i></button></div><div class="question_footer"></div></div></div>');

  });

  $(document).on('click', '#save_course', function() {
     
    var course_name = $('#course_name').val();
    var course_cost = $('#course_cost').val();
    var country_id = <?=$this->session->userdata('selCountry') ?>;
    if(course_name !='' && course_cost !=''){

      $.ajax({   
        url: "addCourseByModule",
        method: 'POST',
        data: {
          course_name: course_name,
          course_cost: course_cost,
          country_id : country_id
        },
        success: function(data) {
          var data = JSON.parse(data);
         if(data['success'] != 1){
          var successs = data['success'];

          var html = '<option value="'+successs['id']+'">'+successs['courseName']+'</option>';
          $('#subject_chapter').append(html);
         }else{
          alert('Sorry this course Already exits');
         }
        }
      });

    }else{
      if(course_name ==''){
        alert("Please fill out course name");
      }else if(course_cost ==''){
        alert("Please fill out course cost");
      }
    }
    
  });

  

  $(document).delegate(".removecontentsection", "click", function() {
    $(this).closest('.panel-box').remove();
  });

  $('.question_sorting').on('change', function() {
    var order = $(this).val();
    var tblId = $(this).attr('data-tblid');

    var exit_number = 0;
    $('.question_sorting').each(function() {
      if (order == $(this).val()) {
        exit_number = exit_number + 1;
      }
    });

    if (exit_number == 2) {
      alert('Sorry this order already have another question');
    } else {

      $.ajax({
        url: "<?php echo base_url(); ?>module_question_sorting",
        method: 'POST',
        data: {
          order: order,
          tblId: tblId
        },
        success: function(data) {
          location.reload();
        }
      });
    }


  });


  $('.box').on('click', function(e) {
    // var box = $(this).attr('data-id');
    console.log('clicked', this);
  })


  $.contextMenu({
    selector: '.box',
    callback: function(key, options) {
      var qId = $(this).attr('data-id');
      var qType = $(this).attr('data-type');
      var questionId = $(this).attr('data-qid');

      // window.console && console.log(m) || alert(m);
      if (key == 'delete') {
        $.ajax({
          url: "module_question_delete/" + qId,
          method: 'POST',
          success: function(data) {
            if (data == 'true') {
              alert('Module Question Deleted Successfully.');
              location.reload();
            } else {
              alert('Somethings wrong.');
            }
          }
        })

      } else if (key == 'duplicate') {
        $.ajax({
          url: "<?php echo base_url(); ?>module_question_duplicate",
          method: 'POST',
          data: {
            questionId: questionId,
            qType: qType
          },
          success: function(data) {
            alert('Module question duplicated successfully.');
            location.reload();
          }
        })
      }

    },
    items: {
      "delete": {
        name: "Delete",
        icon: "delete"
      },
      duplicate: {
        name: "Duplicate",
        icon: "copy"
      },
    }
  });


  // });

  $(document).on('click', '#modTimeSetBtn', function() {
    var timeStart = $('#timeStart').val();
    var timeEnd = $('#timeEnd').val();
    var optTime = $('#optTime').val();
    $('#modStartTime').val(timeStart);
    $('#modEndTime').val(timeEnd);
    $('#modOptTime').val(optTime);
    console.log(timeStart);
    $('#setTime').modal('toggle');
  })

  //time picker
  var startTimeTextBox = $('#timeStart');
  var endTimeTextBox = $('#timeEnd');

  $.timepicker.timeRange(
    startTimeTextBox,
    endTimeTextBox, {
      // 1hr
      minInterval: (1000 * 60),
      //timeFormat: 'HH:mm',
      timeFormat: 'hh:mm tt',
      start: {}, // start picker options
      end: {} // end picker options
    },
  );

  $('#optTime').timepicker();


  //set module id to modal for deletion
  $(document).on('click', '#dltModOpnIcon', function() {
    var moduleTodel = $(this).closest('tr').attr('id');
    $('#moduleToDel').val(moduleTodel);

  })

  //module delete functionality
  $('#moduleDltBtn').on('click', function() {
    var moduleId = $(this).siblings('#moduleToDel').val();
    $.ajax({
      url: 'Module/deleteModule',
      method: 'post',
      data: {
        moduleId: moduleId
      },
      success: function(data) {
        if (data == 'true') {
          alert('Module deleted successfully');
        } else {
          alert('Something is wrong');
        }
        $('#moduleDelModal').modal('toggle');
        $('tr#' + moduleId).fadeOut('500');
      }
    })
  });

  //set original module id on module duplicate modal
  $(document).on('click', '#modDuplicateIcon', function() {
    var origModId = $(this).closest('tr').attr('id');
    var origModStGrade = $(this).closest('tr').attr('studentGrade');


    var origModName = $(this).closest('tr').find('#modName a').html();
    console.log(origModName);
    $('#origModId').val(origModId);
    $("#studentGrade").val(origModStGrade);

    $("#country").val($(this).closest('tr').attr('country'));
    $("#subject").val($(this).closest('tr').attr('subject'));
    $("#course").val($(this).closest('tr').attr('course'));
    //      $('#studentGrade').val(origModStGrade);
    $('#duplicateModName').val(origModName);

    individual_student();
  });

  $("#studentGrade").change(function() {
    individual_student();
  })

  function  individual_student(){
      var studentGrade = $("#studentGrade :selected").val();
      var subject = $("#subject :selected").val();
      var country_id = $("#country_id").val();
      var tutor_type = '<?php echo $loggedUserType?>';
      
      <?php if ($loggedUserType == 7) {?>
        var course_id = $("#subject_chapter :selected").val();
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
        // var html = '';
        // $.ajax({
        //     type: 'POST',
        //     url: 'Module/assign_subject_by_course',
        //     data: {course_id:course_id},
        //     dataType: 'html',
        //     success: function (results) {
        //         html = results;
        //         $("#subject_id").html(html);
        //     }
        // });
        <?php }?>
      //}
    }

    // $(document).on('change', '#subject_id', function () {
    //   var subjectId = $(this, ':selected').val();

    //   var subjectName = $(this, ':selected').html();
    //   $.ajax({
    //     url: 'Student/renderedChapters/' + subjectId,
    //     method: 'POST',
    //     success: function (data) {
    //       $('#chapter_id').html(data);
    //     }
    //   });

    // });

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

  //module duplicate form submit
  $(document).on('submit', '#moduleDuplicateForm', function(event) {
    event.preventDefault();
    var subjectName = $('#duplicateModSubName').val();
    var chapterName = $('#duplicateModChapName').val();
    if (subjectName == '' && chapterName != '') {
      alert('Please Enter Subject !!');
      return false;
    }
    if (subjectName != '' && chapterName == '') {
      alert('Please Enter Chapter !!');
      return false;
    }
    var data = $(this).serialize();

    $.ajax({
      url: 'Module/moduleDuplicate',
      method: 'POST',
      data: data,
      success: function(data) {
        if (data == 'false') {
          alert('To keep same module name please change student grade.');
        } else if (data == 'true') {
          alert('Module duplication complete.');
        } else {
          alert(data);
        }

        $('#moduleDuplicateModal').modal('toggle');
        location.reload();
      }
    })
    //console.log(data);
  });


  //get student on grade change
  $('#studentGrade').change(function() {
    var grade = $('#studentGrade :selected').val();
    $.ajax({
      url: 'Module/getStudentByGrade',
      type: 'POST',
      data: {
        grade: grade
      },
      success: function(data) {
        $('#indivStIds').html(data);
      }
    })

  })



  //date picker on duplicate module modal
  $('#enterDate').datepicker({});
  //datatable
  $('.table').dataTable({
    searching: false,
    lengthChange: false,
    select: true,
    "aaSorting": []
  });

  //get chapter on subject change
  $(document).on('change', '#moduleSubject', function() {
    var subject = $(this).val();
    $.ajax({
      url: 'Tutor/get_chapter_name',
      method: 'post',
      data: {
        'subject_id': subject
      },
      success: function(response) {
        $('#moduleChapter').html(response);
      }
    })
  });

  $('#select_module_type').on('change', function() {
    if (this.value == 3 || this.value == 2) {
      $("#time").show();
    } else {
      $("#time").hide();
    }
  });
</script>
<?php unset($_SESSION['modInfo']); ?>

<!-- qstudyPassword -->


<script type="text/javascript">
  function qPassword() {
    var qPassword = $("#qPassword").val();
    if (qPassword == '') {
      $("#qPasswordErr").html("Input Password Please");
      return false;
    } else {
      $("#qPasswordErr").html(" ");
    }
    $.ajax({
      url: 'Tutor/qstudyPassword/' + qPassword,
      method: 'GET',
      success: function(response) {
        if (response == 0) {
          $("#qPasswordErr").html("Wrong Password")
        } else {
          $("#qPasswordErr").html("")
          $("#ss_info_sucesss").modal("toggle")

          $('#moduleDelModal').modal('toggle');
          $('tr#' + moduleId).fadeOut('500');


        }
      }
    })

  }


  function deleteQuestion() {
    var moduleId = $(this).siblings('#moduleToDel').val();
    $.ajax({
      url: 'Module/deleteModule',
      method: 'post',
      data: {
        moduleId: moduleId
      },
      success: function(data) {
        if (data == 'true') {
          alert('Module deleted successfully');
        } else {
          alert('Something is wrong');
        }

      }
    })
  }


  $(document).on('change', '#dup_moduleSubject', function() {
    var subject = $(this).val();
    $.ajax({
      url: 'Tutor/get_chapter_name',
      method: 'post',
      data: {
        'subject_id': subject
      },
      success: function(response) {
        $('#dup_moduleChapter').html(response);
      }
    })
  });

  $(document).on('click', '#showduplicateModChapName', function() {
    $('#duplicateModChapName').show();
    $('#dup_moduleChapter').hide();
  });

  $(document).on('click', '#showduplicateModSubName', function() {
    var val = $(this).val();
    if (val == 'new') {
      $('#duplicateModSubName').show();
      $('#dup_moduleSubject').hide();
      $('#duplicateModChapName').show();
      $('#dup_moduleChapter').hide();
      $('#dup_moduleSubject').val('');
      $('#dup_moduleChapter').val('');
      $(this).val('old');
    } else {
      $('#duplicateModSubName').hide();
      $('#dup_moduleSubject').show();
      $('#duplicateModChapName').hide();
      $('#dup_moduleChapter').show();
      $('#duplicateModSubName').val('');
      $('#duplicateModChapName').val('');
      $(this).val('new');
    }
  });

  $("#addNewSubject").click(function(){
      
    $("#addSubjectModal").modal('show');
  });

  function saveSubject(){
    var subject_name = $('#subjectName').val();

    if(subject_name != ''){
      $.ajax({
      url: 'Module/addNewSubject',
      method: 'post',
      data: {
        subject_name: subject_name
      },
      success: function(data) {
        var subject = JSON.parse(data);
        
        var html = '<option value="'+subject['subject_id']+'">'+subject['subject_name']+'</option>';
        $("#subject_id").append(html);
        $("#addSubjectModal").modal('hide');
      }
      });
    }else{
      alert('Please write subject name');
    }
  }

  $("#addNewChapter").click(function(){
    $("#addChapterModal").modal('show');
  });

  function saveChapter(){
    var chapter_name = $('#chapterName').val();
    var subject_id = $('#subject_id').val();
 
    if(subject_id != ''){
    if(chapter_name != ''){
      $.ajax({
      url: 'Module/addNewChapter',
      method: 'post',
      data: {
        chapter_name: chapter_name,subject_id:subject_id
      },
      success: function(data) {
        var chapter = JSON.parse(data);
        
        var html = '<option value="'+chapter['id']+'">'+chapter['chapterName']+'</option>';
        $("#chapter_id").append(html);
        $("#addChapterModal").modal('hide');
      }
      });
    }else{
      alert('Please write subject name');
    }
  }else{
    alert('please Select Subject first');
  }
  }

  function editSubject(){
      var subject_name = $('#editsubjectName').val();
      var subject_id = $('#editsubjectName').attr('data-id');

      if(subject_name != ''){
        $.ajax({
        url: 'Module/editNewSubject',
        method: 'post',
        data: {
          subject_name: subject_name,subject_id:subject_id
        },
        success: function(data) {
          if(data==1){
            $('.subject'+subject_id).text(subject_name);
            $('#editSubjectModal').modal('hide');
          }
        }
        });
      }else{
        alert('Please write subject name');
      }
    }

    function editChapter(){
      var chapter_name = $('#editChapterName').val();
      var chapter_id = $('#editChapterName').attr('data-id');

      if(chapter_name != ''){
        $.ajax({
        url: 'Module/editNewChapter',
        method: 'post',
        data: {
          chapter_name: chapter_name,chapter_id:chapter_id
        },
        success: function(data) {
          if(data==1){
            $('.chapter'+chapter_id).text(chapter_name);
            $('#editChapterModal').modal('hide');
          }
        }
        });
      }else{
        alert('Please write Chapter name');
      }
    }

    $('.question_drag').sortable({
        delay: 150,
        stop: function() {

            var serial = new Array();
            var ids = new Array();
            var question_ids = new Array();

            $(".question_sorting_create").each(function() {
              // alert ($(this).val());
              serial.push($(this).val());
              ids.push($(this).attr('data-questionOrder'));
              question_ids.push($(this).attr('data-question'));
              
            });
            // alert (question_ids);
            updateSerial(serial,ids,question_ids);
        }
    });

    function updateSerial(serial,ids,question_ids) {
       
      $.ajax({
        url: "<?php echo base_url(); ?>update_serial_module_question_create",
        method: 'POST',
        data: {
          serial: serial,
          ids: ids,
          question_ids:question_ids
        },
        success: function(data) {
          alert("Module question changes Successgully !");
           location.reload();
        }
      });
 
    }

      
  

</script>