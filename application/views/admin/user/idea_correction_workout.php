<?php foreach($student_ans_details as $idea_details){?>
   <div class="" style="margin-left: 15px;">
   <div class="row">
      <div class="col-md-12">
         <div class="ss_student_board">
            <div class="ss_s_b_top">
               <div class="ss_index_menu ">
                  <a href="#">Details</a>
               </div>
               <div class="col-sm-6 ss_next_pre_top_menu"> 
                  <a class="btn btn_next" href=" "  id="draw" onclick="showDrawBoard()" data-toggle="modal" data-target=".bs-example-modal-lg">
                  Workout <img src="assets/images/icon_draw.png">
                  </a>
               </div>
            </div>
            <div class="container-fluid">
               <div class="row">
                  <div class="ss_s_b_main" style="min-height: 100vh">
                     <div class="col-sm-6">
                        <div class="workout_menu" style=" padding-right: 15px;">
                           <ul>
                              <?php if($idea_details['large_ques_body']!=''){?>
                              <li><a style="cursor:pointer" id="show_questions">Question<i>(Click Here)</i></a></li>
                              <?php }?>
                              <li><a style="cursor:pointer" id="show_questions"><i>Instruction</i></a></li>
                              <li><a style="cursor:pointer; background: red; color: #fff;" id="show_question"> Idea <?=$idea_details['idea_no']?></a></li>
                           </ul>
                        </div>
                        <div class="top_textprev">
                           <?php if($idea_details['shot_question_title']!=''){ ?>
                              <button class="btn btn-profile">“<?=$idea_details['shot_question_title'];?>”</button>
                           <?php } 
                           if($idea_details['short_ques_body']!=''){?>
                           <p><b>Requirement</b></p>
                           <p><?=$idea_details['short_ques_body'];?></p>
                           <?php }?>
                        </div>


                        <div class="rs_word_limt">
                        	 <div class="top_word_limt">
                        	 	<span id="display_count"><?=$idea_details['total_word']?></span>&nbsp;Words
                        	 	<span class="m-auto"><input class="form-control text-center" type="text" value="<?=$idea_details['time_hour']?>:<?=$idea_details['time_min']?>:<?=$idea_details['time_sec']?>" name=""></span>
                        	 	<span class="m-auto"> Word Limit</span>
                        	 	<span class="m-auto b-btn"><?=$idea_details['word_limit']?></span>
                        	 </div>
                        	 <div class="btm_word_limt">
                        	 	<div class="content_box_word" id="add_textarea">
                        	 		<textarea id="word_count" class="form-control preview_main_body mytextarea" name="preview_main_body"><?=$idea_details['student_ans']?></textarea>
                        	 	</div>
                        	 </div>
                        </div>
                     </div>
                     <div class="col-sm-2"></div>
                     <div class="col-sm-4">
                        <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                           <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingOne">
                                 <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  
                                    <span>Module Name: Lesson 2</span></a>
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
                                                      5														
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
                                                <tr>
                                                   <td>
                                                      <a href="check_student_copy/194/754/2/2023">
                                                      <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                      </a>
                                                   </td>
                                                   <td style="">
                                                      2														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <!-- obtained -->
                                                   <td>
                                                      <a class="text-center" onclick="showModalDes(2);">
                                                      <img src="assets/images/icon_details.png">
                                                      </a>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <a href="check_student_copy/194/754/3/2023">
                                                      <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                      </a>
                                                   </td>
                                                   <td style="">
                                                      3														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <!-- obtained -->
                                                   <td>
                                                      <a class="text-center" onclick="showModalDes(3);">
                                                      <img src="assets/images/icon_details.png">
                                                      </a>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <a href="check_student_copy/194/754/4/2023">
                                                      <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                      </a>
                                                   </td>
                                                   <td style="">
                                                      4														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <!-- obtained -->
                                                   <td>
                                                      <a class="text-center" onclick="showModalDes(4);">
                                                      <img src="assets/images/icon_details.png">
                                                      </a>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <a href="check_student_copy/194/754/5/2023">
                                                      <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                      </a>
                                                   </td>
                                                   <td style="">
                                                      5														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <!-- obtained -->
                                                   <td>
                                                      <a class="text-center" onclick="showModalDes(5);">
                                                      <img src="assets/images/icon_details.png">
                                                      </a>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <a href="check_student_copy/194/754/6/2023">
                                                      <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                      </a>
                                                   </td>
                                                   <td style="">
                                                      6														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <!-- obtained -->
                                                   <td>
                                                      <a class="text-center" onclick="showModalDes(6);">
                                                      <img src="assets/images/icon_details.png">
                                                      </a>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <a href="check_student_copy/194/754/7/2023">
                                                      <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                      </a>
                                                   </td>
                                                   <td style="">
                                                      7														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <!-- obtained -->
                                                   <td>
                                                      <a class="text-center" onclick="showModalDes(7);">
                                                      <img src="assets/images/icon_details.png">
                                                      </a>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <a href="check_student_copy/194/754/8/2023">
                                                      <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                      </a>
                                                   </td>
                                                   <td style="">
                                                      8														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <!-- obtained -->
                                                   <td>
                                                      <a class="text-center" onclick="showModalDes(8);">
                                                      <img src="assets/images/icon_details.png">
                                                      </a>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <a href="check_student_copy/194/754/9/2023">
                                                      <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                      </a>
                                                   </td>
                                                   <td style="">
                                                      9														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <!-- obtained -->
                                                   <td>
                                                      <a class="text-center" onclick="showModalDes(9);">
                                                      <img src="assets/images/icon_details.png">
                                                      </a>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <a href="check_student_copy/194/754/10/2023">
                                                      <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                      </a>
                                                   </td>
                                                   <td style="">
                                                      10														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <!-- obtained -->
                                                   <td>
                                                      <a class="text-center" onclick="showModalDes(10);">
                                                      <img src="assets/images/icon_details.png">
                                                      </a>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <a href="check_student_copy/194/754/11/2023">
                                                      <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                      </a>
                                                   </td>
                                                   <td style="">
                                                      11														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <!-- obtained -->
                                                   <td>
                                                      <a class="text-center" onclick="showModalDes(11);">
                                                      <img src="assets/images/icon_details.png">
                                                      </a>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <a href="check_student_copy/194/754/12/2023">
                                                      <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                      </a>
                                                   </td>
                                                   <td style="">
                                                      12														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <td>
                                                      5														
                                                   </td>
                                                   <!-- obtained -->
                                                   <td>
                                                      <a class="text-center" onclick="showModalDes(12);">
                                                      <img src="assets/images/icon_details.png">
                                                      </a>
                                                   </td>
                                                </tr>
                                                <tr style="background-color: #99D9EA;">
                                                   <td colspan="2">Total</td>
                                                   <td colspan="1">60</td>
                                                   <td colspan="1">60</td>
                                                   <td colspan="1"></td>
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
<input type="hidden" name="student_id" id="student_id" value="<?=$idea_details['student_id']?>">
<input type="hidden" name="idea_id" id="idea_id" value="<?=$idea_details['idea_id']?>">
<input type="hidden" name="idea_no" id="idea_no" value="<?=$idea_details['idea_no']?>">
<input type="hidden" name="admin_id" id="admin_id" value="<?=$admin_id?>">
<input type="hidden" name="question_id" id="question_id" value="<?=$idea_details['question_id']?>">
<input type="hidden" name="module_id" id="module_id" value="<?=$idea_details['module_id']?>">
</div>


<div  class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="show_question_body">
  <!-- Modal -->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
         
         <div class="btm_word_limt p-3">
             <div>
                <button type="button" id="close_idea" class=" pull-right" data-dismiss="modal">x</button>
             </div>
            <br> <hr>
            <?=$idea_details['large_ques_body']?>
            <div class="text-center p-3">
            <button type="button" id="close_idea" class="btn btn-info pull-right" data-dismiss="modal">Close</button>
            </div>
         </div> 
    </div>
  </div>
</div>
<?php }?>

