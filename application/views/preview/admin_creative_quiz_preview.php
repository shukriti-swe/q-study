<style>
   .rs_word_limt .top_word_limt>div {
      flex-basis: 0;
      -webkit-box-flex: 1;
      -ms-flex-positive: 1;
      flex-grow: 1;
      max-width: 100%;
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

   .tutor_ans_modal {
      max-height: 300px;
      overflow-y: auto;
   }

   .b-btn {
      display: inline-block;
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

   .workout_menu img.calculator-trigger {
      margin-top: 0;
      margin-bottom: 0;
      width: 30px;
      height: 39px;
   }
</style>

<?php
// echo "<pre>"; print_r($idea_info); die();
?>

<div class="" style="margin-left: 15px;">
   <div class="row">
      <div class="col-md-12">
         <div class="ss_student_board">
            <div class="ss_s_b_top">
               <div class="ss_index_menu ">
                  <a href="#">Details</a>
               </div>
               <div class="col-sm-6 ss_next_pre_top_menu">
                  <a class="btn btn_next" href="<?php echo base_url('Admin/idea_create_student_report') ?>">
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

                              <?php if ($idea_info[0]['large_ques_body'] != '') { ?>
                                 <li><a style="cursor:pointer" id="detail_question">Detail Question </a></li>
                              <?php } ?>

                              <?php if ($idea_info[0]['large_question_allow'] != 0) { ?>
                                 <li><a style="cursor:pointer" id="show_questions"> Question(Click here) </a></li>
                              <?php } ?>

                              <!-- <li><a  href="javascript:;"  data-toggle="modal" data-target="#show_question_idea"> Idea 1</a></li> -->

                              <?php

                              if ($idea_info[0]['allow_idea'] == 1) {
                                 $j = 1;
                                 foreach ($idea_description as $ideas) {
                              ?>

                                    <li class="idea_start_action"><a style="background: white; color:black;border: 1px solid #ddd7d7;" href="javascript:;" data-id="<?= $ideas['question_id']; ?>,<?= $ideas['idea_no']; ?>" data-index="<?= $ideas['id']; ?>" data-toggle="modal" data-target="#show_question_idea_tutor" class="idea_title_modal"><?= $ideas['idea_name'] ?></a></li>
                                 <?php $j++;
                                 } ?>



                                 <div class="idea_start_action">
                                    <a href="javascript:;" data-toggle="modal">
                                       <i class="fa fa-address-card edit-card" style="font-size:43px;"></i>
                                    </a>
                                 </div>

                                 <div class="idea_start_action"><a href="javascript:;"><i class="fa fa-users" style="font-size:38px;margin-left:5px;color:rgb(251, 136, 54);"></i></a></div>
                                 <div class="idea_start_action"><a style="cursor:pointer;" id="show_question"><img src="assets/images/icon_a_left.png"></a></div>
                                 <div class="idea_start_action"><a style="cursor:pointer;" id="show_question"><img src="assets/images/icon_a_right.png"></a></div>

                              <?php } ?>
                           </ul>
                        </div>
                        <div class="top_textprev">



                           <?php

                           date_default_timezone_set($this->site_user_data['zone_name']);
                           $module_time = time();

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

                           $question_time_limit = $hour . ':' . $minute . ':' . $second;

                           $question_time_in_second = ($hour * 3600) + ($minute * 60) + $second;


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

                           <?php }

                           if ($idea_info[0]['image_ques_body'] != '') { ?>
                              <p><?= $idea_info[0]['image_ques_body']; ?></p>

                           <?php } ?>


                        </div>
                        <div class="rs_word_limt">
                           <div class="top_word_limt">
                              <div>
                                 <?php if ($idea_info[0]['word_limit'] != 0) : ?>
                                    <span id="display_count">0</span> &nbsp;Words
                                 <?php endif; ?>

                                 <input id="total_word" type="hidden" value="">


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
                                 $time_show = $get_hour . ':' . $get_min . ':' . $get_sec;
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
                                 <div class="m-auto" style="padding-left: 20px;text-align:right;"><b>Word Limit </b><b class="b-btn"><?= $idea_info[0]['word_limit']; ?></b></div>
                              <?php } ?>


                           </div>
                           <div class="btm_word_limt">
                              <div class="content_box_word">

                                 <div class="text-center">

                                    <input id="question_id" type="hidden" name="question_id" value="<?= $idea_info[0]['question_id'] ?>">
                                    <input id="idea_id" type="hidden" name="idea_id" value="<?= $idea_info[0]['id'] ?>">

                                    <textarea id="word_count" class="form-control preview_main_body mytextarea" name="preview_main_body" onpaste="return false;" onCopy="return false" onCut="return false">

                                    <?php if ($idea_info[0]['student_title'] == 1) {

                                       if (!empty($idea_info[0]['time_hour']) || !empty($idea_info[0]['time_min']) || !empty($idea_info[0]['time_sec'])) { ?>
                                       <elem id="time_image"><img  class="image-editor" style="padding-left: 20%;" data-height="250" data-width="200" height="179" src="<?= base_url() ?>/assets/images/pv1.jpg" width="281" /></elem>

                                    <?php }
                                    } ?>

                                    </textarea>

                                 </div>
                              </div>
                              <div class="text-center">
                                 <?php if ($idea_info[0]['add_start_button'] != 0) { ?>
                                    <button class="btn btn_next" type="button" id="idea_start">Start</button>
                                 <?php } ?>
                                 <button id="answer_matching" class="btn btn_next" type="button">Submit </button>
                                 <!-- <button id="answer_matching" class="btn btn_next" type="button"  data-toggle="modal" data-target="#alert_times_up">Submit </button>  -->
                              </div>
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
                                       <span>Module Name: Every Sector</span></a>
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
                                                <tr>
                                                   <td>
                                                      <a href="check_student_copy/194/754/1/2023">
                                                         <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                      </a>
                                                   </td>
                                                   <td style="background-color: #99D9EA;">
                                                      1
                                                   </td>
                                                   <td>
                                                      25
                                                   </td>
                                                   <td>
                                                      5
                                                   </td>
                                                   <!-- obtained -->
                                                   <td>
                                                      <a class="text-center" onclick="showModalDes(1);">
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
               </div>
            </div>
         </div>
      </div>
   </div>
   <br>
   <br>
