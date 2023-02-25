<?php  
// echo "<pre>";print_r($user_info);die();
$parent_detail = getParentIDPaymetStatus($user_info[0]['parent_id']);

if ($parent_detail[0]['subscription_type'] =="direct_deposite") {
    if ($parent_detail[0]['direct_deposite'] == 0 ) {
        $parent_direct_deposite = 1;
    }
}

if($checkDirectDepositCourseStatus > 0 && $checkRegisterCourses == 0){
    $checkDirectDepositCourseStatus = 1;
    $parent_direct_deposite = 1;
}

?>


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

#myModalLabel{
    background: #83b6c7;
    padding: 3px 10px;
    border-radius: 5px;
    color: #fff;
}
</style>
<?php if ($user_info[0]['suspension_status'] == 1){ ?>
    <div class="row">
        <div class="col-md-5" id="message_denied">
            <p class="alert alert-success"  style="width: 100%"> 
                <b> Your registration has suspend. Please contact with Q-study</b>
            </p>
        </div>
    </div>
    <br>
    <ul class="personal_ul personal_ul_course schedule ss_shudule">
        <li class="presonal">
            <a href="">
                <h5>Personal</h5>
              <img src="" height="40" >
          </a> </li>
        <li class="presonal2" style="padding: 10px">
            <a href=""> 
                <h5>View Progress</h5>
         <img src="<?= base_url('/assets/images/35_ View Progress.jpg') ?>"  height="40">
        </a></li>
        <li class="presonal2" style="padding: 10px"><a href=""> 
                <h5>Course</h5>
         <img src="<?= base_url('/assets/images/36_Course.jpg') ?>"  height="40" ></a>
        </li>

        <li class="presonal2" style="padding: 10px"><a href=""> 
            <h5>Practice</h5>
            <img src="<?= base_url('/assets/images/practice.jpg') ?>"  height="40" ></a>
        </li>

        <li class="presonal2" style="padding: 10px;cursor: pointer;"><a id="quick_help_alert"> 
            <h5>Quick Help From Tutor</h5>
            <img src="<?= base_url('/assets/images/quick_help.jpg') ?>" style="height: 40px;width: 50px;position: relative;top: -25px;left: 55px;"></a>
        </li>
    </ul>
<?php }else{ ?>
<div class="">
    <input type="hidden" id="checkUnavailableProduct" value="<?= (isset($checkUnavailableProduct))?$checkUnavailableProduct:0;?>">
    <?php if (isset($parent_direct_deposite)): ?>
        <div style="margin: 10px 25px;" >
            <img src="assets/images/rsz_59.jpg" class="img-responsive"> <br>
            <span style="color: red;"> Your subscriptions is pending . As soon as received the payment it will active. </span>
        </div>
    <?php endif ?> 
	
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
     if ((isset($end_subscription) && $d1 > $d2) || ($user_info[0]['subscription_type'] =="trial" && $days > 0) || ($user_info[0]['subscription_type'] =="guest" && $user_info[0]['unlimited'] == 1)) { ?>
    <div class="row" class="studentAllModule" style="margin: 0 83px;text-align: center;display: flex;justify-content: center;" >
        <?php  if ($student_colaburation != 1): ?>
            <div class="col-md-2" id="q_study_homework" style="display: none;float: none;">
                <div >
                    <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>
                    <a href="<?= base_url("/")."all_tutors_by_type/2/2" ?>">
                    <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red;  " >  <b> Q-study Homework </b>  </p> <p style="color: red; text-align: center;"><b>(Everyday Study)</b>   </p>   </span>

                    </a>
                </div>
            </div>

            <div class="col-md-2" id="q_study_tutorial" style="display: none;float: none;" >
                <div >
                    <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>
                    <a href="<?= base_url("/")."all_tutors_by_type/2/1" ?>">
                    <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " ><b> Q-study Homework </b> </p> <p style="color: red; text-align: center;"><b>(Tutorial)</b>  </p> </span>
                    </a>
                </div>
            </div>
        <?php endif ?>
        <?php
                foreach ($getIdeaInfos as $ideaInfo) {

                    $modType = $ideaInfo['modtype'];

                    if ($modType == 1) {
                        $value = 'Tutorial';
                    }else if($modType == 1){
                        $value = 'Everyday Study';
                    }else if($modType == 1){
                        $value = 'Special Exam';
                    }else{
                        $value = 'Assignment';
                    } ?>

                        <div class="col-md-2" id="q_study_tutorial_">
                            <div>
                                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>
                                <a href="<?= base_url(); ?>student_report/<?= $ideaInfo['student_id']; ?>/<?= $ideaInfo['idea_id']; ?>/<?= $ideaInfo['idea_no']; ?>/<?= $ideaInfo['question_id']; ?>
                                " style="cursor: pointer;" class="subcribe_expired">
                                    <span style="color: red;">
                                        <p style="text-align: center; text-decoration: underline; color: red; "><b> Q-study Homework </b> </p>
                                        <p style="color: red; text-align: center;"><b><?php echo $value; ?></b> </p>
                                    </span>
                                </a>
                            </div>
                        </div>

                <?php
                }
                ?>

        <div class="col-md-2" id="tutor_showTutorEveyday" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>
                <a href="<?= base_url("/")."module/tutor_list/2" ?>">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Tutor Homework</b> </p> <p style="color: red; text-align: center;"><b>(Everyday Study)</b>  </p>  </span>
                </a>
            </div>
        </div>

        <div class="col-md-2" id="tutor_tutorial" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a href="<?= base_url("/")."module/tutor_list/1" ?>">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Tutor Homework</b> </p> <p style="color: red; text-align: center;"><b>(Tutorial)</b>  </p>  </span> 
                </a>


            </div>
        </div>

        <div class="col-md-2" id="tutor_spacialExam" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a href="<?= base_url("/")."module/tutor_list/3" ?>">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Tutor Homework</b> </p> <p style="color: red; text-align: center;"><b>(Spacial Exam)</b>  </p>  </span>
               </a>
            </div>
        </div>

        <div class="col-md-2" id="tutor_Assignment" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a href="<?= base_url("/")."module/tutor_list/4" ?>">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Tutor Homework</b> </p> <p style="color: red; text-align: center;"><b>(Assignment)</b>  </p>  </span>
                </a>
            </div>
        </div>




        <div class="col-md-2" id="school_showTutorEveyday" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>
                <a href="<?= base_url("/")."module/school/tutor_list/2" ?>">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>School Homework</b> </p> <p style="color: red; text-align: center;"><b>(Everyday Study)</b>  </p>  </span>
                </a>
            </div>
        </div>

        <div class="col-md-2" id="school_tutorial" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a href="<?= base_url("/")."module/school/tutor_list/1" ?>">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>School Homework</b> </p> <p style="color: red; text-align: center;"><b>(Tutorial)</b>  </p>  </span> 
                </a>


            </div>
        </div>

        <div class="col-md-2" id="school_spacialExam" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a href="<?= base_url("/")."module/school/tutor_list/3" ?>">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>School Homework</b> </p> <p style="color: red; text-align: center;"><b>(Spacial Exam)</b>  </p>  </span>
               </a>
            </div>
        </div>

        <div class="col-md-2" id="school_Assignment" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a href="<?= base_url("/")."module/school/tutor_list/4" ?>">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>School Homework</b> </p> <p style="color: red; text-align: center;"><b>(Assignment)</b>  </p>  </span>
                </a>
            </div>
        </div>
        
        <div class="col-md-2" id="corporate_showTutorEveyday" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>
                <a href="<?= base_url("/")."module/corporate/tutor_list/2" ?>">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Corporate Homework</b> </p> <p style="color: red; text-align: center;"><b>(Everyday Study)</b>  </p>  </span>
                </a>
            </div>
        </div>

        <div class="col-md-2" id="corporate_tutorial" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a href="<?= base_url("/")."module/corporate/tutor_list/1" ?>">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Corporate Homework</b> </p> <p style="color: red; text-align: center;"><b>(Tutorial)</b>  </p>  </span> 
                </a>


            </div>
        </div>

        <div class="col-md-2" id="corporate_spacialExam" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a href="<?= base_url("/")."module/corporate/tutor_list/3" ?>">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Corporate Homework</b> </p> <p style="color: red; text-align: center;"><b>(Spacial Exam)</b>  </p>  </span>
               </a>
            </div>
        </div>


        <div class="col-md-2" id="corporate_Assignment" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a href="<?= base_url("/")."module/corporate/tutor_list/4" ?>">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Corporate Homework</b> </p> <p style="color: red; text-align: center;"><b>(Assignment)</b>  </p>  </span>
                </a>
            </div>
        </div>

    </div>
    
    <?php }else{ ?>
    <div class="row" class="studentAllModule" style="margin: 0 83px;text-align: center;display: flex;justify-content: center;" >
        <div class="col-md-2" id="q_study_homework_" style="display: none;float: none;">
            <div>
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>
                <a  style="cursor: pointer;" class="subcribe_expired">

                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red;" >  <b> Q-study Homework </b>  </p> <p style="color: red; text-align: center;"><b>(Everyday Study)</b></p></span>

                </a>
            </div>
        </div>

        
        <div class="col-md-2" id="q_study_tutorial_" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>
                <a  style="cursor: pointer;" class="subcribe_expired">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " ><b> Q-study Homework </b> </p> <p style="color: red; text-align: center;"><b>(Tutorial)</b>  </p> </span>
                </a>
            </div>
        </div>

        <div class="col-md-2" id="tutor_showTutorEveyday_" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>
                <a  style="cursor: pointer;" class="subcribe_expired">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Tutor Homework</b> </p> <p style="color: red; text-align: center;"><b>(Everyday Study)</b>  </p>  </span>
                </a>
            </div>
        </div>

        <div class="col-md-2" id="tutor_tutorial_" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a  style="cursor: pointer;" class="subcribe_expired">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Tutor Homework</b> </p> <p style="color: red; text-align: center;"><b>(Tutorial)</b>  </p>  </span> 
                </a>


            </div>
        </div>

        <div class="col-md-2" id="tutor_spacialExam_" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a  style="cursor: pointer;" class="subcribe_expired">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Tutor Homework</b> </p> <p style="color: red; text-align: center;"><b>(Spacial Exam)</b>  </p>  </span>
               </a>
            </div>
        </div>

        <div class="col-md-2" id="tutor_Assignment_" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a  style="cursor: pointer;" class="subcribe_expired">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Tutor Homework</b> </p> <p style="color: red; text-align: center;"><b>(Assignment)</b>  </p>  </span>
                </a>
            </div>
        </div>




        <div class="col-md-2" id="school_showTutorEveyday_" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>
                <a  style="cursor: pointer;" class="subcribe_expired">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>School Homework</b> </p> <p style="color: red; text-align: center;"><b>(Everyday Study)</b>  </p>  </span>
                </a>
            </div>
        </div>

        <div class="col-md-2" id="school_tutorial_" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a style="cursor: pointer;" class="subcribe_expired">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>School Homework</b> </p> <p style="color: red; text-align: center;"><b>(Tutorial)</b>  </p>  </span> 
                </a>


            </div>
        </div>

        <div class="col-md-2" id="school_spacialExam_" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a style="cursor: pointer;" class="subcribe_expired">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>School Homework</b> </p> <p style="color: red; text-align: center;"><b>(Spacial Exam)</b>  </p>  </span>
               </a>
            </div>
        </div>

        <div class="col-md-2" id="school_Assignment_" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a  style="cursor: pointer;" class="subcribe_expired">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>School Homework</b> </p> <p style="color: red; text-align: center;"><b>(Assignment)</b>  </p>  </span>
                </a>
            </div>
        </div>

        <div class="col-md-2" id="corporate_showTutorEveyday_" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>
                <a  style="cursor: pointer;" class="subcribe_expired">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Corporate Homework</b> </p> <p style="color: red; text-align: center;"><b>(Everyday Study)</b>  </p>  </span>
                </a>
            </div>
        </div>

        <div class="col-md-2" id="corporate_tutorial_" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a style="cursor: pointer;" class="subcribe_expired">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Corporate Homework</b> </p> <p style="color: red; text-align: center;"><b>(Tutorial)</b>  </p>  </span> 
                </a>


            </div>
        </div>

        <div class="col-md-2" id="corporate_spacialExam_" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a  style="cursor: pointer;" class="subcribe_expired">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Corporate Homework</b> </p> <p style="color: red; text-align: center;"><b>(Spacial Exam)</b>  </p>  </span>
               </a>
            </div>
        </div>
        <div class="col-md-2" id="corporate_Assignment_" style="display: none;float: none;" >
            <div >
                <img src="assets/images/rsz_59.jpg" class="img-responsive" style="margin: 0 25%;"> <br>

                <a style="cursor: pointer;" class="subcribe_expired">
                <span style="color: red;"> <p style="text-align: center; text-decoration: underline; color: red; " > <b>Corporate Homework</b> </p> <p style="color: red; text-align: center;"><b>(Assignment)</b>  </p>  </span>
                </a>
            </div>
        </div>
    </div>
    <?php } ?>
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

            if (isset($end_subscription) && $d1 > $d2){ ?>
            <li class="presonal">
                <a href="<?php echo base_url(); ?>student_setting">
                    <h5>Personal</h5>
                  <img src="<?= base_url('/assets/images/34_ Personal.jpg') ?>" height="40" >
              </a> </li>
            <li class="presonal2" style="padding: 10px">
                <a href="<?php echo base_url(); ?>student_progress_step"> 
                    <h5>View Progress</h5>
             <img src="<?= base_url('/assets/images/35_ View Progress.jpg') ?>"  height="40">
            </a></li>
            <li class="presonal2" style="padding: 10px"><a href="<?php echo base_url(); ?>student/organization"> 
                    <h5>Course</h5>
             <img src="<?= base_url('/assets/images/36_Course.jpg') ?>"  height="40" ></a>
            </li>

            <li class="presonal2" style="padding: 10px"><a href="<?php echo base_url(); ?>all_tutors_by_type/2/1/1"> 
                    <h5>Practice</h5>
             <img src="<?= base_url('/assets/images/practice.jpg') ?>"  height="40" ></a>
            </li>

            <li class="presonal2" style="padding: 10px;cursor: pointer;"><a id="quick_help_alert"> 
                    <h5>Quick Help From Tutor</h5>
             <img src="<?= base_url('/assets/images/quick_help.jpg') ?>" style="height: 40px;width: 50px;position: relative;top: -25px;left: 55px;"></a>
            </li>
            <!-- shvou -->
            <?php 
                if ($user_info[0]['subscription_type'] =="trial") {
                    $createAt = $user_info[0]['created'];
                    $this->load->helper('commonmethods_helper');
                    $days = getTrailDate($createAt,$this->db);

                }
                if (isset($days)): ?>
                <?php if ($days < 1): ?>
                    <li class="presonal2" style="background: #eadddd !important;"><a href="<?php echo base_url();?>select_course"> 
                        <h5>Active Subcription</h5>
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
                    <?php if ($user_info[0]['user_type'] == 6){ ?>
                        <li class="presonal2" style="background: #d63832 !important;padding: 10px;"><a data-toggle="modal" data-target="#subscriptions_cancel_by_student" style="cursor: pointer;color: #fff !important;"> 
                            <h5>Cancel Subcription</h5>
                        </a></li> 
                        
                    <?php }else{ ?>
                        <li class="presonal2" style="background: #d63832 !important;padding: 10px;"><a data-toggle="modal" data-target="#subscriptions_cancel" style="cursor: pointer;color: #fff !important;"> 
                            <h5>Cancel Subcription</h5>
                        </a></li> 
                    <?php } ?>
                <?php }else if(($d1 < $d2 && $user_info[0]['payment_status'] != "Cancel")){ ?>
                    <li class="presonal2" style="background: #eadddd !important;"><a href="<?php echo base_url();?>select_course"> 
                        <h5>Active Subcription</h5>
                    </a></li> 
                <?php }else{ ?>
                    <li class="presonal2" style="background: #eadddd !important;"><a  data-toggle="modal" data-target="#subscriptions_active" style="cursor: pointer;">
                       <h5>Active Subcription</h5></a>
                    </li> 
                <?php } ?>
                
                <li class="presonal2" style="padding: 3px 29px;cursor: pointer;border:none"><a href="<?php echo base_url();?>select_course" id="quick_help_alert"> 
                    <h5><u>Buy Now Add Course</u></h5>
                    <img src="<?= base_url('/assets/images/product/juri.PNG') ?>" style="height: 40px;"></a>
                </li>
            <?php endif ?>
            
            <!-- main condition -->
            <?php }else if(($user_info[0]['subscription_type'] =="trial" && $days > 0) || ($user_info[0]['subscription_type'] =="guest" && $user_info[0]['unlimited'] == 1)){ ?>
                <li class="presonal">
                    <a href="<?php echo base_url(); ?>student_setting">
                        <h5>Personal</h5>
                      <img src="<?= base_url('/assets/images/34_ Personal.jpg') ?>" height="40" >
                  </a> </li>
                <li class="presonal2" style="padding: 10px">
                    <a href="<?php echo base_url(); ?>student_progress_step"> 
                        <h5>View Progress</h5>
                 <img src="<?= base_url('/assets/images/35_ View Progress.jpg') ?>"  height="40">
                </a></li>
                <li class="presonal2" style="padding: 10px"><a href="<?php echo base_url(); ?>student/organization"> 
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
                
                <li class="presonal2" style="padding: 3px 29px;cursor: pointer;border:none"><a href="<?php echo base_url();?>select_course" id="quick_help_alert"> 
                    <h5><u>Buy Now Add Course</u></h5>
                    <img src="<?= base_url('/assets/images/product/juri.PNG') ?>" style="height: 40px;"></a>
                </li>
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
            <li class="presonal2" style="background: #eadddd !important;padding: 10px"><a href="<?php echo base_url();?>select_course">
                    <h5>Active Subcriptions</h5>
             </li>
            <?php } ?>
        </ul>
    <?php endif ?>

    <?php if (isset($parent_direct_deposite)): ?>

        <ul class="personal_ul personal_ul_course schedule ss_shudule">
            <li class="presonal">
                <a href="<?php echo base_url(); ?>">
                    <h5>Personal</h5>
                  <img src="<?= base_url('/assets/images/34_ Personal.jpg') ?>" height="40" >
                </a> 
            </li>
            <li class="presonal2" style="padding: 10px">
                <a href="<?php echo base_url(); ?>"> 
                    <h5>View Progress</h5>
                    <img src="<?= base_url('/assets/images/35_ View Progress.jpg') ?>"  height="40">
                </a>
            </li>
            <li class="presonal2" style="padding: 10px"><a href="<?php echo base_url(); ?>"> 
                    <h5>Course</h5>
             <img src="<?= base_url('/assets/images/36_Course.jpg') ?>"  height="40" ></a>
            </li>
            <li class="presonal2" style="padding: 10px"><a href="<?php echo base_url(); ?>"> 
                    <h5>Practice</h5>
             <img src="<?= base_url('/assets/images/practice.jpg') ?>"  height="40" ></a>
            </li>

            <li class="presonal2" style="padding: 10px;cursor: pointer;"><a href="<?php echo base_url(); ?>"> 
                    <h5>Quick Help From Tutor</h5>
             <img src="<?= base_url('/assets/images/quick_help.jpg') ?>" style="height: 40px;width: 50px;position: relative;top: -25px;left: 55px;"></a>
            </li>
        </ul>


            <!-- shvou -->
            <?php 
                if ($user_info[0]['subscription_type'] =="trial") {
                    $createAt = $user_info[0]['created'];
                    $this->load->helper('commonmethods_helper');
                    $days = getTrailDate($createAt,$this->db);

                }
                if (isset($days)): ?>
                <?php if ($days < 1): ?>
                    <li class="presonal2"><a href="#"> 
                        Active Subcription
                    </li> 
                <?php endif ?>
            <?php endif ?>

    <?php endif ?>


