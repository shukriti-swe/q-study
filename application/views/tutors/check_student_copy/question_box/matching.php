<?php 

 $x = json_decode($tutorial_ans_info[0]['st_ans'] , true);

 $y = json_decode($x[$question_order_id]['student_ans'] , true);

if (is_array($y)) {
     $z = $y;
}else{
     $z = json_decode( $y , true);
}

    $question_info = json_decode($question_info_s[0]['questionName']);
    $st_ans = json_decode($tutorial_ans_info[0]['st_ans'],TRUE);
    $question_order = $question_info_s[0]['question_order'];
//    echo '<pre>';print_r($question_info);
?>

<div class="col-md-12"> 
    <div class="text-center">
        
        <div class="form-group ss_h_mi" style="margin-bottom: 10px">
            
<!--            <a role="button" aria-expanded="true" aria-controls="collapseOne" style="float: left;">
                <span onclick="setSolution()">
                    <img src="assets/images/icon_solution.png"> Solution
                </span> Question
            </a>-->
            
            <label for="exampleInputiamges1">Question</label>
            <div class="select">
                <input class="form-control" type="text" value="<?php echo strip_tags($question_info->questionName)?>" name="questionName">
            </div>

        </div>
    </div>
</div>

<?php
    $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
    $color_array = array('red', 'green', 'blue', '#00BFFF', '#b3230a', '#708090', '#2F4F4F', '#C71585', '#8B0000', '#808000', '#FF6347', '#FF4500', '#FFD700', '#FFA500', '#228B22', '#808000', '#00FFFF', '#66CDAA', '#7B68EE', '#FF69B4');
    

    if (is_array($st_ans[$question_order]['student_ans'])) {
         $right_side_ans = $right_side_ans;
    }else{
         $right_side_ans = json_decode($st_ans[$question_order]['student_ans'] , TRUE);
    }
                                           // echo '<pre>';print_r($st_ans);die;
?>
<div class="col-sm-8">
<div class="workout_menu" style="padding-left: 15px;padding-right: 15px;">
    <ul>
        <li><a style="cursor:pointer" id="show_question">Question<i>(Click Here)</i></a></li>
        <li>
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> <span><img src="assets/images/icon_draw.png"> Instruction</span></a>
        </li>
    </ul>
</div>
<div class="col-sm-12 question_module" style="display: none;">
    <div class="panel-group col-sm-7" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    Question
                    <button type="button" class="woq_close_btn" id="woq_close_btn">&#10006;</button>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class=" math_plus" id="quesBody" style="min-height: 100px;">
                    <?php echo $question_info_left_right->questionName;?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5"></div>
</div>
<div class="col-md-12 answer_module" style="margin-top: 20px;">
    <form id="answer_form">
            <?php $i = 1;
            foreach ($question_info_left_right->left_side as $key =>$row) {
                ?>
                <div class="row" style="margin-bottom:20px;">
                    <div class="col-sm-9">
                        <div class="col-xs-11">
                            <div class="box">
                                <div class="ss_w_box text-right">
                                    <?php echo $row[0]; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-1">
                            <p class="ss_lette" id="color_left_side_<?php echo $i; ?>" style="min-height: 0px; background: <?= $color_array[$key]; ?>">
                                <input type="radio" id='left_side_<?php echo $i; ?>' name="left_side_<?php echo $i; ?>" value="<?php echo $i; ?>" data-id="1" class="left" onclick="getLeftVal(this);" style="min-height: 60px;">
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="col-xs-1">
                            <p class="ss_lette" id="color_right_side_<?php echo $i; ?>" style="min-height: 0px; background: <?= $color_array[ $z['student_ans'][$key] - 1 ]; ?>"> 
                                <input type="radio" name="right_side_<?php echo $i; ?>"  value="<?php echo $i; ?>" class="right" onclick="getRightVal(this);" style="min-height: 60px;">
                            </p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <div class="ss_w_box text-left">
                                    <p>
                                        <?php echo $question_info_left_right->right_side[$key][0]; ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="answer_<?php echo $i; ?>" id="answer_<?php echo $i; ?>" data="1" onclick="getAnswer();">

                        <div class="col-xs-1">

                            <?php  if ($z['tutor_ans'][$key] == $z['student_ans'][$key] ) { ?>
                               <span class="fa fa-check" id="message_<?php echo $i - 1; ?>">  </span>
                             <?php }else { ?>
                                <span class="fa fa-close" id="message_<?php echo $i - 1; ?>">  </span>
                             <?php  } ?>
                            
                        </div>
                        <input type="hidden" name="total_ans" value="<?php echo sizeof($question_info_left_right->right_side); ?>">

                    </div>
                </div>
                <?php $i++;
            }
            ?>
            <div class="col-sm-12" style="text-align: center;">     
                <button type="button" class="btn btn_next" id="answer_matching">submit</button>
            </div> 
    </form>
</div>
</div>
<?php
$lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
?>

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