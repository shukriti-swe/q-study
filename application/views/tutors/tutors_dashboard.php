<?php
$school = $user_info[0]['parent_id'];
if (isset($school) && !empty($school)) {
    $school_name = $this->db->where('id',$school)->get('tbl_useraccount')->row('name');
    // echo $school_name;die();
}

if ( $user_info[0]['subscription_type'] == "direct_deposite" && $user_info[0]['direct_deposite'] == 0 ){
    $notComplete = 1;
}     

if($checkDirectDepositPendingCourse > 0 && $checkRegisterCourses == 0){
   $notComplete = 1; 
}

?>
  

<?php if (isset($notComplete)): ?>

 <div style="margin: 10px 25px;" >
    <img src="assets/images/rsz_59.jpg" class="img-responsive"> <br>
    <span style="color: red;"> Your subscriptions is pending . As soon as received the payment it will active. </span>
</div>  

<div class="row">
    <div class="">

        <ul class="personal_ul">
            <?php if ($user_info[0]['subscription_type'] == 'data_input') { ?>
                <li class="presonal2" id="inbox"><a >Inbox</a></li>
            <?php  }else{ ?>
                <li class="presonal"><a href="<?php echo base_url();?>">Personal</a></li>
                <li class="presonal2"><a href="">View Progress</a></li>
            <?php  } ?>
            <li class="presonal2"><a href="">Course</a></li>
            
            <li class="presonal2" style="padding: 3px 19px;cursor: pointer;border:none;background:none;"><a href="<?php echo base_url();?>select_course"> 
                <u><span>Buy Now</span><br><br><span> Add Course</span></u>
                <img src="<?= base_url('/assets/images/product/juri.PNG') ?>" style="height: 40px;"></a>
            </li>
        </ul>

        <div>
            <img style="margin:20px auto;" src="assets/images/personal_n1.png" class="img-responsive">
        </div>

    </div>
</div>
<?php endif ?>

<?php if (!isset($notComplete)): ?>


<?php if ($user_info[0]['suspension_status'] == 1){ ?>
    <div class="row">
        <div class="col-md-7" id="message_denied">
            <p class="alert alert-success"  style="width: 90%"> 
                <b> Your registration has suspend. Please contact with Q-study</b>
            </p>
        </div>
    </div>
    <br>

    <p class="text-center" style="font-size: 25px;font-weight: 700;color: #0078ae;"><?=(isset($school_name))?$school_name:"";?></p>
    <div class="row">
        <div class="">
            <ul class="personal_ul">
                <?php if ($user_info[0]['subscription_type'] == 'data_input') { ?>
                <li class="presonal2" id="inbox"><a >Inbox</a></li>
                <?php  }else{ ?>
                <li class="presonal"><a href="">Personal</a></li>
                <li class="presonal2" style="background: #fff !important;border:1px solid #d4b1b1!important;"><a href="">View Progress</a></li>
                <?php  } ?>
                <li class="presonal2" style="background: #fff !important;border:1px solid #d4b1b1!important;"><a href="">Course</a></li>
            </ul>
        </div>
    </div>

<?php }else{ ?>


<p class="text-center" style="font-size: 25px;font-weight: 700;color: #0078ae;"><?=(isset($school_name))?$school_name:"";?></p>
 <div class="row">
    <div class="">

        <ul class="personal_ul">
            <?php if ($user_info[0]['subscription_type'] == 'data_input') { ?>
                <li class="presonal2" id="inbox"><a >Inbox</a></li>
            <?php  }else{ ?>
                <li class="presonal"><a href="<?php echo base_url();?><?= ($inactive_user_check < 1)?'tutor_setting':''?>">Personal</a></li>
                <li class="presonal2" style="background: #fff !important;border:1px solid #d4b1b1!important; position: relative;"><a class="st_list" href="<?php echo base_url();?>tutor/tutor_students_list"><img src="assets/images/alertd_icon.png"></a> <a href="<?= ($inactive_user_check < 1)?'tutor-progress-type':''?>">View Progress</a></li>
            <?php  } ?>
            <li class="presonal2" style="background: #fff !important;border:1px solid #d4b1b1!important;"><a href="<?= ($inactive_user_check < 1)?'view-course':''?>">Course</a></li>
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
                <?php if (($d1 > $d2) && $user_info[0]['payment_status'] != "Cancel"){ ?>
                    
                    <li class="presonal2" style="background: #d63832 !important;"><a data-toggle="modal" data-target="#subscriptions_cancel" style="cursor: pointer;color: #fff !important;"> 
                        Cancel Subcription
                    </a></li>  
                    
                    <li class="presonal2" style="padding: 3px 19px;cursor: pointer;border:none;background:none;"><a href="<?php echo base_url();?>select_course"> 
                        <u><span>Buy Now</span><br><br><span> Add Course</span></u>
                        <img src="<?= base_url('/assets/images/product/juri.PNG') ?>" style="height: 40px;"></a>
                    </li>
                 <?php }else if(($d1 < $d2 && $user_info[0]['payment_status'] != "Cancel")){ ?>
                    <li class="presonal2" style="background: #eadddd !important;"><a href="<?php echo base_url();?>select_course"> 
                        Active Subcription
                    </li> 
                <?php }else{ ?>
                    <li class="presonal2" style="background: #eadddd !important;"><a  data-toggle="modal" data-target="#subscriptions_active" style="cursor: pointer;">
                        Active Subcription</a>
                    </li> 
                <?php }?>
            <?php endif ?>
        </ul>
        <div>
            <img style="margin:20px auto;" src="assets/images/personal_n1.png" class="img-responsive">
        </div>
    </div>
</div>
<?php } ?>
<?php endif ?>




