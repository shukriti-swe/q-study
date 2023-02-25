<script src="<?php echo base_url(); ?>assets/ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>
<style type="text/css">
  
  .qstudy_module_video{
    position: absolute;
    width: 300px;
    height: 230px;
    top: 35px;
    border: 1px solid #ccc;
    background: #fff;
    z-index: 5;
    display: none;
  }
  .qstudy_module_video .header{
    width: 100%;
    border-bottom: 1px solid #ccc;
    text-align: right
  }
  .qstudy_module_video .header span{
    padding: 3px 10px;
    background: #e3e1e1;
    font-weight: bold;
    cursor: pointer;
  }
  .qstudy_module_video .video-content{
    padding: 10px;
    width: 100%;
    height: 89%;
    overflow-y: scroll;
  }
  .qstudy_module_video .video-content p{

    border: 1px solid #a2a0a0;
    padding-left: 5px;
    background: #f6f6f6;
    margin-bottom: 5px;
    cursor: pointer;
  }
  .no_instruction{
    position: absolute;
    top: 40px;
    background: #c1fcc1;
    padding: 5px;
    border-radius: 5px;
    display: none;
  }
  
  .word-brack{
      word-break: break-all;
  }
  .word-brack p{
      font-size:13px;
      text-decoration: underline;
  }
</style>
<?php 

foreach ($total_question as $ind) {

if ($ind["question_type"] == 14) {
  $chk = $ind["question_order"];
 }

} 
  ?>
<?php 
    $key = $question_info_s[0]['question_order'];
//    echo '<pre>';print_r(($total_question));
//    echo '<pre>';print_r($question_info_s[0]);die;
    date_default_timezone_set('Asia/Dhaka');
    $module_time = time();
    
    if($tutorial_ans_info){
        $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'],TRUE);
        $desired = $temp_table_ans_info;
    }else{
        $desired = $this->session->userdata('data');
    }
    
//    For Question Time
    $question_time = explode(':',$question_info_s[0]['questionTime']);
    $hour = 0;
    $minute = 0;
    $second = 0;
    if(is_numeric($question_time[0])) {
        $hour = $question_time[0];
    } if(is_numeric($question_time[1])) {
        $minute = $question_time[1];
    } if(is_numeric($question_time[2])) {
        $second = $question_time[2];
    }

    $question_time_in_second = ($hour * 3600) + ($minute * 60) + $second ;

//    End For Question Time

    $link_next = "javascript:void(0);";
    $link = "javascript:void(0);";

    $link_next = null;
    if (is_array($desired)) {
        $link_key = $key - 1;
        if (array_key_exists($link_key, $desired)) {
            $link = $desired[$link_key]['link'];
        }
        $link_key_next = $key;
        if (array_key_exists($link_key_next, $desired)) {
            $question_id = $question_info_s[0]['question_order'] + 1;
            $link1 = base_url();
            $link_next = $link1 . 'get_tutor_tutorial_module/' . $question_info_s[0]['module_id'] . '/' . $question_id;
        }
    }

    $module_type = $question_info_s[0]['moduleType'];
    $videoName = strlen($module_info[0]['video_name'])>1 ? $module_info[0]['video_name'] : 'Subject Video';
