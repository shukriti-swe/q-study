<?php echo $header; ?>
<?php echo $header_sign_up; ?>  
	<div class="container">
		<div class="row">

			<div class="col-sm-10 col-sm-offset-1">
				<br>
				<div class="col-sm-3 col-sm-offset-1"></div>
				<div class="col-sm-6 col-sm-offset-1" style="font-weight: 1000; ">Number of Teacher</div>
				<div class="col-sm-3 col-sm-offset-1"></div>
				
				<form class="ss_form text-center form-inline" method="post" action="<?php echo base_url();?>corporate_form">				 	 		
			 		<?php 
						echo $this->session->userdata('teacher_number_error');
						$this->session->unset_userdata('teacher_number_error');
					?>
					<div class="ss_bottom_s_course">
			 		 	<div class="form-group">
			 		 	 <label class="label-inline" for="teacher">Number of Teacher</label>  								 
						 <input type="Number" id="teacher" class="form-control ss_number" name="teacher" value='1' onclick="getTeacher();"></div>
			 		 </div>
					<p class="warnin_text"><br></p>
			 	
					<div class="text-center" > 
						<button class="btn btn_next" id="must_select"> 
						<img src="<?php echo base_url();?>assets/images/icon_save.png"/>Save & Proceed
						</button>
					</div>
				</form>
			 	
			</div>
		</div>
	</div>
<?php echo $footer; ?>
 <script>
	function myR1Func(){
		var davalue = $('.r1').attr('data');
		var total = $('#legal_cost').val();
		var noOfChildreen = $('#children').val();
		document.getElementById("paymentType").value = davalue;
		$('#dolar').html('$'+total * noOfChildreen);
		document.getElementById("totalCost").value = total * 1 * noOfChildreen;
	}
	myR1Func();
	function myR2Func(){
		var total = $('#legal_cost').val();
		var noOfChildreen = $('#children').val();
		var davalue2 = $('.r2').attr('data');
		
		document.getElementById("paymentType").value = davalue2;
		$('#dolar').html('$'+total*6 * noOfChildreen);
		document.getElementById("totalCost").value = total * 6 * noOfChildreen;
	}
	function myR3Func(){
		var davalue3 = $('.r3').attr('data');
		var total = $('#legal_cost').val();
		var noOfChildreen = $('#children').val();
		document.getElementById("paymentType").value = davalue3;
		$('#dolar').html('$'+total*12 * noOfChildreen);
		document.getElementById("totalCost").value = total * 12 * noOfChildreen;
	}
	function getChildreen(){		
		var noOfChildreen = $('#children').val();		
		if(noOfChildreen < 1){
			document.getElementById("children").value = 1;
		}
		var paymentType = $('#paymentType').val();
		if(paymentType == 1){
			common(1);
		}else if(paymentType == 2){
			common(6);
		}else if(paymentType == 3){
			common(12);
			
		}
		function common(flag){
			var noOfChildreen = $('#children').val();	
			var total_cost = $('#legal_cost').val();
			var aggrigate = total_cost * noOfChildreen * flag;
			$('#dolar').html('$'+aggrigate);
			document.getElementById("totalCost").value = aggrigate;
		}
		
	}
</script>