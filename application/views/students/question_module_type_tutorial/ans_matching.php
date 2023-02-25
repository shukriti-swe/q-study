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
        height: 466px;
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

    // echo '<pre>';print_r($this->session->userdata('obtained_marks'));die;
    
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
?>

<style>
    .box {
        padding: 0px !important;
    }
    
    .ss_m_qu .row > div:last-child {
        /*padding-left: 15px !important;*/
    }
    
    .image_box_list .row > div:first-child {
        /*padding-right: 15px;*/
    }
    
    .image_box_list {
        overflow: initial;
    }
</style> 


<!--   Special Exam   -->
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
    <div class="ss_index_menu <?php if ($module_type == 3) {
        ?>col-md-2<?php
    }?>">
    <?php if ($module_type == 1) { ?>
      <a href="all_tutors_by_type/<?php echo $total_question[0]['user_id'];?>/<?php echo $total_question[0]['moduleType'];?>" style="display: inline-block;">Index</a>
    <?php } else {?>
      <!-- <a >Index</a> -->
    <?php }?>
    <?php  if ($module_info[0]['video_name']) { ?>
      <button class="btn btn_next" id="openVideo" style="margin-left: 25px;"><i class="fa fa-play" style="color:#35B6E7;margin-right: 5px;"></i><?php echo $videoName;  ?></button>
    <?php } ?>
  </div>
    <?php if ($module_type == 3 || (($module_type == 2 || $module_type == 1) && $question_time_in_second != 0)) { ?>
    <div class="col-sm-4" style="text-align: right">
      <div class="ss_timer" id="demo"><h1>00:00:00 </h1></div>
    </div>
    <?php }elseif ($module_type == 2 && $question_info_s[0]['optionalTime'] != 0){?>
        <div class="col-sm-3" style="text-align: right">
            <div class="ss_timer" id="demo"><h1>00:00:00 </h1></div>
        </div>
    <?php }?>
    <?php
      $col_class = 'col-sm-7';
      if (($module_type == 2 && $question_info_s[0]['optionalTime'] != 0) || $module_type == 3){
          $col_class = 'col-sm-4';
      }
      ?>
  <div style="text-align: center;" class="text-center <?php echo $col_class?> ss_next_pre_top_menu">
    <?php if ($question_info_s[0]['isCalculator']) : ?>
      <input type="hidden" name="" id="scientificCalc">
    <?php endif; ?>
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

    <a class="btn btn_next" id="draw" onClick="test()" data-toggle="modal" data-target=".bs-example-modal-lg" style="margin-right: -359px;">
     Workout <img src="assets/images/icon_draw.png">
   </a>
 </div>
