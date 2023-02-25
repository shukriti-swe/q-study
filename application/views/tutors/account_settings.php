<section class="main_content ss_sign_up_content bg-gray animatedParent">
  <div class="container-fluid container-fluid_padding">     
    <div class="container">
      <div class="row">

        <div class="col-md-10 text-center col-md-offset-1">
          <?php if ($this->session->userdata('success_msg')) : ?>
            <div class="alert alert-success alert-dismissible show" role="alert">
              <strong><?php echo $this->session->userdata('success_msg'); ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php elseif ($this->session->userdata('error_msg')) : ?>
            <div class="alert alert-danger alert-dismissible show" role="alert">
              <strong><?php echo $this->session->userdata('error_msg'); ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
              </button>
            </div>
                <?php endif; ?>
        </div>         
        <div class="">
          <div class="col-md-10 col-md-offset-1">
            <p class="accordion_new">
              <a class="btn btn-primary" href="" role="button" aria-expanded="" aria-controls="">Account Settings</a>
            </p>
            <div class="">
              <div class="col">
                <div class=" accordion_body2" >
                  <div class="card card-body">
                    <div class="row">
                      <form class="form-horizontal" id="t_tutor_details" method="post" action="tutor/account/settings">     
                        <div class="col-md-6 bottom10">
                          <p id="success" style="color:green;"></p>
                          <p id="error" style="color:red;"></p>
                          <div class="form-group">
                            <div class="text-left col-sm-4"><label class="control-label" for="email">User Name:</label></div>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="name" value="<?php echo $user_info[0]['name'];?>" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="text-left col-sm-4"><label class="control-label" for="email">User Email:</label></div>
                            <div class="col-sm-8">
                              <input type="email" class="form-control" id="name" value="<?php echo $user_info[0]['user_email'];?>" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="text-left col-sm-4"><label class="control-label" for="email">Paypal Account</label></div>
                            <div class="col-sm-8">
                              <input type="email" class="form-control" id="paypal_account" name="paypal_account" value="<?php echo isset($accounts->paypal_account)?$accounts->paypal_account:''; ?>" >
                            </div>
                          </div>   

                          <div class="form-group">
                            <div class="text-left col-sm-4"><label class="control-label" for="email">Credit Card</label></div>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="credit_card" name="credit_card" value="<?php echo isset($accounts->credit_card)?$accounts->credit_card:''; ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="text-left col-sm-4"><label class="control-label" for="email">Bank Account</label></div>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="bank_account" name="bank_account" value="<?php echo isset($accounts->bank_account)?$accounts->bank_account:''; ?>">
                            </div>
                          </div>



                        </div>                
                        <div class="col-md-3 bottom10 text-center">
                          <a href="#"><b></b></a>
                        </div>

                        <div class="col-md-3 bottom10">
                          <ul class="setting_ul">
                          <!-- <li><a href="#"><img src="assets/images/menu_n1.png"></a></li>
                          <li><a onclick="upDateStudentProfile();"><img src="assets/images/menu_n2.png"></a></li>  -->
                          <li><button type="submit" class="btn btn-default"><i class="fa fa-check"></i> Save</button></li>
                          <li><button type="button" class="btn btn-default" onclick="window.location.reload();"><i class="fa fa-times"></i> Cancel</button></li>
                          
                        </ul>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>