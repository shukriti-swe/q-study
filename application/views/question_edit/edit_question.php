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
#prevBtn {
      background-color: #bbbbbb;
  }
  .image_box_list {
      overflow: hidden;
      box-shadow: 0px 0px 0px 1px #91b7ef;
      background-color: #fbfbfb;
  }

  input[type=text] {
      width: 50%;
      border: 1px solid #e1f2f7;
      /*padding: 7px 130px;
*/
  }

  #tbl_show {
      color: #222222;
      font-size: 14px;
      line-height: 24px;
      letter-spacing: .5px;

  }
  #tbl_show .tab{
      padding: 20px;
  }
  .blue{
      color: red;
  }


  .ss_pagination{
      margin-right: 80px;
      background: #fff;
      margin-top: 1px;
  }
  .ss_pagination button{
      background-color: transparent !important;
      padding: 10px 15px !important;
      line-height: 17px;
      margin: 4px 0px 5px 0px;
  }
  .ss_pagination button.activtab{
      background: url(assets/images/ss_p_bg.jpg) repeat-x bottom !important;
      border: 1px solid #979797 !important;
      border-top: 2px solid #979797 !important;
      border-radius: 5px;
  }
  .ss_pagination #prevBtn {
      color: #666 !important;
  }

  .question_tutorial_modal .modal-dialog{
      overflow-y: initial !important
  }
  .question_tutorial_modal .modal-body{
      height: 400px;
      overflow-y: auto;
  }
</style>

<?//php if($_SESSION['userType']== 7 ){?>
    <!-- <div class="col-md-12 upperbutton" style="text-align: center;margin-bottom: 10px;">
     <a href="all-module" style="font-size:20px;font-weight: bold;display: inline-block;">Module Inbox</a>
    </div> -->
<?//php }?>

    <input type="hidden" name="chapter" id="get_chapter_value">

    <div class="col-md-12 upperbutton" style="text-align: center;margin-bottom: 10px;">
      <a href="create-module" style="font-size:22px;color:#8e9295;text-decoration:underline;display: inline-block;">Module Inbox</a>
      <a href="details-module" style="font-size:22px;color:#8e9295;text-decoration:underline;display: inline-block;margin-left:10px;">Question Inbox</a>
    </div>
