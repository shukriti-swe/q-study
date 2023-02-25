<script src="<?php echo base_url(); ?>assets/ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>

<style type="text/css">
  .ss_q_btn {
    margin-top: 21px;
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

  .created_name {
    background: #66afe9;
    color: #fff;
    font-size: 16px;
    padding: 10px 20px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
  }

  .created_name a {
    color: #fff;
  }

  .created_name img {
    max-width: 30px;
    margin-right: 10px;
  }

  .flex-end {
    justify-content: flex-end;
  }

  .d-flex {
    display: flex;
  }

  .w-50 {
    width: 50px !important;
  }

  .idea_setting_mid_bottom {
    margin-top: 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: flex-end;
    flex-wrap: wrap;
  }

  .ss_question_add_top {
    flex-wrap: wrap;
    display: flex;
    align-items: end;
    justify-content: center;
  }

  .ss_question_add_top label,
  .idea_setting_mid label,
  .idea_setting_mid_bottom label {
    margin-bottom: 6px;
  }

  .idea_setting_mid {
    margin-top: 20px;
    display: flex;
    align-items: flex-end;
    flex-wrap: wrap;
  }

  .ss_q_btn {
    margin-top: 22px;
    margin-bottom: 10px;
  }

  .btn-select {
    background: #a9a8a8;
    color: #fff;
    box-shadow: none !important;
    border-radius: 0;
  }

  .btn-select:hover,
  .btn-select.active {
    background: #00a2e8;
    color: #fff;
  }

  .btn-select-border {
    background: #fff;
    color: #000;
    box-shadow: none !important;
    border-radius: 0;
    border: 1px solid #ddd9c3;
  }

  .btn-select-border:hover,
  .btn-select-border.active {
    background: #ddd9c3;
    color: #fff;
  }

  .idea_setting_mid_bottom .btn-select:hover,
  .idea_setting_mid_bottom .btn-select.active {
    background: #ff7f27;
    color: #fff;
  }

  .top_word_limt {
    background: #d9edf7;
    padding: 8px 10px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
  }

  .m-auto {
    margin-left: auto;
  }

  .b-btn {
    background: #9c4d9e;
    padding: 5px 10px;
    border-radius: 5px;
    color: #fff;
  }

  .btm_word_limt .content_box_word {
    border-radius: 5px;
    border: 1px solid #82bae6;
    margin: 10px 0;
    padding: 10px;
    width: 100%;
    box-shadow: 0px 0px 10px #d9edf7;
  }

  .btm_word_limt .content_box_word u {
    color: #888;
  }

  .btm_word_limt .content_box_word span {
    color: #888;
  }

  .btm_word_limt .content_box_word p {
    margin-top: 10px;
  }

  #shot_question .modal-content,
  .ss_modal .modal-content {
    border: 1px solid #a6c9e2;
    padding: 5px;
  }

  .ss_modal .form-group label {
    margin-bottom: 5px;
  }

  .ss_modal .modal-dialog {
    max-width: 100%;
  }

  .ss_modal .form-group input {
    height: 34px;
  }

  .ss_modal .modal-header {
    background: url(assets/images/login_bg.png) repeat-x;
    color: #fff;
    padding: 0;
    border-radius: 5px;
  }

  #advance_searc_op {
    cursor: pointer;
  }

  #advance_searc_content {
    display: none;
  }

  .content_box_word {
    min-height: 300px;
  }

  .serach_list .input-group {
    width: 100%;
  }

  .d-flex {
    display: flex;
    align-items: center;
  }

  .ss_modal .form-group {
    width: 100%;
  }

  #checkbox_titlelimit_alert,
  #checkbox_titlelimitidea_alert {
    display: none;
  }

  #checkbox_titlelimit_alert>div,
  #checkbox_titlelimitidea_alert>div {
    flex-wrap: wrap;
    align-items: center;
    padding: 15px 0px;
    color: #ff0000;
    display: flex;
    justify-content: flex-end;
  }

  #checkbox_titlelimit_alert,
  #checkbox_titlelimit_large_alert {
    display: none;
  }

  #checkbox_titlelimit_alert>div,
  #checkbox_titlelimit_large_alert>div {
    flex-wrap: wrap;
    align-items: center;
    padding: 15px 0px;
    color: #ff0000;
    display: flex;
    justify-content: flex-end;
  }

  #shot_question_details {
    overflow: auto;
  }

  #shot_question_details .col-sm-4 {
    width: 100%;
  }

  #shot_question_details.ss_modal .modal-dialog {
    margin-top: 6%;
  }

  .color_list {
    display: flex;
  }

  .color_list .color_choose {
    position: relative;

  }

  .color_list .color_choose .color_set {
    position: relative;
    height: 20px;
    margin: 2px;
    width: 20px;
    cursor: pointer;
  }

  .color_list .color_choose input {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    opacity: 0;

  }

  .hint_color_list {
    display: flex;
  }

  .hint_color_list .hint_color_choose {
    position: relative;

  }

  .hint_color_list .hint_color_choose .hint_color_set {
    position: relative;
    height: 20px;
    margin: 2px;
    width: 20px;
    cursor: pointer;
  }

  .hint_color_list .hint_color_choose input {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
  }

  .hint_color_list .hint_chosen_color {
    position: relative;

  }

  .hint_color_list .hint_chosen_color .hint_color_set {
    position: relative;
    height: 20px;
    margin: 2px;
    width: 20px;
    cursor: pointer;
  }

  .hint_color_list .hint_chosen_color input {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
  }

  .round_box {
    margin-top: 10px;
    height: 17px;
    width: 30px;
    border: 2px solid #27baf1;
    border-radius: 40%;
  }

  .hint_box {
    color: #000;
    font-size: 30px;
    margin-left: 4%;
  }

  .comprehension_image {
    height: 40px;
    width: 40px;
  }

  .com_hint_image {
    /* margin-left: 20px; */
    height: 38px;
    width: 35px;
  }

  .com_option_image {
    margin-left: 10px;
    height: 38px;
    width: 35px;
  }

  .customcheckbox {
    display: block;
    margin-top: 7px;
    position: relative;
    padding-left: 55px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }


  .customcheckbox input {
    position: absolute;

    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
  }

  .customcheckbox .checkmark {
    position: absolute;
    border: 2px solid #2196F3;
    top: 0;
    left: 0;
    height: 25px;
    text-align: center;
    width: 45px;
    border-radius: 20px;
    background-color: #fff;
  }


  .customcheckbox:hover input~.checkmark {
    background-color: #2196F3;
  }


  .customcheckbox input:checked~.checkmark {
    background-color: #2196F3;
  }


  .customcheckbox .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }


  .customcheckbox input:checked~.checkmark:after {
    display: block;
  }
  .add_hint_question {
    /* margin-left: 20px; */
    height: 25px;
    width: 25px;
    cursor: pointer;
  }

  .set_color_section{
    display:flex;
    justify-content: center;
    max-width: 400px;
    margin: 20px auto;
    gap:10px;
  }
  .set_color_list{
    border:1px solid #c3c3c3;
  }
  .hint_selection_content{
    border:1px solid #c3c3c3;
    margin: 20px 0px;
    padding: 10px;
    word-break: break-all;
  }
  .btn-sm {
    padding: 1px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
    text-align: center;
  }
  .sugg_box{
    padding-top: 14px;
    display: block;
    width: 150px;
   }
   .image-editor{
      height:165px;
      border:4px solid #658ab9;
   }

   .row-eq-height {
   display: -webkit-box;
   display: -webkit-flex;
   display: -ms-flexbox;
   display:         flex;
   }
   .two_hint_wrap , .one_hint_wrap{
     display: inline;
     position: relative;
   }
   .tooltip_rs{
    position: absolute;
    background: #00a2e8;
    z-index: 10;
    padding: 5px 10px 5px 10px;
    color: #fff;
    width: 80%;
    max-width: 250px;
    height: fit-content;
    top:0;
    margin-left:50px;
   }
   .tooltip_rs::after {
      width: 0;
      height: 0;
      border-left: 5px solid transparent;
      border-right: 5px solid transparent;
      border-top: 50px solid #00a2e8;
      content: '';
      position: absolute;
      top: -14px;
      left: -30px;
      transform: rotate(90deg);
      
   }
   .all_options{
      margin-top:5px;
      margin-left:5px;
   }

   .custom_radio {
   display: block;
   position: relative;
   padding-left: 35px;
   margin-bottom: 2px;
   line-height: 24px;
   cursor: pointer;
   -webkit-user-select: none;
   -moz-user-select: none;
   -ms-user-select: none;
   user-select: none;
   }

   /* Hide the browser's default radio button */
   .custom_radio input {
   position: absolute;
   opacity: 0;
   cursor: pointer;
   }

   /* Create a custom radio button */
   .checkmark {
   position: absolute;
   top: 0;
   left: 0;
   height: 24px;
   width: 24px;
   background-color: #fff;
   border-radius: 50%;
   border:2px solid #eee;
   }

   /* On mouse-over, add a grey background color */
   .custom_radio:hover input ~ .checkmark {
      background-color: #fff;
   border:2px solid #eee;
   }

   /* When the radio button is checked, add a blue background */
   .custom_radio input:checked ~ .checkmark {
   background-color: #fff;
   border:2px solid #ccc;
   }

   /* Create the indicator (the dot/circle - hidden when not checked) */
   .checkmark:after {
   content: "";
   position: absolute;
   display: none;
   }

   /* Show the indicator (dot/circle) when checked */
   .custom_radio input:checked ~ .checkmark:after {
     display: block;
   }

   /* Style the indicator (dot/circle) */
   .custom_radio .checkmark:after {
      top: 2px;
      left: 2px;
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background: #2196F3;
   }

   .workout_menu ul li.note_button a {
    padding: 3px 6px 6px 4px;
    background: #fff;
    color: gray;
    font-weight: bold;
    border: 2px solid #c1c1bc;
   }
   .custom_radio:hover input ~ .checkmark {
    background-color: #00a2e8;
   }

   .writing_input_body{
    margin-bottom:10px;
   }

