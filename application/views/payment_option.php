<?php
// echo '<pre>';print_r($rs_course);die();
$course_cost = $this->session->userdata('totalCost');
$payment_process=$this->session->userdata('payment_process');
$this->db->select('*');
$this->db->from('tbl_stripe_api_key');
$this->db->where('type',0);
$api_key=$this->db->get()->result_array();
?>
<?php echo $header; ?>
<?php echo $header_sign_up; ?>
			<div class="container ss_payment_form">
				 	<div class="row">
						
				 		<form  action="card_form_submit" method="POST" id="paymentFrm">
						 	 <div class="col-sm-3"> </div>
						 	 <div class="col-sm-6">
								 <p class="payment-errors"></p>
						 	 	<div class="ss_payment_form_top">
						 	 		<a href="<?php echo base_url();?>go_paypal"><img src="<?php echo base_url();?>assets/images/icon_paypal.jpg"> </a> <span>Click on the PayPal logo</span>
						 	 	</div>
						 	 	<div class="ss_payment_form_bottom">
						 	 		<div class="row">
							 	 		<div class="col-sm-4">
							 	 			<h4>Card type</h4>
							 	 			 
							 	 				<div class="checkbox">
												    <label>
												      <!-- <input type="radio" name="cardName" >  -->
												      <img src="<?php echo base_url();?>assets/images/icon_visa.jpg">
												    </label>
												</div>
												<div class="checkbox">
												    <label>
												       <!-- <input type="radio" name="cardName">  -->
												       <img src="<?php echo base_url();?>assets/images/icon_master.jpg">
												    </label>
												</div>
												<div class="checkbox">
												    <label>
												      <!-- <input type="radio" name="cardName">  -->
												      <img src="<?php echo base_url();?>assets/images/icon_american_express.jpg">
												    </label>
												</div>
							 	 			 
							 	 		</div>
							 	 		<div class="col-sm-8">
							 	 			<div class="form-group">
							 	 				<label>Card holder name*</label>
							 	 				<input  type="text" class="form-control" name="name" >
							 	 			</div>
							 	 			<div class="form-group">
							 	 				<label>Card number</label>
							 	 				<input  type="number" class="form-control card-number" name="card_num" >
							 	 			</div>
							 	 			<div class="row">
							 	 				<div class="col-xs-4">
							 	 					<div class="form-group">
									 	 				<label>Expiry month</label>
									 	 				<select class="form-control card-expiry-month" name="exp_month">
									 	 					<option>01</option>
									 	 					<option>02</option>
									 	 					<option>03</option>
									 	 					<option>04</option>
									 	 					<option>05</option>
									 	 					<option>06</option>
									 	 					<option>07</option>
									 	 					<option>08</option>
									 	 					<option>09</option>
									 	 					<option>10</option>
									 	 					<option>11</option>
									 	 					<option>12</option>
									 	 				</select>
									 	 			</div>
							 	 				</div>
							 	 				<div class="col-xs-4">
							 	 					<div class="form-group">
									 	 				<label>Expiry year</label>
									 	 				<select class="form-control card-expiry-year" name="exp_year">
									 	 					<option>2018</option>
									 	 					<option>2019</option>
									 	 					<option>2020</option>
									 	 					<option>2021</option>
									 	 					<option>2022</option>
									 	 					<option>2023</option>
									 	 					<option>2024</option>
									 	 					<option>2025</option>
									 	 					<option>2026</option>
									 	 					<option>2027</option>
									 	 					<option>2028</option>
									 	 					<option>2029</option>
									 	 					<option>2030</option>
									 	 				</select>
									 	 			</div>
							 	 				</div>
							 	 				<div class="col-xs-4">
							 	 					<div class="form-group">
									 	 				<label>CVV</label>
									 	 				<input  type="text" class="form-control card-cvc" name="cvc"  >
									 	 			</div>
							 	 				</div>
							 	 			</div>
							 	 		</div>
						 	 		</div>
						 	 	</div>

						 	 	<div class="ss_payment_form_agre" style="padding-left: 15px !important;padding: 1px;">
							    	<div class="row">
							    		<div class="col-md-3" style="background: #eaeab9;padding: 17px 40px;">
							    			<p style="font-size: 20px;">
							    				Total <br> $<?= $course_cost; ?></p>
							    		</div>
							    		<?php if ($payment_process == 1): ?>
								    		<div class="col-md-9" style="background: #7092be;padding: 6px 30px;width: 72%;color: #fff;text-align: center;">
								    			<p style="color: #fff;font-weight: bold;">Direct Debit</p>
	                            				<p style="color: #fff">Your membership will be renewed automatically. You may cencel anytime</p>
								    		</div>
							    		<?php endif ?>
							    		<?php if ($payment_process == 2): ?>
								    		<div class="col-md-9" style="background: #7092be;padding: 17px 30px;width: 72%;color: #fff;text-align: center;">
								    			<p style="color: #fff;font-weight: bold;">No direct debit</p>
	                            				<p style="color: #fff">One time payment without no automatic renewel.</p>
								    		</div>
							    		<?php endif ?>
							    		<?php if ($payment_process == 3): ?>
								    		<div class="col-md-9" style="background: #7092be;padding: 17px 30px;width: 72%;color: #fff;text-align: center;">
								    			<p style="color: #fff;font-weight: bold;">Direct Deposit</p>
								    		</div>
							    		<?php endif ?>
							    	</div>
						 	 		<!-- <div class="checkbox">
									    <label>
									    	<a href="<?php echo base_url();?>direct_deposit"><img src="<?php echo base_url();?>assets/images/Screenshot_49.png"></a>
									    </label>
									</div> -->
						 	 	</div>

						 	 	<div class="ss_payment_form_agre">
						 	 	  <div class="checkbox">
								    <label style="font-size:13px">
								      <input style="bottom: 7px;" type="checkbox" id="crad_term_check" onclick="crad_term_checkFunc();">  <span>I agree to the <a href="<?= base_url("/faq/view/30") ?>"><b>Terms & Conditions Policy</b> </a> &nbsp;<a href="<?= base_url("/faq/view/32") ?>"><b>Privacy Policy</b>  </a> &nbsp;<a href="<?= base_url("/faq/view/31") ?>"><b>Disclaimer.</b> </a></span>
								    </label>
								  </div>
						 	 	</div>
						 	 	<div class="text-center">
									<button class="btn btn_next" id="payBtn" type="submit"> 
							            <img src="<?php echo base_url();?>assets/images/icon_save.png"/>Submit
							       </button>
						 	 	</div>
						 	 </div>
						 	 <div class="col-sm-3 ss_payment_right">
						 	 	<div class="imag"><a href="#"><img src="assets/images/money_back_garenty.jpg"></a></div>
						 	 	<div class="imag"><a href="#"><img src="assets/images/ssl_cicurary.jpg"></a></div>
				 	 	     </div>
				 	 </form>
				 </div>
				 </div>
		</div>
</section>
<?php echo $footer; ?>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
//set your publishable key
Stripe.setPublishableKey('<?php echo $publish_key; ?>');

//callback to handle the response from stripe
function stripeResponseHandler(status, response) {

    if (response.error) {
        //enable the submit button
        $('#payBtn').removeAttr("disabled");
        //display the errors on the form
        $(".payment-errors").html(response.error.message);
    } else {
        var form$ = $("#paymentFrm");
        //get token id
        var token = response['id'];
        //insert the token into the form
        form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
        //submit form to the server
        form$.get(0).submit();
    }
}
$(document).ready(function() {
    //on form submit
    $("#paymentFrm").submit(function(event) {
        //disable the submit button to prevent repeated clicks
        $('#payBtn').attr("disabled", "disabled");
        
        //create single-use token to charge the user
        Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
        
        //submit from callback
        return false;
    });
});
if($("#crad_term_check").is(":checked")){
		$("#payBtn").attr('disabled',false);
	}else{
		$("#payBtn").attr('disabled',true);
	}
	function crad_term_checkFunc(){
		if($("#crad_term_check").is(":checked")){
		$("#payBtn").attr('disabled',false);
	}else{
		$("#payBtn").attr('disabled',true);
	}
}
</script>
 