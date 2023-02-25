<script src="<?php echo base_url(); ?>assets/ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>
<style type="text/css">
  body .modal-ku {
width: 750px;
}

.modal-body .panel-body {
    width: 628px;
    height: 466px;
    overflow: auto;
}

.modal-body {
    position: relative;
    padding: 15px;
    }
#ss_extar_top20{
    width: 628px;
    height: 389px;
    overflow: auto;
}
</style>
<style type="text/css">
  
  .qstudy_module_video{
    position: absolute;
    width: 300px;
    height: 230px;
    top: 35px;
    border: 1px solid #ccc;
    background: #fff;
    z-index: 5;
    display: none;
  }
  .qstudy_module_video .header{
    width: 100%;
    border-bottom: 1px solid #ccc;
    text-align: right
  }
  .qstudy_module_video .header span{
    padding: 3px 10px;
    background: #e3e1e1;
    font-weight: bold;
    cursor: pointer;
  }
  .qstudy_module_video .video-content{
    padding: 10px;
    width: 100%;
    height: 89%;
    overflow-y: scroll;
  }
  .qstudy_module_video .video-content p{

    border: 1px solid #a2a0a0;
    padding-left: 5px;
    background: #f6f6f6;
    margin-bottom: 5px;
    cursor: pointer;
  }
  .no_instruction{
    position: absolute;
    top: 40px;
    background: #c1fcc1;
    padding: 5px;
    border-radius: 5px;
    display: none;
  }
  .question_bg_0{
      background: #ffceae !important;
      color: #fff;
    }
  .question_bg_25{
      background: #ffac75 !important;
      color: #fff;
    }
  .question_bg_50{
      background: #ff7f27 !important;
      color: #fff;
    }
  .question_bg_100{
      background: #e85c00 !important;
      color: #fff;
    }
    button:disabled {
      background: #dddddd !important;
    }
    
    .description_video{
       position: relative;
    }
    .description_class{
        position: absolute;
        left: 45px;
    }
    .question_video_class{
        position: absolute;
        left: 70px;
    }
    .ss_timer {
    margin-left: 2px;
    display: inline-block;
    background: #eeeef0;
    border: 0;
    min-width: 110px;
    text-align: center;
}
.ss_timer h1 {
    border: 1px solid #a8a2a2;
    font-size: 17px;
    margin: 0;
    line-height: 28px;
    padding: 3px 0px;
    color: #222;
}

.workout_menu ul li {
    display: inline-block;
    margin-right: 5px;
}