</style>

<?php 
foreach ($total_question as $ind) {

if ($ind["question_type"] == 14) {
  $chk = $ind["question_order"];
 }

} 
  ?>

<?php

    //$answerCount = count(json_decode($question_info_s[0]['answer']));
    // echo "<pre>";print_r($answerCount);die();

    $question_order_array = array_column($total_question, 'question_order');
    $last_question_order = end($question_order_array);

    $key = $question_info_s[0]['question_order'];
    date_default_timezone_set($this->site_user_data['zone_name']);
    $module_time = time();
    
if ($tutorial_ans_info) {
    $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'], true);
    $desired = $temp_table_ans_info;
} else {
    $desired = $this->session->userdata('data');
}

      // Question Time

    $question_time = explode(':', $question_info_s[0]['questionTime']);
    $hour = 0;
    $minute = 0;
    $second = 0;
if (is_numeric($question_time[0])) {
    $hour = $question_time[0];
} if (is_numeric($question_time[1])) {
    $minute = $question_time[1];
} if (is_numeric($question_time[2])) {
    $second = $question_time[2];
}

$question_time_in_second = 0;
$question_time_in_second = ($hour * 3600) + ($minute * 60) + $second ;
$moduleOptionalTime = 0;
if ($question_info_s[0]['moduleType'] == 2 && $question_info_s[0]['optionalTime'] != 0)
{
    $moduleOptionalTime = $question_info_s[0]['optionalTime'];
}

