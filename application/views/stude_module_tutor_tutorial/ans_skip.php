<?php $key = $question_info_s[0]['question_order'];?>	
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
<br>
 	<div class="ss_student_board">
 			 <div class="ss_s_b_top">
				<div class="col-sm-6 ss_index_menu">
					<a href="#">Index</a>
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
					
				<!--	<?php if($question_info_s[0]['question_order'] == 1){?>
						<a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>					
					<?php }else{ ?>
						<a class="btn btn_next" href="<?php echo $link;?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>					
					<?php }?>-------->

					
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
                                    <div class="math_plus">
                                        <?php echo $questionBody; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4">
                    <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">Skip Counting</a>
                                </h4>
                            </div>
                            <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="image_box_list_result result">
                                        <form id="answer_form">
                                            
                                            <div class="row">
                                                <table class="dynamic_table_skpi table table-bordered">
                                                    <tbody class="dynamic_table_skpi_tbody">
                                                        <?php echo $skp_box; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php if(array_key_exists ($key ,$total_question )){ ?>
												<input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] +1;?>" name="next_question" />
												<?php }else{ ?>
												<input type="hidden" id="next_question" value="0" name="next_question" />
												<?php }?>
												<input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id']?>" name="module_id">
												<input type="hidden" id="current_order" value="<?php echo $key;?>" name="current_order">	
												<input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType'];?>" name='module_type'>

                                            <input type="hidden" value="<?php echo $question_info_s[0]['question_id'];?>" name="question_id" id="question_id">
                                            
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    
                    <div class="text-center">
                        <a class="btn btn_next" id="answer_matching">Submit</a>
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


<!--Description Modal-->
<div class="modal fade ss_modal" id="ss_info_description" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
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
                <button id='get_next_question' type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>

<!--Solution Modal-->
<div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
                <i class="fa fa-close" style="font-size:20px;color:red"></i> 
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




<!--<input type="hidden" name="questionType" value="6">

<div>

    <div class="row">
        <div class="ss_question_add">
            <div class="ss_s_b_main" style="min-height: 100vh">
                <div class="col-sm-4">
                    <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?php echo $questionBody; ?>
                            </div>
                            <div class="panel-body">
                                <?php if ($this->session->userdata('wrong_ans')) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        Wrong Answer Given
                                        <button class='btn btn-default btn-sm' data-toggle="modal" data-target="#rightAns" id="rightAnsBtn">Answer</button>
                                    </div>
                                <?php elseif ($this->session->userdata('right_ans')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        Congres right answer given
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="col-sm-3 myNewDivHeight" >
                    <div class="skip_box">
                        <form action="Tutor/checkSkpboxAnswer" method="post" name="ansForm">
                            <input type="hidden" id="questionId" name="questionId" value="<?php echo $questionId; ?>">
                            <div class="table-responsive">
                                <table class="dynamic_table_skpi table table-bordered">
                                    <tbody class="dynamic_table_skpi_tbody">
                                        <?php echo $skp_box; ?>
                                    </tbody>
                                </table>
                                 may be its a draggable modal 
                                <div id="skiping_question_answer" style="display:none">
                                    <input type="text" name="set_skip_value" class="input-box form-control rs_set_skipValue">
                                </div>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-primary btn-sm" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>-->



<!-- right and modal -->
<div class="modal fade" id="rightAns" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Correct Answer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <table class="dynamic_table_skpi table table-bordered">
                    <tbody class="dynamic_table_skpi_tbody" id="rightAnsTblBody">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>

    $(function() {
        $( "#draggable" ).draggable();
    });

    /*pick given input, make obj , set on hidden field*/
    $('.ans_input').on('input', function(){
        var ansElem = $(this);
        var val = $(this).val();
        var type = 'a';
        var colOfRow = $(this).attr('data_num_colofrow');
        var obj = {cr:colOfRow, val:val, type:type}
        var jsonString = JSON.stringify(obj);
        $(this).siblings('#given_ans').val(jsonString);
    });

    /*append the right ans to the modal body*/
    $('#rightAnsBtn').on('click', function(){
        var questionId = $('#questionId').val();
        $.ajax({
            url:'Tutor/getRightAns',
            method: 'POST',
            data:{qId:questionId},
            success: function(data){
                console.log(data);
                $('#rightAnsTblBody').html(data);
            }
        })
    });
    
    function fn_check(aval){
        $("#answer").val(aval);
    }
</script>


<script>
    
    $('#answer_matching').click(function () {
        var form = $("#answer_form");
        $.ajax({
            type: 'POST',
            url: 'Student/st_answer_skip',
            data: form.serialize(),
            dataType: 'html',
            success: function (results) {
//                console.log(results);
                // if(results == 1) {
                    // alert('write your answer');
                // } else if(results == 2) {
                    // $('#ss_info_sucesss').modal('show');
                // } else if(results == 3) {
                    // $('#ss_info_worng').modal('show');		
                // }
				if(results == 6)
				{
					alert('answer saved successfully');					
				}
				if(results == 3){
					$('#ss_info_worng').modal('show');				
				}else if(results == 2){
					$('#ss_info_sucesss').modal('show');
					$('#get_next_question').click(function(){	
						commonCall();
					});
				}
				if(results == 5)
				{
					commonCall();
				}
				function commonCall()
				{
					alert(results);
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
	
    function getLetter(letter)
    {
        var val = document.getElementById('exampleInputl1').value;
        var total = val + letter;
        $('#exampleInputl1').val(total);
    }
    function delLetter(){
        var val = document.getElementById('exampleInputl1').value;
        var sillyString = val.slice(0, -1);
        $('#exampleInputl1').val(sillyString);
    }
        
    function showAudio(){
        $("audio").show();
    }
    
    function showDescription(){
        $('#ss_info_description').modal('show');
    }
    function showModalDes(e)
{
	$('#show_description_'+e).modal('show');
}
</script>