</div>

<form id="answer_form">
   <!-- modal idea -->
   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="show_question_idea">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">


            <div class="mclose" data-dismiss="modal">x</div>


            <div class="btm_word_limt">
               <div class="content_box_word">
                  <p><strong>Here One Example</strong></p>
                  <p>When meat is usually t----- and juicy, it is easily digested. However, this word is also used to describe a soft-hearted person. For instance, Sam’s mother is always warm and t----- towards him</p>
                  <p>The meat was so t _ _ _ _ _ that I managed to cut through it very easily.</p>
               </div>
               <div class="created_name">
                  <img src="assets/images/icon_created.png"> <a href="javascript:;" id="topicstory"> <u>Topic/Story Created By :</u> </a> &nbsp; Lubna
               </div>
            </div>




         </div>
      </div>
   </div>
   <!-- modal idea show_question_idea  tutor -->
   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="show_question_idea_tutor">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">


            <div class="mclose" data-dismiss="modal">x</div>

            <div class="btm_word_limt">
               <div class="content_box_word tutor_ans_modal">
                  <p class="idea_preview_ans">When meat is usually t----- and juicy, it is easily digested. However, this word is also used to describe a soft-hearted person. For instance, Sam’s mother is always warm and t----- towards him</p>
                  <p>The meat was so t _ _ _ _ _ that I managed to cut through it very easily.</p>
               </div>
               <div class="created_name">
                  <img src="assets/images/icon_created.png"> <a href="javascript:;" data-toggle="modal" data-target="#topicstory_tutor"> <u>Topic/Story Created By :</u> </a> &nbsp; <b class="tutor_name">Tutor</b>
               </div>
            </div>




         </div>
      </div>
   </div>




   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="show_detail_question">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="btm_word_limt p-3">
               <div>
                  <button type="button" id="close_idea" class=" pull-right" data-dismiss="modal">x</button>
               </div>
               <br>
               <hr>
               <?= $idea_info[0]['large_ques_body']; ?>
               <div class="text-center p-3">
                  <button type="button" id="close_idea" class="btn btn-info pull-right" data-dismiss="modal">Close</button>
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
               <input type="hidden" name="pre_idea_no" id="pre_idea_no" value="">
               <input type="hidden" name="pre_tutor_id" id="pre_tutor_id" value="">
               <input type="hidden" name="pre_question_id" id="pre_question_id" value="">
               <input type="hidden" name="pre_module_id" id="pre_module_id" value="">
               <input type="hidden" name="pre_idea_id" id="pre_idea_id" value="">
               <p>Tutor(<b class="tutor_name">name</b>)</p>
               <p><u>Topic/Stoty Title</u></p>
               <p class="blue">"New Environment"</p>
               <p> Created: &nbsp; &nbsp; <span id="tutor_submit_date">06/08/2021</span></p>
               <div class="clik_point"><i class="fa fa-thumbs-up" aria-hidden="true"></i></div>

               <div class="clik_point_detatis_tutor">
                  <div class="clik_point_detatis">
                     Total Number Of Like <div class="clik_point">33</i></div>
                  </div>
                  <br>
                  <div class="your_achived_point">
                     Your Achived points <br>
                     <button>15</button>
                  </div>
               </div>


            </div>



         </div>
      </div>
   </div>

   <!-- modal idea profile -->
   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="show_question_idea_profile">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">


            <div class="mclose" data-dismiss="modal">x</div>
            <div class="row">
               <div class="col-sm-4">
                  <div class="p-3 profile_left_ida">
                     <div class="text-center">
                        <img src="assets/images/pp.jpg">
                     </div>
                     <table class="table" border="0">
                        <tbody>
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
                              <td>Austrolia</td>
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
                        Submited by "Linda" <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user_checks">Check</button> Edited by "Tutor" <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tutor_checks"> Check</button>
                     </p>
                  </div>

               </div>
            </div>

            <div class="row">
               <div class="col-sm-4">
                  <div class="your_achived_point">
                     Your Achived points <br>
                     <button>15</button>
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
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                           </tr>
                           <tr>
                              <td>Creativity</td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="" checked=""> 4
                              </td>
                              <td>
                                 <input type="checkbox" name="" checked=""> 3
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                           </tr>
                           <tr>
                              <td>Grammar/Spelling</td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="" checked=""> 5
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                           </tr>
                           <tr>
                              <td>Vocabulary</td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="" checked=""> 3
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                           </tr>
                           <tr>
                              <td>Clarity</td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                              <td>
                                 <input type="checkbox" name="">
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="profile_right_ida">
                     <p>
                        Your grade <button type="button" class="btn btn-primary">Check</button> <input type="number" class="form-control w-50" name=""> Tutor Grade <button type="button" class="btn btn-primary">Check</button> <input type="number" class="form-control w-50" name="">
                     </p>
                     <div class="text-center">
                        <br>
                        <button class="btn btn_next">Submit</button>
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
               <div class="content_box_word">
                  <p><strong>Here One Example</strong></p>
                  <p>When meat is usually t----- and juicy, it is easily digested. However, this word is also used to describe a soft-hearted person. For instance, Sam’s mother is always warm and t----- towards him</p>
                  <p>The meat was so t _ _ _ _ _ that I managed to cut through it very easily.</p>
               </div>

            </div>

         </div>
      </div>
   </div>
   <!-- modal user_checks -->
   <div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="frist_time_user">
      <!-- Modal -->
      <div class="modal-dialog" role="document">
         <div class="modal-content">


            <div class="btm_word_limt p-3">
               <div>
                  <button type="button" class="btn btn-profile">Edit</button>
                  <button type="button" id="close_idea" class="btn btn-info pull-right" data-dismiss="modal">Close</button>
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
                           <input type="text" class="form-control" value="Linda" name="">
                        </div>
                        <div class="form-group">
                           <label>School Name <a href="">Optional</a></label>
                           <input type="text" class="form-control" value="" name="">
                        </div>
                        <div class="form-group">
                           <label>Country</label>
                           <input type="text" class="form-control" value="Aus" name="">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="text-center">
                           <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                           <p>Chose Photo to Upload</p>
                           <p><a href="">(Optional)</a></p>
                        </div>
                        <div class="image_box"></div>
                     </div>
                  </div>
               </div>
               <hr>
               <div class="text-center p-3">
                  <button type="submit" class="btn btn_next">Submit & Proceed</button>
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
                     <div class="col-sm-8">
                        <p><strong>Here One Example</strong></p>
                        <p> When meat is usually t----- and juicy, it is easily digested. However, this word is also used to describe a soft-hearted person. For instance, Sam’s mother is always warm and t----- towards him</p>
                        <p>The meat was so t _ _ _ _ _ that I managed to cut through it very easily.</p>
                     </div>
                     <div class="col-sm-4">
                        <img src="assets/images/42_Everyday Study.png" class="img-responsive">
                     </div>
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
               <button type="button" id="preview_success" class="btn btn_blue" data-dismiss="modal">Ok</button>
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
         <div class="modal-content">

            <div class="modal-header">
               <h4>Topic/Story Title</h4>
            </div>

            <div class="modal-body">

               <div class="d-flex idea_modal_textarea">
                  <textarea id="idea_title_text_get" class="form-control idea_title_text" name="idea_title_text23"></textarea>
               </div>



            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn_blue ideabtnclose">save</button>
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

   <div class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="idea_title_failed">
      <!-- Modal -->
      <div style="max-width: 20%; top: 20% !important; transform: translate(-50%, -50%) !important;" class="modal-dialog" role="document">
         <div class="modal-content">

            <div class="modal-body">
               <p><i class="fa fa-pencil" style="font-size:28px;color:#f5d743;"></i></p>
               <p>Please Write Idea title first!!</p>

            </div>
            <div class="modal-footer">
               <button type="button" id="preview_success" class="btn btn_blue" data-dismiss="modal">Ok</button>
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
         border: 1px solid #ed1c24;
         background-color: #ed1c24;
         background: #ed1c24 url("data:image/gif;base64,R0lGODlhCwAKAIABAP////3cnSH5BAEKAAEALAAAAAALAAoAAAIUjH+AC73WHIsw0UCjglraO20PNhYAOw==") 3px 3px no-repeat;
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
      $("#answer_matching").hide();

      $(function() {
         var ideaInfo = "<?= $idea_info[0]['student_title'] ?>";
         if (ideaInfo == 0) {
            // alert('showing');
            $('#answer_matching').show();
            $('#idea_start').hide();
            $('.idea_start_action').hide();

            <?php if ($question_time_in_second != 0) { ?>
               takeDecesionForQuestion();
            <?php } ?>

         }
      });

      $("#detail_question").on("click", function() {
         $("#show_detail_question").modal('show');
      });

      $("#topicstory").on("click", function() {
         $modal = $('#show_question_idea');
         $modal.modal('hide');
         $modal2 = $('#show_question_idea_profile');
         $modal2.modal('show');
      });

      $("#close_idea").on("click", function() {
         $modal = $('#show_question_idea_profile');
         $modal.modal('show');
      });

      $('.clik_point_detatis_tutor').hide();
      $(".clik_point").on("click", function() {
         $('.clik_point_detatis_tutor').show();
         $('.clik_point').hide();
      });


      $("#idea_start").on("click", function() {

         <?php if ($question_time_in_second != 0) { ?>
            takeDecesionForQuestion();
         <?php } ?>

         $('#answer_matching').show();
         $('#idea_start').hide();
         $('.idea_start_action').hide();

         //  if(idea_no!=''){

         var ideaInfo = "<?= $idea_info[0]['student_title'] ?>";
         if (ideaInfo != 0) {
            var idea_title = "Title";
            text = '<p style="text-align:center;text-decoration:underline;"><b>Idea/Topic/Story title</b></p><p style="text-align:center;color:#fb8836f0;"><b>"' + idea_title + '"</b>&#9999;&#65039;</p><p></p>';
         } else {
            text = '';
         }

         CKEDITOR.instances.word_count.on('paste', function(evt) {
            evt.cancel();
         });
         CKEDITOR.instances.word_count.setData(text);

         <?php if ($idea_info[0]['student_title'] == 1) { ?>
            $modal2 = $('#idea_title_show');
            $modal2.modal('show');
         <?php } ?>

      });


      CKEDITOR.on('instanceReady', function(evt) {


         // console.log(evt.editor.getData());
         evt.editor.on('focus', function(event) {
            var getData = evt.editor.getData();
            var setData = getData.replace("<p>Start write here...</p>", " ");
            evt.editor.setData(setData);
         });
      });


      $(".ideabtnclose").on("click", function() {

         var idea_title = $(".idea_title_text").val();
         if (idea_title == '') {
            $modal2 = $('#idea_title_failed');
            $modal2.modal('show');
         } else {
            $modal2 = $('#idea_title_show');
            $modal2.modal('hide');
            text = '<p style="text-align:center;text-decoration:underline;"><b>Idea/Topic/Story title</b></p><p style="text-align:center;color:#fb8836f0;"><b style="font-size:18px;">"' + idea_title + '"</b>&nbsp;&#9999;&#65039;</p><br><p>Start write here...</p>';

            CKEDITOR.instances.word_count.setData(text);
         }

      });

      //    =====
      $("#show_questions").on("click", function() {
         $modal = $('#show_question_idea');
         $modal.modal('hide');
         $modal2 = $('#show_question_body');
         $modal2.modal('show');
      });

      $(".idea_title_modal").on("click", function() {

         var idea_id = $(this).attr("data-index");
         var idea = $(this).attr("data-id");
         var html = '<textarea  class="form-control idea_title_text mytextarea" name="idea_title_text' + idea_id + '"></textarea>';
         $(".idea_modal_textarea").html(html);
         $(".idea_title_modal").css('background', 'none');
         $(this).css('background', '#f1e7b5');

         <?php if ($idea_info[0]['student_title'] == 1) { ?>
            //  $modal2 = $('#idea_title_show'); 
            //  $modal2.modal('show');
         <?php } ?>
         $.ajax({
            url: "get_preview_idea_info",
            method: "POST",
            data: {
               idea: idea
            },
            dataType: 'json',
            success: function(data) {

               //const student_ans = data['student_ans'].replace(/(<([^>]+)>)/gi, "");

               $('.tutor_name').text(data['name']);
               //$('.tutor_ans_modal').text(student_ans);
               $('.tutor_ans_modal').html(data['student_ans']);

               $('#pre_idea_no').val(data['idea_no']);
               $('#pre_tutor_id').val(data['tutor_id']);
               $('#pre_question_id').val(data['question_id']);
               $('#pre_idea_id').val(data['idea_id']);
            }
         });

      });
      $(".clik_point").on("click", function() {
         var question_id = $("#pre_question_id").val();
         var idea_id = $("#pre_idea_id").val();
         var idea_no = $("#pre_idea_no").val();
         var tutor_id = $("#pre_tutor_id").val();
         var module_id = 0;
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


               if (data.insert_or_update == 1) {
                  alert('like added');
               } else {
                  alert('allready like added');
               }
               $(".clik_point").text(data.total_like);
               $('.clik_point_detatis_tutor').show();
               $('.clik_point').hide();
            }

         })
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
            // alert('hi');
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
                  var idea_answer = CKEDITOR.instances['word_count'].getData();
                  var question_id = $('#question_id').val();
                  var idea_id = $('#idea_id').val();

                  $.ajax({
                     type: 'POST',
                     url: 'Admin/save_answer_idea',
                     data: {
                        idea_answer: idea_answer,
                        question_id: question_id,
                        idea_id: idea_id,
                     },
                     dataType: 'html',
                     success: function(results) {
                        // console.log(results);

                        if (results == 1) {
                           $('#idea_save_success').modal('show');
                        } else if (results == 0) {

                        }
                     }
                  });
               }
            } else {
               var idea_answer = CKEDITOR.instances['word_count'].getData();
               var question_id = $('#question_id').val();
               var idea_id = $('#idea_id').val();

               $.ajax({
                  type: 'POST',
                  url: 'Admin/save_answer_idea',
                  data: {
                     idea_answer: idea_answer,
                     question_id: question_id,
                     idea_id: idea_id,
                  },
                  dataType: 'html',
                  success: function(results) {
                     // console.log(results);

                     if (results == 1) {
                        $('#idea_save_success').modal('show');
                     } else if (results == 0) {

                     }
                  }
               });
            }


         });


         $("#preview_success").click(function() {
            <?php $send = $_SERVER['HTTP_REFERER']; ?>
            var redirect_to = "<?php echo $send; ?>";
            // window.location = redirect_to;
            window.location.reload();
         });


      });
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

            $('#times_up_message').modal('show');
            $('#question_reload').click(function() {
               location.reload();
            });

            //   $.ajax({
            //       type: 'POST',
            //       url: 'IDontLikeIt/save_answer_idea',
            //       data: {
            //          idea_answer: idea_answer,
            //          question_id: question_id,
            //          idea_id: idea_id,
            //       },
            //       dataType: 'html',
            //       success: function (results) {
            //           if (results == 1) {
            //               $('#idea_save_success').modal('show');
            //           } else if (results == 0) {


            //           }
            //       }
            //   });
            h1.textContent = "EXPIRED";
         }
      }

      function takeDecesionForQuestion() {

         var exact_time = $('#exact_time').val();

         var now = $('#now').val();
         var opt = $('#optionalTime').val();
         //   alert(opt);

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
   </script>