<div>
    <?php if (count($class_rooms) ) { 
     foreach ($class_rooms as $key => $value) { ?>
        <div class="studentClassroom">
            <div><b>Tutor Information: </b> <span><?= $value[1]; ?></span> </div><br>
            <div style="display: flex;margin-left: 277px;"><b>Class Url: </b> <a style="margin: 0 5px;" href="<?= $value[0]; ?>"> <span style="color: #7c87ff;"> <?= $value[0]; ?></span> </a> </div>
        </div>
    <?php  } } ?>
    <?php if ($student_colaburation != 1  && (!isset($parent_direct_deposite))): ?>
        <?php if ($user_info[0]['student_grade'] == $gradeCheck->grade): ?>
            <div class="point-section" style="margin-top: 20px;">
                <?php if ($productPoint->recent_point > $point->targetPoint): ?>
                    <div class="congratulation">
                        <img style="margin:20px auto;width: 100px" src="<?= base_url() ?>assets/images/product/congratulations.jpg" class="img-responsive">
                    </div>
                <?php endif ?>
                <div class="row" style="padding: 10px">
                    <div class="col-md-6 text-right" style="padding: 0px;width:45%;">
                        <label>Number of Lessons: <span style="border: 1px solid #c3c3c3; border-radius:4px; padding: 3px 10px;"><?= (30 - $numOfLession)?></span></label>
                    </div>
                    <div class="col-md-6" style="margin-left:4px">
                        <label>Your Point: <span style="border: 1px solid #c3c3c3; border-radius:4px; padding: 3px 10px;"><?=($modulePoint->point)?$modulePoint->point:0;?></span></label>
                    
                        <label style="margin-left: 8px;">Target: <span style="border: 1px solid #c3c3c3; border-radius:4px; padding: 3px 10px;"><?= $point->targetPoint ?></span></label>
                    
                    </div>
                </div>
                <div class="row" style="width: 95%;margin-top:20px;">
                    <div class="col-md-6 text-right" style="padding: 0px">
                       <a href="price_dashboard"> <i class="fa fa-question-circle" style="color:#00a2e8;font-size:30px;"></i></a>
                    </div>
                    <div class="col-md-6" >
                        <?php if ($modulePoint->point > $point->targetPoint){ ?>
                            <a href="price_dashboard" class="btn btn-danger btn-sm">Click Here</a>
                        <?php }else{ ?>
                            <button class="btn btn-default" style="background:#dce6f2"> Get Prize </button>
                        <?php } ?>
                    </div>
                </div>
                <img style="margin:20px auto;width: 100px" src="<?= base_url() ?>assets/images/product/tropy.PNG" class="img-responsive">
            </div>
        <?php endif ?>
    <?php endif ?>