</div>
   
   <div class="container-fluid">
        <div class="row">       
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
                <div class="col-sm-8">
                <div>
                        <div  style="position: absolute;left:-1000px;min-height: 250px;min-width: 600px;text-align: center;" id="quesBody">
                                    <textarea class="mytextareaQuestion" name="questionName" disabled><?php
                                    $question_info = json_decode($question_info_s[0]['questionName']);
                                    echo $question_info->questionName;
                                    ?></textarea>
                                </div>
                    </div>
                <div class="workout_menu" style="padding-left: 15px;padding-right: 15px;">
                        <ul>
                            <li>
                            <?php if($module_info[0]['user_type'] == 7) {?>
                            <a style="cursor: pointer;">
                                  <span style="color: white;" class=" qstudy_Instruction_click">
                                      <img src="assets/images/icon_draw.png" ><b> Instruction</b>
                                  </span> 
                              </a>
                            <?php }else{?>
                                <a role="button" style="color:#fff" <?php if($module_info[0]['moduleName']) {?>onclick="abc()"<?php } else {?> data-toggle="collapse" data-parent="#accordion" href="#collapseOne"<?php }?> aria-expanded="true" aria-controls="collapseOne">
                                        <span  class="Instruction_click">
                                            <img src="assets/images/icon_draw.png" > Instruction
                                        </span>
                                </a>
                                <?php }?>
                            </li>
                            <li><a style="cursor:pointer"  id="show_question">Question<i>(Click Here)</i></a></li>
                        </ul>
                    </div>
                    <div style="display: none;" class="panel-group col-sm-6 question_module" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div style="padding:5px 15px;" class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                     Question
                                    <button type="button" class="woq_close_btn" id="woq_close_btn">&#10006;</button>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="math_plus" >
                                    <textarea class="mytextareaQuestion" name="questionName" disabled><?php
                                    $question_info = json_decode($question_info_s[0]['questionName']);
                                    echo $question_info->questionName;
                                    ?></textarea>
                                </div>
                            </div>
                        </div>                                                
                    </div>
                    
                    <div class="row answer_module" style="margin-top: 20px;">
                        <div class="col-sm-12">
                            <form id="answer_form">
                                <input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id'] ?>" name="module_id">
                                <?php if (array_key_exists($key, $total_question)) { ?>
                                    <input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] + 1; ?>" name="next_question" />
                                <?php } else { ?>
                                    <input type="hidden" id="next_question" value="0" name="next_question" />
                                <?php } ?>
                                <input type="hidden" value="<?php echo $question_info_s[0]['question_id']; ?>" name="question_id" id="question_id">
                                <input type="hidden" id="current_order" value="<?php echo $key; ?>" name="current_order">
                                <input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType']; ?>" name='module_type'>

                                <input type="hidden" name="total_ans" value="<?php echo sizeof($question_info_left_right->right_side); ?>">

                                <?php $i = 1;
                                foreach ($question_info_left_right->left_side as $key=> $row) {
                                    ?>
                                    <div class="row" style="margin-bottom: 20px;">
                                        <div class="col-md-9">
                                            <div class="col-xs-11">
                                                <div class="box" style="float: right;margin-right: 10px;">
                                                    <div class="ss_w_box">
                                                        <?php echo $row[0]; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-1">
                                                <p class="ss_lette" id="color_left_side_<?php echo $i; ?>" style="min-height: 0px;">
                                                    <input type="radio" id='left_side_<?php echo $i; ?>' name="left_side_<?php echo $i; ?>" value="<?php echo $i; ?>" data-id="1" class="left" onclick="getLeftVal(this);" style="min-height: 60px;">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="col-xs-1">
                                                <p class="ss_lette" id="color_right_side_<?php echo $i; ?>" style="min-height: 60px;">
                                                    <input type="radio" name="right_side_<?php echo $i; ?>"  value="<?php echo $i; ?>" class="right" onclick="getRightVal(this);" style="min-height: 60px;">
                                                </p>
                                            </div>

                                            <div class="col-xs-9">
                                                <div class="box ">
                                                    <div class="ss_w_box text-left">
                                                        <p>
                                                            <?php
                                                            echo $question_info_left_right->right_side[$key][0];
                                                            echo '<br><br>'; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" class="form-control" name="answer_<?php echo $i; ?>" id="answer_<?php echo $i; ?>" data="1" onclick="getAnswer();">
                                            <div class="col-xs-1">
                                                <span class="" id="message_<?php echo $i - 1; ?>"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; } ?>
                                <div class="row">
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <button type="button" class="btn btn_next " id="answer_matching">submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
        
        
        
                <div class="col-sm-4">
                    <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  
                                        <span>Module Name: <?php echo isset($module_info[0]['moduleName'])?$module_info[0]['moduleName']:'Not found'; ?></span></a>
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
            
                <div class="col-sm-4" id="draggable" style="display: none;">
                    <div class="panel-group" id="waccordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#waccordion" href="#collapseworkout" aria-expanded="true" aria-controls="collapseworkout">Workout yyy</a>
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
        
                <!--<div class="col-sm-12" style="text-align: center;">  
                    <button type="button" class="btn btn_next" id="answer_matching">submit</button>
                </div>-->
            </form>                 
        </div>
