<?php

    date_default_timezone_set($this->site_user_data['zone_name']);
    $module_time = time();
    
    $key = $question_info_s[0]['question_order'];
    $desired = $this->session->userdata('data');
    
//    For Question Time
    $question_time = explode(':',$question_info_s[0]['questionTime']);
    $hour = 0;
    $minute = 0;
    $second = 0;
    if(is_numeric($question_time[0])) {
        $hour = $question_time[0];
    } if(is_numeric($question_time[1])) {
        $minute = $question_time[1];
    } if(is_numeric($question_time[2])) {
        $second = $question_time[2];
    }

    $question_time_in_second = ($hour * 3600) + ($minute * 60) + $second ;
    $module_type = $question_info_s[0]['moduleType'];
//    End For Question Time
?>

<?php 


foreach ($total_question as $ind) {

if ($ind["question_type"] == 14) {
  $chk = $ind["question_order"];
 }

} 
  ?>

<?php 
    $question_instruct = isset($question_info_s[0]['question_video']) ? json_decode($question_info_s[0]['question_video']):'';
    $question_instruct_id = $question_info_s[0]['id'];
?>
  <style type="text/css">
      body .modal-ku {
    width: 750px;
    }

    .modal-body #quesBody {
         width: 628px;
        height: 389px;
        overflow: auto;
    }

    #ss_extar_top20{
        width: 628px;
        height: 389px;
        overflow: auto;
    }
    </style>

<style type="text/css">
.storyWritePartsImage img {
    max-width: 100%;
    height: 150px!important;
}

.buttonDisable {
  display: none;
}

.buttonEnable {
  display: block;
}

/*to update*/

.modalTitleColor{
    color: #008cff;
    margin-bottom: 7px;
    font-size: 18px;
}

.ss_extar_top20 {
 padding-top: 0!important; 
}

button {
  color: #6d6dd6;
}

button:disabled,
button[disabled]{
	background: #dadada;
}

#login_form .modal-content, .ss_modal .modal-content {
    border: 1px solid #a6c9e2;
    padding: 5px;
    margin-left: -215px;
}
.description_video{
   position: relative;
}
.description_class{
    position: absolute;
    left: 45px;
}
.question_video_class{
    position: absolute;
    left: 70px;
}

</style>

<!--         ***** For Tutorial & Everyday Study *****         -->    
<?php // if ($module_type == 2 || $module_type == 1) { ?>
    <input type="hidden" id="exam_end" value="" name="exam_end" />
    <input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
    <input type="hidden" id="optionalTime" value="<?php echo $question_time_in_second;?>" name="optionalTime" />
    <input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />
<?php // }?>


<input type="hidden" id="paragraphSl" value="1">

