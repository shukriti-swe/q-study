<?php echo $header; ?>
<?php echo $header_sign_up; ?>  
	<div class="container">
		<div class="row">

			<div class="col-sm-10 col-sm-offset-1">
				<br>
				<div class="col-sm-3 col-sm-offset-1"></div>
				<div class="col-sm-6 col-sm-offset-1" style="font-weight: 1000; ">Number of Teacher</div>
				<div class="col-sm-3 col-sm-offset-1"></div>
				
				<form class="ss_form text-center form-inline" method="post" action="<?php echo base_url();?>school_form">				 	 		
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
	function getTeacher(){		
		var noOfTicher = $('#teacher').val();		
		if(noOfTicher < 1){
			document.getElementById("teacher").value = 1;
		}else{
			document.getElementById("teacher").value = noOfTicher;
		}
	}
	getTeacher();

</script>