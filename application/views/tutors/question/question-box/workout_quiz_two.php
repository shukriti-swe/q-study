<style>
    .ss_lette {
        min-height: 158px;
        line-height: 158px;
    }
</style>
<div class="workout_menu" style="margin: 0px 15px;">
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
                    <input class="form-control" type="number" value="2" id="box_qty" onclick="getImageBox(this)">
                </div>
            </div>
        </li>
        <li>
            <!--<input class="form-control" type="text" name="question_hint" style="width:300px!important;" value="Read the options & chose the appropriate percentage.">-->
            
            <a style="padding: 10px;cursor: pointer;">
                <span  id="show_inside_question_box">
                     Inside Question
                </span>
            </a>
        </li>

    </ul>
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
                <textarea name="question_hint" class="mytextarea">Read the options & chose the appropriate percentage.</textarea>
            </div>

        </div>
    </div>
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
                <textarea name="solution" class="mytextarea"></textarea>
            </div>

        </div>
    </div>
</div>

<div id="question_box" class="col-sm-6" style="position: absolute;left: 6%;z-index: 3;">
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
                <textarea class="mytextarea" id="" name="questionName"></textarea>
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
				<input type="hidden" name="answer" value="0">
                    <div class="image_box_list ss_m_qu">

                        <?php
                        $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
                        for ($i = 1; $i <= 2; $i++) { ?>
                            <div class="row editor_hide" id="list_box_<?php echo $i;?>" style="">
                                <div class="col-xs-1">
                                    <p class="ss_lette" style="width: 40px;"><?php echo $lettry_array[$i - 1]; ?></p>
                                </div>
                                <div class="col-xs-9">
                                    <div class="box">
                                        <textarea class="form-control mytextarea" name="vocubulary_image_<?php echo $i?>[]"></textarea>
                                    </div>
                                </div>
<!--                                <div class="col-xs-1">-->
<!--                                    <p class="ss_lette">-->
<!--                                        <input type="radio" name="answer" value="--><?php //echo $i;?><!--" style="min-height: 158px;">-->
<!--                                    </p>-->
<!--                                </div>-->
                                <div class="col-xs-2" style="justify-content: center;min-height: 158px;display: flex;align-items: center;">
                                    <p>
<!--                                        <input style="width: 45px;border:2px solid #ccc;" type="number" name="percentage_--><?php //echo $i?><!--" value="">-->
                                        <select class="form-control form-control-sm" name="percentage_<?php echo $i?>">
                                            <option value="0">0%</option>
                                            <option value="25">25%</option>
                                            <option value="50">50%</option>
                                            <option value="100">100%</option>
                                        </select>
                                    </p>
                                </div>
                            </div>
                        <?php }?>

                        <?php for ($desired_i = $i; $desired_i <= 20; $desired_i++) { ?>
                            <div class="row editor_hide" id="list_box_<?php echo $desired_i?>" style="display:none;">
                                <div class="col-xs-1">
                                    <p class="ss_lette"><?php echo $lettry_array[$desired_i -1]; ?></p>
                                </div>
                                <div class="col-xs-9">
                                    <div class="box">
                                        <textarea class="form-control mytextarea" name="vocubulary_image_<?php echo $desired_i?>[]"></textarea>
                                    </div>
                                </div>
<!--                                <div class="col-xs-1">-->
<!--                                    <p class="ss_lette">-->
<!--                                        <input type="radio" name="answer" value="--><?php //echo $desired_i?><!--" style="min-height: 158px;">-->
<!--                                    </p>-->
<!--                                </div>-->
                                <div class="col-xs-2" style="justify-content: center;min-height: 158px;display: flex;align-items: center;">
                                    <p>
<!--                                        <input style="width: 45px;border:2px solid #ccc;" type="number" name="percentage_--><?php //echo $desired_i?><!--" value="">-->
                                        <select class="form-control form-control-sm" name="percentage_<?php echo $desired_i?>">
                                            <option value="0">0%</option>
                                            <option value="25">25%</option>
                                            <option value="50">50%</option>
                                            <option value="100">100%</option>
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