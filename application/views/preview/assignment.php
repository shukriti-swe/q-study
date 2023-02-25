<input type="hidden" name="questionType" value="6">
<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="ss_index_menu">
            <a href="<?php echo base_url().$userType.'/view_course'; ?>">Question/Module</a>
        </div>
        <div class="col-sm-6 ss_next_pre_top_menu text-left">
            <a class="btn btn_next" href="question_edit/<?php echo $question_item?>/<?php echo $question_id?>">
                <i class="fa fa-caret-left" aria-hidden="true"></i> Back
            </a>

            <a class="btn btn_next" href="#">Index  </a>
            <a class="btn btn_next" href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
        </div>
<!--        <div class="col-sm-6 ss_index_menu"> 
            <img src="assets/images/icon_timer.png" class="pull-left"><div class="ss_timer"><h1>00:00:00 </h1></div>
            
        </div>-->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="ss_s_b_main" style="min-height: 100vh">
                <div class="col-sm-4">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span><img src="assets/images/icon_draw.png"> Instruction</span> Question
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body monmotu-class">
                                    <?php echo isset($questionBody)?$questionBody:''; ?>
                                </div>
                            </div>
                        </div>


                    </div>
                <style>
                .monmotu-class{
                    word-break: break-all;
                }.monmotu-class p a{
                    font-size: 13px;
                    margin-bottom:5px;
                    text-decoration: underline;
                }
                </style>
                </div>
<!--                <div class="col-sm-4">
                    <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?php echo isset($questionBody)?$questionBody:''; ?>
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
                </div>-->


                <div class="col-sm-4">
                    <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">   Answer</a>
                                </h4>
                            </div>
                            <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <textarea name="answer" class="assignment_textarea"></textarea>
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
                                    <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsefour" aria-expanded="true" aria-controls="collapseOne">  <span>Module Name: Will Dynamic Later</span></a>
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
                                                        <!-- <th>Obtain</th> -->
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
                </div> <!-- end col -->

                
                
            </div>
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
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.qDtlsOpenModIcon').on('click', function(){
        var hiddenTaskDesc = $(this).closest('tr').children('#hiddenTaskDesc').val();
        $('.qDtlsModBody').html(hiddenTaskDesc);
    });
    
    
    $('#answer_matching').click(function () {
        $('#ss_info_sucesss').modal('show');
    });
</script>
