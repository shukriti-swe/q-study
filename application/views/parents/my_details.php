<style>
	#error{
		color: red;
		font-weight: bold;
	}

	#success{
		color: green;
		font-weight: bold;
	}
</style>

<section class="main_content ss_sign_up_content bg-gray animatedParent">
        <div class="container-fluid container-fluid_padding">           
            <div class="container">
                <div class="row">                   
                <div class="">
                <div class="col-md-10 col-md-offset-1">
                    <p class="accordion_new">
                        <a class="btn btn-primary" href="" role="button" aria-expanded="" aria-controls="">My Details</a>
                      </p>
                    <div class="">
                      <div class="col">
                        <div class=" accordion_body2" >
                          <div class="card card-body">
                            <form class="form-horizontal" id="my_details">
                                <input type="hidden" name="country_id" value="<?php echo $user_info[0]['country_id'];?>">
                              <div class="row">
                              <div class="col-md-6 bottom10">
                              <p id="success"></p>
                              <p id="error"></p>          
                                  <div class="form-group">
                                    <div class="text-left col-sm-4"><label class="control-label" for="email">User Name:</label></div>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="name" value="<?php echo $user_info[0]['name'];?>" readonly>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <div class="text-left col-sm-4"><label class="control-label" for="email">Login Name:</label></div>
                                    <div class="col-sm-8">
                                      <input type="email" class="form-control" id="name" value="<?php echo $user_info[0]['user_email'];?>" readonly>
                                    </div>
                                  </div>
                                  
                                
                                  <div class="form-group">
                                    <div class="text-left col-sm-4"><label class="control-label" for="password">Password:</label></div>
                                    <div class="col-sm-8"> 
                                      <input type="password" class="form-control" name="password" id="password" value="<?php //echo $user_info[0]['user_pawd'];?>">
                                    </div>
                                  </div>
                                  
                                   <div class="form-group">
                                    <div class="text-left col-sm-4"><label class="" for="passconf">Confirm Password:</label></div>
                                    <div class="col-sm-8"> 
                                      <input type="password" class="form-control" name="passconf" id="passconf" value="<?php //echo $user_info[0]['user_pawd'];?>">
                                    </div>
                                  </div>
                                  
                                  
                                  <div class="form-group">
                                    <div class="text-left col-sm-4"><label class="control-label" for="country">Country:</label></div>
                                    <div class="col-sm-8"> 
                                    
                                         
                                        <input class="form-control" type="text" id="country" value="<?php  echo $user_info[0]['countryName'];?>"/>
                                     
                                    </div>
                                  </div>
                                 <div class="form-group">
                                    <div class="text-left col-sm-4"><label class="control-label" for="children">No of children:</label></div>
                                    <div class="col-sm-8"> 
                                     
                                     <!--<input class="form-control" readonly type="number" id="children" value="<?php  echo $user_info[0]['children_number'];?>"/>-->
                                     <input class="form-control" readonly type="number" id="children" value="<?php  echo $total_child;?>"/>
                                     
                                    </div>
                                  </div>

                                </div>
                                
                                <div class="col-md-3 bottom10 ">
                                    <button type="button" class="btn btn-primary" id="addNewChild"><i class="fa fa-plus"></i> Add Child</button>
                                    <br><br>
                                    <?php foreach ($user_child_info as $key => $value): ?>
                                        <div class="form-group"  style="margin-left:0px;">
                                            <input class="form-control" value="<?= $value['name']; ?>" readonly>
                                        </div>
                                    <?php endforeach ?>
                                    <div class="form-group" id="newChildField" style="margin-left:0px;"></div>
                                    <div class="form-group" id="newChildFieldGrade" style="margin-left:0px;"></div>
                                </div>
                                <div class="col-md-3 bottom10">
                                    <ul class="setting_ul">
                                        <li><a href="#"><img src="assets/images/menu_n1.png"></a></li>
                                        <li>
											<a onclick="upDateMyProfile();">
												<img src="assets/images/save_btn.png">
											</a>
										</li>  
                                    </ul>
                                </div>
                                </div>
                                </form>
                            </div>
                        </div>
                      </div> 
                    </div>
                </div>
                </div>
             </div>
             </div>
        </div>
</section>
<script>
function upDateMyProfile(){
    var data_up=$('#my_details').serialize();
    $.ajax({
        type: 'ajax',
        method: 'post',
        async: false,
        dataType:'html',
        url: 'update_my_details',
        data:data_up,
        success: function(msg){
            if(msg == 0){
                $('#success').html('');
                $('#error').html('Password and confirm password must be same also password length minimum 5 and maximum 6 character');
            }else if(msg == 2){
                $('#error').html('');
                $('#success').html('New child add successfully');
                location.reload();
                
            }else{
                $('#error').html('');
                $('#success').html('Password Updated');
            }
        
        }
    });
}


$(document).ready(function() {
    $('#addNewChild').click(function(){
        var input = jQuery('<input name="childName" class="form-control" placeholder="Enter Name">');
        var inputGrade = jQuery('<input name="childgrade" type="number" class="form-control" placeholder="Enter Grade">');
        jQuery('#newChildField').append(input);
        jQuery('#newChildFieldGrade').append(inputGrade);
        $(this).prop("disabled",true);
        
    })
    
})
</script>
