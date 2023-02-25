
<style>
    
    .ssss_class input[type=checkbox] {
        transform: scale(1.4);
        margin-left: 3px;
        position: relative;
        top: 6px;
        left: 5px;
        margin-top: 0;
    }
    .explanation{
        text-align: right;
        position: absolute;
        top: 10px;
        right: 30px;
    }
</style>
<input name="answer" value="0" type="hidden">
<input id="pattern_type_filed" name="pattern_type" value="1" type="hidden">
<input id="hide_component_filed_left" name="hide_component_left" value="0" type="hidden">
<input id="hide_component_filed_right" name="hide_component_right" value="0" type="hidden">
<input id="hide_alphabet_filed" name="hide_alphabet" value="0" type="hidden">
<input id="hide_word_filed" name="hide_word" value="0" type="hidden">
        <div class="kk-memorization-main">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="">
                    <p id="error_msg" style="color:red"></p>
                    <div class="form-group" style="float:left;padding:10px;">
                        <p>&nbsp; </p>
                        <div class="workout_menu" style="margin-bottom: 30px;">
	                          <ul>

	                              <li><a style="cursor:pointer" id="showQuestion" >Question<i>(Click Here)</i></a></li>
	                              
	                          </ul>
	                      </div>
                    </div>
                    <div class="form-group" style="float:left;padding:10px;">
                        <p style="font-weight:700;text-align:center">Pattern </p>
                        <button type="button"  id="pattern_btn_1" class="btn kk_outline-btn active_btn">1</button>
                        <button type="button"  id="pattern_btn_2" class="btn kk_outline-btn">2</button>
                        <button  type="button" id="pattern_btn_3" class="btn kk_outline-btn">3</button>
                        <button  type="button" id="pattern_btn_4" class="btn kk_outline-btn">4</button>
                    </div>
                    <div class="form-group" style="float:left;padding:10px;">
                        <p style="text-align:center">How Many</p>
                        <input class="form-control how_many_all" type="number" value="1" id="box_qty" onclick="getBox(this)">
                        <input class="form-control how_many_witheboard" type="number" value="1" id="box_qty_witheboard" onclick="
                    getBoxwWhiteboard(this)" style="display: none;">
                    </div>
                    <div class="form-group" style="float:left;padding:10px;">
                        <p>&nbsp; </p>
                        <button style="color:black;background: #fff;border: 1px solid #a5a5a5;cursor:default" type="button"  id="hide_component" class="btn btn-secondary  outline-btn">Hide The Component
                        </button>
                    </div>
                    <div class="form-group" style="float:left;padding:10px;">
                        <p>&nbsp; </p>
                        <button  style="color:black;background: #fff;border: 1px solid #a5a5a5;" type="button" id="hide_alphabet" class="btn btn-secondary outline-btn">Hide Alphabet
                        </button>
                    </div>
                    <div class="form-group" style="float:left;padding:10px;">
                        <p>&nbsp; </p>
                        <button   style="color:black;background: #fff;border: 1px solid #a5a5a5;" type="button"  id="hide_word" class="btn btn-secondary outline-btn">Hide Word
                        </button>
                    </div>
                    <div class="form-group" style="float:left;padding:10px;padding-top: 33px;">
                        <button   style="color:black;background: #fff;border: 1px solid #a5a5a5;display: none;" type="button"  id="whiteboard_step" class="btn btn-secondary outline-btn">Whiteboard Step
                        </button>
                    </div>
                    <div class="form-group" style="float:left;padding:10px;padding-top: 33px;">
                        <button   style="color:black;background: #fff;border: 1px solid #a5a5a5;display: none;" type="button"  id="question_step" class="btn btn-secondary outline-btn">Question Step
                        </button>
                    </div>
                    
                </div>
                <div id="question" style="position: absolute;z-index: 2;width: 500px;top: 85px;display:none;">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" aria-expanded="true" aria-controls="collapseOne">
                                        Question
                                        <button type="button" class="woq_close_btn" id="woq_close_btn">&#10006;</button>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <textarea class="mytextarea" name="questionName"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
