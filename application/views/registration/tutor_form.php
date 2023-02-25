<?php echo $header; ?>
<?php echo $header_sign_up; ?>   
	<div class="container ss_reg_form">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
			  <?php if ($this->session->userdata('token_error')) {
				echo $this->session->userdata('token_error');
				$this->session->unset_userdata('token_error');
			  }?>
				<form class="row" id="tutor_form" data-parsley-validate>
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h3 class="g_heading">All fields are mandatory</h3>
						<div class="form-group">
							<label for="tutor_name">Tutor’s Name </label>
							<input class="form-control" type="text" id="tutor_name" name="tutor_name" required>
							<p id="error_tutor_name" style="color:red"></p>
						</div>
						<div class="form-group">
							<label for="email">Email Adress </label>
							<input class="form-control" type="email" id="email" name="email"/>

						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input class="form-control" type="password" id="password" name="password" required>
							<p id="error_pass" style="color:red"></p>
						</div>
						<div class="form-group">
							<label for="cnfpassword">Confirm Password</label>
							<input class="form-control" type="password" id="cnfpassword" name="cnfpassword" required>
							<p id="error_cnfpass" style="color:red"></p>
						</div>

						<div class="form-group">
                            <label for="">Mobile No</label>
                            <input class="form-control" type="tel" id="mobile" name="mobile">
                            <input type="hidden" id="full_number" name="full_number">
							
                            <p id="error_mobile" style="color:red;font-weight: bold"></p>
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

					<div class="col-sm-3"></div>

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
        <form  method="post" id="parent_otp_modal">
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
              <button class="btn btn_blue" type="button" id="parent_otp_check">
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

			console.log("gfdfgtrhg")
            console.log(input)

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

  /*form validation*/
	$('#tutor_form').validate({
		rules: {
			email: {
				required: true,
				email: true,
				remote: "CommonAccess/emailNotExists",
			},
			password : {
				required: true,
				minlength: 6,
			},
			cnfpassword:{
				equalTo:'#password'
			}
		},
		messages : {
			email : {
				remote : 'email already exists'     
			}
		}   
	});


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
		$("#full_number").val(iti.getNumber());
		e.preventDefault();

		$("#full_number").val(iti.getNumber());

	    var tutor_name=$('#tutor_name').val();
	    var k=0;
	    if(tutor_name == ''){
	        k=1;
	        $('#error_tutor_name').html('Tutor name is required');
	        e.preventDefault();
	    } else {
	        k=0;
	        $('#error_tutor_name').html('');
	    }
	    
	    
	    var m=0;
	    var password=$('#password').val();
	    var cnfpassword=$('#cnfpassword').val();
	    
	    if(password.length < 6) {
	        m=1;
	        $('#error_pass').html('Password requires minimum 6 character');
	        e.preventDefault();
	    } else {
	        m=0;
	        $('#error_pass').html('');
	    }
	    
	    var n=0;
	    
	    if(password != cnfpassword) {
	        n=1;
	        $('#error_cnfpass').html('Password and confirm password must be same');
	        e.preventDefault();
	    } else {      
	        n=0;
	        $('#error_cnfpass').html('');
	    }
	    
	    var mobile_no = $('#mobile').val();
	    var o = 0;
	    
	    if(mobile_no == ''){
	        o = 1;
	        $('#error_mobile').html('Mobile number is required');
	        e.preventDefault();
	    }else{
	        o=0;
	        $('#error_mobile').html('');
	    }

	    if(k==0 && m==0 && n==0 && o==0 ){ 

	    	var data=$('#tutor_form').serialize();
			$.ajax({
				type: 'ajax',
				method: 'post',
				async: false,
				dataType:'json',
				url: 'save_tutor',
				data:data,
				success: function(msg){
					if(msg=='mobile_number_error'){
	        			$('#error_mobile').html('Mobile number already exists');
	        			return false;
					}else{
						$('#error_mobile').html('');
					}

					if(msg=='success'){  
					  console.log('hit');   

					  $('#token_error').html('');
	                  $('#ss_confirm_mobile').modal('show');
					  
					}else{
					  $('#form_error').html(msg);
					  e.preventDefault();                                 
					}   
				}
			});
	    }

	});

	$('#parent_otp_check').click(function(){
        var data_up_modal=$('#parent_otp_modal').serialize();
        var pathname = '<?php echo base_url(); ?>';
        $.ajax({
            type: 'ajax',
            method: 'post',
            async: false,
            dataType:'html',
            url: 'sure_save_tutor',
            data:data_up_modal,
            success: function(msg){
            	console.log(msg);
                if(msg==0){
                    $('#token_error').html('please enter your valid token');
                }else{
                	 window.location.href = pathname+msg;
                }
            }
        });
    });

</script>
