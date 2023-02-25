<style>
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
    height: 35px;
    width: 30px;
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
  .hint_selection_content_sentence{
    border:1px solid #c3c3c3;
    margin: 20px 0px;
    padding: 10px;
    word-break: break-word;
  }
  .btn-sm {
    padding: 1px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
    text-align: center;
  }
  .color_border{
    display: flex;
    gap: 3px;
    border: 1px solid #c3c3c3;
    margin-bottom: 5px;
    padding: 2px;
    width: 100px;
  }
  .hint_words{
    margin-right: 4px;
    line-height: 20px;
  }
  .added_hint_write_image{
    height: 22px;
  }
  .check_set_text_one{
    display: none;
  }
  .check_set_text_two{
    display: none;
  }
  #add_note{
    margin-top: 10px;
    padding: 0px 2px 6px 4px;
    position: relative;
    display: inline-block;
    color: black;
    font-weight: bold;
    font-size: 14px;
    border: 1px solid #d2cfcf;
    cursor: pointer;
  }
  .pencil_icon{
    color: red;
    font-size: 12px;
    position: absolute;
    bottom: 5px;
    right: 3px;
    top: inherit;
  }
  .light_image{
    position: relative;
    bottom: -3px;
  }
   
  .word_select{
    cursor:pointer;
  }

  .sentence_select{
    cursor:pointer;
  }
  
</style>

<input type="hidden" value="<?= $question_info[0]['question_name_type']; ?>" name="question_name_type" id="question_name_type" >


<?php 

  $question_description = json_decode($question_info[0]['questionDescription'],true);
  $all_questions = json_decode($question_info[0]['questionName'],true);
  $answers = json_decode($question_info[0]['answer']);
  // echo "<pre>";print_r($question_description);die();
?>
<div class="row" id="first_section"> 
  <div class="col-sm-2">
    <input type="hidden" id="text_one_hint" name="text_one_hint" value="<?php if(!empty($question_description['text_one_hint'])){echo $question_description['text_one_hint'];}?>">
    <input type="hidden" id="text_two_hint" name="text_two_hint" value="<?php if(!empty($question_description['text_two_hint'])){echo $question_description['text_two_hint'];}?>">
    <input type="hidden" id="option_hint_set" name="option_hint_set" value="<?php if(!empty($question_description['option_hint_set'])){echo $question_description['option_hint_set'];}?>">
    <input type="hidden" id="text_one_hint_no" name="text_one_hint_no" value="<?php if(!empty($question_description['text_one_hint_no'])){echo $question_description['text_one_hint_no'];}?>">
    <input type="hidden" id="text_two_hint_no" name="text_two_hint_no" value="<?php if(!empty($question_description['text_two_hint_no'])){echo $question_description['text_two_hint_no'];}?>">
    <input type="hidden" id="text_one_hint_color" name="text_one_hint_color" value="<?php if(!empty($question_description['text_one_hint_color'])){echo $question_description['text_one_hint_color'];}?>">
    <input type="hidden" id="text_two_hint_color" name="text_two_hint_color" value="<?php if(!empty($question_description['text_two_hint_color'])){echo $question_description['text_two_hint_color'];}?>">
    <input type="hidden" id="com_hint_type" name="com_hint_type" value="<?php if(!empty($question_description['com_hint_type'])){echo $question_description['com_hint_type'];}?>">
  </div>

  <div class="col-sm-10">
    <div class="idea_setting_mid">

      <div class="form-group" style="float: left;margin-right: 10px;">
        <div>
          <button type="button" class="btn btn-select" id="title_button" <?php if(!empty($question_description['question_title_description'])){echo 'style="background-color: rgb(0, 162, 232);"';}?>>Title</button>
        </div>
      </div>

      <div class="form-group" style="float: left;margin-right: 10px;">
        <div>
          <button type="button" class="btn btn-select writing_input" <?php if(!empty($question_description['writing_input'])){echo 'style="background-color: rgb(0, 162, 232);"';}?>>Writing Input</button>
        </div>
      </div>

      <div class="form-group" style="float: left;margin-right: 10px;">
        <div>
          <button type="button" class="btn btn-select image_upload" <?php if(!empty($question_description['image_ques_body'])){echo 'style="background-color: rgb(0, 162, 232);"';}?>>Image Upload</button>
        </div>
      </div>

      <div class="form-group" style="float: left;margin-right: 10px;">
        <div>
          How Many Row <input type="number" name="total_rows" id="total_options" class="form-control w-50" value="<?php if(!empty($question_description['total_rows'])){echo $question_description['total_rows'];}?>">
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col-sm-5"></div>
      <div class="col-sm-6">
        <br><br>
        <div class="comprehension_questions">

          <?php 
              if(!empty($question_description['total_rows'])){
                $total_rows = $question_description['total_rows'];
                
                for($i=1;$i<=$total_rows;$i++){
                  
                  if($i==1){
          ?>
            <div class="option_with_no1" id="com_question" style="margin-left: 57px;cursor:pointer;"><img class="comprehension_image" src="assets/images/images/question_write.png"></div>
            <div class="com_options" style="display:flex;">
                <div class="">
                    <label class="customcheckbox">
                        <input type="checkbox" class="option_no" name="option_check[]" value="<?=$i?>" <?php if($answers==$i){echo "checked";}?>>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <?php

                  if($i==$question_description['option_hint_set']){ ?>
                    <img data-id="<?=$i?>" class="com_hint_image" src="assets/images/images/hint_box_write.png">
                  <?php }else{ ?>
                    <img data-id="<?=$i?>" class="com_hint_image" src="assets/images/images/hint_box.png">
                  <?php }
                ?>
                
                <img class="com_option_image modify_option1" data-id="<?=$i?>" src="assets/images/images/question_write.png">
            </div>
          <?php }else{?>

            <div class="com_options" style="display:flex;">
                <div class="">
                    <label class="customcheckbox">
                        <input type="checkbox" class="option_no" name="option_check[]" value="<?=$i?>" <?php if($answers==$i){echo "checked";}?>>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <?php
                  if($i==$question_description['option_hint_set']){ ?>
                    <img data-id="<?=$i?>" class="com_hint_image" src="assets/images/images/hint_box_write.png">
                  <?php }else{ ?>
                    <img data-id="<?=$i?>" class="com_hint_image" src="assets/images/images/hint_box.png">
                  <?php }
                ?>
                <img class="com_option_image modify_option1" data-id="<?=$i?>" src="assets/images/images/question_write.png">
            </div>
           
          <?php } } } ?>

            



        </div>

        <div class="option_list" style="display: none;">

        </div>

      </div>
    </div>


  </div>
