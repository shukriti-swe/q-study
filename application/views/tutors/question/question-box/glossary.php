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
    /* margin-left: 20px; */
    height: 25px;
    width: 25px;
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
  .btn-sm {
    padding: 1px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
    text-align: center;
  }
  .added_hint_color{
    display: flex;
    gap: 3px;
    border: 1px solid #c3c3c3;
    margin-bottom: 5px;
    padding: 2px;
    width: 100px;
  }
  .hint_words{
    margin-right: 5px;
    margin-bottom: 5px;
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
  .grammer_answer{
    margin-top:2px;
  }

  
</style>




<div class="row" id="first_section">
  <div class="col-sm-2">
    <input type="hidden" id="text_one_hint" name="text_one_hint" value="">
    <input type="hidden" id="text_two_hint" name="text_two_hint" value="">
    <input type="hidden" id="text_one_hint_no" name="text_one_hint_no" value="">
    <input type="hidden" id="text_two_hint_no" name="text_two_hint_no" value="">
    <input type="hidden" id="text_one_hint_color" name="text_one_hint_color" value="">
    <input type="hidden" id="text_two_hint_color" name="text_two_hint_color" value="">

    <input type="hidden" id="option_hint_set" name="option_hint_set" value="">
  </div>
  <div class="col-sm-10">
    <div class="idea_setting_mid">

      <div class="form-group" style="float: left;margin-right: 10px;">
        <div>
          <button type="button" class="btn btn-select" id="title_button">Title</button>
        </div>
      </div>

      <div class="form-group" style="float: left;margin-right: 10px;">
        <div>
          <button type="button" class="btn btn-select image_upload">Image Upload</button>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col-sm-5"></div>
      <div class="col-sm-6">
        <br><br>
        <div class="comprehension_questions">
          <!-- <div id="com_question" style="margin-left: 57px;">
             <img class="comprehension_image" src="assets/images/images/question.png">
            </div><br>
            <div id="com_options" style="display:flex;">
              <div class="">
                <label class="customcheckbox">
                  <input type="checkbox" class="option_no">
                  <span class="checkmark"></span>
                </label>
              </div>
              <img class="com_hint_image" src="assets/images/images/hint_box.png"><img class="com_option_image" src="assets/images/images/question.png">
            </div> -->
        </div>

        <div class="option_list" style="display: none;">

        </div>

      </div>
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
          <div class="color_choose">
            <input type="radio" class="color_input" name="title_color" value="#ffff00;">
            <div class="color_set" style="background-color: #ffff00;"></div>
          </div>
          <div class="color_choose">
            <input type="radio" class="color_input" name="title_color" value="#0f0;">
            <div class="color_set" style="background-color: #0f0;"></div>
          </div>
          <div class="color_choose">
            <input type="radio" class="color_input" name="title_color" value="#0ff;">
            <div class="color_set" style="background-color: #0ff;"></div>
          </div>
          <div class="color_choose">
            <input type="radio" class="color_input" name="title_color" value="#f0f;">
            <div class="color_set" style="background-color: #f0f;"></div>
          </div>
          <div class="color_choose">
            <input type="radio" class="color_input" name="title_color" value="#00f;">
            <div class="color_set" style="background-color: #00f;"></div>
          </div>

        </div>
        <div class="color_list">
          <div class="color_choose">
            <input type="radio" class="color_input" name="title_color" value="#f00;">
            <div class="color_set" style="background-color: #f00;"></div>
          </div>
          <div class="color_choose">
            <input type="radio" class="color_input" name="title_color" value="#ffc90e;">
            <div class="color_set" style="background-color: #ffc90e;"></div>
          </div>
          <div class="color_choose">
            <input type="radio" class="color_input" name="title_color" value="#c8bfe7;">
            <div class="color_set" style="background-color: #c8bfe7;"></div>
          </div>
          <div class="color_choose">
            <input type="radio" class="color_input" name="title_color" value="#b5e61d;">
            <div class="color_set" style="background-color: #b5e61d;"></div>
          </div>
          <div class="color_choose">
            <input type="radio" class="color_input" name="title_color" value="#22b14c;">
            <div class="color_set" style="background-color: #22b14c;"></div>
          </div>
        </div>
        <br>
        <textarea class="form-control question_description" name="question_title_description"></textarea>
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
              <textarea id="writing_input" class="form-control writing_input mytextarea" name="writing_input"></textarea>
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
          <textarea id="image_ques_body" class="form-control mytextarea" name="image_ques_body"></textarea>
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


<!-- ============================ All Modal End ========================== -->



<script type="text/javascript">
  $(document).ready(function() {

    $('#title_button').click(function() {
      $('#question_title_description').modal('show');

    });

    $('.color_choose').click(function() {
      $('.color_choose').css('border', 'none');
      $(this).css('border', '1px solid red');
      $('input[type=radio]', this).attr("checked", true);
    });

    $('.saveTitle').click(function() {
      $('#question_title_description').modal('hide');
      $('#title_button').css('background-color', '#00a2e8;');
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
        url: "glossary_image_upload",
        method: 'POST',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#msg').html('Loading......');
        },
        success: function(data) {

            var img = '<img  class="image-editor" data-height="250" data-width="200" height="179" src="<?= base_url() ?>/assets/glossary/' + data + '" width="281" />';

            $('#image_ques_body').val(img);


        }
        });
    });

    $('#comprehension_image_save').click(function() {
       $('#image_details').modal('hide');
       $('.image_upload').css('background-color', '#00a2e8;');
    });

  });
</script>