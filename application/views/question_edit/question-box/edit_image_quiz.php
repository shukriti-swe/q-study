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

  /* image quiz css */

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
   z-index:1;
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
      z-index:1;
   }

  .question_image {
    max-height: 40px;
    width: 40px;
    cursor:pointer;
  }
  .quiz_option_image {
    margin-left: 40px;
    max-height: 40px;
    width: 40px;
  }
  .t1_box_one{
    border:1px solid #c3c3c3;
    max-height:400px;
    padding: 15px 16px;
  }
  .t1_box_two{
    border: 1px solid #c3c3c3;
    max-height: 500px;
    padding: 0px 12px;
  }
  .t1_box_two_help_button {
    padding: 8px 11px;
    background: red;
    border-radius: 5px;
    color: white;
    display: inline-block;
    border:1px solid black;
    cursor: pointer;
  }
  .t1_explaination{
    color:#000;
    text-decoration:underline;
    font-weight:bold;
    text-align:center;
    font-size:14px;
  }
  .box_one_one{
    width:100%;
    max-height: 355px;
  }
  .box_one_one_hint{
    width:100%;
    max-height: 444px;
  }
  .box_two_one{
    width:100%;
    max-height: 666px;
  }
  .box_two_one_hint{
    width:100%;
    max-height: 580px;
  }
  .box_three_one{
    width:100%;
    max-height: 825px;
  }
  .box_three_one_hint{
    width:100%;
    max-height: 650px;
  }
 

  .t2_box_two_help_button {
    padding: 8px 11px;
    background: red;
    border-radius: 5px;
    color: white;
    display: inline-block;
    border:1px solid black;
  }

  .t2_explaination{
    color:#000;
    text-decoration:underline;
    font-weight:bold;
    text-align:center;
    font-size:14px;
  }
  .t3_explaination{
    color:#000;
    text-decoration:underline;
    font-weight:bold;
    text-align:center;
    font-size:14px;
  }
  .t2_box_one{
    border:1px solid #c3c3c3;
    max-height:710px;
    padding: 0px 13px;
  }
  .t2_box_two{
    border:1px solid #c3c3c3;
    max-height:700px;
    padding: 0px 15px;
  }
  .t2_box_two_one{
    width:100%;
    max-height: 650px;
  }
  .t3_box_one{
    border:1px solid #c3c3c3;
    max-height:870px;
    padding: 0px 15px;
  }
  .t3_box_two{
    border:1px solid #c3c3c3;
    max-height:875px;
    padding: 0px 15px;
  }
  .t3_box_two_one{
    width:100%;
    max-height: 825px;
  }

  .container-fluid {
    width: 98%;
  }

  .type_one_first_box{
    border:1px solid #c3c3c3;
    width: 70px;
    padding:5px 10px;
  }
  .type1_one_explaination{
    display: flex;
    align-items: end;
  }

  .type_two_first_box{
    border:1px solid #c3c3c3;
    width: 70px;
    padding:5px 10px;
  }
  .type_two_explaination{
    display: flex;
    align-items: end;
  }
  .type_three_first_box{
    border:1px solid #c3c3c3;
    width: 70px;
    padding:5px 10px;
  }
  .type_three_explaination{
    display: flex;
    align-items: end;
  }
  
  
</style>

<input type="hidden" value="<?= $question_info[0]['question_name_type']; ?>" name="question_name_type" id="question_name_type" >


<?php 

  $question_description = json_decode($question_info[0]['questionDescription'],true);
  $all_questions = json_decode($question_info[0]['questionName'],true);
  $answers = json_decode($question_info[0]['answer']);
  // echo "<pre>";print_r($question_description);die();
  // echo "<pre>";print_r($question_info[0]);die();
?>

<input type="hidden" name="image_type_one" id="image_type_one" value="<?=$question_description['image_type_one']?>"> 
<input type="hidden" name="image_type_two" id="image_type_two" value="<?=$question_description['image_type_two']?>">
<input type="hidden" name="image_type_three" id="image_type_three" value="<?=$question_description['image_type_three']?>">

<input type="hidden" name="box_one_image" id="box_one_image" value="<?=$question_description['box_one_image']?>">
<input type="hidden" name="box_two_image" id="box_two_image" value="<?=$question_description['box_two_image']?>">
<input type="hidden" name="box_three_image" id="box_three_image" value="<?=$question_description['box_three_image']?>">

<input type="hidden" name="hint_one_image" id="hint_one_image" value="<?=$question_description['hint_one_image']?>">
<input type="hidden" name="hint_two_image" id="hint_two_image" value="<?=$question_description['hint_two_image']?>">
<input type="hidden" name="hint_three_image" id="hint_three_image" value="<?=$question_description['hint_three_image']?>">





