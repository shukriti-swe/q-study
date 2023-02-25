<?php echo $header; ?>
<?php echo $header_sign_up; ?>   
<div class="container ss_reg_form">
  <div class="row">
   <div class="col-sm-6 col-sm-offset-3">
    <?php if ($this->session->userdata('token_error')) {
      echo $this->session->userdata('token_error');
      $this->session->unset_userdata('token_error');
    }?>
    <form class="row" id="tutor_form">
      <p id='form_error'></p>
      <div class="col-sm-3">
      </div>
      <div class="col-sm-6">
        <h3 class="g_heading">All fields are mandatory</h3>
        <div class="form-group">
          <label for="tutor_name">Tutor’s Name </label>
          <input class="form-control" type="text" id="tutor_name" name="tutor_name" />
          <p id="error_tutor_name" style="color:red"></p>
        </div>
        <div class="form-group">
          <label for="email">Email Adress </label>
          <input class="form-control" type="email" id="email" name="email"/>
          <span class="ss_info">Your email adress also your username</span>
          <p id="error_email" style="color:red"></p>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input class="form-control" type="password" id="password" name="password"/>
          <p id="error_pass" style="color:red"></p>
        </div>
        <div class="form-group">
          <label for="cnfpassword">Confirm Password</label>
          <input class="form-control" type="cnfpassword" id="cnfpassword" name="cnfpassword"/>
          <p id="error_cnfpass" style="color:red"></p>
        </div>
              <!-----------
              <div class="form-group">
                <label for="">Mobile No</label>
                <input class="form-control" type="tel" id="mobile" name="mobile">
                <p id="error_mobile" style="color:red"></p>
                <span class="ss_info">Mobile number is essential for keeping track of student’s progress.</span>
              </div>
              --------->
              <div class="form-group">
                <label>Country: </label>
                <input class="form-control" type="text" id="country" value="<?php echo $country_db[0]['countryName'];?>" name="" readonly />
                <input type="hidden" id="country_code" />         
              </div>
              
              <div class="form-group">
                <button class="btn btn_next" id="btnSave">
                  <img src="<?php echo base_url();?>assets/images/icon_save.png"/>Submit
                </button>
              </div>
            </div>
            
            <div class="col-sm-3">
            </div>
            
          </form>
          
          <br/><br/>
        </div>
      </div>
    </div>
  </div>
</section>

<div id="ss_confirm_mobile"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form  method="post" id="tutor_otp_modal">
        
        <div class="modal-body">
          
          <p>
            <img src="<?php echo base_url();?>assets/images/icon_logo_small.png">
          </p>
          <p>
            Congratulations your registration almost done. Enter the verification code that has been send to Your mobile number and press submit. lf the mobile number is not valid or you have not received andy code, press cancel and re-enter your mobile number and submit.
          </p>
          <br/>
          <p id="token_error" style="color:red"></p>
          <div class="form-group">
            <label>Enter code</label>
            <input class="form-control" type="text" id="" name="random"/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn_blue" data-dismiss="modal">Cancel</button>       
          <button class="btn btn_blue" type="button" id="tutor_otp_check">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>
<script>
  <?php if ($country_db[0]['countryCode'] !='any') { ?>
    // $("#mobile").intlTelInput({
		// initialCountry:'<?php echo $country_db[0]['countryCode'];?>',//'au',
		// allowExtensions: true,
		// autoFormat: false,
		// autoHideDialCode: false,
		// autoPlaceholder: false,
		// defaultCountry: "auto",
		// ipinfoToken: "yolo",
		// nationalMode: false,
		// numberType: "MOBILE",
	// });
  <?php } else { ?>
    // $("#mobile").intlTelInput({
		// allowExtensions: true,
		// autoFormat: false,
		// autoHideDialCode: false,
		// autoPlaceholder: false,
		// defaultCountry: "auto",
		// ipinfoToken: "yolo",
		// nationalMode: false,
		// numberType: "MOBILE",
    // });
  <?php } ?>
  $('#btnSave').click(function(e){
    e.preventDefault();
    var pathname = '<?php echo base_url(); ?>';
    var tutor_name=$('#tutor_name').val();
    var k=0;
    if(tutor_name == ''){
      k=1;
      $('#error_tutor_name').html('Student name can not be empty');
      e.preventDefault();
    }else{
      k=0;
      $('#error_tutor_name').html('');
    }
    var email=$('#email').val();
    var l=0;
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (re.test(email)) {
      l=0;
      $('#error_email').html('');
    } else {
      l=1;
      $('#error_email').html('please enter a valid email');
      e.preventDefault();
    }
    var m=0;
    var password=$('#password').val();
    var cnfpassword=$('#cnfpassword').val();  
    if(password.length < 6){
      m=1;
      $('#error_pass').html('password can not blank and minimum length 6 character');
      e.preventDefault();
    }else{
      m=0;
      $('#error_pass').html('');
    }
    
    var n=0;
    
    if(password != cnfpassword){
      n=1;
      $('#error_cnfpass').html('password and confirm password must be same');
      e.preventDefault();
    }else{    
      n=0;
      $('#error_cnfpass').html('');
    }
    var mobile_no=$('#mobile').val();
    var o=0;
    if(mobile_no == ''){
      o=1;
      $('#error_mobile').html('mobile can not be empty');
      e.preventDefault();
    }else{
      o=0;
      $('#error_mobile').html('');
    }
    if(k==0 && l==0 && m==0 && n==0 && o==0){ 
      var data=$('#tutor_form').serialize();
      $.ajax({
        type: 'ajax',
        method: 'post',
        async: false,
        dataType:'json',
        url: 'save_tutor',
        data:data,
        success: function(msg){
          if(msg=='success'){         
          //$('#ss_confirm_mobile').modal('show');
          //e.preventDefault();
          window.location.href = pathname+"sure_save_tutor";
        }else{
          $('#form_error').html(msg);
          e.preventDefault();                 
        } 
      }
    });   
      e.preventDefault();
    }
  });
 /*  $('#tutor_otp_check').click(function(){
  var data_up_modal=$('#tutor_otp_modal').serialize();
    var pathname = '<?php echo base_url(); ?>';
  $.ajax({
      type: 'ajax',
      method: 'post',
      async: false,
      dataType:'html',
      url: 'sure_save_tutor',
      data:data_up_modal,
      success: function(msg){
        if(msg==1){
            window.location.href = pathname+"tutor_signup_mail";
        }if(msg==2){
            window.location.href = pathname+"tutor_trial_mail";
        }if(msg==0){
          
          $('#token_error').html('please enter your valid token');
        }
      }
    });
  });*/
</script>
