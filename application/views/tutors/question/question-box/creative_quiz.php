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
  #search_view{
    display: block;
    border: 1px solid #ccc;
    margin-top: 5px;
    padding: 5px;
    border-radius: 10px;
    width:90%;
  }
  .search_button{
    cursor: pointer;
  }

  .btn_new{
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    margin-right: 3px;
    border: none;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    border:1px solid #ddd9c3;
  }
</style>


<input type="hidden" id="idea_storage">
<input type="hidden" name ="duplicate_question_id" id="duplicate_question_id">
<input type="hidden" id="duplicate_idea_title">
<input type="hidden" id="duplicate_title_idea" name="duplicate_title_idea">

<div class="row">
  <div class="col-sm-12">
    <div class="idea_setting_mid">
      <div class="form-group" style="float: left;margin-right: 10px;">
        <input type="checkbox" name="short_question_allow" value="1" class="short_question_checkbox"> <label id='shot_question_box'> <img src="assets/images/icon_new.png"> New
        </label>
        <div>
          <button type="button" class="btn btn-default show_short_question">Question</button>
        </div>
      </div>

      <div class="form-group" style="float: left;margin-right: 10px;display:none !important" id="dup_ques_short_ques">
        <input type="checkbox" name="short_question_allow" value="1" class="short_question_checkbox"> <label id='shot_question_box'> <img src="assets/images/icon_new.png"> New
        </label>
        <div>
          <button type="button" class="btn btn-default show_short_question_dup">Question</button>
        </div>
      </div>

      <div class="form-group" style="justify-content: center;float: left;margin-right: 10px;">
        <!-- <label><input type="checkbox" name=""> </label><a id="large_question" type="button"><img src="assets/images/icon_new.png"> New</a>  -->
        <input type="checkbox" name="large_question_allow" value="1" class="large_question_checkbox"> <label id='large_question'> <img src="assets/images/icon_new.png"> New
        </label>
        <!-- <label id='large_question_box'> <input type="checkbox" name="">   <img src="assets/images/icon_new.png"> New
          </label> -->
        <div>
          <button type="button" class="btn btn-default show_large_question">Detail Question</button>
        </div>
      </div>
      <div class="form-group" style="float: left;margin-right: 10px;">
        <div>
          <button type="button" class="btn btn-select  ">Student Title
            <input type="hidden" name="student_title" value="0">
            <input type="checkbox" class="student_title" name="student_title" value="1">
          </button>
        </div>
      </div>
      <div class="form-group text-center" style="float: left;margin-right: 10px;">
        <label> <span> Word Limit</span> </label>
        <select class="form-control w-50" id="word_limit_set" name="word_limit">
          <option value="00">00</option>
          <option value="30">30</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="200">200</option>
          <option value="300">300</option>
          <option value="400">400</option>
          <option value="500">500</option>
        </select>
      </div>
      <div class="form-group text-center" style="float: left;margin-right: 10px;">
        <label> <span> Time To Answer</span> </label>
        <div class="d-flex">
          <input type="text" id="time_hour" class="form-control w-50" name="time_hour" value="00">
          <input type="text" id="time_min" class="form-control w-50" name="time_min" value="00">
          <input type="text" id="time_sec" class="form-control w-50" name="time_sec" value="00">
        </div>
      </div>
      <div class="form-group text-center" style="float: left;margin-right: 10px;">
        <label> <span> Allow Ideas</span> </label>
        <div style="height:34px">
          <input type="checkbox" id="allow_idea" name="allow_idea" value="1">
        </div>
      </div>
      <div class="form-group text-center" style="float: left;margin-right: 10px;">
        <label> <span> Add start button</span> </label>
        <div style="height:34px">
          <input type="checkbox" id="add_start_button" name="add_start_button" value="1">
        </div>
      </div>


    </div>

    <div class="idea_setting_mid_bottom">
      <div class="all_idea">
        <?php $i = 1;
        if (!empty($all_idea)) {
          foreach ($all_idea as  $ideas) { ?>
            <div class="form-group" style="float: left;margin-right: 10px;">
              <?php if ($i == 1) { ?>
                <label id="create_new_idea"> <span><img src="assets/images/icon_new.png"> New</span> </label>
              <?php } ?>
              <div>

                <input type="hidden" name="idea_name" value="idea<?= $i; ?>">
                <input type="hidden" name="idea_details[]" value='<?= $ideas['id']; ?>,,,<?= $ideas['idea_title']; ?>,,,<?= $ideas['question_description']; ?>,,,<?= $ideas['total_word']; ?>'>

                <button type="button" class="btn btn-select-border color_change idea<?= $i; ?>" onclick="showIdea(<?= $i; ?>)">Idea <?= $i; ?></button>
              </div>
            </div>
          <?php $i++;
          }
        } else { ?>
          <div class="form-group" style="float: left;margin-right: 10px;">

            <label id="create_new_idea"> <span><img src="assets/images/icon_new.png"> New</span> </label>

            <div class="empty_idea">
              <button id="idea1" type="button" class="btn btn-select-border">Idea- </button>
            </div>
            <div class="all_idea_show" style="margin-top:5px;">

            </div>
          </div>
        <?php }

        ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="rs_word_limt">
          <div class="top_word_limt">
            <!-- <span id="word_show"><b id="total_idea_word">90</b> Words</span> -->
            <span style="margin:0 auto;" class="m-auto"><input id="time_show" class="form-control text-center" type="text" value="00:05:00" name=""></span>
            <span class="m-auto word_limit_show">Word Limit <span class="m-auto b-btn word_limit_number_show">100</span></span>
          </div>
          <div class="btm_word_limt">
            <div class="content_box_word">
              <textarea id="word_count" class="form-control idea_main_body mytextarea" name="idea_main_body"></textarea>
            </div>
          </div>
          <div class="created_name question_idea_show" style="display:none;">
              <img id="question_idea_show_icon" src="assets/images/hand_with_pen_blue.PNG"> <a href="javascript:;" id="idea_creator_details"> <u>Idea Created By :</u> </a> &nbsp; <b class="idea_creator"> </b>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div style="overflow: hidden;">
          <input type="hidden" id="selected_search" value="">
          <div class="form-group" style="float: left;margin-right: 10px;">
            <div>
              <button type="button" class="btn btn-select question_title">Question & Idea Title </button>
            </div>
          </div>
          <div class="form-group" style="float: left;margin-right: 10px;display:none;">
               <a type="button" class="btn btn-select clear_idea" style="display:none;">Clear</a>
          </div>
          <div class="form-group" style="float: left;margin-right: 10px;">
            <div>
              <img src="assets/images/search_a.png" id="advance_searc_op">
            </div>
          </div>
          <!-- aa -->
          <div class="form-group" style="float: left;margin-right: 10px;">
            <div>
              <button type="button" class="btn btn-select" id="image_search_button">Image</button>
            </div>
          </div>
          <div class="form-group" style="float: left;margin-right: 10px;">
               <a type="button" class="btn btn-select clear_image_idea" style="display:none;">Clear</a>
          </div>
          <div class="form-group" style="float: left;margin-right: 10px;display:none;">

          </div>
          <div class="form-group" style="float: left;margin-right: 10px;cursor:pointer;">
            <div>
              <img src="assets/images/search_a.png" id="advance_searc_image">
            </div>
          </div>
        </div>


        <div style="overflow: hidden;">
          <div id="advance_searc_content" style="display:none;">
            <div class="serach_list" >
              <div class="input-group">
                <input type="search" class="form-control" placeholder="Search" name="search" id="advance_searc_content_src" value="" data-id="2">
                <div class="input-group-btn">
                  <a class="btn btn-default" id="advance_idea_search_button" data-id="2" type="button"><i class="glyphicon glyphicon-search"></i></a>
                </div>
              </div>
            </div>
            <div id="search_view">


            </div>
          </div>
          <br>
        </div>

        <div style="overflow: hidden;">
          <div id="image_search_bar" style="">
            <div class="serach_list" >
              <div class="input-group">
                <input type="search" class="form-control" placeholder="Search" name="search" id="advance_searc_image_src" value="">
                <div class="input-group-btn">
                  <a class="btn btn-default" type="button" id="advance_image_search_button"><i class="glyphicon glyphicon-search"></i></a>
                </div>
              </div>
            </div>
            <div id="image_search_view">


            </div>
          </div>
          <br>
        </div>




        <!-- ===== new feature ===== -->
        <div style="background-color: #00a2e8;display:none;color:white;" id="short_question_view">

          <div class="modal-header" style="padding: 2px;">
            <h4 id="short_question_view_header" style="background-color: #00a2e8; color:white;font-size: 15px;line-height: 27px;padding-left: 15px;font-weight: bold;letter-spacing: 0.5px;">Question

              <button style="float: right; color:black;background-color: #00a2e8;border:none;" type="button" class="btnclose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </h4>

          </div>

 
          <div class="modal-body">
            <div class="d-flex">
              <input type="checkbox" name="" id="checkbox_titlelimit"> &nbsp;
              <div class="form-group">
                <label style="color:white;margin-bottom:5px;">Title</label>

                <input type="text" id="short_title1" class="form-control shot_question_title " name="shot_question_title" readonly="" maxlength="50">
              </div>
            </div>
            <div class="d-flex" style="display: flex;">
              <!-- <input type="checkbox" name="" id="checkbox_photolimit"> &nbsp;&nbsp; -->
              <label style="color:white" class="this_idea_title"></label>

            </div>

          </div>
          <input type="hidden" value="2" id="check_new_idea">
          <div class="modal-footer add_edit_button">
            <!-- <a href="javascript:" id="short_edit_button" style="float:left;display:none;"><b>Edit<b></a>
            <a href="javascript:" id="short_question_edit" style="float:left;color:white;"><b>Edit<b></a> -->
              <div class="q_created_name">
                  <img src="assets/images/creative_question_square.png" id="short_question_view_hand_icon"> <a href="javascript:;" id="question_creator_details"><u id="q_created_name_text"></u> <u>Question Created By :</u> </a> &nbsp; <b class="question_creator"> </b>
              </div>
          </div>
        </div> 
        <br>
        
        <div style="background-color: #a349a4;color: white;display:none;" id="Idea_view">

          <div class="modal-header" style="padding: 2px;">
            <h4 style="background-color: #a349a4; color:white;font-size: 15px;line-height: 27px;padding-left: 15px;font-weight: bold;letter-spacing: 0.5px;">Idea

              <button style="float: right; color:black;background-color: #a349a4;border:none;" type="button" class="Idea_viewBtnClose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </h4>
          </div>

          <div class="modal-body">
            
            <div class="d-flex">
              <input type="checkbox" name="" id="checkbox_titlelimit2"> &nbsp;
              <div class="form-group">
                <label style="color:#fff; margin-bottom:5px;">Idea/Topic/Story Title</label>
                <input type="text" id="idea_title" class="form-control tutor_write_idea idea_question_title" name="idea_question_title" maxlength="50">
              </div>
            </div>
            <div style="text-align: right;">
              <button class="tutor_make_idea" type="button" style="font-weight:normal;border:none;color:black;padding:8px 15px;border-radius:5px;">save</button>
            </div>

          </div>
        </div>


      </div>
    </div>
  </div>
