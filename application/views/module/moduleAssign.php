 
<div class="container top100">
    <div class="row">

        <div class="col-md-10 text-center">
            <?php if ($this->session->userdata('success_msg')) : ?>
                <div class="alert alert-success alert-dismissible show" role="alert">
                    <strong><?php echo $this->session->userdata('success_msg'); ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php elseif ($this->session->userdata('error_msg')) : ?>
                <div class="alert alert-danger alert-dismissible show" role="alert">
                    <strong><?php echo $this->session->userdata('error_msg'); ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div> <!-- end row -->

    <form action="" method="post" id="reorderModuleForm">
        <div class="row text-center">

        	<div class="row">
        		<div class="col-md-6">

        			<div class="row">
        				<div class="col-md-6" style="text-align: right;margin-top: 14px;"> <button class="btn btn-primary"  id="save_btn">Save</button> </div>
        				<div class="col-md-6">
		        			<div class="form-group">
						    <label for="exampleInputEmail2">Student’s name</label>
						        <select class="form-control" name="studentId" id="students">
						        <?php if (empty($students)) : ?>
						            <option value=""><?php echo "No students"; ?></option>
						        <?php else : ?>
						                <?php echo $students; ?>
						        <?php endif; ?>
						        </select>
						    </div>
		        		</div>

        			</div>
        		</div>
        	</div>
        </div> 

        <br>
        <br>

        <div class="row"  >
            <div class="progress" id="progress" style="display: none;">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="">
                  </div>
            </div>
        </div>
        <div class="sign_up_menu non_subjects">
            <div class="table-responsive">
                <table class="table table-bordered" id="module_setting">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Module Name</th>
                            <th>Module Type</th>
                            <th>Subject</th>
                            <th>Chapter</th>
                            <th>Assign</th>
                        </tr>
                    </thead>
                    <tbody id="moduleList">

                    </tbody>
                </table>
            </div>
        </div>

    </form>
</div>


<script>

	var courseId = '<?= $course_id; ?>';
    var students = $("#students").val();
    $.ajax({
            url: 'Tutor/moduleSearchFromReorder',
            method: 'POST',
            data: {
                courseId , students
            },
        })
        .done(function(data) {
            $('#moduleList').html(data)
        })

        $(document).ready(function() {
            $('#module_setting').DataTable();
        } );
  </script>

  <script type="text/javascript">
    $(document).on('click', '#save_btn', function(e){

        console.log( $("#reorderModuleForm").serialize()  );
        e.preventDefault();
        $("#progress").show();
        $.ajax({
            type:"POST",
            url: 'tutor/assignModuleStudent',
            dataType:'json',
            data:$("#reorderModuleForm").serialize(),
            beforeSend:function()
             {
              $('#save_btn').attr('disabled', 'disabled');
              $('#progress').css('display', 'block');
             },
            success:function(data){
                if (data == 1) {
                    $("#progress").hide();
                    alert("Successfully assigned")
                }
            }
        });
    });

    $(document).on('change', '#students', function(e){

        console.log( $("#reorderModuleForm").serialize()  );
        e.preventDefault();
        
        var courseId = '<?= $course_id; ?>';
        var students = $("#students").val();
        $.ajax({
                url: 'Tutor/moduleSearchFromReorder',
                method: 'POST',
                data: {
                    courseId , students
                },
            })
            .done(function(data) {
                $('#moduleList').html(data)
            })

            $(document).ready(function() {
                $('#module_setting').DataTable();
            } );
        
    
    });


  </script>