<div id="add_ch_success" style="text-align:center;"></div>
<!-- <form class="form-inline" id="question_form"> -->
  <form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="questionType" value="<?php echo $question_item?>">

    <div class="row" >
      <!--<div class="col-sm-1"></div>-->
      <div class="col-sm-12 ">
        <div class="ss_question_add_top">
          <div class="form-group" style="float: left;margin-right: 10px;margin-top: 10px;">
            <ul class="ss_question_menu" id="quesType_1">
            <?php if(isset($question_module_check)){ ?>
                <?php if(count($question_module_check) == 1){ ?>
                  <li style="background:#00a2e8">
                    <a href="edit-module/<?php echo $question_module_check[0]['module_id']; ?>">M</a>
                  </li>
                <?php }else{ ?>
                  <li style="background:#00a2e8">
                    <a id="show_module_list" style="cursor:pointer">M</a>
                  </li>
                <?php } ?>
            <?php } ?>
              <li >
                <a href="question_edit/<?php echo $question_item.'/'.$question_id ?>"><?php echo "Q".$qIndex; ?></a>
              </li>
            </ul>
          </div>

          <div class="form-group" style="float: left;margin-right: 10px;">
            <label for="exampleInputName2">Grade/Year/Level</label>
            <select class="form-control createQuesLabel" name="studentgrade">
              <option value="">Select Grade/Year/Level</option>
              <?php $grades = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]; ?>
              <?php foreach ($grades as $grade) { ?>
                <option value="<?php echo $grade ?>" <?php if ($question_info[0]['studentgrade'] == $grade) { echo 'selected';} ?>>
                  <?php echo $grade; ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group" style="float: left;margin-right: 10px;">
            <label>Subject <span data-toggle="modal" data-target="#add_subject"><img src="assets/images/icon_new.png"> New</span> </label>
            <select class="form-control createQuesLabel" name="subject" id="subject" onchange="getChapter(this)">
              <option value="">Select ...</option>
              <?php foreach ($all_subject as $subject) { ?>
                <option value="<?php echo $subject['subject_id'] ?>" <?php if ($question_info[0]['subject'] == $subject['subject_id']) { echo 'selected'; } ?>>
                  <?php echo $subject['subject_name']; ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group" style="float: left;margin-right: 10px;">
            <label>Chapter <span id="get_subject"><img src="assets/images/icon_new.png"> New</span>
            <i class="fa fa-clone module_chapter_copy" aria-hidden="true" style="color:#ffa500;"></i>
            <i class="fa fa-clipboard module_chapter_paste" aria-hidden="true" style="color:#ffa500;"></i>
            <i class="fa fa-trash module_chapter_delete" aria-hidden="true" style="color:#ffa500;font-size: 19px;"></i>
          </label>
            <select class="form-control createQuesLabel" name="chapter" id="subject_chapter">
              <option value="">Select Chapter</option>
              <?php foreach ($subject_base_chapter as $chapter) { ?>
                <option value="<?php echo $chapter['id']; ?>" <?php if ($question_info[0]['chapter'] == $chapter['id']) {echo 'selected';} ?>>
                  <?php echo $chapter['chapterName']; ?>
                </option>
              <?php } ?>
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

          <a class="ss_q_btn btn btn_red pull-left" onclick="open_question_setting()">
            Question setting
          </a>
          <button class="ss_q_btn btn pull-left"><i class="fa fa-save" aria-hidden="true" type="submit"></i> Save</button>
          <a class="ss_q_btn btn pull-left" href="#"><i class="fa fa-remove" aria-hidden="true"></i> Cancel</a>

          <a class="ss_q_btn btn pull-left" id="preview_btn" href="question_preview/<?php echo $question_info[0]['questionType']; ?>/<?php echo $question_info[0]['id']; ?>" style="">
            <i class="fa fa-file-o" aria-hidden="true"></i> Preview
          </a>
		  <?php if ($question_info[0]['questionType'] == 4){?>
          <a class="ss_q_btn btn pull-left" id="question_tutorial" href="#" style="background: #c4ffff">
            Tutorial Image
           <!--  <img src="<?php echo base_url('/')?>assets/images/question_tutorial_icon.png" width="46"> -->
          </a>
            <?php }?>

            <!--<?php if ($question_info[0]['questionType'] == 4){?>
          <a class="ss_q_btn btn pull-left question_tutorial" style="text-decoration: underline;border: none;font-size: 15px; font-weight: 600;">
            Tutorial Image
             <img src="<?php echo base_url('/')?>assets/images/question_tutorial_icon.png" width="46"> 
          </a>
            <?php }?>-->

        </div>

      </div>

    </div>
    <div class="col-md-12" style="padding:0">
        <div class="module_list_class" style="display:none">
          <div class="form-group" style="float: left;margin-right: 10px;margin-top: 10px;">
            <ul class="ss_question_menu" id="quesType_1">
            <?php if(isset($question_module_check)){ ?>
              <?php foreach($question_module_check as $key => $value) { ?>
                  <li style="background:#00a2e8">
                    <a href="edit-module/<?php echo $value['module_id']; ?>">M<?=($key+1)?></a>
                  </li>
              <?php } ?>
            <?php } ?>
            </ul>
          </div>
        </div>
    </div>
    <div class="row">
      <div class="ss_question_add">
        <div class="ss_s_b_main" style="">

          <?php echo $question_box; ?>

          <div class="col-sm-4">
            <div class="panel-group ss_edit_q" id="raccordion" role="tablist" aria-multiselectable="true" style="display: none;">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne" style="padding: 0;">
                  <h4 class="panel-title">
                    <a> 
                      <label class="form-check-label" for="">Question Time</label> 
					  <?php
                        $checkedTime = '';
                        $time = explode(":",$question_info[0]['questionTime']);
                        if (isset($time[0]) && $time[0] == 'HH')
                        {
                            $checkedTime = '';
                        }else{
                            $checkedTime = 'checked';
                        }

                        ?>
                      <input type="checkbox" id="question_time" name="ansTimeRequired" value="1" <?php echo $checkedTime ?>>  
                      Calculator Required 
                      <input type="checkbox" name="isCalculator" value="1" <?php if ($question_info[0]['isCalculator'] == 1) {echo 'checked';} ?>> 
                      <!-- Score <input type="checkbox" name=""> -->
                      <?php if($this->session->userdata('userType') == 7) : ?>
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
                              <th>SL</th>
                              <th>Mark</th>
                              <!-- <th>Obtained</th> -->
                              <th>Description / Video </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <input type="hidden" class="form-control" id="marks_value" name="questionMarks" value="<?php echo $question_info[0]['questionMarks']; ?>">
                              <td onclick="setMark()" id="marks">
                                <?php echo $question_info[0]['questionMarks']; ?>
                              </td>
                              <!-- <td><?php //echo $question_info[0]['questionMarks']; ?></td> -->
                              <td style="text-align: center;">
                                <a href="" data-toggle="modal" data-target="#ss_description_model" class="text-center" style="display: inline-block;">
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
                              <textarea class="form-control" name="questionDescription"><?php
                              
                              
                              echo $question_info[0]['questionDescription']; ?></textarea>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Start Instruction Modal -->
                      <?php $question_instruct =isset($question_info[0]['question_instruction']) ? json_decode($question_info[0]['question_instruction']):'';?>
                      <div class="modal fade ss_modal ew_ss_modal" id="ss_instruction_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel"> Question Instruction </h4>
                            </div>
                            <div class="modal-body">
                              <textarea class="form-control instruction" name="question_instruction"><?php echo isset($question_instruct[0]) ? trim($question_instruct[0]) : '';?></textarea>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Instruction Modal -->

                      <!-- Start Video Modal -->
                      <?php $question_instruct =isset($question_info[0]['question_video']) ? json_decode($question_info[0]['question_video']):'';?>
                      <div class="modal fade ss_modal ew_ss_modal" id="ss_video_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel"> Question Video </h4>
                            </div>
                            <div class="modal-body">
                              <textarea class="form-control question_video" name="question_video"><?php echo isset($question_instruct[0]) ? trim($question_instruct[0]) : '';?></textarea>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End video Modal -->

                      <?php
                      $questionTime = $question_info[0]['questionTime'];
                      $array = explode(":", $questionTime);
                      ?>
                      <p><strong> Time to answer:</strong></p>
                      <!--<form class="form-inline ss_common_form" id="set_time" style="display: none">-->
                        <div class="form-group" style="display: inline-block !important;">
                          <select class="form-control" name="hour">
                            <option>HH</option>
                            <?php for ($i = 0; $i < 24; $i++) { ?>
                              <?php if ($i < 24) { ?>
                                <?php $hour = str_pad($i, 2, "0", STR_PAD_LEFT);
                              } ?>
                              <option <?php if ($array[0] == $hour) { echo 'selected'; } ?> value="<?php echo $hour; ?>">
                                <?php echo $hour; ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group" style="display: inline-block !important;">
                          <select class="form-control" name="minute">
                            <option>MM</option>
                            <?php for ($i = 0; $i < 60; $i++) { ?>
                              <?php if ($i < 60) { ?>
                                <?php $minute = str_pad($i, 2, "0", STR_PAD_LEFT);
                              } ?>
                              <option <?php if ($array[1] == $minute) { echo 'selected'; } ?> value="<?php echo $minute; ?>">
                                <?php echo $minute; ?>
                              </option>
                            <?php } ?>

                          </select>
                        </div>
                        <div class="form-group" style="display: inline-block !important;">
                          <select class="form-control" name="second">
                            <option>SS</option>
                            <?php for ($i = 0; $i < 60; $i++) { ?>
                              <?php 
                              if ($i < 60) {
                                $second = str_pad($i, 2, "0", STR_PAD_LEFT);
                              } 
                              ?>
                              <option <?php if ($array[2] == $second) { echo 'selected'; } ?> value="<?php echo $second; ?>">
                                <?php echo $second; ?>
                              </option>
                            <?php } ?>

                          </select>
                        </div>
                        <br/>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php if($question_item == 11) {?>
              <div class="col-sm-12">
                <div class="row htm_r" style="margin: 10px 0px;<?php if($question_info_ind['operator'] != '/') {?>display: none;<?php }?>">

                  <div class="col-sm-8"></div>
                  <div class="col-sm-1 col-xs-3" style="text-align: right;font-size: 30px;line-height: 40px;padding-right: 0px;">
                    <span>R</span>
                  </div>
                  <div class="col-sm-3 col-xs-4">
                    <div class="pull-right" style="padding: 8px;min-width: 18%;border: 1px solid #ddd">
                      <input type="text" placeholder="Remainder" name="remainder" class="form-control" value="<?php echo strip_tags(json_decode($question_info[0]['questionName'])->remainder);?>" style="background-color: #e5e9e4">
                    </div>

                    <input type="text" placeholder="Answer" name="quotient" class="form-control" value="<?= isset( (json_decode($question_info[0]['questionName'])->quotient) ) ? strip_tags((json_decode($question_info[0]['questionName'])->quotient)) : ''; ?>">
                  </div>
                </div>

                <div class="col-sm-4"></div>
                <div class="skip_box col-sm-4">
                  <div class="table-responsive">
                    <table class="dynamic_table_skpi table table-bordered">
                      <tbody class="dynamic_table_skpi_tbody">
                        <?php if($question_info_ind['operator'] != '/') {
                          for($i = 1; $i <= $question_info_ind['numOfRows']; $i++) { ?>
                            <tr class="rw<?=$i?>">
                              <?php for($j = 0; $j < $question_info_ind['numOfCols']; $j++) {?>
                                <td>
                                  <input type="text" data_q_type="0" data_num_colofrow="<?=$i?>_<?=$j?>" value="<?php echo $question_info_ind['item'][$i][$j]?>" name="item[<?=$i?>][]" class="form-control input-box rsskpin rsskpinpt<?=$i?>_<?=$j?>" readonly style="min-width:50px;background-color: #ffb7c5">
                                  <input type="hidden" value="" name="ques_ans[]" id="obj">
                                  <input type="hidden" value="" name="ans[]" id="ans_obj">
                                </td>
                              <?php }?>
                            </tr>
                          <?php }?>
                          <tr>
                            <td colspan="<?= $question_info_ind['numOfCols'] ?>">
                              <input type="text" data_q_type="0" value="<?php echo $question_answer;?>" name="result" class="form-control input-box rsskpin" readonly style="min-width: 50px;background-color: #baffba;">
                            </td>
                          </tr>
                        <?php } if($question_info_ind['operator'] == '/') { 
                        //Divisor
                          for($i = 1; $i <= 1; $i++) { ?>
                            <tr class="rw<?=$i?>">
                              <?php for($j = 0; $j < $question_info_ind['numOfCols']; $j++) {?>
                                <td>
                                  <input type="text" data_q_type="0" data_num_colofrow="<?=$i?>_<?=$j?>" value="<?php echo $question_info_ind['divisor'][$j]?>" name="divisor[]" class="form-control input-box rsskpin rsskpinpt<?=$i?>_<?=$j?>" readonly style="min-width:50px;background-color: #ffb7c5">
                                  <input type="hidden" value="" name="ques_ans[]" id="obj">
                                  <input type="hidden" value="" name="ans[]" id="ans_obj">
                                </td>
                              <?php }?>
                            </tr>
                          <?php }}?>

                        </tbody>
                      </table>

                      <!-- may be its a draggable modal -->
                      <div id="skiping_question_answer" style="display:none">
                        <input type="text" name="set_skip_value" class="input-box form-control rs_set_skipValue">
                      </div>
                    </div>

                  </div>
                  <?php if($question_info_ind['operator'] == '/') {//Dividend  ?>
                    <div class="col-sm-4">
                      <div class="table-responsive">
                        <table class="dynamic_table_dividend table table-bordered">
                          <tbody class="dynamic_table_dividend_tbody">
                            <?php for($i = 1; $i <= 1; $i++) { ?>
                              <tr class="rw<?=$i?>">
                                <?php for($j = 0; $j < $question_info_ind['numOfRows']; $j++) {?>
                                  <td>
                                    <input type="text" data_q_type="0" data_num_colofrow="<?=$i?>_<?=$j?>" value="<?php echo $question_info_ind['dividend'][$j]?>" name="dividend[]" class="form-control input-box rsskpin rsskpinpt<?=$i?>_<?=$j?>" readonly style="min-width:50px;background-color: #ffb7c5">
                                    <input type="hidden" value="" name="ques_ans[]" id="obj">
                                    <input type="hidden" value="" name="ans[]" id="ans_obj">
                                  </td>
                                <?php }?>
                              </tr>
                            <?php }?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  <?php }?>
                </div>
              <?php }?>

              <input type="hidden" id="question_item" name="question_item" value="<?php echo $question_item; ?>">
              <input type="hidden" id="question_id" name="question_id" value="<?php echo $question_id; ?>">
            </div>
          </div>
        </div>

        <!--Set Question Solution on jquery ui-->
        <div id="dialog">
          <textarea  id="setSolution" style="display:none;">
            <?php echo $question_info[0]['question_solution']?>
          </textarea>
        </div>
        <input type="hidden" name="question_solution" id="setSolutionHidden" value='<?php echo $question_info[0]['question_solution']?>'>
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
              <img src="assets/images/icon_info.png" class="pull-left"> <span class="ss_extar_top20">Update Sucessfully</span> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn_blue" id="update_success_button" data-dismiss="modal">Ok</button>
              <a style="display:none;" class="btn btn_blue" id="update_success_button_with_url">Ok</a>
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

<div class="modal fade tutorialModal" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:70%">
        <div class="modal-content" style="height: 96vh;">
            <div class="modal-header" style="padding: 5px;border-bottom: none;">
                <button type="button" class="close preview_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding:0px 30px;">
                <div id="img_show" >
                    <div id="myCarousel" class="carousel" data-ride="carousel" style="border: none;">
                        <!-- Indicators -->
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">

                        </div>

                        <!-- Left and right controls -->
                        <div style="text-align: center;">
<!--                            <button class="sound_play" style="position: relative;bottom: -25px;left: 28%;background: transparent;border: none;color: #2198c5;"></button>-->
                            <a class=""  style="width:90px;display:inline-block;opacity: 1;position:relative;margin: 10px auto;">
                                <span class=" icon-change sound_play" style="line-height: 30px;text-shadow: none;left:-13px;color: #6e6a6a;font-size: 17px;"><img src="<?php base_url('/')?>assets/images/icon_sound.png"></span>
                                <!--                            <span class="glyphicon glyphicon-chevron-left icon-change" style="line-height: 30px;text-shadow: none;left:-13px;color: #2198c5;font-size: 17px;">Prev</span>-->
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="left carousel-control prev-btn-c" href="#myCarousel" data-slide="prev" style="width:90px;border:1px solid #62b1ce;border-radius: 4px;display:inline-block;opacity: 1;position:relative;margin: 10px auto;">
                                <span class=" icon-change" style="line-height: 30px;text-shadow: none;left:-13px;color: #6e6a6a;font-size: 17px;">Previous</span>
                                <!--                            <span class="glyphicon glyphicon-chevron-left icon-change" style="line-height: 30px;text-shadow: none;left:-13px;color: #2198c5;font-size: 17px;">Prev</span>-->
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control next-btn-c" href="#myCarousel" data-slide="next" style="width:90px;border:1px solid #62b1ce;border-radius: 4px;display:inline-block;opacity: 1;position:relative;margin: 10px auto;margin-right: 52px;">
                                <span class=" icon-change" style="line-height: 30px;text-shadow: none;right:-13px;color: #6e6a6a;font-size: 17px;">Next</span>
                                <!--                            <span class="glyphicon glyphicon-chevron-right icon-change" style="line-height: 30px;text-shadow: none;right:-13px;color: #2198c5;font-size: 17px;">Next</span>-->
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 15px;border-top:none;">
            </div>
        </div>
    </div>
</div>
<?php
$countTutorial = 0;
$countTutorial = count($question_tutorial);
?>
    <!-- Large modal -->
<div class="modal fade question_tutorial_modal" id="" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="" id="add_question_tutorial" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="questionType" value="<?=$question_info[0]['questionType']?>">
            <div class="modal-header" style="background: #e1dfdf;padding: 6px;margin: 3px;">
                <input type="submit" style="padding:1px 6px;border-radius: 0px;background: #fff;font-size: 14px; border: 2px solid #9b9696;color: #322e2e;" class="btn btn_blue" value="Save">
                <?php

                    $preview_display = 'none';
                    if(!empty($question_tutorial))
                    {
                        $preview_display = 'inline-block';
                    }
                    ?>
                <button type="button" class="btn btn_blue" id="q_tutorial_preview" preview_id="" style="display:<?php echo $preview_display;?>;padding:1px 6px;border-radius: 0px;background: #fff;font-size: 14px; border: 2px solid #9b9696;color: #322e2e;width:100px;">Preview</button>
                <button type="button" class="close" data-dismiss="modal" style="padding: 1px 4px;opacity: 1;background: #fff;font-size: 18px; border: 2px solid #9b9696;color: #322e2e;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
<!--                <button type="button" class="btn btn_blue" style="padding:4px 10px;border-radius: 0px; float: right" data-dismiss="modal">Cancel</button>-->
            </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
						<div class="progress" style="display: none;">
                                <div class="progress-bar progress-bar-striped active" role="progressbar"
                                     aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Loading...
                                </div>
                            </div>
                            <div id="tutorial_qus_contents">
                                    <div id="collapseOne" class="panel-collapse collapse in edit_question_tutorial" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="image_box_list ss_m_qu" id="edit_tutorial_content" style="box-shadow: 0px 0px 0px 0px #91b7ef;">
                                            <?php if (!empty($question_tutorial)){?>
                                            <?php foreach ($question_tutorial as $key => $value) {  ?>
                                                <div class="tab_1 tabdata_1<?php echo $key ?>">
												<div style="text-align: right;margin: 8px;"><span title="Delete item" class="delete-tutorial-item" style="cursor: pointer;border: 1px solid #dad9d7;background: #fff;padding: 2px 7px;font-weight: bold;color: #fc0b0b;" item-id="<?php echo $value['id']?>" >X</span></div>
                                                    <div class="form-group">
                                                        <div class="col-sm-4"><label for="inputEmail3" class="col control-label">Image file</label></div>
                                                        <div class="col-sm-8">
                                                            <div class="ss_edit_img">
                                                                <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $value["img"]; ?>">
                                                            </div>

                                                            <div style="margin:10px 0px 30px 0px;">
                                                                <p style="color:red;" id="img_id_<?php echo $key ?>"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" >
                                                            <?php if ($value["audio"] !="none" ) { ?>
                                                        <div class="col-sm-4"><label for="inputEmail3" class="col control-label">Audio File</label></div>
                                                        <div class="col-sm-8">
                                                                <audio controls>
                                                                    <source src ="<?php echo base_url() ?>assets/uploads/question_media/<?php echo $value["audio"]; ?>" type="audio/mpeg" >
                                                                </audio>

                                                            <div style="margin:10px 0px 30px 0px;">
                                                                <p style="color:red;" id="aud_id_'.$i.'"></p>
                                                            </div>

                                                        </div>
                                                            <?php } ?>
                                                    </div><br><br>
                                                    <div class="form-group" style="display:none !important">
                                                        <div class="col-sm-4"><label for="spchToTxt" class="col control-label">Speech to text</label></div>
                                                        <div class="col-sm-8">
                                                            <?php if ($value["speech"] !="none") { ?>
                                                                Speech <div class="col-xs-4" style="font-size: 18px; padding-right:0px">
                                                                    <i class="fa fa-volume-up edit_tutorial_speech" value="<?php echo $value["speech"] ?>"></i>
                                                                    <input type="hidden" id="wordToSpeak" value="<?php echo $value["speech"] ?>"></div>
                                                            <?php } ?>

                                                            <div style="margin:20px 0px;">
                                                                <p style="color:red;" id="spch_id_<?php echo $key ?>"></p>
                                                            </div>
                                                        </div>
                                                    </div><br><br>
                                                </div>
                                            <?php  } ?>


                                            <div class="row" style="background-color: #3595d6; margin-bottom:0; clear: both;" >

                                                <div class="col-sm-12" style="">
                                                    <div style="float:right;">
                                                        <div class="ss_pagination">
                                                            <div>
                                                                <button class="steprs_1" style="color: #4c4a4a; border: none; padding: 10px;font-weight: 500;" type="button" id="prevBtn1" onclick="nextPrev_1(-999)" >Previous</button>

                                                                <?php foreach ($question_tutorial as $key => $value) { ?>
                                                                    <button style="background: none; border: none; padding: 10px;font-weight: 500;" class="steprs_1 number_11<?php echo $key; ?>" style="width:45px;" id="qty2" value="<?php echo count($question_tutorial); ?>" type="button" onclick="showFixSlide_1(<?php echo $key; ?> )"><?php echo $key+1; ?></button>
                                                                <?php } ?>

                                                                <button type="button" style="color: #4c4a4a ;border: none; padding: 10px;font-weight: 500;" class="btn_work" id="nextBtn1" onclick="nextPrev_1(99999)">Next</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <script>
                                            var currentTab2 = 0;
                                            $('.number_11'+0).addClass("activtab");
                                            // Current tab is set to be the first tab (0)
                                            showTab1(currentTab2); // Display the current tab

                                            var qty2 = $("#qty2").val();

                                            for (i = 0; i < 4; i++) {
                                                $('.number_11'+i).show();
                                            }
                                            for (i = 4; i < qty2; i++) {
                                                $('.number_11'+i).hide();
                                            }

                                            function showTab1(n) {
                                                $('.tab_1').hide();
                                                $('.tabdata_1'+n).show();
                                            }

                                            function showFixSlide_1(n) {
                                                $(".steprs_1").each(function( index ) {
                                                    $(this).removeClass("activtab");
                                                })


                                                $('.number_11'+n).addClass("activtab");


                                                console.log(n);

                                                currentTab2 = n;
                                                showTab1(n);
                                                fixStepIndicator1(n);
                                            }


                                            function nextPrev_1(n){

                                                //previous clicked
                                                if(n <0 ){

                                                    currentTab2 = currentTab2 - 1;
                                                    fixStepIndicator1(currentTab2);
                                                    if(currentTab2<0) currentTab2 = 0;

                                                }
                                                //next clicked
                                                else{

                                                    currentTab2 = currentTab2 + 1;
                                                    fixStepIndicator1(currentTab2);
                                                    if(currentTab2 >= qty2) currentTab2 = qty2 - 1;
                                                }


                                                fixStepIndicator1();
                                                showTab1(currentTab2);

                                            }


                                            function fixStepIndicator1(currentTab) {

                                                x = currentTab2;

                                                $('.number_11'+parseInt(currentTab2 - 1)).removeClass("activtab");
                                                $('.number_11'+parseInt(currentTab2 + 1)).removeClass("activtab");

                                                $('.number_11'+currentTab2).addClass("activtab");

                                                if(x>=3){

                                                    s_1 = x+2;
                                                    s_2 = x-2;
                                                    for (i = s_2; i < s_1 + 1; i++) {
                                                        $('.number_11'+i).show();
                                                    }
                                                    for (i = 0; i < s_2; i++) {
                                                        $('.number_11'+i).hide();
                                                    }
                                                    for (i = s_1+1; i < qty2; i++) {
                                                        $('.number_11'+i).hide();
                                                    }

                                                }
                                                if(x<3){

                                                    for (i = 0; i < 4; i++) {
                                                        $('.number_11'+i).show();
                                                    }
                                                    for (i = 4; i < qty2; i++) {
                                                        $('.number_11'+i).hide();
                                                    }

                                                }

                                                if( x <= qty2 && x >= qty2-4){
                                                    for (i = qty2-5; i < qty2; i++) {
                                                        $('.number_11'+i).show();
                                                    }

                                                    for (i = 0; i < qty2-4; i++) {
                                                        $('.number_11'+i).hide();
                                                    }

                                                }
                                            }
                                        </script>
                                    </div>
                                <div class="">
                                    <div class="form-group ss_h_mi">
                                        <div class="error_show" style="color: #e41818;width: 166%;text-align: center; margin: 10px;"></div>
                                        <label for="exampleInputiamges1">How many images</label>
                                        <div class="select">
                                            <input type="hidden" id="question_id" name="question_id" value="<?php echo $question_id; ?>">
                                            <input class="form-control" type="number" value="1" id="box_qty_tutorial" onchange="getImageBox(this)">
                                        </div>
                                    </div>
                                </div>

                                <div class="" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">

                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

                                            <div class="image_box_list ss_m_qu">
                                                <div id="tbl_show"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Success Modal-->
<div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
                <img src="assets/images/icon_sucess.png" class="pull-left"> <span class="ss_extar_top20">Save Successfully</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue save_success_btn" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<!--Solution Modal-->
<div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body row">
                <i class="fa fa-close" style="font-size:20px;color:red"></i><br>
                <span class="ss_extar_top20">
                   Save Failed.please refresh browser and try again.
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade ss_modal" id="copy_chapter_success_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body">

        <h6 style="color:green">Successfully copy chapter name</h6>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div> 

<div class="modal fade ss_modal" id="chapter_info_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="to_delete_chapter_id">
        <p style="color:green" class="chapter_question_info">Successfully copy chapter name</p>

        <p>Which chapter do you want to move them to ?</p>

        <select class="form-control createQuesLabel moved_to_chapter_id" name="chapter" id="subject_chapter">
          <option value="">Select Chapter</option>
          <?php foreach ($subject_base_chapter as $chapter) { ?>
            <option value="<?php echo $chapter['id']; ?>">
              <?php echo $chapter['chapterName']; ?>
            </option>
          <?php } ?>
        </select>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>
        <button type="button" class="btn btn-danger" id="delete_chapter" style="padding: 2px 10px;">Delete</button>
      </div>
    </div>
  </div>
</div> 

<script>
  $(document).ready(function(e){
    $(".module_chapter_copy").click(function() {
        var copy_chapter_id = $("#subject_chapter").val();
        if(copy_chapter_id != ''){
          CopyToClipboard(copy_chapter_id);
          $("#copy_chapter_success_modal").modal("show");
        }else{
          alert('Please Select chapter First !!');
        }
        

    });

    $('.module_chapter_paste').click(function(){

        navigator.clipboard
        .readText()
        .then((cliptext) =>
              {
                $('#get_chapter_value').val(cliptext);
                var get_subject_value = $('#subject').val();
                var get_chapter_id = $('#get_chapter_value').val();


                if (get_subject_value == '') {

                  var response = '<p style="color: red;">Please Select Subject</p>';
                  $('#add_ch_success').html(response);

                }else if (get_chapter_id == '') {

                  var response = '<p style="color: red;">Chapter Field Can Not Be Empty</p>';
                  $('#add_ch_success').html(response);

                }else {

                  $('#subject_chapter').val(get_chapter_id).change();

                }
              },
                err => console.log(err)
        );
        
    });

    $('.module_chapter_delete').click(function(){
        var subject_id = $('#subject').val();
        var copy_chapter_id = $("#subject_chapter").val();
        if(copy_chapter_id != ''){
          $.ajax({
            url: "get_chapter_info",
            method: "POST",
            data: {subject_id:subject_id,chapter_id:copy_chapter_id},
            success: function (response) {
              var data = JSON.parse(response);

              var text = 'This chapter used in '+data.chapter_use+' questions';
              $('.chapter_question_info').text(text);
              $('#to_delete_chapter_id').val(data.chapter_id);
              console.log(data);
              $("#chapter_info_modal").modal("show");
            }
          });
          
        }else{
          alert('Please Select chapter First !!');
        }
    });

    $('#delete_chapter').click(function(){
       var from_chapter_id = $('#to_delete_chapter_id').val();
       var to_chapter_id = $('.moved_to_chapter_id').val();
       if(to_chapter_id != ''){
          $.ajax({
            url: "chapter_moved_to_question",
            method: "POST",
            data: {from_chapter_id:from_chapter_id,to_chapter_id:to_chapter_id},
            success: function (response) {
              var text = response+' questions updated';
              alert(text);
              $("#chapter_info_modal").modal("hide");
              $("#subject_chapter").val(to_chapter_id);
            }
          });
       }else{
        alert('Please select new chapter !');
       }
       

    });



  });


        function setSolution() {

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
//            console.log(paragraph_order);
//            console.log(arr);
            if(paragraph_order.length > 0){
                for(var i = 0;i < arr.length; i++){
                    if(paragraph_order[i] == ''){
                        is_submit = 0;
                    }
                }
               
            }
            
            var form = $("#question_form");
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
                $('#textarea_1').html('')
              }else{
                $('#question_name_type').val(1)
                $('#textarea_2').html('');
              }

              
              if (first_question == 1 && second_question == 1) {
          
              }else{

                
                if ($('#questionName_1').val() !='' && $('#questionName_2').val() !='') {
                  alert('You can not use at a time two question ')
                  return ;
                }
                
              }
              
            }
            
            var pathname = '<?php echo base_url(); ?>';
            
            if(is_submit == 1) {
				CKupdate();

				$.ajax({
					url: "update_question_data",
					type: "POST",
					//data: form.serialize(),
					data: new FormData(this),
					processData:false,
					contentType:false,
					cache:false,
          dataType:'html',
					success: function (response) {

            if (response == "update") {
              
            
            <?php 
              if(!empty($this->session->userdata('module_status'))){
            ?>
          
                var module_status = <?php echo $this->session->userdata('module_status'); ?>;
               
                <?php 
                  if(!empty($this->session->userdata('param_module_id'))){
                ?>
                  var param_module_id = <?php echo $this->session->userdata('param_module_id'); ?>;
                <?php }?>

                if (module_status == 1) {
                  // window.location.href = "<?//=base_url()?>create-module/1";
                  var get_url = "<?=base_url()?>create-module/1";
                  
                  $("#update_success_button").hide();
                  $("#update_success_button_with_url").css('display','inline-block');
                  $("#update_success_button_with_url").attr('href',get_url);
                }else if (module_status == 2) {
                  // window.location.href = "<?//=base_url()?>new-edit-module/"+param_module_id;
                  var get_url = "<?=base_url()?>new-edit-module/"+param_module_id; 
                  
                  $("#update_success_button").hide();
                  $("#update_success_button_with_url").css('display','inline-block');
                  $("#update_success_button_with_url").attr('href',get_url);
                }
            <?php }?>

            <?php 
              if(!empty($this->session->userdata('module_edit_status'))){
            ?>
                  var module_edit_status = <?php echo $this->session->userdata('module_edit_status'); ?>;
               
                  if(module_edit_status==2){
                    <?php 
                      if(!empty($this->session->userdata('module_status_edit_id'))){
                    ?>
                    var module_id = <?php echo $this->session->userdata('module_status_edit_id');?>;
                    <?php }
                      
                    ?>

                    var get_url = "<?=base_url()?>new-edit-module/"+module_id+"/"+module_edit_status;
                 
                    $("#update_success_button").hide();
                    $("#update_success_button_with_url").css('display','inline-block');
                    $("#update_success_button_with_url").attr('href',get_url);
                  }else if(module_edit_status==1){
                    
                    var get_url = "<?=base_url()?>create-module/1";
                    
                    $("#update_success_button").hide();
                    $("#update_success_button_with_url").css('display','inline-block');
                    $("#update_success_button_with_url").attr('href',get_url);
                  }
                  
            <?php }?>

              $(".progress").hide();
              $("#ss_sucess_mess").modal('show');
            }
            if (response == "Each part needs a right and wrong Question") {

              alert(response)
            }
					}





				});
			} else {
                alert('Please set all sentence to any paragraph');
            }
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
              $('.moved_to_chapter_id').html(response);
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
          var data = $("#add_subject_wise_chapter").serialize();
          $.ajax({
            url: "add_chapter",
            method: "POST",
            dataType: 'html',
            data: data,
            success: function (response) {
            // if (response == 1) {
              $('#add_ch_success').html('Chapter added successfully');
              $('#add_chapter').modal('hide');
            // } else {
              $('#subject_chapter').html(response);
            // }
          }
        });
        }

        function setMark() {
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

          var decimal_digit = parseInt(number) + parseFloat(first_fraction_digit / second_fraction_digit);
          if(first_fraction_digit == second_fraction_digit){
            decimal_digit = parseInt(number) * parseFloat(first_fraction_digit / second_fraction_digit);
          }
          decimal_digit = decimal_digit.toFixed(2);
          $("#marks").html(decimal_digit) ;
          $("#marks_value").val(decimal_digit) ;
          $("#mark_icon").hide() ;
          $("#marks").show() ;

          $('#set_marks').modal('hide');
        }


        /*autocomplete*/
        $(document).ready(function(){ 
       
		
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
                { name: 'document', items: ['SVideo', 'Youtube'] }, 
        
                ]
              });
			
			$('.wordSearch').devbridgeAutocomplete({
				serviceUrl: 'Subject/suggestSubject',
				onSelect: function (suggestions) {
					console.log(suggestions.answer);
				}
			});
        })

      </script>
	  
	  <script>
    $("#question_tutorial").click(function (event) {
        event.preventDefault();
        $(".question_tutorial_modal").modal('show');
    });
    function getImageBox() {
        var qty = $("#box_qty_tutorial").val();
		//AS
        var qus_type ="<?=$question_info[0]['questionType']?>";
		
        $.ajax({
            url:"<?php echo base_url(); ?>Tutor/input_tutor",
            type:"post",
            dataType:'html',
            data:{qty:qty,qus_type:qus_type},
            success:function(data){

                $('#tbl_show').html(data);

            }
        });
    }

    $("#add_question_tutorial").on('submit', function(e) {
        e.preventDefault();

        // $('.error_show').html('');
        // // var form = $("#add_question_tutorial");
        var check  = 1;
        // $("#add_question_tutorial :input").each(function(){
        //     if($(this).val() == ''){
        //
        //         var name = $(this).attr('count_here');
        //
        //         if (name !== undefined ) {
        //
        //             $('.error_show').prepend("<div>"+name+" is empty</div>");
        //             check = 0;
        //             return;
        //         }
        //     }
        // });

        if (check == 1)
        {
			$(".progress").show();
            $.ajax({
                url:"<?php echo base_url(); ?>Tutor/add_question_tutorial",
                type:"POST",
                dataType:'json',
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                success:function(data){
                    if (data.error == true)
                    {
						$(".progress").hide();
                        $("#ss_info_worng").modal("show");
                    }
                    if (data.success == true)
                    {
						$(".progress").hide();
                        $('#add_question_tutorial')[0].reset();
                        $("#q_tutorial_preview").css("display","inline-block");
                        $("#edit_tutorial_content").html(data.html);
                        $("#ss_info_sucesss").modal("show");
                    }
                }
            });
        }
    });
     $("body").delegate(".delete-tutorial-item", "click", function(){
        $(".progress").show();
        var item_id = $(this).attr('item-id');
        var question_id =  $("#question_id").val();
        console.log(item_id);
        $.ajax({
            url:"<?php echo base_url(); ?>Tutor/delete_question_tutorial_item",
            type:"post",
            dataType:'html',
            data:{item_id:item_id,question_id:question_id},
            success:function(data){
                console.log(data);
                $(".progress").hide();
                $("#edit_tutorial_content").html(data);
            }
        });
    });
    $("#q_tutorial_preview").click(function () {
       var question_id =  $("#question_id").val();

       if (question_id)
       {
           $.ajax({
               url:"<?php echo base_url(); ?>Tutor/question_tutorial_preview",
               type:"post",
               dataType:'html',
               data:{question_id:question_id},
               success:function(data){
                   console.log(data);
                   $(".question_tutorial_modal").modal("hide");
                   $("#tutorialModal .carousel-inner").html(data);
                   $('#tutorialModal').modal('show');
                   var word =  $("#tutorialModal #myCarousel .item.active").attr("id");
                   console.log(word);
                   if (word =='none')
                   {
					   $(".sound_play").hide();
                       return true;
                   }else {
                       $(".sound_play").show();
                   }
                   speak(word);
               }
           });
       }
    });
