<?php
    $question_info = json_decode($question_info_s[0]['questionName']);
    $st_ans = isset($tutorial_ans_info[0]['st_ans'])?json_decode($tutorial_ans_info[0]['st_ans'], true) : [];


    $question_order = $question_info_s[0]['question_order'];


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
                    <div class="image_q_list" style="font-size: 13px;">
                    <!--  <form class="form-horizontal ss_image_add_form"> -->
                        <div class="row">
                            <div class="col-xs-5">Word</div>
                            <div class="col-xs-1">: </div>
                            <div class="col-xs-5">?</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-5">Definition</div>
                            <div class="col-xs-1">: </div>
                            <div class="col-xs-5"> <?php echo $question_info->definition; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-5">Parts of speech</div>
                            <div class="col-xs-1">: </div>
                            <div class="col-xs-5"><?php echo $question_info->parts_of_speech; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-5">Synonym </div>
                            <div class="col-xs-1">: </div>
                            <div class="col-xs-5"><?php echo $question_info->synonym; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-5">Antonym</div>
                            <div class="col-xs-1">: </div>
                            <div class="col-xs-5"><?php echo $question_info->antonym; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-5">Your Sentence</div>
                            <div class="col-xs-1">: </div>
                            <div class="col-xs-5"><?php echo $question_info->sentence; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-5">Near Antonym</div>
                            <div class="col-xs-1">: </div>
                            <div class="col-xs-5"><?php echo $question_info->near_antonym; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-5">Audio File</div>
                            <?php if (isset($question_info->audioFile) && file_exists($question_info->audioFile)) : ?>
                                <div class="col-xs-2" onclick="showAudio()" style="font-size: 18px; padding-right:0px">
                                    <i class="fa fa-volume-up"></i>
                                    <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                                </div>
                                <div class="col-xs-5" style="padding-left:0px;">
                                    <small  style="font-size:10px !important;color:red; float:left;">Listening to audio will deduct 1 number</small>
                                </div>
                            <?php endif; ?>
                        </div>
<!--                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Video file</label>
                            <div class="col-sm-8">
                                <input type="file" id="exampleInputFilevideo" name="videoFile">
                            </div>
                        </div>-->
                    </div>
                    <!--  </form> -->
                </div>
            </div>
        </div>
        
        <audio controls style="display: none;">
            <source src="<?php if (isset($question_info->audioFile)) {
                echo $question_info->audioFile;
        } ?>" type="audio/ogg">
            <source src="<?php if (isset($question_info->audioFile)) {
                echo $question_info->audioFile;
        } ?>" type="audio/mpeg">
            <source src="<?php if (isset($question_info->audioFile)) {
                echo $question_info->audioFile;
        } ?>" type="audio/webm">
            <source src="<?php if (isset($question_info->audioFile)) {
                echo $question_info->audioFile;
        } ?>" type="audio/wav">
            <source src="<?php if (isset($question_info->audioFile)) {
                echo $question_info->audioFile;
        } ?>" type="audio/flac">
        </audio>

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
                    <div class="image_box_list_result result">
                        <form id="answer_form">
                            <div class="image_box_list" style="overflow: visible;">
                                <div class="row">
                                    <div class="">
                                        <div class="">
                                            <?php foreach ($question_info->vocubulary_image as $row) { ?>
                                                <div class="result_board">
                                                    <?php echo $row[0] ?>
                                                </div>
                                                <br/>
                                            <?php } ?>
                                            <div class="form-group" style="padding: 0px 12px;">
                                                <input type="text" readonly class="form-control" name="answer" value="<?php echo isset($st_ans[$question_order]['student_ans']) ? ($st_ans[$question_order]['student_ans']):'';?>">
                                            </div>
                                        </div>
<!--                                        <div class="letter_box" style="padding: 10px 12px;">
                                            <ul>
                                                <?php foreach (range('A', 'Z') as $char) { ?>
                                                    <li> <a onclick="getLetter('<?php echo $char; ?>')" data-id="<?php echo $char; ?>"><?php echo $char; ?></a> </li>
                                                <?php } ?>
                                                <li> 
                                                    <a onclick="delLetter();"><img src="assets/images/icon_l_d.png"></a> 
                                                </li>
                                            </ul>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
<!--                            <div class="text-center">
                                <a  class="btn btn_next"  id="answer_matching">Submit</a>
                            </div>-->
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<script>


    var qtye = $("#box_qty").val();
//    alert(qtye);
    document.getElementById("image_quantity").value = qtye;
    common(qtye);
    function getImageBox() {
        var qty = $("#box_qty").val();
        if (qty < 1) {
            $("#box_qty").val(1);
        } else if (qty > 20) {
            $("#box_qty").val(20);
        } else {
            $('.editor_hide').hide();
            document.getElementById("image_quantity").value = qty;
            common(qty);
        }

    }
    
    function common(quantity) {
        for (var i = 1; i <= quantity; i++)
        {
            $('#list_box_' + i).show();
        }
    }
    
    function showAudio() {
        $("audio").show();
    }
</script>