</div>

</div>

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

<!-- Modal -->
<div class="modal fade" id="subscriptions_cancel_by_student" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <h6 class="modal-title" id="myModalLabel">Need Parent Password</h6>
        </div>
        <div class="modal-footer">
            <!-- <form id="subscriptionCancel"  method="post"> -->
            <div class="row">
            <div class="col-md-3">
                <label>Password</label>
            </div>
            <div class="col-md-9">
                <input type="password" name="password" id="cancel_password"  class="form-control" required>
                <p class="text-danger" id="cancel_password_error"></p>
            </div>
            </div>
            <hr style="margin:10px">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary btn-sm" id="subs_cancel_by_student_submit">Submit</button>
            <!-- </form> -->
          <a href="forgot_password" style="margin-top: 5px;font-size: 13px;margin-right: 34px;">Forget Passwod</a>
        </div>
      </div>
    </div>
</div>


 <!-- Modal -->
<div class="modal" id="checkUnavailableProductModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <p  style="margin-bottom:4px">Sorry your chosen prize is unavailable in our database. You have to choose another. Sorry for the inconvenience.</p>
          <p>Thanks</p>
          <p style="color: red">Q-Study.com</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<?php } ?>


<script type="text/javascript">
    $(document).ready(function(){
        var checkUnavailableProduct = $('#checkUnavailableProduct').val();
        if(checkUnavailableProduct > 0){
            // $('#checkUnavailableProductModal').modal("toggle");
            $('#checkUnavailableProductModal').modal('show');
        }
    })
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

        $('#subs_cancel_by_student_submit').click(function(){
            var password = $('#cancel_password').val();
            if (password == '') {
                $('#cancel_password_error').html('Password must be needed !!');
                return false;
            }else{
                $('#cancel_password_error').html('');
            }
            $.ajax({
                url: "<?php echo base_url(); ?>parent_password_check",
                type: "POST",
                data:{password:password},
                success: function (response) {
                    if (response == 1) {
                        $('#subscriptions_cancel_by_student').modal('hide');
                        $('#subscriptions_cancel').modal('show');
                    }else{
                        $('#cancel_password_error').html('Password not match !!');
                        return false;
                    }
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
    q_study_homework_everyday()

    $(document).ready(function(){

        $("#message_denied").fadeOut( 20000 );
    });

    function q_study_homework_everyday() {

        var tutorId   = 2;
        var moduleType = 2;

        $.ajax({
            url: '<?php echo site_url('Student/studentsModuleByQStudy'); ?>',
            type: 'POST',
            data: {
                tutorId , moduleType 
            },
            success: function (response) {
                if (response != "no module found") {
                    $( "#q_study_homework" ).css( "display" , "inline-block" );
                }

                // q_study_homework_tutor()
            }
        });
    }

    // function q_study_homework_tutor() { 
    //     var subjectId = "all";
    //     var tutorId = 2;
    //     var moduleType = 1;
    //     var courseId = "<?= $registered_courses[0]['id'] ?>";

    //     $.ajax({
    //         url: '<?php echo site_url('Student/studentsModuleByQStudyNew'); ?>',
    //         type: 'POST',
    //         data: {
    //             subjectId , tutorId , moduleType ,  courseId
    //         }, 
    //         success: function (response) {
    //             if (response != "no module found") {
    //                 $( "#q_study_tutorial" ).css( "display" , "inline-block" );
    //             }
    //         }
    //     });
    // }

    

</script>
 
<?php  foreach ($all_teachers as $key => $value) { ?>

    <script type="text/javascript">
        var subjectId = "all";
        var tutorId = "<?= $value['id']; ?>";
        var moduleType = 1;

        $.ajax({
            url: '<?php echo site_url('Student/AssignModuleTutuorTutorial'); ?>',
            type: 'POST',
            data: {
                subjectId , tutorId , moduleType
            }, 
            success: function (response) {
                if (response != "no module found") {
                     showTutorTutorial()
                }
            }
        });

    </script>
    
<?php } ?>

<?php  foreach ($all_teachers as $key => $value) { ?>

    <script type="text/javascript">
        var subjectId = "all";
        var tutorId = "<?= $value['id']; ?>";
        var moduleType = 2;

        $.ajax({
            url: '<?php echo site_url('Student/studentsModuleByQStudy'); ?>',
            type: 'POST',
            data: {
                subjectId , tutorId , moduleType
            }, 
            success: function (response) {
                if (response != "no module found") {
                     showTutorEveyday()
                }
            }
        });

    </script>
<?php } ?>


<?php  foreach ($all_teachers as $key => $value) { ?>
    <script type="text/javascript">
        var subjectId = "all";
        var tutorId = "<?= $value['id']; ?>";
        var moduleType = 3;

        $.ajax({
            url: '<?php echo site_url('Student/studentsModuleByQStudy'); ?>',
            type: 'POST',
            data: {
                subjectId , tutorId , moduleType
            }, 
            success: function (response) {
                if (response != "no module found") {
                     showTutorspacialExam()
                }
            }
        });

    </script>
<?php } ?>


<?php  foreach ($all_teachers as $key => $value) { ?>
    <script type="text/javascript">
        var subjectId = "all";
        var tutorId = "<?= $value['id']; ?>";
        var moduleType = 4;

        $.ajax({
            url: '<?php echo site_url('Student/studentsModuleByQStudy'); ?>',
            type: 'POST',
            data: {
                subjectId , tutorId , moduleType
            }, 
            success: function (response) {
                if (response != "no module found") {
                     showTutorAssignment()
                }
            }
        });

    </script>
<?php } ?>

<script type="text/javascript">
    function showTutorTutorial() {
        $( "#tutor_tutorial" ).css( "display" , "inline-block" );
    }

    function showTutorEveyday() {
        $( "#tutor_showTutorEveyday" ).css( "display" , "inline-block" );
    }

    function showTutorspacialExam() {
        $( "#tutor_spacialExam" ).css( "display" , "inline-block" );
    }

    function showTutorAssignment() {
        $( "#tutor_Assignment" ).css( "display" , "inline-block" );
    }
</script>















<?php  foreach ($allSchoolTutors as $key => $value) { ?>

    <script type="text/javascript">
        var subjectId = "all";
        var tutorId = "<?= $value['id']; ?>";
        var moduleType = 1;

        $.ajax({
            // url: '<?php echo site_url('Student/AssignModuleSchoolTutuorTutorial'); ?>',
            url: '<?php echo site_url('Student/AssignModuleTutuorTutorial'); ?>',
            type: 'POST',
            data: {
                subjectId , tutorId , moduleType
            }, 
            success: function (response) {
                if (response != "no module found") {
                     showSchoolTutorial()
                }
            }
        });

    </script>
<?php } ?>

<?php  foreach ($allSchoolTutors as $key => $value) { ?>

    <script type="text/javascript">
        var subjectId = "all";
        var tutorId = "<?= $value['id']; ?>";
        var moduleType = 2;

        $.ajax({
            url: '<?php echo site_url('Student/AssignModuleSchoolTutuorTutorial'); ?>',
            type: 'POST',
            data: {
                subjectId , tutorId , moduleType
            }, 
            success: function (response) {
                if (response != "no module found") {
                     showSchoolEveyday()
                }
            }
        });

    </script>
<?php } ?>


<?php  foreach ($allSchoolTutors as $key => $value) { ?>
    <script type="text/javascript">
        var subjectId = "all";
        var tutorId = "<?= $value['id']; ?>";
        var moduleType = 3;

        $.ajax({
            url: '<?php echo site_url('Student/AssignModuleSchoolTutuorTutorial'); ?>',
            type: 'POST',
            data: {
                subjectId , tutorId , moduleType
            }, 
            success: function (response) {
                if (response != "no module found") {
                     showSchoolpacialExam()
                }
            }
        });

    </script>
<?php } ?>


<?php  foreach ($allSchoolTutors as $key => $value) { ?>
    <script type="text/javascript">
        var subjectId = "all";
        var tutorId = "<?= $value['id']; ?>";
        var moduleType = 4;

        $.ajax({
            url: '<?php echo site_url('Student/AssignModuleSchoolTutuorTutorial'); ?>',
            type: 'POST',
            data: {
                subjectId , tutorId , moduleType
            }, 
            success: function (response) {
                if (response != "no module found") {
                     showSchoolAssignment()
                }
            }
        });

    </script>
<?php } ?>

<script type="text/javascript">
    function showSchoolTutorial() {
        $( "#school_tutorial" ).css( "display" , "inline-block" );
    }

    function showSchoolEveyday() {
        $( "#school_showTutorEveyday" ).css( "display" , "inline-block" );
    }

    function showSchoolpacialExam() {
        $( "#school_spacialExam" ).css( "display" , "inline-block" );
    }

    function showSchoolAssignment() {
        $( "#school_Assignment" ).css( "display" , "inline-block" );
    }
</script>










<?php  foreach ($allCorporateTutors as $key => $value) { ?>

    <script type="text/javascript">
        var subjectId = "all";
        var tutorId = "<?= $value['id']; ?>";
        var moduleType = 1;

        $.ajax({
            url: '<?php echo site_url('Student/AssignModuleTutuorTutorial'); ?>',
            type: 'POST',
            data: {
                subjectId , tutorId , moduleType
            }, 
            success: function (response) {
                if (response != "no module found") {
                     showCorpotateTutorial()
                }
            }
        });

    </script>
<?php } ?>

<?php  foreach ($allCorporateTutors as $key => $value) { ?>

    <script type="text/javascript">
        var subjectId = "all";
        var tutorId = "<?= $value['id']; ?>";
        var moduleType = 2;

        $.ajax({
            url: '<?php echo site_url('Student/AssignModuleSchoolTutuorTutorial'); ?>',
            type: 'POST',
            data: {
                subjectId , tutorId , moduleType
            }, 
            success: function (response) {
                if (response != "no module found") {
                     showCorporateEveyday()
                }
            }
        });

    </script>
<?php } ?>


<?php  foreach ($allCorporateTutors as $key => $value) { ?>
    <script type="text/javascript">
        var subjectId = "all";
        var tutorId = "<?= $value['id']; ?>";
        var moduleType = 3;

        $.ajax({
            url: '<?php echo site_url('Student/AssignModuleSchoolTutuorTutorial'); ?>',
            type: 'POST',
            data: {
                subjectId , tutorId , moduleType
            }, 
            success: function (response) {
                if (response != "no module found") {
                     showCorporatepacialExam()
                }
            }
        });

    </script>
<?php } ?>


<?php  foreach ($allCorporateTutors as $key => $value) { ?>
    <script type="text/javascript">
        var subjectId = "all";
        var tutorId = "<?= $value['id']; ?>";
        var moduleType = 4;

        $.ajax({
            url: '<?php echo site_url('Student/AssignModuleSchoolTutuorTutorial'); ?>',
            type: 'POST',
            data: {
                subjectId , tutorId , moduleType
            }, 
            success: function (response) {
                if (response != "no module found") {
                     showCorporateAssignment()
                }
            }
        });

    </script>
<?php } ?>

<script type="text/javascript">
    function showCorpotateTutorial() {
        $( "#corporate_tutorial" ).css( "display" , "inline-block" );
    }

    function showCorporateEveyday() {
        $( "#corporate_showTutorEveyday" ).css( "display" , "inline-block" );
    }

    function showCorporatepacialExam() {
        $( "#corporate_spacialExam" ).css( "display" , "inline-block" );
    }

    function showCorporateAssignment() {
        $( "#corporate_Assignment" ).css( "display" , "inline-block" );
    }
</script>