<!--        <div class="row">
            <div class="ss_s_b_main" style="min-height: 100vh">
            
                
                    
            </div>           
        </div>-->
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
                <button type="button" id='get_next_question' class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="max-width: 550px;margin-top: 14%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
                <i class="fa fa-close" style="font-size:20px;color:red"></i> <span class="ss_extar_top20">Your answer is wrong</span>
                <br> <?php echo $question_info_s[0]['question_solution']; ?> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal" onclick="wrongClose()" >close</button>         
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

    var time_count = 0;

    var res;

    $('.right').attr('disabled', true);
    var left_arr = new Array();
    var right_arr = new Array();
    var total_right_side_input = '<?php echo count($question_info_left_right->right_side);?>';
    var answer_array = new Array();
    
    var color_array = new Array('red', 'green', 'blue', '#00BFFF', '#b3230a', '#708090', '#2F4F4F', '#C71585', '#8B0000', '#808000', '#FF6347', '#FF4500', '#FFD700', '#FFA500', '#228B22', '#808000', '#00FFFF', '#66CDAA', '#7B68EE', '#FF69B4');
    
    function getLeftVal(e) {
        var left_ans_val = e.value;
        
        if($.inArray(e.value, left_arr) !== -1) {
            $("#left_side_" + left_ans_val).prop('checked', false);
            $('.left').attr('disabled', false);
            // $("#color_left_side_" + left_ans_val).css({'background-color': '#eeeeee !important'});
            $("#color_left_side_" + left_ans_val).css({'background-color': ''});
            
            if($.inArray(e.value, right_arr) !== -1) {
                for(var i = 1; i <= total_right_side_input; i++){
//                    answer_array.push = $("input[name='answer_" + i + "']").val();
                    if(e.value == $("input[name='answer_" + i + "']").val()){
                        var match_index = i;
                        $("input[name='answer_" + i + "']").val('');
                    }
                }
//                alert(match_index);
                $("input[name='right_side_" + match_index + "']").prop('checked', false);
                // $("#color_right_side_" + match_index).css({'background-color': '#eeeeee !important'});
                $("#color_right_side_" + match_index).css({'background-color': ''});

                right_arr.splice($.inArray(e.value, right_arr),1);
            }
            left_arr.splice($.inArray(left_ans_val, left_arr),1);
        } else {
            $('.right').attr('disabled', false);
            $('.left').attr('disabled', true);
            $("#left_side_" + left_ans_val).attr('disabled', false);
            var color_left = color_array[left_ans_val - 1];
            //document.getElementById("color_left_side_1").style.backgroundColor = color_left;
            document.getElementById("color_left_side_" + left_ans_val).setAttribute('style', 'background-color:' + color_left + ' !important;min-height: 60px;');
            left_arr.push(left_ans_val);
        }
//        console.log(left_arr);
    }

    function getRightVal(e) {
        var last = left_arr.slice(-1)[0];
        var right_ans_val = e.value;
        
        right_arr.push(last);
        
        document.getElementById("answer_" + right_ans_val).value = last;

        $('.right').attr('disabled', true);
        $('.left').attr('disabled', false);
        var color_right = color_array[last - 1];
        document.getElementById("color_right_side_" + right_ans_val).setAttribute('style', 'background-color:' + color_right + ' !important;min-height: 60px;');
//        console.log(right_arr);
    }

    function getAnswer()
    {
        //alert(this.attr('data'));
    }
</script>

