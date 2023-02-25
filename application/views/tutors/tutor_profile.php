<?php
  // echo "<pre>";
  // print_r($tutor_info);die();
?>
<style>
  .form-group.row input{
    background-color: #71b8d6;
    color: #fff;
  }
  .ss_t_r_bottom .form-group.row label{
        margin-top:11px;
    }
</style>

<div>
 
 <div class="row">
   <div class="ss_question_add">
    <div class="ss_s_b_main " style="min-height: 100vh">
    <div class="text-center row">
      <p class="alert alert-success" id="tutorNotReady__" style="margin: 2px 30%;display: none;"  > 
        <b>You need to registration Q-Study to get this tutor.</b>
      </p>
      <p class="alert alert-success" id="tutorNotReady" style="margin: 2px 25%;display: none;"  > 
        <b> Tutor is not ready yet to join with student. Please contact with tutor </b>
      </p>
      <div class="col-sm-5">
        <b style="float: right;"> Ref. Link No:</b>
      </div>
      <?php
        $user_id = $this->session->userdata('user_id');
        if (isset($user_id)) { ?>
          <?php
            $subcription = $tutor_info['end_subscription'];
            if (isset($subcription) && !empty($subcription)){
              $end_subscription = $tutor_info['end_subscription'];
              $date1 = date('Y-m-d',$end_subscription);
              $date2 = date('Y-m-d');
             ?>
              <div class="col-sm-1" style="margin: 0;padding: 0;">
                <a  onclick="getTutorBySCTlink('<?= ($date2 < $date1)? 1: 0;?>')" style="color:red;font-weight: bold;padding: 0;cursor: pointer;"> <?=$tutor_info['SCT_link'] ?> </a> 
              </div>
            <?php } else{ ?>
              <div class="col-sm-1" style="margin: 0;padding: 0;">
                <a  onclick="getTutorBySCTlink(0)" style="color:red;font-weight: bold;padding: 0;cursor: pointer;"> <?=$tutor_info['SCT_link'] ?> </a> 
              </div>
            <?php } ?>
        <?php }else{ ?>
          <div class="col-sm-1" style="margin: 0;padding: 0;">
            <a  onclick="getTutorBySCTlink(3)" style="color:red;font-weight: bold;padding: 0;cursor: pointer;"> <?=$tutor_info['SCT_link'] ?> </a> 
          </div>
        <?php } ?>
      <div class="col-sm-4">
        <p style="float: left;margin: -3px 0px;">(Click this link to get this tutor)</p>

      </div>
    </div>
      <form action="" id="t_tutor_details">
        <div class="col-xs-2"></div>
        <div class="col-sm-4">
          
          
          <div class="ss_t_r_bottom">
            <div class="form-group row">
              <label for="text" class="col-sm-6">Name</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="text" value="<?php echo isset($tutor_info['name'])?$tutor_info['name']:''; ?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Address</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" value="<?php echo isset($tutor_info['address'])?$tutor_info['address']:''; ?>" id="text" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Subrb / City / Town</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="text" value="<?php echo isset($tutor_info['city'])?$tutor_info['city']:''; ?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">State / Province</label>
              <div class="col-sm-6">
                <input value="<?php echo isset($tutor_info['state'])?$tutor_info['state']:''; ?>" type="text" class="form-control" id="text" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Postal Code</label>
              <div class="col-sm-6">
                <input type="text" value="<?php echo isset($tutor_info['post_code'])?$tutor_info['post_code']:''; ?>" class="form-control" id="text" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Country</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="text" value="<?php echo isset($tutor_info['country'])?$tutor_info['country']:''; ?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Mobile Phone</label>
              <div class="col-sm-6">
                <input type="tel" class="form-control" id="text" value="<?php echo isset($tutor_info['user_mobile'])?$tutor_info['user_mobile']:''; ?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Phone Number</label>
              <div class="col-sm-6">
                <input type="tel" class="form-control" id="text" value="<?php echo isset($tutor_info['phone_num'])?$tutor_info['phone_num']:''; ?>" readonly>
              </div>
            </div>
            
            <div class="form-group row">
              <label for="text" class="col-sm-6">Email</label>
              <div class="col-sm-6">
                <input type="email" class="form-control" id="text" value="<?php echo isset($tutor_info['user_email'])?$tutor_info['user_email']:''; ?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Website</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="text" value="<?php echo isset($tutor_info['website'])?$tutor_info['website']:''; ?>" readonly>
              </div>
            </div>
            
            <div class="form-group row">
              <label for="text" class="col-sm-6">Average Review</label>
              <div class="col-sm-6 ss_r_review">
                <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
              </div>
            </div>

                      
            <div class="form-group row">
              <label for="text" class="col-sm-6">Vocabulary point</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="text" value="<?php echo isset($word_approved)?$word_approved:0; ?>" readonly>
              </div>
            </div>


          </div>    
          
          
        </div>
        <div class="col-sm-4 ss_r_q_area">
          <div class="form-group">
            <h5 for="Textarea1">Short biography</h5>
            <p><?php echo isset($tutor_info['short_bio'])?$tutor_info['short_bio']:''; ?></p>
          </div>
      <div class="form-group">
            <h5>Subjects you want to teach</h5>
            <p><?php echo isset($tutor_info['teach_subjects'])?$tutor_info['teach_subjects']:''; ?></p>
          </div>
          <div class="form-group">
            <h5>Subjects tutored tutoring rates</h5>
            <p><?php echo isset($tutor_info['tutoring_rates'])?$tutor_info['tutoring_rates']:''; ?></p>
          </div>
          <div class="form-group">
            <h5 for="Textarea1">Qualification</h5>
            <p><?php echo isset($tutor_info['qualification'])?$tutor_info['qualification']:''; ?></p>
          </div>
          <div class="form-group">
            <h5 for="Textarea1">Availability</h5>
            <p><?php echo isset($tutor_info['availability'])?$tutor_info['availability']:''; ?></p>
          </div>
          <div class="form-group">
            <h5 for="Textarea1">Tution experience</h5>
            <p><?php echo isset($tutor_info['tuition_experience'])?$tutor_info['tuition_experience']:''; ?></p>
          </div>
          <div class="form-group">
            <h5 for="Textarea1">Language</h5>
            <p><?php echo isset($tutor_info['language'])?$tutor_info['language']:''; ?></p>
          </div>
          
        </div>
        <div class="col-sm-4"> </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</section>
<!-- Modal -->
<div class="modal fade ss_modal" id="ss_sucess_mess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <img src="assets/images/icon_info.png" class="pull-left"> <span class="ss_extar_top20">Save Sucessfully</span> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
        
      </div>
    </div>
  </div>
</div>


<script>
  function getTutorBySCTlink(num){
    if (num == 0) {
      $('#tutorNotReady').show();
      $('#tutorNotReady').fadeOut(50000);
    }else if(num == 3){
      $('#tutorNotReady__').show();
      $('#tutorNotReady__').fadeOut(50000);
    }
  }
</script>