</div>
<div class="row" id="PATTERN1">
    <div class="kk-main-section">
        <div class="col-sm-4">
             <label class="text_label">Hide This Row</label>
            <input type="checkbox" id="left_checkbox" class="hide_component_left" name="hide_pattern_one_left" >
             <?php for ($i = 1; $i <= 1; $i++): ?>
            <div style="border: 1px solid #777;" class="hidden_input_button list_box_<?php echo $i;?> panel-group" id="<?php echo $i;?>" att-name="l_m_one_hidden_input_value" role="tablist" hide-form="left" aria-multiselectable="true">
                <div style="height: 40px;border-bottom: 1px solid #777;">
                    <span class="remove_component_left l_m_one_hidden_input_value_icon_<?php echo $i;?>" style="display:none;position: relative;width: 40px;font-size: 20px;left: 30px;top: 10px;color: #12d612;"><i class="fa fa-check-circle"></i></span>
                </div>
                <div>
                    <input data-id="<?php echo $i;?>" autocomplete="off" class="leftInput input-bg" name="left_memorize_p_one[]" style="width:100%;padding: 15px; border: none;"/>
                    <input id="<?php echo $i;?>" type="hidden" class="remove_hidden_value_left l_m_one_hidden_input_value_<?php echo $i;?>" name="left_memorize_h_p_one[]" value="0"/>
                </div>
            </div>
            <?php endfor;?>
            <!-- hidden input box-->
             <?php for ($desired_i = $i; $desired_i <= 20; $desired_i++): ?>
            <div class="hidden_input_button list_box_<?php echo $desired_i;?> panel-group editor_hide" id="<?php echo $desired_i;?>" att-name="l_m_one_hidden_input_value" hide-form="left" role="tablist" aria-multiselectable="true" style="display:none;border: 1px solid #777;">
                <div style="height: 40px;border-bottom: 1px solid #777;">
                    <span class="remove_component_left l_m_one_hidden_input_value_icon_<?php echo $desired_i;?>" style="display:none;position: relative;width: 40px;font-size: 20px;left: 30px;top: 10px;color: #12d612;"><i class="fa fa-check-circle"></i></span>
                </div>
                <div>
                    <input data-id="<?php echo $desired_i;?>" autocomplete="off" class="leftInput input-bg"  name="left_memorize_p_one[]" style="width:100%;padding: 15px;border: none;"/>
                    <input id="<?php echo $desired_i;?>" type="hidden" class="remove_hidden_value_left l_m_one_hidden_input_value_<?php echo $desired_i;?>" name="left_memorize_h_p_one[]" value="0"/>
                </div>
            </div>
            <?php endfor;?>

        </div>

        <!-- right box -->
          <div class="col-sm-4 text-right">
              <label class="text_label">Hide This Row</label>
              <input type="checkbox" id="right_checkbox" class="hide_component_right" name="hide_pattern_one_right">
             <?php for ($right_i = 1; $right_i <= 1; $right_i++): ?>
            <div style="border: 1px solid #777;" class="hidden_input_button right_list_box_<?php echo $right_i;?> panel-group" id="<?php echo $right_i;?>" att-name="r_m_one_hidden_input_value" hide-form="right" role="tablist" aria-multiselectable="true">
                <div style="height: 40px;border-bottom: 1px solid #777;">
                    <span class="remove_component_right r_m_one_hidden_input_value_icon_<?php echo $right_i;?>" style="display:none;position: relative;width: 40px;font-size: 20px;right: 335px;top: 10px;color: #12d612;"><i class="fa fa-check-circle"></i></span>
                </div>
                <div>
                    <input rows="2" class="rightInput input-bg" autocomplete="off" name="right_memorize_p_one[]" style="width:100%;padding: 15px; border: none;" data-id="<?php echo $right_i;?>"/>
                    <input id="<?php echo $right_i;?>" type="hidden" class="remove_hidden_value_right r_m_one_hidden_input_value_<?php echo $right_i;?>" name="right_memorize_h_p_one[]" value="0"/>

                </div>
            </div>
            <?php endfor;?>
<!--            //hidden input box-->
             <?php for ($right_desired_i = $right_i; $right_desired_i <= 20; $right_desired_i++): ?>
            <div class="hidden_input_button right_list_box_<?php echo $right_desired_i;?> panel-group editor_hide" id="<?php echo $right_desired_i;?>" att-name="r_m_one_hidden_input_value" hide-form="right" role="tablist" aria-multiselectable="true" style="display:none;border: 1px solid #777;">
                <div style="height: 40px;border-bottom: 1px solid #777;">
                    <span class="remove_component_right r_m_one_hidden_input_value_icon_<?php echo $right_desired_i;?>" style="display:none;position: relative;width: 40px;font-size: 20px;right: 335px;top: 10px;color: #12d612;"><i class="fa fa-check-circle"></i></span>
                </div>
                <div>
                    <input rows="2" class="rightInput input-bg" autocomplete="off" name="right_memorize_p_one[]"  style="width:100%;padding: 15px;border: none;" data-id="<?php echo $right_desired_i;?>"/>
                    <input id="<?php echo $right_desired_i;?>" type="hidden" class="remove_hidden_value_right r_m_one_hidden_input_value_<?php echo $right_desired_i;?>" name="right_memorize_h_p_one[]" value="0"/>
                </div>
            </div>
            <?php endfor;?>

        </div>


    </div>
</div>

<!--//patern 2 -->
<div class="row" id="PATTERN2" style="display:none">
    <div class="kk-main-section">
        <div class="col-sm-4">
             <!-- <label class="text_label">Hide This Row</label> -->
            <input type="checkbox" id="left_checkbox" class="hide_component_left" name="hide_pattern_two_left" style="display: none">
             <?php for ($i = 1; $i <= 1; $i++): ?>
            <div class="hidden_input_button list_box_<?php echo $i;?> panel-group" role="tablist" id="<?php echo $i;?>" att-name="l_m_two_hidden_input_value" hide-form="left" aria-multiselectable="true">
                <div class="box">
                    <span class="remove_component_left l_m_two_hidden_input_value_icon_<?php echo $i;?>" style="display:none;position: relative;width: 40px;font-size: 20px;left: 30px;top: 23px;color: #12d612;"><i class="fa fa-check-circle"></i></span>
                    <textarea class="form-control mytextarea" name="left_memorize_p_two_<?php echo $i?>[]"></textarea>
                    <input id="<?php echo $i;?>" type="hidden" class="remove_hidden_value_left l_m_two_hidden_input_value_<?php echo $i;?>" name="left_memorize_h_p_two_<?php echo $i?>[]" value="0"/>
                </div>
            </div>
            <?php endfor;?>
