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
        <?php if ($question_time_in_second != 0) { ?>
            <div class="col-sm-4" style="text-align: right">
                <div class="ss_timer" id="demo"><h1>00:00:00 </h1></div>
            </div>
        <?php }?>
        <div class="col-sm-6 ss_next_pre_top_menu">
            <?php if ($question_info[0]['isCalculator']) : ?>
                <input type="hidden" name="" id="scientificCalc">
            <?php endif; ?>           
            
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
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <span style="background: #959292;color: white; border: 5px solid #959292;"><img src="assets/images/icon_draw.png"> Instruction</span>
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
                                                        <th>Description</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td><?php echo $question_info[0]['questionMarks']; ?></td>
                                                        <!-- <td><?php // echo $question_info[0]['questionMarks']; ?></td> -->
                                                        <td><a onclick="showDescription()" class="text-center"><img src="assets/images/icon_details.png"></a></td>
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
