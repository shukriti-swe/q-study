<?php //echo 1111;die;?>
<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="col-sm-6 ss_index_menu">
            <a href="#">Module Setting</a>
        </div>
        <div class="col-sm-6 ss_next_pre_top_menu">
			<?php if($question_info_s[0]['question_order']==1) { ?>														
				<a class="btn btn_next" href="<?php echo base_url();?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/1"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
			<?php }else{ ?>
				<a class="btn btn_next" href="<?php echo base_url();?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/<?php echo ($question_info_s[0]['question_order'] -1); ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
			<?php  } ?> 
			<?php $key = $question_info_s[0]['question_order'];?>	
			<?php if(array_key_exists ($key ,$total_question )){ ?>
				<a class="btn btn_next" href="<?php echo base_url();?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/<?php echo $question_info_s[0]['question_order'] +1; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
			<?php }?>											 		 							
			<a class="btn btn_next" href="#">Draw <img src="assets/images/icon_draw.png"></a>
		</div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="ss_s_b_main" style="min-height: 100vh">
             
						  <div class="col-sm-4">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingOne">
										<h4 class="panel-title">
											<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_solution.png"> Solution</span> Question</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
										<textarea class="mytextarea" name="questionName"><?php echo strip_tags($question_info_vcabulary->questionName);?></textarea>
									</div>
								</div>
							</div>
						  </div>
						  <?php
							$lettry_array=array('A','B','C','D','E','F','G','H','I','J','k','L','M','N','O','P','Q','R','S','T');
						  ?>
				<form id="answer_form">
						<div class="col-sm-4">				
					 		 <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
							  <div class="panel panel-default">							     
							    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							      <div class="panel-body ss_imag_add_right">
							       <div class="image_box_list ss_m_qu">
							       	 	<?php $i=1;foreach ($question_info_vcabulary->vocubulary_image as $row){?>
										<div class="row">
							       	 		<div class="col-xs-2">
							       	 			<p class="ss_lette"><?php echo $lettry_array[$i-1];?></p>
							       	 		</div>
							       	 		<div class="col-xs-8">
							       	 			<div class="box ">
							       	 				<div class="ss_w_box text-center">
							       	 					<?php echo $row[0];?>
							       	 				</div>							       	 				 
							       	 			</div>
							       	 		</div>
							       	 		<div class="col-xs-2">
							       	 			<p class="">
							       	 				<input type="radio" name="answer_reply" value="<?php echo $i;?>">
							       	 			</p>
							       	 		</div>
							       	 	</div>
										<?php $i++;} ?>
							       </div>
								   <div class="col-sm-4">	</div>
								    <div class="col-sm-4">	 
										<button type="button" class="btn btn_next" id="answer_matching">submit</button>
									</div>								    
									  <div class="col-sm-4">	</div>
							      </div>
								 
							    </div>
								
							  </div>
							 
							 
							</div>
							
					 	</div>
						<input type="hidden" value="<?php echo $question_info_s[0]['question_id'];?>" name="id" id="question_id">
				</form>
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
										  		<?php $i=1;foreach($total_question as $ind){ ?>
													<tr>
														<td> </td>
														<td><?php echo $ind['question_order'];?></td>
														<td><?php echo $ind['questionMarks'];?></td>
														<td><?php echo $ind['questionMarks'];?></td>
														<td><a  class="text-center" onclick="showModalDes(<?php echo  $i;?>);"><img src="assets/images/icon_details.png"></a></td>
													</tr>
												<?php $i++;}?>
										  		
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
                <img src="assets/images/icon_sucess.png" class="pull-left"> <span class="ss_extar_top20">Your answer is correct</span> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

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
                <br><?php // echo strip_tags($question_info[0]['questionName']); ?> = <?php  echo strtolower($question_info_s[0]['answer']); ?> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
            </div>
        </div>
    </div>
</div>
<?php $i=1;foreach($total_question as $ind){ ?>
<div class="modal fade ss_modal ew_ss_modal" id="show_description_<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title" id="myModalLabel"> Question Description </h4>
			</div>
			<div class="modal-body">
				<textarea class="form-control" name="questionDescription"><?php echo $ind['questionDescription'];?></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php $i++;}?>
<script>
$('#answer_matching').click(function () {
	var form = $("#answer_form");
	$.ajax({
		type: 'POST',
		url: 'answer_matching_multiple_response',
		data: form.serialize(),
		dataType: 'html',
		success: function (results) {
			if(results==1){
	
				$('#ss_info_sucesss').modal('show');				
			}else {
			
				$('#ss_info_worng').modal('show');
			}
		}
	});
});
function showModalDes(e)
{
	$('#show_description_'+e).modal('show');
}	
</script>