<style>
	#error{
		color: red;
		font-weight: bold;
	}

	#success{
		color: green;
		font-weight: bold;
	}
</style>


<section class="main_content ss_sign_up_content bg-gray animatedParent">
	<div class="container-fluid container-fluid_padding">			
		<div class="container">
			<div class="row">					
				<div class="">
					<div class="col-md-10 col-md-offset-1">
					    <?php if (!empty( $this->session->flashdata('success_msg') )) { ?>
                          <div class="row">
                            <div class="col-md-2"></div>
                            <div class="alert alert-success col-md-9" style="margin-left: 56px;"><?php echo $this->session->flashdata('success_msg'); ?> </div>
                          </div>
                        <?php  } ?>
						<p class="accordion_new">
							<a class="btn btn-primary" href="" role="button" aria-expanded="" aria-controls="">My Details</a>
						</p>
						<div class="">
							<div class="col">
								<div class=" accordion_body2" >
									<div class="card card-body">
										<div class="row">
											<div class="col-md-6 bottom10">
												<p id="success" style="color:green;"></p>
												<p id="error" style="color:red;"></p>
												<form class="form-horizontal" id="t_tutor_details">			
													<div class="form-group">
														<div class="text-left col-sm-4"><label class="control-label" for="email">User Name:</label></div>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="name" value="<?php echo $user_info[0]['name'];?>" readonly>
														</div>
													</div>

													<div class="form-group">
														<div class="text-left col-sm-4"><label class="control-label" for="email">Login Name:</label></div>
														<div class="col-sm-8">
															<input type="email" class="form-control" id="name" value="<?php echo $user_info[0]['user_email'];?>" readonly>
														</div>
													</div>


													<div class="form-group">
														<div class="text-left col-sm-4"><label class="control-label" for="password">Password:</label></div>
														<div class="col-sm-8"> 
															<input type="password" class="form-control" name="password" id="password" value="<?php //echo $user_info[0]['user_pawd'];?>">
														</div>
													</div>

													<div class="form-group">
														<div class="text-left col-sm-4"><label class="" for="passconf">Confirm Password:</label></div>
														<div class="col-sm-8"> 
															<input type="password" class="form-control" name="passconf" id="passconf" value="<?php //echo $user_info[0]['user_pawd'];?>">
														</div>
													</div>


													<div class="form-group">
														<div class="text-left col-sm-4"><label class="control-label" for="country">Country:</label></div>
														<div class="col-sm-8"> 


															<input class="form-control" readonly type="text" id="country" value="<?php  echo $user_info[0]['countryName'];?>"/>

														</div>
													</div>

													<?php if ($whiteboard == 1): ?>

													<div class="form-group">
														<div class="text-left col-sm-4">
															<label class="control-label" for="Ref_link">Ref.Link No:</label>
														</div>
														<div class="col-sm-8"> 
															<p><b><?php echo $user_info[0]['SCT_link'];?></b></p>
														</div>						
													</div>
														
													<?php endif ?>

												</form>

											</div>								
											<div class="col-md-3 bottom10">
												<a href="tutor_bank_details" style='color: #ff2525;'><u><b>Account Details</b></u></a>
											</div>								
											<div class="col-md-3 bottom10">
												<ul class="setting_ul">
													<li><a href="#"><img src="assets/images/menu_n1.png"></a></li>
													<li>
														<a onclick="upDateStudentProfile();">
															<img src="assets/images/save_btn.png">
														</a>
													</li>	
												</ul>
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
	</div>
</section>
<script>
	function upDateStudentProfile(){
		var data_up=$('#t_tutor_details').serialize();
		$.ajax({
			type: 'ajax',
			method: 'post',
			async: false,
			dataType:'html',
			url: 'update_tutor_details',
			data:data_up,
			success: function(msg){
				if(msg == 0){
					$('#success').html('');
					$('#error').html('Password and confirm password must be same and password length minimum 6 characters');
				}else{
					$('#error').html('');
					$('#success').html('Password Updated');
				}

			}
		});
	}

</script>