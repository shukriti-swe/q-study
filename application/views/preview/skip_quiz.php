<?php
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



<?php 
    $question_instruct = isset($question_info_s[0]['question_video']) ? json_decode($question_info_s[0]['question_video']):'';
?>

<style type="text/css">
  .sk_out_box{
    display: flex;
  }
  .sk_inner_box{
    padding: 2px 5px;
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
</style>
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
            <a class="btn btn_next" href="#">Draw <img src="<?php echo base_url();?>assets/images/icon_draw.png"></a>
        </div>
    </div>

  <div class="container-fluid">
    <div class="row">
      <div class="ss_s_b_main" style="min-height: 100vh">
        <div class="col-sm-8">
              <div class="workout_menu" style="margin-bottom: 30px;">
                  <ul>
                      <li>
                          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_draw.png"> Instruction</span></a>
                      </li>
                      <?php if ($question_time_in_second != 0) { ?>

                        <li><div class="ss_timer" id="demo"><h1>00:00:00 </h1></div></li>

                      <?php }?>
                      <li style="margin-left:3px;"><a style="cursor:pointer" id="show_question">Question<i>(Click Here)</i></a></li>
                      <?php if ($question_info_s[0]['isCalculator']) : ?>
                        <li><input type="hidden" name="" id="scientificCalc"></li>
                      <?php endif; ?>
                  </ul>
              </div>
              <div class="col-sm-8 question_module" style="display: none;">
                  <div class="col-sm-8">
                      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                          <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingOne">
                                  <h4 class="panel-title">
                                      Question
                                      <button type="button" class="woq_close_btn" id="woq_close_btn">&#10006;</button>
                                  </h4>
                              </div>
                              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                  <div class="panel-body">
                                      <textarea disabled class="mytextarea"><?php echo $questionBody;?></textarea>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-4"></div>
              </div>
              <div class="col-sm-8 answer_module" style="padding: 0px;">
                  <form id="answer_form">
                      <div style="margin: 20px 0px;overflow: hidden;">
                              <?php echo $skp_box; ?>
                      </div>
                      <input type="hidden" value="<?php echo $question_id;?>" name="questionId" id="question_id">
                  </form>
                  <div class="text-center">
                      <a class="btn btn_next" id="answer_matching">Submit</a>
                  </div>
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

                                <th>SL</th>
                                <th>Mark</th>

                                <th>Description / Video</th>

                              </tr>
                            </thead>
                            <tbody>
                              <tr>

                                <td>1</td>
                                <td><?php echo $question_info_s[0]['questionMarks']; ?></td>
                                <!-- <td><?php //echo $question_info_s[0]['questionMarks']; ?></td> -->
                                <td>
                                  <a onclick="showDescription()" style="display: inline-block;">
                                    <img src="assets/images/icon_details.png">
                                  </a>
                                  <?php if(isset($question_instruct[0]) && $question_instruct[0] != null ){ ?>
                                    <a onclick="showQuestionVideo()" class="text-center" style="display: inline-block;"><img src="http://qstudy.test/assets/ckeditor/plugins/svideo/icons/svideo.png"></a>
                                  <?php } ?>
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
        <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

      </div>
    </div>
  </div>
</div>

<!--Success Modal-->
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

<!--Times Up Modal-->
<div class="modal fade ss_modal" id="times_up_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Times Up</h4>
            </div>
            <div class="modal-body row">
                <i class="fa fa-close" style="font-size:20px;color:red"></i> 
                <!--<span class="ss_extar_top20">Your answer is wrong</span>-->
                <br><?php echo $question_info_s[0]['question_solution']?>
            </div>
            <div class="modal-footer">
                <button type="button" id="question_reload" class="btn btn_blue" data-dismiss="modal">close</button>         
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
                    clearInterval(clear_interval);
                    $('#ss_info_sucesss').modal('show');
                } else if(results == 3) {
                    $('#ss_info_worng').modal('show');      
                }
            }
        });

    });
    
    function getLetter(letter)
    {
      var val = document.getElementById('exampleInputl1').value;
      var total = val + letter;
      $('#exampleInputl1').val(total);
    }
    function delLetter(){
      var val = document.getElementById('exampleInputl1').value;
      var sillyString = val.slice(0, -1);
      $('#exampleInputl1').val(sillyString);
    }
    
    function showAudio(){
      $("audio").show();
    }
    
    function showDescription(){
      $('#ss_info_description').modal('show');
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
                url: 'Tutor/checkSkpboxAnswer',
                data: form.serialize(),
                dataType: 'html',
                success: function (results) {
                    if(results == 1) {
                        $('#times_up_message').modal('show');
                        $('#question_reload').click(function () {
                            location.reload(); 
                        });
                    } else if(results == 3) {
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