<!-- jquery ui dialog -->
<div id="dialog" title="Basic dialog" class="my-drawing"></div>
<div id="wiris_dialog"><p></div>

<style type="text/css">
 .no-close .ui-dialog-titlebar-close {
    display: none;
  }
  @media (min-width: 1000px){
#show_question_idea_profile .modal-dialog{
   width: 800px;
}
}
    .top_word_limt{
    	background: #d9edf7;
    	padding: 8px 10px;
    	display: flex;
    	flex-wrap: wrap;
    	align-items: center;
    }
    .m-auto{
    	margin-left: auto;
    }
    .b-btn{
    	background: #0079bc;
    	padding: 5px 10px;
    	border-radius: 5px;
    	color: #fff;
    }
    .btm_word_limt .content_box_word{
    	border-radius: 5px;
    	border: 1px solid #82bae6;
    	margin: 10px 0;
    	padding: 10px;
    	width: 100%;
    	box-shadow: 0px 0px 10px #d9edf7;
    }
    .btm_word_limt .content_box_word u{
    	color: #888;
    }
    .btm_word_limt .content_box_word span{
    	color: #888;
    }
    .btm_word_limt .content_box_word p{
    	margin-top: 10px;
    }
    .frist_time_user_mid_con_mes strong{
   color: #ff7f27;
}

