<style type="text/css">
    body .modal-ku {
        width: 750px;
    }

    .modal-body .panel-body {
        width: 628px;
        height: 466px;
        overflow: auto;
    }

    .modal-body {
        position: relative;
        padding: 15px;
    }

    #ss_extar_top20 {
        width: 628px;
        height: 466px;
        overflow: auto;
    }
    .image-editor{
      height:165px;
   }
   .image-editor{
      height:165px;
   }
   .row-eq-height {
   display: -webkit-box;
   display: -webkit-flex;
   display: -ms-flexbox;
   display:         flex;
   }
   .two_hint_wrap , .one_hint_wrap{
     display: inline;
     position: relative;
   }
   .tooltip_rs{
      bottom: 100%;
      position: absolute;
      background: #00a2e8;
      z-index: 10;
      padding: 7px;
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
      content:'';
      position: absolute;
      bottom: -15px;
      left: 20%;
   }
   .write_input_word{
      font-size: 16px;
   }

   .custom_radio {
   display: block;
   position: relative;
   padding-left: 35px;
   margin-bottom: 2px;
   line-height: 24px;
   cursor: pointer;
   -webkit-user-select: none;
   -moz-user-select: none;
   -ms-user-select: none;
   user-select: none;
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
   border:2px solid #eee;
   }

   /* On mouse-over, add a grey background color */
   .custom_radio:hover input ~ .checkmark {
      background-color: #fff;
   border:2px solid #eee;
   }

   /* When the radio button is checked, add a blue background */
   .custom_radio input:checked ~ .checkmark {
   background-color: #fff;
   border:2px solid #ccc;
   }

   /* Create the indicator (the dot/circle - hidden when not checked) */
   .checkmark:after {
   content: "";
   position: absolute;
   display: none;
   }

   /* Show the indicator (dot/circle) when checked */
   .custom_radio input:checked ~ .checkmark:after {
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
   #answer_form{
      height:100%;
   }
   .answer_box_main{
      height:100%;
   }
</style>

<?php
$question_info = json_decode($question_info_s[0]['questionName'],true);

$answer = json_decode($question_info_s[0]['answer']);

$st_ans = json_decode($tutorial_ans_info[0]['st_ans'], TRUE);

$question_order = $question_info_s[0]['question_order'];

$student_ans = $st_ans[$question_order_id]['student_ans'];
$questions = $question_info['questions'];
// echo '<pre>';print_r($answer);
?>

<?php if ($question_info_s[0]['question_name_type']) { ?>
    <div class="col-sm-8">
        <div class="workout_menu" style="margin-bottom: 30px;">
            <ul>
                <li>
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_draw.png"> Instruction</span></a>
                </li>

            </ul>
        </div>

<?php  } else { ?>
    <div class="col-sm-8">

        <div class="workout_menu" style="margin-bottom: 30px;">
            <ul>
                <li>
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_draw.png"> Instruction</span></a>
                </li>

                <li><a style="cursor:pointer" id="show_question" onclick="show_question()">Question<i>(Click Here)</i></a></li>

            </ul>
        </div> 


<?php  } ?>

