<div class="" style="margin-left: 15px;">
  	<div class="row">
	    <div class="col-md-4">
	      <?php echo $leftnav ?>
	    </div>
		<div class="col-md-8  ">
	      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true"> 
	          <div class="" role="tab" id="headingOne">
	            <h4 class="  text-center"> 
	                
	                <button class="btn btn-success">New Idea created tuor</button>
	            </h4>
	          </div> 
	      </div> 
	      <div class="row">
		      <div class="col-md-4"> 
		      	 <table class="rs_n_table table table-bordered" ccellspacing="30">
		                <tbody>
                            <?php foreach($all_tutors as $tutor){?>
		                  <tr>
		                    <td style="border:0">
		                    	 <input type="checkbox" name=""
                                 <?php foreach($idea_created_tutor as $created_tutor){
                                       if($created_tutor['id']== $tutor['id']){
                                          echo "checked";
                                       } }?>>
		                    </td>
		                    <td style="width: 85%">
		                    	 <a href="<?php echo base_url('Admin/idea_create_tutor_list/'.$tutor['id']) ?>"><?=$tutor['name'];?></a>  
		                    </td>  
		                  </tr>
                          <?php }?>
		                  
		                </tbody>
		          </table>
		      </div> 
		      <div class="col-md-4"> 
		      	 <table class="rs_n_table table table-bordered" ccellspacing="30">
		                <tbody>
		                  <!-- <tr>
		                    <td style="border:0">
		                    	 <input type="checkbox" name="">
		                    </td>
		                    <td style="width: 85%">
		                    	 <a href="<?php echo base_url('Admin/idea_create_tutor_setting') ?>">Abhor</a>  
		                    </td>  
		                  </tr> -->
		                  
			               	 
		                </tbody>
		          </table>
		      </div> 
		      <div class="col-md-4"> 
		      	 <table class="rs_n_table table table-bordered" ccellspacing="30">
		                <tbody>
		                  <!-- <tr>
		                    <td style="border:0">
		                    	 <input type="checkbox" name="">
		                    </td>
		                    <td style="width: 85%">
		                    	 <a href="<?php echo base_url('Admin/idea_create_tutor_setting') ?>">Abhor</a>  
		                    </td>  
		                  </tr> -->
		                  
			               	 
		                </tbody>
		          </table>
		      </div> 
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
 