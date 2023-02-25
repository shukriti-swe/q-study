
<?php echo $header; ?>
<?php echo $header_sign_up; ?>
	<div class="container ss_payment_form">
		<h5 style="text-align: center;color: #8c9aff; "> Request To Pay By Direct Deposite  </h5>
			 	<div class="row">

					 	 <div class="col-sm-2">  </div>
					 	 <div class="col-sm-8">

                            <p style="margin:15px;">You have requested that you wish to purchase a <span style="font-size: 18px"><b>Q-Study</b></span>  product using direct deposit. We have sent you an email to you at <span style="font-size: 18px"><b> <?=  (isset($parent_email))?$parent_email:$user_info[0]['user_email'];  ?> </b></span>    with instruction on paying for your product by direct deposit. Moreover, the message and direct deposit information are given in the inbox of the front page of the student   </p>
                            <p class="text-danger" style="margin:15px;">Note: If you don't see a confirmation e-mail then please check your bulk/spam folder.</p>
              
					 	 	<div class="row">
					 	 		<div class="col-sm-5" style="text-align:right;">
					 	 			<div class="imag"><a href="#"><img src="assets/images/r_c_l.png"></a></div>
					 	 		</div>

					 	 		<div class="col-sm-3">
					 	 			<div class="imag"><a href="#"><img src="assets/images/rsz_1rsz_158.png"></a></div>

					 	 			<!--<a href="<?= base_url('/finish'); ?>" class="btn btn-primary" style="margin-top: 40%;margin-left: 12%;" >Finish</a>-->
					 	 			<?php
									if($user_type ==2){
									?>
                                        <a href="<?= base_url('/'); ?>" class="btn btn-primary" style="margin-top: 40%;margin-left: 12%;" >Finish</a>
									<?php }else{?>
					 	 			   <a href="<?= base_url('/'); ?>" class="btn btn-primary" style="margin-top: 40%;margin-left: 12%;" >Finish</a>
									<?php }?>
					 	 		</div>

					 	 		<div class="col-sm-4" style="text-align:left;">
					 	 			<div class="imag"><a href="#"><img src="assets/images/r_c_r.png"></a></div>
					 	 		</div>
					 	 	</div>
					 	 </div>
					 	 <div class="col-sm-2 ">
					 	 	
			 	 	     </div>
			 </div>
			 </div>
	</div>
<?php echo $footer; ?>

 