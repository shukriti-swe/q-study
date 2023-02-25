<?php
date_default_timezone_set($this->site_user_data['zone_name']);
$module_time = time();

$key = $question_info_s[0]['question_order'];
$desired = $this->session->userdata('data');

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
$module_type = $question_info_s[0]['moduleType'];
//    End For Question Time
?>

<?php 


foreach ($total_question as $ind) {

if ($ind["question_type"] == 14) {
  $chk = $ind["question_order"];
 }

} 
  ?>

<?php 
    $question_instruct = isset($question_info_s[0]['question_video']) ? json_decode($question_info_s[0]['question_video']):'';
    $question_instruct_id = $question_info_s[0]['id'];
?>
<style type="text/css">
  body .modal-ku {
width: 750px;
}

.modal-body #quesBody {
     width: 628px;
    height: 389px;
    overflow: auto;
}

#ss_extar_top20{
    width: 628px;
    height: 389px;
    overflow: auto;
}
.description_video{
   position: relative;
}
.description_class{
    position: absolute;
    left: 45px;
}
.question_video_class{
    position: absolute;
    left: 70px;
}
</style>

<style>
.box {
  padding: 0px !important;
}

.ss_m_qu .row > div:last-child {
  /*padding-left: 15px !important;*/
}

.image_box_list .row > div:first-child {
  /*padding-right: 15px;*/
}
</style>  


