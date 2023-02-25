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
                <div class="col-md-10 col-md-offset-1">
                    <p class="accordion_new">
                        <a class="btn btn-primary" href="" role="button" aria-expanded="" aria-controls="">My Details</a>
                    </p>
                    <div class="col">
                        <div class=" accordion_body2" >
                            <div class="card card-body">
                                <div class="row">
                                    <form class="form-horizontal" id="school_details">			
                                        <div class="col-md-6 bottom10">
                                            <p id="success"></p>
                                            <p id="error"></p>
                                            <div class="form-group">
                                                <div class="text-left col-sm-4">
                                                    <label class="control-label" for="email">User Name:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="name" value="<?php echo $user_info[0]['name']; ?>" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="text-left col-sm-4">
                                                    <label class="control-label" for="email">Login Name:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" id="name" value="<?php echo $user_info[0]['user_email']; ?>" readonly>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <div class="text-left col-sm-4">
                                                    <label class="control-label" for="password">Password:</label>
                                                </div>
                                                <div class="col-sm-8"> 
                                                    <?php //echo $user_info[0]['user_pawd'];?>
                                                    <input type="password" class="form-control" name="password" id="password" value="">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="text-left col-sm-4">
                                                    <label class="" for="passconf">Confirm Password:</label></div>
                                                <div class="col-sm-8"> 
                                                    <?php // echo $user_info[0]['user_pawd'];?>
                                                    <input type="password" class="form-control" name="passconf" id="passconf" value="">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <div class="text-left col-sm-4">
                                                    <label class="control-label" for="country">Country:</label>
                                                </div>
                                                <div class="col-sm-8"> 
                                                    <input type="hidden" name="country_id" value="<?php echo $user_info[0]['country_id']; ?>"/>
                                                    <input class="form-control" readonly type="text" id="country" value="<?php echo $user_info[0]['countryName']; ?>"/>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="text-left col-sm-4">
                                                    <label class="control-label" for="Ref_link">Ref.Link No:</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="hidden" name="SCT_link" value="<?php echo $user_info[0]['SCT_link']; ?>">
                                                    <p><b><?php echo $user_info[0]['SCT_link']; ?></b></p>
                                                </div>																
                                            </div>

                                        </div>
                                        
                                        <div class="col-md-3 bottom10">
                                            <button class="btn btn-success" type="button" style="margin-bottom: 20px;">Add Teacher Limit</button>
                                            <div class="form-group" style="margin-left: 0px;">
                                                <select class="form-control" id="exampleFormControlSelect1" onchange="getData(this)" style="color: #555;background-color: #fff;">
                                                    <option>Select...</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            
                                            <input type="hidden" value="<?php echo sizeof($tutor_info); ?>" name="actual_teacher" id="actual_teacher">
                                            
                                            <h6 id="set_teacher_number" style="font-size: 15px;">
                                                Teacher Limit: <?php echo sizeof($tutor_info); ?>
                                            </h6>
                                            
                                            <?php foreach ($tutor_info as $data) { ?>
                                                <div class="form-group" style="margin-left: 0px;">
                                                    <label for="exampleFormControlSelect1" style="font-size: 13px;">Name</label>
                                                    <input type="text" class="form-control" id="exampleFormControlSelect1" name="name[]" value="<?php echo $data['name']; ?>" style="color: #555;background-color: #fff;">
                                                </div>								  
                                                <div class="form-group" style="margin-left: 0px;">
                                                    <label for="exampleFormControlSelect1" style="font-size: 13px;">Password</label>
                                                    <input type="text" class="form-control" id="exampleFormControlSelect1" name="passwords[]" value="" style="color: #555;background-color: #fff;">

                                                </div>
                                                <input type="hidden" class="form-control" id="exampleFormControlSelect1" name="update_teacher_id[]" value="<?php echo $data['id']; ?>">
                                            <?php } ?>
                                                
                                            <div id="hidden_div">

                                            </div>
                                        </div>	

                                        <div class="col-md-3 bottom10">
                                            <ul class="setting_ul">
                                                <li><a href="#"><img src="assets/images/menu_n1.png"></a></li>
                                                <li>
													<a onclick="upDateStudentProfile();">
														<img src="assets/images/save_btn.png">
													</a>
												</li>	
                                            </ul>
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
</section>


<script>
    function upDateStudentProfile() {
        var data_up = $('#school_details').serialize();
        console.log(data_up);
        $.ajax({
            type: 'ajax',
            method: 'post',
            dataType: 'html',
            url: 'update_school_details',
            data: data_up,
            success: function (msg) {
                if (msg == 0) {
                    $('#success').html('');
                    $('#error').html('Password and confirm password must be same also password length minimum 5 and maximum 6 character');
                } else {
                    $('#error').html('');
                    $('#success').html('Updated Successfully');
                }

            }
        });
    }
    function getData(e) {
        var actual_teacher = $('#actual_teacher').val();
        var set_extra = e.value;
        var uu = parseInt(actual_teacher) + parseInt(set_extra);
        $('#set_teacher_number').html('Teacher number ' + uu);
        var html = '';
        for (i = 0; i < set_extra; i++)
        {
            html += '<div class="form-group" style="margin: 0;width: 108%;"><label for="exampleFormControlSelect1" style="font-size: 13px;">Name</label> <input type="text" class="form-control" id="exampleFormControlSelect1" name="insert_name[]" value=""> </div> <div class="form-group" style="margin: 0;width: 108%;"> <label for="exampleFormControlSelect1" style="font-size: 13px;">Password</label> <input type="text" class="form-control" id="exampleFormControlSelect1" name="insert_passwords[]" value=""> </div>';
        }
        $('#hidden_div').html(html);
    }
</script>
