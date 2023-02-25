<?php $key = $question_info_s[0]['question_order'];?>	
<?php if(array_key_exists ($key ,$total_question )){ ?>
<input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] +1;?>" name="next_question" />
<?php }else{ ?>
<input type="hidden" id="next_question" value="0" name="next_question" />
<?php }?>
<input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id']?>" name="module_id">
<input type="hidden" id="current_order" value="<?php echo $key;?>" name="current_order">	
<input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType'];?>" name='module_type'>
<?php 

	//$link = null;
	$desired=$this->session->userdata('data');
	$link_next = null;
	if(is_array($desired))
	{
		$link_key = $key-1;
		if(array_key_exists ( $link_key , $desired ))
		{
			$link = $desired[$link_key]['link'];
		}
		$link_key_next = $key;
		if(array_key_exists ( $link_key_next , $desired ))
		{
			$question_id = $question_info_s[0]['question_order']+1;
			$link1 = base_url();
			$link_next= $link1.'get_tutor_tutorial_module/'.$question_info_s[0]['module_id'].'/'.$question_id;
		}
	}
	
?>

 	<div class="ss_student_board">
		<div class="ss_s_b_top">
			<div class="col-sm-6 ss_index_menu">
				<a href="#">Module Setting</a>
			</div>
			 <div class="col-sm-6 ss_next_pre_top_menu">
				<?php if($question_info_s[0]['moduleType'] == 1){ ?>
					<?php if($question_info_s[0]['question_order'] == 1){?>
						<a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>					
					<?php }else{ ?>
						<a class="btn btn_next" href="<?php echo $link;?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>					
					<?php }?>
				<?php }else{ ?>
					<a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>					
				<?php }?>
				<!---
				<?php if($question_info_s[0]['question_order'] == 1){?>
					<a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>					
				<?php }else{ ?>
					<a class="btn btn_next" href="<?php echo $link;?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>					
				<?php }?>	
				--->
				<?php if($link_next != null){ ?>
					<a class="btn btn_next" href="<?php echo $link_next;?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>									
				<?php }else{ ?>
					<a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>					
				<?php }?>
																			
				<a class="btn btn_next" href="#">Draw <img src="assets/images/icon_draw.png"></a>
			</div>
		</div>
		<div class="container-fluid">
		<div class="row">
			
				<div class="col-sm-4">
				
				</div>
				<div class="col-sm-4">
				
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
			<div class="row">
				<div class="ss_s_b_main" style="min-height: 100vh">
					<div class="col-sm-4">
					 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						  <div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
							  <h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> <span><img src="assets/images/icon_draw.png"> Instruction</span> Question</a>
							  </h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							  <div class="panel-body">
									 <h4 class="q_headin">Match the following</h4>
							  </div>
							</div>
						  </div>
						 
						  
						</div>
						 
					</div>
					<?php
						$lettry_array = array('A','B','C','D','E','F','G','H','I','J','k','L','M','N','O','P','Q','R','S','T');
					?>
					<div class="col-sm-4">
						  <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
						  <div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
							  <h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">  Maching</a>
							  </h4>
							</div>
							<div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							  <div class="panel-body">
								 <div class="image_box_list ss_m_qu">
									<?php $i=1;foreach ($question_info_left_right->left_side as $row){?>
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
										<div class="col-xs-1">
											<p class="ss_lette" id="color_left_side_<?php echo $i;?>">
												<input type="radio" id='left_side_<?php echo $i;?>' name="left_side_<?php echo $i;?>" value="<?php echo $i;?>" data-id="1" class="left" onclick="getLeftVal(this);">
											</p>
										</div>
									</div>
									<?php $i++;} ?> 
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
					</div>
			 
					<div class="col-sm-4">
						<div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
						  <div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
							  <h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne"> &nbsp </a>
							  </h4>
							</div>
							<div id="collapseOne2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							  <div class="panel-body">
								<div class="image_box_list ss_m_qu">
									<form id="answer_form">
									<?php $i=1;foreach ($question_info_left_right->right_side as $row){?>
									<div class="row">
									
									
										<div class="col-xs-1">
											<p class="ss_lette" id="color_right_side_<?php echo $i;?>">
												<input type="radio" name="right_side_<?php echo $i;?>"  value="<?php echo $i;?>" class="right" onclick="getRightVal(this);">
											</p>
										</div>
										<div class="col-xs-6">
											<div class="box ">
												<div class="ss_w_box text-center">
													<p><?php echo $row[0];echo '<br><br>';?></p>
												</div>							       	 				 
											</div>
										</div>
									
											<div class="col-xs-3">
												<p class="ss_lette">
													<input type="number" class="form-control" name="answer_<?php echo $i;?>" id="answer_<?php echo $i;?>" data="1" onclick="getAnswer();">
												</p>
											</div>
											<div class="col-xs-1">
												<span class="" id="message_<?php echo $i-1;?>"></span>
											</div>
											<input type="hidden" name="id" value="<?php echo $question_info_s[0]['question_id'];?>">
											<input type="hidden" name="total_ans" value="<?php echo sizeof($question_info_left_right->right_side);?>">
									</div>
									<?php $i++;} ?>
									<?php if(array_key_exists ($key ,$total_question )){ ?>
										<input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] +1;?>" name="next_question" />
									<?php }else{ ?>
										<input type="hidden" id="next_question" value="0" name="next_question" />
									<?php }?>
										<input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id']?>" name="module_id">	
										<input type="hidden" id="current_order" value="<?php echo $key;?>" name="current_order">	
										<input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType'];?>" name='module_type'>
									 </form> 
								   
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
</section>

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
        <button type="button" id='get_next_question' class="btn btn_blue" data-dismiss="modal">Ok</button>
         
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
        <img src="assets/images/icon_sucess.png" class="pull-left"> <span class="ss_extar_top20">Your answer is wrong</span> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
         
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
	$('.right').attr('disabled', true);
	var left_arr = new Array();
	var right_arr = new Array();
	var color_array = new Array('red','green','blue','#00BFFF','#FF6347','#708090','#2F4F4F','#C71585','#8B0000','#808000','#FF6347','#FF4500','#FFD700','#FFA500','#228B22','#808000','#00FFFF','#66CDAA','#7B68EE','#FF69B4');
	function getLeftVal(e)
	{	
		var left_ans_val = e.value;
		
		left_arr.push(left_ans_val);
		
		$('.right').attr('disabled', false);
		$('.left').attr('disabled', true);
		//var last = left_arr.slice(-1)[0];
		var color_left = color_array[left_ans_val-1];
		//document.getElementById("color_left_side_1").style.backgroundColor = color_left;
		document.getElementById("color_left_side_"+left_ans_val).setAttribute( 'style', 'background-color:'+color_left+' !important' );
		//console.log(last);
	}
	
	function getRightVal(e)
	{
		var last = left_arr.slice(-1)[0];
		var right_ans_val = e.value;
		
		document.getElementById("answer_"+right_ans_val).value = last;
		
		$('.right').attr('disabled', true);
		$('.left').attr('disabled', false);
		var color_right = color_array[last-1];
		document.getElementById("color_right_side_"+right_ans_val).setAttribute( 'style', 'background-color:'+color_right+' !important' );
		//console.log(right_arr);
	}

   function getAnswer()
   {
	   //alert(this.attr('data'));
   }
