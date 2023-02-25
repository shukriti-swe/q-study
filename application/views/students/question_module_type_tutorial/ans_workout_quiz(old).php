<?php 
date_default_timezone_set('Asia/Dhaka');
$module_time = time();
$key = $question_info_s[0]['question_order']; 


if($tutorial_ans_info){
  $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'],TRUE);
  $desired = $temp_table_ans_info;
}else{
  $desired = $this->session->userdata('data');
}


$link_next = "javascript:void(0);";
$link = "javascript:void(0);";

if (is_array($desired)) {
  $link_key = $key - 1;
  if (array_key_exists($link_key, $desired) && !$tutorial_ans_info) {
    $link = $desired[$link_key]['link'];
  }
  $link_key_next = $key;
  if (array_key_exists($link_key_next, $desired) && !$tutorial_ans_info) {
    $question_id = $question_info_s[0]['question_order'] + 1;
    $link1 = base_url();
    $link_next = $link1 . 'get_tutor_tutorial_module/' . $question_info_s[0]['module_id'] . '/' . $question_id;
  }
}

$module_type = $question_info_s[0]['moduleType'];
?>

<!--         ***** Only For Special Exam *****         -->
<?php if ($module_type == 3) { ?>
  <input type="hidden" id="exam_end" value="<?php echo $module_info[0]['exam_end'];?>" name="exam_end" />
  <input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
  <input type="hidden" id="optionalTime" value="<?php echo $module_info[0]['optionalTime'];?>" name="optionalTime" />
  <input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />
<?php }?>