</script>
<!--<script src="https://code.responsivevoice.org/responsivevoice.js"></script>-->

<script>
    $(window).on('load', function () {
        $('#myCarousel').carousel({
            pause: true,
            interval: false,
            wrap: false,
        });
        // $("#tutorialModal #myCarousel .carousel-inner .item:first").addClass( 'active' );
        var word =  $("#tutorialModal #myCarousel .item.active").attr("id");
        console.log(word);
        if (word =='none')
        {
			$(".sound_play").hide();
            return true;
        }else {
            $(".sound_play").show();
        }
        speak(word);
    });
    var count = 1;
    var countTutorial = '<?php echo $countTutorial;?>';
    function speak(word) {
        responsiveVoice.speak(word);
    }
    $('#myCarousel').on('slide.bs.carousel', function onSlide (ev) {
        var word = ev.relatedTarget.id;
		console.log(word);
        if (word =='none')
        {
			$(".sound_play").hide();
            return true;
        }else {
            $(".sound_play").show();
        }
        speak(word);
    });
    $(".sound_play").click(function () {
        var word =  $("#tutorialModal #myCarousel .item.active").attr("id");
        console.log(word);
        if (word =='none')
        {
            return true;
        }
        speak(word);
    });
    $("body").delegate(".edit_tutorial_speech", "click", function(){
        var word = $(this).attr('value');
        console.log(word);
        if (word =='none')
        {
            return true;
        }
        speak(word);
    });
	 $( "body" ).delegate( ".img-validate", "change", function() {
        $this = jQuery(this);
        var fsize = $this[0].files[0].size,
            ftype = $this[0].files[0].type,
            fname = $this[0].files[0].name,
            fextension = fname.substring(fname.lastIndexOf('.')+1);
        validExtensions = ["png","PNG"];
        console.log(fsize);
        console.log(ftype);
        if ($.inArray(fextension, validExtensions) == -1){
            alert("This type of files are not allowed!");
            this.value = "";
            return false;
        }else{
            if(fsize > 3145728){/*1048576-1MB(You can change the size as you want)*/
                alert("File size too large! Please upload less than 3MB");
                this.value = "";
                return false;
            }
            return true;
        }
    });
    // $(".edit_tutorial_speech").click(function () {
    //
    // });
    // $(".prev-btn-c").click(function () {
    //     count--;
    //     if (count < 1)
    //     {
    //         $("#tutorialModal").modal('hide');
    //     }
    // });
    // $(".next-btn-c").click(function () {
    //     count++;
    //     if (count > countTutorial)
    //     {
    //         count = countTutorial;
    //         $("#tutorialModal").modal('hide');
    //     }
    // });

    $(".preview_close").click(function () {
        $(".question_tutorial_modal").modal("show");
    });
    
    $("#show_module_list").click(function () {
        $(".module_list_class").show();
    });
    // var pPage = '';
    // console.log(pPage);
</script>