<div class="row" id="first_section" >
  <div class="col-sm-1">
    
  </div>
  <div class="col-sm-11">
    <div class="Image_quiz_main">

      <div class="form-group" style="float: left;margin-right: 10px;">
        <div>
          <button type="button" class="btn btn-select image_upload" style="background-color: rgb(0, 162, 232);">Image Upload</button>
        </div>
      </div>

      <div class="form-group" style="float: left;margin-right: 10px;">
        <div>
          How Many Row <input type="number" name="total_rows" id="total_options" class="form-control w-50" value="<?=$question_description['total_rows']?>">
        </div>
      </div>

      <div id="show_types" style="margin-left:20px;">
        <div class="form-group" style="float: left;margin-right: 10px;">
            <button type="button" class="btn btn-select type_one" style="<?php if($question_description['image_type_one']==1){echo "background-color:rgb(0, 162, 232)";}?>">Type-1</button>
        </div>

        <div class="form-group" style="float: left;margin-right: 10px;">
            <button type="button" class="btn btn-select type_two" style="<?php if($question_description['image_type_two']==1){echo "background-color:rgb(0, 162, 232)";}?>">Type-2</button>
        </div>

        <div class="form-group" style="float: left;margin-right: 10px;">
            <button type="button" class="btn btn-select type_three" style="<?php if($question_description['image_type_three']==1){echo "background-color:rgb(0, 162, 232)";}?>">Type-3</button>
        </div>
      </div>
      
    </div>
  </div>
</div>


<div class="col-sm-6" style="position: absolute;left: 25%;z-index: 3;display:none;" id="type_one_title">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne" style="background-color:#00a2e8">
              <h5 class="panel-title">
                  <a role="button" aria-expanded="true" aria-controls="collapseOne" style="color:white;">
                        Question Description
                      <button type="button" class="woq_close_btn question_close" >&#10006;</button>
                  </a>
              </h5>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
          <textarea class="form-control imageQuiztextarea" name="question"><?=$question_description['question']?></textarea>
          </div>
          <div class="modal-footer" style="background-color:white;">
            <button type="button" class="btn btn_blue question_close">Close</button>
            <button type="button" class="btn btn_blue question_close">Save</button>
          </div>
      </div>
      
  </div>
  </div>

  <div class="col-sm-6" style="position: absolute;left: 25%;z-index: 3;display:none;" id="type_explaination">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne" style="background-color:#00a2e8">
              <h5 class="panel-title">
                  <a role="button" aria-expanded="true" aria-controls="collapseOne" style="color:white;">
                        Question Description
                      <button type="button" class="woq_close_btn explaination_close" >&#10006;</button>
                  </a>
              </h5>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
          <textarea class="form-control imageQuiztextarea" name="quiz_explaination"><?=$question_description['quiz_explaination']?></textarea>
          </div>
          <div class="modal-footer" style="background-color:white;">
            <button type="button" class="btn btn_blue explaination_close">Close</button>
            <button type="button" class="btn btn_blue explaination_close">Save</button>
          </div>
      </div>
  </div>
  </div>

  <div class="col-sm-6" style="position: absolute;left: 25%;z-index: 3;display:none;" id="quiz_question_area">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne" style="background-color:#00a2e8">
              <h5 class="panel-title">
                  <a role="button" aria-expanded="true" aria-controls="collapseOne" style="color:white;">
                        Question Description
                      <button type="button" class="woq_close_btn quiz_question_close" >&#10006;</button>
                  </a>
              </h5>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
          <textarea class="form-control question_description imageQuiztextarea" name="quiz_question"><?=$question_info[0]['questionName']?></textarea>
          </div>
          <div class="modal-footer" style="background-color:white;">
            <button type="button" class="btn btn_blue quiz_question_close">Close</button>
            <button type="button" class="btn btn_blue quiz_question_close">Save</button>
          </div>
      </div>
  </div>
  </div>




  <div class="col-sm-6" style="position: absolute;left: 25%;z-index: 3;display:none;" id="options_area">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne" style="background-color:#00a2e8">
              <h5 class="panel-title">
                  <a role="button" aria-expanded="true" aria-controls="collapseOne" style="color:white;">
                        Question Description
                      <button type="button" class="woq_close_btn option_close" >&#10006;</button>
                  </a>
              </h5>
          </div>
          <div id="option_inputs" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
          <?php 
              $options = $question_description['options'];
                if(!empty($question_description['total_rows'])){
                  $total_rows = $question_description['total_rows'];
                  for($i=1;$i<=$total_rows;$i++){
                    $j= $i-1;
          ?>

          <br><div class="optionDivs optionTextarea<?=$i?>"><textarea class="form-control imageQuiztextarea option_all option_description<?=$i?>"  name="options[<?=$j?>]" value="<?=$options[$j]?>"><?=$options[$j]?></textarea></div>

          <?php }}?>
          </div>
          <div class="modal-footer option_footer" style="background-color:white;">
            <button type="button" class="btn btn_blue option_close" data-dismiss="modal">Save</button>
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