<div class="ss_student_board">
  <div class="ss_s_b_top">
    <div class="ss_index_menu <?php if ($module_type == 3) { ?>col-md-2<?php }?>">
      <?php if ($module_type == 1) { ?>
        <a href="all_module_by_type/<?php echo $total_question[0]['user_type'];?>/<?php echo $total_question[0]['moduleType'];?>">Index</a>
      <?php }else {?>
        <a >Index</a>
      <?php }?>
    </div>
    <?php if ($module_type == 3) { ?>
      <div class="col-sm-4" style="text-align: right">
        <div class="ss_timer" id="demo"><h1>00:00:00 </h1></div>
      </div>
    <?php }?>

    <div class="<?php if ($module_type != 3) {echo 'col-sm-7'; }else{echo 'col-sm-6';}?> ss_next_pre_top_menu">
      <?php if ($question_info_s[0]['moduleType'] == 1) { ?>

        <a class="btn btn_next" href="<?php echo $link; ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
        <a class="btn btn_next" href="<?php echo $link_next; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>                  
      <?php }else{?>
        <a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
        <a class="btn btn_next" href="javascript:void(0);"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
      <?php }?>
      <a class="btn btn_next" id="draw" onClick="test()" data-toggle="modal" data-target=".bs-example-modal-lg">
       Draw <img src="assets/images/icon_draw.png">
     </a>
   </div>
 </div>
 <div class="container-fluid">
  <form id="answer_form">

    <input type="hidden" value="<?php echo $question_info_s[0]['question_id']; ?>" name="question_id" id="question_id">

    <?php if (array_key_exists($key, $total_question) && !$tutorial_ans_info) { ?>
      <input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] + 1; ?>" name="next_question" />
    <?php } else { ?>
      <input type="hidden" id="next_question" value="0" name="next_question" />
    <?php } ?>
    <input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id'] ?>" name="module_id">
    <input type="hidden" id="current_order" value="<?php echo $key; ?>" name="current_order"> 
    <input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType']; ?>" name='module_type'>

    <div class="row">
      <div class="ss_s_b_main" style="min-height: 100vh">
        <div class="col-sm-4">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <span>
                      <img src="assets/images/icon_draw.png"> Instruction
                    </span> Question
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class=" math_plus" id="quesBody">
                  <?php echo ($question_info_s[0]['questionName']); ?>
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
              <?php $flag = 0;
              if(isset($desired)){
                foreach ($desired as $desired_row) {
                  if(($desired_row['question_order_id'] == $key && $desired_row['ans_is_right'] == 'correct')){
                    $flag = 1;?>
                    <div class=" math_plus" id="quesBody">
                      <?php echo isset($desired_row['student_ans'])?json_decode($desired_row['student_ans']):''; ?>
                    </div>
                  <?php }}}?>

                  <?php if($flag != 1) {?>
                    <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                      <textarea name="answer" class="mytextarea"></textarea>
                    </div>
                  <?php }?>
                </div>
              </div>
              <?php if($flag != 1) {?>
                <div class="text-center">
                  <a class="btn btn_next" id="answer_matching">Submit</a>
                </div>
              <?php }?>


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
                                    <td>
                                      <?php if(isset($desired[$i]['ans_is_right'])){
                                        if($desired[$i]['ans_is_right'] == 'correct'){?>
                                          <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                        <?php } else {?>
                                          <span class="glyphicon glyphicon-remove" style="color: red;"></span>
                                        <?php }}?>
                                      </td>
                                      <td style="<?php if($question_info_s[0]['question_order'] == $ind['question_order']){echo 'background-color: #99D9EA;';}?>">
                                        <?php echo $ind['question_order']; ?>
                                      </td>
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

                  <div class="col-sm-4" id="draggable" style="display: none;">
                    <div class="panel-group" id="waccordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                          <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#waccordion" href="#collapseworkout" aria-expanded="true" aria-controls="collapseworkout">  Workout</a>
                          </h4>
                        </div>
                        <div id="collapseworkout" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <textarea name="workout" class="mytextarea"></textarea>
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


        <div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
              </div>
              <div class="modal-body row">
                <i class="fa fa-pencil" style="font-size:20px;color:#e0ca28; margin-left: 5px;"></i><br>
                <span class="ss_extar_top20">
                  Examiner will scrutinize your answer and get back to you.
                </span>
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
               <i class="fa fa-pencil" style="font-size:20px;color:#e0ca28; margin-left: 5px;"></i><br>
               <span class="ss_extar_top20">
                Examiner will scrutinize your answer and get back to you.
              </span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
            </div>
          </div>
        </div>
      </div>

      <?php $i = 1;
      foreach ($total_question as $ind) { ?>
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
        $('#answer_matching').click(function () {

          var form = $("#answer_form");
          $.ajax({
            type: 'POST',
            url: 'Student/st_answer_workout_quiz',
            data: form.serialize(),
            dataType: 'html',
            success: function (results) {

              if (results == 6) {
                window.location.href = 'show_tutorial_result/'+$("#module_id").val();
              }
              if (results == 3) {
                $('#ss_info_worng').modal('show');
              } if (results == 2) {
                $('#ss_info_sucesss').modal('show');
                $('#get_next_question').click(function () {
                  commonCall();
                });
              }
              if (results == 5) {
                commonCall();
              }
              function commonCall() {
                $question_order = $('#next_question').val();
                $module_id = $('#module_id').val();

                <?php if($tutorial_ans_info){?>
                  window.location.href = 'show_tutorial_result/'+$module_id;
                <?php }?>

                if ($question_order != 0) {
                  window.location.href = 'get_tutor_tutorial_module/' + $module_id + '/' + $question_order;
                }
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

        function takeDecesion() {
          var exact_time = $('#exact_time').val();

          var countDownDate =  $('#exam_end').val();

          var now = $('#now').val();
          var opt = $('#optionalTime').val();
          var h1 = document.getElementsByTagName('h1')[0];  

          var distance = countDownDate - now;  
          var hours = Math.floor(distance/3600);
          var x = distance % 3600;

          var minutes = Math.floor(x/60); 
          var seconds = distance%60;

          var t_h = hours * 60 * 60;
          var t_m = minutes * 60;
          var t_s = seconds;

          var total = parseInt(t_h) + parseInt(t_m) + parseInt(t_s);

          var remaining_time;
          var end_depend_optional = parseInt(exact_time) + parseInt(opt);
          // if(opt > total){
          //   remaining_time = total;
          // } else {  
          //   remaining_time = parseInt(end_depend_optional) - parseInt(now);
          // }

          if(opt > 0){
            remaining_time = parseInt(end_depend_optional) - parseInt(now);
          
          } else {  
            remaining_time = total;
          }

          setInterval(circulate,1000);

          function circulate(){

            remaining_time = remaining_time - 1;

            var v_hours = Math.floor(remaining_time / 3600);
            var remain_seconds = remaining_time - v_hours * 3600;   
            var v_minutes = Math.floor(remain_seconds / 60);
            var v_seconds = remain_seconds - v_minutes * 60;

            if (remaining_time > 0) {
              h1.textContent = v_hours + " : "  + v_minutes + " : " + v_seconds + "  " ;      
            }else{
              var form = $("#answer_form");
              $.ajax({
                type: 'POST',
                url: 'st_answer_matching',
                data: form.serialize(),
                dataType: 'html',
                success: function (results) {
                  window.location.href = 'show_tutorial_result/'+$('#module_id').val();
                }
              });
              h1.textContent = "EXPIRED";
            }
          }

        }

        <?php if ($module_type == 3) { ?>
          takeDecesion();
        <?php }?>

      </script>

      <?php $this->load->view('students/question_module_type_tutorial/drawingBoard'); ?>