.ss_timer {
    margin-left: 5px;
    display: inline-block;
    background: #eeeef0;
    border: 0;
    min-width: 110px;
    text-align: center;
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
$question_order_array = array_column($total_question, 'question_order');
$last_question_order = end($question_order_array);

$key = $question_info_s[0]['question_order'];
date_default_timezone_set($this->site_user_data['zone_name']);
$module_time = time();
// echo '<pre>';print_r($tutorial_ans_info);die();
if ($tutorial_ans_info) {
    $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'], true);
    $desired = $temp_table_ans_info;
} else {
    $desired = $this->session->userdata('data');
}


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
$link_next = "javascript:void(0);";
$link = "javascript:void(0);";

if (is_array($desired)) {
    $link_key = $key - 1;
    if (array_key_exists($link_key, $desired) && !$tutorial_ans_info) {
        $link = $desired[$link_key]['link'];
    }
    $link_key_next = $key;
    if (array_key_exists($link_key_next, $desired) && !$tutorial_ans_info) {
        $question_id = $question_info_s[0]['question_order'] + 1;
        $link1 = base_url();
        $link_next = $link1 . 'get_tutor_tutorial_module/' . $question_info_s[0]['module_id'] . '/' . $question_id;
    }
}

$module_type = $question_info_s[0]['moduleType'];

$videoName = strlen($module_info[0]['video_name'])>1 ? $module_info[0]['video_name'] : 'Subject Video';
?>

<!--         ***** Only For Special Exam *****         -->
<?php if ($module_type == 3) { ?>
    <input type="hidden" id="exam_end" value="<?php echo strtotime($module_info[0]['exam_end']);?>" name="exam_end" />
    <input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
    <input type="hidden" id="optionalTime" value="<?php echo $module_info[0]['optionalTime'];?>" name="optionalTime" />
    <input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />
<?php }?>
<!--         ***** For Everyday Study & Tutorial *****         -->
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
        ?>col-md-3<?php
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
        <div style="text-align: center;" class="text-center <?php echo $col_class?><?php //if ($module_type != 3) {
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
            <form id="answer_form">
                <input type="hidden" id="answershow" name="answerClick" value="0" />
                <input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id'] ?>" name="module_id">
                <?php if (array_key_exists($key, $total_question)) { ?>
                    <input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] + 1; ?>" name="next_question" />
                <?php } else { ?>
                    <input type="hidden" id="next_question" value="0" name="next_question" />
                <?php } ?>
                <input type="hidden" value="<?php echo $question_info_s[0]['question_id']; ?>" name="question_id" id="question_id">
                <input type="hidden" id="current_order" value="<?php echo $key; ?>" name="current_order">
                <input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType']; ?>" name='module_type'>
                <input type="hidden" name="answer" id="Answer" value="">
                <div class="ss_s_b_main" style="min-height: 100vh">
                <div class="col-md-8" id="box_one" style="display: none;">
                    <div class="col-sm-10" id="answer_box">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title" style="text-align: center;">
                                          Answer
                                            <button type="button" class="woq_close_btn" id="woa_close_btn">&#10006;</button>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">

                                        <textarea  class="mytextarea" name="workout"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-12" style="text-align: center;">
                        <button type="button" class="btn btn_next" id="click_box_btn">Next</button>
                    </div>
                </div>
                <div class="col-md-8" style="padding: 0;margin-top: -10px;">
                    <div class="workout_menu" style="padding-left: 15px;padding-right: 15px;">
                        <ul>
                            <?php if($question_info->questionName != '') { ?>
                                <li><a style="cursor:pointer" id="show_question">Question<i>(Click Here)</i></a></li>
                            <?php } ?>
                            <li>
                                <?php if($module_info[0]['user_type'] == 7) {?>
                                    
                    <div class="workout_menu" style=" padding-right: 15px;">
                        <ul>
                        <li><a style="cursor: pointer;">
                            <span style="color: white;" class="qstudy_Instruction_click">
                                <img src="assets/images/icon_draw.png" ><b> Instruction</b>
                            </span> 
                        </a></li>

                            <?php if ($module_type == 3 || (($module_type == 2 || $module_type == 1) && $question_time_in_second != 0)) { ?>

                                <li><div class="ss_timer" id="demo"><h1>00:00:00 </h1></div></li>

                                <?php }elseif ($module_type == 2 && $question_info_s[0]['optionalTime'] != 0){?>

                                    <li> <div class="ss_timer" id="demo"><h1>00:00:00 </h1></div></li>

                            <?php }?>

                            <?php if ($question_info_s[0]['isCalculator']) : ?>
                                <input type="hidden" name="" id="scientificCalc">
                            <?php endif; ?>
                        </ul>
                    </div>

                                    <?php }else{?>
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> <span class="Instruction_click"><img src="assets/images/icon_draw.png"> Instruction</span></a>
                                <?php }?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-10" id="question_box" style="display: none;">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title" style="text-align: center;">
                                           Question
                                            <button type="button" class="woq_close_btn" id="woq_close_btn">&#10006;</button>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                         <div class=" math_plus">
                                            <?php echo $question_info->questionName; ?>
                                        </div> 
                                        <!-- <textarea disabled class="mytextarea"><?php echo $question_info->questionName;?></textarea> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8" id="box_two">
                        <div class="col-md-12">
                            <div class="row">
                                <!--<div class="col-md-5">-->
                                    
                                <!--</div>-->
                                <div class="col-md-7" style="text-align: center;font-size: 16px;">
                                    <div class="question_hint"><?php echo $question_info->question_hint?></div>
                                </div>
                            </div>
                            <div class="button_click" style="margin-top: 20px;margin-left: -40px;">
                                <div class="panel-body ss_imag_add_right">

                                    <?php
                                    $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
                                    ?>
                                    <?php $i = 1;
                                    foreach ($question_info_ind->vocubulary_image as $row) { ?>
                                        <div class="question_content" id="question_content_<?php echo $i; ?>" style="height: 300px;overflow:scroll;display:none;width: 600px;padding: 10px;border:1px solid #ccc;position: absolute;top:0px;left:19%;z-index: 3;background: #fff;">
                                            <div style="text-align:right;border-bottom: 1px solid #ccc">
                                                <button style="margin-bottom:6px;border: 1px solid #b3b3b3;width:40px;height:40px;border-radius: 20px;font-size: 14px;color: #fff;background: #c1c1c1;" type="button" contentId ="<?php echo $i; ?>" class="wocb_close_btn" id="woa_close_btn">&#10006;</button>
                                            </div>
                                            <div style="padding-top:10px;">
                                                <?php echo $row[0]; ?>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 15px">
                                            <div class="col-md-4">
                                                <!--remove display none last line-->
                                                <div class="row "id="content_percent_<?php echo $i; ?>" style="">
                                                    <div class="col-md-3" style="padding-right: 0px;">
                                                        <span class="c_p_box_0_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: green;">✓</span><span class="r_p_box_0_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: red;">✖</span>
                                                        <button  class="percent_color c_percent_0_<?php echo $i; ?> c_percent_<?php echo $i; ?>" id="c_percent_<?php echo $i; ?>" parcentId ="<?php echo $i; ?>" value="0" style="background: none;width: 100%;padding: 10px 0px;border: 1px solid #ccc;font-size: 14px;text-align: center;">0%</button>
                                                    </div>
                                                    <div class="col-md-3" style="padding-right: 0px;">
                                                        <span class="c_p_box_25_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: green;">✓</span><span class="r_p_box_25_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: red;">✖</span>
                                                        <button class="percent_color c_percent_25_<?php echo $i; ?> c_percent_<?php echo $i; ?>" id="c_percent_<?php echo $i; ?>" parcentId ="<?php echo $i; ?>" value="25" style="background: none;width: 100%;border: 1px solid #ccc;padding: 10px 0px;font-size: 14px;text-align: center;">25%</button>
                                                    </div>
                                                    <div class="col-md-3" style="padding-right: 0px;">
                                                        <span class="c_p_box_50_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: green;">✓</span><span class="r_p_box_50_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: red;">✖</span>
                                                        <button class="percent_color c_percent_50_<?php echo $i; ?> c_percent_<?php echo $i; ?>" id="c_percent_<?php echo $i; ?>" parcentId ="<?php echo $i; ?>" value="50" style="background: none;width: 100%;padding: 10px 0px;border: 1px solid #ccc;font-size: 14px;text-align: center;">50%</button>
                                                    </div>
                                                    <div class="col-md-3" style="padding-right: 0px;">
                                                        <span class="c_p_box_100_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: green;">✓</span><span class="r_p_box_100_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: red;">✖</span>
                                                        <button class="percent_color c_percent_100_<?php echo $i; ?> c_percent_<?php echo $i; ?>" id="c_percent_<?php echo $i; ?>" parcentId ="<?php echo $i; ?>" value="100" style="background: none;width: 100%;padding: 10px 0px;border: 1px solid #ccc;font-size: 14px;text-align: center;">
                                                            100%
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 list_q_box_bg" style="border: 1px solid;color: aqua;margin-left: 14px;padding:2px;width: 60%;" id="list_q_box_<?php echo $i; ?>">
                                                <div class="col-md-12" style="margin-left: -10px;">
                                                    <?php echo $row[0]; ?>
                                                </div>
                                                <div class="row editor_hide" id="list_box_<?php echo $i; ?>" style="margin-bottom:5px">
                                                    <div class="col-xs-2" >
                                                        <p class="ss_lette" style="display:none;background:none;min-height:40px;line-height: 40px"><?php echo $lettry_array[$i - 1]; ?></p>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="box" id="box_<?php echo $i; ?>" style="display:none;border: 1px solid #565656;padding: 10px;text-align: center;">
                                                            <button class="click_btn" contentId ="<?php echo $i; ?>"  id="click_btn" style="background: none;border: none;">Click Here</button>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-1" style="color:<?php //; ?>">
                                                        <input type="hidden" id="percentage_<?php echo $i; ?>" name="percentage_<?php echo $i; ?>" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <?php $i++;
                                    } ?>
                                    <?php
                                    $counter = sizeof($question_info_ind->vocubulary_image);
                                    $desired_i = $counter + 1;
                                    ?>
                                    <?php for ($desired_i; $desired_i <= 20; $desired_i++) { ?>
                                        <div class="row editor_hide" id="list_box_<?php echo $desired_i; ?>" style="display:none; margin-bottom:5px">
                                            <div class="col-xs-2">
                                                <p class="ss_lette" style="min-height: 136px; line-height: 137px; ">
                                                    <?php echo $lettry_array[$desired_i - 1]; ?>
                                                </p>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="box">
                                                    <textarea class="form-control mytextarea" name="vocubulary_image_<?php echo $desired_i; ?>[]"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-1">
                                                <input type="radio" name="response_answer" value="<?php echo $desired_i; ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div style="margin-top:20px;margin-left: 15px;" class="col-md-6">
                                            <a class="btn btn_next" style="margin-right: 13%" id="answer_matching">Submit</a>
                                        </div>
                                    </div>
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
                                        <span>Module Name: <?php echo $question_info_s[0]['moduleName']; ?></span></a>
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
                                          <?php }
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
            </div>
           </form>
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
                <?php }else{ ?>
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

$('#ss_question_video'+id).modal('show');
}
    
    
    function videoCloseWithModal(id){
      $('#ss_question_video'+id).modal('hide');
      var video = $('#videoTag'+id).get(0);
      if (video.paused === false) {
        video.pause();
      } 
    }
