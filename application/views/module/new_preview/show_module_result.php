
<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="ss_index_menu">
            <a href="all_module_by_type">Index</a>
        </div>

       
        <div class="col-sm-6 ss_next_pre_top_menu">
            <a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>					
            <a class="btn btn_next" href="all_module_by_type/<?php echo $module_info[0]['user_type']?>/<?php echo $module_info[0]['moduleType']?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="ss_s_b_main" style="min-height: 100vh">
                
                <div class="col-sm-12">
                    <h5 style="color: #095f7b;font-size: 14px;font-weight: bold;margin-bottom: 25px;">
                        <?php echo $user_info[0]['user_email'];?> obtained <?php echo $obtained_marks;?> out of <?php echo count($tutorial_ans_info);?> question
                    </h5>
                    <?php 
                        $flag = 0;
                        if($tutorial_ans_info){?>
                    <ul class="list list-unstyled list-inline" style="margin-bottom: 10px;">
                    <?php foreach ($tutorial_ans_info as $row){
                        if($row['ans_is_right'] == 'wrong'){
                            $flag = 1;?>
                        <li>
                            <!--<a href="ans_the_wrong_question/<?php echo $row['module_type']?>/<?php echo $row['module_id']?>/<?php echo $row['question_order_id'];?>">-->
                            <a href="module_preview/<?php echo $row['module_id']?>/<?php echo $row['question_order_id'];?>">
                                <button class="btn btn-info" style="background-color: #888d8f;border-color: #888d8f;">
                                    <?php echo $row['question_order_id'];?>
                                </button>
                            </a>
                        </li>
                    <?php }}?>
                    </ul>
                    
                    
                    
                        <?php }if($flag == 1) {?>
                        <p style="color: #990000;font-weight: bold;font-size: 12px;">In above question(s) you have answered wrong. Please error revision them</p>
                    <?php }?>
                </div>
                
                <div class="col-sm-12" style="text-align: center;">
                    
                    <!--<a class="btn btn-info"href="all_module_by_type/<?php echo $module_info[0]['user_type'] ?>/<?php echo $module_info[0]['moduleType'] ?>" style="color: white;">-->
                    <a class="btn btn-info"href="edit-module/<?php echo $module_info[0]['id']?>" style="color: white;">
                        <!--<button class="" type="button">-->
                            Finish
                        <!--</button>-->
                    </a>
                    
                </div>
            </div>				 
        </div>
    </div>
</div>




