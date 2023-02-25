<style>
    td {
        border: 2px solid #f68d20 !important;
    }
    
    .checkbox input[type="checkbox"]{
        position: absolute;
        margin-top: 4px\9;
        margin-left: 0px;
    }

</style>


<div class="" style="margin-left: 15px;">
    <div class="row">
        <!--<div class="col-md-2"></div>-->
        <div class="col-md-12 user_list">
            <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title text-center">
                            <img style="float:left;" src="assets/images/email-read.png" alt="" width="45px" height="45px;">
                            <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                                <strong><span style="font-size : 18px; ">  Set Message </span></strong>
                            </a>
                        </h4>
                    </div>
					<div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-6">
                            <?php $this->load->view('flash_message_section'); ?>
                        </div>
                    </div>
                    <form action="message/set" method="POST" id="message_send"> 
                        
                        <input type="hidden" name="message_id" value="<?php if(isset($message_info[0]['id'])){echo $message_info[0]['id'];}?>">
                        
                        <div class="row panel-body">
                            <div class="col-sm-12 text-right"> 
                                <a href="message/topics" style="display: inline-block;">
                                    <button type="button" class="btn btn_next" id=""><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                                </a>
                                <button type="submit"  class="btn btn_next" id=""><i class="fa fa-check" style="padding-right: 5px;"></i>Save</button>
								<button type="button"  class="btn btn_next" id="proceed_email"><i class="fa fa-check" style="padding-right: 5px;"></i>Proceed</button>
                            </div> 
                        </div>
                        <div class="row panel-body">
                            <div class="col-sm-4"> 
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="title" placeholder="" value="<?php echo $message_info[0]['topic_name']; ?>" readonly>
                                        <input type="hidden" name="topicId" value="<?php echo $message_info[0]['topic']; ?>">
                                    </div>
                                </div>
<!--                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 control-label">Date to Show</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control datepicker" id="datepicker" placeholder="" name="dateToShow" value="">
                                    </div>
                                </div>-->

                                <div class="form-group row">
                                    <label for="body" class="col-sm-2 control-label">Body</label>
                                    <div class="col-sm-10">
                                        <textarea class="mytextarea" name="body" id="body" cols="30" rows="3"><?php if(isset($message_info[0]['body'])){echo $message_info[0]['body'];}?></textarea>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-lg-3 col-sm-4"> 
                                
                                <div class="form-group ">
                                    <!--<label for="title" class="col-sm-2 control-label">Date to Show</label>-->
                                   
                                        <div id="mdp-demo"></div>
                                        <input type="hidden" name="dateToShow" value="<?php if($schedule_date){echo implode(',',json_decode($schedule_date));}?>">
                                  
                                </div>
                                

                            </div>
                            <div class="col-lg-5 col-sm-4"> 
                                <div>
                                    <div class="checkbox">
                                        <label>Email For All Student(Per Level)  <input style="margin-left:5px;" type="checkbox" class="student_level" name="email_for_student" value="1" 
                                                <?php if(isset($message_info[0]['email_for_student']) && $message_info[0]['email_for_student']){echo 'checked';}?>>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group " id="level_div" style="display: none;margin-left: 20px;">
                                    <label for="title">Grade/Year/Level</label>
                                    <select class="form-control select2" name="student_grade">
                                        <option value="">Select Grade/Year/Level</option>
                                        <?php $grades = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; ?>
                                        <?php foreach ($grades as $grade) { ?>
                                            <option value="<?php echo $grade; ?>" <?php if(isset($message_info[0]['student_grade']) && $message_info[0]['student_grade'] == $grade){echo 'selected';}?>>
                                                <?php echo $grade; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    
                                </div>
                                
                                <div class="">
                                    <div class="checkbox">
                                        <label>Email For Entire School  <input style="margin-left:5px;" type="checkbox" class="school_level" name="email_for_school" value="1" 
                                                <?php if(isset($message_info[0]['email_for_school']) && $message_info[0]['email_for_school']){echo 'checked';}?>>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="form-group col-sm-12" id="school_div" style="display: none;margin-left: 20px;">
                                    <label for="title">Schools</label>
                                    <select class="form-control select2" name="school_id">
                                        <option value="">Select School</option>
                                        <?php foreach ($all_school as $school) { ?>
                                            <option value="<?php echo $school['id'] ?>" <?php if(isset($message_info[0]['school_id']) && $message_info[0]['school_id'] == $school['id']){echo 'selected';}?>>
                                                <?php echo $school['name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    
                                </div>

                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
</div>


<script>
    //$('.table').DataTable({});
    $( document ).ready(function() {
        show_student_level();
        show_school_level();
		
		$('#mdp-demo').multiDatesPicker({
            dateFormat : "yy-mm-dd",
			<?php if($schedule_date && !empty($schedule_date)){?>
            addDates: <?php echo $schedule_date;?>,
            <?php }?>
			onSelect: function() {
                $("input[name=dateToShow]").val($(this).multiDatesPicker("getDates"));    
            }
        });
        
        //$('#mdp-demo').multiDatesPicker({
//            beforeShow: function() { $(this).datepicker().addClass("datepickerBorder"); },
//            onClose: function() { $(this).datepicker().removeClass("datepickerBorder"); },
            //dateFormat : "yy-mm-dd",
            <?php if($schedule_date && !empty($schedule_date)){?>
            //addDates: <?php echo $schedule_date;?>,
            <?php }?>
//            showOn: "button",
//            inline:true,
            //onSelect: function() {
                //$("input[name=dateToShow]").val($(this).multiDatesPicker("getDates"));    
            //}
        //});
        
//        $(".datepicker").datepicker('show');
//        $(document).off('mousedown', $.datepicker._checkExternalClick);


    });
    
    $( ".student_level" ).click(function() {
        show_student_level();
    });
    
    function show_student_level(){
        if ($('input.student_level').is(':checked')) {
            $("#level_div").show();
        } else {
            $("#level_div").hide();
        }
    }
    
    
    $( ".school_level" ).click(function() {
        show_school_level();
    });
    
    function show_school_level(){
        if ($('input.school_level').is(':checked')) {
            $("#school_div").show();
        } else {
            $("#school_div").hide();
        }
    }
</script>
<script>
    $('#proceed_email').click(function (event) {
        event.preventDefault();
        var form = $("#message_send");
        $.ajax({
            method: 'POST',
            url: 'proceed_email',
            data: form.serialize(),
            success: function(response){
                console.log(response);
            },
            error: function(){
                alert('Could not add data');
            }
        });
    });
</script>
