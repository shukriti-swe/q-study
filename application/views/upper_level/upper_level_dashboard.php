<?php  

if ($user_info[0]['subscription_type'] =="direct_deposite") {
    if ( $user_info[0]['direct_deposite'] == 0 ) {
        $parent_direct_deposite = 1;
    }
}


?>

<?php if (isset($parent_direct_deposite)): ?>
    <div style="margin: 10px 25px;" >
        <img src="assets/images/rsz_59.jpg" class="img-responsive"> <br>
        <span style="color: red;"> Your subscriptions is pending . As soon as received the payment it will active. </span>
    </div>


    <div class="">
        <ul class="personal_ul personal_ul_course schedule">
            <li class="presonal"><a href="">Personal</a></li>
            <li class="presonal2"><a href="">View Progress</a></li>
            <li class="presonal2"><a href="">Course</a></li>
        </ul>

        <div ><img style="margin:20px auto;" src="assets/images/personal_n1.png" class="img-responsive"></div>
    </div>
<?php endif ?>


    <div class="row">
        <div class="col-md-7"></div>
        
        <div class="col-md-5" id="message_denied" style="display: none;">
            <p class="alert alert-success"  style="width: 90%"> 
                <b> You need to subcribe to get access full features. </b>
            </p>
        </div>
        <div class="col-md-5" id="quick_help_message_denied" style="display: none;">
            <p class="alert alert-success"  style="width: 90%"> 
                <b> This feature is not yet, comming soon </b>
            </p>
        </div>
    </div>
    <br>