<!--            //hidden input box-->
             <?php for ($desired_i = $i; $desired_i <= 20; $desired_i++): ?>
            <div class="hidden_input_button list_box_<?php echo $desired_i;?> panel-group editor_hide" id="<?php echo $desired_i;?>" att-name="l_m_two_hidden_input_value" hide-form="left" role="tablist" aria-multiselectable="true" style="display:none">
                <div class="box">
                    <span class="remove_component_left l_m_two_hidden_input_value_icon_<?php echo $desired_i;?>" style="display:none;position: relative;width: 40px;font-size: 20px;left: 30px;top: 23px;color: #12d612;"><i class="fa fa-check-circle"></i></span>
                    <textarea class="form-control mytextarea" name="left_memorize_p_two_<?php echo $desired_i?>[]"></textarea>
                    <input id="<?php echo $desired_i;?>" type="hidden" class="remove_hidden_value_left l_m_two_hidden_input_value_<?php echo $desired_i;?>" name="left_memorize_h_p_two_<?php echo $desired_i?>[]" value="0"/>
                </div>
            </div>
            <?php endfor;?>

        </div>

<!-- right box -->
          <div class="col-sm-4 text-right">
              <!-- <label class="text_label">Hide This Row</label> -->
              <input type="checkbox" id="right_checkbox" class="hide_component_right" name="hide_pattern_two_right"  style="display: none">
             <?php for ($right_i = 1; $right_i <= 1; $right_i++): ?>
            <div class="hidden_input_button right_list_box_<?php echo $right_i;?> panel-group" id="<?php echo $right_i;?>" att-name="r_m_two_hidden_input_value" hide-form="right" role="tablist" aria-multiselectable="true">
                <div class="box">
                    <span class="remove_component_right r_m_two_hidden_input_value_icon_<?php echo $right_i;?>" style="display:none;position: relative;width: 40px;font-size: 20px;right: 345px;top: 23px;color: #12d612;"><i class="fa fa-check-circle"></i></span>
                    <textarea class="form-control mytextarea" name="right_memorize_p_two_<?php echo $right_i?>[]"></textarea>
                    <input id="<?php echo $right_i;?>" type="hidden" class="remove_hidden_value_right r_m_two_hidden_input_value_<?php echo $right_i;?>" name="right_memorize_h_p_two_<?php echo $right_i?>[]" value="0"/>
                </div>
            </div>
            <?php endfor;?>
<!--            //hidden input box-->
             <?php for ($right_desired_i = $right_i; $right_desired_i <= 20; $right_desired_i++): ?>
            <div class="hidden_input_button right_list_box_<?php echo $right_desired_i;?> panel-group editor_hide" id="<?php echo $right_desired_i;?>" att-name="r_m_two_hidden_input_value" hide-form="right" role="tablist" aria-multiselectable="true" style="display:none">
                <div class="box">
                    <span class="remove_component_right r_m_two_hidden_input_value_icon_<?php echo $right_desired_i;?>" style="display:none;position: relative;width: 40px;font-size: 20px;right: 345px;top: 23px;color: #12d612;"><i class="fa fa-check-circle"></i></span>
                    <textarea class="form-control mytextarea" name="right_memorize_p_two_<?php echo $right_desired_i?>[]"></textarea>
                    <input id="<?php echo $right_desired_i;?>" type="hidden" class="remove_hidden_value_right r_m_two_hidden_input_value_<?php echo $right_desired_i;?>" name="right_memorize_h_p_two_<?php echo $right_desired_i?>[]" value="0"/>
                </div>
            </div>
            <?php endfor;?>

        </div>


    </div>
</div>

<!--patern 3-->
<div class="row" id="PATTERN3" style="display:none">
    <div class="kk-main-section">
        <div class="col-sm-8" id="right_whiteboard_step">
             <!-- <label class="text_label">Hide This Row</label>
            <input type="checkbox" id="left_checkbox" class="hide_component_left" name="hide_pattern_three_left"> -->
             <?php for ($i = 1; $i <= 1; $i++): ?>
            <div class="hidden_input_button list_box_Whiteboard_<?php echo $i;?> panel-group" id="<?php echo $i;?>" att-name="l_m_three_hidden_input_value" hide-form="left" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="box">
                        <!-- <input type="file" data-id="<?php echo $i;?>" class="leftInput browseimage" name="left_memorize_p_three[]" style="width:62%;padding: 15px; border: none;"/> -->

                        <textarea class="form-control mytextarea_patern_two" name="whiteboard_memorize_p_three_<?php echo $i?>[]"></textarea>
                    </div>
                    </div>
                </div>
            </div>
            <?php endfor;?>