<div class="modal fade ss_modal" id="set_solution" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="max-width: 400px;">
        <div class="modal-content">
          <div class="modal-header">

            <h4 class="modal-title" id="myModalLabel">Solution</h4>
          </div>
          <div class="modal-body row">
            <form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data">
                <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne1">
                  <textarea class="form-control" id="assignment_textarea" name="question_body" ></textarea>
                </div>
                <input type="submit" name="submit" class="btn btn-danger ss_q_btn" value="Save"/>
            </form>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
</div>


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

<script type="text/javascript">
    $(document).ready(function () {


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

        $("#question_form").on('submit', function(e){
            
          e.preventDefault();

          var pathname = '<?php echo base_url(); ?>';

          CKupdate();

          console.log( new FormData(this) )

          $.ajax({
            url: "save_question_data",
            type: "POST",
            data: new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            success: function (response) {
              var data = jQuery.parseJSON(response);

              alert('Added Successfully');
              
              $("#error_msg").text('');
              if(data.flag == 1){
                $("#preview_btn").show();
                        $("#preview_btn").attr("href", pathname+'question_preview/'+question_item+'/'+data.question_id);//today 20/7/18
                        $("#ss_sucess_mess").modal('show');
                      }if(data.flag == 0){
                        $("#error_msg").text(data.msg);
                      }
                    }
                  });
        });

        function CKupdate() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }

        $("#inbox").click(function(){
            $("#set_solution").modal('show');
        });

        CKEDITOR.replace('assignment_textarea',{
            extraPlugins : 'simage,spdf,sdoc,ckeditor_wiris,sppt',
            filebrowserBrowseUrl: '/assets/uploads?type=Images',
            filebrowserUploadUrl: 'imageUpload',
            toolbar: [
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                { name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage','SPdf','SDoc','SPpt' ] },
                '/',
                    { name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'Image', 'addFile'] }, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                // Line break - next group will be placed in new line.
                '/',
                { name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
                { name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
            ]
        });
        
        
    });
</script>
<script type="text/javascript">
    $(".btn_blue").click(function(){
           console.log(x)
        });
</script>
<style type="text/css">
    .st_list{
            position: absolute;
            top: -40px;
            left: 0;
            right: 0;
            margin: auto;
    }
    .st_list img{
        width: 30px;
    }
</style>