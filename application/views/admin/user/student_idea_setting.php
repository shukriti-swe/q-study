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

  .custom_radio:hover input~.checkmark {
    background-color: #00a2e8;
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
</style>
 
<?php
   // echo "<pre>";print_r($student_idea[0]);die();
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
            <p style="text-align:center;"><b>Idea/Topic/Story Title</b></p>
            <p class="" style="color:#f98f0b;text-align:center;">"<?=$student_idea[0]['idea_title']?>"<i class="fa fa-pencil" style="font-size:18px;color:#f98f0b;"></i></p>
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
 <form action="" id="given_idea_point">
  <!-- Hidden Field -->
  <input type="hidden" name="module_id" value="<?= $student_idea[0]['module_id'];?>">
  <input type="hidden" name="question_id" value="<?= $student_idea[0]['question_id'];?>">
  <input type="hidden" name="student_id" value="<?= $student_idea[0]['user_id'];?>">
  <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id')?>">
  <input type="hidden" name="idea_id" value="<?= $student_idea[0]['idea_id'];?>">
  <input type="hidden" name="title_comment" id="title_comment">
  <input type="hidden" name="total_title_mark" id="total_title_mark">
  <input type="hidden" name="total_spelling_mark" id="total_spelling_mark">
  <input type="hidden" name="creative_sentence_mark" id="creative_sentence_mark">
  <!-- <input type="text" name="spelling_error_value" id="spelling_error_value"> -->
  <input type="hidden" name="creative_sentence_index" id="creative_sentence_index">
  <input type="hidden" name="every_introduction_index" id="every_introduction_index">
  <input type="hidden" name="introduction_auto_comment_value" id="introduction_auto_comment_value">
  <input type="hidden" name="introduction_point" id="introduction_point">
  <input type="hidden" name="every_body_index" id="every_body_index">
  <input type="hidden" name="body_paragraph_auto_comment_value" id="body_paragraph_auto_comment_value">
  <input type="hidden" name="body_paragraph_point" id="body_paragraph_point">
  <input type="hidden" name="every_conclusion_index" id="every_conclusion_index">
  <input type="hidden" name="conclusion_auto_comment_value" id="conclusion_auto_comment_value">
  <input type="hidden" name="conclusion_point" id="conclusion_point">
  <textarea name="spelling_error_value" cols="30" rows="10" class="spelling_error_value" style="display:none;"></textarea>
</form>
  <div class="row" style="padding:0px 15px;">
    <div class="col-md-6">

    </div>

    <div class="col-md-5" style="margin-left:2%;">
      <span class="btn btn-select3 title_mark" style="display: none;"></span>
      <span class="btn btn-select3 spelling_error_mark" style="display: none;"></span>
      <span class="btn btn-select3 creative_sentence_mark_show" style="display:none;"></span>
      <span class="btn btn-select3 introduction_mark_show" style="display: none;"></span>
      <span class="btn btn-select3 body_paragraph_mark_show" style="display: none;"></span>
      <span class="btn btn-select3 conclusion_mark_show" style="display: none;"></span>
      <a type="button" class="btn btn-select title_button">Title</a>
      <a type="button" class="btn btn-select spelling_error">Spelling Error</a>
      <a type="button" class="btn btn-select creative_sentence">Creative Sentence</a>
      <a type="button" class="btn btn-select story_structure">Story Structure</a>
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
      <div class="creative_sentence_text" style="display:none;">
      </div>
      <div class="introduction_answer_paragraph" style="display:none;">
      </div>
      <div class="body_answer_paragraph" style="display:none;">
      </div>
      <div class="conclusion_sentense_paragraph" style="display:none;">
      </div>
    </div>

    <div class="col-md-5" style="border:1px solid gray;padding:5px;margin-left:3%;overflow: hidden;">

      <div class="title_menu" style="display:none">
        <a type="button" class="btn btn-select2 auto_comment_button">Auto Comment</a>
        <a type="button" class="btn btn-select2 manual_comment_button">Manual Comment</a>
      </div>

      <div class="with_option" style="display:none">
        <!-- <div class="auto_comment_box"> -->

        <div style="padding-left:30px;gap:5px;">
          <div style="margin-top: 6px;position:relative;">
            <div class="set_tooltip" style="position:relative;display:inline-flex;gap:10px;align-items: baseline;">
              <label class="custom_radio"><span class="option_no all_options">Not Bad</span>
                <input type="radio" class="radio_ans" id="html" name="answer" value="1">
                <span class="checkmark "></span>
              </label>
            </div>
          </div>
        </div>

        <div style="padding-left: 30px;gap:5px;">
          <div style="margin-top: 6px;position:relative;">
            <div class="set_tooltip" style="position:relative;display:inline-flex;gap:10px;align-items: baseline;">
              <label class="custom_radio"><span class="option_no all_options">Not Related</span>
                <input type="radio" class="radio_ans" id="html" name="answer" value="2">
                <span class="checkmark "></span>
              </label>
            </div>
          </div>
        </div>

        <div style="padding-left: 30px;gap:5px;">
          <div style="margin-top: 6px;position:relative;">
            <div class="set_tooltip" style="position:relative;display:inline-flex;gap:10px;align-items: baseline;">
              <label class="custom_radio"><span class="option_no all_options">It was great title</span>
                <input type="radio" class="radio_ans" id="html" name="answer" value="3">
                <span class="checkmark "></span>
              </label>
            </div>
          </div>
        </div>

        <br>

        <div style="margin-top: auto;">
          <a href="javascript:;" type="button" class="btn btn-primary ans_submit" style="background-color: #bee131;color:#000;margin-left:10px;">Submit</a>
        </div>

      </div>

      <div>
        <a href="javascript:;" type="button" class="btn btn-primary spelling_submit" style="display:none;">Submit</a>
      </div>
      

      <div class="creative_sentence_show">
        <a type="button" class="btn btn-select2 manual_comment_button">Manual Comment</a>
        <a href="javascript:;" type="button" class="btn btn-primary creative_sentence_submit" style="display:none;">Submit</a>
      </div>
      <div class="story_structure_show" style="display:none;">
        <div class="row" style="padding:2%;height:100%;position:relative;">
          <div class="col-md-7" style="height:100%;">
             <!-- For Introduction Paragraph -->
            <div class="introduction_auto_comment" style="display:none;">
              <div style="display:flex;gap:10px;">
                <a type="button" class="btn btn-select2 introduction_auto_comment_checkbox">Auto Comment</a>
                <select class="form-control introduction_mark_chose" name="" id="" style="width:50px;">
                  <option value=""></option>
                  <option value="0">0</option>
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="15">15</option>
                  <option value="20">20</option>
                </select>
                <a type="button" class="btn btn-select2">Manual Comment</a>
              </div>
              
            <div class="with_option_introduction" style="display:none">
                <!-- <div class="auto_comment_box"> -->

                <div style="padding-left:30px;gap:5px;">
                  <div style="margin-top: 6px;position:relative;">
                    <div class="set_tooltip" style="position:relative;display:inline-flex;gap:10px;align-items: baseline;">
                      <label class="custom_radio"><span class="option_no all_options">Not Bad</span>
                        <input type="radio" class="radio_ans_intro" id="html" name="answer" value="1">
                        <span class="checkmark "></span>
                      </label>
                    </div>
                  </div>
                </div>

                <div style="padding-left: 30px;gap:5px;">
                  <div style="margin-top: 6px;position:relative;">
                    <div class="set_tooltip" style="position:relative;display:inline-flex;gap:10px;align-items: baseline;">
                      <label class="custom_radio"><span class="option_no all_options">Not Related</span>
                        <input type="radio" class="radio_ans_intro" id="html" name="answer" value="2">
                        <span class="checkmark "></span>
                      </label>
                    </div>
                  </div>
                </div>

                <div style="padding-left: 30px;gap:5px;">
                  <div style="margin-top: 6px;position:relative;">
                    <div class="set_tooltip" style="position:relative;display:inline-flex;gap:10px;align-items: baseline;">
                      <label class="custom_radio"><span class="option_no all_options">It was great title</span>
                        <input type="radio" class="radio_ans_intro" id="html" name="answer" value="3">
                        <span class="checkmark "></span>
                      </label>
                    </div>
                  </div>
                </div>

              </div>
              <a href="javascript:;" type="button" class="btn btn-primary introduction_submit" style="background-color:#bee131;color:#000;margin-left:10px;position:absolute; bottom:12px;">Submit</a>
            </div>
            <!-- For Body Paragraph -->
            <div class="body_paragraph_auto_comment" style="display:none;">
              <div style="display:flex;gap:10px;" class="body_paragraph_auto_comment_component">
                <a type="button" class="btn btn-select2 body_paragraph_auto_comment_checkbox">Auto Comment</a>
                <select class="form-control body_paragraph_mark_chose" name="" id="" style="width:50px;">
                  <option value=""></option>
                  <option value="0">0</option>
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="15">15</option>
                  <option value="20">20</option>
                </select>
                <a type="button" class="btn btn-select2">Manual Comment</a>
              </div>
              
            <div class="with_option_body_paragraph" style="display:none">
                <!-- <div class="auto_comment_box"> -->

                <div style="padding-left:30px;gap:5px;">
                  <div style="margin-top: 6px;position:relative;">
                    <div class="set_tooltip" style="position:relative;display:inline-flex;gap:10px;align-items: baseline;">
                      <label class="custom_radio"><span class="option_no all_options">Not Bad</span>
                        <input type="radio" class="radio_ans_intro" id="html" name="answer" value="1">
                        <span class="checkmark "></span>
                      </label>
                    </div>
                  </div>
                </div>

                <div style="padding-left: 30px;gap:5px;">
                  <div style="margin-top: 6px;position:relative;">
                    <div class="set_tooltip" style="position:relative;display:inline-flex;gap:10px;align-items: baseline;">
                      <label class="custom_radio"><span class="option_no all_options">Not Related</span>
                        <input type="radio" class="radio_ans_intro" id="html" name="answer" value="2">
                        <span class="checkmark "></span>
                      </label>
                    </div>
                  </div>
                </div>

                <div style="padding-left: 30px;gap:5px;">
                  <div style="margin-top: 6px;position:relative;">
                    <div class="set_tooltip" style="position:relative;display:inline-flex;gap:10px;align-items: baseline;">
                      <label class="custom_radio"><span class="option_no all_options">It was great title</span>
                        <input type="radio" class="radio_ans_intro" id="html" name="answer" value="3">
                        <span class="checkmark "></span>
                      </label>
                    </div>
                  </div>
                </div>

              </div>
              <a href="javascript:;" type="button" class="btn btn-primary body_paragraph_submit" style="background-color:#bee131;color:#000;margin-left:10px;position:absolute; bottom:12px;">Submit</a>
            </div>

             <!-- For Conclusion Paragraph -->
             <div class="conclusion_auto_comment" style="display:none;">
              <div style="display:flex;gap:10px;" class="conclusion_auto_comment_component">
                <a type="button" class="btn btn-select2 conclusion_auto_comment_checkbox">Auto Comment</a>
                <select class="form-control conclusion_mark_chose" name="" id="" style="width:50px;">
                  <option value=""></option>
                  <option value="0">0</option>
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="15">15</option>
                  <option value="20">20</option>
                </select>
                <a type="button" class="btn btn-select2">Manual Comment</a>
              </div>
              
            <div class="with_option_conclusion" style="display:none">
                <!-- <div class="auto_comment_box"> -->

                <div style="padding-left:30px;gap:5px;">
                  <div style="margin-top: 6px;position:relative;">
                    <div class="set_tooltip" style="position:relative;display:inline-flex;gap:10px;align-items: baseline;">
                      <label class="custom_radio"><span class="option_no all_options">Not Bad</span>
                        <input type="radio" class="radio_ans_intro" id="html" name="answer" value="1">
                        <span class="checkmark "></span>
                      </label>
                    </div>
                  </div>
                </div>

                <div style="padding-left: 30px;gap:5px;">
                  <div style="margin-top: 6px;position:relative;">
                    <div class="set_tooltip" style="position:relative;display:inline-flex;gap:10px;align-items: baseline;">
                      <label class="custom_radio"><span class="option_no all_options">Not Related</span>
                        <input type="radio" class="radio_ans_intro" id="html" name="answer" value="2">
                        <span class="checkmark "></span>
                      </label>
                    </div>
                  </div>
                </div>

                <div style="padding-left: 30px;gap:5px;">
                  <div style="margin-top: 6px;position:relative;">
                    <div class="set_tooltip" style="position:relative;display:inline-flex;gap:10px;align-items: baseline;">
                      <label class="custom_radio"><span class="option_no all_options">It was great title</span>
                        <input type="radio" class="radio_ans_intro" id="html" name="answer" value="3">
                        <span class="checkmark "></span>
                      </label>
                    </div>
                  </div>
                </div>

              </div>
              <a href="javascript:;" type="button" class="btn btn-primary conclusion_submit" style="background-color:#bee131;color:#000;margin-left:10px;position:absolute; bottom:12px;">Submit</a>
              <a href="javascript:;" type="button" class="btn btn-sm btn-primary save_all_data" style="display:none">Save</a>
            </div>
          </div>
          <div class="col-md-5" style="text-align:right;">
            <a type="button" class="btn btn-select2 story_introduction" style="margin-bottom:10px;width:123px;">Introduction</a>
            <a type="button" class="btn btn-select2 story_body_paragraph" style="margin-bottom:10px;width: 123px;">Body Paragraph</a>
            <a type="button" class="btn btn-select2 story_conclusion" style="width:123px;">Conclusion</a>
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
        <img src="assets/images/icon_info.png" class="pull-left"> <span class="ss_extar_top20">Save Sucessfully</span>
      </div>
      <div class="modal-footer">
        <a href="<?= base_url()?>/tutor" class="btn btn_blue" id="save_success_button_with_url">Ok</a>
      </div>
    </div>
  </div>
</div>

</div>
<div id="make_student_idea_title" style="display:none;">

</div>

<script>
  $(document).ready(function() {

    var get_student_ans = `<?=$student_idea[0]['student_ans']?>`;
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

    $('.spelling_error').click(function() {
      $('.student_idea_text').attr('style', 'display:none;');
      $('.spelling_idea_text').attr('style', 'display:block;');
      $('.creative_sentence_text').attr('style', 'display:none;');
      $('.creative_sentence_show').attr('style', 'display:none;');
      $('.title_menu').hide();
      $('.with_option').hide();
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

        $('.spelling_submit').attr('style', 'background-color:#bee131;color:#000;margin-left:10px;position:absolute;bottom:12px;display:block');
      }

    });

    $(document).delegate('.spelling_submit', 'click', function() {
      $(this).hide();
      var spellings = [];
      $(".spelling_prepend").each(function() {
        spellings.push({
          'word_index': $(this).attr('wordindex'),
          'correct_words': $(this).val()
        });
      });

      var spelling_error_mark = 20 - (spellings.length * 2);
      console.log(spelling_error_mark);

      $(".spelling_error_mark").html(spelling_error_mark);
      $('.spelling_error_mark').attr('style', 'display:block');

      var spelling_text = JSON.stringify(spellings);
      $(".spelling_error_value").val(spelling_text);
      $('#total_spelling_mark').val(spelling_error_mark);

    });



  });



  function call_tutor_idea_question(param) {

    var tutor_ans = $('.student_idea_text').html();
    // console.log(tutor_ans);

    /*===========new code=================*/
    if (tutor_ans != '') {
      var new_sentense = tutor_ans.match(/<p>([^\<]*?)<\/p>/g);
      var get_sentences = new_sentense.slice(1);
      var sentences = new Array();
      var all_answer = '';
      var spelling_answer = '';
      var all_sentense_answer = '';
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
      $('.creative_sentence_text').html(all_sentense_answer);
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

  //Creative Sentence------------
  $('.creative_sentence_text').hide();
  $('.creative_sentence_show').hide();
  $('.creative_sentence').click(function() {
    $('.student_idea_text').attr('style', 'display:none;');
    $('.spelling_idea_text').attr('style', 'display:none;');
    $('.creative_sentence_text').attr('style', 'display:block;');
    $('.creative_sentence_show').show();
    $('.title_menu').hide();
    $('.with_option').hide();
    $('.spelling_submit').hide();
    $('.story_structure_show').attr('style', 'display:none;');
    $(this).attr('style', 'background-color:#00A2E8;color:#fff');
  });

  var every_creative_sentense_index = new Array();
  $(document).delegate('.grammer_answer_new', 'click', function() {
    //alert('jii');
    var id = $(this).attr('data-id');
    var text = $(this).text();
    every_creative_sentense_index.push(id);
    if (every_creative_sentense_index.length > 4) {
      every_creative_sentense_index.pop();
      alert('You can not select more than 4 sentence');
      return false;
    }
    $("#creative_sentence_index").val(every_creative_sentense_index);
    $('.grammer_ans_new' + id).attr('style', 'background-color: rgb(255,201,14);');
    $('.creative_sentence_submit').attr('style', 'background-color:#bee131;color:#000;margin-left:10px;position:absolute;bottom:12px;display:block');
  });

  $('.creative_sentence_submit').click(function(e) {
    $(this).hide();
    $('.creative_sentence_mark_show').attr('style', 'display:block;');
    $('.creative_sentence_mark_show').html(10);
    $('#creative_sentence_mark').val(10);
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
  });

  //Introduction----------------------
  $('.story_introduction').click(function(e) {
    $(this).attr('style', 'background-color:#00A2E8;color:#fff;margin-bottom:10px;width:123px;');
    $('.introduction_auto_comment').attr('style', 'display:block;');
    $('.spelling_idea_text').attr('style', 'display:none;');
    $('.introduction_answer_paragraph').attr('style', 'display:block;');
    $('.student_idea_text').attr('style', 'display:none;');
    $('.body_answer_paragraph').attr('style', 'display:none;');
    $('.conclusion_sentense_paragraph').attr('style','display:none;');
    $('.conclusion_auto_comment').attr('style','display:none;');
  });

  $('.introduction_auto_comment_checkbox').click(function(e) {
        $('.with_option_introduction').attr('style', 'display:block;');
  })

  var every_introduction_sentense_index = new Array();
  $(document).delegate('.grammer_answer_introduction', 'click', function() {
      var id = $(this).attr('data-id');
      every_introduction_sentense_index.push(id);
      if (every_introduction_sentense_index.length > 1) {
        every_introduction_sentense_index.pop();
        alert('You can not select more than one sentence');
        return false;
      }
      $("#every_introduction_index").val(every_introduction_sentense_index);
      $('.grammer_ans_introduction'+id).attr('style','background-color: rgb(255,201,14);');
  });

  $('.introduction_submit').click(function(e){
      var introduction_mark_chose=$('.introduction_mark_chose').val();
      var is_empty = 0;
      var std_val = 0;
      var std_check_val = 0;
      $(".radio_ans_intro").each(function() {
        if ($(this).is(":checked")) {
          is_empty = 1;
          std_val = $(this).val();
        }
      });
      if (is_empty == 0) {
        alert("please checked one of them");
        return false;
      }
      if(introduction_mark_chose == ''){
        alert("please select introduction mark");
        return false;
      }
      $('#introduction_auto_comment_value').val(std_val);
      $('#introduction_point').val(introduction_mark_chose);
      $('.introduction_mark_show').attr('style', 'display:block;');
      $('.introduction_mark_show').html(introduction_mark_chose);
  });

  //story_body_paragraph----------------------
  $('.story_body_paragraph').click(function(e){
      $(this).attr('style', 'background-color:#00A2E8;color:#fff;margin-bottom:10px;width:123px;');
      $('.introduction_auto_comment').attr('style', 'display:none;');
      $('.spelling_idea_text').attr('style', 'display:none;');
      $('.student_idea_text').attr('style', 'display:none;');
      $('.introduction_answer_paragraph').attr('style', 'display:none;');
      $('.conclusion_sentense_paragraph').attr('style','display:none;');
      $('.body_answer_paragraph').attr('style', 'display:block;');
      $('.body_paragraph_auto_comment').attr('style', 'display:block;');
      $('.conclusion_auto_comment').attr('style','display:none;');
      $('.body_paragraph_auto_comment_component').show();
  });

  $('.body_paragraph_auto_comment_checkbox').click(function(e){
       $('.with_option_body_paragraph').attr('style','display:block;');
  });

  var every_body_sentense_index = new Array();
  $(document).delegate('.grammer_answer_body ','click',function(){
      var id = $(this).attr('data-id');
      every_body_sentense_index.push(id);
      if (every_body_sentense_index.length > 1) {
          every_body_sentense_index.pop();
          alert('You can not select more than one sentence');
          return false;
      }
      $("#every_body_index").val(every_body_sentense_index);
      $('.grammer_ans_body'+id).attr('style','background-color: rgb(255,201,14);');

  });

  $('.body_paragraph_submit').click(function(e){
      var body_paragraph_mark_chose=$('.body_paragraph_mark_chose').val();
      var is_empty = 0;
      var std_val_new = 0;
      var std_check_val = 0;
      $(".radio_ans_intro").each(function() {
        if ($(this).is(":checked")) {
          is_empty = 1;
          std_val_new = $(this).val();
        }
      });
      if (is_empty == 0) {
        alert("please checked one of them");
        return false;
      }
      if(body_paragraph_mark_chose == ''){
        alert("please select introduction mark");
        return false;
      }
      $('#body_paragraph_auto_comment_value').val(std_val_new);
      $('#body_paragraph_point').val(body_paragraph_mark_chose);
      $('.body_paragraph_mark_show').attr('style', 'display:block;');
      $('.body_paragraph_mark_show').html(body_paragraph_mark_chose);
  });

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

  $('.conclusion_auto_comment_checkbox').click(function(e){
       $('.with_option_conclusion').attr('style','display:block;');
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

  $('.conclusion_submit').click(function(e){
      var conclusion_mark_chose=$('.conclusion_mark_chose').val();
      var is_empty = 0;
      var std_val_news = 0;
      $(".radio_ans_intro").each(function() {
        if ($(this).is(":checked")) {
          is_empty = 1;
          std_val_news = $(this).val();
        }
      });
      if (is_empty == 0) {
        alert("please checked one of them");
        return false;
      }
      if(conclusion_mark_chose == ''){
        alert("please select introduction mark");
        return false;
      }
      $(this).hide();
      $('#conclusion_auto_comment_value').val(std_val_news);
      $('#conclusion_point').val(conclusion_mark_chose);
      $('.conclusion_mark_show').attr('style', 'display:block;');
      $('.conclusion_mark_show').html(conclusion_mark_chose);
      $('.save_all_data').attr('style','display:block;background-color:#bee131;color:#000;margin-left:10px;position:absolute; bottom:12px;');
      $('.conclusion_auto_comment_component').hide();
      $('.with_option_conclusion').hide();
  });

  $('.save_all_data').click(function(e){


        //  var title_comment=$('#title_comment').val();
        //  var title_mark=$('#total_title_mark').val();
        //  var total_spelling_mark=$('#total_spelling_mark').val();
        //  var spelling_error_value=('.spelling_error_value').val();
        //  var creative_sentence_mark=('#creative_sentence_mark').val();
        //  var creative_sentence_index=$('#creative_sentence_index').val();
        //  var every_introduction_index=$('#every_introduction_index').val();
        //  var introduction_auto_comment_value=$('#introduction_auto_comment_value').val();
        //  var introduction_point=$('#introduction_point').val();
        //  var body_paragraph_index=$('#every_body_index').val();
        //  var body_paragraph_auto_comment_value=$('#body_paragraph_auto_comment_value').val();
        //  var body_paragraph_point=$('#body_paragraph_point').val();
        //  var every_conclusion_index=$('#every_conclusion_index').val();
        //  var conclusion_auto_comment_value=$('#conclusion_auto_comment_value').val();
        //  var conclusion_point=$('#conclusion_point').val();
         var data=$("#given_idea_point").serialize();

         $.ajax({
            url: "Admin/teacher_given_idea_point",
            method: "POST",
            enctype: 'multipart/form-data',
            data: data,
            cache: false,
            dataType: 'json',
            success: function(data) {
                if(data==1){
                    var url = "<?=$_SERVER['HTTP_REFERER']?>";
                    $("#ss_sucess_mess").modal('show');
                }else{
                    alert('All ready Submitted');
                }
                location.href=url;
            }
         });
  });
</script>