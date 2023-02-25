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
#ss_extar_top20{
    width: 628px;
    height: 389px;
    overflow: auto;
}


.question_bg_0{
  background: #ffceae !important;
  color: #fff;
}
.question_bg_25{
  background: #ffac75 !important;
  color: #fff;
}
.question_bg_50{
  background: #ff7f27 !important;
  color: #fff;
}
.question_bg_100{
  background: #e85c00 !important;
  color: #fff;
}
button:disabled {
  background: #dddddd !important;
}
.ss_timer h1 {
    border: 1px solid #a8a2a2;
    font-size: 17px;
    margin: 0;
    line-height: 28px;
    padding: 3px 0px;
    color: #222;
    }
    .workout_menu ul li {
    display: inline-block;

    margin-right: 5px;
   }
  .ss_timer {
      margin-left: 5px;
      display: inline-block;
      background: #eeeef0;
      border: 0;
      min-width: 110px;
      text-align: center;
  }
  .workout_menu img.calculator-trigger{
    margin-top:0;
    margin-bottom:0;
    width: 30px;
    height: 39px;
   }
</style>
<style>
  .workout_menu ul li {
    display: inline-block;

    margin-right: 5px;
   }
  .ss_timer {
      margin-left: 5px;
      display: inline-block;
      background: #eeeef0;
      border: 0;
      min-width: 110px;
      text-align: center;
  }
</style>
<?php
date_default_timezone_set($this->site_user_data['zone_name']);
$module_time = time();

//    For Question Time
$question_time = explode(':', $question_info_s[0]['questionTime']);
$hour = 0;
$minute = 0;
$second = 0;
if (is_numeric($question_time[0])) {
    $hour = $question_time[0];
} if (is_numeric($question_time[1])) {
    $minute = $question_time[1];
} if (is_numeric($question_time[2])) {
    $second = $question_time[2];
}

$question_time_in_second = ($hour * 3600) + ($minute * 60) + $second ;

//    End For Question Time

?>

<?php 
    $question_instruct = isset($question_info_s[0]['question_video']) ? json_decode($question_info_s[0]['question_video']):'';
?>
<input type="hidden" id="exam_end" value="" name="exam_end" />
<input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
<input type="hidden" id="optionalTime" value="<?php echo $question_time_in_second;?>" name="optionalTime" />
<input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />
<input type="hidden" id="answershow" name="answerClick" value="0" />

<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="ss_index_menu">
            <a href="<?php echo base_url().$userType.'/view_course'; ?>">Question/Module</a>
        </div>

        

        <div class="col-sm-6 ss_next_pre_top_menu">

            

            <a class="btn btn_next" href="question_edit/<?php echo $question_item?>/<?php echo $question_id?>">
                <i class="fa fa-caret-left" aria-hidden="true"></i> Back
            </a>
            <a class="btn btn_next" href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
            <a class="btn btn_next" id="draw" onClick="test()" data-toggle="modal" data-target=".bs-example-modal-lg">
                Workout <img src="assets/images/icon_draw.png">
            </a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <form id="answer_form"><input type="hidden" value="<?php echo $question_id ?>" name="question_id" id="question_id">

            <div class="ss_s_b_main" style="min-height: 100vh">
                <div class="col-md-8" id="box_one" style="display: none;">
                    <div class="col-sm-10" id="answer_box">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title" style="text-align: center;">
                                          Answer
                                            <button type="button" class="woq_close_btn" id="woa_close_btn">&#10006;</button>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">

                                        <textarea  class="mytextarea" name="workout"></textarea>
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
                    <div class="workout_menu">
                        <ul>
                            <?php if($question_info->questionName != '') { ?>
                                <li><a style="cursor:pointer" id="show_question">Question<i>(Click Here)</i></a></li>
                            <?php } ?>
                            <li>
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> <span><img src="assets/images/icon_draw.png"> Instruction</span></a>
                            </li>
                            <?php if ($question_time_in_second != 0) { ?>
                                <li><div class="ss_timer" id="demo"><h1>00:00:00 </h1></div></li>
                            <?php }?>

                            <?php if ($question_info_s[0]['isCalculator']) : ?>
                                <li><input type="hidden" name="" id="scientificCalc"></li>
                            <?php endif; ?>
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
                                            <?php echo $question_info->questionName; ?>
                                        </div> 
                                        <!-- <textarea disabled class="mytextarea"><?php echo $question_info->questionName;?></textarea> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8" id="box_two">

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-0" style="padding: 0;">
                                   <!--<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> <span><img src="assets/images/icon_draw.png"> Instruction</span></a>-->
                                </div>