</div>

<div class="row" id="second_section" style="display: none;">
  <div class="col-sm-2"></div>
  <div class="hint_ans_box col-sm-8">
        <div style="text-decoration:underline;color:black;display:flex;gap:10px;margin-left:25%;">
          <a class="sentence_select" <?php if($question_description['com_hint_type']=='sentence'){echo 'data-color="'.$question_description['text_one_hint_color'].'"';}?> style="color:<?php if($question_description['com_hint_type']=='sentence'){echo $question_description['text_one_hint_color'];}?>">Sentence</a>
          <a class="word_select" <?php if($question_description['com_hint_type']=='word'){echo 'data-color="'.$question_description['text_one_hint_color'].'"';}?> style="color:<?php if($question_description['com_hint_type']=='word'){echo $question_description['text_one_hint_color'];}?>">Word</a>
        </div>
    <div class="set_color_section">
       <div class="set_color_show">
          
            <div class="added_hint_color added_hint_color_with_no1">
            <?php if(!empty($question_description['text_one_hint_no'])){?>
            <div class="color_border">
              <div class="hint_color_list color_selected_one"> 
                  <div class="hint_chosen_color">
                    <input type="radio" data-color="<?=$question_description['text_one_hint_color']?>" class="hint_color_input hint_color_input_one" name="title_colors" value="<?=$question_description['text_one_hint_color']?>">
                    <div class="hint_bc_color_one hint_color_set" style="background-color:<?=$question_description['text_one_hint_color']?>">
                  </div>
                  </div>
              </div>
              <div class="check_set_text_one" style="display: flex;">
                  <img class="added_hint_write_image added_hint_color_image_1" data-id="1" src="assets/images/images/question_write.png">
                  <a class="clear_hint_one" type="button" style="text-decoration: underline;margin-left:3px;cursor: pointer;">clear</a>
              </div>
            </div>
            <?php }?>
            </div>


          
            <div class="added_hint_color added_hint_color_with_no2">
            <?php if(!empty($question_description['text_two_hint_no'])){ ?>
            <div class="color_border">
              <div class="hint_color_list color_selected_two">
                  <div class="hint_chosen_color" >
                    <input type="radio" data-color="<?=$question_description['text_two_hint_color']?>" class="hint_color_input hint_color_input_two" name="title_colors" value="<?=$question_description['text_two_hint_color']?>">
                    <div class="hint_bc_color_two hint_color_set" style="background-color:<?=$question_description['text_two_hint_color']?>">
                  </div>
                  </div>
              </div>
              <div class="check_set_text_two" style="display: flex;">
                  <img class="added_hint_write_image added_hint_color_image_1" data-id="2" src="assets/images/images/question_write.png">
                  <a class="clear_hint_two" type="button" style="text-decoration: underline;margin-left:3px;cursor: pointer;">clear</a>
              </div>
            </div>
            <?php }?>
            </div>
         

       </div>
       <div class="set_color_list">
          <div class="hint_color_box">
            <div class="hint_color_list">
              <div class="hint_color_choose">
                <input type="radio" class="hint_color_input" name="title_color" value="#ffff00;">
                <div class="hint_color_set" style="background-color: #ffff00;"></div>
              </div>
              <div class="hint_color_choose">
                <input type="radio" class="hint_color_input" name="title_color" value="#0f0;">
                <div class="hint_color_set" style="background-color: #0f0;"></div>
              </div>
              <div class="hint_color_choose">
                <input type="radio" class="hint_color_input" name="title_color" value="#0ff;">
                <div class="hint_color_set" style="background-color: #0ff;"></div>
              </div>
              <div class="hint_color_choose">
                <input type="radio" class="hint_color_input" name="title_color" value="#f0f;">
                <div class="hint_color_set" style="background-color: #f0f;"></div>
              </div>
              <div class="hint_color_choose">
                <input type="radio" class="hint_color_input" name="title_color" value="#00f;">
                <div class="hint_color_set" style="background-color: #00f;"></div>
              </div>
            </div>
            <div class="hint_color_list">
              <div class="hint_color_choose">
                <input type="radio" class="hint_color_input" name="title_color" value="#f00;">
                <div class="hint_color_set" style="background-color: #f00;"></div>
              </div>
              <div class="hint_color_choose">
                <input type="radio" class="hint_color_input" name="title_color" value="#ffc90e;">
                <div class="hint_color_set" style="background-color: #ffc90e;"></div>
              </div>
              <div class="hint_color_choose">
                <input type="radio" class="hint_color_input" name="title_color" value="#c8bfe7;">
                <div class="hint_color_set" style="background-color: #c8bfe7;"></div>
              </div>
              <div class="hint_color_choose">
                <input type="radio" class="hint_color_input" name="title_color" value="#b5e61d;">
                <div class="hint_color_set" style="background-color: #b5e61d;"></div>
              </div>
              <div class="hint_color_choose">
                <input type="radio" class="hint_color_input" name="title_color" value="#22b14c;">
                <div class="hint_color_set" style="background-color: #22b14c;"></div>
              </div>
            </div>
          </div>
          <div style="text-align: center;">
            <a type="button" class="set_color_with_text btn btn-default btn-sm">Set</a>
          </div>
       </div>
       <div>
         <a type="button"><img class="add_hint_question" src="assets/images/images/hint_box_write.png"></a>
         <a id="add_note">Hint<img style="height:20px;width:20px;" class="light_image" src="assets/images/images/light.png"></a>
       </div>
   </div>

   <div class="hint_selection_content" style="<?php if($question_description['com_hint_type']=='sentence'){echo "display:none";}?>">

   </div>


   <div class="hint_selection_content_sentence" style="<?php if(empty($question_description['com_hint_type']) || $question_description['com_hint_type']=='word'){echo "display:none";}?>">

   </div>

  </div>
