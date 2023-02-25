<style>
    /* bhugi jugi */
    .presonal2 a {
        color:#fff !important;
    }
    .presonal2 {
        background-color: #EB1F28 !important;
    }
    .presonal {
        background-color: #006F8C !important;
    }
</style>

<div class="col-md-3"></div>
<div class="col-md-6">
    <div class="row">
        <form id="assign_subject_form">
        <div class="col-md-6">
            <?php if ($_SESSION['userType']==7) : ?>
                <div class="form-group">
                    <label for="exampleInputEmail2" style="color:#007ac9;font-weight: bold;margin: 5px 0px;">Course</label>
                    <div class="select">
                        <select class="form-control select-hidden"  name="course">
                            <option value="">Select....</option>
                            <?php foreach ($all_course as $course) {?>
                                <?php $sel = isset($_SESSION['modInfo']['course_id'])&&($course['id']==$_SESSION['modInfo']['course_id']) ? 'selected' : '';?>
                                <option value="<?php echo $course['id']?>" <?php echo $sel; ?>>
                                    <?php echo $course['courseName'];?>
                                </option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail2" style="color:#007ac9;font-weight: bold;margin: 5px 0px;">Subject</label>
                <div class="select">
                        <?php if (isset($all_subjects)){?>
                            <?php foreach ($all_subjects as $subject) {?>
                                <?php
                                if ($subject['subject_name'] != ''){?>
                                    <p><input class="form-check-input" name="subject_id[]" type="checkbox" value="<?php echo $subject['subject_id']?>">
                                        <label class="form-check-label">
                                            <?php echo $subject['subject_name'];?>
                                        </label></p>
                                <?php }?>
                            <?php }?>
                        <?php }?>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button style="margin-top: 24px;" class="btn btn-primary" type="button" id="saveBtn">Save</button>
        </div>
        </form>
    </div>
</div>
<div class="col-md-3"></div>
<div class="row"></div>
<div class="col-md-2"></div>
<div class="col-md-8">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Sl</th>
            <th scope="col">Course</th>
            <th scope="col">Subject</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($courseInfo)){?>
            <?php $i =1;?>
            <?php foreach($courseInfo as $course){?>
                <tr>
                    <th scope="row"><?php echo $i;?></th>
                    <td><?php echo $course['course_name']?></td>
                    <td><?php echo $course['subject_name']?></td>
                    <td><button class="editBtn" id="<?php echo $course['id']?>" style="border: none;background: none;padding: 0px;margin-right: 4px;"><i class="fa fa-pencil" style="color:#4c8e0c;"></i></button><button class="deleteBtn" id="<?php echo $course['id']?>" style="border: none;background: none;padding: 0px;margin-right: 4px;"><i class="fa fa-trash" style="color:red;"></i></button></td>
                </tr>
                <?php $i++;?>
            <?php }?>
        <?php }?>
        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Assign Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="EditForm">
                        <div class="row" id="edit_data">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update_btn">Update</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Assign Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="text-danger">Are you sure delete this item?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary confirm_btn">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2"></div>
<div class="row" style="margin-bottom:40px;"></div>

<script>
    $("#saveBtn").click(function () {
        var form = $("#assign_subject_form");
        $.ajax({
            type: 'POST',
            url: 'Module/save_assign_subject',
            data: form.serialize(),
            dataType: 'json',
            success: function (results) {
                alert(results.message);
                window.location.reload();
            }
        });
    });
</script>

<script>
    $(".editBtn").click(function () {
        var id = $(this).attr("id");
        var html = '';
        $.ajax({
            type: 'POST',
            url: 'Module/edit_assign_subject',
            data: {id:id},
            dataType: 'html',
            success: function (results) {
                html = results;
                $("#edit_data").html(html);
                $("#EditModal").modal("show");
                // window.location.reload();
            }
        });
    });

    $("#update_btn").click(function () {
        var form = $("#EditForm");
        $.ajax({
            type: 'POST',
            url: 'Module/update_assign_subject',
            data: form.serialize(),
            dataType: 'json',
            success: function (results) {
                alert(results.message);
                window.location.reload();
            }
        });
    });
    $(".deleteBtn").click(function () {
        var assign_id = '';
        assign_id = $(this).attr("id");
        $(".confirm_btn").attr("id",assign_id);
        $("#DeleteModal").modal('show');
    });
    $(".confirm_btn").click(function () {
        var id = $(this).attr("id");
        $.ajax({
            type: 'POST',
            url: 'Module/delete_assign_subject',
            data: {id:id},
            dataType: 'json',
            success: function (results) {
                alert(results);
                window.location.reload();
            }
        });
    });
</script>

