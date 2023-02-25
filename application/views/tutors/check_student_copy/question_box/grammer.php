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
    .sugg_box{
    padding-top: 14px;
    display: block;
    width: 150px;
   }
   .image-editor{
      height:165px;
      border:4px solid #658ab9;
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
      position: absolute;
    background: #00a2e8;
    z-index: 10;
    padding: 5px 10px 5px 10px;
    color: #fff;
    right: 0;
    width: 80%;
    max-width: 250px;
    height: fit-content;
    top:0;
   }
   .tooltip_rs::after {
      width: 0;
      height: 0;
      border-left: 5px solid transparent;
      border-right: 5px solid transparent;
      border-top: 50px solid #00a2e8;
      content: '';
      position: absolute;
      top: -14px;
      left: -30px;
      transform: rotate(90deg);
   }
   .all_options{
      margin-top:5px;
      margin-left:5px;
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
</style>

<?php
$question_info = json_decode($question_info_s[0]['questionName'],true);

$answer = json_decode($question_info_s[0]['answer']);

$st_ans = json_decode($tutorial_ans_info[0]['st_ans'], TRUE);

$question_order = $question_info_s[0]['question_order'];

$student_ans = $st_ans[$question_order_id]['student_ans'];
$questions = $question_info['questions'];
// echo '<pre>';print_r($st_ans);
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
        
        <div class="col-sm-8">
        <form id="answer_form">
                           <?php 
                            // echo "<pre>";print_r($question_info_s[0]);die();
                            $question = $question_info_s[0]['questionName'];
                            $answer = $question_info_s[0]['answer'];
                            $question_description = json_decode($question_info_s[0]['questionDescription'],true);
                           // echo "<pre>";print_r($question_description);die();
                           ?>
                            <div class="writing_input_body">
                                <h6 style="font-weight: bold;margin-left:30px;font-size:17px;"> <?=$question?></h6>
                            </div>
                            <div>
                                <?php $i=1; foreach($question_description['options'] as $option){ ?>
                                    <div style="padding-left: 30px;gap:10px;">
                                       
                                       <div style="margin-top: 10px;position:relative;">
                                          <div style="position:relative;max-width:300px;display:flex;gap:10px;    align-items: baseline;">

                                             <div style="max-width:20px;position:absolute;left:-25px; top: -5px;">
                                                <i class="fa fa-close ans_wrong wrong_ans<?=$i?>" style="font-size:24px;color:red;margin-top:5px;display:none;"></i>
                                                <i class="fa fa-check ans_right right_ans<?=$i?>" style="font-size:21px;color:green;margin-top:5px;display:none;"></i>
                                             </div>
                                             
                                             

                                             <label class="custom_radio"><span class="option_no<?=$i?> all_options"><?=$option?></span>
                                                <input type="radio" class="radio_ans" id="html<?=$i?>" name="answer" value="<?=$i?>" <?php if($i==$st_ans[$question_order]['student_ans']){echo "checked";}?>>
                                                <span class="checkmark "></span>
                                             </label>

                                          </div>
                                           

                                          
                                            
                                       </div>
                                    </div>
                                <?php $i++; } ?>
                            </div>
                            <div style="margin-left: 30px;margin-top:30px;">
                                <input type="hidden" value="<?php echo $question_id;?>" name="question_id" id="question_id">
                                
                                <a href="javascript:;" type="button" class="btn btn-primary ans_submit" style="background-color: #bee131;color:#000">Submit</a>
                            </div>
                          </form>  
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