<script type="text/javascript">
    var sendToParent = 0;
</script>

<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="ss_index_menu">
            <?php if ($module_info[0]['moduleType'] == 1) :?>
                <a href="all_tutors_by_type/<?php echo $module_info[0]['user_id']?>/<?php echo $module_info[0]['moduleType']?>">Index
                </a>
            <?php endif; ?>
        </div>

       
        <!-- <div class="col-sm-6 ss_next_pre_top_menu">
            <a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>                 
            <a class="btn btn_next" href="all_module_by_type/<?php echo $module_info[0]['user_type']?>/<?php echo $module_info[0]['moduleType']?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
        </div> -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="ss_s_b_main" style="min-height: 100vh">
                <?php if ($module_info[0]['moduleType'] == 1) {
                    $obtain_marks = $obtained_marks;
                    $originalMark = $total_marks;

                } else {
    $obtain_marks = isset($obtained_marks[0]['studentMark']) ? $obtained_marks[0]['studentMark'] : 0;
    $originalMark = isset($obtained_marks[0]['originalMark']) ? $obtained_marks[0]['originalMark'] : 0;

}?>

<?php

    $val1 = $obtain_marks;
    $val2 = $originalMark;
    $paecentage = number_format(($val1 * 100)/$val2);
?>
                
                <div class="col-sm-12">
                    
                    <div class="row">
                    <div class="col-sm-6">
                        <h5 style="color: #095f7b;font-size: 14px;font-weight: bold;margin-bottom: 25px;">
                            <?php if ($this->session->userdata('all_workout_quiz_q') == 0 ) { ?>
                                <?php echo $user_info[0]['user_email'];?> obtained <?php echo $obtain_marks;?> marks out of <?php echo $originalMark;?> 
                            <?php } ?>
                        </h5>
                    </div>
                    <div style="padding-left: 12%;" class="col-sm-6">
                        <?php if($dialogue[0]['link']){ ?>

                            <!-- <a id="click_link" class="btn btn-warning click_link" style="text-align:center;border-radius:20px;background-color:#ebc50c;color:black;" href="<?//php echo $dialogue[0]['link']; ?>"><b>Click Here</b></a> -->
                        <?php }?>
                    </div>
                    </div>

                    <?php $flag = 0;
                    if ($tutorial_ans_info) {
                        if ($module_info[0]['moduleType'] == 1) {?>
                            <ul class="list list-unstyled list-inline" style="margin-bottom: 10px;">
                            <?php foreach ($tutorial_ans_info as $row) {
                                if ($row['ans_is_right'] == 'wrong') {
                                    $flag = 1;?>
                                <li class="show_wrong_btn" style="display: none;">
                                    <div >
                                    <a href="get_tutor_tutorial_module/<?php echo $row['module_id']?>/<?php echo $row['question_order_id'];?>">
                                        <button class="btn btn-info" style="background-color: #888d8f;border-color: #888d8f;">
                                            <?php echo $row['question_order_id'];?>
                                        </button>
                                    </a>
                                    </div>
                                </li>
                                <?php }
                            }?>
                            </ul>
                        
                        <?php } if ($module_info[0]['moduleType'] == 2 && $module_info[0]['optionalTime'] ==0) { ?>
                            <ul class="list list-unstyled list-inline" style="margin-bottom: 10px;">
                            <?php foreach ($tutorial_ans_info as $row) {
                                if ($row['error_count'] <= 3) {
                                    $flag = 1;?>
                                <li class="show_wrong_btn" style="display: none;">
                                    <a href="get_tutor_tutorial_module/<?php echo $row['module_id']?>/<?php echo $row['question_order_id'];?>">
                                        <button class="btn btn-info" style="background-color: #888d8f;border-color: #888d8f;">
                                            <?php echo $row['question_order_id'];?>
                                        </button>
                                    </a>
                                </li>
                                <?php }
                            }?>
                            </ul>
                        <?php }
                    }?>
                    
                    <?php if ($flag == 1) {?>
                         <?php if ($module_info[0]['moduleType'] == 2 && ($module_info[0]['optionalTime'] !=0)) { ?>
                            <?php }else{?>
                            <p style="color: #990000;font-weight: bold;font-size: 12px;">In above question(s) you have answered wrong. Please error revision them</p>
                            <?php }?>
                    <?php }?>
                </div>
                
                <div class="col-sm-12" style="text-align: center;">
                    
                    <?php if (($module_info[0]['moduleType'] == 2 && !$tutorial_ans_info) ||
                                ($module_info[0]['moduleType'] == 1 && $flag != 1) || $module_info[0]['moduleType'] == 3 || $module_info[0]['moduleType'] == 4) {?>
                        <!--<a class="btn btn-info"href="all_module_by_type/<?php echo $module_info[0]['user_type'] ?>/<?php echo $module_info[0]['moduleType'] ?>" style="color: white;">-->
                        <script type="text/javascript">
                                 sendToParent = 1;
                        </script>
                        <a id="for_finish" class="btn btn-info" href="finish_all_module_question/<?php echo $module_info[0]['id'] ?>/<?php echo $paecentage ?>" style="color: white;"> Finish</a>
                        
                        <p style="color:red;"> You will be redirected in module page within <span id="counter">15</span> seconds</p>

                    <?php }elseif ($module_info[0]['moduleType'] == 2 && $module_info[0]['optionalTime'] !=0){ ?>
                        <a id="for_finish"   class="btn btn-info" href="finish_all_module_question/<?php echo $module_info[0]['id'] ?>/<?php echo $paecentage ?>" style="color: white;">
                            Finish
                        </a>
                    <?php } ?>

                    
                    
                    
                    
                </div>
                
                <div class="col-md-12" style="text-align: center;padding: 50px;">
                    <?php
                    if (($module_info[0]['moduleType'] == 2 || $module_info[0]['moduleType'] == 1) && $flag != 1 && $dialogue) {
                        echo $dialogue[0]['body'];
                    }elseif($module_info[0]['moduleType'] == 2 && $module_info[0]['optionalTime'] !=0)
                    {
                        echo $dialogue[0]['body'];
                    }
                    ?>
                </div>
                
            </div>               
        </div>
    </div>
