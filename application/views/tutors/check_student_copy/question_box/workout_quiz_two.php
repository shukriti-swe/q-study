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
        height: 389px;
        overflow: auto;
    }


    .question_bg_0 {
        background: #ffceae !important;
        color: #fff;
    }

    .question_bg_25 {
        background: #ffac75 !important;
        color: #fff;
    }

    .question_bg_50 {
        background: #ff7f27 !important;
        color: #fff;
    }

    .question_bg_100 {
        background: #e85c00 !important;
        color: #fff;
    }

    button:disabled {
        background: #dddddd !important;
    }

    .description_video {
        position: relative;
    }

    .description_class {
        position: absolute;
        left: 45px;
    }

    .question_video_class {
        position: absolute;
        left: 70px;
    }
</style>

<?php

// foreach ($total_question as $ind) {

//     if ($ind["question_type"] == 14) {
//         $chk = $ind["question_order"];
//     }
// }

$test = json_decode($all_question_answer[0]['st_ans'], true);
// print_r($test);

foreach ($test as $test2) {

    if ($test2['question_id'] ==  $question_info_s[0]['id']) {

        $student_ans = $test2['student_ans'];

        break;
    }
}

// echo "<pre>";
// print_r($student_ans);
// die();

$percentage_arr = json_decode($question_info_s[0]['questionName'], TRUE);
$percentage = $percentage_arr['percentage_array'];
// print_r($percentage);
// die();

// // foreach($test as $key=>$value){
// //     $abc = (array)$value->student_ans ;
// //      echo "<pre>";
// //     print_r($abc);
// // }
// die();

?>

<form id="answer_form">
    <input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id'] ?>" name="module_id">
    <?php if (array_key_exists($key, $total_question)) { ?>
        <input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] + 1; ?>" name="next_question" />
    <?php } else { ?>
        <input type="hidden" id="next_question" value="0" name="next_question" />
    <?php } ?>
    <input type="hidden" value="<?php echo $question_info_s[0]['question_id']; ?>" name="question_id" id="question_id">
    <input type="hidden" id="current_order" value="<?php echo $key; ?>" name="current_order">
    <input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType']; ?>" name='module_type'>
    <input type="hidden" name="answer" id="Answer" value="">


    <div class="col-md-8" id="box_one" style="display: none;">
        <div class="col-sm-10" id="answer_box">
            <div class="panel-group testq" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title" style="text-align: center;">
                            Answer
                            <button type="button" class="woq_close_btn" id="woa_close_btn">&#10006;</button>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">

                            <textarea class="mytextarea" name="workout"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-12" style="text-align: center;">
            <button type="button" class="btn btn_next" id="click_box_btn">Next</button>
        </div>
    </div>

    <div class="col-md-8" style="padding: 0;margin-top: -10px;">
        <div class="workout_menu" style="padding-left: 15px;padding-right: 15px;">
            <ul>
                <?php if ($question_info->questionName != '') { ?>
                    <li><a style="cursor:pointer" id="show_question">Question<i>(Click Here)</i></a></li>
                <?php } ?>
                <li>
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> <span><img src="assets/images/icon_draw.png"> Instruction</span></a>
                </li>
            </ul>
        </div>
        <div class="col-sm-10" id="question_box" style="display: none;">
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
                            <div class=" math_plus">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8" id="box_two">

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-0">

                </div>
                <div class="col-md-7" style="text-align: center;font-size: 16px;">
                    <div class="question_hint"><?php echo $question_info->question_hint ?></div>
                </div>
            </div>
            <div class="button_click" style="margin-top: 20px;">
                <div class="panel-body ss_imag_add_right">

                    <?php
                    $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
                    ?>
                    <?php $i = 1;
                    // print_r($question_info_ind->vocubulary_image);

                    foreach ($question_info_ind->vocubulary_image as $row) {

                        $data = showTrueFalse($percentage['percentage_' . $i], $student_ans['percentage_' . $i][0]);

                        // echo $percentage['percentage_' . $i]. ' aa '.$student_ans['percentage_' . $i][0];
                        // print_r($data);


                    ?>


                        <div class="row" style="margin-bottom: 15px;margin-left: -60px;">
                            <div class="col-md-4">
                                <div class="row " id="content_percent_<?php echo $i; ?>" style="">

                                    <div class="col-md-3" style="padding-right: 0px;">

                                        <?php if ($data['0'] > 0) { ?>
                                            <?php if ($data['0'] == 1) { ?>
                                                <span class="c_p_box_0_<?php echo $i; ?>" style="position: absolute;top: -17px;left: 32px;color: green;">✓</span>
                                            <?php } else { ?>
                                                <span class="r_p_box_0_<?php echo $i; ?>" style="position: absolute;top: -17px;left: 32px;color: red;">✖</span>
                                            <?php } ?>
                                        <?php } ?>

                                        <button class="percent_color c_percent_0_<?php echo $i; ?> c_percent_<?php echo $i; ?>" id="c_percent_<?php echo $i; ?>" parcentId="<?php echo $i; ?>" value="0" style="background: none;width: 100%;padding: 10px 0px;border: 1px solid #ccc;font-size: 14px;text-align: center;">0%</button>

                                    </div>
                                    <div class="col-md-3" style="padding-right: 0px;">
                                        <?php if ($data['25'] > 0) { ?>
                                            <?php if ($data['25'] == 1) { ?>
                                                <span class="c_p_box_25_<?php echo $i; ?>" style="position: absolute;top: -17px;left: 32px;color: green;">✓</span>
                                            <?php } else { ?>
                                                <span class="r_p_box_25_<?php echo $i; ?>" style="position: absolute;top: -17px;left: 32px;color: red;">✖</span>
                                            <?php } ?>
                                        <?php } ?>

                                        <button class="percent_color c_percent_25_<?php echo $i; ?> c_percent_<?php echo $i; ?>" id="c_percent_<?php echo $i; ?>" parcentId="<?php echo $i; ?>" value="25" style="background: none;width: 100%;border: 1px solid #ccc;padding: 10px 0px;font-size: 14px;text-align: center;">25%</button>
                                    </div>

                                    <div class="col-md-3" style="padding-right: 0px;">
                                        <?php if ($data['50'] > 0) { ?>
                                            <?php if ($data['50'] == 1) { ?>
                                                <span class="c_p_box_50_<?php echo $i; ?>" style="position: absolute;top: -17px;left: 32px;color: green;">✓</span>
                                            <?php } else { ?>
                                                <span class="r_p_box_50_<?php echo $i; ?>" style="position: absolute;top: -17px;left: 32px;color: red;">✖</span>
                                            <?php } ?>
                                        <?php } ?>

                                        <button class="percent_color c_percent_50_<?php echo $i; ?> c_percent_<?php echo $i; ?>" id="c_percent_<?php echo $i; ?>" parcentId="<?php echo $i; ?>" value="50" style="background: none;width: 100%;padding: 10px 0px;border: 1px solid #ccc;font-size: 14px;text-align: center;">50%</button>
                                    </div>
                                    <div class="col-md-3" style="padding-right: 0px;">
                                        <?php if ($data['100'] > 0) { ?>
                                            <?php if ($data['100'] == 1) { ?>
                                                <span class="c_p_box_100_<?php echo $i; ?>" style="position: absolute;top: -17px;left: 32px;color: green;">✓</span>
                                            <?php } else { ?>
                                                <span class="r_p_box_100_<?php echo $i; ?>" style="position: absolute;top: -17px;left: 32px;color: red;">✖</span>
                                            <?php } ?>
                                        <?php } ?>

                                        <button class="percent_color c_percent_100_<?php echo $i; ?> c_percent_<?php echo $i; ?>" id="c_percent_<?php echo $i; ?>" parcentId="<?php echo $i; ?>" value="100" style="background: none;width: 100%;padding: 10px 0px;border: 1px solid #ccc;font-size: 14px;text-align: center;">
                                            100%
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 list_q_box_bg working" style="border: 1px solid;color: aqua;margin-left: 14px;width: 60%;" id="list_q_box_<?php echo $i; ?>">
                                <div class="col-md-12" style="padding: 2px;margin-left: -6px;">
                                    <?php echo $row[0]; ?>
                                </div>
                                <div class="row editor_hide" id="list_box_<?php echo $i; ?>" style="margin-bottom:5px">
                                    <div class="col-xs-2">
                                        <p class="ss_lette" style="display:none;background:none;min-height:40px;line-height: 40px"><?php echo $lettry_array[$i - 1]; ?></p>
                                    </div>
                                    <div class="col-xs-6">

                                        <div class="box" id="box_<?php echo $i; ?>" style="display:none;border: 1px solid #565656;padding: 10px;text-align: center;">
                                            <button class="click_btn" contentId="<?php echo $i; ?>" id="click_btn" style="background: none;border: none;">Click Here</button>
                                        </div>
                                    </div>

                                    <div class="col-xs-1" style="color:<?php //; 
                                                                        ?>">

                                        <input type="hidden" id="percentage_<?php echo $i; ?>" name="percentage_<?php echo $i; ?>" value="">
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php $i++;
                    }
                    // die();


                    ?>


                </div>
            </div>
        </div>
    </div>
