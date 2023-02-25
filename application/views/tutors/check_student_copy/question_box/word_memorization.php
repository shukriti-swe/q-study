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
        
        <div class="col-sm-8">
                  <?php 


                    $i=0;
                    foreach($questions as $question){

                        $ans = '&nbsp;<p style="color:#fb8836;font-size:20px;text-decoration:underline;line-height: 18px;line-height: 18px;">'.$student_ans[$i].'</p>&nbsp;';
                        
                        $questions_answer = $answer[$i];
                        $make_question = str_replace($questions_answer,$ans,$question);
                    ?>

                    
                    <div style="display:flex" class="question_all">
                        <div style="display:flex;width:100%;background-color: #0000000f;padding: 15px;font-size:20px;"><?=$make_question?></div>

                        <div class="ans_info<?=$incre?>">
                            &nbsp;&nbsp;
                            <?php if($student_ans[$i] != $answer[$i]){?>
                            <i class="fa fa-close wrong_ans<?=$incre?>" style="font-size:24px;padding-top:1px;color:red;display:block;"></i>
                            <?php }else{?>
                            <i class="fa fa-check right_ans<?=$incre?>" style="font-size:24px;padding-top:1px;color:green;display:block;"></i>
                            <?php }?>
                        </div>
                            &nbsp;&nbsp;

                        <div style="display:block;" class="suggession_box<?=$incre?>">
                            <p style="background-color:gray;color:white;text-align: center;padding:0px 15px;">Answer</p>
                            <p class="ans_set<?=$incre?>" style="text-align: center;background-color:wheat;"><?=$answer[$i]?></p>
                        </div>
                    </div>
                    <br>
                    <?php $i++;}?>
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