<?php if ($user_info[0]['suspension_status'] == 1){ ?>
	<div class="row ml-20">
        <div class="col-md-8" id="message_denied">
            <p class="alert alert-success"  style="width: 90%"> 
                <b> Your registration has suspend. Please contact with Q-study</b>
            </p>
        </div>
    </div>
    <br>

	<ul class="personal_ul" disabled="disabled">
		<li class="presonal"><a href="">Personal</a></li>
		<li class="presonal2"><a href="">View Progress</a></li>
	</ul>
<?php } else{ ?>
<div class=""> 

	<?php if ( $user_info[0]['subscription_type'] =="direct_deposite" && $user_info[0]['direct_deposite'] == 0 ) { ?>
		<div style="margin: 10px 25px;" >
			<img src="assets/images/rsz_59.jpg" class="img-responsive"> <br>
			<span style="color: red;"> Your subscriptions is pending . As soon as received the payment it will active. </span>
		</div>

		<ul class="personal_ul" disabled="disabled">
			<li class="presonal"><a href="">Personal</a></li>
			<li class="presonal2"><a href="">View Progress</a></li>
		</ul>

	<?php }else { ?>
		<ul class="personal_ul">
			<li class="presonal"><a href="<?php echo base_url();?>parent_setting">Personal</a></li>
			<li class="presonal2"><a href="student_progress">View Progress</a></li>
		</ul>
	<?php } ?>

	<div ><img style="margin:20px auto;" src="assets/images/personal_n1.png" class="img-responsive"></div>


</div>
<?php } ?>