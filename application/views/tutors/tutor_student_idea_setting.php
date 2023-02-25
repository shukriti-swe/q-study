<style type="text/css">
  .w-100 { 
    max-width: 100px;
  }

  .top_headed {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }

  .top_headed>div {
    box-sizing: border-box;
    margin: 10px 10px 0 0;
  }

  .top_headed label {
    margin-bottom: 5px;
  }

  .p2 {
    padding: 10px;
  }

  .btn-text {
    background: #fff;
    color: #17a8e9;
    font-weight: bold;
    text-decoration: underline;
  }

  .rs_n_table {
    border: none;
    border-collapse: separate;
    border-spacing: 10px 0px;
  }

  .rs_n_table a {
    color: #333;
  }

  .rs_n_table td {
    vertical-align: middle !important;
    border-color: #b7dde9 !important;
  }

  body .rs_n_table thead th {
    border: none !important;
    text-align: center;
    font-size: 14px;
    padding-left: 0;
    padding-right: 0;
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

  .btn-select2 {
    background: #e8e8e8;
    color: black;
    box-shadow: none !important;
    border-radius: 0;
    /* font-weight:bold; */
  }

  .btn-select2:hover,
  .btn-select2.active {
    background: #00a2e8;
    color: #fff;
  }

  .btn-select2-border {
    background: #fff;
    color: #000;
    box-shadow: none !important;
    border-radius: 0;
    border: 1px solid #ddd9c3;
  }

  .btn-select2-border:hover,
  .btn-select2-border.active {
    background: #ddd9c3;
    color: #fff;
  }

  .idea_setting_mid_bottom .btn-select2:hover,
  .idea_setting_mid_bottom .btn-select2.active {
    background: #ff7f27;
    color: #fff;
  }

  .custom_radio_custom {
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
  .custom_radio_custom input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
  }

  /* Create a custom radio button */
  .checkmark_custom {
    position: absolute;
    top: 10px;
    left: 2px;
    height: 24px;
    width: 24px;
    background-color: #00a2e8 !important;
    border-radius: 50%;
    
  }

  /* new code */
  .title_mark {
    position: absolute;
    top: -40px;
    left: 20px;
  }

  .spelling_error {
    position: relative;
  }

  .spelling_error_mark {
    position: absolute;
    top: -40px;
    left: 96px;
  }

  .creative_sentence_mark_show {
    display: block;
    position: absolute;
    top: -40px;
    right: 0px;
    left: 0px;
    margin: auto;
    width: 34px;
  }

  .introduction_mark_show{
    display: block;
    position: absolute;
    top: -40px;
    right: 0px;
    left: 185px;
    margin: auto;
    width: 34px;  
  }

  .body_paragraph_mark_show{
    display: block;
    position: absolute;
    top: -40px;
    right: 0px;
    left: 265px;
    margin: auto;
    width: 34px;
  }
  .conclusion_mark_show{
    display: block;
    position: absolute;
    top: -40px;
    right: 0px;
    left: 350px;
    margin: auto;
    width: 34px;
  }

  .btn-select3 {
    background: rgb(255 255 255 / 90%);
    color: #000;
    box-shadow: none !important;
    border-radius: 40%;
    font-weight: bold;
    border: 1px solid #ddd2d5;
  }
  .idea_table{
    font-size:15px;
  }
  .idea_student{
    color:black;
    font-size:20px;
    text-decoration:underline;
    cursor:pointer;
  }
  .students_button{
    color:black;
    font-size:20px;
    text-decoration:underline;
    cursor:pointer;
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
    border: 2px solid #eee;
  }

  /* On mouse-over, add a grey background color */
  .custom_radio:hover input~.checkmark {
    background-color: #fff;
    border: 2px solid #eee;
  }

  /* When the radio button is checked, add a blue background */
  .custom_radio input:checked~.checkmark {
    background-color: #fff;
    border: 2px solid #ccc;
  }

  /* Create the indicator (the dot/circle - hidden when not checked) */
  .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }

  /* Show the indicator (dot/circle) when checked */
  .custom_radio input:checked~.checkmark:after {
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
  .upload_image_1{
    position: relative;
  }
  .option_box_image{
    width: 160px;
    height: 140px;
    border-radius: 10px;
  }
  .option_box_image_show{
    width: 175px;
    height: 140px;
    border-radius: 10px;
  }
  .custom_tooltip::after {
    width: 0;
    height: 0;
    border-left: 33px solid transparent;
    border-right: 20px solid transparent;
    border-top: 50px solid #fff2cc;
    content: '';
    position: absolute;
    bottom: -50px;
    left: 60%;
  }
  .upper_box{
    display:none;
    position:absolute;
    border:2px solid #2f528f;
    height:130px;
    width:190px;
    border-radius: 20px;
    top: -200px;
    left:-100px;
    background-color: #fff2cc;
    padding:10px;
  }
  .upper_arrow{
    display:none;
    position:absolute;
    bottom:-50px;
    left: 100px;
  }
  .right_box{
    display:none;
    position:absolute;
    border:2px solid #264596;
    height:130px;width:190px;
    border-radius: 20px;
    top: -190px;
    left:-50px;
    background-color: #00a2e8;
    padding:10px;
    color:white;
  }
  .right_arrow{
    display:none;
    position:absolute;
    bottom:-50px;
    left: 100px;
  }
  .down_box{
    display:none;
    position: absolute;
    border: 2px solid #264596;
    height: 160px;
    width: 140px;
    border-radius: 20px;
    top: 40px;
    left: -200px;
    background-color: #fff2cc;
    padding: 10px;
    color: black;
  }
  .down_arrow{
    display:none;
    position: absolute;
    bottom: 70px;
    transform: rotate(-90deg);
    left: 129px;
  }
  .left_box{
    display:none;
    position: absolute;
    border: 2px solid #264596;
    height: 100px;
    width: 175px;
    border-radius: 20px;
    top: 185px;
    left: 0px;
    background-color: #ed1c24;
    padding: 10px;
    color: black;
  }
  .left_arrow{
    display:none;
    position: absolute;
    bottom: 96px;
    left: 55px;
  }
  .hint_set_prev{
    position: absolute;
    right: 100%;
    white-space: nowrap;
    border: 1px solid gray;
    margin-right: 20px;
    padding: 0px 7px;
  }
  .intro_hint_set_prev{
    position: absolute;
    right: 100%;
    white-space: nowrap;
    border: 1px solid gray;
    margin-right: 20px;
    padding: 0px 7px;
  }
  .title_opt_hint_icon{
    position: absolute;
    right: 100%;
    white-space: nowrap;
    color: red;
    margin-right: 3px;
    top: 3px;
    font-size: 25px;
  }
  .intro_opt_hint_icon{
    position: absolute;
    right: 100%;
    white-space: nowrap;
    color: red;
    margin-right: 3px;
    top: 3px;
    font-size: 25px;
  }
  .body_paragraph_opt_hint_icon{
    position: absolute;
    right: 100%;
    white-space: nowrap;
    color: red;
    margin-right: 3px;
    top: 3px;
    font-size: 25px;
  }
  .body_paragraph_hint_set_prev{
    position: absolute;
    right: 100%;
    white-space: nowrap;
    border: 1px solid gray;
    margin-right: 20px;
    padding: 0px 7px;
  }
  .ss_conclution_opt_hint_icon{
    position: absolute;
    right: 100%;
    white-space: nowrap;
    color: red;
    margin-right: 3px;
    top: 3px;
    font-size: 25px;
  }
  .ss_conclution_hint_set_prev{
    position: absolute;
    right: 100%;
    white-space: nowrap;
    border: 1px solid gray;
    margin-right: 20px;
    padding: 0px 7px;
  }

  
</style>
 
<?php
  //  echo "<pre>";print_r($student_idea[0]);die();
?>

<div class="" style="margin-left: 15px;">
  <div class="row">
    <div class="col-md-3">
      <div class="row" >
        <div class="col-md-2">
          <!-- <div class="image_box"><img style="height:70px;" id="imgFrame" src="assets/uploads/profile/thumbnail/<?//= $profile[0]['profile_image'] ?>" width="100px" height="200px" /></div> -->
        </div>
        <div class="col-md-10" style="border:1px solid #c3c3c3;padding:5px;">
          <table class="idea_table">
            <tr>
              <td>Created</td>
              <td><?=$student_idea[0]['submit_date']?></td>
            </tr>
            <tr>
              <td>Name</td>
              <td><?=$student_idea[0]['name']?></td>
            </tr>
            <tr>
              <td>Grade/Year </td>
              <td><?=$student_idea[0]['student_grade']?></td>
            </tr>
            <tr>
              <td>School</td>
              <td><?=$student_idea[0]['school_name']?></td>
            </tr> 
          </table>
          <br>
          <div>
            <p><b>Idea/Topic/Story Title</b></p>
            <p class="set_student_title" style="color:#f98f0b;"></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <h6><?=$student_idea[0]['short_ques_body']?></h6>
    </div>

    <div class="col-md-5">
        

    </div>
  </div>

  <br>
  <input type="hidden" class="get_matching_ans_word">
  <input type="hidden" class="get_matching_ques_word">
  <input type="hidden" class="other_creative_sentence_match_index">

 <form action="" id="given_idea_point">
  <!-- Hidden Field -->
  <input type="hidden" name="module_id" value="<?= $student_idea[0]['module_id'];?>">
  <input type="hidden" name="question_id" value="<?= $student_idea[0]['question_id'];?>">
  <input type="hidden" name="student_id" value="<?= $student_idea[0]['user_id'];?>">
  <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id')?>">
  <input type="hidden" name="idea_id" value="<?= $student_idea[0]['idea_id'];?>">


  <!-- <input type="hidden" name="title_comment" id="title_comment"> -->
  <input type="hidden" name="total_title_mark" id="total_title_mark">
  <textarea name="spelling_error_value" cols="30" rows="10" class="spelling_error_value" style="display:none;"></textarea>
  <input type="hidden" name="total_spelling_mark" id="total_spelling_mark">
  <input type="hidden" name="creative_sentence_mark" id="creative_sentence_mark">
  <input type="hidden" name="creative_sentence_index" id="creative_sentence_index">
  <!-- <input type="text" name="every_introduction_index" id="every_introduction_index"> -->
  <!-- <input type="text" name="introduction_auto_comment_value" id="introduction_auto_comment_value"> -->
  <input type="hidden" name="introduction_point" id="introduction_point">
  <!-- <input type="text" name="every_body_index" id="every_body_index"> -->
  <!-- <input type="text" name="body_paragraph_auto_comment_value" id="body_paragraph_auto_comment_value"> -->
  <input type="hidden" name="body_paragraph_point" id="body_paragraph_point">
  <!-- <input type="text" name="every_conclusion_index" id="every_conclusion_index">
  <input type="text" name="conclusion_auto_comment_value" id="conclusion_auto_comment_value"> -->
  <input type="hidden" name="conclusion_point" id="conclusion_point">

  <div class="other_student_value">
    <input type="hidden" name="title_option_one" id="title_option_one">
    <input type="hidden" name="title_option_one_hint" id="title_option_one_hint">
    <input type="hidden" name="title_option_two" id="title_option_two">
    <input type="hidden" name="title_option_two_hint" id="title_option_two_hint">
    <input type="hidden" name="title_option_three" id="title_option_three">
    <input type="hidden" name="title_option_three_hint" id="title_option_three_hint">
    <input type="hidden" name="title_option_four" id="title_option_four">
    <input type="hidden" name="title_option_four_hint" id="title_option_four_hint">

    <input type="hidden" name="option_one_image" id="option_one_image">
    <input type="hidden" name="option_two_image" id="option_two_image">
    <input type="hidden" name="option_three_image" id="option_three_image">
    <input type="hidden" name="option_four_image" id="option_four_image">
    <input type="hidden" name="image_option_points" id="image_option_points">
    <input type="hidden" name="image_option_ans" id="image_option_ans">
    <input type="hidden" name="option_one_image_texts" id="option_one_image_texts">


    <input type="hidden" name="other_total_spelling_mark" id="other_total_spelling_mark">
    <textarea name="other_spelling_error_value" cols="30" rows="10" class="other_spelling_error_value" style="display:none;"></textarea>

    <input type="hidden" name="other_creative_sentence_index" id="other_creative_sentence_index">
    <input type="hidden" name="other_creative_sentence_mark" id="other_creative_sentence_mark">

    <input type="hidden" name="ss_intro_option_one" id="ss_intro_option_one">
    <input type="hidden" name="ss_intro_option_one_hint" id="ss_intro_option_one_hint">
    <input type="hidden" name="ss_intro_option_two" id="ss_intro_option_two">
    <input type="hidden" name="ss_intro_option_two_hint" id="ss_intro_option_two_hint">
    <input type="hidden" name="ss_intro_option_three" id="ss_intro_option_three">
    <input type="hidden" name="ss_intro_option_three_hint" id="ss_intro_option_three_hint">
    <input type="hidden" name="ss_intro_option_four" id="ss_intro_option_four">
    <input type="hidden" name="ss_intro_option_four_hint" id="ss_intro_option_four_hint">

    <input type="hidden" name="ss_body_paragraph_one" id="ss_body_paragraph_option_one">
    <input type="hidden" name="ss_body_paragraph_one_hint" id="ss_body_paragraph_option_one_hint">
    <input type="hidden" name="ss_body_paragraph_two" id="ss_body_paragraph_option_two">
    <input type="hidden" name="ss_body_paragraph_two_hint" id="ss_body_paragraph_option_two_hint">
    <input type="hidden" name="ss_body_paragraph_three" id="ss_body_paragraph_option_three">
    <input type="hidden" name="ss_body_paragraph_three_hint" id="ss_body_paragraph_option_three_hint">
    <input type="hidden" name="ss_body_paragraph_four" id="ss_body_paragraph_option_four">
    <input type="hidden" name="ss_body_paragraph_four_hint" id="ss_body_paragraph_option_four_hint">

    <input type="hidden" name="ss_conclution_one" id="ss_conclution_option_one">
    <input type="hidden" name="ss_conclution_one_hint" id="ss_conclution_option_one_hint">
    <input type="hidden" name="ss_conclution_two" id="ss_conclution_option_two">
    <input type="hidden" name="ss_conclution_two_hint" id="ss_conclution_option_two_hint">
    <input type="hidden" name="ss_conclution_three" id="ss_conclution_option_three">
    <input type="hidden" name="ss_conclution_three_hint" id="ss_conclution_option_three_hint">
    <input type="hidden" name="ss_conclution_four" id="ss_conclution_option_four">
    <input type="hidden" name="ss_conclution_four_hint" id="ss_conclution_option_four_hint">
  </div>
  
</form>
  <div class="row" style="padding:0px 15px;">
    <div class="col-md-6">
      
    </div>

    <div class="col-md-5" style="margin-left:2%;">
      <div class="row standard_selected_box" style="margin-left:1px;margin-bottom:50px;display:none;">
        <div style="display:flex;gap:20px;">
            <a class="students_button idea_student" type="button">Linda</a>
            <a class="students_button idea_others_student" type="button">Others Student</a>

            <a style="color:gray;font-size:20px;text-decoration:underline;cursor:pointer;margin-left:50px;" class="standard_button" type="button">Standard Marking</a>
        </div>
        
      </div>
      <div class="standard_marking_box" style="display:none;">
        
        <div class="student_idea_menu" style="display:none;">
            <a type="button" class="btn btn-select title_button">Title</a>
            <a type="button" class="btn btn-select spelling_error">Spelling Error</a>
            <a type="button" class="btn btn-select creative_sentence">Creative Sentence</a>
          
            <a type="button" class="btn btn-select introduction_button">Introduction</a>
            <a type="button" class="btn btn-select body_paragraph_button">Body Paragraph</a>
            <a type="button" class="btn btn-select conclution_button">Conclution</a>
            <a type="button" class="btn btn-select story_structure">Story Structure</a>
        </div>

        <div class="others_student_idea_menu" style="display:none;">
            <a type="button" style="padding: 6px 8px;" class="btn btn-select other_title_button">Title</a>
            <a type="button" style="padding: 6px 8px;" class="btn btn-select other_image_button">Image</a>
            <a type="button" style="padding: 6px 8px;" class="btn btn-select other_spelling_error">Spelling Error</a>
            <a type="button" style="padding: 6px 8px;" class="btn btn-select other_creative_button">Creative Sentence</a>
            <a type="button" style="padding: 6px 8px;" class="btn btn-select other_story_structure_button">Story Structure</a>
        </div>
        
        <div class="others_story_structure_menu" style="display:none;">
             <a type="button" class="btn btn-select other_introduction_button">Introduction</a>
             <a type="button" class="btn btn-select other_body_paragraph_button">Body Paragraph</a>
             <a type="button" class="btn btn-select other_conclution_button">Conclution</a>

             <a type="button" class="btn btn-select save_all_info">Save all info</a>
        </div>
          
      </div>

      <div class="row standard_special_box">
        <div class="col-md-6 text-center">
          <a style="color:gray;font-size:20px;text-decoration:underline;cursor:pointer;" class="standard_button" type="button">Standard Marking</a>
        </div>

        <div class="col-md-6 text-center">
          <a style="color:gray;font-size:20px;text-decoration:underline;cursor:pointer;" class="special_button" type="button">Special Marking</a>
        </div>
      </div>
      
    </div>

  </div>
  <br>
  <div class="row" style="padding:0px 15px; display: flex;">
    <div class="col-md-6" style="border: 1px solid #82bae6;padding: 5px;box-shadow: 0px 0px 4px #82bae6;border-radius: 5px;">
      
      <div class="student_idea_text">
        <?= $student_idea[0]['idea_ans']; ?>
      </div>

      <div class="spelling_idea_text" style="display:none;">
      </div>
      <div class="other_spelling_idea_text" style="display:none;">
      </div>
      <div class="other_spelling_error_check" style="display:none;">
      </div>
      <div class="other_creative_sentence" style="display:none;">
      </div>
      <div class="other_creative_sentence_match" style="display:none;">
      </div>
      <div class="creative_sentence_text" style="display:none;">
      </div>
      <div class="introduction_answer_paragraph" style="display:none;">
      </div>
      <div class="body_answer_paragraph" style="display:none;">
      </div>
      <div class="conclusion_sentense_paragraph" style="display:none;">
      </div>
    </div>

    <div class="col-md-5" style="border:1px solid gray;padding:5px;margin-left:3%;">
        <div class="main_student_idea">
          <div class="title_menu" style="display:none;">
            <div style="text-align:center;">
              <a class="btn btn-danger">Title</a>
            </div>
            <br>
            
            <div class="row">
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/poor_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Poor
                  <input type="radio" style="margin-left:5px;" name="st_mark" class="average_check student_marking" value="5"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control poor_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/average_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Average
                  <input type="radio" style="margin-left:5px;" name="st_mark" class="average_check student_marking" value="10"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control average_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/good_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Good
                  <input type="radio" style="margin-left:5px;" name="st_mark" class="good_check student_marking" value="15"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control good_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/excelent_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Excelent
                  <input type="radio" style="margin-left:5px;" name="st_mark" class="excelent_check student_marking" value="20"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control excelent_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
            </div>
            
            <br><br>
            <div class="text-center">
                <img src="assets/images/images/question_write.png" style="width: 35px;">
            </div>
            <div style="margin-top:30px;background-color:#f7f7f7;display:flex;justify-content:center;">
                <h5 style="">Your Point : </h5>
                <input type="text" class="form-control total_title_point" style="color:#2b2b2f;width:50px;height:30px;background-color:white;">
            </div>
            <br>
            <div style="text-align:center;">
              <a href="javascript:;" type="button" class="btn btn-primary title_submit" style="background-color:#bee131;color:#000;">Submit</a>
            </div>
              
          </div>

          <div class="spelling_error_menu" style="display:none">
            <div style="text-align:center;">
              <a class="btn btn-danger">Spelling Error</a>
            </div>
            <br><br>
            <div class="text-center">
                <img src="assets/images/images/question_write.png" style="width: 35px;">
            </div>
            <div style="margin-top:30px;display:flex;justify-content:center;">
                <h5 style="">Your Point : </h5>
                <input type="text" class="form-control total_splleing_error_point" style="color:#2b2b2f;width:50px;height:30px;background-color:white;">
            </div>
            <br>
            <br>
            <div style="text-align:center;">
              <a href="javascript:;" type="button" class="btn btn-primary spelling_error_save" style="background-color:#bee131;color:#000;display:none;">Save</a>
              <a href="javascript:;" type="button" class="btn btn-primary spelling_next" style="display:none;background-color:#bee131;color:#000;">Next</a>
            </div>
          </div>

          <div class="creative_sentence_show">
              <div style="text-align:center;">
                <a class="btn btn-danger">Creative Sentence</a>
              </div>
              <br><br>
              <div class="text-center">
                  <img src="assets/images/images/question_write.png" style="width: 35px;">
              </div>
              <div style="margin-top:30px;display:flex;justify-content:center;">
                  <h5>Your Point : </h5>
                  <input type="text" class="form-control total_creative_sentence_point" style="color:#2b2b2f;width:50px;height:30px;background-color:white;">
              </div>
              <br>
              <br>
              <div style="text-align:center;">
                  <a href="javascript:;" type="button" class="btn btn-primary creative_sentence_submit" style="background-color:#bee131;color:#000;">Save</a>
                  <a href="javascript:;" type="button" class="btn btn-primary creative_sentence_next" style="display:none;background-color:#bee131;color:#000;">Next</a>
              </div>

          </div>


          <div class="introduction_menu" style="display:none;">
            <div style="text-align:center;">
              <a class="btn btn-danger">Introduction</a>
            </div>
            <br>
            
            <div class="row">
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/poor_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Poor
                  <input type="radio" style="margin-left:5px;" name="st_mark" class="poor_check introduction_marking" value="5"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control st_ss_intro_poor_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/average_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Average
                  <input type="radio" style="margin-left:5px;" name="st_mark" class="average_check introduction_marking" value="10"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control st_ss_intro_average_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/good_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Good
                  <input type="radio" style="margin-left:5px;" name="st_mark" class="good_check introduction_marking" value="15"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control st_ss_intro_good_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/excelent_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Excelent
                  <input type="radio" style="margin-left:5px;" name="st_mark" class="excelent_check introduction_marking" value="20"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control st_ss_intro_excelent_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
            </div>
            <br><br>
            <div class="text-center">
                <img src="assets/images/images/question_write.png" style="width: 35px;">
            </div>
            <div style="margin-top:30px;background-color:#f7f7f7;display:flex;justify-content:center;">
                <h5 >Your Point : </h5>
                <input type="text" class="form-control total_introduction_point" style="color:#2b2b2f;width:50px;height:30px;background-color:white;">
            </div>
            <br>
            <div style="text-align:center;">
              <a href="javascript:;" type="button" class="btn btn-primary introduction_submit" style="background-color:#bee131;color:#000;">Submit</a>
            </div>
              
          </div>


          <div class="body_paragraph_menu" style="display:none;">
            <div style="text-align:center;">
              <a class="btn btn-danger">Body Paragraph</a>
            </div>
            <br>
            
            <div class="row">
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/poor_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Poor
                  <input type="radio" style="margin-left:5px;" name="st_body_para_mark" class="poor_check body_paragraph_marking" value="5"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control st_body_para_poor_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/average_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Average
                  <input type="radio" style="margin-left:5px;" name="st_body_para_mark" class="average_check body_paragraph_marking" value="10"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control st_body_para_average_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/good_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Good
                  <input type="radio" style="margin-left:5px;" name="st_body_para_mark" class="good_check body_paragraph_marking" value="15"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control st_body_para_good_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/excelent_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Excelent
                  <input type="radio" style="margin-left:5px;" name="st_body_para_mark" class="excelent_check body_paragraph_marking" value="20"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control st_body_para_excelent_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
            </div>
            <br><br>
            <div class="text-center">
                <img src="assets/images/images/question_write.png" style="width: 35px;">
            </div>
            <div style="margin-top:30px;background-color:#f7f7f7;display:flex;justify-content:center;">
                <h5 style="">Your Point : </h5>
                <input type="text" class="form-control total_body_paragraph_point" style="color:#2b2b2f;width:50px;height:30px;background-color:white;">
            </div>
            <br>
            <div style="text-align:center;">
              <a href="javascript:;" type="button" class="btn btn-primary body_paragraph_submit" style="background-color:#bee131;color:#000;">Submit</a>
            </div>
              
          </div>

          <div class="conclution_menu" style="display:none;">
            <div style="text-align:center;">
              <a class="btn btn-danger">Conclution</a>
            </div>
            <br>
            
            <div class="row">
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/poor_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Poor
                  <input type="radio" style="margin-left:5px;" name="st_mark" class="poor_check conclution_marking" value="5"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control st_ss_conclution_poor_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/average_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Average
                  <input type="radio" style="margin-left:5px;" name="st_mark" class="average_check conclution_marking" value="10"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control st_ss_conclution_average_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/good_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Good
                  <input type="radio" style="margin-left:5px;" name="st_mark" class="good_check conclution_marking" value="15"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control st_ss_conclution_good_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/excelent_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Excelent
                  <input type="radio" style="margin-left:5px;" name="st_mark" class="excelent_check conclution_marking" value="20"></p>
                  <div style="text-align:center;">
                      <input type="text" class="form-control st_ss_conclution_excelent_mark" style="color:#2b2b2f;width:50px;height:30px;background-color:white;margin-left:22px;">
                  </div>
                </div>
            </div>
            <br><br>
            <div class="text-center">
                <img src="assets/images/images/question_write.png" style="width: 35px;">
            </div>
            <div style="margin-top:30px;background-color:#f7f7f7;display:flex;justify-content:center;">
                <h5 style="">Your Point : </h5>
                <input type="text" class="form-control total_conclution_point" style="color:#2b2b2f;width:50px;height:30px;background-color:white;">
            </div>
            <br>
            <div style="text-align:center;">
              <a href="javascript:;" type="button" class="btn btn-primary conclution_submit" style="background-color:#bee131;color:#000;">Submit</a>
            </div>
              
          </div>

          <div class="total_get_point" style="margin-top:50px;display:none">
              <div style="background-color:#f7f7f7;display:flex;justify-content:center;margin:0px 75px;padding:20px 0px;">
                  <h5 style="">Your Total Point : </h5>
                  <!-- <input type="text" class="form-control total_conclution_point" style="color:#2b2b2f;width:50px;height:30px;background-color:white;"> -->
                  <a class="btn btn-danger total_correction_point" style="margin-left:10px;">00</a>
              </div>
              <br>
              <br>
              <div style="text-align:center;">
                <a href="javascript:;" type="button" class="btn btn-primary conclution_submit" style="background-color:#bee131;color:#000;">Submit</a>
              </div>
          </div>
        </div>

        <div class="others_student_idea">
            <div class="other_title_menu" style="display:none;padding: 5px;">
              <div style="border:1px solid #dbdbdb;padding:3px;font-weight:bold;">
                  <p>Do you think your story "Title" could have been better ? If it seems so which of these "Title" would you choose from bellow?</p>
              </div>
              <br>
              <div class="" style="display:flex;margin-top: 25px;">
                  <a type="button" class="title_set_option" data-id="1"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom"></span>
                  </label>
                  <div class="title_hint_parrent">
                      <textarea class="form-control title_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="1" data-id="2">Most of the student voted</textarea>
                      <!-- <textarea class="form-control title_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;"  data-id="1">Not Bad</textarea> -->
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="10">
                  </div>
              </div>
              <div class="" style="display:flex;margin-top: 25px;">
              <a type="button" class="title_set_option" data-id="2"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom "></span>
                  </label>
                  <div class="title_hint_parrent">
                      <textarea class="form-control title_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="2"  data-id="1">Not Bad</textarea>
                      <!-- <textarea class="form-control title_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;"  data-id="2">Most of the student voted</textarea> -->
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="20">
                  </div>
              </div>
              <div class="" style="display:flex;margin-top: 25px;">
              <a type="button" class="title_set_option" data-id="3"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom "></span>
                  </label>
                  <div class="title_hint_parrent">
                      <textarea class="form-control title_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="3" data-id="3">Very Closed</textarea>
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="15">
                  </div>
              </div>
              <div class="" style="display:flex;margin-top: 25px;">
                  <a type="button" class="title_set_option" data-id="4"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom "></span>
                  </label>
                  <div class="title_hint_parrent">
                      <textarea class="form-control title_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="4" data-id="4">Not Really Story</textarea>
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="0">
                  </div>
              </div>
              <div style="margin-top:30px;display:flex;gap:20px;">
                  <a href="javascript:;" type="button" class="btn btn-primary other_title_menu_save" style="background-color:#bee131;color:#000;">Save</a>
                  <a class="other_title_menu_preview" style="color: #00A2E8;margin-top: 3px;font-size: 20px;text-decoration: underline;cursor:pointer;display:none;">Preview</a>
              </div>
            </div>
            
            <div class="other_title_menu_preview_box" style="padding: 15px;display:none;">
                <p style="font-weight:bold;">Do you think your story "Title" could have been better ? If it seems so which of these "Title" would you choose from bellow?</p>

                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="hint_set_prev hint_set_prev1" class="title_opt_hint1"></span><i class="fa fa-share title_opt_hint_icon title_opt_hint_icon1" style="color:#ecd3b8;" aria-hidden="true"></i><span class="title_opt_prev1 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark1"></span>
                    </label>
                </div>
                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="hint_set_prev hint_set_prev2" class="title_opt_hint2"></span><i class="fa fa-share title_opt_hint_icon title_opt_hint_icon2" style="color:red;" aria-hidden="true"></i><span class="title_opt_prev2 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark2"></span>
                    </label>
                </div>
                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="hint_set_prev hint_set_prev3" class="title_opt_hint3"></span><i class="fa fa-share title_opt_hint_icon title_opt_hint_icon3" style="color:#00a2e8;" aria-hidden="true"></i><span class="title_opt_prev3 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark3"></span>
                    </label>
                </div>
                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="hint_set_prev hint_set_prev4" class="title_opt_hint4"></span><i class="fa fa-share title_opt_hint_icon title_opt_hint_icon4" style="color:#ecd3b8;" aria-hidden="true"></i><span class="title_opt_prev4 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark4"></span>
                    </label>
                </div>
                <div style="margin-top:30px;display:flex;gap:20px;">
                    <a href="javascript:;" type="button" class="btn btn-primary other_title_menu_submit" style="background-color:#bee131;color:#000;">Submit</a>
                    <a href="javascript:;" type="button" class="btn btn-primary other_title_menu_next" style="background-color:#bee131;color:#000;display:none;">Next</a>
                </div>
            </div>

            <div class="other_image_menu" style="padding: 5px;display:none;">
                <p style="font-weight:bold;">Which Photo best descrive for Linda story ?</p>
                <div class="row">
                    <div class="col-md-6" style="display:flex;">
                        <div>
                          <label class="custom_radio" style="margin-left: 4px;margin-top: 25px;">
                            <input type="radio" class="radio_ans" id="html" name="image_radio_option" value="1">
                            <span class="checkmark "></span>
                          </label>
                          
                          <a type="button" class="image_set_option" data-id="1"><img src="assets/images/question_write.png" style="width: 40px;height: 40px;margin-top: 30px;"></a>
                          <div style="height:30px;width:30px;border:1px solid #a9a8a8;margin-top: 7px;">
                              <select class="image_point" data-id="1" style="width: 28px;height: 28px;">
                                <option value=""></option>
                                <option value="0">0</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                              </select>
                          </div>
                        </div>
                        
                        <div class="image_box_1" style="border:5px solid #a9a8a8;margin: 10px 10px 10px 10px;width:185px;height: 150px;position:relative;">
                            <div class="upload_image_1" style="margin:10px">
                              <span style="text-decoration:underline;color:#7f7f7f;">Upload</span>
                              <input type="file" data-id="1" class="image_option option_1" style="position:absolute;top:0;left:0;opacity:0;" id="upload_option_image_1">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" style="display:flex;">
                        <div>
                          <label class="custom_radio" style="margin-left: 4px;margin-top: 25px;">
                            <input type="radio" class="radio_ans" id="html" name="image_radio_option" value="2">
                            <span class="checkmark "></span>
                          </label>
                          <a type="button" class="image_set_option" data-id="2"><img src="assets/images/question_write.png" style="width: 40px;height: 40px;margin-top: 30px;"></a>
                          
                          <div style="height:30px;width:30px;border:1px solid #a9a8a8;margin-top: 7px;">
                              <select class="image_point" data-id="2" style="width: 28px;height: 28px;">
                                <option value=""></option>
                                <option value="0">0</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                              </select>
                          </div>
                        </div>
                        
                        <div class="image_box_2" style="border:5px solid #a9a8a8;margin: 10px 10px 10px 10px;width:185px;height: 150px;position:relative;">
                            <div class="upload_image_1" style="margin:10px">
                              <span style="text-decoration:underline;color:#7f7f7f;">Upload</span>
                              <input type="file" data-id="2" class="image_option option_2" style="position:absolute;top:0;left:0;opacity:0;" id="upload_option_image_2">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" style="display:flex;">
                        <div>
                          <label class="custom_radio" style="margin-left: 4px;margin-top: 25px;">
                            <input type="radio" class="radio_ans" id="html" name="image_radio_option" value="3">
                            <span class="checkmark "></span>
                          </label>
                          <a type="button" class="image_set_option" data-id="3"><img src="assets/images/question_write.png" style="width: 40px;height: 40px;margin-top: 30px;"></a>
                          
                          <div style="height:30px;width:30px;border:1px solid #a9a8a8;margin-top: 7px;">
                              <select class="image_point" data-id="3" style="width: 28px;height: 28px;">
                                <option value=""></option>
                                <option value="0">0</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                              </select>
                            </div>
                        </div>
                        
                        <div class="image_box_3" style="border:5px solid #a9a8a8;margin: 10px 10px 10px 10px;width:185px;height: 150px;position:relative;">
                            <div class="upload_image_1" style="margin:10px">
                              <span style="text-decoration:underline;color:#7f7f7f;">Upload</span>
                              <input type="file" data-id="3" class="image_option option_3" style="position:absolute;top:0;left:0;opacity:0;" id="upload_option_image_3">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" style="display:flex;">
                        <div>
                          <label class="custom_radio" style="margin-left: 4px;margin-top: 25px;">
                            <input type="radio" class="radio_ans" id="html" name="image_radio_option" value="4">
                            <span class="checkmark "></span>
                          </label>
                          <a type="button" class="image_set_option" data-id="4"><img src="assets/images/question_write.png" style="width: 40px;height: 40px;margin-top: 30px;"></a>
                          
                          <div style="height:30px;width:30px;border:1px solid #a9a8a8;margin-top: 7px;">
                              <select class="image_point" data-id="4" style="width: 28px;height: 28px;">
                                <option value=""></option>
                                <option value="0">0</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                              </select>
                          </div>
                        </div>
                        
                        <div class="image_box_4" style="border:5px solid #a9a8a8;margin: 10px 10px 10px 10px;width:185px;height: 150px;position:relative;">
                            <div class="upload_image_1" style="margin:10px">
                              <span style="text-decoration:underline;color:#7f7f7f;">Upload</span>
                              <input type="file" data-id="4" class="image_option option_4" style="position:absolute;top:0;left:0;opacity:0;" id="upload_option_image_4">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                <div style="margin-top:30px;display:flex;gap:20px;">
                    <a href="javascript:;" type="button" class="btn btn-primary save_idea_options_image" style="background-color:#bee131;color:#000;">Save</a>
                    <a class="options_image_preview" style="color: #00A2E8;margin-top: 3px;font-size: 20px;text-decoration: underline;cursor:pointer;display:none;">Preview</a>
                </div>
                </div>
            </div>

            <div class="options_image_preview_show" style="display:none;">
                <div class="row">
                  <div class="col-md-6">
                      <div>
                          <label class="custom_radio" style="margin-left: 4px;margin-top: 25px;">
                            <input type="radio" class="image_radio_ans_match_1 match_image_radio_ans" data="1" id="html" name="image_radio_ans_match" value="1">
                            <span class="checkmark" style="top:30px;"></span>
                          </label>
                      </div>
                      <div class="show_image_box_1" style="border:5px solid #a9a8a8;margin: 10px 10px 10px 40px;width:185px;height: 150px;position:relative;">
                          <div class="upper_box"><p class="upper_box_text"></p><img class="upper_arrow" src="assets/images/down_arrow.png"></div>
                          <div class="image_box_show_1"></div>
                          
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div>
                          <label class="custom_radio" style="margin-left: 4px;margin-top: 25px;">
                            <input type="radio" class="image_radio_ans_match_2 match_image_radio_ans" data="2"  id="html" name="image_radio_ans_match" value="2">
                            <span class="checkmark" style="top:30px;"></span>
                          </label>
                      </div>
                      <div class="show_image_box_2" style="border:5px solid #a9a8a8;margin: 10px 10px 10px 40px;width:185px;height: 150px;position:relative;">
                           <div class="right_box"><p class="right_box_text"></p><img class="right_arrow" src="assets/images/down_arrow_blue.png"></div>
                           <div class="image_box_show_2"></div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div>
                          <label class="custom_radio" style="margin-left: 4px;margin-top: 25px;">
                            <input type="radio" class="image_radio_ans_match_3 match_image_radio_ans" data="3"  id="html" name="image_radio_ans_match" value="3">
                            <span class="checkmark" style="top:30px;"></span>
                          </label>
                      </div>
                      <div class="show_image_box_3" style="border:5px solid #a9a8a8;margin: 10px 10px 10px 40px;width:185px;height: 150px;position:relative;">
                        <div class="down_box"><p class="down_box_text"></p><img class="down_arrow" src="assets/images/down_arrow.png"></div>
                        <div class="image_box_show_3"></div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div>
                          <label class="custom_radio" style="margin-left: 4px;margin-top: 25px;">
                            <input type="radio" class="image_radio_ans_match_4 match_image_radio_ans" data="4"  id="html" name="image_radio_ans_match" value="4">
                            <span class="checkmark" style="top:30px;"></span>
                          </label>
                      </div>
                      <div class="show_image_box_4" style="border:5px solid #a9a8a8;margin: 10px 10px 10px 40px;width:185px;height: 150px;position:relative;">
                          <div class="left_box"><p class="left_box_text"></p><img class="left_arrow" src="assets/images/up_arrow.png"></div>
                          <div class="image_box_show_4"></div>
                      </div>
                  </div>
                </div>
                
                <br><br>
                <div style="margin-top:30px;display:flex;gap:20px;">
                    <a href="javascript:;" type="button" class="btn btn-primary match_idea_options_image" style="background-color:#bee131;color:#000;">submit</a>
                    <a href="javascript:;" type="button" class="btn btn-primary match_idea_options_image_next" style="background-color:#bee131;color:#000;display:none;">Next</a>
                </div>
                <br><br>
            </div>

            <div class="other_spelling_error_menu" style="padding:10px;display:none;">
              <div style="text-align:center;">
                <h6>Click and choose the words from Linda's story which was mis spelled.</h6>
              </div>
              <br>
              <br>
              <div class="other_spelling_error_words">
              </div>
              <br>
              <br>
              <div style="text-align:left;">
              <div style="display:flex;gap:10px;">
                <a href="javascript:;" type="button" class="btn btn-primary other_spelling_error_save" style="background-color:#bee131;color:#000;display:none;">Save</a>
                <a class="other_spelling_error_preview" style="color: #00A2E8;margin-top: 3px;font-size: 20px;text-decoration: underline;cursor:pointer;display:none;">Preview</a>
              </div>
                
                <a href="javascript:;" type="button" class="btn btn-primary other_spelling_error_submit" style="display:none;background-color:#bee131;color:#000;">Submit</a>
                <a href="javascript:;" type="button" class="btn btn-primary other_spelling_error_next" style="display:none;background-color:#bee131;color:#000;">Next</a>
              </div>
            </div>

            <div class="other_creative_sentence_menu" style="padding:10px;display:none;">
              <div style="text-align:center;">
                <h6>Click and choose 2 sentences from lina's story that represents mataphors Example of metaphor.</h6>
              </div>
              <br>
              <br>
              <div class="other_creative_sentence_show_box" style="min-height:100px;width:100%;border:1px solid #d2d2d2;padding:10px;">
              </div>
              <br>
              <br>
              <div style="text-align:left;">
              <div style="display:flex;gap:10px;">
                <a href="javascript:;" type="button" class="btn btn-primary other_creative_sentence_save" style="background-color:#bee131;color:#000;display:none;">Save</a>
                <a class="other_creative_sentence_preview" style="color: #00A2E8;margin-top: 3px;font-size: 20px;text-decoration: underline;cursor:pointer;display:none;">Preview</a>
              </div>
                
                <a href="javascript:;" type="button" class="btn btn-primary other_creative_sentence_submit" style="display:none;background-color:#bee131;color:#000;">Submit</a>
                <a href="javascript:;" type="button" class="btn btn-primary other_creative_sentence_next" style="display:none;background-color:#bee131;color:#000;">Next</a>
              </div>
            </div>

            <!-- Other Story Structure -->
            <!-- Introduction -->
            <div class="other_ss_introduction_menu" style="display:none;padding: 5px;">
              <div style="border:1px solid #dbdbdb;padding:3px;font-weight:bold;">
                  <p>Do you think your story "Introduction" could have been better ? If it seems so which of these "Paragraph" would you choose from bellow?</p>
              </div>
              <br>
              <div class="" style="display:flex;margin-top: 25px;">
                  <a type="button" class="set_option" data-id="1"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom"></span>
                  </label>
                  <div class="introduction_hint_parrent">
                      <textarea class="form-control introduction_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="1" data-id="2">Most of the student voted</textarea>
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="10">
                  </div>
              </div>
              <div class="" style="display:flex;margin-top: 25px;">
              <a type="button" class="set_option" data-id="2"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom "></span>
                  </label>
                  <div class="introduction_hint_parrent">
                      <textarea class="form-control introduction_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="2"  data-id="1">Not Bad</textarea>
                      <!-- <textarea class="form-control title_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;"  data-id="2">Most of the student voted</textarea> -->
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="20">
                  </div>
              </div>
              <div class="" style="display:flex;margin-top: 25px;">
              <a type="button" class="set_option" data-id="3"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom "></span>
                  </label>
                  <div class="introduction_hint_parrent">
                      <textarea class="form-control introduction_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="3" data-id="3">Very Closed</textarea>
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="15">
                  </div>
              </div>
              <div class="" style="display:flex;margin-top: 25px;">
                  <a type="button" class="set_option" data-id="4"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom "></span>
                  </label>
                  <div class="introduction_hint_parrent">
                      <textarea class="form-control introduction_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="4" data-id="4">Not Related Story</textarea>
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="0">
                  </div>
              </div>
              <div style="margin-top:30px;display:flex;gap:20px;">
                  <a href="javascript:;" type="button" class="btn btn-primary other_introduction_menu_save" style="background-color:#bee131;color:#000;">Save</a>
                  <a class="other_introduction_menu_preview" style="color: #00A2E8;margin-top: 3px;font-size: 20px;text-decoration: underline;cursor:pointer;display:none;">Preview</a>
              </div>
            </div>

            <div class="other_ss_introduction_menu_preview_box" style="padding: 15px;display:none;">
                <p style="font-weight:bold;">Do you think your story "Introduction" could have been better ? If it seems so which of these "Paragraph" would you choose from bellow?</p>

                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="intro_hint_set_prev intro_hint_set_prev1" class="intro_opt_hint1"></span><i class="fa fa-share intro_opt_hint_icon intro_opt_hint_icon1" style="color:#ecd3b8;" aria-hidden="true"></i><span class="intro_opt_prev1 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark1"></span>
                    </label>
                </div>
                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="intro_hint_set_prev intro_hint_set_prev2" class="intro_opt_hint2"></span><i class="fa fa-share intro_opt_hint_icon intro_opt_hint_icon2" style="color:red;" aria-hidden="true"></i><span class="intro_opt_prev2 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark2"></span>
                    </label>
                </div>
                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="intro_hint_set_prev intro_hint_set_prev3" class="intro_opt_hint3"></span><i class="fa fa-share intro_opt_hint_icon intro_opt_hint_icon3" style="color:#00a2e8;" aria-hidden="true"></i><span class="intro_opt_prev3 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark3"></span>
                    </label>
                </div>
                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="intro_hint_set_prev intro_hint_set_prev4" class="intro_opt_hint4"></span><i class="fa fa-share intro_opt_hint_icon intro_opt_hint_icon4" style="color:#ecd3b8;" aria-hidden="true"></i><span class="intro_opt_prev4 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark4"></span>
                    </label>
                </div>
                <div style="margin-top:30px;display:flex;gap:20px;">
                    <a href="javascript:;" type="button" class="btn btn-primary other_intro_menu_submit" style="background-color:#bee131;color:#000;">Submit</a>
                    <a href="javascript:;" type="button" class="btn btn-primary other_intro_menu_next" style="background-color:#bee131;color:#000;display:none;">Next</a>
                </div>
            </div>




            <div class="other_body_paragraph_menu" style="display:none;padding: 5px;">
              <div style="border:1px solid #dbdbdb;padding:3px;font-weight:bold;">
                  <p>Do you think your story "Body Paragraph" could have been better ? If it seems so which of these "Paragraph" would you choose from bellow?</p>
              </div>
              <br>
              <div class="" style="display:flex;margin-top: 25px;">
                  <a type="button" class="body_para_set_option" data-id="1"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom"></span>
                  </label>
                  <div class="body_paragraph_hint_parrent">
                      <textarea class="form-control body_paragraph_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="1" data-id="2">Most of the student voted</textarea>
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="10">
                  </div>
              </div>
              <div class="" style="display:flex;margin-top: 25px;">
              <a type="button" class="body_para_set_option" data-id="2"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom "></span>
                  </label>
                  <div class="body_paragraph_hint_parrent">
                      <textarea class="form-control body_paragraph_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="2"  data-id="1">Not Bad</textarea>
                      <!-- <textarea class="form-control title_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;"  data-id="2">Most of the student voted</textarea> -->
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="20">
                  </div>
              </div>
              <div class="" style="display:flex;margin-top: 25px;">
              <a type="button" class="body_para_set_option" data-id="3"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom "></span>
                  </label>
                  <div class="body_paragraph_hint_parrent">
                      <textarea class="form-control body_paragraph_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="3" data-id="3">Very Closed</textarea>
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="15">
                  </div>
              </div>
              <div class="" style="display:flex;margin-top: 25px;">
                  <a type="button" class="body_para_set_option" data-id="4"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom "></span>
                  </label>
                  <div class="body_paragraph_hint_parrent">
                      <textarea class="form-control body_paragraph_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="4" data-id="4">Not Related Story</textarea>
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="0">
                  </div>
              </div>
              <div style="margin-top:30px;display:flex;gap:20px;">
                  <a href="javascript:;" type="button" class="btn btn-primary other_body_paragraph_menu_save" style="background-color:#bee131;color:#000;">Save</a>
                  <a class="other_body_paragraph_menu_preview" style="color: #00A2E8;margin-top: 3px;font-size: 20px;text-decoration: underline;cursor:pointer;display:none;">Preview</a>
              </div>
            </div>

            <div class="other_body_paragraph_menu_preview_box" style="padding: 15px;display:none;">
                <p style="font-weight:bold;">Do you think your story "Introduction" could have been better ? If it seems so which of these "Paragraph" would you choose from bellow?</p>

                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="body_paragraph_hint_set_prev body_paragraph_hint_set_prev1" class="body_paragraph_opt_hint1"></span><i class="fa fa-share body_paragraph_opt_hint_icon body_paragraph_opt_hint_icon1" style="color:#ecd3b8;" aria-hidden="true"></i><span class="body_paragraph_opt_prev1 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark1"></span>
                    </label>
                </div>
                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="body_paragraph_hint_set_prev body_paragraph_hint_set_prev2" class="body_paragraph_opt_hint2"></span><i class="fa fa-share body_paragraph_opt_hint_icon body_paragraph_opt_hint_icon2" style="color:red;" aria-hidden="true"></i><span class="body_paragraph_opt_prev2 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark2"></span>
                    </label>
                </div>
                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="body_paragraph_hint_set_prev body_paragraph_hint_set_prev3" class="body_paragraph_opt_hint3"></span><i class="fa fa-share body_paragraph_opt_hint_icon body_paragraph_opt_hint_icon3" style="color:#00a2e8;" aria-hidden="true"></i><span class="body_paragraph_opt_prev3 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark3"></span>
                    </label>
                </div>
                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="body_paragraph_hint_set_prev body_paragraph_hint_set_prev4" class="body_paragraph_opt_hint4"></span><i class="fa fa-share body_paragraph_opt_hint_icon body_paragraph_opt_hint_icon4" style="color:#ecd3b8;" aria-hidden="true"></i><span class="body_paragraph_opt_prev4 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark4"></span>
                    </label>
                </div>
                <div style="margin-top:30px;display:flex;gap:20px;">
                    <a href="javascript:;" type="button" class="btn btn-primary other_body_paragraph_menu_submit" style="background-color:#bee131;color:#000;">Submit</a>
                    <a href="javascript:;" type="button" class="btn btn-primary other_body_paragraph_menu_next" style="background-color:#bee131;color:#000;display:none;">Next</a>
                </div>
            </div>



            <div class="other_ss_conclution_menu" style="display:none;padding: 5px;">
              <div style="border:1px solid #dbdbdb;padding:3px;font-weight:bold;">
                  <p>Do you think your story "Conclusion" could have been better ? If it seems so which of these "Paragraph" would you choose from bellow?</p>
              </div>
              <br>
              <div class="" style="display:flex;margin-top: 25px;">
                  <a type="button" class="ss_conclution_set_option" data-id="1"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom"></span>
                  </label>
                  <div class="ss_conclution_hint_parrent">
                      <textarea class="form-control ss_conclution_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="1" data-id="2">Most of the student voted</textarea>
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="10">
                  </div>
              </div>
              <div class="" style="display:flex;margin-top: 25px;">
              <a type="button" class="ss_conclution_set_option" data-id="2"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom "></span>
                  </label>
                  <div class="ss_conclution_hint_parrent">
                      <textarea class="form-control ss_conclution_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="2"  data-id="1">Not Bad</textarea>
                      <!-- <textarea class="form-control title_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;"  data-id="2">Most of the student voted</textarea> -->
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="20">
                  </div>
              </div>
              <div class="" style="display:flex;margin-top: 25px;">
              <a type="button" class="ss_conclution_set_option" data-id="3"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom "></span>
                  </label>
                  <div class="ss_conclution_hint_parrent">
                      <textarea class="form-control ss_conclution_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="3" data-id="3">Very Closed</textarea>
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="15">
                  </div>
              </div>
              <div class="" style="display:flex;margin-top: 25px;">
                  <a type="button" class="ss_conclution_set_option" data-id="4"><img src="assets/images/question_write.png" style="width:50px;height: 50px;"></a>
                  <label class="custom_radio_custom">
                      <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2" checked>
                      <span class="checkmark_custom "></span>
                  </label>
                  <div class="ss_conclution_hint_parrent">
                      <textarea class="form-control ss_conclution_hint_sort" style="width: 330px;color: #9d9a9a;font-weight:bold;" data-index="4" data-id="4">Not Related Story</textarea>
                  </div>
                  <div style="position:relative;">
                    <span style="position: absolute;color: #9d9a9a;margin-top: -20px;margin-left: 20px;">Point</span>
                    <input type="text" class="form-control" style="width:50px;margin-left: 15px;height: 55px;font-weight:bold;" value="0">
                  </div>
              </div>
              <div style="margin-top:30px;display:flex;gap:20px;">
                  <a href="javascript:;" type="button" class="btn btn-primary other_ss_conclution_menu_save" style="background-color:#bee131;color:#000;">Save</a>
                  <a class="other_ss_conclution_menu_preview" style="color: #00A2E8;margin-top: 3px;font-size: 20px;text-decoration: underline;cursor:pointer;display:none;">Preview</a>
              </div>
            </div>

            <div class="other_ss_conclution_menu_preview_box" style="padding: 15px;display:none;">
                <p style="font-weight:bold;">Do you think your story "Introduction" could have been better ? If it seems so which of these "Paragraph" would you choose from bellow?</p>

                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="ss_conclution_hint_set_prev ss_conclution_hint_set_prev1" class="ss_conclution_opt_hint1"></span><i class="fa fa-share ss_conclution_opt_hint_icon ss_conclution_opt_hint_icon1" style="color:#ecd3b8;" aria-hidden="true"></i><span class="ss_conclution_opt_prev1 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark1"></span>
                    </label>
                </div>
                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="ss_conclution_hint_set_prev ss_conclution_hint_set_prev2" class="ss_conclution_opt_hint2"></span><i class="fa fa-share ss_conclution_opt_hint_icon ss_conclution_opt_hint_icon2" style="color:red;" aria-hidden="true"></i><span class="ss_conclution_opt_prev2 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark2"></span>
                    </label>
                </div>
                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="ss_conclution_hint_set_prev ss_conclution_hint_set_prev3" class="ss_conclution_opt_hint3"></span><i class="fa fa-share ss_conclution_opt_hint_icon ss_conclution_opt_hint_icon3" style="color:#00a2e8;" aria-hidden="true"></i><span class="ss_conclution_opt_prev3 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark3"></span>
                    </label>
                </div>
                <div style="margin-top: 15px;margin-left: 10px;">
                    <label class="custom_radio"><span class="ss_conclution_hint_set_prev ss_conclution_hint_set_prev4" class="ss_conclution_opt_hint4"></span><i class="fa fa-share ss_conclution_opt_hint_icon ss_conclution_opt_hint_icon4" style="color:#ecd3b8;" aria-hidden="true"></i><span class="ss_conclution_opt_prev4 all_options"></span>
                      <input type="radio" class="radio_ans" id="html" name="radio_ans1" value="2">
                      <span class="checkmark checkmark4"></span>
                    </label>
                </div>
                <div style="margin-top:30px;display:flex;gap:20px;">
                    <a href="javascript:;" type="button" class="btn btn-primary other_ss_conclution_menu_submit" style="background-color:#bee131;color:#000;">Submit</a>
                    <a href="javascript:;" type="button" class="btn btn-primary other_ss_conclution_menu_next" style="background-color:#bee131;color:#000;display:none;">Next</a>
                </div>
            </div>
        </div>

        
          

      
    </div>
  </div>
</div>

<!-- modal user_checks -->
<div class="modal fade ss_modal" id="manual_comment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <!-- Modal -->
  <div style="max-width: 100%;margin-top:8%;" class="modal-dialog idea_box" role="document">
    <div class="modal-content">
      <div class="modal-body" style="background-color: #00A2E8;">
        <div style="position:relative;">
          <h6 style="text-align:center;"> Teacher Comment </h6>
          <button style="color:black;border:none;position:absolute;right:10px;top:1px;" type="button" class="close_ch close_large_question" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="row">
          <textarea id="large_ques_body" class="form-control mytextarea" name="large_ques_body"></textarea>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn large_question_close" id="save_manual_comment">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Success Modal -->
<div class="modal fade ss_modal" id="ss_sucess_mess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <img src="assets/images/icon_info.png" class="pull-left"> <span class="status_message">Save Sucessfully</span>
      </div>
      <div class="modal-footer">
        <a href="<?= base_url()?>/tutor" class="btn btn_blue" id="save_success_button_with_url">Ok</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal ew_ss_modal" id="image_options_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Option Description </h4>
      </div>
      <div class="modal-body" id="option_inputs">
        <textarea data-id="1" class="form-control image_option_all image_option_description1" name="options[]"></textarea>
        <textarea data-id="2" class="form-control image_option_all image_option_description2" name="options[]"></textarea>
        <textarea data-id="3" class="form-control image_option_all image_option_description3" name="options[]"></textarea>
        <textarea data-id="4" class="form-control image_option_all image_option_description4" name="options[]"></textarea>

      </div>
      <div class="modal-footer option_footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal ew_ss_modal" id="title_options_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Option Description </h4>
      </div>
      <div class="modal-body" id="option_inputs">
        <textarea data-id="1" class="form-control option_all option_description1" name="options[]"></textarea>
        <textarea data-id="2" class="form-control option_all option_description2" name="options[]"></textarea>
        <textarea data-id="3" class="form-control option_all option_description3" name="options[]"></textarea>
        <textarea data-id="4" class="form-control option_all option_description4" name="options[]"></textarea>

      </div>
      <div class="modal-footer option_footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade ss_modal ew_ss_modal" id="intro_options_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Option Description </h4>
      </div>
      <div class="modal-body" id="option_inputs">
        <textarea data-id="1" class="form-control ss_intro_option_all ss_intro_option_description1" name="options[]"></textarea>
        <textarea data-id="2" class="form-control ss_intro_option_all ss_intro_option_description2" name="options[]"></textarea>
        <textarea data-id="3" class="form-control ss_intro_option_all ss_intro_option_description3" name="options[]"></textarea>
        <textarea data-id="4" class="form-control ss_intro_option_all ss_intro_option_description4" name="options[]"></textarea>

      </div>
      <div class="modal-footer option_footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal ew_ss_modal" id="body_paragraph_options_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Option Description </h4>
      </div>
      <div class="modal-body" id="option_inputs">
        <textarea data-id="1" class="form-control body_para_option_all body_para_option_description1" name="options[]"></textarea>
        <textarea data-id="2" class="form-control body_para_option_all body_para_option_description2" name="options[]"></textarea>
        <textarea data-id="3" class="form-control body_para_option_all body_para_option_description3" name="options[]"></textarea>
        <textarea data-id="4" class="form-control body_para_option_all body_para_option_description4" name="options[]"></textarea>

      </div>
      <div class="modal-footer option_footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal ew_ss_modal" id="body_ss_conclution_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Option Description </h4>
      </div>
      <div class="modal-body" id="option_inputs">
        <textarea data-id="1" class="form-control ss_conclution_option_all ss_conclution_option_description1" name="options[]"></textarea>
        <textarea data-id="2" class="form-control ss_conclution_option_all ss_conclution_option_description2" name="options[]"></textarea>
        <textarea data-id="3" class="form-control ss_conclution_option_all ss_conclution_option_description3" name="options[]"></textarea>
        <textarea data-id="4" class="form-control ss_conclution_option_all ss_conclution_option_description4" name="options[]"></textarea>
      </div>
      <div class="modal-footer option_footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>

</div>
<div id="make_student_idea_title" style="display:none;">

</div>

<script>

  $('.introduction_button').hide();
  $('.body_paragraph_button').hide();
  $('.ss_conclution_button').hide();
  $('.conclution_button').hide();
  $('.total_get_point').hide();
  $('.hint_set_prev').hide();
  $('.intro_hint_set_prev').hide();
  $('.title_opt_hint_icon').hide();
  $('.intro_opt_hint_icon').hide();
  $('.body_paragraph_hint_set_prev').hide();
  $('.body_paragraph_opt_hint_icon').hide();
  $('.ss_conclution_hint_set_prev').hide();
  $('.ss_conclution_opt_hint_icon').hide();

  $(document).ready(function() {

    var get_student_ans = `<?=$student_idea[0]['idea_ans']?>`;
    $('#make_student_idea_title').html(get_student_ans);
    $('#make_student_idea_title').find('p:first').remove();
    var get_idea_title = $("#make_student_idea_title").find("p:first").text();
    // alert(get_idea_title);
    $('.set_student_title').text(get_idea_title);

    call_tutor_idea_question();

    $('.title_button').click(function() {
      $('.student_idea_text').attr('style', 'display:block;');
      $('.spelling_idea_text').attr('style', 'display:none;');
      $('.creative_sentence_text').attr('style', 'display:none;');
      $('.creative_sentence_show').attr('style', 'display:none;');
      $('.title_button').attr('style', 'background-color:#00A2E8');
      $('.title_menu').attr('style', 'display:block;margin-top:10px');
      $('.spelling_submit').hide();
      $('.story_structure_show').attr('style', 'display:none;');
      $('.ans_submit').click(function() {
        // alert('hello');
        var is_empty = 0;
        var std_val = 0;
        var std_check_val = 0;
        $(".radio_ans").each(function() {
          if ($(this).is(":checked")) {
            is_empty = 1;
            std_val = $(this).val();
          }
        });
        if (is_empty == 0) {
          alert("please checked one of them");
          return false;
        } else {

          $('.auto_comment_button').attr('style', 'background-color:#00A2E8;color:#fff');
          $('.title_mark').attr('style', 'display:block');
          var total_title_mark;
          if (std_val == 1) {
            total_title_mark = 0;
            $('.title_mark').html(total_title_mark);
            $('.with_option').attr('style', 'display:none');
            // return false;
          } else if (std_val == 2) {
            total_title_mark = 0;
            $('.title_mark').html(total_title_mark);
            $('.with_option').attr('style', 'display:none');
            // return false;
          } else if (std_val == 3) {
            total_title_mark = 20;
            $('.title_mark').html(total_title_mark);
            $('.with_option').attr('style', 'display:none');
          }

          $('#total_title_mark').val(total_title_mark);
          $('#title_comment').val(std_val);
        }

      });

    });

    // $('textarea').spellAsYouType(defaultDictionary:'Espanol',checkGrammar:true);

    $('.auto_comment_button').click(function() {
      $('.with_option').attr('style', 'display:block');
    });
    $('.manual_comment_button').click(function() {
      $('.auto_comment_button').attr('style', 'background-color:#00A2E8;color:#fff');
      $('#manual_comment_modal').modal('show');
    });
    $('#save_manual_comment').click(function() {
      $('.title_mark').attr('style', 'display:block');
      $('.title_menu').attr('style', 'display:none');
      $('#manual_comment_modal').modal('hide');
    });

  });

  function call_tutor_idea_question(param) {

    var tutor_ans = $('.student_idea_text').html();
    // console.log(tutor_ans);
    // alert(tutor_ans);
    /*===========new code=================*/
    if (tutor_ans != '') {
      var get_sentences = tutor_ans.match(/<p>([^\<]*?)<\/p>/g);
      // var get_sentences = new_sentense.slice(1);
      var sentences = new Array();
      var all_answer = '';
      var spelling_answer = '';
      var other_spelling_answer = '';
      var other_spelling_answer_match = '';
      var all_sentense_answer = '';
      var other_creative_sentence = '';
      var other_creative_sentence_match = '';
      var all_introduction_answer = '';
      var all_body_answer='';
      var all_conclusion_answer='';
      var all_input = '';
      var html = '';
      var html2 = '<button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>';
      var abc_arr = new Array();
      var sentense_store = new Array();

      for (var i = 0; i < get_sentences.length; i++) {

        var get_sentence = get_sentences[i].replace(/<[\/]{0,1}(p)[^><]*>/ig, "");
        var new_get_word = get_sentence.split(" ");
        var get_new_sentense = get_sentence.split(".");

        //for word----------------
        var j;
        for (j = 0; j < new_get_word.length; j++) {
          abc_arr.push(new_get_word[j]);
        }

        //for sentense----------------
        var m;
        for (m = 0; m < get_new_sentense.length; m++) {
          sentense_store.push(get_new_sentense[m]);
        }

        var index = i + 1;

        all_input += '<input type="hidden" name="option[]" value="' + get_sentence + '">';
        sentences.push(get_sentence);

        html += '<textarea class="form-control hint_textarea hint_textarea_no' + index + '" data-id="' + index + '" name="hint_text[]">' + get_sentence + '</textarea>';
        html2 += '<button type="button" class="btn btn_blue hint_save_button hint_save_button_no' + index + '" data-dismiss="modal" data-id ="' + index + '">Save</button>';
      }
      //alert(sentense_store);
      spelling_answer += '<p class="grammer_class_remove" style="display: flex;flex-wrap: wrap; gap:3px">';
      var k;
      for (k = 0; k < abc_arr.length; k++) {
        spelling_answer += '<span class="one_hint_wrap grammer_answer grammer_ans' + k + '" data-id="' + k + '">' + abc_arr[k] + '</span>';
      }
      spelling_answer += '</p>';

      other_spelling_answer += '<p class="other_spelling_error_new" style="display: flex;flex-wrap: wrap; gap:3px">';
      var k;
      for (k = 0; k < abc_arr.length; k++) {
        other_spelling_answer += '<span class="one_hint_wrap other_spelling other_spelling' + k + '" data-id="' + k + '">' + abc_arr[k] + '</span>';
      }
      other_spelling_answer += '</p>';


      other_spelling_answer_match += '<p class="other_spelling_error_new_match" style="display: flex;flex-wrap: wrap; gap:3px">';
      var k;
      for (k = 0; k < abc_arr.length; k++) {
        other_spelling_answer_match += '<span class="one_hint_wrap other_spelling_match other_spelling_match' + k + '" data-id="' + k + '">' + abc_arr[k] + '</span>';
      }
      other_spelling_answer_match += '</p>';


      all_answer += '<p class="grammer_class_remove" style="display: flex;flex-wrap: wrap; gap:3px">';
      var k;
      for (k = 0; k < abc_arr.length; k++) {
        all_answer += '<span class="one_hint_wrap" data-id="' + k + '">' + abc_arr[k] + '</span>';
      }
      all_answer += '</p>';

      //For Creative Sentence Part----------
      all_sentense_answer += '<p class="grammer_class_remove_new" style="flex-wrap: wrap; gap:3px">';
      var n;
      //console.log(get_new_sentense.length);
      for (n = 0; n < sentense_store.length - 1; n++) {

        all_sentense_answer += '<span class="one_hint_wrap grammer_answer_new grammer_ans_new' + n + '" data-id="' + n + '">' + sentense_store[n] + '.</span>';
      }
      all_sentense_answer += '</p>';

      //For Other Creative Sentence Part----------
      other_creative_sentence += '<p class="other_creative_sentence_box" style="flex-wrap: wrap; gap:3px">';
      var n;
      for (n = 0; n < sentense_store.length - 1; n++) {
        other_creative_sentence += '<span class="one_hint_wrap other_creative other_creative' + n + '" data-id="' + n + '">' + sentense_store[n] + '.</span>';
      }
      other_creative_sentence += '</p>';

      //For Other Creative Sentence match Part----------
      other_creative_sentence_match += '<p class="other_creative_sentence_match_box" style="flex-wrap: wrap; gap:3px">';
      var n;
      for (n = 0; n < sentense_store.length - 1; n++) {
        other_creative_sentence_match += '<span class="one_hint_wrap other_creative_match other_creative_match' + n + '" data-id="' + n + '">' + sentense_store[n] + '.</span>';
      }
      other_creative_sentence_match += '</p>';

      //For Introduction Part----------
      all_introduction_answer += '<p class="grammer_class_remove_introduction" style="flex-wrap: wrap; gap:3px">';
      var n;

      //console.log(get_new_sentense.length);
      for (n = 0; n < sentense_store.length; n++) {

        all_introduction_answer += '<span class="one_hint_wrap grammer_answer_introduction grammer_ans_introduction' + n + '" data-id="' + n + '">' + sentense_store[n] + '.</span>';
      }
      all_introduction_answer += '</p>';

      //ALl body_paragraph_answer-----------------
      all_body_answer += '<p class="grammer_class_remove_body" style="flex-wrap: wrap; gap:3px">';
      var n;
      for (n = 0; n < sentense_store.length; n++) {

          all_body_answer += '<span class="one_hint_wrap grammer_answer_body grammer_ans_body' + n + '" data-id="' + n + '">' + sentense_store[n] + '.</span>';
      }
      all_body_answer += '</p>';

      //For Concluson Part----------
      all_conclusion_answer += '<p class="grammer_class_remove_news" style="flex-wrap: wrap; gap:3px">';
      var n;
      //console.log(get_new_sentense.length);
      for (n = 0; n < sentense_store.length; n++) {

          all_conclusion_answer += '<span class="one_hint_wrap grammer_answer_news grammer_ans_news' + n + '" data-id="' + n + '">' + sentense_store[n] + '.</span>';
      }
      all_conclusion_answer += '</p>';

      // console.log(get_sentences);
      $('.student_idea_text').html(all_answer);
      $('.spelling_idea_text').html(spelling_answer);
      $('.other_spelling_idea_text').html(other_spelling_answer);
      $('.other_spelling_error_check').html(other_spelling_answer_match);
      $('.creative_sentence_text').html(all_sentense_answer);
      $('.other_creative_sentence').html(other_creative_sentence);
      $('.other_creative_sentence_match').html(other_creative_sentence_match);
      $('.introduction_answer_paragraph').html(all_introduction_answer);
      $('.body_answer_paragraph').html(all_body_answer);
      $('.conclusion_sentense_paragraph').html(all_conclusion_answer);

      $('#all_option_input').html(all_input);
      $('.hint_text_modal_body').html(html);
      $('.hint_text_modal_footer').html(html2);

    } else {
      alert('First You need to write Writing input');
    }

    /*===========new code=================*/

    //$("#profile_image").attr('src', '<?php echo base_url(); ?>assets/uploads//profile/thumbnail/' + profile_image);
    // $("#submited_ans_view_student_id").val(idea_info.student_id);
    // //$(".blue").text('"'+idea_information.idea_title+'"');
    // $("#submited_ans_idea_no").val(idea_info.idea_no);

    // $(".student_ans_modal").html(student_ans);
    // $(".student_name").html(student_name);
    // $("#show_question_idea").modal("show");
    // $("#student_info").html(student_info);


  }

  //story_body_paragraph----------------------
  $('.story_conclusion').click(function(e){
      $(this).attr('style', 'background-color:#00A2E8;color:#fff;margin-bottom:10px;width:123px;');
      $('.conclusion_sentense_paragraph').attr('style','display:block;');
      $('.conclusion_auto_comment').attr('style','display:block;');
      $('.student_idea_text').attr('style','display:none;');
      $('.introduction_answer_paragraph').attr('style','display:none;');
      $('.body_answer_paragraph').attr('style','display:none;');
      $('.introduction_auto_comment').attr('style','display:none;');
      $('.body_paragraph_auto_comment').attr('style','display:none;'); 
  });



  $('.save_all_info').click(function(e){
      // teacher_given_idea_point 01740350264
      var data=$("#given_idea_point").serialize();

      $.ajax({
        url: "Tutor/teacher_idea_correction_save",
        method: "POST",
        enctype: 'multipart/form-data',
        data: data,
        cache: false,
        dataType: 'json',
        success: function(data) {
          var message = data.success;
          var status = data.status;
          $('.status_message').text(message);
          $("#ss_sucess_mess").modal('show');
        }
      });
  });


  $('.standard_button').click(function(){
     $('.standard_selected_box').show();
     $('.standard_special_box').hide();
     $('.standard_marking_box').show();
  });

  $('.student_marking').click(function(){
    var get_mark = $(this).val();
    $('.total_title_point').val(get_mark);
    if(get_mark==5){
      $('.poor_mark').val(get_mark);
      $('.average_mark').val('');
      $('.good_mark').val('');
      $('.excelent_mark').val('');
    }else if(get_mark==10){
      $('.poor_mark').val('');
      $('.average_mark').val(get_mark);
      $('.good_mark').val('');
      $('.excelent_mark').val('');
    }else if(get_mark==15){
      $('.poor_mark').val('');
      $('.average_mark').val('');
      $('.good_mark').val(get_mark);
      $('.excelent_mark').val('');
    }else if(get_mark==20){
      $('.poor_mark').val('');
      $('.average_mark').val('');
      $('.good_mark').val('');
      $('.excelent_mark').val(get_mark);
    }
  });
  $('.title_submit').click(function(){
    var title_mark = $('.total_title_point').val();
    if(title_mark != ''){
      if(title_mark==5){
        var title_index = 1;
      }else if(title_mark==10){
        var title_index = 2;
      }else if(title_mark==15){
        var title_index = 3;
      }else if(title_mark==20){
        var title_index = 4;
      }
      $('#title_comment').val(title_index);
      $('#total_title_mark').val(title_mark);
      $('.title_menu').hide();
    }else{
       alert('Please select at least one item !');
    }
  });

  $('.spelling_error').click(function() {
    $('.spelling_error_menu').show();
    $('.spelling_error_save').show();
    $('.total_splleing_error_point').val();


    $('.student_idea_text').attr('style', 'display:none;');
    $('.spelling_idea_text').attr('style', 'display:block;');
    $('.creative_sentence_text').attr('style', 'display:none;');
    $('.creative_sentence_show').attr('style', 'display:none;');
    $('.title_menu').hide();
    $('.with_option').hide();
    $('.spelling_next').hide();
    $(this).attr('style', 'background-color:#00A2E8;color:#fff');
    $('.story_structure_show').attr('style', 'display:none;');
  });

  $(document).delegate('.grammer_answer', 'click', function() {
    var text = $(this).attr('data-id');

    var checkStyle = $(this).attr('style');
    if (checkStyle != undefined) {
      // $(this).removeAttr('style');
      // $('.grammer_ans' + text).find('.spelling_prepend').remove();
    } else {
      $('.grammer_ans' + text).attr('style', 'background-color: rgb(255, 201, 14); position: relative;');
      $('.grammer_ans' + text).prepend('<input class="spelling_prepend" wordindex="' + text + '" style="margin-top: -42px;margin-left: -32px;color: #000;position: absolute;width: 106px;height: 35px;background-color: #FFFFFF;border: 1px solid #C5EB4E;" value="">');
    }
  });

  
  $(document).delegate('.other_spelling', 'click', function() {
    var text = $(this).attr('data-id');
    
    var checkStyle = $(this).attr('style');
    if (checkStyle != undefined) {
      // $(this).removeAttr('style');
      // $('.grammer_ans' + text).find('.spelling_prepend').remove();
    } else {
      $('.other_spelling' + text).attr('style', 'background-color: rgb(255, 201, 14); position: relative;');
      $('.other_spelling' + text).prepend('<input class="other_spelling_prepend" wordindex="' + text + '" style="margin-top: -42px;margin-left: -32px;color: #000;position: absolute;width: 106px;height: 35px;background-color: #FFFFFF;border: 1px solid #C5EB4E;" value="">');
    }
  });

  var get_matching_words = new Array();
  $(document).delegate('.other_spelling_match', 'click', function() {
    var text = $(this).attr('data-id');
    get_matching_words.push(text);
    var ans_matching_words = JSON.stringify(get_matching_words);
    $('.get_matching_ans_word').val(ans_matching_words);
    var get_word = $('.other_spelling_match' + text).text();
    var word_no = $('.spelling_error_words').length;
    var word_no = word_no+1;
    var words = '<p style="position:relative;margin-top: 15px;" class="spelling_error_words spelling_error_words'+text+'"><i class="fa fa-close spell_word_wrong'+text+'" style="font-size:24px;color:red;position:absolute; top: -17px;left: 25px;display:none;"></i><i class="fa fa-check spell_word_right'+text+'" style="font-size:24px;color:green;position:absolute;top: -17px;left: 25px;display:none;"></i><span>'+word_no+'.</span>'+get_word+'<span id="correction_info'+text+'"></span></p>';
    $('.other_spelling_error_words').append(words);

    var checkStyle = $(this).attr('style');
    if (checkStyle != undefined) {
      
    } else {
      $('.other_spelling_match' + text).attr('style', 'background-color: rgb(255, 201, 14); position: relative;');
      // $('.other_spelling_match' + text).prepend('<input class="other_spelling_prepend" wordindex="' + text + '" style="margin-top: -42px;margin-left: -32px;color: #000;position: absolute;width: 106px;height: 35px;background-color: #FFFFFF;border: 1px solid #C5EB4E;" value="">');
    }
  });

  $(document).delegate('.spelling_error_save', 'click', function() {
      $(this).hide();
      $('.spelling_next').show();
      var spellings = [];
      
      $(".spelling_prepend").each(function() {
        
        spellings.push({
          'word_index': $(this).attr('wordindex'),
          'correct_words': $(this).val()
        });
      });

      var spelling_mistake_no = $(".spelling_prepend").length;
      // alert(spelling_mistake_no);

      var spelling_error_mark = 20;
      if(spelling_mistake_no==1){
        spelling_error_mark = 17;
      }else if(spelling_mistake_no==2){
        spelling_error_mark = 14;
      }else if(spelling_mistake_no==3){
        spelling_error_mark = 11;
      }else if(spelling_mistake_no==4){
        spelling_error_mark = 8;
      }else if(spelling_mistake_no==5){
        spelling_error_mark = 5;
      }else if(spelling_mistake_no>=6){
        spelling_error_mark = 2;
      }

      $(".spelling_error_mark").html(spelling_error_mark);
      $('.total_splleing_error_point').val(spelling_error_mark);
      // $('.spelling_error_mark').attr('style', 'display:block');

      var spelling_text = JSON.stringify(spellings);

      $(".spelling_error_value").val(spelling_text);
      $('#total_spelling_mark').val(spelling_error_mark);
  });

  

  $(document).delegate('.other_spelling_error_save', 'click', function() {
      // $(this).hide();
      $('.other_spelling_error_preview').show();
      var other_spellings = [];
      var other_spelling_ques_words = new Array();
      $(".other_spelling_prepend").each(function() {
        other_spelling_ques_words.push($(this).attr('wordindex'));
        other_spellings.push({
          'word_index': $(this).attr('wordindex'),
          'correct_words': $(this).val()
        });
      });



      var spelling_mistake_no = $(".other_spelling_prepend").length;
      // alert(spelling_mistake_no);

      var spelling_error_mark = 20;
      if(spelling_mistake_no==1){
        spelling_error_mark = 15;
      }else if(spelling_mistake_no==2){
        spelling_error_mark = 10;
      }else if(spelling_mistake_no==3){
        spelling_error_mark = 5;
      }else if(spelling_mistake_no>=4){
        spelling_error_mark = 0;
      }

      // $(".spelling_error_mark").html(spelling_error_mark);
      //$('.total_splleing_error_point').val(spelling_error_mark);
      // $('.spelling_error_mark').attr('style', 'display:block');

      var spelling_text = JSON.stringify(other_spellings);

      
      var other_spelling_ques_words = JSON.stringify(other_spelling_ques_words);
      
      $('.get_matching_ques_word').val(other_spelling_ques_words);

      $(".other_spelling_error_value").val(spelling_text);
      $('#other_total_spelling_mark').val(spelling_error_mark);

  });

  $('.spelling_next').click(function(){
    $('.spelling_error_menu').hide();
  });

  //Creative Sentence------------
  

  $('.creative_sentence_text').hide();
  $('.creative_sentence_show').hide();

  $('.creative_sentence').click(function() {
      $('.student_idea_text').attr('style', 'display:none;');
      $('.spelling_idea_text').attr('style', 'display:none;');
      $('.creative_sentence_text').attr('style', 'display:block;');
      $('.creative_sentence_show').show();
      $('.title_menu').hide();
      $('.spelling_error_menu').hide();
      $('.with_option').hide();
      $('.spelling_submit').hide();
      $('.story_structure_show').attr('style', 'display:none;');
      $(this).attr('style', 'background-color:#00A2E8;color:#fff');
  });

  var every_creative_sentense_index = new Array();
  $(document).delegate('.grammer_answer_new', 'click', function() {
    // alert('jii');
    var id = $(this).attr('data-id');
    var text = $(this).text();
    every_creative_sentense_index.push(id);
    if (every_creative_sentense_index.length > 4) {
      every_creative_sentense_index.pop();
      alert('You can not select more than 4 sentence');
      return false;
    }
    var creative_sentence_length = every_creative_sentense_index.length;
    if(creative_sentence_length==1){

    }else if(creative_sentence_length==2){

    }else if(creative_sentence_length==3){

    }else if(creative_sentence_length==4){

    }
    var creative_mark = creative_sentence_length*5;

    $("#creative_sentence_index").val(every_creative_sentense_index);
    $('.grammer_ans_new' + id).attr('style', 'background-color: rgb(255,201,14);');
    $('#creative_sentence_mark').val(creative_mark);
    $('.total_creative_sentence_point').val(creative_mark);
    
  });

  var other_creative_sentense_index = new Array();
  $(document).delegate('.other_creative', 'click', function() {
    //alert('jii');
    var id = $(this).attr('data-id');
    var text = $(this).text();
    other_creative_sentense_index.push(id);
    if (other_creative_sentense_index.length > 4) {
      other_creative_sentense_index.pop();
      alert('You can not select more than 4 sentence');
      return false;
    }
    var creative_sentence_length = other_creative_sentense_index.length;
    if(creative_sentence_length==1){

    }else if(creative_sentence_length==2){

    }else if(creative_sentence_length==3){

    }else if(creative_sentence_length==4){

    }
    var other_creative_mark = creative_sentence_length*5;
    var other_creative_sentense_indexs = JSON.stringify(other_creative_sentense_index);
    $("#other_creative_sentence_index").val(other_creative_sentense_indexs);
    $('.other_creative' + id).attr('style', 'background-color: rgb(255,201,14);');
    $('#other_creative_sentence_mark').val(other_creative_mark);
  });

  var other_creative_sentense_match_index = new Array();
  $(document).delegate('.other_creative_match', 'click', function() {
    //alert('jii');
    var id = $(this).attr('data-id');
    var text = $(this).text();
    var sentence_no = $('.creative_match_sentence').length;
    var sentence_no = sentence_no+1;

    var sentence = '<p style="position:relative;margin-top: 15px;" class="creative_match_sentence creative_match_sentence'+id+'"><i class="fa fa-close creative_sentence_wrong'+id+'" style="font-size:22px;color:red;position:absolute; top: -17px;left: 25px;display:none;"></i><i class="fa fa-check creative_sentence_right'+id+'" style="font-size:22px;color:green;position:absolute;top: -17px;left: 25px;display:none;"></i><span style="position:absolute;top: -17px;left: 25px;" id="creative_correction_info'+id+'"></span><span>'+sentence_no+'.</span>'+text+'</p>';
    $('.other_creative_sentence_show_box').append(sentence);

    other_creative_sentense_match_index.push(id);
    if (other_creative_sentense_match_index.length > 4) {
      other_creative_sentense_match_index.pop();
      alert('You can not select more than 4 sentence');
      return false;
    }
    var creative_sentence_length = other_creative_sentense_match_index.length;
    var other_creative_sentense_match_indexs = JSON.stringify(other_creative_sentense_match_index);
    $(".other_creative_sentence_match_index").val(other_creative_sentense_match_indexs);
    $('.other_creative_match' + id).attr('style', 'background-color: rgb(255,201,14);');
  });



  $('.creative_sentence_submit').click(function(e) {
    $(this).hide();
    $('.creative_sentence_next').show();
    // $('.creative_sentence_mark_show').attr('style', 'display:block;');
    // $('.creative_sentence_mark_show').html(10);
  });

  $('.creative_sentence_next').click(function(e) {
    $('.creative_sentence_show').hide();
  });

    //Story Structure-------------------
  $('.story_structure').click(function(e) {
      $(this).attr('style', 'background-color:#00A2E8;color:#fff');
      $('.creative_sentence_text').attr('style', 'display:none;');
      $('.student_idea_text').attr('style', 'display:block;');
      $('.creative_sentence_show').attr('style', 'display:none;');
      $('.spelling_idea_text').attr('style', 'display:none;');
      $('.spelling_submit').attr('style', 'display:none;');
      $('.introduction_auto_comment').attr('style', 'display:none;');
      $('.body_paragraph_auto_comment').attr('style', 'display:none;');
      $('.conclusion_auto_comment').attr('style', 'display:none;');
      $('.story_structure_show').attr('style', 'display:block;height:100%');
      $('.title_menu').hide();
      $('.with_option').hide();
      $('.ans_submit').hide();

      $('.title_button').hide();
      $('.spelling_error').hide();
      $('.creative_sentence').hide(); 

      $('.introduction_button').show();
      $('.body_paragraph_button').show();
      $('.conclution_button').show();
  });

  //Introduction----------------------
  $('.introduction_button').click(function(e) {
    $(this).attr('style', 'background-color:#00A2E8;color:#fff;');
    $('.introduction_auto_comment').attr('style', 'display:block;');
    $('.spelling_idea_text').attr('style', 'display:none;');
    $('.introduction_answer_paragraph').attr('style', 'display:block;');
    $('.student_idea_text').attr('style', 'display:none;');
    $('.body_answer_paragraph').attr('style', 'display:none;');
    $('.conclusion_sentense_paragraph').attr('style','display:none;');
    $('.conclusion_auto_comment').attr('style','display:none;');
    
    $('.introduction_menu').show();
    $('.body_paragraph_menu').hide();
    $('.conclution_menu').hide();
  });

  // var every_introduction_sentense_index = new Array();
  // $(document).delegate('.grammer_answer_introduction', 'click', function() {
  //     var id = $(this).attr('data-id');
  //     every_introduction_sentense_index.push(id);
  //     if (every_introduction_sentense_index.length > 1) {
  //       every_introduction_sentense_index.pop();
  //       alert('You can not select more than one sentence');
  //       return false;
  //     }
  //     // $("#every_introduction_index").val(every_introduction_sentense_index);
  //     $('.grammer_ans_introduction'+id).attr('style','background-color: rgb(255,201,14);');
  // });

  $('.introduction_marking').click(function(){
    var get_mark = $(this).val();
    $('.total_introduction_point').val(get_mark);
    if(get_mark==5){
      $('.st_ss_intro_poor_mark').val(get_mark);
      $('.st_ss_intro_average_mark').val('');
      $('.st_ss_intro_good_mark').val('');
      $('.st_ss_intro_excelent_mark').val('');
    }else if(get_mark==10){
      $('.st_ss_intro_poor_mark').val('');
      $('.st_ss_intro_average_mark').val(get_mark);
      $('.st_ss_intro_good_mark').val('');
      $('.st_ss_intro_excelent_mark').val('');
    }else if(get_mark==15){
      $('.st_ss_intro_poor_mark').val('');
      $('.st_ss_intro_average_mark').val('');
      $('.st_ss_intro_good_mark').val(get_mark);
      $('.st_ss_intro_excelent_mark').val('');
    }else if(get_mark==20){
      $('.st_ss_intro_poor_mark').val('');
      $('.st_ss_intro_average_mark').val('');
      $('.st_ss_intro_good_mark').val('');
      $('.st_ss_intro_excelent_mark').val(get_mark);
    }
  });

  $('.introduction_submit').click(function(e){

      var title_mark = $('.total_introduction_point').val();
      if(title_mark != ''){
        if(title_mark==5){
          var title_index = 1;
        }else if(title_mark==10){
          var title_index = 2;
        }else if(title_mark==15){
          var title_index = 3;
        }else if(title_mark==20){
          var title_index = 4;
        }
        // $('#introduction_auto_comment_value').val(title_index);
        $('#introduction_point').val(title_mark);
        $('.introduction_menu').hide();
      }else{
        alert('Please select at least one item !');
      }
  });

  //story_body_paragraph----------------------
  $('.body_paragraph_button').click(function(e){
      $(this).attr('style', 'background-color:#00A2E8;color:#fff;');
      $('.introduction_auto_comment').attr('style', 'display:none;');
      $('.spelling_idea_text').attr('style', 'display:none;');
      $('.student_idea_text').attr('style', 'display:none;');
      $('.introduction_answer_paragraph').attr('style', 'display:none;');
      $('.conclusion_sentense_paragraph').attr('style','display:none;');
      $('.body_answer_paragraph').attr('style', 'display:block;');
      $('.body_paragraph_auto_comment').attr('style', 'display:block;');
      $('.conclusion_auto_comment').attr('style','display:none;');
      $('.body_paragraph_auto_comment_component').show();

      $('.introduction_menu').hide();
      $('.body_paragraph_menu').show();
      $('.conclution_menu').hide();
      
  });

  // var every_body_sentense_index = new Array();
  // $(document).delegate('.grammer_answer_body ','click',function(){
  //     var id = $(this).attr('data-id');
  //     every_body_sentense_index.push(id);
  //     if (every_body_sentense_index.length > 1) {
  //         every_body_sentense_index.pop();
  //         alert('You can not select more than one sentence');
  //         return false;
  //     }
  //     $("#every_body_index").val(every_body_sentense_index);
  //     $('.grammer_ans_body'+id).attr('style','background-color: rgb(255,201,14);');

  // });

  $('.body_paragraph_marking').click(function(){
    var get_mark = $(this).val();
    $('.total_body_paragraph_point').val(get_mark);
    if(get_mark==5){
      $('.st_body_para_poor_mark').val(get_mark);
      $('.st_body_para_average_mark').val('');
      $('.st_body_para_good_mark').val('');
      $('.st_body_para_excelent_mark').val('');
    }else if(get_mark==10){
      $('.st_body_para_poor_mark').val('');
      $('.st_body_para_average_mark').val(get_mark);
      $('.st_body_para_good_mark').val('');
      $('.st_body_para_excelent_mark').val('');
    }else if(get_mark==15){
      $('.st_body_para_poor_mark').val('');
      $('.st_body_para_average_mark').val('');
      $('.st_body_para_good_mark').val(get_mark);
      $('.st_body_para_excelent_mark').val('');
    }else if(get_mark==20){
      $('.st_body_para_poor_mark').val('');
      $('.st_body_para_average_mark').val('');
      $('.st_body_para_good_mark').val('');
      $('.st_body_para_excelent_mark').val(get_mark);
    }
  });

  $('.body_paragraph_submit').click(function(e){
      var title_mark = $('.total_body_paragraph_point').val();
      if(title_mark != ''){
        if(title_mark==5){
          var title_index = 1;
        }else if(title_mark==10){
          var title_index = 2;
        }else if(title_mark==15){
          var title_index = 3;
        }else if(title_mark==20){
          var title_index = 4;
        }
        // $('#body_paragraph_auto_comment_value').val(title_index);
        $('#body_paragraph_point').val(title_mark);
        $('.body_paragraph_menu').hide();
      }else{
        alert('Please select at least one item !');
      }
  });

  //Conclution----------------------
  $('.conclution_button').click(function(e) {
      $(this).attr('style', 'background-color:#00A2E8;color:#fff;');
      $('.conclusion_sentense_paragraph').attr('style','display:block;');
      $('.conclusion_auto_comment').attr('style','display:block;');
      $('.student_idea_text').attr('style','display:none;');
      $('.introduction_answer_paragraph').attr('style','display:none;');
      $('.body_answer_paragraph').attr('style','display:none;');
      $('.introduction_auto_comment').attr('style','display:none;');
      $('.body_paragraph_auto_comment').attr('style','display:none;'); 
    
      $('.introduction_menu').hide();
      $('.body_paragraph_menu').hide();
      $('.conclution_menu').show();
  });

  var every_conclusion_sentense_index = new Array();
  $(document).delegate('.grammer_answer_news', 'click', function() {
      var id = $(this).attr('data-id');
      every_conclusion_sentense_index.push(id);
      if (every_conclusion_sentense_index.length > 1) {
        every_conclusion_sentense_index.pop();
        alert('You can not select more than one sentence');
        return false;
      }
      $("#every_conclusion_index").val(every_conclusion_sentense_index);
      $('.grammer_ans_news'+id).attr('style', 'background-color: rgb(255,201,14);');
  });

  $('.conclution_marking').click(function(){
    var get_mark = $(this).val();
    $('.total_conclution_point').val(get_mark);
    if(get_mark==5){
      $('.st_ss_conclution_poor_mark').val(get_mark);
      $('.st_ss_conclution_average_mark').val('');
      $('.st_ss_conclution_good_mark').val('');
      $('.st_ss_conclution_excelent_mark').val('');
    }else if(get_mark==10){
      $('.st_ss_conclution_poor_mark').val('');
      $('.st_ss_conclution_average_mark').val(get_mark);
      $('.st_ss_conclution_good_mark').val('');
      $('.st_ss_conclution_excelent_mark').val('');
    }else if(get_mark==15){
      $('.st_ss_conclution_poor_mark').val('');
      $('.st_ss_conclution_average_mark').val('');
      $('.st_ss_conclution_good_mark').val(get_mark);
      $('.st_ss_conclution_excelent_mark').val('');
    }else if(get_mark==20){
      $('.st_ss_conclution_poor_mark').val('');
      $('.st_ss_conclution_average_mark').val('');
      $('.st_ss_conclution_good_mark').val('');
      $('.st_ss_conclution_excelent_mark').val(get_mark);
    }
  });

  $('.conclution_submit').click(function(e){
      var title_mark = $('.total_conclution_point').val();
      if(title_mark != ''){
        if(title_mark==5){
          var title_index = 1;
        }else if(title_mark==10){
          var title_index = 2;
        }else if(title_mark==15){
          var title_index = 3;
        }else if(title_mark==20){
          var title_index = 4;
        }
        $('#conclusion_auto_comment_value').val(title_index);
        $('#conclusion_point').val(title_mark);
        $('.conclution_menu').hide();
        $('.total_get_point').show();

            
        var title_point = $('#total_title_mark').val();
        var total_spelling_point = $('#total_spelling_mark').val();
        var creative_sentence_point = $('#creative_sentence_mark').val();
        var introduction_point = $('#introduction_point').val();
        var body_paragraph_point = $('#body_paragraph_point').val();
        var conclusion_point = $('#conclusion_point').val();
        
        if(title_point==''){
          title_point=0;
        }
        if(total_spelling_point==''){
          total_spelling_point=0;
        }
        if(creative_sentence_point==''){
          creative_sentence_point=0;
        }
        if(introduction_point==''){
          introduction_point=0;
        }
        if(body_paragraph_point==''){
          body_paragraph_point=0;
        }
        if(conclusion_point==''){
          conclusion_point=0;
        }
        var st_total_get_point = (parseInt(title_point)+parseInt(total_spelling_point)+parseInt(creative_sentence_point)+parseInt(introduction_point)+parseInt(body_paragraph_point)+parseInt(conclusion_point));
        // alert(st_total_get_point);

        $('.total_correction_point').text(st_total_get_point);
      }else{
        alert('Please select at least one item !');
      }
  });

  $('.idea_student').click(function(){
      $(this).attr('style','color:#00a2f0 !important;');
      $(this).attr('data-id',1);
      $('.idea_others_student').removeAttr('style');
      $('.idea_others_student').removeAttr('data-id');
      $('.main_student_idea').show();
      $('.student_idea_menu').show();
      $('.others_student_idea').hide();
      $('.others_student_idea_menu').hide();
      $('.others_story_structure_menu').hide();
  });

  $('.idea_others_student').click(function(){
      $(this).attr('style','color:#00a2f0 !important;');
      $(this).attr('data-id',2);
      $('.idea_student').removeAttr('style');
      $('.idea_student').removeAttr('data-id');
      $('.main_student_idea').hide();
      $('.student_idea_menu').hide();
      $('.others_student_idea').show();
      $('.others_student_idea_menu').show();
      $('.others_story_structure_menu').hide();
  });

  $('.other_title_button').click(function(){
      $(this).attr('style', 'background-color:#00A2E8;padding: 6px 8px;');

      $('.other_ss_conclution_menu').hide();
      $('.other_body_paragraph_menu').hide();
      $('.other_ss_introduction_menu').hide();
      $('.other_creative_sentence_menu').hide();
      $('.other_spelling_error_menu').hide();
      $('.other_image_menu').hide();
      $('.other_title_menu').show();
      $('.conclusion_sentense_paragraph').hide();
      $('.student_idea_text').show();
  });

  $('.other_title_menu_save').click(function(){
      
      var value_exits = 0;
      $('.option_all').each(function(){
        var title_option_valu = $(this).val();
        if(title_option_valu==''){
          value_exits = 1;
        }
      });
      if(value_exits ==1){
        alert('Please enter all option value');
      }else{
        $('.other_title_menu_preview').show();
        $('.option_all').each(function(){
          var title_option_val = $(this).val();
          if(title_option_val==''){
            value_exits = 1;
          }
          var index = $(this).attr('data-id');
          
          if(index==1){
            $('#title_option_one').val(title_option_val);
          }else if(index==2){
            $('#title_option_two').val(title_option_val);
          }else if(index==3){
            $('#title_option_three').val(title_option_val);
          }else if(index==4){
            $('#title_option_four').val(title_option_val);
          }
            $('.title_opt_prev'+index).text(title_option_val);
        });

        $('.title_hint_sort').each(function(){
          var title_option_hint_val = $(this).val();
          var index = $(this).attr('data-index');
          if(index==1){
            $('#title_option_one_hint').val(title_option_hint_val);
          }else if(index==2){
            $('#title_option_two_hint').val(title_option_hint_val);
          }else if(index==3){
            $('#title_option_three_hint').val(title_option_hint_val);
          }else if(index==4){
            $('#title_option_four_hint').val(title_option_hint_val);
          }
        });
      }
  });
  $('.other_title_menu_preview').click(function(){
      $('.other_title_menu_preview_box').show();
      $('.other_title_menu').hide();
  });


  $('.other_title_menu_submit').click(function(){
      $('.hint_set_prev').show();
      $('.title_opt_hint_icon').show();

      $('.title_hint_sort').each(function(){
        var title_option_hint_val = $(this).val();
        var id = $(this).attr('data-id');
        var index = $(this).attr('data-index');

        if(id==1){
          var color = '#ecd3b8;';
        }else if(id==2){
          var color = '#ed1c24;';
        }else if(id==3){
          var color = '#00a2e8;';
        }else if(id==4){
          var color = '#ecd3b8;';
        }
        
        if(index==1){
          $('.hint_set_prev'+index).css('background-color',color);
          $('.title_opt_hint_icon'+index).css('color',color);
          $('.hint_set_prev'+index).text(title_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }else if(index==2){
          $('.hint_set_prev'+index).css('background-color',color);
          $('.title_opt_hint_icon'+index).css('color',color);
          $('.hint_set_prev'+index).text(title_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }else if(index==3){
          $('.hint_set_prev'+index).css('background-color',color);
          $('.title_opt_hint_icon'+index).css('color',color);
          $('.hint_set_prev'+index).text(title_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }else if(index==4){
          $('.hint_set_prev'+index).css('background-color',color);
          $('.title_opt_hint_icon'+index).css('color',color);
          $('.hint_set_prev'+index).text(title_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }
          
      });
      $('.other_title_menu_next').show();
      $('.other_title_menu_submit').hide();
  });

  $('.other_title_menu_next').click(function(){
    $('.other_title_menu_next').hide();
    $('.other_title_menu_preview_box').hide();
  });


  // Image start here
  $('.other_image_button').click(function(){
    $(this).attr('style', 'background-color:#00A2E8;padding: 6px 8px;');

    $('.other_ss_conclution_menu').hide();
    $('.other_body_paragraph_menu').hide();
    $('.other_ss_introduction_menu').hide();
    $('.other_creative_sentence_menu').hide();
    $('.other_spelling_error_menu').hide();
    $('.other_image_menu').show();
    $('.other_title_menu').hide();

    $('.other_title_menu_preview_box').hide();
  });

  $('.image_option').change(function(){
      var id = $(this).attr('data-id');
      var property = document.getElementById('upload_option_image_'+id).files[0];
      var image_name = property.name;
      var image_extension = image_name.split('.').pop().toLowerCase();
      if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png','']) == -1){
        //alert("Invalid image file");
      }
      console.log(property);
      var form_data = new FormData();
      form_data.append("file",property);

      $.ajax({
        url: "upload_idea_story_options",
        method:'POST',
        data:form_data,
        contentType:false,
        cache:false,
        processData:false,
        beforeSend:function(){
          $('#msg').html('Loading......');
        },
        success: function (data) {

          var img = '<img  class="option_box_image" src="<?=base_url()?>/assets/idea_image/idea_options/'+data+'"/>';
          var img2 = '<img  class="option_box_image_show" src="<?=base_url()?>/assets/idea_image/idea_options/'+data+'"/>';
          // $('#hint_one_image').val(data);

          if(id==1){
            $('#option_one_image').val(data);
          }else if(id==2){
            $('#option_two_image').val(data);
          }else if(id==3){
            $('#option_three_image').val(data);
          }else if(id==4){
            $('#option_four_image').val(data);
          }

          $('.image_box_'+id).html(img);
          $('.image_box_show_'+id).html(img2);
        }
      });
  });

  $('.save_idea_options_image').click(function(){
    var value_exits = 0;
    $('.image_option_all').each(function(){  
      var texts = $(this).val();
      if(texts == ''){
        value_exits = 1;
      }
    });

    if(value_exits ==1){
       alert('Please fill-up all option text !');
    }else{
      var image_option_ans = $('input[name="image_radio_option"]:checked').val();
      if(image_option_ans != undefined){
        $('.options_image_preview').show();
        var image_points = new Array();
        var image_texts = new Array();

        $('.image_point').each(function(){
          var id = $(this).attr('data-id');
          var point = $(this).val();
          image_points.push(point);
          $('#image_option_points').val(image_points);
          $('#image_option_ans').val(image_option_ans);
        });

        $('.image_option_all').each(function(){ 
          var text = $(this).val();
          image_texts.push(text);
        });

        var array_remake = JSON.stringify(image_texts);
        $('#option_one_image_texts').val(array_remake);

      }else{
        alert('Please select ans first !');
      }
    }

  });

  $('.options_image_preview').click(function(){
     $('.options_image_preview_show').show();
     $('.other_image_menu').hide();
     
  });
  $('.image_point').change(function(){
      var get_id = $(this).attr('data-id');
      var get_point = $(this).val();
      $('.image_radio_ans_'+get_id).val(get_point);
  });

  $('.match_idea_options_image').click(function(){
    var image_option_ans = $('input[name="image_radio_ans_match"]:checked').val();
    if(image_option_ans != undefined){
      $('.upper_box').show();
      $('.upper_arrow').show();
      $('.right_box').show();
      $('.right_arrow').show();
      $('.down_box').show();
      $('.down_arrow').show();
      $('.left_box').show();
      $('.left_arrow').show();
      $('.match_idea_options_image_next').show();
      $(this).hide();
      
      var get_texts = $('#option_one_image_texts').val();
      var option_texts = JSON.parse(get_texts);
      
      for(var i=0;i<option_texts.length;i++){
        var text = option_texts[i];
        if(i==0){
           $('.upper_box_text').text(text);
        }else if(i==1){
          $('.right_box_text').text(text);
        }else if(i==2){
          $('.down_box_text').text(text);
        }else if(i==3){
          $('.left_box_text').text(text);
        }
      }
    }else{
      alert('Please select ans first !');
    }
  });
  
  $('.match_idea_options_image_next').click(function(){
    $('.options_image_preview_show').hide();
  });

  $('.title_set_option').click(function(){
      var id = $(this).attr('data-id');
      $('.option_all').hide(); 
      $('.option_description' + id).show();
      $('#title_options_modal').modal('show');
  });

  $(".title_hint_parrent").sortable({
    delay: 150,
    stop: function() {

        var allSerial = new Array();
        var ideaIds = new Array();
        var oldIdeaIds = new Array();

        // $(".title_hint_parrent>.student_idea").each(function() {
        //     var idea_serial = $(this).data('serial');
        //     var idea_id = $(this).data('idea');

        //     allSerial.push(idea_serial);
        //     ideaIds.push(idea_id);
        // });

        // $(".student_idea_serial").each(function() {
        //     var idea_id = $(this).data('idea');
        //     oldIdeaIds.push(idea_id);
        // });other_spelling

        // updateOrder(allSerial,ideaIds,oldIdeaIds);
    }
  });
  $('.image_set_option').click(function(){
      var id = $(this).attr('data-id');
      $('.image_option_all').hide(); 
      $('.image_option_description' + id).show();
      $('#image_options_modal').modal('show');
  });
  $('.other_spelling_error').click(function(){
    $('.other_ss_conclution_menu').hide();
    $('.other_body_paragraph_menu').hide();
    $('.other_ss_introduction_menu').hide();
    $('.other_creative_sentence_menu').hide();
    $('.other_spelling_error_menu').show();
    $('.other_image_menu').hide();
    $('.other_title_menu').hide();

    $('.other_creative_sentence').hide();
    $('.other_spelling_error_save').show();
    $('.total_splleing_error_point').val();


    $('.student_idea_text').attr('style', 'display:none;');
    $('.spelling_idea_text').attr('style', 'display:none;');
    $('.other_spelling_idea_text').show();
    $('.creative_sentence_text').attr('style', 'display:none;');
    $('.creative_sentence_show').attr('style', 'display:none;');
    $('.title_menu').hide();
    $('.with_option').hide();
    $(this).attr('style', 'background-color:#00A2E8;color:#fff;padding: 6px 8px;');
    $('.story_structure_show').attr('style', 'display:none;');
  });
  $('.other_spelling_error_preview').click(function(){
    $('.other_spelling_idea_text').hide();
    $('.other_spelling_error_check').show();
    $('.other_spelling_error_save').hide();
    $('.other_spelling_error_preview').hide();
    $('.other_spelling_error_submit').show();
    var get_matching_words = new Array();
  });

  $('.other_spelling_error_submit').click(function(){
      var wrong_words = $('.get_matching_ques_word').val();
      var right_words = $('.get_matching_ans_word').val();

      // if(right_words != ''){
        var spelling_wrong_words = JSON.parse(wrong_words);
        var spelling_right_words = JSON.parse(right_words);
        // console.log(spelling_wrong_words);
        // console.log(spelling_right_words);

        for(var i=0;i<spelling_right_words.length;i++){
           var ans_index = spelling_right_words[i];
           
            if(jQuery.inArray(ans_index, spelling_wrong_words) != -1) {
                $('.spell_word_right'+ans_index).show();
                $('#correction_info'+ans_index).html('<b style="margin-left:20px;color:green;">(Correct Chosen)</b>');
            } else {
                $('.spell_word_wrong'+ans_index).show();
                $('#correction_info'+ans_index).html('<b style="margin-left:20px;color:red;">(Incorrect Chosen)</b>');
            } 
        }
        $(this).hide();
        $('.other_spelling_error_next').show();
  });

  $('.other_spelling_error_next').click(function(){
      $('.other_spelling_error_menu').hide();
  });
  
  $('.other_creative_button').click(function(){
    $('.other_ss_conclution_menu').hide();
    $('.other_body_paragraph_menu').hide();
    $('.other_ss_introduction_menu').hide();
    $('.other_creative_sentence_menu').show();
    $('.other_spelling_error_menu').hide();
    $('.other_image_menu').hide();
    $('.other_title_menu').hide();

    $('.other_spelling_error_check').hide();
    $('.other_spelling_error_save').show();
    $('.other_creative_sentence_save').show();
    $('.total_splleing_error_point').val();


    $('.student_idea_text').attr('style', 'display:none;');
    $('.spelling_idea_text').attr('style', 'display:none;');
    $('.other_spelling_idea_text').hide();
    $('.other_creative_sentence').show();
    $('.creative_sentence_text').attr('style', 'display:none;');
    $('.creative_sentence_show').attr('style', 'display:none;');
    $('.title_menu').hide();
    $('.with_option').hide();
    $(this).attr('style', 'background-color:#00A2E8;color:#fff;padding: 6px 8px;');
    $('.story_structure_show').attr('style', 'display:none;');
  });
  $('.other_creative_sentence_save').click(function(){
    $('.other_creative_sentence_preview').show();
  });

  $('.other_creative_sentence_preview').click(function(){
    $('.other_creative_sentence_save').hide();
    $('.other_creative_sentence_preview').hide();
    $('.other_creative_sentence_submit').show();
    $('.other_creative_sentence_match').show();
    $('.other_creative_sentence').hide();
  });

  $('.other_creative_sentence_submit').click(function(){
    $(this).hide();
    $('.other_creative_sentence_next').show();

    var right_creative_sentence = $('#other_creative_sentence_index').val();
    var wrong_creative_sentence = $('.other_creative_sentence_match_index').val();
    var creative_wrong_words = JSON.parse(wrong_creative_sentence);
    var creative_right_words = JSON.parse(right_creative_sentence);
    // console.log(creative_wrong_words);
    // console.log(creative_right_words);
    
    for(var j=0;j<creative_right_words.length;j++){
      var sentence_no = $('.creative_match_sentence').length;
      var sentence_no = sentence_no+1; 
      var not_chosen_index = creative_wrong_words[j];
      if(jQuery.inArray(not_chosen_index, creative_right_words) != -1) {

      }else{
        
        var get_text = $('.other_creative_match'+not_chosen_index).text();

        var sentence = '<p style="position:relative;margin-top: 15px;" class="creative_match_sentence creative_match_sentence'+not_chosen_index+'"><i class="fa fa-exclamation creative_sentence_wrong'+not_chosen_index+'" style="font-size:22px;color:#00a2e8;position:absolute; top: -17px;left: 30px;"></i><span style="position:absolute;top: -17px;left: 25px;"><b style="margin-left:30px;color:#00a2e8;">(Incorrect Chosen)</b></span><span>'+sentence_no+'.</span>'+get_text+'</p>';
        $('.other_creative_sentence_show_box').append(sentence);
      }
    }

    for(var i=0;i<creative_wrong_words.length;i++){
        var ans_index = creative_wrong_words[i];
        //  alert(ans_index);
        if(jQuery.inArray(ans_index, creative_right_words) != -1) {
            $('.creative_sentence_right'+ans_index).show();
            $('#creative_correction_info'+ans_index).html('<b style="margin-left:30px;color:green;">(Correct Chosen)</b>');
        } else {
            $('.creative_sentence_wrong'+ans_index).show();
            $('#creative_correction_info'+ans_index).html('<b style="margin-left:30px;color:red;">(Incorrect Chosen)</b>');
        } 
    }
  });

  $('.other_creative_sentence_next').click(function(){
    $('.other_creative_sentence_menu').hide();
  });
  $('.other_story_structure_button').click(function(){
    $('.others_story_structure_menu').show();
    $('.others_student_idea_menu').hide();
  });
  $('.other_introduction_button').click(function(){
    $(this).attr('style', 'background-color:#00A2E8;padding: 6px 8px;');
    $('.checkmark').removeAttr('style');
    $('.student_idea_text').show(); 

    $('.other_ss_conclution_menu').hide();
    $('.other_body_paragraph_menu').hide();
    $('.other_ss_introduction_menu').show();
    $('.other_creative_sentence_menu').hide();
    $('.other_spelling_error_menu').hide();
    $('.other_image_menu').hide();
    $('.other_title_menu').hide();

    $('.other_creative_sentence_match').hide();
    
    $('.other_ss_conclution_menu_preview_box').hide();
    $('.other_body_paragraph_menu_preview_box').hide();
    $('.other_ss_introduction_menu_preview_box').hide();
  });

  $('.other_introduction_menu_save').click(function(){
      $('.other_introduction_menu_preview').show();
      value_exits = 0;
      $('.ss_intro_option_all').each(function(){
        var introduction_option_val = $(this).val();
        if(introduction_option_val==''){
          value_exits =1;
        }
      });

      if(value_exits==1){
          alert('Please Select all oprtion !');
      }else{
        $('.ss_intro_option_all').each(function(){
          var introduction_option_val = $(this).val();
          var index = $(this).attr('data-id');
          // alert(introduction_option_val);
          if(index==1){
            $('#ss_intro_option_one').val(introduction_option_val);
          }else if(index==2){
            $('#ss_intro_option_two').val(introduction_option_val);
          }else if(index==3){
            $('#ss_intro_option_three').val(introduction_option_val);
          }else if(index==4){
            $('#ss_intro_option_four').val(introduction_option_val);
          }
            $('.intro_opt_prev'+index).text(introduction_option_val);
        });

        $('.introduction_hint_sort').each(function(){
          var intro_option_hint_val = $(this).val();
          var index = $(this).attr('data-index');
          if(index==1){
            $('#ss_intro_option_one_hint').val(intro_option_hint_val);
          }else if(index==2){
            $('#ss_intro_option_two_hint').val(intro_option_hint_val);
          }else if(index==3){
            $('#ss_intro_option_three_hint').val(intro_option_hint_val);
          }else if(index==4){
            $('#ss_intro_option_four_hint').val(intro_option_hint_val);
          }
        });
      }
      
  });

  $('.other_introduction_menu_preview').click(function(){
      $('.other_ss_introduction_menu_preview_box').show();
      $('.other_ss_introduction_menu').hide();
  });

  $('.other_intro_menu_submit').click(function(){
      $('.intro_hint_set_prev').show();
      $('.intro_opt_hint_icon').show();

      $('.introduction_hint_sort').each(function(){
        var intro_option_hint_val = $(this).val();
        var id = $(this).attr('data-id');
        var index = $(this).attr('data-index');

        if(id==1){
          var color = '#ecd3b8;';
        }else if(id==2){
          var color = '#ed1c24;';
        }else if(id==3){
          var color = '#00a2e8;';
        }else if(id==4){
          var color = '#ecd3b8;';
        }
        
        if(index==1){
          $('.intro_hint_set_prev'+index).css('background-color',color);
          $('.intro_opt_hint_icon'+index).css('color',color);
          $('.intro_hint_set_prev'+index).text(intro_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }else if(index==2){
          $('.intro_hint_set_prev'+index).css('background-color',color);
          $('.intro_opt_hint_icon'+index).css('color',color);
          $('.intro_hint_set_prev'+index).text(intro_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }else if(index==3){
          $('.intro_hint_set_prev'+index).css('background-color',color);
          $('.intro_opt_hint_icon'+index).css('color',color);
          $('.intro_hint_set_prev'+index).text(intro_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }else if(index==4){
          $('.intro_hint_set_prev'+index).css('background-color',color);
          $('.intro_opt_hint_icon'+index).css('color',color);
          $('.intro_hint_set_prev'+index).text(intro_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }
          
      });
      $('.other_intro_menu_next').show();
      $('.other_intro_menu_submit').hide();
  });

  $('.other_intro_menu_next').click(function(){
    $('.other_intro_menu_next').hide();
    $('.other_ss_introduction_menu_preview_box').hide();
  });

  $('.set_option').click(function(){
      var id = $(this).attr('data-id');
      $('.ss_intro_option_all').hide(); 
      $('.ss_intro_option_description' + id).show();
      $('#intro_options_modal').modal('show');
  });
// ===================== Other Body Paragraph ========================
  $('.other_body_paragraph_button').click(function(){
    $(this).attr('style', 'background-color:#00A2E8;padding: 6px 8px;');
    $('.checkmark').removeAttr('style');

    $('.other_ss_conclution_menu').hide();
    $('.other_body_paragraph_menu').show();
    $('.other_ss_introduction_menu').hide();
    $('.other_creative_sentence_menu').hide();
    $('.other_spelling_error_menu').hide();
    $('.other_image_menu').hide();
    $('.other_title_menu').hide();

    $('.other_ss_conclution_menu_preview_box').hide();
    $('.other_body_paragraph_menu_preview_box').hide();
    $('.other_ss_introduction_menu_preview_box').hide();
  });

  $('.other_body_paragraph_menu_save').click(function(){
      $('.other_body_paragraph_menu_preview').show();
      $('.body_para_option_all').each(function(){
        var body_paragraph_option_val = $(this).val();
        var index = $(this).attr('data-id');
        if(index==1){
          $('#ss_body_paragraph_option_one').val(body_paragraph_option_val);
        }else if(index==2){
          $('#ss_body_paragraph_option_two').val(body_paragraph_option_val);
        }else if(index==3){
          $('#ss_body_paragraph_option_three').val(body_paragraph_option_val);
        }else if(index==4){
          $('#ss_body_paragraph_option_four').val(body_paragraph_option_val);
        }
          $('.body_paragraph_opt_prev'+index).text(body_paragraph_option_val);
      });

      $('.body_paragraph_hint_sort').each(function(){
        var body_paragraph_option_hint_val = $(this).val();
        var index = $(this).attr('data-index');
        if(index==1){
          $('#ss_body_paragraph_option_one_hint').val(body_paragraph_option_hint_val);
        }else if(index==2){
          $('#ss_body_paragraph_option_two_hint').val(body_paragraph_option_hint_val);
        }else if(index==3){
          $('#ss_body_paragraph_option_three_hint').val(body_paragraph_option_hint_val);
        }else if(index==4){
          $('#ss_body_paragraph_option_four_hint').val(body_paragraph_option_hint_val);
        }
      });
  });
  $('.other_body_paragraph_menu_preview').click(function(){
      $('.other_body_paragraph_menu_preview_box').show();
      $('.other_body_paragraph_menu').hide();
   
  });

  $('.other_body_paragraph_menu_submit').click(function(){ 
      $('.body_paragraph_hint_set_prev').show();
      $('.body_paragraph_opt_hint_icon').show();


      $('.body_paragraph_hint_sort').each(function(){
        var intro_option_hint_val = $(this).val();
        var id = $(this).attr('data-id');
        var index = $(this).attr('data-index');


        if(id==1){
          var color = '#ecd3b8;';
        }else if(id==2){
          var color = '#ed1c24;';
        }else if(id==3){
          var color = '#00a2e8;';
        }else if(id==4){
          var color = '#ecd3b8;';
        }
        
        if(index==1){
          $('.body_paragraph_hint_set_prev'+index).css('background-color',color);
          $('.body_paragraph_opt_hint_icon'+index).css('color',color);
          $('.body_paragraph_hint_set_prev'+index).text(intro_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }else if(index==2){
          $('.body_paragraph_hint_set_prev'+index).css('background-color',color);
          $('.body_paragraph_opt_hint_icon'+index).css('color',color);
          $('.body_paragraph_hint_set_prev'+index).text(intro_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }else if(index==3){
          $('.body_paragraph_hint_set_prev'+index).css('background-color',color);
          $('.body_paragraph_opt_hint_icon'+index).css('color',color);
          $('.body_paragraph_hint_set_prev'+index).text(intro_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }else if(index==4){
          $('.body_paragraph_hint_set_prev'+index).css('background-color',color);
          $('.body_paragraph_opt_hint_icon'+index).css('color',color);
          $('.body_paragraph_hint_set_prev'+index).text(intro_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }
          
      });
      $('.other_body_paragraph_menu_next').show();
      $('.other_body_paragraph_menu_submit').hide();
  });

  $('.other_body_paragraph_menu_next').click(function(){
    $('.other_body_paragraph_menu_next').hide();
    $('.other_body_paragraph_menu_preview_box').hide();
  });
  $('.body_para_set_option').click(function(){
      var id = $(this).attr('data-id'); 
      $('.body_para_option_all').hide(); 
      $('.body_para_option_description' + id).show();
      $('#body_paragraph_options_modal').modal('show');
  });

// ===================== Other Conclusion ========================

  $('.other_conclution_button').click(function(){
    $(this).attr('style', 'background-color:#00A2E8;padding: 6px 8px;');
    $('.checkmark').removeAttr('style');

    $('.other_ss_conclution_menu').show();
    $('.other_body_paragraph_menu').hide();
    $('.other_ss_introduction_menu').hide();
    $('.other_creative_sentence_menu').hide();
    $('.other_spelling_error_menu').hide();
    $('.other_image_menu').hide();
    $('.other_title_menu').hide();

    $('.other_ss_conclution_menu_preview_box').hide();
    $('.other_body_paragraph_menu_preview_box').hide();
    $('.other_ss_introduction_menu_preview_box').hide();
  });

  $('.other_ss_conclution_menu_save').click(function(){
      $('.other_ss_conclution_menu_preview').show();
      $('.ss_conclution_option_all').each(function(){
        var ss_conclution_option_val = $(this).val();
        var index = $(this).attr('data-id');
        if(index==1){
          $('#ss_conclution_option_one').val(ss_conclution_option_val);
        }else if(index==2){
          $('#ss_conclution_option_two').val(ss_conclution_option_val);
        }else if(index==3){
          $('#ss_conclution_option_three').val(ss_conclution_option_val);
        }else if(index==4){
          $('#ss_conclution_option_four').val(ss_conclution_option_val);
        }
          $('.ss_conclution_opt_prev'+index).text(ss_conclution_option_val);
      });

      $('.ss_conclution_hint_sort').each(function(){
        var ss_conclution_option_hint_val = $(this).val();
        var index = $(this).attr('data-index');
        if(index==1){
          $('#ss_conclution_option_one_hint').val(ss_conclution_option_hint_val);
        }else if(index==2){
          $('#ss_conclution_option_two_hint').val(ss_conclution_option_hint_val);
        }else if(index==3){
          $('#ss_conclution_option_three_hint').val(ss_conclution_option_hint_val);
        }else if(index==4){
          $('#ss_conclution_option_four_hint').val(ss_conclution_option_hint_val);
        }
      });
  });
  $('.other_ss_conclution_menu_preview').click(function(){
      $('.other_ss_conclution_menu_preview_box').show();
      $('.other_ss_conclution_menu').hide();
   
  });

  $('.other_ss_conclution_menu_submit').click(function(){ 
      $('.ss_conclution_hint_set_prev').show();
      $('.ss_conclution_opt_hint_icon').show();


      $('.ss_conclution_hint_sort').each(function(){
        var intro_option_hint_val = $(this).val();
        var id = $(this).attr('data-id');
        var index = $(this).attr('data-index');


        if(id==1){
          var color = '#ecd3b8;';
        }else if(id==2){
          var color = '#ed1c24;';
        }else if(id==3){
          var color = '#00a2e8;';
        }else if(id==4){
          var color = '#ecd3b8;';
        }
        
        if(index==1){
          $('.ss_conclution_hint_set_prev'+index).css('background-color',color);
          $('.ss_conclution_opt_hint_icon'+index).css('color',color);
          $('.ss_conclution_hint_set_prev'+index).text(intro_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }else if(index==2){
          $('.ss_conclution_hint_set_prev'+index).css('background-color',color);
          $('.ss_conclution_opt_hint_icon'+index).css('color',color);
          $('.ss_conclution_hint_set_prev'+index).text(intro_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }else if(index==3){
          $('.ss_conclution_hint_set_prev'+index).css('background-color',color);
          $('.ss_conclution_opt_hint_icon'+index).css('color',color);
          $('.ss_conclution_hint_set_prev'+index).text(intro_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }else if(index==4){
          $('.ss_conclution_hint_set_prev'+index).css('background-color',color);
          $('.ss_conclution_opt_hint_icon'+index).css('color',color);
          $('.ss_conclution_hint_set_prev'+index).text(intro_option_hint_val);
          $('.checkmark'+index).css('background-color',color);
        }
          
      });
      $('.other_ss_conclution_menu_next').show();
      $('.other_ss_conclution_menu_submit').hide();
  });

  $('.other_ss_conclution_menu_next').click(function(){
    $('.other_ss_conclution_menu_next').hide();
    $('.other_ss_conclution_menu_preview_box').hide();
  });

  $('.ss_conclution_set_option').click(function(){
    var id = $(this).attr('data-id'); 
    $('.ss_conclution_option_all').hide(); 
    $('.ss_conclution_option_description' + id).show();
    $('#body_ss_conclution_modal').modal('show');
  });

  $(".title_hint_parrent").sortable({
    delay: 150,
    stop: function() {
        var allSerial = new Array();
        var ideaIds = new Array();
        var oldIdeaIds = new Array();
    }
  });
  // ss_conclution_hint_sort

</script>