<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="ss_index_menu">
            <a href="#">Module Setting</a>
        </div>
    
    <?php if ($question_time_in_second != 0) { ?>
            <div class="col-sm-4" style="text-align: right">
                <div class="ss_timer" id="demo"><h1>00:00:00 </h1></div>
            </div>
        <?php }?>
    
        <div class="col-sm-6 ss_next_pre_top_menu">
            <?php if ($question_info_s[0]['isCalculator']) : ?>
                <input type="hidden" name="" id="scientificCalc">
            <?php endif; ?>
            
            <?php if ($question_info_s[0]['question_order'] == 1) { ?>                                                      
                <a class="btn btn_next" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/1"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
            <?php } else { ?>
                <a class="btn btn_next" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/<?php echo ($question_info_s[0]['question_order'] - 1); ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
            <?php } ?> 
            
            <?php if (array_key_exists($key, $total_question)) { ?>
                <a class="btn btn_next" id="question_order_link" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/<?php echo $question_info_s[0]['question_order'] + 1; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
            <?php } ?>                                                                              
            <a class="btn btn_next" id="draw" onClick="showDrawBoard()" data-toggle="modal" data-target=".bs-example-modal-lg">
                Draw <img src="assets/images/icon_draw.png">
            </a>
        </div>
    </div>
    
    
    
    <div class="container-fluid">
        <form id="answer_form">
          <input type="hidden" name="answerGiven" id="answerGiven" value="1">
            <input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id'] ?>" name="module_id">
            <?php if (array_key_exists($key, $total_question)) { ?>
                <input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] + 1; ?>" name="next_question" />
            <?php } else { ?>
                <input type="hidden" id="next_question" value="0" name="next_question" />
            <?php } ?>
            <input type="hidden" value="<?php echo $question_info_s[0]['question_id']; ?>" name="question_id" id="question_id">
            <input type="hidden" id="current_order" value="<?php echo $key; ?>" name="current_order">
            <input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType']; ?>" name='module_type'>
            
            <div class="row">
                <img id="canvasImage" src="">
                <div class="ss_s_b_main" style="min-height: 100vh">
                    <div class="col-sm-2">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <span style="background: #959292;color: white; border: 5px solid #959292;"><img src="assets/images/icon_draw.png"> Instruction</span>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="storyWriteAnsBox">
                         <div class="row">
                            <div class="col-sm-4">
                                <div id="ansPicture"></div>
                            </div>
                            <div class="col-sm-1">
                                
                            </div>
                            <div class="col-sm-7">
                                <div id="ansTitle"></div>
                            </div>
                         </div>

                        <div class="other_parts">
                            <div id="ansIntro"></div>
                            <div id="ansParagraph"></div><br>
                            <div id="ansConclusion"></div><br>
                        </div>
                    </div>

                    <div class="storyWriteBody">

                        <?php foreach ($question['titles'] as $key => $val)  { ?>
                            <div class="storyWriteParts">
                                <div class="firstElementStoryWrite"> <?= $val[0]; ?> </div>
                                <div class="chooseBtnStoryWrite"> <button type="button" disabled id="titleBtn" class="titleBtn_<?= $key; ?> titleBtn 1 btn" onclick="rightOrWrong('<?= $val[1]; ?>' , '<?= $val[0]; ?>' , 'titleBtn_<?= $key; ?>' , 'titleBtn' , 1)">Choose</button>  </div>
                            </div>
                        <?php } ?>

                        <br>

                        <div class="storyWritePartsImage">
                            <?php foreach ($question['picture'] as $key => $val)  { ?>
                                    <div class="firstElementStoryWrite"> <img src="<?= base_url('/assets/uploads/').$val[0]; ?>" height="150px" width="150px"> </div><br> 
                                    <div class="chooseBtnStoryWriteImg"> <button type="button" id="pictureBtn" class="pictureBtn_<?= $key; ?> pictureBtn 2 btn" style="display: none;" onclick="rightOrWrong('<?= $val[1]; ?>' , '<?= base_url('/assets/uploads/').$val[0]; ?>' , 'pictureBtn_<?= $key; ?>' , 'pictureBtn' , 2)">Choose</button>  </div>
                            <?php } ?>
                        </div>

                        <br>

                        <?php foreach ($question['Intro'] as $key => $val)  { ?>
                            <div class="storyWriteParts">
                                <div class="firstElementStoryWrite"> <?= $val[0]; ?> </div>
                                <div class="chooseBtnStoryWrite"> <button type="button" id="introBtn" class="introBtn_<?= $key; ?> introBtn 3 btn" style="display: none;" onclick="rightOrWrong('<?= $val[1]; ?>', '<?= $val[0]; ?>' , 'introBtn_<?= $key; ?>' , 'introBtn' , 3)">Choose</button>  </div>
                            </div>
                        <?php } ?>

                        <br>

                        <?php $i=0; foreach ($question['paragraph'] as $key_2 => $val) { $paragraph_count = isset($val['Paragraph']) ? count($val['Paragraph']) : 0; $PuzzleParagraph = isset($val['PuzzleParagraph']) ? count($val['PuzzleParagraph']) : 0;  $RightAnswer = isset($val['RightAnswer']) ? count($val['RightAnswer']) : 0; $totalCount  = $RightAnswer + $paragraph_count + $PuzzleParagraph; $sl_no = $key_2;  ?>
                            <div class="storyWriteParts">
                                <?php foreach ($val as $key_3 => $value) {  ?>
                                <?php foreach ($value as $key_4 => $values) { $i++;  ?>
                                   <div class="firstElementStoryWrite paragraphFirstEm<?= $key_2; ?>"> <?= $values; ?> </div>

                                   <?php if ($key_3 =="Paragraph") { $val[1] = "right_ones_xxx"; ?>
                                       <div class="chooseBtnStoryWrite"> <button type="button" id="paragraphBtn" class="paragraphBtn_<?= $key_4; ?> paragraphBtn 4 btn offparagraph_<?= $key_2; ?> disabledButton<?= $i; ?>" style="display: none;" onclick="rightOrWrongParagraph('<?= $val[1]; ?>' , '<?= $values; ?>', 'paragraphBtn_<?= $key_4; ?>' , 'paragraphBtn' , 4 , '<?= $key_2; ?>' , '<?= $totalCount; ?>' , '<?= $i; ?>')">Choose</button></div>
                                   <?php } ?>

                                   <?php if ($key_3 =="RightAnswer") { $val[1] = "rightOne"; ?>
                                       <div class="chooseBtnStoryWrite"> <button type="button" id="paragraphBtn" class="paragraphBtn_<?= $key_4; ?> paragraphBtn 4 btn offparagraph_<?= $key_2; ?> disabledButton<?= $i; ?>" style="display: none;" onclick="rightOrWrongParagraph('<?= $val[1]; ?>' , '<?= $values; ?>', 'paragraphBtn_<?= $key_4; ?>' , 'paragraphBtn' , 4 , '<?= $key_2; ?>' , '<?= $totalCount; ?>' , '<?= $i; ?>')">Choose</button></div>
                                   <?php } ?>

                                   <?php if ($key_3 =="PuzzleParagraph") { $val[1] = "wrong_ones_xxx"; ?>
                                       <div class="chooseBtnStoryWrite"> <button type="button" id="paragraphBtn" class="paragraphBtn_<?= $key_4; ?> paragraphBtn 4 btn offparagraph_<?= $key_2; ?> disabledButton<?= $i; ?>" style="display: none;" onclick="rightOrWrongParagraph('<?= $val[1]; ?>' , '<?= $values; ?>', 'paragraphBtn_<?= $key_4; ?>' , 'paragraphBtn' , 4 , '<?= $key_2; ?>' , '<?= $totalCount; ?>' , '<?= $i; ?>')">Choose</button></div>
                                   <?php } ?>

                                   <?php if ($key_3 =="WrongAnswer") { $val[1] = $question['wrongParagraphIncrement'][$key_2]['WrongAnswer'][$key_4]; ?>
                                       <div class="chooseBtnStoryWrite"> <button type="button" id="paragraphBtn" class="paragraphBtn_<?= $key_4; ?> paragraphBtn 4 btn offparagraph_<?= $key_2; ?> disabledButton<?= $i; ?>" style="display: none;" onclick="rightOrWrongParagraph('<?= $val[1]; ?>' , '<?= $values; ?>', 'paragraphBtn_<?= $key_4; ?>' , 'paragraphBtn' , 4 , '<?= $key_2; ?>' , '<?= $totalCount; ?>' , '<?= $i; ?>')">Choose</button></div>
                                   <?php } ?>

                                <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <br>

                        <?php foreach ($question['conclution'] as $key => $val)  { ?>
                            <div class="storyWriteParts">
                                <div class="firstElementStoryWrite"> <?= $val[0]; ?> </div>
                                <div class="chooseBtnStoryWrite"> <button type="button" id="conclutionBtn" class="conclutionBtn_<?= $key; ?> conclutionBtn 5 btn" style="display: none;" onclick="rightOrWrong('<?= $val[1]; ?>' , '<?= $val[0]; ?>', 'conclutionBtn_<?= $key; ?>' , 'conclutionBtn' , 5)">Choose</button>  </div>
                            </div>
                        <?php } ?>

                        <br>
                    </div>

                    <div class="text-center">
                      <button class="btn btn_next" type="button" id="answer_matching" style="display: none;">Submit</button>
                    </div> 
                </div>

                <script type="text/javascript">

                  var ans_;
                  var title_;
                  var orderBtn_;
                  var groupBtn_;
                  var classOder_;
                  var paragraphSL_;
                  var total_count_;
                  var disabledButton_;
                  var paragraphFlag_;
                  var countss = 0;
                  var sl_no = '<?= $sl_no; ?>';
                  var paragraphSerial = 1;
                  var showNextParagraph = 1;
                  var itzPuzzpleClicked;
                  var clickedbeforePuzzle = 0;

                  function rightOrWrongParagraph(ans , title , orderBtn , groupBtn , classOder , paragraphSL , total_count ,disabledButton){

                    if (ans == "wrong_ones_xxx") {
                        itzPuzzpleClicked = 1;

                      }else{
                        itzPuzzpleClicked = 0;
                      }

                      if (ans == "right_ones_xxx" || ans == "rightOne" ) {
                         clickedbeforePuzzle = 1;
                      }
                      total_count_ = total_count;
                      disabledButton_ =  disabledButton ;
                      classOder_ = classOder;

                      $(".offparagraph_"+paragraphSerial+"").show();
                      
                      if (ans == "right_ones_xxx" || ans == "wrong_ones_xxx" ) {
                          $("#ParagrapConfirmModal").modal('show');
                      }

                      if (ans != "right_ones_xxx" && ans != "wrong_ones_xxx"  && ans != "rightOne" ) {
                          var wrongTitle = removeTags(ans);
                            $("#showWrongTitleStoryWrite").html( "<span style='text-align: center;' >"+wrongTitle+"</span><br>");

                            var wrongTitle = removeTags(ans);
                            if (wrongTitle == "noInput") {
                              wrongTitle = "";
                            }

                            $("#showWrongTitleStoryWrite").html( "<span style='text-align: center;' >"+wrongTitle+"</span><br>");

                            $('#wrongModal').modal('show');
                            $(".disabledButton"+disabledButton+"").prop('disabled', true);
                            $("#answerGiven").val(0);

                      }

                      if (ans == "rightOne") {
                            $(".disabledButton"+disabledButton+"").prop('disabled', true);
                            $("#ansParagraph").append( "<span style='text-align: center;' >"+title+"</span>");
                      }

                      ans_ = ans;
                      title_ = title;
                      orderBtn_ = orderBtn;
                      groupBtn_ = groupBtn;
                      classOder_ = classOder;
                      paragraphSL_ = paragraphSL;
                      total_count_ = total_count;
                      disabledButton_ = disabledButton;
                      startConclusion = 0;

                      if ( ans_ == "rightOne") {
                        countss++;
                          if (total_count_ == countss) {
                              paragraphFlag_ = 1;
                              countss = 0;
                              if (sl_no == paragraphSerial ) {
                                classOder = classOder_;
                                  classOder++;
                                  $("."+classOder+"").show();
                                  showNextParagraph = 1;

                                  $("#question_msgShowConclusion").html(" <p class='modalTitleColor'> ''Conclusion'' </p> You have to choose a 'Conclusion' for the story. Read the entire story carefully before you choose the conclusion.");    
                                  startConclusion = 1;

                                  if (ans == "rightOne") {
                                    conclusionModalCall();
                                  }

                                }else{
                                  showNextParagraph = 0;
                                }

                                if (ans == "rightOne" && showNextParagraph == 0) {
                                  $("#correctParagraph").modal("show");
                                  if (showNextParagraph == 0) {
                                      $("#question_msgShow_2_2").html("Choose the next paragraph.")
                                      // $("#ansParagraph").append( "<span style='text-align: center;' > <br><br> </span>");
                                  }

                                }

                                if (startConclusion == 0 && ans == "rightOne" && showNextParagraph != 0) {
                                  $("#correctParagraph").modal("show");
                                }

                                var pSL = $("#paragraphSl").val();
                                $(".offparagraph_"+paragraphSerial+"").prop('disabled', true);
                                paragraphSerial++;
                                xxx =  paragraphSerial
                                $("#paragraphSl").val(xxx);
                                $(".offparagraph_"+xxx+"").show();
                          }else{
                                if (startConclusion == 0 && ans == "rightOne" && showNextParagraph != 0) {
                                  $("#correctParagraph").modal("show");
                                }

                              paragraphFlag_ = 0;
                          }
                      }
                  }

                  function decisionParagraph(argument) {
                    $(".disabledButton"+disabledButton_+"").prop('disabled', true);
                      if (ans_ == "wrong_ones_xxx" && argument == "no") {
                          if (argument == "no") {
                              argument ="right_ones_xxx";
                          }
                      }else if (ans_ == "right_ones_xxx" && argument == "no") {
                          if (argument == "no") {
                              argument ="wrong_ones_xxx";
                          }
                      }else if (ans_ == "wrong_ones_xxx" && argument == "right_ones_xxx") {
                          if (argument == "right_ones_xxx") {
                              argument ="wrong_ones_xxx";
                          }
                      }else if (ans_ == "WrongAnswer") {
                              argument ="WrongAnswer";
                      }


                      if (ans_ == "right_ones_xxx" || ans_ == "wrong_ones_xxx" ) {
                        countss++;
                          if (total_count_ == countss) {

                              paragraphFlag_ = 1;
                              countss = 0;
                              if (sl_no == paragraphSerial ) {

                                  classOder = classOder_;

                                  classOder++;
                                  $("."+classOder+"").show();
                                  showNextParagraph = 1;

                                  $("#question_msgShowConclusion").html(" <p class='modalTitleColor'> ''Conclusion'' </p> You have to choose a 'Conclusion' for the story. Read the entire story carefully before you choose the conclusion.");    
                                  startConclusion = 1;

                                }else{
                                  showNextParagraph = 0;
                                }

                                var pSL = $("#paragraphSl").val();
                                $(".offparagraph_"+paragraphSerial+"").prop('disabled', true);
                                paragraphSerial++;
                                xxx =  paragraphSerial
                                $("#paragraphSl").val(xxx);
                                $(".offparagraph_"+xxx+"").show();
                              
                          }else{
                              paragraphFlag_ = 0;
                          }
                      }



                      rightOrWrong(argument , title_ , orderBtn_ , groupBtn_ , classOder_);
                  }

                  function rightOrWrong(ans , title , orderBtn , groupBtn , classOder) {
                      if (ans == "WrongAnswer") {
                          $(".disabledButton"+disabledButton_+"").prop('disabled', true);
                      }else{
                          if (ans =="right_ones_xxx") {
                              paragraphSLL = paragraphSL_;

                              if (classOder == 1 ) {
                                  $("#ansTitle").html( " <span style='padding: 1px 0;color: whitesmoke;'>Title:</span><br><br> <span style='text-align: center;' >"+title+"</span><br><br>");

                                  $("#question_msgShow").html(" <p class='modalTitleColor'> ''Picture'' </p> You have to choose a 'picture' for the story. Read the entire story carefully before you choose the picture.")
                                  $("#correctModal").modal("show")
                                  
                              }
                              if (classOder == 2 ) {
                                  $("#ansPicture").html( " <img src="+title+"  height='150px' weight='150px' /> ");

                                  $("#question_msgShow").html(" <p class='modalTitleColor'> ''Introduction'' </p> You have to choose an 'introduction' for the story. Read the entire story carefully before you choose the introduction.");
                               
                                  $("#correctModal").modal("show");
                              }
                              if (classOder == 3 ) {
                                  $("#ansIntro").html( "<span style='padding: 1px 0;color: whitesmoke;'>Introduction:</span><br><br> <span style='text-align: center;' >"+title+"</span><br><br> <span style='padding: 1px 0;color: salmon;'>Body:</span><br><br> ");

                                  $("#question_msgShow").html(" <p class='modalTitleColor'> ''Body'' </p> You have to choose a 'body' for the story. Read the entire story carefully before you choose the body.");
                               
                                  $("#correctModal").modal("show");
                              }
                              if (classOder == 4 ) {
                                  $("#question_msgShow").html("Your Assumption is right")
                                  $("#msg_modal").modal("show")

                                  $("#ansParagraph").append( "<span style='text-align: center;' >"+title+"</span>");

                                  // if (paragraphFlag_) {
                                  //   $("#ansParagraph").append( "<span style='text-align: center;' > <br><br> </span>");
                                  // }

                                  
                              }
                              if (classOder == 5 ) {
                                  $("#answer_matching").show();
                                  $(".ss_info_congratulationMSG").html(" <span style='color:red;' > <b>Congratulations!</b> </span> <br><br> <span> Your story writing tutorial has been successfully completed. Now review your story and <span style='color:red;' > ''Submit'' </span></span> ")
                                  $("#ss_info_congratulation").modal("show")
                                  $("#ansConclusion").html( "<span style='padding: 1px 0;color: whitesmoke;'>Conclution:</span><br><br><span style='text-align: center;' >"+title+"</span><br>");
                              }

                              if (classOder == 4) {
                                  $(".disabledButton"+disabledButton_+"").prop('disabled', true);

                              }else{
                                  $("."+groupBtn+"").prop('disabled', true);
                                  classOder++;

                                  var pSL = $("#paragraphSl").val();
                                  var pSL_sl = '<?= $sl_no; ?>';

                                  if (classOder == 4) {
                                      $(".offparagraph_"+pSL+"").show();
                                  }else{
                                      $("."+classOder+"").show();
                                  }
                              }
                              
                          }else{
                              $("#answerGiven").val(0);

                            if (classOder == 1 || classOder == 3 || classOder == 2 || classOder == 5 ) {
                                var wrongTitle = removeTags(ans);
                                if (wrongTitle == "noInput") {
                                  wrongTitle = "";
                                }
                                

                                if (classOder == 1) {
                                  wrongTitle = "This is not the correct <span style='color:red;'> <b>''Title''</b> </span> for the story. You have to choose the title which is related to the story.  <br> <br> <b> Why is a title important to a story? </b> <br><br> The importance of titles. The title of your manuscript is usually the first introduction readers have to your  published work. Therefore, you must select a title that grabs attention, accurately describes the contents of your manuscript, and makes people want to read further. "
                                }

                                if (classOder == 2) {
                                  wrongTitle = "This is not the correct <span style='color:red;'> <b>''picture''</b> </span> for the story. You have to choose the picture which is related to the story. <br> <br> <b> Why is a picture important to a story? </b> <br><br> A picture is a great way to convey your message quickly to an audience without them reading through a lot of text. <br> Shareability: Images can be easily shared by other people, which means your story will be seen be a larger audience. You could even link the image back to an article you want your target audience to read."
                                }

                                if (classOder == 3) {
                                  wrongTitle = "This is not the correct <span style='color:red;'> <b>''introduction''</b> </span> for the story. You have to choose the introduction which is related to the story.<br> <br> <b> Why is an introduction important to a story? </b> <br><br> Introductions are important because they provide a first impression, establish credibility with your audience, and prepare the audience for the speech's content . First,the introduction gives your audience the first impression of your speech."
                                }

                                $("#showWrongTitleStoryWrite").html( "<span' >"+wrongTitle+"</span><br>");
                                $('#wrongModal').modal('show');
                            }

                            if ( classOder == 4  ) {
                                var wrongTitle = removeTags(ans);
                                if (wrongTitle == "noInput") {
                                  wrongTitle = "";
                                }

                                $("#showWrongParaStoryWrite").html( "<span style='text-align: center; color:red;' > <b> Your Assumption is Wrong  </b> </span> <br><br> <b> Paragraph are </b> a collection of sentences. They <b> are </b> used in writing to introduce new section of a story , characters or peices of information . <b> Paragraphs </b> break text up into easy-to-read sections. <br>");

                                $('#wrongParagraphModal').modal('show');

                                $("#ansParagraph").append( "<span style='text-align: center;' >"+title+"</span>");

                                // if (paragraphFlag_) {
                                //     $("#ansParagraph").append( "<span style='text-align: center;' > <br><br> </span>");
                                //   }
                            }

                            if (classOder == 4 ) {

                              $(".disabledButton"+disabledButton_+"").prop('disabled', true);

                              if (paragraphFlag_) {
                                  $(".offparagraph_"+pSL+"").prop('disabled', true);

                                  var pSL = $("#paragraphSl").val();
                                  var pSL_sl = '<?= $sl_no; ?>';

                                  pppSl = pSL++;

                                  $(".offparagraph_"+pSL+"").show()
                                  $("#paragraphSl").val(pSL);

                                  if (paragraphSL_ == pSL_sl) {
                                      classOder++;
                                      $("."+classOder+"").show();
                                  }
                                  paragraphFlag_ = 0;
                              
                              }

                                $("#showWrongParaStoryWrite").html( "<span style='text-align: center; color:red;' > <b> Your Assumption is Wrong  </b> </span> <br><br> <b> Paragraph are </b> a collection of sentences. They <b> are </b> used in writing to introduce new section of a story , characters or peices of information . <b> Paragraphs </b> break text up into easy-to-read sections. <br>");


                                $('#wrongParagraphModal').modal('show');
                            }else{
                              $("."+orderBtn+"").prop('disabled', true);
                            }
                          }
                      }
                  }


                  function removeTags(str) {
                        if ((str===null) || (str===''))
                        return false;
                        else
                        str = str.toString();
                        return str.replace( /(<([^>]+)>)/ig, '');
                     }
                </script>

                    <div class="col-sm-4">
                        <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  
                                            <span>Module Name: <?php echo $question_info_s[0]['moduleName']; ?></span></a>
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
                                                  <th>Description / Video</th>                                                  
                                                </tr>
                                              </thead>
                                              <tbody>
                                                  <?php $i = 1;
                                                  $total = 0;
                                                  foreach ($total_question as $ind) { ?>
                                                  <tr>
                                                    <td>
                                                        <?php if (isset($desired[$i]['ans_is_right'])) {
                                                              if ($desired[$i]['ans_is_right'] == 'correct') {?>
                                                          <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                              <?php } else {?>
                                                          <span class="glyphicon glyphicon-remove" style="color: red;"></span>
                                                              <?php }
                                                        }?>
                                                    </td> 

                                                    
                                                           <?php  if ( ($ind["question_type"] !=14) && ($question_info_s[0]['question_order'] == $ind['question_order']) ) { ?>
                                                                <td style="background-color:lightblue">
                                                                    <?php echo $ind['question_order']; ?>
                                                                </td>
                                                           <?php } 

                                                            elseif ( ($ind["question_type"] ==14) && $order >= $chk ) { ?>
                                                                <td style="background-color:#FFA500">
                                                                  <a href="<?php echo site_url('/module_preview/').$ind['module_id'].'/'.$ind['question_order'] ?>"><?php echo $ind['question_order']; ?></a>
                                                                 </td>
                                                           <?php } 

                                                           elseif ( ($ind["question_type"] ==14) && $order < $chk ) { ?>
                                                                <td style="background-color:#FFA500">
                                                                  <?php echo $ind['question_order']; ?>
                                                                 </td>
                                                           <?php } 

                                                            else{  ?>

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
                                                  <td><?php echo $ind['questionMarks']; ?></td>
                                                  <td class="description_video">
                    
                                                        <?php if (isset($ind['questionDescription']) && $ind['questionDescription'] != null ){ ?>
                                                            <a  class="description_class" onclick="showModalDes(<?php echo $i; ?>);" style="display: inline-block;"><img src="assets/images/icon_details.png"></a>
                                                        <?php } ?>
                                                        <?php 
                                                            $question_instruct_vid = isset($ind['question_video']) ? json_decode($ind['question_video']):'';
                                                        ?>
                                                        <?php if (isset($question_instruct_vid[0]) && $question_instruct_vid[0] != null ){ ?>
                                                          <a onclick="showQuestionVideo(<?php echo $i; ?>)" class="question_video_class" style="display: inline-block;"><img src="http://q-study.com/assets/ckeditor/plugins/svideo/icons/svideo.png"></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                      <?php $i++;
                                                  } ?>
                                              <tr>
                                                <td colspan="2">Total</td>
                                                <td colspan="3"><?php echo $total?></td>
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

                    <div class="col-sm-4" id="draggable" style="display: none;">
                        <div class="panel-group" id="waccordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#waccordion" href="#collapseworkout" aria-expanded="true" aria-controls="collapseworkout">  Workout</a>
                                    </h4>
                                </div>
                                <div id="collapseworkout" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body" id="setWorkoutHere">
                                        <textarea name="workout" class="mytextarea"></textarea>
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

<!--Solution Modal-->
<div class="modal fade ss_modal" id="msg_Paragraph_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body row">
                <span class="ss_extar_top20">
                    <div id="question_msgShow_2_2"></div>
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
            </div>
        </div>
    </div>
</div>

<?php $i = 1;
$total = 0;
foreach ($total_question as $ind) { ?>
<!--Question Video Modal-->
<div class="modal fade" id="ss_question_video<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Question Video</h4>
            </div>
            <div class="modal-body">
                <?php 
                    $question_instruct_vid = isset($ind['question_video']) ? json_decode($ind['question_video']):'';
                ?>
                <?php if (isset($question_instruct_vid[0]) && $question_instruct_vid[0] != null ){ ?>
                    <video controls style="width: 100%">
                      <source src="<?php echo isset($question_instruct_vid[0]) ? trim($question_instruct_vid[0]) : '';?>" type="video/mp4">
                    </video>
                    <?php if (isset($question_instruct_vid[1]) && $question_instruct_vid[1] != null ): ?>
                        
                        <video controls style="width: 100%">
                          <source src="<?php echo isset($question_instruct_vid[1]) ? trim($question_instruct_vid[1]) : '';?>" type="video/mp4">
                        </video>
                    <?php endif ?>
                <?php }else{ ?>
                    <P>No question video</P>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>
<?php $i++; } ?>
<script>
    function showQuestionVideo(id){
      $('#ss_question_video'+id).modal('show');
    }
</script>
<!--Question Video Modal-->
<div class="modal fade" id="ss_question_video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Question Video</h4>
            </div>
            <div class="modal-body">

                <?php if (isset($question_instruct[0]) && $question_instruct[0] != null ){ ?>
                    <video controls style="width: 100%">
                      <source src="<?php echo isset($question_instruct[0]) ? trim($question_instruct[0]) : '';?>" type="video/mp4">
                    </video>
                    <?php if (isset($question_instruct[1]) && $question_instruct[1] != null ): ?>
                        
                        <video controls style="width: 100%">
                          <source src="<?php echo isset($question_instruct[1]) ? trim($question_instruct[1]) : '';?>" type="video/mp4">
                        </video>
                    <?php endif ?>
                <?php }else{ ?>
                    <P>No question video</P>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade ss_modal" id="ParagrapConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content"style="margin: -88px;">
            <div class="modal-body row">
                <span class="">
                    Do you think this sentense can be used to write a saparate paragraph ?
                </span>
            </div>
            <div class="modal-footer">
                <div class="wrongFooterModel">
                    <button type="button" class="btn btn_blue" data-dismiss="modal" style="margin: 0 2px;" onclick="decisionParagraph('right_ones_xxx')" >Yes</button>   
                    <button type="button" class="btn btn_blue" data-dismiss="modal" onclick="decisionParagraph('no')">No</button>
                </div>       
            </div>
        </div>
    </div>
</div>

<!--Solution Modal-->
<!--Solution Modal-->
<div class="modal fade ss_modal" id="msg_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body row">
                
                <span class="ss_extar_top20">
                    
                    <div id="question_msgShow"></div>
                    
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" onclick="NextParaShowMsg()" data-dismiss="modal">close</button>         
            </div>
        </div>
    </div>
</div>

<!--Solution Modal-->
<div class="modal fade ss_modal" id="ss_info_congratulation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body row">
                <span class="ss_info_congratulationMSG">
                    
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
            </div>
        </div>
    </div>
</div>

<!--Solution Modal-->
<div class="modal fade ss_modal" id="wrongModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="margin-top: 42px;margin-right: 548px;">
        <div class="modal-content" style="margin-left: -123px!important;">
            <p><i class="fa fa-times" style="font-size:20px;color:red"></i> Incorrect</p>
            <div class="modal-body row">
                <span class="">
                    <div id="showWrongTitleStoryWrite"></div>
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal" >try Again</button>         
            </div>
        </div>
    </div>
</div>

<!--Solution Modal-->
<div class="modal fade ss_modal" id="wrongParagraphModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <p><i class="fa fa-times" style="font-size:20px;color:red"></i> Incorrect</p>
            <div class="modal-body row">
                <span class="">
                    <div id="showWrongParaStoryWrite"></div>
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" onclick="NextParaShowMsg()" data-dismiss="modal" >Got It</button>         
            </div>
        </div>
    </div>
</div>

<!--Solution Modal-->
<div class="modal fade ss_modal" id="firstmsg_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-left: 0!important;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body row">
                <span class="ss_extar_top20">
                    <div id="question_msgShow_2"></div>
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal" onclick="firstPartShow()" >close</button>         
            </div>
        </div>
    </div>
</div>

<!--Solution Modal-->
<div class="modal fade ss_modal" id="msg_modalConclusion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body row">
                <span class="ss_extar_top20">
                    <div id="question_msgShowConclusion"></div>
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
            </div>
        </div>
    </div>
</div>

<div class="modal fade ss_modal" id="correctParagraph" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-left: 0!important;">
            
            <div class="modal-header">
            </div>
            <div class="modal-body row">
                <p><i class="fa fa-check" style="font-size:20px;color:red"></i> Correct</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal" onclick="NextParaShowMsg()" >Close</button>           
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

  
  var breakIncrement = 1;
    function NextParaShowMsg() {

      if (startConclusion) {
        conclusionModalCall()
      }

        if (showNextParagraph == 0) {

            $("#question_msgShow_2_2").html("Choose the next paragraph.")
            if (itzPuzzpleClicked && clickedbeforePuzzle == 0) {
              xxxxxx = breakIncrement;
              xxxxxx--;
              $(".breakIncrement_"+xxxxxx+" ").html( "");

             
              $("#ansParagraph").append( "<span class='breakIncrement_"+breakIncrement+"' style='text-align: center;' > <br><br> </span>");
               breakIncrement++;
            }else{
              $("#ansParagraph").append( "<span class='breakIncrement_"+breakIncrement+"' style='text-align: center;' > <br><br> </span>");
               breakIncrement++;
            }

            clickedbeforePuzzle = 0;
            $("#msg_Paragraph_modal").modal("show")
            showNextParagraph = 1;
        }
    }

    function conclusionModalCall() {
      if (itzPuzzpleClicked  && clickedbeforePuzzle == 0 ) {
        xxxxxx = breakIncrement;
        xxxxxx--;
        $(".breakIncrement_"+xxxxxx+" ").html( "");
      }else{
        $("#ansParagraph").append( "<span class='breakIncrement_"+breakIncrement+"' style='text-align: center;' > <br><br> </span>");
      }

      $("#msg_modalConclusion").modal("show")
    }
</script>

<script type="text/javascript">
    var flag = 1;
    
    function firstPartShow() {
        flag = 0;
        $("#question_msgShow").html(" <p class='modalTitleColor'> ''Title'' </p> You have to choose a 'Title' for the story. Read the entire story carefully before you choose the title.")
        $("#msg_modal").modal("show")
        clearInterval(myVar);
        $(".titleBtn").prop('disabled', false);
    }
    if (flag) {
        var myVar = setInterval(setColor, 6000);

        function setColor() {
          $("#question_msgShow_2").html("Choose the sentence/sentences below to create a story.")
          $("#firstmsg_modal").modal("show")
        }

    }

</script>

<script type="text/javascript">
  function show_question_two(){
    $("#question_msgShow").html("")
    $("#msg_modal").modal("show")
  }
</script>



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
                <a id="next_qustion_link" href="">
                    <button type="button" class="btn btn_blue" >Ok</button>
                </a>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ss_info_worng" role="dialog">
    <div class="modal-dialog ui-draggable" style=" width: 48%;">

        <!-- Modal content-->
        <div class="modal-content" style="width: 100%;">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"> <i class="fa fa-close" style="font-size:20px;color:red"></i><br> Solution</h5>
            </div>
            <div class="modal-body storyWrite" style="height: 468px;">
                <div id="ss_extar_top20 ">
                    <?php echo $question_info_s[0]['question_solution']?>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal" onclick="reload()">close</button>   
            </div>
        </div>

    </div>
</div>

        
<!--Times Up Modal-->
<div class="modal fade ss_modal" id="times_up_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Times Up</h4>
            </div>
            <div class="modal-body row">
                <i class="fa fa-close" style="font-size:20px;color:red"></i> 
                <br><?php echo $question_info_s[0]['question_solution'] ?>
            </div>
            <div class="modal-footer">
                <button type="button" id="question_reload" class="btn btn_blue" data-dismiss="modal">close</button>         
            </div>
        </div>
    </div>
</div>

<?php $i = 1;
foreach ($total_question as $ind) { ?>
    <div class="modal fade ss_modal ew_ss_modal" id="show_description_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" name="questionDescription"><?php echo $ind['questionDescription']; ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php $i++;
} ?>


<script>

  function reload() {
    location.reload(); 
  }
    $('#answer_matching').click(function () {
    var form = $("#answer_form");
    $.ajax({
      type: 'POST',
      url: 'answer_matching_StoryWrite',
      data: form.serialize(),
      dataType: 'html',
      success: function (results) {
        if (results == 6) {
          window.location.href = 'Preview/show_tutorial_result/'+$("#module_id").val();
        }
        if (results == 5) {
          window.location.href = 'module_preview/'+$("#module_id").val()+'/'+$('#next_question').val();
        }
        if (results == 3) {
                    $('#ss_info_worng').modal('show');
                } if (results == 2) {
                    var next_question = $("#next_question").val();
                    if(next_question != 0) {
                        var question_order_link = $('#question_order_link').attr('href');
                    } if(next_question == 0) {
                        var question_order_link = 'Preview/show_tutorial_result/'+$("#module_id").val();
                    }
                    
                    $("#next_qustion_link").attr("href", question_order_link);
                    $('#ss_info_sucesss').modal('show');
                }
        
      }
    });

  });
  
    function showModalDes(e)
    {
        $('#show_description_' + e).modal('show');
    }
</script>

<!--Correct Modal-->
<div class="modal fade ss_modal" id="correctModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-left: 0!important;">
            <div class="modal-header">
            </div>
            <div class="modal-body row">
                <p><i class="fa fa-check" style="font-size:20px;color:red"></i> Correct</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal" onclick="correctAns()" >Next</button>           
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function correctAns() {
        $("#msg_modal").modal("show")
    }
</script>

<script>
    
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
            h1.textContent = v_hours + " : "  + v_minutes + " : " + v_seconds + "  " ;      
        } else {
            var form = $("#answer_form");
            $.ajax({
                type: 'POST',
                url: 'answer_matching_StoryWrite',
                data: form.serialize(),
                dataType: 'html',
                success: function (results) {
                    if (results == 6) {
                        window.location.href = 'Preview/show_tutorial_result/'+$("#module_id").val();
                    }
                    if (results == 5) {
                        window.location.href = 'module_preview/'+$("#module_id").val()+'/'+$('#next_question').val();
                    }
                    if (results == 3) {
                        $('#times_up_message').modal('show');
                        $('#question_reload').click(function () {
                            location.reload(); 
                        });
                        
                    }
                    
                }
            });
            h1.textContent = "EXPIRED";
        }
    }
  
    function takeDecesionForQuestion() {
        
        var exact_time = $('#exact_time').val();
        
        var now = $('#now').val();
        var opt = $('#optionalTime').val();
        
        
        var countDownDate =  parseInt (now) + parseInt($('#optionalTime').val());
        
        var distance = countDownDate - now;  
        var hours = Math.floor( distance/3600 );
//        alert(distance)
        var x = distance % 3600;
  
        var minutes = Math.floor(x/60); 
        
        var seconds = distance % 60;
        
        var t_h = hours * 60 * 60;
        var t_m = minutes * 60;
        var t_s = seconds;
  
        var total = parseInt(t_h) + parseInt(t_m) + parseInt(t_s);
  
        
        var end_depend_optional = parseInt(exact_time) + parseInt(opt);
  
        if(opt > total) {
            remaining_time = total;
        } else {  
            remaining_time = parseInt(end_depend_optional) - parseInt(now);
        }
  
        clear_interval = setInterval(circulate1,1000);
  
    }
  

    <?php if ($question_time_in_second != 0) { ?>
        takeDecesionForQuestion();
    <?php }?>
</script>

<script>  
  $(function() {  
    $( ".ss_modal" ).draggable();  
  });  
</script>  

<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> 

<?php $this->load->view('module/preview/drawingBoard'); ?>
