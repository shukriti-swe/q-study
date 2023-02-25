<script src="<?php echo base_url(); ?>assets/ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>
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

  .result_board p{
    word-break:  break-word;
  }
  @media screen and (min-width: 768px) {
    .space_reduce{
    padding-left: 8px;
    max-width: 106px;

  }
  }
</style>
<?php 

foreach ($total_question as $ind) {

if ($ind["question_type"] == 14) {
  $chk = $ind["question_order"];
 }

} 
  ?>

<style>
  div{
    font-size: 99%;
  }
</style>
<?php
$videoName = strlen($module_info[0]['video_name'])>1 ? $module_info[0]['video_name'] : 'Subject Video';
$question_order_array = array_column($total_question, 'question_order');
$last_question_order = end($question_order_array);

date_default_timezone_set($this->site_user_data['zone_name']);
$module_time = time();
    // echo $this->session->userdata('exam_start').'<pre>';//1543918806
    // echo date('Y-m-d H:i:s',$this->session->userdata('exam_start'));die;
$key = $question_info_s[0]['question_order'];
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
?>
<?php 
    $question_instruct = isset($question_info_s[0]['question_video']) ? json_decode($question_info_s[0]['question_video']):'';
    $question_instruct_id = $question_info_s[0]['id'];
    
?>