<!--            //hidden input box-->
             <?php for ($desired_i = $i; $desired_i <= 20; $desired_i++): ?>
            <div class="hidden_input_button list_box_Whiteboard_<?php echo $desired_i;?> panel-group editor_hide" id="<?php echo $desired_i;?>" att-name="l_m_three_hidden_input_value" hide-form="left" role="tablist" aria-multiselectable="true" style="display:none">
                <div class="panel panel-default">
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="box">
                        <!-- <input type="file" data-id="<?php echo $desired_i;?>" class="leftInput browseimage" name="left_memorize_p_three[]" style="width:62%;padding: 15px; border: none;"/> -->

                        <textarea class="form-control mytextarea_patern_two" name="whiteboard_memorize_p_three_<?php echo $desired_i?>[]"></textarea>
                    </div>
                    </div>
                </div>
            </div>
            <?php endfor;?>

        </div>

<!-- right box -->
          <div class="col-sm-6" id="right_question_step" style="display:none">
              <!-- <label class="text_label">Hide This Row</label>
              <input type="checkbox" id="right_checkbox" class="hide_component_right" name="hide_pattern_three_right"> -->
             <?php
             $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
              for ($right_i = 1; $right_i <= 1; $right_i++): ?>
                <div class="hidden_input_button right_list_box_<?php echo $right_i;?> panel-group" id="<?php echo $right_i;?>" att-name="r_m_three_hidden_input_value" hide-form="right" role="tablist" aria-multiselectable="true">

                    <div class="row">
                        <div class="col-md-1 ssss_class" style="display: flex;">
                           <p style="font-size: 21px;"><?php echo $lettry_array[$right_i -1]; ?></p> 
                            <input class="response_answer_class" id="response_answer_id" type="checkbox" name="wrong_answer<?= $right_i; ?>[]" value="1">
                        </div>
                        <div class="col-md-11">
                            <div class="panel panel-default" style="display: block;border: 1px solid #d1d1d1;">
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="box">
                                    <div class="clue_list" style="padding: 2px;display: flex">
                                        <?php for ($f_i = 0; $f_i <= 4; $f_i++): ?>
                                            <a onclick="showClue(<?=($right_i)?>,<?=($f_i+1)?>)" style="padding: 8px;cursor: pointer;">Clue<?=($f_i+1);?></a>


                                    <div id="clue_list_modal_<?= $right_i; ?>_<?=($f_i+1)?>" style="position: absolute;z-index: 2;width: 500px;top: 85px;display:none;">
                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                                        <a role="button" aria-expanded="true" aria-controls="collapseOne">
                                                            Question
                                                            <button type="button" class="woq_close_btn" onclick="close_clue_modal(<?= $right_i; ?>,<?=($f_i+1)?>)">&#10006;</button>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                    <textarea class="mytextarea_patern_two" name="clueQuestionStep_<?= $right_i; ?>_<?=($f_i+1)?>[]"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                        <?php endfor;?>
                                    </div>
                                    <a onclick="showExplanation(<?=($right_i)?>)"  style="cursor: pointer;" class="explanation">Explanation</a>
                                    <textarea class="form-control mytextarea_patern_two" name="question_step_memorize_p_three_<?php echo $right_i?>[]"></textarea>
                                    
                <div id="showExplanation<?= $right_i; ?>" style="position: absolute;z-index: 2;width: 500px;top: 85px;display:none;">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" aria-expanded="true" aria-controls="collapseOne">
                                        Question
                                        <button type="button" class="woq_close_btn" onclick="close_explanation_modal(<?= $right_i; ?>)">&#10006;</button>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <textarea class="mytextarea_patern_two" name="showExplanationStep_<?= $right_i; ?>[]"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endfor;?>
<!--            //hidden input box-->
             <?php for ($right_desired_i = $right_i; $right_desired_i <= 20; $right_desired_i++): ?>
                <div class="hidden_input_button right_list_box_<?php echo $right_desired_i;?> panel-group editor_hide" id="<?php echo $right_desired_i;?>" att-name="r_m_three_hidden_input_value" hide-form="right" role="tablist" aria-multiselectable="true" style="display:none">

                    <div class="row">
                        <div class="col-md-1 ssss_class" style="display: flex;">
                            <p style="font-size: 21px;"><?php echo $lettry_array[$right_desired_i -1]; ?></p>
                            <input class="response_answer_class" id="response_answer_id<?php echo $i; ?>" type="checkbox" name="wrong_answer<?= $right_desired_i; ?>[]" value="1">
                        </div>
                        <div class="col-md-11">
                            <div class="panel panel-default" style="border: 1px solid #d1d1d1;">
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="kk_file input-bg input-bg-right">

                                    <div class="clue_list" style="padding: 2px;display: flex">
                                        <?php for ($f_i = 0; $f_i <= 4; $f_i++): ?>
                                            <a onclick="showClue(<?=($right_desired_i)?>,<?=($f_i+1)?>)" style="padding: 8px;cursor: pointer;">Clue<?=($f_i+1);?></a>


                                    <div id="clue_list_modal_<?= $right_desired_i; ?>_<?=($f_i+1)?>" style="position: absolute;z-index: 2;width: 500px;top: 30px;display:none;">
                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                                        <a role="button" aria-expanded="true" aria-controls="collapseOne">
                                                            Question
                                                            <button type="button" class="woq_close_btn"  onclick="close_clue_modal(<?= $right_desired_i; ?>,<?=($f_i+1)?>)">&#10006;</button>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                    <textarea class="mytextarea_patern_two" name="clueQuestionStep_<?= $right_desired_i; ?>_<?=($f_i+1)?>[]"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <?php endfor;?>
                
                                        <div id="showExplanation<?= $right_desired_i; ?>" style="position: absolute;z-index: 2;width: 500px;top: 30px;display:none;">
                                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingOne">
                                                        <h4 class="panel-title">
                                                            <a role="button" aria-expanded="true" aria-controls="collapseOne">
                                                                Question
                                                                <button type="button" class="woq_close_btn" onclick="close_explanation_modal(<?= $right_desired_i; ?>)">&#10006;</button>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                        <textarea class="mytextarea_patern_two" name="showExplanationStep_<?= $right_desired_i; ?>[]"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    
                                    <a onclick="showExplanation(<?=($right_desired_i)?>)"  style="cursor: pointer;" class="explanation">Explanation</a>
                                    <textarea class="form-control mytextarea_patern_two" name="question_step_memorize_p_three_<?php echo $right_desired_i?>[]"></textarea>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor;?>
   
        </div>
    </div>
