<style>
  .ss_q_btn {
    margin-top: 21px;
  }

  .checkbox,.form-group{
    display: block !important;
    margin-bottom: 10px !important;
  }

  .form-control {
    width: 100% !important;
  }

  .createQuesLabel{
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
  .question_tutorial:hover{
        background: transparent !important;
    }
    .sss_ans_set{
        position: absolute;bottom: -158px;width: 30%;margin-top: 16px;
    }
</style>



<div id="add_ch_success" style="text-align:center;"></div>

<form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data">
  <input type="hidden" id="question_item" name="questionType" value="<?php echo $question_item; ?>">
  <div class="row" >
    <div class="col-sm-1"></div>
    <div class="col-sm-11 ">
      <div class="ss_question_add_top">

        <p id="error_msg" style="color:red"></p>

        <div class="form-group" style="float: left;margin-right: 10px;">
          <label for="exampleInputName2">Grade/Year/Level</label>
          <select class="form-control createQuesLabel" name="studentgrade">
            <option value="">Select Grade/Year/Level</option>
            <?php $grades = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]; ?>
            <?php foreach ($grades as $grade) { ?>
              <option value="<?php echo $grade ?>">
                <?php echo $grade; ?>
              </option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group" style="float: left;margin-right: 10px;">
          <label>Subject 
            <span data-toggle="modal" data-target="#add_subject"><img src="assets/images/icon_new.png"> New</span> 
          </label>
          
          <select class="form-control createQuesLabel subject select2" name="subject" id="subject" onchange="getChapter(this)">
            <option value="">Select Subject</option>
            <?php foreach ($all_subject as $subject) { ?>
              <option class="option" value="<?php echo $subject['subject_id'] ?>">
                <?php echo $subject['subject_name']; ?>
              </option>
            <?php } ?>
          </select>
          
        </div>

        <div class="form-group" style="float: left;margin-right: 10px;">
          <label>Chapter <span id="get_subject"><img src="assets/images/icon_new.png"> New</span></label>
          <select class="form-control createQuesLabel select2" name="chapter" id="subject_chapter">
            <option value="">Select Chapter</option>
          </select>
        </div>
        
                
        <div class="form-group" style="float: left;margin-right: 10px;">
          <label>Country</label>
          <select class="form-control createQuesLabel select2" name="country" id="quesCountry">
            <option value="">Select Country</option>
            <?php foreach ($allCountry as $country) : ?>
                <?php $sel = strlen($selCountry)&&($country['id']==$selCountry) ? 'selected' : ''; ?>
              <option value="<?php echo $country['id'] ?>" <?php echo $sel; ?>><?php echo $country['countryName'] ?></option>
            <?php endforeach ?>  
          </select>
        </div>


        <?php if (!empty($for_disable_button)) { ?>
          <a disabled class="ss_q_btn btn btn_red pull-left ">
          Question setting
          </a>
        <?php }else{ ?>
          <a class="ss_q_btn btn btn_red pull-left " onclick="open_question_setting()">
          Question setting
          </a>
        <?php } ?>
        
        <input type="submit" name="submit" class="btn btn-danger ss_q_btn " value="Save"/> 

        <a class="ss_q_btn btn pull-left " href="#"><i class="fa fa-remove" aria-hidden="true"></i> Cancel</a>
        
        <a class="ss_q_btn btn pull-left " href="" id="preview_btn" style="display: none;">
          <i class="fa fa-file-o" aria-hidden="true"></i> Preview
        </a>
               <!-- <?php if ($question_item == 4) {?>
              <a class="btn btn-danger ss_q_btn question_tutorial" title="You can click when edit a question." href="#" disabled="disabled" style="text-decoration: underline;font-size: medium; font-weight: 600;">

                  <img src="<?php echo base_url('/')?>assets/images/question_tutorial_icon.png" width="46">
              </a>
          <?php }?> -->

          <?php if ($question_item == 4) {?>
            <a class="btn btn-danger ss_q_btn question_tutorial pull-left" style="text-decoration: underline;border: none;font-size: medium; font-weight: 600;">
                Tutorial Image <div class="uploadsMsg_"> </div>
            </a>
            
        <?php }?>
      </div>

    </div>

  </div>
  <div class="row">
    <div class="ss_question_add" style="margin-top: 1px;">
     <div class="ss_s_b_main" style="min-height: 100vh">

     <style>
  .ss_q_btn {
    margin-top: 21px;
  }

  .checkbox,.form-group{
    display: block !important;
    margin-bottom: 10px !important;
  }

  .form-control {
    width: 100% !important;
  }

  .createQuesLabel{
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
  .question_tutorial:hover{
        background: transparent !important;
    }
    .sss_ans_set{
        position: absolute;bottom: -158px;width: 30%;margin-top: 16px;
    }
</style>



 
 <div class="row">
   <div class="col-sm-12">
     <div class="idea_setting_mid">
      <div class="form-group" style="float: left;margin-right: 10px;">
      <input type="checkbox" name="short_question_allow" value="1" <?php  if($idea_details[0]['short_question_allow']==1){echo "checked";}?>> <label id='shot_question_box'>   <img src="assets/images/icon_new.png"> New
          </label>
            <div>
              <button type="button" class="btn btn-select active">Short Question</button>
            </div> 
         </div>
         <div class="form-group" style="justify-content: center;float: left;margin-right: 10px;">
            <!-- <label><input type="checkbox" name=""> </label><a id="large_question" type="button"><img src="assets/images/icon_new.png"> New</a>  -->
            <input type="checkbox" name="large_question_allow" value="1" <?php  if($idea_details[0]['large_question_allow']==1){echo "checked";}?>> <label id='large_question'>   <img src="assets/images/icon_new.png"> New
          </label>
            <!-- <label id='large_question_box'> <input type="checkbox" name="">   <img src="assets/images/icon_new.png"> New
          </label> -->
            <div>
              <button type="button" class="btn btn-select ">Large Question</button>
            </div> 
         </div>
         <div class="form-group" style="float: left;margin-right: 10px;"> 
            <div>
              <button type="button" class="btn btn-select  ">Student Title <input type="checkbox" name="student_title" value="1" <?php  if($idea_details[0]['student_title']==1){echo "checked";}?>></button>
            </div> 
         </div>
          <div class="form-group text-center" style="float: left;margin-right: 10px;">
            <label>  <span> Word Limit</span> </label> 
               <select class="form-control w-50" id="word_limit_set" name="word_limit">
              
                <option value="30" <?php  if($idea_details[0]['word_limit']==30){echo "selected";}?>>30</option>
                <option value="50" <?php  if($idea_details[0]['word_limit']==50){echo "selected";}?>>50</option>
                <option value="100" <?php  if($idea_details[0]['word_limit']==100){echo "selected";}?>>100</option>
                <option value="200" <?php  if($idea_details[0]['word_limit']==200){echo "selected";}?>>200</option>
                <option value="300" <?php  if($idea_details[0]['word_limit']==300){echo "selected";}?>>300</option>
                <option value="400" <?php  if($idea_details[0]['word_limit']==400){echo "selected";}?>>400</option>
                <option value="500" <?php  if($idea_details[0]['word_limit']==500){echo "selected";}?>>500</option>
              </select>  
         </div>
         <div class="form-group text-center" style="float: left;margin-right: 10px;">
            <label>  <span> Time To Answer</span> </label>
            <div class="d-flex">
               <input type="text" id="time_hour" class="form-control w-50" name="time_hour" value="<?=$idea_details[0]['time_hour']?>">
               <input type="text" id="time_min" class="form-control w-50" name="time_min" value="<?=$idea_details[0]['time_min']?>">
               <input type="text" id="time_sec" class="form-control w-50" name="time_sec" value="<?=$idea_details[0]['time_sec']?>">
            </div> 
         </div>
         <div class="form-group text-center" style="float: left;margin-right: 10px;">
            <label>  <span> Allow Ideas</span> </label>
            <div style="height:34px">
               <input type="checkbox" name="allow_idea" value="1" <?php  if($idea_details[0]['allow_idea']==1){echo "checked";}?>>
            </div> 
         </div>
         <div class="form-group text-center" style="float: left;margin-right: 10px;">
            <label>  <span> Add start button</span> </label>
            <div style="height:34px">
               <input type="checkbox" name="add_start_button" value="1" <?php  if($idea_details[0]['add_start_button']==1){echo "checked";}?>>
            </div> 
         </div>

    </div>

    <div class="idea_setting_mid_bottom">

     <div class = "all_idea">
      <?php $i=1; 
      if(!empty($all_idea)){
      foreach($all_idea as  $ideas){?>
          <div class="form-group" style="float: left;margin-right: 10px;">
            <?php if($i==1){?>
            <label data-toggle="modal" data-target="#newidea"> <span><img src="assets/images/icon_new.png"> New</span> </label>
             <?php }?>
            <div>

              <input type="hidden" name="idea_name" value="idea<?=$i;?>">
              <input type="hidden" name="idea_details[]" value="<?=$ideas['id'];?>,<?=$ideas['idea_title'];?>,<?=$ideas['question_description'];?>">

              <button type="button" class="btn btn-select-border color_change idea<?=$i;?>" onclick="showIdea(<?=$i;?>)">Idea <?=$i;?></button>
            </div> 
         </div>
         <?php $i++; }
         }else{ ?>
         <div class="form-group" style="float: left;margin-right: 10px;">
         
            <label data-toggle="modal" data-target="#newidea"> <span><img src="assets/images/icon_new.png"> New</span> </label>
            
            <div>
              
              <?php foreach($idea_description as $ideas){?>
                <button id="idea1" class="btn btn-select-border"<?php if($idea_no==$ideas['idea_no']){echo "style='background:#fb8836f0;'";}?>>Idea-<?=$ideas['idea_no']?> </button>

                <?php }?>
            </div> 
         </div>
        <?php }
         
         ?>

         <!-- <div class="form-group" style="float: left;margin-right: 10px;"> 
            <div>
              <button class="btn btn-select-border">Idea 2</button>
            </div> 
         </div>
         <div class="form-group" style="float: left;margin-right: 10px;"> 
            <div>
              <button class="btn btn-select-border">Idea 3</button>
            </div> 
         </div>
         <div class="form-group" style="float: left;margin-right: 10px;"> 
            <div>
              <button class="btn btn-select-border">Idea 4</button>
            </div> 
         </div>
         <div class="form-group" style="float: left;margin-right: 10px;"> 
            <div>
              <button class="btn btn-select-border">Idea 4</button>
            </div> 
         </div> -->
        </div>
         
         <div class="form-group" style="float: left;margin-right: 10px;">
          <img src="assets/images/quiz_list.png">
         </div>
         <div class="form-group" style="float: left;margin-right: 10px;">
          <img src="assets/images/quiz_list.png">
         </div>
         <div class="form-group" style="float: left;margin-right: 10px;">
          <img src="assets/images/quiz_arrow.png">
         </div>
         <div class="form-group" style="float: left;margin-right: 10px;">
          <img src="assets/images/quiz_arrow_r.png">
         </div>
         <div class="form-group" style="float: left;margin-right: 10px;"> 
            <div>
              <button type="button" class="btn btn-select question_title">Question Title </button>
            </div> 
         </div>
         <div class="form-group" style="float: left;margin-right: 10px;"> 
            <div>
              <button type="button" class="btn btn-select idea_title">Idea Title</button>
            </div> 
         </div>
         <div class="form-group" style="float: left;margin-right: 10px;"> 
            <div>
              <img src="assets/images/search_a.png" id="advance_searc_op">
            </div> 
         </div>
      
    </div>
    <div class="row">
      <div class="col-md-6" style="margin-top: 15px;">
         <div class="rs_word_limt">
               <div class="top_word_limt">
                <span id="word_show">90 Words</span>
                <span style="margin:0 auto;" class="m-auto"><input id="time_show" class="form-control text-center" type="text" value="00:05:00" name=""></span>
                <span class="m-auto word_limit_show"> Word Limit <span class="m-auto b-btn word_limit_number_show">100</span></span>
             
               </div>
               <div class="btm_word_limt"style="margin-top: 30px;">
                <div class="content_box_word">
                <?php foreach($idea_description as $ideas){?>
                  <?php if($ideas['idea_no']==$idea_no){ ?>
                    <textarea class="form-control idea_main_body mytextarea" name="idea_main_body"><?=$ideas['idea_question'];?></textarea>
                    <?php } }?>
                </div>
               </div>
            </div>
      </div>
      <div class="col-md-6">
    	 <div id="advance_allowonline">
    		<div class="idea_setting_mid flex-end" >
    			<div class="form-group text-center" style="float: left;margin-right: 10px; margin-bottom: 0">
		            <label>  <span> Allow Online</span> </label>
		            <div style="height:34px">
		            	 <input type="checkbox" value="1" name="allow_online">
		            </div> 
		         </div>
		         <div class="form-group text-center" style="float: left;margin-right: 10px; margin-bottom: 0;">
		            <label>  <span> Serial No:</span> </label>
		            <div style="height:34px">
		            	 <select class="form-control" id="serial_no_idea" name="serial">
                   <option value="">Select one</option>
                     <?php for($i=1;$i<10;$i++){?>
		            	 	<option value="<?=$i;?>"><?=$i;?></option>
                     <?php }?>
		            	 </select>
		            </div> 
		         </div>
    		</div>
    		<div class="btm_word_limt">
        	 	<div class="content_box_word">
               <?=$student_ans[0]['student_ans']?>
        	 	</div>
        	 	<div class="created_name">
        	 		<img src="assets/images/icon_created.png"> <a href="<?php echo base_url('Admin/idea_view_student_report/'.$student_ans[0]['student_id'].'/'.$student_ans[0]['idea_id'].'/'.$student_ans[0]['idea_no']) ?>"> <u>Topic/Story Created By :</u> </a> &nbsp; <?=$student_ans[0]['name'];?>
        	 	</div>
        	 </div>
        	</div>

        	<div id="advance_searc_content">
        		<div class="serach_list"> 
					<div class="input-group">
				      <input type="search" class="form-control" placeholder="Search" name="search" id="advance_searc_content_src">
				      <div class="input-group-btn">
				        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				      </div>
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
  
<br/>

</div>
</div>
</div>
</div>
</div>
</div>

<?php if ($question_item == 11) {?>
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
<?php }?>

</div>
</div>
</div>


<!--Set Question Solution on jquery ui-->
<div id="dialog">
  <textarea  id="setSolution" style="display:none;"></textarea>
</div>
<input type="hidden" name="question_solution" id="setSolutionHidden" value="">


<!--Set Question Solution modal-->
<!--   <div class="modal fade ss_modal" id="set_solution" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="max-width: 400px;">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">Solution</h4>
      </div>
      <div class="modal-body row">
        <textarea class="mytextarea" name="question_solution"></textarea>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div> -->
 
<!-- </form> -->



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


<!-- <div class="modal fade ss_modal" id="ss_sucess_mess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <img src="assets/images/icon_info.png" class="pull-left"> <span class="ss_extar_top20">Save Sucessfully</span> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div> -->

<!--Add Chapter Modal-->
<!-- 
<div class="modal fade ss_modal" id="add_chapter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add Chapter</h4>
      </div>
      <div id="chapter_error"></div>
      
      <div class="modal-body">
        <form class="" id="add_subject_wise_chapter">

          <div class="form-group">
            <label for="attached_subject"></label>
            <input type="hidden" class="form-control" name="attached_subject" id="attached_subject">
          </div>
          <div class="form-group">
            <label for="chapter">Chapter Name</label>
            <input class="form-control" name="chapter" id="chapter">
          </div>

         </form> -->
      <!-- </div>
      
      <div class="modal-footer">
        <button type="button" onclick="add_chapter()" class="btn btn_blue">Save</button>
        <button type="button" class="btn btn_blue" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div> -->

<!--Add Subject Modal-->

<!-- <div class="modal fade ss_modal" id="add_subject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add New Subject</h4>
      </div>
      <form class="" id="add_subject_name">
        <div class="modal-body">
          <div class="form-group">
            <label>Add Subject</label>
            <input type="text" class="form-control wordSearch" name="subject_name">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" onclick="add_subject()" class="btn btn_blue">Save</button>
          <button type="button" class="btn btn_blue" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div> --> -->

 

<!-- shot_question -->

<div class="modal fade ss_modal " id="shot_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div style="background-color: #e1cbcb;" class="modal-content">
     
      <div class="modal-header">
        <h4 style="background-color: #e1cbcb; color:#4732e9"> Short Question 

            <button style="float: right; color:black;background-color: #e1cbcb;border:none;" type="button" class="btnclose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </h4>
        
      </div>

      <form class="">
        <div class="modal-body">
           <div id="checkbox_titlelimitidea_alert">
              <div>
                   Number of writing task submited on this topic &nbsp; <input class="form-control w-50 idea_number" type="text" value="50"  name="">
              </div>
             
            </div>
          <div class="d-flex">
            <input type="checkbox" name="" id="checkbox_titlelimitidea"> &nbsp;
            <div class="form-group">
              <label style="color:#4732e9">Title</label>
              <input type="text" id="short_title" class="form-control shot_question_title " name="shot_question_title" readonly="" maxlength="50">
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
                   Number of writing task submited on this topic &nbsp; <input class="form-control w-50 idea_number" type="text" value="50"  name="">
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
    <div  style="background-color: #e1cbcb;" class="modal-content">
     
      <div class="modal-header">
        <h4 style="background-color: #e1cbcb; color:#4732e9">Idea

            <button style="float: right; color:black;background-color: #e1cbcb;border:none;" type="button" class="ideabtnclose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
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
              <label style="color:#4732e9">Idea/Topic/Story Title</label>
              <input type="text" id="idea_title" class="form-control shot_question_title " name="idea_question_title" readonly="" maxlength="50">
            </div>
          </div> 
         

        </div>
        <!-- <div class="modal-footer"> 
          <button type="button" class="btn btn_blue ideabtnclose" data-dismiss="modal">Cancel</button>
        </div> -->
      <!-- </form> -->
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
        
        <h6 style="text-align:center;">   Question </h6>

            <button style="color:black;border:none;margin-left: auto;order: 2;" type="button" class="close_idea" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            
            </div>
          <div class="row">
            
             <textarea id="idea_ques_body" class="form-control mytextarea" name="idea_question_body"></textarea>

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
        <a href="#" style="color:black; text-decoration: underline;padding-right:100px;">Short Question</a>
        <h6 style="display: flex;">   Question </h6>

            <button style="color:black;border:none;margin-left: auto;order: 2;" type="button" class="close_ch" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            
            </div>
          <div class="row">
            
             <textarea id="short_ques_body" class="form-control mytextarea" name="short_ques_body"></textarea>

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
<div class="modal fade ss_modal " id="large_question_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
   
    <!-- <form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data"> -->
  
        <div style="background-color: #eee;" class="modal-body">
        <div style="display: flex;">
        <a href="#" style="color:black; text-decoration: underline;padding-right:100px;">Large Question</a>
        <h6 style="display: flex;">   Question </h6>

            <button style="color:black;border:none;margin-left: auto;order: 2;" type="button" class="close_ch" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            
            </div>
          <div class="row">
            
             <textarea id="large_ques_body" class="form-control mytextarea" name="large_ques_body"></textarea>

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

  .created_name{
  background: #66afe9;
  color: #fff;
  font-size: 16px;
  padding: 10px 20px;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
}
.created_name a{
  color: #fff;
}
.created_name img{
  max-width: 30px;
  margin-right: 10px;
}
.flex-end{
  justify-content: flex-end;
}
  .d-flex{
    display: flex;
  }
  .w-50{
    width: 50px !important;
  }
  .idea_setting_mid_bottom{
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
  .ss_question_add_top label, .idea_setting_mid label, .idea_setting_mid_bottom label{
    margin-bottom: 6px;
  }
  .idea_setting_mid {
    margin-top: 5px;
    display: flex;
    align-items: flex-end;
    flex-wrap: wrap;
  }
    .ss_q_btn { 
    margin-top: 22px;
    margin-bottom: 10px;
  }
  .btn-select{
    background: #a9a8a8;
    color: #fff;
    box-shadow: none !important;
    border-radius: 0;
  }
  .btn-select:hover, .btn-select.active{
    background: #00a2e8;
    color: #fff;
  }
  .btn-select-border{
    background: #fff;
    color: #000;
    box-shadow: none !important;
    border-radius: 0;
    border: 1px solid #ddd9c3;
  }
  .btn-select-border:hover, .btn-select-border.active{
    background: #ddd9c3;
    color: #fff;
  }
  .idea_setting_mid_bottom .btn-select:hover, .idea_setting_mid_bottom .btn-select.active{
    background: #ff7f27;
    color: #fff;
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
      background: #9c4d9e;
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
    #shot_question .modal-content, .ss_modal .modal-content {
      border: 1px solid #a6c9e2;
      padding: 5px;
  }
  .ss_modal .form-group label{
    margin-bottom: 5px;
  }
  .ss_modal .modal-dialog{
    max-width: 100%;
  }
  .ss_modal .form-group input{
     height: 34px;
  }
 .ss_modal .modal-header {
    background: url(assets/images/login_bg.png) repeat-x;
    color: #fff;
    padding: 0;
    border-radius: 5px;
}
#advance_searc_op{
  cursor: pointer;
}
#advance_searc_content{
  display: none;
}
.content_box_word{
  min-height: 300px;
}
.serach_list .input-group{
      width: 100%;
}
.d-flex{
  display: flex; 
  align-items: center;
}
.ss_modal .form-group{
  width: 100%;
}
#checkbox_titlelimit_alert, #checkbox_titlelimitidea_alert{
  display: none;
}
#checkbox_titlelimit_alert > div, #checkbox_titlelimitidea_alert > div{
  flex-wrap: wrap;
  align-items: center;
  padding: 15px 0px;
  color: #ff0000;
   display: flex;
   justify-content: flex-end;
}
#checkbox_titlelimit_alert, #checkbox_titlelimit_large_alert{
  display: none;
}
#checkbox_titlelimit_alert > div, #checkbox_titlelimit_large_alert > div{
  flex-wrap: wrap;
  align-items: center;
  padding: 15px 0px;
  color: #ff0000;
   display: flex;
   justify-content: flex-end;
}
#shot_question_details{
  overflow: auto;
}
#shot_question_details .col-sm-4{
  width: 100%;
}
#shot_question_details.ss_modal .modal-dialog{
  margin-top: 6%;
}
</style>
<script type="text/javascript"> 

   $(".word_limit_show").hide();
   $(".word_limit_number_show").hide();
   $("#time_show").hide();

   function showIdea(select_id){
    $.ajax({
          url: "get_idea",
          type: "POST",
          data: {select_id:select_id},
          success: function (response) {
     
            var data = JSON.parse(response);
            console.log(data);
            var idea_id = data[0].id;
            var idea_description = data[0].question_description;
            console.log(idea_id);
            
            $(".color_change ").css('background', 'none');
            $(".idea_main_body ").val(idea_description);
            $( ".idea"+idea_id ).css('background', '#fb8836f0');
            $('#search_view').hide();
            
          }

          });
  
      
   }

