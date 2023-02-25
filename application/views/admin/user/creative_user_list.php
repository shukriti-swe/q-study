<div class="" style="margin-left: 15px;">
  	<div class="row">
	    <div class="col-md-4">
	      <?php echo $leftnav ?>
	    </div>
		<div class="col-md-8 user_list">

		<form action="<?php echo base_url('Admin/addExamine') ?>" method="post" >
	      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
	        <div class="">
	          <div class="" role="tab" id="headingOne">
	            <h4 class="panel-title text-center"> 
	                <button type="submit" class="btn btn-success" id="add_examine">Examiner</button>
	                <button type="button" class="btn btn-success">Creativee Registration</button>
	            </h4>
	          </div>
	      	</div>
	      </div>
	      <div class="section full_section">
	      	<div class="form-group row inactive_list">
	      		<?php 
				  
            	$i = 0;
            	foreach ($creative_registers as $key => $value): ?>
            		<?php if ($i % 10 == 0 ): ?>
            			<?php if ($i > 0): ?>
            				</div>
            			<?php endif ?>
                        <!-- <p>Grade</p> -->
            			<div class="col-md-4">
            		<?php endif ?>
                    <?php if ($i % 10 == 0 ): ?>
                    <p><b>Grade</b></p>
                    <?php endif ?>
                    <div style="display: flex; text-align: center;">
            		<div style="border: 1px solid lightblue;padding: 3px;width:50px;">
            			<a href="edit_user/<?php echo $value['user_id'];?>"><p><?= $value['student_grade']; ?></p></a>
            		</div>
                    <div style="text-align:left;border: 1px solid lightblue;padding: 3px;width:150px; margin-left:10px;">
            			<a href="edit_user/<?php echo $value['user_id'];?>"><p><?= $value['name']; ?></p></a>
            		</div>
                    <input class="selected_users" style="margin-left:10px;" type="checkbox" value="<?php echo $value['user_id'];?>" name ="users[]">
                    </div>
            		<?php $i++;?>
            	<?php endforeach ?>
            	<?php if ($i % 10 != 0): ?>
            		</div>
            	<?php endif ?>
            </div>
            <div class="form-group row text-right">
            	<button class="btn btn-default" id="preview-button" value=""><i class="fa fa-arrow-circle-left"></i></i> Preview</button>
            	<button class="btn btn-default" id="next-button" value="30">Next <i class="fa fa-arrow-circle-right"></i></button>
            </div>
			</form>
	      </div>
	  	</div>
	</div>
</div>