<!--         ***** For Tutorial & Everyday Study *****         -->    
<?php // if ($module_type == 2 || $module_type == 1) { ?>
  <input type="hidden" id="exam_end" value="" name="exam_end" />
  <input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
  <input type="hidden" id="optionalTime" value="<?php echo $question_time_in_second;?>" name="optionalTime" />
  <input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />
  <?php // }?>


  <div class="ss_student_board">
    <div class="ss_s_b_top">
      <div class="ss_index_menu">
        <a href="#">Module Setting</a>
      </div>
      
      <?php if ($question_time_in_second != 0) { ?>
        <div class="col-sm-4" style="text-align: right">
          <div class="ss_timer" id="demo"><h1>00:00:00 </h1></div>
        </div>
      <?php }?>
      
      <div class="col-sm-6 ss_next_pre_top_menu">
        <?php if ($question_info_s[0]['isCalculator']) : ?>
          <input type="hidden" name="" id="scientificCalc">
        <?php endif; ?>

        <?php if ($question_info_s[0]['question_order'] == 1) { ?>                            
          <a class="btn btn_next" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/1"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
        <?php } else { ?>
          <a class="btn btn_next" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/<?php echo ($question_info_s[0]['question_order'] - 1); ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
        <?php } ?> 
        <?php if (array_key_exists($key, $total_question)) { ?>
          <a class="btn btn_next" id="question_order_link" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/<?php echo $question_info_s[0]['question_order'] + 1; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
        <?php } ?>                                        
        <a class="btn btn_next" id="draw" onClick="showDrawBoard()" data-toggle="modal" data-target=".bs-example-modal-lg">
          Draw <img src="assets/images/icon_draw.png">
        </a>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">

        <div class="col-sm-8">
            <div class="workout_menu" style="padding-left: 15px;padding-right: 15px;">
                <ul>
                    <li><a style="cursor:pointer" id="show_question">Question<i>(Click Here)</i></a></li>
                    <li>
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> <span><img src="assets/images/icon_draw.png"> Instruction</span></a>
                    </li>
                </ul>
            </div>
          <div style="display: none;" class="panel-group col-sm-6 question_module" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  Question
                  <button type="button" class="woq_close_btn" id="woq_close_btn">&#10006;</button>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body" id="quesBody">
                  Match the following
                </div>
              </div>
            </div>
          </div>

          <div class="row answer_module" style="margin-top: 20px;">
                <div class="col-sm-12">
                    <form id="answer_form">
                        <input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id'] ?>" name="module_id">
                        <?php if (array_key_exists($key, $total_question)) { ?>
                            <input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] + 1; ?>" name="next_question" />
                        <?php } else { ?>
                            <input type="hidden" id="next_question" value="0" name="next_question" />
                        <?php } ?>
                        <input type="hidden" value="<?php echo $question_info_s[0]['question_id']; ?>" name="question_id" id="question_id">
                        <input type="hidden" id="current_order" value="<?php echo $key; ?>" name="current_order">
                        <input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType']; ?>" name='module_type'>

                        <input type="hidden" name="total_ans" value="<?php echo sizeof($question_info_left_right->right_side); ?>">

                        <?php $i = 1;
                        foreach ($question_info_left_right->left_side as $key=> $row) {
                            ?>
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col-md-9">
                                    <div class="col-xs-11">
                                        <div class="box" style="float: right;margin-right: 10px;">
                                            <div class="ss_w_box">
                                                <?php echo $row[0]; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="ss_lette" id="color_left_side_<?php echo $i; ?>" style="min-height: 0px;">
                                            <input type="radio" id='left_side_<?php echo $i; ?>' name="left_side_<?php echo $i; ?>" value="<?php echo $i; ?>" data-id="1" class="left" onclick="getLeftVal(this);" style="min-height: 60px;">
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-xs-1">
                                        <p class="ss_lette" id="color_right_side_<?php echo $i; ?>" style="min-height: 60px;">
                                            <input type="radio" name="right_side_<?php echo $i; ?>"  value="<?php echo $i; ?>" class="right" onclick="getRightVal(this);" style="min-height: 60px;">
                                        </p>
                                    </div>

                                    <div class="col-xs-9">
                                        <div class="box ">
                                            <div class="ss_w_box text-left">
                                                <p>
                                                    <?php
                                                    echo $question_info_left_right->right_side[$key][0];
                                                    echo '<br><br>'; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="answer_<?php echo $i; ?>" id="answer_<?php echo $i; ?>" data="1" onclick="getAnswer();">
                                    <div class="col-xs-1">
                                        <span class="" id="message_<?php echo $i - 1; ?>"></span>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; } ?>
                        <div class="col-sm-12" style="text-align: center;">
                            <button type="button" class="btn btn_next" id="answer_matching">submit</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>

              <div class="col-sm-4">
                <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  <span>Module Name: <?php echo $question_info_s[0]['moduleName']; ?></span></a>
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
                                                  <th>Description / Video</th>                                                  
                                                </tr>
                                              </thead>
                                              <tbody>
                                                  <?php $i = 1;
                                                  $total = 0;
                                                  foreach ($total_question as $ind) { ?>
                                                  <tr>
                                                    <td>
                                                        <?php if (isset($desired[$i]['ans_is_right'])) {
                                                              if ($desired[$i]['ans_is_right'] == 'correct') {?>
                                                          <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                              <?php } else {?>
                                                          <span class="glyphicon glyphicon-remove" style="color: red;"></span>
                                                              <?php }
                                                        }?>
                                                    </td> 

                                                    
                                                           <?php  if ( ($ind["question_type"] !=14) && ($question_info_s[0]['question_order'] == $ind['question_order']) ) { ?>
                                                                <td style="background-color:lightblue">
                                                                    <?php echo $ind['question_order']; ?>
                                                                </td>
                                                           <?php } 

                                                            elseif ( ($ind["question_type"] ==14) && $order >= $chk ) { ?>
                                                                <td style="background-color:#FFA500">
                                                                  <a href="<?php echo site_url('/module_preview/').$ind['module_id'].'/'.$ind['question_order'] ?>"><?php echo $ind['question_order']; ?></a>
                                                                 </td>
                                                           <?php } 

                                                           elseif ( ($ind["question_type"] ==14) && $order < $chk ) { ?>
                                                                <td style="background-color:#FFA500">
                                                                  <?php echo $ind['question_order']; ?>
                                                                 </td>
                                                           <?php } 

                                                            else{  ?>

                                                              <td>
                                                                  <?php echo $ind['question_order']; ?>
                                                              </td>
                                                              
                                                           <?php } ?>
                                                            

                                                  <td>
                                                      <?php
                                                      echo $ind['questionMarks'];
                                                      $total = $total + $ind['questionMarks'];
                                                      ?>
                                                  </td>
                                                  <td><?php echo $ind['questionMarks']; ?></td>
                                                    <td class="description_video">
                    
                                                        <?php if (isset($ind['questionDescription']) && $ind['questionDescription'] != null ){ ?>
                                                            <a  class="description_class" onclick="showModalDes(<?php echo $i; ?>);" style="display: inline-block;"><img src="assets/images/icon_details.png"></a>
                                                        <?php } ?>
                                                        <?php 
                                                            $question_instruct_vid = isset($ind['question_video']) ? json_decode($ind['question_video']):'';
                                                        ?>
                                                        <?php if (isset($question_instruct_vid[0]) && $question_instruct_vid[0] != null ){ ?>
                                                          <a onclick="showQuestionVideo(<?php echo $i; ?>)" class="question_video_class" style="display: inline-block;"><img src="http://q-study.com/assets/ckeditor/plugins/svideo/icons/svideo.png"></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                      <?php $i++;
                                                  } ?>
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

              <div class="col-sm-4" id="draggable" style="display: none;">
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

      <div class="modal fade" id="ss_info_worng" role="dialog">
        <div class="modal-dialog ui-draggable" style=" width: 48%;">

            <!-- Modal content-->
            <div class="modal-content" style="width: 100%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"> <i class="fa fa-close" style="font-size:20px;color:red"></i><br> Solution</h5>
                </div>
                
                <div class="modal-body row">
                  <i class="fa fa-close" style="font-size:20px;color:red"></i> <span class="ss_extar_top20">Your answer is wrong</span>
                  <br><?php  echo $question_info_s[0]['question_solution']; ?> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn_blue" data-dismiss="modal" onclick="reload()">close</button>   
                </div>
            </div>

        </div>
    </div>

      <!--Times Up Modal-->
      <div class="modal fade ss_modal" id="times_up_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Times Up</h4>
            </div>
            <div class="modal-body row">
              <i class="fa fa-close" style="font-size:20px;color:red"></i> 
              <br><?php echo $question_info_s[0]['question_solution'] ?>
            </div>
            <div class="modal-footer">
              <button type="button" id="question_reload" class="btn btn_blue" data-dismiss="modal">close</button>         
            </div>
          </div>
        </div>
      </div>


<?php $i = 1;
$total = 0;
foreach ($total_question as $ind) { ?>
<!--Question Video Modal-->
<div class="modal fade" id="ss_question_video<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Question Video</h4>
            </div>
            <div class="modal-body">
                <?php 
                    $question_instruct_vid = isset($ind['question_video']) ? json_decode($ind['question_video']):'';
                ?>
                <?php if (isset($question_instruct_vid[0]) && $question_instruct_vid[0] != null ){ ?>
                    <video controls style="width: 100%" id="videoTag<?php echo $i; ?>">
                      <source src="<?php echo isset($question_instruct_vid[0]) ? trim($question_instruct_vid[0]) : '';?>" type="video/mp4">
                    </video>
                    <?php if (isset($question_instruct_vid[1]) && $question_instruct_vid[1] != null ): ?>
                        
                        <video controls style="width: 100%" id="videoTag<?php echo $i; ?>">
                          <source src="<?php echo isset($question_instruct_vid[1]) ? trim($question_instruct_vid[1]) : '';?>" type="video/mp4">
                        </video>
                    <?php endif ?>
                <?php }else{ ?>
                    <P>No question video</P>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue closeVideoModal" value="<?php echo $i; ?>" id="closeVideoModalId<?php echo $i; ?>" onclick="videoCloseWithModal(<?php echo $i; ?>);">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $i++; } ?>
<script>
    function showQuestionVideo(id){
      $('#ss_question_video'+id).modal('show');
    }
    
    function videoCloseWithModal(id){
      $('#ss_question_video'+id).modal('hide');
      var video = $('#videoTag'+id).get(0);
      if (video.paused === false) {
        video.pause();
      } 
    }
</script>



      <?php $i = 1;
      foreach ($total_question as $ind) {
        ?>
        <div class="modal fade ss_modal ew_ss_modal" id="show_description_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
              </div>
              <div class="modal-body">
                <textarea class="form-control" name="questionDescription"><?php echo $ind['questionDescription']; ?></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <?php $i++;
      } ?>


<script>


//    var time_count = 0;

var res;

    $('.right').attr('disabled', true);
    var left_arr = new Array();
    var right_arr = new Array();
    var total_right_side_input = '<?php echo count($question_info_left_right->right_side);?>';
    var answer_array = new Array();
    
    var color_array = new Array('red', 'green', 'blue', '#00BFFF', '#b3230a', '#708090', '#2F4F4F', '#C71585', '#8B0000', '#808000', '#FF6347', '#FF4500', '#FFD700', '#FFA500', '#228B22', '#808000', '#00FFFF', '#66CDAA', '#7B68EE', '#FF69B4');
    
    function getLeftVal(e) {
        var left_ans_val = e.value;
        
        if($.inArray(e.value, left_arr) !== -1) {
            $("#left_side_" + left_ans_val).prop('checked', false);
            $('.left').attr('disabled', false);
            // $("#color_left_side_" + left_ans_val).css({'background-color': '#eeeeee !important'});
            $("#color_left_side_" + left_ans_val).css({'background-color': ''});
            
            if($.inArray(e.value, right_arr) !== -1) {
                for(var i = 1; i <= total_right_side_input; i++){
//                    answer_array.push = $("input[name='answer_" + i + "']").val();
                    if(e.value == $("input[name='answer_" + i + "']").val()){
                        var match_index = i;
                        $("input[name='answer_" + i + "']").val('');
                    }
                }
//                alert(match_index);
                $("input[name='right_side_" + match_index + "']").prop('checked', false);
                // $("#color_right_side_" + match_index).css({'background-color': '#eeeeee !important'});
                $("#color_right_side_" + match_index).css({'background-color': ''});

                right_arr.splice($.inArray(e.value, right_arr),1);
            }
            left_arr.splice($.inArray(left_ans_val, left_arr),1);
        } else {
            $('.right').attr('disabled', false);
            $('.left').attr('disabled', true);
            $("#left_side_" + left_ans_val).attr('disabled', false);
            var color_left = color_array[left_ans_val - 1];
            //document.getElementById("color_left_side_1").style.backgroundColor = color_left;
            document.getElementById("color_left_side_" + left_ans_val).setAttribute('style', 'background-color:' + color_left + ' !important;min-height: 60px;');
            left_arr.push(left_ans_val);
        }
//        console.log(left_arr);
    }

    function getRightVal(e) {
        var last = left_arr.slice(-1)[0];
        var right_ans_val = e.value;
        
        right_arr.push(last);
        
        document.getElementById("answer_" + right_ans_val).value = last;

        $('.right').attr('disabled', true);
        $('.left').attr('disabled', false);
        var color_right = color_array[last - 1];
        document.getElementById("color_right_side_" + right_ans_val).setAttribute('style', 'background-color:' + color_right + ' !important;min-height: 60px;');
//        console.log(right_arr);
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
            url: 'answer_multiple_matching',
            data: form.serialize(),
            dataType: 'json',
            success: function (results) {
//                console.log(results);
                if (results == 6) {
                    window.location.href = 'Preview/show_tutorial_result/'+$('#module_id').val();
                }
                if (results == 5) {
                    window.location.href = 'module_preview/'+$("#module_id").val()+'/'+$('#next_question').val();
                }
                var obj = (results);

                res = results;
                console.log(obj);
                if (obj.flag == 0) {
                    $('#ss_info_worng').modal('show');
                    abc=0;
                    for (var i = 0; i < obj.student_ans.length; i++) {
                      if(obj.student_ans[i]!=""){
                                abc=1;
                             
                            }
                        if (obj.student_ans[i] == obj.tutor_ans[i]) {
                            $("#message_" + i).removeClass("fa fa-close");
                            $("#message_" + i).addClass("fa fa-check");
                        } else {
                            $("#message_" + i).removeClass("fa fa-check");
                            $("#message_" + i).addClass("fa fa-close");
                        }
                        if(obj.student_ans.length-1==i){
                               $('.left').attr('disabled', false);
                               }
                    }
                }
                if (obj.flag == 1) {
                    for (var i = 0; i < obj.student_ans.length; i++) {
                        $("#message_" + i).removeClass("fa fa-close");
                        $("#message_" + i).removeClass("fa fa-check");
                    }

                    var next_question = $("#next_question").val();
                    if(next_question != 0) {
                        var question_order_link = $('#question_order_link').attr('href');
                    } if(next_question == 0) {
                        var question_order_link = 'Preview/show_tutorial_result/'+$("#module_id").val();
                    }

                    $("#next_qustion_link").attr("href", question_order_link);
                    $('#ss_info_sucesss').modal('show');
                }

            }
        });

    });
    
    function showModalDes(e)
    {
        $('#show_description_' + e).modal('show');
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
                url: 'answer_multiple_matching',
                data: form.serialize(),
                dataType: 'json',
                success: function (results) {
                    if (results == 6) {
                        window.location.href = 'Preview/show_tutorial_result/'+$('#module_id').val();
                    }
                    if (results == 5) {
                        window.location.href = 'module_preview/'+$("#module_id").val()+'/'+$('#next_question').val();
                    }
                    var obj = (results);
                    res = results;
                    console.log(obj);
                    if (obj.flag == 0) {
                        $('#times_up_message').modal('show');
                        $('#question_reload').click(function () {
                            location.reload(); 
                        });
                        for (var i = 0; i < obj.student_ans.length; i++) {
                            if (obj.student_ans[i] == obj.tutor_ans[i]) {
                                $("#message_" + i).removeClass("fa fa-close");
                                $("#message_" + i).addClass("fa fa-check");
                            } else {
                                $("#message_" + i).removeClass("fa fa-check");
                                $("#message_" + i).addClass("fa fa-close");
                            }
                        }
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

<script>
        $("#show_question").click(function () {
            $(".question_module").show();
            $(".answer_module").hide();
        });
        $("#woq_close_btn").click(function () {
            $(".question_module").hide();
            $(".answer_module").show();
        });
</script>

<script type="text/javascript">
    $("#ss_info_worng").on('hidden.bs.modal', function () {
      for (var i = 0; i < res.student_ans.length; i++) {
            let x = i+1;
            let right_side = "right_side_"+x+"";
            let left_side = "left_side_"+x+"";
            let color_left_side = "color_left_side_"+x+"";
            let color_right_side = "color_right_side_"+x+"";

            $("input:radio").attr("checked", false)

            document.getElementById(color_left_side).style.backgroundColor  = "white";
            document.getElementById(color_right_side).style.backgroundColor  = "white";
            $("#message_" + i).removeClass("fa fa-close");
            $("#message_" + i).removeClass("fa fa-check");
        }

    });
</script>

<?php $this->load->view('module/preview/drawingBoard'); ?>