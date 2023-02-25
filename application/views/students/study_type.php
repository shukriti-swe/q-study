<style>
ul.personal_ul li:first-child {
    margin-right: 5px;
}

ul.personal_ul li {
    margin-right: 5px;
}
.presonal2 a {
    color:#fff !important;
}
.presonal2 {
    background-color: #EB1F28 !important;
}
.presonal {
    background-color: #006F8C !important;
}
.ss_shudule li img{
max-height: 51px
}
.ss_shudule li{
    background: #fff !important;
    border:1px solid #cbbebe;
    border-radius: 20px;
    padding: 20px;
    min-height: 125px;
    min-width: 176px;
}

</style>

<style type="text/css">
li.presonal3 {
    border-radius: 50%;
    min-height: 0px;
    min-width: 0px;
}

li.presonal4 {
    border-radius: 50%;
    min-height: 0px;
    min-width: 0px;
}

</style>

<style type="text/css">

.presonal:hover {
    background-color: yellow;
}

.ss_shudule li a{
    color: #000 !important;
}
.ss_shudule li h5 {
font-size: 18px;
}
.btnChngByHover {
  color: #333!important;
}
.btnChngByHover:hover {
    background-color: #0078ae;
}

</style>

<div class="">

    <ul class="personal_ul personal_ul_course schedule ss_shudule">

    	<?php if ($types == 1) { ?>
    		<li class="presonal2">
	            <a href="<?php echo base_url(); ?>all_tutors_by_type/2/1"> 
	                <h5>Tutorial</h5>
	         <img src="<?= base_url('/assets/images/41_Tutorial.png') ?>"  height="40">
	        </a></li>

	        <li class="presonal2">
	            <a href="<?php echo base_url(); ?>all_tutors_by_type/2/2"> 
	                <h5>Everyday Study</h5>
	         <img src="<?= base_url('/assets/images/42_Everyday Study.png') ?>"  height="40">
	        </a></li>

	        <?php if ($user_info[0]['country_id'] != 1) { ?>
	        	<li class="presonal3">
		            <a href="<?php echo base_url(); ?>tutor/search"> 
		                <h5>Find Tutor</h5>
		         <img src="<?= base_url('/assets/images/icon_find_tutorial.png') ?>"  height="40">
		        </a></li>
	        <?php } ?>

	        

	        <li class="presonal4" onclick="Whiteboard()">
	            <a href="std-whiteboard-items"> 
	                <h5>Whiteboard</h5>
	         <img src="<?= base_url('/assets/images/icon_w_board.png') ?>"  height="40">
	        </a></li>
    	<?php } ?>

    	<?php if ($types == 2) { ?>

    		<li class="presonal2">
	            <a href="<?php echo base_url(); ?>module/tutor_list/1"> 
	                <h5>Tutorial</h5>
	         <img src="<?= base_url('/assets/images/41_Tutorial.png') ?>"  height="40">
	        </a></li>

	        <li class="presonal2">
	            <a href="<?php echo base_url(); ?>module/tutor_list/2"> 
	                <h5>Everyday Study</h5>
	         <img src="<?= base_url('/assets/images/42_Everyday Study.png') ?>"  height="40">
	        </a></li>

	        <li class="presonal2">
	            <a href="<?php echo base_url(); ?>module/tutor_list/3"> 
	                <h5>Spacial Exam</h5>
	         <img src="<?= base_url('/assets/images/43_Special Exam.png') ?>"  height="40">
	        </a></li>

	        <li class="presonal2">
	            <a href="<?php echo base_url(); ?>module/tutor_list/4"> 
	                <h5>Assignment</h5>
	         <img src="<?= base_url('/assets/images/44_Assignment.png') ?>"  height="40">
	        </a></li>

    	<?php } ?>	

    	<?php if ($types == 3) { ?>

    		<li class="presonal2">
	            <a href="<?php echo base_url(); ?>module/school/tutor_list/1"> 
	                <h5>Tutorial</h5>
	         <img src="<?= base_url('/assets/images/41_Tutorial.png') ?>"  height="40">
	        </a></li>

	        <li class="presonal2">
	            <a href="<?php echo base_url(); ?>module/school/tutor_list/2"> 
	                <h5>Everyday Study</h5>
	         <img src="<?= base_url('/assets/images/42_Everyday Study.png') ?>"  height="40">
	        </a></li>

	        <li class="presonal2">
	            <a href="<?php echo base_url(); ?>module/school/tutor_list/3"> 
	                <h5>Spacial Exam</h5>
	         <img src="<?= base_url('/assets/images/43_Special Exam.png') ?>"  height="40">
	        </a></li>

	        <li class="presonal2">
	            <a href="<?php echo base_url(); ?>module/school/tutor_list/4"> 
	                <h5>Assignment</h5>
	         <img src="<?= base_url('/assets/images/44_Assignment.png') ?>"  height="40">
	        </a></li>

    	<?php } ?>	

    	<?php if ($types == 4) { ?>

    		<li class="presonal2">
	            <a href="<?php echo base_url(); ?>module/corporate/tutor_list/1"> 
	                <h5>Tutorial</h5>
	         <img src="<?= base_url('/assets/images/41_Tutorial.png') ?>"  height="40">
	        </a></li>

	        <li class="presonal2">
	            <a href="<?php echo base_url(); ?>module/corporate/tutor_list/2"> 
	                <h5>Everyday Study</h5>
	         <img src="<?= base_url('/assets/images/42_Everyday Study.png') ?>"  height="40">
	        </a></li>

	        <li class="presonal2">
	            <a href="<?php echo base_url(); ?>module/corporate/tutor_list/3"> 
	                <h5>Spacial Exam</h5>
	         <img src="<?= base_url('/assets/images/43_Special Exam.png') ?>"  height="40">
	        </a></li>

	        <li class="presonal2">
	            <a href="<?php echo base_url(); ?>module/corporate/tutor_list/4"> 
	                <h5>Assignment</h5>
	         <img src="<?= base_url('/assets/images/44_Assignment.png') ?>"  height="40">
	        </a></li>

    	<?php } ?>	


    </ul>

</div>
