
<style type="text/css">
    #login_form .modal-dialog, .ss_modal .modal-dialog {
    /* margin-top: 20%; */
    margin-top: 16%;
    max-width: 554px;
}

.error_correct_ans_show{
    position: absolute;
    top: 11px;
    left: 75px;
    font-weight: bold;
    color: orange;
    font-size: 14px;
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
  .workout_menu img.calculator-trigger{
    margin-top:0;
    margin-bottom:0;
    width: 30px;
    height: 39px;
   }

   img.calculator-trigger{
    margin-top:0;
    margin-bottom:0;
    width: 30px;
    height: 36px;
    }
</style>

<style>
.ui_select { 
    min-height: 30px;
    width: 100%;
    border: 1px #ccc solid;
}
.ui_select li { padding: 5px 10px; z-index: 2; }
.ui_select li:not(.init) { float: left; width: 100%; display: none; background: #fff;
    border: 1px #ccc solid; }
.ui_select li:not(.init):hover, .ui_select li.selected:not(.init) { background:  #46c8ff; }
li.init { cursor: pointer; }

a#submit { z-index: 1; }
.ssss_class input[type=checkbox] {
    transform: scale(1.4);
    margin-left: 3px;
    position: relative;
    top: 6px;
    left: 0px;
    margin-top: 0;
}
.ans_image{
    position: absolute;
    display: none;
    right: 85px;
    top: 2px;

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
.step_p_info{
    display: inline-block;
    padding: 4px 20px;
    background: red;
    border: 2px solid #ccc;
    font-weight: bold;
    color: #fff;
}

.calculator-trigger {
    width: 30px;
    height: 34px;
}
.ss_timer h1 {
border: 1px solid #a8a2a2;
font-size: 17px;
margin: 0;
line-height: 28px;
padding: 3px 0px;
color: #222;
}
</style>
<?php
date_default_timezone_set($this->site_user_data['zone_name']);
$module_time = time();

//    For Question Time
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

$question_time_in_second = ($hour * 3600) + ($minute * 60) + $second ;
//    End For Question Time

?>
<input type="hidden" id="exam_end" value="" name="exam_end" />
<input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
<input type="hidden" id="optionalTime" value="<?php echo $question_time_in_second;?>" name="optionalTime" />
<input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />
<input type="hidden" id="answershow" name="answerClick" value="" />
<input type="hidden" id="correctAnsArray" name="correctAnsArray" value="" />

<input type="hidden"  id="selectFieldvalue" value="1">
<input type="hidden"  id="result_choose_status" value="0">

<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="ss_index_menu">
            <a href="<?php echo base_url().$userType.'/view_course'; ?>">Question/Module</a>
        </div>

        <div class="col-sm-6 ss_next_pre_top_menu">

            <a class="btn btn_next" href="question_edit/<?php echo $question_item?>/<?php echo $question_id?>">
                <i class="fa fa-caret-left" aria-hidden="true"></i> Back
            </a>
            <a class="btn btn_next" href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
            <a class="btn btn_next" id="draw" onClick="test()" data-toggle="modal" data-target=".bs-example-modal-lg">
                Workout <img src="assets/images/icon_draw.png">
            </a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <form id="answer_form">
                <input type="hidden" value="<?php echo $question_id ?>" name="question_id" id="question_id">
                <div class="ss_s_b_main" style="min-height: 100vh">
                    <div class="col-md-8" id="box_one" >
                        <div class="workout_menu" style="padding-left: 15px;padding-right: 15px;">
                            <ul>
                                <li>
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> <span><img src="assets/images/icon_draw.png"> Instruction</span></a>
                                </li>
                                <?php if ($question_time_in_second != 0) { ?>

                                    <li>  <div class="ss_timer" id="demo"><h1>00:00:00 </h1></div> </li>

                                <?php }?>

                                <?php if ($question_info_s[0]['isCalculator']) : ?>
                                    <li> <input type="hidden" name="" id="scientificCalc"></li>
                                <?php endif; ?>
                                <?php if ($question_info->pattern_type != 3){?>
                                    <li><a style="cursor:pointer" id="show_question">Question<i>(Click Here)</i></a></li>
                                <?php } ?>
                                <?php if ($question_info->pattern_type == 3){?>
                                    <?php foreach($question_step_details as $q=>$q_three){?>
                                    <?php foreach($q_three['clue'] as $c=>$q_clue){?>
                                        <?php if ($q_three['order'] == 1): ?>
                                            <li class="clue_step_order_<?= $q_three['order']; ?>"><a style="cursor:pointer" onclick="showStepsClue(<?= $q_three['order']; ?>,<?= $c+1; ?>)">Clue<?= $c+1; ?></a></li>
                                        <?php endif ?>

                                        <?php if ($q_three['order'] != 1): ?>
                                            <li class="clue_step_order_<?= $q_three['order']; ?>" style="display: none;"><a style="cursor:pointer" onclick="showStepsClue(<?= $q_three['order']; ?>,<?= $c+1; ?>)">Clue<?= $c+1; ?></a></li>
                                        <?php endif ?>

                                    <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                        
<?php if ($question_info->pattern_type == 3){?>
    <?php foreach($question_step_details as $q=>$q_three){?>
        <?php foreach($q_three['clue'] as $c=>$q_clue){?>
            <div id="list_box_question_clue_<?= $q_three['order'];?>_<?= ($c+1); ?>" style="position: absolute;z-index: 2;width: 500px;top: 85px;display:none;">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" aria-expanded="true" aria-controls="collapseOne">
                                    Question
                                    <button type="button" class="woq_close_btn" onclick="close_question_clue(<?= $q_three['order'];?>,<?= ($c+1); ?>)">&#10006;</button>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div style="padding: 10px">
                                <?= $q_clue;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
<?php } ?>

                        <?php if ($question_info->pattern_type == 2){?>
                        <div class="row text-right" style="margin: 10px;" >
                            <div class="col-md-8"></div>
                            <div class="col-md-4" style="display:none;">
                                <button disabled style="border:1px solid #ccc;background: #fff;padding: 5px 10px;"  type="button"  id="pattern_two_notepad">Notepad</button>
                                <button  style="border:1px solid #ccc;background: #fff;padding: 5px 10px;"  type="button"  id="pattern_two_clue">Clue</button>
                            </div>

                            <div id="notePad" style="display:none;width: 500px;height:250px;background: #fff;padding: 10px;border:1px solid #ccc;top: 105px;right: 0px;z-index: 3;position: absolute;">
                                <div style="padding: 5px;height: 40px;border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                                    <button type="button" class="woq_close_btn" id="notepad_close_btn">&#10006;</button>
                                </div>
                                <div style="min-height: 178px;width: 100%">
                                    <textarea style="min-height: 170px;width: 100%;padding: 10px;resize: none;"></textarea>
                                </div>
                            </div>
                            <div id="clue" style="display:none;overflow:scroll ;text-align:left;width: 600px;min-height:300px;background: #fff;padding: 10px;border:1px solid #ccc;top: 105px;right: 0px;z-index: 3;position: absolute;">
                                <div style="padding: 5px;height: 40px;border-bottom: 1px solid #ccc;margin-bottom: 10px;">
                                    <button type="button" class="woq_close_btn" id="clue_close_btn">&#10006;</button>
                                </div>
                                <div style="min-height: 178px;width: 100%" id="ClueContent">
                                    <div id="leftClue"></div>
                                    <div id="rightClue"></div>

                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <?php if ($question_info->pattern_type == 3){?>
                            <div class="row" style="margin: 10px 0;border: 1px solid #ccc;padding: 6px;" >
                                <div class="col-md-10" style="padding: 0;">
                                    <div style="display: flex;">
                                        <i style="font-size: 23px;color: red;margin-right: 5px;" class="fa fa-question-circle-o"></i><?= $question_info->questionName; ?> 
                                    </div>
                                    <div class="witheboard_answer" style="margin-top: 20px">
                                        <?php 
                                        $total = count($question_info->whiteboard_memorize_p_three);
                                        foreach ($question_info->whiteboard_memorize_p_three as $key => $value) { ?>
                                            <?php if($key == 0) { ?>
                                                <div id="witheboard_answer_step_<?= ($key+1) ?>"><?= $value[0]; ?></div>
                                            <?php }?>

                                            <?php if($key != 0) { ?>
                                                <div id="witheboard_answer_step_<?= ($key+1) ?>" style="display: none;"><?= $value[0]; ?></div>
                                            <?php }?>

                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <p style="color: #fff;font-weight: bold;background: red;border: 3px solid #ccc;text-align: center;">Step <span id="step_id">1</span></p>
                                </div>
                            </div>
                        <?php }?>
                        <div class="col-sm-10" id="question_box" style="display: none;position: absolute;z-index: 2;">
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
                                            <!-- <textarea disabled class="mytextarea"><?php echo $question_info->questionName;?></textarea>
 -->                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($question_info->pattern_type == 3){?>

                            <input type="hidden"  id="result_choose_order" name="order" value="">
                            <input type="hidden" name="imageBtnId" id="imageBtnId" value="0">
                            <input type="hidden" name="HiddenValue" id="HiddenValue" value="0">
                            <input type="hidden" name="leftAns" id="leftAns" value="0">
                            <input type="hidden" name="rightAns" id="rightAns" value="0">
                            <div id="pattern_three_body">
                                <?php 
                                    $i =1;
                                    $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');

                                ?>
                                <?php foreach($question_step_details as $key=>$question_step_memorize_p_three){?>
                                    <div class="row" style="margin-left: 0">

                                        <div class="col-sm-12 question_step_memorize<?=  $question_step_memorize_p_three['order']; ?>" style="margin: 10px 0;border: 1px solid #ccc;padding: 6px;display: flex;width: 98%;">
                                            <div>
                                                <?= $question_step_memorize_p_three['question_step'];?>
                                            </div>
                                            <div class="stepOrderShow<?=  $question_step_memorize_p_three['order']; ?>" style="display:none;margin-left: 5px;padding-top: 4px;color: red;"><u>Step <?=  $question_step_memorize_p_three['order']; ?></u></div>
                                            <div style="margin-left: auto;">
                                                <div class="ssss_class ssss_class_order_<?=  $question_step_memorize_p_three['order']; ?>" id="response_answer_id_<?= $key+1; ?>" style="display: flex;">
                                                    <p style="font-size: 21px;margin-right: 5px;"><?= $lettry_array[$key] ?></p> 
                                                    <input class="response_answer_class response_answer_class_<?=  $question_step_memorize_p_three['order']; ?>" id="response_answer_id<?= $key+1; ?>" type="checkbox" name="wrong_answer<?= $key+1; ?>[]" serial="<?= $key+1; ?>" value="<?=  $question_step_memorize_p_three['order']; ?>" >
                                                </div>

                                                <div class="ans_image answ_image_order_<?=  $question_step_memorize_p_three['order']; ?>" id="ans_image<?php echo $key+1;?>">
                                                    <button type="button" class="image_click" id="image_click<?php echo $key+1; ?>" value="<?php echo $key+1;?>"><img src="assets/images/images/answer_img.PNG"></button><span >Answer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <span class="left_r_p_box_three_<?=  $question_step_memorize_p_three['order']; ?>" style="display:none;position: absolute;font-weight:bold;top: -39px;right: -12px;color: green;">✓</span><span class="left_w_p_box_three_<?=  $question_step_memorize_p_three['order']; ?>" style="display:none;position: absolute;font-weight:bold;top: -39px;right:-12px;color: red;">✖</span>
                                        </div>
                                    </div>
                                    <?php $i ++;?>
                                <?php };?>
                            </div>
                        <?php };?>
                        <?php if ($question_info->pattern_type == 3){?>

                        <?php };?>
                        <?php if ($question_info->pattern_type == 2){?>
                            <div>
                                <input type="hidden" value="0" id="pattern_two_hidden_ans_left" name="pattern_two_hidden_ans_left">
                                <input type="hidden" value="0" id="pattern_two_hidden_ans_right" name="pattern_two_hidden_ans_right">
                                <input type="hidden" id="pattern_two_cycle" name="pattern_two_cycle" value="1" />
                                <?php $i =1;?>
                                <?php foreach ($question_info_ind->left_memorize_p_two as $key=>$left_memorize_p_two){?>
                                <div class="row" style="margin-bottom: 15px;">

                                    <div class="col-sm-6">
                                        <div>
                                            
                                            <div style="min-height: 90px;height: 100%;" id="left_memorize_p_two_<?=$i;?>" class="form-control left_memorize_p_two_<?=$i;?>"  spellcheck="false">
                                                <?php echo $left_memorize_p_two[0] ?>
                                            </div>
                                            <input type="hidden" name="left_memorize_p_two[]" id="left_memorize_p_two_value_<?=$i;?>" value="<?=$i;?>">
                                            <!--<textarea style="min-height: 90px;" id="left_memorize_p_two_<?=$i;?>" class="form-control left_memorize_p_two_<?=$i;?>" name="left_memorize_p_two[]" spellcheck="false"><?php echo strip_tags($left_memorize_p_two[0])?></textarea><span class="left_r_p_box_two_<?php echo $i; ?>" style="display:none;position: absolute;font-weight:bold;top: 5px;right: -4px;color: green;">✓</span><span class="left_w_p_box_two_<?php echo $i; ?>" style="display:none;position: absolute;font-weight:bold;top: 5px;right:-4px;color: red;">✖</span>-->
                                        </div>
                                    </div>

                                   <div class="col-sm-6">
                                        <div>
                                            
                                            <div style="min-height: 90px;height: 100%;" id="right_memorize_p_two_<?=$i;?>" class="form-control right_memorize_p_two_<?=$i;?> right_memorize_p_two_qus" name="right_memorize_p_two[]" spellcheck="false">
                                              <?php echo $question_info_ind->right_memorize_p_two[$key][0] ?>  
                                            </div> 
                                            <ul id="ui_select" class="ui_select right_memorize_p_two_answer right_answer_sile<?= $i;?>" style="display: none;">
                                                <li class="init" id="init<?= $i;?>" data-value-li="<?= $i;?>">--Select--</li>
                                                <?php $j = 1;?>
                                                <?php foreach ($question_info_ind->left_memorize_p_two as $key1=>$left_memorize_p_two){?>
                                                    <li data-value="<?=$j;?>" id="right_memorize_p_two_<?=$j;?>" class="right_memorize_p_two_<?=$i;?>_<?=$j;?>" >
                                                        <?php echo $question_info_ind->right_memorize_p_two[$key1][0] ?> 
                                                    </li>
                                                <?php $j++; ?>
                                                <?php } ?>
                                            </ul>
                                            <input type="hidden" name="right_memorize_p_two[]" id="right_memorize_p_two_value_<?=$i;?>" value="<?=$i;?>">
                                            <!--<textarea style="min-height: 90px;" id="right_memorize_p_two_<?=$i;?>" class="form-control right_memorize_p_two_<?=$i;?>" name="right_memorize_p_two[]" spellcheck="false"><?php echo strip_tags($question_info_ind->right_memorize_p_two[$key][0])?></textarea>-->
                                            <span class="right_r_p_box_two_<?php echo $i; ?>" style="display:none;position: absolute;font-weight:bold;top: 5px;right: -4px;color: green;">✓</span><span class="right_w_p_box_two_<?php echo $i; ?>" style="display:none;position: absolute;font-weight:bold;top: 5px;right:-4px;color: red;">✖</span>
                                        </div>
                                    </div>
                                </div>
                                    <?php $i++;?>
                                <?php }?>
                            </div>
                        <?php }?>
                        <?php if ($question_info->pattern_type == 1){?>

                        <input name="all_check_hint" id="all_check_hint" type="hidden">
                        <?php if ($question_info->hide_alphabet == 1){?>
                        <div class="col-sm-12" id="box_two" style="display: none;">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php $i = 1;
                                foreach ($question_info_ind->left_memorize_p_one as $row) { ?>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-sm-7" style="text-align: right">
                                            <?php

                                            $split_array = str_split(trim($row), 1);
                                            $split_array_count = count($split_array);
                                            ?>
                                            <?php for ($split = 0;$split<$split_array_count;$split++){?>
                                                <?php if ($split_array[$split] != ''){?>
                                                    <div style="width:32px;display: inline-block;">
                                                        <input style="width: 32px;padding:0px;text-align:center;margin-bottom: 5px;margin-right: 2px;border: 1px solid #a09e9e;font-weight:bold;background: #fff;border-radius:0px;color: black;box-shadow: none;" type="text" value="<?php echo $split_array[$split]?>" name="left_memorize_p_one_alpha[]" id="alpha_<?php echo $i?>_<?=$split+1?>" class="form-control alpha_<?php echo $i?>>" readonly spellcheck="false">
                                                    </div>
                                                <?php }?>
                                            <?php }?>
                                        </div>
                                        <div class="col-sm-5">
                                            <input readonly style="background: #777;border: 1px solid #ccc;font-weight:bold; border-radius:0px;color: #888;" type="text" spellcheck="false" value="" placeholder="" id="alph_ans_<?php echo $i?>" name="left_memorize_p_one_alpha_ans[]" class="form-control wordMatching placeholder-color"><span class="r_p_box_two_<?php echo $i; ?>" style="display:none;position: absolute;font-weight:bold;top: 5px;right: -4px;color: green;">✓</span><span class="w_p_box_two_<?php echo $i; ?>" style="display:none;position: absolute;font-weight:bold;top: 5px;right:-4px;color: red;">✖</span>
                                        </div>
                                    </div>
                                    <?php $i++;
                                } ?>
                            </div>
                        </div>
                        <?php }?>
                        <div class="col-sm-10" id="answer_box">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                <?php $i = 1;
                                foreach ($question_info_ind->left_memorize_p_one as $row) { ?>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-sm-6" >
                                            <input style="border: 1px solid transparent;font-weight:bold;background: #0079bc;border-radius:0px;color: #fff;" id="left_memorize_p_one_<?= $i;?>" type="text" value="<?php echo $row?>" name="left_memorize_p_one[]" class="form-control" readonly>
                                        </div>
                                        <div class="col-sm-6">
                                            <input spellcheck="false" readonly="readonly" placeholder="" style="border: 1px solid #ccc;font-weight:bold;border-radius:0px;color: #888;background: #0079bc" id="correct_answer_<?= $i;?>" type="text" value="" name="word_matching[]" class="form-control wordMatching"><span class="r_p_box_<?php echo $i; ?>" style="display:none;position: absolute;font-weight:bold;top: 5px;right: -4px;color: green;">✓</span><span class="w_p_box_<?php echo $i; ?>" style="display:none;position: absolute;font-weight:bold;top: 5px;right:-4px;color: red;">✖</span>
                                        </div>
                                    </div>
                                    <?php $i++;
                                } ?>
                            </div>
                        </div>
                        <?php }?>




                        <!-- for patten 4 -->

                        <?php if ($question_info->pattern_type == 4){?>

                        <input name="all_check_hint" id="all_check_hint" type="hidden">
                        <?php if ($question_info->hide_alphabet == 1){?>
                        <div class="col-sm-12" id="box_two" style="display: none;">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php $i = 1;
                                foreach ($question_info_ind->left_memorize_p_four as $row) { ?>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-sm-7" style="text-align: right">
                                            <?php

                                            $split_array = str_split(trim($row), 1);
                                            $split_array_count = count($split_array);
                                            ?>
                                            <?php for ($split = 0;$split<$split_array_count;$split++){?>
                                                <?php if ($split_array[$split] != ''){?>
                                                    <div style="width:32px;display: inline-block;">
                                                        <input style="width: 32px;padding:0px;text-align:center;margin-bottom: 5px;margin-right: 2px;border: 1px solid #a09e9e;font-weight:bold;background: #fff;border-radius:0px;color: black;box-shadow: none;" type="text" value="<?php echo $split_array[$split]?>" name="left_memorize_p_four_alpha[]" id="alpha_<?php echo $i?>_<?=$split+1?>" class="form-control alpha_<?php echo $i?>>" readonly spellcheck="false">
                                                    </div>
                                                <?php }?>
                                            <?php }?>
                                        </div>
                                        <div class="col-sm-5">
                                            <input readonly style="background: #777;border: 1px solid #ccc;font-weight:bold; border-radius:0px;color: #888;" type="text" spellcheck="false" value="" placeholder="" id="alph_ans_<?php echo $i?>" name="left_memorize_p_four_alpha_ans[]" class="form-control wordMatching placeholder-color"><span class="r_p_box_two_<?php echo $i; ?>" style="display:none;position: absolute;font-weight:bold;top: 5px;right: -4px;color: green;">✓</span><span class="w_p_box_two_<?php echo $i; ?>" style="display:none;position: absolute;font-weight:bold;top: 5px;right:-4px;color: red;">✖</span>
                                        </div>
                                    </div>
                                    <?php $i++;
                                } ?>
                            </div>
                        </div>
                        <?php }?>
                        <div class="col-sm-10" id="answer_box">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                <?php
                                 $i = 1;
                                 $right_ans_p_four = $question_info_ind->right_memorize_p_four;
                                 shuffle($question_info_ind->left_memorize_p_four);
                                 // shuffle($question_info_ind->right_memorize_p_four);
                                foreach ($qus_array as $key =>$row) { ?>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-sm-6" >
                                            <input style="border: 1px solid transparent;font-weight:bold;background: #0079bc;border-radius:0px;color: #fff;" id="left_memorize_p_four_<?= $i;?>" type="text" value="<?php echo $row['left']?>" name="left_memorize_p_four[]" class="form-control" readonly>
                                            <span class="error_correct_ans_show" id="correct_ans_value_<?= $i;?>"></span>
                                        </div>
                                        <div class="col-sm-6">

                                            <input style="border: 1px solid transparent;font-weight:bold;background: #0079bc;border-radius:0px;color: #fff;" id="right_memorize_p_four_<?= $i;?>" type="text" value="<?php echo $row['right']?>" name="right_memorize_p_four[]" class="form-control right_memorize_p_four" readonly>
                                            <input autocomplete="off" spellcheck="false" readonly="readonly" placeholder="" style="display:none;border: 1px solid #ccc;font-weight:bold;border-radius:0px;color: #888;background: #0079bc" id="correct_answer_<?= $i;?>" type="text" value="" name="word_matching[]" class="form-control wordMatching">
                                            <span class="r_p_box_<?php echo $i; ?>" style="display:none;position: absolute;font-weight:bold;top: 5px;right: -4px;color: green;">✓</span><span class="w_p_box_<?php echo $i; ?>" style="display:none;position: absolute;font-weight:bold;top: 5px;right:-4px;color: red;">✖</span>
                                        </div>
                                    </div>
                                    <?php $i++;
                                } ?>
                            </div>
                        </div>
                        <?php }?>





                        <div class="col-md-2"></div>
                        <div class="col-md-12" style="text-align: center;">
                            <?php if ($question_info->pattern_type == 1){?>
                                            <!--  this button for pattern one of part one-->
                                                    <button type="button" class="btn btn_next" style="margin: 0 201px" id="start_memorization_one">Start Memorization</button>
                                                    <button style="display: none; margin: 0 251px;" type="button" class="btn btn_next" id="start_memorization_one_submit">Submit</button>
                                                    <button style="display: none; margin: 0 250px;" type="button" class="btn btn_next" id="try_again">Try Again</button>
                                                    <input type="hidden" name="start_memorization_one" style="margin: 0 201px" value="0" id="start_memorization_one_value">
                                                    <input type="hidden" name="submit_cycle" value="0" id="submit_cycle">
                                                    <button style="display: none; margin: 0 201px;"  type="button" class="btn btn_next" id="click_ok_btn">Start Memorization</button>
<!--                                                    this button for pattern one of part two-->
                            <?php if ($question_info->hide_alphabet == 1){?>
                            <button style="display: none;margin: 0 201px;" type="button" class="btn btn_next" id="start_memorization_two">Start Memorization</button>
                            <button style="display: none;margin: 0 250px;" type="button" class="btn btn_next" id="start_memorization_two_submit">Submit</button>
                            <button style="display: none;margin: 0 251px;" type="button" class="btn btn_next" id="two_try_again">Try Again</button>
                            <?php }?>
                            <?php }?>

                            <?php if ($question_info->pattern_type == 4){?>
                                <!-- this button for pattern one of part one-->
                                <button type="button" class="btn btn_next" style="margin: 0 201px" id="start_memorization_four">Start Memorization</button>
                                <button style="display: none; margin: 0 251px;" type="button" class="btn btn_next" id="start_memorization_four_submit">Submit</button>
                                <button style="display: none; margin: 0 250px;" type="button" class="btn btn_next" id="try_again">Try Again</button>
                                <input type="hidden" name="start_memorization_four" style="margin: 0 201px" value="0" id="start_memorization_four_value">
                                <input type="hidden" name="submit_cycle" value="0" id="submit_cycle">
                                <button style="display: none; margin: 0 201px;"  type="button" class="btn btn_next" id="click_ok_btn_four">Start Memorization</button>
                                <!--this button for pattern one of part two-->
                                <?php if ($question_info->hide_alphabet == 1){?>
                                <button style="display: none;margin: 0 201px;" type="button" class="btn btn_next" id="start_memorization_two">Start Memorization</button>
                                <button style="display: none;margin: 0 250px;" type="button" class="btn btn_next" id="start_memorization_two_submit">Submit</button>
                                <button style="display: none;margin: 0 251px;" type="button" class="btn btn_next" id="two_try_again">Try Again</button>
                                <?php }?>
                            <?php }?>
                            <?php if ($question_info->pattern_type == 2){?>
                                <button style="margin: 0 201px;" type="button" class="btn btn_next" id="start_memorization_p_two">Start Memorization</button>
                                <button style="margin: 0 250px;display: none;" type="button" class="btn btn_next" id="pattern_two_submit">Submit</button>
                                <button style="margin: 0 251px;display: none;" type="button" class="btn btn_next" id="pattern_two_try">Try Again</button>
                            <?php }?>
                            <?php if ($question_info->pattern_type == 3){?>
                                <button style="margin: 0 201px;display: none;" type="button" class="btn btn_next" id="start_memorization_p_three">Start Memorization</button>
                                <button style="margin: 0 250px;" type="button" class="btn btn_next" id="pattern_three_submit">Submit</button>
                                <button style="margin: 0 251px;display: none;" type="button" class="btn btn_next" id="pattern_three_try">Try Again</button>
                                <button style="margin: 0 251px;display: none;" type="button" class="btn btn_next" id="pattern_three_ok">Ok</button>
                            <?php }?>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  <span>Module Name: Every Sector</span></a>
                                    </h4>
                                </div>
                                <div id="collapsethree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div class=" ss_module_result">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>

                                                        <th>SL</th>
                                                        <th>Mark</th>

                                                        <th>Description</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>

                                                        <td>1</td>
                                                        <td><?php echo $question_info_s[0]['questionMarks']; ?></td>

                                                        <td>
                                                            <a onclick="showDescription()">
                                                                <img src="assets/images/icon_details.png">
                                                            </a>
                                                        </td>
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

<?php if ($question_info->pattern_type == 3){?>
    <?php foreach($question_step_details as $s=>$solution){?>
<!--Solution modal Modal-->
<div class="modal fade ss_modal" id="ss_info_solution<?=$solution['order'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Solution</h4>
            </div>
            <div class="modal-body row">
                <span class="ss_extar_top20"><?php echo $solution['ecplanation']?></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>

    <?php } ?>
<?php } ?>
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
        <div class="modal-content" style="width: 240px;">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body row">
                <img src="assets/images/icon_sucess.png" class="pull-left"> <span class="ss_extar_top20">Your answer is correct</span>
<!--                <div class="question_content" style="width:100%;padding: 10px;margin-top: 20px;">-->
<!--                    <div>-->
<!--                        --><?php //echo $question_info_ind->solution; ?>
<!--                    </div>-->
<!--                </div>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>

<!--Success Modal-->
<div class="modal fade ss_modal" id="ss_info_step" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 240px;">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body row">
                <div style="text-align:center"> <p class="step_p_info">Step <span id="stepNumber"> </span></p></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>

<!--Solution Modal-->
<div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:400px;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Solution</h4>
            </div>
            <div class="modal-body row">
                <i class="fa fa-close" style="font-size:20px;color:red"></i><br>
                <br>
                                    <?php echo $question_info_s[0]['question_solution']?>

<!--                <div class="question_content" style="width:100%;padding: 10px;margin-top: 20px;">-->
<!--                    <div>-->
<!--                        --><?php //echo $question_info_ind->solution; ?>
<!--                    </div>-->
<!--                </div>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>

<!--Success Modal-->
<div class="modal fade ss_modal" id="ss_info_sucesss_new_two" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 240px;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body row">
                <img src="assets/images/icon_sucess.png" class="pull-left"> <span class="ss_extar_top20">Your answer is correct</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue ss_info_sucesss_new_two_close">Ok</button>

            </div>
        </div>
    </div>
</div>

<!--Success Modal-->
<div class="modal fade ss_modal" id="ss_info_sucesss_new_three" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 240px;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body row">
                <img src="assets/images/icon_sucess.png" class="pull-left"> <span class="ss_extar_top20">Your answer is correct</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue ss_info_sucesss_new_three_close">Ok</button>

            </div>
        </div>
    </div>
</div>
<!--Solution Modal-->
<!--Times Up Modal-->
<div class="modal fade ss_modal" id="times_up_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 50%">
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

<script>

    var remaining_time;
    var clear_interval;
    var h1 = document.getElementsByTagName('h1')[0];

    function circulate1() {
         
        remaining_time = remaining_time - 1;

        var v_hours = Math.floor(remaining_time / 3600);
        var remain_seconds = remaining_time - v_hours * 3600;
        var v_minutes = Math.floor(remain_seconds / 60);
        var v_seconds = remain_seconds - v_minutes * 60;

        if (remaining_time > 0) {
            h1.textContent = v_hours + " : "  + v_minutes + " : " + v_seconds + "  " ;
        } else {
            var form = $("#answer_form");
            $.ajax({
                type: 'POST',
                url: 'IDontLikeIt/answer_matching_multiple_choice',
                data: form.serialize(),
                dataType: 'html',
                success: function (results) {
                    if (results == 1) {
                        // $('#ss_info_sucesss').modal('show');
                        $('#times_up_message').modal('show');
                        $('#question_reload').click(function () {
                            location.reload();
                        });
                    }
                    else {
                        $('#times_up_message').modal('show');
                        $('#question_reload').click(function () {
                            location.reload();
                        });
                    }
                }
            });
            h1.textContent = "EXPIRED";
        }
    }

    function takeDecesionForQuestion() {
        
        var exact_time = $('#exact_time').val();

        var now = $('#now').val();
        var opt = $('#optionalTime').val();


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


        var end_depend_optional = parseInt(exact_time) + parseInt(opt);

        if(opt > total) {
            remaining_time = total;
        } else {
            remaining_time = parseInt(end_depend_optional) - parseInt(now);
        }

        clear_interval = setInterval(circulate1,1000);

    }


    <?php if ($question_time_in_second != 0) { ?>
    $( document ).ready(function() {
      
      $("#start_memorization_one").click(function(){
        takeDecesionForQuestion();
      });

      $("#start_memorization_two").click(function(){
        takeDecesionForQuestion();
      });

      $("#start_memorization_p_three").click(function(){
        takeDecesionForQuestion();
      });

      $("#start_memorization_four").click(function(){
        takeDecesionForQuestion();
      });

    });
    
    <?php }?>
</script>
<script>
    //$( document ).ready(function() {
    //    var PercentageObj =<?php //echo json_encode($question_info_ind->percentage_array);?>//;
    //    var PercentageArray = $.makeArray( PercentageObj );
    //});

    var show = true;

    $("#show_question").click(function () {

        if (show) {
            $("#question_box").show();
            show = false;
        }else{
            $("#question_box").hide();
            show = true;
        }
        

    });
    $("#woq_close_btn").click(function () {
        $("#question_box").hide();
    });
    $("#click_box_btn").click(function () {
        $("#box_two").show();
        $("#answer_box").hide();
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
        var ThisExsit = $(this).hasClass( "parcent_bg" );
        if (classExsit == true)
        {
            $(".c_percent_"+parcentId).removeClass( "parcent_bg" );
            $(this).addClass( "parcent_bg");
        }else
        {
            $(this).addClass( "parcent_bg");
        }

    });
    $(".answerClick").click(function () {
        $("#answershow").val(1);
    })

</script>

<script>
    <?php if ($question_info->pattern_type == 1){ ?>
    // part one
    var question_id = $("#question_id").val();
    $('#start_memorization_one').click(function () {
        var question_id = $("#question_id").val();
        //$(".wordMatching").removeAttr("readonly");
        var start_memorization_one_value = $("#start_memorization_one_value").val();
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_one_matching',
            data:{question_id:question_id,start_memorization_one_value:start_memorization_one_value} ,
            dataType: 'json',
            success: function (results) {
                var all_correct = results.all_correct;
                var length =  results.show_data_array.length;
                console.log(results);
                var html = '';
                if (all_correct == 0)
                {
                    for (var i =0; i <length;i++)
                    {
                        var id = i+1;
                        $("#left_memorize_p_one_"+id).val(results.show_data_array[i]);
                        // correct_answer_3
                        if (results.show_data_array[i] == '')
                        {
                            $("#correct_answer_"+id).css('background','#fff');
                            $("#correct_answer_"+id).removeAttr("readonly");
                            $("#correct_answer_"+id).addClass("placeholder-color");
                            $("#correct_answer_"+id).attr("placeholder","Write here");
                            //$("img").attr("width","500");
                        }
                        $('#start_memorization_one').hide();
                        $('#start_memorization_one_submit').show();
                    }
                }else
                {

                    for (var i =0; i <length;i++)
                    {
                        var id = i+1;

                        $("#left_memorize_p_one_"+id).val('');
                        if (results.show_data_array[i][1] == 1)
                        {
                            $(".r_p_box_"+id).css("display", "block");
                            $("#correct_answer_"+id).val(results.show_data_array[i][0]);
                        }else {
                            $("#correct_answer_"+id).css('background','#fff');
                            $("#correct_answer_"+id).removeAttr("readonly");
                            $("#correct_answer_"+id).addClass("placeholder-color");
                            $("#correct_answer_"+id).attr("placeholder","Write here");

                        }
                        $('#start_memorization_one').hide();
                        $('#start_memorization_one_submit').show();
                    }
                    //$("#submit_cycle").val(1);
                }

            }
        });
    });
    $("#start_memorization_one_submit").click(function (event) {
        event.preventDefault();
        var form = $("#answer_form");
        AjaxReturn(form);
    });
    $("#try_again").click(function (event) {
        event.preventDefault();
        var correctAnswer  = $("#correctAnsArray").val();
        var all_check_hint  = $("#all_check_hint").val();
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_one_try',
            data:{question_id:question_id,correctAnswer:correctAnswer,all_check_hint:all_check_hint} ,
            dataType: 'json',
            success: function (results) {
                console.log(results);
                var length =  results.show_data_array.length;
                var show_data_array =  results.show_data_array;
                var show_correct_ans =  results.show_correct_ans;
                var all_check_hint =  results.all_check_hint;
                for (var i =0; i <length;i++)
                {
                    var id = i+1;
                    $(".r_p_box_"+id).css({"display": "none"});
                    $(".w_p_box_"+id).css({"display": "none"});
                    if (all_check_hint == 1)
                    {
                        $("#left_memorize_p_one_"+id).val('');
                        if (show_correct_ans[i] == '') {
                            $("#correct_answer_" + id).removeAttr('readonly');
                            $("#correct_answer_" + id).attr('placeholder', 'Write here');
                            $("#correct_answer_" + id).css({"background": "#fff"});
                        }
                    }else
                    {
                        $("#left_memorize_p_one_"+id).val(show_data_array[i]);
                    }

                    $("#correct_answer_"+id).val(show_correct_ans[i]);
                    if (show_correct_ans[i] != '')
                    {
                        $(".r_p_box_"+id).css("display", "block");
                        console.log(".r_p_box_"+id);
                    }

                    console.log(show_correct_ans[i]);
                    $('#try_again').hide();
                    $('#start_memorization_one_submit').show();
                }

            }
        });
    });
    function AjaxReturn(form) {
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_one_ans_matching',
            data:form.serialize(),
            dataType: 'json',
            success: function (results) {
                console.log(results);
                var status = results.status;
                console.log(results);
                if (status == 1)
                {
                    var all_correct_ans = results.all_correct_ans;
                    var correct_status = results.correct_status;
                    var leftSileData = results.leftSileData;
                    var leftLength = results.leftSileData.length;
                    var length =  results.all_correct_ans.length;

                    for (var i = 0;i < length;i++)
                    {
                        var id = i+1;
                        $(".r_p_box_"+id).css({"display": "none"});
                        $(".w_p_box_"+id).css({"display": "none"});
                        $("#left_memorize_p_one_"+id).val('');
                        if (all_correct_ans[i][1] == 1)
                        {
                            $(".r_p_box_"+id).css({"display": "block"});
                            $("#correct_answer_"+id).attr('readonly','readonly');
                        }else
                        {
                            $(".w_p_box_"+id).css({"display": "block"});
                            $("#correct_answer_"+id).attr('readonly','readonly');
                            $("#correct_answer_"+id).attr('placeholder','');
                            $("#correct_answer_"+id).css({"background": "#777"});
                        }

                        $("#correct_answer_"+id).val(all_correct_ans[i][0]);
                    }
                    if (correct_status == 1)
                    {
                        $('#start_memorization_one_submit').hide();
                        $('#click_ok_btn').show();
                    }else{
                        var word_matching_answer =  results.word_matching_answer;
                        $("#correctAnsArray").val(word_matching_answer);
                        for (var i = 0;i < leftLength;i++) {
                            var LeftId = i+1;
                            if (leftSileData[i][1]  == 0)
                            {
                                $("#left_memorize_p_one_"+LeftId).val(leftSileData[i][0]);
                            }
                        }

                        $("#all_check_hint").val(1);
                        $('#start_memorization_one_submit').hide();
                        $('#try_again').show();
                    }

                }else {
                    var all_correct_status = results.all_correct_status;
                    var length =  results.data_array.length;
                    var data_array =  results.data_array;
                    var word_matching_answer =  results.word_matching_answer;
                    $("#correctAnsArray").val(word_matching_answer);
                    for (var i = 0;i < length;i++)
                    {
                        var id = i+1;
                        var item = word_matching_answer[i];
                        $("#left_memorize_p_one_"+id).val(data_array[i]);
                        $(".r_p_box_"+id).css({"display": "none"});
                        $(".w_p_box_"+id).css({"display": "none"});
                        if ( item == 1)
                        {
                            $(".r_p_box_"+id).css({"display": "block"});
                        }else if(item == 0)
                        {
                            $(".w_p_box_"+id).css({"display": "block"});
                        }
                    }
                    if (all_correct_status == 1)
                    {
                        $('#start_memorization_one_value').val(1);
                        $('#submit_cycle').val(1);
                        $('#start_memorization_one_submit').hide();
                        $('#start_memorization_one').show();
                    }else
                    {
                        $('#start_memorization_one_submit').hide();
                        $('#try_again').show();
                    }
                }
            }
        });
    }
    $("#click_ok_btn").click(function () {
        var  hide_alphabet =<?php echo $question_info->hide_alphabet;?>;
        if (hide_alphabet == 1 )
        {
            $('#click_ok_btn').hide();
            $('#click_ok_btn').hide();
            $('#answer_box').hide();
            $('#box_two').show();
            $('#start_memorization_two').show();
            $('#start_memorization_one_value').val(0);
            //$('#submit_cycle').val(0);
        }else
        {
            alert('answer is correct.');
        }

        return true;
        var question_id = $("#question_id").val();
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_one_ok',
            data:{question_id:question_id} ,
            dataType: 'json',
            success: function (results) {
                var all_correct_ans = results.all_correct_ans;
                var length =  results.all_correct_ans.length;
                for (var i =0; i <length;i++)
                {
                    var id = i+1;
                    $(".r_p_box_"+id).css({"display": "none"});
                    $(".w_p_box_"+id).css({"display": "none"});
                    $("#left_memorize_p_one_"+id).val(results.all_correct_ans[i][0]);
                    $("#correct_answer_"+id).val('');
                    $('#click_ok_btn').hide();
                    $('#start_memorization_one_value').val(0);
                    //$('#submit_cycle').val(0);
                    $('#start_memorization_one').show();
                }
            }
        });
    });


    // part two
    $('#start_memorization_two').click(function () {
        var question_id = $("#question_id").val();
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_two_matching',
            data:{question_id:question_id} ,
            dataType: 'json',
            success: function (results) {
                var length = results.row;
                var col = results.col;
                var first_alph = results.first_alph;
                var row ;
               for (var i = 0;i<length;i++)
               {
                   row = i+1;
                   $("#alph_ans_"+row).css("background","#fff");
                   $("#alph_ans_"+row).removeAttr("readonly");
                   $("#alph_ans_"+row).attr("placeholder" , "Write Here");

                   for (var j = 0;j<col[i];j++)
                   {
                       var col_id = j+1;
                       var class_value = 'alpha_'+row+'_'+col_id;
                       if (col_id == 1)
                       {
                           $("#"+class_value).val(first_alph[i]);
                       }else {

                           $("#"+class_value).val('');
                       }

                   }
               }

               $("#start_memorization_two_submit").show();
               $("#start_memorization_two").hide();
            }
        });
    });


    $("#start_memorization_two_submit").click(function () {
        var form = $("#answer_form");
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_two_ans_matching',
            data:form.serialize(),
            dataType: 'json',
            success: function (results) {
                var length = results.reply_hints.length;
                var reply_hints = results.reply_hints;
                var reply_ans = results.reply_ans;
                var correct = results.correct;
                var submit_cycle = results.submit_cycle;
                var correctAnswer = results.correctAnswer;
                for (var i =0;i<length;i++)
                {
                    var id = i+1;
                    $(".w_p_box_two_"+id).css('display','none');
                    $(".r_p_box_two_"+id).css('display','none');
                    var id_value = 'alph_ans_'+id;
                    $("#"+id_value).val(reply_ans[i][0]);
                    if (reply_ans[i][1] == 0)
                    {
                        $(".w_p_box_two_"+id).css('display','block');
                    }else {
                        $(".r_p_box_two_"+id).css('display','block');
                    }

                    for (var j = 0;j <reply_hints[i][0].length;j++)
                    {
                        var col_id = j+1;
                        var class_value = 'alpha_'+id+'_'+col_id;
                        if (reply_hints[i][1] == 1)
                        {
                            $("#"+class_value).val(reply_hints[i][0][j]);
                        }else
                        {
                            $("#"+class_value).val(' ');
                        }
                    }
                }
                if (correct == 0)
                {
                    $("#correctAnsArray").val(correctAnswer);
                    $("#submit_cycle").val(submit_cycle);
                    $("#start_memorization_two_submit").css('display','none');
                    $("#two_try_again").css('display','block');
                }else {
                    $("#ss_info_sucesss").modal('show');

                }
            }
        });
    });
    $("#two_try_again").click(function () {
        var correctAnswer  = $("#correctAnsArray").val();
        var submit_cycle = $("#submit_cycle").val();
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_two_try',
            data:{question_id:question_id,correctAnswer:correctAnswer,submit_cycle:submit_cycle} ,
            dataType: 'json',
            success: function (results) {
                var show_correct_ans = results.show_correct_ans;
                var next = results.next;
                var length =  show_correct_ans.length;
                for (var i =0;i<length;i++)
                {
                    var id = i+1;
                    $(".w_p_box_two_"+id).css('display','none');
                    $(".r_p_box_two_"+id).css('display','none');
                    var id_value = 'alph_ans_'+id;
                    $("#"+id_value).val(show_correct_ans[i]);
                    if (show_correct_ans[i].length == 0)
                    {
                        //$(".w_p_box_two_"+id).css('display','none');

                    }else {
                        $(".r_p_box_two_"+id).css('display','block');
                    }

                    for (var j = 0;j <next[i][0].length;j++)
                    {
                        var col_id = j+1;
                        var class_value = 'alpha_'+id+'_'+col_id;

                        if (next[i][1] == 0)
                        {
                            $("#"+class_value).val(next[i][0][j]);
                        }else
                        {
                            $("#"+class_value).val(' ');
                        }
                    }
                }
                $("#start_memorization_two_submit").css('display','block');
                $("#two_try_again").css('display','none');
            }
        });
    });
    <?php }?>



    <?php if ($question_info->pattern_type == 4){ ?>
    // part four
    var question_id = $("#question_id").val();
    $('#start_memorization_four').click(function () {
        var question_id = $("#question_id").val();
        //$(".wordMatching").removeAttr("readonly");
        var start_memorization_four_value = $("#start_memorization_four_value").val();
        var start_memorization_four_value = $("#start_memorization_four_value").val();
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_four_matching',
            data:{question_id:question_id,start_memorization_four_value:start_memorization_four_value} ,
            dataType: 'json',
            success: function (results) {
                var all_correct = results.all_correct;
                var length =  results.show_data_array.length;
                console.log(results);
                var html = '';
                if (all_correct == 0)
                {
                    for (var i =0; i <length;i++)
                    {
                        var id = i+1;
                        $("#left_memorize_p_four_"+id).val(results.show_data_array[i]['left']);
                        $("#right_memorize_p_four_"+id).val(results.show_data_array[i]['right']);
                        // correct_answer_3
                        if (results.show_data_array[i] != '')
                        {

                            $("#correct_answer_"+id).css('background','#fff');
                            $("#correct_answer_"+id).css('display','block');
                            $("#right_memorize_p_four_"+id).css('display','none');
                            $("#correct_answer_"+id).removeAttr("readonly");
                            $("#correct_answer_"+id).addClass("placeholder-color");
                            $("#correct_answer_"+id).attr("placeholder","Write here");
                            //$("img").attr("width","500");
                        }
                        $('#start_memorization_four').hide();
                        $('#start_memorization_four_submit').show();
                    }
                }else
                {

                    for (var i =0; i <length;i++)
                    {
                        var id = i+1;

                        $("#left_memorize_p_four_"+id).val('');
                        if (results.show_data_array[i][1] == 1)
                        {
                            $(".r_p_box_"+id).css("display", "block");
                            $("#correct_answer_"+id).val(results.show_data_array[i][0]);
                        }else {
                            $("#correct_answer_"+id).css('background','#fff');
                            $("#correct_answer_"+id).removeAttr("readonly");
                            $("#correct_answer_"+id).addClass("placeholder-color");
                            $("#correct_answer_"+id).attr("placeholder","Write here");

                        }
                        $('#start_memorization_four').hide();
                        $('#start_memorization_four_submit').show();
                    }
                    //$("#submit_cycle").val(1);
                }

            }
        });
    });
    $("#start_memorization_four_submit").click(function (event) {
        event.preventDefault();
        var form = $("#answer_form");
        AjaxReturnFour(form);
    });
    $("#try_again").click(function (event) {
        event.preventDefault();
        var correctAnswer  = $("#correctAnsArray").val();
        var all_check_hint  = $("#all_check_hint").val();
        $('.error_correct_ans_show').html('');
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_four_try',
            data:{question_id:question_id,correctAnswer:correctAnswer,all_check_hint:all_check_hint} ,
            dataType: 'json',
            success: function (results) {
                console.log(results);
                var length =  results.show_data_array.length;
                var show_data_array =  results.show_data_array;
                var show_correct_ans =  results.show_correct_ans;
                var all_check_hint =  results.all_check_hint;
                for (var i =0; i <length;i++)
                {
                    var id = i+1;
                    $(".r_p_box_"+id).css({"display": "none"});
                    $(".w_p_box_"+id).css({"display": "none"});
                    if (all_check_hint == 1)
                    {
                        $("#left_memorize_p_four_"+id).val('');
                        $("#right_memorize_p_four_"+id).val('');
                        if (show_correct_ans[i] == '') {
                            $("#correct_answer_" + id).removeAttr('readonly');
                            $("#correct_answer_" + id).attr('placeholder', 'Write here');
                            $("#correct_answer_" + id).css({"background": "#fff"});
                        }
                    }else
                    {
                        // $("#left_memorize_p_four_"+id).val(show_data_array[i]['left']);
                        $("#left_memorize_p_four_"+id).val(show_data_array[i]['left']);
                        $("#right_memorize_p_four_"+id).val(show_data_array[i]['right']);
                    }



                    if (show_correct_ans[i] != '') {
                        $("#correct_answer_"+id).val(show_data_array[i]['right']);
                    }else{
                        $("#correct_answer_"+id).val('');
                        $("#correct_answer_" + id).removeAttr('readonly');
                        $("#correct_answer_" + id).attr('placeholder', 'Write here');
                        $("#correct_answer_" + id).css({"background": "#fff"});

                    }
                    
                    if (show_correct_ans[i] != '')
                    {
                        $(".r_p_box_"+id).css("display", "block");
                        console.log(".r_p_box_"+id);
                    }

                    console.log(show_correct_ans[i]);
                    $('#try_again').hide();
                    $('#start_memorization_four_submit').show();
                }

            }
        });
    });
    function AjaxReturnFour(form) {
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_four_ans_matching',
            data:form.serialize(),
            dataType: 'json',
            success: function (results) {
                var status = results.status;
                console.log(results);
                if (status == 1)
                {
                    var all_correct_ans = results.all_correct_ans;
                    var correct_status = results.correct_status;
                    var leftSileData = results.leftSileData;
                    var leftLength = results.leftSileData.length;
                    var length =  results.all_correct_ans.length;

                    for (var i = 0;i < length;i++)
                    {
                        var id = i+1;
                        $(".r_p_box_"+id).css({"display": "none"});
                        $(".w_p_box_"+id).css({"display": "none"});
                        $("#left_memorize_p_four_"+id).val('');
                        if (all_correct_ans[i][1] == 1)
                        {
                            $(".r_p_box_"+id).css({"display": "block"});
                            $("#correct_answer_"+id).attr('readonly','readonly');
                        }else
                        {
                            $(".w_p_box_"+id).css({"display": "block"});
                            $("#correct_answer_"+id).attr('readonly','readonly');
                            $("#correct_answer_"+id).attr('placeholder','');
                            $("#correct_answer_"+id).css({"background": "#777"});
                        }

                        $("#correct_answer_"+id).val(all_correct_ans[i][0]);
                    }
                    if (correct_status == 1)
                    {
                        $('#start_memorization_four_submit').hide();
                        $('#click_ok_btn_four').show();
                    }else{
                        var word_matching_answer =  results.word_matching_answer;
                        $("#correctAnsArray").val(word_matching_answer);
                        for (var i = 0;i < leftLength;i++) {
                            var LeftId = i+1;
                            if (leftSileData[i][1]  == 0)
                            {
                                $("#left_memorize_p_four_"+LeftId).val(leftSileData[i][0]);
                            }
                        }

                        $("#all_check_hint").val(1);
                        $('#start_memorization_four_submit').hide();
                        $('#try_again').show();
                    }

                }else {
                    var all_correct_status = results.all_correct_status;
                    var length =  results.data_array.length;
                    var data_array =  results.data_array;
                    var word_matching_answer =  results.word_matching_answer;
                    var correct_answer =  results.correct_answer;
                    $("#correctAnsArray").val(word_matching_answer);
                    for (var i = 0;i < length;i++)
                    {
                        var id = i+1;
                        var item = word_matching_answer[i];
                        var ans_value = '= '+correct_answer[i];
                        // $("#left_memorize_p_four_"+id).val(data_array[i]);

                        $(".r_p_box_"+id).css({"display": "none"});
                        $(".w_p_box_"+id).css({"display": "none"});
                        if ( item == 1)
                        {
                            $(".r_p_box_"+id).css({"display": "block"});
                        }else if(item == 0)
                        {
                            $(".w_p_box_"+id).css({"display": "block"});
                            $("#correct_ans_value_"+id).html(ans_value);
                        }
                    }
                    if (all_correct_status == 1)
                    {
                        $('#ss_info_sucesss').modal('show');
                        $('#start_memorization_four_value').val(1);
                        $('#submit_cycle').val(1);
                        $('#start_memorization_four_submit').hide();
                        $('#start_memorization_four').show();
                        location.reload();
                    }else
                    {
                        $('#start_memorization_four_submit').hide();
                        $('#try_again').show();
                    }
                }
            }
        });
    }
    $("#click_ok_btn").click(function () {
        var  hide_alphabet =<?php echo $question_info->hide_alphabet;?>;
        if (hide_alphabet == 1 )
        {
            $('#click_ok_btn').hide();
            $('#click_ok_btn').hide();
            $('#answer_box').hide();
            $('#box_two').show();
            $('#start_memorization_two').show();
            $('#start_memorization_four_value').val(0);
            //$('#submit_cycle').val(0);
        }else
        {
            alert('answer is correct.');
        }

        return true;
        var question_id = $("#question_id").val();
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_one_ok',
            data:{question_id:question_id} ,
            dataType: 'json',
            success: function (results) {
                var all_correct_ans = results.all_correct_ans;
                var length =  results.all_correct_ans.length;
                for (var i =0; i <length;i++)
                {
                    var id = i+1;
                    $(".r_p_box_"+id).css({"display": "none"});
                    $(".w_p_box_"+id).css({"display": "none"});
                    $("#left_memorize_p_one_"+id).val(results.all_correct_ans[i][0]);
                    $("#correct_answer_"+id).val('');
                    $('#click_ok_btn').hide();
                    $('#start_memorization_four_value').val(0);
                    //$('#submit_cycle').val(0);
                    $('#start_memorization_four').show();
                }
            }
        });
    });


    // part two
    $('#start_memorization_two').click(function () {
        var question_id = $("#question_id").val();
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_two_matching',
            data:{question_id:question_id} ,
            dataType: 'json',
            success: function (results) {
                var length = results.row;
                var col = results.col;
                var first_alph = results.first_alph;
                var row ;
               for (var i = 0;i<length;i++)
               {
                   row = i+1;
                   $("#alph_ans_"+row).css("background","#fff");
                   $("#alph_ans_"+row).removeAttr("readonly");
                   $("#alph_ans_"+row).attr("placeholder" , "Write Here");

                   for (var j = 0;j<col[i];j++)
                   {
                       var col_id = j+1;
                       var class_value = 'alpha_'+row+'_'+col_id;
                       if (col_id == 1)
                       {
                           $("#"+class_value).val(first_alph[i]);
                       }else {

                           $("#"+class_value).val('');
                       }

                   }
               }

               $("#start_memorization_two_submit").show();
               $("#start_memorization_two").hide();
            }
        });
    });


    $("#start_memorization_two_submit").click(function () {
        var form = $("#answer_form");
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_two_ans_matching',
            data:form.serialize(),
            dataType: 'json',
            success: function (results) {
                var length = results.reply_hints.length;
                var reply_hints = results.reply_hints;
                var reply_ans = results.reply_ans;
                var correct = results.correct;
                var submit_cycle = results.submit_cycle;
                var correctAnswer = results.correctAnswer;
                for (var i =0;i<length;i++)
                {
                    var id = i+1;
                    $(".w_p_box_two_"+id).css('display','none');
                    $(".r_p_box_two_"+id).css('display','none');
                    var id_value = 'alph_ans_'+id;
                    $("#"+id_value).val(reply_ans[i][0]);
                    if (reply_ans[i][1] == 0)
                    {
                        $(".w_p_box_two_"+id).css('display','block');
                    }else {
                        $(".r_p_box_two_"+id).css('display','block');
                    }

                    for (var j = 0;j <reply_hints[i][0].length;j++)
                    {
                        var col_id = j+1;
                        var class_value = 'alpha_'+id+'_'+col_id;
                        if (reply_hints[i][1] == 1)
                        {
                            $("#"+class_value).val(reply_hints[i][0][j]);
                        }else
                        {
                            $("#"+class_value).val(' ');
                        }
                    }
                }
                if (correct == 0)
                {
                    $("#correctAnsArray").val(correctAnswer);
                    $("#submit_cycle").val(submit_cycle);
                    $("#start_memorization_two_submit").css('display','none');
                    $("#two_try_again").css('display','block');
                }else {
                    $("#ss_info_sucesss").modal('show');

                }
            }
        });
    });
    
    $("#two_try_again").click(function () {
        var correctAnswer  = $("#correctAnsArray").val();
        var submit_cycle = $("#submit_cycle").val();
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_two_try',
            data:{question_id:question_id,correctAnswer:correctAnswer,submit_cycle:submit_cycle} ,
            dataType: 'json',
            success: function (results) {
                var show_correct_ans = results.show_correct_ans;
                var next = results.next;
                var length =  show_correct_ans.length;
                for (var i =0;i<length;i++)
                {
                    var id = i+1;
                    $(".w_p_box_two_"+id).css('display','none');
                    $(".r_p_box_two_"+id).css('display','none');
                    var id_value = 'alph_ans_'+id;
                    $("#"+id_value).val(show_correct_ans[i]);
                    if (show_correct_ans[i].length == 0)
                    {
                        //$(".w_p_box_two_"+id).css('display','none');

                    }else {
                        $(".r_p_box_two_"+id).css('display','block');
                    }

                    for (var j = 0;j <next[i][0].length;j++)
                    {
                        var col_id = j+1;
                        var class_value = 'alpha_'+id+'_'+col_id;

                        if (next[i][1] == 0)
                        {
                            $("#"+class_value).val(next[i][0][j]);
                        }else
                        {
                            $("#"+class_value).val(' ');
                        }
                    }
                }
                $("#start_memorization_two_submit").css('display','block');
                $("#two_try_again").css('display','none');
            }
        });
    });
    <?php }?>


    // end patten 4

    <?php if ($question_info->pattern_type == 2){?>

    $("#pattern_two_notepad").click(function () {
        $("#notePad").show();
    });
    $("#pattern_two_clue").click(function () {
        $("#clue").show();
    });
    $("#notepad_close_btn").click(function () {
        $("#notePad").hide();
    });
    $("#clue_close_btn").click(function () {
        $("#clue").hide();
    });

    $("#start_memorization_p_two").click(function () {
        var question_id = $("#question_id").val();
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_p_two_start_memorization',
            data:{question_id:question_id} ,
            dataType: 'json',
            success: function (results) {

               var length =  results.right_content.length;
               var right_content =  results.right_content;
               var left_content =  results.left_content;

               for (var i =0;i<length;i++)
               {
                   var id = i+1;
                   var content_id_left = 'left_memorize_p_two_'+id;
                   var content_id_left_value = 'left_memorize_p_two_value_'+id;

                   var content_id_right = 'right_memorize_p_two_'+id;
                   
                   var content_id_right_value = 'right_memorize_p_two_value_'+id;
                   $('#'+content_id_right_value).val('');
                   // $('#'+content_id_left).val(left_content[i]);
                   // $('#'+content_id_right).val(right_content[i]);
                   $('#'+content_id_left).html(left_content[i]['left']);
                   $('#'+content_id_left_value).val(left_content[i]['sl']);
                   // $('#'+content_id_right).html(right_content[i]);
                   //  if (left_content[i] == '')
                   // {
                   //     $("#"+content_id_left).attr("placeholder","Write here");
                   //     $("#"+content_id_left).addClass("placeholder-color");
                   // }
                   // if (right_content[i] == '')
                   // {
                   //     $("#"+content_id_right).attr("placeholder","Write here");
                   //     $("#"+content_id_right).addClass("placeholder-color");
                   // }
               }
                $('#start_memorization_p_two').hide();
                $('#pattern_two_submit').show();
                $('.right_memorize_p_two_answer').show();
                $('.right_memorize_p_two_qus').hide();
                
                MathJax.typeset();
            }
        });
    });

    $("#pattern_two_submit").click(function () {
        var form = $("#answer_form");
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_p_two_ans_matching',
            data:form.serialize(),
            dataType: 'json',
            success: function (results) {
                $("#pattern_two_cycle").val(results.cycle);
                var left_content = results.left_content;
                var right_content = results.right_content;
                var length = 0;
                var correct = 1;
                if (left_content != '')
                {
                    left_content = results.left_content.matchingAnswer;
                    length = left_content.length;
                    var errorIconLeftR = 'left_r_p_box_two_';
                    var errorIconLeftW = 'left_w_p_box_two_';
                    var ContentIdLeft = 'left_memorize_p_two_';
                    if(results.left_content.correct == 0)
                    {
                        correct = results.left_content.correct;
                    }
                    
                    $("#pattern_two_hidden_ans_left").val(left_content);
                    $("#leftClue").html(results.left_content.clue);
                    patternTwoAnswerShow(errorIconLeftR,errorIconLeftW,left_content,ContentIdLeft,length);
                }
                if (right_content != '')
                {
                    right_content = results.right_content.matchingAnswer;
                    length = right_content.length;
                    var errorIconRightR = 'right_r_p_box_two_';
                    var errorIconRightW = 'right_w_p_box_two_';
                    var ContentIdRight = 'right_memorize_p_two_';
                    if(results.right_content.correct == 0)
                    {
                        correct = results.right_content.correct;
                    }
                    
                    $("#pattern_two_hidden_ans_right").val(right_content);
                    $("#rightClue").html(results.right_content.clue);
                    patternTwoAnswerShow(errorIconRightR,errorIconRightW,right_content,ContentIdRight,length);
                }
                if (correct == 0)
                {
                    $("#pattern_two_notepad").css('background','#a5e4f9');
                    $("#pattern_two_clue").css('background','#a5e4f9');
                    $('#pattern_two_clue').prop('disabled', false);
                    $('#pattern_two_notepad').prop('disabled', false);
                    $('#pattern_two_try').css('display','block');
                    $('#pattern_two_submit').css('display','none');
                }else
                {
                    $('#pattern_two_submit').css('display','none');
                    $("#ss_info_sucesss_new_two").modal('show');

                   
                }
            }
        });
    });
    $(document).on('click','.ss_info_sucesss_new_two_close',function(){
        location.reload();
    })
    function patternTwoAnswerShow(right,wrong,content,ContentId,length) {
        for(var i =0;i<length;i++)
        {
            var IncId = i+1;
            var id = ContentId+IncId;
            var ResultClassRight = right+IncId;
            var ResultClassWrong = wrong+IncId;
            $("."+ResultClassRight).css('display','none');
            $("."+ResultClassWrong).css('display','none');
            if (content[i][1] == 1)
            {
                $("#"+id).val(content[i][0]);
                $("."+ResultClassRight).css('display','block');
            }
            if (content[i][1] == 0)
            {
                $("#"+id).val(content[i][0]);
                $("."+ResultClassWrong).css('display','block');
            }
            if (content[i][1] == 2)
            {
                $("#"+id).val(content[i][0]);
            }
        }
    }

    $("#pattern_two_try").click(function () {
        var pattern_two_hidden_ans_left  = $("#pattern_two_hidden_ans_left").val();
        var pattern_two_hidden_ans_right  = $("#pattern_two_hidden_ans_right").val();
        var question_id  = $("#question_id").val();
        $('#pattern_two_clue').prop('disabled', true);
        $("#pattern_two_clue").css('background','#fff');
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_two_try_again',
            data:{question_id:question_id,pattern_two_hidden_ans_left:pattern_two_hidden_ans_left,pattern_two_hidden_ans_right:pattern_two_hidden_ans_right} ,
            dataType: 'json',
            success: function (results) {
                var returnLeft  = results.returnLeft;
                var returnRight = results.returnRight;
                var stdAnsLeft  = results.stdAnsLeft;
                var stdAnsRight = results.stdAnsRight;
                var length = 0;
                if (returnLeft != '')
                {
                    length = returnLeft.length;
                    var errorIconRightR = 'left_r_p_box_two_';
                    var errorIconRightW = 'left_w_p_box_two_';

                    var righterrorIconRightR = 'right_r_p_box_two_';
                    var righterrorIconRightW = 'right_w_p_box_two_';

                    var ContentIdRight = 'left_memorize_p_two_';
                    var right_side_comtent = 'right_memorize_p_two_';
                    for(var left = 0;left<length;left++)
                    {
                        var id = left+1;
                        var InputIdR = errorIconRightR+id;
                        var InputIdW = errorIconRightW+id;
                        var rightInputIdW = righterrorIconRightW+id;
                        var rightInputIdR = righterrorIconRightR+id;
                        var Inputright_side_comtent= right_side_comtent+id;
                        //$("."+InputIdW).css('display','none');
                        // $("."+InputIdR).css('display','none');
                        if (stdAnsRight[left] == 1)
                        {
                            //$("."+InputIdR).css('display','block');
                        }

                        // $("#left_memorize_p_two_"+id).val(returnLeft[left]);

                        $("#left_memorize_p_two_"+id).html(returnLeft[left]['left']);
                        $("."+Inputright_side_comtent).html(returnLeft[left]['right']);

                        $("#left_memorize_p_two_value_"+id).val(returnLeft[left]['sl']);
                        $("#right_memorize_p_two_value_"+id).val(returnLeft[left]['sl']);

                        // $(".right_memorize_p_two_answer ").css('display','none');
                        $result_status = returnLeft[left]['result_status'];
                        if ($result_status == 1) {

                            $("."+Inputright_side_comtent).css('display','block');
                            $("."+rightInputIdR).css('display','block');
                            $("."+rightInputIdW).css('display','none');
                            $(".right_answer_sile"+id).css('display','none');

                        }else{

                            $("."+rightInputIdR).css('display','none');
                            $("."+rightInputIdW).css('display','none');
                            $(".right_answer_sile"+id).css('display','block');

                            $("."+Inputright_side_comtent).css('display','none');
                            $(".right_answer_sile"+id).children('#init'+id).html('--select--');
                            
                            
                            var content_id_right_value = 'right_memorize_p_two_value_'+id;
                            $('#'+content_id_right_value).val('');
                        }



                    }
                }
                // if (returnRight != '')
                // {
                //     length = returnRight.length;
                //     var errorIconRightR = 'right_r_p_box_two_';
                //     var errorIconRightW = 'right_w_p_box_two_';
                //     var ContentIdRight = 'right_memorize_p_two_';

                //     for(var right = 0;right<length;right++)
                //     {
                //         var id = right+1;
                //         var InputIdR = errorIconRightR+id;
                //         var InputIdW = errorIconRightW+id;
                //         $("."+InputIdW).css('display','none');
                //         $("."+InputIdR).css('display','none');
                //         if (stdAnsRight[right] == 1)
                //         {
                //             //$("."+InputIdR).css('display','block');
                //         }
                //         $("#right_memorize_p_two_"+id).val(returnRight[right]);
                //     }
                // }
                $('#pattern_two_try').css('display','none');
                $('#pattern_two_submit').css('display','block');
                
                MathJax.typeset();
            }
        });
    });
    <?php }?>
    <?php if ($question_info->pattern_type == 3){?>
        $("#start_memorization_p_three").click(function () {
            var question_id = $("#question_id").val();
            $.ajax({
                type: 'POST',
                url: 'IDontLikeIt/preview_memorization_p_three_start_memorization',
                data:{question_id:question_id} ,
                dataType: 'json',
                success: function (results) {
                    console.log(results);
                    $('#pattern_three_body').html(results);
                    $('#start_memorization_p_three').hide();
                    $('#pattern_three_submit').show();
                }
            });
        });

    $( "body" ).delegate( ".show_all_images", "click", function(event) {
        event.preventDefault();
        $(".all_images_modal").modal( "show" );
        var imageId = $(this).attr('imageId');
        var ValueId = $(this).attr('valueId');
        $("#imageBtnId").val(imageId);
        $("#HiddenValue").val(ValueId);
    });

    $( "body" ).delegate( ".checkImage", "click", function(event) {
        event.preventDefault();
        var imageBtnId =  $("#imageBtnId").val();
        var HiddenValueClass =  $("#HiddenValue").val();
        var imageSrc = $(this).attr('image');
        var imageValue = $(this).attr('imageValue');

        var activeClass = $(this).hasClass("intro");
        if (activeClass == true){
            $(this).removeClass("intro");
            $(this).css({"border": "none", "padding": "0px"});
            $("#"+imageBtnId).attr('src','');
            $("#"+imageBtnId).css("height","0px");
            $("."+imageBtnId).css({"position": "relative", "opacity": "1"});
            $("."+HiddenValueClass).val('');
        }else {
            $(this).addClass("intro");
            $(this).css({"border": "1px solid #ccc", "padding": "5px"});
            $("#"+imageBtnId).attr('src',imageSrc);
            $("#"+imageBtnId).css("height","150px");
            $("."+HiddenValueClass).val(imageValue);
            //$("#"+imageBtnId).css({"height": "150px", "margin": "auto"});
            $("."+imageBtnId).css({"position": "absolute", "opacity": "0"});
        }
    });


    $("#pattern_three_submit").click(function () {
        var order = $('#result_choose_order').val();
        if (order == "") {alert('Please choose your answer first');return;}
        var form = $("#answer_form");
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_three_ans_matching',
            data:form.serialize(),
            dataType: 'json',
            success: function (results) {
                // var leftResult = results.leftAnsMatching;
                // var rightResult = results.rightAnsMatching;
                // var leftLength = results.leftAnsMatching.length;
                // var rightLength = results.rightAnsMatching.length;

                var correct = results.correct;
                var wrong_order_check = results.wrong_order_check;
                var answer_status = results.answer_status;
                var last_answer_order = results.last_answer_order;
                var active_order = results.active_order;
                var next_step = results.next_step;
                if (next_step == 0) {
                    $("#ss_info_sucesss_new_three").modal('show');
                }

                if (correct == 1)
                {
                    $('#result_choose_order').val('');
                    $(".left_r_p_box_three_"+last_answer_order).css("display","block");
                    $(".answ_image_order_"+last_answer_order).css("display","none");

                    $(".left_w_p_box_three_"+last_answer_order).css("display","none");
                    $('#result_choose_status').val(0);
                    $('.question_step_memorize'+last_answer_order).css("background","#cfeef5");

                    for (var i = 0;i<10;i++)
                    {
                        $(".left_w_p_box_three_"+i).css("display","none");
                    }

                    for (var j = 0;j<10;j++)
                    {
                        $("#witheboard_answer_step_"+j).css("display","none");
                        $(".clue_step_order_"+j).css("display","none");

                    }
                    $("#ss_info_step").modal('show');
                    $("#stepNumber").html(active_order);
                    $(".stepOrderShow"+last_answer_order).show();

                    $('#step_id').html(active_order);
                    $("#witheboard_answer_step_"+active_order).css("display","block");
                    $(".clue_step_order_"+active_order).css("display","block");

                }else{
                    $('#result_choose_order').val('');
                    $(".left_r_p_box_three_"+last_answer_order).css("display","none");
                    $(".left_w_p_box_three_"+last_answer_order).css("display","block");
                    $(".ssss_class_order_"+last_answer_order).show();
                    $(".answ_image_order_"+last_answer_order).hide();

                   $('.response_answer_class_'+last_answer_order).prop('checked',false);
                   $('#result_choose_status').val(0); 

                    $("#ss_info_solution"+active_order).modal('show');


                }

            

            }
        });
    });
    $("#pattern_three_try").click(function () {
        var form = $("#answer_form");
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_three_try_again',
            data:form.serialize(),
            dataType: 'json',
            success: function (results) {
                console.log(results);
                $('#pattern_three_body').html(results);
                //$('#pattern_three_body').html(results);
                //$('#start_memorization_p_three').hide();
                $('#pattern_three_try').hide();
                $('#pattern_three_submit').show();
            }
        });
    });
    $("#pattern_three_ok").click(function () {
        var form = $("#answer_form");
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/preview_memorization_pattern_three_ok',
            data:form.serialize(),
            dataType: 'json',
            success: function (results) {
                console.log(results);
                //$('#pattern_three_body').html(results);
                //$('#pattern_three_body').html(results);
                //$('#start_memorization_p_three').hide();
                //$('#pattern_three_try').hide();
                //$('#pattern_three_submit').show();
            }
        });
    });


    $(document).on('click','.ss_info_sucesss_new_three_close',function(){
        location.reload();
    })
    <?php }?>
    function showDescription(){
        $('#ss_info_description').modal('show');

    }