</script>


<!--Description Modal-->
<div class="modal fade ss_modal" id="ss_info_description" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Question Description</h4>
            </div>
            <div class="modal-body row">
                <span class="ss_extar_top20"><?php echo $question_info_s[0]['questionDescription']?></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>

<!--Success Modal-->
<div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>

            <div class="modal-body row">
                <img src="assets/images/icon_sucess.png" class="pull-left"> <span class="ss_extar_top20">Your answer is correct</span> 
            </div>
            <div class="modal-footer">
                <button id="get_next_question" type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<!--Solution Modal-->
<div class="modal fade" id="ss_info_worng" role="dialog">
    <div class="modal-dialog ui-draggable" style=" width: 48%;">

        <!-- Modal content-->
        <div class="modal-content" style="width: 100%;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-close" style="font-size:20px;color:red"></i><br> Solution</h4>
            </div>
            <div class="modal-body">
                <div id="ss_extar_top20">
                    <?php echo $question_info_s[0]['question_solution']?>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>   
            </div>
        </div>

    </div>
</div>

<!--Times Up Modal-->
<div class="modal fade ss_modal" id="times_up_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Times Up</h4>
            </div>
            <div class="modal-body row">
                <i class="fa fa-close" style="font-size:20px;color:red"></i>
                <!--<span class="ss_extar_top20">Your answer is wrong</span>-->
                <br><?php echo $question_info_s[0]['question_solution']?>
            </div>
            <div class="modal-footer">
                <button type="button" id="question_reload" class="btn btn_blue" data-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>
