<script src="<?php echo base_url(); ?>assets/ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>

<?php

	$key = $question_info_s[0]['question_order'];
	$ques_type = $question_info_s[0]['question_type'];

	$temp_table_ans_info = isset($tutorial_ans_info[0]['st_ans']) ? json_decode($tutorial_ans_info[0]['st_ans'], true):[];
	$desired = $temp_table_ans_info;
	
	if (isset($tutorial_ans_info[0]['tbl_studentprogress_id'])) {
		$st_prog_id = $tutorial_ans_info[0]['tbl_studentprogress_id'];
	}
	//echo '<pre>';print_r($tutorial_ans_info);die;
	if (!empty($desired[$key]['workout']))
{
    $string = strip_tags($desired[$key]['workout'],'<img>');
    preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $string, $matches);
    if (is_array($matches) && count($matches))
    {
        $workout_image_link =  $matches[1];
    }
}
	
	$link_next = "javascript:void(0);";
	$link = "javascript:void(0);";

	$lastElement = end($desired);

	//Print it out!
	//print_r($lastElement);
	if (is_array($desired)) {
		$link1 = base_url();
		$link_key = $key - 1;
		if (array_key_exists($link_key, $desired)) {
			$link = $link1 . 'check_student_copy/' . $question_info_s[0]['module_id'] . '/' . $user_info[0]['id']. '/' . $link_key.'/' . $tutorial_ans_info[0]['tbl_studentprogress_id'];
		}
		$link_key_next = $key;
		if (array_key_exists($link_key_next, $desired) && $lastElement['question_order_id'] != $key) {
			$question_order = $question_info_s[0]['question_order'] + 1;
			
			$link_next = $link1 . 'check_student_copy/' . $question_info_s[0]['module_id'] . '/' . $user_info[0]['id']. '/' . $question_order.'/' . $tutorial_ans_info[0]['tbl_studentprogress_id'];
		}
	}

	$module_type = $question_info_s[0]['moduleType'];
	$coursesId = $module_info[0]['course_id'];
?>

<div class="ss_student_board">
	<div class="ss_s_b_top">
		<div class="ss_index_menu <?php if ($module_type == 3) { ?>col-md-2<?php }?>">
			<?php if ($module_type == 1) { ?>
			    <a style="font-size: 17px;" href="<?php echo base_url('student_progress_course/' . $coursesId) ?>">Index</a>
			<?php } else {?>
				<a >Index</a>
			<?php }?>
		</div>
    
