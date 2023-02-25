<?php
$question_info = json_decode($question_info_s[0]['questionName'], TRUE);
$st_ans = json_decode($tutorial_ans_info[0]['st_ans'], TRUE);
$question_order = $question_info_s[0]['question_order'];
$questionName = $question_info['whiteboard_memorize_p_three'];
$student_ans = is_array($st_ans[$question_order]['student_ans']) ? $st_ans[$question_order]['student_ans'] : json_decode($st_ans[$question_order]['student_ans'], TRUE);

// echo '<pre>';print_r(json_decode($st_ans[$question_order]['student_ans'], TRUE));die;
?>

<div class="col-sm-8">
    <div class="workout_menu" style="padding-left: 15px;padding-right: 15px;">
        <ul>
            <li><a style="cursor:pointer" id="show_question">Question<i>(Click Here)</i></a></li>
        </ul>
    </div>
    <div>
        <?php if ($pattern_type == 1) { ?>
            <div class="col-sm-10" id="answer_box">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <!-- <h5 style="text-align: center;margin-bottom: 10px;border: 1px solid #b1b1b1;font-size: 20px;">Part One</h5> -->
                    <?php $i = 1;

                    $right = 'none';
                    $wrong = 'none';
                    if ($row[1] == 1) {
                        $right = 'block';
                    }
                    if ($row[1] == 0) {
                        $wrong = 'block';
                    }
                    ?>
                    <div class="row" style="margin-bottom: 10px;">
                        <?php
                        $i = 0;

                        $check = $student_answer;
                        $array = [];

                        foreach ($check[0] as $key => $value) {
                            $array[$key] = $value;
                        }

                        foreach ($check[1] as $key => $value) {
                            if ($array[$key] == '') {
                                $array[$key] = $value;
                            }
                        }

                        // $jj = array();

                        // for ($ii = 0; $ii < count($pm[0]); $ii++) {
                        //     $jj[$ii] = $pm[0][$ii];
                        // }


                        // for ($ii = 0; $ii < count($pm[1]); $ii++) {
                        //     if ($jj[$ii] == '') {
                        //         $jj[$ii] = $pm[1][$ii];
                        //     }
                        // }

                        ?>

                        <?php foreach ($question_info['left_memorize_p_one'] as $question) : ?>
                            <div class="col-sm-6">
                                <input style="border: 1px solid transparent;font-weight:bold;background: #777;border-radius:0px;color: #fff;" type="text" value="<?php echo $question; ?>" class="form-control" readonly>

                            </div>
                            <div class="col-sm-6">

                                <?php if (trim($array[$i]) == trim($question)) { ?>
                                    <span style="position: absolute;font-weight:bold;top: 5px;right: -4px;color: green;">✓</span>
                                <?php } else { ?>
                                    <span style="position: absolute;font-weight:bold;top: 5px;right:-4px;color: red;">✖</span>
                                <?php } ?>


                                <input readonly="readonly" style="background: #fff;border: 1px solid #ccc;font-weight:bold;border-radius:0px;color: #888;" type="text" value="<?php echo $array[$i]; ?>" class="form-control">

                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

        <?php } ?>
        <?php if ($pattern_type == 2) { ?>

            <div class="row" style="margin-bottom: 15px;">
                <div class="col-sm-6" style="margin-bottom: 20px;">
                    <?php if (isset($std_ans['left_memorize_p_two'])) {
                        $i = 1;
                        foreach ($std_ans['left_memorize_p_two'] as $left_memorize_p_two) {
                            $str_arr = explode(",", $left_memorize_p_two);

                    ?>
                            <div>
                                <textarea readonly style="background-color: #fff;min-height: 90px;margin-bottom: 10px" id="lleft_memorize_p_two_<?= $i; ?>" class="form-control lleft_memorize_p_two_<?= $i; ?>" name="lleft_memorize_p_two[]" spellcheck="false"><?php echo $str_arr[0] ?></textarea>

                            </div>

                        <?php $i++;
                        } ?>
                    <?php } ?>
                </div>
                <div class="col-sm-6" style="margin-bottom: 20px;">
                    <?php if (isset($std_ans['right_memorize_p_two'])) {
                        $i = 1;
                        foreach ($std_ans['right_memorize_p_two'] as $key1 => $right_memorize_p_two) {
                            $str_arr2 = explode(",", $right_memorize_p_two);
                            $right_right = 'none';
                            $right_wrong = 'none';
                            foreach ($std_ans['left_memorize_p_two'] as $key2 => $left_memorize_p_two) {

                                $str_arr_left = explode(",", $left_memorize_p_two);
                                if ($key1 == $key2) {
                                    //  echo $str_arr2[1];echo $str_arr_left[1];
                                    if ($str_arr2[1] == $str_arr_left[1]) {

                                        $right_right = 'block';
                                    } elseif ($str_arr_left[1] != $str_arr2[1]) {
                                        $right_wrong = 'block';
                                    }

                    ?>
                                    <div style="position:relative;">
                                        <textarea readonly style="background-color: #fff;min-height: 90px; margin-bottom: 10px" id="rright_memorize_p_two_<?= $i; ?>" class="form-control rright_memorize_p_two_<?= $i; ?>" name="rright_memorize_p_two[]" spellcheck="false"><?php echo $str_arr2[0] ?></textarea>

                                        <span class="right_r_p_box_two_<?php echo $i; ?>" style="display:<?php echo $right_right; ?>;position: absolute;font-weight:bold;top: 5px;right: -15px;color: green;">✓</span><span class="right_w_p_box_two_<?php echo $i; ?>" style="display:<?php echo $right_wrong; ?>;position: absolute;font-weight:bold;top: 5px;right:-15px;color: red;">✖</span>
                                    </div>

                        <?php //echo $right_right;echo $str_arr2[1];echo $str_arr_left[1];
                                }
                            }
                        } ?>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php if ($pattern_type == 3) { ?>
            <div id="pattern_three_body">

                <?php if ($pattern_type == 3) { ?>
                    <?php foreach ($qus_setup_array as $q => $q_three) { ?>
                        <?php foreach ($q_three['clue'] as $c => $q_clue) { ?>
                            <div id="list_box_question_clue_<?= $q_three['order']; ?>_<?= ($c + 1); ?>" style="position: absolute;z-index: 2;width: 500px;top: 85px;display:none;">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" aria-expanded="true" aria-controls="collapseOne">
                                                    Question
                                                    <button type="button" class="woq_close_btn" onclick="close_question_clue(<?= $q_three['order']; ?>,<?= ($c + 1); ?>)">&#10006;</button>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                            <div style="padding: 10px">
                                                <?= $q_clue; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>


                <?php if ($pattern_type == 3) { ?>

                    <div id="pattern_three_body">
                        <?php
                        $i = 1;
                        $j = 0;

                        $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');

                        ?>
                        <?php foreach ($qus_setup_array as $key => $question_step_memorize_p_three) {  ?>

                            <div class="row" style="margin-left: 0">

                                <div class="col-sm-12 question_step_memorize<?= $question_step_memorize_p_three['order']; ?>" style="margin: 10px 0;border: 1px solid #ccc;padding: 6px;display: flex;width: 98%;">
                                    <div>
                                        <?= $question_step_memorize_p_three['question_step']; ?>
                                    </div>

                                    <div class="stepOrderShow<?= $question_step_memorize_p_three['order']; ?>" style="display:none;margin-left: 5px;padding-top: 4px;color: red;"><u>Step <?= $question_step_memorize_p_three['order']; ?></u></div>
                                    <div style="margin-left: auto;">
                                        <div class="ssss_class ssss_class_order_<?= $question_step_memorize_p_three['order']; ?>" id="response_answer_id_<?= $key + 1; ?>" style="display: flex;">
                                            <p style="font-size: 21px;margin-right: 5px;"><?= $lettry_array[$key] ?></p>
                                            <input class="response_answer_class response_answer_class_<?= $question_step_memorize_p_three['order']; ?>" id="response_answer_id<?= $key + 1; ?>" type="checkbox" name="wrong_answer<?= $key + 1; ?>[]" serial="<?= $key + 1; ?>" value="<?= $question_step_memorize_p_three['order']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin: 10px 0;border: 1px solid #ccc;padding: 6px;">
                                    <div class="col-md-10" style="padding: 0;">
                                        <div style="display: flex;">

                                            <?php $gerQuestion = array_column($questionName, 0); ?>

                                            <i style="font-size: 23px;color: red;margin-right: 5px;" class="fa fa-question-circle-o"></i><?= $gerQuestion[$j]; ?>


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p style="color: #fff;font-weight: bold;background: red;border: 3px solid #ccc;text-align: center;">Step <span id="step_id"><?= ($key + 1) ?></span></p>
                                    </div>
                                </div>

                                <div class="col-sm-12">

                                    <?php
                                    if ($question_step_memorize_p_three['answer_status'] == 0) {
                                        $newAnswer = -1;
                                        if (array_key_exists($question_step_memorize_p_three['order'], $student_ans) && $student_ans[$question_step_memorize_p_three['order']] == $question_step_memorize_p_three['order']) {
                                            $newAnswer = $question_step_memorize_p_three['order'];
                                        }
                                    }

                                    // echo $newAnswer . "=" . $question_step_memorize_p_three['order'] . "=" . $question_step_memorize_p_three['answer_status'];

                                    ?>

                                    <?php if ($question_step_memorize_p_three['answer_status'] == 1) {

                                    ?>
                                    <?php } else { ?>

                                        <?php if ($newAnswer == $question_step_memorize_p_three['order']) { ?>
                                            <span class="left_r_p_box_three_<?= $question_step_memorize_p_three['order']; ?>" style="position: absolute;font-weight:bold;top: -39px;right: -12px;color: green;">✓</span>
                                        <?php } else { ?>
                                            <span class="left_w_p_box_three_<?= $question_step_memorize_p_three['order']; ?>" style="position: absolute;font-weight:bold;top: -39px;right:-12px;color: red;">✖</span>
                                        <?php } ?>

                                    <?php } ?>

                                </div>
                            </div>


                            <?php $i++; ?>
                        <?php $j++;
                        } ?>
                    </div>
                <?php }; ?>

            </div>
        <?php } ?>
        <?php if ($pattern_type == 4) { ?>

            <?php

            $i = 0;

            $array = [];

            foreach ($m_4_std_answer->student as $key => $value) {
                $array[$key] = $value;
            }

            // echo "<pre>";
            // print_r($array);

            ?>

            <?php foreach ($m_4_std_answer->left as $question) : ?>
                <div class="col-sm-6">
                    <input style="border: 1px solid transparent;font-weight:bold;background: #777;border-radius:0px;color: #fff;" type="text" value="<?php echo $question; ?>" class="form-control" readonly>

                </div>
                <div class="col-sm-6">

                    <?php if ($array[$i] == $question) { ?>
                        <span style="position: absolute;font-weight:bold;top: 5px;right: -4px;color: green;">✓</span>
                    <?php } else { ?>
                        <span style="position: absolute;font-weight:bold;top: 5px;right:-4px;color: red;">✖</span>
                    <?php } ?>

                    <input readonly="readonly" style="background: #fff;border: 1px solid #ccc;font-weight:bold;border-radius:0px;color: #888;" type="text" value="<?php echo $array[$i]; ?>" class="form-control">

                </div>
                <?php $i++; ?>
            <?php endforeach; ?>

        <?php } ?>
    </div>

</div>
<div class="col-sm-6" id="question_box" style="display: none;position: absolute;z-index: 1000;">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title" style="text-align: center;">
                    Question
                    <button type="button" class="woq_close_btn" id="woq_close_btn">&#10006;</button>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <textarea disabled class="mytextarea"><?php echo $question_info['questionName']; ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $("#show_question").click(function() {
        $("#question_box").show();

    });
    $("#woq_close_btn").click(function() {
        $("#question_box").hide();
    });
</script>