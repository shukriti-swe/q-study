<div class="container-fluid">
    <div class="row">
        <div class="ss_student_progress">

            <div class="heading_title">
                <h3>Progress by Student</h3>
            </div>
            <div class="search_filter">
                <form class="form-inline" method="POST" action="student_progress" id="st_progress_form">
                    <div class="form-group">
                        <label for="exampleInputName2">Grade/Year/Lavel</label>
                        <select class="form-control" name="class" id="studentClass">
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
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">Module Type</label>
                        <select class="form-control" name="moduleTypeId">
                            <?php echo $moduleTypes; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">Student’s name</label>
                        <select class="form-control" name="studentId" id="students">
                            <?php //echo $students; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn_green">Detail Exam Score</button>
                </form>
            </div>
            <div class="ss_s_plist">
                <div class="table-responsive">
                    <table class="table table-bordered" id="st_progress_table">
                        <thead>
                            <tr>                       
                                <th>Module Name</th>
                                <th>Module Type</th>
                                <th>Answer Date</th>
                                <th>Answer Time</th>
                                <th>Time Taken</th>
                                <th>Original Mark</th>
                                <th>Student Mark</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody id="stProgTableBody">

                            <?php //echo $st_progress; ?>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>
</div>



<script>
    $('#studentClass').on('change', function () {
        var stClass = $(this).val();
        console.log(stClass);
        $.ajax({
            url: 'CommonAccess/studentByClass',
            method: 'POST',
            data: {stClass: stClass},
            //processData: false,
            success: function (data) {

                $('#students').html(data);

            }

        });
    });


    $('#st_progress_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'CommonAccess/StProgTableData',
            method: 'POST',
            data: $(this).serialize(),
            success: function (data) {
                if (data.length) {
                    $('#stProgTableBody').html(data);
                }
            }
        });
    });

    $(document).ready(function () {
        $('#st_progress_table').DataTable({
            "searching": false,
            "pageLength": 10,
            "lengthChange": false
        });
    });
</script>