</div>

<!-- Start Instruction Modal -->
<div class="modal fade ss_modal ew_ss_modal" id="ss_instruction_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Question Instruction </h4>
      </div>
      <div class="modal-body">
        <textarea class="form-control instruction" name="question_instruction"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- End Instruction Modal -->
<!-- Start video Modal -->
<div class="modal fade ss_modal ew_ss_modal" id="ss_video_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Question Video </h4>
      </div>
      <div class="modal-body">
        <textarea class="form-control question_video" name="question_video"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>

<br />

</div>
</div>
</div>
</div>
</div>
</div>

<?php if ($question_item == 11) { ?>
  <div class="col-sm-12">
    <div class="row htm_r" style="margin: 10px 0px;">


    </div>

    <div class="col-sm-2"></div>
    <div class="skip_box col-sm-4">
      <div class="table-responsive">
        <table class="dynamic_table_skpi table table-bordered">
          <tbody class="dynamic_table_skpi_tbody">

          </tbody>
        </table>

        <!-- may be its a draggable modal -->
        <div id="skiping_question_answer" style="display:none">
          <input type="text" name="set_skip_value" class="input-box form-control rs_set_skipValue">
        </div>
      </div>

    </div>
    <div class="col-sm-4">
      <div class="table-responsive">
        <table class="dynamic_table_dividend table table-bordered">
          <tbody class="dynamic_table_dividend_tbody">

          </tbody>
        </table>
      </div>
    </div>
    <div class="col-sm-2 quotient_block">

    </div>
  </div>
<?php } ?>

</div>
</div>
</div>


<!--Set Question Solution on jquery ui-->
<div id="dialog">
  <textarea id="setSolution" style="display:none;"></textarea>
</div>
<input type="hidden" name="question_solution" id="setSolutionHidden" value="">



<!--Set Question Marks-->
<div class="modal fade ss_modal" id="set_marks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <form id="marksValue">
          <div class="row">
            <div class="col-xs-4 sh_input">

              <input type="hidden" class="form-control" name="first_digit" value="0">
            </div>
            <div class="col-xs-4 sh_input">
              <input type="number" class="form-control" name="second_digit">
            </div>
            <div class="col-xs-4">
              <input type="number" class="form-control" name="first_fraction_digit">
              <input type="number" class="form-control" name="second_fraction_digit">
            </div>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" onclick="markData()">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- shot_question -->

<div class="modal fade ss_modal" id="shot_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div style="background-color: #00a2e8; color: white;" class="modal-content">

      <div class="modal-header">
        <h4 style="background-color: #00a2e8; color:white;">Question

          <button style="float: right; color:black;background-color: #00a2e8;border:none;" type="button" class="short_question_close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </h4>

      </div>

      <form class="">
        <div class="modal-body">
          <div id="checkbox_titlelimitidea_alert">
            <div>
              Number of writing task submited on this topic &nbsp; <input class="form-control w-50 idea_number" type="text" value="50" name="">
            </div>

          </div>
          <div class="d-flex">
            <input type="checkbox" name="" id="checkbox_titlelimitidea"> &nbsp;
            <div class="form-group">
              <label style="color:white;">Title</label>
              <input type="text" id="short_title" class="form-control shot_question_title " name="shot_question_title" readonly="" maxlength="50">
            </div>
          </div>
          <div class="d-flex" style="display: flex;">
            <!-- <input type="checkbox" name="" id="checkbox_photolimit"> &nbsp;&nbsp; -->

            <a style="color:white;cursor:pointer;" type="button" id="image_short_question">Image</a>
            <button class="btnclose" type="button" style="margin-left:auto;font-weight:normal;border:none;padding:8px 15px;border-radius:5px;color:black;">save</button>
          </div>

        </div>
        <div class="modal-footer">


        </div>
        <!-- </form> -->
    </div>
  </div>
</div>

<!-- Edit shot_question -->

<div class="modal fade ss_modal " id="edit_shot_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div style="background-color: #e1cbcb;" class="modal-content">

      <div class="modal-header">
        <h4 style="background-color: #e1cbcb; color:#4732e9">Question

          <button style="float: right; color:black;background-color: #e1cbcb;border:none;" type="button" class="short_question_close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </h4>

      </div>

      <form class="">
        <div class="modal-body">
          <div id="checkbox_titlelimitidea_alert">
            <div>
              Number of writing task submited on this topic &nbsp; <input class="form-control w-50 idea_number" type="text" value="50" name="">
            </div>

          </div>
          <div class="d-flex">
            <input type="checkbox" name="" id="checkbox_titlelimitidea"> &nbsp;
            <div class="form-group">
              <label style="color:#4732e9">Title</label>
              <input type="text" id="short_title" class="form-control shot_question_title edit_short_title" name="shot_question_title" readonly="" maxlength="50">
            </div>
          </div>
          <div class="d-flex" style="display: flex;">
            <input type="checkbox" name="" id="checkbox_photolimit"> &nbsp;&nbsp;
            <label style="color:#4732e9">Photo</label>
            <input type="hidden" id="short_question_id" value="">
            <button class="Update_short_question" type="button" style="margin-left:auto;font-weight:normal;border:none;padding:8px 15px;border-radius:5px;">save</button>
          </div>

        </div>
        <div class="modal-footer">


        </div>
        <!-- </form> -->
    </div>
  </div>
</div>


<div class="modal fade ss_modal " id="largequestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div style="background-color: #e1cbcb;" class="modal-content">

      <div class="modal-header">
        <h4 style="background-color: #e1cbcb; color:#4732e9"> Large Question

          <button style="float: right; color:black;background-color: #e1cbcb;border:none;" type="button" class="largebtnclose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </h4>

      </div>

      <form class="">
        <div class="modal-body">
          <div id="checkbox_titlelimit_large_alert">
            <div>
              Number of writing task submited on this topic &nbsp; <input class="form-control w-50 idea_number" type="text" value="50" name="">
            </div>

          </div>
          <div class="d-flex">
            <input type="checkbox" name="" id="checkbox_titlelimitidea_large"> &nbsp;
            <div class="form-group">
              <label style="color:#4732e9">Title</label>
              <input type="text" id="large_title" class="form-control large_question_title " name="large_question_title" readonly="" maxlength="50">
            </div>
          </div>
          <div class="d-flex" style="display: flex;">
            <input type="checkbox" name="" id="checkbox_photolimit"> &nbsp;&nbsp;
            <label style="color:#4732e9">Photo</label>

          </div>

        </div>
        <div class="modal-footer">


        </div>
        <!-- </form> -->
    </div>
  </div>