.frist_time_user_mid_con_mes a{
   color: #00c1f7;
   display: inline-block;
}
.frist_time_user_mid_con a{
   display: inline-block;
}
.frist_time_user_mid_con label{
   margin-bottom: 6px;
}
.frist_time_user_mid_con .image_box{
   border: 1px solid #00c1f7;
   height: 100px;
   width: 100px;
   margin: 10px auto;
   background: #d9d9d9;
}

.clik_point{
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
.clik_point_detatis{
   display: inline-flex;
   justify-content: center;
   align-items: center;
   padding: 20px 0px;
}
.clik_point_detatis .clik_point{
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
.clik_point_detatis_tutor .your_achived_point{
   max-width: 200px;
   margin: auto;
}
#topicstory_tutor .btm_word_limt {
   min-height: 300px;
   padding: 30px;
}
.your_achived_point{
   border: 1px solid #015f4e;
    padding: 15px;
    text-align: center;
    margin: 10px;
    background: #f4f5f9;
}
.your_achived_point button{
   padding: 7px 15px;
   color: #fff;
   background: #015f4e;
   border: 0;
   border-radius: 5px;
   margin-top: 10px;
}
.w-50{
       width: 70px;
    display: inline-block;
}
.profile_right_ida{
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
.profile_right_ida u{
   color: #7f7f7f;
}
.profile_right_ida .btn-primary{
   margin-bottom: 5px;
   background: #fff;
   color: #333;
   padding: 6px 15px;
   border-radius: 0;
   line-height: 16px;
   border: 1px solid #c3c3c3;
}
.profile_right_ida .btn-primary:hover{
   background: #a349a4;
   color: #fff;
   padding: 6px 15px;
   border-radius: 0;
   line-height: 16px;
}

#show_question_idea_profile table{
   font-size: 13px;
}
.profile_right_ida_bottom {
   padding:0 10px;
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
.profile_right_ida_bottom .table tbody tr > td {
    text-align: center;
    padding: 4px 10px;
    color: #ed1c24;
}
.profile_right_ida_bottom .table tbody tr {
    background: #e6eed5;
    border-bottom: 20px solid #fff;
}
.profile_right_ida_bottom .table input{
   margin: 0;
}

.profile_right_ida_bottom .table tbody tr > td:first-child {
    text-align: left;
    color: #76923c;
    font-weight: bold;
}
.profile_right_ida_bottom .table input[type=checkbox]:focus
      {
          outline: none;
      }

  .profile_right_ida_bottom .table input[type=checkbox]
   {
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

   .profile_right_ida_bottom .table input[type=checkbox]:checked
   {
      border: 1px solid #ed1c24;
       background-color: #ed1c24;
       background: #ed1c24 url("data:image/gif;base64,R0lGODlhCwAKAIABAP////3cnSH5BAEKAAEALAAAAAALAAoAAAIUjH+AC73WHIsw0UCjglraO20PNhYAOw==") 3px 3px no-repeat;
       background-size: 8px;
   } 
@media (min-width: 1000px){
#show_question_idea_profile .modal-dialog{
   width: 800px;
}
}
  #show_question_idea_profile{
      overflow-y: scroll;
   }
.profile_left_ida table{
   margin-top: 10px;
}
.profile_left_ida table tr td{
   border: none;
   padding: 0;
   color: #7f7f7f;
   font-size: 13px;
}
.p-3{
   padding: 15px;
}
.ss_modal .modal-content {
    border: 1px solid #a6c9e2;
    padding: 0;
    margin: 0;
}
.top_textprev{
   padding-bottom: 20px;
}
.top_textprev h4{
   color: #7f7f7f;
   font-size: 16px;
   font-weight: bold;
}
.top_textprev .btn{
   background: #9c4d9e;
   border-radius: 0;
   border: none;
   color: #fff;
   padding: 8px 20px;
   margin-top: 10px;
   margin-bottom: 20px;
}
.top_textprev h6{
   color: #000;
   font-size: 14px;
   font-weight: bold;
}
.workout_menu{
   height: initial;
}
.workout_menu ul{
   margin-bottom: 20px;
   display: flex;
   align-items: end;
   flex-wrap: wrap;
}
.workout_menu ul > div{ 
   margin-bottom: 10px;
}
    .top_word_limt{
    	background: #d9edf7;
    	padding: 8px 10px;
    	display: flex;
    	flex-wrap: wrap;
    	align-items: center;
    }
    .m-auto{
    	margin-left: auto;
    }
    .b-btn{
    	background: #0079bc;
    	padding: 5px 10px;
    	border-radius: 5px;
    	color: #fff;
    }
    #login_form .modal-dialog, .ss_modal .modal-dialog {
       max-width: 100%;
   }
    .btm_word_limt .content_box_word{
    	border-radius: 5px;
    	border: 1px solid #82bae6;
    	margin: 10px 0;
    	padding: 10px;
    	width: 100%;
    	box-shadow: 0px 0px 10px #d9edf7;
      margin-top: 0 !important;
    }
    .btm_word_limt .content_box_word u{
    	color: #888;
    }
    .btm_word_limt .content_box_word span{
    	color: #888;
    }
    .btm_word_limt .content_box_word p{
    	margin-top: 10px;
    }
    .ss_modal .modal-dialog{
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
    transform: translate( 0%, 0%) !important;
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
.mclose{
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
jquery ui
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
<!-- dependency: React.js -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-with-addons.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-dom.js"></script>

<script src="http://localhost/qstudy/assets/js/html2canvas/html2canvas.js"></script>
<script src="http://localhost/qstudy/assets/js/literallycanvas/js/literallycanvas.js"></script>
<link rel="stylesheet" href="http://localhost/qstudy/assets/js/literallycanvas/css/literallycanvas.css">
<!-- html2canvas -->
<!-- <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>-->
<script src="assets/js/html2canvas/html2canvas.js"></script>

<!-- wiris demo editor-->
<!-- <script src="https://www.wiris.net/demo/editor/editor"></script> -->
<script src="assets/js/wiris_editor.js"></script>

<script type="text/javascript">
    $(document).ready(function()
   {
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
     $("#show_questions").on("click", function () {       
       $modal = $('#show_question_idea'); 
       $modal.modal('hide');
       $modal2 = $('#show_question_body'); 
       $modal2.modal('show');
      });
   });
  var lc;
  function showDrawBoard(){

    //dialog open
    $( "#dialog" ).dialog({
    title: "Drawing Board",
    dialogClass: "no-close",
    height: 670,
    width: 870,
    buttons: [
      {
        text:"Close",
        icon: "ui-icon-heart",
        click: function() {
          //lc.teardown();
          $( this ).dialog( "close" );
        }
      },
    //   {
    //     text:"Get Question",
    //     //id:"getQues",
    //     click: function() {
    //       getQues();
    //     }
    //   },
      {
        text:"Save",
        click: function() { 
         // location.href = 'tutor/idea_create_student_report'; 
          //lc.teardown();
          setAnswer();
       
          
          $( this ).dialog( "close" );
        }
      },
    ]
    });


    lc = LC.init(//canvas init
        document.getElementsByClassName('my-drawing')[0],
        {
         imageURLPrefix: "http://localhost/qstudy/assets/js/literallycanvas/img",
         tools: LC.defaultTools.concat([MyTool]),
       });


       var unsubscribe = lc.on('drawingChange', function() {
       });
//unsubscribe();  // stop listening
        getQues();
     }

  /*custom literallycanvas tool*/
  var MyTool = function(lc) {  // take lc as constructor arg
    var self = this;

    return {
    usesSimpleAPI: false,  // DO NOT FORGET THIS!!!
    name: 'Math',
    iconName: 'formula',
    strokeWidth: lc.opts.defaultStrokeWidth,
    optionsStyle: 'stroke-width',
    didBecomeActive: function(lc) {
      editor = com.wiris.jsEditor.JsEditor.newInstance({'language': 'en'});
      editor.insertInto(document.getElementById('wiris_dialog'));
      $('.wrs_container').attr('id', 'id_added');
      $('#wiris_dialog').dialog({
        height: 350,
        width: 550,
        hide: { effect: "slideUp", duration: 1000 }, 
        //position: { my: "top", at: "right", of: 'window' }, 
        buttons: [
        {
          text:"Close",
          icon: "ui-icon-heart",
          click: function() {
            //lc.teardown();
            $( this ).dialog( "close" );
          }
        },
        {
          text:"Ok",
          click: function() {
          //lc.teardown();
          console.log(editor.getMathML());
          getWirisEqn();
          $( this ).dialog("option", "hide");
        }
      },
      ]
    });


    },
    willBecomeInactive: function(lc) {
      console.log('inactive');
    },
  }//end return
}//end function


  function setAnswer(){
     
    try {
        var imageData = (lc.getImage().toDataURL('image/png'));
      }
      catch(err) {
        lc.tool.commit(lc);
        var imageData = (lc.getImage().toDataURL('image/png'));
      }
      var student_id= $("#student_id").val();
      var idea_id= $("#idea_id").val();
      var idea_no= $("#idea_no").val();
      var admin_id= $("#admin_id").val();
      var question_id= $("#question_id").val();
      var module_id= $("#module_id").val();
      
    $.ajax({
    type: 'POST',
    url: 'admin/admin_workout_save',
    data: {
      imageData: imageData,student_id:student_id,idea_id:idea_id,idea_no:idea_no,admin_id:admin_id,question_id:question_id,module_id:module_id,
    },
    dataType: 'html',
      success: function (results) {

         location.href = 'admin/idea_create_student_report/'+results; 
     
   
      }
    });
    
  }
  //get question(modal button) activity
  $(document).on('click', '#getQues', function(){
    html2canvas(document.querySelector("#add_textarea")).then(canvas => {
      var img = new Image();
      img.src = canvas.toDataURL();
      lc.saveShape(LC.createShape('Image', {x: 100, y: 100, image: img}));
      //console.log(canvas.toDataURL('image/png'));
    });
  });

  function getQues() {
   
    html2canvas(document.querySelector("#add_textarea")).then(canvas => {
      var img = new Image();
      img.src = canvas.toDataURL();
      lc.saveShape(LC.createShape('Image', {x: 10, y: 10, image: img}));
      //console.log(canvas.toDataURL('image/png'));
    });
  }

  function getWirisEqn() {
    html2canvas(document.querySelector("#id_added")).then(canvas => {
      var img = new Image();
      img.src = canvas.toDataURL();
      console.log(img);
      lc.saveShape(LC.createShape('Image', {x: 100, y: 100, image: img}));
    });
  }
  
</script>