$(document).ready(function(){


  $(".question_title").click(function(){
    $("#advance_allowonline").toggle();
    $("#advance_searc_content").toggle();
  });

  $(".idea_title").click(function(){
    $("#advance_allowonline").toggle();
    $("#advance_searc_content").toggle();
  });

  
  

  $("#advance_searc_content_src").keyup(function(){
    var search_text = $(this).val();
    // alert(search_text);
    $.ajax({
          url: "search_idea",
          type: "POST",
          data: {search_text:search_text},
          success: function (response) {
     
            var data = JSON.parse(response);
            console.log(data);

            html ='';

             
            for(i=0;i<data.length;i++){
              // alert(data[i].id);
              //  alert(data[i].idea_title);
              html +='<br><a class="search_button" type="button"  onclick="showIdea('+data[i].id+')">'+data[i].idea_title+'</a>';


            }

            $('#search_view').html(html);

            // var idea_id = data[0].id;
            // var idea_description = data[0].question_description;
            // console.log(idea_id);
            
            // $(".color_change ").css('background', 'none');
            // $(".idea_main_body ").val(idea_description);
            // $( ".idea"+idea_id ).css('background', '#fb8836f0');
            
            
          }

          });

  });
  

  // $(".idea_number").change(function(){

  //   var total = $(this).val();
  //   var html ='';
  

  //   for(i=1; i<=total;i++){

  //     if(i==1){
  //      var add_button='<label data-toggle="modal" data-target="#newidea"> <span><img src="assets/images/icon_new.png"> New</span> </label>';
  //     }else{
  //       add_button='';
  //     }
  //     html +='<div class="form-group" style="float: left;margin-right: 10px;">'+add_button+'<div><button id="idea1" class="btn btn-select-border">Idea '+i+'</button></div></div>';
      
  //   }
  //   $('#all_idea').html(html);
  // });


   $("#word_limit_set").change(function(){
    var word_limit= $("#word_limit_set").val();
    $(".word_limit_number_show").text(word_limit);
    $(".word_limit_number_show").show();
    $(".word_limit_show").show();
   });

   $("#large_question").click(function(){
    $('#largequestion').modal('show'); 
   });
   
   $("#time_hour").keyup(function(){

    var hour = $("#time_hour").val();
    
    var min = parseInt($("#time_min").val());
    if(isNaN(min)){
      min = 0;
    }
    if(min==''){
      var min =0;
    }
    if(min<=60){
      
    }else{
      alert("It should be equal or less than 60");
      min=00;
      $("#time_min").val('00');
    }
    var sec= parseInt($("#time_sec").val());
    if(isNaN(sec)){
      sec = 0;
    }
    if(sec<=60){
      
    }else{
      alert("It should be equal or less than 60");
      sec=00;
      $("#time_sec").val('00');
    }
    var time= hour+':'+min+':'+sec;
    $("#time_show").val(time);
    $("#time_show").show();
   });


 
                    
   $("#time_min").keyup(function(){

    var hour = $("#time_hour").val();
    var min = parseInt($("#time_min").val());
    if(isNaN(min)){
      min = 0;
    }
    if(min<=60){
      
    }else{
      alert("It should be equal or less than 60");
      min=00;
      $("#time_min").val('00');
    }
    var sec= parseInt($("#time_sec").val());
    if(isNaN(sec)){
      sec = 0;
    }
    if(sec<=60){
      
    }else{
      alert("It should be equal or less than 60");
      sec=00;
      $("#time_sec").val('00');
    }
    var time= hour+':'+min+':'+sec;
    $("#time_show").val(time);
    $("#time_show").show();
    });

    $("#time_sec").keyup(function(){

    var hour = $("#time_hour").val();
    var min = parseInt($("#time_min").val());
    if(isNaN(min)){
      min = 0;
    }
    if(min==''){
      var min =0;
    }
    if(min<=60){
      
    }else{
      alert("It should be equal or less than 60");
      min='00';
      $("#time_min").val('00');
    }
    var sec= parseInt($("#time_sec").val());
    if(isNaN(sec)){
      sec = 0;
    }
    if(sec<=60){
      
    }else{
      alert("It should be equal or less than 60");
      sec=00;
      $("#time_sec").val('00');
    }
    var time= hour+':'+min+':'+sec;
    $("#time_show").val(time);
    $("#time_show").show();
    });
   
    });

  


    

  $(function () {
      $("#checkbox_titlelimit").click(function () {
          if ($(this).is(":checked")) {
              $("#checkbox_titlelimit_alert").show();
              $(".shot_question_title").removeAttr("readonly");
          } else {
              $("#checkbox_titlelimit_alert").hide();
              $(".shot_question_title").attr('readonly', true);
          }
      });
  });
  $(function () {
      $("#checkbox_titlelimitidea").click(function () {
          if ($(this).is(":checked")) {
              $("#checkbox_titlelimitidea_alert").show();
              $(".shot_question_title").removeAttr("readonly");
          } else {
              $("#checkbox_titlelimitidea_alert").hide();
              $(".shot_question_title").attr('readonly', true);
          }
      });
  });
  $(function () {
      $("#checkbox_titlelimitidea_large").click(function () {
          if ($(this).is(":checked")) {
              $("#checkbox_titlelimit_large_alert").show();
              $(".large_question_title").removeAttr("readonly");
          } else {
              $("#checkbox_titlelimit_large_alert").hide();
              $(".large_question_title").attr('readonly', true);
          }
      });
  });
 
 

  
  // $('#large_question_box').click(function(){
  //     $modal = $('#large_question');
  //     $('#large_question').modal('show'); 
      
  // });
 
 $('.close_idea').click(function(){


    
    var idea_title = $('#idea_title').val();
    var question_description = $('#idea_ques_body').val();
    // alert(idea_title);
    // alert(question_description);
    $.ajax({
          url: "save_idea",
          type: "POST",
          data: {idea_title:idea_title,question_description:question_description},
          success: function (response) {
         
            var html = '';
            var data = JSON.parse(response);
            console.log(data);
            var idea_id = data[0].id;
            var idea_title = data[0].idea_title;
            var idea_description = data[0].question_description;
            console.log(idea_id);
     

            if(idea_id==1){
              var html2 = '<label data-toggle="modal" data-target="#newidea"> <span><img src="assets/images/icon_new.png"> New</span> </label>';
            }else{
              var html2='';
            }
            $( ".color_change" ).css('background', 'none');
            var html = '<div class="form-group" style="float: left;margin-right: 10px;">'+html2+'<div><input type="hidden" name="idea_name[]" value="idea'+idea_id+'"><input type="hidden" name="idea_details[]" value="'+idea_id+','+idea_title+','+idea_description+'"><button style="background:#fb8836f0;" class="btn btn-select-border color_change idea'+idea_id+'" type="button" onclick="showIdea('+idea_id+')">Idea '+idea_id+'</button></div></div>';
            
           
              

            $(".idea_main_body").val(idea_description);
            
            if(idea_id==1){
              $('.all_idea').html(html);
            }else{
              $('.all_idea').append(html);
            }
            
          }

          });
     
 });


  $('.btnclose').click(function(){
    //$('#shot_question_box input').prop('checked',false);
      $modal = $('#shot_question_details');
      $('#shot_question_details').modal('show');

      var short_body = $('#short_title').val();
      var text= '<p><b>Write about the topic bellow :</b></p>"'+short_body+'"&#9999;&#65039;';
      $('#short_ques_body').val(text);

    });
    $('.largebtnclose').click(function(){
    //$('#shot_question_box input').prop('checked',false);
      $modal = $('#large_question_details');
      $('#large_question_details').modal('show'); 



      var large_body = $('#large_title').val();
      
      var text= '<p><b>Write about the topic bellow :</b></p>"'+large_body+'"&#9999;&#65039;';
      $('#large_ques_body').val(text);

    });

    $('#shot_question_box').click(function(){
      $modal = $('#shot_question');
      $('#shot_question').modal('show'); 
    });


  $('.ideabtnclose').click(function(){
  //$('#shot_question_box input').prop('checked',false);
     $modal = $('#idea_question_details');
     $('#idea_question_details').modal('show'); 



    var idea_body = $('#idea_title').val();
    var text= '"'+idea_body+'"&#9999;&#65039;<br>';
 
    $('#idea_ques_body').val(text);

   });
 

  $("#serial_no_idea").on("change", function () {        
      $modal = $('#login_form');
      if($(this).val() === '1'){
          $modal.modal('show');
      }
  });
  $(document).ready(function(){
    $("#advance_searc_op").click(function(){
      $("#advance_allowonline").toggle();
      $("#advance_searc_content").toggle();
    });
   
  });
  $( function() {
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
    // $( "#advance_searc_content_src" ).autocomplete({

    //   source: availableTags
    // });
  } );
 
  function setSolution() {
    //$("#set_solution").modal('show');
    $( "#dialog" ).dialog({
      height: 400,
      width: 600,
      buttons: [
      {
        text:"Close",
        icon: "ui-icon-heart",
        click: function() {

          $( this ).dialog( "close" );
        }
      },
      {
        text:"Save",
        click: function() {
          var solution = ($('#setSolution').val());
          ($('#setSolutionHidden').val(solution));
          $( this ).dialog( "close" );
        }
      }
      ]
    });
    $('#setSolution').ckeditor({
      height: 200,
      extraPlugins : 'simage,ckeditor_wiris',
      filebrowserBrowseUrl: '/assets/uploads?type=Images',
      filebrowserUploadUrl: 'imageUpload',
      toolbar: [
      { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
      { name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
      '/',
      { name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'addFile'] }, 
      '/',
      { name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
      { name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
      ],
      allowedContent: true
    });
  }
</script>




        
        
      <div class="col-sm-4">
       <div class="panel-group ss_edit_q" id="raccordion" role="tablist" aria-multiselectable="true" style="display: none;">
        <div class="panel panel-default">
         <div class="panel-heading" role="tab" id="headingOne" style="padding: 0;">
          <h4 class="panel-title">
           <a> 
            <label class="form-check-label" for="question_time">Question Time</label> 
            <input type="checkbox" id="question_time" name="question_time">  
            Calculator Required <input type="checkbox" name="isCalculator" value="1"> 
            <!-- Score <input type="checkbox" name=""> -->
            <?php if ($this->session->userdata('userType') == 7) : ?>
              <strong style="text-decoration: underline; cursor:pointer;" data-toggle="modal" data-target="#ss_instruction_model">Instruction</strong>
              <strong style="text-decoration: underline; cursor:pointer;" data-toggle="modal" data-target="#ss_video_model">Video</strong>
            <?php endif; ?>
          </a>
        </h4>
      </div>

      <div id="collapsethree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

        <div class="panel-body">
         <div class=" ss_module_result">
          <p>Module Name:</p>
          <div class="table-responsive">
           <table class="table table-bordered">
            <thead>    
             <tr>
              <th></th>
              <th>SL</th>
              <th>Mark</th>
              <!--<th>Obtained</th>-->
              <th>Description / Video </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td> </td>
              <td>1</td>
              <input type="hidden" class="form-control" id="marks_value" name="questionMarks" value="">
              <td onclick="setMark()" class="inner" id="marks">
                <img src="assets/images/icon_mark.png" id="mark_icon">
              </td>
              <!--<td>5.0</td>-->
              <td style="text-align: center;">
                <a data-toggle="modal" data-target="#ss_description_model" class="text-center" style="display: inline-block;">
                  <img src="assets/images/icon_details.png">
                </a>
              
                <a data-toggle="modal" data-target="#ss_video_model" class="text-center" style="display: inline-block;">
                  <img src="/assets/ckeditor/plugins/svideo/icons/svideo.png">
                </a>

              </td>
            </tr>
          </tbody>
        </table>

      </div>
      <!-- Modal -->
      <div class="modal fade ss_modal ew_ss_modal" id="ss_description_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
       <div class="modal-dialog" role="document">
        <div class="modal-content">
         <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
        </div>
        <div class="modal-body">
          <textarea class="form-control" name="questionDescription"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
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
          <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
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
  <!-- End Instruction Modal -->
  <p><strong> Time To Answer:</strong></p>
  <!--<form class="form-inline ss_common_form" id="set_time" style="display: none">-->
    <div class="form-inline" id="set_time" style="display: none">
     <div class="form-group" style="display: inline-block !important;">
      <select class="form-control" name="hour">
       <option>HH</option>
        <?php for ($i = 0; $i < 24; $i++) { ?>
        <option>
            <?php
            $value = $i;
            if ($i < 24) {
                echo str_pad($i, 2, "0", STR_PAD_LEFT);
            }
            ?>
        </option>
        <?php } ?>
    </select>
  </div>
  <div class="form-group" style="display: inline-block !important;">
    <select class="form-control" name="minute">
     <option>MM</option>
        <?php for ($i = 0; $i < 60; $i++) { ?>
      <option>
            <?php
            if ($i < 60) {
                echo str_pad($i, 2, "0", STR_PAD_LEFT);
            }
            ?>
      </option>
        <?php } ?>
  </select>
</div>
<div class="form-group" style="display: inline-block !important;">
  <select class="form-control" name="second">
    <option>SS</option>
    <?php for ($i = 0; $i < 60; $i++) { ?>
     <option>
        <?php
        if ($i < 60) {
            echo str_pad($i, 2, "0", STR_PAD_LEFT);
        }
        ?>
    </option>
    <?php } ?>

</select>
</div>
</div>

<br/>

</div>
</div>
</div>
</div>
</div>
</div>

<?php if ($question_item == 11) {?>
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
<?php }?>

</div>
</div>
</div>


<!--Set Question Solution on jquery ui-->
<div id="dialog">
  <textarea  id="setSolution" style="display:none;"></textarea>
</div>
<input type="hidden" name="question_solution" id="setSolutionHidden" value="">


<!--Set Question Solution modal-->
<!--   <div class="modal fade ss_modal" id="set_solution" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="max-width: 400px;">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">Solution</h4>
      </div>
      <div class="modal-body row">
        <textarea class="mytextarea" name="question_solution"></textarea>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div> -->


</form>



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
              <!-- <input type="number" class="form-control" name="first_digit"> -->
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
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" onclick="markData()">Save</button>
      </div>
    </div>
  </div>
</div>


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
        <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>

<!--Add Chapter Modal-->

<div class="modal fade ss_modal" id="add_chapter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add Chapter</h4>
      </div>
      <div id="chapter_error"></div>
      
      <div class="modal-body">
        <form class="" id="add_subject_wise_chapter">

          <div class="form-group">
            <label for="attached_subject"></label>
            <input type="hidden" class="form-control" name="attached_subject" id="attached_subject">
          </div>
          <div class="form-group">
            <label for="chapter">Chapter Name</label>
            <input class="form-control" name="chapter" id="chapter">
          </div>

        </form>
      </div>
      
      <div class="modal-footer">
        <button type="button" onclick="add_chapter()" class="btn btn_blue">Save</button>
        <button type="button" class="btn btn_blue" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!--Add Subject Modal-->

<div class="modal fade ss_modal" id="add_subject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add New Subject</h4>
      </div>
      <form class="" id="add_subject_name">
        <div class="modal-body">
          <div class="form-group">
            <label>Add Subject</label>
            <input type="text" class="form-control wordSearch" name="subject_name">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" onclick="add_subject()" class="btn btn_blue">Save</button>
          <button type="button" class="btn btn_blue" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>




<script>
  function setSolution() {
    //$("#set_solution").modal('show');
    $( "#dialog" ).dialog({
      height: 400,
      width: 600,
      buttons: [
      {
        text:"Close",
        icon: "ui-icon-heart",
        click: function() {

          $( this ).dialog( "close" );
        }
      },
      {
        text:"Save",
        click: function() {
          var solution = ($('#setSolution').val());
          ($('#setSolutionHidden').val(solution));
          $( this ).dialog( "close" );
        }
      }
      ]
    });
    $('#setSolution').ckeditor({
      height: 200,
      extraPlugins : 'simage,ckeditor_wiris',
      filebrowserBrowseUrl: '/assets/uploads?type=Images',
      filebrowserUploadUrl: 'imageUpload',
      toolbar: [
      { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
      { name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
      '/',
      { name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'addFile'] }, 
      '/',
      { name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
      { name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
      ],
      allowedContent: true
    });
  }
</script>


<script>
  $(document).ready(function(e){

    $('.instruction').ckeditor({
      height: 60,
      extraPlugins : 'svideo,youtube',
      filebrowserBrowseUrl: '/assets/uploads?type=Images',
      filebrowserUploadUrl: 'imageUpload',
      toolbar: [
      { name: 'document', items: ['SVideo', 'Youtube'] }, 

      ]
    });

    $('.question_video').ckeditor({
      height: 60,
      extraPlugins : 'svideo,youtube',
      filebrowserBrowseUrl: '/assets/uploads?type=Images',
      filebrowserUploadUrl: 'imageUpload',
      toolbar: [
      { name: 'document', items: ['SVideo', 'Youtube'], }, 

      ],
    });
   

        // Variable to store your files
        var files;

        // Add events
        $('input[type=file]').on('change', prepareUpload);

        // Grab the files and set them to our variable
        function prepareUpload(event) {
          files = event.target.files;
        }

        $("#question_form").on('submit', function(e){
      e.preventDefault();
     <?php if($question_item == 14){?>
                $(".progress").show();
            <?php }?>
      var is_submit = 1;
//          var list = [];
            //Check for Creative Quiz
            var paragraph_order = $("input[name='paragraph_order[]']").map(function(){return $(this).val();}).get();
            var list = $(".sentence input:checked").map(function(){
                                                                return $(this).attr("checkboxid");
                                                            }).get().join();
            
            var arr = list.split(',');
            paragraph_order = paragraph_order.filter(function (el) {
                                                        return el != '';
                                                    });
            console.log(arr);
            console.log(paragraph_order);
            if(paragraph_order.length > 0){
                for(var i = 0;i < arr.length; i++){
//                    
                    if(paragraph_order[i] == ''){
                        is_submit = 0;
                    }
                }
                
                if(arr.length != paragraph_order.length){
                    is_submit = 0;
                }
            }
      
      var pathname = '<?php echo base_url(); ?>';
      var question_item = document.getElementById('question_item').value;

      if (question_item == 4) {
          
        if ($('input:checkbox[name=questionName_1_checkbox]:checked').val() == 1) {
          var first_question = $('input:checkbox[name=questionName_1_checkbox]:checked').val();

        }

        if ($('input:checkbox[name=questionName_2_checkbox]:checked').val() == 1) {
          var second_question = $('input:checkbox[name=questionName_2_checkbox]:checked').val();

        }

        if ($('#questionName_1').val() =='') {
          $('#question_name_type').val(0)
        }else{
          $('#question_name_type').val(1)
        }

        if (first_question == 1 && second_question == 1) {
          
        }else{

          if ($('#questionName_1').val() !='' && $('#questionName_2').val() !='') {
            alert('You can not use at a time two question ')
            return ;
          }
          
        }
      }

      // if(is_submit == 1) {
        CKupdate();
        $.ajax({
          url: "save_question_data",
          type: "POST",
          data: new FormData(this),
          processData:false,
          contentType:false,
          cache:false,

          success: function (response) {
            console.log(response);
            $(".progress").hide();
            var data = jQuery.parseJSON(response);
            console.log(data.flag);
            $("#error_msg").text('');
            if(data.flag == 1){
              $("#preview_btn").show();
              $("#preview_btn").attr("href", pathname+'question_preview/'+question_item+'/'+data.question_id);
			  $(".uploadsMsg_").html('');
              $("#ss_sucess_mess").modal('show');
            }if(data.flag == 0){
              $("#error_msg").text(data.msg);
            }
          }
        });
      // } else {
                // alert('Please set all sentence to any paragraph');
            // }
        });
      });

  function CKupdate() {
    for (instance in CKEDITOR.instances)
      CKEDITOR.instances[instance].updateElement();
  }

  function add_subject() {
    $.ajax({
     url: "add_subject_name",
     method: "POST",
     data: $("#add_subject_name").serialize(),
     success: function (response) {
      $('#add_subject').modal('hide');

      $('#subject').html(response);
    }
  });
  }

  function getChapter(e) {
    var subject_id = e.value;
    $.ajax({
     url: "get_chapter_name",
     method: "POST",
     data: {
      subject_id: subject_id
    },
    success: function (response) {
      $('#subject_chapter').html(response);
    }
  });
  }

  function open_question_setting() {
    $("#raccordion").show();
  }
  
  $('#get_subject').click(function () {

    var subject_id = document.getElementById('subject').value;
    document.getElementById("attached_subject").value = subject_id;
    $('#add_chapter').modal('show');
  });

  function add_chapter() {
    var data = $("#add_subject_wise_chapter").serializeArray();
    console.log(data[0].value);
    if(data[0].value == ''){
     var response = '<p style="color: red;">Please Select Subject</p>';
     $('#chapter_error').html(response);
   } else if(data[1].value == '') {
     var response = '<p style="color: red;">Chapter Field Can Not Be Empty</p>';
     $('#chapter_error').html(response);
   } else {
     $.ajax({
      url: "add_chapter",
      method: "POST",
      dataType: 'html',
      data: data,
      success: function (response) {

       $('#add_ch_success').html('Chapter added successfully');
       $('#add_chapter').modal('hide');
       $('#subject_chapter').html(response);

     }
   });
   }
 }


 function setMark(){
  $("#set_marks").modal('show');
}

function markData(){
  var marks = $("#marksValue").serializeArray();

  var first_digit = marks[0].value;
  var second_digit = marks[1].value;
  first_digit = first_digit.length ? first_digit : 0;
  second_digit = second_digit.length ? second_digit : 0;
  var number = "" + first_digit + second_digit;

  var first_fraction_digit = marks[2].value;
  var second_fraction_digit = marks[3].value;
  first_fraction_digit = first_fraction_digit.length ? first_fraction_digit : 1;
  second_fraction_digit = second_fraction_digit.length ? second_fraction_digit : 1;

  if(first_fraction_digit > second_fraction_digit) {
    alert('Numerator can not be bigger than denominator');
  } else {
    var decimal_digit = parseInt(number) + parseFloat(first_fraction_digit / second_fraction_digit);
    if(first_fraction_digit == second_fraction_digit) {
      decimal_digit = parseInt(number) * parseFloat(first_fraction_digit / second_fraction_digit);
    }
    decimal_digit = decimal_digit.toFixed(2);
    $("#marks").html(decimal_digit) ;
    $("#marks_value").val(decimal_digit) ;
    $("#mark_icon").hide() ;
    $("#marks").show() ;

    $('#set_marks').modal('hide');
  }
}

  //context menu on subject
  $(function($){
    var selector = $('#subject');
    $(document).on('change', '#subject', function(){
      var selItem = $("#subject :selected");
      console.log('hit');
      selItem.mousedown(function(e){
        console.log(e);
      })
    })
  })

  /*autocomplete*/
  $(document).ready(function(){ 
    $('.wordSearch').devbridgeAutocomplete({
      serviceUrl: 'Subject/suggestSubject',
      onSelect: function (suggestions) {
        console.log(suggestions.answer);
      }
    });
  })

</script>