</div>
<!-- newidea -->

<div class="modal fade ss_modal " id="newidea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div style="background-color: #00a2e8; color: white;" class="modal-content">

      <div class="modal-header">
        <h4 style="background-color: #00a2e8; color: white;">Idea

          <button style="float:right;color:black;background-color:#00a2e8;border:none;" type="button" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </h4>
      </div>

      <form class="">
        <div class="modal-body">
          <div id="checkbox_titlelimit_alert">
            <div>
              Number of task submited on this topic &nbsp; <input class="form-control w-50" type="text" value="50" readonly="" name="">
            </div>

          </div>
          <div class="d-flex">
            <input type="checkbox" name="" id="checkbox_titlelimit"> &nbsp;
            <div class="form-group">
              <label style="color:#fff">Idea/Topic/Story Title</label>
              <input type="text" id="idea_question_title_main" class="form-control shot_question_title " name="idea_question_title" readonly="" maxlength="50" value="">
            </div>
          </div>
          <div style="text-align: right;">
            <button class="ideabtnclose" type="button" style="font-weight:normal;border:none;color:black;padding:8px 15px;border-radius:5px;">save</button>
          </div>
        </div>
    </div>
  </div>
</div>



<div class="modal fade ss_modal" id="newideaimage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div style="background-color: #00a2e8; color: white;" class="modal-content">

      <div class="modal-header">
        <h4 style="background-color: #00a2e8; color:white;">Idea
          <button style="float: right; color:black;background-color:#00a2e8;border:none;" type="button" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </h4>
      </div>

      <form class="">
        <div class="modal-body">
          <div id="checkbox_titlelimit_alert">
            <div>
              Number of task submited on this topic &nbsp; <input class="form-control w-50" type="text" value="50" readonly="" name="">
            </div>

          </div>
          <div class="d-flex">
            <input type="checkbox" name="" id="checkbox_titlelimit"> &nbsp;
            <div class="form-group">
              <label style="color:#fff">Idea/Topic/Story Title</label>
              <input type="text" id="idea_question_title_image" class="form-control shot_question_title " name="idea_question_title_image" readonly="" maxlength="50" value="">
            </div>
          </div>
          <div style="text-align: right;">
            <p style="font-weight: normal;margin-bottom:7px;font-size:16px;">Image <?= $image_no ?></p>
            <button class="imageideatitleclose" type="button" style="font-weight:normal;border:none;padding:8px 15px;color:black;border-radius:5px;">save</button>
          </div>
        </div>
    </div>
  </div>
</div>


<!-- model question -->
<div class="modal fade ss_modal " id="idea_question_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <!-- <form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data"> -->

      <div style="background-color: #eee;" class="modal-body">
        <div style="display: flex;">

          <h6 style="text-align:center;"> Question </h6>

          <button style="color:black;border:none;margin-left: auto;order: 2;" type="button" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>

        </div>
        <div class="row">
          <input type="hidden" id="total_word_ajax" value="7">
          <textarea id="idea_ques_body" class="form-control mytextarea" name="idea_question_body"></textarea>

        </div>
        <div style="text-align: right;">
          <button class="close_idea" type="button" style="font-weight:normal;border:none;margin-top:5px;padding:8px 15px;border-radius:5px;background-color:white;">save</button>
        </div>
      </div>

      <!-- <div class="modal-footer">
          <button type="button" onclick="add_subject()" class="btn btn_blue">Save</button>
          <button type="button" class="btn btn_blue close_ch" data-dismiss="modal">Cancel</button>
        </div> -->
      <!-- </form> -->
    </div>
  </div>
</div>

<div class="modal fade ss_modal " id="edit_idea_question_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <!-- <form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data"> -->

      <div style="background-color: #eee;" class="modal-body">
        <div style="display: flex;">

          <h6 style="text-align:center;"> Idea </h6>

          <button style="color:black;border:none;margin-left: auto;order: 2;" type="button" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>

        </div>
        <div class="row">
          <input type="hidden" id="edit_total_word_ajax" value="7">
          <input type="hidden" id="edit_idea_id" value="7">
          <textarea id="edit_idea_ques_body" class="form-control mytextarea" name="edit_idea_question_body"></textarea>

        </div>
        <div style="text-align: right;">
          <button class="edit_close_idea" type="button" style="font-weight:normal;border:none;margin-top:5px;padding:8px 15px;border-radius:5px;background-color:white;">save</button>
        </div>
      </div>

      <!-- <div class="modal-footer">
          <button type="button" onclick="add_subject()" class="btn btn_blue">Save</button>
          <button type="button" class="btn btn_blue close_ch" data-dismiss="modal">Cancel</button>
        </div> -->
      <!-- </form> -->

    </div>
  </div>
</div>


<!-- model question -->
<div class="modal fade ss_modal " id="image_idea_question_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="top: -150px !important;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <!-- <form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data"> -->

      <div style="background-color: #eee;" class="modal-body">
        <div style="display: flex;">

          <h6 style="text-align:center;"> Question </h6>

          <button style="color:black;border:none;margin-left: auto;order: 2;" type="button" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>

        </div>
        <div class="row">
          <input type="hidden" id="total_image_word_ajax" value="7">
          <textarea id="image_idea_ques_body" class="form-control mytextarea" name="image_idea_question_body"></textarea>

        </div>
        <div style="text-align: right;">
          <button class="close_image_idea" type="button" style="font-weight:normal;border:none;margin-top:5px;padding:8px 15px;border-radius:5px;background-color:white;">save</button>
        </div>
      </div>

      <!-- <div class="modal-footer">
          <button type="button" onclick="add_subject()" class="btn btn_blue">Save</button>
          <button type="button" class="btn btn_blue close_ch" data-dismiss="modal">Cancel</button>
        </div> -->
      <!-- </form> -->
    </div>
  </div>
</div>

<!-- model question -->
<div class="modal fade ss_modal " id="shot_question_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <!-- <form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data"> -->

      <div style="background-color: #eee;" class="modal-body">
        <div style="display: flex;">
          <!-- <a href="#" style="color:black; text-decoration: underline;padding-right:100px;">fgg</a> -->
          <h6 style="margin:auto;padding-left:120px;">Question </h6>

          <button style="color:black;border:none;margin-left: auto;order: 2;" type="button" class="close_ch close_short_question_modal" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>

        </div>
        <div class="row">
          <textarea id="short_ques_body" class="form-control mytextarea" name="short_ques_body"></textarea>
          <button type="button" class="close_short_question" style="float: right;margin-top: 9px;margin-right: 9px;font-weight: normal;border: none;padding: 8px 15px;border-radius: 5px;background: white;">save</button>
        </div>
      </div>

      <!-- <div class="modal-footer">
          <button type="button" onclick="add_subject()" class="btn btn_blue">Save</button>
          <button type="button" class="btn btn_blue close_ch" data-dismiss="modal">Cancel</button>
        </div> -->
      <!-- </form> -->
    </div>
  </div>
</div>

<!-- model question -->
<div class="modal fade ss_modal " id="shot_image_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="top:-120px !important;">
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
            <button class="image_idea_save" type="button" style="position:absolute;right:10px;top:-5px;border: none;padding: 8px 15px;border-radius: 5px;background: white;">save</button>
          </div>
          <input type="hidden" class="check_image" value="2">
          <input type="hidden" class="idea_image_name" value="no_image.png">
        </div>
      </div>

    </div>
  </div>
</div>

<div class="modal fade ss_modal " id="large_question_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <!-- <form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data"> -->

      <div style="background-color: #eee;" class="modal-body">
        <div style="position:relative;">

          <h6 style="text-align:center;"> Detail Question </h6>

          <button style="color:black;border:none;position:absolute;right:10px;top:1px;" type="button" class="close_ch close_large_question" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>

        </div>
        <div class="row">

          <textarea id="large_ques_body" class="form-control mytextarea" name="large_ques_body"></textarea>

        </div>
      </div>

      <div class="modal-footer" style="background-color:#eee;">
        <button type="button" class="btn large_question_close" style="background-color:white;">Save</button>
      </div>
      <!-- </form> -->
    </div>
  </div>
</div>

