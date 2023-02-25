<div class="" style="margin-left: 15px;">
  	<div class="row">
	    <div class="col-md-4">
	      <?php echo $leftnav ?>
	    </div>
		<div class="col-md-8  ">
	      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true"> 
	          <div class="" role="tab" id="headingOne">
	            <h4 class="  text-center"> 
	                
	                <button class="btn btn-success">New Idea created student</button>
	            </h4>
	          </div> 
	      </div>
		  
	      <div class="section full_section">
	      	<div class="form-group row inactive_list">
	      		<?php 
				  
            	$i = 0;
            	foreach ($creative_students as $key => $value): ?>
            		<?php if ($i % 10 == 0 ): ?>
            			<?php if ($i > 0): ?>
            				</div>
            			<?php endif ?>
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
            			<a href="<?php echo base_url();?>Admin/idea_created_student_details/<?=$value['id']?>/<?=$value['student_grade']?>"><p><?= $value['name']; ?></p></a>
            		</div>
                    <input class="selected_users" style="margin-left:10px;" type="checkbox" value="<?php echo $value['user_id'];?>" name ="users[]" <?php foreach($created_idea_students as $student){
						if($student['user_id'] == $value['id']){
                             echo "checked";
						}
					 }?>>
                    </div>
            		<?php $i++;?>
            	<?php endforeach ?>
            	<?php if ($i % 10 != 0): ?>
            		</div>
            	<?php endif ?>
            </div>
	      <br>
	      <br>
	      <div class="form-group p2 text-center">
            	<button class="btn btn-default" id="preview-button" value="">
            		<i class="fa fa-arrow-circle-left"></i> Preview
            	</button>
            	<button class="btn btn-default" id="next-button" value="30">
            		Next <i class="fa fa-arrow-circle-right"></i>
            	</button>
          </div>
	  	</div>
	</div>
</div>
<style type="text/css">
.p2{
	padding: 10px;
}
	.btn-text{
		background: #fff;
	    color: #17a8e9;
	    font-weight: bold;
	    text-decoration: underline;
	}
	.rs_n_table{
		border: none;
		 border-collapse: separate;
  		border-spacing: 10px 0px;
	} 
	.rs_n_table a{
		color: #333;
	}
	.rs_n_table td{
		border-color: #b7dde9 !important;
	}
</style>
 