</div>

<div class="row" id="PATTERN4" style="display:none">
    <div class="kk-main-section">
        <div class="col-sm-4">
             <label class="text_label">Answer</label>
            <!-- <input type="checkbox" id="left_checkbox" class="hide_component_left" name="hide_pattern_four_left" > -->
             <?php for ($i = 1; $i <= 1; $i++): ?>
            <div style="border: 1px solid #777;" class="hidden_input_button list_box_<?php echo $i;?> panel-group" id="<?php echo $i;?>" att-name="l_m_four_hidden_input_value" role="tablist" hide-form="left" aria-multiselectable="true">
                <div style="height: 40px;border-bottom: 1px solid #777;">
                    <span class="remove_component_left l_m_four_hidden_input_value_icon_<?php echo $i;?>" style="display:none;position: relative;width: 40px;font-size: 20px;left: 30px;top: 10px;color: #12d612;"><i class="fa fa-check-circle"></i></span>
                </div>
                <div>
                    <input data-id="<?php echo $i;?>" autocomplete="off" class="leftInput input-bg" name="left_memorize_p_four[]" style="width:100%;padding: 15px; border: none;"/>
                    <input id="<?php echo $i;?>" type="hidden" class="remove_hidden_value_left l_m_four_hidden_input_value_<?php echo $i;?>" name="left_memorize_h_p_four[]" value="0"/>
                </div>
            </div>
            <?php endfor;?>
            <!--            //hidden input box-->
             <?php for ($desired_i = $i; $desired_i <= 20; $desired_i++): ?>
            <div class="hidden_input_button list_box_<?php echo $desired_i;?> panel-group editor_hide" id="<?php echo $desired_i;?>" att-name="l_m_four_hidden_input_value" hide-form="left" role="tablist" aria-multiselectable="true" style="display:none;border: 1px solid #777;">
                <div style="height: 40px;border-bottom: 1px solid #777;">
                    <span class="remove_component_left l_m_four_hidden_input_value_icon_<?php echo $desired_i;?>" style="display:none;position: relative;width: 40px;font-size: 20px;left: 30px;top: 10px;color: #12d612;"><i class="fa fa-check-circle"></i></span>
                </div>
                <div>
                    <input data-id="<?php echo $desired_i;?>" autocomplete="off" class="leftInput input-bg"  name="left_memorize_p_four[]" style="width:100%;padding: 15px;border: none;"/>
                    <input id="<?php echo $desired_i;?>" type="hidden" class="remove_hidden_value_left l_m_four_hidden_input_value_<?php echo $desired_i;?>" name="left_memorize_h_p_four[]" value="0"/>
                </div>
            </div>
            <?php endfor;?>

        </div>

        <!-- right box -->
        <div class="col-sm-4 text-right">
              <label class="text_label">Answer</label>
              <input type="checkbox" id="right_checkbox" class="hide_component_right" name="hide_pattern_four_right" checked style="display: none">
             <?php for ($right_i = 1; $right_i <= 1; $right_i++): ?>
            <div style="border: 1px solid #777;" class="hidden_input_button right_list_box_<?php echo $right_i;?> panel-group" id="<?php echo $right_i;?>" att-name="r_m_four_hidden_input_value" hide-form="right" role="tablist" aria-multiselectable="true">
                <div style="height: 40px;border-bottom: 1px solid #777;">
                    <span class="remove_component_right r_m_four_hidden_input_value_icon_<?php echo $right_i;?>" style="display:none;position: relative;width: 40px;font-size: 20px;right: 335px;top: 10px;color: #12d612;"><i class="fa fa-check-circle"></i></span>
                </div>
                <div>
                    <input rows="2" class="rightInput input-bg" autocomplete="off" name="right_memorize_p_four[]" style="width:100%;padding: 15px; border: none;" data-id="<?php echo $right_i;?>"/>
                    <input id="<?php echo $right_i;?>" type="hidden" class="remove_hidden_value_right r_m_four_hidden_input_value_<?php echo $right_i;?>" name="right_memorize_h_p_four[]" value="1"/>

                </div>
            </div>
            <?php endfor;?>
            <!--            //hidden input box-->
             <?php for ($right_desired_i = $right_i; $right_desired_i <= 20; $right_desired_i++): ?>
            <div class="hidden_input_button right_list_box_<?php echo $right_desired_i;?> panel-group editor_hide" id="<?php echo $right_desired_i;?>" att-name="r_m_four_hidden_input_value" hide-form="right" role="tablist" aria-multiselectable="true" style="display:none;border: 1px solid #777;">
                <div style="height: 40px;border-bottom: 1px solid #777;">
                    <span class="remove_component_right r_m_four_hidden_input_value_icon_<?php echo $right_desired_i;?>" style="display:none;position: relative;width: 40px;font-size: 20px;right: 335px;top: 10px;color: #12d612;"><i class="fa fa-check-circle"></i></span>
                </div>
                <div>
                    <input rows="2" class="rightInput input-bg" autocomplete="off" name="right_memorize_p_four[]"  style="width:100%;padding: 15px;border: none;" data-id="<?php echo $right_desired_i;?>"/>
                    <input id="<?php echo $right_desired_i;?>" type="hidden" class="remove_hidden_value_right r_m_four_hidden_input_value_<?php echo $right_desired_i;?>" name="right_memorize_h_p_four[]" value="0"/>
                </div>
            </div>
            <?php endfor;?>
        </div>
    </div>