<script>
    $('#answer_matching').click(function () {
        var form = $("#answer_form");
        $.ajax({
            type: 'POST',
            url: 'st_answer_multiple_matching',
            data: form.serialize(),
            dataType: 'json',
            success: function (results) {
                if (results == 6) {
                    window.location.href = 'show_tutorial_result/'+$('#module_id').val();
                }
                if (results != 5) {
                    var obj = (results);
                    res = results;
                    var ii = 0;
                    if (typeof obj.student_ans !== 'undefined') {
                        console.log(obj.student_ans);
                        var abc=0;
                        for (var i = 0; i < obj.student_ans.length; i++) {
                             if(obj.student_ans[i]!=""){
                                abc=1
                             
                            }
                            if (obj.student_ans[i] == obj.tutor_ans[i]) {
                                $("#message_" + i).removeClass("fa fa-close");
                                $("#message_" + i).addClass("fa fa-check");
                            } else {
                                $("#message_" + i).removeClass("fa fa-check");
                                $("#message_" + i).addClass("fa fa-close");
                                ii++;
                            }
                            if(obj.student_ans.length-1==i){
                               $('.left').attr('disabled', false);
                               }

                        }
                    }
                    
                    if (ii == 0) {
                        $('#ss_info_sucesss').modal('show');
                        $('#get_next_question').click(function () {
                            commonCall();
                        });
                    } else {
                        $("#ss_info_worng").modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                    }
                }
                else {
                    commonCall();
                }
                
            }
        });
    });
    
    function commonCall() {
        $question_order = $('#next_question').val();
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
    
    function showModalDes(e)
    {
        $('#show_description_' + e).modal('show');
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
            //     remaining_time = total;
            // }else{  
            //     remaining_time = parseInt(end_depend_optional) - parseInt(now);
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
                        url: 'st_answer_multiple_matching',
                        data: form.serialize(),
                        dataType: 'json',
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
                    url: 'st_answer_multiple_matching',
                    data: form.serialize(),
                    dataType: 'html',
                    success: function (results) {
                        if (results != 5) {
                            var obj = (results);
                            res = results;
                            var ii = 0;
                            if (typeof obj.student_ans !== 'undefined') {
                                for (var i = 0; i < obj.student_ans.length; i++)
                                {
                                    if (obj.student_ans[i] == obj.tutor_ans[i])
                                    {
                                        $("#message_" + i).removeClass("fa fa-close");
                                        $("#message_" + i).addClass("fa fa-check");
                                    } else
                                    {

                                        $("#message_" + i).removeClass("fa fa-check");
                                        $("#message_" + i).addClass("fa fa-close");
                                        ii++;
                                    }
                                }
                                if (ii == 0) {
                                    $('#ss_info_sucesss').modal('show');
                                    $('#get_next_question').click(function () {
                                        commonCall();
                                    });
                                } else {
                                    $('#times_up_message').modal('show');
                                    $('#question_reload').click(function () {
                                        location.reload(); 
                                    });
                                }
                            } else {
                                $('#times_up_message').modal('show');
                                $('#question_reload').click(function () {
                                    location.reload(); 
                                });
                            }
                            

                            
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
        $(".question_module").show();
        $(".answer_module").hide();
    });
    $("#woq_close_btn").click(function () {
        $(".question_module").hide();
        $(".answer_module").show();
    });

    function wrongClose() {
        for (var i = 0; i < res.student_ans.length; i++) {
            let x = i+1;
            let right_side = "right_side_"+x+"";
            let left_side = "left_side_"+x+"";
            let color_left_side = "color_left_side_"+x+"";
            let color_right_side = "color_right_side_"+x+"";

            $("input:radio").attr("checked", false)

            document.getElementById(color_left_side).style.backgroundColor  = "white";
            document.getElementById(color_right_side).style.backgroundColor  = "white";
            $("#message_" + i).removeClass("fa fa-close");
            $("#message_" + i).removeClass("fa fa-check");
        }
    }

</script>
<?php $this->load->view('students/question_module_type_tutorial/module_video'); ?>
<?php $this->load->view('students/question_module_type_tutorial/instruction_video'); ?>
<?php $this->load->view('students/question_module_type_tutorial/drawingBoard'); ?>
