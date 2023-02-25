<?php 
    $question_info = json_decode($question_info_s[0]['questionName']);
    $st_ans = json_decode($tutorial_ans_info[0]['st_ans'],TRUE);
    $question_order = $question_info_s[0]['question_order'];
//    echo '<pre>';print_r($st_ans);die;
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
                    <div class=" math_plus">
                        <?php echo $question_info->questionName; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-4">
<!--    <div class="text-right ">
        <div class="form-group ss_h_mi">
            <label for="exampleInputiamges1">How many images</label>

            <div class="select">
                <input class="form-control" type="number" value="4" id="box_qty" onclick="getImageBox(this)">
            </div>
        </div>
    </div>-->
    
    <?php
        $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
        $st_response = json_decode($st_ans[$question_order]['student_ans']);
    ?>
    
    <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">

            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body ss_imag_add_right">

                    <div class="image_box_list ss_m_qu">
                       
                        <?php $i = 1;
                            foreach ($question_info->vocubulary_image as $row) { ?>
                            <div class="row">
                                <div class="col-xs-2">
                                    <p class="ss_lette"><?php echo $lettry_array[$i - 1]; ?></p>
                                </div>
                                <div class="col-xs-9">
                                    <div class="box ">
                                        <div class="ss_w_box text-center">
                                            <?php echo $row[0]; ?>
                                        </div>                                                   
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <p class="ss_lette">
                                        <input type="checkbox" name="answer_reply[]" value="<?php echo $i;?>" 
                                             <?php foreach ($st_response as $response){if($response == $i){echo 'checked';}}?>  style="min-height: 97px;">
                                    </p>
                                </div>
                            </div>
                        <?php $i++; } ?>

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