</div>

        <button type="submit" id="submitBtn" style="display:none"></button>
<input type="hidden" name="box_quantity" id="box_quantity" value="">
<input type="hidden" name="box_quantity_whiteboard" id="box_quantity_whiteboard" value="">
<script>
   var qtye = $("#box_qty").val();
    var qtyew = $("#box_qty_witheboard").val();

    document.getElementById("box_quantity").value = qtye;
    document.getElementById("box_quantity_whiteboard").value = qtyew;
    common(qtye)
    commonWhiteboard(qtyew)
    function getBox() {
        var qty = $("#box_qty").val();
        if (qty < 1) {
            $("#box_qty").val(1);
        } else if (qty > 20) {
            $("#box_qty").val(20);
        } else {
            $('.editor_hide').hide();
            document.getElementById("box_quantity").value = qty;
            common(qty);
        }

    }
    function getBoxwWhiteboard() {
        var qtyw = $("#box_qty_witheboard").val();
        if (qtyw < 1) {
            $("#box_qty_witheboard").val(1);
        } else if (qtyw > 20) {
            $("#box_qty_witheboard").val(20);
        } else {
            $('.editor_hide').hide();
            document.getElementById("box_quantity_whiteboard").value = qtyw;
            commonWhiteboard(qtyw);
        }

    }
    function common(quantity)
    {
        for (var i = 1; i <= quantity; i++)
        {
            $('.list_box_' + i).show();
            $('.right_list_box_' + i).show();
            
        }
    }
    function commonWhiteboard(quantity)
    {
        for (var i = 1; i <= quantity; i++)
        {
            $('.list_box_Whiteboard_' + i).show();
            $('.right_list_box_Whiteboard_' + i).show();
            
        }
    }
    
