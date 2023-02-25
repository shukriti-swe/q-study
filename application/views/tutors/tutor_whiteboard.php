<style type="text/css">
    .active{
        display: none;
    }
</style>

<div class="row">
    <div class="">

        <ul class="personal_ul">
            <div class="whiteboard_container">

                <?php if (isset($ckExist[0]['id'])) { ?>
                   <div class="RemoveShow" style="margin-left: -36%;"> <b>Your class is on going :</b> </div> <br>
                   <div class="Enter_room">
                    <div class="Links_room">
                        <a style="margin-left: -306px;" href="<?= base_url('/yourClassRoomTutor/'.$ckExist[0]['id']) ?>"> Enter the classroom :  </a> 

                        <a href="<?= base_url('/yourClassRoomTutor/'.$ckExist[0]['id']) ?>"><?= base_url('/yourClassRoomTutor/'.$ckExist[0]['id']) ?></a>
                    </div>
                       
                       <br>
                        <button style="margin-left: -37px;" type="button" class="btn Remove_class RemoveShow" onclick="Remove_class('<?= $ckExist[0]['id']; ?>')" >Remove Class </button>
                        <span class="remain_time"> <?= $min_hr_sc; ?> Min Remains to class duration </span>
                   </div>

                <?php } ?>

                <div class="whiteboard_button <?php if (isset( $ckExist[0]['id'] )) echo "active"; ?> ">
                    <!-- <button type="button" class="btn" >Create Class </button> -->
                </div>

                <div class="whiteboard_inforrmation <?php if (isset($ckExist[0]['id']))  echo "active"; ?>">
                    <div style="margin-left: 11px;"> <b>Teacher Information</b> : <?= $user_info[0]['user_email']; ?> </div>

                    <div class="whiteboard_form">
                        <form id="question_form" class="form-inline" method="post">
                            <div class="row">
                                <div class="col-md-7" style="    text-align: right;margin: 0 11px;">
                                    <b>Assign for all student</b> : <label class="form-check-label"><input type="checkbox" class="form-check-input" name="all_student" value="all" id="ckAllStudent" > All</label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6" style="text-align: right;"><b>Assign Individual</b> : </div>
                                <div class="col-md-6" style="text-align: left;">
                                    <select class="select2" multiple="multiple" name="students" style="width:30%">
                                        <?php foreach ($all_student as $key => $value) { ?>
                                            <option value="<?= $value['id']; ?>"><?= $value['user_email']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                               <div class="createClass">
                                    <button type="button" class="btn submit" id="createClass" style="margin-right: -130px;">Create Class</button>
                                </div>
                        </form>
                    </div>

                    <div id="success_msg"></div> <br>
                    <div id="class_uld" ></div>
                    
                </div>
            </div>
        </ul>

    </div>
</div>

<script type="text/javascript">
    document.getElementById('ckAllStudent').onclick = function() {
    if ( this.checked ) {
        $(".select2").hide();
    } else {
        $(".select2").show();
    }
};
</script>
<script type="text/javascript">
    function Remove_class(argument) {
        var url  = "<?php echo base_url(); ?>removeClass"
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'html',
            data:{ 
                "data"  : argument
           },
            success: function (data) {
               if (data == 1) {
                $(".active").show();
                $(".RemoveShow").hide();
                $(".Links_room").hide();
                $(".remain_time").hide();
               }
            }
        });
    }
</script>

<script type="text/javascript">
    $(".submit").click(function (e) {
      e.preventDefault();
    var data = $('#question_form').serialize();
    var url  = "<?php echo base_url(); ?>insertClass"
    $.ajax({
        type: "POST",
        url: url,
        dataType: 'html',
        data:{ 
            "data"  : data
       },
        success: function (data) {
           if (data == 0) {
            alert("Room is not available now")
           }else if(data == 1){
            alert("You can not create two class together.")
           }
           else{
            $("#success_msg").html("<div style='padding: 10px 0;color: white;background: slategrey;margin: 10px;'>Successfully created classrooms </div>")
            $("#class_uld").html("<div style='display:flex;margin: 0 90px;'> <span style='color: #525253;margin: 0 5px;font-weight: 600;' >Classroom Url:</span>  <a href="+data+" > "+data+"</a></div>")

           }
        }
    });
    return false;
    });
</script>

