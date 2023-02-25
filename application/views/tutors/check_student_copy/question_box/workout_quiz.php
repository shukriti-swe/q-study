<?php
	$question_info = $question_info_s[0]['questionName'];
	$st_ans = json_decode($tutorial_ans_info[0]['st_ans'], true);
	$question_order = $question_info_s[0]['question_order'];
	$workoutImage = $st_ans[$question_order]['workout'];
	$userType = $_SESSION['userType'];

	$questionId = $question_info_s[0]['question_id'];
	$stAnsId = $tutorial_ans_info[0]['id'];

	if ($userType==6) {
		//$strutinizeData = $this->Admin_model->search('scrutinize_report', ['ans_id'=>$stAnsId, 'question_id'=>$questionId]); //noshto noshto
		
		//$strutinizeData = $strutinizeData[0]['data'];
		//$strutinizeData = json_decode($strutinizeData);
		//$strutinizeImg = $strutinizeData->scrutinize_image;
		$strutinizeImg ='';
	}

?>
<div id="workoutImage" style="display:none;">
    <?php if ($userType==6) : ?>
      <p><img src="<?php echo $strutinizeImg ?>" alt="no image"></p>
    <?php else : ?>
        <?php print_r(json_decode($st_ans[$question_order]['student_ans'])); ?>
    <?php endif ?>
</div>
<input type="hidden" id="answerId" value="<?php echo $stAnsId; ?>">
<input type="hidden" id="questionId" value="<?php echo $questionId; ?>">
<input type="hidden" id="userType" value="<?php echo $userType; ?>">
<input type="hidden" id="workout_question_order_id" value="<?php echo @$workout_question_order_id; ?>">

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
            <?php echo $question_info; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="" id="draggable" style="display: none;">
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
<div class="col-sm-4">
  <!-- <strong class="text-center">
    <a href="javascript:void(0)" style="text-decoration: underline;padding:10px;" onclick="test()">Workout</a>
  </strong> -->
 

    <form id="std_update_progress_form">
<!--        <input type="hidden" id="answerId" value="--><?php //echo $stAnsId; ?><!--">-->
        <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">   Answer</a>
                    </h4>
                </div>

                <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

                    <textarea name="answer" class="mytextarea" id="text_answer"><?php echo($st_ans[$question_order]['student_ans']); ?></textarea>
                </div>

            </div>
        </div>
			<?php if($_SESSION['userType'] !=6){?>
        <div class="text-center">
            <a class="btn btn_next" id="update_progress_answer">Save</a>
        </div>
		<?php }?>
    </form>
</div>

<!-- <div class="col-sm-4" style="display: none;">
  <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
          <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">   Answer</a>
        </h4>
      </div>
      <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body" id="quesBody">
          <div class="math_plus">
            <?php echo json_decode($st_ans[$question_order]['student_ans']);?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>-->

<script>
    $("#update_progress_answer").click(function () {

        var ans_id = $('#answerId').val();
        var text_answer = $('#text_answer').val();
        var workout_question_order_id = $('#workout_question_order_id').val();
        console.log(ans_id);
        console.log(text_answer);
        $.ajax({
            type: 'POST',
            url: 'Student_Copy/st_progress_update_answer_workout_quiz',
            data: {ans_id:ans_id,text_answer:text_answer,workout_question_order_id:workout_question_order_id},
            success: function (results) {
                var obj = JSON.parse(results);
                alert(obj.msg);
                //window.location.href = "check_student_copy/<?//=$question_info_s[0]['module_id']?>///<?//=$user_info[0]['id']?>///<?//=$ind['question_order']?>//";
            }
        });
    });
</script>