<!--         ***** Only For Special Exam *****         -->
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

    <a class="btn btn_next" id="draw" onClick="test()" data-toggle="modal" data-target=".bs-example-modal-lg" style="margin: 0 20px;">
     Workout <img src="assets/images/icon_draw.png">
   </a>
 </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="ss_s_b_main" style="min-height: 100vh">
      <form id="answer_form"> 
        <input type="hidden" value="<?php echo $question_info_s[0]['question_id']; ?>" name="question_id" id="question_id">

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
          
          <input type="hidden" value="" id="obtnMark" name="obtain_marks">

          <div class="col-sm-4">
              <div class="workout_menu" style=" padding-right: 15px;">
                <ul>
                <li><a style="cursor:pointer" id="show_question"> <img src="assets/images/icon_draw.png"/> Instruction</a></li>

                <?php if ($module_type == 3 || (($module_type == 2 || $module_type == 1) && $question_time_in_second != 0)) { ?>

                  <li><div class="ss_timer" id="demo"><h1>00:00:00 </h1></div></li>

                <?php }elseif ($module_type == 2 && $question_info_s[0]['optionalTime'] != 0){?>

                  <li><div class="ss_timer" id="demo"><h1>00:00:00 </h1></div></li>

                <?php }?>

                <?php if ($question_info_s[0]['isCalculator']) : ?>
                  <li><input type="hidden" name="" id="scientificCalc"></li>
                <?php endif; ?>
                </ul>
              </div>

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
				  <?php if($module_info[0]['user_type'] == 7) {?>
				<a style="cursor: pointer;">
                      <span style="color: #2198c5;" class=" qstudy_Instruction_click">
                          <img src="assets/images/icon_draw.png" ><b> Instruction</b>
                      </span> 
					  Question
                  </a>

				<?php }else{?>
                    <a role="button" <?php if ($module_info[0]['moduleName']) { ?>onclick="abc()"<?php } else {
                      ?> data-toggle="collapse" data-parent="#accordion" href="#collapseOne"<?php }?> aria-expanded="true" aria-controls="collapseOne">
						        <span style="color:#2198c5;" class="Instruction_click">
                        <img src="assets/images/icon_draw.png" ><b> Instruction</b>
                    </span> Question
					</a>
					 <?php }?>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <div class="image_q_list">

                      <div class="row">
                        <div class="col-xs-4 text-right col-lg-4 space_reduce" style="font-size: 13px;">Word</div>
                        <div class="col-xs-8  col-lg-6">?</div>
                      </div>
                      
                        <?php if (!empty($question_info_vcabulary->definition)) : ?>
                        <div class="row">
                          <div class="col-xs-4 text-right col-lg-4 space_reduce" style="font-size: 13px;">Definition</div>
                          <div class="col-xs-8  col-lg-6"><?php echo $question_info_vcabulary->definition; ?></div>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($question_info_vcabulary->parts_of_speech)) : ?>
                        <div class="row">
                          <div class="col-xs-4 text-right col-lg-4 space_reduce" style="font-size: 13px;">Parts of speech</div>
                          <div class="col-xs-8  col-lg-6"><?php echo $question_info_vcabulary->parts_of_speech; ?></div>
                        </div>
                        <?php endif; ?>          

                        <?php if (!empty($question_info_vcabulary->synonym)) : ?>
                        <div class="row">
                          <div class="col-xs-4 text-right col-lg-4 space_reduce" style="font-size: 13px;">Synonym </div>
                          <div class="col-xs-8  col-lg-6"><?php echo $question_info_vcabulary->synonym; ?></div>
                        </div>
                        <?php endif; ?>
                      
                        <?php if (!empty($question_info_vcabulary->antonym)) : ?>
                        <div class="row">
                          <div class="col-xs-4 text-right col-lg-4 space_reduce" style="font-size: 13px;">Antonym</div>
                          <div class="col-xs-8  col-lg-6"><?php echo $question_info_vcabulary->antonym; ?></div>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($question_info_vcabulary->sentence)) : ?>
                        <div class="row">
                          <div class="col-xs-4 text-right col-lg-4 space_reduce" style="font-size: 13px;">Hint</div>
                          <div class="col-xs-8  col-lg-6">
                            <?php //echo $question_info_vcabulary->sentence; ?>
                            <a href="javascript:;" id="hintPopover" data-html="true" class="text-center" style="display: inline-block;">
                              <img src="assets/images/icon_details.png">
                            </a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($question_info_vcabulary->near_antonym)) : ?>
                        <div class="row">
                          <div class="col-xs-4 text-right space_reduce" style="font-size: 13px;">Category</div>
                          <div class="col-xs-8 "><?php echo $question_info_vcabulary->near_antonym; ?></div>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($question_info_vcabulary->speech_to_text)) : ?>
                        <div class="row">
                          <div class="col-xs-4 text-right col-lg-4 space_reduce" style="font-size: 13px;">Speech to text</div>

                            <?php if ($question_info_vcabulary->speech_to_text) {?>
                            <div class="col-xs-2" style="font-size: 18px; padding-right:0px">
                              <i class="fa fa-volume-up" onclick='MySpeak()'></i>
                              <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                              <input type="hidden" id="wordToSpeak" value="<?php echo isset($question_info_vcabulary->speech_to_text) ? $question_info_vcabulary->speech_to_text:''; ?>">
                            </div>

                            <div class="col-xs-6 space_reduce col-lg-6" style="padding-left:0px;">
                              <small  style="font-size:12px !important;color:red; float:left;">Listening to audio will deduct 2 number</small>
                            </div>
                            <?php }?>

                        </div>
                        <?php endif; ?>

                        <?php if (!empty($question_info_vcabulary->audioFile)) : ?>
                        <div class="row">
                          <div class="col-xs-4 text-right col-lg-4 space_reduce" style="font-size: 13px;">Audio File</div>
                            <?php if (isset($question_info_vcabulary->audioFile)&& file_exists($question_info_vcabulary->audioFile)) : ?>
                          <div class="col-xs-2" onclick="showAudio()" style="font-size: 18px; padding-right:0px">
                            <i class="fa fa-volume-up"></i>
                            <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                          </div>
                          <div class="col-xs-5 col-lg-6 space_reduce" style="padding-left:0px;">
                            <small  style="font-size:15px !important;color:red; float:left;">Listening to audio will deduct 1 number</small>
                          </div>
                            <?php endif; ?>
                      </div>
                        <?php endif; ?>              

                    <?php if (!empty($question_info_vcabulary->ytLinkInput)) : ?>   
                      <div class="row">
                        <div class="col-xs-4 text-right col-lg-4 space_reduce" style="font-size: 13px;">Video file</div>

                        <div class="col-xs-8 col-lg-9">
                          <?php if (isset($question_info_vcabulary->ytLinkInput) && strlen($question_info_vcabulary->ytLinkInput)>10) : ?>
                          <label id="ytIcon" class="ytIcon"><i class="fa fa-youtube"></i></label>
                          <input type="hidden" id="hiddenYtLink" value="<?php echo $question_info_vcabulary->ytLinkInput; ?>">
                          <input type="hidden"  id="hiddenYtTitle" value="<?php echo isset($question_info_vcabulary->ytLinkTitle) ? $question_info_vcabulary->ytLinkTitle:''; ?>">

                            <?php elseif (isset($question_info_vcabulary->videoFile)) : ?>
                            <label id="vidIcon" for="exampleInputFilevideo"><i class="fa fa-youtube-play"></i></label>
                          <?php endif;?>
                        </div>
                      </div>
                    <?php endif; ?>


                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
        <div class="col-sm-4">
          <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">Answer</a>
                </h4>
              </div>
              <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  <div class="image_box_list_result result">


                    <div class="image_box_list" style="overflow: visible;">
                      <div class="row">

                        <div class="">
                          <div class="">
                            <?php foreach ($question_info_vcabulary->vocubulary_image as $row) { ?>
                              <div class="result_board" id="quesBody">
                                <?php echo $row[0]; ?>
                              </div>
                              <br/>
                            <?php } ?>
                            <div class="form-group" style="padding: 0px 12px;">
                              <input type="text" class="form-control" autocorrect="off" spellcheck="false" autocomplete="off" name="answer">
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button class="btn btn_next" type="submit"  id="answer_matching">Submit</button>

                    </div> 

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
                  <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  <span>Module Name: <?php echo isset($module_info[0]['moduleName'])?$module_info[0]['moduleName']:'Not found'; ?></span></a>
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
        <button id="get_next_question" type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <i class="fa fa-close" style="font-size:20px;color:red"></i> <span class="ss_extar_top20">Your answer is wrong</span>
        <br>
        <?php echo $question_info_s[0]['question_solution']; ?> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
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


