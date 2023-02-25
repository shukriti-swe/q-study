<style>
    .ss_lette {
        min-height: 137px;
        line-height: 137px;
    }

    .image_box_list_2 {
	    overflow: hidden;
	}
</style>

<div class="col-sm-4">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" aria-expanded="true" aria-controls="collapseOne">
                        <span onclick="setSolution()">
                            <img src="assets/images/icon_solution.png"> Solution
                        </span> Question
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <textarea class="mytextarea" name="questionName"><?php echo $question_info_ind->questionName; ?></textarea>
            </div>
        </div>
    </div>
</div>


<div class="col-sm-4">
    <div class="text-right ">
        <div class="form-group ss_h_mi">
            <label for="exampleInputiamges1">How many images</label>

            <div class="select">
                <input class="form-control" type="number" value="4" id="box_qty" onclick="getImageBox(this)">
            </div>
        </div>
    </div>

    <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">

            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body ss_imag_add_right">

                    <div class="image_box_list_2 ss_m_qu">
                        <?php
                        $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
                        ?>
                        <?php $i = 1;
                        $question_ans = json_decode($question_info[0]['answer']);
//                        echo '<pre>';print_r($question_ans);
                        foreach ($question_info_ind->vocubulary_image as $row) {
                            ?>

                            <div class="row editor_hide" id="list_box_<?php echo $i; ?>" style="display:none; margin-bottom:5px">
                                <div class="col-xs-2">
                                    <p class="ss_lette"><?php echo $lettry_array[$i - 1]; ?></p>
                                </div>
                                <div class="col-xs-9">
                                    <div class="box">
                                        <textarea class="form-control mytextarea" name="vocubulary_image_<?php echo $i; ?>[]"> <?php echo $row[0]; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-1">							
                                    <p class="ss_lette">
                                        <input type="checkbox" name="response_answer[]" value="<?php echo $i; ?>" <?php foreach ($question_ans as $ans) {if($ans == $i){echo 'checked'; }} ?> style="min-height: 134px;" >
                                    </p>
                                </div>							
                            </div>

                            <?php $i++;
                        }
                        ?>
                        <?php
                        $counter = sizeof($question_info_ind->vocubulary_image);
                        $desired_i = $counter + 1;
                        ?>
                        <?php for ($desired_i; $desired_i <= 20; $desired_i++) { ?>					
                            <div class="row editor_hide" id="list_box_<?php echo $desired_i; ?>" style="display:none; margin-bottom:5px">
                                <div class="col-xs-2">
                                    <p class="ss_lette">
                                        <?php echo $lettry_array[$desired_i - 1]; ?>
                                    </p>
                                </div>
                                <div class="col-xs-9">
                                    <div class="box">
                                        <textarea class="form-control mytextarea" name="vocubulary_image_<?php echo $i; ?>[]"></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-1">							
                                    <p class="ss_lette">
                                        <input type="checkbox" name="response_answer[]" value="<?php echo $desired_i; ?>" style="min-height: 134px;">
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
    common(qtye)
    function getImageBox() {
        var qty = $("#box_qty").val();
        if (qty < 4) {
            $("#box_qty").val(4);
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