<div class="image_quiz_first_section" style="margin-top:10px; <?php if($question_description['image_type_one']==0){echo "display:none;";}?>">

  <div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-11" style="display:flex;gap:10px;">
  
      <div class="type_one_first_box">
        <img type="button" class="question_image t1_box1_question" src="assets/images/images/question.png" data-id="11">
        
        <div style="position:relative;margin:auto;margin-top: 5px;">
            <input type="file" name="image" id="Upload_image" data-id="11" style="opacity: 0;position:absolute;width:100%;">
            <span style="color:black;font-size:14px;font-weight:bold;cursor:pointer;">Upload</span>
        </div>
      </div>
  
      <div style="border:1px solid #c3c3c3;width: 100px;padding:0px 5px;" class="type_one_second_box">
          <div style="position:relative;display:flex;gap:10px;padding-top:8px;">
            <a class="t1_box_two_help_button">Help</a>
            <label class="custom_radio">
              <span class="all_options"></span>
              <input type="checkbox" class="radio_ans" value="1" name="help_check_one" data-id="12" <?php if($question_description['help_check_one']==1){echo "checked";}?>>
              <span class="checkmark "></span>
            </label>
          </div>
          
          <div style="position:relative;margin:auto;margin-top: 10px;">
                <input type="file" name="type_one_hint_image" id="Upload_image_hint" style="opacity: 0;position:absolute;width:100%;" data-id="12">
                <span style="color:black;font-size:14px;font-weight:bold;cursor:pointer;">Upload</span>
          </div>
      </div>
      <div style="display: none;" class="type1_one_explaination">
        <a class="t1_explaination" style="display:inline-block;cursor:pointer;">Explaination</a>
      </div>
  
    </div>
  </div>
  <br>


  <div class="row">
    <div class="col-sm-1">
    </div>
    
    <div class="col-sm-5 type_one_image_box">
       <div class="t1_box_one">
          <div style="border:7px solid #c3c3c3;min-height:200px;" class="type1_box1_image">
             <?php if(!empty($question_description['box_one_image'])){?>
              <img  class="box_one_one" src="<?=base_url()?>/assets/imageQuiz/<?=$question_description['box_one_image']?>"/>
             <?php }?>
          </div>
       </div> 
    </div>

    <div class="col-sm-6 type_one_hint_box" style="display:none;">
      <div class="t1_box_two">

          <div style="border:7px solid #c3c3c3;min-height:200px;margin-top:15px" class="type1_box1_image_hint">
             <?php if(!empty($question_description['hint_one_image'])){?>
              <img  class="box_one_one_hint" src="<?=base_url()?>/assets/imageQuiz/<?=$question_description['hint_one_image']?>"/>
             <?php }?>
          </div>
     
      </div>
    </div>

    
      <div class="col-sm-2">
        <div class="ques_with_option" style="margin-left:20%;">

        <?php for($i=1;$i<=$question_description['total_rows'];$i++){?>
          <?php if($i ==1){?>
        <div style="display:inline-block;">
          <div class="option_with_no<?=$i?>" id="quiz_question" style="margin-left: 20px;cursor:pointer;display:inline-block;">
          <img class="question_image" src="assets/images/images/question.png">
          </div>
          <br>
          <div class="quiz_options" style="display:inline-block;">
          <div style="margin-top: 8px;">
            <label class="custom_radio"><span class="all_options"></span><input type="radio" class="radio_ans"  name="answer_one" value="<?=$i?>" <?php if($question_info[0]['answer']==$i){echo "checked";}?>><span class="checkmark" style="margin-top: 9px;"></span></label>
          </div>
          <img class="quiz_option_image modify_option<?=$i?>" data-id="<?=$i?>" src="assets/images/images/question.png">
          </div>
        </div>
        <?php }else{?>
         
          <br><div class="quiz_options" style="display:inline-block;">
          <div style="margin-top: 8px;">
          <label class="custom_radio"><span class="all_options"></span><input type="radio" class="radio_ans" name="answer_one" value="<?=$i?>" <?php if($question_info[0]['answer']==$i){echo "checked";}?>><span class="checkmark" style="margin-top: 9px;"></span></label>
          </div>
          <img class="quiz_option_image modify_option<?=$i?>" data-id="<?=$i?>" src="assets/images/images/question.png">
        </div>
        <?php }?>
        <?php }?>
      </div>
      
    </div>
  </div>
