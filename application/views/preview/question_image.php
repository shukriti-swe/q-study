<style>
.workout_menu ul li {
display: inline-block;
float: left;
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
.ss_timer h1 {
    font-size: 17px;
    margin: 0;
    line-height: 14px !important;
    padding: 7px 10px;
    color: #222;
}
.workout_menu img.calculator-trigger{
    margin-top:0;
    margin-bottom:0;
    width: 30px;
    height: 39px;
}

</style>
<?php

date_default_timezone_set($this->site_user_data['zone_name']);
$module_time = time();

    //    For Question Time
$question_time = explode(':', $question_info[0]['questionTime']);
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
        <div class="row">
            <div class="ss_s_b_main" style="min-height: 100vh">
                <div class="col-sm-4">
                    <div class="workout_menu" style=" padding-right: 15px;">
                        <ul>
                        <li><a style="cursor:pointer" id="show_question"> <img src="assets/images/icon_draw.png"/> Instruction </a></li>

                        <?php if ($question_time_in_second != 0) { ?>
                           
                            <li><div class="ss_timer" id="demo"><h1 style="padding: 10px;border: 1px solid #cfc4c4;">00:00:00 </h1></div></li>
                     
                        <?php }?>
                        <?php if ($question_info[0]['isCalculator']) : ?>
                            <li><input type="hidden" name="" id="scientificCalc"></li>
                        <?php endif; ?>  
                        </ul>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $question_id; ?>" name="question_id" id="question_id">
                <div class="col-sm-4">
                    <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default" style="border: 1px solid #dbd8d8;">
                        <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <div class="image_box_list_result result">
                                <div class="image_box_list" style="overflow: visible;">
                                  <div class="row">
                                    <div class="">
                                      <div class="">

                                        <div class=" math_plus" id="quesBody">
                                            <?php echo ($question_info[0]['questionName']); ?>
                                        </div>
                                        <div class="form-group" style="padding: 0px 12px;">
                                          <input type="text" autofill="off" class="form-control" autocorrect="off" spellcheck="false" autocomplete="off" name="answer" id="answer">
                                        </div>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                                <input type="hidden" value="<?php echo $question_id;?>" name="question_id" id="question_id">
                                
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
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
                                                        <td><?php echo $question_info[0]['questionMarks']; ?></td>
                                                        <!-- <td><?php // echo $question_info[0]['questionMarks']; ?></td> -->
                                                        <td class="text-center">
                                                            <a onclick="showDescription()" class="text-center" style="display: inline-block;"><img src="assets/images/icon_details.png"></a>
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
								<div class="panel-body">
									<textarea name="workout" class="mytextarea"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>

            </div>

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
                <span class="ss_extar_top20"><?php echo $question_info[0]['questionDescription']?></span> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>


<!--Description Modal-->
<?php 
    $question_instruct = isset($question_info[0]['question_video']) ? json_decode($question_info[0]['question_video']):'';
?>
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
                <img src="assets/images/icon_sucess.png" class="pull-left"> <span class="ss_extar_top20">Your answer is correct</span> 
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
                    <?php echo $question_info[0]['question_solution']?>
                    
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
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
                <br><?php echo $question_info[0]['question_solution']?>
            </div>
            <div class="modal-footer">
                <button type="button" id="question_reload" class="btn btn_blue" data-dismiss="modal">close</button>         
            </div>
        </div>
    </div>
</div>

<script>
    $('#answer_matching').click(function () {
        var user_answer = $('#answer').val();
        var id = $('#question_id').val();
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/answer_matching',
            data: {
                user_answer: user_answer,
                id: id
            },
            dataType: 'html',
            success: function (results) {
                if (results == 0) {
                    $('#ss_info_worng').modal('show');
                } else if (results == 1) {
                    clearInterval(clear_interval);
                    $('#ss_info_sucesss').modal('show');
                    
                }
            }
        });

    });
    
    function showDescription(){
        $('#ss_info_description').modal('show');
    }

    function showQuestionVideo(){
        $('#ss_question_video').modal('show');
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
            var user_answer = CKEDITOR.instances.answer.getData();
            var id = $('#question_id').val();
            
            $.ajax({
                type: 'POST',
                url: 'IDontLikeIt/answer_matching',
                data: {
                    user_answer: user_answer,
                    id: id
                },
                dataType: 'html',
                success: function (results) {
                    if (results == 0) {
                        $('#times_up_message').modal('show');
                        $('#question_reload').click(function () {
                            location.reload(); 
                        });
                    } else if (results == 1) {
                        $('#ss_info_sucesss').modal('show');
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


<?php $this->load->view('module/preview/drawingBoard'); ?>