<?php if (!isset($parent_direct_deposite)): ?>
<div class="">
    <!-- <ul class="personal_ul personal_ul_course schedule">
        <li class="presonal"><a href="<?php echo base_url(); ?>student_setting">Personal</a></li>
        <li class="presonal2"><a href="student_progress">View Progress</a></li>
        <li class="presonal2"><a href="view-course">Course</a></li>
    </ul> -->
    <ul class="personal_ul personal_ul_course schedule ss_shudule">
        <?php 
            $end_subscription = $user_info[0]['end_subscription'];
                if (isset($end_subscription)) {
                     $d1 = date('Y-m-d',strtotime($end_subscription));
                     $d2 = date('Y-m-d');
                }

                if ($user_info[0]['subscription_type'] =="trial") {
                        $createAt = $user_info[0]['created'];
                        $this->load->helper('commonmethods_helper');
                        $days = getTrailDate($createAt,$this->db);

                }
            if (isset($end_subscription) && $d1 > $d2) { ?>
        
            <li class="presonal">
                <a href="<?php echo base_url(); ?>student_setting">
                    <h5>Personal</h5>
                  <img src="<?= base_url('/assets/images/34_ Personal.jpg') ?>" height="40" >
              </a> </li>
            <li class="presonal2" style="padding: 10px">
                <a href="student_progress"> 
                    <h5>View Progress</h5>
             <img src="<?= base_url('/assets/images/35_ View Progress.jpg') ?>"  height="40">
            </a></li>
        <!--        <li class="presonal2"><a href="student_progress">View Progress</a></li>-->
            <li class="presonal2" style="padding: 10px"><a href="view-course"> 
                    <h5>Course</h5>
             <img src="<?= base_url('/assets/images/36_Course.jpg') ?>"  height="40" ></a>
            </li>

            <li class="presonal2" style="padding: 10px"><a href="<?php echo base_url(); ?>all_tutors_by_type/2/1"> 
                    <h5>Practice</h5>
             <img src="<?= base_url('/assets/images/practice.jpg') ?>"  height="40" ></a>
            </li>

            <li class="presonal2" style="padding: 10px;cursor: pointer;"><a id="quick_help_alert"> 
                    <h5>Quick Help From Tutor</h5>
             <img src="<?= base_url('/assets/images/quick_help.jpg') ?>" style="height: 40px;width: 50px;position: relative;top: -25px;left: 55px;"></a>
            </li>

            <!-- shvou -->
            <!-- shvou -->
            <?php 
                if ($user_info[0]['subscription_type'] =="trial") {
                    $createAt = $user_info[0]['created'];
                    $this->load->helper('commonmethods_helper');
                    $days = getTrailDate($createAt,$this->db);

                }
                if (isset($days)): ?>
                <?php if ($days < 1): ?>
                    <li class="presonal2" style="background: #eadddd !important;padding:10px;"><a href="<?php echo base_url();?>select_course"> 
                        Active Subcription
                    </li> 
                <?php endif ?>
                
                
                <?php if ($days > 0): ?>
                    <li class="presonal2" style="padding: 3px 19px;cursor: pointer;border:none;background:none;"><a href="<?php echo base_url();?>select_course"> 
                        <u><span>Buy Now</span><br><br><span> Add Course</span></u>
                        <img src="<?= base_url('/assets/images/product/juri.PNG') ?>" style="height: 40px;"></a>
                    </li>
                <?php endif ?>
            <?php endif ?>

            <?php 
                $end_subscription = $user_info[0]['end_subscription'];
                 if (isset($end_subscription)) {
                     $d1 = date('Y-m-d',strtotime($end_subscription));
                     $d2 = date('Y-m-d');
                 }
                if (isset($end_subscription) && $end_subscription != null): ?>
                <?php if (($d1 > $d2 && $user_info[0]['payment_status'] != "Cancel")){ ?>
                    <li class="presonal2" style="background: #d63832 !important;padding:10px"><a data-toggle="modal" data-target="#subscriptions_cancel" style="cursor: pointer;color:#fff !important"> 
                       <h5> Cancel Subcription</h5>
                    </a></li> 
                    
                    <li class="presonal2" style="cursor: pointer;border:none;"><a href="<?php echo base_url();?>select_course"> 
                        <u><span>Buy Now</span><br><br><span> Add Course</span></u>
                        <img src="<?= base_url('/assets/images/product/juri.PNG') ?>" style="height: 40px;"></a>
                    </li>
                 <?php }else if(($d1 < $d2 && $user_info[0]['payment_status'] != "Cancel")){ ?>
                    <li class="presonal2" style="background: #eadddd !important;padding:10px;"><a href="<?php echo base_url();?>select_course"> 
                        <h5>Active Subcriptions</h5>​</a>
                    </li> 
                <?php }else{ ?>
                    <li class="presonal2" style="background: #eadddd !important;padding:10px;"><a  data-toggle="modal" data-target="#subscriptions_active" style="cursor: pointer;">
                        <h5>Active Subcriptions</h5></a>
                    </li> 
                <?php }?>
            <?php endif ?>
        
        <!-- main condition -->
            <?php }else if(($user_info[0]['subscription_type'] =="trial" && $days > 0) || ($user_info[0]['subscription_type'] =="guest" && $user_info[0]['unlimited'] == 1)){ ?>
                <li class="presonal">
                    <a href="<?php echo base_url(); ?>student_setting">
                        <h5>Personal</h5>
                      <img src="<?= base_url('/assets/images/34_ Personal.jpg') ?>" height="40" >
                  </a> </li>
                <li class="presonal2" style="padding: 10px">
                    <a href="student_progress"> 
                        <h5>View Progress</h5>
                 <img src="<?= base_url('/assets/images/35_ View Progress.jpg') ?>"  height="40">
                </a></li>
            <!--        <li class="presonal2"><a href="student_progress">View Progress</a></li>-->
                <li class="presonal2" style="padding: 10px"><a href="view-course"> 
                        <h5>Course</h5>
                 <img src="<?= base_url('/assets/images/36_Course.jpg') ?>"  height="40" ></a>
                </li>

                <li class="presonal2" style="padding: 10px"><a href="<?php echo base_url(); ?>all_tutors_by_type/2/1"> 
                        <h5>Practice</h5>
                 <img src="<?= base_url('/assets/images/practice.jpg') ?>"  height="40" ></a>
                </li>

                <li class="presonal2" style="padding: 10px;cursor: pointer;"><a id="quick_help_alert"> 
                        <h5>Quick Help From Tutor</h5>
                 <img src="<?= base_url('/assets/images/quick_help.jpg') ?>" style="height: 40px;width: 50px;position: relative;top: -25px;left: 55px;"></a>
                </li>
                
                <?php if (($user_info[0]['subscription_type'] =="trial" && $days > 0)): ?>
                    <li class="presonal2" style="cursor: pointer;border:none;"><a href="<?php echo base_url();?>select_course"> 
                        <u><span>Buy Now</span><br><br><span> Add Course</span></u>
                        <img src="<?= base_url('/assets/images/product/juri.PNG') ?>" style="height: 40px;"></a>
                    </li>
                <?php endif ?>
            <?php }else{ ?>
            <li class="presonal subcribe_expired">
                <a style="cursor: pointer;">
                    <h5>Personal</h5>
                  <img src="<?= base_url('/assets/images/34_ Personal.jpg') ?>" height="40" >
              </a> </li>
            <li class="presonal2 subcribe_expired" style="padding: 10px">
                <a style="cursor: pointer;"> 
                    <h5>View Progress</h5>
             <img src="<?= base_url('/assets/images/35_ View Progress.jpg') ?>"  height="40">
            </a></li>
            <li class="presonal2 subcribe_expired" style="padding: 10px"><a style="cursor: pointer;"> 
                    <h5>Course</h5>
             <img src="<?= base_url('/assets/images/36_Course.jpg') ?>"  height="40" ></a>
            </li>

            <li class="presonal2 subcribe_expired" style="padding: 10px"><a style="cursor: pointer;"> 
                    <h5>Practice</h5>
             <img src="<?= base_url('/assets/images/practice.jpg') ?>"  height="40" ></a>
            </li>

            <li class="presonal2 subcribe_expired" style="padding: 10px;cursor: pointer;"><a id="quick_help_alert"> 
                    <h5>Quick Help From Tutor</h5>
             <img src="<?= base_url('/assets/images/quick_help.jpg') ?>" style="height: 40px;width: 50px;position: relative;top: -25px;left: 55px;"></a>
            </li>
            <li class="presonal2" style="background: #eadddd !important;padding:10px;"><a href="<?php echo base_url();?>select_course"> 
                        <h5>Active Subcriptions</h5>
                    </a></li>
            <?php } ?>
        </ul>

    <div ><img style="margin:20px auto;" src="assets/images/personal_n1.png" class="img-responsive"></div>
