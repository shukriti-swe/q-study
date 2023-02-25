<input type="hidden" name="questionType" value="6">

<div>

    <div class="row">
        <div class="ss_question_add">
            <div class="ss_s_b_main" style="min-height: 100vh">
                <div class="col-sm-4">
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
                                <?php elseif ($this->session->userdata('success_msg')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $this->session->userdata('success_msg'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="col-sm-4" >
                    <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  <span>Submit Your Files</span></a>
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
                                                        <th>File</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php for ($a = 0; $a < $totalItems; $a++) : ?>
                                                       <tr>
                                                           <td><?php echo ($a + 1); ?></td>
                                                           <td><input type="file" name="assignmentFiles[]"></td>
                                                       </tr>
                                                    <?php endfor; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <input type="button" name="fileSubmitBtn" class="btn btn-primary" value="Submit" data-toggle="modal" data-target="#ss_sucess_mess_custom">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                </div> <!-- end col -->



            </div>
        </div>
    </div>
</div>
</div>
</section>


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
<div class="modal fade ss_modal" id="ss_sucess_mess_custom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
                <img src="assets/images/icon_info.png" class="pull-left"> <span class="ss_extar_top20">Files Submitted Sucessfully</span> 
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
</script>

<?php $this->load->view('module/preview/drawingBoard'); ?>