<div class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="question_create_failed">
  <!-- Modal -->
  <div style="max-width: 20%;" class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">
        <p><i class="fa fa-pencil" style="font-size:28px;color:#f5d743;"></i></p>
        <p>This question already exists.</p>
        <p>You can write an idea.</p>

      </div>
      <div class="modal-footer">
        <button type="button" id="preview_success" class="btn btn_blue" data-dismiss="modal">Ok</button>
      </div>

    </div>
  </div>

</div>

<div class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="idea_create_failed">
  <!-- Modal -->
  <div style="max-width: 20%;" class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">
        <p><i class="fa fa-pencil" style="font-size:28px;color:#f5d743;"></i></p>
        <p>At first you need to create Short question</p>
        <p>or select a question by search option.</p>

      </div>
      <div class="modal-footer">
        <button type="button" id="preview_success" class="btn btn_blue" data-dismiss="modal">Ok</button>
      </div>

    </div>
  </div>

</div>


<div class="modal fade ss_modal " id="viewIdeaCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div style="background-color: #00a2e8; color:white;" class="modal-content">

      <div class="modal-header">
        <h4 style="background-color: #00a2e8; color:white;">Idea

          <button style="float: right; color:black;background-color: #00a2e8;border:none;" type="button" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </h4>
      </div>

      <form class="">
        <div class="modal-body">
          <div id="checkbox_titlelimit_alert">
            <div>
              Number of task submited on this topic &nbsp; <input class="form-control w-50" type="text" value="50" readonly="" name="">
            </div>

          </div>
          <div class="d-flex">
            <input type="checkbox" name="" id="checkbox_titlelimit"> &nbsp;
            <div class="form-group">
              <label style="color:#fff">Idea/Topic/Story Title</label>
              <input type="text" id="view_idea_question_title" class="form-control shot_question_title " name="idea_question_title" readonly="" maxlength="50" value="">
            </div>
          </div>
          <div style="text-align: right;">
            <button class="viewideabtnclose" type="button" style="font-weight:normal;border:none;color:#000;padding:8px 15px;border-radius:5px;">save</button>
          </div>
        </div>
    </div>
  </div>
</div>





<div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="question_create_details_modal">
  <!-- Modal -->
  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="mclose" data-dismiss="modal" style="float:right;cursor:pointer;">x</div>
        <div class="btm_word_limt text-center">
            <p style="color:#00a2e8;">Tutor(<b class="question_creator_name">name</b>)</p>
            <br><br>
            <p style="font-weight:bold;"><u>Idea/Topic/Stoty Title</u></p>
            <br>
            <p class="short_question_name_modal">""</p>
            <br>
            <p> Created: &nbsp; &nbsp; <span id="question_creator_date">06/08/2021</span></p>
            
        </div>
      </div>
  </div>
</div>

<div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="idea_create_details_modal">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="mclose" data-dismiss="modal" style="float:right;cursor:pointer;">x</div>
        <div class="btm_word_limt text-center">
            <p style="color:#00a2e8;">Tutor(<b class="idea_creator_name">name</b>)</p>
            <br><br>
            <p style="font-weight:bold;"><u>Idea/Topic/Stoty Title</u></p>
            <br>
            <p class="idea_name_modal">""</p>
            <br>
            <p> Created: &nbsp; &nbsp; <span id="idea_creator_date">06/08/2021</span></p>
            
        </div>
      </div>
  </div>
</div>

<div class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="NotCreateQuestion">
  <!-- Modal -->
  <div style="max-width: 20%;" class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">
        <p>You cannot create question at this moment</p>

      </div>
      <div class="modal-footer">
        <button type="button" id="preview_success" class="btn btn_blue" data-dismiss="modal">Ok</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade ss_modal" id="idea_details_textarea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <!-- <form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data"> -->

      <div style="background-color: #eee;" class="modal-body">
        <div style="display: flex;">

          <h6 style="text-align:center;"> Question </h6>

          <button style="color:black;border:none;margin-left: auto;order: 2;" type="button" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>

        </div>
        <div class="row">
          <input type="hidden" id="total_word_ajax" value="7">
          <textarea id="idea_description_body" class="form-control mytextarea" name="idea_description_body"></textarea>
        </div>
        <div style="text-align: right;">
          <button class="duplicate_idea_save" type="button" style="font-weight:normal;border:none;margin-top:5px;padding:8px 15px;border-radius:5px;background-color:white;">save</button>
        </div>
      </div>

      <!-- <div class="modal-footer">
          <button type="button" onclick="add_subject()" class="btn btn_blue">Save</button>
          <button type="button" class="btn btn_blue close_ch" data-dismiss="modal">Cancel</button>
        </div> -->
      <!-- </form> -->
    </div>
  </div>
</div>