<?php $i = 1;
foreach ($total_question as $ind) { ?>
  <div class="modal fade ss_modal ew_ss_modal" id="show_description_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
        </div>
        <div class="modal-body">
          <textarea class="form-control" name="questionDescription"><?php echo $ind['questionDescription']; ?></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <?php $i++;
} ?>


<script>
  function showModalDes(e)
  {
    $('#show_description_' + e).modal('show');
  }
    // $('#answer_matching').click(function () {
    //     var form = $("#answer_form");
    //     $.ajax({
    //         type: 'POST',
    //         url: 'Student/st_answer_matching_workout_two',
    //         data: form.serialize(),
    //         dataType: 'html',
    //         success: function (results) {
    //             if (results == 6) {
    //                 window.location.href = 'show_tutorial_result/'+$("#module_id").val();
    //             }
    //             if (results == 3) {
    //                 $('#ss_info_worng').modal('show');
    //             } if (results == 2) {
    //                 $('#ss_info_sucesss').modal('show');
    //                 $('#get_next_question').click(function () {
    //                     commonCall();
    //                 });
    //             }
    //             if (results == 5) {
    //                 commonCall();
    //             }
    //         }
    //     });
    //
    // });

    function commonCall() {
        $question_order = $('#next_question').val();
        $module_id = $('#module_id').val();

        <?php if ($tutorial_ans_info) {?>
        
            window.location.href = 'show_tutorial_result/'+$module_id;
            // alert($module_id);
            return;
        <?php }?>
        
        if ($question_order == 0) {
            window.location.href = 'show_tutorial_result/' + $module_id ;
        }
        if ($question_order != 0) {
            window.location.href = 'get_tutor_tutorial_module/' + $module_id + '/' + $question_order;
        }
    }

    function showDescription(){
        $('#ss_info_description').modal('show');
    }

