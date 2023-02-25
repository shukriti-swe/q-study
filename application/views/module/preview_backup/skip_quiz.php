<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="col-sm-6 ss_index_menu">
            <a href="#">Module Setting</a>
        </div>
        <div class="col-sm-6 ss_next_pre_top_menu">
            <?php if ($question_info_s[0]['question_order'] == 1) { ?>                                                      
                <a class="btn btn_next" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/1"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
            <?php } else { ?>
                <a class="btn btn_next" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/<?php echo ($question_info_s[0]['question_order'] - 1); ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
            <?php } ?> 
            <?php $key = $question_info_s[0]['question_order']; ?>  
            <?php if (array_key_exists($key, $total_question)) { ?>
                <a class="btn btn_next" id="question_order_link" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/<?php echo $question_info_s[0]['question_order'] + 1; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
            <?php } ?>                                                                              
            <a class="btn btn_next" id="draw" onClick="test()" data-toggle="modal" data-target=".bs-example-modal-lg">Draw <img src="assets/images/icon_draw.png"></a>
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
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_draw.png"> Instruction</span> Question</a>
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
                                            
                                            <input type="hidden" name="questionId" value="<?php echo $question_info_s[0]['question_id']?>">
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
                                                    <?php $i = 1;$total = 0;
                                                    foreach ($total_question as $ind) { ?>
                                                        <tr>
                                                            <td> </td>
                                                            <td><?php echo $ind['question_order']; ?></td>
                                                            <td>
                                                                <?php 
                                                                    echo $ind['questionMarks']; 
                                                                    $total = $total + $ind['questionMarks'];
                                                                ?>
                                                            </td>
                                                            <td><?php echo $ind['questionMarks']; ?></td>
                                                            <td><a  class="text-center" onclick="showModalDes(<?php echo $i; ?>);"><img src="assets/images/icon_details.png"></a></td>
                                                        </tr>
                                                    <?php $i++; } ?>
                                                    <tr>
                                                        <td colspan="2">Total</td>
                                                        <td colspan="3"><?php echo $total?></td>
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
				<a id="next_qustion_link" href="">
					<button type="button" class="btn btn_blue" >Ok</button>
				</a>
			</div>
		</div>
	</div>
</div>

<!--Solution Modal-->
<div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="max-width: 382px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Solution</h4>
      </div>
      <div class="modal-body row">
        <i class="fa fa-close" style="font-size:20px;color:red"></i><br> 
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



  <!-- right ans modal -->
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
			url: 'Tutor/checkSkpboxAnswer',
			data: form.serialize(),
			dataType: 'html',
			success: function (results) {

				if(results == 1) {
					alert('write your answer');
				} else if(results == 2) {
					var question_order_link = $('#question_order_link').attr('href');
					$("#next_qustion_link").attr("href", question_order_link);
					$('#ss_info_sucesss').modal('show');
				} else if(results == 3) {
					$('#ss_info_worng').modal('show');      
				}
			}
		});
    });
    
    
  </script>
  
<?php $this->load->view('module/preview/drawingBoard'); ?>