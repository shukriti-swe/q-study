<?php
// print_r($this->session->userdata('user_id')) ;die();
 // if (isset($_POST['submit']) && $_POST['submit'] = 'submit')
 // {
 //    //echo "<pre>";print_r($_POST);die();
 //    $course_data['courses'] = $_POST['course'];
 //    $course_data['totalCost'] = $_POST['totalCost'];
 //    $course_data['token'] = $_POST['token'];
 //    $course_data['paymentType'] = $_POST['paymentType'];
 //    $course_data['children'] = $_POST['children'];
 //    $this->session->set_userdata($course_data);
 //    redirect('/paypal');
 // }

?> 
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
</style>

<div class="container">
    <div class="row">
        <p class="alert alert-success" id="help_denied" style="margin: 0 28%;"  > 
            <b> Before you select the subject please watch the video help. </b>
        </p>
        <div class="col-sm-10 col-sm-offset-1">
            <h6 style="color: #053167;font-weight: 600;text-decoration: underline;text-align: center;padding-top: 15px;"></h6>
            <form class="ss_form text-center form-inline" method="post" action="">
                <div class="ss_bottom_s_course" style="padding-right: 50px;">
                    <?php if ($this->session->userdata('registrationType') != 'trial') { ?>
                        <div class="select active r1" data="1" checked onclick="myR1Func();">For always</div>

                        <div class="total">Total<br/><b id="dolar">$<?= $rs_amount ?></b></div>
                        <input type="hidden" name="paymentType" value="1" id="paymentType" />
                        <input type="hidden" name="totalCost" value="<?= $rs_amount ?>" id="totalCost" />
                        <input type="hidden" name="rs_subject" value="<?= $rs_subject ?>" id="rs_subject" />
                    <?php } ?>
                </div>
                   <br> 
                <div class="text-center" style="padding: 15px 185px;"> 
                    <button class="btn btn-primary" style="margin-right: 50px;">Choose Option</button>
                    <br>
                    <br>
                    <!--<div class="row" style="margin-bottom: 5px;">-->
                    <!--    <div class="col-md-2 direct_debit_1">Option 1</div>-->
                    <!--    <div class="col-md-7 direct_debit_2">-->
                    <!--        <p style="font-weight: bold;">Direct Debit</p>-->
                    <!--        <p>Your membership will be renewed automatically. You may cencel anytime</p>-->
                        
                    <!--    </div>-->
                    <!--    <div class="col-md-2 direct_debit_3">-->
                    <!--        <input type="checkbox" class="ck_direct_debit payment_process" id="ck_direct_debit" name="direct_debit" value="1">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="row no_direct_debit" style="margin-bottom: 5px;">
                        <div class="col-md-2 direct_debit_1">Option 1</div>
                        <div class="col-md-7 direct_debit_2">
                            <p>No direct debit</p>
                            <p>One time payment without no automatic renewel.</p>
                        </div>
                        <div class="col-md-2 direct_debit_3">
                            <input type="checkbox" class="ck_no_direct_debit payment_process" id="ck_no_direct_debit" name="no_direct_debit" value="2">
                        </div>
                    </div>
                    <div class="row direct_deposits">
                        <div class="col-md-2 direct_debit_1">Option 2</div>
                        <div class="col-md-7 direct_debit_2">
                            <p>Direct Deposit</p>
                        </div>
                        <div class="col-md-2 direct_debit_3">
                            <input type="checkbox" class="ck_direct_deposit payment_process" id="ck_direct_deposit" name="direct_deposit" value="3">
                        </div>
                    </div>
                    <div class="payment_option_error text-danger" style="font-size: 18px;font-weight: bold;text-align: left;margin-top: 5px;"></div>
                </div>
                <?php if ($this->session->userdata('registrationType') != 'trial') { ?>
                    <!-- <p class="warnin_text">“Your membership will be renewed automatically. You may cencel anytime”</p> -->
                <?php } else {
                    echo '<br>';
                } ?>

                <input type="hidden" value="1" name="token">    
                <div class="text-center" style="padding-right: 30px;"> 
                    <button type="submit" class="btn btn_next" id="must_select" name="submit" value="submit"> 
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

<?php if ($this->session->userdata('registrationType') != 'trial') { ?>


        $('.ck_direct_debit').change(function(){
            if ($('#ck_direct_debit').prop('checked')) {
                $('#ck_no_direct_debit').prop('checked',false);
                $('#ck_direct_deposit').prop('checked',false);
                
            }
        })
        $('.ck_no_direct_debit').change(function(){
            if ($('#ck_no_direct_debit').prop('checked')) {
                $('#ck_direct_debit').prop('checked',false);
                $('#ck_direct_deposit').prop('checked',false);
                
            }
        })
        $('.ck_direct_deposit').change(function(){
            if ($('#ck_direct_deposit').prop('checked')) {
                $('#ck_direct_debit').prop('checked',false);
                $('#ck_no_direct_debit').prop('checked',false);
            }
        })


<?php } ?>
</script>

<script>
    $(document).ready(function(){
        $('#help_denied').fadeOut(15000);
    })
</script>