</div>


<!-- ============ Type two start Here =============  -->


<div class="image_quiz_second_section" style="margin-top:10px;<?php if($question_description['image_type_two']==0){echo "display:none;";}?>">

  <div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-11" style="display:flex;gap:10px;">
  
      <div class="type_two_first_box">
        <img type="button" class="question_image t1_box1_question" src="assets/images/images/question.png" data-id="21">
        
        <div style="position:relative;margin:auto;margin-top: 5px;">
            <input type="file" name="image" id="Upload_image_t2" data-id="21" style="opacity: 0;position:absolute;width:100%;">
            <span style="color:black;font-size:14px;font-weight:bold;cursor:pointer;">Upload</span>
        </div>
      </div>
  
      <div style="border:1px solid #c3c3c3;width: 100px;padding:0px 5px;" class="type_two_second_box">
          <div style="position:relative;display:flex;gap:10px;padding-top:8px;">
            <a class="t1_box_two_help_button">Help</a>
            <label class="custom_radio">
              <span class="all_options"></span>
              <input type="checkbox" class="radio_ans" value="1" name="help_check_two" data-id="22" <?php if($question_description['help_check_two']==1){echo "checked";}?>>
              <span class="checkmark "></span>
            </label>
          </div>
          
          <div style="position:relative;margin:auto;margin-top: 10px;">
                <input type="file" name="type_two_hint_image" id="Upload_image_hint_t2" style="opacity: 0;position:absolute;width:100%;" data-id="22">
                <span style="color:black;font-size:14px;font-weight:bold;cursor:pointer;">Upload</span>
          </div>
      </div>
      <div style="display: none;" class="type_two_explaination">
        <a class="t1_explaination" style="display:inline-block;cursor:pointer;">Explaination</a>
      </div>
  
    </div>
  </div>
  <br>

  <div class="row">
    <div class="col-sm-1">
    </div>
    
    <div class="col-sm-8 type_two_image_box">
       <div class="t2_box_one">
          <div style="border:7px solid #c3c3c3;min-height:300px;margin-top:15px" class="type2_box1_image">
             <?php if(!empty($question_description['box_two_image'])){?>
              <img  class="box_two_one" src="<?=base_url()?>/assets/imageQuiz/<?=$question_description['box_two_image']?>"/>
             <?php }?>
          </div>
       </div> 
    </div>

    <div class="col-sm-8 type_two_hint_box" style="display:none;">
      <div class="t2_box_two">
          <div style="border:7px solid #c3c3c3;min-height:300px;margin-top:15px" class="type2_image_hint">
             <?php if(!empty($question_description['hint_two_image'])){?>
              <img  class="box_two_one_hint" src="<?=base_url()?>/assets/imageQuiz/<?=$question_description['hint_two_image']?>"/>
             <?php }?>
          </div>
      </div>
    </div>

    
    <div class="col-sm-1">
      <div class="ques_with_option">
      <?php for($i=1;$i<=$question_description['total_rows'];$i++){?>
          <?php if($i ==1){?>
        <div style="display:inline-block;">
          <div class="option_with_no<?=$i?>" id="quiz_question" style="margin-left: 20px;cursor:pointer;display:inline-block;">
          <img class="question_image" src="assets/images/images/question.png">
          </div>
          <br>
          <div class="quiz_options" style="display:inline-block;">
          <div style="margin-top: 8px;">
            <label class="custom_radio"><span class="all_options"></span><input type="radio" class="radio_ans"  name="answer_two" value="<?=$i?>" <?php if($question_info[0]['answer']==$i){echo "checked";}?>><span class="checkmark" style="margin-top: 9px;"></span></label>
          </div>
          <img class="quiz_option_image modify_option<?=$i?>" data-id="<?=$i?>" src="assets/images/images/question.png">
          </div>
        </div>
        <?php }else{?>
         
          <br><div class="quiz_options" style="display:inline-block;">
          <div style="margin-top: 8px;">
          <label class="custom_radio"><span class="all_options"></span><input type="radio" class="radio_ans" name="answer_two" value="<?=$i?>" <?php if($question_info[0]['answer']==$i){echo "checked";}?>><span class="checkmark" style="margin-top: 9px;"></span></label>
          </div>
          <img class="quiz_option_image modify_option<?=$i?>" data-id="<?=$i?>" src="assets/images/images/question.png">
        </div>
        <?php }?>
        <?php }?>
      </div>
    </div>
  </div>
</div>



<!-- ============ Type Three start Here =============  -->


<div class="image_quiz_third_section" style="margin-top:10px;<?php if($question_description['image_type_three']==0){echo "display:none;";}?>">