</div> 



<!-- ============================ All Modal Start ========================== -->

<div class="modal fade ss_modal ew_ss_modal" id="question_title_description" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
      </div>
      <div class="modal-body">
        <div class="color_list">
          <div class="color_choose" <?php if($question_description['title_colors']=='#ffff00;'){echo 'style="border: 1px solid red;"';}?>>
            <input type="radio" class="color_input" name="title_colors" value="#ffff00;" <?php if($question_description['title_colors']=='#ffff00;'){echo "checked";}?>>
            <div class="color_set" style="background-color: #ffff00;"></div>
          </div>
          <div class="color_choose" <?php if($question_description['title_colors']=='#0f0;'){echo 'style="border: 1px solid red;"';}?>>
            <input type="radio" class="color_input" name="title_colors" value="#0f0;" <?php if($question_description['title_colors']=='#0f0;'){echo "checked";}?>>
            <div class="color_set" style="background-color: #0f0;"></div>
          </div>
          <div class="color_choose" <?php if($question_description['title_colors']=='#0ff;'){echo 'style="border: 1px solid red;"';}?>>
            <input type="radio" class="color_input" name="title_colors" value="#0ff;" <?php if($question_description['title_colors']=='#0ff;'){echo "checked";}?>>
            <div class="color_set" style="background-color: #0ff;"></div>
          </div>
          <div class="color_choose" <?php if($question_description['title_colors']=='#f0f;'){echo 'style="border: 1px solid red;"';}?>>
            <input type="radio" class="color_input" name="title_colors" value="#f0f;" <?php if($question_description['title_colors']=='#f0f;'){echo "checked";}?>>
            <div class="color_set" style="background-color: #f0f;"></div>
          </div>
          <div class="color_choose" <?php if($question_description['title_colors']=='#00f;'){echo 'style="border: 1px solid red;"';}?>>
            <input type="radio" class="color_input" name="title_colors" value="#00f;" <?php if($question_description['title_colors']=='#00f;'){echo "checked";}?>>
            <div class="color_set" style="background-color: #00f;"></div>
          </div>

        </div>
        <div class="color_list">
          <div class="color_choose" <?php if($question_description['title_colors']=='#f00;'){echo 'style="border: 1px solid red;"';}?>>
            <input type="radio" class="color_input" name="title_colors" value="#f00;" <?php if($question_description['title_colors']=='#f00;'){echo "checked";}?>>
            <div class="color_set" style="background-color: #f00;"></div>
          </div>
          <div class="color_choose" <?php if($question_description['title_colors']=='#ffc90e;'){echo 'style="border: 1px solid red;"';}?>>
            <input type="radio" class="color_input" name="title_colors" value="#ffc90e;" <?php if($question_description['title_colors']=='#ffc90e;'){echo "checked";}?>>
            <div class="color_set" style="background-color: #ffc90e;"></div>
          </div>
          <div class="color_choose" <?php if($question_description['title_colors']=='#c8bfe7;'){echo 'style="border: 1px solid red;"';}?>>
            <input type="radio" class="color_input" name="title_colors" value="#c8bfe7;" <?php if($question_description['title_colors']=='#c8bfe7;'){echo "checked";}?>>
            <div class="color_set" style="background-color: #c8bfe7;"></div>
          </div>
          <div class="color_choose" <?php if($question_description['title_colors']=='#b5e61d;'){echo 'style="border: 1px solid red;"';}?>>
            <input type="radio" class="color_input" name="title_colors" value="#b5e61d;" <?php if($question_description['title_colors']=='#b5e61d;'){echo "checked";}?>>
            <div class="color_set" style="background-color: #b5e61d;"></div>
          </div>
          <div class="color_choose" <?php if($question_description['title_colors']=='#22b14c;'){echo 'style="border: 1px solid red;"';}?>>
            <input type="radio" class="color_input" name="title_colors" value="#22b14c;" <?php if($question_description['title_colors']=='#22b14c;'){echo "checked";}?>>
            <div class="color_set" style="background-color: #22b14c;"></div>
          </div>
        </div>
        <br>
        <textarea class="form-control question_description" name="question_title_description"><?php  if(!empty($question_description['question_title_description'])){ echo $question_description['question_title_description'];}?></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue saveTitle">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade ss_modal ew_ss_modal" id="writing_input_description" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        <div class="rs_word_limt">
          <div class="top_word_limt">
            <!-- <span id="word_show"><b id="total_idea_word">90</b> Words</span> -->
            <span style="margin:0 auto;" class="m-auto"></span>
          </div>
          <div class="btm_word_limt">
            <div class="content_box_word">
              <textarea id="writing_input" class="form-control writing_input mytextarea" name="writing_input"><?php  if(!empty($question_description['writing_input'])){ echo $question_description['writing_input'];}?></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue writing_input_save">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade ss_modal " id="image_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="top:-120px !important;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div style="background-color: #eee;" class="modal-body">
        <div style="display: flex;">
          <h6 style="margin:auto;padding-left:120px;">Image </h6>

          <button style="color:black;border:none;margin-left: auto;order: 2;" type="button" class="close_ch close_short_question_modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>

        </div>
        <div class="row">
          <textarea id="image_ques_body" class="form-control mytextarea" name="image_ques_body"><?php  if(!empty($question_description['image_ques_body'])){ echo $question_description['image_ques_body'];}?></textarea>
          <br>
          <div style="position: relative;">
            <div style="position:relative;width:50px;margin:auto;">
              <input type="file" name="image" id="Upload_image" style="opacity: 0;position:absolute;width:100%;">
              <span style="text-align:center;color:black;">Upload</span>
            </div>
            <button id="comprehension_image_save" type="button" style="position:absolute;right:10px;top:-5px;border: none;padding: 8px 15px;border-radius: 5px;background: white;">Save</button>
          </div>
          <input type="hidden" class="check_image" value="2">
          <input type="hidden" class="idea_image_name" value="no_image.png">
        </div>
      </div>

    </div>
  </div>
