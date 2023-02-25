<style>
    .ss_lette {
        min-height: 158px;
        line-height: 158px;
    }
</style>


<input type="hidden" name="questionType" value="13">
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
                <textarea class="mytextarea" id="" name="questionName"></textarea>
            </div>
        </div>
    </div>
</div>



<div class="col-sm-4">
    <div class="text-right ">
        <div class="form-group ss_h_mi">
            <label for="exampleInputiamges1">How many images</label>

            <div class="select">
                <input class="form-control" type="number" value="2" id="box_qty" onclick="getImageBox(this)">
            </div>
        </div>
    </div>
    
    <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">

            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body ss_imag_add_right">

                    <div class="image_box_list ss_m_qu">
                       
                        <?php
                        $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
                        for ($i = 1; $i <= 2; $i++) { ?>
                        <div class="row editor_hide" id="list_box_<?php echo $i;?>" style="">
                            <div class="col-xs-2">
                                <p class="ss_lette"><?php echo $lettry_array[$i - 1]; ?></p>
                            </div>
                            <div class="col-xs-9">
                                <div class="box">
                                    <textarea class="form-control mytextarea" name="vocubulary_image_<?php echo $i?>[]"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <p class="ss_lette">
                                    <input type="radio" name="response_answer" value="<?php echo $i;?>" style="min-height: 158px;">
                                </p>
                            </div>
                        </div>
                        <?php }?>
                    
                    <?php for ($desired_i = $i; $desired_i <= 20; $desired_i++) { ?>
                    <div class="row editor_hide" id="list_box_<?php echo $desired_i?>" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette"><?php echo $lettry_array[$desired_i]; ?></p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control mytextarea" name="vocubulary_image_<?php echo $desired_i?>[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">  
                            <p class="ss_lette">
                                <input type="radio" name="response_answer" value="<?php echo $desired_i?>" style="min-height: 158px;">
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
        if (qty < 2) {
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
        console.log('q:'+quantity);
        for (var i = 1; i <= quantity; i++)
        {
            $('#list_box_' + i).show();
        }
    }
</script>