<!--        <div class="col-sm-4" style="text-align: right">
            <div class="ss_timer" id="demo"><h1>00:00:00 </h1></div>
          </div>-->
          
        <div class="col-sm-7 ss_next_pre_top_menu">

            <a class="btn btn_next" href="<?php echo $link; ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
            <a class="btn btn_next" href="<?php echo $link_next; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>                                  
            
			<?php if($ques_type != 12  && $ques_type != 15){ ?>
            <a class="btn btn_next" id="draw" onClick="show_workout()">
             Workout <img src="assets/images/icon_draw.png">
            </a>
            <?php }?>
		    <?php if ($ques_type == 12) {?>
            <a class="btn btn_next" id="draw" onClick="student_progress_workout_quiz_drawing('','<?php echo @$workout_image_link?>')" data-toggle="modal" data-target=".bs-example-modal-lg" >
                Workout <img src="assets/images/icon_draw.png">
            </a>
            <?php }?>
			<?php if ($ques_type == 15) {?>
            <a class="btn btn_next" id="draw" onClick="student_progress_workout_quiz_drawing('','<?php echo @$workout_image_link?>')" data-toggle="modal" data-target=".bs-example-modal-lg" >
                Workout <img src="assets/images/icon_draw.png">
            </a>
            <?php }?>
        </div>
    </div>
       
       
       
    <div class="container-fluid">
        <div class="row">
			<div class="ss_s_b_main" style="min-height: 100vh">

				<?php echo $question_box;?>
            
				<div class="col-sm-4">
					<div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  
									<span>Module Name: <?php echo $module_info[0]['moduleName'] ?></span></a>
								</h4>
							</div>
							<div id="collapsethree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<div class=" ss_module_result">
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>    
													<tr>
														<th></th>
														<th>SL</th>
														<th>Mark</th>
														<th>Obtained</th>
														<th>Description</th>                                                    
													</tr>
												</thead>
												<tbody>
												<?php $i = 1;
												$total = 0;
												$totalObtained = 0;
												foreach ($total_question as $ind) { ?>
													<tr>
														<td>
															<?php if(isset($desired[$ind['question_order']]['ans_is_right']) && $ind['question_order'] == $desired[$ind['question_order']]['question_order_id'] && ($ind['question_type'] != 12 && $ind['question_type'] != 11)){

															if($desired[$ind['question_order']]['ans_is_right'] == 'correct'){?>
																<a href="check_student_copy/<?=$question_info_s[0]['module_id']?>/<?=$user_info[0]['id']?>/<?=$ind['question_order']?><?php if (isset($st_prog_id)) echo '/'.$st_prog_id; ?>">
																  <span class="glyphicon glyphicon-ok" style="color: green;"></span>
																</a>
															<?php } else if($desired[$ind['question_order']]['ans_is_right'] == 'wrong') {?>
																<a href="check_student_copy/<?=$question_info_s[0]['module_id']?>/<?=$user_info[0]['id']?>/<?=$ind['question_order']?><?php if (isset($st_prog_id)) echo '/'.$st_prog_id; ?>">
																  <span class="glyphicon glyphicon-remove" style="color: red;"></span>
																</a>
															<?php }} if(isset($desired[$ind['question_order']]['ans_is_right']) && ($ind['question_type'] == 12 || $ind['question_type'] == 11)) {?>
																<a href="check_student_copy/<?=$question_info_s[0]['module_id']?>/<?=$user_info[0]['id']?>/<?=$ind['question_order']?><?php if (isset($st_prog_id)) echo '/'.$st_prog_id; ?>">
																  <span class="glyphicon glyphicon-pencil" style="color: #fb9c08;"></span>
																</a>
															<?php }
															if($ind['question_type'] == 17){ ?>
																<a href="check_student_copy/<?=$question_info_s[0]['module_id']?>/<?=$user_info[0]['id']?>/<?=$ind['question_order']?><?php if (isset($st_prog_id)) echo '/'.$st_prog_id; ?>">
																  <span class="glyphicon glyphicon-pencil" style="color: #fb9c08;"></span>
																</a>
															<?php }
															?>
														</td>
														<td style="<?php if ($question_info_s[0]['question_order'] == $ind['question_order']) {
														  echo 'background-color: #99D9EA;';
														}?>">
															<?php echo $ind['question_order']; ?>
														</td>
														<td>
															<?php
															echo $ind['questionMarks'];
															$total = $total + $ind['questionMarks'];
															
															?>
														</td>
														<td>
															<?php 
																if(isset($desired[$ind['question_order']]['student_question_marks'])){
																	echo $desired[$ind['question_order']]['student_question_marks'];
																	$totalObtained += $desired[$ind['question_order']]['student_question_marks'];
																} 
															?>
														</td> <!-- obtained -->
														<td>
															<a  class="text-center" onclick="showModalDes(<?php echo $i; ?>);">
																<img src="assets/images/icon_details.png">
															</a>
														</td>
													</tr>
												<?php $i++; } ?>
													<tr style="background-color: #99D9EA;">
														<td colspan="2">Total</td>
														<td colspan="1"><?php echo $total?></td>
														<td colspan="1"><?php echo $totalObtained;?></td>
														<td colspan="1"></td>
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
				
				<?php if($question_info_s[0]['question_type'] == 9) {?>
                <div class="col-md-6">
                </div>
                
                <?php }?>

                <?php 

                 $pattern = '/<p><img src=/i';

                 $img = '';

                 if (isset($desired[$key]['workout'])) {
                 	
                 $img =  preg_replace($pattern, '', $desired[$key]['workout'] );
                 $img = str_replace("/></p>","", $img );

                 }

                 ?>

				<div class="col-sm-4" id="workout" style="display: none;">
					<div class="drawPicture" id="draggable"><a class="example-image-link" href="<?= $img; ?>" data-lightbox="example-1" style="margin: 6px;">
						<img src="assets/images/iconFullscreen.png" class="drawIMG"></a><div id="testScreen"> 

						<?php echo isset($desired[$key]['workout']) ? $desired[$key]['workout'] : ""; ?> 

					</div>

					</div>
				</div>


			</div>               
		</div>
	</div>
</div>


<div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
			</div>
			<div class="modal-body row">
				<img src="assets/images/icon_sucess.png" class="pull-left"> 
				<span class="ss_extar_top20">Your answer is correct	</span> 
			</div>
			<div class="modal-footer">
				<button id="get_next_question" type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>        
			</div>
        </div>
    </div>
</div>

    <div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
          </div>
          <div class="modal-body row">
            <i class="fa fa-close" style="font-size:20px;color:red"></i> <span class="ss_extar_top20">Your answer is wrong</span>
            <br><?php echo strip_tags($question_info_s[0]['answer']); ?>  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
          </div>
        </div>
      </div>
    </div>

    <?php $i = 1;
    foreach ($total_question as $ind) { ?>
      <div class="modal fade ss_modal ew_ss_modal" id="show_description_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">

              <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
            </div>
            <div class="modal-body">
              <textarea class="form-control" name="questionDescription"><?php echo $ind['questionDescription']; ?></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <?php $i++;
    } ?>


    <script>
      function show_workout(){
        $("#workout").show();
      }
    </script>

    <?php $this->load->view('tutors/check_student_copy/drawingBoard'); ?>
