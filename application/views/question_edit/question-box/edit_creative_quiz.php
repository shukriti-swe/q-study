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
</style>

<?php 

//echo "<pre>";print_r($idea_info);die();

?>


 
 <div class="row">
   <div class="col-sm-12">
     <div class="idea_setting_mid">
     <div class="form-group" style="float: left;margin-right: 10px;">
      <input type="checkbox" name="short_question_allow" value="1" <?php if($idea_info['short_question_allow']==1){echo "checked";}?>> <label id='shot_question_box'>   <img src="assets/images/icon_new.png"> New
          </label>
            <div>
              <button type="button" class="btn btn-select active show_short_question">Question</button>
            </div> 
         </div>
         <div class="form-group" style="justify-content: center;float: left;margin-right: 10px;">
            <!-- <label><input type="checkbox" name=""> </label><a id="large_question" type="button"><img src="assets/images/icon_new.png"> New</a>  -->
            <input type="checkbox" name="large_question_allow" value="1" <?php if($idea_info['large_question_allow']==1){echo "checked";}?>> <label id='large_question'>   <img src="assets/images/icon_new.png"> New
          </label>
            <!-- <label id='large_question_box'> <input type="checkbox" name="">   <img src="assets/images/icon_new.png"> New
          </label> -->
            <div>
              <button type="button" class="btn btn-select open_detail_question">Detail Question</button>
            </div> 
         </div>
         <div class="form-group" style="float: left;margin-right: 10px;"> 
            <div>
              <button type="button" class="btn btn-select  ">Student Title
                <input type="hidden" name="student_title" value="0">
                <input type="checkbox" name="student_title" value="1" <?php if($idea_info['student_title']==1){echo "checked";}?>
              ></button>
            </div> 
         </div>
          <div class="form-group text-center" style="float: left;margin-right: 10px;">
            <label>  <span> Word Limit</span> </label> 
               <select class="form-control w-50" id="word_limit_set" name="word_limit">
               <option value="00" <?php if($idea_info['word_limit'] == 00){echo "selected";}?>>00</option>
                <option value="30" <?php if($idea_info['word_limit'] == 30){echo "selected";}?>>30</option>
                <option value="50" <?php if($idea_info['word_limit'] == 50){echo "selected";}?>>50</option>
                <option value="100" <?php if($idea_info['word_limit'] == 100){echo "selected";}?>>100</option>
                <option value="200" <?php if($idea_info['word_limit'] == 200){echo "selected";}?>>200</option> 
                <option value="300" <?php if($idea_info['word_limit'] == 300){echo "selected";}?>>300</option>
                <option value="400" <?php if($idea_info['word_limit'] == 400){echo "selected";}?>>400</option>
                <option value="500" <?php if($idea_info['word_limit'] == 500){echo "selected";}?>>500</option>
              </select>  
         </div>
         <div class="form-group text-center" style="float: left;margin-right: 10px;">
            <label>  <span> Time To Answer</span> </label>
            <div class="d-flex">
               <input type="text" id="time_hour" class="form-control w-50" name="time_hour" value="<?php  if($idea_info['time_hour']< 10){echo '0'.$idea_info['time_hour'];}else{echo $idea_info['time_hour'];}?>">
               <input type="text" id="time_min" class="form-control w-50" name="time_min" value="<?php  if($idea_info['time_min']< 10){echo '0'.$idea_info['time_min'];}else{echo $idea_info['time_min'];}?>">
               <input type="text" id="time_sec" class="form-control w-50" name="time_sec" value="<?php  if($idea_info['time_sec']< 10){echo '0'.$idea_info['time_sec'];}else{echo $idea_info['time_sec'];}?>">
            </div> 
         </div>
         <div class="form-group text-center" style="float: left;margin-right: 10px;">
            <label>  <span> Allow Ideas</span> </label>
            <div style="height:34px">
               <input type="checkbox" name="allow_idea" value="1" <?php if($idea_info['allow_idea']==1){echo "checked";}?>> 
            </div> 
         </div>
         <div class="form-group text-center" style="float: left;margin-right: 10px;">
            <label>  <span> Add start button</span> </label>
            <div style="height:34px">
               <input type="checkbox" name="add_start_button" value="1"<?php if($idea_info['add_start_button']==1){echo "checked";}?>>
            </div> 
         </div>
         <div class="form-group" style="float: left;margin-right: 10px;"> 
            <div>
              <button type="button" class="btn btn-select admin_approval_button" style="background-color: #df3832;">Admin Approval 
              <input type="checkbox" class="admin_approval_checkbox" name="admin_approval" value="<?=$ideas[0]['approval']?>" 
                <?php 
                foreach($ideas as $idea){ 

                  if($idea['user_id']==$user_id){
                if($idea['approval']==1){
                  echo "checked"; }}
                }?>> 
              </button>
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
              <label  id="create_new_idea"> <span><img src="assets/images/icon_new.png"> New</span> </label>
             <?php }?>
            <div>

              <input type="hidden" name="idea_name" value="idea<?=$i;?>">
              <input type="hidden" name="idea_details[]" value="<?=$ideas['id'];?>,<?=$ideas['idea_title'];?>,<?=$ideas['question_description'];?>,<?=$ideas['total_word'];?>">

              <button type="button" class="btn btn-select-border color_change idea<?=$i;?>" onclick="showIdea(<?=$i;?>)">Idea <?=$i;?></button>
            </div> 
         </div> 
         <?php $i++; }
         }else{ ?>
         <div class="form-group" style="float: left;margin-right: 10px;">
         
         <label id="create_new_idea"> <span><img src="assets/images/icon_new.png"> New</span> </label>
            
          <div>
            <?php
            if(!empty($ideas)){
            $a=1;
            foreach($ideas as $idea){ 
               $style = '';
               if($idea['user_id']==$user_id && $idea['tutor_question_id']==$question_id){
                  $style="background:#00a2e8;color:white;";
               }
              ?>
              <button type="button" style="<?=$style?>" data-question-id="<?=$idea['question_id']?>" data-id="<?=$idea['question_id']?>" data-value="<?=$idea['id']?>" 
              class="btn btn-select-border view_idea">Idea-<?=$a?>
              </button>
            <?php
             $a++;}
            }else{
             ?>
              <button type="button" style="background:#00a2e8;color:white;" class="btn btn-select-border">Idea- </button>
             <?php }?>
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
                <span id="word_show"><b id="total_idea_word"><?=$idea_info['word_limit']?></b> Words</span>
                <span style="margin:0 auto;" class="m-auto"><input id="time_show" class="form-control text-center" type="text" value="00:05:00" name=""></span>
                <span class="m-auto word_limit_show"> Word Limit <span class="m-auto b-btn word_limit_number_show">100</span></span>
               </div>
               <div class="btm_word_limt">
                <div class="content_box_word">
                    <textarea id="word_count" class="form-control idea_main_body mytextarea" name="idea_main_body"><?php foreach($ideas as $idea){if($idea['user_id']==$user_id  && $idea['tutor_question_id']==$question_id){echo $idea['idea_ans'];} }?></textarea>
                </div>
               </div>
          </div>
          <div class="created_name question_idea_show">
              <img src="assets/images/hand_with_pen_blue.PNG"> <a href="javascript:;" id="idea_creator_details" data-qcreator="<?=$ideas[0]['name']?>" data-idea_name="<?=$ideas[0]['idea_title']?>" data-created_at="<?=$ideas[0]['created_at']?>"> <u>Idea Created By :</u> </a> &nbsp; <b class="idea_creator"> <?=$q_creator_name[0]['name']?></b>
          </div>


          <!-- <div class="created_name question_idea_show" style="display:none;">
              <img id="question_idea_show_icon" src="assets/images/hand_with_pen_blue.PNG"> <a href="javascript:;" id="idea_creator_details"> <u>Idea Created By :</u> </a> &nbsp; <b class="question_creator"> </b>
          </div> -->

      </div>
      <div class="col-md-6">
          <div style="overflow: hidden;">
          <input type="hidden" id="selected_search" value="">
            <div class="form-group" style="float: left;margin-right: 10px;"> 
                  <div>
                    <button type="button" class="btn btn-select question_title" style="<?php if(empty($idea_info['image_title'])){echo "background:#00a2e8";}?>">Question & Idea Title </button>
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

              <div class="form-group" style="float: left;margin-right: 10px;"> 
                  <div>
                    <button type="button" class="btn btn-select" id="image_search_button" style="<?php if(!empty($idea_info['image_title'])){echo "background:#00a2e8";}?>">Image</button>
                  </div> 
              </div> 
              <div class="form-group" style="float: left;margin-right: 10px;display:none;"> 
              
              </div>
              <div class="form-group" style="float: left;margin-right: 10px;"> 
                  <div>
                    <img src="assets/images/search_a.png" id="advance_searc_image">
                  </div> 
              </div>
          </div>
          <?php if(empty($idea_info['image_title'])){?>
          <div style="overflow: hidden;">
             <div id="advance_searc_content" style="display:none;">
                <div class="serach_list"> 
                    <div class="input-group">
                      <input type="search" class="form-control" placeholder="Search" name="search" id="advance_searc_content_src" value="<?=$idea_info['shot_question_title']?>">
                      <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                      </div>
                    </div>
                  </div>
                  <div id="search_view">

                  
                  </div>
              </div>
              <br>
          </div>
          <?php }else{?>

          <div style="overflow: hidden;">
             <div id="image_search_bar">
                <div class="serach_list"> 
                    <div class="input-group">
                      <input type="search" class="form-control" placeholder="Search" name="search" id="advance_searc_image_src" value="<?=$idea_info['image_title']?>">
                      <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                      </div>
                    </div>
                  </div>
                  <div id="image_search_view">

                  
                  </div>
              </div>
              <br>
          </div>
          <?php }?>
              
              <!-- ===== new feature ===== -->
              <div style="background-color: #00a2e8;" id="short_question_view">
     
                <div class="modal-header" style="padding: 2px;">
                  <h4 style="background-color: #00a2e8; color:white;font-size: 15px;line-height: 27px;padding-left: 15px;font-weight: bold;letter-spacing: 0.5px;">Question 

                      <button style="float: right; color:black;background-color: #00a2e8;border:none;" type="button" class="btnclose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                  </h4>
                  
                </div>

               
                  <div class="modal-body">
                    <div class="d-flex">
                      <input type="checkbox" name="" id="checkbox_titlelimitidea"> &nbsp;
                      <div class="form-group">
                        <label style="color:white;margin-bottom:5px;">Title</label>
                        <input type="text" id="short_title" class="form-control shot_question_title" name="shot_question_title" readonly=""  value="<?=$idea_info['shot_question_title']?>">
                      </div>
                    </div> 
                    <div class="d-flex" style="display: flex;">
                      <label style="color:white;"><?=$idea_info['image_title']?></label>
                      
                    </div> 

                  </div>
                  
                  <input type="hidden" value="2" id="check_new_idea">
                  <div class="modal-footer add_edit_button">
                      <div class="q_created_name">
                          <img src="assets/images/creative_question_square.png" id="short_question_view_hand_icon"> <a href="javascript:;" id="question_creator_details" data-qcreator="<?=$idea_info['name']?>" data-question_name="<?=$idea_info['shot_question_title']?>" data-q_created_at="<?=$idea_info['created_at']?>"><u id="q_created_name_text"></u> <u style="color:white;">Question Created By :</u> </a> &nbsp; <b class="question_creator"><?=$ideas[0]['name']?> </b>
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



<!-- shot_question -->

<div class="modal fade ss_modal " id="shot_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div style="background-color: #e1cbcb;" class="modal-content">
     
      <div class="modal-header">
        <h4 style="background-color: #e1cbcb; color:#4732e9">Question 

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
              <input type="text" id="short_title2" class="form-control shot_question_title " name="shot_question_title2" readonly="" maxlength="50">
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
        <h4 style="background-color: #e1cbcb; color:#4732e9">Detail Question 

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
              <input type="text" id="large_title" class="form-control large_question_title " name="large_question_title" readonly="" maxlength="50" value="<?=$idea_info['large_question_title']?>">
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
    <div  style="background-color: #00a2e8; color:white;" class="modal-content">
     
      <div class="modal-header">
        <h4 style="background-color: #00a2e8; color:white;">Idea

            <button style="float: right; color:black;background-color: #00a2e8;border:none;" type="button" class="ideabtnclose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
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
        
        <h6 style="text-align:center;">   Question </h6>

            <button style="color:black;border:none;margin-left: auto;order: 2;" type="button" class="close_idea" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            
            </div>
          <div class="row">
            <input type="hidden" id="total_word_ajax" value="7">
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
  
        <div style="background-color: #eee;" class="modal-body">
        <div style="display: flex;">
        <a href="#" style="color:black; text-decoration: underline;padding-right:100px;">Question</a>
        <h6 style="display: flex;">   Question </h6>

            <button style="color:black;border:none;margin-left: auto;order: 2;" type="button" class="close_ch" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            
            </div>
          <div class="row">
            
             <textarea id="short_ques_body" class="form-control mytextarea" name="short_ques_body" value=""><?=$idea_info['short_ques_body']?></textarea>

             <textarea style="display: none;" id="short_ques_body_rep"></textarea>


             <input type="hidden" id="new_short_replace" value="">
             <input type="hidden" id="new_large_replace" value="">
             <input type="hidden" id="pre_short_question_title" value="<?=$idea_info['shot_question_title']?>">
             <input type="hidden" id="pre_large_question_title" value="<?=$idea_info['large_question_title']?>">
             <input type="hidden" id="pre_short_question_body" value="<?=$idea_info['short_ques_body']?>">
             <input type="hidden" id="pre_large_question_body" value="<?=$idea_info['large_ques_body']?>">

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
        <a href="#" style="color:black; text-decoration: underline;padding-right:100px;">Detail Question</a>
        <h6 style="display: flex;">   Question </h6>

            <button style="color:black;border:none;margin-left: auto;order: 2;" type="button" class="close_ch" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            
            </div>
          <div class="row">
            
             <textarea id="large_ques_body" class="form-control mytextarea" name="large_ques_body"><?=$idea_info['large_ques_body']?></textarea>
             <textarea style="display: none;" id="large_ques_body_rep"></textarea>
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
    margin-top: 20px;
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
  display: block;
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
.search_button{
  cursor: pointer;
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
   $(document).on('click','#create_new_idea',function(){  

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

$(document).ready(function(){

  // $('.admin_approval_checkbox').attr('disabled', true);
  // $('.admin_approval_button').attr('disabled', true);

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
      
      am_cal(finalCount);
    
    });


  $(".question_title").click(function(){
    $("#advance_allowonline").toggle();
    $("#advance_searc_content").toggle();
  });

  $(".idea_title").click(function(){
    $("#advance_allowonline").toggle();
    $("#advance_searc_content").toggle();
  });

  $('#short_question_edit').click(function(){
      $('#shot_question').modal('show'); 
    });
  

  $("#advance_searc_content_src").keyup(function(){
    var search_text = $(this).val();
    var search_type = $("#selected_search").val();
    
    $.ajax({
          url: "search_idea",
          type: "POST",
          data: {search_text:search_text,search_type:search_type},
          success: function (data) {
     
            var all_data = JSON.parse(data);
            console.log(all_data);
            html ='';

              for(i=0;i<all_data['questions'].length;i++){
              html +='<br><a class="search_button" type="button"  data-id="'+all_data['questions'][i].question_id+'" data-index="'+all_data['questions'][i].id+'">'+all_data['questions'][i].shot_question_title+'</a>';
              }

            $("#search_view").css('display', 'block');
            $('#search_view').html(html);
            
          }

          });

  });
  
    $(document).on('click','.search_button',function(){
      $("#search_view").css('display', 'none');
      $("#short_question_view").css('display', 'block');
      $(".shot_question_title").attr('readonly', true);
      $("#check_new_idea").val(1);
      var question_id = $(this).attr('data-id');
      $.ajax({
            url: "get_idea",
            type: "POST",
            data: {question_id:question_id},
            success: function (response) {
              var data = JSON.parse(response);
              console.log(data);
              $("#short_title").val(data[0]['shot_question_title']);
              $("#idea_title").val(data[0]['idea_name']);
              $(".idea_main_body ").val(data[0]['idea_question']);
            }

            });
      
    });


   $("#word_limit_set").change(function(){
    var word_limit= $("#word_limit_set").val();
    $(".word_limit_number_show").text(word_limit);
    $(".word_limit_number_show").show();
    $(".word_limit_show").show();
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
 
 
  $('.close_idea').click(function(){

    var check_idea = $("#check_new_idea").val();
    
    // if(check_idea == 1){
    
    var total_word = $('#total_word_ajax').val();
    var idea_id = $(".search_button").attr("data-index");
    var idea_title = $('#idea_question_title_main').val();
    var question_description = $('#idea_ques_body').val();
    var question_id = <?=$idea_info['question_id']?>;
    
    
    $.ajax({
          url: "save_more_idea",
          type: "POST",
          data: {idea_title:idea_title,question_description:question_description,question_id:question_id},
          success: function (response) {
            
            var data = JSON.parse(response);
            var html = '';
            var color = 'background:#fb8836f0;';

            // alert(data.length);

            for(var i = 0; i<data.length;i++){
                
                if(i==0){
                var html2 = '<label data-toggle="modal" data-target="#newidea"> <span><img src="assets/images/icon_new.png"> New</span> </label>';
                }else{
                  var html2='';
                }
                if(i == data.length-1){
                  var color = 'background:#fb8836f0;';
                  //$(".idea_main_body").val(data[i].idea_question);
                }else{
                  var color = '';
                }
                var idea = i+1;
                
                var desc = "<input type='hidden' class='ideasall' name='idea_details[]' data-index='"+data[i].idea_question+"' data-id='"+i+"' value='"+data[i].idea_id+","+data[i].idea_title+","+data[i].idea_question+"'>";
                

                html += '<div class="form-group" style="float: left;margin-right: 10px;">'+html2+'<div><input type="hidden" name="idea_name[]" value="idea'+data[i].idea_id+'">'+desc+'<button style="'+color+'" data-id="'+i+'" class="btn btn-select-border showIdea  color_change idea'+data[i].idea_id+'" type="button">Idea '+idea+'</button></div></div>';
                
                if(i == data.length-1){
                  $(".idea_main_body").val(data[i].idea_question);
                }
            }
              $('.all_idea').html(html);
        
          }

          });
    // }else{ 
    
    //   var total_word = $('#total_word_ajax').val();
    //   var idea_title = $('#idea_question_title_main').val();
    //   var question_description = $('#idea_ques_body').val();

    //   // alert(total_word);
    //   // alert(idea_title);
    //   // alert(question_description);

    //   $.ajax({
    //       url: "save_idea",
    //       type: "POST",
    //       data: {idea_title:idea_title,question_description:question_description,total_word:total_word},
    //       success: function (response) {
        
    //         var html = '';
    //         var data = JSON.parse(response);
    //         console.log(data);
    //         var idea_id = data[0].id;
    //         var idea_title = data[0].idea_title;
    //         var idea_description = data[0].question_description;
    //         console.log(idea_id);
    

    //         if(idea_id==1){
    //           var html2 = '<label data-toggle="modal" data-target="#newidea"> <span><img src="assets/images/icon_new.png"> New</span> </label>';
    //         }else{
    //           var html2='';
    //         }
    //         $( ".color_change" ).css('background', 'none');
    //         var desc = "<input type='hidden' name='idea_details[]' value='"+idea_id+","+idea_title+","+idea_description+"'>";
    //         var html = '<div class="form-group" style="float: left;margin-right: 10px;">'+html2+'<div><input type="hidden" name="idea_name[]" value="idea'+idea_id+'">'+desc+'<button style="background:#fb8836f0;" data-value="" class="btn btn-select-border color_change idea'+idea_id+'" type="button" onclick="showIdea('+idea_id+')">Idea '+idea_id+'</button></div></div>';
            
          
              

    //         $(".idea_main_body").val(idea_description);
            
    //         if(idea_id==1){
    //           $('.all_idea').html(html);
    //         }else{
    //           $('.all_idea').append(html);
    //         }
            
    //       }

    //       });

    // }

  });
  

  $('.show_short_question').click(function(){
      $modal = $('#shot_question_details');
      $('#shot_question_details').modal('show');
  });


  $('.btnclose').click(function(){

    //$('#shot_question_box input').prop('checked',false);
      $modal = $('#shot_question_details');
      $('#shot_question_details').modal('show');

      var short_title = $('#short_title').val();
      var text= '<p><b>Write about the topic bellow :</b></p>"'+short_title+'"&#9999;&#65039;';
      $("#new_short_replace").val(text);
  
      var pre_short_body = $("#pre_short_question_body").val();
      var pre_short_question_title = $("#pre_short_question_title").val();
      var find_short_replace = '<p><b>Write about the topic bellow :</b></p>'+'\n\n'+'<p>"'+pre_short_question_title+'"✏️</p>';
      $('#short_ques_body_rep').val(find_short_replace);
      var get_text = $('#short_ques_body_rep').val();
      var new_short_body = '<p><b>Write about the topic bellow :</b></p>'+'\n\n'+'"'+short_title+'"✏️';

      var replace = pre_short_body.replace(find_short_replace, new_short_body);
      // alert(pre_short_body);
      // alert(find_short_replace);
      // alert(new_short_body);
      // alert(replace);
      $('#short_ques_body').val(replace);

    });

    $('.largebtnclose').click(function(){

      $modal = $('#large_question_details');
      $('#large_question_details').modal('show'); 

      var large_title = $('#large_title').val();
      var text= '<p><b>Write about the topic bellow :</b></p>"'+large_title+'"&#9999;&#65039;';
      
      $("#new_large_replace").val(text);
      var pre_large_body = $("#pre_large_question_body").val();
      var pre_large_question_title = $("#pre_large_question_title").val();
      var find_large_replace = '<p><b>Write about the topic bellow :</b></p>'+'\n\n'+'<p>"'+pre_large_question_title+'"✏️</p>';
      $('#large_ques_body_rep').val(find_large_replace);
      var get_text = $('#large_ques_body_rep').val();
      var new_large_body = '<p><b>Write about the topic bellow :</b></p>'+'\n'+'"'+large_title+'"✏️';

      var replace = pre_large_body.replace(find_large_replace, new_large_body);

      $('#large_ques_body').val(replace);

    });

    $("#large_question").click(function(){
    //  $("#large_title").val("<?=$idea_info['large_question_title']?>");
    //  $('#largequestion').modal('show'); 
    $('#large_question_details').modal('show'); 

    });

    $(".open_detail_question").click(function(){

    //  $('#largequestion').modal('show'); 
    $('#large_question_details').modal('show'); 

    });

    $('#shot_question_box').click(function(){

      $(".question_title").css('background-color', '#00a2e8');
      $("#advance_searc_content").show();
      $("#selected_search").val(1);
      $("#short_question_view").css('display', 'block');
      $("#Idea_view").css('display', 'none');
      //$(".shot_question_title").removeAttr("readonly");
      
      $("#short_title").val("<?=$idea_info['shot_question_title']?>");
      
      $("#check_new_idea").val(2);

      var html2 = '<label data-toggle="modal" data-target="#newidea"> <span><img src="assets/images/icon_new.png"> New</span> </label>';

      html = '<div class="idea_setting_mid_bottom"><div class="all_idea2"><div class="form-group" style="float: left;margin-right: 10px;"><label id="create_new_idea"> <span><img src="assets/images/icon_new.png"> New</span> </label><div><button id="idea1" class="btn btn-select-border">Idea- </button></div></div></div></div>';

      //$('.all_idea').html(html);
    });


    $('.ideabtnclose').click(function(){
     $modal = $('#idea_question_details');
     $('#idea_question_details').modal('show'); 


     var check_idea = $("#check_new_idea").val();

     if(check_idea == 2){
      var idea_body = $('#idea_question_title_main').val();
     }else{
      var idea_body = $('#idea_title').val();
     }

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
      // $("#advance_allowonline").toggle();
      // $("#advance_searc_content").toggle(); 222
      $("#image_search_bar").hide();
      $("#advance_searc_content").show();
      $('.clear_idea').show();
      $('#advance_searc_op').hide();

      var search_text = $("#advance_searc_content_src").val();
      var search_type = $("#selected_search").val();
      if(search_type==''){
        search_type =1;
      }
      search_idea_question(search_text,search_type);
    });
   
  });

  function search_idea_question(search_text,search_type){
      var search_text =''
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

            console.log(all_data['questions']);
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
  $(document).on('click','.view_idea',function(){ 
    var question_id = $(this).attr('data-id');
    var idea_id = $(this).attr('data-value');
    $('.view_idea').removeAttr('style');
    $(this).attr('style','background:#00a2e8;color:white;');
    
    $.ajax({
      url: "view_edit_idea",
      type: "POST",
      data: {question_id:question_id,idea_id:idea_id},
      success: function (response) {

          var data = JSON.parse(response);
          console.log(data);
          $(".idea_main_body ").val(data['idea_ans']);
          $('#idea_creator_details').attr('data-qcreator',data['name']);
          $('#idea_creator_details').attr('data-idea_name',data['idea_title']);
          $('#idea_creator_details').attr('data-created_at',data['created_at']);
          // question_creator
          $('.idea_creator').text(data['name']);
          // $('.question_creator').text(data['name']);


      }

    });

  });
  $(document).on('click', '.search_button', function() {
      $("#search_view").css('display', 'none');
      $("#short_question_view").css('display', 'block');
      //$("#short_edit_button").css('display', 'block');
      // $(".shot_question_title").attr('readonly', true);
      
      $("#check_new_idea").val(1);
      var question_id = $(this).attr('data-id');
      $.ajax({
        url: "get_idea",
        type: "POST",
        data: {
          question_id: question_id
        },
        success: function(response) {
          var data = JSON.parse(response); 
          console.log(data);
          var idea_value = CKEDITOR.instances['word_count'].document.getBody().getText();
          $('#idea_storage').val(idea_value);
          $("#short_title").val(data[0]['shot_question_title']);
          $(".shot_question_title").val(data[0]['shot_question_title']);
          $('#shot_question_box').attr('data-nonCreate',1);
          $("#idea_title").val(data[0]['idea_name']);
          $(".idea_main_body ").val(data[0]['idea_question']);
          $('#short_ques_body').val(data[0]['shot_question_title']);
          $('#large_ques_body').val(data[0]['large_ques_body']);
          $('#short_question_id').val(data[0]['question_id']);
          $('#idea1').text(data[0]['idea_name']);
          $('#idea1').css({
            "background-color": "#00a2e8;",
            "color": "white;"
          }); 

          $('.this_idea_title').text(data[0]['image_title']);
          $('.question_creator').text(data[0]['name']);
          $('.question_idea_show').show();
          $('.show_short_question').css('background-color','#00a2e8');
          $('#short_ques_body').attr('disabled',true);
          CKEDITOR.instances['short_ques_body'].setReadOnly(true);

          $('#question_creator_details').attr('data-qcreator',data[0]['name']);
          $('#question_creator_details').attr('data-question_name',data[0]['shot_question_title']);
          $('#question_creator_details').attr('data-q_created_at',data[0][' ']);

          $('#idea_creator_details').attr('data-qcreator',data[0]['name']);
          $('#idea_creator_details').attr('data-idea_name',data[0]['idea_name']);
          $('#idea_creator_details').attr('data-created_at',data[0]['created_at']);
        }

      });

  });
  $('.clear_idea').click(function(){

      var get_idea_val = $('#idea_storage').val();
      $('#word_count').val(get_idea_val);
      $('#short_question_view').hide();
      $('#advance_searc_content').hide();
      $('.clear_idea').hide();
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
          $('.question_creator').text(data[0].name);
      
        }
      });
    });
</script>