</script>

<script>
var time_count = 0;
          function takeDecesion() {
            var exact_time = $('#exact_time').val();

            var countDownDate =  $('#exam_end').val();

            var now = $('#now').val();
            var opt = $('#optionalTime').val();
            var h1 = document.getElementsByTagName('h1')[0];  

            var distance = countDownDate - now;  
            var hours = Math.floor(distance/3600);

            var x = distance % 3600;

            var minutes = Math.floor(x/60); 
            var seconds = distance%60;

            var t_h = hours * 60 * 60;
            var t_m = minutes * 60;
            var t_s = seconds;

            var total = parseInt(t_h) + parseInt(t_m) + parseInt(t_s);

            var remaining_time;
            var end_depend_optional = parseInt(exact_time) + parseInt(opt);

            // if(opt > total){
            //   remaining_time = total;
            // } else {  
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
              } else {
                var form = $("#answer_form");
                $.ajax({
                  type: 'POST',
                  url: 'st_answer_matching',
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
                  url: 'st_answer_matching',
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
                      $('#get_next_question').click(function () {
                        commonCall();
                      });
                    }
                  }
                });
                h1.textContent = "EXPIRED";
              }
            }

          }

            <?php if (($module_type == 1 || $module_type == 2) && $question_time_in_second != 0) { ?>
            takeDecesionForQuestion();
            <?php }?>
        </script>