</script>
<script>
    $('#answer_matching').click(function () {
        var form = $("#answer_form");
        $.ajax({
            type: 'POST',
            url: 'st_answer_multiple_matching',
            data: form.serialize(),
            dataType: 'json',
            success: function (results) {
				if(results == 6)
				{
					alert('answer saved successfully');
					
				}
				if(results != 5)
				{
					var obj = (results);
				
					var ii = 0;
					for(var i = 0; i < obj.student_ans.length; i++)
					{
						if(obj.student_ans[i] == obj.tutor_ans[i])
						{
							$("#message_"+i).removeClass("fa fa-close");
							$( "#message_"+i).addClass("fa fa-check");
						}else
						{
							
							$( "#message_"+i).removeClass("fa fa-check");
							$( "#message_"+i).addClass("fa fa-close");
							ii++;
						}
					}
					
					if(ii == 0){
						
						$('#ss_info_sucesss').modal('show');
						$('#get_next_question').click(function(){	
							commonCall();
						});
					}else {
						
						$('#ss_info_worng').modal('show');
					}
				}				
				else
				{
					commonCall();
				}
				function commonCall()
				{
					$question_order = $('#next_question').val();
					$module_id = $('#module_id').val();					
					if($question_order != 0){
						window.location.href = 'get_tutor_tutorial_module/'+$module_id+'/'+$question_order;
					}else{
						alert('That was last question');
					}
				}
            }
        });

    });
function showModalDes(e)
{
	$('#show_description_'+e).modal('show');
}	
</script>