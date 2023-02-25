<?php echo $header; ?>
<?php echo $header_sign_up; ?>   
<div class="container ss_reg_form">

  <div class="row">
  
    <h3 class="g_heading" style="text-align: center;">All fields are mandatory</h3>
    
    <div class="col-sm-6 col-sm-offset-3">
      <?php if ($this->session->userdata('token_error')) {
      echo $this->session->userdata('token_error');
      $this->session->unset_userdata('token_error');
      }?>
      <form  method="post" id="student_form">
        <p id='form_error'></p>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
          <!---<h3 class="g_heading">All fields are mandatory</h3>--->
          <div class="form-group">
            <label for="upper_student_name">Student’s Name </label>
            <input class="form-control" type="text" id="upper_student_name" name="upper_student_name" />
            <p id="error_upStudent" style="color:red"></p>
          </div>
          <div class="form-group">
            <label for="email">Email Adress </label>
            <input class="form-control" type="email" id="email" name="email"/>
            <!--<span class="ss_info">Your email adress also your username</span>-->
            <p id="error_email" style="color:red"></p>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" id="password" name="password"/>
            <p id="error_pass" style="color:red"></p>
          </div>
          <div class="form-group">
            <label for="cnfpassword">Confirm Password</label>
            <input class="form-control" type="password" id="cnfpassword" name="cnfpassword"/>
            <p id="error_cnfpass" style="color:red"></p>
          </div>
          <div class="form-group">
            <label for="">Mobile No</label>
            <input class="form-control" type="tel" id="mobile" name="mobile">
            <input type="hidden" id="full_number" name="full_number">
            <p id="error_mobile" style="color:red;font-weight: bold;"></p>
            <span class="ss_info" style="color:#8f8e8d;">Mobile number is essential for keeping track of student’s progress.</span>
          </div>

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


<div id="ss_confirm_mobile"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form  method="post" id="upper_student_otp_modal">

        <div class="modal-body">

          <p>
            <img src="<?php echo base_url();?>assets/images/icon_logo_small.png">
          </p>
          <p>
            Congratulations! your registration almost done. Enter the verification code that has been send to your mobile number and press submit. lf the mobile number is not valid or you have not received any code, press cancel and Re-enter your mobile number and submit.
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
          <button class="btn btn_blue" type="button" id="upper_student_otp_check">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>
<script>
  var iti='';
  $(window).ready(function() {
 
    <?php if ($country_db[0]['countryCode'] != 'any') { ?>
      var input = document.querySelector("#mobile");

      iti = intlTelInput(input, {
        utilsScript: "<?php echo base_url();?>assets/js/utils.js?1537727621611",
        initialCountry:'<?php echo $country_db[0]['countryCode'];?>',
        autoHideDialCode: true,
        autoPlaceholder: "off",
        //defaultCountry: "auto",
        numberType: "MOBILE",
        separateDialCode:true,
      });
    <?php } else { ?>
      /*$("#mobile").intlTelInput({
        autoHideDialCode: false,
        autoPlaceholder: false,
        defaultCountry: "auto",
        numberType: "MOBILE",
        separateDialCode:true,
      });*/

      //au as detault
      var input = document.querySelector("#mobile");

      iti = intlTelInput(input, {
        utilsScript: "<?php echo base_url();?>assets/js/utils.js?1537727621611",
        initialCountry:'AU',
        autoHideDialCode: true,
        autoPlaceholder: "off",
        //defaultCountry: "auto",
        numberType: "MOBILE",
        separateDialCode:true,
      });
    <?php } ?>

  });


  $('#btnSave').click(function(e){  
  $("#full_number").val(iti.getNumber());  
    var upper_student_name=$('#upper_student_name').val();
    var k=0;
    if(upper_student_name == ''){
      k=1;
      $('#error_upStudent').html('Student name is required');
      e.preventDefault();
    }else{
      k=0;
      $('#error_upStudent').html('');
    }
    var email=$('#email').val();
    var l=0;
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (re.test(email)) {
      l=0;
      $('#error_email').html('');
    } else {
      l=1;
      $('#error_email').html('Please enter a valid email');
      e.preventDefault();
    }
    var m=0;
    var password=$('#password').val();
    var cnfpassword=$('#cnfpassword').val();    
    if(password.length < 6){
      m=1;
      $('#error_pass').html('Password requires minimum 6 character');
      e.preventDefault();
    }else{
      m=0;
      $('#error_pass').html('');
    }

    var n=0;

    if(password != cnfpassword){
      n=1;
      $('#error_cnfpass').html('Password and confirm password must be same');
      e.preventDefault();
    }else{      
      n=0;
      $('#error_cnfpass').html('');
    }
    var mobile_no=$('#mobile').val();
    var o=0;
    if(mobile_no == ''){
      o=1;
      $('#error_mobile').html('Mobile number is required');
      e.preventDefault();
    }else{
      o=0;
      $('#error_mobile').html('');
    }
    if(k==0 && l==0 && m==0 && n==0 && o==0){   
      var data=$('#student_form').serialize();
      $.ajax({
        type: 'ajax',
        method: 'post',
        async: false,
        dataType:'json',
        url: 'save_upper_student',
        data:data,
        success: function(msg){
          if(msg=='mobile_number_error'){
                $('#error_mobile').html('Mobile number already exists');
                return false;
          }else{
            $('#error_mobile').html('');
          }
          if(msg=='success'){     
            $('#token_error').html('');
            $('#ss_confirm_mobile').modal('show');
            e.preventDefault();
          }else{
            $('#form_error').html(msg);
            e.preventDefault();                                 
          }   
        }
      });     
      e.preventDefault();
    }
  });
  $('#upper_student_otp_check').click(function(){
    var data_up_modal=$('#upper_student_otp_modal').serialize();
    var pathname = '<?php echo base_url(); ?>';
    $.ajax({
      type: 'ajax',
      method: 'post',
      async: false,
      dataType:'html',
      url: 'sure_upper_student_data_save',
      data:data_up_modal,
      success: function(msg){

        if(msg==1){
          
          window.location.href = pathname+"paypal_new";
        }if(msg==2){
          window.location.href = pathname+"upper_student_trial_mail";
        }if(msg==0){

          $('#token_error').html('please enter your valid token');
        }

      }
    });
  });
</script>
