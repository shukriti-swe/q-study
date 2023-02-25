<style>
    .question_choose{
        margin-top:10px;
        padding-right:10px;
        cursor:pointer;
        display:inline-block;
        padding:3px;
        
    }
    .idea_publish{
        accent-color: #ed1c24;
    }
    
</style>

<?php
 // echo "<pre>";print_r($tutor_questions);die();
?>
<input type="hidden" id="tutor_id" value="<?=$tutor_id?>">
<div class="" style="margin-left: 15px;">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-8" style="padding-right: 0px;padding-left: 0px;">
                    <a class="btn btn-primary" style="background-color:#c3c3c3;border:1px solid blue;border-radius:0px;">Question</a>
                    <a class="btn btn-primary selected_question" style="background-color:#00a2e8;border-radius:0px;"><?=$tutor_questions[0]['shot_question_title']?> </a>
                   
                    <div style="border:1px solid #c0b7b7;padding:10px;margin-top:20px;border-radius:10px 0px 0px 10px;" id="ques_box">

                      <?php
                        $i=1;
                        foreach($tutor_questions as $tutor_question){
                        if($tutor_question['image_no']==0){
                        ?>
                        <a data-question_id= "<?php if(!empty($tutor_question['parent_question_id'])){echo $tutor_question['parent_question_id'];}else{echo $tutor_question['question_id'];}?>"  data-question_title="<?=$tutor_question['shot_question_title']?>" class="question_choose" style="<?php if($i==1){ echo "background-color:#00a2e8;color:white;";}?>"><?=$tutor_question['shot_question_title']?></a>
                        <br>
                      <?php  $i++;}}?>
                    </div>
                </div>
                <div class="col-md-4" style="padding-right: 0px;padding-left: 0px;">
                    <a class="btn btn-primary" style="background-color:#c3c3c3;border:1px solid blue;border-radius:0px;">Image</a>
                    <div style="border:1px solid #c0b7b7;padding:10px;margin-top:20px;border-radius:0px 10px 10px 0px;" id="image_box">
                    <?php foreach($tutor_questions as $tutor_question){
                        if($tutor_question['image_no']!=0){
                        ?>
                       <a data-question_id= "<?=$tutor_question['question_id']?>" class="question_" style="margin-top:10px;padding-right:10px;cursor:pointer;"><?=$tutor_question['image_title']?></a>
                       
                    <?php  }}?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div style="text-align:center;">
               <a class="btn btn-primary examine_button" type="button" style="background-color:#c3c3c3;border-radius:0px;">Examine</a>
            </div>
            <div class="row" style="margin-top:20px;">
                <div class="col-md-2" id="student_ideas_all">
                    <a class="btn btn-primary" style="background-color:#ededed;border:1px solid blue;border-radius:0px;width:75px;color:black;font-weight:bold;font-size: 13px;padding: 6px 6px;">Student</a>
                    <div id="student_all_ideas">
                        <?php 
                            $i=1;
                            foreach($first_question_ideas as $first_question_idea){
                            if($first_question_idea['type']==2){
                        ?>

                        <a class="btn btn-primary student_idea" data-serial="<?=$first_question_idea['serial']?>" data-idea="<?=$first_question_idea['id']?>" style="<?php if($first_question_idea['approval']==1){echo "background-color:#7f7f7f;color:white;";}else{echo "background-color:#e0e0e0;color:#7f7f7f;";}?>border-radius:0px;width:75px;font-weight:bold;margin-top:10px;font-size: 13px;">Idea <?=$i?></a>
                        <?php
                            $i++;}}
                        ?>
                    </div>
                </div>

                <div class="col-md-4" id="st_idea_approval_serial">
                    <a class="btn btn-primary" style="background-color:#ededed;border:1px solid blue;border-radius:0px;width:100%;color:black;font-weight:bold;padding: 6px 6px;">Approval/Serial</a>
                    
                    <?php 
                        $i=1;
                        foreach($first_question_ideas as $first_question_idea){
                        if($first_question_idea['type']==2){
                    ?>
                        <div style="display:flex;margin-top:10px;gap:10px;">
                            <div style="display:flex;gap:5px;padding: 6px 6px;border:1px solid #c0b7b7;width:40%;height: 30px;">
                                <input type="checkbox" class="idea_publish" data-question="<?=$first_question_idea['question_id']?>" data-idea="<?=$first_question_idea['id']?>" <?php if($first_question_idea['idea_publish']==1){echo "checked";}?>>

                                <input type="checkbox" data-question="<?=$first_question_idea['question_id']?>" data-idea="<?=$first_question_idea['id']?>" class="approve_idea" <?php if($first_question_idea['approval']==1){echo "checked";}?>>
                            </div>
                            <div class="form-group" style="width:60%;">
                                <button type="button" class="btn btn-default bluebutton" style="<?php if($first_question_idea['approval']!=1){echo "background-color:#e0e0e0;";}?>">
                                    <label for="formInputButton1" style="width: 80px;<?php if($first_question_idea['approval']!=1){echo "color:black;";}?>">SL<input type="text" value="<?=$first_question_idea['serial']?>" data-question="<?=$first_question_idea['question_id']?>" data-idea="<?=$first_question_idea['id']?>" class="form-control student_idea_serial assign_serial serial_0"></label>
                                </button>
                            </div>
                        </div>
                    <?php
                        $i++;}}
                    ?>
                </div>
                <div class="col-md-2" id="tutor_ideas_all">
                    <a class="btn btn-primary" style="background-color:#00a2e8;border:1px solid blue;border-radius:0px;width:75px;color:black;font-weight:bold;font-size: 13px;padding: 6px 6px;">Tutor</a>

                    <div id="tutor_all_ideas">
                        <?php 
                            $i=1;
                            foreach($first_question_ideas as $first_question_idea){
                            if($first_question_idea['type']==1){
                        ?>
                        <a class="btn btn-primary tutor_idea" data-serial="<?=$first_question_idea['serial']?>" data-idea="<?=$first_question_idea['id']?>" href="Admin/idea_create_tutor_setting/<?php echo $first_question_idea['user_id'];?>/<?php echo $first_question_idea['question_id'];?>/<?php echo $first_question_idea['id'];?>" style="<?php 
                        if($first_question_idea['user_id']==$tutor_id){echo "background-color:#00a2e8;color:black;";}else{if($first_question_idea['approval']==1){echo "background-color:#7f7f7f;color:white;";}else{echo "background-color:#e0e0e0;color:#7f7f7f;";}}?>border-radius:0px;width:75px;font-weight:bold;margin-top:10px;font-size: 13px;">Idea <?=$i?></a>
                        <?php
                            $i++;}}
                        ?>
                    </div>
                </div>
                <div class="col-md-4" id="tutor_idea_approval_serial">
                    <a class="btn btn-primary" style="background-color:#ededed;border:1px solid blue;border-radius:0px;width:100%;color:black;font-weight:bold;padding: 6px 6px;">Approval/Serial</a>
                    
                    
                    <?php 
                        $i=1;
                        foreach($first_question_ideas as $first_question_idea){
                        if($first_question_idea['type']==1){
                    ?>
                        <div style="display:flex;margin-top:10px;gap:10px;">
                            <div style="display:flex;gap:5px;padding: 6px 6px;border:1px solid #c0b7b7;width:40%;height: 30px;">
                                <input type="checkbox" class="idea_publish" class="idea_publish" data-question="<?=$first_question_idea['question_id']?>" data-idea="<?=$first_question_idea['id']?>" <?php if($first_question_idea['idea_publish']==1){echo "checked";}?>>

                                <input type="checkbox" data-question="<?=$first_question_idea['question_id']?>" data-idea="<?=$first_question_idea['id']?>" class="approve_idea" <?php if($first_question_idea['approval']==1){echo "checked";}?>>
                            </div>
                            <div class="form-group" style="width:60%;">
                                <button type="button" class="btn btn-default bluebutton" style="<?php if($first_question_idea['approval']!=1){echo "background-color:#e0e0e0;";}?>">
                                    <label for="formInputButton1" style="width: 80px;<?php if($first_question_idea['approval']!=1){echo "color:black;";}?>">SL<input type="text"  value="<?=$first_question_idea['serial']?>" data-question="<?=$first_question_idea['question_id']?>" data-idea="<?=$first_question_idea['id']?>" class="form-control tutor_idea_serial assign_serial serial_0"></label>
                                </button>
                            </div>
                        </div>
                    <?php
                        $i++;}}
                    ?>
                </div>
            </div>
            
        </div>
        <div class="col-md-3" id="idea_tutor_point">
            <a class="btn btn-primary" style="background-color:#ededed;border:1px solid blue;border-radius:0px;margin-top: 55px;width:100%;color:black;font-weight:bold;">Tutor Point</a>
            <?php 
                $i=1;
                foreach($first_question_ideas as $first_question_idea){
                if($first_question_idea['type']==1){
            ?>
                <div style="display:flex;gap:10px;margin-top:10px;border:1px solid #c0b7b7;padding: 4px 6px;">
                    <div>
                        <label style="font-weight:bold;">Average</label>
                        <input type="radio" name="tutor_point<?=$i?>" data-index="<?=$i?>" value="1" class="tutor_point" data-question="<?=$first_question_idea['question_id']?>" data-id="<?=$first_question_idea['id']?>" <?php if($first_question_idea['tutor_point']==1){echo "checked";}?>>
                    </div>
                    <div>
                        <label style="font-weight:bold;">Good</label>
                        <input type="radio" name="tutor_point<?=$i?>" data-index="<?=$i?>" value="2" class="tutor_point" data-question="<?=$first_question_idea['question_id']?>" data-id="<?=$first_question_idea['id']?>" <?php if($first_question_idea['tutor_point']==2){echo "checked";}?>>
                    </div>
                    <div>
                        <label style="font-weight:bold;">Excelent</label>
                        <input type="radio" name="tutor_point<?=$i?>" data-index="<?=$i?>" value="3" class="tutor_point" data-question="<?=$first_question_idea['question_id']?>" data-id="<?=$first_question_idea['id']?>" <?php if($first_question_idea['tutor_point']==3){echo "checked";}?>>
                    </div>
                    
                </div>
            <?php
                $i++;}}
            ?>
            
        </div>
    </div>
