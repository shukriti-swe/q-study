<?php echo $header; ?>
<?php echo $header_sign_up; ?> 

<div class="container">
	<div class="row">
		<div class="sign_up_menu">
			<h3>Please Select Your User Type</h3>
			<ul>
				<?php 
				if($user){
					foreach($user as $siUser){
						if($siUser['id'] !=  6 && $siUser['id'] !=  7 ){
						?>	
							<li>
								<!-- <a href="<?php echo base_url();?><?php echo $registration_slug_type;?>/<?php echo $siUser['user_slug'];?>"><?php echo $siUser['userType'];?></a> -->

								<a href="<?php echo base_url(); ?>select_country/<?php echo $registration_slug_type;?>/<?= $siUser['id']; ?>"><?php echo $siUser['userType'];?></a>
							</li>
						<?php
						}

					}
				}
				?>

			</ul>
			<div >
				<img style="margin:20px auto;" src="<?php echo base_url();?>assets/images/sign_btm.png" class="img-responsive">
			</div>
		</div>
	</div>
</div>

<?php echo $footer; ?>