</div>


<div class="modal fade ss_modal ew_ss_modal" id="com_question_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
      </div>
      <div class="modal-body">

        <br>
        <textarea class="form-control question_description" name="com_question"><?=$question_info[0]['questionName']?></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue saveComQuestion">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal ew_ss_modal" id="options_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Option Description </h4>
      </div>
      <div class="modal-body" id="option_inputs">
        <?php 
             $options = $question_description['options'];
              if(!empty($question_description['total_rows'])){
                $total_rows = $question_description['total_rows'];
                for($i=1;$i<=$total_rows;$i++){
                  $j= $i-1;
        ?>
        <br><textarea class="form-control option_all option_description<?=$i?>"  name="options[]"><?=$options[$j]?></textarea>
        <?php }}?>

      </div>
      <div class="modal-footer option_footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Save</button>
        <?php 
              if(!empty($question_description['total_rows'])){
                $total_rows = $question_description['total_rows'];
                for($i=1;$i<=$total_rows;$i++){
        ?>
        <button type="button" data-id="<?=$i?>" class="btn btn_blue optionSaveButton saveComOption' + j + '">Save</button>
        <?php }}?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal ew_ss_modal" id="options_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Option hint </h4>
      </div>
      <div class="modal-body" id="option_inputs">


      </div>
      <div class="modal-footer option_footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal ew_ss_modal" id="first_hint_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
      </div>
      <div class="modal-body">

        <br>
        <textarea class="form-control question_description" name="first_hint"><?php if(!empty($question_description['first_hint'])){echo $question_description['first_hint'];}?></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue firstHintModalButton">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal ew_ss_modal" id="second_hint_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
      </div>
      <div class="modal-body">

        <br>
        <textarea class="form-control question_description" name="second_hint"><?php if(!empty($question_description['second_hint'])){echo $question_description['second_hint'];}?></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue secondtHintModalButton">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal ew_ss_modal" id="add_note_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
      </div>
      <div class="modal-body">
        <textarea class="form-control hint_text_one_textarea" name="note_description"><?=$question_description['note_description']?></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue secondtHintModalButton noteModalButton">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- ============================ All Modal End ========================== -->


