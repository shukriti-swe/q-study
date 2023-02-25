<style>
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 35px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="ss_student_progress">

            <div class="heading_title">
                <h3>Progress by Student</h3>
            </div>
            <div class="search_filter">
                <form class="form-inline" method="POST" action="student_progress" id="st_progress_form">
				
					<?php if(isset($all_country)) {?>
                    <div class="form-group">
                        <label for="Country">Country</label>
                        <select name="country" class="form-control select2">
                            <option>Select Country</option>
                            <?php foreach ($all_country as $country) {?>
                            <option value="<?php echo $country['id'];?>">
                                <?php echo $country['countryName'];?>
                            </option>
                            <?php }?>
                        </select>
                    </div>
                    <?php }?>
				
                    <div class="form-group">
                        <label for="exampleInputName2">Grade/Year/Lavel</label>
                        <select class="form-control" name="class" id="studentClass" required>
                            <?php if (isset($isStudent)) : ?>
                                <option value="<?php echo $studentClass[0]['student_grade']; ?>"><?php echo $studentClass[0]['student_grade']; ?></option>
                            <?php else : ?>
                                    <option value="">Select A Class</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">Upper Level</option>
                            <?php endif; ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Module Type</label>
                            <select class="form-control" name="moduleTypeId" required>
                                <?php echo $moduleTypes; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Student’s name</label>
                            <select class="form-control" name="studentId" id="students">
                                <?php if (isset($isStudent)) : ?>
                                    <option value="<?php echo $isStudent; ?>"><?php echo $studentName; ?></option>
                                <?php else : ?>
                                        <?php echo $students; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    <?php if (isset($module_user_type)){?>
                    <input type="hidden" name="module_user_type" value="<?php echo $module_user_type?>">
                           <?php }?>

                    <?php if (isset($course_id)){?>
                    <input type="hidden" name="course_id" value="<?php echo $course_id?>">
                           <?php }?>

                    <button type="submit" class="btn btn_green">Detail Exam Score</button>
                    
                    <?php if (isset($course_id) && $_SESSION['userType'] == 3 ) {  ?>
                        <a href="assign-module/<?= $course_id; ?>" class="btn" style="background: #ffc90e;margin-top: 20px;">Assign</a>
                    <?php  } ?>
                    
                        </form>
                    </div>
                    <div class="ss_s_plist">
                        <div class="table-responsive tableDiv">
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- add marks modal -->
        <div class="modal fade bs-example-modal-sm" id="addMarksModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Add Marks</h4>
            </div>
            <form class="form-inline" id="addMarksForm">
                <div class="modal-body">
                        
                    <label style="margin-bottom:5px;" for="recipient-name" class="control-label">Marks to add(eg:5.50):</label>
                    <div class="form-group">
                        <input type="number" class="form-control" id="" min="0" max="9" name="intMark">
                        <strong>.</strong>
                        <input type="number" class="form-control" id="" min="0" max="9" name="float_1">
                        <input type="number" class="form-control" id="" min="0" max="9" name="float_2">
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Marks</button>
                </div>
            </form>
        </div>
    </div>
</div>
<input type="hidden"  id="selectedProgId" value="">


<script>
    $('#studentClass').on('change', function(){
        var stClass = $(this).val();
		var country = '';
        <?php if($this->loggedUserType == 7){?>
            country = $("[name=country]").val();
        <?php }?>
        console.log(stClass);
        $.ajax({
            url:'Student_Progress/studentByClass',
            method: 'POST',
            data : {
                stClass: stClass,
                country: country
            },
            success: function(data){
                $('#students').html(data);
            }

        }); 
    });

    
<?php if($_SESSION['userType'] != 3){?>
    $(document).on('submit','#st_progress_form', function(e){
        e.preventDefault();
        $.ajax({
            url:'Student_Progress/StProgTableDataStd',
            method:'POST',
            data: $( this ).serialize(),
            success: function(data){
				console.log(data);
                if(data.length){
                    if (typeof mytable !='undefined'){
                        mytable.empty();
                    }
                    $('.tableDiv').html(data);

                    mytable = $('.table').dataTable({
                        "aaSorting": []
                    });
                }
            },
			 error: function(e){
                console.log(e);
            }
        });
    });

<?php }else{?>

    $(document).on('submit','#st_progress_form', function(e){
        e.preventDefault();
        $.ajax({
            url:'Student_Progress/TutorStProgTableDataStd',
            method:'POST',
            data: $( this ).serialize(),
            success: function(data){
                console.log(data);
                if(data.length){
                    if (typeof mytable !='undefined'){
                        mytable.empty();
                    }
                    $('.tableDiv').html(data);

                    mytable = $('.table').dataTable({
                        "aaSorting": []
                    });
                }
            },
             error: function(e){
                console.log(e);
            }
        });
    });
<?php }?>
 function searchAfterAddMark() {
        var form = $("#st_progress_form");
        $.ajax({
            url:'Student_Progress/StProgTableDataStd',
            method:'POST',
            data: form.serialize(),
            success: function(data){
                if(data.length){

                    if (typeof mytable !='undefined'){
                        mytable.empty();
                    }
                    $('.tableDiv').html(data);

                    mytable = $('.table').dataTable({
                        "aaSorting": []
                    });
                }
            },
            error: function(e){
                console.log(e);
            }
        });
    }
    function delete_progress(progress_id) {
        var form = $("#st_progress_form");
        $.ajax({
            url: 'Student_Progress/delete_progress',
            method: 'POST',
            data: form.serialize() + "&progress_id=" + progress_id ,
            success: function (data) {
                if (data.length) {
                    $('#stProgTableBody').html(data);
                }
            }
        });
    }

    //add marks icon click
    $(document).on('click','.addMarks', function(){
        $('#addMarksModal').modal('show');
        var progId = $(this).closest('tr').attr('progId');
        $('#selectedProgId').val(progId);
    })

    /*add marks modal button click*/
    $(document).on('submit','#addMarksForm', function(e) {
        e.preventDefault();
        var formVal = $(this).serializeArray();
        var intMark = formVal[0].value;
        var float_1 = formVal[1].value;
        var float_2 = formVal[2].value;
        var toAdd = formVal[0].value + '.' + formVal[1].value + formVal[2].value;
        
        var progressId = $('#selectedProgId').val();
        $.ajax({
            url:'Student_Progress/addMarks',
            method:'POST',
            data:{'marksToAdd':toAdd, 'progressId':progressId},
            success: function(data){
                if(data=='1'){
                    $('#addMarksModal').modal('toggle');
                    swal("Marks Updated Successfully");
					searchAfterAddMark();
                }
            }
        })
    })
</script>
