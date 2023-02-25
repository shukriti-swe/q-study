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
            $question = $question_info_s[0]['questionName'];
            $answer = $question_info_s[0]['answer'];
            $question_description = json_decode($question_info_s[0]['questionDescription'],true);
            // echo "<pre>";print_r($question_description);die();
        ?>
        <h2 style="font-weight:bold;text-align:center;color:<?=$question_description['title_color']?>"><?=$question_description['question_title_description']?></h2>

        <div style="display:flex;height:75vh;min-height:90px;align-items:center;justify-content:center;">
        <?=$question_description['image_ques_body']?>
        </div>

        <div style="text-align:center;">
            <a class="btn ans_submit" type="button" style="padding:5px 20px;border:1px solid #62b1ce;background-color:#99d9ea;color:black;">Next</a>
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