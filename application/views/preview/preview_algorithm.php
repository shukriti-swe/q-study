<?php
if (isset($question_info['item'])) {
    end($question_info['item']);
    $last_item_index = key($question_info['item']);

    $i = 1;

    foreach ($question_info['item'][1] as $key => $value) {
        if (!empty($value)) {
            $index_q = $i;
            $i++;
        }
    }

    $i = 1;

    foreach ($question_info['item'][2] as $key => $value) {
        if (!empty($value)) {
            $index_ans = $i;
            $i++;
        }
    }

    $index = $index_q - $index_ans;

    if ($index > 1 ) {
        $px = -18 - ( 25 * ( $index - 1) );
    }else{
        $px = -18;
    }
}
    
//    echo '<pre>';print_r($question_info);die;
?>

<?php 
    $question_instruct = isset($question_info_s[0]['question_video']) ? json_decode($question_info_s[0]['question_video']):'';
?>

<style>
    .operator_div{
        display: inline-block;
        position: relative;
        width: 0;
    }
    
    .operator_div span{
        position: absolute;
        bottom: -2px;
        left: <?= $px ?>px;
    }
    .calculator-trigger {
    width: 30px;
    height: 35px;
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
<?php
    //$answerCount = count($question_info_s[0]['answer']);
    // echo "<pre>";print_r($answerCount);die();
    
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
     // echo $question_time_in_second;
//    End For Question Time

?>
<input type="hidden" id="exam_end" value="" name="exam_end" />
<input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
<input type="hidden" id="optionalTime" value="<?php echo $question_time_in_second;?>" name="optionalTime" />
<input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />

<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="ss_index_menu">
            <a href="<?php echo base_url().$userType.'/view_course'; ?>">Question/Module</a>
        </div>
        <div class="col-sm-6 ss_next_pre_top_menu">
            <a class="btn btn_next" href="question_edit/<?php echo $question_item; ?>/<?php echo $question_id; ?>">
                <i class="fa fa-caret-left" aria-hidden="true"></i> Back
            </a>
            <a class="btn btn_next" href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
            <a class="btn btn_next" href="javascript:void(0)" onclick="showDrawBoard()">Workout <img src="assets/images/icon_draw.png"></a>
        </div>
    </div>
    <div class="container-fluid">
        <form id="preview_form">
            <div class="row">
                <div class="ss_s_b_main" style="min-height: 100vh">
                    <div class="col-sm-4">
                        <div class="workout_menu" style="margin-bottom: 30px;">
                          <ul>
                              <li>
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_draw.png"> Instruction</span></a>
                              </li>
                              <?php if ($question_time_in_second != 0) { ?>

                                <li><div class="ss_timer" id="demo"><h1>00:00:00 </h1></div></li>

                                <?php }?>
                                <?php if ($question_info_s[0]['isCalculator']) : ?>
                                    <li><input type="hidden" name="" id="scientificCalc"></li>
                                <?php endif; ?>
                              
                              <?php if($question_info_s[0]['question_name_type'] == 2) { ?>

                                <li><a style="cursor:pointer" id="show_question" onclick="show_question()">Question<i>(Click Here)</i></a></li>
                              <?php } ?>
                          </ul>
                        </div>
                    </div>
                    
                    <input type="hidden" value="<?php echo $question_id; ?>" name="question_id" id="question_id">
                    
                    <div class="col-sm-4">

                        <div style="border:1px solid #dfdfdf;margin-bottom: 5px;">
                            <div class="math_plus">
                                <?php echo $question_info['questionName']; ?>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 times_table_div" style="<?php if($question_info['operator'] != '/'){?>text-align: center<?php }?>">
                                    <div style="font-size: 30px;">
                                        <?php if ($question_info['operator'] != '/') { ?>
                                            <div id="quesBody" style="padding: 0px 10px;border-bottom: 2px solid black;text-align: right;margin-bottom: 10px;">
                                                <?php $i = 1;
                                                foreach ($question_info['item'] as $row) {
                                                    if ($i == $last_item_index) {
                                                        ?>
                                                        <div class="operator_div"><span><?php echo $question_info['operator'] ?></span></div>
                                                    <?php }
                                                    foreach ($row as $key_data) {
                                                        ?>
                                                        <span><?php echo $key_data; ?></span>
                                                <?php } ?><br>
                                                <?php $i++;
                                            } ?>
                                            </div>
                                        <?php } if ($question_info['operator'] == '/') { ?>
                                            <div style="display: block;margin-top: 55px;">
                                                <div class="form-group" style="float: left;">
                                                    <input type="text" class="form-control" id="" name="answer[]" autocomplete="off" autofocus style="font-size: 30px;max-width: 160px !important">
                                                </div>
                                                <div class="form-group" style="float: left;margin-left: 30px;">
                                                    <label>R</label>
                                                    <input type="text" class="form-control" id="" name="answer[]" autocomplete="off" autofocus style="font-size: 30px;">
                                                </div>

                                            </div>

                                            <div>
                                                <div id="quesBody" style="float: left;padding: 5px;">
                                                        <?php
                                                        foreach ($question_info['divisor'] as $divisor) {
                                                            echo $divisor;
                                                        }
                                                        ?><span class="dividend">
                                                            <?php
                                                            foreach ($question_info['dividend'] as $dividend) {
                                                                echo $dividend;
                                                            }
                                                            ?>
                                                        </span>
                                                </div>
                                                <!--<div style="float: left;padding: 5px;background-image: url('assets/images/44.png');padding: 3px 5px 6px 17px;background-repeat: no-repeat;background-position: 0px 0px;min-height: 41px;">
                                                <?php
                                                foreach ($question_info['dividend'] as $dividend) {
                                                    echo $dividend;
                                                }
                                                ?>
                                                </div>-->
                                            </div>

                                        <?php } ?>
                                    </div>

                                    <?php if ($question_info['operator'] != '/') { ?>

                                    <input type="text" class="form-control" id="" name="answer" autocomplete="off" autofocus style="font-size: 30px; margin-bottom: 10px;margin-left: 30%;width: 40%;margin-top: -10px;">

                                     <?php } ?>
                                    
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="col-sm-12" style="text-align: center">
                            <button class="btn btn_next" type="submit" id="answer_matching">Submit</button>
                        </div>
                        
                    </div>

                    <div class="col-sm-4">
                        <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  
                                            <span>Module Name: Every Sector</span></a>
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
                                                                <!-- <th>Obtained</th> -->
                                                                <th>Description / Video</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td><?php echo $question_info_s[0]['questionMarks']; ?></td>
                                                                <!-- <td><?php // echo $question_info[0]['questionMarks']; ?></td> -->
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
                    
                    <div class="col-sm-4 pull-right" id="draggable" style="display: none;">
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

                    <!--<div class="col-sm-12" style="text-align: center">
                        <button class="btn btn_next" type="submit" id="answer_matching">Submit</button>
                    </div>-->

                </div>

            </div>
        </form>
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

    <!--Success Modal-->
    <div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
                </div>

                <div class="modal-body row">
					<img src="assets/images/icon_sucess.png" class="pull-left"> 
                    <span class="ss_extar_top20">Your answer is correct</span>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

                </div>
            </div>
        </div>
    </div>

    <!--Solution Modal-->
    <div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Solution</h4>
                </div>
                <div class="modal-body row">
                    <i class="fa fa-times" style="font-size:20px;color:red"></i><br>
                    <span class="ss_extar_top20">
                        <?php echo $question_info_s[0]['question_solution']?>
                        
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
                </div>
            </div>
        </div>
    </div>


<script>
   
    $("#preview_form").on('submit', function (e) {
        e.preventDefault();
		var workout_val = CKEDITOR.instances['workout'].getData();
		if(workout_val == ''){
			alert('You have to do workout first');
		}  else {
            var form = $("#preview_form");
        
            $.ajax({
                type: 'POST',
                url: 'IDontLikeIt/answer_algorithm',
                data: form.serialize(),
                dataType: 'html',
                success: function (results) {
                    if (results == 0) {
                        $('#ss_info_worng').modal('show');
                    } else if (results == 1) {
                        $('#ss_info_sucesss').modal('show');
                    }
                }
            });
        }

    });

    function showDescription(){
        $('#ss_info_description').modal('show');
    }
    function showQuestionVideo(){
        $('#ss_question_video').modal('show');
    }
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
        
        //alert('vvv');
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

<?php $this->load->view('module/preview/drawingBoard'); ?>
