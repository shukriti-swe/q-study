<div class="" style="margin-left: 15px;">
  	<div class="row">
	    <div class="col-md-4">
	      <?php echo $leftnav ?>
	    </div>
		<div class="col-md-8 user_list">

		<form action="<?php echo base_url('Admin/saveandviewdetails') ?>" method="post" >
        
        <?php foreach($selected_student as $students){?>
            <input type="hidden" name ="assigned_student[]" value="<?php echo $students;?>">
            <?php }?>
        
	      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
	        <div class="">
	          <div class="" role="tab" id="headingOne">
	            <h4 class="panel-title text-center"> 
	                <button type="submit" class="btn btn-success" id="add_examine">Tutor (Examiner)</button>
	                
	            </h4>
	          </div>
	      	</div>
	      </div>
	      <div class="section full_section">
	      	<div class="form-group row inactive_list">
	      		<?php 
            	$i = 0;
          
            	foreach ($alltutor as $key => $value): ?>
            		<?php if ($i % 10 == 0 ): ?>
            			<?php if ($i > 0): ?>
            				</div>
            			<?php endif ?>
                        <!-- <p>Grade</p> -->
            			<div class="col-md-4">
            		<?php endif ?>
                    
                    <div style="display: flex; text-align: center;">
            		
                    <input  style="margin-right:10px;" type="checkbox" value="<?php echo $value['id'];?>" name ="examine[]">
                    

                    <div style="text-align:left;border: 1px solid lightblue;padding: 3px;width:150px; margin-left:10px;">
            			<a href="edit_user/<?php echo $value['id'];?>"><p><?= $value['name']; ?></p></a>
            		</div>
                    
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
<!-- <script>
	$(document).ready(function(){
		$('#add_examine').click(function(event){
            event.preventDefault();
			var all_user = [];
            $(".selected_users").each(function() {
                if($(this).is(":checked")){
                   var user = $(this).val();
                   all_user.push(user);
                }
                });
                console.log(all_user);
                window.location.href = "";
		});

	
	});
</script> -->