<script>

    $("#show_question").click(function () {
        $("#question_box").show();
        $("#answer_box").hide();
        $(".btn_next").hide();
        $("#box_two").hide();
    });
    $("#woq_close_btn").click(function () {
        $("#answer_box").show();
        $("#question_box").hide();
        $(".btn_next").show();
        $("#box_two").show();
    });
    $("#click_box_btn").click(function () {
        var workout_val = document.getElementsByName("workout");
        if (workout_val == '')
        {
            alert('You have to do workout first');
        }else
        {
            $("#box_two").show();
            $("#box_one").hide();
        }
    });
    $(".click_btn").click(function (event) {
        event.preventDefault();
        var id = $(this).attr("contentId");
        $("#box_"+id).addClass( "button_bg");
        $('#question_content_'+id).show();
    });
    $(".wocb_close_btn").click(function (event) {
        event.preventDefault();
        var id = $(this).attr("contentId");
        $('#question_content_'+id).hide();
        $('#content_percent_'+id).show();
    });
    $(".percent_color").click(function (event) {
        event.preventDefault();
        var parcentId = $(this).attr("parcentId");
        var value = $(this).attr("value");
        var idIndex = 'percentage_'+parcentId;
        $("#"+idIndex).val(value);
        var classExsit = $(".c_percent_"+parcentId).hasClass( "parcent_bg" );
        // var classExsit = $(".c_percent_"+parcentId).hasClass( "question_bg_"+parcentId );
        var ThisExsit = $(this).hasClass( "parcent_bg" );
        if (classExsit == true)
        {
            $(".c_percent_"+parcentId).removeClass( "parcent_bg" );
            $(".c_percent_"+parcentId).removeClass( "question_bg_"+value );
            $("#list_q_box_"+parcentId).removeClass( "question_bg_"+value );
            $(".c_percent_"+parcentId).removeClass( "one_button_active" );
            // $("#list_q_box_"+parcentId).addClass( "question_bg_"+parcentId );
            // $(this).addClass( "question_bg_"+parcentId );
            // $(this).addClass( "parcent_bg");
            active_button(parcentId,value);
            remove_value_class(value);
        }else
        {
            $(this).addClass( "parcent_bg");
            $(this).addClass( "question_bg_"+value );
            $("#list_q_box_"+parcentId).addClass( "question_bg_"+value );
            $(".c_percent_"+parcentId).addClass( "one_button_active" );
            hide_button(parcentId,value);
            add_value_class(value);
        }
        
        

    });


    

    function hide_button(a,b){
      console.log(a);
      for(var j=0; j<=100;j){
          var value = $('.c_percent_'+j+'_'+a).val();
          //console.log('.c_percent_'+j+'_'+a);
          if(value != b){
              $('.c_percent_'+j+'_'+a).prop('disabled',true);
          }
          j = j + 25;
      }
      var s = 1;
      for(var k=0; k<=4;k++){
          var value = $('.c_percent_'+b+'_'+s).val();
          //console.log('.c_percent_'+b+'_'+s);
          if(a != s){
              $('.c_percent_'+b+'_'+s).prop('disabled',true);
          }
          s = s + 1;
      }
      
    }
    
    function active_button(a,b){
      for(var j=0; j<=100;j){
          var value = $('.c_percent_'+j+'_'+a).val();
          var classExsit = $('.c_percent_'+j+'_'+a).hasClass( "value_active_class_"+j );
         //   console.log('.c_percent_'+j+'_'+a);
          if(classExsit == false){
            $('.c_percent_'+j+'_'+a).prop('disabled',false); 
          }
          j = j + 25;
      }
      
      var s = 1;
      for(var k=0; k<=4;k++){
          var value = $('.c_percent_'+b+'_'+s).val();
          var classExsit = $(".c_percent_"+s).hasClass( "one_button_active" );
          console.log('.c_percent_'+b+'_'+s);
          console.log(classExsit);
          if(classExsit == false){
            $('.c_percent_'+b+'_'+s).prop('disabled',false);
          }
          s = s + 1;
      }
      
      
    }
    
    function add_value_class(b){
      var s = 1;
      for(var k=0; k<=4;k++){
          $('.c_percent_'+b+'_'+s).addClass( "value_active_class_"+b);
          s = s + 1;
      }
    }
    function remove_value_class(b){
      var s = 1;
      for(var k=0; k<=4;k++){
          $('.c_percent_'+b+'_'+s).removeClass( "value_active_class_"+b);
          s = s + 1;
      }
    }
    