</div>


<?php $this->load->view('students/question_module_type_tutorial/drawingBoard'); ?>

<script type="text/javascript">
    var myinterval;
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) {
        clearInterval(myinterval);
        var link=$('#for_finish').attr('href');
        if(link == undefined)
        {
            window.location.href = 'finish_all_module_question/'+<?php echo $module_info[0]['id'] ?>+'/'+<?php echo $paecentage ?>;
        }
        else
        {
            window.location.href = $('#for_finish').attr('href');
        }
 
    }
if (parseInt(i.innerHTML)!=0) {
    i.innerHTML = parseInt(i.innerHTML)-1;
}
}
myinterval = setInterval(function(){ countdown(); },1000);

</script>

<script>
   
    $(document).ready(function(){
      
    //  $(document).on("click", ".click_link", function(event) {
        $("#click_link").click(function(event){
        event.preventDefault();
       var link = $(this).attr('href');
       
        $.ajax({
                      type: 'GET',
                      url: 'finish_all_module_question/'+<?php echo $module_info[0]['id'] ?>+'/'+<?php echo $paecentage ?>,
                      dataType: 'html',
                      success: function (results) {
                         window.location.href=link;
                      }
                  });
    });
    
    });
    </script>

    <script>

    send_sms_parent();
    $(document).ready(function(){
    
        sessionStorage.removeItem('audioPlayed');
        
    })

    function send_sms_parent() {

        var user_email     = '<?= $user_info[0]['user_email']; ?>';
        var obtain_marks   = '<?= $obtain_marks; ?>';
        var originalMark   = '<?= $originalMark; ?>';
        var time_hour_minute_sec   = '<?= isset($time_hour_minute_sec) ? $time_hour_minute_sec : "";  ?>';
        var parent_mobile    = '<?= isset($parent_info) ? $parent_info : "";  ?>';
        var module_info    = '<?= $module_info[0]['moduleType'];  ?>';

        if (time_hour_minute_sec != "" && parent_mobile !="" ) {
            $.ajax({
                url: '<?php echo site_url('student/sms_to_parent'); ?>',
                type: 'POST',
                data: {
                    user_email , obtain_marks , originalMark , time_hour_minute_sec , parent_mobile , module_info , sendToParent
                },
                success: function (data) {

                }
            });

        }
    }

    setTimeout(function () {
      $(".show_wrong_btn").show()
    }, 1)

</script>
