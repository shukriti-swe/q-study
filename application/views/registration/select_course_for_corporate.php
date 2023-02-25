<?php echo $header; ?>
<?php echo $header_sign_up; ?>
<style>
    .direct_debit_1{
        background: #337ab7;
        height: 76px;
        font-size: 16px;
        color: #fff;
        padding-top: 25px;
    }
    .direct_deposit_1{
        background: #b3a2c7;
        height: 76px;
        font-size: 16px;
        color: #fff;
        padding-top: 25px;
    }

    .direct_debit_2{
        background: #337ab7;
        color: #fff; 
        height: 76px;
        margin-left: 2px;       
    }

    .direct_debit_2 p{
        color: #fff;       
    }
    .direct_debit_3{
        background: #337ab7;
        color: #fff; 
        height: 76px;
        margin-left: 2px;  
        padding-top: 25px;     
    }
    .direct_deposit_3{
        background: #b3a2c7;
        color: #fff; 
        height: 76px;
        margin-left: 2px;  
        padding-top: 25px;     
    }

    .no_direct_debit .direct_debit_1{
        background: #d99694;
        color: #fff; 
        height: 76px;
        padding-top: 25px;
    }
    .no_direct_debit .direct_debit_2{
        background: #d99694;
        color: #fff; 
        height: 76px;
        margin-left: 2px; 
    }
    .no_direct_debit .direct_debit_3{
        background: #d99694;
        color: #fff; 
        height: 76px;
        margin-left: 2px; 
        padding-top: 25px;
    }
    .direct_deposits .direct_debit_2{
        background: #b3a2c7;
        color: #fff; 
        height: 76px;
        margin-left: 2px;   
        padding-top: 25px;    
    }

    .hover_set .tooltiptext {
        visibility: hidden;
        width: 315px;
        background-color: #c8d9db;
        color: #100101;
        text-align: center;
        border-radius: 1px;
        padding: 7px 0;
        margin-top: -137px;
        margin-left: -119px;
        position: absolute;
        z-index: 1;

    }

    .hover_set:hover .tooltiptext {
        visibility: visible;
    }

    .course_checkbox{
        position:relative !important;
    }
    .course_image{
        height: 200px;
        width: 200px;
    }
    .cost_box{
        height:50px;
        width:51px;
        border-radius:50%;
        padding-top: 14px;
        padding-left: 5px;
        background-color:#b0e7fa;
    }
    .cost_box_second{
        height:50px;
        width:51px;
        border-radius:50%;
        padding-top: 14px;
        padding-left: 5px;
        background-color:#b0e7fa;
        bottom: 0px;
        position: absolute;
    }
    .course_one_serial{
        border: 1px solid #b6b6b6;
        padding: 15px;
        box-shadow: 0px 0px 10px #b6b6b6;
        border-radius: 10px;
        text-align:left;
        min-height:325px;
        cursor:pointer;
    }
    .course_two_serial{
        border: 1px solid #b6b6b6;
        padding: 15px;
        box-shadow: 0px 0px 10px #b6b6b6;
        border-radius: 10px;
        text-align:left;
        min-height:325px;
    }
    .course_three_serial{
        border: 1px solid #b6b6b6;
        padding: 15px;
        box-shadow: 0px 0px 10px #b6b6b6;
        border-radius: 10px;
        text-align:left;
        min-height:325px;
    }
    .course_without_image{
        border: 1px solid #b6b6b6;
        box-shadow: 0px 0px 10px #b6b6b6;
        border-radius: 10px;
        text-align:left;
        min-height:325px;
        padding-bottom:14px;
        
    }
    .without_image_course_name{
        font-family: century-gothic, sans-serif;
        font-weight:bold;
        font-size:16px;
        text-align: center;
    }
    .without_image_course_grade{
        font-family: century-gothic, sans-serif;
        font-weight:bold;
        font-size:16px;
        text-align: center;
        color:#d63832;
    }
