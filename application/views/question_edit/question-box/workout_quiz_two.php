<style>
    .ss_lette {
        min-height: 158px;
        line-height: 158px;
    }
</style>
<div class="workout_menu">
    <ul>
	   <li>
            <a style="padding: 10px;cursor: pointer;">
                <span  id="show_answer_box">
                     Solution
                </span>
            </a>
        </li>
        <li><a style="cursor:pointer" id="show_question">Question<i>(Click Here)</i></a></li>

        <li>
            <div class="form-group ss_h_mi">
                <label for="exampleInputiamges1">How many</label>

                <div class="select">
                    <input class="form-control" type="number" value="<?php echo sizeof($question_info_ind->vocubulary_image); ?>" id="box_qty" onclick="getImageBox(this)">
                </div>
            </div>
        </li>
        <li>
            <!--<input class="form-control" type="text" name="question_hint" style="width:300px!important;" value="<?php echo $question_info_ind->question_hint?>">-->
           
            <a style="padding: 10px;cursor: pointer;">
                <span  id="show_inside_question_box">
                     Inside Question
                </span>
            </a>
        </li>

    </ul>
</div>

<input type="hidden" name="questionType" value="15">
<div id="answer_box" class="col-sm-6" style="position: absolute;left: 20%;z-index: 3;display: none">
    <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">   </a>
                    <button type="button" class="woq_close_btn" id="woq_close_btn">&#10006;</button>
                </h4>
            </div>

            <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <textarea name="solution" class="mytextarea"><?php echo $question_info_ind->solution?></textarea>
            </div>

        </div>
    </div>
</div>

<div id="inside_question_box" class="col-sm-6" style="position: absolute;left: 20%;z-index: 3;display: none">
    <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">   </a>
                    <button type="button" class="close_inside_question_box" id="close_inside_question_box">&#10006;</button>
                </h4>
            </div>

            <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <textarea name="question_hint" class="mytextarea"><?php echo $question_info_ind->question_hint?></textarea>
            </div>

        </div>
    </div>
</div>
<div id="question_box" class="col-sm-6" style="position: absolute;left: 6%;z-index: 3;display: none">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" aria-expanded="true" aria-controls="collapseOne">
                        Question
                        <button type="button" class="woq_close_btn" id="wotwoq_close_btn">&#10006;</button>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <textarea class="mytextarea" id="" name="questionName"><?php echo $question_info_ind->questionName; ?></textarea>
            </div>
        </div>
    </div>
</div>



<div class="col-sm-8">
    <div class="text-right ">

    </div>

    <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">

            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body ss_imag_add_right">
				<input type="hidden" name="response_answer" value="0">
                    <?php
                    $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
                    ?>
                    <?php $i = 1;
                    foreach ($question_info_ind->vocubulary_image as $row) { ?>
                        <div class="row editor_hide" id="list_box_<?php echo $i; ?>" style="display:none; margin-bottom:5px">
                            <div class="col-xs-1">
                                <p class="ss_lette" style="min-height: 136px; line-height: 137px;width:40px;"><?php echo $lettry_array[$i - 1]; ?></p>
                            </div>
                            <div class="col-xs-9">
                                <div class="box">
                                    <textarea class="form-control mytextarea" name="vocubulary_image_<?php echo $i; ?>[]"> <?php echo $row[0]; ?></textarea>
                                </div>
                            </div>

                            <div class="col-xs-2" style="justify-content: center;min-height: 158px;display: flex;align-items: center;padding-right: 0px;padding-left: 0px;">
                                <p>
<!--                                    <input style="width: 45px;border:2px solid #ccc;" type="number" name="percentage_--><?php //echo $i?><!--" value="">-->
                                    <?php
                                    $aaa = 'percentage_'.$i;
                                    if (isset($question_info_ind->percentage_array->$aaa))
                                    {
                                        $percentValue = $question_info_ind->percentage_array->$aaa;
                                    }
                                    ?>
                                    <select class="form-control form-control-sm" name="percentage_<?php echo $i?>">
                                        <option <?= (isset($percentValue) && $percentValue == '0' ? 'selected' : '')?> value="0">0%</option>
                                        <option <?= (isset($percentValue) && $percentValue == '25' ? 'selected' : '')?> value="25">25%</option>
                                        <option <?= (isset($percentValue) && $percentValue == '50' ? 'selected' : '')?> value="50">50%</option>
                                        <option <?= (isset($percentValue) && $percentValue == '100' ? 'selected' : '')?> value="100">100%</option>
                                    </select>
                                </p>
                            </div>
                        </div>

                        <?php $i++;
                    } ?>
                    <?php
                    $counter = sizeof($question_info_ind->vocubulary_image);
                    $desired_i = $counter + 1;
                    ?>
                    <?php for ($desired_i; $desired_i <= 20; $desired_i++) { ?>
                        <div class="row editor_hide" id="list_box_<?php echo $desired_i; ?>" style="display:none; margin-bottom:5px">
                            <div class="col-xs-1">
                                <p class="ss_lette" style="min-height: 136px; line-height: 137px;width: 40px;">
                                    <?php echo $lettry_array[$desired_i - 1]; ?>
                                </p>
                            </div>
                            <div class="col-xs-9">
                                <div class="box">
                                    <textarea class="form-control mytextarea" name="vocubulary_image_<?php echo $desired_i; ?>[]"></textarea>
                                </div>
                            </div>

                            <div class="col-xs-2" style="justify-content: center;min-height: 158px;display: flex;align-items: center;padding-left: 0px;padding-right: 0px;">
                                <p>
                                    <select class="form-control form-control-sm" name="percentage_<?php echo $desired_i?>">
                                        <option  value="0">0%</option>
                                        <option  value="25">25%</option>
                                        <option  value="50">50%</option>
                                        <option  value="100">100%</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>


    </div>
</div>

<input type="hidden" name="image_quantity" id="image_quantity" value="">

<script>

    var qtye = $("#box_qty").val();
    document.getElementById("image_quantity").value = qtye;

    common(qtye);
    function getImageBox() {
        var qty = $("#box_qty").val();
        if (qty < 3) {
            $("#box_qty").val(2);
        } else if (qty > 20) {
            $("#box_qty").val(20);
        } else {
            $('.editor_hide').hide();
            document.getElementById("image_quantity").value = qty;
            common(qty);
        }

    }
    function common(quantity)
    {
        for (var i = 1; i <= quantity; i++)
        {
            $('#list_box_' + i).show();
        }
    }
</script>
<script>
     $("#show_answer_box").click(function () {
         $("#answer_box").show();
     });
     $("#woq_close_btn").click(function () {
         $("#answer_box").hide();
     });
    $("#show_question").click(function () {
        $("#question_box").show();
    });
    $("#wotwoq_close_btn").click(function () {
        $("#question_box").hide();
    });
    
    
     $("#show_inside_question_box").click(function () {
         $("#inside_question_box").show();
     });
     $("#close_inside_question_box").click(function () {
         $("#inside_question_box").hide();
     });
    
</script>