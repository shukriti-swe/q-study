<div class="" style="margin-left: 15px;">
	<?php
		$user_type = $user_info[0]['user_type'];
		if ($user_type == 1) {
			$userType = "Parent";
			$color = "blue";
		}else if($user_type == 6){
			$userType = "Student";
			$color = "blue";
		}else if($user_type == 3){
			$userType = "Tutor";
			$color = "blue";
		}else if($user_type == 5){
			$userType = "Corporate";
			$color = "blue";
		}else if($user_type == 4){
			$userType = "School";
			$color = "blue";
		}
	?>
  	<div class="row">
	    <div class="col-md-4">
	      <?php echo $leftnav ?>
	    </div>
		<div class="col-md-8 user_list">
	      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
	        <div class="panel panel-default">
	          <div class="panel-heading" role="tab" id="headingOne">
	            <h4 class="panel-title text-center">
	              <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
	                <strong><span style="font-size : 18px;"><?= $userType ?></span></strong>
	              </a>
	            </h4>
	          </div>
	      	</div>
	      </div>
	      <div class="section full_section">
	      	<div class="form-group row"> 
	      		<label class="col-md-4 text-right label-class">Trial taken date:</label>
	      		<div class="col-md-8"><?= (isset($trial_date))?$trial_date:'';?></div>
	      	</div>
	      	<div class="form-group row"> 
	      		<label class="col-md-4 text-right label-class">First signup taken date: </label>
	      		<div class="col-md-8"><?= (isset($signup_date))?$signup_date:''; ?></div>
	      	</div>
	      	<div class="form-group row"> 
	      		<label class="col-md-4 text-right label-class">Inactive date:</label>
	      		<div class="col-md-8"></div>
	      	</div>
	      	<div class="form-group row"> 
	      		<label class="col-md-4 text-right student-label-class">Progress average percentage:</label>
	      		<div class="col-md-8"></div>
	      	</div>
	      	<div class="form-group row"> 
	      		<label class="col-md-4 text-right student-label-class">Prize winner total:</label>
	      		<div class="col-md-5">
	      			<input type="text" value="<?= (isset($prize_won_user))?$prize_won_user:''; ?>" class="form-control">
	      		</div>
	      	</div>
	      	<div class="form-group row"> 
	      		<label class="col-md-4 text-right student-label-class">Referral Link:</label>
	      		<div class="col-md-5">
	      			<input type="text" value="<?= isset($user_info[0]['SCT_link'])?$user_info[0]['SCT_link']:null; ?>" class="form-control">
	      		</div>
	      	</div>
	      	<div class="form-group row"> 
	      		<label class="col-md-4 text-right tutor-label-class">Vocabulary point:</label>
	      		<div class="col-md-5">
	      			<input type="text" value="<?= (isset($vocabulary_point))?$vocabulary_point->total_approved:null; ?>" class="form-control">
	      		</div>
	      	</div>
	      	<div class="form-group row"> 
	      		<label class="col-md-4 text-right tutor-label-class"><a href="<?= base_url()?>tutor/profile/<?= $user_info[0]['id']?>">Average review:</a></label>
	      		<div class="col-md-5">
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star"></span>
	      		</div>
	      	</div>
	      	<form action="Admin/bank_recipt_number_submit" method="post">
	      	<div class="form-group row"> 
	      		<label class="col-md-4 text-right">Purchase bank & recipt number:</label>
	      		<div class="col-md-5">
	      			<textarea class="form-control" rows="3" name="bank_recipt_number"><?= (isset($recipe_number))?$recipe_number->bank_recipt_number:'';?></textarea>
	      			<input type="hidden" name="userId" value="<?= $user_info[0]['id'] ?>">
	      		</div>
	      		<!--<?php if($user_type != 1) { ?>-->
	      		<div class="col-md-9 text-right" style="margin-top:5px;">
	      		    <button class="btn btn-success btn-sm">Save</button>
	      		</div>
	      		<!--<?php } ?>-->
	      	</div>
	      	</form>
	      </div>
	  	</div>
	</div>
</div>
<style type="text/css">
	.full_section{
		border: 2px solid #e4d7d7;
	    padding: 20px;
	    margin-top: -9px;
	}
	label.label-class{
		font-weight: bold;
		font-size: 15px;
		color: <?= ($user_type == 1 || $user_type == 6 || $user_type == 3 || $user_type == 4 || $user_type == 5)?$color:''; ?>;
	}
	label.student-label-class{
		font-weight: bold;
		font-size: 15px;
		color: <?= ($user_type == 6)?$color:''; ?>;
	}
	label.tutor-label-class{
		font-weight: bold;
		font-size: 15px;
		color: <?= ($user_type == 3 || $user_type == 5)?$color:''; ?>;
	}


</style>