</form>


<?php

function showTrueFalse($correct, $student_ans)
{
    //0=not display, 1=tick, 2=cross
    $result = array(
        '0' => '0',
        '25' => '0',
        '50' => '0',
        '100' => '0',
    );

    foreach ($result as $key => $value) {

        if ($correct == $key) {

            $result[$key] = '1';
        }

        if ($student_ans == $key) {
            if ($result[$key] == '0') {
                if ($student_ans == $correct) {
                    $result[$key] = '1';
                } else {
                    $result[$key] = '2';
                }
            }
        }
    }


    // for($i= 1; $i<=4; $i++){
    //     $show = FALSE;

    //     if ($['percentage_' . $i][0] == 0 || $studentAnswerArray['percentage_' . $i] == 0) {
    //         $show = TRUE;
    //     }
    //     if ($show) {

    //         $correct = FALSE;
    //         if($['percentage_' . $i] == $studentAnswerArray['percentage_' . $i][0]){
    //             $correct = TRUE;
    //         }



    //         if ($correct == $student_ans) {
    //             echo "true";
    //         }else{
    //             echo "false";
    //         }
    //     }




    //     // $correct = FALSE;
    //     // if($answerArray['percentage_' . $i] == $studentAnswerArray['percentage_' . $i][0]){
    //     //     $correct = TRUE;
    //     // }

    //     // $show_1 = FALSE;
    //     // if ($studentAnswerArray['percentage_' . $i][0] == 100 || $studentAnswerArray['percentage_' . $i] == 100) {
    //     //     $show_1 = TRUE;
    //     // }
    //     // if ($show_1) {

    //     // if ($answerArray['percentage_' . $i] == $studentAnswerArray['percentage_' . $i][0]) {

    //     // }

    // }

    //end forloop

    return $result;
}




?>