</style>  
<div class="container">
    <div class="row">
        <p class="alert alert-success" id="help_denied" style="margin: 0 28%;"  > 
            <b> Before you select the subject please watch the video help. </b>
        </p>
        <div class="col-sm-12">

            <h6 style="color: #053167;font-weight: 600;text-decoration: underline;text-align: center;padding-top: 15px;">Select Your Course</h6>
            <form class="ss_form text-center form-inline" method="post" action="">
                <div class="ss_top_s_course">
                <div class="row">
                    <?php 
                        
                        $i=1;
                        $j=1;
                        $k=2;
                        $l=3;
                        foreach($courses as $course_info){?>
                        <div class="col-md-4" style="margin-top: 15px;">
                            
                            <?php 
                                if($i==$j){
                                $j=$j+3;
                                if(!empty($course_info['image_name'])){
                            ?>
                                    <div class="course_one_serial selected_course selected_course<?=$i;?>" data-id="<?=$i;?>">

                                    <input type="checkbox" name="course[]" id="course<?php echo $i; ?>" class="course_checkbox" value="<?php echo $course_info['id'] ?>">

                                    <div class="row">
                                    <div class="col-md-4" style="padding-right:0px;padding-left:8px;">
                                        <?php $course_name = preg_split('#<p([^>])*>#',$course_info['courseName']);
                                        //echo "<pre>";print_r(array_filter($course_name));die();
                                        $course_name = array_filter($course_name);
                                        $course = '';
                                        $grade = '';
                                        if(isset($course_name[1])){
                                            $course = $course_name[1];
                                        }
                                        if(isset($course_name[2])){
                                            $grade =  $course_name[2];
                                        }
                                        ?>
                                        <br><br><br>
                                        <p class="courseName<?=$i;?>" style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:16px;text-align: center;"><?php echo $course?></p>
                                        <p class="gradeName<?=$i;?>" style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:16px;text-align: center;color:#d63832;"><?php echo $grade?></p>
                                        
                                    </div>
                                        <div class="col-md-8">
                                            <?php if(!empty($course_info['image_name'])){?>
                                                <img src="assets/course_image/<?=$course_info['image_name']?>" class="course_image">
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="cost_box">$<?=$course_info['courseCost']?></div>
                                    </div>
                                <?php }else{ ?>
                                    <div class="course_without_image course_without_image<?=$i?>"   data-id="<?=$i;?>">
                                        <div class="course_without_image_box course_without_image_box<?=$i?>" style="min-height:219px;background-color:#c3eaf1;border-top-right-radius: 10px;border-top-left-radius: 10px;width:100%;text-align: center;display:table;">

                                        <input type="checkbox" style="margin-top:20px;margin-left:7px;" name="course[]" id="course<?php echo $i; ?>" class="course_checkbox" value="<?php echo $course_info['id'] ?>">
                                            <div style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:16px;display: table-cell;vertical-align: middle;">
                                            <?php $course_name = preg_split('#<p([^>])*>#',$course_info['courseName']);
                                            //echo "<pre>";print_r(array_filter($course_name));die();
                                            $course_name = array_filter($course_name);
                                            $course = '';
                                            $grade = '';
                                            if(isset($course_name[1])){
                                                $course = $course_name[1];
                                            }
                                            if(isset($course_name[2])){
                                                $grade =  $course_name[2];
                                            }
                                            ?>
                                            <p class="without_image_course_name without_image_course_name<?php echo $i; ?>"><?php echo $course?></p>
                                            <p class="without_image_course_grade without_image_course_grade<?php echo $i; ?>"><?php echo $grade?></p>
                                            </div>
                                        </div>
                                        <div style="width:100%;padding:20px 15px;">
                                            <div class="cost_box">$<?=$course_info['courseCost']?></div>
                                        </div>
                                    </div>

                                <?php }?>
                            <?php 
                                }elseif($i==$k){
                                $k=$k+3;
                                if(!empty($course_info['image_name'])){
                            ?>
                                    <div class="course_two_serial selected_course selected_course<?=$i;?>" data-id="<?=$i;?>">
                                    <input type="checkbox" name="course[]" id="course<?php echo $i; ?>" class="course_checkbox" value="<?php echo $course_info['id'] ?>">
                                        <br><br>
                                        <?php $course_name = preg_split('#<p([^>])*>#',$course_info['courseName']);
                                        // echo "<pre>";print_r($course_name);die();
                                        $course_name = array_filter($course_name);
                                        $course = '';
                                        $grade = '';
                                        if(isset($course_name[1])){
                                            $course = $course_name[1];
                                        }
                                        if(isset($course_name[2])){
                                            $grade =  $course_name[2];
                                        }
                                        
                                        ?>
                                        <p class="courseName<?=$i;?>" style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:16px;text-align: left;"><?php echo $course;?></p>
                                        <p class="gradeName<?=$i;?>" style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:16px;text-align: left;color:#d63832;"><?php echo $grade?></p>
                                        
                                        <div class="row">

                                            <div class="col-md-4" style="min-height: 200px;">
                                                <div class="cost_box_second">$<?=$course_info['courseCost']?></div>
                                            </div>
                                            <div class="col-md-8" style="min-height: 200px;">
                                                <?php if(!empty($course_info['image_name'])){?>
                                                    <img src="assets/course_image/<?=$course_info['image_name']?>" class="course_image">
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <div class="course_without_image course_without_image<?=$i?>" data-id="<?=$i;?>">
                                        <div class="course_without_image_box course_without_image_box<?=$i?>" style="min-height:219px;background-color:#fbe5d6;border-top-right-radius: 10px;border-top-left-radius: 10px;width:100%;text-align: center;display:table;">

                                        <input type="checkbox" style="margin-top:20px;margin-left:7px;" name="course[]" id="course<?php echo $i; ?>" class="course_checkbox" value="<?php echo $course_info['id'] ?>">
                                            <div style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:16px;display: table-cell;vertical-align: middle;">
                                                <?php $course_name = preg_split('#<p([^>])*>#',$course_info['courseName']);
                                                //echo "<pre>";print_r(array_filter($course_name));die();
                                                $course_name = array_filter($course_name);
                                                $course = '';
                                                $grade = '';
                                                if(isset($course_name[1])){
                                                    $course = $course_name[1];
                                                }
                                                if(isset($course_name[2])){
                                                    $grade =  $course_name[2];
                                                }
                                                ?>
                                                <p class="without_image_course_name without_image_course_name<?php echo $i; ?>"><?php echo $course?></p>
                                                <p class="without_image_course_grade without_image_course_grade<?php echo $i; ?>"><?php echo $grade?></p>
                                            </div>
                                        </div>
                                        <div style="width:100%;padding:20px 15px;">
                                            <div class="cost_box">$<?=$course_info['courseCost']?></div>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php 
                                }elseif($i==$l){
                                $l=$l+3;
                                if(!empty($course_info['image_name'])){
                            ?>
                                    <div class="course_three_serial selected_course selected_course<?=$i;?>" data-id="<?=$i;?>">
                                    <input type="checkbox" name="course[]" id="course<?php echo $i; ?>" class="course_checkbox" value="<?php echo $course_info['id'] ?>">
                                        <?php if(!empty($course_info['image_name'])){?>
                                            <div style="text-align:center;">
                                            <img src="assets/course_image/<?=$course_info['image_name']?>" class="course_image">
                                            </div>
                                        <?php }?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="cost_box">$<?=$course_info['courseCost']?></div>
                                            </div>
                                            <div class="col-md-8">
                                                <?php $course_name = preg_split('#<p([^>])*>#',$course_info['courseName']);
                                                // echo "<pre>";print_r($course_name);die();
                                                $course_name = array_filter($course_name);
                                                $course = '';
                                                $grade = '';
                                                if(isset($course_name[1])){
                                                    $course = $course_name[1];
                                                }
                                                if(isset($course_name[2])){
                                                    $grade =  $course_name[2];
                                                }
                                                ?>
                                                <p class="courseName<?=$i;?>" style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:16px;text-align: left;color:#d63832;"><?php echo $grade?></p>
                                                <p class="gradeName<?=$i;?>" style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:16px;text-align: left;"><?php echo $course;?></p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <div class="course_without_image course_without_image<?=$i?>" data-id="<?=$i;?>">
                                        <div class="course_without_image_box course_without_image_box<?=$i?>" style="min-height:219px;background-color:#e2f0d9;border-top-right-radius: 10px;border-top-left-radius: 10px;width:100%;text-align: center;display:table;">
                                        <input type="checkbox" style="margin-top:20px;margin-left:7px;" name="course[]" id="course<?php echo $i; ?>" class="course_checkbox" value="<?php echo $course_info['id'] ?>">

                                            <div style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:16px;display: table-cell;vertical-align: middle;">
                                            <?php $course_name = preg_split('#<p([^>])*>#',$course_info['courseName']);
                                            //echo "<pre>";print_r(array_filter($course_name));die();
                                            $course_name = array_filter($course_name);
                                            $course = '';
                                            $grade = '';
                                            if(isset($course_name[1])){
                                                $course = $course_name[1];
                                            }
                                            if(isset($course_name[2])){
                                                $grade =  $course_name[2];
                                            }
                                            ?>
                                            <p class="without_image_course_name without_image_course_name<?php echo $i; ?>"><?php echo $course?></p>
                                            <p class="without_image_course_grade without_image_course_grade<?php echo $i; ?>"><?php echo $grade?></p>
                                            </div>
                                        </div>
                                        <div style="width:100%;padding:20px 15px;">
                                            <div class="cost_box">$<?=$course_info['courseCost']?></div>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php 
                                }
                            ?>
                            
                            
                        </div>
                            
                    <?php $i++;}?>
                </div>
                <br><br><br><br><br>
                </div>

                <div class="ss_bottom_s_course">

                    <div class="form-group">
                        <label class="label-inline">Number of teacher</label>  

                        <input type="Number" id="children" class="form-control ss_number" name="teacher" value='1' onclick="getChildreen();" onkeyup="getChildreen();" readonly>
                    </div>


                    <?php if ($this->session->userdata('registrationType') != 'trial') { ?>
                        <div class="select active r1" checked data="1" onclick="myR1Func();">Per month</div>
                        <div class="select r4" data="4" onclick="myR4Func();">3 Months</div>
                        <div class="select r2" data="2" onclick="myR2Func();">6 Months</div>
                        <div class="select r3" data="3" onclick="myR3Func();">1Year</div>

                        <div class="total">Total<br/><b id="dolar">$0</b></div>
                        <input type="hidden" name="paymentType" value="" id="paymentType" />
                        <input type="hidden" name="totalCost" value="" id="totalCost" />
                    <?php } ?>
                </div>

                <br>
                <?php if ($this->session->userdata('registrationType') != 'trial') { ?>
                <div class="text-center" style="padding: 15px 185px;margin-left:30px;"> 
                    <button class="btn btn-primary" style="margin-right: 50px;">Choose Option</button>
                    <br>
                    <br>
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-md-2 direct_debit_1">Option 1</div>
                        <div class="col-md-7 direct_debit_2">
                            <p>Direct Debit</p>
                            <p>Your membership will be renewed automatically. You may cancel anytime</p>
                        </div>
                        <div class="col-md-2 direct_debit_3">
                            <input type="checkbox" class="ck_direct_debit payment_process" id="ck_direct_debit" name="direct_debit" value="1">
                        </div>
                    </div>
                    <div class="row no_direct_debit" style="margin-bottom: 5px;">
                        <div class="col-md-2 direct_debit_1">Option 2</div>
                        <div class="col-md-7 direct_debit_2">
                            <p>No direct debit</p>
                            <p>One time payment without no automatic renewel.</p>
                        </div>
                        <div class="col-md-2 direct_debit_3">
                            <input type="checkbox" class="ck_no_direct_debit payment_process" id="ck_no_direct_debit" name="no_direct_debit" value="2">
                        </div>
                    </div>
                    <div class="row direct_deposits">
                        <div class="col-md-2 direct_debit_1">Option 3</div>
                        <div class="col-md-7 direct_debit_2">
                            <p>Direct Deposit</p>
                        </div>
                        <div class="col-md-2 direct_debit_3">
                            <input type="checkbox" class="ck_direct_deposit payment_process" id="ck_direct_deposit" name="direct_deposit" value="3">
                        </div>
                    </div>
                    <div class="payment_option_error text-danger" style="font-size: 18px;font-weight: bold;text-align: left;margin-top: 5px;"></div>
                </div>
                <?php } ?> 
                
                <?php if ($this->session->userdata('registrationType') != 'trial') { ?>
                    <!--<p class="warnin_text">“Your membership will be renewed automatically. You may cencel anytime”</p>-->
                <?php } else {
                    echo '<br>';
                } ?>

                <input type="hidden" value="1" name="token">    
                <div class="text-center" > 
                    <button class="btn btn_next" id="must_select" name="submit" value="submit"> 
                        <img src="<?php echo base_url(); ?>assets/images/icon_save.png"/>Save & Proceed
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
</div>
</section>
<?php echo $footer; ?>

<script>

<?php if ($this->session->userdata('registrationType') != 'trial') { ?>
    $('#must_select').click(function(){
         if ($('#ck_direct_debit').prop('checked')) {
            var result = "OK";
        }else if ($('#ck_no_direct_debit').prop('checked')) {
            var result = "OK";
        }else if ($('#ck_direct_deposit').prop('checked')) {
            var result = "OK";
        }else{
            var result = "NO";
        }

        if (result == "NO") {
            $('.payment_option_error').html('Please select the payment option first !!');
            // alert('Please select the payment option first !!')
            return false;
        }else{
            $('.payment_option_error').html('');
            return true;
        }
    })
<?php } ?>

<?php if ($this->session->userdata('registrationType') != 'trial') { ?>
        
        function myR1Func() {
            // var davalue = $('.r1').attr('data');
            // var Period = $("#paymentType").val();
            // var totalCostWithPeriod = $("#totalCost").val();//"<?= $course_details[0]['courseCost']; ?>";
            // document.getElementById("paymentType").value = davalue;
            // countTotal(1,totalCostWithPeriod,1);
            
            var davalue = $('.r1').attr('data');
            var Period = $("#paymentType").val();
            var totalCostWithPeriod = $("#totalCost").val();
            document.getElementById("paymentType").value = davalue;
            countTotal(Period,totalCostWithPeriod,1);
        }
        myR1Func();
        
        courseClick();
        function myR2Func() {
            var davalue2 = $('.r2').attr('data');
            var Period = $("#paymentType").val();
            var totalCostWithPeriod = $("#totalCost").val();
            document.getElementById("paymentType").value = davalue2;
            countTotal(Period,totalCostWithPeriod,6);
        }
        function myR3Func() {
            var davalue3 = $('.r3').attr('data');
            var Period = $("#paymentType").val();
            var totalCostWithPeriod = $("#totalCost").val();
            document.getElementById("paymentType").value = davalue3;
            countTotal(Period,totalCostWithPeriod,12);
        }
        function myR4Func() {
            var davalue4 = $('.r4').attr('data');
            var Period = $("#paymentType").val();
            var totalCostWithPeriod = $("#totalCost").val();
            document.getElementById("paymentType").value = davalue4;
            countTotal(Period,totalCostWithPeriod,3);
        }
        function countTotal(Period,totalCostWithPeriod,select) {
            var amountTotal = 0 ;
            if (Period == 1)
            {
                amountTotal = totalCostWithPeriod/1;
                amountTotal = amountTotal*select;

            }else if (Period == 2)
            {
                amountTotal = totalCostWithPeriod/6;
                amountTotal = amountTotal*select;
            }else if (Period == 3)
            {
                amountTotal = totalCostWithPeriod/12;
                amountTotal = amountTotal*select;
            }else if (Period == 4)
            {
                amountTotal = totalCostWithPeriod/3;
                amountTotal = amountTotal*select;
            }
            $('#dolar').html('$' + amountTotal);
            document.getElementById("totalCost").value = amountTotal;
        }
<?php } ?>
    var courseNumber = document.getElementsByName('course[]');
    var amit = 0;
    for (i = 1; i <= courseNumber.length; i++) {
        if ($("#course_" + i).is(":checked")) {
            amit++;
        }
    }
    // if (amit == 0) {
    //     $("#must_select").attr('disabled', true);
    // } else {
    //     $("#must_select").attr('disabled', false);
    // }

    function getChildreen() {
        var noOfChildreen = $('#children').val();
        if (noOfChildreen < 1) {
            document.getElementById("children").value = 1;
        }
        courseClick();
    }

    function courseClick() {
        var courseNumber = document.getElementsByName('course[]');
        var j = 0;
        var total_cost = 0;
        
        
        for (ss = 1; ss <= courseNumber.length; ss++) {
            if ($("#course_" + ss).is(":disabled")) {
                $("#course_" + ss).prop('checked',false);
            }
        }
        
        for (i = 1; i <= courseNumber.length; i++) {
            if ($("#course_" + i).is(":checked")) {
                var course_cost = $("#course_" + i).attr('data');
                var total_cost = parseInt(total_cost) + parseInt(course_cost);
                j++;
            }
        }
        var children = $('#children').val();
        var total_amount = total_cost * children;
        // if (j == 0) {
        //     $("#must_select").attr('disabled', true);
        // } else {
        //     $("#must_select").attr('disabled', false);
        // }
<?php if ($this->session->userdata('registrationType') != 'trial') { ?>
        var Period = $("#paymentType").val();
        if (Period == 1)
        {
            total_amount = total_amount*1;

        }else if (Period == 2)
        {
            total_amount = total_amount*6;
        }else if (Period == 3)
        {
            total_amount = total_amount*12;
        }else if (Period == 4)
        {
            total_amount = total_amount*3;
        }
        $('#dolar').html('$' + total_amount);
        document.getElementById("totalCost").value = total_amount;
<?php } ?>
    }
</script>
<script>
    $(document).ready(function(){
        $('#help_denied').fadeOut(15000);

        $('.selected_course').click(function(){
          var get_id =$(this).attr('data-id');
          if($('#course'+get_id).is(':checked')){
            $('#course'+get_id).attr('checked',false);
            $(this).attr('style','background-color:white;');
            $('.courseName'+get_id).attr('style','color:black;');
            $('.gradeName'+get_id).attr('style','color:black;');
          }else{
            $('#course'+get_id).attr('checked',true);
            $(this).attr('style','background-color:#ed1c24');
            $('.courseName'+get_id).attr('style','color:white;');
            $('.gradeName'+get_id).attr('style','color:white;');
          }
        });

        $('.course_without_image').click(function(){
          var get_id =$(this).attr('data-id');
          if($('#course'+get_id).is(':checked')){
            $('#course'+get_id).attr('checked',false);$('.course_without_image_box'+get_id).attr('style','min-height:219px;background-color:#c3eaf1;border-top-right-radius: 10px;border-top-left-radius: 10px;width:100%;text-align: center;display:table;');
            $('.without_image_course_name'+get_id).attr('style','color:black;');
            $('.without_image_course_grade'+get_id).attr('style','color:black;');
            $(this).attr('style','background-color:white;');
          }else{
            $('#course'+get_id).attr('checked',true);
            $('.course_without_image_box'+get_id).attr('style','min-height:219px;background-color:#ed1c24;border-top-right-radius: 10px;border-top-left-radius: 10px;width:100%;text-align: center;display:table;');
            $('.without_image_course_name'+get_id).attr('style','color:white;');
            $('.without_image_course_grade'+get_id).attr('style','color:white;');
            $(this).attr('style','background-color:#ed1c24');
            $('.courseName'+get_id).attr('style','color:white;');
            $('.gradeName'+get_id).attr('style','color:white;');
           
          }
       
        }); 
    })
</script>