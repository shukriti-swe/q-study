<?php 
    $question_info = $question_info_s[0]['questionName'];
    $st_ans = json_decode($tutorial_ans_info[0]['st_ans'],TRUE);
    $question_order = $question_info_s[0]['question_order'];
//    echo '<pre>';print_r($question_info);die;
?>

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
                        <?php echo json_decode($st_ans[$question_order]['student_ans']);?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