<?php
$lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
?>


    <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
        
      
        <div class="comprehension_body" style="display:flex;">
            <?php 
            // echo "<pre>";print_r($word_match_info[0]);die();
            $question = $question_info_s[0]['questionName'];
            $answer = $question_info_s[0]['answer'];
            $question_description = json_decode($question_info_s[0]['questionDescription'],true);

            $st_ans = json_decode($tutorial_ans_info[0]['st_ans'],TRUE);
            
            ?>
            <div class="writing_input_body" style="width:60%;display:flex;">
                <?=$question_description['image_ques_body'];?>
            </div>
            <?php 
                              $title_count = strlen($question_description['question_title_description']);

                              if($title_count<=19){
                                $add_css = 'font-size:28px;';
                              }else if($title_count<=24 && $title_count>19){
                                $add_css = 'font-size:36px;';
                              }else if($title_count<=32 && $title_count>24){
                                $add_css = 'font-size:26px;';
                              }else if($title_count<=48 && $title_count>32){
                                $add_css = 'font-size:17px;';
                              }else if($title_count<=48 && $title_count>32){
                                $add_css = 'font-size:17px;';
                              }else if($title_count>48){
                                $add_css = 'font-size:12px;line-height: 20px;';
                              }
                            ?>

                            <p style="font-size:26px;text-align:center;padding-bottom: 10px;font-weight:bold;width:100%;margin-top:auto;margin-left: auto;color:<?=$question_description['title_colors']?>"><?=$question_description['question_title_description'];?></p>
            
        </div>
        <div style="display:flex;">
        <div class="col-md-7 row-eq-height" style="border: 1px solid #82bae6;padding: 5px;box-shadow: 0px 0px 4px #82bae6;border-radius: 5px;">

        <div style="word-break:break-word">

          <?php 
          // var_dump($question_description['writing_input']);die();
          //$all_words = explode(" ",strip_tags($question_description['writing_input']));
          $get_sentences =  preg_split('/<\/\s*p\s*>/', $question_description['writing_input']);
          // echo "<pre>";print_r($get_sentences);die();
          $k=1;
          foreach($get_sentences as $sentence){
              $al_words .= '<p style="display: flex;flex-wrap: wrap;">';
              $words = explode(' ',strip_tags($sentence));
              if($k==1){
                $i=0;
              }
              foreach($words as $word){
                $al_words .= '<span class="write_input_word write_input_word'.$i.'" data-id="'.$i.'">'.$word.'&nbsp;</span>';
              $i++; }
              $al_words .= '</p><br>';

          $k++; }

              echo $al_words;
          ?> 
        </div>
      </div> 
        <div class="col-md-5">


            <div class="answer_box_main" style="border:1px solid gray;padding:5px;margin-left:3%;overflow: hidden;">

            <?php
            
            if($answer=='write'){ ?>
            <div class="without_option">
                <a href="javascript:;" type="button" class="btn btn-primary" style="background-color: #bee131;color:#000" id="extra_bonus">Get Extra Bonus Point !!</a>

            <div class="answer_box">
                <br>
                <p style="font-weight: bold;"><?=$question_info_s[0]['questionName'];?></p> <br>
                <input type="hidden" id="html" name="answer" value="write_ans">
                <textarea class="form-control question_description" style="height:200px;" name="student_answer"><?= $student_ans?></textarea>
                <br>
                <div style="text-align:center;">
                <a href="javascript:;" type="button" class="btn btn-primary ans_submit" style="background-color: #bee131;color:#000;margin:auto;">Submit</a>
                </div>

                <a href="javascript:;" type="button" class="btn btn-primary" style="background-color: #fff200;float:left;color:#000;margin-left:5px;" id="skip_button">Skip</a>
                
            </div>
            </div>

            <?php }else{ ?>
            <div class="with_option">
            <br>
            <h6 style="font-weight: bold;margin-left:30px;font-size:17px;"> <?=$question_info_s[0]['questionName'];?></h6>
            <br>
            <?php
            $i=1;
            foreach($question_description['options'] as $option){ ?>

            
                <div style="width:100%;padding-left:30px;position:relative;">
                    <div style="width:20px;position:absolute;left:0;top:0;">
                    <i class="fa fa-close ans_wrong wrong_ans<?=$i?>" style="font-size:21px;color:red;margin-top:1px;display:none;"></i>
                    <i class="fa fa-check ans_right right_ans<?=$i?>" style="font-size:21px;color:green;margin-top:1px;display:none;"></i>
                    </div>
                    <div style="margin-top: 2px;">
                       <label class="custom_radio"><span class="option_no<?=$i?> all_options"><?=$option?></span>
                        <input type="radio" class="radio_ans" id="html<?=$i?>" name="answer" value="<?=$i?>">
                        <span class="checkmark "></span>
                      </label>
                    </div>
                </div>
            <?php $i++;} ?>

            <br>
            <div style="margin-left: 30px;">

                <input type="hidden" value="<?php echo $question_id;?>" name="question_id" id="question_id">
                
                <a href="javascript:;" type="button" class="btn btn-primary ans_submit" style="background-color: #bee131;color:#000">Submit</a>
            </div>
            </div>
            <?php }?>
        </div>
        </div>
        </div>
      
 
    </div>

</div>

<input type="hidden" name="image_quantity" id="image_quantity" value="">

<div class="modal fade" id="myModal_2222" role="dialog">
    <div class="modal-dialog ui-draggable" style=" width: 48%;">

        <!-- Modal content-->
        <div class="modal-content" style="width: 100%;height: 64%;">
            <div class="modal-header ui-draggable-handle">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <!--<h4 class="modal-title">Video Lesson</h4>-->
            </div>
            <div class="modal-body" style="height: 481px;">

                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" id="textarea_2">

                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class=" math_plus">
                            <?php echo $question_info->questionName; ?>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    function show_question() {
        $('#myModal_2222').modal('show');
    }
</script>

<script>
    var qtye = $("#box_qty").val();
    document.getElementById("image_quantity").value = qtye;

    common(qtye);

    function getImageBox() {
        var qty = $("#box_qty").val();
        if (qty < 4) {
            $("#box_qty").val(4);
        } else if (qty > 20) {
            $("#box_qty").val(20);
        } else {
            $('.editor_hide').hide();
            document.getElementById("image_quantity").value = qty;
            common(qty);
        }

    }

    function common(quantity) {
        for (var i = 1; i <= quantity; i++) {
            $('#list_box_' + i).show();
        }
    }
</script>