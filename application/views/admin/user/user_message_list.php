<div class="" style="margin-left: 15px;">
  	<div class="row">
	    <div class="col-md-4">
	      <?php echo $leftnav ?>
	    </div>
		<div class="col-md-8 user_list">
	      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
	        <div class="">
	          <div class="" role="tab" id="headingOne">
	            <h4 class="panel-title text-center"> 
	                <button class="btn btn-success"><?php echo $date ?></button>
	                <button class="btn btn-success">Message Users</button>
	            </h4>
	          </div>
	      	</div>
	      </div>
	      <div class="section full_section">
	      	<div class="form-group row inactive_list">
	      		<?php 
            	$i = 0;
            	foreach ($messages_users as $key => $value): ?>
            		<?php if ($i % 10 == 0 ): ?>
            			<?php if ($i > 0): ?>
            				</div>
            			<?php endif ?>
            			<div class="col-md-4">
            		<?php endif ?>
            		<div style="border: 1px solid lightblue;padding: 3px 10px">
            			<a href="edit_user/<?php echo $value['user_id'];?>"><p><?= $value['user_name']; ?></p></a>
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
	      </div>
	  	</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#next-button').click(function(){
			var offset = $(this).val();
			console.log(offset);
			$.ajax({
	            url:'Admin/next_inactive_users_list',
	            method: 'POST',
	            data:{'offset': offset},
	            success: function(data){
	                $('.inactive_list').html(data); 
	                var v = parseInt(offset) + 30;
	                $('#next-button').val(v);   
	            }
			})
		})

		$('#preview-button').click(function(){
	        var value = $('#next-button').val();   
			var offset = parseInt(value) - 60;
			// var offset = 0;
			$.ajax({
	            url:'Admin/next_inactive_users_list',
	            method: 'POST',
	            data:{'offset': offset},
	            success: function(data){
	                $('.inactive_list').html(data); 
	                var v = parseInt(value) - 30;
	                $('#next-button').val(v);   
	            }
			})
		})
	})
</script>