$passTime = time() - $_SESSION['exam_start'] ;
$setTime = 0;
if($moduleOptionalTime <= 0)
{
    if ($question_time_in_second > 0)
    {
        $setTime = $question_time_in_second;
    }

}else{
    $moduleOptionalTime = $moduleOptionalTime - $passTime;
    if ($question_time_in_second <= 0)
    {
        $setTime = $moduleOptionalTime;
    }else{
        if ($question_time_in_second > $moduleOptionalTime)
        {
            $setTime = $moduleOptionalTime;
        }else{
            $setTime = $question_time_in_second;
        }

    }
}

      // End Question Time

    $link_next = "javascript:void(0);";
    $link = "javascript:void(0);";

if (is_array($desired)) {
    $link_key = $key - 1;
    if (array_key_exists($link_key, $desired)) {
        $link = $desired[$link_key]['link'];
    }
        $link_key_next = $key;
    if (array_key_exists($link_key_next, $desired)) {
        $question_id = $question_info_s[0]['question_order'] + 1;
        $link1 = base_url();
        $link_next = $link1 . 'get_tutor_tutorial_module/' . $question_info_s[0]['module_id'] . '/' . $question_id;
    }
}

    $module_type = $question_info_s[0]['moduleType'];

     $videoName = strlen($module_info[0]['video_name'])>1 ? $module_info[0]['video_name'] : 'Subject Video';

  // echo "<pre>";print_r($word_match_info[0]);die();
  $question = $question_info_s[0]['questionName'];
  $answer = $question_info_s[0]['answer'];
  $question_description = json_decode($question_info_s[0]['questionDescription'],true);
  // echo "<pre>";print_r($question_description);die();

?>


<?php if ($module_type == 3) { ?>
  <input type="hidden" id="exam_end" value="<?php echo strtotime($module_info[0]['exam_end']);?>" name="exam_end" />
  <input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
  <input type="hidden" id="optionalTime" value="<?php echo $module_info[0]['optionalTime'];?>" name="optionalTime" />
  <input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />
<?php }?>

<!--         ***** For Tutorial & Everyday Study *****         -->    
<?php if ($module_type == 2 || $module_type == 1) { ?>
  <input type="hidden" id="exam_end" value="" name="exam_end" />
  <input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
  <!--  <input type="hidden" id="optionalTime" value="--><?php //echo $question_time_in_second;?><!--" name="optionalTime" />-->
  <input type="hidden" id="optionalTime" value="<?php echo $setTime;?>" name="optionalTime" />
 
  <input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />
<?php }?>

<div class="ss_student_board">
  <div class="ss_s_b_top">
    <div class="ss_index_menu <?php //if ($module_type == 3) {
    ?>col-sm-5<?php
    //}?>">
    <?php if ($module_type == 1) { ?>
      <a href="all_tutors_by_type/<?php echo $total_question[0]['user_id'];?>/<?php echo $total_question[0]['moduleType'];?>" style="display: inline-block;">Index</a>
    <?php } else {?>
      <!-- <a >Index</a> -->
    <?php }?>

    <?php  if ($module_info[0]['video_name']) { ?>
      <button class="btn btn_next" id="openVideo" style="margin-left: 25px;"><i class="fa fa-play" style="color:#35B6E7;margin-right: 5px;"></i><?php echo $videoName;  ?></button>
    <?php } ?>
    
  </div>
    
<?php
      $col_class = 'col-sm-7';
      if (($module_type == 2 && $question_info_s[0]['optionalTime'] != 0) || $module_type == 3){
          $col_class = 'col-sm-4';
      }
      ?>
  <div style="text-align: left;" class="text-center <?php echo $col_class?><?php //if ($module_type != 3) {
    //echo 'col-sm-7';
    //} else {
      //echo 'col-sm-6';
    //}?> ss_next_pre_top_menu">

    <?php if ($_SESSION['userType']==3||$_SESSION['userType']==7) :
        ?> <!-- only tutor&qstudy will be able to back next -->
        <?php if ($question_info_s[0]['moduleType'] == 1) { ?>
        <a class="btn btn_next" href="<?php echo $link; ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
        <a class="btn btn_next" href="<?php echo $link_next; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>                                  
        <?php } else {?>
        <a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
        <a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
        <?php }?>
    <?php endif; ?>

    <a class="btn btn_next" id="draw" onClick="test()" data-toggle="modal" data-target=".bs-example-modal-lg" >
     Workout <img src="assets/images/icon_draw.png">
   </a>
 </div>
