<div class="" style="margin-left: 15px;">
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
	                <strong style="border: 2px solid;padding: 4px;font-size : 16px;
    border-radius: 6%;"><span><?php echo $date ?></span></strong>
	                <strong style="border: 2px solid;padding: 4px;font-size : 16px;border-radius: 6%;"><span>Notification</span></strong>
	              </a>
	            </h4>
	          </div>
	      	</div>
	      </div>
	      <div class="section full_section">
	      	<div class="form-group row">
	      		<div class="col-md-4">
	      			<table class="table table-bordered">
		                <tbody>
		                  <tr>
		                    <td style="width: 85%"><a href="<?php echo base_url('Admin/trail_list') ?>">Trial</a></td>
		                    <td>
		                        <?= $trial_user_info ?>
		                    </td>
		                  </tr>
		                  <tr>
		                    <td><a href="<?php echo base_url('Admin/signup_users') ?>">Signup</a></td>
		                    <td>
		                        <?= $signup_user_info ?>
		                    </td>
		                  </tr>
		                  <tr>
		                    <td><a href="<?php echo base_url('Admin/inactive_users') ?>">Inactive</a></td>
		                    <td>
		                        <?= $inactive_user_info ?>
		                    </td>
		                  </tr>
		                  <tr>
		                    <td><a href="<?php echo base_url('Admin/suspend_users') ?>">Suspend</a></td>
		                    <td>
		                      <?= $suspend_user_info; ?>
		                    </td>
		                  </tr>
		                </tbody>
		            </table>
		            <br>
	      			<table class="table table-bordered">
		                <tbody>
		                  <tr>
		                    <td><a href="<?php echo base_url('Admin/guest_users') ?>">Guest</a></td>
		                    <td>
		                      <?= $guest_user_info ?>
		                    </td>
		                  </tr>
		                  <tr>
		                    <td><a href="<?php echo base_url('Admin/parent_users') ?>">Parent</a></td>
		                    <td>
		                      <?= $parent_list ?>
		                    </td>
		                  </tr>
		                  <tr>
		                    <td><a href="<?php echo base_url('Admin/student_users') ?>">Student</a></td>
		                    <td>
		                      <?= $student_list ?>
		                    </td>
		                  </tr>
		                  <tr>
		                    <td><a href="<?php echo base_url('Admin/upper_level_users') ?>">Upper Level Student</a></td>
		                    <td>
		                      <?= $upper_student ?>
		                    </td>
		                  </tr>
		                  <tr>
		                    <td><a href="<?php echo base_url('Admin/tutor_users') ?>">Tutor</a></td>
		                    <td>
		                      <?= $tutors_list ?>
		                    </td>
		                  </tr>
		                  <tr>
		                    <td><a href="<?php echo base_url('Admin/corporateList') ?>">Corporate</a></td>
		                    <td>
		                      <?= $corporate_list ?>
		                    </td>
		                  </tr>
		                  <tr>
		                    <td><a href="<?php echo base_url('Admin/schoolList') ?>">School</a></td>
		                    <td>
		                      <?= $school_list ?>
		                    </td>
		                  </tr>
		                </tbody>
		            </table>
	      		</div>
	      		<div class="col-md-4">
	               <table class="table table-bordered">
	                <tbody>
	                  <tr>
	                    <td><a href="<?php echo base_url('Admin/student_prize_list') ?>">Student Prize</a></td>
	                    <td>
	                      <?= $student_prize_list ?>
	                    </td>
	                  </tr>
	                  <tr>
	                    <td><a href="<?php echo base_url('Admin/direct_deposit_list') ?>">Direct Deposit(normal course)</a></td>
	                    <td>
	                    	<?= $direct_deposit_count; ?>
	                    </td>
	                  </tr>
	                  <tr>
	                    <td><a href="<?php echo base_url('Admin/depositeResources') ?>">Direct Deposit(resourse)</a></td>
	                    <td>
	                        <?= $deposite_resources ?>
	                    </td>
	                  </tr>
	                  <tr>
	                    <td><a href="<?php echo base_url('Admin/groupboardResources') ?>">Groupboard (resourse)</a></td>
	                    <td>
	                      <?= $groupboardResources ?>
	                    </td>
	                  </tr>
	                  <tr>
	                    <td><a href="<?php echo base_url('Admin/groupboardTrialList') ?>">Groupboard (trial)</a></td>
	                    <td>
	                      <?= $groupboardTrialList ?>
	                    </td>
	                  </tr>
	                  <tr>
	                    <td><a href="<?php echo base_url('Admin/groupboardSignup') ?>">Groupboard(signup)</a></td>
	                    <td>
	                      <?= $groupboardSignup ?>
	                    </td>
	                  </tr>
	                  <tr>
	                    <td><a href="<?php echo base_url('Admin/tutorCommisionLists') ?>">Tutor(commission)</a></td>
	                    <td>
	                      <?= $CommissiontutorList ?>
	                    </td>
	                  </tr>
	                  <tr>
	                    <td><a href="<?php echo base_url('Admin/vocabularyCommisionLists') ?>">Vocabulary(commission)</a></td>
	                    <td>
	                      <?= $vocabularyCommision ?>
	                    </td>
	                  </tr>

	                  <tr>
	                    <td><a>Inative/Tutor/corporate/school</a></td>
	                    <td>
	                      0
	                    </td>
	                  </tr>

	                  <tr>
	                    <td><a href="<?php echo base_url('Admin/ninteyPercentageMark') ?>">Student who score 90% up</a></td>
	                    <td>
	                      <?= $ninteyPercentageMark ?>
	                    </td>
	                  </tr>
	                  <tr>
	                    <td><a href="<?php echo base_url('Admin/userEmailList') ?>">Email</a></td>
	                    <td>
	                      <?= $email_messages ?>
	                    </td>
	                  </tr>
					  <tr>
	                    <td><a href="<?php echo base_url('Admin/creativeUserList') ?>">Creative Registration</a></td>
	                    <td>
	                      <?= $total_creative_reg ?>
	                    </td>
	                  </tr>
					  <tr>
	                    <td><a href="<?php echo base_url('Admin/new_idea_create_student') ?>">New Idea created student</a></td>
	                    <td>
	                      <?=$idea_created_students;?>
	                    </td>
	                  </tr>
					  <tr>
	                    <td><a href="<?php echo base_url('Admin/new_idea_create_tutor') ?>">New Idea created tutor</a></td>
	                    <td>
						<?=$ides_notification;?>
	                    </td>
	                  </tr>
	                </tbody>
	              </table>
	      		</div>
	      		<div class="col-md-4">
	      			<table class="table table-bordered">
	                <tbody>
	                 <tr>
	                    <td style="width: 85%"><a href="country_users_list/1">Australia</a></td>
	                    <td>
	                      <?= $aus_users ?>
	                    </td>
	                  </tr>
	                  <tr>
	                    <td><a href="country_users_list/9">UK</a></td>
	                    <td>
	                      <?= $uk_users ?>
	                    </td>
	                  </tr>
	                  <tr>
	                    <td><a href="country_users_list/8">Bangladesh</a></td>
	                    <td>
	                      <?= $bd_users ?>
	                    </td>
	                  </tr>
	                  <tr>
	                    <td><a href="country_users_list/2">USA</a></td>
	                    <td>
	                      <?= $usa_users ?>
	                    </td>
	                  </tr>
	                  <tr>
	                    <td><a href="country_users_list/10">Canada</a></td>
	                    <td>
	                      <?= $can_users ?>
	                    </td>
	                  </tr>
	                </tbody>
	              </table>
	      		</div>
            </div>
	      </div>
	  	</div>
	</div>
</div>