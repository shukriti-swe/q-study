<?php 
    // $question_info = $question_info_s[0]['questionName'];
    if (isset($tutorial_ans_info) && !empty($tutorial_ans_info)) {
        $st_ans = json_decode($tutorial_ans_info[0]['st_ans'],TRUE);
        $question_order = $question_info_s[0]['question_order'];
    }
   // echo '<pre>';print_r($tutorial_ans_info);
   // echo '<pre>';print_r($st_ans[$question_order]['student_ans']);
   // die();
?>
<?php if (isset($tutorial_ans_info) && empty($tutorial_ans_info)): ?>
    <div class="alert alert-primary" role="alert" style="background: gainsboro;">
      Student Data Is Not Available!
    </div>
<?php endif ?>
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
                        <?php echo $question_info['questionName']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-4" style="text-align: center">
    <div class="row">
        <div class="col-xs-3">
            <?php foreach ($question_info['factor1'] as $factor1) { ?>
                <div class="form-group" style="font-size: 30px;">
                    <?php echo $factor1; ?>
                </div>
            <?php } ?>
        </div>
        <div class="col-xs-2">
            <span style="font-size: 30px;">X</span>
        </div>
        <div class="col-xs-3">
            <?php foreach ($question_info['factor2'] as $factor2) { ?>
                <div class="form-group" style="font-size: 30px;">
                    <?php echo $factor2; ?>
                </div>
            <?php } ?>
        </div>
        <div class="col-xs-1">
            <span style="font-size: 30px;">=</span>
        </div>
        <div class="col-xs-3">
            <?php if (isset($tutorial_ans_info) && !empty($tutorial_ans_info)): ?>
                <?php foreach ($st_ans[$question_order]['student_ans'] as $result) { ?>
                    <div class="form-group" style="font-size: 30px;">
                        <?php echo $result; ?>
                    </div>
                <?php } ?>
                
            <?php endif ?>
            <!-- <?php foreach (json_decode($st_ans[$question_order]['student_ans']) as $result) { ?>
                <div class="form-group" style="font-size: 30px;">
                    <?php echo $result; ?>
                </div>
            <?php } ?> -->
        </div>
    </div>
</div>


