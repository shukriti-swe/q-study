<div class="container ss_payment_form">
 	<div class="row">
 		<form  action="bank_details_submit_form" method="POST">
		 	 <div class="col-sm-3"> </div>
		 	 <div class="col-sm-6">
				 <p class="payment-errors"></p>
		 	 	<div class="ss_payment_form_top">
		 	 		<a href=""><img src="<?php echo base_url();?>assets/images/icon_paypal.jpg"></a>
		 	 		<span>Paypal account details: </span> <input class="form-control" type="email" value="<?= (isset($account_detail->paypal_details))?$account_detail->paypal_details:null?>" name="paypal_details" id="paypal_details" style="width: 50%;display: inline-block;">
		 	 	</div>
		 	 	<div class="ss_payment_form_bottom">
		 	 		<b>Bank Details</b>
		 	 		<p style="color:red">Note: Do not forget to write country "swift address" and "swift code"</p>
		 	 		<div class="row">
		 	 		</div>
		 	 		<textarea class="form-control" name="bank_details" id="bank_details" rows="10"><?= (isset($account_detail->bank_details))?$account_detail->bank_details:null?></textarea>
		 	 		<div class="form-check" style="display:inline-block">
                      <label class="form-check-label" for="paypal">
                      <input class="form-check-input" type="radio" name="bank_paypal_details" id="paypal" value="paypal" <?= (isset($account_detail->default_option) && $account_detail->default_option == 'paypal')?'checked':null?>>
                        PayPal
                      </label>
                    </div>
                    <div class="form-check" style="display:inline-block">
                      <label class="form-check-label" for="bank">
                      <input class="form-check-input" type="radio" name="bank_paypal_details" id="bank" value="bank" <?= (isset($account_detail->default_option) && $account_detail->default_option == 'bank')?'checked':null?> >
                        Bank
                      </label>
                    </div>
		 	 		<br>
    		 	 	<div class="text-right">
    					<button class="btn btn-danger" id="payBtn" type="submit">Save</button>
    		 	 	</div>
		 	 	</div>
		 	 	
		 	 	<div class="ss_payment_form_agre" style="padding-left: 15px !important;padding: 1px;">
			    	<div class="row">
			    	</div>
		 	 	</div>
		 	 	<div class="ss_payment_form_agre">
		 	 	  <div class="checkbox">
				    <label>
				      <input type="checkbox" id="crad_term_check" onclick="crad_term_checkFunc();"> I agree to the <a href="<?= base_url("/faq/view/30") ?>"><b>Tarms & Conditions Policy</b> </a> &nbsp; <a href="<?= base_url("/faq/view/32") ?>"> <b>Privacy Policy</b>  </a> &nbsp; <a href="<?= base_url("/faq/view/31") ?>"> <b>Disclaimer</b> </a>
				    </label>
				  </div>
		 	 	</div>
		 	 </div>
 	     </form>
    </div>
  </div>
  
<script type="text/javascript">

$(document).ready(function() {
    $('#payBtn').attr("disabled", "disabled");
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

$('#payBtn').click(function(){
    var paypal_details = $('#paypal_details').val();
    var bank_details   = $('#bank_details').val();
    
    if($('input[name="bank_paypal_details"]:checked').is(":checked")){
        var default_option = $('input[name="bank_paypal_details"]:checked').val();
    }else{
        var default_option = '';
        
    }
    
    if(paypal_details == '' && bank_details == ''){
        alert('Paypal details or bank details must be needed...');
        return false;
    }else{
        if(paypal_details != '' && bank_details != '' && default_option == ''){
            alert('Please select one default option(PayPal or Bank) ...');
            return false;
        }else{
            return true;
        }
    }
    
})
</script>