</script>


<script>
    $(document).ready(function(){
        $(".ui_select").on("click", ".init", function() {
            var value = $(this).attr('data-value-li');
            console.log(value);
            $(this).closest(".ui_select").children('li:not(.init)').toggle();
            $('#selectFieldvalue').val(value);
        });
        var sl_id = $('#selectFieldvalue').val();
        var allOptions = $("#ui_select"+sl_id).children('li:not(.init)');
        $(".ui_select").on("click", "li:not(.init)", function() {

            var sl_id = $('#selectFieldvalue').val();
            // allOptions.removeClass('selected');
            // $(this).addClass('selected');
            $(".ui_select").children('#init'+sl_id).html($(this).html());
            allOptions.toggle();
            var this_val = $(this).attr('data-value');
            for (var j = 1; j<20; j++)
            {
                
                $('#right_memorize_p_two_value_'+sl_id).val(this_val);
                if(this_val == j){
                    $('.right_memorize_p_two_'+sl_id+'_'+j).addClass('selected');
                }
                $('.right_memorize_p_two_'+sl_id+'_'+j).hide();
                $('.right_memorize_p_two_'+sl_id+'_'+j).removeClass('selected');
            }
        });

    })

    // $(".response_answer_class").click(function(){
    $(document).on('change','.response_answer_class',function(){
       if($('.response_answer_class').is(":checked")) {
            var value = $(this).attr('serial');
            var order = $(this).val();

            var resultData = $('#result_choose_status').val();
            if (resultData == 1) {
                $('#response_answer_id'+value).prop('checked',false);
                alert('You aleary choose another option');
                return;
            }
            $('#ans_image'+value).show();
            $('#response_answer_id_'+value).hide();
            $('#result_choose_status').val(1);
            $('#result_choose_order').val(order);
            
        }else{
        }
    });
    $(".image_click").click(function(){
       var value = $(this).val();
       $('#response_answer_id'+value).prop('checked',false);
       $('#ans_image'+value).hide();
       $('#response_answer_id_'+value).show(); 
       $('#result_choose_status').val(0);      
    });


    function showStepsClue(a,b){
        $('#list_box_question_clue_'+a+'_'+b).show();

    }


    function close_question_clue(a,b){
        $('#list_box_question_clue_'+a+'_'+b).hide();

    }
    
</script>
<?php $this->load->view('preview/drawingBoardForWorkoutTwo'); ?>