<div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-11" style="display:flex;gap:10px;">
  
      <div class="type_three_first_box">
        <img type="button" class="question_image t1_box1_question" src="assets/images/images/question.png" data-id="31">
        
        <div style="position:relative;margin:auto;margin-top: 5px;">
            <input type="file" name="image" id="Upload_image_t3" data-id="31" style="opacity: 0;position:absolute;width:100%;">
            <span style="color:black;font-size:14px;font-weight:bold;cursor:pointer;">Upload</span>
        </div>
      </div>
  
      <div style="border:1px solid #c3c3c3;width: 100px;padding:0px 5px;" class="type_three_second_box">
          <div style="position:relative;display:flex;gap:10px;padding-top:8px;">
            <a class="t1_box_two_help_button">Help</a>
            <label class="custom_radio">
              <span class="all_options"></span>
              <input type="checkbox" class="radio_ans" value="1" name="help_check_three" data-id="32" <?php if($question_description['help_check_three']==1){echo "checked";}?>>
              <span class="checkmark "></span>
            </label>
          </div>
          
          <div style="position:relative;margin:auto;margin-top: 10px;">
                <input type="file" name="type_three_hint_image" id="Upload_image_hint_t3" style="opacity: 0;position:absolute;width:100%;" data-id="32">
                <span style="color:black;font-size:14px;font-weight:bold;cursor:pointer;">Upload</span>
          </div>
      </div>

      <div style="display: none;" class="type_three_explaination">
        <a class="t1_explaination" style="display:inline-block;cursor:pointer;">Explaination</a>
      </div>
  
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-sm-1">
    </div>
    
    <div class="col-sm-8 type_three_image_box">
       <div class="t3_box_one">
          <div style="border:7px solid #c3c3c3;min-height:400px;margin-top:15px" class="type3_box1_image">
             <?php if(!empty($question_description['box_three_image'])){?>
              <img  class="box_three_one" src="<?=base_url()?>/assets/imageQuiz/<?=$question_description['box_three_image']?>"/>
             <?php }?>
          </div>
       </div> 
    </div>

    <div class="col-sm-8 type_three_hint_box" style="display:none;">
      <div class="t3_box_two">
          <div style="border:7px solid #c3c3c3;min-height:400px;margin-top:15px" class="type3_image_hint">
             <?php if(!empty($question_description['hint_three_image'])){?>
              <img  class="box_three_one_hint" src="<?=base_url()?>/assets/imageQuiz/<?=$question_description['hint_three_image']?>"/>
             <?php }?>
          </div>
      </div>
    </div>

    
    <div class="col-sm-1">
      <div class="ques_with_option">
        <?php for($i=1;$i<=$question_description['total_rows'];$i++){?>
          <?php if($i ==1){?>
        <div style="display:inline-block;">
          <div class="option_with_no<?=$i?>" id="quiz_question" style="margin-left: 20px;cursor:pointer;display:inline-block;">
          <img class="question_image" src="assets/images/images/question.png">
          </div>
          <br>
          <div class="quiz_options" style="display:inline-block;">
          <div style="margin-top: 8px;">
            <label class="custom_radio"><span class="all_options"></span><input type="radio" class="radio_ans"  name="answer_three" value="<?=$i?>" <?php if($question_info[0]['answer']==$i){echo "checked";}?>><span class="checkmark" style="margin-top: 9px;"></span></label>
          </div>
          <img class="quiz_option_image modify_option<?=$i?>" data-id="<?=$i?>" src="assets/images/images/question.png">
          </div>
        </div>
        <?php }else{?>
         
          <br><div class="quiz_options" style="display:inline-block;">
          <div style="margin-top: 8px;">
          <label class="custom_radio"><span class="all_options"></span><input type="radio" class="radio_ans" name="answer_three" value="<?=$i?>" <?php if($question_info[0]['answer']==$i){echo "checked";}?>><span class="checkmark" style="margin-top: 9px;"></span></label>
          </div>
          <img class="quiz_option_image modify_option<?=$i?>" data-id="<?=$i?>" src="assets/images/images/question.png">
        </div>
        <?php }?>
        <?php }?>
      </div>
    </div>
  </div>
</div>





<!-- ============================ All Modal Start ========================== -->



<!-- ============================ All Modal End ========================== -->


