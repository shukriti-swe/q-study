<script src="<?php echo base_url(); ?>assets/ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>

<style type="text/css">
  body .modal-ku {
width: 750px;
}

.modal-body #quesBody {
     width: 628px;
    height: 466px;
    overflow: auto;
}

.modal-body {
    position: relative;
    padding: 15px;
    }
#ss_extar_top20{
    width: 100%;
    height: 389px;
    overflow: auto;
    max-width: 628px;
}

.ss_lette input[type=radio] {
    min-height: 162px!important;
    display: block;
    line-height: 149px;
}
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
    .ss_lette {
        min-height: 158px;
        line-height: 158px;
    }

    .ques_solution{
        display: flex;
        padding: 9px 17px;
    }
    .ques_class{
        background-color: #7f7f7f;
        padding: 5px 10px;
    }

    .sol_class{
        padding: 5px 5px;
        background-color: #eeeeee;
        cursor: pointer;
    }

    .math_plus {
        display: inline-block;
        padding: 10px;
        min-height: 40px;
    }

.ssss_class{
    margin-bottom: 8px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 6px;
}
.checkbox_class{
    display: inline-block;
    width: 53px;
    position: relative;
}
.ssss_class p{
    font-size: 23px;
    display: inline-block;
    margin-top: 0;
}

