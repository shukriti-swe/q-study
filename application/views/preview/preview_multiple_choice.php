<style type="text/css">
  body .modal-ku {
width: 750px;
}

.modal-body .panel-body {
     width: 628px;
    height: 466px;
    overflow: auto;
}

.modal-body {
    position: relative;
    padding: 15px;
    }
#ss_extar_top20{
    width: 628px;
    height: 466px;
    overflow: auto;
}
.ssss_class{
    margin-bottom: 8px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 6px;
}
.checkbox_class{
    display: inline-block;
    width: 53px;
    position: relative;
}
.ssss_class p{
    font-size: 23px;
    display: inline-block;
    margin-top: 0;
}

.ssss_class input[type=checkbox] {
    transform: scale(1.4);
    margin-left: 3px;
    position: relative;
    top: 2px;
    left: -13px;
    margin-top: 0;
}
.ans_image{
    position: absolute;
    display: none;
    top: -5px;
    left: -2px;

}
.ans_image img{
    width: 30px;
}
.ans_image button{
    border:none;
    background:none;
}
.ans_image span{
    font-family: berlin Sans FB;
    font-size: 24px;
    font-weight: bold;
    color: #92d050;
    position: absolute;
    top: 2px;
}
.image_view_click{
    border:none;
    background:none;
    position: absolute;
    top: 4px;
    right: 0px;
}
.image_view_click img{
    width: 24px;
}
.ss_w_box .image-editor{
    height: 184px;
}

.ss_w_box{max-height: 192px;}

.panel_p_qus p{
    font-size: 20px;
    font-weight: bold;
    margin-left: -15px;
    margin-bottom: 10px;
}
.calculator-trigger {
width: 30px;
height: 35px;
}
.ss_timer h1 {
border: 1px solid #a8a2a2;
font-size: 17px;
margin: 0;
line-height: 28px;
padding: 3px 0px;
color: #222;
}
.workout_menu ul li {
    display: inline-block;
  
    margin-right: 5px;
  }
  .ss_timer {
      margin-left: 5px;
      display: inline-block;
      background: #eeeef0;
      border: 0;
      min-width: 110px;
      text-align: center;
  }
  .ss_timer h1 {
    font-size: 17px;
    margin: 0;
    line-height: 20px !important;
    padding: 7px 10px;
    color: #222;
    }
    .workout_menu img.calculator-trigger{
        margin-top:0;
        margin-bottom:0;
        width: 30px;
        height: 39px;
    }
</style>

<?php
    $answerCount = count(json_decode($question_info_s[0]['answer']));
    // echo "<pre>";print_r($answerCount);die();
    
    date_default_timezone_set($this->site_user_data['zone_name']);
    $module_time = time();
    
    //    For Question Time
    $question_time = explode(':', $question_info_s[0]['questionTime']);
    $hour = 0;
    $minute = 0;
    $second = 0;
if (is_numeric($question_time[0])) {
    $hour = $question_time[0];
} if (is_numeric($question_time[1])) {
    $minute = $question_time[1];
} if (is_numeric($question_time[2])) {
    $second = $question_time[2];
}

    $question_time_in_second = ($hour * 3600) + ($minute * 60) + $second ;
    
//    End For Question Time

?>
<input type="hidden" id="exam_end" value="" name="exam_end" />
<input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
<input type="hidden" id="optionalTime" value="<?php echo $question_time_in_second;?>" name="optionalTime" />
<input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />

<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="ss_index_menu">
            <a href="<?php echo base_url().$userType.'/view_course'; ?>">Question/Module</a>
        </div>
        
        
        
        <div class="col-sm-6 ss_next_pre_top_menu">
            
            
            <a class="btn btn_next" href="question_edit/<?php echo $question_item?>/<?php echo $question_id?>">
                <i class="fa fa-caret-left" aria-hidden="true"></i> Back
            </a>
            <a class="btn btn_next" href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
            <!--<a class="btn btn_next" href="#">Draw <img src="<?php echo base_url(); ?>assets/images/icon_draw.png"></a>                                       -->
            <a class="btn btn_next" id="draw" onClick="showDrawBoard()" data-toggle="modal" data-target=".bs-example-modal-lg">
                Workout <img src="assets/images/icon_draw.png">
            </a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="ss_s_b_main" style="min-height: 100vh">

                <?php  if ($question_info_s[0]['question_name_type']) { ?>
                   <div class="col-sm-12">
                        <div class="workout_menu" style="margin-bottom: 30px;">
                          <ul>
                              <li>
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_draw.png"> Instruction</span></a>
                              </li>
                              <?php if ($question_time_in_second != 0) { ?>

                                <li><div class="ss_timer" id="demo"><h1>00:00:00 </h1></div></li>

                                <?php }?>
                                <?php if ($question_info_s[0]['isCalculator']) : ?>
                                    <li><input type="hidden" name="" id="scientificCalc"></li>
                                <?php endif; ?>
                              
                              <?php if($question_info_s[0]['question_name_type'] == 2) { ?>

                                <li><a style="cursor:pointer" id="show_question" onclick="show_question()">Question<i>(Click Here)</i></a></li>
                              <?php } ?>
                          </ul>
                        </div>
                    </div>
                <?php  }else{ ?>
                  <div class="col-sm-12">

                      <div class="workout_menu" style="margin-bottom: 30px;">
                          <ul>
                              <li>
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_draw.png"> Instruction</span></a>
                              </li>

                              <li><a style="cursor:pointer" id="show_question" onclick="show_question()">Question<i>(Click Here)</i></a></li>
                              
                          </ul>
                      </div>

<!-- 
                      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                          <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingOne">
                                  <h4 class="panel-title">
                                      <a role="button" onclick="show_question()">
                                          <span style="color:#2198c5;" class="Instruction_click">
                                              <img src="assets/images/icon_draw.png" ><b> Instruction</b>
                                          </span>  Question ( Click )
                                      </a>
                                  </h4>
                              </div>
                          </div>
                      </div> -->
                  </div>
                <?php  } ?>
                
                <?php $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');?>
                
                <form id="answer_form">
                    <div class="col-sm-8" style="padding:0;">              
                        <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default" style="border:none;">                                
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body ss_imag_add_right" >
                                        <?php  if ($question_info_s[0]['question_name_type']) { ?>
                                            <div class="panel-body panel_p_qus" style="padding:0;">
                                               
                                                <?php echo $question_info->questionName;?>
                                                <br>
                                            </div>
                                        <?php }?>
                                        <div class="row image_box_list ss_m_qu">
                                            <?php $i = 1;
                                            foreach ($question_info->vocubulary_image as $row) { ?>
                                                <div class="col-md-6" style="min-height: 107px;">
                                                    <div class="row" style="display: flex;align-items: center;border: 1px solid #565656;margin-right: 2px;">
                                                        <div class="col-md-12 text-center">
                                                            <div class="ssss_class">
                                                                <p class=""><?php echo $lettry_array[$i - 1]; ?></p>
                                                                <div class="checkbox_class">
                                                                    <input class="response_answer_class" id="response_answer_id<?php echo $i; ?>" type="checkbox" name="answer_reply[]" value="<?php echo $i; ?>" >
                                                                    <div class="ans_image" id="ans_image<?php echo $i?>">
                                                                        <button type="button" class="image_click" id="image_click<?php echo $i?>" value="<?php echo $i?>"><img src="assets/images/images/answer_img.PNG"></button>
                                                                        <!-- <span >Answer</span> -->
                                                                    </div>
                                                                </div>
                                                                <button type="button" data-toggle="modal" data-target="#view_image<?php echo $i;?>" class="image_view_click" id="image_view_click<?php echo $i?>" value="<?php echo $i?>"><img src="assets/images/images/image_view.PNG"></button>
                                                                <!--<input type="radio" name="answer_reply[]" value="<?php echo $i; ?>" >-->
                                                            </div>
                                                            <div class="box ">
                                                                <div class="ss_w_box">
                                                                    <?php echo $row[0]; ?>
                                                                </div>                                                   
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $i++;
                                            } ?>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-4" style="margin-top: 10px;">     
                                        <button type="button" class="btn btn_next" id="answer_matching">submit</button>
                                    </div>                                  
                                    <div class="col-sm-3"></div>

                                </div>

                            </div>


                        </div>

                    </div>
                    <input type="hidden" name="id" value="<?php echo $question_id; ?>">
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
                                                <thead>    
                                                    <tr>

                                                        <th>SL</th>
                                                        <th>Mark</th>
                                                        
                                                        <th>Description / Video</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>

                                                        <td>1</td>
                                                        <td><?php echo $question_info_s[0]['questionMarks']; ?></td>
                                                        
                                                        <td>
                                                            <a onclick="showDescription()" style="display: inline-block;">
                                                                <img src="assets/images/icon_details.png">
                                                            </a>
                                                            <a onclick="showQuestionVideo()" class="text-center" style="display: inline-block;"><img src="http://q-study.com/assets/ckeditor/plugins/svideo/icons/svideo.png"></a>
                                                        </td>
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
                 <div class="col-sm-4 pull-right" id="draggable" style="display: none;">
                        <div class="panel-group" id="waccordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#waccordion" href="#collapseworkout" aria-expanded="true" aria-controls="collapseworkout">  Workout</a>
                                    </h4>
                                </div>
                                <div id="collapseworkout" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body" id="setWorkoutHere">
                                        <textarea name="workout" class="mytextarea"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal_2222" role="dialog">
    <div class="modal-dialog ui-draggable" style=" width: 48%;">
        <!-- Modal content-->
        <div class="modal-content" style="width: 100%;">
            <div class="modal-header ui-draggable-handle">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <!--<h4 class="modal-title">Video Lesson</h4>-->
            </div>
            <div class="modal-body" >
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" id="textarea_2">
                   <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <?php if($question_info_s[0]['question_name_type'] == 2) { ?>
                                <?php echo $question_info->questionName_2;?>
                            <?php }else{ ?>
                                <?php echo $question_info->questionName;?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>   
            </div>
        </div>
    </div>
</div>
<?php $i = 1;
    foreach ($question_info->vocubulary_image as $row) { ?>
    <!-- Modal -->
    <div class="modal fade" id="view_image<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="box ">
                <div class="ss_w_box_modal">
                    <?php echo $row[0]; ?>
                </div>                                                   
            </div>
          </div>
        </div>
      </div>
    </div>
<?php $i++;
} ?>

<script type="text/javascript">
  function show_question() {
    $('#myModal_2222').modal('show');
  }
  
  
    
  
    $(".response_answer_class").click(function(){
       if($('.response_answer_class').is(":checked")) {
            var question = <?=$answerCount?>;  
            var value = $(this).val();
            $('#ans_image'+value).show();
            if(question == 1){
                
                for (var i = 1; i <= 10; i++)
                {
                    if(value != i){
                        $('#ans_image'+i).hide();
                        $('#response_answer_id'+i).prop('checked',false);
                    }
                }
               
            }
        }else{
        }
    });
    
    $(".image_click").click(function(){
       var value = $(this).val();
       $('#response_answer_id'+value).prop('checked',false);
       $('#ans_image'+value).hide();
    });
</script>

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
        <div class="modal-content" style="height: 265px">
            <div class="modal-header" >

                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body row" style="height: 87%;">
                <img src="assets/images/icon_sucess.png" class="pull-left"> <br> <span class="">Your answer is correct</span> 

            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<!--Success Modal-->
<?php 
    $question_instruct = isset($question_info_s[0]['question_video']) ? json_decode($question_info_s[0]['question_video']):'';
?>
<div class="modal fade" id="ss_question_video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Question Video</h4>
            </div>
            <div class="modal-body">

                <?php if (isset($question_instruct[0]) && $question_instruct[0] != null ){ ?>
                    <video controls style="width: 100%">
                      <source src="<?php echo isset($question_instruct[0]) ? trim($question_instruct[0]) : '';?>" type="video/mp4">
                    </video>
                    <?php if (isset($question_instruct[1]) && $question_instruct[1] != null ): ?>
                        
                        <video controls style="width: 100%">
                          <source src="<?php echo isset($question_instruct[1]) ? trim($question_instruct[1]) : '';?>" type="video/mp4">
                        </video>
                    <?php endif ?>
                <?php }else{ ?>
                    <P>No question video</P>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ss_info_worng" role="dialog">
    <div class="modal-dialog ui-draggable" style=" width: 48%;">

        <!-- Modal content-->
        <div class="modal-content" style="width: 100%;">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"> <i class="fa fa-close" style="font-size:20px;color:red"></i><br> Solution</h5>
            </div>
            <div class="modal-body" style="height: 468px;">
                <div id="ss_extar_top20">
                    <?php echo $question_info_s[0]['question_solution']?>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue rsclose" data-dismiss="modal">close</button>   
            </div>
        </div>

    </div>
</div>

<script>
    $('#answer_matching').click(function () {
        var form = $("#answer_form");
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/answer_matching_multiple_choice',
            data: form.serialize(),
            dataType: 'html',
            success: function (results) {
                if (results == 1) {
                    clearInterval(clear_interval);
                    $('#ss_info_sucesss').modal('show');
                } else {
                    $('#ss_info_worng').modal('show');
                }
            }
        });

    });
     $('body').on('click','.rsclose',function(){
        $('.response_answer_class').prop('checked', false);
        $('.ans_image').hide(); 
    })
    function showDescription(){
        $('#ss_info_description').modal('show');
    }
    function showQuestionVideo(){
        $('#ss_question_video').modal('show');
    }