</script>

<script>
var checkAllFiled = [];
var resultArray;
    $('#answer_matching').click(function () {
        checkAllFiled = [];
        var PercentageObj =<?php echo json_encode($ans_count);?>;
        var ansFiled = $("#answershow").val();
        var percentInputValue;
        var percentId;
        
        for (var i = 1;i<=PercentageObj;i++)
        {
            var  checkvalue =  $("#percentage_"+i).val();
            if (checkvalue != '')
            {
                //checkAllFiled[i-1] = parseInt(checkvalue);
                checkAllFiled.push(parseInt(checkvalue));
            }
        }
        var stdAnsLen = checkAllFiled.length;
        if ((PercentageObj != stdAnsLen) && ansFiled == '')
        {
            alert('Select all percentage filed and answer filed');
        }else if ((PercentageObj == stdAnsLen) && ansFiled == '')
        {
            alert('Select answer filed');
        }else if ((PercentageObj != stdAnsLen) && ansFiled != '')
        {
            alert('Select all percentage filed');
        }else {

            var question_id = $("#question_id").val();
            $.ajax({
                type: 'POST',
                url: 'Student/st_answer_matching_without_form_workout_two',
                data:{checkAllFiled:checkAllFiled,question_id:question_id,ansFiled:ansFiled} ,
                dataType: 'json',
                success: function (results) {

                    resultArray = results;
                    var correct = results.correct;
                    var correct_ans = results.correct_ans;
                    var PercentageObj = results.percentage_array;
                    var student_answer = results.student_answer;
                    var tutorAnsLen = Object.keys(PercentageObj).length;
                    for (var i = 1;i<=tutorAnsLen;i++)
                    {
                        var percentInputValue = '';
                        var percentId = 'percentage_'+i;
                        var itemvalue = '';
                        var classIcon = '';
                        var classBg = '';
                        var classIconR = '';
                        var classIconC = '';
                        percentInputValue = $("#percentage_"+i).val();
                        itemvalue = PercentageObj[percentId];
                        if (percentInputValue != '')
                        {
                            if (percentInputValue == PercentageObj[percentId])
                            {
                                classIcon = 'c_p_box_'+percentInputValue+'_'+i;
                                $("."+classIcon).css({"display": "block"});
                            }else {
                                classIconR = 'r_p_box_'+percentInputValue+'_'+i;
                                $("."+classIconR).css({"display": "block"});
                                classBg = 'c_percent_'+itemvalue+'_'+i;
                                $("."+classBg).css({"background-color": "green","color":"#fff"});
                            }
                        }
                        if (correct_ans == i)
                        {
                            $("#box_"+i).css({"background-color": "green","color":"#fff"});
                        }

                    }
                    $("#answer_matching").show();
                    if (correct == 1)
                    {
                        $("#Answer").val('correct');
                        answer_saving_workout_two();
                    }else{
                        $("#Answer").val('wrong');
                        answer_saving_workout_two();
                        $('#ss_info_worng').modal('show');
                    }
                }

            });
        }
    });

    $("#answer_saving").click(function () {
        var totalP =<?php echo json_encode($ans_count);?>;
        checkAllFiled = [];
        for (var Tid = 1;Tid<=totalP;Tid++)
        {
            //var Tid =t+1;
            $(".c_p_box_0_"+Tid).css({"display": "none"});
            $(".c_p_box_25_"+Tid).css({"display": "none"});
            $(".c_p_box_50_"+Tid).css({"display": "none"});
            $(".c_p_box_100_"+Tid).css({"display": "none"});
            $(".r_p_box_0_"+Tid).css({"display": "none"});
            $(".r_p_box_25_"+Tid).css({"display": "none"});
            $(".r_p_box_50_"+Tid).css({"display": "none"});
            $(".r_p_box_100_"+Tid).css({"display": "none"});
            $(".percent_color").removeClass('parcent_bg');
            $(".percent_color").removeClass( "question_bg"+Tid );
            $(".list_q_box_bg").removeClass( "question_bg"+Tid );
            $('.percent_color').prop('disabled',false);
            $(".c_percent_0_"+Tid).css({"background": "#fff","color":"#444444"});
            $(".c_percent_25_"+Tid).css({"background": "#fff","color":"#444444"});
            $(".c_percent_50_"+Tid).css({"background": "#fff","color":"#444444"});
            $(".c_percent_100_"+Tid).css({"background": "#fff","color":"#444444"});
            $("#box_"+Tid).css({"background": "#00A2E8"});
            $("#percentage_"+Tid).val('');
        }

        // $(".answerClick").checked = false;
        $(".answerClick").prop('checked', false);
        $("#answer_matching").show();
    });

    function answer_saving_workout_two() {
        var form = $("#answer_form");
        $.ajax({
            type: 'POST',
            url: 'Student/st_answer_matching_workout_two',
            data: form.serialize(),
            dataType: 'html',
            success: function (results) {
                if (results == 6) {
                    window.location.href = 'show_tutorial_result/'+$("#module_id").val();
                }
                if (results == 3) {
                    //$('#ss_info_worng').modal('show');
                } if (results == 2) {
                    $('#ss_info_sucesss').modal('show');
                    $('#get_next_question').click(function () {
                        commonCall();
                    });
                }
                if (results == 5) {
                    commonCall();
                }
            }
        });
    }

