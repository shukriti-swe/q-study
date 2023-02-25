<?php 

    $key = $question_info_s[0]['question_order']; 
    
    $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'],TRUE);
    $desired = $temp_table_ans_info;
//    echo '<pre>';print_r(json_decode($temp_table_ans_info[$key]['student_ans']));
    $link_next = "javascript:void(0);";
    $link = "javascript:void(0);";

    $lastElement = end($desired);
 
//Print it out!
//print_r($lastElement);
    if (is_array($desired)) {
        $link1 = base_url();
        $link_key = $key - 1;
        if (array_key_exists($link_key, $desired)) {
            $link = $link1 . 'check_student_copy/' . $question_info_s[0]['module_id'] . '/' . $user_info[0]['id']. '/' . $link_key;
        }
        $link_key_next = $key;
        if (array_key_exists($link_key_next, $desired) && $lastElement['question_order_id'] != $key) {
            $question_order = $question_info_s[0]['question_order'] + 1;
            
            $link_next = $link1 . 'check_student_copy/' . $question_info_s[0]['module_id'] . '/' . $user_info[0]['id']. '/' . $question_order;
        }
    }

    $module_type = $question_info_s[0]['moduleType'];
?>
<style>
.math_plus{word-break: break-all;}
.math_plus p{font-size: 13px;text-decoration: underline;}
</style>
<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="ss_index_menu <?php if ($module_type == 3) {?>col-md-2<?php }?>">
            <?php if ($module_type == 1) { ?>
            <a href="all_module_by_type/<?php echo $total_question[0]['user_type'];?>/<?php echo $total_question[0]['moduleType'];?>">Index</a>
            <?php }else {?>
            <a >Index</a>
            <?php }?>
        </div>
        
<!--        <div class="col-sm-4" style="text-align: right">
            <div class="ss_timer" id="demo"><h1>00:00:00 </h1></div>
        </div>-->
        
        <div class="col-sm-7 ss_next_pre_top_menu">
        
            <a class="btn btn_next" href="<?php echo $link; ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
            <a class="btn btn_next" href="<?php echo $link_next; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>									
        
            <a class="btn btn_next" id="draw" onClick="show_workout()">
               Draw <img src="assets/images/icon_draw.png">
            </a>
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
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span><img src="assets/images/icon_draw.png"> Instruction</span> Question
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="math_plus">
                                        <?php echo isset($questionBody)?$questionBody:''; ?>
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
                                    <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">   Answer</a>
                                </h4>
                            </div>
                            <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="math_plus">
                                        <?php echo json_decode($temp_table_ans_info[$key]['student_ans']);?>
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
                                    <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  
                                        <span>Module Name: <?php echo $question_info_s[0]['module_type'] ?></span></a>
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
                                                        <th>Obtained</th>
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

                <div class="col-sm-4" id="workout" style="display: none;">
                    <div class="panel-group" id="waccordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#waccordion" href="#collapseworkout" aria-expanded="true" aria-controls="collapseworkout">  Workout</a>
                                </h4>
                            </div>
                            <div id="collapseworkout" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class=" math_plus">
                                        <?php echo $desired[$key]['workout'] ?>
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

<script type="text/javascript">
    $('.qDtlsOpenModIcon').on('click', function(){
        var hiddenTaskDesc = $(this).closest('tr').children('#hiddenTaskDesc').val();
        $('.qDtlsModBody').html(hiddenTaskDesc);
    });
    
    
//    $('#answer_matching').click(function () {
//        $('#ss_info_sucesss').modal('show');
//    });
</script>

<script>
    function show_workout(){
        $("#workout").show();
    }
</script>