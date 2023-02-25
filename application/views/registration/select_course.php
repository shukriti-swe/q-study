<?php
if( $this->session->userdata('userType') == 1 && $this->session->userdata('registrationType') == ''){
    $this->session->set_userdata('userType', 6);
}
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
        bottom:0px !important;
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
<?php //echo "<pre>";print_r($user_info);die(); 

    $end_subs = $user_info[0]['end_subscription'];
    $payment_status = $user_info[0]['payment_status'];
    $subscription_type = $user_info[0]['subscription_type'];
    if (isset($end_subs)) {
        $d1 = date('Y-m-d',strtotime($end_subs));
        $d2 = date('Y-m-d');
        $diff = strtotime($d1) - strtotime($d2);
        $r_days = floor($diff/(60*60*24));
    }
    
?>

<div class="container">
    <div class="row">
        <p class="alert alert-success" id="help_denied" style="margin: 0 28%;"  > 
            <b> Before you select the subject please watch the video help. </b>
        </p>
        <div class="col-sm-12">
            <h6 style="color: #053167;font-weight: 600;text-decoration: underline;text-align: center;padding-top: 15px;">Select Your Course</h6>
            <!--<div class="disabled_option_error text-danger" style="font-size: 18px;font-weight: bold;text-align: center;margin-top: 5px;"></div>-->
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

                                        <input type="checkbox" name="course[]" id="course_<?php echo $i; ?>" class="course_checkbox" value="<?php echo $course_info['id'] ?>" data="<?php echo $course_info['courseCost'] ?>" <?php if(in_array($course_info['id'],$register_course)){echo "checked";} ?>>
                                        
                                        <?php if(in_array($course_info['id'],$register_course)){ ?>
                                        <i class="fa fa-check" style="color:green;font-size:18px;bottom:5px;"></i>
                                        <?php }?>
                                        <div class="row">
                                        <div class="col-md-4" style="padding-right:0px;padding-left:8px;">
                                            <?php $course_name = preg_split('#<p([^>])*>#',$course_info['courseName']);
                                            //echo "<pre>";print_r(array_filter($course_name));die();
                                            $course_name = array_filter($course_name);
                                            $course = '';
                                            $grade = '';
                                            if(isset($course_name[0])){
                                                $course = $course_name[0];
                                            }else if(isset($course_name[1])){
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
                                    <?php }else{ 
                                        ?>
                                        <div class="course_without_image course_without_image<?=$i?>"   data-id="<?=$i;?>">
                                            <div class="course_without_image_box course_without_image_box<?=$i?>" style="min-height:219px;background-color:#c3eaf1;border-top-right-radius: 10px;border-top-left-radius: 10px;width:100%;text-align: center;display:table;">

                                            <input type="checkbox" style="margin-top:20px;margin-left:7px;" name="course[]" id="course_<?php echo $i; ?>" class="course_checkbox" value="<?php echo $course_info['id'] ?>" data="<?php echo $course_info['courseCost'] ?>" <?php if(in_array($course_info['id'],$register_course)){echo "checked";} ?>>
                                            <?php if(in_array($course_info['id'],$register_course)){ ?>
                                                <i class="fa fa-check" style="color:green;font-size:18px;bottom:5px;"></i>
                                            <?php }?>
                                                <div style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:16px;display: table-cell;vertical-align: middle;">
                                                <?php $course_name = preg_split('#<p([^>])*>#',$course_info['courseName']);
                                                // echo "<pre>";print_r($course_name);die();
                                                $course_name = array_filter($course_name);
                                                $course = '';
                                                $grade = '';
                                                if(isset($course_name[0])){
                                                    $course = $course_name[0];
                                                }else if(isset($course_name[1])){
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
                                            <input type="checkbox" name="course[]" id="course_<?php echo $i; ?>" class="course_checkbox" value="<?php echo $course_info['id'] ?>" data="<?php echo $course_info['courseCost'] ?>" <?php if(in_array($course_info['id'],$register_course)){echo "checked";} ?>>
                                            <?php if(in_array($course_info['id'],$register_course)){ ?>
                                            <i class="fa fa-check" style="color:green;font-size:18px;bottom:5px;"></i>
                                            <?php }?>
                                            <br><br>
                                            <?php $course_name = preg_split('#<p([^>])*>#',$course_info['courseName']);
                                            // echo "<pre>";print_r($course_name);die();
                                            $course_name = array_filter($course_name);
                                            $course = '';
                                            $grade = '';
                                            if(isset($course_name[0])){
                                                $course = $course_name[0];
                                            }else if(isset($course_name[1])){
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

                                            <input type="checkbox" style="margin-top:20px;margin-left:7px;" name="course[]" id="course_<?php echo $i; ?>" data="<?php echo $course_info['courseCost'] ?>" class="course_checkbox" value="<?php echo $course_info['id'] ?>" <?php if(in_array($course_info['id'],$register_course)){echo "checked";} ?>>
                                            <?php if(in_array($course_info['id'],$register_course)){ ?>
                                            <i class="fa fa-check" style="color:green;font-size:18px;bottom:5px;"></i>
                                            <?php }?>

                                                <div style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:16px;display: table-cell;vertical-align: middle;">
                                                    <?php $course_name = preg_split('#<p([^>])*>#',$course_info['courseName']);
                                                    //echo "<pre>";print_r(array_filter($course_name));die();
                                                    $course_name = array_filter($course_name);
                                                    $course = '';
                                                    $grade = '';
                                                    if(isset($course_name[0])){
                                                        $course = $course_name[0];
                                                    }else if(isset($course_name[1])){
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
                                        <input type="checkbox" style="margin-top:20px;margin-left:7px;" name="course[]" id="course_<?php echo $i; ?>" class="course_checkbox" value="<?php echo $course_info['id'] ?>" data="<?php echo $course_info['courseCost'] ?>" <?php if(in_array($course_info['id'],$register_course)){echo "checked";} ?>>
                                        <?php if(in_array($course_info['id'],$register_course)){ ?>
                                        <i class="fa fa-check" style="color:green;font-size:18px;bottom:5px;"></i>
                                        <?php }?>
                                        
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
                                                    if(isset($course_name[0])){
                                                        $course = $course_name[0];
                                                    }else if(isset($course_name[1])){
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
                                            <input type="checkbox" style="margin-top:20px;margin-left:7px;" name="course[]" id="course_<?php echo $i; ?>" data="<?php echo $course_info['courseCost'] ?>"class="course_checkbox" value="<?php echo $course_info['id'] ?>" <?php if(in_array($course_info['id'],$register_course)){echo "checked";} ?>>

                                            <?php if(in_array($course_info['id'],$register_course)){ ?>
                                            <i class="fa fa-check" style="color:green;font-size:18px;bottom:5px;"></i>
                                            <?php }?>

                                                <div style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:16px;display: table-cell;vertical-align: middle;">
                                                <?php $course_name = preg_split('#<p([^>])*>#',$course_info['courseName']);
                                                //echo "<pre>";print_r(array_filter($course_name));die();
                                                $course_name = array_filter($course_name);
                                                $course = '';
                                                $grade = '';
                                                if(isset($course_name[0])){
                                                    $course = $course_name[0];
                                                }else if(isset($course_name[1])){
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

                        <!-- <div class="col-md-4">
                            <div style="border: 1px solid #b6b6b6;padding: 5px;box-shadow: 0px 0px 10px #b6b6b6;border-radius: 5px;">
                               <input type="checkbox" name="course_check" class="course_checkbox">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="border: 1px solid #b6b6b6;padding: 5px;box-shadow: 0px 0px 10px #b6b6b6;border-radius: 5px;">
                               <input type="checkbox" name="course_check" class="course_checkbox">
                            </div>
                        </div> -->
                    </div>
                    <br><br><br><br><br>










                </div>

                <div class="ss_bottom_s_course">
                    <div class="form-group">
                        <label class="label-inline">Number of children</label>  

                        <input type="Number" id="children" class="form-control ss_number" name="children" value='1' onclick="getChildreen();" onkeyup="getChildreen();" readonly>
                    </div>
                    <?php if ($this->session->userdata('registrationType') != 'trial') { ?>
                        <?php if (!empty($refferalUser)) { ?>
                            <div class="select active r4" data="4" checked onclick="myR4Func();">3 Months</div>
                            <!--<div class="select active r2" data="2" checked onclick="myR2Func();">6 Months</div>-->
                            <div class="select r2" data="2" onclick="myR2Func();">6 Months</div>
                            <div class="select r3" data="3" onclick="myR3Func();">1Year</div>
                            
                        <?php }else{ ?>
                            <div class="select active r1" data="1" checked onclick="myR1Func();">Per month</div>
                            <div class="select  r4" data="4"  onclick="myR4Func();">3 Months</div>
                            <div class="select  r2" data="2"  onclick="myR2Func();">6 Months</div>
                            <div class="select r3" data="3" onclick="myR3Func();">1Year</div>
                        <?php } ?>

                        <div class="total">Total<br/><b id="dolar">$0</b></div>
                        <input type="hidden" name="paymentType" value="" id="paymentType" />
                        <input type="hidden" name="totalCost" value="" id="totalCost" />
                    <?php } ?>
                </div>
                   <br> 
                <?php if ($this->session->userdata('registrationType') != 'trial') { ?>
                <div class="text-center" style="padding: 15px 185px;"> 
                    <button class="btn btn-primary" style="margin-right: 50px;">Choose Option</button>
                    <br>
                    <br>
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="col-md-2 direct_debit_1">Option 1</div>
                        <div class="col-md-7 direct_debit_2">
                            <p style="font-weight: bold;">Direct Debit</p>
                            <p>Your membership will be renewed automatically. You may cancel anytime</p>
                        
                        </div>
                        <div class="col-md-2 direct_debit_3">
                            <input type="checkbox" class="ck_direct_debit payment_process" id="ck_direct_debit" name="direct_debit" value="1">
                        </div>
                    </div>
                    <div class="row no_direct_debit" style="margin-bottom: 5px;">
                        <div class="col-md-2 direct_debit_1">Option 2</div>
                        <div class="col-md-7 direct_debit_2">
                            <p style="font-weight: bold;">No direct debit</p>
                            <p>One time payment without no automatic renewel.</p>
                        </div>
                        <div class="col-md-2 direct_debit_3">
                            <input type="checkbox" class="ck_no_direct_debit payment_process" id="ck_no_direct_debit" name="no_direct_debit" value="2">
                        </div>
                    </div>
                    <?php if($direct_deposit_by_contry == 1) { ?>
                    <div class="row direct_deposits">
                        <div class="col-md-2 direct_deposit_1">Option 3</div>
                        <div class="col-md-7 direct_debit_2">
                            <p style="font-weight: bold;">Direct Deposit</p>
                        </div>
                        <div class="col-md-2 direct_deposit_3">
                            <input type="checkbox" class="ck_direct_deposit payment_process" id="ck_direct_deposit" name="direct_deposit" value="3">
                        </div>
                    </div>
                    <?php } ?>
                    <div class="payment_option_error text-danger" style="font-size: 18px;font-weight: bold;text-align: left;margin-top: 5px;"></div>
                </div>
                <?php } ?>
                <?php if ($this->session->userdata('registrationType') != 'trial') { ?>
                    <!-- <p class="warnin_text">“Your membership will be renewed automatically. You may cencel anytime”</p> -->
                <?php } else {
                    echo '<br>';
                } ?>

                <input type="hidden" value="1" name="token">    
                <div class="text-center" > 
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
$(document).ready(function(){
    courseClick(); 
})
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


<?php if (!empty($refferalUser)) { ?>
    myR4Func();
<?php }else{ ?>
     myR1Func();
<?php } ?>

<?php if ($this->session->userdata('registrationType') != 'trial') { ?>

        if (true) {}
        function myR1Func() {
            var davalue = $('.r1').attr('data');
            var Period = $("#paymentType").val();
            var totalCostWithPeriod = $("#totalCost").val();
            document.getElementById("paymentType").value = davalue;
            countTotal(Period,totalCostWithPeriod,1);
        }
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
         
            <?php if(!empty($r_days)){ ?>
                var has_total_days = <?=$r_days?>;
            <?php    }else{ ?>
                var has_total_days = 0;
            <?php }?>
            
            var amountTotal = 0 ;
            var newDays = 0 ;
            if (Period == 1)
            {
                amountTotal = totalCostWithPeriod/1;
                amountTotal = amountTotal*select;
                newDays = select*30;

            }else if (Period == 2)
            {
                amountTotal = totalCostWithPeriod/6;
                amountTotal = amountTotal*select;
                newDays = select*30;
            }else if (Period == 3)
            {
                amountTotal = totalCostWithPeriod/12;
                amountTotal = amountTotal*select;
                newDays = select*30;
            }else if (Period == 4)
            {
                amountTotal = totalCostWithPeriod/3;
                amountTotal = amountTotal*select;
                newDays = select*30;
            }
            
            $('#dolar').html('$' + amountTotal);
          
            document.getElementById("totalCost").value = amountTotal;
            
        
            if(amountTotal !=0){
                if(has_total_days>newDays){
                   alert('If you buy this course then all subcription goes down with this course days ! ');
                }
            }
            
        }

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
        var checkCourseNum = 0;
        for (i = 1; i <= courseNumber.length; i++) {
            if ($("#course_" + i).is(":checked")) {
                checkCourseNum++;
            }
        }

        var disabled = 0;
        var disable_st_tutor = 0;
        var three_course_disable = 0;

        for (d = 1; d <= courseNumber.length; d++) {
            if ($("#course_" + d).is(":disabled")) {
                var course_val = $("#course_" + d).attr('value');
                if (course_val == 44) {
                   disabled = 1;
                }
                if (course_val != 44) {
                   disable_st_tutor = 1;
                }
                
                if(course_val == 21 || course_val == 22 || course_val == 55){
                    three_course_disable = 1;
                }
            }
        }

        //  alert(disabled);
        //  alert(disable_st_tutor);
        //  alert(three_course_disable);
        // console.log(disabled);
        // console.log(disable_st_tutor);
        // console.log(three_course_disable);

        if(disable_st_tutor == 1){
            for ( st_tu = 1;  st_tu <= courseNumber.length; st_tu++) {

                var course_cost = $("#course_" + st_tu).attr('data');
                var course_val = $("#course_" + st_tu).attr('value');
                if (course_val == 44) {
                    $("#course_" + st_tu).prop('checked',false);
                }
            }
        }

        
        if(disabled == 1){
            for ( dd = 1;  dd <= courseNumber.length; dd++) {

                var course_cost = $("#course_" + dd).attr('data');
                var course_val = $("#course_" + dd).attr('value');
                if (course_val != 44) {
                    $("#course_" + dd).prop('checked',false);
                }
            }
            $('.disabled_option_error').html(' "Tutor-Student Collaboration (AUS) Any Grade" course is running');
            return;
        }else{
            $('.disabled_option_error').html('');
        }
        
        
        
        if(checkCourseNum == 0 && disabled == 0 && disable_st_tutor == 0){
            $("#course_1").prop('checked',true);
            $('#course_1').attr('checked',true);
            $('.selected_course1').attr('style','background-color:#ed1c24;pointer-events:none;');
            $('.courseName1').attr('style','color:white;');
            $('.gradeName1').attr('style','color:white;');
        }
        
        var j = 0;
        var total_cost = 0;
        var is_st_colaburation = 0;
        var is_three_courses = 0;
        // var three_course_disable = 0;
        for (i = 1; i <= courseNumber.length; i++) {
            if ($("#course_" + i).is(":checked")) {
              
                var course_cost = $("#course_" + i).attr('data');
                var course_val = $("#course_" + i).attr('value');
                if (course_val == 44) {
                    is_st_colaburation = 1;
                }

                
                if (course_val == 21) {
                  $("#course_3").attr('disabled',true);
                  $("#course_5").attr('disabled',true);
                  $('.selected_course3').attr('style','pointer-events:none;');
                  $('.selected_course5').attr('style','pointer-events:none;');
                  $('.course_without_image3').attr('style','pointer-events:none;');
                  $('.course_without_image5').attr('style','pointer-events:none;');
                  var is_three_courses = 1;
                  three_course_disable = 0;
                }else if (course_val == 22) {
                  $("#course_2").attr('disabled',true);
                  $("#course_5").attr('disabled',true);
                  $('.selected_course2').attr('style','pointer-events:none;');
                  $('.selected_course5').attr('style','pointer-events:none;');
                  $('.course_without_image2').attr('style','pointer-events:none;');
                  $('.course_without_image5').attr('style','pointer-events:none;');
                  var is_three_courses = 1;
                  three_course_disable = 0;
                }else if (course_val == 55) {
                  $("#course_2").attr('disabled',true);
                  $("#course_3").attr('disabled',true);
                  $('.selected_course2').attr('style','pointer-events:none;');
                  $('.selected_course3').attr('style','pointer-events:none;');
                  $('.course_without_image2').attr('style','pointer-events:none;');
                  $('.course_without_image3').attr('style','pointer-events:none;');
                  var is_three_courses = 1;
                  three_course_disable = 0;
                }else if (course_val == 62) {
                  $("#course_7").attr('disabled',true);
                  $('.selected_course7').attr('style','pointer-events:none;');
                  $('.course_without_image7').attr('style','pointer-events:none;');
                  var is_three_courses = 1;
                  three_course_disable = 0;
                }else if (course_val == 63) {
                  $("#course_6").attr('disabled',true);
                  $('.selected_course6').attr('style','pointer-events:none;');
                  $('.course_without_image6').attr('style','pointer-events:none;');
                  var is_three_courses = 1;
                  three_course_disable = 0;
                }else{
                //   var is_three_courses = 0;
                  
                }
                var total_cost = parseInt(total_cost) + parseInt(course_cost);
                j++;
            }
        }
        
        // alert(is_st_colaburation);
        if (is_st_colaburation == 1) {
            for ( k = 1;  k <= courseNumber.length; k++) {

                var course_cost = $("#course_" + k).attr('data');
                var course_val = $("#course_" + k).attr('value');
                if (course_val != 44) {
                    $("#course_" + k).prop('checked',false);
                    $('.selected_course'+k).removeAttr('style');
                }else{
                    console.log(course_cost);
                    total_cost = parseInt(course_cost);
                }
            }

        }

        if(is_three_courses == 0 ){
   
          $("#course_2").attr('disabled',false);
          $("#course_3").attr('disabled',false);
          $("#course_5").attr('disabled',false);
          $('.course_without_image2').removeAttr('style');
          $('.course_without_image3').removeAttr('style');
          $('.course_without_image5').removeAttr('style');

          $('.selected_course2').removeAttr('style');
          $('.selected_course3').removeAttr('style');
          $('.selected_course5').removeAttr('style');
        }
        
        if(three_course_disable == 1){
            $("#course_2").attr('disabled',true);
            $("#course_3").attr('disabled',true);
            $("#course_5").attr('disabled',true);

            $('.selected_course2').attr('style','pointer-events:none;');
            $('.selected_course3').attr('style','pointer-events:none;');
            $('.selected_course5').attr('style','pointer-events:none;');
            $('.course_without_image2').attr('style','pointer-events:none;');
            $('.course_without_image3').attr('style','pointer-events:none;');
            $('.course_without_image5').attr('style','pointer-events:none;');
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
        <?php if(!empty($r_days)){ ?>
            var has_total_days = <?=$r_days?>;
        <?php    }else{ ?>
            var has_total_days = 0;
        <?php }?>
       
        if (Period == 1)
        {
            total_amount = total_amount*1;
            newDays = 1*30;
        }else if (Period == 2)
        {
            total_amount = total_amount*6;
            newDays = 6*30;
        }else if (Period == 3)
        {
            total_amount = total_amount*12;
            newDays = 12*30;
        }else if (Period == 4)
        {
            total_amount = total_amount*3;
            newDays = 3*30;
        }
        
            $('#dolar').html('$' + total_amount);
            document.getElementById("totalCost").value = total_amount;
            // if(amountTotal !=0){
                if(has_total_days>newDays){
                //    alert('You Already have '+newDays+' days ! ');
                }
            // }
      <?php } ?>
      
        
       for (s = 1; s <= courseNumber.length; s++) {
            if ($("#course_" + s).is(":checked")) {
                var course_value = $("#course_" + s).attr('value');
                if(course_value == 62){
                    // alert(s);
                }
               
            }
             if(!$("#course_" + s).is(":checked")){
                var course_value = $("#course_" + s).attr('value');
                if(course_value == 62){
                    $("#course_7").attr('disabled',false);
                }
                if(course_value == 63){
                    $("#course_6").attr('disabled',false);
                }
                
            }
        }
    }
</script>
<script>
    $(document).ready(function(){
        $('#help_denied').fadeOut(15000);

        $('.selected_course').click(function(){
            
          var get_id =$(this).attr('data-id');
          if($('#course_'+get_id).is(':checked')){

             var course_val = $('#course_'+get_id).attr('data');
            
            $('#course_'+get_id).attr('checked',false);
            $(this).attr('style','background-color:white;');
            $('.courseName'+get_id).attr('style','color:black;');
            $('.gradeName'+get_id).attr('style','color:black;');
          }else{

            var course_val= $('#course_'+get_id).val();
            
            if(course_val == 44){
                // alert(course_val);
                var courseNumber = document.getElementsByName('course[]');

                for (i = 1; i <= courseNumber.length; i++) {
                    var courseVal =  $('#course_'+i).val();

                    $('#course_'+i).removeAttr('checked');

                    $('.selected_course'+i).attr('style','background-color:white;');
                    $('.courseName'+i).attr('style','color:black;');
                    $('.gradeName'+i).attr('style','color:black;');
                }
                $('#course_1').removeAttr('checked');
                $('#course_'+get_id).attr('checked',true);
                $('.selected_course'+i).attr('style','background-color:#ed1c24');
                $('.courseName'+get_id).attr('style','color:white;');
                $('.gradeName'+get_id).attr('style','color:white;');

            }
            $('#course_'+get_id).attr('checked',true);
            $(this).attr('style','background-color:#ed1c24');
            $('.courseName'+get_id).attr('style','color:white;');
            $('.gradeName'+get_id).attr('style','color:white;');
          }
          courseClick();
        });

        $('.course_without_image').click(function(){
          var get_id =$(this).attr('data-id');
          if($('#course_'+get_id).is(':checked')){


            $('#course_'+get_id).attr('checked',false);
            $('.course_without_image_box'+get_id).attr('style','min-height:219px;background-color:#c3eaf1;border-top-right-radius: 10px;border-top-left-radius: 10px;width:100%;text-align: center;display:table;');
            $('.without_image_course_name'+get_id).attr('style','color:black;');
            $('.without_image_course_grade'+get_id).attr('style','color:black;');
            $(this).attr('style','background-color:white;');
          }else{
            $('#course_'+get_id).attr('checked',true);
            $('.course_without_image_box'+get_id).attr('style','min-height:219px;background-color:#ed1c24;border-top-right-radius: 10px;border-top-left-radius: 10px;width:100%;text-align: center;display:table;');
            $('.without_image_course_name'+get_id).attr('style','color:white;');
            $('.without_image_course_grade'+get_id).attr('style','color:white;');
            $(this).attr('style','background-color:#ed1c24');
            $('.courseName'+get_id).attr('style','color:white;');
            $('.gradeName'+get_id).attr('style','color:white;');
           
          }
          courseClick();
       
        }); 
    })
</script>