<?php $i=1;foreach ($total_question as $ind) { ?>
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
}?>

<div id="popoverContent" style="display:none">
  <br><?php echo trim($question_info_vcabulary->sentence);?>
</div>

<!-- video player -->
<div id="ytPlayer" title="Reference video" style="display: none">
  <div id="P1" class="player" style="margin-top: 30px"></div>
</div>

<!--<script src='https://code.responsivevoice.org/responsivevoice.js'></script> -->
<script src="https://code.responsivevoice.org/responsivevoice.js?key=RCb3gYkz"></script>
<script>

  function showQuestionVideo(){
      $('#ss_question_video').modal('show');
  }
  var time_count = 0;
  var origMark = <?php echo $question_info_s[0]['questionMarks']; ?>;
    //initially obtn mark
    $(document).ready(function(){
      $("input[name='answer']").focus();

        //var origMark = <?php echo $question_info_s[0]['questionMarks']; ?>;
        origMark = parseInt(origMark);

        if(!sessionStorage.getItem('audioPlayed')){
          $('#obtnMark').val(origMark);
        } else {
          $('#obtnMark').val(parseInt(origMark)-2);
        }
      })

    //text to speech
    function MySpeak() {
      var word = $('#wordToSpeak').val();
      responsiveVoice.speak(word);
      

      //after listening text to speech obtain mark will decrease by 2
      if(!sessionStorage.getItem('audioPlayed')) {
      //var key = 
      sessionStorage.setItem('audioPlayed', 'true');
      //var obtnMark  = <?php echo $ind['questionMarks']; ?>;
      obtnMark = parseInt(origMark) - 2;
      console.log('hit0:'+ obtnMark);
      obtnMark = obtnMark < 0 ? 0 : obtnMark; 
      console.log('hit:'+ obtnMark);
      $('#obtnMark').val(obtnMark);
    }

  }

//    $('#answer_matching').click(function () {
  $("#answer_form").on('submit', function (e) {
    e.preventDefault();
    
    var form = $("#answer_form");
    $.ajax({
      type: 'POST',
      url: 'st_answer_matching_vocabolary',
      data: form.serialize(),
      dataType: 'html',
      success: function (results) {
        if (results == 6) {
          window.location.href = 'show_tutorial_result/'+$("#module_id").val();
        }
        if (results == 3) {
          $('#ss_info_worng').modal('show');
        } if (results == 2) {
          $('#ss_info_sucesss').modal('show');
          sessionStorage.removeItem('audioPlayed');
          $('#get_next_question').click(function () {
            commonCall();
          });
        }
        if (results == 5) {
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

  function getLetter(letter)
  {
    var val = document.getElementById('exampleInputl1').value;
    var total = val + letter;
    $('#exampleInputl1').val(total);
  }
  function delLetter(){
    var val = document.getElementById('exampleInputl1').value;
    var sillyString = val.slice(0, -1);
    $('#exampleInputl1').val(sillyString);
  }
  function showModalDes(e)
  {
    $('#show_description_'+e).modal('show');
  }
</script>

<script>

  function takeDecesion(){
	  console.log('takeDecesion');
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

        function circulate() {
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
              url: 'st_answer_matching_vocabolary',
              data: form.serialize(),
              dataType: 'html',
              success: function (results) {
                sessionStorage.removeItem('audioPlayed');
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
		  console.log('takeDecesionForQuestion');
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
           url: 'st_answer_matching_vocabolary',
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


//audio play
function showAudio(){
  $("audio").show();
}


//yt icon click action
$('.ytIcon').on('click', function(){
    //convert yt url to embed link
    var videoUrl = $('#hiddenYtLink').val();
    var videoTitle = $('#hiddenYtTitle').val();

    //generate data
    var data= "{videoURL:'"+videoUrl+"',containment:'self',startAt:0,mute:false,autoPlay:false,loop:false,opacity:.9, ratio:'auto'}"
    $('#P1').attr('data-property', data);
    //var videoId = getYtId(url);
    
    $( "#ytPlayer" ).dialog({
      width:700,
      height: 500,
      title: videoTitle,
      buttons: [
      {
        text: "Close",
        icon: "ui-icon ui-icon-heart",
        click: function() {
          jQuery('#P1').YTPPause()
          $( this ).dialog( "close" );
        }
      }
      ]
    });
    jQuery("#P1").YTPlayer();
  })

function getYtId(url) {
  var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
  var match = url.match(regExp);

  if (match && match[2].length == 11) {
    return match[2];
  } else {
    return 'error';
  }
}

//hint popover
  $('#hintPopover').webuiPopover({
	url:'#popoverContent', 
    width:350,
    height:250,
    closeable:true
  });
</script>


<?php $this->load->view('students/question_module_type_tutorial/module_video'); ?>
<?php $this->load->view('students/question_module_type_tutorial/instruction_video'); ?>
<?php $this->load->view('students/question_module_type_tutorial/drawingBoard'); ?>
