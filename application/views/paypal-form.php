<?php
// echo "<pre>";
// print_r($payment_process); die();
/*$this->db->select('*');
$this->db->from('tbl_paypal_key');
$this->db->where('type',0);
$api_key=$this->db->get()->result_array();*/

if ($payment_process == 1) {
    $cmd = '_xclick-subscriptions';
    $notify_url = "https://q-study.com/paypal_notify"; 
    $payment = 'Subscribe';
}elseif($payment_process == 2){
    $cmd = '_xclick';
    $notify_url = "https://q-study.com/no_debit_paypal_notify";
    $payment = 'Payment';
}

//echo $cmd;die();
?>
<?php echo $header; ?>
<?php echo $header_sign_up; ?> 

<div class="card-header">
    <?= $payment ?> Now
</div>
<div class="card-body">
    
    <p class="card-text"><?= $payment ?> with any of these</p>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            
            <!-- paypal -->
            <form action="<?php echo $url;?>" method="post">
                <input type="hidden" name="cmd" value="<?= $cmd ?>">
                <input type="hidden" name="business" value="<?php echo $business_key;?>">
                <input type="hidden" name="item_name" value="<?php echo $package;?>">
                <input type="hidden" name="item_number" value="1">
                <?php if ($courseId !='') { ?>
                    <input type="hidden" name="custom" value="<?php echo $user_id.','.$paymentType.','.$courseId;?>"><!-- user_id,payment_method -->
                <?php } else { ?>
                    <input type="hidden" name="custom" value="<?php echo $user_id.','.$paymentType;?>"><!-- user_id,payment_method -->
                <?php } ?> 
                
                <?php if ($payment_process == 2){ ?>
                        <input type="hidden" name="amount" value="<?php echo $amount;?>"> <!-- plan price -->
                    
                <?php }else{ ?>
                    <?php if ($paymentType==1) { ?>
                        <input type="hidden" name="a3" value="<?php echo $amount;?>"> <!-- plan price -->
                        <input type="hidden" name="p3" value="1"> <!-- plan duration -->
                        <input type="hidden" name="t3" value="M"> <!-- plan duration: ex:D W M Y -->    
                    <?php } elseif ($paymentType==2) { ?>
                        <input type="hidden" name="a3" value="<?php echo $amount;?>"> <!-- plan price -->
                        <input type="hidden" name="p3" value="6"> <!-- plan duration -->
                        <input type="hidden" name="t3" value="M"> <!-- plan duration: ex:D W M Y -->
                    <?php } elseif ($paymentType==3) { ?>
                        <input type="hidden" name="a3" value="<?php echo $amount;?>"> <!-- plan price -->
                        <input type="hidden" name="p3" value="1"> <!-- plan duration -->
                        <input type="hidden" name="t3" value="Y"> <!-- plan duration: ex:D W M Y -->
                    <?php } elseif ($paymentType==4) { ?>
                        <input type="hidden" name="a3" value="<?php echo $amount;?>"> <!-- plan price -->
                        <input type="hidden" name="p3" value="3"> <!-- plan duration -->
                        <input type="hidden" name="t3" value="M"> <!-- plan duration: ex:D W M Y -->
                    <?php }?>

                <?php } ?>
                
                
                <input type="hidden" name="rm" value="2"> <!--return method: send data by post method -->
                <input type="hidden" name="src" value="1"> <!-- subscription recur -->
                <!-- cancel,return,notify url-->
                <input type='hidden' name='return' value="<?php echo base_url();?>">
                <input type='hidden' name='cancel_return' value="<?php echo base_url();?>">
                <input type='hidden' name='notify_url' value="<?= $notify_url;?>">
                <input type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribe_LG.gif" alt="Subscribe">
                 <!--<input type="image" src="https://www.paypalobjects.com/en_GB/SG/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal"> -->
            </form>
        </div>
        <!-- paypal -->
        
    </div>
</div>



<?php echo $footer; ?>