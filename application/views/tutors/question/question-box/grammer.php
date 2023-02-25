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

  .change_hint_question {
    /* margin-left: 20px; */
    height: 35px;
    width: 30px;
    cursor: pointer;
  }

  .set_color_section{
    display:flex;
    justify-content: center;
    max-width: 500px;
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
  #add_note{
    margin-top: 10px;
    padding: 3px 16px 7px 5px;
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
  .one_color_added{
    width: 105px;
  }
  .two_color_added{
    width: 105px;
  }
  .three_color_added{
    width: 105px;
  }
  .four_color_added{
    width: 105px;
  }

  
</style>


<div class="row" id="first_section" >
  <div class="col-sm-2">
    <input type="hidden" id="text_one_hint" name="text_one_hint" value="">
    <input type="hidden" id="text_two_hint" name="text_two_hint" value="">

    <input type="hidden" id="text_one_hint_no" name="text_one_hint_no" value="">
    <input type="hidden" id="text_two_hint_no" name="text_two_hint_no" value="">
    <input type="hidden" id="text_three_hint_no" name="text_three_hint_no" value="">
    <input type="hidden" id="text_four_hint_no" name="text_four_hint_no" value="">

    <input type="hidden" id="text_one_hint_color" name="text_one_hint_color" value="">
    <input type="hidden" id="text_two_hint_color" name="text_two_hint_color" value="">
    <input type="hidden" id="text_three_hint_color" name="text_three_hint_color" value="">
    <input type="hidden" id="text_four_hint_color" name="text_four_hint_color" value="">

    <input type="hidden" id="option_hint_set" name="option_hint_set" value="">
    <div id="all_option_input">

    </div>
  </div>
  <div class="col-sm-10">
    <div class="idea_setting_mid">

      <div class="form-group" style="float: left;margin-right: 10px;">
        <div>
          <button type="button" class="btn btn-select writing_input">Writing Input</button>
        </div>
      </div>

      <div class="form-group" style="float: left;margin-right: 10px;">
        <div>
          How Many Row <input type="number" name="total_rows" id="total_options" class="form-control w-50">
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

<div class="row" id="second_section" style="display: none;">
  <div class="col-sm-2"></div>
  <div class="hint_ans_box col-sm-8">

   <div class="set_color_section">
        <div class="set_color_show_one" style="margin-right: 10px;">
          <div class="selected_color_one" data-id="1">
          </div>

          <div class="selected_color_two" data-id="2">
          </div>
        </div>

        <div class="set_color_show_two" style="margin-right: 10px;">
          <div class="selected_color_three" data-id="3">
          </div>

          <div class="selected_color_four" data-id="4">
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
         <a type="button" style="padding-left: 15px;"><img class="change_hint_question" src="assets/images/images/hint_box_write.png"></a>
         <a id="add_note">Hint<img style="height:20px;width:20px;" class="light_image" src="assets/images/images/light.png"></a>
       </div>
       <div id="add_input_color_serial">

        </div>
   </div>

   <div class="hint_selection_content">
   </div>
   <div id="word_remake" style="display:none;"></div>
  </div>
</div>




<!-- ============================ All Modal Start ========================== -->

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


<div class="modal fade ss_modal ew_ss_modal" id="com_question_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
      </div>
      <div class="modal-body">

        <br>
        <textarea class="form-control question_description" name="com_question"></textarea>
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


      </div>
      <div class="modal-footer option_footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Save</button>

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
        <textarea class="form-control question_description" name="first_hint"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
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
        <textarea class="form-control question_description" name="second_hint"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue " data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal ew_ss_modal" id="third_hint_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
      </div>
      <div class="modal-body">

        <br>
        <textarea class="form-control question_description" name="third_hint"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal ew_ss_modal" id="fourth_hint_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
      </div>
      <div class="modal-body">

        <br>
        <textarea class="form-control question_description" name="four_hint"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade ss_modal ew_ss_modal" id="hint_text_change_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
      </div>
      <div class="modal-body hint_text_modal_body">
        
      </div>
      <div class="modal-footer hint_text_modal_footer">
        
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
        <textarea class="form-control hint_text_one_textarea" name="note_description"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue noteModalButton">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- ============================ All Modal End ========================== -->



<script type="text/javascript">
  $(document).ready(function() {

    $('.writing_input').click(function() {
      $('#writing_input_description').modal('show');

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

      var question_with_option = '';
      var option_input ='';
      var option_save = '';
 
      for(var j=1;j<=total_number;j++){
        if(j==1){
          question_with_option += '<div class="option_with_no'+j+'" id="com_question" style="margin-left: 57px;cursor:pointer;"><img class="comprehension_image" src="assets/images/images/question.png"></div><br><div class="com_options" style="display:flex;"><div class=""><label class="customcheckbox"><input type="checkbox" class="option_no" name="option_check[]" value="'+j+'"><span class="checkmark"></span></label></div><img data-id="'+j+'" class="com_hint_image" src="assets/images/images/hint_box.png"><img class="com_option_image modify_option' +j+ '" data-id="' +j+ '" src="assets/images/images/question.png"></div>';
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
      
      var wrrite_input = CKEDITOR.instances['writing_input'].getData();
      var paragraphs = [];
      if(wrrite_input != ''){
        $('#second_section').show();
        $('#first_section').hide();
        // var get_sentences =  wrrite_input.match(/<p>([^\<]*?)<\/p>/g);
        $('#word_remake').html(wrrite_input);
        $("#word_remake p").each(function(){
           paragraphs.push($(this).html());
        });
        var get_sentences = paragraphs;
        var sentences = new Array();
        var all_answer = '';
        var all_input = '';
        var html = '';
        var html2= '<button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>';
        for(var i=0; i<get_sentences.length;i++){
          var get_sentence = get_sentences[i].replace(/(<([^>]+)>)/ig,"");
          var index = i+1;
          all_answer += '<h6 class="grammer_answer grammer_ans'+index+'" data-id="'+index+'">'+get_sentence+'</h6>';
          all_input += '<input type="hidden" name="option[]" value="'+get_sentence+'">';
          sentences.push(get_sentence);

          html += '<textarea class="form-control hint_textarea hint_textarea_no'+index+'" data-id="'+index+'" name="hint_text[]">'+get_sentence+'</textarea>';
          html2 += '<button type="button" class="btn btn_blue hint_save_button hint_save_button_no'+index+'" data-dismiss="modal" data-id ="'+index+'">Save</button>';
        }
        // console.log(get_sentences);
        $('.hint_selection_content').html(all_answer);
        $('#all_option_input').html(all_input);
        $('.hint_text_modal_body').html(html);
        $('.hint_text_modal_footer').html(html2);

      }else{
        alert('First You need to write Writing input');
      }

    });

    $(document).on('click', '.hint_words', function() {
        var text = $(this).text();
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

    });

    $(document).on('click', '.hint_color_choose', function() {
      var get_color = $('input[type=radio]', this).val();
      var check_length = $('.selected_color_set').length;
      //alert(check_length);
      var index = check_length+1;

      



      var check_one_length = $('.one_color_added').length;
      var check_two_length = $('.two_color_added').length;
      var check_three_length = $('.three_color_added').length;
      var check_four_length = $('.four_color_added').length;
      

      if(check_one_length==0){
        var word_concat = get_color+',,'+1;
        var inputs = '<input type="hidden" name="color_serial[]" class="" value="'+word_concat+'">';
        $('#text_one_hint_color').val(get_color);

        var html ='<div class="selected_color_set one_color_added" data-id="1" style="display:flex;gap:5px;border:1px solid #c3c3c3;margin-bottom:5px;padding:2px;"><div class="hint_color_list"><div class="hint_chosen_color"><input type="radio" class="hint_color_input take_input_color" data-id="1" name="title_color" value="'+get_color+'"><div class="hint_color_set" style="background-color: '+get_color+';"></div></div></div><img class="add_hint_question hint_text_change" data-id="1" src="assets/images/images/question_write.png"><a class="clear_hint_by clear_hint1" data-id="1" type="button" style="text-decoration: underline;">clear</a></div>';

        $('.selected_color_one').append(html);
        $('#add_input_color_serial').append(inputs);
      }else if(check_two_length==0){
        var word_concat = get_color+',,'+2;
        var inputs = '<input type="hidden" name="color_serial[]" class="" value="'+word_concat+'">';
        $('#text_two_hint_color').val(get_color);

        var html ='<div class="selected_color_set two_color_added" data-id="2" style="display:flex;gap:5px;border:1px solid #c3c3c3;margin-bottom:5px;padding:2px;"><div class="hint_color_list"><div class="hint_chosen_color"><input type="radio" class="hint_color_input take_input_color" data-id="2" name="title_color" value="'+get_color+'"><div class="hint_color_set" style="background-color: '+get_color+';"></div></div></div><img class="add_hint_question hint_text_change" data-id="2" src="assets/images/images/question_write.png"><a class="clear_hint_by clear_hint2" data-id="2" type="button" style="text-decoration: underline;">clear</a></div>';

        $('.selected_color_two').append(html);
        $('#add_input_color_serial').append(inputs);
      }else if(check_three_length==0){
        var word_concat = get_color+',,'+3;
        var inputs = '<input type="hidden" name="color_serial[]" class="" value="'+word_concat+'">';
        $('#text_three_hint_color').val(get_color);

        var html ='<div class="selected_color_set three_color_added" data-id="3" style="display:flex;gap:5px;border:1px solid #c3c3c3;margin-bottom:5px;padding:2px;"><div class="hint_color_list"><div class="hint_chosen_color"><input type="radio" class="hint_color_input take_input_color" data-id="3" name="title_color" value="'+get_color+'"><div class="hint_color_set" style="background-color: '+get_color+';"></div></div></div><img class="add_hint_question hint_text_change" data-id="3" src="assets/images/images/question_write.png"><a class="clear_hint_by clear_hint3" data-id="3" type="button" style="text-decoration: underline;">clear</a></div>';

        $('.selected_color_three').append(html);
        $('#add_input_color_serial').append(inputs);
      }else if(check_four_length==0){
        var word_concat = get_color+',,'+4;
        var inputs = '<input type="hidden" name="color_serial[]" class="" value="'+word_concat+'">';
        $('#text_four_hint_color').val(get_color);

        var html ='<div class="selected_color_set four_color_added" data-id="4" style="display:flex;gap:5px;border:1px solid #c3c3c3;margin-bottom:5px;padding:2px;"><div class="hint_color_list"><div class="hint_chosen_color"><input type="radio" class="hint_color_input take_input_color" data-id="4" name="title_color" value="'+get_color+'"><div class="hint_color_set" style="background-color: '+get_color+';"></div></div></div><img class="add_hint_question hint_text_change" data-id="4" src="assets/images/images/question_write.png"><a class="clear_hint_by clear_hint4" data-id="4" type="button" style="text-decoration: underline;">clear</a></div>';

        $('.selected_color_four').append(html);
        $('#add_input_color_serial').append(inputs);
      }else{
        alert('Sorry, You selected four color !!');
      }
       
    });

    $(document).on('click', '.hint_chosen_color', function() {
      $('.hint_chosen_color').css('border', 'none');
      $(this).css('border', '1px solid red');
      $('input[type=radio]', this).attr("checked", true);
    });

    $(document).on('click', '.grammer_answer', function() {

      var get_color ='';
      var get_id = '';
      $('.take_input_color').each(function(){
        if($(this).is(':checked')){
          get_color = $(this).val();
          get_id = $(this).attr('data-id');
        }
      });

      if(get_color != ''){

        $('.grammer_answer').each(function(){
          var color_no =  $(this).attr('data-color_no');
          if(color_no != '' && color_no==get_id){
            $(this).removeAttr('data-color_no');
            $(this).removeAttr('style');
          }
        });

        $(this).css('background-color',get_color);
        $(this).attr('data-color',get_color);
        $(this).attr('data-color_no',get_id);

      }else{
        alert('you have to select at least one color.');
      }
      
    });

    $(document).on('click', '.set_color_with_text', function() {
        var get_color ='';
        var get_id ='';
        $('.take_input_color').each(function(){
          
          if($(this).is(':checked')){
            get_color = $(this).val();
            get_id = $(this).attr('data-id');
            get_text = $('.grammer_ans'+get_id).text();
            get_text_color_id = '';

            $('.grammer_answer').each(function(){
              var chk_color_no = $(this).attr('data-color_no');
              if(chk_color_no == get_id ){
                get_text_color_id = $(this).attr('data-id');
                get_text_color = $(this).attr('data-color');
              }
            });
           
            if(get_text_color_id !=''){
              if(get_text_color_id==1){
                $('#first_hint_modal').modal('show');
                $('#text_one_hint_color').val(get_text_color);
              }else if(get_text_color_id==2){
                $('#second_hint_modal').modal('show');
                $('#text_two_hint_color').val(get_text_color);
              }else if(get_text_color_id==3){
                $('#third_hint_modal').modal('show');
                $('#text_three_hint_color').val(get_text_color);
              }else if(get_text_color_id==4){
                $('#fourth_hint_modal').modal('show');
                $('#text_four_hint_color').val(get_text_color);
              }
             
            }else{
              alert('Please select all text with color !!');
            }
            
          }
        });
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
      $('.check_set_text_one').hide();
    });

    $(document).on('click', '.clear_hint_two', function() {
      $('.hint_words').each(function(){ 
        var chk_two_status = $(this).attr('data-id');
          if(chk_two_status != '' && chk_two_status==2){
            $(this).removeAttr('data-id');
            $(this).removeAttr('style');
          }
      });
      $('.check_set_text_two').hide();
    });

    $('.change_hint_question').click(function(){
      $('#second_section').hide();
      $('#first_section').show();
    });

    $(document).on('click', '.option_no', function() {
      $(".option_no").prop('checked', false); 
      $(this).attr('checked',true);
    });

    $(document).on('click', '.clear_hint_by', function() {
      var my_id = $(this).attr('data-id');

      $('.grammer_answer').each(function(){
      var color_no = $(this).attr('data-color_no');

      if(my_id==1){
        $('.selected_color_one').html('');
      }else if(my_id==2){
        $('.selected_color_two').html('');
      }else if(my_id==3){
        $('.selected_color_three').html('');
      }else if(my_id==4){
        $('.selected_color_four').html('');
      }

        if(color_no == my_id){
          $(this).removeAttr('data-color_no');
          $(this).removeAttr('style');

          if(color_no ==1){
            $('#text_one_hint_color').val('');
          }else if(color_no ==2){
            $('#text_two_hint_color').val('');
          }else if(color_no ==3){
            $('#text_three_hint_color').val('');
          }else if(color_no ==4){
            $('#text_four_hint_color').val('');
          }
        }
      });

      
    });

    $(document).on('click', '.hint_text_change', function() {
       var id = $(this).attr('data-id');
       $('.hint_textarea').hide(); 
       $('.hint_save_button').hide();
       $('.hint_textarea_no'+id).show();
       $('.hint_save_button_no'+id).show();
       $('#hint_text_change_modal').modal('show');
    });

    $(document).on('click', '.hint_save_button', function() {
       var id = $(this).attr('data-id');
       var hint_text = $('.hint_textarea_no'+id).val();
       $('.grammer_ans'+id).text(hint_text);
    }); 

    $('#add_note').click(function(){
      $('#add_note_modal').modal('show');
    });

    $(".noteModalButton").click(function (){
      $('#add_note_modal').modal('hide');
    });

  });
</script>