//checkbox checking event for left side
    $(".hide_component_left").change(function() {
        if(this.checked) {
           $('#hide_component').css('background-color','#c3c0c0');
           //  $('.remove_component_left').css('display','block');
            $("#hide_component_filed_left").val(1);
        } else{
            var hide_component_filed_right  = $("#hide_component_filed_right").val();
            if (hide_component_filed_right == 0)
            {
                $('#hide_component').css('background-color','#fff');
            }
            $("#hide_component_filed_left").val(0);
            $(".remove_hidden_value_left").val(0);
            $('.input-bg-left').css('background-color','#fff');
            $('.remove_component_left').css('display','none');
        }
    });
    $(".hide_component_right").change(function() {
        if(this.checked) {
           $('#hide_component').css('background-color','#c3c0c0');
            $("#hide_component_filed_right").val(1);
        } else{
            var hide_component_filed_left  = $("#hide_component_filed_left").val();
            if (hide_component_filed_left == 0)
            {
                $('#hide_component').css('background-color','#fff');
            }
            $("#hide_component_filed_right").val(0);
            $(".remove_hidden_value_right").val(0);
            $('.input-bg-right').css('background-color','#fff');
            $('.remove_component_right').css('display','none');
        }
    });

    function hide_component_right_four(){
       $('#hide_component').css('background-color','#c3c0c0');
        $("#hide_component_filed_right").val(1);
    }


    $(".hidden_input_button ").click(function () {
        var patern = $('#pattern_type_filed').val();
        if (patern == 4) {return;}
       var id = $(this).attr("id");
       var att_name = $(this).attr("att-name");
       var hide_form = $(this).attr("hide-form");
       if (hide_form == 'left')
       {
          var leftCheck =  $("#hide_component_filed_left").val();
       
          if (leftCheck == 1)
          {
             var filedValue =  $("."+att_name+'_'+id).val();
              if (filedValue == 1)
              {
                // alert(filedValue);
                  if (att_name == 'l_m_two_hidden_input_value')
                  {
                      $("."+att_name+'_icon_'+id).fadeOut();
                  }else if(att_name == 'l_m_one_hidden_input_value')
                  {
                      $("."+att_name+'_icon_'+id).fadeOut();
                  }else if(att_name == 'l_m_four_hidden_input_value')
                  {
                      $("."+att_name+'_icon_'+id).fadeOut();
                  }
                  else {
                      $(this).find( ".input-bg" ).css( "background-color", "#fff" );
                  }
                  $("."+att_name+'_'+id).val(0);
              }else {
                  if (att_name == 'l_m_two_hidden_input_value')
                  {
                      $("."+att_name+'_icon_'+id).fadeIn();
                  }else if(att_name == 'l_m_one_hidden_input_value')
                  {
                      $("."+att_name+'_icon_'+id).fadeIn();
                  }else if(att_name == 'l_m_four_hidden_input_value')
                  {
                      $("."+att_name+'_icon_'+id).fadeIn();
                  }else {
                      $(this).find( ".input-bg" ).css( "background-color", "#dddddd" );
                  }
                  $("."+att_name+'_'+id).val(1);
              }
          }
       }else {
           var rightCheck =  $("#hide_component_filed_right").val();
           if (rightCheck == 1)
           {
               var filedValue =  $("."+att_name+'_'+id).val();
               if (filedValue == 1)
               {
                   if (att_name == 'r_m_two_hidden_input_value')
                   {
                       $("."+att_name+'_icon_'+id).fadeOut();
                   }else if(att_name == 'r_m_one_hidden_input_value')
                   {
                       $("."+att_name+'_icon_'+id).fadeOut();
                   }else if(att_name == 'r_m_four_hidden_input_value')
                   {
                       $("."+att_name+'_icon_'+id).fadeOut();
                   }else {
                       $(this).find( ".input-bg" ).css( "background-color", "#fff" );
                   }
                   $("."+att_name+'_'+id).val(0);
               }else {
                   if (att_name == 'r_m_two_hidden_input_value')
                   {
                       $("."+att_name+'_icon_'+id).fadeIn();
                   }else if(att_name == 'r_m_one_hidden_input_value')
                   {
                       $("."+att_name+'_icon_'+id).fadeIn();
                   }else if(att_name == 'r_m_four_hidden_input_value')
                   {
                       $("."+att_name+'_icon_'+id).fadeIn();
                   }else {
                       $(this).find( ".input-bg" ).css( "background-color", "#dddddd" );
                   }
                   $("."+att_name+'_'+id).val(1);
               }
           }
       }
    });

//checkbox checking event for right side
//     $("#right_checkbox").change(function() {
//         if(this.checked) {
//              $(this).prop('checked', true);
//            $('#hide_component').removeClass('outline-btn');
//               $('.rightInput').on('click',function() {
//                 var id = $(this).data('id');
//                 $(this).css('background-color','#dddddd');
//                 $('.hide_com_r'+id).val(1);
//
//               });
//         } else{
//              $(this).prop('checked', false);
//
//             $('#hide_component').addClass('outline-btn');
//              $('.rightInput').on('click',function() {
//                 var id = $(this).data('id');
//                 $(this).css('background-color','transparent');
//                   $('.hide_com_r'+id).val(0);
//               });
//         }
//     });
    ///hide alpabetical
    $("#hide_alphabet").click(function () {
       var hide_alphabet_value = $("#hide_alphabet_filed").val();
       if (hide_alphabet_value == 0)
       {
           $("#hide_alphabet_filed").val(1);
           $("#hide_alphabet").css('background-color','#ddd');
       }else
       {
           $("#hide_alphabet_filed").val(0);
           $("#hide_alphabet").css('background-color','#fff');
       }
    });
///hide word 
    $('#hide_word').click(function () {
        var hide_word_filed = $("#hide_word_filed").val();
        if (hide_word_filed == 1)
        {
            $("#hide_word_filed").val(0);
            $("#hide_word").css('background-color','#fff');
        }else
        {
            $("#hide_word_filed").val(1);
            $("#hide_word").css('background-color','#ddd');
        }
    });
</script>

