<section class="main_content ss_sign_up_content bg-gray animatedParent">
	<div class="container-fluid container-fluid_padding">         
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
				  <?php $this->load->view('flash_message_section'); ?>
				</div>
			</div>
			<div class="row">                 
				<div class="">
					<div class="col-md-10 col-md-offset-1">
						<p class="accordion_new">
							<a class="btn btn-primary" href="" role="button" aria-expanded="" aria-controls="">My Details</a>
						</p>
						<div class="">
							<div class="col">
								<div class=" accordion_body2" >
									<div class="card card-body">

										<div class="row">
											<form class="form-horizontal" id="student_details" method="POST" action="Student/update_student_details"> 
												<div class="col-md-6 bottom10">
										   <!--  <p id="success"></p>
											 <p id="error"></p> -->
												        
													<div class="form-group">
														<div class="text-left col-sm-4">
															<label class="control-label" for="email">User Name:</label>
														</div>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="name" value="<?php echo $user_info[0]['name']; ?>" readonly>
														</div>
													</div>

													<div class="form-group">
														<div class="text-left col-sm-4">
															<label class="control-label" for="email">Login Name:</label>
														</div>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="email" value="<?php echo $user_info[0]['user_email']; ?>" readonly>
														</div>
													</div>


													<div class="form-group">
														<div class="text-left col-sm-4">
															<label class="control-label" for="password">Password:</label>
														</div>
														<div class="col-sm-8"> 
															<input type="password" class="form-control" name="password" id="password" value="">
														</div>
													</div>

													<div class="form-group">
														<div class="text-left col-sm-4">
															<label class="" for="passconf">Confirm Password:</label>
														</div>
														<div class="col-sm-8"> 
															<input type="password" class="form-control" name="passconf" id="passconf" value="">
														</div>
													</div>

													<div class="form-group">
														<div class="text-left col-sm-4">
															<label class="control-label" for="country">Country:</label>
														</div>
														<div class="col-sm-8">
															<input class="form-control" readonly type="text" id="country" value="<?php echo $user_info[0]['countryName']; ?>"/>

														</div>
													</div>

													<div class="form-group">
														<div class="text-left col-sm-4">
															<label class="control-label" for="gade_level">Grade/Year/Level:</label>
														</div>
														<div class="col-sm-8"> 
														  <!-- <input class="form-control" readonly type="text" id="gade_level" value="<?php echo $user_info[0]['student_grade']; ?>" /> -->
															<select class="form-control" name="student_grade" id="stGrade">  

																<?php foreach (range(1, 12) as $grade) : ?>
																  <option value="<?php echo $grade ?>" <?php echo $user_info[0]['student_grade']==$grade ? 'selected':''; ?>>
																	<?php echo $grade; ?>
																  </option>     
																<?php endforeach; ?>

															</select>
														</div>                          
													</div>

													<div class="form-group">
														<div class="text-left col-sm-4">
															<label class="control-label" for="gade_level">Courses :</label>
														</div>
														<div class="col-sm-8" style="font-size: 13px;"> 
															<?php foreach ($student_course as $row) {
																echo $row['courseName'].'<br>';
															} ?>
														</div>                          
													</div>
													<div class="form-group">
														<div class="text-left col-sm-4">
															<label class="control-label" for="Ref_link">Ref.Link No: </label>
														</div>

														<div class="text-left col-sm-4">
														 <?php echo $user_info[0]['SCT_link']; ?>	
														<!-- <?php
														if ($studentRefLink) {
														  $i = 0;
														  foreach ($studentRefLink as $dataLink) {
															?>
															<?php if ($i > 0) { ?>
																	<label class="control-label" for="Ref_link" style="display: none"></label>
															<?php } ?>
																<?php if (!empty($dataLink['SCT_link'])): ?>
																	<p ><b><?php echo $dataLink['SCT_link']; ?></b></p>
																 	
																 <?php endif ?> 
															<?php
															$i++;
														  }
														}
														?> -->

														</div>
													</div>

													<div class="form-group">
														<div class="text-left col-sm-4">
															<label class="control-label" for="Ref_link">Stop SMS:</label>
														</div>
														<div class="text-left col-sm-4">
															<input type="checkbox" name="sms_status_stop" value="1" <?= ($user_info[0]['sms_status_stop'] == 1)?"checked":"";?>>	
														</div>
													</div> 

												</div>                                
												<div class="col-md-3 bottom10 text-center">
													<a href="#"><b></b></a>
												</div>                              
												<div class="col-md-3 bottom10">
													<ul class="setting_ul">
														<a class="btn btn-primary" href="<?php echo base_url(); ?>">Home</a>
														<button class="btn btn-default" type="submit">Update</button>
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


<script>

  //form validation
	$('#student_details').validate({
		rules:{
			password:{
				minlength: 6
			},
			passconf:{
				equalTo: "#password"
			}
		}
	});


/*  function upDateStudentProfile() {
    var data_up = $('#student_details').serialize();
    $.ajax({
      type: 'ajax',
      method: 'post',
      async: false,
      dataType: 'html',
      url: 'update_student_details',
      data: data_up,
      success: function (msg) {
        alert(msg);
        if (msg == 0) {
          $('#success').html('');
          $('#error').html('password and confirm password must be same also password length minimum 5 and maximum 6 character');
        } else {
          $('#error').html('');
          $('#success').html('password updated');
        }

      }
    });
  }*/

</script>
