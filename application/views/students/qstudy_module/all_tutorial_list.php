<div class="container">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-11">
            <div class="ss_qstudy_list">
                <div class="ss_qstudy_list_top">
                    <?php if($moduleType==1): ?>
                        <form class="form-inline" action="">
                            <div class="form-group">
                                <label for="email">Country</label>
                                <input type="text" class="form-control" readonly="" value="<?php echo $user_info[0]['countryName'];?>">
                            </div>
                            <div class="form-group">
                                <label for="sbjct">Subject</label>
                                <select class="form-control" id="subjects">
                                    <option value="">Select Subject</option>
                                    <?php foreach ($studentSubjects as $subject){?>
                                    <option value="<?php echo $subject['subject_id']?>"><?php echo $subject['subject_name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="chpter">Chapter</label>
                                <select class="form-control" name="chapter" id="subject_chapter">
                                    <option value="">Select Chapter</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-default" id="moduleSearchBtn">Search</button>
                        </form>
                    <?php else: ?>
                       <script>
                        $(document).ready(function(){
                            getTutorials();    
                        })
                    </script>
                    
                <?php endif; ?> 
            </div>
            <div class="ss_qstudy_list_mid">
                <div class="row">
                    <div class="col-sm-4">
                        <h3 style="text-align: left;"><?php echo ($tutorType==3)?'Tutor':'Q-study'; ?></h3>
                    </div>
                    <div class="col-sm-4">
                        <h3>Index</h3>
                    </div>
                    <div class="col-sm-4 ss_qstudy_list_mid_right">

                            <!-- <div class="profise_techer"><img src="<?php if(isset($all_module[0]['image'])){echo $all_module[0]['image'];}else{?>assets/images/default_user.jpg<?php }?>">
                        </div> -->

                        <div class="profise_techer">
                            <?php if(isset($tutorImage)&&file_exists('assets/uploads/'.$tutorImage)): ?>
                                <img src="<?php echo 'assets/uploads/'.$tutorImage; ?>">
                            <?php else: ?>
                                <img src="assets/images/default_user.jpg">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if($moduleType==1): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <span id="subjectName" subjectId="<?php echo ''; ?>" style="margin:5px 5px 5px 5px;cursor: pointer;">All</span>
                            <?php foreach($studentSubjects as $subject ): ?>
                                <span id="subjectName" subjectId="<?php echo $subject['subject_id'] ?>" style="margin:5px 5px 5px 5px; cursor: pointer;"><?php echo $subject['subject_name'] ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="tab-content">
                <div class="ss_qstudy_list_bottom tab-pane active" id="all_list" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Module Name</th>
                                    <th>Tutor Name</th>
                                    <th>Tracker Name</th>
                                    <th>Individual Name</th>
                                    <th>Subject</th>
                                    <th>Chapter</th>
                                </tr>
                            </thead>
                            <tbody id="moduleTable">

                            </tbody>
                        </table>

                    </div>

                </div>
                
            </div>
        </div>
    </div>
</div>
</div>


<script>
    /*set chapters according to subject*/
    $(document).on('change', '#subjects', function(){
        var subjectId = $(this).val();
        $.ajax({
            url:'Student/renderedChapters/'+subjectId,
            method: 'POST',
            success: function(data){
                $('#subject_chapter').html(data);
            }
        })
    });

    $(document).on('click', '#moduleSearchBtn', function(event){
        event.preventDefault();
        var chapterId = $("#subject_chapter :selected").val();
        var subjectId = $("#subjects :selected").val();
        var tutorType  = <?php echo $tutorType; ?>;
        var moduleType = <?php echo $moduleType; ?>;
        $.ajax({
            url: 'Student/studentsModuleByQStudy',
            method: 'POST',
            data: {
                chapterId:chapterId, 
                subjectId:subjectId, 
                tutorType:tutorType, 
                moduleType:moduleType
            },
            success: function(data){
                $('#moduleTable').html(data);
            }
        })
    });
    
    function get_permission(module_id){
        var first_module_id = $("#first_module_id").val();
        if(module_id == first_module_id){
            //window.location.href = 'get_tutor_tutorial_module/'+module_id+'/1';
            $.ajax({
                type: 'POST',
                url: 'student/get_permission',
                data: {
                    module_id : module_id
                },
                dataType: 'html',
                success: function (results) {
                   //console.log(results);
                   if(results != ''){
                      window.location.href = results;
                  }
              }
          });
        } else {
            alert('Please Complete First Lesson');
        }
        
    }

    function getTutorials() {
        //var chapterId = $("#subject_chapter :selected").val();
        //var subjectId = $("#subjects :selected").val();
        var tutorType  = <?php echo $tutorType; ?>;
        var moduleType = <?php echo $moduleType; ?>;
        $.ajax({
            url: 'Student/studentsModuleByQStudy',
            method: 'POST',
            data: {
                //chapterId:chapterId, 
                //subjectId:subjectId, 
                tutorType:tutorType, 
                moduleType:moduleType
            },
            success: function(data){
                $('#moduleTable').html(data);
            }
        })
    }

    $(document).on('click', '#subjectName', function(){
        var subjectId = $(this).attr('subjectId');
        var tutorType  = <?php echo $tutorType; ?>;
        var moduleType = <?php echo $moduleType; ?>;
        $.ajax({
            url: 'Student/studentsModuleByQStudy',
            method: 'POST',
            data: {
                //chapterId:chapterId, 
                subjectId:subjectId, 
                tutorType:tutorType, 
                moduleType:moduleType
            },
            success: function(data){
                $('#moduleTable').html(data);
            }
        })
    })

</script>