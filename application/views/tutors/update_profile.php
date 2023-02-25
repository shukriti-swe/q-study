<div>
  <div class="row">
   <div class="ss_question_add">
    <div class="ss_s_b_main" style="min-height: 100vh">
      <?php if($this->session->flashdata('success_msg')): ?>
        <div class="alert alert-success alert-dismissible fade in" role="alert"> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $this->session->flashdata('success_msg') ?>
        </div>
      <?php endif; ?>
      <form action="<?php echo base_url('tutor/profile/update'); ?>" method="POST">
        <div class="col-sm-2"></div>
        <div class="col-sm-5">

          <div class="ss_t_r_top">
            <button class="ss_q_btn btn" type="submit"><i class="fa fa-save" aria-hidden="true"></i> Save</button> 
            <a href="<?php echo base_url('tutor/profile/'.$this->session->userdata('user_id')); ?>" class="ss_q_btn btn"><i class="fa fa-file-o" aria-hidden="true"></i> Preview</a> 
          </div>
          <div class="ss_t_r_bottom">
            <div class="form-group row">
              <label for="text" class="col-sm-6">Name or (Catchy tutoring name)</label>
              <div class="col-sm-6">
                <input name="name" type="text" class="form-control" id="text" value="<?php echo isset($tutor_info['name'])?$tutor_info['name']:''; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Address</label>
              <div class="col-sm-6">
                <input  name="address" type="text" class="form-control" id="text" value="<?php echo isset($tutor_info['address'])?$tutor_info['address']:''; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Subrb / City / Town</label>
              <div class="col-sm-6">
                <input  name="city" type="text" class="form-control" id="text" value="<?php echo isset($tutor_info['city'])?$tutor_info['city']:''; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">State / Province</label>
              <div class="col-sm-6">
                <input  name="state" type="text" class="form-control" id="text" value="<?php echo isset($tutor_info['state'])?$tutor_info['state']:''; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Postal Code</label>
              <div class="col-sm-6">
                <input  name="post_code" type="text" class="form-control" id="text" value="<?php echo isset($tutor_info['post_code'])?$tutor_info['post_code']:''; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Country</label>
              <div class="col-sm-6">
                <input  name="" type="text" class="form-control" id="text" value="<?php echo isset($tutor_info['country'])?$tutor_info['country']:''; ?>">
                <input type="hidden" name="country_id" value="<?php echo isset($tutor_info['country_id'])?$tutor_info['country_id']:''; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Mobile Phone</label>
              <div class="col-sm-6">
                <input  name="user_mobile" type="tel" class="form-control" id="text" value="<?php echo isset($tutor_info['user_mobile'])?$tutor_info['user_mobile']:''; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Phone Number</label>
              <div class="col-sm-6">
                <input  name="phone_num" type="tel" class="form-control" id="text" value="<?php echo isset($tutor_info['phone_num'])?$tutor_info['phone_num']:''; ?>">
              </div>
            </div>
            
            <div class="form-group row">
              <label for="text" class="col-sm-6">Email</label>
              <div class="col-sm-6">
                <input  name="user_email" type="email" class="form-control" id="text" value="<?php echo isset($tutor_info['user_email'])?$tutor_info['user_email']:''; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Website</label>
              <div class="col-sm-6">
                <input  name="website" type="text" class="form-control" id="text" value="<?php echo isset($tutor_info['website'])?$tutor_info['website']:''; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Vocabulary Point</label>
              <div class="col-sm-6">
                <input  name="" type="text" class="form-control v_point" value="1" id="text" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Numbers of Student</label>
              <div class="col-sm-6">
                <input  name="" type="number" value="<?php echo $total_std; ?>" class="form-control n_student" id="text" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="text" class="col-sm-6">Your Review</label>
              <div class="col-sm-6 ss_r_review">
                <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
              </div>
            </div>

            
            
          </div>    
          
          
        </div>
        <div class="col-sm-4 ss_r_q_area">
          <div class="form-group">
            <label for="Textarea1">Short biography</label>
            <textarea  name="short_bio" class="form-control" id="Textarea1" rows="5"><?php echo isset($tutor_info['short_bio'])?$tutor_info['short_bio']:''; ?></textarea>
          </div>
		  <div class="form-group">
            <label for="Textarea1">Subjects you want to teach</label>
            <input type="text" required="required"  name="teach_subjects" class="form-control" value="<?php echo isset($tutor_info['teach_subjects'])?$tutor_info['teach_subjects']:''; ?>">
          </div>
          <div class="form-group">
            <label for="Textarea1">Subjects tutored tutoring rates</label>
            <textarea  name="tutoring_rates" class="form-control" id="Textarea1" rows="5"><?php echo isset($tutor_info['tutoring_rates'])?$tutor_info['tutoring_rates']:''; ?></textarea>
          </div>
          <div class="form-group">
            <label for="Textarea1">Qualification</label>
            <textarea  name="qualification" class="form-control" id="Textarea1" rows="5"><?php echo isset($tutor_info['qualification'])?$tutor_info['qualification']:''; ?></textarea>
          </div>
          <div class="form-group">
            <label for="Textarea1">Availability</label>
            <textarea  name="availability" class="form-control" id="Textarea1" rows="5"><?php echo isset($tutor_info['availability'])?$tutor_info['availability']:''; ?></textarea>
          </div>
          <div class="form-group">
            <label for="Textarea1">Tution experience</label>
            <textarea  name="tuition_experience" class="form-control" id="Textarea1" rows="5"><?php echo isset($tutor_info['tuition_experience'])?$tutor_info['tuition_experience']:''; ?></textarea>
          </div>
          <div class="form-group">
            <label for="Textarea1">Language</label>
            <textarea  name="language" class="form-control" id="Textarea1" rows="5"><?php echo isset($tutor_info['language'])?$tutor_info['language']:''; ?></textarea>
          </div>
          
        </div>
        <div class="col-sm-3"> </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</section>
<!-- Modal -->
<!-- <div class="modal fade ss_modal" id="ss_sucess_mess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
</div> -->

