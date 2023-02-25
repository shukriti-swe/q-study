<script src="<?php echo base_url(); ?>assets/ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>
<style type="text/css">
   .tooltip_rs {
      font-weight:bold;
      bottom: 100%;
      position: absolute;
      background: #00a2e8;
      z-index: 10;
      padding: 15px;
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
      content: '';
      position: absolute;
      bottom: -15px;
      left: 20%;
   }

   .tooltip_rs_new {
      font-weight:bold;
      bottom: 100%;
      position: absolute;
      background: #ED1C24;
      z-index: 10;
      padding: 15px;
      color: #fff;
      font-size: 12px;
      margin-bottom: 15px;
      left: 0;
      width: max-content;
      display: block;
      max-width: 400px;
      height: fit-content;
   }

   .tooltip_rs_new::after {
      width: 0;
      height: 0;
      border-left: 20px solid transparent;
      border-right: 20px solid transparent;
      border-top: 15px solid #ED1C24;
      content: '';
      position: absolute;
      bottom: -15px;
      left: 20%;
   }

   .one_hint_wrap {
      display: inline;
      position: relative;
   }

   .ss_s_b_main {
      padding: 10px;
      overflow: inherit;
   }

   .qstudy_module_video {
      position: absolute;
      width: 300px;
      height: 230px;
      top: 35px;
      border: 1px solid #ccc;
      background: #fff;
      z-index: 5;
      display: none;
   }

   .edit-card {
      position: relative;
   }

   .edit-card::after {
      content: '';
      height: 5px;
      width: 80%;
      background-color: #337bbc;
      position: absolute;
      left: 5px;
      bottom: 3.5px;
   }

   .qstudy_module_video .header {
      width: 100%;
      border-bottom: 1px solid #ccc;
      text-align: right
   }

   .qstudy_module_video .header span {
      padding: 3px 10px;
      background: #e3e1e1;
      font-weight: bold;
      cursor: pointer;
   }

   .qstudy_module_video .video-content {
      padding: 10px;
      width: 100%;
      height: 89%;
      overflow-y: scroll;
   }

   .qstudy_module_video .video-content p {

      border: 1px solid #a2a0a0;
      padding-left: 5px;
      background: #f6f6f6;
      margin-bottom: 5px;
      cursor: pointer;
   }

   .no_instruction {
      position: absolute;
      top: 40px;
      background: #c1fcc1;
      padding: 5px;
      border-radius: 5px;
      display: none;
   }

   .description_video {
      position: relative;
   }

   .description_class {
      position: absolute;
      left: 45px;
   }

   .question_video_class {
      position: absolute;
      left: 70px;
   }

   .rs_word_limt .top_word_limt>div {
      flex-basis: 0;
      -webkit-box-flex: 1;
      -ms-flex-positive: 1;
      flex-grow: 1;
      max-width: 100%;
   }

   .b-btn {
      display: inline-block;
   }

   .tutor_ans_modal {
      max-height: 300px;
      overflow-y: auto;
   }

   @media only screen and (min-width:768px) and (max-width:1023px) {
      .rs_word_limt .top_word_limt>div {
         font-size: 9px;
      }
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

   .hover_action {
      position: relative;
   }

   /* .hover_action .tooltiptext {
      visibility: hidden;
      width: 52px;
      background-color: #dee4f1;
      color: black;
      border: 2px solid #addaff;
      text-align: center;
      border-radius: 4px;
      padding: 4px 0;
      position: absolute;
      z-index: 1;
      bottom: 115%;
      left: 125%;
      margin-left: 9px;

   }

   .hover_action:hover .tooltiptext {
      visibility: visible !important;
   } */

   .st_hover_action {
      position: relative;
   }

   /* .st_hover_action .st_tooltiptext {
      visibility: hidden;
      width: 70px;
      background-color: #dee4f1;
      color: black;
      border: 2px solid #addaff;
      text-align: center;
      border-radius: 4px;
      padding: 4px 0;
      position: absolute;
      z-index: 1;
      bottom: 110%;
      left: 103%;
      margin-left: -58px;
   }

   .st_hover_action:hover .st_tooltiptext {
      visibility: visible !important;
   } */

   .idea_table td {
      text-align: left;
      font-size: 18px;
      padding-right: 10px;
   }

   .idea_table {
      margin: auto;
   }

   .idea_box {
      width: 800px;
      margin: 30px auto;
   }

   .exciting_box {
      width: 80%;
      margin: auto;
      width: 80%;
      margin: auto;
      background-color: #00a2e8;
      padding: 15px;
      border-radius: 12px;
   }

   .exciting_box p {
      color: white;
      font-size: 16px;
   }

   .idea_quiz_box {
      width: 1000px;
      margin: 30px auto;
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
   .student_idea_ans:hover .view_student_idea {
      background-color:#ffbd0e !important;
   }

   .student_idea_ans:hover .st_tooltiptext {
      visibility: visible !important;
      visibility: hidden;
      width: 60px;
      background-color: #dee4f1;
      color: black;
      border: 2px solid #addaff;
      text-align: center;
      border-radius: 4px;
      padding: 4px 0;
      z-index: 1;
      bottom: 110%;
      left: 103%;
      margin-left: -58px;
   }
   .tutor_idea_ans:hover .view_tutor_idea {
      background-color:#ffbd0e !important;
   }
   .tutor_idea_ans:hover .tooltiptext {
      visibility: visible !important;
      visibility: hidden;
      width: 60px;
      background-color: #dee4f1;
      color: black;
      border: 2px solid #addaff;
      text-align: center;
      border-radius: 4px;
      padding: 4px 0;
      z-index: 1;
      bottom: 110%;
      left: 103%;
      margin-left: -61px;
   }

   
   
</style>

<?php
   if ($this->session->userdata('user_id')) {
         $data['user_id']=$this->session->userdata('user_id');

         $this->db->select('*');
         $this->db->from('profile');
         $this->db->where('user_id',$data['user_id']);
         $queries = $this->db->get();
         $profile = $queries->result_array();
         
   }
?>
<input type="hidden" id="student_page_index" value="1">
<input type="hidden" id="tutor_page_index" value="1">

<div class="" style="margin-left: 15px;">
   <div class="row">
      <div class="col-md-12">
         <?php
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



         // $question_time = explode(':', $question_info_s[0]['questionTime']);
         $hour = 0;
         $minute = 0;
         $second = 0;

         if (is_numeric($idea_info[0]['time_hour'])) {
            $hour = $idea_info[0]['time_hour'];
         }
         if (is_numeric($idea_info[0]['time_min'])) {
            $minute = $idea_info[0]['time_min'];
         }
         if (is_numeric($idea_info[0]['time_sec'])) {
            $second = $idea_info[0]['time_sec'];
         }
         $question_time_in_second = 0;
         $question_time_in_second = ($hour * 3600) + ($minute * 60) + $second;
         $moduleOptionalTime = 0;
         if ($question_info_s[0]['moduleType'] == 2 && $question_info_s[0]['optionalTime'] != 0) {
            $moduleOptionalTime = $question_info_s[0]['optionalTime'];
         }

         $passTime = time() - $_SESSION['exam_start'];
         $setTime = 0;
         if ($moduleOptionalTime <= 0) {
            if ($question_time_in_second > 0) {
               $setTime = $question_time_in_second;
            }
         } else {
            $moduleOptionalTime = $moduleOptionalTime - $passTime;
            if ($question_time_in_second <= 0) {
               $setTime = $moduleOptionalTime;
            } else {
               if ($question_time_in_second > $moduleOptionalTime) {
                  $setTime = $moduleOptionalTime;
               } else {
                  $setTime = $question_time_in_second;
               }
            }
         }

         $link_next = "javascript:void(0);";
         $link = "javascript:void(0);";

         if (is_array($desired)) {
            $link_key = $key - 1;
            if (array_key_exists($link_key, $desired) && !$tutorial_ans_info) {
               $link = $desired[$link_key]['link'];
            }
            $link_key_next = $key;
            if (array_key_exists($link_key_next, $desired) && !$tutorial_ans_info) {
               $question_id = $question_info_s[0]['question_order'] + 1;
               $link1 = base_url();
               $link_next = $link1 . 'get_tutor_tutorial_module/' . $question_info_s[0]['module_id'] . '/' . $question_id;
            }
         }

         $module_type = $question_info_s[0]['moduleType'];

         $videoName = strlen($module_info[0]['video_name']) > 1 ? $module_info[0]['video_name'] : 'Subject Video';
         ?>
         <?php


         foreach ($total_question as $ind) {

            if ($ind["question_type"] == 14) {
               $chk = $ind["question_order"];
            }
         }
         
         ?>
         <!--         ***** Only For Special Exam *****         -->
         <?php if ($module_type == 3) { ?>
            <input type="hidden" id="exam_end" value="<?php echo strtotime($module_info[0]['exam_end']); ?>" name="exam_end" />
            <input type="hidden" id="now" value="<?php echo $module_time; ?>" name="now" />
            <input type="hidden" id="optionalTime" value="<?php echo $module_info[0]['optionalTime']; ?>" name="optionalTime" />
            <input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time'); ?>" />
         <?php } ?>
         <!--         ***** For Everyday Study & Tutorial *****         -->
         <?php if ($module_type == 2 || $module_type == 1) { ?>
            <input type="hidden" id="exam_end" value="" name="exam_end" />
            <input type="hidden" id="now" value="<?php echo $module_time; ?>" name="now" />
            <!--  <input type="hidden" id="optionalTime" value="--><?php //echo $question_time_in_second;
                                                                     ?>
            <!--" name="optionalTime" />-->
            <input type="hidden" id="optionalTime" value="<?php echo $setTime; ?>" name="optionalTime" />

            <input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time'); ?>" />
         <?php } ?>

         <div class="ss_student_board">
            <div class="ss_s_b_top">
               <div class="ss_index_menu <?php //if ($module_type == 3) {
                                          ?>col-md-3<?php
                                                      //}
                                                      ?>">
                  <?php if ($module_type == 1) {

                     if ($this->session->userdata('userType') == 3) { ?>

                        <a href="Tutor/all_tutors_by_type/2/1" style="display: inline-block;">Index</a>

                     <?php } else {
                     ?>
                        <a href="all_tutors_by_type/<?php echo $total_question[0]['user_id']; ?>/<?php echo $total_question[0]['moduleType']; ?>" style="display: inline-block;">Index</a>
                     <?php }
                  } else { ?>
                     <!-- <a >Index</a> -->
                  <?php } ?>
                  <?php if ($module_info[0]['video_name']) { ?>
                     <button class="btn btn_next" id="openVideo" style="margin-left: 25px;"><i class="fa fa-play" style="color:#35B6E7;margin-right: 5px;"></i><?php echo $videoName;  ?></button>
                  <?php } ?>
               </div>


               <?php
               $col_class = 'col-sm-7';
               if (($module_type == 2 && $question_info_s[0]['optionalTime'] != 0) || $module_type == 3) {
                  $col_class = 'col-sm-4';
               }
               ?>
               <div style="text-align: center;" class="text-center <?php echo $col_class ?><?php //if ($module_type != 3) {
                                                                                             //echo 'col-sm-7';
                                                                                             //} else {
                                                                                             //echo 'col-sm-6';
                                                                                             //}
                                                                                             ?> ss_next_pre_top_menu">
                  <?php if ($question_info_s[0]['isCalculator']) : ?>
                     <input type="hidden" name="" id="scientificCalc">
                  <?php endif; ?>
                  <?php if ($_SESSION['userType'] == 3 || $_SESSION['userType'] == 7) :
                  ?>
                     <!-- only tutor&qstudy will be able to back next -->
                     <?php if ($question_info_s[0]['moduleType'] == 1) { ?>
                        <a class="btn btn_next" href="<?php echo $link; ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
                        <a class="btn btn_next" href="<?php echo $link_next; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
                     <?php } else { ?>
                        <a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
                        <a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
                     <?php } ?>
                  <?php endif; ?>

                  <a class="btn btn_next" id="draw" onClick="test()" data-toggle="modal" data-target=".bs-example-modal-lg">
                     Workout <img src="assets/images/icon_draw.png">
                  </a>
               </div>
            </div>
            <div class="container-fluid">
               <div class="row">
                  <div class="ss_s_b_main" style="min-height: 100vh">
                     <div class="col-sm-7">
                        <div class="workout_menu" style=" padding-right: 15px;">
                           <ul>

                              <li><a style="cursor:pointer" id="show_question"> <img src="assets/images/icon_draw.png" /> Instruction </a></li>

                              <?php if ($idea_info[0]['large_question_allow'] != 0) { ?>
                                 <li><a style="cursor:pointer" id="show_questions"> Question(Click here) </a></li>
                              <?php } ?>

                              <!-- <li><a  href="javascript:;"  data-toggle="modal" data-target="#show_question_idea"> Idea 1</a></li> -->

                              <?php
                              if ($idea_info[0]['allow_idea'] == 1) {
                                 $j = 1;
                              ?>
                                 
                                 <?php $k = 1;
                                 foreach ($student_ideas as $student_idea) { ?>
                                    <li style="position:relative;<?php if($k>2){echo "display:none";}?>" class="student_idea_ans student_idea<?=$k?>">
                                    <span class="st_tooltiptext" style="visibility: hidden;position: absolute;">Student</span>
                                    <a class="view_student_idea idea_start_action" style="background: white; color:black;padding: 5px;border: 1px solid #ddd7d7;" href="javascript:;" data-index="<?= $student_idea['user_id']; ?>" data-question="<?=$student_idea['question_id'];?>" data-idea="<?= $student_idea['id']; ?>"><img src="assets/images/hand_with_pen_icon.png" class="" style="height:25px;margin-left: 10px;"><br>Idea-<?= $k; ?></a></li>
                                 <?php $k++;
                                 } ?>

                                 
                                 <div class="idea_start_action"><a style="cursor:pointer;" id="student_right_menu"><img src="assets/images/icon_a_left.png"></a></div>
                                 <div class="idea_start_action"><a style="cursor:pointer;" id="student_left_menu"><img src="assets/images/icon_a_right.png"></a></div>

                                 <?php $n = 1;
                                 foreach ($tutor_ideas as $tutor_idea) { ?>
                                    <li style="position:relative;<?php if($n>2){echo "display:none";}?>" class="tutor_idea_ans tutor_idea<?=$n?>"><span class="tooltiptext" style="visibility: hidden;position:absolute;">Tutor</span><a class="view_tutor_idea idea_start_action" style="background: white; color:black;border: 1px solid #ddd7d7;padding: 5px;" href="javascript:;" data-index="<?= $tutor_idea['user_id']; ?>" data-question="<?=$tutor_idea['question_id'];?>" data-idea="<?= $tutor_idea['id']; ?>"><img src="assets/images/hand_with_pen_icon.png" class="" style="height:25px;margin-left: 10px;"><br>Idea-<?= $n; ?></a></li>
                                 <?php $n++;
                                 } ?>

                                 <div class="idea_start_action"><a style="cursor:pointer;" id="tutor_right_menu"><img src="assets/images/icon_a_left.png"></a></div>
                                 <div class="idea_start_action"><a style="cursor:pointer;" id="tutor_left_menu"><img src="assets/images/icon_a_right.png"></a></div>

                              <?php } ?>
                           </ul>
                        </div>
                        <div class="top_textprev">



                           <?php


                           ?>
                           <?php if ($idea_info[0]['shot_question_title'] != '') { ?>

                           <?php }
                           if ($idea_info[0]['short_ques_body'] != '') { ?>
                              <p>
                                 <?php
                                 $text = $idea_info[0]['short_ques_body'];
                                 $target = "Requirement :";
                                 $result = strstr($text, $target);
                                 $remove_html = strip_tags($result);
                                 $str = preg_replace("/[^A-Za-z]/", "", $remove_html);
                                 $character_count = strlen($str);
                                 if ($character_count < 16) {
                                    $without_requirement = str_replace("Requirement :", "", $text);
                                    echo $without_requirement;
                                 } else {
                                    echo $text;
                                 }
                                 ?>
                              </p>
                           <?php } ?>
                        </div>

                        <div class="rs_word_limt">
                           <div class="top_word_limt">
                              <div>

                                 <?php if ($idea_info[0]['word_limit'] != 0) { ?>
                                    <span id="display_count"> 0 </span> Words
                                 <?php } ?>


                                 <!-- Time -->
                                 <input type="hidden" id="exam_end" value="" name="exam_end" />
                                 <input type="hidden" id="now" value="<?php echo $module_time; ?>" name="now" />
                                 <input type="hidden" id="optionalTime" value="<?php echo $question_time_in_second; ?>" name="optionalTime" />
                                 <input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time'); ?>" />
                              </div>

                              <?php if ($question_time_in_second != 0) {
                                 if ($idea_info[0]['time_hour'] < 10) {
                                    $get_hour = "0" . $idea_info[0]['time_hour'];
                                 } else {
                                    $get_hour = $idea_info[0]['time_hour'];
                                 }

                                 if ($idea_info[0]['time_min'] < 10) {
                                    $get_min = "0" . $idea_info[0]['time_min'];
                                 } else {
                                    $get_min = $idea_info[0]['time_min'];
                                 }

                                 if ($idea_info[0]['time_sec'] < 10) {
                                    $get_sec = "0" . $idea_info[0]['time_sec'];
                                 } else {
                                    $get_sec = $idea_info[0]['time_sec'];
                                 }
                                 $_REQUEST = $get_hour . ':' . $get_min . ':' . $get_sec;
                              ?>
                                 <div class="" style="text-align: center; margin:auto;">
                                    <div class="ss_timer" id="demo">
                                       <h1><?= $time_show; ?></h1>
                                    </div>
                                 </div>
                              <?php } ?>




                              <?php
                              if ($idea_info[0]['word_limit'] != 0) {
                              ?>
                                 <!-- <span class="m-auto" style="float: right;"><b>Word Limit</b></span> -->
                                 <div class="m-auto" style="padding-left: 20px;text-align:right;"><b>Word Limit </b><b class="b-btn"><?= $idea_info[0]['word_limit']; ?></b></div>
                              <?php } ?>
                           </div>
                           <div class="btm_word_limt">

                              <form id="creative_ans_save" method="post">

                                 <div class="content_box_word">

                                    <div class="text-center" id="on_focus">

                                       <?php if (($last_question_order != $key) && !$tutorial_ans_info) { ?>
                                          <input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] + 1; ?>" name="next_question" />
                                       <?php } else { ?>
                                          <input type="hidden" id="next_question" value="0" name="next_question" />
                                       <?php } ?>

                                       <input id="question_id" type="hidden" name="question_id" value="<?= $idea_info[0]['question_id'] ?>">

                                       <input id="module_id" type="hidden" name="module_id" value="<?= $question_info_s[0]['module_id']; ?>">

                                       <input id="question_order_id" type="hidden" name="question_order_id" value="<?= $question_info_s[0]['question_order']; ?>">

                                       <input id="module_type" type="hidden" name="module_type" value="<?= $module_type; ?>">

                                       <input id="idea_id" type="hidden" name="idea_id" value="<?= $idea_info[0]['id'] ?>">

                                       <input id="idea_no" type="hidden" name="idea_no" value="">
                                       <input id="idea_title" type="hidden" name="idea_title" value="">
                                       <input id="total_word" type="hidden" name="total_word" value="">
                                       <input id="student_ans" type="hidden" name="student_ans" value="">
                                       <input id="student_idea_title" type="hidden" name="student_idea_title" >

                                       <textarea id="word_count" class="form-control preview_main_body mytextarea" name="preview_main_body">
                                          <?php if ($idea_info[0]['student_title'] == 1) {

                                             if (!empty($idea_info[0]['time_hour']) || !empty($idea_info[0]['time_min']) || !empty($idea_info[0]['time_sec'])) { ?><elem id="time_image"><img  class="image-editor" style="padding-left: 20%;" data-height="250" data-width="200" height="179" src="<?= base_url() ?>/assets/images/pv1.jpg" width="281" /></elem>
                                          <?php }
                                          } else {
                                             if ($idea_info[0]['add_start_button'] == 1) { ?>
                                       <elem id="time_image"><img  class="image-editor" style="padding-left: 20%;" data-height="250" data-width="200" height="179" src="<?= base_url() ?>/assets/images/pv1.jpg" width="281" /></elem>
                                       <?php }
                                          } ?>

                                       </textarea>


                                    </div>

                                 </div>
                                 <div class="text-center">
                                    <?php if ($idea_info[0]['add_start_button'] != 0) { ?>
                                       <button data-toggle="modal" id="idea_start" class="btn btn_next" type="button">Start</button>
                                    <?php } ?>
                                    <button id="answer_matching" class="btn btn_next" type="button">Submit </button>
                                    <!-- <button id="answer_matching" class="btn btn_next" type="button"  data-toggle="modal" data-target="#alert_times_up">Submit </button>  -->
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-1"></div>
                     <div class="col-sm-4">
                        <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                           <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingOne">
                                 <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">

                                       <span>Module Name: <?php echo isset($module_info[0]['moduleName']) ? $module_info[0]['moduleName'] : 'Not found'; ?></span></a>
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
                                                   <th>Description</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <?php $i = 1;
                                                $total = 0;

                                                foreach ($total_question as $ind) { ?>

                                                   <tr>
                                                      <?php

                                                      $style = '';
                                                      if (isset($desired[$i]['ans_is_right'])) {
                                                         $qus_tutorial = get_question_tutorial($ind['question_id']);
                                                         if ($qus_tutorial && $module_info[0]['repetition_days'] == '') {
                                                            $style = "background-color:#dcf394;text-align: center;padding: 0px;";
                                                         }
                                                      }
                                                      ?>
                                                      <td style="<?php echo $style; ?>">
                                                         <?php if (isset($desired[$i]['ans_is_right'])) {
                                                            $qus_tutorial = get_question_tutorial($ind['question_id']);

                                                            if ($desired[$i]['ans_is_right'] == 'correct') { ?>
                                                               <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                               <?php if ($qus_tutorial && ($module_info[0]['repetition_days'] == '' || $module_info[0]['repetition_days'] == 'null')) { ?>
                                                                  <span class="question_tutorial_view" question_id="<?php echo $ind['question_id']; ?>" style="font-weight: bolder;color: #ff8b00;font-size: 20px;margin-left: 3px;">T</span>
                                                               <?php } ?>
                                                            <?php } else if ($desired[$i]['ans_is_right'] == 'idea') { ?>
                                                               <span class="glyphicon glyphicon-pencil" style="color: red;"></span>

                                                            <?php   } else { ?>
                                                               <span class="glyphicon glyphicon-remove" style="color: red;"></span>
                                                               <?php if ($qus_tutorial && ($module_info[0]['repetition_days'] == '' || $module_info[0]['repetition_days'] == 'null')) { ?>
                                                                  <span class="question_tutorial_view" question_id="<?php echo $ind['question_id']; ?>" style="font-weight: bolder;color: #ff8b00;font-size: 20px;margin-left: 3px;">T</span>
                                                               <?php } ?>
                                                         <?php }
                                                            // echo "//bbbbb".$ind["question_type"];

                                                         } ?>
                                                      </td>


                                                      <?php if (($ind["question_type"] != 14) && ($question_info_s[0]['question_order'] == $ind['question_order'])) { ?>
                                                         <td style="background-color:lightblue">
                                                            <?php echo $ind['question_order']; ?>
                                                         </td>
                                                      <?php } elseif (($ind["question_type"] == 14) && $order >= $chk) { ?>
                                                         <td style="background-color:#dcf394;text-align: center;padding: 0px;">
                                                            <a style="color: #000;" class="show_tutorial_modal" question_id="<?php echo $ind['question_id']; ?>" modalId="<?php echo $ind['module_id']; ?>" Order="<?php echo $ind['question_order']; ?>"><?php echo $ind['question_order']; ?><span style="font-weight: bolder;color: #ff8b00;font-size: 20px;margin-left: 3px;">T</span></a>
                                                         </td>
                                                      <?php } elseif (($ind["question_type"] == 14) && $order < $chk) { ?>
                                                         <td style="background-color:#dcf394;text-align: center;padding: 0px;">
                                                            <a style="color: #000;" class="show_tutorial_modal" question_id="<?php echo $ind['question_id']; ?>" modalId="<?php echo $ind['module_id']; ?>" Order="<?php echo $ind['question_order']; ?>"><?php echo $ind['question_order']; ?><span style="font-weight: bolder;color: #ff8b00;font-size: 20px;margin-left: 3px;">T</span></a>
                                                         </td>
                                                      <?php } else {  ?>

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
                                                         <?php if ($ind["question_type"] == 14) {
                                                            echo "0";
                                                         } ?>
                                                         <?php if (isset($desired[$ind['question_order']]['student_question_marks'])) {
                                                            echo $desired[$ind['question_order']]['student_question_marks'];
                                                         } ?>
                                                      </td>
                                                      <td class="description_video">
                                                         <?php if (isset($ind['questionDescription']) && $ind['questionDescription'] != null) { ?>
                                                            <a class="description_class" onclick="showModalDes(<?php echo $i; ?>);" style="display: inline-block;"><img src="assets/images/icon_details.png"></a>
                                                         <?php } ?>
                                                         <?php
                                                         $question_instruct_vid = isset($ind['question_video']) ? json_decode($ind['question_video']) : '';
                                                         ?>
                                                         <?php if (isset($question_instruct_vid[0]) && $question_instruct_vid[0] != null) { ?>
                                                            <a onclick="showQuestionVideo(<?php echo $i; ?>)" class="question_video_class" style="display: inline-block;"><img src="http://q-study.com/assets/ckeditor/plugins/svideo/icons/svideo.png"></a>
                                                         <?php } ?>
                                                      </td>
                                                   </tr>
                                                <?php $i++;
                                                } ?>
                                                <tr>
                                                   <td colspan="2">Total</td>
                                                   <td colspan="3"><?php echo $total ?></td>
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
               </div>
            </div>
         </div>
      </div>
   </div>
   <br>
   <br>
</div>
<div>
     <input type="hidden" id="student_view_idea_idea_id">
     <input type="hidden" id="student_view_idea_student_id">
     <input type="hidden" id="student_view_idea_question_id">
</div>

<form id="answer_form">
   <!-- modal idea -->
   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="show_question_idea">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">


            <div class="mclose" data-dismiss="modal">x</div>


            <div class="btm_word_limt">
               <div class="content_box_word student_ans_modal">
                  <p><strong>Here One Example</strong></p>
                  <p>When meat is usually t----- and juicy, it is easily digested. However, this word is also used to describe a soft-hearted person. For instance, Sam’s mother is always warm and t----- towards him</p>
                  <p>The meat was so t _ _ _ _ _ that I managed to cut through it very easily.</p>
               </div>
               <div class="created_name">

                  <img src="assets/images/icon_created.png"> <a href="javascript:;" id="topicstory"> <u>Topic/Story Created By :</u> </a> &nbsp; <b class="student_name">Lubna </b>
                  <input type="hidden" id="submited_ans_view_student_id" name="selected_student" value="">
                  <input type="hidden" id="submited_ans_idea_no" name="selected_student" value="">

               </div>

               <div style="text-align:center;margin:10px 0px;">
                  <button type="button" id="idea_next_student" class="btn btn_nexts">Next</button>
               </div>


            </div>




         </div>
      </div>
   </div>
   <!-- modal idea show_question_ idea_tutor -->
   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="show_question_idea_tutor">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">


            <div class="mclose" data-dismiss="modal">x</div>

            <div class="btm_word_limt">
               <div class="content_box_word tutor_ans_modal">
                  <!-- <p><strong>Here One Example</strong></p>
                  <p>When meat is usually t----- and juicy, it is easily digested. However, this word is also used to describe a soft-hearted person. For instance, Sam’s mother is always warm and t----- towards him</p>
                  <p>The meat was so t _ _ _ _ _ that I managed to cut through it very easily.</p> -->
               </div>
               <div class="created_name">
                  <img src="assets/images/icon_created.png"> <a type="button" href="javascript:;" data-toggle="modal" data-target="#topicstory_tutor"> <u>Topic/Story Created By :</u> </a> &nbsp; (Tutor) <b class="tutor_name"> Tutor</b>

               </div>

               <div style="text-align:center;margin:10px 0px;">
                  <button type="button" id="tutor_idea_next" style="display:none;background-color:#ffc90e;border:1px solid black;" class="btn btn_nexts">Next</button>
                  <button type="button" id="tutor_idea_close" style="display:none;background-color:#b5e61d;border:1px solid black;" class="btn btn_nexts" data-dismiss="modal">Close</button>
               </div>

            </div>

         </div>
      </div>
   </div>

   <!-- modal idea topicstory_tutor -->
   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="topicstory_tutor">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">


            <div class="mclose" data-dismiss="modal">x</div>


            <div class="btm_word_limt text-center">

               <input type="hidden" name="tutor_idea_no" id="tutor_idea_no" value="">
               <input type="hidden" name="tutor_id" id="get_tutor_id" value="">
               <p>Tutor(<b class="tutor_name">name</b>)</p>
               <p><u>Topic/Stoty Title</u></p>

               <div class="blue">

               </div>

               <p> Created: &nbsp; &nbsp; <span id="tutor_submit_date">06/08/2021</span></p>
               <div class="clik_point"><i class="fa fa-thumbs-up" aria-hidden="true"></i></div>

               <div class="clik_point_detatis_tutor">
                  <div class="clik_point_detatis">
                     Total Number Of Like <div class="clik_point">33</i></div>
                  </div>
                  <br>
                  <div class="your_achived_point">
                     Your Achived points <br>
                     <button id="like_get_point">15</button>
                  </div>
               </div>


            </div>



         </div>
      </div>
   </div>

   <!-- modal idea profile -->
   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="show_question_idea_profile">
      <!-- Modal -->
      <div class="modal-dialog " role="document">
         <div class="modal-content">


            <div class="mclose" data-dismiss="modal">x</div>
            <div class="row">
               <div class="col-sm-4">
                  <div class="p-3 profile_left_ida">
                     <div class="text-center">
                        <img id="profile_image" src="assets/images/pp.jpg">
                     </div>
                     <table class="table" border="0">
                        <tbody id="student_info">
                           <tr>
                              <td>Created</td>
                              <td>15/08/2021</td>
                           </tr>
                           <tr>
                              <td>Name</td>
                              <td>Luchi</td>
                           </tr>
                           <tr>
                              <td>Grade/Year</td>
                              <td>3</td>
                           </tr>
                           <tr>
                              <td>School</td>
                              <td>Dhaka school</td>
                           </tr>
                           <tr>
                              <td>Country</td>
                              <td>Australia</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-sm-8">
                  <div class="profile_right_ida">
                     <div class="welcom_mes">
                        Welcome! In this exciting section you have the cool opportunity to earn Extra Bonus Points. Put on the teacher’s hat and grade the student’s work below, let’s start!
                     </div>
                     <p><u> Topic/Story Title</u></p>
                     <p class="blue">"New Environment"</p>
                     <p class="p-3">
                        Submited by "<b class="student_name">Linda</b>" <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user_checks">Check</button> Edited by "Tutor" <button type="button" disabled="disabled" class="btn btn-primary tutor_check_button" data-toggle="modal" data-target="#tutor_checks"> Check</button>
                     </p>
                  </div>

               </div>
            </div>

            <div class="row">
               <div class="col-sm-4">
                  <div style="display: none;" class="your_achived_point" id="your_achived_point">
                     Your Achived points <br>
                     <button id="grade_get_point">150</button>
                  </div>
               </div>
               <div class="col-sm-8">
                  <div class="profile_right_ida_bottom table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th></th>
                              <th class="red">Poor</th>
                              <th class="blue">Average</th>
                              <th class="gold">Good</th>
                              <th class="green">Very Good</th>
                              <th class="orange">Excellent!</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Relevance</td>
                              <td>
                                 <input type="checkbox" value="1" class="report_box relevance" id="Rel_poor" name="Rel_poor"><span id="Rel_poor_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="2" class="report_box relevance" id="Rel_average" name="Rel_average"><span id="Rel_average_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="3" class="report_box relevance" id="Rel_good" name="Rel_good"><span id="Rel_good_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="4" class="report_box relevance" id="Rel_very_good" name="Rel_very_good"><span id="Rel_very_good_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="5" class="report_box relevance" id="Rel_excellent" name="Rel_excellent"><span id="Rel_excellent_span"></span>
                              </td>
                           </tr>
                           <tr>
                              <td>Creativity</td>
                              <td>
                                 <input type="checkbox" value="1" class="report_box creativity" id="cre_poor" name="cre_poor"><span id="cre_poor_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="2" class="report_box creativity" id="cre_average" name="cre_average"><span id="cre_average_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="3" class="report_box creativity" id="cre_good" name="cre_good"><span id="cre_good_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="4" class="report_box creativity" id="cre_very_good" name="cre_very_good"><span id="cre_very_good_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="5" class="report_box creativity" id="cre_excellent" name="cre_excellent"><span id="cre_excellent_span"></span>
                              </td>
                           </tr>
                           <tr>
                              <td>Grammar/Spelling</td>
                              <td>
                                 <input type="checkbox" value="1" class="report_box grammar" id="grammar_poor" name="grammar_poor"><span id="grammar_poor_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="2" class="report_box grammar" id="grammar_average" name="grammar_average"><span id="grammar_average_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="3" class="report_box grammar" id="grammar_good" name="grammar_good"><span id="grammar_good_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="4" class="report_box grammar" id="grammar_very_good" name="grammar_very_good"><span id="grammar_very_good_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="5" class="report_box grammar" id="grammar_excellent" name="grammar_excellent"><span id="grammar_excellent_span"></span>
                              </td>
                           </tr>
                           <tr>
                              <td>Vocabulary</td>
                              <td>
                                 <input type="checkbox" value="1" class="report_box vocabulary" id="vocabulary_poor" name="vocabulary_poor"><span id="vocabulary_poor_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="2" class="report_box vocabulary" id="vocabulary_average" name="vocabulary_average"><span id="vocabulary_average_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="3" class="report_box vocabulary" id="vocabulary_good" name="vocabulary_good"><span id="vocabulary_good_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="4" class="report_box vocabulary" id="vocabulary_very_good" name="vocabulary_very_good"><span id="vocabulary_very_good_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="5" class="report_box vocabulary" id="vocabulary_excellent" name="vocabulary_excellent"><span id="vocabulary_excellent_span"></span>
                              </td>
                           </tr>
                           <tr>
                              <td>Clarity</td>
                              <td>
                                 <input type="checkbox" value="1" class="report_box clarity" id="clarity_poor" name="clarity_poor"><span id="clarity_poor_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="2" class="report_box clarity" id="clarity_average" name="clarity_average"><span id="clarity_average_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="3" class="report_box clarity" id="clarity_good" name="clarity_good"><span id="clarity_good_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="4" class="report_box clarity" id="clarity_very_good" name="clarity_very_good"><span id="clarity_very_good_span"></span>
                              </td>
                              <td>
                                 <input type="checkbox" value="5" class="report_box clarity" id="clarity_excellent" name="clarity_excellent"><span id="clarity_excellent_span"></span>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="profile_right_ida">
                     <p style="display: flex;">
                        Your grade <button style="margin-right:5px;margin-left:5px;" type="button" class="btn btn-primary" id="view_my_grade">Check</button> <input style="margin-right:5px;" type="text" class="form-control w-50" id="my_grade" name="" value="0"> Tutor Grade <button disabled="disabled" style="margin-right:5px;margin-left:5px;" type="button" id="tutor_report_show" class="btn btn-primary tutor_check_button">Check</button>
                        <input style="margin-right:5px;" type="text" class="form-control w-50" id="tutor_grade_show" name="tutor_grade" value="0">
                        <input style="display: none;margin-right:5px;" type="text" class="form-control w-50" id="tutor_grade" name="tutor_grade" value="0">
                     </p>

                     <input type="hidden" class="form-control w-50" id="tutor_report" name="tutor_report" value="">

                     <div class="text-center">
                        <br>
                        <button type="button" class="btn btn_next" id="submit_button">Submit</button>
                     </div>
                  </div>
               </div>
            </div>


         </div>
      </div>
   </div>

   <!-- modal user_checks -->
   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="user_checks">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="mclose" data-dismiss="modal">x</div>
            <div class="btm_word_limt">
               <div class="content_box_word student_ans_modal">
                  <p><strong>Here One Example</strong></p>
                  <p>When meat is usually t----- and juicy, it is easily digested. However, this word is also used to describe a soft-hearted person. For instance, Sam’s mother is always warm and t----- towards him</p>
                  <p>The meat was so t _ _ _ _ _ that I managed to cut through it very easily.</p>
               </div>

            </div>

         </div>
      </div>
   </div>
   <!-- modal user_checks -->
   <div class="modal fade ss_modal" id="others_idea_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <!-- Modal -->
      <div style="max-width: 100%;margin-top:8%;" class="modal-dialog idea_box" role="document">
         <div class="modal-content">


            <div style="padding:10px;" class="btm_word_limt p-3 text-center">
               <div class="image_box">
                 
                  <img src="assets/images/default_user.jpg" alt="User Image" style="width: 125px; height:115px" id="idea_user_image" class="ss_user" />   
                  
               </div>
               <br>
               <table class="idea_table">
                  <tr>
                     <td>Created</td>
                     <td id="st_sub_idea_created_date"></td>
                  </tr>
                  <tr>
                     <td>Name</td>
                     <td id="st_sub_idea_name"></td>
                  </tr>
                  <tr>
                     <td>Grade/Year </td>
                     <td id="st_sub_idea_grade"></td>
                  </tr>
                  <tr>
                     <td>School</td>
                     <td id="st_sub_idea_school">Test School</td>
                  </tr>
                  <tr>
                     <td>Country</td>
                     <td id="st_sub_idea_country">Test School</td>
                  </tr>
               </table>
               <br><br>
               <div>
                  <!-- <h4>Topic/Story Title</h4> -->
                  <h6>Idea/Topic/Stoty Title</h6>
                  <div class="others_idea_info_blue">

                  </div>
               </div>
               <br><br>
               <div class="exciting_box">
                  <p>Welcome! in the exciting section you have the cool opportunity to earn extra bonus point. Put on the teacher's hat and grade the students work bellow, let's start!</p>
               </div>

               <br>
               <div style="text-align:center;">
                  <button id="start_idea_quiz" class="btn btn_next" type="button">Start</button>
               </div>

            </div>
            <div>

            </div>
         </div>
      </div>
   </div>

   <!-- modal user_checks -->
   <div class="modal fade ss_modal" id="idea_quiz_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <!-- Modal -->
      <div style="max-width: 100%;margin-top:8%;" class="modal-dialog idea_quiz_box" role="document" style="overflow-y: initial !important">
         <div class="modal-content">
            <div class="modal-body" style="height: 80vh; overflow-y: auto;">
               <div class="mclose" data-dismiss="modal">x</div>
               <div style="padding:10px;" class="btm_word_limt p-3 text-center">
                  <div class="row">
                     <div class="col-md-5" style="border:1px solid #d4d3d3;padding:2px;">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="image_box">
                                 <img src="assets/images/default_user.jpg" alt="User Image" style="width: 100px; height:70px" class="idea_user_image" class="ss_user" />  
                              </div>
                           </div>
                           <div class="col-md-8">
                              <table class="idea_table">
                                 <tr>
                                    <td>Created</td>
                                    <td class="st_sub_idea_created_date"></td>
                                 </tr>
                                 <tr>
                                    <td>Name</td>
                                    <td class="st_sub_idea_name"></td>
                                 </tr>
                                 <tr>
                                    <td>Grade/Year </td>
                                    <td class="st_sub_idea_grade"></td>
                                 </tr>
                                 <tr>
                                    <td>School</td>
                                    <td class="st_sub_idea_school">Test School</td>
                                 </tr>
                                 <tr>
                                    <td>Country</td>
                                    <td class="st_sub_idea_country">Test School</td>
                                 </tr>
                              </table>
                           </div>

                           <div class="col-md-4">
                              
                           </div>
                           <div class="col-md-8">
                              <br>
                              <p style="text-align:left;margin-left: 15px;"><b>Idea/Topic/Story Title</b></p>
                              <p style="text-align:left;margin-left: 15px;" id="student_idea_title"></p>
                           </div>

                        </div>
                     </div>
                     <div class="col-md-4">
                        <h6>Write about the topic bellow:</h6>

                        <div class="idea_quiz_modal_blue">

                        </div>
                     </div>

                     <div class="col-md-3">

                     </div>
                  </div>

                  <br>
                  <div class="row">
                     <div class="col-md-8"></div>
                     <div class="col-md-4" style="display: flex; justify-content: space-between">

                        <button type="button" class="btn">instruction time</button>

                        <div class="your_point_show">Your Point :
                           <span class="total_point_count btn" style="background-color: red;color: #fff;width: 26%;">0</span>
                        </div>

                     </div>
                  </div>
               </div>
               <div class="row" style="display: flex;">
                  <div class="col-md-6 tutor_idea_text" style="border: 1px solid #82bae6;padding: 5px;box-shadow: 0px 0px 4px #82bae6;border-radius: 5px;">

                  </div>
                  <div class="col-md-6 creative_sentense_paragraph_show" style="border:1px solid #82bae6;padding: 5px;box-shadow: 0px 0px 4px #82bae6;border-radius: 5px;">

                  </div>

                  <div class="col-md-6 conclusion_sentense_paragraph_show" style="border:1px solid #82bae6;padding: 5px;box-shadow: 0px 0px 4px #82bae6;border-radius: 5px;">

                  </div>

                  <div class="col-md-6 common_answer_paragraph" style="border:1px solid #82bae6;padding: 5px;box-shadow: 0px 0px 4px #82bae6;border-radius: 5px;">

                  </div>
                  <div class="col-md-6 introduction_answer_paragraph" style="border:1px solid #82bae6;padding: 5px;box-shadow: 0px 0px 4px #82bae6;border-radius: 5px;">

                  </div>
                  <div class="col-md-6 body_answer_paragraph" style="border:1px solid #82bae6;padding: 5px;box-shadow: 0px 0px 4px #82bae6;border-radius: 5px;">

                  </div>
                 
                  <div class="col-md-6" style="border:1px solid #82bae6;padding:5px;margin-left:3%;overflow: hidden;box-shadow: 0px 0px 4px #82bae6;border-radius: 5px;">

                     <div class="with_option">
                        <br>
                        <div class="content_Show"">
                           <p class=" rainy_day_hide" style="font-weight: bold;margin-left:30px;">How do You think lindas story title ("Rainy day") Which of the following sentences will you choose for linda</p>
                           <p class="choose_word" style="font-weight: bold;margin-left:30px; display:none">Click and choose the words from Linda's story which was mis spelled.</p>
                           <p class="heading_creative_sentense_show" style="font-weight: bold;margin-left:30px;">Click and choose two sentences from Linda's story which was creative.</p>
                           <p class="heading_conclusion_sentense_show" style="font-weight: bold;margin-left:30px;">Click and choose the "Conclusion" from the Linda's story.</p>
                           <p class="heading_checkbox_show" style="font-weight: bold;margin-left:30px;">How do you think about Linda's Conclusion?</p>
                           <p class="heading_introduction_paragraph" style="font-weight: bold;margin-left:30px;">Click and choose the "Introduction" from the Linda's story.</p>
                           <p class="heading_checkbox_introduction" style="font-weight: bold;margin-left:30px;">How do you think about Linda's Introduction?</p>
                           <p class="heading_body_paragraph" style="font-weight: bold;margin-left:30px;">Click and choose the "Body Paragraph" from the Linda's story.</p>
                           <p class="heading_checkbox_body" style="font-weight: bold;margin-left:30px;">How do you think about Linda's Body Paragraph?</p>
                        </div>
                        <br>

                        <div style="width:100%;padding-left:30px;position:relative;">

                           <div class="ans_submit_first_box">
                              <div class="ans_show" style="min-height:150px">
                                 <div style="width:100%;padding-left:30px;position:relative;">
                                    <div style="margin-top: 15px;">
                                       <label class="custom_radio"><span class="option_no all_options">Not Bad</span>
                                          <input type="radio" class="radio_ans" id="html" name="radio_ans" value="1">
                                          <span class="checkmark "></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div style="width:100%;padding-left:30px;position:relative;">
                                    <div style="margin-top: 15px;">
                                       <label class="custom_radio"><span class="option_no all_options">Not Related</span>
                                          <input type="radio" class="radio_ans" id="html" name="radio_ans" value="2">
                                          <span class="checkmark "></span>
                                       </label>
                                    </div>
                                 </div>
                                 <div style="width:100%;padding-left:30px;position:relative;">
                                    <div style="margin-top: 15px;">
                                       <label class="custom_radio"><span class="option_no all_options">It was great title</span>
                                          <input type="radio" class="radio_ans" id="html" name="radio_ans" value="3">
                                          <span class="checkmark "></span>
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="row text-left">
                                 <input type="hidden" value="<?php echo $question_id; ?>" name="question_id" id="question_id">
                                 <a href="javascript:;" type="button" class="btn btn-primary ans_submit" style="background-color: #bee131;color:#000; margin-top:30px">submit</a>
                              </div>
                           </div>

                           <div class="row">

                              <div class="ans_submit_second_box" style="display: none;">

                                 <div class="col-md-6">

                                    <p>Your Grading</p>

                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Bad</span>
                                             <input type="radio" class="student_radio_ans" id="html" name="student_radio_ans" value="1">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Related</span>
                                             <input type="radio" class="student_radio_ans" id="html" name="student_radio_ans" value="2">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">It was great title</span>
                                             <input type="radio" class="student_radio_ans" id="html" name="student_radio_ans" value="3">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>

                                 </div>

                                 <div class="col-md-6">

                                    <p>Teachers Grading</p>

                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Bad</span>
                                             <input type="radio" class="teacher_radio_ans0" id="html" name="teacher_radio_ans" value="1">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Related</span>
                                             <input type="radio" class="teacher_radio_ans1" id="html" name="teacher_radio_ans" value="2">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">It was great title</span>
                                             <input type="radio" class="teacher_radio_ans2" id="html" name="teacher_radio_ans" value="3" checked>
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>

                                 </div>


                                 <div class="row text-left">
                                    <input type="hidden" value="<?php echo $question_id; ?>" name="question_id" id="question_id">
                                    <a href="javascript:;" type="button" class="btn btn-primary ans_submit_next" style="background-color: #bee131;color:#000; margin-top:30px">Next</a>
                                 </div>


                              </div>
                              <div class="ans_submit_miss_spelled" style="display:none;">
                                 <div class="choosen_word_show" style="min-height:150px;">

                                 </div>
                                 <a href="javascript:;" type="button" class="btn btn-primary ans_submit_spelled" style="background-color: #bee131;color:#000; margin-top:30px;">submit</a>
                                 <a href="javascript:;" type="button" class="btn btn-primary next_submit_spelled" style="background-color: #FFC90E;color:#000; margin-top:30px;">Next</a>
                              </div>
                              <div class="chose_creative_sentense" style="display:none;">
                                 <div class="chose_creative_sentense_show" style="min-height:150px;">

                                 </div>
                                 <a href="javascript:;" type="button" class="btn btn-primary ans_creative_question" style="background-color: #bee131;color:#000; margin-top:30px;">submit<a>
                                       <a href="javascript:;" type="button" class="btn btn-primary next_creative_sentence_button" style="background-color: #FFC90E;color:#000; margin-top:30px;">Next</a>
                              </div>

                              <div class="chose_conclusion_sentense" style="display:none;padding-right: 14px;">
                                 <div class="chose_conclusion_sentense_show" style="min-height:150px;">

                                 </div>
                                 <a href="javascript:;" type="button" class="btn btn-primary ans_conclusion_question" style="background-color: #bee131;color:#000; margin-top:30px">submit<a>

                                       <a href="javascript:;" type="button" class="btn btn-primary next_conclusion_sentence_button" style="background-color: #FFC90E;color:#000; margin-top:30px;">Next</a>
                              </div>

                              <div class="conclusion_checkbox" style="padding-right: 14px;">
                                 <div class="conclusion_checkbox_show col-md-6" style="min-height:150px;">
                                    <P>Your Grading:</P>             
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Bad</span>
                                             <input type="radio" class="conclusion_radio" id="html" name="radio_ans" value="1">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Related</span>
                                             <input type="radio" class="conclusion_radio" id="html" name="radio_ans" value="2">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">It was great conclusion</span>
                                             <input type="radio" class="conclusion_radio" id="html" name="radio_ans" value="3">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <a href="javascript:;" type="button" class="btn btn-primary ans_conclusion_comment" style="background-color: #bee131;color:#000; margin-top:30px">Submit</a>

                                 </div>
                                 <div class="conclusion_checkbox_show_teacher col-md-6" style="min-height:150px;">
                                    <P>Teacher Grading:</P>             
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Bad</span>
                                             <input type="radio" class="conclusion_checkbox_ans1" id="html" name="radio_ans_new" value="1" disabled>
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Related</span>
                                             <input type="radio" class="conclusion_checkbox_ans2" id="html" name="radio_ans_new" value="2" disabled>
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">It was great conclusion</span>
                                             <input type="radio" class="conclusion_checkbox_ans3" id="html" name="radio_ans_new" value="3" disabled>
                                             <span class="checkmark"></span>
                                          </label>
                                       </div>
                                    </div>

                                 </div>               
                                  
                                
                                 <a href="javascript:;" type="button" class="btn btn-primary ans_conclusion_next" style="background-color: #bee131;color:#000; margin-top:30px">Next<a>                
                              </div>

                              <div class="introduction_paragraph" style="display:none;">
                                 <div class="introduction_paragraph_show" style="min-height:150px;">

                                 </div>
                                 <a href="javascript:;" type="button" class="btn btn-primary introduction_paragraph_submit" style="background-color: #bee131;color:#000; margin-top:30px;">submit<a>
                                 <a href="javascript:;" type="button" class="btn btn-primary ans_introduction_next" style="background-color: #bee131;color:#000; margin-top:30px">Next</a>    
                              </div>

                              <div class="introduction_checkbox" style="padding-right: 14px;">
                                 <div class="introduction_checkbox_show col-md-6" style="min-height:150px;">
                                    <P>Your Grading:</P>             
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Bad</span>
                                             <input type="radio" class="introduction_radio" id="html" name="radio_ans" value="1">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Related</span>
                                             <input type="radio" class="introduction_radio" id="html" name="radio_ans" value="2">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">It was great Introduction</span>
                                             <input type="radio" class="introduction_radio" id="html" name="radio_ans" value="3">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <a href="javascript:;" type="button" class="btn btn-primary ans_introduction_comment" style="background-color: #bee131;color:#000; margin-top:30px">Submit</a>

                                 </div>
                                 <div class="introduction_checkbox_show_teacher col-md-6" style="min-height:150px;">
                                    <P>Teacher Grading:</P>             
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Bad</span>
                                             <input type="radio" class="introduction_checkbox_ans1" id="html" name="radio_ans_introduction" value="1" disabled>
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Related</span>
                                             <input type="radio" class="introduction_checkbox_ans2" id="html" name="radio_ans_introduction" value="2" disabled>
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">It was great Introduction</span>
                                             <input type="radio" class="introduction_checkbox_ans3" id="html" name="radio_ans_introduction" value="3" disabled>
                                             <span class="checkmark"></span>
                                          </label>
                                       </div>
                                    </div>

                                 </div>               
                                  
                                
                                 <a href="javascript:;" type="button" class="btn btn-primary ans_introduction_next_new" style="background-color: #bee131;color:#000; margin-top:30px">Next</a>                
                              </div>

                              <div class="body_paragraph" style="display:none;">
                                 <div class="body_paragraph_show" style="min-height:150px;">

                                 </div>
                                 <a href="javascript:;" type="button" class="btn btn-primary body_paragraph_submit" style="background-color: #bee131;color:#000; margin-top:30px;">submit<a>
                                 <a href="javascript:;" type="button" class="btn btn-primary ans_body_next" style="background-color: #bee131;color:#000; margin-top:30px">Next</a>    
                              </div>

                              <div class="body_paragraph_checkbox" style="padding-right: 14px;">
                                 <div class="body_paragraph_checkbox_show col-md-6" style="min-height:150px;">
                                    <P>Your Grading:</P>             
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Bad</span>
                                             <input type="radio" class="body_radio" id="html" name="radio_ans" value="1">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Related</span>
                                             <input type="radio" class="body_radio" id="html" name="radio_ans" value="2">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">It was great body paragraph</span>
                                             <input type="radio" class="body_radio" id="html" name="radio_ans" value="3">
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <a href="javascript:;" type="button" class="btn btn-primary ans_body_comment" style="background-color: #bee131;color:#000; margin-top:30px">Submit</a>

                                 </div>
                                 <div class="body_paragraph_checkbox_show_teacher col-md-6" style="min-height:150px;">
                                    <P>Teacher Grading:</P>             
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Bad</span>
                                             <input type="radio" class="body_checkbox_ans1" id="html" name="body_ans_introduction" value="1" disabled>
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">Not Related</span>
                                             <input type="radio" class="body_checkbox_ans2" id="html" name="body_ans_introduction" value="2" disabled>
                                             <span class="checkmark "></span>
                                          </label>
                                       </div>
                                    </div>
                                    <div style="width:100%;padding-left:30px;position:relative;">
                                       <div style="margin-top: 15px;">
                                          <label class="custom_radio"><span class="option_no all_options">It was great body paragraph</span>
                                             <input type="radio" class="body_checkbox_ans3" id="html" name="body_ans_introduction" value="3" disabled>
                                             <span class="checkmark"></span>
                                          </label>
                                       </div>
                                    </div>

                                 </div>               
                                  
                                
                                 <a href="javascript:;" type="button" class="btn btn-primary ans_body_next_new" style="background-color: #bee131;color:#000; margin-top:30px">Next</a>                
                              </div>

                              <div class="total_point_show" style="padding-right:14px;">
                                 <div style="text-align:center;padding:10px;">
                                       <h4 style="font-size:24px">Your Total Point: <span class="all_point_show" style="background:#ff0000;color:#e6eed5">30</span></h4>               
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
   </div>


   <!-- modal tutor_checks -->
   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="tutor_checks">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="mclose" data-dismiss="modal">x</div>
            <div class="btm_word_limt">
               <div class="content_box_word">
                  <div class="row">
                     <img id="teacher_correction_img" src="">
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>
   <!-- alert_times_up -->
   <div class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="alert_times_up">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h4>Times Up</h4>
            </div>

            <div class="modal-body">

               <p>Oops! You’ve lost your paragraph for exceeding your time! You need to re-write from the start.</p>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
            </div>

         </div>
      </div>

   </div>
   <!-- /////////////// -->
   <div class="modal fade ss_modal" id="idea_save_faild" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">

               <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
               <img src="assets/images/icon_sucess.png" class="pull-left"> <span class="ss_extar_top20">You already submit this Idea</span>
            </div>
            <div class="modal-footer">
               <button id='get_next_question' type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="idea_save_success">
      <!-- Modal -->
      <div style="max-width: 20%;" class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h4>Success</h4>
            </div>

            <div class="modal-body">
               <p><i class="fa fa-pencil" style="font-size:28px;color:#f5d743;"></i></p>
               <p>Examiner will scrutinize your answer and get back to you.</p>

            </div>
            <div class="modal-footer">
               <button id="get_next_question2" type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
            </div>

         </div>
      </div>
   </div>

   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="show_question_body">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="btm_word_limt p-3">
               <div>
                  <button type="button" id="close_idea" class=" pull-right" data-dismiss="modal">x</button>
               </div>
               <br>
               <hr>
               <?= $idea_info[0]['large_ques_body'] ?>
               <div class="text-center p-3">
                  <button type="button" id="close_idea" class="btn btn-info pull-right" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade ss_modal " id="idea_title_show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">

         <div class="modal-content" style="width: 50%;margin-left:25%;display:none;" id="show_empty_idea">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel"> </h4>
            </div>

            <div class="modal-body">
               <i class="fa fa-pencil" style="font-size:28px;color:#f5d743;"></i>
               <p>Please Write Idea title first!!</p>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn_blue" id="close_empty_idea">Ok</button>
            </div>

         </div>

         <div class="modal-content">

            <div class="modal-header">
               <h4>Topic/Story Title</h4>
            </div>

            <div class="modal-body">

               <div class="d-flex idea_modal_textarea">
                  <textarea id="idea_title_text_get" class="form-control idea_title_text " name="idea_title_text23"></textarea>
               </div>



            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn_blue ideabtnclose">close</button>
            </div>

         </div>
      </div>
   </div>
   <div class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="alert_times_up">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h4>Times Up</h4>
            </div>

            <div class="modal-body">

               <p>Oops! You’ve lost your paragraph for exceeding your time! You need to re-write from the start.</p>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
            </div>

         </div>
      </div>

   </div>

   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="tutor_idea_marking">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="btm_word_limt">
               <div style="border:1px solid #c3c3c3;margin: 0px 25%;">
                  <h6 style="text-align:center;font-weight:bold;color:#7f7f7f;">Tutor<h6>
                  <p class="idea_tutor_name" style="text-align:center;font-weight:bold;color:#7f7f7f;"><p>
                  <br>
                  <p style="text-align:center;font-weight:bold;">Idea/Topic/Story Title<p>
                  <h6 style="text-align:center;font-weight:bold;color:#ff7f27;" id="tutor_idea_title">Tutor Name<h6>
                  <p style="text-align:center;color:#7f7f7f;">created : <span class="idea_submit_date"></span></p>
               </div>
               <br>
               <br>
               <div style="margin: 0px 23%;" class="student_point_check">
                  <h6 style="text-align:center;font-weight:bold;color:#880015;">Choose Your Marking<h6>
                  <br>
                  <div class="row">
                     <div class="col-md-4">
                        <img src="assets/images/average_img.png">
                        <p class="text-center" style="font-weight:bold;color:#87551c;">Average</p>
                        <div style="text-align:center;">
                           <input type="radio" name="st_mark" class="average_check student_marking" value="1">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <img src="assets/images/good_img.png">
                        <p class="text-center" style="font-weight:bold;color:#87551c;">Good</p>
                        <div style="text-align:center;">
                           <input type="radio" name="st_mark" class="good_check student_marking" value="2">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <img src="assets/images/excelent_img.png">
                        <p class="text-center" style="font-weight:bold;color:#87551c;">Excelent</p>
                        <div style="text-align:center;">
                           <input type="radio" name="st_mark" class="excelent_check student_marking" value="3">
                        </div>
                     </div>
                  </div>
                  <br>
                  <div style="text-align:center;">
                     <button type="button" id="" style="background-color:#b5e61d;border:1px solid black;font-weight:bold;" class="btn student_mark_submit" >Submit</button>
                     <button type="button" id="" style="background-color:#b5e61d;border:1px solid black;font-weight:bold;" class="btn btn_nexts" data-dismiss="modal">Back</button>
                  </div>
                  <br>
                  <p style="text-align:center;font-weight:bold;color:#7f7f7f;">See others tutor's "Idea" and then submit<p>
               </div>

               <div class="get_point_message" style="display:none;">
                  <div style="margin:0px 25%;padding:30px 0px;background-color:#f7f7f7;">
                     <h5 style="text-align:center;">Your Point : <a class="btn btn-danger saved_point_show" type="button">10</a></h5>
                  </div>
                  <br><br>
                  <div style="display:flex;gap:10px;text-align:center;">
                     <h6 style="font-weight: bold;color: #ed1c24;margin-left:20%;">Student's <span class="student_point_ans_text">Average</span> Vote:</h6>
                     <p style="font-size: 16px;font-weight: bold;color: #794f1a;" class="tutor_point_ans_text">Excelent</p>
                     <div><img class="tutor_point_icon" style="margin-top:-25px;height: 75px;" src="assets/images/excelent_img.png"></div>
                  </div>
                  <br>
                  <div style="text-align:center;">
                     <button type="button" id="" style="background-color:#b5e61d;border:1px solid black;font-weight:bold;" class="btn btn_nexts" data-dismiss="modal">Next</button>
                  </div>
                  <br>

               </div>
            </div>
         </div>
      </div>
   </div>


   <!-- Mark hidden filed -->
   <input type="hidden" id="story_checkbox_mark">
   <input type="hidden" id="word_spelled_mark">
   <input type="hidden" id="creative_sentence_mark">
   <input type="hidden" id="conclusion_sentence_mark">
   <input type="hidden" id="conclusion_checkbox_mark">
   <input type="hidden" id="introduction_sentence_mark">
   <input type="hidden" id="introduction_checkbox_mark">
   <input type="hidden" id="body_sentence_point">
   <input type="hidden" id="body_checkbox_mark">
   <!-- End -->
   <input type="hidden" id="number_increase" value="0">
   <input type="hidden" id="number_increase_new" value="0">

   <input type="hidden" id="every_word_index">
   <input type="hidden" id="every_sentence_index">
   <input type="hidden" id="every_conclusion_index">
   <input type="hidden" id="every_introduction_index">
   <input type="hidden" id="every_body_index">


   <!-- <form id="submit_student_ans_remake_info"  method="post" enctype="multipart/form-data">
      <input type="text" name="question_id" value="<?//php echo $question_id; ?>">
      <input type="text" id="title_auto_comment_ans" name="title_auto_comment_ans">
      <input type="text" id="title_auto_comment_get_point" name="title_auto_comment_get_point">
      <input type="text" id="student_spelling_ans" name="student_spelling_ans">
      <input type="text" id="student_spelling_get_point" name="student_spelling_get_point">
      <input type="text" id="student_sentence_index_ans" name="student_sentence_index_ans">
      <input type="text" id="student_sentence_get_point" name="student_sentence_get_point">
      <input type="text" id="student_ans_conclusion_index" name="student_ans_conclusion_index">
      <input type="text" id="student_ans_conclusion_get_point" name="student_ans_conclusion_get_point"> 
      <input type="text" id="student_radio_conclusion_index" name="student_radio_conclusion_index">
      <input type="text" id="student_radio_conclusion_get_point" name="student_radio_conclusion_get_point"> 
      <input type="text" id="student_ans_introduction_index" name="student_ans_introduction_index">
      <input type="text" id="student_ans_intro_get_point" name="student_ans_intro_get_point"> 
      <input type="text" id="student_intro_radio_index" name="student_intro_radio_index">
      <input type="text" id="student_intro_radio_get_point" name="student_intro_radio_get_point"> 
      <input type="text" id="student_ans_paragraph_index" name="student_ans_paragraph_index">
      <input type="text" id="student_ans_paragraph_get_point" name="student_ans_paragraph_get_point"> 
      <input type="text" id="student_ans_radio_paragraph" name="student_ans_radio_paragraph">
      <input type="text" id="student_ans_radio_paragraph_get_point" name="student_ans_radio_paragraph_get_point">
   </form> -->


   <div class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="total_limit_exceed">
      <!-- Modal -->
      <div style="max-width: 20%;" class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel"></h4>
            </div>

            <div class="modal-body">
               <i class="fa fa-pencil" style="font-size:28px;color:#f5d743;"></i>
               <p>you've already exceeded <b><?= $idea_info[0]['word_limit']; ?></b> word.Please make it <b><?= $idea_info[0]['word_limit']; ?></b> words or bellow and then resubmit.</p>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
            </div>

         </div>
      </div>
   </div>

   <div class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="low_limit">
      <!-- Modal -->
      <div style="max-width: 20%;" class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel"> </h4>
            </div>

            <div class="modal-body">
               <i class="fa fa-pencil" style="font-size:28px;color:#f5d743;"></i>
               <p>Oops! you need to have a minimum input of <b id="percent_limit"></b> words and then resubmit.</p>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
            </div>

         </div>
      </div>

   </div>

   <div class="modal fade ss_modal" id="times_up_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" style="max-width: 20%;" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h4 style="text-align:center;" class="modal-title" id="myModalLabel">Times Up</h4>
            </div>
            <div class="modal-body row">
               <i class="fa fa-close" style="font-size:20px;color:red"></i>
               <!--<span class="ss_extar_top20">Your answer is wrong</span>-->
               <br>
               <p>Oops! you've lost your paragraph for exceeding your time! You now need to re-write from the start</p>
            </div>
            <div class="modal-footer">
               <button type="button" id="question_reload" class="btn btn_blue" data-dismiss="modal">close</button>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">

               <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
               <img src="assets/images/icon_sucess.png" class="pull-left"> <span class="ss_extar_top20">Your answer is correct</span>
            </div>
            <div class="modal-footer">
               <button id='get_next_question' type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="frist_time_user">
      <!-- Modal -->
      <div style="max-width: 100%;margin-top:8%;" class="modal-dialog" role="document">
         <div class="modal-content">


            <div style="padding:10px;" class="btm_word_limt p-3">

               <form id="add_profile_form" action="" method="post" enctype="multipart/form-data">
                  <div>
                     <button type="button" class="btn btn-profile">Edit</button>
                     <button type="button" id="close_idea_modal" class="btn btn-info pull-right" data-dismiss="modal">Close</button>
                  </div>
                  <hr>
                  <div class="frist_time_user_mid_con">
                     <div class="frist_time_user_mid_con_mes">
                        <strong> Wanna be a superstar?? </strong> Each time you submit a writing task, your
                        wonderful work is automatically published as a writing suggestion
                        viewable around the world <a href="#">view more</a>
                     </div>
                     <div class="row p-3">
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label>Name</label>
                              <input type="text" id="student_name" class="form-control" value="<?= $profile[0]['student_name'] ?>" name="student_name">
                           </div>
                           <div class="form-group">
                              <label>School Name <a href="#">Optional</a></label>
                              <input type="text" id="school_name" class="form-control" value="<?= $profile[0]['school_name'] ?>" name="school_name">
                           </div>
                           <div class="form-group">
                              <label>Country</label>
                              <input type="text" id="country" class="form-control" value="<?= $profile[0]['country'] ?>" name="country">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="text-center">
                              <div class="form-group">

                                 <input style="display: none;" id="file-input" type="file" class="form-control" name="profile_image" onchange="imgPreview()">

                                 <label for="file-input"><i class="fa fa-cloud-upload" aria-hidden="true"></i></label>
                                 <p>Chose Photo to Upload</p>
                                 <p><a href="">(Optional)</a></p>
                              </div>
                              <div class="image_box"><img style="height:100px;" id="imgFrame" src="assets/uploads/profile/thumbnail/<?= $profile[0]['profile_image'] ?>" width="100px" height="200px" /></div>
                           </div>
                        </div>
                     </div>
                     <hr>
                     <div class="text-center p-3">
                        <button type="button" id="add_profile" class="btn btn_next">Submit & Proceed</button>
                     </div>
               </form>
            </div>

         </div>
      </div>
   </div>

   <style type="text/css">
      .frist_time_user_mid_con_mes strong {
         color: #ff7f27;
      }

      .frist_time_user_mid_con_mes a {
         color: #00c1f7;
         display: inline-block;
      }

      .frist_time_user_mid_con a {
         display: inline-block;
      }

      .frist_time_user_mid_con label {
         margin-bottom: 6px;
      }

      .frist_time_user_mid_con .image_box {
         border: 1px solid #00c1f7;
         height: 100px;
         width: 100px;
         margin: 10px auto;
         background: #d9d9d9;
      }

      .clik_point {
         border: 1px solid #4bb04f;
         background: #4bb04f;
         color: #fff;
         height: 60px;
         width: 60px;
         line-height: 55px;
         text-align: center;
         margin: 20px auto;
         border-radius: 50%;
         font-size: 30px;
         cursor: pointer;
      }

      .clik_point_detatis {
         display: inline-flex;
         justify-content: center;
         align-items: center;
         padding: 20px 0px;
      }

      .clik_point_detatis .clik_point {
         display: block !important;
         margin-left: 10px;
         border: 1px solid #ff0000;
         background: #ff0000;
         color: #fff;
         height: 60px;
         width: 60px;
         line-height: 55px;
         text-align: center;
         border-radius: 50%;
         font-size: 30px;
      }

      .clik_point_detatis_tutor .your_achived_point {
         max-width: 200px;
         margin: auto;
      }

      #topicstory_tutor .btm_word_limt {
         min-height: 300px;
         padding: 30px;
      }

      .your_achived_point {
         border: 1px solid #015f4e;
         padding: 15px;
         text-align: center;
         margin: 10px;
         background: #f4f5f9;
      }

      .your_achived_point button {
         padding: 7px 15px;
         color: #fff;
         background: #015f4e;
         border: 0;
         border-radius: 5px;
         margin-top: 10px;
      }

      .w-50 {
         width: 70px;
         display: inline-block;
      }

      .profile_right_ida {
         padding: 10px;
         padding-top: 20px;
         text-align: center;

      }

      .profile_right_ida .welcom_mes {
         font-size: 13px;
         line-height: 16px;
         margin: 20px 0px;
         padding: 10px;
         background: #b5e61d;
         border: 1px solid #0079bc;
      }

      .profile_right_ida u {
         color: #7f7f7f;
      }

      .profile_right_ida .btn-primary {
         margin-bottom: 5px;
         background: #fff;
         color: #333;
         padding: 6px 15px;
         border-radius: 0;
         line-height: 16px;
         border: 1px solid #c3c3c3;
      }

      .profile_right_ida .btn-primary:hover {
         background: #a349a4;
         color: #fff;
         padding: 6px 15px;
         border-radius: 0;
         line-height: 16px;
      }

      #show_question_idea_profile table {
         font-size: 13px;
      }

      .profile_right_ida_bottom {
         padding: 0 10px;
      }

      .profile_right_ida_bottom .table>thead>tr>th {
         border-bottom: 2px solid #e6eed5;
      }

      .red {
         color: #ff0000;
      }

      .blue {
         color: #00b0f0;
      }

      .gold {
         color: #e36c09;
      }

      .green {
         color: #00b050;
      }

      .orange {
         color: #953734;
      }

      .profile_right_ida_bottom .table tbody tr>td {
         text-align: center;
         padding: 4px 10px;
         color: #ed1c24;
      }

      .profile_right_ida_bottom .table tbody tr {
         background: #e6eed5;
         border-bottom: 20px solid #fff;
      }

      .profile_right_ida_bottom .table input {
         margin: 0;
      }

      .profile_right_ida_bottom .table tbody tr>td:first-child {
         text-align: left;
         color: #76923c;
         font-weight: bold;
      }

      .profile_right_ida_bottom .table input[type=checkbox]:focus {
         outline: none;
      }

      .profile_right_ida_bottom .table input[type=checkbox] {
         background-color: #fff;
         border-radius: 2px;
         appearance: none;
         -webkit-appearance: none;
         -moz-appearance: none;
         width: 14px;
         height: 14px;
         cursor: pointer;
         position: relative;
         border: 1px solid #959595;
      }

      .profile_right_ida_bottom .table input[type=checkbox]:checked {
         border: 1px solid #0699ef;
         background-color: #0699ef;
         background: #0699ef url("data:image/gif;base64,R0lGODlhCwAKAIABAP////3cnSH5BAEKAAEALAAAAAALAAoAAAIUjH+AC73WHIsw0UCjglraO20PNhYAOw==") 3px 3px no-repeat;
         background-size: 8px;
      }

      @media (min-width: 1000px) {
         #show_question_idea_profile .modal-dialog {
            width: 800px;
         }
      }

      #show_question_idea_profile {
         overflow-y: scroll;
      }

      .profile_left_ida table {
         margin-top: 10px;
      }

      .profile_left_ida table tr td {
         border: none;
         padding: 0;
         color: #7f7f7f;
         font-size: 13px;
      }

      .p-3 {
         padding: 15px;
      }

      .ss_modal .modal-content {
         border: 1px solid #a6c9e2;
         padding: 0;
         margin: 0;
      }

      .top_textprev {
         padding-bottom: 20px;
      }

      .top_textprev h4 {
         color: #7f7f7f;
         font-size: 16px;
         font-weight: bold;
      }

      .top_textprev .btn {
         background: #9c4d9e;
         border-radius: 0;
         border: none;
         color: #fff;
         padding: 8px 20px;
         margin-top: 10px;
         margin-bottom: 20px;
      }

      .top_textprev h6 {
         color: #000;
         font-size: 14px;
         font-weight: bold;
      }

      .workout_menu {
         height: initial;
      }

      .workout_menu ul {
         margin-bottom: 20px;
         display: flex;
         align-items: center;
         flex-wrap: wrap;
      }

      .workout_menu ul>div {
         margin-bottom: 10px;
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
         background: #0079bc;
         padding: 5px 10px;
         border-radius: 5px;
         color: #fff;
      }

      #login_form .modal-dialog,
      .ss_modal .modal-dialog {
         max-width: 100%;
      }

      .btm_word_limt .content_box_word {
         border-radius: 5px;
         border: 1px solid #82bae6;
         margin: 10px 0;
         padding: 10px;
         width: 100%;
         box-shadow: 0px 0px 10px #d9edf7;
         margin-top: 0 !important;
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

      .ss_modal .modal-dialog {
         position: absolute;
         margin-top: 0% !important;
         top: 50% !important;
         left: 50% !important;
         transform: translate(-50%, -50%) !important;
      }

      .ss_modal .modal-content {
         padding: 5px !important;
      }

      .ss_modal .modal-header {
         background: url(assets/images/login_bg.png) repeat-x;
         color: #fff;
         padding: 0;
         border-radius: 5px;
      }

      #show_question_idea_profile .modal-dialog {
         position: relative;
         margin-top: 2% !important;
         top: 0 !important;
         left: auto !important;
         transform: translate(0%, 0%) !important;
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

      .mclose {
         position: absolute;
         right: 10px;
         top: 10px;
         font-size: 20px;
         z-index: 10;
         cursor: pointer;
      }

      .created_name img {
         max-width: 30px;
         margin-right: 10px;
      }

      .created_name a {
         color: #fff;
      }
   </style>

   <script type="text/javascript">
      $(".ans_submit").on("click", function() {
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
         }

         $('#title_auto_comment_ans').val(std_val);
         // console.log(std_val);
         $(".ans_submit_first_box").attr("style", "display:none");
         $(".ans_submit_second_box").attr("style", "display:block");

         $(".student_radio_ans").each(function() {
            std_check_val = $(this).val();
            if (std_val == std_check_val) {
               $(this).attr("checked", true);

            } 
         });

         var student_id = $('#student_view_idea_student_id').val();
         var module_id = $('#student_view_idea_module_id').val();
         var question_id = $('#student_view_idea_question_id').val();

         $.ajax({
            url: "Student/comment_story_title",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {student_id:student_id,module_id:module_id,question_id:question_id},
            cache: false,
            dataType: 'json',
            success: function(data) {
                  //console.log(data.story_title_mark);
                  $('.teacher_radio_ans'+data.story_title_comment).attr('checked','checked');
                  $('.your_point_show').show();
                  
                  if(std_val == data.story_title_comment){
                     $('#title_auto_comment_get_point').val(data.story_title_mark);
                     $('.total_point_count').html(data.story_title_mark);
                     $('#story_checkbox_mark').val(data.story_title_mark);
                  }
                  else
                  {
                     $('.total_point_count').html(0);
                     $('#story_checkbox_mark').val(0);    
                  }
            }
         });

         

      });

      $(".ans_submit_next").on("click", function() {
         //alert("hello");
         $('.your_point_show').hide();
         $('.rainy_day_hide').hide();
         $('.tutor_idea_text').show();
         $('.common_answer_paragraph').hide();
         $('.choose_word').attr("style", "display:block");
         $('.ans_submit_miss_spelled').css({
            "display": "block",
            "min-height": "150px"
         });
         $(".ans_submit_first_box").attr("style", "display:none");
         $(".ans_submit_second_box").attr("style", "display:none");
      });


      function imgPreview() {
         imgFrame.src = URL.createObjectURL(event.target.files[0]);
      }
      $('#answer_matching').hide();

      $(function() {
         var ideaInfo = "<?= $idea_info[0]['student_title'] ?>";
         var start_button_status = "<?= $idea_info[0]['add_start_button'] ?>";
         if (ideaInfo == 0) {
            if (start_button_status == 1) {
               $('#answer_matching').hide();
               $('#idea_start').show();

            } else {
               $('#answer_matching').show();
               $('#idea_start').hide();
               $('.idea_start_action').hide();
            }

            <?php if ($question_time_in_second != 0) { ?>
               takeDecesionForQuestion();
            <?php } ?>
         }
      });

      $("#idea_start").on("click", function() {

         <?php if ($question_time_in_second != 0) { ?>

            takeDecesionForQuestion();
         <?php } ?>

         <?php if ($profile[0]['user_id'] == '') { ?>
            $('#frist_time_user').modal('show');
         <?php } ?>


         var idea_no = $("#idea_no").val();
         var idea_title = $("#idea_title").val();
         //  if(idea_no!=''){

         $('#idea_start').hide();
         $('#answer_matching').show();
         $('.idea_start_action').hide();

         var ideaInfo = "<?= $idea_info[0]['student_title'] ?>";
         // alert(ideaInfo);

         if (ideaInfo != 0) {
            var idea_title = "Title";
            text = '<p style="text-align:center;text-decoration:underline;"><b>Idea/Topic/Story title</b></p><p style="text-align:center;color:#fb8836f0;"><b>"' + idea_title + '"</b>&#9999;&#65039;</p><p></p>';
         } else {
            text = '';
         }

         // CKEDITOR.instances.word_count.on('paste', function(evt) {
         //    evt.cancel();
         // });
         CKEDITOR.instances.word_count.setData(text);

         <?php if ($idea_info[0]['student_title'] == 1) { ?>
            $modal2 = $('#idea_title_show');
            $modal2.modal('show');
         <?php } ?>

      });

      $(".ideabtnclose").on("click", function() {

         var idea_title = $(".idea_title_text").val();
         $('#student_idea_title').val(idea_title);
         if (idea_title == '') {
            $("#show_empty_idea").css("display", "block");
         } else {
            $modal2 = $('#idea_title_show');
            $modal2.modal('hide');
            text = '<p style="text-align:center;text-decoration:underline;"><b>Idea/Topic/Story title</b></p><p style="text-align:center;color:#fb8836f0;"><b style="font-size:18px;">"' + idea_title + '"</b>&nbsp;&#9999;&#65039;</p><br><p>Start write here...</p>';

            CKEDITOR.instances.word_count.setData(text);
         }
      });

      $("#close_empty_idea").on("click", function() {
         $("#show_empty_idea").css("display", "none");
      });

      CKEDITOR.on('instanceReady', function(evt) {
         // console.log(evt.editor.getData());
         evt.editor.on('focus', function(event) {
            var getData = evt.editor.getData();
            var setData = getData.replace("<p>Start write here...</p>", " ");
            evt.editor.setData(setData);
         });
      });

      $("table").delegate("td", "click", function() {
         $(this).toggleClass("chosen");
      });

      $("#topicstory").on("click", function() {
         $modal = $('#show_question_idea');
         $modal.modal('hide');
         $modal2 = $('#show_question_idea_profile');
         $modal2.modal('show');

         var checker_id = "<?= $user_id; ?>";
         var submited_student_id = $("#submited_ans_view_student_id").val();
         var question_id = $("#question_id").val();
         var idea_id = $("#idea_id").val();
         var idea_no = $("#submited_ans_idea_no").val();

         $.ajax({
            url: "Student/check_student_grade",
            method: "POST",
            data: {
               question_id: question_id,
               checker_id: checker_id,
               submited_student_id: submited_student_id
            },
            dataType: 'json',
            success: function(data) {
               if (data != 2) {

                  var relchk1 = '';
                  var relval1 = '';
                  var relchk2 = '';
                  var relval2 = '';
                  var relchk3 = '';
                  var relval3 = '';
                  var relchk4 = '';
                  var relval4 = '';
                  var relchk5 = '';
                  var relval5 = '';

                  var creativechk1 = '';
                  var creativeval1 = '';
                  var creativechk2 = '';
                  var creativeval2 = '';
                  var creativechk3 = '';
                  var creativeval3 = '';
                  var creativechk4 = '';
                  var creativeval4 = '';
                  var creativechk5 = '';
                  var creativeval5 = '';

                  var grammerchk1 = '';
                  var grammerval1 = '';
                  var grammerchk2 = '';
                  var grammerval2 = '';
                  var grammerchk3 = '';
                  var grammerval3 = '';
                  var grammerchk4 = '';
                  var grammerval4 = '';
                  var grammerchk5 = '';
                  var grammerval5 = '';

                  var vocabularychk1 = '';
                  var vocabularyval1 = '';
                  var vocabularychk2 = '';
                  var vocabularyval2 = '';
                  var vocabularychk3 = '';
                  var vocabularyval3 = '';
                  var vocabularychk4 = '';
                  var vocabularyval4 = '';
                  var vocabularychk5 = '';
                  var vocabularyval5 = '';

                  var claritychk1 = '';
                  var clarityval1 = '';
                  var claritychk2 = '';
                  var clarityval2 = '';
                  var claritychk3 = '';
                  var clarityval3 = '';
                  var claritychk4 = '';
                  var clarityval4 = '';
                  var claritychk5 = '';
                  var clarityval5 = '';

                  var relevance = '';
                  var creativity = '';
                  var grammar = '';
                  var vocabulary = '';
                  var clarity = '';

                  var reports = JSON.parse(data.checked_checkbox);

                  var i = '';
                  for (i = 0; i < reports.length; i++) {
                     var checked = 'checked';
                     var report = reports[i].split(',');
                     //console.log(report);

                     if (report[1] == 'relevance') {

                        if (report[2] == 1) {
                           var relchk1 = 'checked';
                           var relval1 = 1;
                        }
                        if (report[2] == 2) {
                           var relchk2 = 'checked';
                           var relval2 = 2;
                        }
                        if (report[2] == 3) {
                           var relchk3 = 'checked';
                           var relval3 = 3;
                        }
                        if (report[2] == 4) {
                           var relchk4 = 'checked';
                           var relval4 = 4;
                        }
                        if (report[2] == 5) {
                           var relchk5 = 'checked';
                           var relval5 = 5;
                        }

                     }

                     if (report[1] == 'creativity') {

                        if (report[2] == 1) {
                           var creativechk1 = 'checked';
                           var creativeval1 = 1;
                        }
                        if (report[2] == 2) {
                           var creativechk2 = 'checked';
                           var creativeval2 = 2;
                        }
                        if (report[2] == 3) {
                           var creativechk3 = 'checked';
                           var creativeval3 = 3;
                        }
                        if (report[2] == 4) {
                           var creativechk4 = 'checked';
                           var creativeval4 = 4;
                        }
                        if (report[2] == 5) {
                           var creativechk5 = 'checked';
                           var creativeval5 = 5;
                        }
                     }

                     if (report[1] == 'grammar') {

                        if (report[2] == 1) {
                           var grammerchk1 = 'checked';
                           var grammerval1 = 1;

                        }
                        if (report[2] == 2) {
                           var grammerchk2 = 'checked';
                           var grammerval2 = 2;
                        }
                        if (report[2] == 3) {
                           var grammerchk3 = 'checked';
                           var grammerval3 = 3;
                        }
                        if (report[2] == 4) {
                           var grammerchk4 = 'checked';
                           var grammerval4 = 4;
                        }
                        if (report[2] == 5) {
                           var grammerchk5 = 'checked';
                           var grammerval5 = 5;
                        }
                     }

                     if (report[1] == 'vocabulary') {

                        if (report[2] == 1) {
                           var vocabularychk1 = 'checked';
                           var vocabularyval1 = 1;
                        }
                        if (report[2] == 2) {
                           var vocabularychk2 = 'checked';
                           var vocabularyval2 = 2;
                        }
                        if (report[2] == 3) {
                           var vocabularychk3 = 'checked';
                           var vocabularyval3 = 3;
                        }
                        if (report[2] == 4) {
                           var vocabularychk4 = 'checked';
                           var vocabularyval4 = 4;
                        }
                        if (report[2] == 5) {
                           var vocabularychk5 = 'checked';
                           var vocabularyval5 = 5;
                        }
                     }

                     if (report[1] == 'clarity') {

                        if (report[2] == 1) {
                           var claritychk1 = 'checked';
                           var clarityval1 = 1;
                        }
                        if (report[2] == 2) {
                           var claritychk2 = 'checked';
                           var clarityval2 = 2;
                        }
                        if (report[2] == 3) {
                           var claritychk3 = 'checked';
                           var clarityval3 = 3;
                        }
                        if (report[2] == 4) {
                           var claritychk4 = 'checked';
                           var clarityval4 = 4;
                        }
                        if (report[2] == 5) {
                           var claritychk5 = 'checked';
                           var clarityval5 = 5;
                        }

                     }
                  }

                  var final_report = '<table class="table"><thead><tr><th></th><th class="red">Poor</th><th class="blue">Average</th><th class="gold">Good</th><th class="green">Very Good</th><th class="orange">Excellent!</th></tr></thead><tbody><tr><td>Relevance</td><td><input type="checkbox" value="1" class="report_box relevance" id="Rel_poor" name="Rel_poor"' + relchk1 + '><span id="Rel_poor_span">' + relval1 + '</span></td><td><input type="checkbox" value="2" class="report_box relevance" id="Rel_average" name="Rel_average"' + relchk2 + '><span id="Rel_average_span">' + relval2 + '</span></td><td><input type="checkbox" value="3" class="report_box relevance" id="Rel_good" name="Rel_good"' + relchk3 + '><span id="Rel_good_span">' + relval3 + '</span></td><td><input type="checkbox" value="4" class="report_box relevance" id="Rel_very_good" name="Rel_very_good"' + relchk4 + '><span id="Rel_very_good_span">' + relval4 + '</span></td><td><input type="checkbox" value="5" class="report_box relevance" id="Rel_excellent" name="Rel_excellent"' + relchk5 + '><span id="Rel_excellent_span">' + relval5 + '</span></td></tr><tr><td>Creativity</td><td><input type="checkbox" value="1" class="report_box creativity" id="cre_poor" name="cre_poor"' + creativechk1 + '><span id="cre_poor_span">' + creativeval1 + '</span></td><td><input type="checkbox" value="2" class="report_box creativity" id="cre_average" name="cre_average"' + creativechk2 + '><span id="cre_average_span">' + creativeval2 + '</span></td><td><input type="checkbox" value="3" class="report_box creativity" id="cre_good" name="cre_good"' + creativechk3 + '><span id="cre_good_span">' + creativeval3 + '</span></td><td><input type="checkbox" value="4" class="report_box creativity" id="cre_very_good" name="cre_very_good"' + creativechk4 + '><span id="cre_very_good_span">' + creativeval4 + '</span></td><td><input type="checkbox" value="5" class="report_box creativity" id="cre_excellent" name="cre_excellent"' + creativechk5 + '><span id="cre_excellent_span">' + creativeval5 + '</span></td></tr><tr><td>Grammar/Spelling</td><td><input type="checkbox" value="1" class="report_box grammar" id="grammar_poor" name="grammar_poor"' + grammerchk1 + '><span id="grammar_poor_span">' + grammerval1 + '</span></td><td><input type="checkbox" value="2" class="report_box grammar" id="grammar_average" name="grammar_average"' + grammerchk2 + '><span id="grammar_average_span">' + grammerval2 + '</span></td><td><input type="checkbox" value="3" class="report_box grammar" id="grammar_good" name="grammar_good"' + grammerchk3 + '><span id="grammar_good_span">' + grammerval3 + '</span></td><td><input type="checkbox" value="4" class="report_box grammar" id="grammar_very_good" name="grammar_very_good" ' + grammerchk4 + '><span id="grammar_very_good_span">' + grammerval4 + '</span></td><td><input type="checkbox" value="5" class="report_box grammar" id="grammar_excellent" name="grammar_excellent" ' + grammerchk5 + '><span id="grammar_excellent_span">' + grammerval5 + '</span></td></tr><tr><td>Vocabulary</td><td><input type="checkbox" value="1" class="report_box vocabulary" id="vocabulary_poor" name="vocabulary_poor"' + vocabularychk1 + '><span id="vocabulary_poor_span">' + vocabularyval1 + '</span></td><td><input type="checkbox" value="2" class="report_box vocabulary" id="vocabulary_average" name="vocabulary_average" ' + vocabularychk2 + '><span id="vocabulary_average_span">' + vocabularyval2 + '</span></td><td><input type="checkbox" value="3" class="report_box vocabulary" id="vocabulary_good" name="vocabulary_good" ' + vocabularychk3 + '><span id="vocabulary_good_span">' + vocabularyval3 + '</span></td><td><input type="checkbox" value="4" class="report_box vocabulary" id="vocabulary_very_good" name="vocabulary_very_good" ' + vocabularychk4 + '><span id="vocabulary_very_good_span">' + vocabularyval4 + '</span></td><td><input type="checkbox" value="5" class="report_box vocabulary" id="vocabulary_excellent" name="vocabulary_excellent"' + vocabularychk5 + '><span id="vocabulary_excellent_span">' + vocabularyval5 + '</span></td></tr><tr><td>Clarity</td><td><input type="checkbox" value="1" class="report_box clarity" id="clarity_poor" name="clarity_poor" ' + claritychk1 + '><span id="clarity_poor_span">' + clarityval1 + '</span></td><td><input type="checkbox" value="2" class="report_box clarity" id="clarity_average" name="clarity_average"' + claritychk2 + '><span id="clarity_average_span">' + clarityval2 + '</span></td><td><input type="checkbox" value="3" class="report_box clarity" id="clarity_good" name="clarity_good"' + claritychk3 + '><span id="clarity_good_span">' + clarityval3 + '</span></td><td><input type="checkbox" value="4" class="report_box clarity" id="clarity_very_good" name="clarity_very_good" ' + claritychk4 + '><span id="clarity_very_good_span">' + clarityval4 + '</span></td><td><input type="checkbox" value="5" class="report_box clarity" id="clarity_excellent" name="clarity_excellent" ' + claritychk5 + '><span id="clarity_excellent_span">' + clarityval5 + '</span></td></tr></tbody></table>';

                  $(".profile_right_ida_bottom").html(final_report);
                  $("#my_grade").val(data.total_point);
                  $(".your_achived_point").css("display", "block");
                  $('#grade_get_point').text(data.total_point);

               } else {
                  alert('You have not submit Grade Yet.');
               }

            }
         });

      });
      $("#view_my_grade").on("click", function() {
         var checker_id = "<?= $user_id; ?>";
         var submited_student_id = $("#submited_ans_view_student_id").val();
         var question_id = $("#question_id").val();
         var idea_id = $("#idea_id").val();
         var idea_no = $("#submited_ans_idea_no").val();

         $.ajax({
            url: "Student/check_student_grade",
            method: "POST",
            data: {
               question_id: question_id,
               checker_id: checker_id,
               submited_student_id: submited_student_id
            },
            dataType: 'json',
            success: function(data) {
               if (data != 2) {

                  var relchk1 = '';
                  var relval1 = '';
                  var relchk2 = '';
                  var relval2 = '';
                  var relchk3 = '';
                  var relval3 = '';
                  var relchk4 = '';
                  var relval4 = '';
                  var relchk5 = '';
                  var relval5 = '';

                  var creativechk1 = '';
                  var creativeval1 = '';
                  var creativechk2 = '';
                  var creativeval2 = '';
                  var creativechk3 = '';
                  var creativeval3 = '';
                  var creativechk4 = '';
                  var creativeval4 = '';
                  var creativechk5 = '';
                  var creativeval5 = '';

                  var grammerchk1 = '';
                  var grammerval1 = '';
                  var grammerchk2 = '';
                  var grammerval2 = '';
                  var grammerchk3 = '';
                  var grammerval3 = '';
                  var grammerchk4 = '';
                  var grammerval4 = '';
                  var grammerchk5 = '';
                  var grammerval5 = '';

                  var vocabularychk1 = '';
                  var vocabularyval1 = '';
                  var vocabularychk2 = '';
                  var vocabularyval2 = '';
                  var vocabularychk3 = '';
                  var vocabularyval3 = '';
                  var vocabularychk4 = '';
                  var vocabularyval4 = '';
                  var vocabularychk5 = '';
                  var vocabularyval5 = '';

                  var claritychk1 = '';
                  var clarityval1 = '';
                  var claritychk2 = '';
                  var clarityval2 = '';
                  var claritychk3 = '';
                  var clarityval3 = '';
                  var claritychk4 = '';
                  var clarityval4 = '';
                  var claritychk5 = '';
                  var clarityval5 = '';

                  var relevance = '';
                  var creativity = '';
                  var grammar = '';
                  var vocabulary = '';
                  var clarity = '';

                  var reports = JSON.parse(data.checked_checkbox);

                  var i = '';
                  for (i = 0; i < reports.length; i++) {
                     var checked = 'checked';
                     var report = reports[i].split(',');
                     //console.log(report);

                     if (report[1] == 'relevance') {

                        if (report[2] == 1) {
                           var relchk1 = 'checked';
                           var relval1 = 1;
                        }
                        if (report[2] == 2) {
                           var relchk2 = 'checked';
                           var relval2 = 2;
                        }
                        if (report[2] == 3) {
                           var relchk3 = 'checked';
                           var relval3 = 3;
                        }
                        if (report[2] == 4) {
                           var relchk4 = 'checked';
                           var relval4 = 4;
                        }
                        if (report[2] == 5) {
                           var relchk5 = 'checked';
                           var relval5 = 5;
                        }

                     }

                     if (report[1] == 'creativity') {

                        if (report[2] == 1) {
                           var creativechk1 = 'checked';
                           var creativeval1 = 1;
                        }
                        if (report[2] == 2) {
                           var creativechk2 = 'checked';
                           var creativeval2 = 2;
                        }
                        if (report[2] == 3) {
                           var creativechk3 = 'checked';
                           var creativeval3 = 3;
                        }
                        if (report[2] == 4) {
                           var creativechk4 = 'checked';
                           var creativeval4 = 4;
                        }
                        if (report[2] == 5) {
                           var creativechk5 = 'checked';
                           var creativeval5 = 5;
                        }
                     }

                     if (report[1] == 'grammar') {

                        if (report[2] == 1) {
                           var grammerchk1 = 'checked';
                           var grammerval1 = 1;

                        }
                        if (report[2] == 2) {
                           var grammerchk2 = 'checked';
                           var grammerval2 = 2;
                        }
                        if (report[2] == 3) {
                           var grammerchk3 = 'checked';
                           var grammerval3 = 3;
                        }
                        if (report[2] == 4) {
                           var grammerchk4 = 'checked';
                           var grammerval4 = 4;
                        }
                        if (report[2] == 5) {
                           var grammerchk5 = 'checked';
                           var grammerval5 = 5;
                        }
                     }

                     if (report[1] == 'vocabulary') {

                        if (report[2] == 1) {
                           var vocabularychk1 = 'checked';
                           var vocabularyval1 = 1;
                        }
                        if (report[2] == 2) {
                           var vocabularychk2 = 'checked';
                           var vocabularyval2 = 2;
                        }
                        if (report[2] == 3) {
                           var vocabularychk3 = 'checked';
                           var vocabularyval3 = 3;
                        }
                        if (report[2] == 4) {
                           var vocabularychk4 = 'checked';
                           var vocabularyval4 = 4;
                        }
                        if (report[2] == 5) {
                           var vocabularychk5 = 'checked';
                           var vocabularyval5 = 5;
                        }
                     }

                     if (report[1] == 'clarity') {

                        if (report[2] == 1) {
                           var claritychk1 = 'checked';
                           var clarityval1 = 1;
                        }
                        if (report[2] == 2) {
                           var claritychk2 = 'checked';
                           var clarityval2 = 2;
                        }
                        if (report[2] == 3) {
                           var claritychk3 = 'checked';
                           var clarityval3 = 3;
                        }
                        if (report[2] == 4) {
                           var claritychk4 = 'checked';
                           var clarityval4 = 4;
                        }
                        if (report[2] == 5) {
                           var claritychk5 = 'checked';
                           var clarityval5 = 5;
                        }

                     }
                  }

                  var final_report = '<table class="table"><thead><tr><th></th><th class="red">Poor</th><th class="blue">Average</th><th class="gold">Good</th><th class="green">Very Good</th><th class="orange">Excellent!</th></tr></thead><tbody><tr><td>Relevance</td><td><input type="checkbox" value="1" class="report_box relevance" id="Rel_poor" name="Rel_poor"' + relchk1 + '><span id="Rel_poor_span">' + relval1 + '</span></td><td><input type="checkbox" value="2" class="report_box relevance" id="Rel_average" name="Rel_average"' + relchk2 + '><span id="Rel_average_span">' + relval2 + '</span></td><td><input type="checkbox" value="3" class="report_box relevance" id="Rel_good" name="Rel_good"' + relchk3 + '><span id="Rel_good_span">' + relval3 + '</span></td><td><input type="checkbox" value="4" class="report_box relevance" id="Rel_very_good" name="Rel_very_good"' + relchk4 + '><span id="Rel_very_good_span">' + relval4 + '</span></td><td><input type="checkbox" value="5" class="report_box relevance" id="Rel_excellent" name="Rel_excellent"' + relchk5 + '><span id="Rel_excellent_span">' + relval5 + '</span></td></tr><tr><td>Creativity</td><td><input type="checkbox" value="1" class="report_box creativity" id="cre_poor" name="cre_poor"' + creativechk1 + '><span id="cre_poor_span">' + creativeval1 + '</span></td><td><input type="checkbox" value="2" class="report_box creativity" id="cre_average" name="cre_average"' + creativechk2 + '><span id="cre_average_span">' + creativeval2 + '</span></td><td><input type="checkbox" value="3" class="report_box creativity" id="cre_good" name="cre_good"' + creativechk3 + '><span id="cre_good_span">' + creativeval3 + '</span></td><td><input type="checkbox" value="4" class="report_box creativity" id="cre_very_good" name="cre_very_good"' + creativechk4 + '><span id="cre_very_good_span">' + creativeval4 + '</span></td><td><input type="checkbox" value="5" class="report_box creativity" id="cre_excellent" name="cre_excellent"' + creativechk5 + '><span id="cre_excellent_span">' + creativeval5 + '</span></td></tr><tr><td>Grammar/Spelling</td><td><input type="checkbox" value="1" class="report_box grammar" id="grammar_poor" name="grammar_poor"' + grammerchk1 + '><span id="grammar_poor_span">' + grammerval1 + '</span></td><td><input type="checkbox" value="2" class="report_box grammar" id="grammar_average" name="grammar_average"' + grammerchk2 + '><span id="grammar_average_span">' + grammerval2 + '</span></td><td><input type="checkbox" value="3" class="report_box grammar" id="grammar_good" name="grammar_good"' + grammerchk3 + '><span id="grammar_good_span">' + grammerval3 + '</span></td><td><input type="checkbox" value="4" class="report_box grammar" id="grammar_very_good" name="grammar_very_good" ' + grammerchk4 + '><span id="grammar_very_good_span">' + grammerval4 + '</span></td><td><input type="checkbox" value="5" class="report_box grammar" id="grammar_excellent" name="grammar_excellent" ' + grammerchk5 + '><span id="grammar_excellent_span">' + grammerval5 + '</span></td></tr><tr><td>Vocabulary</td><td><input type="checkbox" value="1" class="report_box vocabulary" id="vocabulary_poor" name="vocabulary_poor"' + vocabularychk1 + '><span id="vocabulary_poor_span">' + vocabularyval1 + '</span></td><td><input type="checkbox" value="2" class="report_box vocabulary" id="vocabulary_average" name="vocabulary_average" ' + vocabularychk2 + '><span id="vocabulary_average_span">' + vocabularyval2 + '</span></td><td><input type="checkbox" value="3" class="report_box vocabulary" id="vocabulary_good" name="vocabulary_good" ' + vocabularychk3 + '><span id="vocabulary_good_span">' + vocabularyval3 + '</span></td><td><input type="checkbox" value="4" class="report_box vocabulary" id="vocabulary_very_good" name="vocabulary_very_good" ' + vocabularychk4 + '><span id="vocabulary_very_good_span">' + vocabularyval4 + '</span></td><td><input type="checkbox" value="5" class="report_box vocabulary" id="vocabulary_excellent" name="vocabulary_excellent"' + vocabularychk5 + '><span id="vocabulary_excellent_span">' + vocabularyval5 + '</span></td></tr><tr><td>Clarity</td><td><input type="checkbox" value="1" class="report_box clarity" id="clarity_poor" name="clarity_poor" ' + claritychk1 + '><span id="clarity_poor_span">' + clarityval1 + '</span></td><td><input type="checkbox" value="2" class="report_box clarity" id="clarity_average" name="clarity_average"' + claritychk2 + '><span id="clarity_average_span">' + clarityval2 + '</span></td><td><input type="checkbox" value="3" class="report_box clarity" id="clarity_good" name="clarity_good"' + claritychk3 + '><span id="clarity_good_span">' + clarityval3 + '</span></td><td><input type="checkbox" value="4" class="report_box clarity" id="clarity_very_good" name="clarity_very_good" ' + claritychk4 + '><span id="clarity_very_good_span">' + clarityval4 + '</span></td><td><input type="checkbox" value="5" class="report_box clarity" id="clarity_excellent" name="clarity_excellent" ' + claritychk5 + '><span id="clarity_excellent_span">' + clarityval5 + '</span></td></tr></tbody></table>';

                  $(".profile_right_ida_bottom").html(final_report);
                  $("#my_grade").val(data.total_point);
                  $(".your_achived_point").css("display", "block");
                  $('#grade_get_point').text(data.total_point);


               } else {
                  alert('You have not submit Grade Yet.');
               }

            }
         });
      });
      $('.clik_point_detatis_tutor').hide();
      $(".clik_point").on("click", function() {

         var question_id = $("#question_id").val();
         var module_id = $("#module_id").val();
         var idea_id = $("#idea_id").val();
         var idea_no = $("#tutor_idea_no").val();
         var tutor_id = $("#get_tutor_id").val();
         // alert(question_id);  
         // alert(module_id);  
         // alert(idea_id);  
         // alert(idea_no);  alert(tutor_id);  
         $.ajax({
            url: "Student/add_tutor_like",
            method: "POST",
            data: {
               question_id: question_id,
               module_id: module_id,
               idea_id: idea_id,
               idea_no: idea_no,
               tutor_id: tutor_id
            },
            dataType: 'json',
            success: function(data) {
               console.log(data);

               var total_point = data.student_point['student_point'];


               if (data.insert_or_update == 1) {
                  alert('like added');
               } else {
                  alert('allready like added');
               }
               $(".clik_point").text(data.total_like);
               $('.clik_point_detatis_tutor').show();
               $('.clik_point').hide();
               $('#like_get_point').text(total_point);
            }

         })

      });

      $("#show_questions").on("click", function() {
         $modal = $('#show_question_idea');
         $modal.modal('hide');
         $modal2 = $('#show_question_body');
         $modal2.modal('show');
      });

      $(".idea_title_modal").on("click", function() {


         var idea_no = $(this).attr("data-value");
         var idea_title = $(this).attr("data-index");

         $("#idea_no").val(idea_no);
         $("#idea_title").val(idea_title);

         var html = '<textarea  class="form-control idea_title_text mytextarea" name="idea_title_text' + idea_id + '"></textarea>';
         $(".idea_modal_textarea").html(html);
         $(".idea_title_modal").css('background', 'none');
         $(this).css('background', '#fb8836f0');

         <?php if ($idea_info[0]['student_title'] == 1) { ?>
            $modal2 = $('#idea_title_show');
            $modal2.modal('show');
         <?php } ?>
      });


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

            $('#display_count').html(finalCount);

            $('#total_word').val(finalCount);


            am_cal(finalCount);

         });

         $('#answer_matching').click(function() {

            var total_word = $('#total_word').val();
            var limit_word = <?= $idea_info[0]['word_limit']; ?>;
            var percentage_value = (limit_word / 100) * 80;
            $('#percent_limit').text(percentage_value);

            if (limit_word != 0) {
               if (total_word > limit_word) {

                  $('#total_limit_exceed').modal('show');

               } else if (total_word < percentage_value) {
                  $('#low_limit').modal('show');

               } else {

                  var student_ans = CKEDITOR.instances['word_count'].getData();
                  // alert(student_ans);

                  var forms = $('#creative_ans_save')[0];
                  var data = new FormData(forms);
                  data.append("student_ans", student_ans);

                  $.ajax({
                     url: "st_creative_ans_save",
                     method: "POST",
                     enctype: 'multipart/form-data',
                     data: data, 
                     processData: false,
                     contentType: false,
                     cache: false,
                     dataType: 'json',
                     success: function(data) {
                        if (data == 9) {
                           $('#idea_save_faild').modal('show');
                           $('#get_next_question').click(function() {
                              commonCall();
                           });
                        } else {
                           $('#idea_save_success').modal('show');

                           $('#get_next_question2').click(function() {

                              commonCall();
                           });
                        } 
                     }
                  });

               }
            } else {
               var student_ans = CKEDITOR.instances['word_count'].getData();
               // alert(student_ans);

               var forms = $('#creative_ans_save')[0];
               var data = new FormData(forms);
               data.append("student_ans", student_ans);

               $.ajax({
                  url: "st_creative_ans_save",
                  method: "POST",
                  enctype: 'multipart/form-data',
                  data: data,
                  processData: false,
                  contentType: false,
                  cache: false,
                  dataType: 'json',
                  success: function(data) {
                     if (data == 9) {
                        $('#idea_save_faild').modal('show');
                        $('#get_next_question').click(function() {
                           commonCall();
                        });
                     } else {
                        $('#idea_save_success').modal('show');

                        $('#get_next_question2').click(function() {

                           commonCall();
                        });

                     }

                  }
               });
            }

         });
         $("#add_profile").on("click", function() {
            var forms = $('#add_profile_form')[0];
            var data = new FormData(forms);
            $.ajax({
               url: "add_profile_info",
               method: "POST",
               enctype: 'multipart/form-data',
               data: data,
               processData: false,
               contentType: false,
               cache: false,
               dataType: 'json',
               success: function(data) {
                  if (data) {
                     alert("Profile updated");
                  }

               }
            });
         });

      });

      function commonCall() {
         var question_order = $('#next_question').val();

         var module_id = $('#module_id').val();

         <?php if ($tutorial_ans_info) { ?>
            window.location.href = 'show_tutorial_result/' + module_id;
         <?php } ?>

         if (question_order == 0) {
            window.location.href = 'show_tutorial_result/' + module_id;
         }

         if (question_order != 0) {
            window.location.href = 'get_tutor_tutorial_module/' + module_id + '/' + question_order;
         }
      }
   </script>

   <script>
      var success_flag = 1;
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
            h1.textContent = v_hours + " : " + v_minutes + " : " + v_seconds + "  ";
         } else {
            var idea_answer = CKEDITOR.instances['word_count'].getData();
            var question_id = $('#question_id').val();
            var idea_id = $('#idea_id').val();


            h1.textContent = "EXPIRED";
         }
      }

      function takeDecesionForQuestion() {


         var exact_time = $('#exact_time').val();

         var now = $('#now').val();
         var opt = $('#optionalTime').val();
         //  alert(opt);

         var countDownDate = parseInt(now) + parseInt($('#optionalTime').val());

         var distance = countDownDate - now;
         var hours = Math.floor(distance / 3600);
         //        alert(distance)
         var x = distance % 3600;

         var minutes = Math.floor(x / 60);

         var seconds = distance % 60;

         var t_h = hours * 60 * 60;
         var t_m = minutes * 60;
         var t_s = seconds;

         var total = parseInt(t_h) + parseInt(t_m) + parseInt(t_s);


         var end_depend_optional = parseInt(exact_time) + parseInt(opt);

         if (opt > total) {
            remaining_time = total;
         } else {
            remaining_time = parseInt(end_depend_optional) - parseInt(now);
         }

         clear_interval = setInterval(circulate1, 1000);

      }

      $("#student_ideas").click(function() {
         $(this).css("color", "#fb8836f0");
         $("#tutor_ideas").css("color", "");
         $(".all_ideas").css('display', 'none');
         $(".tutor_ans").css('display', 'none');
         $(".student_ans").css('display', 'block');
      });
      $("#tutor_ideas").click(function() {
         $(this).css("color", "#fb8836f0");
         $("#student_ideas").css("color", "");
         $(".all_ideas").css('display', 'none');
         $(".student_ans").css('display', 'none');
         $(".tutor_ans").css('display', 'block');
      });
      $("#tutor_ideas").css("color", "#fb8836f0");


      $("#submit_button").click(function() {

         let checked_checkbox = [];
         $(".report_box:checked").each(function() {
            var all_class = $(this).attr('class').split(' ');
            var className = all_class[1];
            var point = $(this).val();
            var name = $(this).attr('name');
            var check_data = name + ',' + className + ',' + point;
            checked_checkbox.push(check_data);

         });


         var checker_id = "<?= $user_id; ?>";
         var submited_student_id = $("#submited_ans_view_student_id").val();
         var question_id = $("#question_id").val();
         var module_id = $("#module_id").val();
         var idea_id = $("#idea_id").val();
         var idea_no = $("#submited_ans_idea_no").val();
         var total_point = $("#my_grade").val();

         $.ajax({
            url: "submit_student_grade",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {
               checker_id: checker_id,
               submited_student_id: submited_student_id,
               question_id: question_id,
               module_id: module_id,
               idea_id: idea_id,
               idea_no: idea_no,
               checked_checkbox: checked_checkbox,
               total_point: total_point
            },
            cache: false,
            dataType: 'json',
            success: function(data) {
               if (data.status == 1) {
                  alert("Data saved");
               } else if (data.status == 2) {
                  alert("Data Updated");
               }

               var total_point = data.student_point['student_point'];

               $(".your_achived_point").css("display", "block");
               $(".tutor_check_button").removeAttr('disabled');
               $("#tutor_grade_show").css("display", "none");
               $("#tutor_grade").css("display", "block");
               $('#grade_get_point').text(total_point);
            }
         });

      });

      $(".report_box").change(function() {
         var all_class = $(this).attr('class').split(' ');
         var className = all_class[1];

         $(this).removeAttr('checked');
         $('.' + className).each(function() {
            if ($(this).is(':checked')) {
               // var name = $( this ).attr('name'); 
               // alert(name);
               var pre_point = $(this).val();
               var total_point = $("#my_grade").val();
               var total = parseInt(total_point) - parseInt(pre_point);
               $("#my_grade").val(total);
            }
         });


         $('.' + className).removeAttr('checked');

         $(this).attr('checked', true);
         var point = $(this).val();
         $('.span_' + className).remove();
         $(this).after("<span class='span_" + className + "'>" + point + "<span>");

         var total_point = $("#my_grade").val();
         var total = parseInt(total_point) + parseInt(point);

         $("#my_grade").val(total);

      });

      $(".view_student_idea").click(function() {
         var student_id = $(this).attr("data-index");
         var idea_id = $(this).attr("data-idea");
         var question_id = $(this).attr("data-question");
      
         $('#student_view_idea_idea_id').val(idea_id);
         $('#student_view_idea_student_id').val(student_id);
         $('#student_view_idea_question_id').val(question_id);

         $.ajax({
            url: "submited_student_idea",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {
               student_id: student_id,
               idea_id: idea_id,
               question_id: question_id
            },
            cache: false,
            dataType: 'json',
            success: function(data) {

               // console.log(data);

               var idea_info = data.get_idea[0];
               console.log(idea_info);
               var profile_info = data.profile_info[0];
               //var idea_information = data.idea_information[0];
               //var teacher_correction = data.teacher_correction[0];
               var country = data.country[0];

               var tutor_ans = data.get_idea[0].idea_ans;

               // alert(tutor_ans);
               // $(".blue").text('"' + tutor_ans + '"');
               // console.log(tutor_ans);

               $(".others_idea_info_blue").html('"' + tutor_ans + '"');
               $('.others_idea_info_blue').find('p:first').remove();
               var test = $(".others_idea_info_blue").find("p:first").text();
               // var test1 = test.replace('&nbsp','');
               $(".others_idea_info_blue").html(test );

               $(".idea_quiz_modal_blue").html('"' + tutor_ans + '"');
               $('.idea_quiz_modal_blue').find('p:first').remove();
               var test = $(".idea_quiz_modal_blue").find("p:first").text();
               // var test1 = test.replace('&nbsp','');
               $(".idea_quiz_modal_blue").html(test);
               
               $("#student_idea_title").html(test);
               // $(".blue").find("p").andSelf().filter("p:first").first().text();

               // $('.hint_selection_content').html(words);
               // $('.hint_selection_content_sentence').html(sentences);


               // $('.tutor_idea_text').html(tutor_ans);
               // $('.tutor_idea_text').find('p:first').remove();
               // $('.tutor_idea_text').find('p:first').remove();





               /*===========new code=================*/
               if (tutor_ans != '') {
                  // $('#second_section').show();
                  // $('#first_section').hide();
                  // alert('jiii');
                  var get_sentences = tutor_ans.match(/<p>([^\<]*?)<\/p>/g);
                  // console.log(typeof new_sentense);
                  // console.log(new_sentense);
                  // alert(get_sentences);
                  //var get_sentences = new_sentense.slice(1);
                  var sentences = new Array();
                  var all_answer = '';
                  var all_sentense_answer = '';
                  var all_conclusion_answer = '';
                  var all_introduction_answer='';
                  var all_body_answer='';
                  var all_common_answer = '';
                  var all_input = '';
                  var html = '';
                  var html2 = '<button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>';
                  //get_sentences.first().remove();
                  var abc_arr = new Array();
                  var sentense_store = new Array();
                  // alert(get_sentences);
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
                        //console.log(get_new_sentense[m]);
                        sentense_store.push(get_new_sentense[m]);
                     }

                     var index = i + 1;

                     // all_answer += '<h6 class="grammer_answer grammer_ans'+index+'" data-id="'+index+'">'+get_sentence+'</h6>';
                     //alert(all_answer);
                     all_input += '<input type="hidden" name="option[]" value="' + get_sentence + '">';
                     sentences.push(get_sentence);

                     // all_answer += '<h6 style="background-color:#000" class="grammer_answer grammer_ans'+index+'" data-id="'+index+'" data-color_no ="'+index+'">'+get_sentence+'</h6>';
                     // all_input += '<input type="hidden" name="option[]" value="'+get_sentence+'">';
                     // sentences.push(get_sentence);

                     html += '<textarea class="form-control hint_textarea hint_textarea_no' + index + '" data-id="' + index + '" name="hint_text[]">' + get_sentence + '</textarea>';
                     html2 += '<button type="button" class="btn btn_blue hint_save_button hint_save_button_no' + index + '" data-dismiss="modal" data-id ="' + index + '">Save</button>';
                  }

                  all_answer += '<p class="grammer_class_remove" style="display: flex;flex-wrap: wrap; gap:3px">';
                  var k;
                  for (k = 0; k < abc_arr.length; k++) {
                     all_answer += '<span class="one_hint_wrap grammer_answer grammer_ans' + k + '" data-id="' + k + '">' + abc_arr[k] + '</span>';
                  }
                  all_answer += '</p>';

                  //For Creative Sentence Part----------
                  all_sentense_answer += '<p class="grammer_class_remove_new" style="flex-wrap: wrap; gap:3px">';
                  var n;
                  //console.log(get_new_sentense.length);
                  for (n = 0; n < sentense_store.length; n++) {

                     all_sentense_answer += '<span class="one_hint_wrap grammer_answer_new grammer_ans_new' + n + '" data-id="' + n + '">' + sentense_store[n] + '.</span>';
                  }
                  all_sentense_answer += '</p>';

                  //For Concluson Part----------
                  all_conclusion_answer += '<p class="grammer_class_remove_news" style="flex-wrap: wrap; gap:3px">';
                  var n;
                  //console.log(get_new_sentense.length);
                  for (n = 0; n < sentense_store.length; n++) {

                     all_conclusion_answer += '<span class="one_hint_wrap grammer_answer_news grammer_ans_news' + n + '" data-id="' + n + '">' + sentense_store[n] + '.</span>';
                  }
                  all_conclusion_answer += '</p>';

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
                  //console.log(get_new_sentense.length);
                  for (n = 0; n < sentense_store.length; n++) {

                     all_body_answer += '<span class="one_hint_wrap grammer_answer_body grammer_ans_body' + n + '" data-id="' + n + '">' + sentense_store[n] + '.</span>';
                  }
                  all_body_answer += '</p>';

                  //All common answer----------------
                  all_common_answer += '<p class="" style="flex-wrap: wrap; gap:3px">';
                  var n;
                  for (n = 0; n < sentense_store.length; n++) {
                     all_common_answer += '<span class="">' + sentense_store[n] + '.</span>';
                  }
                  all_common_answer += '</p>';


                  $('.creative_sentense_paragraph_show').html(all_sentense_answer);
                  $('.conclusion_sentense_paragraph_show').html(all_conclusion_answer);
                  $('.introduction_answer_paragraph').html(all_introduction_answer);
                  $('.body_answer_paragraph').html(all_body_answer);
                  $('.common_answer_paragraph').html(all_common_answer);
                  $('.tutor_idea_text').html(all_answer);
                  // $('.hint_selection_content').html(all_answer);
                  $('#all_option_input').html(all_input);
                  $('.hint_text_modal_body').html(html);
                  $('.hint_text_modal_footer').html(html2);

               } else {
                  alert('First You need to write Writing input');
               }



               /*===========new code=================*/


               var student_name = idea_info.name;
               var student_ans = idea_info.student_ans;
               var profile_image = profile_info.profile_image;


               var student_info = '<tr><td>Created</td><td>' + profile_info.created + '</td></tr><tr><td>Name</td><td >' + profile_info.student_name + '</td></tr><tr><td>Grade/Year</td><td>' + profile_info.student_grade + '</td></tr><tr><td>School</td><td>Qstudy</td></tr><tr><td>Country</td><td>' + country.countryName + '</td></tr>';


               var check_array = Array.isArray(data.teacher_correction[0]);

               if (data.teacher_correction.length > 0) {

                  var teacher_correction = data.teacher_correction[0];

                  var idea_correction_img = teacher_correction.teacher_correction;
                  var total_point = teacher_correction.total_point;
                  var checked_checkbox = teacher_correction.checked_checkbox;

                  $("#tutor_report").val(checked_checkbox);
                  $("#teacher_correction_img").attr('src', idea_correction_img);
                  $("#tutor_grade").val(total_point);
               }




               $("#profile_image").attr('src', '<?php echo base_url(); ?>assets/uploads//profile/thumbnail/' + profile_image);
               $("#submited_ans_view_student_id").val(idea_info.student_id);
               //$(".blue").text('"'+idea_information.idea_title+'"');
               $("#submited_ans_idea_no").val(idea_info.idea_no);

               $(".student_ans_modal").html(student_ans);
               $(".student_name").html(student_name);
               $("#show_question_idea").modal("show");
               $("#student_info").html(student_info);


            }

         });

         $("#tutor_report_show").click(function() {


            var relchk1 = '';
            var relval1 = '';
            var relchk2 = '';
            var relval2 = '';
            var relchk3 = '';
            var relval3 = '';
            var relchk4 = '';
            var relval4 = '';
            var relchk5 = '';
            var relval5 = '';

            var creativechk1 = '';
            var creativeval1 = '';
            var creativechk2 = '';
            var creativeval2 = '';
            var creativechk3 = '';
            var creativeval3 = '';
            var creativechk4 = '';
            var creativeval4 = '';
            var creativechk5 = '';
            var creativeval5 = '';

            var grammerchk1 = '';
            var grammerval1 = '';
            var grammerchk2 = '';
            var grammerval2 = '';
            var grammerchk3 = '';
            var grammerval3 = '';
            var grammerchk4 = '';
            var grammerval4 = '';
            var grammerchk5 = '';
            var grammerval5 = '';

            var vocabularychk1 = '';
            var vocabularyval1 = '';
            var vocabularychk2 = '';
            var vocabularyval2 = '';
            var vocabularychk3 = '';
            var vocabularyval3 = '';
            var vocabularychk4 = '';
            var vocabularyval4 = '';
            var vocabularychk5 = '';
            var vocabularyval5 = '';

            var claritychk1 = '';
            var clarityval1 = '';
            var claritychk2 = '';
            var clarityval2 = '';
            var claritychk3 = '';
            var clarityval3 = '';
            var claritychk4 = '';
            var clarityval4 = '';
            var claritychk5 = '';
            var clarityval5 = '';

            var relevance = '';
            var creativity = '';
            var grammar = '';
            var vocabulary = '';
            var clarity = '';

            var checked_checkbox = $("#tutor_report").val();
            if (checked_checkbox == '') {
               alert('Tutor does not grade yet');
            } else {
               var reports = JSON.parse(checked_checkbox);

               var i = '';
               for (i = 0; i < reports.length; i++) {
                  var checked = 'checked';
                  var report = reports[i].split(',');
                  //console.log(report);

                  if (report[1] == 'relevance') {

                     if (report[2] == 1) {
                        var relchk1 = 'checked';
                        var relval1 = 1;
                     }
                     if (report[2] == 2) {
                        var relchk2 = 'checked';
                        var relval2 = 2;
                     }
                     if (report[2] == 3) {
                        var relchk3 = 'checked';
                        var relval3 = 3;
                     }
                     if (report[2] == 4) {
                        var relchk4 = 'checked';
                        var relval4 = 4;
                     }
                     if (report[2] == 5) {
                        var relchk5 = 'checked';
                        var relval5 = 5;
                     }

                  }

                  if (report[1] == 'creativity') {

                     if (report[2] == 1) {
                        var creativechk1 = 'checked';
                        var creativeval1 = 1;
                     }
                     if (report[2] == 2) {
                        var creativechk2 = 'checked';
                        var creativeval2 = 2;
                     }
                     if (report[2] == 3) {
                        var creativechk3 = 'checked';
                        var creativeval3 = 3;
                     }
                     if (report[2] == 4) {
                        var creativechk4 = 'checked';
                        var creativeval4 = 4;
                     }
                     if (report[2] == 5) {
                        var creativechk5 = 'checked';
                        var creativeval5 = 5;
                     }
                  }

                  if (report[1] == 'grammar') {

                     if (report[2] == 1) {
                        var grammerchk1 = 'checked';
                        var grammerval1 = 1;

                     }
                     if (report[2] == 2) {
                        var grammerchk2 = 'checked';
                        var grammerval2 = 2;
                     }
                     if (report[2] == 3) {
                        var grammerchk3 = 'checked';
                        var grammerval3 = 3;
                     }
                     if (report[2] == 4) {
                        var grammerchk4 = 'checked';
                        var grammerval4 = 4;
                     }
                     if (report[2] == 5) {
                        var grammerchk5 = 'checked';
                        var grammerval5 = 5;
                     }
                  }

                  if (report[1] == 'vocabulary') {

                     if (report[2] == 1) {
                        var vocabularychk1 = 'checked';
                        var vocabularyval1 = 1;
                     }
                     if (report[2] == 2) {
                        var vocabularychk2 = 'checked';
                        var vocabularyval2 = 2;
                     }
                     if (report[2] == 3) {
                        var vocabularychk3 = 'checked';
                        var vocabularyval3 = 3;
                     }
                     if (report[2] == 4) {
                        var vocabularychk4 = 'checked';
                        var vocabularyval4 = 4;
                     }
                     if (report[2] == 5) {
                        var vocabularychk5 = 'checked';
                        var vocabularyval5 = 5;
                     }
                  }

                  if (report[1] == 'clarity') {

                     if (report[2] == 1) {
                        var claritychk1 = 'checked';
                        var clarityval1 = 1;
                     }
                     if (report[2] == 2) {
                        var claritychk2 = 'checked';
                        var clarityval2 = 2;
                     }
                     if (report[2] == 3) {
                        var claritychk3 = 'checked';
                        var clarityval3 = 3;
                     }
                     if (report[2] == 4) {
                        var claritychk4 = 'checked';
                        var clarityval4 = 4;
                     }
                     if (report[2] == 5) {
                        var claritychk5 = 'checked';
                        var clarityval5 = 5;
                     }

                  }
               }

               var final_report = '<table class="table"><thead><tr><th></th><th class="red">Poor</th><th class="blue">Average</th><th class="gold">Good</th><th class="green">Very Good</th><th class="orange">Excellent!</th></tr></thead><tbody><tr><td>Relevance</td><td><input type="checkbox" value="1" class="report_box relevance" id="Rel_poor" name="Rel_poor"' + relchk1 + '><span id="Rel_poor_span">' + relval1 + '</span></td><td><input type="checkbox" value="2" class="report_box relevance" id="Rel_average" name="Rel_average"' + relchk2 + '><span id="Rel_average_span">' + relval2 + '</span></td><td><input type="checkbox" value="3" class="report_box relevance" id="Rel_good" name="Rel_good"' + relchk3 + '><span id="Rel_good_span">' + relval3 + '</span></td><td><input type="checkbox" value="4" class="report_box relevance" id="Rel_very_good" name="Rel_very_good"' + relchk4 + '><span id="Rel_very_good_span">' + relval4 + '</span></td><td><input type="checkbox" value="5" class="report_box relevance" id="Rel_excellent" name="Rel_excellent"' + relchk5 + '><span id="Rel_excellent_span">' + relval5 + '</span></td></tr><tr><td>Creativity</td><td><input type="checkbox" value="1" class="report_box creativity" id="cre_poor" name="cre_poor"' + creativechk1 + '><span id="cre_poor_span">' + creativeval1 + '</span></td><td><input type="checkbox" value="2" class="report_box creativity" id="cre_average" name="cre_average"' + creativechk2 + '><span id="cre_average_span">' + creativeval2 + '</span></td><td><input type="checkbox" value="3" class="report_box creativity" id="cre_good" name="cre_good"' + creativechk3 + '><span id="cre_good_span">' + creativeval3 + '</span></td><td><input type="checkbox" value="4" class="report_box creativity" id="cre_very_good" name="cre_very_good"' + creativechk4 + '><span id="cre_very_good_span">' + creativeval4 + '</span></td><td><input type="checkbox" value="5" class="report_box creativity" id="cre_excellent" name="cre_excellent"' + creativechk5 + '><span id="cre_excellent_span">' + creativeval5 + '</span></td></tr><tr><td>Grammar/Spelling</td><td><input type="checkbox" value="1" class="report_box grammar" id="grammar_poor" name="grammar_poor"' + grammerchk1 + '><span id="grammar_poor_span">' + grammerval1 + '</span></td><td><input type="checkbox" value="2" class="report_box grammar" id="grammar_average" name="grammar_average"' + grammerchk2 + '><span id="grammar_average_span">' + grammerval2 + '</span></td><td><input type="checkbox" value="3" class="report_box grammar" id="grammar_good" name="grammar_good"' + grammerchk3 + '><span id="grammar_good_span">' + grammerval3 + '</span></td><td><input type="checkbox" value="4" class="report_box grammar" id="grammar_very_good" name="grammar_very_good" ' + grammerchk4 + '><span id="grammar_very_good_span">' + grammerval4 + '</span></td><td><input type="checkbox" value="5" class="report_box grammar" id="grammar_excellent" name="grammar_excellent" ' + grammerchk5 + '><span id="grammar_excellent_span">' + grammerval5 + '</span></td></tr><tr><td>Vocabulary</td><td><input type="checkbox" value="1" class="report_box vocabulary" id="vocabulary_poor" name="vocabulary_poor"' + vocabularychk1 + '><span id="vocabulary_poor_span">' + vocabularyval1 + '</span></td><td><input type="checkbox" value="2" class="report_box vocabulary" id="vocabulary_average" name="vocabulary_average" ' + vocabularychk2 + '><span id="vocabulary_average_span">' + vocabularyval2 + '</span></td><td><input type="checkbox" value="3" class="report_box vocabulary" id="vocabulary_good" name="vocabulary_good" ' + vocabularychk3 + '><span id="vocabulary_good_span">' + vocabularyval3 + '</span></td><td><input type="checkbox" value="4" class="report_box vocabulary" id="vocabulary_very_good" name="vocabulary_very_good" ' + vocabularychk4 + '><span id="vocabulary_very_good_span">' + vocabularyval4 + '</span></td><td><input type="checkbox" value="5" class="report_box vocabulary" id="vocabulary_excellent" name="vocabulary_excellent"' + vocabularychk5 + '><span id="vocabulary_excellent_span">' + vocabularyval5 + '</span></td></tr><tr><td>Clarity</td><td><input type="checkbox" value="1" class="report_box clarity" id="clarity_poor" name="clarity_poor" ' + claritychk1 + '><span id="clarity_poor_span">' + clarityval1 + '</span></td><td><input type="checkbox" value="2" class="report_box clarity" id="clarity_average" name="clarity_average"' + claritychk2 + '><span id="clarity_average_span">' + clarityval2 + '</span></td><td><input type="checkbox" value="3" class="report_box clarity" id="clarity_good" name="clarity_good"' + claritychk3 + '><span id="clarity_good_span">' + clarityval3 + '</span></td><td><input type="checkbox" value="4" class="report_box clarity" id="clarity_very_good" name="clarity_very_good" ' + claritychk4 + '><span id="clarity_very_good_span">' + clarityval4 + '</span></td><td><input type="checkbox" value="5" class="report_box clarity" id="clarity_excellent" name="clarity_excellent" ' + claritychk5 + '><span id="clarity_excellent_span">' + clarityval5 + '</span></td></tr></tbody></table>';

               $(".profile_right_ida_bottom").html(final_report);
            }
         });

      });
      $(".view_tutor_idea").click(function() {
         var tutor_id = $(this).attr("data-index");
         var idea_id = $(this).attr("data-idea");
         var question_id = $(this).attr("data-question");

         $.ajax({
            url: "submited_tutor_idea",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {
               tutor_id: tutor_id,
               idea_id: idea_id,
               question_id: question_id
            },
            cache: false,
            dataType: 'json',
            success: function(data) {
               console.log(data);

               var idea_info = data.get_idea[0];
               var profile_info = data.profile_info[0];
               var idea_information = data.idea_information[0];
               // var teacher_correction = data.teacher_correction[0];
               var country = data.country[0];
               //  console.log(idea_info[0].id);
               // var tutor_name = idea_info.name;
               var tutor_ans = idea_info.idea_ans;
               //var profile_image= profile_info.profile_image;
               

               // $('.tutor_idea_text').html(tutor_ans);
               //$('.tutor_idea_text').find('p:first').remove();
               //$('.tutor_idea_text').find('p:first').remove();
               // alert($( ".tutor_idea_text" ).html());


               // $(".blue").text('"' + idea_information.idea_title + '"');

               $(".tutor_ans_modal").html(tutor_ans);
               // $(".tutor_name").html(tutor_name);
               // $("#get_tutor_id").val(idea_info.tutor_id);
               $("#show_question_idea_tutor").modal("show");
               // $("#tutor_submit_date").text(idea_info.submit_date);
               // $("#tutor_idea_no").val(idea_information.idea_no);
               if(idea_info.idea_publish==1){
                   
                  $('#tutor_idea_next').show();
                  $('#tutor_idea_close').hide();
               }else{
                  $('#tutor_idea_close').show();
                  $('#tutor_idea_next').hide();
               }
               $('.idea_tutor_name').text(idea_info.name);
               var idea_title='"'+idea_info.idea_title+'"<i class="fa fa-pencil" aria-hidden="true"></i>';
               $('#tutor_idea_title').html(idea_title);
               $('.idea_submit_date').text(idea_info.submit_date);
               $('.student_mark_submit').attr('data-idea',idea_info.idea_id);
               $('.student_mark_submit').attr('data-question',question_id);
               $('.student_mark_submit').attr('data-point',idea_info.tutor_point);

            }

         });
      });

      // $('#idea_next_student').click(function(){


      // });
      $("#idea_next_student").on("click", function() {

         $("#show_question_idea").modal("hide");
         $('#others_idea_info').modal('show');

         var student_id = $('#student_view_idea_student_id').val();
         var idea_id = $('#student_view_idea_idea_id').val();
         var question_id = $('#student_view_idea_question_id').val();
         // alert(student_id);
         // alert(idea_id);
         // alert(question_id);
         $.ajax({
            url: "Student/get_student_submited_idea_info",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {student_id:student_id,idea_id:idea_id,question_id:question_id},
            cache: false,
            dataType: 'json',
            success: function(data) {
                  console.log(data);
                  if(data.profile_image !=''){
                     var img_url = '<?php echo base_url();?>assets/uploads/profile/thumbnail/'+data.profile_image;
                  }else{
                     var img_url = 'assets/images/default_user.jpg';
                  }
                  $('#idea_user_image').attr('src',img_url);
                  $('#st_sub_idea_created_date').text(data.submit_date);
                  $('#st_sub_idea_name').text(data.name);
                  $('#st_sub_idea_grade').text(data.student_grade);
                  $('#st_sub_idea_school').text(data.school_name);
                  $('#st_sub_idea_country').text(data.countryName);

                  $('.idea_user_image').attr('src',img_url);
                  $('.st_sub_idea_created_date').text(data.submit_date);
                  $('.st_sub_idea_name').text(data.name);
                  $('.st_sub_idea_grade').text(data.student_grade);
                  $('.st_sub_idea_school').text(data.school_name);
                  $('.st_sub_idea_country').text(data.countryName);

            }
         });

      });
      $('#start_idea_quiz').click(function() {
         //console.log('hi');
         // var studentAns = $("#student_ans").val();
         // $(".blue").text('"' + studentAns + '"');
         //alert('jii');
         $("#others_idea_info").modal("hide");
         $('#idea_quiz_modal').modal('show');
         $('.tutor_idea_text').hide();
         $('.common_answer_paragraph').show();
      });
   </script>

   <!-- Nazmul-->
   <script>
      //For Word---------------------- 
      var every_word_index = new Array();
      $(document).delegate('.grammer_answer', 'click', function() {
         every_word_index.push($(this).attr('data-id'));
         $("#every_word_index").val(every_word_index);
         $("#student_spelling_ans").val(every_word_index);
         var number = $("#number_increase").val();
         var sum = parseInt(number) + 1;
         $("#number_increase").val(sum);
         var text = $(this).text();
         var id = $(this).attr('data-id');
         var test = $('.grammer_ans' + id).attr('style', 'background-color: rgb(255, 201, 14);');
         var text_new = '<p data-id="' + sum + '" class="incorrect_word' + id + '"><span class="number_inser">' + sum + '. </span>' + text + '</p>'
         $('.choosen_word_show').append(text_new);

      });

      $('.next_submit_spelled').hide();
      $('.ans_submit_spelled').click(function() {
         $(this).hide();
         $('.next_submit_spelled').show();

         var student_id = $('#student_view_idea_student_id').val();
         var module_id = $('#student_view_idea_module_id').val();
         var question_id = $('#student_view_idea_question_id').val();

         $.ajax({
            url: "student_word_get",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {student_id:student_id,module_id:module_id,question_id:question_id},
            cache: false,
            dataType: 'json',
            success: function(data) {

               var result_calculate = 0;
               var word_mark = Math.ceil(parseInt(20) / parseInt(data.word_index.length));

               var chosen_word_index = $('#every_word_index').val().split(",");
               $('.grammer_answer').css("background-color", "");
               $('.grammer_class_remove').find('span').removeClass("grammer_answer");
               if (data.word_index.length > 0) {
                  for (var i = 0; i < data.word_index.length; i++) {
                     $('.grammer_ans' + data.word_index[i]).css("background-color", "#b5e61d");
                     $('.grammer_ans' + data.word_index[i]).append('<span class="tooltip_one tooltip_rs">' + data.correct_words[i] + '</span>');
                  }
               }
               //show conrrect and incorrect word---------------
               if (chosen_word_index.length > 0) {
                  for (var j = 0; j < chosen_word_index.length; j++) {
                     if ($.inArray(chosen_word_index[j], data.word_index) >= 0) {
                        result_calculate = result_calculate + word_mark;
                        $('.incorrect_word' + chosen_word_index[j]).append('<span style="margin-left:10px;color:#ED1622;">(Correct Chosen)</span>')
                     } else {
                        $('.incorrect_word' + chosen_word_index[j]).append('<span style="margin-left:10px;color:#ED1622;">(Incorrect Chosen)</span>');
                     }
                  }

                  //for word spelled mark show--------------
                  $('.your_point_show').show();
                  $('#student_spelling_get_point').val(result_calculate);
                  $('#word_spelled_mark').val(result_calculate);
                  $('.total_point_count').html(result_calculate);
               }

               $('.tooltip_rs').draggable({
                  revert: 'invalid',
               });
            }
         });

      });

      //For sentence---------------------- 
      $('.chose_creative_sentense').hide();
      $('.heading_creative_sentense_show').hide();
      $('.creative_sentense_paragraph_show').hide();
      $('.next_submit_spelled').click(function() {
         $('.your_point_show').hide();
         $('.choose_word').hide();
         $('.ans_submit_miss_spelled').hide();
         $(this).hide();
         $('.tutor_idea_text').hide();
         $('.chose_creative_sentense').show();
         $('.heading_creative_sentense_show').show();
         $('.creative_sentense_paragraph_show').show();

      });

      //Creative sentence part Start-------------
      var every_sentense_index = new Array();
      $(document).delegate('.grammer_answer_new', 'click', function() {
         var id = $(this).attr('data-id');
         every_sentense_index.push(id);
        
         if (every_sentense_index.length > 2) {
            every_sentense_index.pop(); //remove last index
            alert('You can not select more than two sentence');
            return false;
         }
         $('#every_sentence_index').val(every_sentense_index);
         $('#student_sentence_index_ans').val(every_sentense_index);
         var number = $("#number_increase_new").val();
         var sum = parseInt(number) + 1;
         $("#number_increase_new").val(sum);
         var text = $(this).text();
         if (every_sentense_index.length == 1) {
            var test = $('.grammer_ans_new' + id).attr('style', 'background-color: rgb(180, 231, 28);');
         } else {
            var test = $('.grammer_ans_new' + id).attr('style', 'background-color: rgb(255, 201, 14);');
         }

         var text_new = '<p data-id="' + sum + '" class="incorrect_word'+id +'"><span class="number_inser">' + sum + '. </span>' + text + '</p>'
         $('.chose_creative_sentense_show').append(text_new);
      });


      $('.next_creative_sentence_button').hide();
      $('.ans_creative_question').click(function() {
         $(this).hide();
         $('.next_creative_sentence_button').show();

         var student_id = $('#student_view_idea_student_id').val();
         var module_id = $('#student_view_idea_module_id').val();
         var question_id = $('#student_view_idea_question_id').val();

         $.ajax({
            url: "Student/student_creative_sentence_get",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {student_id:student_id,module_id:module_id,question_id:question_id},
            cache: false,
            dataType: 'json',
            success: function(data) {
               var result_calculate = 0;
               var sentence_mark = 10;

               var chosen_sentence_index = $('#every_sentence_index').val().split(",");

               $('.grammer_answer_new ').css("background-color","");
               if (data.sentence_index.length > 0) {
                  for (var i = 0; i < data.sentence_index.length; i++) {
                     //$('.grammer_answer_new'+data.sentence_index[i]).css("background-color","#b5e61d"); 
                     if (i == 0) {
                        $('.grammer_ans_new' + data.sentence_index[i]).css("background-color", "background-color: rgb(180, 231, 28)");
                        $('.grammer_ans_new' + data.sentence_index[i]).append('<span class="tooltip_one tooltip_rs">Creative Sentence</span>');
                     } else {
                        $('.grammer_ans_new' + data.sentence_index[i]).css("background-color", "background-color: rgb(255, 171, 191)");
                        $('.grammer_ans_new' + data.sentence_index[i]).append('<span class="tooltip_one tooltip_rs">Creative Sentence</span>');
                     }
                  }

                    //show conrrect and incorrect Sentence---------------
                    if(chosen_sentence_index.length>0){
                      for (var j = 0; j < chosen_sentence_index.length; j++) {
                        if ($.inArray(chosen_sentence_index[j],data.sentence_index) >= 0) {
                           result_calculate = result_calculate + sentence_mark;
                           $('.incorrect_word'+chosen_sentence_index[j]).prepend('<div style="margin-left:10px;color:#EE1A20;">(Correct Chosen)</div>')
                        } else {
                           $('.incorrect_word' + chosen_sentence_index[j]).prepend('<div style="margin-left:10px;color:#EE1A20;">(Incorrect Chosen)</div>');
                           $('.grammer_ans_new' + chosen_sentence_index[j]).css("background-color", "background-color: rgb(255,201,14)");
                           $('.grammer_ans_new' + chosen_sentence_index[j]).append('<span class="tooltip_one tooltip_rs_new">Incorrect Chosen</span>');
                        }
                      }
                    }
                     $('.your_point_show').show();
                     $('.total_point_count').html(result_calculate);
                     $('#creative_sentence_mark').val(result_calculate);
                     $('#student_sentence_get_point').val(result_calculate);
                     $('.tooltip_rs').draggable({
                        revert: 'invalid',
                     });

                     $('.tooltip_rs_new').draggable({
                     revert: 'invalid',
                     });
                   
               }
          

            }
         });
      });
      //Creative sentence part End------------- 


      //Conclusion part Start-------------
      $('.conclusion_sentense_paragraph_show').hide();
      $('.heading_conclusion_sentense_show').hide();
      $('.next_creative_sentence_button').click(function(e) {
         $(this).hide();
         $('.your_point_show').hide();
         $('.chose_conclusion_sentense').show();
         $('.creative_sentense_paragraph_show').hide();
         $('.heading_conclusion_sentense_show').show();
         $('.heading_creative_sentense_show').hide();
         $('.chose_creative_sentense').hide();
         $('.conclusion_sentense_paragraph_show').show();
      })

      var every_conclusion_sentense_index = new Array();
      $(document).delegate('.grammer_answer_news', 'click', function() {
         var id = $(this).attr('data-id');
         var text = $(this).text();
         every_conclusion_sentense_index.push(id);
         if (every_conclusion_sentense_index.length > 1) {
            every_conclusion_sentense_index.pop();
            alert('You can not select more than one sentence');
            return false;
         }
         $("#every_conclusion_index").val(every_conclusion_sentense_index);
         $("#student_ans_conclusion_index").val(every_conclusion_sentense_index);
         $('.grammer_ans_news' + id).attr('style', 'background-color: rgb(255,201,14);');
         var text_new = '<p class="incorrect_word'+id+'"><span class="number_inser"></span>' + text + '</p>'
         $('.chose_conclusion_sentense_show').append(text_new);
      });

      $('.next_conclusion_sentence_button').hide();
      $('.ans_conclusion_question').click(function(e) {
         $('.grammer_class_remove_news').find('span').removeClass("grammer_answer_news");
         $(this).hide();
         $('.next_conclusion_sentence_button').show();

         var student_id = $('#student_view_idea_student_id').val();
         var module_id = $('#student_view_idea_module_id').val();
         var question_id = $('#student_view_idea_question_id').val();

         $.ajax({
            url: "Student/student_conclusion_sentence_get",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {student_id:student_id,module_id:module_id,question_id:question_id},
            cache: false,
            dataType: 'json',
            success: function(data) {
               var result_calculate = 0;
               var conclusion_point=20;
               var every_conclusion_index = $('#every_conclusion_index').val().split(",");

               //show conrrect and incorrect Sentence---------------
               if (every_conclusion_index.length > 0) {
                  for (var j = 0; j<every_conclusion_index.length; j++) {
                    
                     if ($.inArray(every_conclusion_index[j],data.conclusion_sentence_index) >= 0) {
                        result_calculate = result_calculate+conclusion_point;
                        $('.incorrect_word' +every_conclusion_index[j]).prepend('<div style="margin-left:10px;color:#EE1A20;">Correct Chosen</div>')
                        // $('.grammer_ans_news' + data.conclusion_sentence_index[j]).css("background-color", "background-color: rgb(255,174,201)");
                        // $('.grammer_ans_news' + data.conclusion_sentence_index[j]).append('<span class="tooltip_one tooltip_rs">Correct Conclusion</span>');
                     } else {
                        //console.log(data.conclusion_sentence_index[j]);
                        $('.incorrect_word' + every_conclusion_index[j]).prepend('<div style="margin-left:10px;color:#EE1A20;">Incorrect Chosen</div>');
                        $('.grammer_ans_news' + every_conclusion_index[j]).append('<span class="tooltip_one tooltip_rs_new">Incorrect Conclusion</span>');
                        $('.grammer_ans_news' + data.conclusion_sentence_index[j]).css("background-color",   "background-color: rgb(255,174,201)");
                        $('.grammer_ans_news' + data.conclusion_sentence_index[j]).append('<span class="tooltip_one tooltip_rs">Correct Conclusion</span>');
                     }
                  }
                  $('.tooltip_rs_new').draggable({
                     revert: 'invalid',
                  });
                  $('.tooltip_rs').draggable({
                     revert: 'invalid',
                  });

                  //Mark Show------
                  $('.your_point_show').show();
                  $('.total_point_count').html(result_calculate);
                  $('#conclusion_sentence_mark').val(result_calculate);
                  $('#student_ans_conclusion_get_point').val(result_calculate);
               }
            }
         });
      });


      $('.conclusion_checkbox_show').hide();
      $('.conclusion_checkbox_show_teacher').hide();
      $('.heading_checkbox_show').hide();
      $('.common_answer_paragraph').hide();
      $('.next_conclusion_sentence_button').click(function(e) {
         $(this).hide();
         $('.conclusion_checkbox_show').show();
         $('.chose_conclusion_sentense').hide();
         $('.heading_conclusion_sentense_show').hide();
         $('.conclusion_sentense_paragraph_show').hide();
         $('.heading_checkbox_show').show();
         $('.common_answer_paragraph').show();
         $('.your_point_show').hide();
      });

      $('.ans_conclusion_next').hide();
    
      $('.ans_conclusion_comment').click(function(e){
         var is_empty = 0;
         var std_value = 0;
         var std_check_val = 0;
         $(".conclusion_radio").each(function() {
            if ($(this).is(":checked")) {
               is_empty = 1;
               std_value = $(this).val();
            }
         });
         if (is_empty == 0) {
            alert("please checked one of them");
            return false;
         }
         $('#student_radio_conclusion_index').val(std_value);
         //alert(is_empty);
         $(this).hide(); 

         var student_id = $('#student_view_idea_student_id').val();
         var module_id = $('#student_view_idea_module_id').val();
         var question_id = $('#student_view_idea_question_id').val();

         $.ajax({
            url: "Student/student_conclusion_comment",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {student_id:student_id,module_id:module_id,question_id:question_id},
            cache: false,
            dataType: 'json',
            success: function(data) {
                  //console.log(data);
                  $('.ans_conclusion_next').show();
                  $('.conclusion_checkbox_show_teacher').show();
                  $('.conclusion_checkbox_ans'+data.conclusion_comment).attr('checked','checked');
                  $('.your_point_show').show();
                  
                  if(std_value == data.conclusion_comment){
                     $('.total_point_count').html(data.conclusion_mark);
                     $('#conclusion_checkbox_mark').val(data.conclusion_mark);
                     $('#student_radio_conclusion_get_point').val(std_value);
                  }
                  else
                  {
                     $('.total_point_count').html(0);
                     $('#conclusion_checkbox_mark').val(0);    
                  }
            }
         });
      });

      //Introduction Part Start---------------
      $('.heading_introduction_paragraph').hide();
      $('.introduction_answer_paragraph').hide();
      $('.ans_conclusion_next').click(function(e){
            $('.heading_introduction_paragraph').show();
            $('.introduction_paragraph').show();
            $('.heading_checkbox_show').hide();
            $('.conclusion_checkbox').hide();
            $('.your_point_show').hide();
            $('.common_answer_paragraph').hide();
            $('.introduction_answer_paragraph').show();
      });

      var every_introduction_sentense_index = new Array();
      $(document).delegate('.grammer_answer_introduction', 'click', function() {
         var id = $(this).attr('data-id');
         var text = $(this).text();
         every_introduction_sentense_index.push(id);
         if (every_introduction_sentense_index.length > 1) {
            every_introduction_sentense_index.pop();
            alert('You can not select more than one sentence');
            return false;
         }
         $("#every_introduction_index").val(every_introduction_sentense_index);
         $("#student_ans_introduction_index").val(every_introduction_sentense_index);
         $('.grammer_ans_introduction'+id).attr('style','background-color: rgb(255,201,14);');
         var text_new = '<p class="incorrect_word'+id+'"><span class="number_inser"></span>' + text + '</p>'
         $('.introduction_paragraph_show').append(text_new);
      })

      $('.ans_introduction_next').hide();
      $('.introduction_paragraph_submit').click(function(e){
            $('.grammer_class_remove_introduction').find('span').removeClass("grammer_answer_introduction");
            $(this).hide();
            $('.ans_introduction_next').show();

            var student_id = $('#student_view_idea_student_id').val();
            var module_id = $('#student_view_idea_module_id').val();
            var question_id = $('#student_view_idea_question_id').val();

            $.ajax({
            url: "Student/student_introduction_sentence_get",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {student_id:student_id,module_id:module_id,question_id:question_id},
            cache: false,
            dataType: 'json',
            success: function(data) {
               var result_calculate = 0;
               var introduction_point=20;
               var every_introduction_index = $('#every_introduction_index').val().split(",");
               //console.log(every_introduction_index);
               //show conrrect and incorrect Sentence---------------
               if (every_introduction_index.length > 0) {
                  for (var j = 0; j < every_introduction_index.length; j++) {
                     if ($.inArray(every_introduction_index[j], data.introduction_sentence_index) >= 0) {
                        result_calculate =result_calculate+introduction_point;
                        $('.incorrect_word' + every_introduction_index[j]).prepend('<div style="margin-left:10px;color:#EE1A20;">Correct Chosen</div>');
                     } else {
                        //console.log(every_introduction_index[j]);
                        $('.incorrect_word' + every_introduction_index[j]).prepend('<div style="margin-left:10px;color:#EE1A20;">Incorrect Chosen</div>');
                        $('.grammer_ans_introduction' + every_introduction_index[j]).append('<span class="tooltip_one tooltip_rs_new">Incorrect Introduction</span>');

                        $('.grammer_ans_introduction' + data.introduction_sentence_index[j]).css("background-color", "background-color: rgb(255,174,201)");
                        $('.grammer_ans_introduction' + data.introduction_sentence_index[j]).append('<span class="tooltip_one tooltip_rs">Correct Introduction</span>');
                      
                     }
                  }
                  $('.tooltip_rs_new').draggable({
                     revert: 'invalid',
                  });
                  $('.tooltip_rs').draggable({
                     revert: 'invalid',
                  });

                  //Mark Show------
                  $('.your_point_show').show();
                  $('.total_point_count').html(result_calculate);
                  $('#introduction_sentence_mark').val(result_calculate);
                  $('#student_ans_intro_get_point').val(result_calculate);
               }
            }
         });
      });

      $('.heading_checkbox_introduction').hide();
      $('.introduction_checkbox_show').hide();
      $('.introduction_checkbox_show_teacher').hide();
      $('.ans_introduction_next_new').hide();
      $('.ans_introduction_next').click(function(e){
            $(this).hide();
            $('.ans_conclusion_next').hide();
            $('.introduction_checkbox_show').show();
            $('.heading_introduction_paragraph').hide();
            $('.introduction_answer_paragraph').hide();
            $('.introduction_paragraph_show').hide();
            $('.common_answer_paragraph').show();
            $('.heading_checkbox_introduction').show();
            $('.your_point_show').hide();
      });

      $('.ans_introduction_comment').click(function(e){
         var is_empty = 0;
         var std_values = 0;
         var std_check_val = 0;
         $(".introduction_radio").each(function() {
            if ($(this).is(":checked")) {
               is_empty = 1;
               std_values = $(this).val();
            }
         });
         if (is_empty == 0) {
            alert("please checked one of them");
            return false;
         }
         $('#student_intro_radio_index').val(std_values);
         //alert(is_empty);
         $(this).hide(); 

         var student_id = $('#student_view_idea_student_id').val();
         var module_id = $('#student_view_idea_module_id').val();
         var question_id = $('#student_view_idea_question_id').val();

         $.ajax({
            url: "Student/student_introduction_comment",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {student_id:student_id,module_id:module_id,question_id:question_id},
            cache: false,
            dataType: 'json',
            success: function(data) {
                  //console.log(data);
                  $('.ans_introduction_next_new').show();
                  $('.introduction_checkbox_show_teacher').show();
                  $('.introduction_checkbox_ans'+data.introduction_comment).attr('checked','checked');
                  $('.your_point_show').show();
                  
                  if(std_values == data.introduction_comment){
                     $('.total_point_count').html(data.introduction_mark);
                     $('#introduction_checkbox_mark').val(data.introduction_mark);
                     $('#student_intro_radio_get_point').val(data.introduction_mark);
                  }
                  else
                  {
                     $('.total_point_count').html(0);
                     $('#introduction_checkbox_mark').val(0);    
                  }
            }
         });
      });

      //Body Paragraph start------------------
      $('.heading_body_paragraph').hide();
      $('.body_answer_paragraph').hide();
      $('.ans_introduction_next_new').click(function(e){
            $(this).hide();
            $('.heading_checkbox_introduction').hide();
            $('.introduction_checkbox').hide();
            $('.common_answer_paragraph').hide();
            $('.heading_body_paragraph').show();
            $('.body_paragraph').show();
            $('.body_answer_paragraph').show();
      });

      var every_body_sentense_index = new Array();
      $(document).delegate('.grammer_answer_body ','click',function(){
            var id = $(this).attr('data-id');
            var text = $(this).text();
            every_body_sentense_index.push(id);
            if (every_body_sentense_index.length > 1) {
               every_body_sentense_index.pop();
               alert('You can not select more than one sentence');
               return false;
            }
            $("#every_body_index").val(every_body_sentense_index);
            $("#student_ans_paragraph_index").val(every_body_sentense_index);
            $('.grammer_ans_body'+id).attr('style','background-color: rgb(255,201,14);');
            var text_new = '<p class="incorrect_word'+id+'"><span class="number_inser"></span>' + text + '</p>'
            $('.body_paragraph_show').append(text_new);
      });

      $('.ans_body_next').hide();
      $('.body_paragraph_submit').click(function(e){
            $('.grammer_class_remove_body').find('span').removeClass("grammer_answer_body");
            $(this).hide();
            $('.ans_body_next').show();

            var student_id = $('#student_view_idea_student_id').val();
            var module_id = $('#student_view_idea_module_id').val();
            var question_id = $('#student_view_idea_question_id').val();

            $.ajax({
            url: "Student/student_body_sentence_get",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {student_id:student_id,module_id:module_id,question_id:question_id},
            cache: false,
            dataType: 'json',
            success: function(data) {
               var result_calculate = 0;
               var body_point=20;
               var every_body_index = $('#every_body_index').val().split(",");
               //console.log(every_body_index);
               //show conrrect and incorrect Sentence---------------
               if (every_body_index.length > 0) {
                  for (var j = 0; j < every_body_index.length; j++) {
                     if ($.inArray(every_body_index[j], data.body_sentence_index) >= 0) {
                        result_calculate =result_calculate+body_point;
                        $('.incorrect_word'+every_body_index[j]).prepend('<div style="margin-left:10px;color:#EE1A20;">Correct Chosen</div>');
                     } else {
                        //console.log(every_introduction_index[j]);
                        $('.incorrect_word' + every_body_index[j]).prepend('<div style="margin-left:10px;color:#EE1A20;">Incorrect Chosen</div>');
                        $('.grammer_ans_body' + every_body_index[j]).append('<span class="tooltip_one tooltip_rs_new">Incorrect Body Paragraph</span>');
                        
                        $('.grammer_ans_body' + data.body_sentence_index[j]).css("background-color", "background-color: rgb(255,174,201)");
                        $('.grammer_ans_body' + data.body_sentence_index[j]).append('<span class="tooltip_one tooltip_rs">Correct Body Paragraph</span>');
                     
                     }
                  }
                  $('.tooltip_rs_new').draggable({
                     revert: 'invalid',
                  });
                  $('.tooltip_rs').draggable({
                     revert: 'invalid',
                  });

                  //Mark Show------
                  $('.your_point_show').show();
                  $('.total_point_count').html(result_calculate);
                  $('#body_sentence_point').val(result_calculate);
                  $('#student_ans_paragraph_get_point').val(result_calculate);

               }
            }
         });
      });

      $('.heading_checkbox_body').hide();
      $('.body_paragraph_checkbox_show').hide();
      $('.body_paragraph_checkbox_show_teacher').hide();
      $('.ans_body_next_new').hide();
      $('.ans_body_next').click(function(e){
           $(this).hide();
           $('.heading_body_paragraph').hide(); 
           $('.body_paragraph').hide();
           $('.heading_checkbox_body').show();
           $('.body_answer_paragraph').hide();
           $('.common_answer_paragraph').show();
           $('.body_paragraph_checkbox_show').show();
      });

     $('.ans_body_comment').click(function(e){
      var is_empty = 0;
         var std_values = 0;
         var std_check_val = 0;
         $(".body_radio").each(function() {
            if ($(this).is(":checked")) {
               is_empty = 1;
               std_values = $(this).val();
            }
         });
         $('#student_ans_radio_paragraph').val(std_values);
         if (is_empty == 0) {
            alert("please checked one of them");
            return false;
         }

         $(this).hide(); 

         var student_id = $('#student_view_idea_student_id').val();
         var module_id = $('#student_view_idea_module_id').val();
         var question_id = $('#student_view_idea_question_id').val();

         $.ajax({
            url: "Student/student_body_comment",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {student_id:student_id,module_id:module_id,question_id:question_id},
            cache: false,
            dataType: 'json',
            success: function(data) {
                  $('.ans_body_next_new').show();
                  $('.body_paragraph_checkbox_show_teacher').show();
                  $('.body_checkbox_ans'+data.body_comment).attr('checked','checked');
                  $('.your_point_show').show();
                  
                  if(std_values == data.body_comment){
                     $('.total_point_count').html(data.body_mark);
                     $('#body_checkbox_mark').val(data.body_mark);
                     $('#student_ans_radio_paragraph_get_point').val(std_values);
                  }
                  else
                  {
                     $('.total_point_count').html(0);
                     $('#body_checkbox_mark').val(0);    
                  }
            }
         });
     }); 
     $('.total_point_show').hide();

     $('.ans_body_next_new').click(function(e){
           $(this).hide(); 
           $('.heading_checkbox_body').hide();
           $('.body_paragraph_checkbox_show').hide();
           $('.body_paragraph_checkbox_show_teacher').hide();
           $('.your_point_show').hide();
           $('.total_point_show').show();
           
           var total_point=parseInt($('#story_checkbox_mark').val())+parseInt($('#word_spelled_mark').val())+parseInt($('#creative_sentence_mark').val())+parseInt($('#conclusion_sentence_mark').val())+parseInt($('#conclusion_checkbox_mark').val())+parseInt($('#introduction_sentence_mark').val())+parseInt($('#introduction_checkbox_mark').val())+parseInt($('#body_sentence_point').val())+parseInt($('#body_checkbox_mark').val());
           
           $('.all_point_show').html(total_point);

           var question_id=$('#question_id').val();
           var student_id='<?php echo $this->session->userdata('user_id')?>';  
         $.ajax({
            url: "Student/submited_student_idea_point",
            method: "POST",
            enctype: 'multipart/form-data',
            data: {
               student_id: student_id,
               question_id: question_id,
               total_point:total_point,
            },
            cache: false,
            dataType: 'json',
            success: function(data) {

               $('#idea_quiz_modal').modal('hide');
               base_url = '<?= base_url('/price_dashboard') ?>';
               window.location.href = base_url
            }
         });
     });

      $('#student_left_menu').click(function(){

         var page_increment = 2;
         var page_index = $('#student_page_index').val();
         if(page_index>1){
            var new_page_index = parseInt(page_index)-1;
            $('#student_page_index').val(new_page_index);
            var start_index = (new_page_index*page_increment)-1;
            var end_index = (new_page_index*page_increment);
            $('.student_idea_ans').hide();
            for(var i=start_index;i<=end_index;i++){
               $('.student_idea'+i).show();
            }
         }
      });
      $('#student_right_menu').click(function(){
         var index_area = $('.student_idea_ans').length;
         var page_increment = 2;
         var page_index = $('#student_page_index').val();
         var new_page_index = parseInt(page_index)+1;
         
         var start_index = (page_index*page_increment)+1;
         var end_index = (new_page_index*page_increment);
         if(start_index<=index_area){
            $('#student_page_index').val(new_page_index);
            $('.student_idea_ans').hide();
            for(var i=start_index;i<=end_index;i++){
               $('.student_idea'+i).show();
            }
         }
      });

      $('#tutor_left_menu').click(function(){
         var page_increment = 2;
         var page_index = $('#tutor_page_index').val();
         if(page_index>1){
            var new_page_index = parseInt(page_index)-1;
            $('#tutor_page_index').val(new_page_index);
            var start_index = (new_page_index*page_increment)-1;
            var end_index = (new_page_index*page_increment);
            $('.tutor_idea_ans').hide();
            for(var i=start_index;i<=end_index;i++){
               $('.tutor_idea'+i).show();
            }
         }
      });

      $('#tutor_right_menu').click(function(){
         var index_area = $('.tutor_idea_ans').length;
         var page_increment = 2;
         var page_index = $('#tutor_page_index').val();
         var new_page_index = parseInt(page_index)+1;
         
         var start_index = (page_index*page_increment)+1;
         var end_index = (new_page_index*page_increment);
         if(start_index<index_area){
            $('#tutor_page_index').val(new_page_index);
            $('.tutor_idea_ans').hide();
            for(var i=start_index;i<=end_index;i++){
               $('.tutor_idea'+i).show();
            }
         }
      });

      $('#tutor_idea_next').click(function(){
         $('#show_question_idea_tutor').modal('hide');
         $('#tutor_idea_marking').modal('show');
      });

      $('.student_mark_submit').click(function(){
         var student_ans = $('input[name="st_mark"]:checked').val();
         var idea_id = $(this).attr('data-idea');
         var question_id = $(this).attr('data-question');
         var idea_point = $(this).attr('data-point');
         if(student_ans!=''){
            var get_point = 0;
            if(student_ans==idea_point){
               get_point = 10;
            }
           
            $.ajax({
               url: "Student/students_get_point_save",
               method: "POST",
               enctype: 'multipart/form-data',
               data: {
                  idea_id: idea_id,
                  question_id: question_id,
                  get_point:get_point,
               },
               cache: false,
               dataType: 'json',
               success: function(data) {
                  if(data!=2){
                     $('.get_point_message').show();
                     $('.student_point_check').hide();
                     $('.saved_point_show').text(get_point);

                     if(student_ans==1){
                        var st_ans_text = 'Average';
                     }else if(student_ans==2){
                        var st_ans_text = 'Good';
                     }else if(student_ans==3){
                        var st_ans_text = 'Excelent';
                     }

                     if(idea_point==1){
                        var idea_ans_src = 'assets/images/average_img.png';
                        var idea_ans_text = 'Average';
                     }else if(idea_point==2){
                        var idea_ans_src = 'assets/images/good_img.png';
                        var idea_ans_text = 'Good';
                     }else if(idea_point==3){
                        var idea_ans_src = 'assets/images/excelent_img.png';
                        var idea_ans_text = 'Excelent';
                     }
                     $('.tutor_point_ans_text').text(idea_ans_text); 
                     $('.tutor_point_icon').attr('src',idea_ans_src); 
                     $('.student_point_ans_text').text(st_ans_text);
                  }else{
                     alert("Submited Already !");
                  }
                   
               }
            });
             
         }else{
           alert('Please Select an option !');
         }
      });

   </script>