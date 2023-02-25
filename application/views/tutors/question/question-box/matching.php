<style>
    .form-control {
        width: 100% !important;
    }
    .ss_lette{
        min-height: 138px !important;
        line-height: 138px !important;
    }
</style>

<div class="col-md-12"> 
    <div class="text-center">
        <div class="form-group ss_h_mi" style="margin-bottom: 10px">
        
            <a role="button" aria-expanded="true" aria-controls="collapseOne" style="float: left;">
                <span onclick="setSolution()">
                    <img src="assets/images/icon_solution.png"> Solution
                </span> Question
            </a>
            
            <label for="exampleInputiamges1">Question</label>
            <div class="select">
                <input class="form-control" type="text" value="" name="questionName">
            </div>
            
            <label for="exampleInputiamges1">How many images</label>
            <div class="select">
                <input class="form-control" type="number" value="4" id="box_qty" onclick="getImageBox(this)">
            </div>

        </div>
    </div>
</div>

<!--<div class="col-sm-4">
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
                <textarea class="mytextarea" name="questionName"></textarea>
            </div>
        </div>
    </div>
</div>-->

<div class="col-sm-4">  
    <div class="image_box_list ss_m_qu">
        
        <?php for ($i = 1; $i <= 4; $i++) {?>
        <div class="row editor_hide" id="list_box_1_<?php echo $i;?>" style="display:none;">                    
            <div class="col-xs-2">
                <p class="ss_lette"><?php echo $i;?></p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="mytextarea" name="match_image_1_<?php echo $i;?>[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_<?php echo $i;?>">
                    <input type="radio" id='left_side_1' name="left_side_<?php echo $i;?>" value="<?php echo $i;?>" data-id="<?php echo $i;?>" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>
        <?php }?>
        <?php for ($desired_i = $i; $desired_i <= 20; $desired_i++) { ?>
            <div class="row editor_hide" id="list_box_1_<?php echo $desired_i;?>" style="display:none;">                    
                <div class="col-xs-2">
                    <p class="ss_lette"><?php echo $desired_i;?></p>
                </div>
                <div class="col-xs-9">
                    <div class=" ">
                        <div class="text-center">
                            <textarea class="mytextarea" name="match_image_1_<?php echo $desired_i;?>[]"></textarea>
                        </div>

                    </div>
                </div>

                <div class="col-xs-1">
                    <p class="ss_lette" id="color_left_side_<?php echo $desired_i;?>">
                        <input type="radio" id='left_side_<?php echo $desired_i;?>' name="left_side_<?php echo $desired_i;?>" value="<?php echo $desired_i;?>" data-id="<?php echo $desired_i;?>" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                    </p>
                </div>
            </div>
        <?php }?>
        
    </div> 
</div>
<div class="col-sm-4">  
    <div class="image_box_list ss_m_qu">
        <?php for ($i = 1; $i <= 4; $i++) {?>
        <div class="row editor_hide" id="list_box_2_<?php echo $i;?>" style="display:none;">                    
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_<?php echo $i;?>">
                    <input type="radio" name="right_side_<?php echo $i;?>"  value="<?php echo $i;?>" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="mytextarea" name="match_image_2_<?php echo $i;?>[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" class="form-control" name="answer_<?php echo $i;?>" id="answer_<?php echo $i;?>" data="<?php echo $i;?>" onclick="getAnswer();">
                </p>
            </div>
        </div>
        <?php }?>
        <?php for ($desired_i = $i; $desired_i <= 20; $desired_i++) { ?>
        <div class="row editor_hide" id="list_box_2_<?php echo $desired_i;?>" style="display:none;">                    
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_<?php echo $desired_i;?>">
                    <input type="radio" name="right_side_<?php echo $desired_i;?>"  value="<?php echo $desired_i;?>" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="mytextarea" name="match_image_2_<?php echo $desired_i;?>[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" class="form-control" name="answer_<?php echo $desired_i;?>" id="answer_<?php echo $desired_i;?>" data="<?php echo $desired_i;?>" onclick="getAnswer();">
                </p>
            </div>
        </div>
        <?php }?>
        

    </div> 
</div>
<input type="hidden" name="image_quantity" id="image_quantity" value="">
<script>
    $('.right').attr('disabled', true);
    var left_arr = new Array();
    var right_arr = new Array();
    var color_array = new Array('red', 'green', 'blue', '#00BFFF', '#FF6347', '#708090', '#2F4F4F', '#C71585', '#8B0000', '#808000', '#FF6347', '#FF4500', '#FFD700', '#FFA500', '#228B22', '#808000', '#00FFFF', '#66CDAA', '#7B68EE', '#FF69B4');
    function getLeftVal(e)
    {
        var left_ans_val = e.value;

        left_arr.push(left_ans_val);
        /*if(left_arr.length == 0)
         {
         left_arr.push(left_ans_val);
         //$('.right').attr('disabled', false);
         $('.left').attr('disabled', true);
         }else
         {
         var temp = 0;
         for(var i = 0; i < left_arr.length; i++) 
         {
         
         if(left_arr[i] === left_ans_val)
         {
         temp = 1;
         }
         }
         if(temp == 0)
         {
         left_arr.push(left_ans_val);
         //$('.right').attr('disabled', false);
         $('.left').attr('disabled', true);
         }
         }*/
        $('.right').attr('disabled', false);
        $('.left').attr('disabled', true);
        //var last = left_arr.slice(-1)[0];
        var color_left = color_array[left_ans_val - 1];
        //document.getElementById("color_left_side_1").style.backgroundColor = color_left;
        document.getElementById("color_left_side_" + left_ans_val).setAttribute('style', 'background-color:' + color_left + ' !important');
        //console.log(last);
    }

    function getRightVal(e)
    {
        var last = left_arr.slice(-1)[0];

        var right_ans_val = e.value;

        document.getElementById("answer_" + right_ans_val).value = last;
        /*if(right_arr.length == 0)
         {
         right_arr.push(right_ans_val);
         $('.right').attr('disabled', true);
         $('.left').attr('disabled', false);
         }else
         {
         var temp = 0;
         for(var i = 0; i < right_arr.length; i++) 
         {
         
         if(right_arr[i] === right_ans_val)
         {
         temp = 1;
         }
         }
         if(temp == 0)
         {
         right_arr.push(right_ans_val);
         //$('.right').attr('disabled', true);
         //$('.left').attr('disabled', false);
         }
         }*/
        $('.right').attr('disabled', true);
        $('.left').attr('disabled', false);
        var color_right = color_array[last - 1];
        document.getElementById("color_right_side_" + right_ans_val).setAttribute('style', 'background-color:' + color_right + ' !important');
        console.log(right_arr);
    }


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
            $('#list_box_1_' + i).show();
            $('#list_box_2_' + i).show();
        }
    }
    function getAnswer()
    {
        //alert(this.attr('data'));
    }
</script>