</div>
<?php endif ?>



<!-- added AS  -->
<?php 
    $end_subscription = $user_info[0]['end_subscription'];
    if (isset($end_subscription)) {
        $d1 = date('Y-m-d',strtotime($end_subscription));
        $d2 = date('Y-m-d');
        $diff = strtotime($d1) - strtotime($d2);
        $r_days = floor($diff/(60*60*24));
    }
?>
<!-- subscriptions_cancel Modal -->
<div class="modal fade" id="subscriptions_cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="max-width: 515px;">
      <div class="modal-body">
        <p class="modal-title" id="exampleModalLabel" style="padding: 5px;font-size: 20px;font-weight: bold;">Cancel Subscription?</p>
        <p style="font-weight: 500;padding: 5px;">
        Your subscription will be cancel at the end of your belling period. After <b><u><?= (isset($r_days))?$r_days:'';?></u></b> days your subscription will end no payment will be taken.<br> Change your mind any time before this date.</p> 
      </div>
    <div class="modal-footer" style="border-bottom: 1px solid #e5e5e5;border-top:none;margin-bottom: 20px;padding: 15px 50px;">
        <button type="button" class="btn btn-danger" id="cancel_subscription_form">Cancel Subscription</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Keep Subscription</button>
    </div>
    </div>
  </div>
</div>

<!-- subscriptions_active -->
<!-- Modal -->
<div class="modal fade" id="subscriptions_active" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <h5>Wellcome Back!</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="subscriptions_renew">OK</button>
        </div>
      </div>
    </div>
</div>


<script>
     $(document).ready(function(){
        $('#cancel_subscription_form').click(function(){
            $.ajax({
                url: "<?php echo base_url(); ?>both_subscription_cancel",
                type: "POST",
                processData:false,
                contentType:false,
                cache:false,
                success: function (response) {
                    alert('Subscription Cancel Successfully');
                    location.reload();
                }
            });
        })

        $('#subscriptions_renew').click(function(){
            $.ajax({
                url: "<?php echo base_url(); ?>subscription_renew",
                type: "POST",
                processData:false,
                contentType:false,
                cache:false,
                success: function (response) {
                    location.reload();
                }
            });
        })
        $('#quick_help_alert').click(function(){
           $("#message_denied").hide();
           $("#quick_help_message_denied").show();
           $("#quick_help_message_denied").fadeOut( 20000 );
        })
        
        //expired alert
        $('.subcribe_expired').click(function(){
            $("#message_denied").show();
           $("#quick_help_message_denied").hide();
           $("#message_denied").fadeOut( 20000 );
        })

    });
</script>
<style>
/* bhugi jugi */

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
    min-height: 106px;
    min-width: 176px;
    box-sizing: border-box;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
      
}
.ss_shudule li:first-child{
    border-radius: 58%;
    min-height: 128px;
    min-width: 125px;
}

.presonal:hover {
    background-color: yellow;
}

.ss_shudule li a{
    color: #000 !important;
}
.ss_shudule li h5 {
font-size: 19px;
}
.btnChngByHover {
  color: #333!important;
}
.btnChngByHover:hover {
    background-color: #0078ae;
}

.div2 {
    margin-left: 54px;
    margin: -109px;
}
</style>