</div>
 
 <div class="container-fluid">
  <div class="row">
  <div>
    <div style="position: absolute;left:-1000px;min-height: 250px;width: 600px;text-align: center;padding: 10px;" id="quesBody">
        <?php echo ($question_info_vcabulary->questionName); ?>
        </div>
    </div>




    <div class="ss_s_b_main" style="min-height: 100vh">
        <form id="answer_form">
        
            <input type="hidden" value="<?php echo $question_info_s[0]['question_id']; ?>" name="id" id="question_id">
            <?php // if (array_key_exists($key, $total_question) && !$tutorial_ans_info) { ?>
            <?php if (($last_question_order != $key) && !$tutorial_ans_info) {?>
              <input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] + 1; ?>" name="next_question" />
            <?php } else { ?>
              <input type="hidden" id="next_question" value="0" name="next_question" />
            <?php } ?>
            <input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id'] ?>" name="module_id">
            <input type="hidden" id="current_order" value="<?php echo $key; ?>" name="current_order"> 
            <input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType']; ?>" name='module_type'>
            
            <input type='hidden' id="student_question_time" value="" name='student_question_time'>
            
              <?php  if ($question_info_s[0]['question_name_type']) { ?>
                   <div class="col-sm-12">
                        <div class="workout_menu" style="margin-bottom: 30px;">
                          <ul>
                          
                          <?php if($module_info[0]['user_type'] == 7) {?>
                          <!-- <a style="cursor: pointer;">
                              <span style="color: white;" class=" qstudy_Instruction_click">
                                <img src="assets/images/icon_draw.png" ><b> Instruction</b>
                              </span> 
                            </a> -->
                            <div class="workout_menu" style=" padding-right: 15px;">
                              <ul>
                              <li><a style="cursor:pointer" id="show_question" class=" qstudy_Instruction_click"> <img src="assets/images/icon_draw.png"/> Instruction</a></li>

                              <?php if ($module_type == 3 || (($module_type == 2 || $module_type == 1) && $question_time_in_second != 0)) { ?>
                                <li><div class="ss_timer" id="demo"><h1>00:00:00 </h1></div></li>
                              <?php }elseif ($module_type == 2 && $question_info_s[0]['optionalTime'] != 0){?>
                                <li><div class="ss_timer" id="demo"><h1>00:00:00 </h1></div></li>

                              <?php }?>

                               <?php if ($question_info_s[0]['isCalculator']) : ?>
                                <input type="hidden" name="" id="scientificCalc">
                               <?php endif; ?>

                              <?php if(!empty($question_description['note_description'])){?>
                                  <li class="note_button">
                                    <!-- <a style="cursor:pointer" id="show_question"><span class="glyphicon glyphicon-pencil pencil_icon" style="color:red;"></span> Note </a> -->
                                    <a style="cursor:pointer" id="show_note">Hint<img style="height:20px;width:20px;" class="light_image" src="assets/images/images/light.png"></a>
                                  </li>
                              <?php }?>
                              </ul>
                            </div>

                          <?php }else{?>
                          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span class="Instruction_click"><img src="assets/images/icon_draw.png" onclick="abc()" > Instruction</span></a>
                          <?php }?>
                          </li>
                              <?php if($question_info_s[0]['question_name_type'] == 2) { ?>

                                <li><a style="cursor:pointer" id="show_question" onclick="show_questionModal()">Question<i>(Click Here)</i></a></li>
                              <?php } ?>

                          


                          </ul>
                      </div>
                    </div>
                <?php  }else{ ?>

                  <div class="col-sm-12">
                      <div class="workout_menu" style="margin-bottom: 30px;">
                            <ul>
                                <li>
                <?php if($module_info[0]['user_type'] == 7) {?>
                <a style="cursor: pointer;">
                    <span style="color: white;" class=" qstudy_Instruction_click">
                      <img src="assets/images/icon_draw.png" ><b> Instruction</b>
                    </span> 
                  </a>

                <?php }else{?>
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_draw.png" onclick="abc()"> Instruction</span></a>
                                <?php }?>
                </li>

                <li><a style="cursor:pointer" id="show_question" onclick="show_questionModal()">Question<i>(Click Here)</i></a></li>
                                
                            </ul>
                        </div>
                  </div>
                <?php  } ?>

            
            <div class="col-sm-8" style="padding:0;">        
                <div class="panel-group  panel-body" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default" style="border:none;">                  
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" style="border:1px solid #c3c3c3;">
                        <div class="panel-body ss_imag_add_right">

                        <form id="answer_form">
                           
                            <div class="writing_input_body">
                                <h6 style="font-weight: bold;margin-left:30px;font-size:17px;"> <?=$question?></h6>
                            </div>
                            <div>
                                <?php $i=1; foreach($question_description['options'] as $option){ ?>
                                    <div style="padding-left: 30px;gap:5px;">
                                       
                                       <div style="margin-top: 6px;position:relative;">
                                          <div class="set_tooltip<?=$i?>" style="position:relative;display:inline-flex;gap:10px;align-items: baseline;">

                                             <div style="max-width:20px;position:absolute;left:-25px; top: -5px;">
                                                <i class="fa fa-close ans_wrong wrong_ans<?=$i?>" style="font-size:24px;color:red;margin-top:5px;display:none;"></i>
                                                <i class="fa fa-check ans_right right_ans<?=$i?>" style="font-size:21px;color:green;margin-top:5px;display:none;"></i>
                                             </div>
                                             
                                             
                                             <label class="custom_radio"><span class="option_no<?=$i?> all_options"><?=$option?></span>
                                                <input type="radio" class="radio_ans" id="html<?=$i?>" name="answer" value="<?=$i?>">
                                                <span class="checkmark "></span>
                                             </label>

                                          </div>
                                          

                                          <?php if($i == 1){ ?>
                                            <div class="first_hint_text tooltip_rs hint_text<?=$i?>"><?=$question_description['first_hint']?></div>
                                          <?php }elseif($i == 2){ ?>
                                            <div class="second_hint_text tooltip_rs hint_text<?=$i?>"><?=$question_description['second_hint']?></div>
                                          <?php }elseif($i == 3){ ?>
                                            <div class="third_hint_text tooltip_rs hint_text<?=$i?>"><?=$question_description['third_hint']?></div>
                                          <?php }elseif($i == 4){ ?>
                                            <div class="fourth_hint_text tooltip_rs hint_text<?=$i?>"><?=$question_description['four_hint']?></div>
                                          <?php }?>
                                            
                                       </div>
                                    </div>
                                <?php $i++; } ?>
                            </div>
                            <div style="margin-left: 30px;margin-top:30px;">
                                <input type="hidden" value="<?php echo $question_id;?>" name="question_id" id="question_id">
                                <a href="javascript:;" type="button" class="btn btn-primary" style="background-color: #ff0000;float:left;" id="ans_help">Help</a>
                                <a href="javascript:;" type="button" class="btn btn-primary" style="background-color: #ed7d31;float:left;" id="ans_try_again">Try Again</a>
                                <a href="javascript:;" type="button" class="btn btn-primary ans_submit" style="background-color: #bee131;color:#000">Submit</a>
                            </div>
                          </form>

                        </div>
                            
                            <div class="col-sm-5"></div>                  
                            <div class="col-sm-4"></div>
                            
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="col-sm-4">
                <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  
                                    <span>Module Name:<?php echo isset($module_info[0]['moduleName'])?$module_info[0]['moduleName']:'Not found'; ?></span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapsethree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class=" ss_module_result">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                          <thead>    
                            <tr>
                              <th></th>
                              <th>SL</th>
                              <th>Mark</th>
                              <th>Obtained</th>
                              <th>Description / Video</th>                                                  
                            </tr>
                          </thead>
                          <tbody>
                              <?php $i = 1;
                              $total = 0;
                              foreach ($total_question as $ind) { ?>
                              <tr>
                                <?php

                                  $style = '';
                                  if (isset($desired[$i]['ans_is_right']))
                                  {
                                      $qus_tutorial = get_question_tutorial($ind['question_id']);
                                      if ($qus_tutorial && $module_info[0]['repetition_days'] == '')
                                      {
                                          $style = "background-color:#dcf394;text-align: center;padding: 0px;";
                                      }
                                  }
                                                      ?>
                                <td style="<?php echo $style;?>">
                                    <?php if (isset($desired[$i]['ans_is_right'])) {
                                      if($ind["question_type"] == 14){?>
                                        <span  style="color: red;"></span>
                                        <?php   }else{
                    $qus_tutorial = get_question_tutorial($ind['question_id']);

                                          if ($desired[$i]['ans_is_right'] == 'correct') {?>
                                      <span class="glyphicon glyphicon-ok" style="color: green;"></span>

                    <?php if ($qus_tutorial && ($module_info[0]['repetition_days'] == '' || $module_info[0]['repetition_days'] == 'null')){?>
                                                  <span class="question_tutorial_view" question_id="<?php echo $ind['question_id']; ?>" style="font-weight: bolder;color: #ff8b00;font-size: 20px;margin-left: 3px;">T</span>
                                              <?php }?>
                                          <?php }else if($desired[$i]['ans_is_right'] == 'idea'){?>
                                    <span class="glyphicon glyphicon-pencil" style="color: red;"></span>
                                            
                                    <?php   } else {?>
                                      <span class="glyphicon glyphicon-remove" style="color: red;"></span>
                    <?php if ($qus_tutorial && ($module_info[0]['repetition_days'] == '' || $module_info[0]['repetition_days'] == 'null')){?>
                                                  <span class="question_tutorial_view" question_id="<?php echo $ind['question_id']; ?>" style="font-weight: bolder;color: #ff8b00;font-size: 20px;margin-left: 3px;">T</span>
                                              <?php }?>
                                          <?php }}
                                    }?>
                                </td> 

                                
                                       <?php  if ( ($ind["question_type"] !=14) && ($question_info_s[0]['question_order'] == $ind['question_order']) ) { ?>
                                            <td style="background-color:lightblue">
                                                <?php echo $ind['question_order']; ?>
                                            </td>
                                       <?php } 

                                        elseif ( ($ind["question_type"] ==14) && $order >= $chk ) { ?>
                                            <td style="background-color:#dcf394;text-align: center;padding: 0px;">
                                              <a style="color: #000;" class="show_tutorial_modal" question_id="<?php echo $ind['question_id']; ?>" modalId="<?php echo $ind['module_id']; ?>" Order="<?php echo $ind['question_order']; ?>"><?php echo $ind['question_order']; ?><span style="font-weight: bolder;color: #ff8b00;font-size: 20px;margin-left: 3px;">T</span></a>
                                             </td>
                                       <?php } 

                                       elseif ( ($ind["question_type"] ==14) && $order < $chk ) { ?>
                                            <td style="background-color:#dcf394;text-align: center;padding: 0px;">
                                              <a style="color: #000;" class="show_tutorial_modal" question_id="<?php echo $ind['question_id']; ?>" modalId="<?php echo $ind['module_id']; ?>" Order="<?php echo $ind['question_order']; ?>"><?php echo $ind['question_order']; ?><span style="font-weight: bolder;color: #ff8b00;font-size: 20px;margin-left: 3px;">T</span></a>
                                             </td>
                                       <?php } 

                                        else{  ?>

                                          <td>
                                              <?php echo $ind['question_order']; ?>
                                          </td>
                                          
                                       <?php } ?>
                                        

                              <td>
                                  <?php
                                  echo $ind['questionMarks'];
                                  $total = $total + $ind['questionMarks'];
                                  ?>
                              </td>
                              <td>
                                <?php if ($ind["question_type"] ==14) {
                                  echo "0";
                                } ?>
                                <?php if (isset($desired[$ind['question_order']]['student_question_marks'])) {
                                  echo $desired[$ind['question_order']]['student_question_marks'];
                                } ?>
                              </td>
                              <td class="description_video">
                                    <?php if (isset($ind['questionDescription']) && $ind['questionDescription'] != null ){ ?>
                                        <a  class="description_class" onclick="showModalDes(<?php echo $i; ?>);" style="display: inline-block;"><img src="assets/images/icon_details.png"></a>
                                    <?php } ?>
                                    <?php 
                                        $question_instruct_vid = isset($ind['question_video']) ? json_decode($ind['question_video']):'';
                                    ?>
                                    <?php if (isset($question_instruct_vid[0]) && $question_instruct_vid[0] != null ){ ?>
                                      <a onclick="showQuestionVideo(<?php echo $i; ?>)" class="question_video_class" style="display: inline-block;"><img src="http://q-study.com/assets/ckeditor/plugins/svideo/icons/svideo.png"></a>
                                    <?php } ?>
                                </td>
                            </tr>
                                  <?php $i++;
                              } ?>
                          <tr>
                            <td colspan="2">Total</td>
                            <td colspan="3"><?php echo $total?></td>
                          </tr>
                        </tbody>
                      </table>

                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        <div class="panel-body">

        <div class="col-md-6">
          
        </div>
         <div class="col-md-5">
         

           

            

         </div>
         </div>


              <div class="col-sm-4" id="draggable" style="display: none;">
                <div class="panel-group" id="waccordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#waccordion" href="#collapseworkout" aria-expanded="true" aria-controls="collapseworkout">  Workout</a>
                      </h4>
                    </div>
                    <div id="collapseworkout" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        <textarea name="workout" class="mytextarea"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>


