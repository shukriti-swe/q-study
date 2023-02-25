<style type="text/css">
    .btn_next{
        margin-top: 50px;
    }
    .registrationComplete {
    /* margin-top: 40px; */
    margin: -26px 40% !important;
}

.logo_image {
    width: 353px
}
.top_signup{
    display: none;
}
</style>

<?php echo $header; ?>
<?php echo $header_sign_up; ?> 

<div class="container ss_compleate ss_r_compleate">
    <h3 style="font-size: 16px" class="registrationComplete">Registration Completed</h3>
    <div class="row">
            
            <br/><br/>
            <!-- <h4><img src="assets/images/icon_logo_small.png"> Hello,<?php echo isset($mail_user_info[0]['name'])?$mail_user_info[0]['name']:'';?> </h4> -->

        <div class="col-xs-2 col-sm-2">
            <img src="assets/images/r_c_l.png" class="img-responsive">
        </div>
        <div class="col-xs-8 col-sm-8">
            <h4> Hello,<?php echo isset($mail_user_info[0]['name'])?$mail_user_info[0]['name']:'';?> </h4>
            <br/>
            <p>Congratulations for registration with Q-Study. Your registration has been successfully completed.
We sent an email to your account. Please keep them in your supervision for further login. </p>

            <p style="display: flex;"> Thanks for using the <a href="<?= base_url() ?>" style="color: red" >&nbsp; Q-Study.com</a> </p>
            <p>

                <p></p>
                <p></p>
                <p style="color: red;"> Note: If you don't see a confirmation e-mail than please check your bulk/spam folder.</p>
                <p style="color: red;"> We sent a sms to your mobile for account details.  </p>
                <?php echo (isset($mail_user_info[0]['user_type']) && $mail_user_info[0]['user_type'] == 3)?'<p style="color: red;">Your whiteboard will activate with in one days.  </p>':'';?>
                
                <?php if ($registration_type == 0 || $reg_type == 'trial' ) { ?>
                    <a href="<?php echo base_url();?>home_page" class="btn btn_next">Finish</a>
                <?php } else { ?>
                    <a href="<?php echo base_url();?>home_page" class="btn btn_next">Finish</a>
                <?php }?>

                <!-- <a href="<?php echo base_url();?>home_page" class="btn btn_next">Finish</a> -->
                
            </p>
            <div class="ss_b_r_complete">
                <img src="assets/images/sign_btm.png" class="image-responsive">
            </div>
        </div>
        <div class="col-xs-2 col-sm-2">
            <img src="assets/images/r_c_r.png" class="img-responsive">
        </div>
    </div>
</div>
</div>
</section>
<?php echo $footer; ?>
