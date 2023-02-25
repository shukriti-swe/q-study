<style type="text/css">
.frist_time_user_mid_con_mes strong{
   color: #ff7f27;
}

.frist_time_user_mid_con_mes a{
   color: #00c1f7;
   display: inline-block;
}
.frist_time_user_mid_con a{
   display: inline-block;
}
.frist_time_user_mid_con label{
   margin-bottom: 6px;
}
.frist_time_user_mid_con .image_box{
   border: 1px solid #00c1f7;
   height: 100px;
   width: 100px;
   margin: 10px auto;
   background: #d9d9d9;
}
</style>
<div class="container">
<?php
  $message=$this->session->userdata('success');
  if ($message) {
  	
  	echo "<p class='alert alert-danger' style='text-align: center;'>$message</p>";

  	$this->session->unset_userdata('success');
  }
  ?>
				<div class="row">
					<div class="sign_my_acount">
						<div class="col-md-4 col-md-offset-4">
							<p class="accordion_new">
								<a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-sort-down"></i> My Account</a>
							</p>
							<div class="">
								<div class="col">
									<div class="collapse multi-collapse accordion_body in" id="multiCollapseExample1">
										<div class="card card-body">
											<ul>
												<li><a href="<?php echo base_url(); ?>student_details">Setting</a></li>
												<li><a href="<?php echo base_url(); ?>student_upload_photo">Logo/Photo</a></li>
												<!----<li><a href="cancel.php">Cancel/Subscription</a></li>----->
												<li><a href="<?php echo base_url(); ?>my_enrollment">Enrollment List</a></li>
												<li><a href="#" data-toggle="modal" data-target="#frist_time_user"  >Profile</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="frist_time_user">
				<!-- Modal -->
				<div style="max-width: 100%;margin-top:8%;" class="modal-dialog" role="document">
					<div  class="modal-content">

						<div style="padding:10px;" class="btm_word_limt p-3">

						<form action="<?php echo base_url(); ?>profile_update" method="post" enctype="multipart/form-data">
							<div>
								<button type="button" class="btn btn-profile">Edit</button>
								<button type="button" id="close_idea" class="btn btn-info pull-right" data-dismiss="modal">Close</button>
							</div>
							<hr>
							<div class="frist_time_user_mid_con">
								<div class="frist_time_user_mid_con_mes">
									<strong> Wanna be a superstar?? </strong> Each time you submit a writing task, your
									wonderful work is automatically published as a writing suggestion
									viewable around the world <a href="#">view more</a>
								</div>
								<div class="row p-3">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Name</label>
											<input type="text" class="form-control" value="<?=$profile[0]['student_name']?>" name="student_name">
										</div>
										<div class="form-group">
											<label>School Name <a href="#">Optional</a></label>
											<input type="text" class="form-control" value="<?=$profile[0]['school_name']?>" name="school_name">
										</div>
										<div class="form-group">
											<label>Country</label>
											<input type="text" class="form-control" value="<?=$profile[0]['country']?>" name="country">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="text-center">
										<div class="form-group">
													
													<input style="display: none;" id="file-input" type="file" class="form-control" name="profile_image" onchange="imgPreview()">
											
													<label for="file-input"><i class="fa fa-cloud-upload" aria-hidden="true"></i></label>
											<p>Chose Photo to Upload</p>
											<p><a href="">(Optional)</a></p>
										</div>
										<div class="image_box"><img style="height:100px;" id="imgFrame" src="assets/uploads/profile/thumbnail/<?=$profile[0]['profile_image']?>" width="100px" height="200px" /></div>
									</div>
								</div>
							</div>
							<hr>
							<div class="text-center p-3">
								<button type="submit" class="btn btn_next">Submit & Proceed</button>
							</div>
						</form>
						</div>

					</div>
				</div>
			</div>
			</div>

			<script>
			function imgPreview() {
				imgFrame.src = URL.createObjectURL(event.target.files[0]);
			}
			</script>

			</section>