<script>
    $(document).ready(function(){
        $('.image_upload').click(function(){
        $('#show_types').show();
        $(this).css('background-color','#00a2e8;');
    });

    $('.type_one').click(function(){
        $('.type_two').removeAttr('style');
        $('.type_three').removeAttr('style');
        $(this).css('background-color','#00a2e8;');
        $('.image_quiz_first_section').show();
        $('.image_quiz_second_section').hide();
        $('.image_quiz_third_section').hide();

        $('#image_type_one').val(1);
        $('#image_type_two').val(0);
        $('#image_type_three').val(0);
        $('.imageQuiztextarea').val('');
        $('.t1_box1_question').attr('src', 'assets/images/images/question.png');
    });

    $('.t1_box1_question').click(function(){
      var box_chk = $(this).attr('data-id');

      if(box_chk==11){
         $('.type_one_first_box').css('background-color','#a5eafc;');
         $('.type_one_second_box').css('background-color','white');
         $('.type_one_image_box').show();
         $('.type_one_hint_box').hide();
         $('.type1_one_explaination').hide();
      }else if(box_chk==21){
         $('.type_two_first_box').css('background-color','#a5eafc;');
         $('.type_two_second_box').css('background-color','white');
         $('.type_two_image_box').show();
         $('.type_two_hint_box').hide();
         $('.type_two_explaination').hide();
      }else if(box_chk==31){
         $('.type_three_first_box').css('background-color','#a5eafc;');
         $('.type_three_second_box').css('background-color','white');
         $('.type_three_image_box').show();
         $('.type_three_hint_box').hide();
         $('.type_three_explaination').hide();
      }
      // $('#t1_box1_question_description').modal('show');
      $('#type_one_title').show();
    });

    $('.radio_ans').click(function(){
      var box_chk = $(this).attr('data-id');
      if(box_chk==12){
         $('.type_one_first_box').css('background-color','white');
         $('.type_one_second_box').css('background-color','#a5eafc;');
         $('.type_one_image_box').hide();
         $('.type_one_hint_box').show();
         $('.type1_one_explaination').show();
      }else if(box_chk==22){
         $('.type_two_first_box').css('background-color','white');
         $('.type_two_second_box').css('background-color','#a5eafc;');
         $('.type_two_image_box').hide();
         $('.type_two_hint_box').show();
         $('.type_two_explaination').show();
      }else if(box_chk==32){
         $('.type_three_first_box').css('background-color','white');
         $('.type_three_second_box').css('background-color','#a5eafc;');
         $('.type_three_image_box').hide();
         $('.type_three_hint_box').show();
         $('.type_three_explaination').show();
      }
    });

    $('.t1_box1_ques_desc_modal_save').click(function(){
      $('.t1_box1_question').attr('src', 'assets/images/images/question_write.png');
      $('#t1_box1_question_description').modal('hide');
    });

    $('#total_options').change(function() {
      var total_number = $(this).val();

      var question_with_option = '';
      var option_input ='';
      var option_save = '';
 
      for(var j=1;j<=total_number;j++){
        if(j==1){
          question_with_option += '<div style="display:inline-block;"><div class="option_with_no'+j+'" id="quiz_question" style="margin-left: 20px;cursor:pointer;display:inline-block;"><img class="question_image" src="assets/images/images/question.png"></div><br><div class="quiz_options" style="display:inline-block;"><div style="margin-top: 8px;"><label class="custom_radio"><span class="all_options"></span><input type="radio" class="radio_ans"  name="answer" value="'+j+'"><span class="checkmark" style="margin-top: 9px;"></span></label></div><img class="quiz_option_image modify_option' +j+ '" data-id="' +j+ '" src="assets/images/images/question.png"></div></div>';
        }else{
          question_with_option += '<br><div class="quiz_options" style="display:inline-block;"><div style="margin-top: 8px;"><label class="custom_radio"><span class="all_options"></span><input type="radio" class="radio_ans" name="answer" value="'+j+'"><span class="checkmark" style="margin-top: 9px;"></span></label></div><img class="quiz_option_image modify_option' +j+ '" data-id="' +j+ '" src="assets/images/images/question.png"></div>';
        }
        option_input += '<br><textarea class="form-control option_all option_description' + j + '"  name="options[]"></textarea>';
        option_save += '<button type="button" data-id="' + j + '" class="btn btn_blue optionSaveButton saveComOption' + j + '">Save</button>';

      }

      $('.ques_with_option').html(question_with_option);
      $('#option_inputs').html(option_input);
      $('.option_footer').html(option_save);
      
    });

    $("#Upload_image").change(function(){
        var box_chk = $(this).attr('data-id');
        if(box_chk==11){
          $('.type_one_second_box').css('background-color','white');
          $('.type_one_first_box').css('background-color','#a5eafc;');
          $('.type_one_image_box').show();
          $('.type_one_hint_box').hide();
        }
        var property = document.getElementById('Upload_image').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        
        if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png','']) == -1){
          //alert("Invalid image file");
        }
       
        var form_data = new FormData();
        form_data.append("file",property);

      $.ajax({
          url: "type_one_box_one_image_upload",
          method:'POST',
          data:form_data,
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function(){
            $('#msg').html('Loading......');
          },
          success: function (data) {

            var img = '<img  class="box_one_one" src="<?=base_url()?>/assets/imageQuiz/'+data+'"/>';
            $('#box_one_image').val(data);
            $('.type1_box1_image').html(img);
          }
        });
      
    });

    $(document).on('click', '.quiz_option_image', function() {
  
      var index = $(this).attr('data-id');
      
      $('.optionDivs').hide(); 
      $('.optionSaveButton').hide();
      $('.optionTextarea' + index).show();
      $('.saveComOption' + index).show();
      // $('#options_modal').modal('show');
      $('#options_area').show();
    });

    $(document).on('click', '.optionSaveButton', function() {
      var index_no = $(this).attr('data-id');
      // $('#options_modal').modal('hide');
      $('#options_area').hide();
      $('.modify_option' + index_no).attr('src', 'assets/images/images/question_write.png');
    });

    $("#Upload_image_hint").change(function(){
      
        var box_chk = $(this).attr('data-id');
        if(box_chk==12){
          $('.type_one_first_box').css('background-color','white');
          $('.type_one_second_box').css('background-color','#a5eafc;');
          $('.type_one_image_box').hide();
          $('.type_one_hint_box').show();
          $('.type1_one_explaination').show();
        }
        var property = document.getElementById('Upload_image_hint').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        
        if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png','']) == -1){
          //alert("Invalid image file");
        }
      
        var form_data = new FormData();
        form_data.append("file",property);

      $.ajax({
          url: "type_one_box_one_hint_image_upload",
          method:'POST',
          data:form_data,
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function(){
            $('#msg').html('Loading......');
          },
          success: function (data) {

            var img = '<img  class="box_one_one_hint" src="<?=base_url()?>/assets/imageQuiz/'+data+'"/>';
            $('#hint_one_image').val(data);
            $('.type1_box1_image_hint').html(img);
          }
        });
      
    });

    $(document).on('click', '#quiz_question', function() {
      // $('#quiz_question_modal').modal('show');
      $('#quiz_question_area').show();
    });

    $('.saveQuizQuestion').click(function() {
      $('#quiz_question_modal').modal('hide');
      $('.question_image').attr('src', 'assets/images/images/question_write.png');
    });

    $('.t1_explaination').click(function() {
      // $('#t1_explainationModal').modal('show');
      $('#type_explaination').show();
    });

    $('.saveExplaination').click(function() {
      $('#t1_explainationModal').modal('hide');
    });



    //  ==========   Type One is End here ===========


    $('.type_two').click(function(){
      
        $(this).css('background-color','#00a2e8;');
        $('.type_one').removeAttr('style');
        $('.type_three').removeAttr('style');
        $('.image_quiz_first_section').hide();
        $('.image_quiz_second_section').show();
        $('.image_quiz_third_section').hide();

        $('#image_type_one').val(0);
        $('#image_type_two').val(1);
        $('#image_type_three').val(0);
        $('.imageQuiztextarea').val('');
        $('.t1_box1_question').attr('src', 'assets/images/images/question.png');
    });

    $("#Upload_image_t2").change(function(){
          
          var box_chk = $(this).attr('data-id');
          if(box_chk==21){
            $('.type_two_second_box').css('background-color','white');
            $('.type_two_first_box').css('background-color','#a5eafc;');
            $('.type_two_image_box').show();
            $('.type_two_hint_box').hide();
          }
          var property = document.getElementById('Upload_image_t2').files[0];
          var image_name = property.name;
          var image_extension = image_name.split('.').pop().toLowerCase();
          
          if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png','']) == -1){
            //alert("Invalid image file");
          }
        
          var form_data = new FormData();
          form_data.append("file",property);

        $.ajax({
            url: "type_two_box_one_image_upload",
            method:'POST',
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
              $('#msg').html('Loading......');
            },
            success: function (data) {

              var img = '<img  class="box_two_one" src="<?=base_url()?>/assets/imageQuiz/'+data+'"/>';
              $('#box_two_image').val(data);
              $('.type2_box1_image').html(img);
            }
          });
        
    });

    $("#Upload_image_hint_t2").change(function(){
        var box_chk = $(this).attr('data-id');
        if(box_chk==22){
          $('.type_two_first_box').css('background-color','white');
          $('.type_two_second_box').css('background-color','#a5eafc;');
          $('.type_two_image_box').hide();
          $('.type_two_hint_box').show();
          $('.type1_two_explaination').show();
        }
        var property = document.getElementById('Upload_image_hint_t2').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        
        if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png','']) == -1){
          //alert("Invalid image file");
        }
      
        var form_data = new FormData();
        form_data.append("file",property);

      $.ajax({
          url: "type_two_box_one_image_upload",
          method:'POST',
          data:form_data,
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function(){
            $('#msg').html('Loading......');
          },
          success: function (data) {

            var img = '<img  class="t2_box_two_one" src="<?=base_url()?>/assets/imageQuiz/'+data+'"/>';
            $('#hint_two_image').val(data);
            $('.type2_image_hint').html(img);
          }
        });
    
    });

    //  ==========   Type Two is End here ==========

    $('.type_three').click(function(){
      $(this).css('background-color','#00a2e8;');
      $('.type_one').removeAttr('style');
      $('.type_two').removeAttr('style');
      $('.image_quiz_second_section').hide();
      $('.image_quiz_first_section').hide();
      $('.image_quiz_third_section').show();

      $('#image_type_one').val(0);
      $('#image_type_two').val(0);
      $('#image_type_three').val(1);
      $('.imageQuiztextarea').val('');
      $('.t1_box1_question').attr('src', 'assets/images/images/question.png');
    });

    $("#Upload_image_t3").change(function(){
      var box_chk = $(this).attr('data-id');
      if(box_chk==31){
         $('.type_three_second_box').css('background-color','white');
         $('.type_three_first_box').css('background-color','#a5eafc;');
         $('.type_three_image_box').show();
         $('.type_three_hint_box').hide();
      }

      var property = document.getElementById('Upload_image_t3').files[0];
      var image_name = property.name;
      var image_extension = image_name.split('.').pop().toLowerCase();
      
      if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png','']) == -1){
        //alert("Invalid image file");
      }
    
      var form_data = new FormData();
      form_data.append("file",property);

      $.ajax({
        url: "type_three_box_one_image_upload",
        method:'POST',
        data:form_data,
        contentType:false,
        cache:false,
        processData:false,
        beforeSend:function(){
          $('#msg').html('Loading......');
        },
        success: function (data) {

          if(data !=''){
            var img = '<img  class="box_three_one" src="<?=base_url()?>/assets/imageQuiz/'+data+'"/>';
            $('#box_three_image').val(data);

            $('.type3_box1_image').html(img);
          }else{
            alert('Invalid image height, please upload image height 700 px!');
          }
        }
      });
    
    });

    $("#Upload_image_hint_t3").change(function(){
      
        var box_chk = $(this).attr('data-id');
        if(box_chk==32){
          $('.type_three_first_box').css('background-color','white');
          $('.type_three_second_box').css('background-color','#a5eafc;');
          $('.type_three_image_box').hide();
          $('.type_three_hint_box').show();
          $('.type1_three_explaination').show();
        }
        var property = document.getElementById('Upload_image_hint_t3').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        
        if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png','']) == -1){
          //alert("Invalid image file");
        }
      
        var form_data = new FormData();
        form_data.append("file",property);

      $.ajax({
          url: "type_three_box_one_image_upload/3",
          method:'POST',
          data:form_data,
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function(){
            $('#msg').html('Loading......');
          },
          success: function (data) {

            if(data !=''){
              var img = '<img  class="t3_box_two_one" src="<?=base_url()?>/assets/imageQuiz/'+data+'"/>';
              
              $('#hint_three_image').val(data);
              $('.type3_image_hint').html(img);
            }else{
                alert('Invalid image height, please upload image height 700 px!');
            }
          }
          
      });
    
    });

    $('.t1_box_two_help_button').click(function(){
      var status1 = $('#image_type_one').val();
      var status2 = $('#image_type_two').val();
      var status3 = $('#image_type_three').val();
      if(status1==1){
        $('.type_one_first_box').css('background-color','white');
        $('.type_one_second_box').css('background-color','#a5eafc;');
        $('.type_one_image_box').hide();
        $('.type_one_hint_box').show();
        $('.type1_one_explaination').show();
      }else if(status2==1){
        $('.type_two_first_box').css('background-color','white');
        $('.type_two_second_box').css('background-color','#a5eafc;');
        $('.type_two_image_box').hide();
        $('.type_two_hint_box').show();
        $('.type_two_explaination').show();

      }else if(status3==1){
        $('.type_three_first_box').css('background-color','white');
        $('.type_three_second_box').css('background-color','#a5eafc;');
        $('.type_three_image_box').hide();
        $('.type_three_hint_box').show();
        $('.type_three_explaination').show();

      }
        
    });

    $('.question_close').click(function(){
       $('#type_one_title').hide();
    });

    $('.explaination_close').click(function(){
       $('#type_explaination').hide();
    });

    $('.quiz_question_close').click(function(){
       $('.question_image').attr('src', 'assets/images/images/question_write.png');
       $('#quiz_question_area').hide();
    });
    $('.option_close').click(function(){
       $('#options_area').hide();
    });


    });
</script>