<!--//patern tab control-->
<script>
$(document).ready(function(){
    $('#pattern_btn_1').on('click',function(){
        $("#pattern_type_filed").val(1);
        $('#PATTERN1').css('display','block');
        $('#PATTERN2').css('display','none');
        $('#PATTERN3').css('display','none');
        $('#PATTERN4').css('display','none');
        $('#pattern_btn_1').addClass('active_btn');
        $('#pattern_btn_2').removeClass('active_btn');
        $('#pattern_btn_3').removeClass('active_btn');
        $('#pattern_btn_4').removeClass('active_btn');
        removeHiddenComponent();
    });
    $('#pattern_btn_2').on('click',function(){
        $("#pattern_type_filed").val(2);
        $('#PATTERN2').css('display','block');
        $('#PATTERN1').css('display','none');
        $('#PATTERN3').css('display','none');
        $('#PATTERN4').css('display','none');
         $('#pattern_btn_2').addClass('active_btn');
        $('#pattern_btn_1').removeClass('active_btn');
        $('#pattern_btn_3').removeClass('active_btn');
        $('#pattern_btn_4').removeClass('active_btn');
        removeHiddenComponent();
    });
    $('#pattern_btn_3').on('click',function(){
        $("#pattern_type_filed").val(3);
        $('#PATTERN3').css('display','block');
        $('#PATTERN2').css('display','none');
        $('#PATTERN1').css('display','none');
        $('#PATTERN4').css('display','none');
         $('#pattern_btn_3').addClass('active_btn');
        $('#pattern_btn_2').removeClass('active_btn');
        $('#pattern_btn_1').removeClass('active_btn');
        $('#pattern_btn_4').removeClass('active_btn');
        removeHiddenComponent();
    });
    $('#pattern_btn_4').on('click',function(){
        $("#pattern_type_filed").val(4);
        $('#PATTERN4').css('display','block');
        $('#PATTERN2').css('display','none');
        $('#PATTERN1').css('display','none');
        $('#PATTERN3').css('display','none');
         $('#pattern_btn_4').addClass('active_btn');
        $('#pattern_btn_2').removeClass('active_btn');
        $('#pattern_btn_1').removeClass('active_btn');
        $('#pattern_btn_3').removeClass('active_btn');
        removeHiddenComponentFour();
        // hide_component_right_four();
    });
    $("#showQuestion").click(function (event) {
        event.preventDefault();
        $("#question").show();
    });
    $("#woq_close_btn").click(function () {
        $("#question").hide();
    });
    // $("#hide_component").click(function () {
    //     $("#hide_component_filed").val(1);
    // });
    // $("#hide_alphabet").click(function () {
    //     $("#hide_alphabet_filed").val(1);
    // });
    // $("#hide_word").click(function () {
    //     $("#hide_word_filed").val(1);
    // });
});
function removeHiddenComponent() {
    
    var patern = $("#pattern_type_filed").val();
    if (patern == 3) {

        $('#whiteboard_step').show();
        $('#question_step').show();
        $('#hide_component').hide();
        $('#hide_alphabet').hide();
        $('#hide_word').hide();


        $('.how_many_all').css('display','none');
        $('.how_many_witheboard').css('display','block');
        
    }else{
        $('#whiteboard_step').hide();
        $('#question_step').hide();
        $('#hide_component').show();
        $('#hide_alphabet').show();
        $('#hide_word').show();


        $('.how_many_all').css('display','block');
        $('.how_many_witheboard').css('display','none');

    }
    
    $("#hide_component_filed_right").val(0);
    $(".remove_hidden_value_right").val(0);
    $('.input-bg-right').css('background-color','#fff');
    $('.remove_component_right').css('display','none');

    $("#hide_component_filed_left").val(0);
    $(".remove_hidden_value_left").val(0);
    $('.input-bg-left').css('background-color','#fff');
    $('.remove_component_left').css('display','none');
}
function removeHiddenComponentFour() {
    var patern = $("#pattern_type_filed").val();
    if (patern == 4) {
        $('#whiteboard_step').hide();
        $('#question_step').hide();
        $('.how_many_all').css('display','block');
        $('.how_many_witheboard').css('display','none');
    }

    $("#hide_component_filed_right").val(1);
    $(".remove_hidden_value_right").val(1);
    $('.input-bg-right').css('background-color','#fff');
    $('.remove_component_right').css('display','block');
    $('.remove_component_right').css('right','0');

    $("#hide_component_filed_left").val(0);
    $(".remove_hidden_value_left").val(0);
    $('.input-bg-left').css('background-color','#fff');
    $('.remove_component_left').css('display','none');
}



$(document).on('click','#whiteboard_step',function(){
    $('#right_question_step').css('display','none');
    $('#right_whiteboard_step').css('display','block');
    $('#whiteboard_step').css('background','#c3c0c0');
    $('#question_step').css('background','#fff');

    $('.how_many_all').css('display','none');
    $('.how_many_witheboard').css('display','block');


    var qtyew = $("#box_qty_witheboard").val();
    document.getElementById("box_quantity_whiteboard").value = qtyew;
    commonWhiteboard(qtyew)
})

$(document).on('click','#question_step',function(){
    $('#right_question_step').css('display','block');
    $('#right_whiteboard_step').css('display','none');
    $('#right_whiteboard_step').css('display','none');

    $('#question_step').css('background','#c3c0c0');
    $('#whiteboard_step').css('background','#fff');


    $('.how_many_all').css('display','block');
    $('.how_many_witheboard').css('display','none');



    var qtye = $("#box_qty").val();
    document.getElementById("box_quantity").value = qtye;
    common(qtye)
})

function showClue(a,b){
    event.preventDefault();
    $("#clue_list_modal_"+a+"_"+b).show();

}


function close_clue_modal(a,b){
    event.preventDefault();
    $("#clue_list_modal_"+a+"_"+b).hide();

}
function showExplanation(a){
    event.preventDefault();
    $("#showExplanation"+a).show();

}
function close_explanation_modal(a){
    event.preventDefault();
    $("#showExplanation"+a).hide();

}
</script>