<script>
    $(document).ready(function(){
        $('#title_button').click(function() {
        $('#question_title_description').modal('show');

        });

        $('.color_choose').click(function() {
        $('.color_choose').css('border', 'none');
        $(this).css('border', '1px solid red');
        $('input[type=radio]', this).attr("checked", true);
        });

        $('.writing_input').click(function() {
        $('#writing_input_description').modal('show');

        });

        $('.image_upload').click(function() {
        $('#image_details').modal('show');

        });

        $("#Upload_image").change(function() {

        var property = document.getElementById('Upload_image').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();

        if (jQuery.inArray(image_extension, ['gif', 'jpg', 'jpeg', 'png', '']) == -1) {
            alert("Invalid image file");
        }

        var form_data = new FormData();
        form_data.append("file", property);

        $.ajax({
            url: "comprehension_image_upload",
            method: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
            $('#msg').html('Loading......');
            },
            success: function(data) {

            var img = '<img  class="image-editor" data-height="250" data-width="200" height="179" src="<?= base_url() ?>/assets/comprehension/' + data + '" width="281" />';

            $('#image_ques_body').val(img);


            }
        });
        });

        $('#comprehension_image_save').click(function() {
        $('#image_details').modal('hide');
        $('.image_upload').css('background-color', '#00a2e8;');
        });

        $('.writing_input_save').click(function() {
        $('#writing_input_description').modal('hide');
        $('.writing_input').css('background-color', '#00a2e8;');
        });

        $('.saveTitle').click(function() {
        $('#question_title_description').modal('hide');
        $('#title_button').css('background-color', '#00a2e8;');
        });

        $('#total_options').change(function() {
        var total_number = $(this).val();

        // var index = $('.com_hint_image').length;
        // index = index + 1;
        var question_with_option = '';
        var option_input ='';
        var option_save = '';

        for(var j=1;j<=total_number;j++){
            if(j==1){
            question_with_option += '<div class="option_with_no'+j+'" id="com_question" style="margin-left: 57px;cursor:pointer;"><img class="comprehension_image" src="assets/images/images/question.png"></div><br><div class="com_options" style="display:flex;"><div class=""><label class="customcheckbox"><input type="checkbox" class="option_no" name="option_check[]" value="'+j+'"><span class="checkmark"></span></label></div><img class="com_hint_image" src="assets/images/images/hint_box.png"><img class="com_option_image modify_option' +j+ '" data-id="' +j+ '" src="assets/images/images/question.png"></div>';
            }else{
            question_with_option += '<br><div class="com_options option_with_no'+j+'" style="display:flex;"><div class=""><label class="customcheckbox"><input type="checkbox" class="option_no" name="option_check[]" value="'+j+'"><span class="checkmark"></span></label></div><img data-id="'+j+'" class="com_hint_image option_hint'+j+ '" src="assets/images/images/hint_box.png"><img class="com_option_image modify_option' +j+ '" data-id="' +j+ '" src="assets/images/images/question.png"></div>';
            }

            option_input += '<br><textarea class="form-control option_all option_description' + j + '"  name="options[]"></textarea>';
            option_save += '<button type="button" data-id="' + j + '" class="btn btn_blue optionSaveButton saveComOption' + j + '">Save</button>';
        }

            $('.comprehension_questions').html(question_with_option);
            $('#option_inputs').html(option_input);
            $('.option_footer').html(option_save);
        

        });


        $(document).on('click', '#com_question', function() {
        $('#com_question_modal').modal('show');
        });

        $('.saveComQuestion').click(function() {
        $('#com_question_modal').modal('hide');
        $('.comprehension_image').attr('src', 'assets/images/images/question_write.png');
        });


        $(document).on('click', '.com_option_image', function() {
        var index = $(this).attr('data-id');
        $('.option_all').hide(); 
        $('.optionSaveButton').hide();
        $('.option_description' + index).show();
        $('.saveComOption' + index).show();
        $('#options_modal').modal('show');
        });

        $(document).on('click', '.optionSaveButton', function() {
        var index_no = $(this).attr('data-id');
        $('#options_modal').modal('hide');
        $('.modify_option' + index_no).attr('src', 'assets/images/images/question_write.png');
        });

        $(document).on('click', '.com_hint_image', function() {
          var index_no = $(this).attr('data-id');
          // alert(index_no);
          $('#second_section').show();
          $('#first_section').hide();

          var wrrite_input = $('#writing_input').val();
          $.ajax({
            url: "html_text_to_array",
            method: 'POST',
            data:{wrrite_input:wrrite_input},
            dataType: 'html',
            success: function(data) {
              
              var data = JSON.parse(data);
              
              var sentences = data.sentence;
              var words = data.words;
              $('.hint_selection_content').html(words);
              $('.hint_selection_content_sentence').html(sentences);
              
              $('#option_hint_set').val(index_no);

              $('.com_hint_image').attr('src', 'assets/images/images/hint_box.png');
              $(this).attr('src', 'assets/images/images/hint_box_write.png');

              var text_one_hint_no = '<?=$question_description['text_one_hint_no']?>';
              var text_two_hint_no = '<?=$question_description['text_two_hint_no']?>';

              var one_hint_no = text_one_hint_no.split(",,");
              var two_hint_no = text_two_hint_no.split(",,");

              var text_one_hint_color = '<?=$question_description['text_one_hint_color']?>';
              var text_two_hint_color = '<?=$question_description['text_two_hint_color']?>';
              
              // console.log(one_hint_no);
              // console.log(two_hint_no);
              var one_hint_length = one_hint_no.length-1;
              var two_hint_length = two_hint_no.length-1;

              var com_hint_type = '<?=$question_description['com_hint_type']?>';

              if(com_hint_type == 'word'){
                for(var i=0;i<one_hint_length;i++){
                  $('.word_no'+one_hint_no[i]).attr('style','background-color:'+text_one_hint_color);
                  $('.word_no'+one_hint_no[i]).attr('data-id',1);
                }

                for(var k=0;k<two_hint_length;k++){
                  $('.word_no'+two_hint_no[k]).attr('style','background-color:'+text_two_hint_color);
                  $('.word_no'+two_hint_no[k]).attr('data-id',2);
                }
              }if(com_hint_type == 'sentence'){
                for(var i=0;i<one_hint_length;i++){
                  $('.sentence_no'+one_hint_no[i]).attr('style','background-color:'+text_one_hint_color);
                  $('.sentence_no'+one_hint_no[i]).attr('data-id',1);
                }

                for(var k=0;k<two_hint_length;k++){
                  $('.sentence_no'+two_hint_no[k]).attr('style','background-color:'+text_two_hint_color);
                  $('.sentence_no'+two_hint_no[k]).attr('data-id',2);
                }
              }

            }
          });
          
        });

        $(document).on('click', '.hint_words', function() {
          var check_set = $(this).attr('data-id');
          var chk_word = $('.word_select').attr('data-color');
          if(check_set != undefined){
              $(this).removeAttr('data-id');
              $(this).removeAttr('style');
          }else{
              var text = $(this).text();
              var get_color_by_button = $('.word_select').attr('data-color');
              if(get_color_by_button != ''){
                if($('.hint_color_input_one').is(':checked')){
                    var get_color = $('.hint_color_input_one').attr('data-color');
                    $(this).css('background-color',get_color);
                    $(this).attr('data-id',1);
                }else if($('.hint_color_input_two').is(':checked')){
                    var get_color = $('.hint_color_input_two').attr('data-color');
                    $(this).css('background-color',get_color);
                    $(this).attr('data-id',2);
                }else{
                    alert('Please Select a color first');
                }
              }
          }
          
        });


        $(document).on('click', '.hint_color_choose', function() {
          var get_color = $('input[type=radio]', this).val();
          var check_length = $('.added_hint_color').length;

          html = '<div class="color_border"><div class="hint_color_list color_selected_one"><div class="hint_chosen_color"><input type="radio" data-color="'+get_color+'" class="hint_color_input hint_color_input_one" name="title_color" value="'+get_color+'"><div class="hint_bc_color_one hint_color_set" style="background-color:'+get_color+'"></div></div></div><div class="check_set_text_one"><img class="added_hint_write_image added_hint_color_image_1" data-id="1" src="assets/images/images/question_write.png"><a class="clear_hint_one" type="button" style="text-decoration: underline;margin-left:3px;cursor: pointer;">clear</a></div></div></div>';

          html2 = '<div class="color_border"><div class="hint_color_list color_selected_two"><div class="hint_chosen_color"><input type="radio" data-color="'+get_color+'" class="hint_color_input hint_color_input_two" name="title_color" value="'+get_color+'"><div class="hint_bc_color_two hint_color_set" style="background-color:'+get_color+'"></div></div></div><div class="check_set_text_two"><img class="added_hint_write_image added_hint_color_image_2" data-id="2" src="assets/images/images/question_write.png"><a type="button" class="clear_hint_two" style="text-decoration: underline;margin-left:3px;cursor: pointer;">clear</a></div></div></div>';

          
          var first_color  = $('.color_selected_one').length;
          var second_color  = $('.color_selected_two').length;

          if(first_color == '0'){
            $('.added_hint_color_with_no1').html(html);
          }else if(second_color == '0'){ 
            $('.added_hint_color_with_no2').append(html2);
          }else if(first_color != '0' && $('.hint_color_input_one').is(':checked')){
            if($('.hint_color_input_one').is(':checked')){
              $('.hint_color_input_one').removeAttr('data-color');
              $('.hint_color_input_one').attr('data-color',get_color);
              $('.hint_color_input_one').val(get_color);
              $('.hint_bc_color_one').removeAttr('style');
              $('.hint_bc_color_one').css('background-color',get_color);

              if($('.sentence_select').attr('data-color') != undefined){
                $('.sentence_select').removeAttr('data-color');
                $('.sentence_select').attr('data-color',get_color);
                $('.sentence_select').removeAttr('style');
                $('.sentence_select').css('color',get_color);

                $('.hint_sentence').each(function(){
                  var chk_id = $(this).attr('data-id');
                  if(chk_id==1){
                    $(this).removeAttr('style');
                    $(this).css('background-color',get_color)
                  }
                });
              }else if($('.word_select').attr('data-color') !=undefined){
                $('.word_select').removeAttr('data-color');
                $('.word_select').attr('data-color',get_color);
                $('.word_select').removeAttr('style');
                $('.word_select').css('color',get_color);

                $('.hint_words').each(function(){
                  var chk_id = $(this).attr('data-id');
                  if(chk_id==1){
                    $(this).removeAttr('style');
                    $(this).css('background-color',get_color)
                  }
                }); 
              }
              
            }
          }else if(second_color != '0' && $('.hint_color_input_two').is(':checked')){
            if($('.hint_color_input_two').is(':checked')){

              $('.hint_color_input_two').removeAttr('data-color');
              $('.hint_color_input_two').attr('data-color',get_color);
              $('.hint_color_input_two').val(get_color);
              $('.hint_bc_color_two').removeAttr('style');
              $('.hint_bc_color_two').css('background-color',get_color);

              if($('.sentence_select').attr('data-color') != undefined){
                $('.sentence_select').removeAttr('data-color');
                $('.sentence_select').attr('data-color',get_color);
                $('.sentence_select').removeAttr('style');
                $('.sentence_select').css('color',get_color);

                $('.hint_sentence').each(function(){
                  var chk_id = $(this).attr('data-id');
                  if(chk_id==2){
                    $(this).removeAttr('style');
                    $(this).css('background-color',get_color)
                  }
                });
              }else if($('.word_select').attr('data-color') !=undefined){
                $('.word_select').removeAttr('data-color');
                $('.word_select').attr('data-color',get_color);
                $('.word_select').removeAttr('style');
                $('.word_select').css('color',get_color);

                $('.hint_words').each(function(){
                  var chk_id = $(this).attr('data-id');
                  if(chk_id==2){
                    $(this).removeAttr('style');
                    $(this).css('background-color',get_color)
                  }
                }); 
              }
            }
          }
        
        });

        $(document).on('click', '.hint_chosen_color', function() {
          $('.hint_color_input_one').prop("checked", false);
          $('.hint_color_input_two').prop("checked", false);

          $('.hint_chosen_color').css('border', 'none');
          $(this).css('border', '1px solid red');
          $('input[type=radio]', this).prop("checked", true);
        });

        $(document).on('click', '.set_color_with_text', function() {

        // if($('.hint_color_input_one').is(':checked')){
            var get_one_color = $('.hint_color_input_one').attr('data-color');
            var get_two_color = $('.hint_color_input_two').attr('data-color');
            
            let text_one = new Array();
            let text_two = new Array();
            var one_final_text_no = '';
            var two_final_text_no = '';

            var chk_sentence = $('.sentence_select').attr('data-color');
            var chk_word = $('.word_select').attr('data-color');


            if(chk_word != undefined){
              $('#com_hint_type').val('word');
              $('.hint_words').each(function(){
                var chk_one = $(this).attr('data-id');
                if(chk_one != '' && chk_one==1){
                    var get_text = $(this).text();
                    text_one.push(get_text);

                    var get_id = $(this).attr('data-index');
                    one_final_text_no += get_id+',,';
                }else if(chk_one != '' && chk_one==2){
                    var get_text = $(this).text();
                    text_two.push(get_text);

                    var get_id = $(this).attr('data-index');
                    two_final_text_no += get_id+',,';
                }
              });
              
            }else if(chk_sentence != undefined){
              $('#com_hint_type').val('sentence');
              $('.hint_sentence').each(function(){
                var chk_one = $(this).attr('data-id');
                
                if(chk_one != '' && chk_one==1){
                    var get_text = $(this).text();
                    text_one.push(get_text);

                    var get_id = $(this).attr('data-index');
                    one_final_text_no += get_id+',,';
                }else if(chk_one != '' && chk_one==2){
                    var get_text = $(this).text();
                    text_two.push(get_text);

                    var get_id = $(this).attr('data-index');
                    two_final_text_no += get_id+',,';
                }
              });
            }

            
            var text_one_length = text_one.length;

            if(text_one_length>0){
            var final_text_one = '';
            
            for(var i=0;i<text_one_length;i++){
                final_text_one += text_one[i]+' ';
            }

            $('#text_one_hint').val(final_text_one);
            $('#text_one_hint_no').val(one_final_text_no);
            $('#text_one_hint_color').val(get_one_color);
            if($('.hint_color_input_one').is(':checked')){
              $('#first_hint_modal').modal('show');
            }

            }else{
              if($('.hint_color_input_one').is(':checked')){
               alert('You have to select at least one word');
              }
            }

            var text_two_length = text_two.length;
            if(text_two_length>0){
                var final_text_two = '';
                for(var i=0;i<text_two_length;i++){
                final_text_two += text_two[i]+' ';
                }

                $('#text_two_hint').val(final_text_two);
                $('#text_two_hint_no').val(two_final_text_no);
                $('#text_two_hint_color').val(get_two_color);
                if($('.hint_color_input_two').is(':checked')){
                  $('#second_hint_modal').modal('show');
                }
            }else{
              if($('.hint_color_input_two').is(':checked')){
                alert('You have to select at least one word');
              }
            }
        });

        $(".firstHintModalButton").click(function (){
        $('.check_set_text_one').css('display','flex');
        $('#first_hint_modal').modal('hide');
        });

        $(".secondtHintModalButton").click(function (){
          $('.check_set_text_two').css('display','flex');
          $('#second_hint_modal').modal('hide');
        });

        $(document).on('click', '.clear_hint_one', function() {
        
          $('.hint_words').each(function(){ 
              var chk_one_status = $(this).attr('data-id');
              if(chk_one_status != '' && chk_one_status==1){
                  $(this).removeAttr('data-id');
                  $(this).removeAttr('style');
              }
          });

          $('.hint_sentence').each(function(){ 
              var chk_two_status = $(this).attr('data-id');
              
              if(chk_two_status != '' && chk_two_status==1){
               // alert(chk_two_status);
                  $(this).removeAttr('data-id');
                  $(this).removeAttr('style');
              }
          });
         
          $('#text_one_hint_no').val('');
          $('.added_hint_color_with_no1').html('');

        });

        $(document).on('click', '.clear_hint_two', function() {
          $('.hint_words').each(function(){ 
              var chk_two_status = $(this).attr('data-id');
              if(chk_two_status != '' && chk_two_status==2){
                  $(this).removeAttr('data-id');
                  $(this).removeAttr('style');
              }
          });
          $('.hint_sentence').each(function(){ 
              var chk_two_status = $(this).attr('data-id');
              if(chk_two_status != '' && chk_two_status==2){
                  $(this).removeAttr('data-id');
                  $(this).removeAttr('style');
              }
          });
          $('#text_two_hint_no').val('');
          $('.added_hint_color_with_no2').html('');
        });

        $('.add_hint_question').click(function(){
          $('#second_section').hide();
          $('#first_section').show();
        });

        $(document).on('click', '.option_no', function() {
          $(".option_no").prop('checked', false); 
          $(this).attr('checked',true);
        });

        $(document).on('click', '.added_hint_write_image', function() {
          var id = $(this).attr('data-id');
          if(id ==1){
            $('#first_hint_modal').modal('show');
          }else{
            $('#second_hint_modal').modal('show');
          }
          
        });

        $('#add_note').click(function(){
          $('#add_note_modal').modal('show');
        });
        
        $(".noteModalButton").click(function (){
          $('#add_note_modal').modal('hide');
        });

        $('.sentence_select').click(function(){
            var found_color = '';
            if($('.hint_color_input_one').is(':checked')){
              found_color = $('.hint_color_input_one').val();
            }

            if($('.hint_color_input_two').is(':checked')){
              found_color = $('.hint_color_input_two').val();
            }
            if(found_color!= ''){
              $('.hint_selection_content').hide();
              $('.hint_selection_content_sentence').show();

              $(this).css('color',found_color);
              $(this).attr('data-color',found_color);
              $('.word_select').removeAttr('data-color');
              $('.word_select').removeAttr('style');
            }else{
              alert('Please Select One Color');
            }
        });

        $('.word_select').click(function(){
            var found_color = '';
            if($('.hint_color_input_one').is(':checked')){
              found_color = $('.hint_color_input_one').val();
            }

            if($('.hint_color_input_two').is(':checked')){
              found_color = $('.hint_color_input_two').val();
            }
            if(found_color!= ''){
              $('.hint_selection_content_sentence').hide();
              $('.hint_selection_content').show();
           
              $(this).css('color',found_color);
              $(this).attr('data-color',found_color);
              $('.sentence_select').removeAttr('data-color');
              $('.sentence_select').removeAttr('style');
            }else{
              alert('Please Select One Color');
            }
        });


        $(document).on('click', '.hint_sentence', function() {
          var check_set = $(this).attr('data-id');
          if(check_set != undefined){
              $(this).removeAttr('data-id');
              $(this).removeAttr('style');
          }else{
              var text = $(this).text();
              var get_color_by_button = $('.sentence_select').attr('data-color');
              if(get_color_by_button != ''){
                if($('.hint_color_input_one').is(':checked')){
                    var get_color = $('.hint_color_input_one').attr('data-color');
                    $(this).css('background-color',get_color);
                    $(this).attr('data-id',1);
                }else if($('.hint_color_input_two').is(':checked')){
                    var get_color = $('.hint_color_input_two').attr('data-color');
                    $(this).css('background-color',get_color);
                    $(this).attr('data-id',2);
                }else{
                    alert('Please Select a color first');
                }
              }else{
                alert('Please Select Sentence or word button first');
              }
          }
          
        });


    });


</script>