<!--                                <div class="col-md-6" style="border:1px solid #ccc;padding: 10px;line-height: 1.2;">-->
                                <div class="col-md-7" style="text-align: center;font-size: 16px;">
                                    <div class="question_hint"><?php echo $question_info->question_hint?></div>
                                </div>
                            </div>
                            <div class="button_click" style="margin-top: 20px;">
                                <div class="panel-body ss_imag_add_right">

                                    <?php
                                    $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
                                    ?>
                                    <?php $i = 1;
                                    foreach ($question_info_ind->vocubulary_image as $row) { ?>

                                        <div class="question_content" id="question_content_<?php echo $i; ?>" style="height: 300px;overflow:scroll;display:none;width: 600px;padding: 10px;border:1px solid #ccc;position: absolute;top:0px;left:19%;z-index: 3;background: #fff;">
                                            <div style="text-align:right;border-bottom: 1px solid #ccc">
                                                <button style="margin-bottom:6px;border: 1px solid #b3b3b3;width:40px;height:40px;border-radius: 20px;font-size: 14px;color: #fff;background: #c1c1c1;" type="button" contentId ="<?php echo $i; ?>" class="wocb_close_btn" id="woa_close_btn">&#10006;</button>
                                            </div>
                                            <div style="padding-top: 10px;">
                                                <?php echo $row[0]; ?>
                                            </div>
                                        </div>

                                        <div class="row" style="margin-bottom: 15px;margin-left: -60px;">
                                            <div class="col-md-4">
                                                <div class="row "id="content_percent_<?php echo $i; ?>" style="">
                                                    <div class="col-md-3" style="padding-right: 0px;">
                                                        <span class="c_p_box_0_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: green;">✓</span><span class="r_p_box_0_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: red;">✖</span>
                                                        <button class="percent_color c_percent_0_<?php echo $i; ?> c_percent_<?php echo $i; ?>" id="c_percent_<?php echo $i; ?>" parcentId ="<?php echo $i; ?>" value="0" style="background: none;width: 100%;padding: 10px 0px;border: 1px solid #ccc;font-size: 14px;text-align: center;">0%</button>
                                                    </div>
                                                    <div class="col-md-3" style="padding-right: 0px;">
                                                        <span class="c_p_box_25_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: green;">✓</span><span class="r_p_box_25_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: red;">✖</span>
                                                        <button class="percent_color c_percent_25_<?php echo $i; ?> c_percent_<?php echo $i; ?>" id="c_percent_<?php echo $i; ?>" parcentId ="<?php echo $i; ?>" value="25"style="background: none;width: 100%;padding: 10px 0px;border: 1px solid #ccc;font-size: 14px;text-align: center;">25%</button>
                                                    </div>
                                                    <div class="col-md-3" style="padding-right: 0px;">
                                                        <span class="c_p_box_50_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: green;">✓</span><span class="r_p_box_50_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: red;">✖</span>
                                                        <button class="percent_color c_percent_50_<?php echo $i; ?> c_percent_<?php echo $i; ?>" id="c_percent_<?php echo $i; ?>" parcentId ="<?php echo $i; ?>" value="50" style="background: none;width: 100%;border: 1px solid #ccc;padding: 10px 0px;font-size: 14px;text-align: center;">50%</button>
                                                    </div>
                                                    <div class="col-md-3" style="padding-right: 0px;">
                                                        <span class="c_p_box_100_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: green;">✓</span><span class="r_p_box_100_<?php echo $i; ?>" style="display:none;position: absolute;top: -17px;left: 32px;color: red;">✖</span>
                                                        <button class="percent_color c_percent_100_<?php echo $i; ?> c_percent_<?php echo $i; ?>" id="c_percent_<?php echo $i; ?>" parcentId ="<?php echo $i; ?>" value="100" style="background: none;width: 100%;padding: 10px 0px;border: 1px solid #ccc;font-size: 14px;text-align: center;">
                                                            100%
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 list_q_box_bg" style="border: 1px solid;color: aqua;width: 60%;margin-left: 14px;" id="list_q_box_<?php echo $i; ?>">
                                                <div class="col-md-12" style="padding: 2px;margin-left: -6px;">
                                                    <?php echo $row[0]; ?>
                                                </div>
                                                <div class="row editor_hide " id="list_box_<?php echo $i; ?>" style="margin-bottom:5px">
                                                     
                                                    <div class="col-xs-2" >
                                                        <p class="ss_lette" style="display:none;background:none;min-height:40px;line-height: 40px"><?php echo $lettry_array[$i - 1]; ?></p>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="box" id="box_<?php echo $i; ?>" style="display:none;border: 1px solid #565656;padding: 10px;text-align: center;">
                                                            <button class="click_btn" contentId ="<?php echo $i; ?>"  id="click_btn" style="background: none;border: none;">Click Here</button>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-1" style="color:<?php //; ?>">
<!--                                                        <input type="radio" class="answerClick" name="answer" value="--><?php //echo $i; ?><!--" >-->
                                                        <input type="hidden" id="percentage_<?php echo $i; ?>" name="percentage_<?php echo $i; ?>" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <?php $i++;
                                    } ?>
                                    <?php
                                    $counter = sizeof($question_info_ind->vocubulary_image);
                                    $desired_i = $counter + 1;
                                    ?>
                                    <?php for ($desired_i; $desired_i <= 20; $desired_i++) { ?>
                                        <div class="row editor_hide" id="list_box_<?php echo $desired_i; ?>" style="display:none; margin-bottom:5px">
                                            <div class="col-xs-2">
                                                <p class="ss_lette" style="min-height: 136px; line-height: 137px; ">
                                                    <?php echo $lettry_array[$desired_i - 1]; ?>
                                                </p>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="box">
                                                    <textarea class="form-control mytextarea" name="vocubulary_image_<?php echo $desired_i; ?>[]"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-1">
                                                <input type="radio" name="response_answer" value="<?php echo $desired_i; ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-md-3"></div>

                                        <div style="margin-top:15px;padding: 0;" class="col-md-6">
                                            <a class="btn btn_next" style="margin-right: 13%" id="answer_matching">Submit</a>
<!--                                            <a class="btn btn_next" style="margin-right: 13%;display: none;" id="answer_saving">ok</a>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  <span>Module Name: Every Sector</span></a>
                                </h4>
                            </div>
                            <div id="collapsethree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class=" ss_module_result">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>

                                                    <th>SL</th>
                                                    <th>Mark</th>

                                                    <th>Description / Video</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>

                                                    <td>1</td>
                                                    <td><?php echo $question_info_s[0]['questionMarks']; ?></td>
                                                    <td class="text-center">
                                                        <a onclick="showDescription()" style="display: inline-block;">
                                                          <img src="assets/images/icon_details.png">
                                                        </a>
                                                      <?php if (isset($question_instruct[0]) && $question_instruct[0] != null ){ ?>
                                                        <a onclick="showQuestionVideo()" class="text-center" style="display: inline-block;"><img src="http://q-study.com/assets/ckeditor/plugins/svideo/icons/svideo.png"></a>
                                                      <?php } ?>
                                                    </td>
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
            </div>
           </form>
        </div>
    </div>
</div>

<!--Description Modal-->
<div class="modal fade ss_modal" id="ss_info_description" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Question Description</h4>
            </div>
            <div class="modal-body row">
                <span class="ss_extar_top20"><?php echo $question_info_s[0]['questionDescription']?></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
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
                <img src="assets/images/icon_sucess.png" class="pull-left"> <span class="ss_extar_top20">Your answer is correct</span> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>

<!--Solution Modal-->

<div class="modal fade" id="ss_info_worng" role="dialog">
    <div class="modal-dialog ui-draggable" style=" width: 48%;">

        <!-- Modal content-->
        <div class="modal-content" style="width: 100%;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-close" style="font-size:20px;color:red"></i><br> Solution</h4>
            </div>
            <div class="modal-body">
                <div id="ss_extar_top20">
                    <?php echo $question_info_s[0]['question_solution']?>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>   
            </div>
        </div>

    </div>
</div>


<!--Success Modal-->
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


<!--Times Up Modal-->
<div class="modal fade ss_modal" id="times_up_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Times Up</h4>
            </div>
            <div class="modal-body row">
                <i class="fa fa-close" style="font-size:20px;color:red"></i>
                <!--<span class="ss_extar_top20">Your answer is wrong</span>-->
                <br><?php echo $question_info_s[0]['question_solution']?>
            </div>
            <div class="modal-footer">
                <button type="button" id="question_reload" class="btn btn_blue" data-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>

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
                url: 'IDontLikeIt/answer_matching_multiple_choice',
                data: form.serialize(),
                dataType: 'html',
                success: function (results) {
                    if (results == 1) {
                        $('#ss_info_sucesss').modal('show');
                    }
                    else {
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
    //$( document ).ready(function() {
    //    var PercentageObj =<?php //echo json_encode($question_info_ind->percentage_array);?>//;
    //    var PercentageArray = $.makeArray( PercentageObj );
    //});

    $("#show_question").click(function () {
       $("#question_box").show();
       $("#answer_box").hide();
       $(".btn_next").hide();
       $("#box_two").hide();
       
    });
    $("#woq_close_btn").click(function () {
       $("#answer_box").show();
       $("#question_box").hide();
       $(".btn_next").show();
       $("#box_two").show();
    });
    $("#click_box_btn").click(function () {
        var workout_val = CKEDITOR.instances['workout'].getData();
        if (workout_val == '')
        {
            alert('You have to do workout first');
        }else
        {
            $("#box_two").show();
            $("#box_one").hide();
        }
    });
    $(".click_btn").click(function (event) {
        event.preventDefault();
        var id = $(this).attr("contentId");
        $("#box_"+id).addClass( "button_bg");
        $('#question_content_'+id).show();
    });
    $(".wocb_close_btn").click(function (event) {
        event.preventDefault();
        var id = $(this).attr("contentId");
        $('#question_content_'+id).hide();
        $('#content_percent_'+id).show();
    });
    $(".percent_color").click(function (event) {
        event.preventDefault();
        var parcentId = $(this).attr("parcentId");
        var value = $(this).attr("value");
        var idIndex = 'percentage_'+parcentId;
        $("#"+idIndex).val(value);
        var classExsit = $(".c_percent_"+parcentId).hasClass( "parcent_bg" );
        var ThisExsit = $(this).hasClass( "parcent_bg" );
        if (classExsit == true)
        {
            $(".c_percent_"+parcentId).removeClass( "parcent_bg" );
            $(".c_percent_"+parcentId).removeClass( "question_bg_"+value );
            $("#list_q_box_"+parcentId).removeClass( "question_bg_"+value );
            $(".c_percent_"+parcentId).removeClass( "one_button_active" );
            //$(this).addClass( "parcent_bg");
            active_button(parcentId,value);
            remove_value_class(value);
        }else
        {
            $(this).addClass( "parcent_bg");
            $(this).addClass( "question_bg_"+value );
            $("#list_q_box_"+parcentId).addClass( "question_bg_"+value );
            $(".c_percent_"+parcentId).addClass( "one_button_active" );
            hide_button(parcentId,value);
            add_value_class(value);
        }

    });
    // $(".answerClick").click(function () {
    //     var answer = $(this).val();
    //     $("#answershow").val(answer);
    // })


    function hide_button(a,b){
      console.log(a);
      for(var j=0; j<=100;j){
          var value = $('.c_percent_'+j+'_'+a).val();
          //console.log('.c_percent_'+j+'_'+a);
          if(value != b){
              $('.c_percent_'+j+'_'+a).prop('disabled',true);
          }
          j = j + 25;
      }
      var s = 1;
      for(var k=0; k<=4;k++){
          var value = $('.c_percent_'+b+'_'+s).val();
          //console.log('.c_percent_'+b+'_'+s);
          if(a != s){
              $('.c_percent_'+b+'_'+s).prop('disabled',true);
          }
          s = s + 1;
      }
      
    }
    
    function active_button(a,b){
      for(var j=0; j<=100;j){
          var value = $('.c_percent_'+j+'_'+a).val();
          var classExsit = $('.c_percent_'+j+'_'+a).hasClass( "value_active_class_"+j );
         //   console.log('.c_percent_'+j+'_'+a);
          if(classExsit == false){
            $('.c_percent_'+j+'_'+a).prop('disabled',false); 
          }
          j = j + 25;
      }
      
      var s = 1;
      for(var k=0; k<=4;k++){
          var value = $('.c_percent_'+b+'_'+s).val();
          var classExsit = $(".c_percent_"+s).hasClass( "one_button_active" );
          console.log('.c_percent_'+b+'_'+s);
          console.log(classExsit);
          if(classExsit == false){
            $('.c_percent_'+b+'_'+s).prop('disabled',false);
          }
          s = s + 1;
      }
      
      
    }
    
    function add_value_class(b){
      var s = 1;
      for(var k=0; k<=4;k++){
          $('.c_percent_'+b+'_'+s).addClass( "value_active_class_"+b);
          s = s + 1;
      }
    }
    function remove_value_class(b){
      var s = 1;
      for(var k=0; k<=4;k++){
          $('.c_percent_'+b+'_'+s).removeClass( "value_active_class_"+b);
          s = s + 1;
      }
    }
    

</script>
<script>
    var checkAllFiled = [];
    var resultArray;
    $('#answer_matching').click(function () {
        checkAllFiled = [];
        var PercentageObj =<?php echo json_encode($ans_count);?>;
        var ansFiled = $("#answershow").val();
        var percentInputValue;
        var percentId;
        for (var i = 1;i<=PercentageObj;i++)
        {
            var  checkvalue =  $("#percentage_"+i).val();
            if (checkvalue != '')
            {
                //checkAllFiled[i-1] = parseInt(checkvalue);
                checkAllFiled.push(parseInt(checkvalue));
            }
        }
        var stdAnsLen = checkAllFiled.length;
        if ((PercentageObj != stdAnsLen) && ansFiled == '')
        {
            alert('Select all percentage filed and answer filed');
        }else if ((PercentageObj == stdAnsLen) && ansFiled == '')
        {
            alert('Select answer filed');
        }else if ((PercentageObj != stdAnsLen) && ansFiled != '')
        {
            alert('Select all percentage filed');
        }else {

            var question_id = $("#question_id").val();
            $.ajax({
                type: 'POST',
                url: 'Student/st_answer_matching_without_form_workout_two',
                data:{checkAllFiled:checkAllFiled,question_id:question_id,ansFiled:ansFiled} ,
                dataType: 'json',
                success: function (results) {
                    resultArray = results;
                    
                    var correct = results.correct;
                    var correct_ans = results.correct_ans;
                    var PercentageObj = results.percentage_array;
                    var student_answer = results.student_answer;
                    var tutorAnsLen = Object.keys(PercentageObj).length;
                    for (var i = 1;i<=tutorAnsLen;i++)
                    {
                        var percentInputValue = '';
                        var percentId = 'percentage_'+i;
                        var itemvalue = '';
                        var classIcon = '';
                        var classBg = '';
                        var classIconR = '';
                        var classIconC = '';
                        percentInputValue = $("#percentage_"+i).val();
                        itemvalue = PercentageObj[percentId];
                        if (percentInputValue != '')
                        {
                            if (percentInputValue == PercentageObj[percentId])
                            {
                                classIcon = 'c_p_box_'+percentInputValue+'_'+i;
                                $("."+classIcon).css({"display": "block"});
                            }else {
                                classIconR = 'r_p_box_'+percentInputValue+'_'+i;
                                $("."+classIconR).css({"display": "block"});
                                classBg = 'c_percent_'+itemvalue+'_'+i;
                                $("."+classBg).css({"background-color": "green","color":"#fff"});
                            }
                        }
                        if (correct_ans == i)
                        {
                            $("#box_"+i).css({"background-color": "green","color":"#fff"});
                        }

                    }
                    // $("#answer_matching").hide();
                    // $("#answer_saving").show();
                    if (correct == 1)
                    {
                        answer_saving_workout_two();
                        // $("#answer_saving").hide();
                    }else {
                        $('#ss_info_worng').modal('show');
                    }
                }

            });
        }
    });

    $("#answer_saving").click(function () {

        var totalP =<?php echo json_encode($ans_count);?>;
        checkAllFiled = [];
        for (var Tid = 1;Tid<=totalP;Tid++)
        {
            //var Tid =t+1;
            $(".c_p_box_0_"+Tid).css({"display": "none"});
            $(".c_p_box_25_"+Tid).css({"display": "none"});
            $(".c_p_box_50_"+Tid).css({"display": "none"});
            $(".c_p_box_100_"+Tid).css({"display": "none"});
            $(".r_p_box_0_"+Tid).css({"display": "none"});
            $(".r_p_box_25_"+Tid).css({"display": "none"});
            $(".r_p_box_50_"+Tid).css({"display": "none"});
            $(".r_p_box_100_"+Tid).css({"display": "none"});
            $(".percent_color").removeClass('parcent_bg');
            // addedAS
            $(".percent_color").removeClass( "question_bg"+Tid );
            $(".list_q_box_bg").removeClass( "question_bg"+Tid );
            $('.percent_color').prop('disabled',false);
            
            $(".c_percent_0_"+Tid).css({"background": "#fff","color":"#444444"});
            $(".c_percent_25_"+Tid).css({"background": "#fff","color":"#444444"});
            $(".c_percent_50_"+Tid).css({"background": "#fff","color":"#444444"});
            $(".c_percent_100_"+Tid).css({"background": "#fff","color":"#444444"});
            $("#box_"+Tid).css({"background": "#00A2E8"});
            $("#percentage_"+Tid).val('');
        }

        // $(".answerClick").checked = false;
        $(".answerClick").prop('checked', false);
        $("#answer_matching").show();
    });
    function answer_saving_workout_two() {
        var form = $("#answer_form");
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/answer_matching_workout_two',
            data: form.serialize(),
            dataType: 'html',
            success: function (results) {
                if (results == 1) {
                    clearInterval(clear_interval);
                    $('#ss_info_sucesss').modal('show');
                } else {
                    $('#ss_info_worng').modal('show');
                }
            }
        });
    }
    function showDescription(){
        $('#ss_info_description').modal('show');
    }
    function showQuestionVideo(){
        $('#ss_question_video').modal('show');
    }

</script>

<script type="text/javascript">

    $("#ss_info_worng").on("hidden.bs.modal", function () {
        results = resultArray;
        var correct = results.correct;
        var correct_ans = results.correct_ans;
        var PercentageObj = results.percentage_array;
        var student_answer = results.student_answer;
        var tutorAnsLen = Object.keys(PercentageObj).length;
        for (var i = 1;i<=tutorAnsLen;i++)
        {
            var percentInputValue = '';
            var percentId = 'percentage_'+i;
            var itemvalue = '';
            var classIcon = '';
            var classBg = '';
            var classIconR = '';
            var classIconC = '';
            percentInputValue = $("#percentage_"+i).val();
            itemvalue = PercentageObj[percentId];
            if (percentInputValue != '')
            {
                if (percentInputValue == PercentageObj[percentId])
                {
                    classIcon = 'c_p_box_'+percentInputValue+'_'+i;
                    $("."+classIcon).css({"display": "none"});
                    
                    $(".percent_color").removeClass( "question_bg_"+percentInputValue);
                    $(".list_q_box_bg").removeClass( "question_bg_"+percentInputValue);
                }else {
                    classIconR = 'r_p_box_'+percentInputValue+'_'+i;
                    $("."+classIconR).css({"display": "none"});
                    classBg = 'c_percent_'+itemvalue+'_'+i;
                    idss = 'c_percent_'+i;
                    $(".percent_color").removeClass("parcent_bg");
                    // added AS
                    $(".percent_color").removeClass( "question_bg_"+percentInputValue);
                    $(".list_q_box_bg").removeClass( "question_bg_"+percentInputValue);
                    $('.percent_color').prop('disabled',false);
                    
                    $("."+classBg).css({"background-color": "#fff","color":"black"});
                }
            }
            if (correct_ans == i)
            {
                $("#box_"+i).css({"background-color": "#fff","color":"black"});
                $(".percent_color").removeClass( "question_bg_"+percentInputValue);
                $(".list_q_box_bg").removeClass( "question_bg_"+percentInputValue);
            }

        }
    });
    
</script>
<?php $this->load->view('preview/drawingBoardForWorkoutTwo'); ?>