.ssss_class input[type=checkbox] {
    transform: scale(1.4);
    margin-left: 3px;
    position: relative;
    top: 2px;
    left: -13px;
    margin-top: 0;
}
.ans_image{
    position: absolute;
    display: none;
    top: -5px;
    left: -2px;

}
.ans_image img{
    width: 30px;
}
.ans_image button{
    border:none;
    background:none;
}
.ans_image span{
    font-family: berlin Sans FB;
    font-size: 24px;
    font-weight: bold;
    color: #92d050;
    position: absolute;
    top: 2px;
}
.image_view_click{
    border:none;
    background:none;
    position: absolute;
    top: 4px;
    right: 0px;
}
.image_view_click img{
    width: 24px;
}
.ss_w_box .image-editor{
    height: 184px;
}
.ss_w_box{max-height: 192px;}
.panel_p_qus p{
    font-size: 20px;
    font-weight: bold;
    margin-left: 0px;
    margin-bottom: 10px;
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
.footer_loding{
  position: absolute;
  bottom: 10px;
  left: 0;
  right: 0;
  margin: auto;
  height: 90px;
  width: 90px;
 
}
.footer_loding h1{
position: absolute;
top: 0;
left: 0;
margin: auto;
width: 100%;
height: 100%;
text-align: center;
line-height: 66px;
z-index: 2;
font-size: 24px;
font-weight: bold;
}
.footer_loding img{
   height: 90px;
  width: 90px;

}
.footer_loding span{
  position: absolute;
    bottom: -22px;
    left: 0;
    margin: auto;
    width: 100%;
    height: 100%;
    text-align: center;
    line-height: 66px;
    z-index: 2;
    font-size: 18px;
    font-weight: bold;
    color: #888;
}
select{
      -webkit-appearance: listbox !important;
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
        line-height: 27px;
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

    .sugg_box{
      padding-top: 14px;
      display: block;
      width: 150px;
   }

   .image-editor{
      height:165px;
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
      bottom: 100%;
      position: absolute;
      background: #00a2e8;
      z-index: 10;
      padding: 7px;
      color: #fff;
      font-size: 12px;
      margin-bottom: 15px;
      left: 0;
      width: max-content;
      display: block;
      max-width: 400px;
      height: fit-content;
   }
   .tooltip_rs::after {
      width: 0; 
      height: 0; 
      border-left: 20px solid transparent;
      border-right: 20px solid transparent;
      border-top: 15px solid #00a2e8;
      content:'';
      position: absolute;
      bottom: -15px;
      left: 20%;
   }
   .write_input_word{
      font-size: 16px;
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
   .answer_box_main{
      height:100%;
   }

   @media screen and (min-width: 768px) {
      .Show_hide_opt{
        position:absolute;
        left:0;
        width:100%;
        background-color: white;
        z-index: 1;

      }
      
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
// echo "ggg".$answer;die();
// echo "<pre>"; print_r($question_description);die();
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
                <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default" style="border:none;">                  
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body ss_imag_add_right">

                             <!-- Comprehension start -->
                            <div class="comprehension_body" style="display:flex;">
                             
                                <div class="writing_input_body" style="width:60%;display:flex;"><?=$question_description['image_ques_body'];?>
                                </div>

                                <?php 
                                  $title_count = strlen($question_description['question_title_description']);

                                  if($title_count<=19){
                                    $add_css = 'font-size:28px;';
                                  }else if($title_count<=24 && $title_count>19){
                                    $add_css = 'font-size:36px;';
                                  }else if($title_count<=32 && $title_count>24){
                                    $add_css = 'font-size:26px;';
                                  }else if($title_count<=48 && $title_count>32){
                                    $add_css = 'font-size:17px;';
                                  }else if($title_count<=48 && $title_count>32){
                                    $add_css = 'font-size:17px;';
                                  }else if($title_count>48){
                                    $add_css = 'font-size:12px;line-height: 20px;';
                                  }
                                ?>

                                <p style="font-size:26px;text-align:center;padding-bottom: 10px;font-weight:bold;width:100%;margin-top:auto;margin-left: auto;color:<?=$question_description['title_colors']?>"><?=$question_description['question_title_description'];?></p>
                                
                            </div>

                        </div>
                            
                            <div class="col-sm-5"></div>                  
                            <div class="col-sm-4"></div>
                            
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="col-sm-4">
            <div class="Show_hide_opt">
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
                              <tr <?php if($i!=1){echo "class='hide_row'";}?>>
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
                    <a type="button" style="text-decoration: underline;float:right;" id="view_more">View more</a>
                    <a type="button" style="text-decoration: underline;float:right;" id="view_less">View less</a>
                </div>
              </div>
            </div>









        <div class="row panel-body" style="display: flex;flex-wrap: wrap;clear:both;">    

        <div class="col-md-6" style="border: 1px solid #82bae6;padding: 5px;box-shadow: 0px 0px 4px #82bae6;border-radius: 5px;">

          <div style="word-break: break-word;">
           <?php 
           $get_sentences =  preg_split('/<\/\s*p\s*>/', $question_description['writing_input']);
           // echo "<pre>";print_r($get_sentences);die();
           $com_hint_type = $question_description['com_hint_type'];

            if($com_hint_type=='word'){
              $k=1;
              foreach($get_sentences as $sentence){
                  $al_words .= '<p style="    display: flex;flex-wrap: wrap;">';
                  $words = explode(' ',strip_tags($sentence));
                  if($k==1){
                    $i=0;
                  }
                  foreach($words as $word){
                  $al_words .= '<span class="write_input_word write_input_word'.$i.'" data-id="'.$i.'">'.$word.'&nbsp;</span>';
                  $i++; }
                  $al_words .= '</p><br>';

              $k++; }
                echo $al_words;
            }else if($com_hint_type='sentence'){
                  
              $k=1;
              foreach($get_sentences as $sentence){
                 $al_sentence .= '<p>';
                 $get_sentences_ex = explode('.',strip_tags($sentence));
                 if($k==1){
                    $i=0;
                    $j=0;
                 }
                 $total_sentence = count($get_sentences_ex);
                 $ii = 1;
              foreach($get_sentences_ex as $get_sentence){

                 if($ii<$total_sentence){
                    $al_sentence .= '<span class="write_input_word write_input_word'.$j.'" data-index="'.$j.'">'.$get_sentence.'.</span>';
                    $j++;
                 }
                 
                 $ii++; }
              $al_sentence .= '</p><br>';

              $k++; }

                 echo $al_sentence;
           }
           ?> 
          </div>
        </div>
         <div class="col-md-5">
         

           <div class="answer_box_main" style="border:1px solid gray;padding:5px;margin-left:3%;overflow: hidden;">

            <?php
            
         if($answer=='write'){ ?>
            <div class="without_option">
               <a href="javascript:;" type="button" class="btn btn-primary" style="background-color: #bee131;color:#000" id="extra_bonus">Get Extra Bonus Point !!</a>

            <div class="answer_box">
               <br>
               <p style="font-weight: bold;"><?=$comprehension_info[0]['questionName'];?></p> <br>
               <input type="hidden" id="html" name="answer" value="write_ans">
               <textarea class="form-control question_description" style="height:200px;" name="student_answer"></textarea>
               <br> 
               <div style="text-align:center;">
                 <a href="javascript:;" type="button" class="btn btn-primary ans_submit" style="background-color: #bee131;color:#000;margin:auto;">Submit</a>
               </div>

               <?php if(!empty($question_description['note_description'])){?>
                <a href="javascript:;" type="button" class="btn btn-primary" style="background-color: #ff0000;float:left;" id="help_button">Help</a>

                <a href="javascript:;" type="button" class="btn btn-primary" style="background-color: #fff200;float:left;color:#000;margin-left:5px;" id="skip_button">Skip</a>
               <?php }?>
               
            </div>
            </div>

            <?php }else{ ?>
            <div class="with_option">
             <br>
            <h6 style="font-weight: bold;margin-left:30px;"> <?=$question_info_s[0]['questionName'];?></h6>
            <br>
            <?php
             $i=1;
            foreach($question_description['options'] as $option){ ?>

            
               <div style="width:100%;padding-left:30px;position:relative;">
                  <div style="width:20px;position:absolute;left:0;top:0;">
                     <i class="fa fa-close ans_wrong wrong_ans<?=$i?>" style="font-size:21px;color:red;margin-top:1px;display:none;"></i>
                     <i class="fa fa-check ans_right right_ans<?=$i?>" style="font-size:21px;color:green;margin-top:1px;display:none;"></i>
                  </div>
                  <div style="margin-top: 6px;">
                    <label class="custom_radio"><span class="option_no<?=$i?> all_options"><?=$option?></span>
                        <input type="radio" class="radio_ans" id="html<?=$i?>" name="answer" value="<?=$i?>">
                        <span class="checkmark "></span>
                     </label>
                  </div>
               </div>
            <?php $i++;} ?>

            <br>
            <div style="margin-left: 30px;">

               <input type="hidden" value="<?php echo $question_id;?>" name="question_id" id="question_id">
               <a href="javascript:;" type="button" class="btn btn-primary" style="background-color: #ff0000;float:left;" id="ans_help">Help</a>
               <a href="javascript:;" type="button" class="btn btn-primary" style="background-color: #ed7d31;float:left;" id="ans_try_again">Try Again</a>
               <a href="javascript:;" type="button" class="btn btn-primary ans_submit" style="background-color: #bee131;color:#000">Submit</a>
            </div>
            </div>
            <?php }?>

            </div>
         </div>
         </div>


              <div class="col-sm-4" id="draggable" style="display: none; ">

              
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
                  <button style="margin-left:auto;border: none;background: white;position: absolute;right: 10px;top: 5px;" type="button" id="close_note" class=" pull-right" data-dismiss="modal">x</button>
               </div>
               <hr>
               <div style="max-height: 200px; overflow-y: auto;">
               <?=$question_description['note_description'];?>
               </div>
               
               
            </div> 
      </div>
  </div>
  </div>


<script type="text/javascript">
   $('#ans_help').hide();
   $('#ans_try_again').hide();
   $('.hide_row').hide(); 
   $('#view_less').hide();


  $(document).ready(function(){
    
    $('#view_more').click(function(){
      $('.hide_row').show();
      $('#view_less').show();
      $(this).hide();
    });


    $('#view_less').click(function(){
      $('.hide_row').hide();
      $('#view_more').show();
      $(this).hide();

    });


    $('.ans_submit').click(function () {
      <?php if($answer=='write'){ ?>
        var question_description = $('.question_description').val();
        if(question_description == ''){
          alert("Please Write something !!");
      }else{
        var form = $("#answer_form");

        $.ajax({
            type: 'POST',
            url: 'st_answer_comprehension',
            data: form.serialize(),
            dataType: 'html',
            success: function (results) {

                if (results == 2) { 
                    $('#ss_info_sucesss').modal('show');
                    $('#get_next_question').click(function () {
                        commonCall();
                    });
                }else if (results == 3) {
                    //$('#ss_info_worng').modal('show');
                    $('.ans_wrong').hide();
                    $('.wrong_ans'+ans_no).show();
                    $('#ans_help').show();
                    $('.ans_submit').hide();
                    
                }

            }
        });
      }
    <?php }else { ?>

        var form = $("#answer_form");
        var ans_no =$('input[name="answer"]:checked').val();
        if(ans_no != undefined){

        $.ajax({
            type: 'POST',
            url: 'st_answer_comprehension',
            data: form.serialize(),
            dataType: 'html',
            success: function (results) {

                if (results == 2) {
                    $('.ans_wrong').hide();
                    $('.right_ans'+ans_no).show();
                    $('#ss_info_sucesss').modal('show');
                    $('#get_next_question').click(function () {
                        commonCall();
                    });
                }else if (results == 3) {
                    //$('#ss_info_worng').modal('show');
                    $('.ans_wrong').hide();
                    $('.wrong_ans'+ans_no).show();
                    $('#ans_help').show();
                    $('.ans_submit').hide();
                    
                }

            }
        });

      }else{
          alert('Please select Ans first !!');
      }

    <?php }?>
    });
    $('#skip_button').click(function(){
      $('#skip_success').modal('show');
    });

    $('#help_button').click(function(){
      var text_one_hint = `<?=$question_description['text_one_hint']?>`;
      var text_two_hint = `<?=$question_description['text_two_hint']?>`;

      var text_one_hint_no = `<?=$question_description['text_one_hint_no']?>`;
      var text_two_hint_no = `<?=$question_description['text_two_hint_no']?>`;

      var one_hint_color = '<?=$question_description['text_one_hint_color']?>';
      var two_hint_color = '<?=$question_description['text_two_hint_color']?>';

      var first_hint = "<?=$question_description['first_hint']?>";
      var second_hint = "<?=$question_description['second_hint']?>";

      // console.log(text_two_hint_no);
      
      if(text_one_hint_no !=''){
         var one_hint_words_no = text_one_hint_no.split(",,");
         var hint_one_length = one_hint_words_no.length - 1;

         var wrap_class_one ='';
         for(var k=0;k< hint_one_length;k++){
            var last_no_one = hint_one_length-1;
            var comma_one = ', ';
            if(k==last_no_one){
               var comma_one = '';
            }
            wrap_class_one += '.write_input_word'+one_hint_words_no[k]+comma_one;
            $('.write_input_word'+one_hint_words_no[k]).css('background-color',one_hint_color);
         }
      }

      if(text_two_hint_no !=''){
         var two_hint_words_no = text_two_hint_no.split(",,");
         var hint_two_length = two_hint_words_no.length - 1;

         var wrap_class_two ='';
         for(var m=0;m<hint_two_length;m++){
            var last_no_two = hint_two_length-1;
            var comma_two = ', ';
            if(m==last_no_two){
               var comma_two = '';
            }
            wrap_class_two += '.write_input_word'+two_hint_words_no[m]+comma_two;
            $('.write_input_word'+two_hint_words_no[m]).css('background-color',two_hint_color);
         }
      }

      $(wrap_class_one).wrapAll('<span class="one_hint_wrap"/>');
      $(wrap_class_two).wrapAll('<span class="two_hint_wrap"/>');

      $('.one_hint_wrap').append('<span class="tooltip_one tooltip_rs">'+first_hint+'</span>');
      $('.two_hint_wrap').append('<span class="tooltip_two tooltip_rs">'+second_hint+'</span>');
      $( '.tooltip_rs' ).draggable({
         revert:'invalid' ,
      }); 
      

    });

    $('#ans_help').click(function(){
      var text_one_hint = `<?=$question_description['text_one_hint']?>`;
      var text_two_hint = `<?=$question_description['text_two_hint']?>`;

      var text_one_hint_no = `<?=$question_description['text_one_hint_no']?>`;
      var text_two_hint_no = `<?=$question_description['text_two_hint_no']?>`;

      var one_hint_color = '<?=$question_description['text_one_hint_color']?>';
      var two_hint_color = '<?=$question_description['text_two_hint_color']?>';

      var first_hint = "<?=$question_description['first_hint']?>";
      var second_hint = "<?=$question_description['second_hint']?>";

      // console.log(text_one_hint_no);
      // console.log(text_two_hint_no);
      
      if(text_one_hint_no !=''){
         var one_hint_words_no = text_one_hint_no.split(",,");
         var hint_one_length = one_hint_words_no.length - 1;

         for(var k=0;k< hint_one_length;k++){
            var last_no_one = hint_one_length-1;
            if(k==0){
              $('.write_input_word'+one_hint_words_no[k]).addClass('one_hint_wrap');
            }
            $('.write_input_word'+one_hint_words_no[k]).css('background-color',one_hint_color);
         }
      }

      if(text_two_hint_no !=''){
         var two_hint_words_no = text_two_hint_no.split(",,");
         var hint_two_length = two_hint_words_no.length - 1;
         
         for(var m=0;m<hint_two_length;m++){
            var last_no_two = hint_two_length-1;
            if(m==0){
              $('.write_input_word'+two_hint_words_no[m]).addClass('two_hint_wrap');
            }
            $('.write_input_word'+two_hint_words_no[m]).css('background-color',two_hint_color);
         }
      }

      $('.one_hint_wrap').append('<span class="tooltip_one tooltip_rs">'+first_hint+'</span>');
      $('.two_hint_wrap').append('<span class="tooltip_two tooltip_rs">'+second_hint+'</span>');
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
    });

    $('#get_next_question2').click(function(){
        var ans_patern = "ans_patern";
        var value = 'skip';
        var form = $("#answer_form");

        form.append('<input type="hidden" name="ans_pattern" id="pattern_ans" value="skip">');

        $.ajax({
            type: 'POST',
            url: 'st_answer_comprehension',
            data: form.serialize(),
            dataType: 'html',
            success: function (results) {

                if (results == 2) {
                  commonCall();
                }

            }
        });
    });
    
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

    $('.note_button').click(function(){
       $('#show_note_details').modal('show');
    });

    $('#close_note').click(function(){
      $('#show_note').css({'background-color':'#2c92ba;','color':'#fff'});
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
              alert('hello1111');
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
            h1.textContent = "EXPIREDee";
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