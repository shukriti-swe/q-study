<style>
    .trial_button{
        color:black;
        text-decoration:underline;
        font-size:22px;
        display:inline-block;
        font-weight:bold;
        cursor: pointer;
    }
    .charge_button{
        color:black;
        text-decoration:underline;
        font-size:22px;
        display:inline-block;
        font-weight:bold;
        cursor: pointer;
        margin-left:10px;
    }
    .course_checkbox{
        position:relative !important;
        bottom:0px !important;
    }
    .course_image{
        height: 100px;
        width: 100px;
        padding-left:5px;
    }
    .cost_box{
        position: absolute;
        bottom: 10px;
        height: 35px;
        width: 36px;
        border-radius: 50%;
        padding-top: 10px;
        padding-left: 4px;
        background-color: #b0e7fa;
    }
    .cost_box_second{
        height:50px;
        width:51px;
        border-radius:50%;
        padding-top: 14px;
        padding-left: 5px;
        background-color:#b0e7fa;
        bottom: 0px;
        position: absolute;
    }
    .course_one_serial{
        border: 1px solid #b6b6b6;
        padding: 15px;
        box-shadow: 0px 0px 10px #b6b6b6;
        border-radius: 10px;
        text-align:left;
        min-height:230px;
        cursor:pointer;
    }
    .course_two_serial{
        border: 1px solid #b6b6b6;
        padding: 15px;
        box-shadow: 0px 0px 10px #b6b6b6;
        border-radius: 10px;
        text-align:left;
        min-height:325px;
    }
    .course_three_serial{
        border: 1px solid #b6b6b6;
        padding: 15px;
        box-shadow: 0px 0px 10px #b6b6b6;
        border-radius: 10px;
        text-align:left;
        min-height:325px;
    }
    .course_without_image{
        border: 1px solid #b6b6b6;
        box-shadow: 0px 0px 10px #b6b6b6;
        border-radius: 10px;
        text-align:left;
        min-height:325px;
        padding-bottom:14px;
        
    }
    .without_image_course_name{
        font-family: century-gothic, sans-serif;
        font-weight:bold;
        font-size:16px;
        text-align: center;
    }
    .without_image_course_grade{
        font-family: century-gothic, sans-serif;
        font-weight:bold;
        font-size:16px;
        text-align: center;
        color:#d63832;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="button_schedule">
            <div class="row">
                <div class="col-md-7 text-right">
                  <!-- <div style="display:flex;gap:10px;" class=""> -->
                    <a type="button" class="trial_button">Trial</a>
                    <a type="button" class="charge_button" style="color:#2198c5;">Charge</a>
                  <!-- </div> -->
                </div>
                <div class="col-md-5 text-right">
                    
                    <a href="" class="btn btn_next" data-toggle="modal" data-target="#ss_sucess_mess"><i class="fa fa-save"></i> Save</a>
                    <a href="" class="btn btn_next"><i class="fa fa-home"></i> Home</a>
                    
                </div>
            </div>
            
        </div>

        <input type="hidden" name="country_id" id="country_id" value="<?php echo $country_info[0]['id']?>">
        <input type="hidden" name="user_type" id="user_type" value="<?php echo $user_type;?>">
        <input type="hidden" name="subscription_type" id="subscription_type" value="<?php echo $subscription_type;?>">

        <div class="charge_box">
          <div class="row schedule_country_details">
            <div class="col-md-3">
                <P style=" color: #000; "><i class="fa fa-file" style=" color: #fbea71; "></i> <?php echo $country_info[0]['countryName']?></P>
            </div>
            <div class="col-md-9">
                <label class="col-md-2">How Many Rows</label>
                <div class="col-md-2">
                    <input class="form-control" type="number" value="<?php if($course_info){echo count($course_info);}else{echo 0;}?>" id="box_num">
                </div>
                <div class="col-md-2">
                    <button class="btn btn_next" type="button" id="add_course_schedule_box">Submit</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" id="show_course_box" style="margin-top: 30px;">
                    <?php $i = 1;foreach ($course_info as $row){?>
                    <div class="col-md-4" id="show_box_content<?php echo $i;?>">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class ="form-group">
                                    <label for="text" style="float:left;margin-right:5px;">1</label>       
                                    <div class="input-group">   
                                        <input  class="validate[required] text-input form-control" style="height: 21px;margin: 0px;width: auto" type="checkbox" value="1" id="is_enable<?php echo $i;?>" <?php if($row['is_enable'] == 1){echo 'checked';}?>/>                                           
                                    </div>   
                                </div> 
                                <div class ="form-group">
                                    <label for="text" style="float:left;margin-right:5px;">$</label>       
                                    <div class="input-group">   
                                        <input  class="validate[required] text-input form-control" type="number" id="course_cost<?php echo $i;?>" value="<?php echo $row['courseCost'];?>"/>

                                        <input type="hidden" id="course_id<?php echo $i?>" value="<?php echo $row['id']?>"/>
                                    </div>   
                                </div> 
                                <div style="display:flex;">
                                    <label for="text" style="float:left;margin-right:5px;">$</label>       
                                    <div class="input-group">   
                                        <input  class="validate[required] text-input form-control" type="number" id="other_box<?php echo $i;?>" value=""/>
                                    </div>
                                    <input type="checkbox" name="other_check" style="margin-left:5px;">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <span style="color:red;font-weight:bold;margin-left:20px;">SN: <?=$i?></span>
                                <textarea class="course_textarea" id="course_name<?php echo $i;?>"><?php echo $row['courseName'] ?></textarea>
                            </div>

                            <div class="col-md-12" style="text-align: center;margin: 10px;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="upload_image">
                                            <span style="text-decoration:underline;color:#7f7f7f;font-size:22px;">Upload</span>
                                            <input type="file" data-id="<?=$i;?>" class="image_option option_<?=$i?>" style="position:absolute;top:0;left:0;opacity:0;" id="upload_option_image_<?=$i?>">
                                        </div>
                                        <p style="word-break:break-all;" class="image_upload_name<?=$i;?>"></p>
                                    </div>
                                    <div class="col-md-9">
                                        <?php
                                           if(!empty($row['image_name'])){
                                              $image_path = 'assets/course_image/'.$row['image_name'];
                                           }else{
                                              $image_path = 'assets/course_image/no_image.jpg';
                                           }
                                        ?>
                                        <!-- <img class="course_image_show_<?=$i?>" src="<?=$image_path?>" style="height:110px;width:195px;"> -->

                                        <!-- =============== -->
                                        <?php if($i!=2){?>
                                            <div class="course_one_serial selected_course selected_course<?=$i;?>" data-id="<?=$i;?>">

                                                <input type="checkbox" name="course[]" id="course_<?php echo $i; ?>" class="course_checkbox" value="<?php echo $row['id'] ?>" data="<?php echo $row['courseCost'] ?>">
                                                <div class="row">
                                                <div class="col-md-4" style="padding-right:0px;padding-left:8px;">
                                                    <?php $course_name = preg_split('#<p([^>])*>#',$row['courseName']);
                                                    //echo "<pre>";print_r(array_filter($course_name));die();
                                                    $course_name = array_filter($course_name);
                                                    $course = '';
                                                    $grade = '';
                                                    if(isset($course_name[0])){
                                                        $course = $course_name[0];
                                                    }else if(isset($course_name[1])){
                                                        $course = $course_name[1];
                                                    }
                                                    if(isset($course_name[2])){
                                                        $grade =  $course_name[2];
                                                    }
                                                    ?>
                                                    <br><br>
                                                    <p class="courseName<?=$i;?>" style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:12px;text-align: center;"><?php echo $course?></p>
                                                    <p class="gradeName<?=$i;?>" style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:12px;text-align: center;color:#d63832;"><?php echo $grade?></p>
                                                    
                                                </div>
                                                    <div class="col-md-8">
                                                        <?php if(!empty($row['image_name'])){?>
                                                            <img src="assets/course_image/<?=$row['image_name']?>" class="course_image">
                                                        <?php }?>
                                                    </div>
                                                </div>
                                                <div class="cost_box">$<?=$row['courseCost']?></div>
                                            </div>
                                        <?php }else if($i==2){?>
                                            <div class="course_one_serial selected_course selected_course<?=$i;?>" data-id="<?=$i;?>">

                                                <input type="checkbox" name="course[]" id="course_<?php echo $i; ?>" class="course_checkbox" value="<?php echo $row['id'] ?>" data="<?php echo $row['courseCost'] ?>">
                                                <div class="row">
                                                    <div class="col-md-12" style="padding-right:0px;padding-left:8px;">
                                                        <?php $course_name = preg_split('#<p([^>])*>#',$row['courseName']);
                                                        //echo "<pre>";print_r(array_filter($course_name));die();
                                                        $course_name = array_filter($course_name);
                                                        $course = '';
                                                        $grade = '';
                                                        if(isset($course_name[0])){
                                                            $course = $course_name[0];
                                                        }else if(isset($course_name[1])){
                                                            $course = $course_name[1];
                                                        }
                                                        if(isset($course_name[2])){
                                                            $grade =  $course_name[2];
                                                        }
                                                        ?>
                                                        <br><br><br>
                                                        <p class="courseName<?=$i;?>" style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:12px;text-align: center;"><?php echo $course?></p>
                                                        <p class="gradeName<?=$i;?>" style="font-family: century-gothic, sans-serif;font-weight:bold;font-size:12px;text-align: center;color:#d63832;"><?php echo $grade?></p>
                                                        
                                                    </div>

                                                    <div class="col-md-4" style="position:relative;">
                                                       <div class="cost_box">$<?=$row['courseCost']?></div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div>
                                                          <img src="assets/course_image/<?=$row['image_name']?>" class="course_image">
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }?>
                                        <!-- =============== -->
                                        
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn_next" type="button" style="padding: 5px;" onclick="add_course_schedule('<?php echo $i;?>')">submit</button>
                            </div>
                            <div id="show_course_content<?php echo $i;?>">
                                
                            </div>

                        </div>
                    </div>
                    <?php $i++;}?>
                </div>
            </div>
           </div>
        </div>

        <?php
           //echo "<pre>";print_r($trial_course_info);die();
        ?>
        <div class="trial_box" style="display:none;">
          <div class="row schedule_country_details">
            <div class="col-md-3">
                <P style=" color: #000; "><i class="fa fa-file" style=" color: #fbea71; "></i> <?php echo $country_info[0]['countryName']?></P>
            </div>
            <div class="col-md-9">
                <label class="col-md-2">How Many Rows</label>
                <div class="col-md-2">
                    <input class="form-control" type="number" value="<?php if($trial_course_info){echo count($trial_course_info);}else{echo 0;}?>" id="trial_box_num">
                </div>
                <div class="col-md-2">
                    <button class="btn btn_next" type="button" id="add_trial_course_schedule_box">Submit</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" id="show_trial_course_box" style="margin-top: 30px;">
                    <?php $i = 1;foreach ($trial_course_info as $row){?>
                    <div class="col-md-4" id="show_box_content<?php echo $i;?>">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class ="form-group">
                                    <label for="text" style="float:left;margin-right:5px;">1</label>       
                                    <div class="input-group">   
                                        <input  class="validate[required] text-input form-control" style="height: 21px;margin: 0px;width: auto" type="checkbox" value="1" id="trial_is_enable<?php echo $i;?>" <?php if($row['is_enable'] == 1){echo 'checked';}?>/>                                           
                                    </div>   
                                </div>
                                <div class ="form-group">
                                    <label for="text" style="float:left;margin-right:5px;">$</label>       
                                    <div class="input-group">   
                                        <input  class="validate[required] text-input form-control trial_course_cost" type="number" data-id="<?php echo $i;?>" id="trial_course_cost<?php echo $i;?>" value="<?php echo $row['courseCost'];?>"/>

                                        <input type="hidden" id="trial_course_id<?php echo $i?>" value="<?php echo $row['id']?>"/>
                                    </div>   
                                </div> 
                                
                                <div style="display:flex;">
                                    <label for="text" style="float:left;margin-right:5px;">$</label>       
                                    <div class="input-group">   
                                        <input  class="validate[required] text-input form-control" type="number" id="trial_other_box<?php echo $i;?>" value=""/>
                                    </div>
                                    <input type="checkbox" name="other_check" style="margin-left:5px;">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <span style="color:red;font-weight:bold;margin-left:20px;">SN: <?=$i?></span>
                                <textarea class="course_textarea" id="trial_course_name<?php echo $i;?>"><?php echo $row['courseName'] ?></textarea>
                            </div>

                            <div class="col-md-12" style="text-align: center;margin: 10px;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="upload_image">
                                            <span style="text-decoration:underline;color:#7f7f7f;font-size:22px;">Upload</span>
                                            <input type="file" data-id="<?=$i;?>" class="trial_image_option option_<?=$i?>" style="position:absolute;top:0;left:0;opacity:0;" id="upload_trial_option_image_<?=$i?>">
                                        </div>
                                        <p style="word-break:break-all;" class="trial_image_upload_name<?=$i;?>"></p>
                                    </div>
                                    <div class="col-md-9">
                                        <?php
                                           if(!empty($row['image_name'])){
                                              $image_path = 'assets/course_image/'.$row['image_name'];
                                           }else{
                                              $image_path = 'assets/course_image/no_image.jpg';
                                           }
                                        ?>
                                        <img class="course_image_show_<?=$i?>" src="<?=$image_path?>" style="height:110px;width:195px;">
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn_next" type="button" style="padding: 5px;" onclick="add_trial_course_schedule('<?php echo $i;?>')">submit</button>
                            </div>
                            <div id="show_course_content<?php echo $i;?>">
                                
                            </div>

                        </div>
                    </div>
                    <?php $i++;}?>
                </div>
            </div>
           </div>
        </div>
        
    </div>
</div>



<!--   Success Message   -->
<div class="modal fade ss_modal" id="ss_sucess_mess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
                <img src="assets/images/icon_info.png" class="pull-left"> <span class="ss_extar_top20">Save Sucessfully</span> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

 
<script>
    var exist_box_num = <?php if($course_info){echo count($course_info);}else{echo 0;}?>;
    var exist_trial_box_num = <?php if($trial_course_info){echo count($trial_course_info);}else{echo 0;}?>;

    $(document).ready(function () {
        
        $("#add_course_schedule_box").on("click", function () {
            
            var box_num = $("#box_num").val();
            
            for (var i = 1; i <= parseInt(box_num); i++) {
               //     console.log(exist_box_num);
                if(i > exist_box_num){
                    create_box(i);
                    exist_box_num = i;
                }
            }
            
            
            $('.course_textarea').ckeditor({
                height: 50,
                extraPlugins : 'simage',
                filebrowserBrowseUrl: '/assets/uploads?type=Images',
                filebrowserUploadUrl: 'imageUpload',
                toolbar: [
                        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                        { name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
                        '/',
                        { name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','Table','-', 'Templates','Link', 'addFile'] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                                // Line break - next group will be placed in new line.
                        '/',
                        { name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] }
                    ],
                allowedContent: true
            });
        });

        $("#add_trial_course_schedule_box").on("click", function () {
            var box_num = $("#trial_box_num").val();
            
            for (var i = 1; i <= parseInt(box_num); i++) {
               //     console.log(exist_box_num);
                if(i > exist_trial_box_num){
                    trial_create_box(i);
                    exist_trial_box_num = i;
                }
            }
            
            
            $('.course_textarea').ckeditor({
                height: 50,
                extraPlugins : 'simage',
                filebrowserBrowseUrl: '/assets/uploads?type=Images',
                filebrowserUploadUrl: 'imageUpload',
                toolbar: [
                        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                        { name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
                        '/',
                        { name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','Table','-', 'Templates','Link', 'addFile'] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                                // Line break - next group will be placed in new line.
                        '/',
                        { name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] }
                    ],
                allowedContent: true
            });
        });
        
    });
    
    function create_box(box_num){
        var box_element = "";
        box_element += '<div class="col-md-4" id="show_box_content'+box_num+'">';

            box_element += '<div class="col-md-12">';
                box_element += '<div class="col-md-4">';
                    box_element += '<div class ="form-group">';
                        box_element += '<label for="text" style="float:left;margin-right:5px;">1</label>';
                        box_element += '<div class="input-group">';
                            box_element += '<input class="validate[required] text-input form-control" style="height: 21px;margin: 0px;width: auto" type="checkbox" value="1" id="is_enable'+box_num+'" />';
                        box_element += '</div>';
                    box_element += '</div>';
                    

                    box_element += '<div class ="form-group">';
                        box_element += '<label for="text" style="float:left;margin-right:5px;">$</label>';
                        box_element += '<div class="input-group">';
                            box_element += '<input  class="validate[required] text-input form-control" type="number" id="course_cost'+box_num+'"  value="<?php //if($subscription_type == 2){echo 0;}?>"/>';
                            box_element += '<input type="hidden" id="course_id'+box_num+'" value=""/>';
                        box_element += '</div>';
                    box_element += '</div>';

                    box_element += '<div style="display:flex;"><label for="text" style="float:left;margin-right:5px;">$</label><div class="input-group"><input  class="validate[required] text-input form-control" type="number" id="other_box'+box_num+'" value=""/></div><input type="checkbox" name="other_check" style="margin-left:5px;"></div>';

                box_element += '</div>';

                box_element += '<div class="col-md-8">';
                    box_element += '<span style="color:red;font-weight:bold;margin-left:20px;">SN: '+box_num+'</span><textarea class="course_textarea" id="course_name'+box_num+'"></textarea>';
                box_element += '</div>';

                box_element += '<div class="col-md-12" style="text-align: center;margin: 10px;">';
                box_element += '<div class="row"><div class="col-md-3"><div class="upload_image"><span style="text-decoration:underline;color:#7f7f7f;font-size:22px;">Upload</span><input type="file" data-id="'+box_num+'" class="image_option option_'+box_num+'" style="position:absolute;top:0;left:0;opacity:0;" id="upload_option_image_'+box_num+'"></div><p style="word-break:break-all;" class="image_upload_name'+box_num+'"></p></div><div class="col-md-9"><img class="course_image_show_'+box_num+'" src="assets/course_image/no_image.jpg" style="height:110px;width:195px;"></div></div><br>';
                    box_element += '<button class="btn btn_next" type="button" style="padding: 5px;" onclick="add_course_schedule('+box_num+')">submit</button>';
                box_element += '</div>';
                box_element += '<div id="show_course_content'+box_num+'">';
                box_element += '</div>';
            box_element += '</div>';
        box_element += '</div>';
        
        $("#show_course_box").append(box_element);
    }

    function trial_create_box(box_num){
        var box_element = "";
        box_element += '<div class="col-md-4" id="show_box_content'+box_num+'">';

            box_element += '<div class="col-md-12">';
                box_element += '<div class="col-md-4">';
                    box_element += '<div class ="form-group">';
                        box_element += '<label for="text" style="float:left;margin-right:5px;">1</label>';
                        box_element += '<div class="input-group">';
                            box_element += '<input class="validate[required] text-input form-control" style="height: 21px;margin: 0px;width: auto" type="checkbox" value="1" id="trial_is_enable'+box_num+'" />';
                        box_element += '</div>';
                    box_element += '</div>';

                    box_element += '<div class ="form-group">';
                        box_element += '<label for="text" style="float:left;margin-right:5px;">$</label>';
                        box_element += '<div class="input-group">';
                            box_element += '<input  class="validate[required] text-input form-control trial_course_cost" type="number" data-id="'+box_num+'" id="trial_course_cost'+box_num+'"  value="0"/>';
                            box_element += '<input type="hidden" id="trial_course_id'+box_num+'" value=""/>';
                        box_element += '</div>';
                    box_element += '</div>';

                    box_element += '<div style="display:flex;"><label for="text" style="float:left;margin-right:5px;">$</label><div class="input-group"><input  class="validate[required] text-input form-control" type="number" id="trial_other_box'+box_num+'" value=""/></div><input type="checkbox" name="other_check" style="margin-left:5px;"></div>';

                box_element += '</div>';

                box_element += '<div class="col-md-8">';
                    box_element += '<span style="color:red;font-weight:bold;margin-left:20px;">SN: '+box_num+'</span><textarea class="course_textarea" id="trial_course_name'+box_num+'"></textarea>';
                box_element += '</div>';

                box_element += '<div class="col-md-12" style="text-align: center;margin: 10px;">';
                
                box_element += '<div class="row"><div class="col-md-3"><div class="upload_image"><span style="text-decoration:underline;color:#7f7f7f;font-size:22px;">Upload</span><input type="file" data-id="'+box_num+'" class="trial_image_option option_'+box_num+'" style="position:absolute;top:0;left:0;opacity:0;" id="upload_trial_option_image_'+box_num+'"></div><p style="word-break:break-all;" class="trial_image_upload_name'+box_num+'"></p></div><div class="col-md-9"><img class="course_image_show_'+box_num+'" src="assets/course_image/no_image.jpg" style="height:110px;width:195px;"></div></div><br>';

                    box_element += '<button class="btn btn_next" type="button" style="padding: 5px;" onclick="add_trial_course_schedule('+box_num+')">submit</button>';
                box_element += '</div>';
                box_element += '<div id="show_course_content'+box_num+'">';
                box_element += '</div>';
            box_element += '</div>';
        box_element += '</div>';
        
        $("#show_trial_course_box").append(box_element);
    }
    
    
    function add_course_schedule(box_num){
        var is_enable = 0;
        if($('input:checkbox[id=is_enable'+box_num+']').is(':checked') ==true ) {
            is_enable = 1; 
        }

        var property = document.getElementById('upload_option_image_'+box_num).files[0];
        if(property != undefined){
            var image_name = property.name;
            var image_extension = image_name.split('.').pop().toLowerCase();
            if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png','']) == -1){
                //alert("Invalid image file");
            }
        }


        var form_data = new FormData();
        form_data.append("file",property);
        form_data.append("user_type",$("#user_type").val());
        form_data.append("box_num",box_num);
        form_data.append("country_id",$("#country_id").val());
        form_data.append("course_id",$("#course_id"+box_num).val());
        form_data.append("courseName",$("#course_name"+box_num).val());
        form_data.append("courseCost",$("#course_cost"+box_num).val());
        form_data.append("is_enable",is_enable);

        $.ajax({
            url: '<?php echo site_url('save_course_schedule'); ?>',
            type: 'POST',
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            success: function (data) { 
                var res = jQuery.parseJSON(data);
                $('#course_id'+box_num).val(res.course_id);
                $('#show_course_content'+box_num).html(res.course_content_div);
                if(res.image_name != undefined){
                    var paths = 'assets/course_image/'+res.image_name;
                    $('.course_image_show_'+box_num).attr('src',paths);
                }else{
                    var paths = 'assets/course_image/no_image.jpg';
                    $('.course_image_show_'+box_num).attr('src',paths);
                }
                
            }
        });
    }

    function add_trial_course_schedule(box_num){
        var is_enable = 0;
        if($('input:checkbox[id=trial_is_enable'+box_num+']').is(':checked') ==true ) {
            is_enable = 1; 
        }

        var property = document.getElementById('upload_trial_option_image_'+box_num).files[0];
        if(property != undefined){
            var image_name = property.name;
            var image_extension = image_name.split('.').pop().toLowerCase();
            if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png','']) == -1){
                //alert("Invalid image file");
            }
        }

        var form_data = new FormData();
        form_data.append("file",property);
        form_data.append("user_type",$("#user_type").val());
        form_data.append("box_num",box_num);
        form_data.append("country_id",$("#country_id").val());
        form_data.append("course_id",$("#trial_course_id"+box_num).val());
        form_data.append("courseName",$("#trial_course_name"+box_num).val());
        form_data.append("courseCost",$("#trial_course_cost"+box_num).val());
        form_data.append("is_enable",is_enable);

        $.ajax({
            url: '<?php echo site_url('save_trial_course_schedule'); ?>',
            type: 'POST',
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            success: function (data) { 
                var res = jQuery.parseJSON(data);
                $('#trial_course_id'+box_num).val(res.course_id);
                $('#show_course_content'+box_num).html(res.course_content_div);
               
                if(res.image_name != undefined){
                    var paths = 'assets/course_image/'+res.image_name;
                    $('.course_image_show_'+box_num).attr('src',paths);
                }else{
                    var paths = 'assets/course_image/no_image.jpg';
                    $('.course_image_show_'+box_num).attr('src',paths);
                }
                
            }
        });
    }
    
    
    function delete_course(course_id,box_num){
    
        $.ajax({
            url: '<?php echo site_url('delete_course'); ?>',
            type: 'POST',
            data: {
                course_id: course_id,
            },
            success: function (data) {
                $('#show_box_content'+box_num).remove();
                exist_box_num = 0;
            }
        });
    }

    $(function() {
        $('.trial_button').click(function(){
           $(this).css('color','#2198c5;');
           $(this).attr('data-id',1);
           $('.charge_button').removeAttr('style');
           $('.charge_button').removeAttr('data-id');
           $('.trial_box').show();
           $('.charge_box').hide();
        });

        $('.charge_button').click(function(){
           $(this).css('color','#2198c5;');
           $(this).attr('data-id',1);
           $('.trial_button').removeAttr('style');
           $('.trial_button').removeAttr('data-id');
           $('.trial_box').hide();
           $('.charge_box').show();
        });

        $(document).on('change','.image_option', function(){
            var id=$(this).attr('data-id');
            var property = document.getElementById('upload_option_image_'+id).files[0];
            if(property != undefined){
                var image_name = property.name;
                $('.image_upload_name'+id).text(image_name);
                var image_extension = image_name.split('.').pop().toLowerCase();
                if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png','']) == -1){
                    //alert("Invalid image file");
                }
            }else{

            }
        });

        // $('.trial_image_option').change(function(){
        $(document).on('change','.trial_image_option', function(){
            var id=$(this).attr('data-id');
            var property = document.getElementById('upload_trial_option_image_'+id).files[0];
            if(property != undefined){
                var image_name = property.name;
                $('.trial_image_upload_name'+id).text(image_name);
                var image_extension = image_name.split('.').pop().toLowerCase();
                if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png','']) == -1){
                    //alert("Invalid image file");
                }
            }else{

            }
        });

        $(document).on('change','.trial_course_cost', function(){
            var chk_val = $(this).val();

            var id = $(this).attr('data-id');
            if(chk_val != 0){
               alert('Trial Course cost all time 0');
               $('#trial_course_cost'+id).val(0);
            }
            
        });
    });
    
</script>