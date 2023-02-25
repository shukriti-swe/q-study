<?php   

if($checkDirectDepositPendingCourse > 0 && $checkRegisterCourses == 0){
   $notComplete = 1; 
}

?>
<?php if (isset($notComplete)): ?>
<div class="">
    <div style="margin: 10px 25px;" >
        <img src="assets/images/rsz_59.jpg" class="img-responsive"> <br>
        <span style="color: red;"> Your subscriptions is pending . As soon as received the payment it will active. </span>
    </div>  

	<ul class="personal_ul">
		<li class="presonal"><a href="<?php echo base_url();?>">Personal</a></li>
		<li class="presonal2"><a href="">View Progress</a></li>
		
        <li class="presonal2" style="padding: 3px 19px;cursor: pointer;border:none;background:none;"><a href="<?php echo base_url();?>select_course"> 
            <u><span>Buy Now</span><br><br><span> Add Course</span></u>
            <img src="<?= base_url('/assets/images/product/juri.PNG') ?>" style="height: 40px;"></a>
        </li>
	</ul>

	<div ><img style="margin:20px auto;" src="assets/images/personal_n1.png" class="img-responsive"></div>

</div>
<?php endif ?>

<?php if (!isset($notComplete)): ?>
<div class="">

	<ul class="personal_ul">
		<li class="presonal"><a href="<?php echo base_url();?><?= ($inactive_user_check < 1)?'corporate_setting':''?>">Personal</a></li>
		<li class="presonal2"><a href="<?= ($inactive_user_check < 1)?'student_progress':''?>">View Progress</a></li>
		
        <li class="presonal2" style="padding: 3px 19px;cursor: pointer;border:none;background:none;"><a href="<?php echo base_url();?>select_course"> 
            <u><span>Buy Now</span><br><br><span> Add Course</span></u>
            <img src="<?= base_url('/assets/images/product/juri.PNG') ?>" style="height: 40px;"></a>
        </li>
	</ul>

	<div ><img style="margin:20px auto;" src="assets/images/personal_n1.png" class="img-responsive"></div>

</div>
<?php endif ?>
