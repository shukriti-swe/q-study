<style>
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
<?php 
    $question_instruct = isset($question_info[0]['question_video']) ? json_decode($question_info[0]['question_video']):'';
?>
<br>
<div class="ss_student_board">
  <div class="ss_s_b_top">
    <div class="ss_index_menu">
      <a href="<?php echo base_url().$userType.'/view_course'; ?>">Question/Module</a>
    </div>
    <div class="col-sm-6 ss_next_pre_top_menu">
        <?php if ($question_info_s[0]['isCalculator']) : ?>
        <input type="hidden" name="" id="scientificCalc">
        <?php endif; ?>

        <a class="btn btn_next" href="question_edit/<?php echo $question_item; ?>/<?php echo $question_id; ?>">
            <i class="fa fa-caret-left" aria-hidden="true"></i> Back
        </a>
        <a class="btn btn_next" href="#">
            <i class="fa fa-caret-right" aria-hidden="true"></i> Next
        </a>
      <!-- <a class="btn btn_next" href="#">Draw <img src="assets/images/icon_draw.png"></a> -->
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="ss_s_b_main" style="min-height: 100vh">
        <div class="col-sm-6">
            <div class="workout_menu">
                <ul>
                    <li><a style="cursor:pointer" id="show_question">Question<i>(Click Here)</i></a></li>
                    <li>
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <span>
                                    <img src="assets/images/icon_draw.png"> Instruction
                                </span>
                        </a>
                    </li>
                </ul>
            </div>

            <div style="display: none;" class="panel-group question_module" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">Question
                            <button type="button" class="woq_close_btn" id="woq_close_btn">&#10006;</button>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class=" math_plus" id="quesBody">
                            <?php echo ($question_info_s[0]['questionName']); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-group answer_module" id="saccordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">   Answer</a>
                        </h4>
                    </div>

                    <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <textarea name="answer" class="mytextarea" id="text_answer"></textarea>
                    </div>

                    <div id="capture" style="padding: 10px; width:300px;text-align:center;position: absolute; left: -2000px;">

                    </div>

                </div>
                <div style="margin-top:20px;" class="text-center">
                    <a class="btn btn_next" id="answer_matching">Submit</a>
                </div>
            </div>

        <input type="hidden" value="<?php echo $question_id; ?>" name="question_id" id="question_id">
      </div>

        <div class="col-sm-2">

        </div>
        
            <div class="col-sm-4">
                <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                          <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  
                            <span>Module Name: Every Sector</span></a>
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
                                          <!-- <th>Obtained</th> -->
                                          <th>Description / Video</th>

                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td>1</td>
                                          <td><?php echo $question_info[0]['questionMarks']; ?></td>
                                          <!-- <td><?php // echo $question_info[0]['questionMarks']; ?></td> -->
                                          <td class="text-center">
                                            <a onclick="showDescription()" style="display: inline-block;">
                                              <img src="assets/images/icon_details.png">
                                            </a>
                                          <?php if (isset($question_instruct[0]) && $question_instruct[0] != null ){ ?>
                                            <a onclick="showQuestionVideo()" class="text-center" style="display: inline-block;"><img src="http://q-study.com/assets/ckeditor/plugins/svideo/icons/svideo.png"></a>
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
          
            <div class="col-sm-4 pull-right" id="draggable" style="display: none;">
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

      <div class="row">
        
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
          <span class="ss_extar_top20"><?php echo $question_info[0]['questionDescription']?></span> 
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

  <!--Solution Modal-->
  <div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Solution</h4>
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

  <script>
    $('#answer_matching').click(function () {
      $('#ss_info_worng').modal('show');
    });

    function showDescription(){
      $('#ss_info_description').modal('show');
    }
    function showQuestionVideo(){
        $('#ss_question_video').modal('show');
    }
  </script>
  <?php $this->load->view('students/question_module_type_tutorial/drawingBoard'); ?>

    <?php $this->load->view('module/preview/drawingBoard'); ?>