?>
<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="ss_index_menu <?php if ($module_type == 3) { ?>col-sm-5<?php }?>">
            <?php if ($module_type == 1) { ?>
            <p class="row">
                  <a style="
    margin: 17px;
" href="all_module_by_type/<?php echo $total_question[0]['user_type'];?>/<?php echo $total_question[0]['moduleType'];?>">Index</a>
              <?php }else {?>
				<?php  if ($module_info[0]['video_name']) { ?>
                  <button class="btn btn_next" id="openVideo" style="margin-left: 25px;"><i class="fa fa-play" style="color:#35B6E7;margin-right: 5px;"></i><?php echo $videoName;  ?></button>
                <?php } ?>
              <?php }?>
              
              </p>
        </div>
        <?php if ($module_type == 3 || (($module_type == 2 || $module_type == 1) && $question_time_in_second != 0)) { ?>
            <div class="col-sm-3" style="text-align: right">
                <div class="ss_timer" id="demo"><h1>00:00:00 </h1></div>
            </div>
        <?php }?>
        <?php
        $col_class = 'col-sm-7';
        if (($module_type == 2 && $question_info_s[0]['optionalTime'] != 0) || $module_type == 3){
            $col_class = 'col-sm-4';
        }
        ?>
        <div class="<?php echo $col_class?> ss_next_pre_top_menu" style="text-align:center;">
			<?php if ($question_info_s[0]['isCalculator']) : ?>
                <input type="hidden" name="" id="scientificCalc">
            <?php endif; ?>
            <?php if ($_SESSION['userType']==3||$_SESSION['userType']==7) :
                ?> <!-- only tutor&qstudy will be able to back next -->
                <?php if ($question_info_s[0]['moduleType'] == 1) { ?>
                <a class="btn btn_next" href="<?php echo $link; ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
                <a class="btn btn_next" href="<?php echo $link_next; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
            <?php } else {?>
                <a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
                <a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
            <?php }?>
            <?php endif; ?>
            <a class="btn btn_next" id="draw" onClick="test()" data-toggle="modal" data-target=".bs-example-modal-lg" style="margin: 0 20px;">
                 Workout <img src="assets/images/icon_draw.png">
            </a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
		<div>
              <div style="position: absolute;left:-1000px;min-height: 250px;min-width: 600px;text-align: center;" id="quesBody">
                    <?php echo isset($questionBody)?$questionBody:''; ?>

              </div>
              
            </div>
            <form id="answer_form">
                
                <input type="hidden" value="<?php echo $question_info_s[0]['question_id']; ?>" name="question_id" id="question_id">

                 <?php if ((count($total_question)-1) > count($this->session->userdata('data')) && !$tutorial_ans_info) {?>
                    <input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] + 1; ?>" name="next_question" />
                <?php } else { ?>
                    <input type="hidden" id="next_question" value="0" name="next_question" />
                <?php } ?>
                <input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id'] ?>" name="module_id">
                <input type="hidden" id="current_order" value="<?php echo $key; ?>" name="current_order">	
                <input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType']; ?>" name='module_type'>

                <input type='hidden' id="student_question_time" value="" name='student_question_time'>

                
                <div class="ss_s_b_main" style="min-height: 100vh">
                    <div class="col-sm-4">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
									<?php if($module_info[0]['user_type'] == 7) {?>
									<a style="cursor: pointer;">
										  <span style="color: #2198c5;" class=" qstudy_Instruction_click">
											  <img src="assets/images/icon_draw.png" ><b> Instruction</b>
										  </span> 
										  Question
									  </a>
									<?php }else{?>
                                        <a role="button" <?php if ($module_info[0]['moduleName']) {
                                            ?>onclick="abc()"<?php
                                          } else {
                                            ?> data-toggle="collapse" data-parent="#accordion" href="#collapseOne"<?php
                                          }?> aria-expanded="true" aria-controls="collapseOne">
                                          <span style="color:#2198c5;" class="Instruction_click">
                                              <img src="assets/images/icon_draw.png" ><b> Instruction</b>
                                          </span> Question
                                        </a>
										<?php }?>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body word-brack">
                                        <?php echo isset($questionBody)?$questionBody:''; ?>
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
                                        <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">   Answer</a>
                                    </h4>
                                </div>
                                <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <textarea name="answer" class="student_assignment_textarea"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">   
                            <button type="button" class="btn btn_next" id="answer_matching">submit</button>
                        </div>                                  
                        <div class="col-sm-4"></div>
                    </div>

                    <div class="col-sm-4">

                        <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsefour" aria-expanded="true" aria-controls="collapseOne">  
                                            <span>Module Name: <?php echo $question_info_s[0]['moduleName'];?></span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsefour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">

                                        <div class=" ss_module_result">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>    
                                                        <tr>

                                                            <th>SL</th>
                                                            <th>Mark</th>
                                                             <th>Obtain</th> 
                                                            <th>Description</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id="assListTbl">
                                                        <?php echo $assignment_list; ?>
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

<!-- Modal -->
<div class="modal fade ss_modal" id="ss_sucess_mess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
                <img src="assets/images/icon_info.png" class="pull-left"> <span class="ss_extar_top20">Save Sucessfully</span> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade ss_modal ew_ss_modal show_description" id="show_description" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
            </div>
            <div class="modal-body ">
                <div class="panel panel-default">
                    <div class="panel-body questionDescription">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- question details modal -->
<div class="modal fade" id="quesDtlsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Question Details</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-body qDtlsModBody">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- assignment file submit success modal -->

<!-- Modal -->
<div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
                <img src="assets/images/icon_details.png" class="pull-left"> 
                <span class="ss_extar_top20" style="display: contents;">Examiner will scrutinise your work and go back to you.</span> 
            </div>
            <div class="modal-footer">
                <button type="button" id="get_next_question" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.qDtlsOpenModIcon').on('click', function(){
        var hiddenTaskDesc = $(this).closest('tr').children('#hiddenTaskDesc').val();
        $('#show_description').modal('show');
        $('.questionDescription').html(hiddenTaskDesc);
    });
</script>


<script>
    var time_count = 0;
    
    $('#answer_matching').click(function () {

        var form = $("#answer_form");
        $.ajax({
            type: 'POST',
            url: 'st_answer_assignment',
            data: form.serialize(),
            dataType: 'html',
            success: function (results) {
                if (results == 2) {
                    $('#ss_info_sucesss').modal('show');
                    $('#get_next_question').click(function () {
                        commonCall();
                    });
                }
            }
        });

    });
    
    function commonCall() {
        $question_order = $('#next_question').val();
        $module_id = $('#module_id').val();

        if ($question_order == 0) {
            window.location.href = 'show_tutorial_result/' + $module_id ;
        }
        if ($question_order != 0) {
            window.location.href = 'get_tutor_tutorial_module/' + $module_id + '/' + $question_order;
        }
    }
    
    get_student_taken_time();
	
    function get_student_taken_time() {
        setInterval(circulate,1000);

        function circulate() {
            time_count++;
            $("#student_question_time").val(time_count);
        }
    }
</script>

<?php $this->load->view('students/question_module_type_tutorial/module_video'); ?>
<?php $this->load->view('students/question_module_type_tutorial/instruction_video'); ?>
<?php $this->load->view('students/question_module_type_tutorial/drawingBoard'); ?>
