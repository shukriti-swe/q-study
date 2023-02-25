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
$question_info = json_decode($question_info_s[0]['questionName']);

$currect_answer = $question_info_s[0]['answer'];

$st_ans = json_decode($tutorial_ans_info[0]['st_ans'], TRUE);

$question_order = $question_info_s[0]['question_order'];
//    echo '<pre>';print_r($st_ans);
?>

<?php if ($question_info_s[0]['question_name_type']) { ?>
    <div class="col-sm-4">
        <div class="workout_menu" style="margin-bottom: 30px;">
            <ul>
                <li>
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_draw.png"> Instruction</span></a>
                </li>

            </ul>
        </div>
    </div>
<?php  } else { ?>
    <div class="col-sm-4">

        <div class="workout_menu" style="margin-bottom: 30px;">
            <ul>
                <li>
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_draw.png"> Instruction</span></a>
                </li>

                <li><a style="cursor:pointer" id="show_question" onclick="show_question()">Question<i>(Click Here)</i></a></li>

            </ul>
        </div>

    </div>
<?php  } ?>

<?php
$lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
?>

<div class="col-sm-4">
    <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body ss_imag_add_right">
                    <?php if ($question_info_s[0]['question_name_type']) { ?>
                        <div class="panel-body">
                            <!-- <div class=" math_plus">
                                <?php echo $question_info->questionName; ?>
                            </div> -->
                            <?php echo $question_info->questionName; ?>
                        </div>
                    <?php } ?>
                    <div class="image_box_list ss_m_qu">
                        <?php $i = 1;
                        $j = 1;

                        // print_r($st_ans[$question_order]['student_ans']);

                        // print_r($currect_answer);

                        $right_ans = trim($currect_answer, '[" "]');

                        // echo "=" . $st_ans[$question_order]['student_ans'][0] . "=" . $right_ans . "=";

                        foreach ($question_info->vocubulary_image as $row) {

                        ?>
                            <div class="row">
                                <div class="col-xs-2">
                                    <p class="ss_lette"><?php echo $lettry_array[$i - 1]; ?></p>
                                </div>
                                <div class="col-xs-8">
                                    <div class="box ">
                                        <div class="ss_w_box text-center">
                                            <?php echo $row[0]; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2">

                                    <?php if ($right_ans == $j) { ?>
                                        <span class="c_p_box_50_<?php echo $i; ?>" style="position: absolute;top: -2px;left: 32px;color: green;">✓</span>
                                    <?php } else { ?>

                                        <?php if ($st_ans[$question_order]['student_ans'][0] == $j) { ?>
                                            <span class="r_p_box_50_<?php echo $i; ?>" style="position: absolute;top: -2px;left: 32px;color: red;">✖</span>
                                        <?php } ?>

                                    <?php } ?>

                                </div>
                            </div>
                        <?php $i++;
                            $j++;
                        } ?>
                    </div>

                </div>

                <div class="col-sm-4"></div>
                <!--                <div class="col-sm-4" style="margin-top: 10px;">     
                    <button type="button" class="btn btn_next" id="answer_matching">submit</button>
                </div>                                  -->
                <div class="col-sm-4"></div>

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