</div>

<style type="text/css">
  .w-100{
    max-width: 100px;
  }
  .top_headed{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
  .top_headed > div { 
    box-sizing: border-box;
    margin: 10px 10px 0 0; 
  }
  .top_headed label{
    margin-bottom: 5px;
  }
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
    vertical-align: middle !important;
    border-color: #b7dde9 !important;
  }
  body .rs_n_table thead th{
    border: none !important;
    text-align: center;
    font-size: 14px;
      padding-left: 0;
      padding-right: 0;
  }
  .bluebutton,
  .bluebutton:hover {
    background: #00a2e8;
    padding: 2px 2px 2px 4px;
  }

  .bluebutton label {
    display: flex;
    align-items: center;
    color: #fff;
    flex-direction: row;
  }

  .bluebutton .form-control {
    margin-left: 5px;
  }
  .form-control {
    height: 26px;
  }
  .form-group {
    margin-bottom: 0px;
  }
</style>
<script>
    var ques_box_size = $('#ques_box').outerHeight();
    $('#image_box').css('height',ques_box_size);

    $(function(){
        $('.question_choose').click(function(){
            var tutor_id = $('#tutor_id').val();
            var question_id = $(this).attr('data-question_id');
            var question_title = $(this).attr('data-question_title');
            $('.selected_question').text(question_title);
            $('.question_choose').removeAttr('style');
            $(this).css({
                "color": "#fff;",
                "background-color": "#00a2e8;",
            });

            $.ajax({
                url: "Admin/get_ideas_by_question",
                type: "POST",
                data: {
                    question_id: question_id,
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    console.log(data);

                    var student_ideas = '<a class="btn btn-primary" style="background-color:#ededed;border:1px solid blue;border-radius:0px;width:75px;color:black;font-weight:bold;font-size: 13px;padding: 6px 6px;">Student</a><div id="student_all_ideas">';

                    var st_idea_app_serial = '<a class="btn btn-primary" style="background-color:#ededed;border:1px solid blue;border-radius:0px;width:100%;color:black;font-weight:bold;padding: 6px 6px;">Approval/Serial</a>';
                    
                    var k = 0;
                    for(var i=0;i<data.length;i++){
                        if(data[i].type==2){
                            var k=k+1;
                            if(data[i].approval==1){
                                var add_style = 'background-color:#7f7f7f;color:white;';
                            }else{
                                var add_style = 'background-color:#e0e0e0;color:#7f7f7f;';
                            }

                            student_ideas += '<a class="btn btn-primary" style="'+add_style+'border-radius:0px;width:75px;font-weight:bold;margin-top:10px;font-size: 13px;">Idea '+k+'</a>';

                            if(data[i].approval==1){
                                var approve = 'checked';
                            }else{
                                var approve = '';
                            }
                            if(data[i].idea_publish==1){
                                var publish = 'checked';
                            }else{
                                var publish = '';
                            }
                            var style_background = '';
                            var style_color = '';
                            if(data[i].approval!=1){
                                style_background = 'style="background-color:#e0e0e0;"';
                                style_color = 'color:black;';
                            }
                            st_idea_app_serial +='<div style="display:flex;margin-top:10px;gap:10px;"><div style="display:flex;gap:5px;padding: 6px 6px;border:1px solid #c0b7b7;width:40%;height: 30px;"><input type="checkbox" class="idea_publish" data-question="'+data[i].question_id+'" data-idea="'+data[i].id+'" '+publish+'><input type="checkbox" data-question="'+data[i].question_id+'" data-idea="'+data[i].id+'" class="approve_idea"'+approve+'></div><div class="form-group" style="width:60%;"><button type="button" class="btn btn-default bluebutton" '+style_background+'><label for="formInputButton1" style="width: 80px;'+style_color+'">SL<input type="text" value="'+data[i].serial+'" data-question="'+data[i].question_id+'" data-idea="'+data[i].id+'" class="form-control assign_serial serial_0"></label></button></div></div>';
                        }
                    }

                    student_ideas += '</div>';
                    
                    var tutor_ideas = '<a class="btn btn-primary" style="background-color:#00a2e8;border:1px solid blue;border-radius:0px;width:75px;color:black;font-weight:bold;font-size: 13px;padding: 6px 6px;">Tutor</a><div id="tutor_all_ideas">';

                    var tutor_idea_app_serial = '<a class="btn btn-primary" style="background-color:#ededed;border:1px solid blue;border-radius:0px;width:100%;color:black;font-weight:bold;padding: 6px 6px;">Approval/Serial</a>';

                    var idea_point = '<a class="btn btn-primary" style="background-color:#ededed;border:1px solid blue;border-radius:0px;margin-top: 55px;width:100%;color:black;font-weight:bold;">Tutor Point</a>';

                    var j = 0;
                    for(var i=0;i<data.length;i++){
                        if(data[i].type==1){
                            var j=j+1;
                            if(data[i].user_id==tutor_id){
                                var add_style = 'background-color:#00a2e8;color:black;';
                            }else{
                                if(data[i].approval==1){
                                var add_style = 'background-color:#7f7f7f;color:white;';
                                }else{
                                    var add_style = 'background-color:#e0e0e0;color:#7f7f7f;';
                                }
                            }
                            
                            tutor_ideas += '<a class="btn btn-primary" href="Admin/idea_create_tutor_setting/'+data[i].user_id+'/'+data[i].question_id+'/'+data[i].id+'" style="'+add_style+'border-radius:0px;width:75px;font-weight:bold;margin-top:10px;font-size: 13px;">Idea '+j+'</a>';

                            if(data[i].approval==1){
                                var approve = 'checked';
                            }else{
                                var approve = '';
                            }
                            if(data[i].idea_publish==1){
                                var publish = 'checked';
                            }else{
                                var publish = '';
                            }

                            var style_background = '';
                            var style_color = '';
                            if(data[i].approval!=1){
                                style_background = 'style="background-color:#e0e0e0;"';
                                style_color = 'color:black;';
                            }
                            tutor_idea_app_serial +='<div style="display:flex;margin-top:10px;gap:10px;"><div style="display:flex;gap:5px;padding: 6px 6px;border:1px solid #c0b7b7;width:40%;height: 30px;"><input type="checkbox" class="idea_publish" data-question="'+data[i].question_id+'" data-idea="'+data[i].id+'" '+publish+'><input type="checkbox" data-question="'+data[i].question_id+'" data-idea="'+data[i].id+'" class="approve_idea" '+approve+'></div><div class="form-group" style="width:60%;"><button type="button" class="btn btn-default bluebutton" '+style_background+'><label for="formInputButton1" style="width: 80px;'+style_color+'">SL<input type="text"  value="'+data[i].serial+'" data-question="'+data[i].question_id+'" data-idea="'+data[i].id+'" class="form-control assign_serial serial_0"></label></button></div></div>';

                            var average = '';
                            var good = '';
                            var excelent = '';
                            if(data[i].tutor_point==1){
                                var average = 'checked';
                            }else if(data[i].tutor_point==2){
                                var good = 'checked';
                            }else if(data[i].tutor_point==3){
                                var excelent = 'checked';
                            }
                            idea_point += '<div style="display:flex;gap:10px;margin-top:10px;border:1px solid #c0b7b7;padding: 4px 6px;"><div><label style="font-weight:bold;">Average</label><input type="radio" name="tutor_point'+j+'" data-index="'+j+'" value="1" class="tutor_point" style="margin-left:5px;" data-question="'+data[i].question_id+'" data-id="'+data[i].id+'" '+average+'></div><div><label style="font-weight:bold;">Good</label><input type="radio" name="tutor_point'+j+'" data-index="'+j+'" value="2" class="tutor_point" style="margin-left:5px;" data-question="'+data[i].question_id+'" data-id="'+data[i].id+'" '+good+'></div><div><label style="font-weight:bold;">Excelent</label><input type="radio" name="tutor_point'+j+'" data-index="'+j+'" value="3" class="tutor_point" style="margin-left:5px;" data-question="'+data[i].question_id+'" data-id="'+data[i].id+'" '+excelent+'></div></div>';
                        }
                    }

                    tutor_ideas += '</div>';

                    
                    

                    $('#student_ideas_all').html(student_ideas);
                    $('#st_idea_approval_serial').html(st_idea_app_serial);
                    $('#tutor_ideas_all').html(tutor_ideas);
                    $('#tutor_idea_approval_serial').html(tutor_idea_app_serial);
                    $('#idea_tutor_point').html(idea_point);
                }
            });

            
        });

        // $('.approve_idea').click(function(){
        $(document).on('click','.approve_idea',function(){
            var question_id = $(this).attr('data-question');
            var idea_id = $(this).attr('data-idea');

            if($(this).is(':checked')){
                var approve = 1;
                $.ajax({
                    url: "Admin/approve_tutor_idea",
                    type: "POST",
                    data: {
                        question_id: question_id,
                        idea_id:idea_id,
                        approve:approve,
                    },
                    success: function(response) {
                        if(response==1){
                            alert('Idea Approved !');
                            location.reload();
                        }
                        
                    }
                });
            }else{
                var approve = 0;
                $.ajax({
                    url: "Admin/approve_tutor_idea",
                    type: "POST",
                    data: {
                        question_id: question_id,
                        idea_id:idea_id,
                        approve:approve,
                    },
                    success: function(response) {
                        if(response==1){
                            alert('Idea remove Approved !');
                            location.reload();
                        }
                        
                    }
                });
            }
        });

        $(document).on('change','.assign_serial',function(){
        // $('.assign_serial').change(function(){
            var question_id = $(this).attr('data-question');
            var idea_id = $(this).attr('data-idea');
            var serial = $(this).val();

            $.ajax({
                url: "Admin/update_tutor_idea_serial",
                type: "POST",
                data: {
                    question_id: question_id,
                    idea_id:idea_id,
                    serial:serial,
                },
                success: function(response) {
                    if(response==1){
                        alert('Idea Serial Updated !');
                        location.reload();
                    }
                    
                }
            });
        });

        // $('.idea_publish').click(function(){
        $(document).on('click','.idea_publish',function(){
            var question_id = $(this).attr('data-question');
            var idea_id = $(this).attr('data-idea');
            $('.examine_button').attr('style','background-color:red');

            if($(this).is(':checked')){
                var is_publish = 1;
                $.ajax({
                    url: "Admin/publish_tutor_idea",
                    type: "POST",
                    data: {
                        question_id: question_id,
                        idea_id:idea_id,
                        is_publish:is_publish,
                    },
                    success: function(response) {
                        if(response==1){
                            alert('Idea Published !');
                            location.reload();
                        }
                        
                    }
                });
            }else{
                var is_publish = 0;
                $.ajax({
                    url: "Admin/publish_tutor_idea",
                    type: "POST",
                    data: {
                        question_id: question_id,
                        idea_id:idea_id,
                        is_publish:is_publish,
                    },
                    success: function(response) {
                        if(response==1){
                            alert('Idea remove Published !');
                            location.reload();
                        }
                        
                    }
                });
            }
        });
        
        $(document).on('click','.tutor_point',function(){
            var question_id = $(this).attr('data-question');
            var idea_id = $(this).attr('data-id');
            var index_no = $(this).attr('data-index');
            var tutor_point = $('[name=tutor_point'+index_no+']:checked').val();
            // alert(question_id);
            // alert(idea_id);
            // alert(index_no);
            // alert(tutor_point);
            $.ajax({
                url: "Admin/idea_tutor_point_save",
                type: "POST",
                data: {
                    question_id: question_id,
                    idea_id:idea_id,
                    tutor_point:tutor_point,
                },
                success: function(response) {
                    if(response==1){
                        alert('Tutor Point Saved!');
                        location.reload();
                    }
                    
                }
            });
        });

        $("#student_all_ideas").sortable({
        delay: 150,
        stop: function() {

                var allSerial = new Array();
                var ideaIds = new Array();
                var oldIdeaIds = new Array();

                $("#student_all_ideas>.student_idea").each(function() {
                    var idea_serial = $(this).data('serial');
                    var idea_id = $(this).data('idea');

                    allSerial.push(idea_serial);
                    ideaIds.push(idea_id);
                });

                $(".student_idea_serial").each(function() {
                    var idea_id = $(this).data('idea');
                    oldIdeaIds.push(idea_id);
                });


                updateOrder(allSerial,ideaIds,oldIdeaIds);
            }
        });
        function updateOrder(allSerial,ideaIds,oldIdeaIds) {
            $.ajax({
                url: "Student/update_student_idea_serial",
                method: 'POST',
                data: {
                    allSerial: allSerial,
                    ideaIds: ideaIds,
                    oldIdeaIds:oldIdeaIds,
                },
                success: function(data) {
                    // location.reload();
                }
            });
        
        }
        $("#tutor_all_ideas").sortable({
        delay: 150,
        stop: function() {

                var allSerial = new Array();
                var ideaIds = new Array();
                var oldIdeaIds = new Array();

                $("#tutor_all_ideas>.tutor_idea").each(function() {
                    var idea_serial = $(this).data('serial');
                    var idea_id = $(this).data('idea');

                    allSerial.push(idea_serial);
                    ideaIds.push(idea_id);
                });

                $(".tutor_idea_serial").each(function() {
                    var idea_id = $(this).data('idea');
                    oldIdeaIds.push(idea_id);
                });


                updateOrder(allSerial,ideaIds,oldIdeaIds);
            }
        });

    });

</script>
 