<?php $i = 1;
$total = 0;
foreach ($total_question as $ind) { 
  if($ind['question_video']!='' && $ind['question_video']!="[]"){ ?>
<!--Question Video Modal-->
<div class="modal fade" id="ss_question_video<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Question Video</h4>
            </div>
            <div class="modal-body">
                <?php 
                    $question_instruct_vid = isset($ind['question_video']) ? json_decode($ind['question_video']):'';
                ?>
                <?php if (isset($question_instruct_vid[0]) && $question_instruct_vid[0] != null ){ ?>
                    <video controls style="width: 100%" id="videoTag<?php echo $i; ?>">
                      <source src="<?php echo isset($question_instruct_vid[0]) ? trim($question_instruct_vid[0]) : '';?>" type="video/mp4">
                    </video>
                    <?php if (isset($question_instruct_vid[1]) && $question_instruct_vid[1] != null ): ?>
                        
                        <video controls style="width: 100%" id="videoTag<?php echo $i; ?>">
                          <source src="<?php echo isset($question_instruct_vid[1]) ? trim($question_instruct_vid[1]) : '';?>" type="video/mp4">
                        </video>
                    <?php endif ?>
                <?php }else{ 
                  
                  ?>
                    <P>No question video</P>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue closeVideoModal" value="<?php echo $i; ?>" id="closeVideoModalId<?php echo $i; ?>" onclick="videoCloseWithModal(<?php echo $i; ?>);">Close</button>
            </div>
        </div>
    </div>
</div>
<?php }$i++; } ?>


<script>
     $(window).on('load',function(){
      <?php 
        foreach ($total_question as $ind) {
          if ( ($ind["question_type"] !=14) && ($question_info_s[0]['question_order'] == $ind['question_order']) ) { ?>

          var id= <?php echo $ind['question_order']; ?>;  
          <?php 
          if($ind['question_video']!='' && $ind['question_video']!="[]"){ ?>
        showQuestionVideo(id);
        <?php }}}?>
    });

function showQuestionVideo(id){

//$('#ss_question_video'+id).modal('show');
}
    
    
    function videoCloseWithModal(id){
      $('#ss_question_video'+id).modal('hide');
      var video = $('#videoTag'+id).get(0);
      if (video.paused === false) {
        video.pause();
      } 
    }
</script>


    <!--Success Modal-->
    <div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="height: 265px">  
                <div class="modal-header" >

                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body row" style="height: 87%;">
                    <img src="assets/images/icon_sucess.png" class="pull-left"> <br> <span class="">Your answer is correct</span> 

                </div>
                <div class="modal-footer">
                 <button id="get_next_question" type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ss_info_worng" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog ui-draggable" style=" width: 48%;">

            <!-- Modal content-->
            <div class="modal-content" style="width: 100%;">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-close" style="font-size:20px;color:red"></i> <span class="">Your answer is wrong</span></h4>
                </div>
                <div class="modal-body">
                    <div id="ss_extar_top20">
                        <?php echo $question_info_s[0]['question_solution']?>
                    </div>

                </div>
                
                <div class="modal-footer">

                 <div class="footer_loding">
                 <h1 id="counter"></h1>
                 <img src="assets/images/loading17.gif">
                 <span>SEC</span>
                 </div>
                    
                  

                <button type="button" class="btn btn_blue rsclose" data-dismiss="modal">close</button>

                </div>
            </div>

        </div>
    </div>

    
    <div class="modal fade ss_modal" id="times_up_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Times Up</h4>
          </div>
          <div class="modal-body row">
            <i class="fa fa-close" style="font-size:20px;color:red"></i> 
            <br><?php echo $question_info_s[0]['question_solution']; ?>
          </div>
          <div class="modal-footer">
            <button type="button" id="question_reload" class="btn btn_blue" data-dismiss="modal">close</button>         
          </div>
        </div>
      </div>
    </div>
    
    <?php $i = 1;
    foreach ($total_question as $indwww) { ?>
      <div class="modal fade ss_modal ew_ss_modal" id="show_description_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">

              <h4 class="modal-title" id="myModalLabel">Question Description</h4>
            </div>
            <div class="modal-body">
              <textarea class="form-control" name="questionDescription"><?php echo $indwww['questionDescription']; ?></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
        <?php $i++;
    } ?>

    <div class="modal fade" id="myModal_2222" role="dialog">
        <div class="modal-dialog ui-draggable" style=" width: 48%;">

            <!-- Modal content-->
            <div class="modal-content" style="width: 100%;height: 64%;">
                <div class="modal-header ui-draggable-handle">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <!--<h4 class="modal-title">Video Lesson</h4>-->
                </div>
                <div class="modal-body" style="height: 481px;">
                    
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" id="textarea_2">

                       <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class=" math_plus" >
                                
                                <?php if($question_info_s[0]['question_name_type'] == 2) { ?>
                                    <?php echo $question_info_vcabulary->questionName_2;?>
                                <?php }else{ ?>
                                    <?php echo ($question_info_vcabulary->questionName); ?>
                                <?php } ?>
                            </div>
                        </div>

                    </div>

                </div>
        
                <div class="modal-footer">
                    <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>   
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade ss_modal" id="ss_info_faild" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">

            <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
          </div>
          <div class="modal-body row">
            <img src="assets/images/alertd_icon.png" style="height:50px;width:50px;" class="pull-left"> <span class="ss_extar_top20">Please select answer</span> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

          </div>
        </div>
      </div>
    </div>
<div  class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="show_instructions">
  <!-- Modal -->
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 500px;margin-left: -100px;">
         
         <div class="btm_word_limt p-3">
             <div>
                <button type="button" id="close_idea" class="pull-right" data-dismiss="modal">x</button>
             </div>
            <br> <hr>
            <?php echo $question_info_s[0]['question_instruction']; ?>
            <div style="height: 30px;">
            <button type="button" id="close_idea" class="btn btn-info pull-right" data-dismiss="modal">Close</button>
            </div>
         </div> 
    </div>
  </div>
</div>

<div class="modal fade ss_modal" id="help_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
         <h4 class="modal-title"  style="font-size: 20px;padding: 10px;background: #34a9c9;color: white;">Intentionally the correct spelling has been done wrong.You have figure out the right spelling.</h4>
         <div class="modal-header">

         </div>
      <div class="modal-body row">
        <div style="border: 2px solid #0000000f;padding:10px;">
            <?php 
               $j=1;
               foreach($wrong_questions as $key => $wrong_question){
                  
                  ?>
                  <p style="font-size: 22px;background-color: #0000000f;padding: 15px;"><?=$wrong_question?></p>
                  <br>

            <?php $j++;}?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="skip_success">
    <div style="max-width: 22%;" class="modal-dialog" role="document">
    <div class="modal-content">
    
        <div class="modal-header">
          <h4></h4>
        </div>
    
        <div class="modal-body">
          <p><i class="fa fa-pencil" style="font-size:28px;color:#f5d743;"></i></p>
          <p>You will not get extra bonus point !</p>
        </div>

        <div class="modal-footer">
          <button id="back_button" type="button" class="btn btn_blue" data-dismiss="modal">Back</button>
          <button id="get_next_question2" type="button" class="btn btn_blue" data-dismiss="modal">Preceed next question</button>
        </div>
    
    </div>
    </div>
</div>

   <div  class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="show_note_details">
   <!-- Modal -->
   <div class="modal-dialog" role="document" style="width: 400px;">
      <div class="modal-content">
            
            <div class="btm_word_limt p-3">
               <div style="position: relative;text-align: center;">
                  <h6 style="color:gray;"><span class="glyphicon glyphicon-pencil pencil_icon" style="color:red;"></span> Note</h6>
                  <button style="margin-left:auto;border: none;background: white;position: absolute;right: 10px;top: 5px;" type="button" id="close_idea" class=" pull-right" data-dismiss="modal">x</button>
               </div>
               <hr>
               <div style="max-height: 200px; overflow-y: auto;">
               <?=$question_description['note_description'];?>
               </div>
               
               
            </div> 
      </div>
   </div>
   </div>


<script>
   $('#ans_help').hide();
   $('#ans_try_again').hide();
   $('.tooltip_rs').hide();


    $(document).ready(function(){
        $('.ans_submit').click(function () {
            
            var form = $("#answer_form");
            var ans_no =$('input[name="answer"]:checked').val();
            if(ans_no != undefined){
            $.ajax({
                type: 'POST',
                url: 'st_answer_grammer',
                data: form.serialize(),
                dataType: 'html',
                success: function (results) {

                if (results == 1) {

                        $('#ss_info_faild').modal('show');

                }else if (results == 2) {

                        $('#ss_info_sucesss').modal('show');
                        $('.ans_wrong').hide();
                        $('.right_ans'+ans_no).show();
                        $('#get_next_question').click(function () {
                            commonCall();
                        });
                }else if (results == 3){

                    $('.ans_wrong').hide();
                    $('.wrong_ans'+ans_no).show();
                    $('#ans_help').show();
                    $('#ans_help').attr('data-id',ans_no);
                    $('#help_button').show();
                    $('.ans_submit').hide();

                }
                }
            });

            }else{
              $('#ss_info_faild').modal('show');
            }
        });

        $('#skip_button').click(function(){
            $('#skip_success').modal('show');
        });



        $('#ans_help').click(function(){
            ans_no = $(this).attr('data-id');

            var first_option_color = '<?=$question_description['text_one_hint_color']?>';
            var second_option_color = '<?=$question_description['text_two_hint_color']?>';
            var third_option_color = '<?=$question_description['text_three_hint_color']?>';
            var fourth_option_color = '<?=$question_description['text_four_hint_color']?>';

            if(ans_no==1){
                $('.option_no'+ans_no).css('background-color',first_option_color);
            }else if(ans_no==2){
                $('.option_no'+ans_no).css('background-color',second_option_color);
            }else if(ans_no==2){
                $('.option_no'+ans_no).css('background-color',third_option_color);
            }else if(ans_no==2){
                $('.option_no'+ans_no).css('background-color',fourth_option_color);
            }
            $('.hint_text'+ans_no).show();
      
            var get_width  = $('.set_tooltip'+ans_no).width();
            $('.tooltip_rs').css('left',get_width);
            $( '.tooltip_rs' ).draggable({
              revert:'invalid' ,
            }); 

            $('#ans_help').hide();
            $('#ans_try_again').show();
        });

            

            $('#ans_try_again').click(function(){
                $('#ans_try_again').hide();
                $('.ans_submit').show();
                $('.write_input_word').removeAttr("style");
                $('.ans_wrong').hide();
                $('.radio_ans').removeAttr("checked");
                $('.tooltip_rs').hide(); 
                $('.all_options').removeAttr("style");
            });
        });

        $('.note_button').click(function(){
            $('#show_note_details').modal('show');
        });
    
</script>







<script type="text/javascript">
      function show_questionModal() {
        $('#myModal_2222').modal('show');
      }
      
     
    // $(".response_answer_class").click(function(){
    //    if($('.response_answer_class').is(":checked")) {  
    //         var value = $(this).val();
    //         var question = <?//=$answerCount?>;  
    //         $('#ans_image'+value).show();
    //         if(question == 1){
    //             for (var i = 1; i <= 10; i++)
    //             {
    //                 if(value != i){
    //                     $('#ans_image'+i).hide();
    //                     $('#response_answer_id'+i).prop('checked',false);
    //                 }
    //             }
               
    //         }
    //     }else{
    //     }
    // });

    $('body').on('click','.rsclose',function(){
        $('.response_answer_class').prop('checked', false);
        $('.ans_image').hide(); 
    })
    $(".image_click").click(function(){
       var value = $(this).val();
       $('#response_answer_id'+value).prop('checked',false);
       $('#ans_image'+value).hide();
    });

   
    </script>
<script>
    
    var time_count = 0;
    
      
      
      function showModalDes(e)
      {
        $('#show_description_' + e).modal('show');
      }
      
      
      function commonCall()
      {
        $question_order = $('#next_question').val();
        //alert($question_order);
        $module_id = $('#module_id').val();
        
        <?php if ($tutorial_ans_info) {?>
          window.location.href = 'show_tutorial_result/'+$module_id;
        <?php }?>
        
        if ($question_order == 0) {
          window.location.href = 'show_tutorial_result/' + $module_id ;
        }
        if ($question_order != 0) {
          window.location.href = 'get_tutor_tutorial_module/' + $module_id + '/' + $question_order;
        }
      }
    </script>

    <script>

      function takeDecesion(){
        var exact_time = $('#exact_time').val();
        
        var countDownDate =  $('#exam_end').val();

        var now = $('#now').val();
        var opt = $('#optionalTime').val();
        var h1 = document.getElementsByTagName('h1')[0];  
        
        var distance = countDownDate - now;  
        var hours = Math.floor(distance/3600);
        //alert(distance);
        var x = distance % 3600;
        
        var minutes = Math.floor(x/60); 
        var seconds = distance%60;

        var t_h = hours * 60 * 60;
        var t_m = minutes * 60;
        var t_s = seconds;
        
        var total = parseInt(t_h) + parseInt(t_m) + parseInt(t_s);
        
        var remaining_time;
        var end_depend_optional = parseInt(exact_time) + parseInt(opt);
        //  alert(opt);
        // if(opt > total){
        //   remaining_time = total;
        // }else{  
        //   remaining_time = parseInt(end_depend_optional) - parseInt(now);
        // }

        if(opt > 0){
          remaining_time = parseInt(end_depend_optional) - parseInt(now);
        
        } else {  
          remaining_time = total;
        }

        setInterval(circulate,1000);

        function circulate(){
            time_count++;
            remaining_time = remaining_time - 1;
    
            var v_hours = Math.floor(remaining_time / 3600);
            var remain_seconds = remaining_time - v_hours * 3600;   
            var v_minutes = Math.floor(remain_seconds / 60);
            var v_seconds = remain_seconds - v_minutes * 60;
            
            $("#student_question_time").val(time_count);
    
            if (remaining_time > 0) {
                h1.textContent = v_hours + " : "  + v_minutes + " : " + v_seconds + "  " ;      
            }else{
                var form = $("#answer_form");
                $.ajax({
                  type: 'POST',
                  url: 'st_answer_matching_multiple_choice',
                  data: form.serialize(),
                  dataType: 'html',
                  success: function (results) {
                    window.location.href = 'show_tutorial_result/'+$('#module_id').val();
                  }
                });
            h1.textContent = "EXPIRED";
          }
        }

    }

<?php if ($module_type == 3  || ($module_type == 2 && $question_info_s[0]['optionalTime'] != 0 && ($question_time_in_second > $moduleOptionalTime || $question_time_in_second == 0))) { ?>
        takeDecesion();
        <?php }?>

</script>


<script>
  function takeDecesionForQuestion() {
    
    var exact_time = $('#exact_time').val();
    
    var now = $('#now').val();
    var opt = $('#optionalTime').val();
    var h1 = document.getElementsByTagName('h1')[0];
    
    var countDownDate =  parseInt (now) + parseInt($('#optionalTime').val());
    
    var distance = countDownDate - now;  
    var hours = Math.floor( distance/3600 );
//        alert(distance)
var x = distance % 3600;

var minutes = Math.floor(x/60); 

var seconds = distance % 60;

var t_h = hours * 60 * 60;
var t_m = minutes * 60;
var t_s = seconds;

var total = parseInt(t_h) + parseInt(t_m) + parseInt(t_s);

var remaining_time;
var end_depend_optional = parseInt(exact_time) + parseInt(opt);

if(opt > total) {
  remaining_time = total;
} else {  
  remaining_time = parseInt(end_depend_optional) - parseInt(now);
}

setInterval(circulate1,1000);

function circulate1() {

    time_count++;
  
  remaining_time = remaining_time - 1;
  
  var v_hours = Math.floor(remaining_time / 3600);
  var remain_seconds = remaining_time - v_hours * 3600;   
  var v_minutes = Math.floor(remain_seconds / 60);
  var v_seconds = remain_seconds - v_minutes * 60;
  
  $("#student_question_time").val(time_count);
  
  if (remaining_time > 0) {
    h1.textContent = v_hours + " : "  + v_minutes + " : " + v_seconds + "  " ;      
  } else {
    var form = $("#answer_form");
    $.ajax({
      type: 'POST',
      url: 'st_answer_matching_multiple_choice',
      data: form.serialize(),
      dataType: 'html',
      success: function (results) {
        if (results == 3) {
          $('#times_up_message').modal('show');
          $('#question_reload').click(function () {
            location.reload(); 
          });
        } if (results == 2) {
          $('#ss_info_sucesss').modal('show');
          
        }
      }
    });
    h1.textContent = "EXPIRED";
  }
}

}
$('#get_next_question').click(function () {
            commonCall();
          });
<?php if (($module_type == 1 || $module_type == 2) && $question_time_in_second != 0) { ?>
  takeDecesionForQuestion();
<?php }?>
</script>
<?php $this->load->view('students/question_module_type_tutorial/module_video'); ?>
<?php $this->load->view('students/question_module_type_tutorial/instruction_video'); ?>
<?php $this->load->view('students/question_module_type_tutorial/drawingBoardMultifule'); ?>