</script>


<script>
    var remaining_time;
    var clear_interval;
    var h1 = document.getElementsByTagName('h1')[0];

    function circulate1() {
            
        remaining_time = remaining_time - 1;
        
        var v_hours = Math.floor(remaining_time / 3600);
        var remain_seconds = remaining_time - v_hours * 3600;       
        var v_minutes = Math.floor(remain_seconds / 60);
        var v_seconds = remain_seconds - v_minutes * 60;
        
        if (remaining_time > 0) {
            h1.textContent = v_hours + " : "  + v_minutes + " : " + v_seconds + "  " ;          
        } else {
            var form = $("#answer_form");
            $.ajax({
                type: 'POST',
                url: 'IDontLikeIt/answer_matching_multiple_choice',
                data: form.serialize(),
                dataType: 'html',
                success: function (results) {
                     if (results == 1) {
                        $('#ss_info_sucesss').modal('show');
                    }
                    else {
                        $('#times_up_message').modal('show');
                        $('#question_reload').click(function () {
                            location.reload(); 
                        });
                    }
                }
            });
            h1.textContent = "EXPIRED";
        }
    }
    
    function takeDecesionForQuestion() {
        
        var exact_time = $('#exact_time').val();
        
        var now = $('#now').val();
        var opt = $('#optionalTime').val();
        
        
        var countDownDate =  parseInt (now) + parseInt($('#optionalTime').val());
        
        var distance = countDownDate - now;  
        var hours = Math.floor( distance/3600 );
//        alert(distance)
        var x = distance % 3600;
    
        var minutes = Math.floor(x/60); 
        
        var seconds = distance % 60;
        
        var t_h = hours * 60 * 60;
        var t_m = minutes * 60;
        var t_s = seconds;
    
        var total = parseInt(t_h) + parseInt(t_m) + parseInt(t_s);
    
        
        var end_depend_optional = parseInt(exact_time) + parseInt(opt);
    
        if(opt > total) {
            remaining_time = total;
        } else {    
            remaining_time = parseInt(end_depend_optional) - parseInt(now);
        }
    
        clear_interval = setInterval(circulate1,1000);
    
    }
    

    <?php if ($question_time_in_second != 0) { ?>
        takeDecesionForQuestion();
    <?php }?>
</script>
<?php $this->load->view('module/preview/drawingBoard');?>
