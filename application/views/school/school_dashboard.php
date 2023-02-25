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
        <li class="presonal2" style="background: #fff !important;border:1px solid #d4b1b1!important;"><a href="">View Progress</a></li>
        <li class="presonal2" style="background: #fff !important;border:1px solid #d4b1b1!important;"><a href="">Course</a></li>
    </ul>
<?php } else{ ?>
<div class="">
    <p class="text-center" style="font-size: 25px;font-weight: 700;color: #0078ae;"><?=$user_info[0]['name'];?></p>
    <ul class="personal_ul">
        <li class="presonal"><a href="<?php echo base_url(); ?>school_setting">Personal</a></li>
        <li class="presonal2" style="background: #fff !important;border:1px solid #d4b1b1!important;"><a href="student_progress">View Progress</a></li>
        <li class="presonal2" style="background: #fff !important;border:1px solid #d4b1b1!important;"><a href="view-course">Course</a></li>
        <!-- shvou -->
        <?php 
            if ($user_info[0]['subscription_type'] =="trial") {
                $createAt = $user_info[0]['created'];
                $this->load->helper('commonmethods_helper');
                $days = getTrailDate($createAt,$this->db);

            }
            if (isset($days)): ?>
            <?php if ($days < 1): ?>
                <li class="presonal2" style="background: #eadddd !important;"><a href="#"> 
                    Active Subcription
                </li> 
            <?php endif ?>
        <?php endif ?>
        <!-- shvou -->
    </ul>

    <div >
        <img style="margin:20px auto;" src="assets/images/personal_n1.png" class="img-responsive">
    </div>
</div>
<?php } ?>