<style type="text/css">
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
  .q_created_name {
    /* background: #66afe9; */
    color: #fff;
    font-size: 16px;
    /* padding: 10px 20px; */
    display: flex;
    flex-wrap: wrap;
    align-items: center;
  }

  .q_created_name a {
    color: #fff;
  }

  .q_created_name img {
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
  .showIdeaPosition{
    padding-top:22px;
  }
</style>
<!-- <script type="text/javascript" src="jquery-3.2.1.min.js"></script> -->
<script type="text/javascript">
  $(".word_limit_show").hide();
  $(".word_limit_number_show").hide();
  $("#time_show").hide();
  $(".question_title").css('background', '#a9a8a8');

  // $("#advance_searc_content").show();
  $("#image_search_bar").hide();
  $("#search_view").hide();
  

  $(document).ready(function() {

    
    var wordCounts = {};

    CKEDITOR.instances.word_count.on('key', function(e) {

      var text = CKEDITOR.instances['word_count'].document.getBody().getText();


      var matches = text.match(/\b/g);
      wordCounts[this.id] = matches ? matches.length / 2 : 0;
      var finalCount = 0;
      $.each(wordCounts, function(k, v) {
        finalCount += v;
      });

      $('#total_idea_word').val(finalCount);

      am_cal(finalCount);

    });


    CKEDITOR.instances.idea_ques_body.on('key', function(e) {

      var text = CKEDITOR.instances['idea_ques_body'].document.getBody().getText();


      var matches = text.match(/\b/g);
      wordCounts[this.id] = matches ? matches.length / 2 : 0;
      var finalCount = 0;
      $.each(wordCounts, function(k, v) {
        finalCount += v;
      });

      $('#total_word_ajax').val(finalCount);

      //am_cal(finalCount);

    });

    CKEDITOR.instances.edit_idea_ques_body.on('key', function(e) {

      var text = CKEDITOR.instances['edit_idea_ques_body'].document.getBody().getText();


      var matches = text.match(/\b/g);
      wordCounts[this.id] = matches ? matches.length / 2 : 0;
      var finalCount = 0;
      $.each(wordCounts, function(k, v) {
        finalCount += v;
      });

      $('#edit_total_word_ajax').val(finalCount);

      //am_cal(finalCount);

    });

    CKEDITOR.instances.image_idea_ques_body.on('key', function(e) {


      var text = CKEDITOR.instances['image_idea_ques_body'].document.getBody().getText();


      var matches = text.match(/\b/g);
      wordCounts[this.id] = matches ? matches.length / 2 : 0;
      var finalCount = 0;
      $.each(wordCounts, function(k, v) {
        finalCount += v;
      });


      $('#total_image_word_ajax').val(finalCount);

      am_cal(finalCount);

    });


    $(".question_title").click(function() {
      // $("#advance_allowonline").toggle();
      // $("#advance_searc_content").toggle();
    });

    $(".idea_title_button").click(function() {
      $("#advance_allowonline").toggle();
      $("#advance_searc_content").toggle();
      $(".idea_title_button").css('background-color', '#00a2e8');
      $(".question_title").css('background-color', '#a9a8a8');
      $("#selected_search").val(2);
    });


    $('#advance_idea_search_button').click(function(){
      var search_text = $("#advance_searc_content_src").val();
      var search_type = $("#selected_search").val();
      if(search_type==''){
        search_type =1;
      }

      $.ajax({
        url: "search_idea",
        type: "POST",
        data: {
          search_text: search_text,
          search_type: search_type
        },
        success: function(data) {

          var all_data = JSON.parse(data);
          console.log(data);
          html = '';

          for (i = 0; i < all_data['questions'].length; i++) {
            html += '<br><a class="search_button" type="button"  data-id="' + all_data['questions'][i].question_id + '" data-index="' + all_data['questions'][i].id + '">' + all_data['questions'][i].shot_question_title + '</a>';
          }

          $("#search_view").css('display', 'block');
          $('#search_view').show();
          $('#search_view').html(html);

        }

      });
    });

    $("#advance_searc_content_src").keyup(function() {
      var search_text = $(this).val();
      var search_type = $("#selected_search").val();
      if(search_type==''){
        search_type =1;
      }
      search_idea_question(search_text,search_type);

    });
    $("#advance_searc_content_src").click(function() {
      var search_text = $(this).val();
      var search_type = $("#selected_search").val();
      if(search_type==''){
        search_type =1;
      }
      search_idea_question(search_text,search_type);

    });

    $("#advance_searc_op").click(function() {
      // $("#advance_allowonline").toggle();
      // $("#advance_searc_content").toggle(); 222
      $("#image_search_bar").hide();
      $("#advance_searc_content").show();
      $('.clear_idea').show();
      $('#advance_searc_op').hide();

      var search_text = $("#advance_searc_content_src").val();
      var search_type = $("#selected_search").val();
      if(search_type==''){
        search_type=1;
      }
      // alert(search_text);
      // alert(search_type);
      search_idea_question(search_text,search_type);
    });

    function search_idea_question(search_text,search_type){

      $.ajax({
        url: "search_idea",
        type: "POST",
        data: { 
          search_text: search_text,
          search_type: search_type
        },
        success: function(data) {

          var all_data = JSON.parse(data);
          
          html = '';
          console.log(all_data);
          if(all_data['questions'] != undefined){
          for (i = 0; i < all_data['questions'].length; i++) {
            html += '<br><a class="search_button" type="button"  data-id="' + all_data['questions'][i].question_id + '" data-index="' + all_data['questions'][i].id + '">' + all_data['questions'][i].shot_question_title + '</a>';
          }
          }
          
          $("#search_view").css('display', 'block');
          $('#search_view').show();
          $('#search_view').html(html);
          
        }
      });
    }

    

    $("#advance_searc_image_src").keyup(function() {
      search_image_question();
    });

    $(document).on('click', '.search_button', function() {

      $("#search_view").css('display', 'none');
      $("#short_question_view").css('display', 'block');
      //$("#short_edit_button").css('display', 'block');
      // $(".shot_question_title").attr('readonly', true);
      
      $("#check_new_idea").val(1);
      var question_id = $(this).attr('data-id');
      var img_chk = $(this).attr('data-img');
      
      $.ajax({
        url: "get_idea",
        type: "POST",
        data: {
          question_id: question_id
        },
        success: function(response) {
          var data = JSON.parse(response);
          console.log(data);

          var html='';
          if(data.length > 0){
             for(var i=0;i<data.length;i++){
                var j= i+1;
                var style="background:#white;color:black;";
                if(i==0)
                {
                  var style="background:#0062cc !important;color:white;";
                  html+='<button type="button" class="btn_new view_idea" style="'+style+'" data-id="'+data[i]['ids']+'">Idea'+j+'</button>'
                }
                else
                {
                  html+='<button type="button" class="btn_new view_idea" style="'+style+'" data-id="'+data[i]['ids']+'">Idea'+j+'</button>'
                }
             }
             $(".all_idea_show").html(html);
             $(".empty_idea").hide();
          }
          var idea_value = CKEDITOR.instances['word_count'].document.getBody().getText();

          $('#idea_storage').val(idea_value);
          $("#short_title").val(data[0]['shot_question_title']);
          $(".shot_question_title").val(data[0]['shot_question_title']);
          $('#shot_question_box').attr('data-nonCreate',1);
          $("#idea_title").val();
          $(".idea_main_body ").val(data[0]['idea_ans']);
          
          $('#large_ques_body').val(data[0]['large_ques_body']);
          $('#short_question_id').val(data[0]['question_id']);
          //alert(data[0]['image_ques_body']);
          if(img_chk != undefined){
            $('#short_ques_body').val(data[0]['image_ques_body']);
          }else{
            $('#short_ques_body').val(data[0]['shot_question_title']);
          }
          
          // $('#idea1').text(data[0]['idea_name']);
          // $('#idea1').css({
          //   "background-color": "#00a2e8;",
          //   "color": "white;"
          // }); 

          $('.this_idea_title').text(data[0]['image_title']);
          $('.question_creator').text(data[0]['name']);
          $('.idea_creator').text(data[0]['name']);
          $('.question_idea_show').show();
          // $('.show_short_question').css('background-color','#00a2e8');
          $('#short_ques_body').attr('disabled',true);
          CKEDITOR.instances['short_ques_body'].setReadOnly(true);

          $('#question_creator_details').attr('data-qcreator',data[0]['name']);
          $('#question_creator_details').attr('data-question_name',data[0]['shot_question_title']);
          $('#question_creator_details').attr('data-q_created_at',data[0]['q_created_at']);

          $('#idea_creator_details').attr('data-qcreator',data[0]['name']);
          $('#idea_creator_details').attr('data-idea_name',data[0]['idea_name']);
          $('#idea_creator_details').attr('data-created_at',data[0]['created_at']);
          
          
          
          $('.tutor_make_idea').attr('data-id',data[0]['question_id']);
          
          var student_title =  data[0]['student_title'];
          if(student_title==1){
            $('.student_title').attr('checked',true);
          }
          var word_limit =  data[0]['word_limit'];
          $('#word_limit_set').val(word_limit);

          var time_hour =  data[0]['time_hour'];
          var time_min =  data[0]['time_min'];
          var time_sec =  data[0]['time_sec'];
          $('#time_hour').val(time_hour);
          $('#time_min').val(time_min);
          $('#time_sec').val(time_sec);
          var allow_idea = data[0]['allow_idea'];
          var add_start_button = data[0]['add_start_button'];
          if(allow_idea==1){
             $('#allow_idea').attr('checked',true);
          }
          if(add_start_button==1){
             $('#add_start_button').attr('checked',true);
          }
          var grade = data[0]['studentgrade'];
          var subject = data[0]['subject'];
          var chapter = data[0]['chapter'];
          var country = data[0]['country'];
          $('.createQuesLabel').val(grade);
          $('#subject').val(subject).trigger('change');
          
          $('#dup_ques_chapter').val(chapter);
          $('#quesCountry').val(country).trigger('change');
        }

      });

    });

    $(document).on('click', '#create_new_idea', function() {
      var short_question = CKEDITOR.instances['short_ques_body'].document.getBody().getText();
      var check_idea = $("#check_new_idea").val();
      var idea_image = $(".check_image").val();
      if (idea_image == 1) {
        $('#newideaimage').modal('show');
      } else {

        if (check_idea == 1) {
          if (short_question != '') {
            $("#Idea_view").css('display', 'block');
            $(".shot_question_title").attr('readonly', true);
            $("#idea_question_title_main").val('');
            $(".idea_main_body").val('');
            $("#idea_title").val('');
            $(".idea_question_title").removeAttr("readonly");
          } else {
            $modal = $('#idea_create_failed');
            $('#idea_create_failed').modal('show');
          }

        } else if (check_idea == 2) {
          if (short_question != '') {
            $("#idea_question_title_main").val('');
            $('#newidea').modal('show');
            $(".idea_question_title").removeAttr("readonly");
          } else {
            $modal = $('#idea_create_failed');
            $('#idea_create_failed').modal('show');
          }
        }
      }
    });

    $(".imageideatitleclose").click(function() {
      var idea_image_title = $("#idea_question_title_image").val();


      $('#image_idea_question_details').modal('show');
      $('#newideaimage').modal('hide');
      var get_image = $('.idea_image_name').val();

      var text = '<p style="text-align:center;color:#f98f0b;font-size:18px;">"' + idea_image_title + '"&#9999;&#65039;</p>';

      var img_with_text = '<img  class="image-editor" data-height="250" data-width="200" height="179" src="<?= base_url() ?>/assets/idea_image/' + get_image + '" width="281" />' + text + '<br>';

      $("#image_idea_ques_body").val(img_with_text);

    });




    $(document).on('click', '#short_edit_button', function() {
      $('#edit_shot_question').modal('show');
    });

    $(document).on('click', '.Update_short_question', function() {
      var question_id = $('#short_question_id').val();
      var short_question = $('.edit_short_title').val();

      $.ajax({
        url: "update_short_question",
        type: "POST",
        data: {
          question_id: question_id,
          short_question: short_question
        },
        success: function(response) {
          if (response == 1) {
            $('#short_title1').val(short_question);
            $('#edit_shot_question').modal('hide');
          }
        }

      });
    });


    $("#word_limit_set").change(function() {
      var word_limit = $("#word_limit_set").val();
      $(".word_limit_number_show").text(word_limit);
      $(".word_limit_number_show").show();
      $(".word_limit_show").show();
    });

    $("#large_question").click(function() {
      // $('#largequestion').modal('show'); 
      $('#large_question_details').modal('show');
    });

    $("#time_hour").keyup(function() {

      var hour = $("#time_hour").val();

      var min = parseInt($("#time_min").val());
      if (isNaN(min)) {
        min = 0;
      }
      if (min == '') {
        var min = 0;
      }
      if (min <= 60) {

      } else {
        alert("It should be equal or less than 60");
        min = 00;
        $("#time_min").val('00');
      }
      var sec = parseInt($("#time_sec").val());
      if (isNaN(sec)) {
        sec = 0;
      }
      if (sec <= 60) {

      } else {
        alert("It should be equal or less than 60");
        sec = 00;
        $("#time_sec").val('00');
      }
      var time = hour + ':' + min + ':' + sec;
      $("#time_show").val(time);
      $("#time_show").show();
    });




    $("#time_min").keyup(function() {

      var hour = $("#time_hour").val();
      var min = parseInt($("#time_min").val());
      if (isNaN(min)) {
        min = 0;
      }
      if (min <= 60) {

      } else {
        alert("It should be equal or less than 60");
        min = 00;
        $("#time_min").val('00');
      }
      var sec = parseInt($("#time_sec").val());
      if (isNaN(sec)) {
        sec = 0;
      }
      if (sec <= 60) {

      } else {
        alert("It should be equal or less than 60");
        sec = 00;
        $("#time_sec").val('00');
      }
      var time = hour + ':' + min + ':' + sec;
      $("#time_show").val(time);
      $("#time_show").show();
    });

    $("#time_sec").keyup(function() {

      var hour = $("#time_hour").val();
      var min = parseInt($("#time_min").val());
      if (isNaN(min)) {
        min = 0;
      }
      if (min == '') {
        var min = 0;
      }
      if (min <= 60) {

      } else {
        alert("It should be equal or less than 60");
        min = '00';
        $("#time_min").val('00');
      }
      var sec = parseInt($("#time_sec").val());
      if (isNaN(sec)) {
        sec = 0;
      }
      if (sec <= 60) {

      } else {
        alert("It should be equal or less than 60");
        sec = 00;
        $("#time_sec").val('00');
      }
      var time = hour + ':' + min + ':' + sec;
      $("#time_show").val(time);
      $("#time_show").show();
    });

  });






  $(function() {
    $("#checkbox_titlelimit").click(function() {
      if ($(this).is(":checked")) {
        $("#checkbox_titlelimit_alert").show();
        $(".shot_question_title").removeAttr("readonly");
      } else {
        $("#checkbox_titlelimit_alert").hide();
        $(".shot_question_title").attr('readonly', true);
      }
    });
  });
  $(function() {
    $("#checkbox_titlelimitidea").click(function() {
      if ($(this).is(":checked")) {
        $("#checkbox_titlelimitidea_alert").show();
        $(".idea_question_title").removeAttr("readonly");
      } else {
        $("#checkbox_titlelimitidea_alert").hide();
        $(".idea_question_title").attr('readonly', true);
      }
    });
  });
  $(function() {
    $("#checkbox_titlelimitidea_large").click(function() {
      if ($(this).is(":checked")) {
        $("#checkbox_titlelimit_large_alert").show();
        $(".large_question_title").removeAttr("readonly");
      } else {
        $("#checkbox_titlelimit_large_alert").hide();
        $(".large_question_title").attr('readonly', true);
      }
    });
  });

  $(function() {
    $("#checkbox_titlelimit2").click(function() {
      if ($(this).is(":checked")) {
        $("#checkbox_titlelimit2").show();
        $(".idea_question_title").removeAttr("readonly");
      } else {
        $("#checkbox_titlelimit2").hide();
        $(".idea_question_title").attr('readonly', true);
      }
    });
  });


  $('.close_idea').click(function() {
    $('#idea_question_details').modal('hide');
    var check_idea = $("#check_new_idea").val();
    
    if (check_idea == 1) {

      var total_word = $('#total_word_ajax').val();
      var idea_title = $('#idea_title').val();
      var question_description = $('#idea_ques_body').val();
      var question_id = $(".search_button").attr("data-id");
      var idea_id = $(".search_button").attr("data-index");

      $.ajax({
        url: "save_more_idea",
        type: "POST",
        data: {
          idea_title: idea_title,
          question_description: question_description,
          question_id: question_id
        },  
        success: function(response) {

          var data = JSON.parse(response);
          var html = '';
          var color = 'background:#00a2e8;';
          console.log(data);
          // alert(data.length);

          for (var i = 0; i < data.length; i++) {

            if (i == 0) {
              var html2 = '<label data-toggle="modal" data-target="#newidea"> <span><img src="assets/images/icon_new.png"> New</span> </label>';
              var style = '';
            } else {
              var style = 'style="padding-top:22px;"';
              var html2 = '';
            }
            if (i == data.length - 1) {
              var color = 'background:#00a2e8;color:white;';
              //$(".idea_main_body").val(data[i].idea_question);
            } else {

              var color = 'color:black;';
            }
            var idea = i + 1;

            var desc = "<input type='hidden' class='ideasall' name='idea_details[]' data-index='" + data[i].idea_question + "' data-id='" + i + "' value='" + data[i].idea_id + ",,," + data[i].idea_title + ",,," + data[i].idea_question + "'>";


            html += '<div class="form-group" style="float: left;margin-right: 10px;">' + html2 + '<div '+style+'><input type="hidden" name="idea_name[]" value="idea' + data[i].idea_id + '">' + desc + '<button style="' + color + '" data-id="' + i + '" class="btn btn-select-border showIdea  color_change idea' + data[i].idea_id + '" type="button">Idea ' + idea + '</button></div></div>';

            if (i == data.length - 1) {
              $(".idea_main_body").val(data[i].idea_question);
            }
          }
          $('.all_idea').html(html);

        }

      });
    } else {

      var total_word = $('#total_word_ajax').val();
      var idea_title = $('#idea_question_title_main').val();
      var question_description = $('#idea_ques_body').val();

      // alert(total_word);
      // alert(idea_title);
      // alert(question_description);

      $.ajax({
        url: "save_idea",
        type: "POST",
        data: {
          idea_title: idea_title,
          question_description: question_description,
          total_word: total_word
        },
        success: function(response) {

          var html = '';
          var data = JSON.parse(response);
          console.log(data);
          var idea_id = data[0].id;
          var idea_title = data[0].idea_title;
          var idea_description = data[0].question_description;
          console.log(idea_id);


          if (idea_id == 1) {
            var html2 = '<label data-toggle="modal" data-target="#newidea"> <span><img src="assets/images/icon_new.png"> New</span> </label>';
            var style = '';
          } else {
            var html2 = '';
            var style = 'style="padding-top:22px;"';
          }
          $(".color_change").css('background', 'none');
          $(".color_change").css('color', 'black');
          var desc = "<input type='hidden' name='idea_details[]' value='" + idea_id + ",,," + idea_title + ",,," + idea_description + "'>";
          var html = '<div class="form-group" style="float: left;margin-right: 10px;">' + html2 + '<div '+style+'><input type="hidden" name="idea_name[]" value="idea' + idea_id + '">' + desc + '<button style="background:#00a2e8;color:white;" data-value="' + idea_id + '" data-index="' + idea_title + '" class="btn btn-select-border color_change idea' + idea_id + ' created_ideas" type="button">Idea ' + idea_id + '</button></div></div>';


          $(".idea_main_body").val(idea_description);

          if (idea_id == 1) {
            $('.all_idea').html(html);
          } else {
            $('.all_idea').append(html);
          }

        }

      });

    }

  });

  $(".edit_close_idea").click(function() {
    var idea_title = $('#view_idea_question_title').val();
    var question_description = $('#edit_idea_ques_body').val();
    var total_word = question_description.split(/[\s\.\?]+/).length;
    var idea_id = $('#edit_idea_id').val();

    $.ajax({
      url: "edit_save_idea",
      type: "POST",
      data: {
        idea_title: idea_title,
        question_description: question_description,
        total_word: total_word,
        idea_id: idea_id
      },
      success: function(response) {
        alert("idea Updated");
        $('#edit_idea_question_details').modal('hide');
      }

    });
  });

  $(document).on('click', '.created_ideas', function() {
    var idea_id = $(this).attr('data-value');
    $('#viewIdeaCreate').modal('show');
    var idea_title = $(this).attr('data-index');
    $("#view_idea_question_title").val(idea_title);
    $("#view_idea_question_title").attr('data-index', idea_id);
  });

  $(document).on('click', '.viewideabtnclose', function() {
    var idea_title = $("#view_idea_question_title").val();
    var idea_id = $("#view_idea_question_title").attr('data-index');
    $.ajax({
      url: "edit_idea",
      type: "POST",
      data: {
        idea_id: idea_id,
        idea_title: idea_title
      },
      success: function(response) {
        var data = JSON.parse(response);
        console.log(data);
        $('#viewIdeaCreate').modal('hide');
        $('#edit_idea_question_details').modal('show');
        var idea_description = data['question_description'];
        var idea_title = data['idea_title'];
        var new_title = $("#view_idea_question_title").val();
        var text = idea_description.replace(idea_title, new_title);
        $('#edit_idea_ques_body').val(text);
        $('#edit_idea_id').val(data['id']);

      }
    });
  });

  $(document).on('click', '.close_image_idea', function() {
    $('#image_idea_question_details').modal('hide');

    var total_word = $('#total_image_word_ajax').val();
    var idea_title = $('#idea_question_title_image').val();
    var question_description = $('#image_idea_ques_body').val();

    $.ajax({
      url: "save_image_idea",
      type: "POST",
      data: {
        idea_title: idea_title,
        question_description: question_description,
        total_word: total_word
      },
      success: function(response) {

        var html = '';
        var data = JSON.parse(response);
        //console.log(data);
        var idea_id = data[0].id;
        var idea_title = data[0].idea_title;
        var idea_description = data[0].question_description;
        //console.log(idea_id);
        var color = 'black';


        if (idea_id == 1) {
          var html2 = '<label id="create_new_idea"> <span><img src="assets/images/icon_new.png"> New</span> </label>';
        } else {
          var html2 = '';
        }
        $(".color_change").css('background', 'none');
        var desc = "<input type='hidden' name='idea_details[]' value='" + idea_id + ",,," + idea_title + ",,," + idea_description + "'>";
        var html = '<div class="form-group" style="float: left;margin-right: 10px;">' + html2 + '<div><input type="hidden" name="idea_name[]" value="idea' + idea_id + '">' + desc + '<button style="background:#00a2e8;color:' + color + ';" data-value="" class="btn btn-select-border color_change idea' + idea_id + '" type="button" onclick="showIdea(' + idea_id + ')">Idea ' + idea_id + '</button></div></div>';




        $(".idea_main_body").val(idea_description);

        if (idea_id == 1) {
          $('.all_idea').html(html);
        } else {
          $('.all_idea').append(html);
        }

      }

    });
  });

  $(document).on('click', '.showIdea', function() {
    let that = $(this);
    $(".showIdea").css('background-color', 'white');
    $(this).css('background-color', '#fb8836f0;');
    var this_id = $(that).attr("data-id");

    $(".ideasall").each(function() {
      var get_id = $(this).attr('data-id');
      if (get_id == this_id) {
        var get_question = $(this).attr('data-index');
        $(".idea_main_body").val(get_question);
      }
    });
  });


  $('.btnclose').click(function() {
    var short_body = $('#short_title').val();
    $.ajax({
      url: "check_idea_short_question",
      type: "POST",
      data: {
        short_title: short_body
      },
      success: function(data) {

        if (data == 2) {
          $modal = $('#shot_question_details');
          $('#shot_question_details').modal('show');

          $modal = $('#shot_question');
          $('#shot_question').modal('hide');

          var text = '<p><b>Write about the topic bellow :</b></p>"' + short_body + '"&#9999;&#65039;<p><b>Requirement :</b></p><p> </p>';
          $('#short_ques_body').val(text);
          $('.shot_question_title').val(short_body);
        } else {
          $modal = $('#question_create_failed');
          $('#question_create_failed').modal('show');
        }
      }

    });

  });

  $(document).on('click', '#image_short_question', function() {
    $('#shot_image_details').modal('show');
    var text = '<p><b>Use your imagination to write the opening of a story inspired by this image : &#9999;&#65039;</b></p><br>';

    // alert('hell');
    $('#image_ques_body').val(text); 
    $('#shot_question').modal('hide');
  });

  $("#Upload_image").change(function() {
    // var text= '<p><b>Write about the topic bellow :</b></p>&#9999;&#65039;';
    // $('#image_ques_body').val(text);

    var property = document.getElementById('Upload_image').files[0];
    var image_name = property.name;
    var image_extension = image_name.split('.').pop().toLowerCase();

    if (jQuery.inArray(image_extension, ['gif', 'jpg', 'jpeg', 'png', '']) == -1) {
      alert("Invalid image file");
    }

    var form_data = new FormData();
    form_data.append("file", property);

    $.ajax({
      url: "short_image_upload",
      method: 'POST',
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function() {
        $('#msg').html('Loading......');
      },
      success: function(data) {

        var text = '<p><b>Use your imagination to write the opening of a story inspired by this image : &#9999;&#65039;</b></p><br>';

        var img = text + '<img  class="image-editor" data-height="250" data-width="200" height="179" src="<?= base_url() ?>/assets/idea_image/' + data + '" width="281" />';

        $('#image_ques_body').val(img);
        $('.idea_image_name').val(data);
        $(".check_image").val(1);
      }
    });

  });

  $('.image_idea_save').click(function() {
    $("#image_search_bar").show(); 
    $(".show_short_question").css('color', 'white');
    $(".show_short_question").css('background', '#00a2e8');
    $(".short_question_checkbox").attr('checked', 'true');
    $("#shot_image_details").modal('hide');
    $("#advance_searc_content").css('display', 'none');
    $("#image_search_button").css('background', '#00a2e8');
    $(".question_title").css('background', '#a9a8a8');
    var image_body = $('#image_ques_body').val();
    $("#short_ques_body").val(image_body);

  });

  $('.short_question_close').click(function() {
    $modal = $('#shot_question_details');
    $('#shot_question_details').modal('hide');
  });

  $('.largebtnclose').click(function() {
    $modal = $('#large_question_details');
    $('#large_question_details').modal('show');

    // var large_body = $('#large_title').val();

    // var text= '<p><b>Write about the topic bellow :</b></p>"'+large_body+'"&#9999;&#65039;';
    // $('#large_ques_body').val(text);

  });

  $('#shot_question_box').click(function() {
    chk_create = $(this).attr('data-nonCreate');

    if(chk_create == undefined){
      $('#shot_question').modal('show');
      $(".question_title").css('background-color', '#00a2e8');
      $("#advance_searc_content").show();
      $("#image_search_bar").hide();
      $("#selected_search").val(1);
      //$("#short_question_view").css('display', 'block');
      $("#Idea_view").css('display', 'none');
      $(".shot_question_title").removeAttr("readonly");
      $(".shot_question_title").val("");
      $("#check_new_idea").val(2);

      var html2 = '<label data-toggle="modal" data-target="#newidea"> <span><img src="assets/images/icon_new.png"> New</span> </label>';

      html = '<div class="idea_setting_mid_bottom"><div class="all_idea"><div class="form-group" style="float: left;margin-right: 10px;"><label id="create_new_idea"> <span><img src="assets/images/icon_new.png"> New</span> </label><div><button id="idea1" class="btn btn-select-border">Idea- </button></div></div></div></div>';
    }else{
      $('#NotCreateQuestion').modal('show');
    }
    

  });
  $('#short_question_edit').click(function() {
    $('#shot_question').modal('show');
  });

  $(".close_short_question").click(function() {
    $(".show_short_question").css('color', 'white');
    $(".show_short_question").css('background', '#00a2e8');
    $(".short_question_checkbox").attr('checked', 'true');

    $modal = $('#shot_question_details');
    $('#shot_question_details').modal('hide');
    $("#image_search_bar").hide();
  });

  $(".show_short_question").click(function() {
    $modal = $('#shot_question_details');
    $('#shot_question_details').modal('show');
  });

  $(".close_large_question").click(function() {
    $(".show_large_question").css('color', 'white');
    $(".show_large_question").css('background', '#00a2e8');
    $(".large_question_checkbox").attr('checked', 'true');
  });

  $(".large_question_close").click(function() {
    $('#large_question_details').modal('hide');
    $(".show_large_question").css('color', 'white');
    $(".show_large_question").css('background', '#00a2e8');
  });

  $(".show_large_question").click(function() {
    $modal = $('#large_question_details');
    $('#large_question_details').modal('show');
  });


  $('.ideabtnclose').click(function() {

    $modal = $('#idea_question_details');
    $('#idea_question_details').modal('show');
    $('#newidea').modal('hide');
    var check_idea = $("#check_new_idea").val();
    if (check_idea == 2) {
      var idea_body = $('#idea_question_title_main').val();
    } else {
      var idea_body = $('#idea_title').val();
    }

    var idea_text = '<p style="text-align:center;font-weight:bold;font-size:16px;">Idea/Topic/Story Title</p>';
    var text = idea_text + '<p style="text-align:center;color:#f98f0b;font-size:18px;">"' + idea_body + '"&#9999;&#65039;</p><br>';
    $('#idea_ques_body').val(text);

  });


  $("#serial_no_idea").on("change", function() {
    $modal = $('#login_form');
    if ($(this).val() === '1') {
      $modal.modal('show');
    }
  });

  $(document).ready(function() {

    $("#advance_searc_image").click(function() {
      $("#image_search_bar").show();
      $("#advance_searc_content").hide();
      $('.clear_image_idea').show();
      $('#advance_searc_image').hide();
      search_image_question();
    });

    $('.tutor_make_idea').click(function(){
       var tutor_idea = $('.tutor_write_idea').val();
       var question_id = $(this).attr('data-id');

       if(tutor_idea != ''){
          $('#idea_details_textarea').modal('show');
          var idea_text = '<p style="text-align:center;font-weight:bold;font-size:16px;">Idea/Topic/Story Title</p>';
          var text = idea_text + '<p style="text-align:center;color:#f98f0b;font-size:18px;">"' + tutor_idea + '"&#9999;&#65039;</p><br>';
          $('#duplicate_title_idea').val(tutor_idea);
          // $('.idea_main_body').val(text);
          $('#duplicate_idea_title').val(text);
          $('#idea_description_body').val(text);

          
          // $('#Idea_view').hide();
          $('#short_question_view').css('background-color','#a349a4'); 
          $('#short_question_view_header').css('background-color','#a349a4');
          $('.btnclose').css('background-color','#a349a4'); 
          $('#short_question_view_hand_icon').attr('src','assets/images/creative_hand_icon_blue.png');
          $('#q_created_name_text').text('Duplicate ');
          $('.question_idea_show').css('background-color','#a349a4');
          $('#question_idea_show_icon').attr('src','assets/images/creative_hand_icon_blue.png');
          // $('.view_idea').css('background-color','#a349a4');
          $('.show_short_question_dup').css('background-color','#a349a4');
          $('#duplicate_question_id').val(question_id);
          $('#dup_ques_short_ques').show();

          $('.view_idea').css({
              "background-color": "#fff;",
              "color": "#000;",
              "border": "1px solid black;",
          });

          
          var idea_title = $('#idea_title').val();
          var total_ideas = $('.view_idea').length;
          var total_ideas = total_ideas+1;
          var html = '<button type="button" class="btn_new view_idea" style="background:#a349a4;color:white;margin-top:27px;" data-idea="1 data-id="">Idea'+total_ideas+'</button>';
          $('.all_idea').append(html);
          
          
          


       }else{
        alert('Please write idea title first !!');
       }
    });

  });

  $(function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
  });

  function setSolution() {
    $("#dialog").dialog({
      height: 400,
      width: 600,
      buttons: [{
          text: "Close",
          icon: "ui-icon-heart",
          click: function() {

            $(this).dialog("close");
          }
        },
        {
          text: "Save",
          click: function() {
            var solution = ($('#setSolution').val());
            ($('#setSolutionHidden').val(solution));
            $(this).dialog("close");
          }
        }
      ]
    });
    $('#setSolution').ckeditor({
      height: 200,
      extraPlugins: 'simage,ckeditor_wiris',
      filebrowserBrowseUrl: '/assets/uploads?type=Images',
      filebrowserUploadUrl: 'imageUpload',
      toolbar: [{
          name: 'clipboard',
          groups: ['clipboard', 'undo'],
          items: ['NewPage', 'Preview', 'Preview', 'Print', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
        },
        {
          name: 'basicstyles',
          items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'SImage']
        },
        '/',
        {
          name: 'document',
          items: ['RemoveFormat', 'Maximize', 'ShowBlocks', 'TextColor', 'BGColor', '-', 'Templates', 'Link', 'addFile']
        },
        '/',
        {
          name: 'styles',
          items: ['Styles', 'Format', 'Font', 'FontSize']
        },
        {
          name: 'wiris',
          items: ['ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry']
        }
      ],
      allowedContent: true
    });
  }

  $('.clear_idea').click(function(){
    var get_idea_val = $('#idea_storage').val();
    $('#word_count').val(get_idea_val);
    $('#short_question_view').hide();
    $('#advance_searc_content').hide();
    $('.clear_idea').hide();
    $('#Idea_view').hide();
    $('#advance_searc_op').show();
    $('.question_idea_show').hide();
    $('.show_short_question').css('background-color','#fff');
    $('.show_large_question').css('background-color','#fff');
    CKEDITOR.instances['short_ques_body'].setReadOnly(false);
    $('#shot_question_box').removeAttr('data-nonCreate');

    $('#idea1').text('Idea-');
      $('#idea1').css({
        "background-color": "#fff;",
        "color": "black;"
    });
  });

  $('.clear_image_idea').click(function(){
    $('#advance_searc_image').show();
    $('.clear_image_idea').hide();



    var get_idea_val = $('#idea_storage').val();
    $('#word_count').val(get_idea_val);
    $('#short_question_view').hide();
    $('#advance_searc_content').hide();
    // $('.clear_idea').hide();
    $('#advance_searc_op').show();
    $('.question_idea_show').hide();
    $('.show_short_question').css('background-color','#fff');
    $('.show_large_question').css('background-color','#fff');
    CKEDITOR.instances['short_ques_body'].setReadOnly(false);
    $('#shot_question_box').removeAttr('data-nonCreate');

    $('#idea1').text('Idea-');
      $('#idea1').css({
        "background-color": "#fff;",
        "color": "black;"
    });
  });

  $('#question_creator_details').click(function(){
      var creator_name = $(this).attr('data-qcreator');
      var creation_date = $(this).attr('data-q_created_at');
      var short_question_name = '"'+$(this).attr('data-question_name')+'"';
      //  var date = "2013-06-26 06:46:29";
      var dateSplit = creation_date.split(" ");
      var dateSplit2 = dateSplit[0].split("-");
      var formattedDate = dateSplit2.reverse().join('-'); 
      $('.question_creator_name').text(creator_name);
      $('#question_creator_date').text(formattedDate);
      $('.short_question_name_modal').text(short_question_name);
      $('#question_create_details_modal').modal('show');
  });


  $('#idea_creator_details').click(function(){
      var creator_name = $(this).attr('data-qcreator');
      var creation_date = $(this).attr('data-created_at');
      var short_question_name = '"'+$(this).attr('data-idea_name')+'"';
      //  var date = "2013-06-26 06:46:29";
      var dateSplit = creation_date.split(" ");
      var dateSplit2 = dateSplit[0].split("-");
      var formattedDate = dateSplit2.reverse().join('-');   
      $('.idea_creator_name').text(creator_name);
      $('#idea_creator_date').text(formattedDate);
      $('.idea_name_modal').text(short_question_name);
      $('#idea_create_details_modal').modal('show');
      
  });
  
  $(document).on('click', '.view_idea', function() {
    
      $('.view_idea').css({"background-color":"white", "color":"black"});
      $(this).css({"background-color":"#0062cc", "color":"white"})
			var idea_id = $(this).attr('data-id');
      var idea_chk = $(this).attr('data-idea');
      if(idea_chk != undefined){
        var text = $('#duplicate_idea_title').val();
        $('.idea_main_body').val(text);
      }else{
        $.ajax({
          url: "Tutor/view_tutor_idea",
          type: "POST",
          data: {
            idea_id: idea_id,
          },
          success: function(response) {
            var data = JSON.parse(response);
            console.log(data);
            $(".idea_main_body ").val(data['idea_ans']);
            $(".idea_creator").text(data['name']);

          }
        });
      }
			

		});

    function search_image_question(){
      var search_text = $("#advance_searc_image_src").val();
    
      $.ajax({
        url: "search_image_idea",
        type: "POST",
        data: {
          search_text: search_text
        },
        success: function(data) {

          var all_data = JSON.parse(data);
          console.log(all_data['questions']);
          html = '';

          for (i = 0; i < all_data['questions'].length; i++) {
            html += '<br><a class="search_button" type="button" data-img="1" data-id="' + all_data['questions'][i].question_id + '" data-index="' + all_data['questions'][i].id + '">' + all_data['questions'][i].image_title + '</a>';
          }

          $('#search_view').show();
          $('#image_search_view').html(html);

        }

      });
    }
    $('.Idea_viewBtnClose').click(function(){
       $('#Idea_view').hide();
    });
    $('.duplicate_idea_save').click(function(){
      var idea = $('#idea_description_body').val();
      $('.idea_main_body').val(idea);
      $('#idea_details_textarea').modal('hide');

      $.ajax({
        url: "getUserInfos",
        type: "POST",
        data: {},
        success: function(response) {
          var data = JSON.parse(response);
          // console.log(data);
          $('.idea_creator').text(data[0].name);
      
        }
      });
    });

</script>