</script>

<script type="text/javascript">

    $("#ss_info_worng").on("hidden.bs.modal", function () {
        results = resultArray;
        var correct = results.correct;
        var correct_ans = results.correct_ans;
        var PercentageObj = results.percentage_array;
        var student_answer = results.student_answer;
        var tutorAnsLen = Object.keys(PercentageObj).length;
        for (var i = 1;i<=tutorAnsLen;i++)
        {
            var percentInputValue = '';
            var percentId = 'percentage_'+i;
            var itemvalue = '';
            var classIcon = '';
            var classBg = '';
            var classIconR = '';
            var classIconC = '';
            percentInputValue = $("#percentage_"+i).val();
            itemvalue = PercentageObj[percentId];
            if (percentInputValue != '')
            {
                if (percentInputValue == PercentageObj[percentId])
                {
                    classIcon = 'c_p_box_'+percentInputValue+'_'+i;
                    $("."+classIcon).css({"display": "none"});
                    $(".percent_color").removeClass( "question_bg_"+percentInputValue);
                    $(".list_q_box_bg").removeClass( "question_bg_"+percentInputValue);
                }else {
                    classIconR = 'r_p_box_'+percentInputValue+'_'+i;
                    $("."+classIconR).css({"display": "none"});
                    classBg = 'c_percent_'+itemvalue+'_'+i;
                    $(".percent_color").removeClass("parcent_bg");
                    $(".percent_color").removeClass( "question_bg_"+percentInputValue);
                    $(".list_q_box_bg").removeClass( "question_bg_"+percentInputValue);
                    $('.percent_color').prop('disabled',false);
                    $("."+classBg).css({"background-color": "#fff","color":"black"});
                }
            }
            if (correct_ans == i)
            {
                $("#box_"+i).css({"background-color": "#fff","color":"black"});
                $(".percent_color").removeClass( "question_bg_"+percentInputValue);
                $(".list_q_box_bg").removeClass( "question_bg_"+percentInputValue);
            }

        }
    });
    
</script>
<?php $this->load->view('students/question_module_type_tutorial/module_video'); ?>
<?php $this->load->view('students/question_module_type_tutorial/instruction_video'); ?>
<?php $this->load->view('students/question_module_type_tutorial/drawingBoardForWorkoutTwo');?>
