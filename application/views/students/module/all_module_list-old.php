<style>
  .slick-prev:before, .slick-next:before {
    color: #337ab7 !important;   
  }

   #mySlickCourse{
      margin-bottom: 15px;
  }
  .slick-prev:before, .slick-next:before{
      color: #ffffff !important;
      font-size: 14px
  }
  .slick-prev{
      left: -10px;
  }
  .slick-next{
      right: -0px;
  }
  .slick-list{
      margin-right: 15px !important;
  }
  #mySlickCourse .courseName{
      font-size: 13px;
  }

  .slick-slide {
    margin: 0 10px;
    height: auto !important;
  }
  /* the parent */
  .slick-list {
    margin: 0 -10px;
  }

  .badge{white-space: normal !important;}
  .ss_qstudy_list_mid_right
  {
      text-align: right;
  }
  @media only screen and (min-width: 768px) and (max-width: 1199px){
    
    
    .form-inline .form-control {
      width:110px;
      font-size: 13px;
    }
  }
    @media only screen and (max-width: 1200px) {
    .ss_qstudy_list .tab-content{
      padding-bottom:0px;
    }
  }
   @media only screen and (min-width: 768px) and (max-width: 991px){
    .mySlickSubject .slick-list{
      overflow:inherit;
    } 
  .mySlickSubject .slick-list .slick-slide{
        display: inline-block;
    width: auto !important;
  }   
  }

  .ss_qstudy_list_mid_right{
    text-align: right!important;
  }

  .ss_qstudy_list_mid_right .profise_techer {
      height: 60px;
      width: 60px;
      overflow: hidden;
      display: inline-block;
      padding: 1px;
      border: 1px solid #e5e8ec;
      background-color: #132c54;
  }
.ss_qstudy_list_mid_right .profise_techer_two {
      height: 60px;
      width: 60px;
      overflow: hidden;
      display: inline-block;
  }
</style>

<?php $qstudyEveryday = ($tutorInfo[0]['user_type']==7 && $moduleType==2) ? 1:0 ?>
<div class="container">
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-11">
      <div class="ss_qstudy_list">
        <div class="ss_qstudy_list_top">
            <?php if ($moduleType == 1) {?>
            <form class="form-inline" action="/action_page.php">
        <?php if ( $moduleType == 1 || $moduleType == 2){?>
                <h3 style="font-size: 21px;margin-right: 17%;display: inline-block;line-height: 40px;font-weight: 600;"><?php echo $tutorInfo[0]['name'];?></h3>
                <?php }?>
              <div class="form-group">
                <label for="email">Country </label>
                <input type="text" class="form-control" readonly="" value="<?php echo $user_info[0]['countryName'];?>">
              </div>
              <div class="form-group">
                <label for="sbjct">Subject</label>
                <select class="form-control" id="subjects">
                  <option value="">Select Subject</option>
                  <?php foreach ($studentSubjects as $subject) {?>
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
            <?php } else { ?>
           <script>
            $(document).ready(function(){
              getTutorials();    
            })
          </script>
            <?php } ?> 
      </div>
      <div class="ss_qstudy_list_mid">
        <div class="row">
            <?php if (($tutorInfo[0]['id'] == 2 && $moduleType == 1) || ($tutorInfo[0]['id'] == 2 && $moduleType == 2)){?>
                
         <div class="col-sm-2 col-lg-1 ss_qstudy_list_mid_right">

   
                <div class="profise_techer_two">
                    <?php if (!empty($tutorInfo[0]['image'])) : ?>
                        <img src="<?php echo 'assets/uploads/'.$tutorInfo[0]['image']; ?>">
                    <?php else : ?>
                        <img src="assets/images/default_user.jpg">
                    <?php endif; ?>
                </div>
            </div>
        <div class="col-sm-10 col-lg-11">
                    <div class="col-md-12 mySlick" id="mySlickCourse">
                        <?php  if (isset($registered_courses)) { ?>
                            <?php foreach ($registered_courses as $registered_course) : ?>
                                <span class=" courseName" id="courseName" courseId="<?php echo $registered_course['id'] ?>" style="cursor: pointer; text-transform: capitalize;font-size: 12px;width: auto;"><?php echo $registered_course['courseName'] ?></span>
                       <?php endforeach; ?>
                        <?php } ?>
                    </div>
                </div>
           

<!--            --><?php //if ($moduleType==1 || ($qstudyEveryday)) : ?>
                <div class="row">
                    <div class="col-md-1"></div>
<!--                    id="mySlickSubject"-->
                    <div class="col-md-10 mySlick" >
                        <?php if (isset($first_course_subjects)){?>
                          <?php if ($tutor_id == 2 && $module_type == 2) { ?>
                            
                            <?php }else{ ?>

                              <span class="badge badge-pill badge-primary" courseId="<?= $first_course_id?>" id="subjectNameQ" subjectId="all" style="width: 197px;;margin:5px 5px 5px 5px; cursor: pointer;">All</span>
                               <?php foreach ($first_course_subjects as $first_course_subject){?>
                                <span class="badge badge-pill badge-primary" courseId="<?= $first_course_id?>" id="subjectNameQ" subjectId="<?= $first_course_subject[0]['subject_id']?>" style="width:197px;margin:5px 5px 5px 5px; cursor: pointer; text-transform: capitalize;"><?= $first_course_subject[0]['subject_name']?></span>
                                <?php }?>

                            <?php }?>
                        <?php }?>
                    </div>
                </div>
<!--            --><?php //endif; ?>
        </div>
            <?php } else{?>
          <div class="col-sm-4">
              <?php if($moduleType!= 1){?>
            <h3 style="text-align: left;"><?php echo $tutorInfo[0]['name'];?></h3>
              <?php }?>
          </div>
          <div class="col-sm-4">
              <?php if ($tutorInfo[0]['id'] != 2){?>
            <?php if (!$qstudyEveryday) : ?>
              <h3>Index</h3>
            <?php endif; ?>
              <?php }?>
          </div>
          <div class="col-sm-4 ss_qstudy_list_mid_right">

              
            <?php if ($tutorInfo[0]['id'] == 2){?>
                <?php if (!$qstudyEveryday) : ?>
                  <div class="profise_techer">
                    <h3>Index</h3>
                  </div>
                <?php endif; ?>
            <?php }?>
              


            <div class="profise_techer">
                <?php if (!empty($tutorInfo[0]['image'])) : ?>
                    <img src="<?php echo 'assets/uploads/'.$tutorInfo[0]['image']; ?>">
                <?php else : ?>
                    <img src="assets/images/default_user.jpg">
                <?php endif; ?>
            </div>
          </div>

            <?php if ($moduleType==1 || ($qstudyEveryday)) : ?>
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 mySlick">
                  <?php  if ($qstudyEveryday == 0) { ?>
                  <span class="badge badge-pill badge-primary" id="subjectName" subjectId="<?php echo 'all'; ?>" style="margin:5px 5px 5px 5px; cursor: pointer;">All</span>
                  <?php } ?>
                  <?php  if ($qstudyEveryday == 0) { ?>
                  <?php foreach ($studentSubjects as $subject) : ?>
                    <span class="badge badge-pill badge-primary" id="subjectName" subjectId="<?php echo $subject['subject_id'] ?>" style="margin:5px 5px 5px 5px; cursor: pointer; text-transform: capitalize;"><?php echo $subject['subject_name'] ?></span>
                  <?php endforeach; ?>
                  <?php } ?>
                </div>
              </div>
            <?php endif; ?>
      </div>
          <?php }?>
        </div>
        <div class="tab-content">
          <h5 class="text-center" style="color:red;"><?php echo  isset($_SESSION['message_name']) ? $_SESSION['message_name']: '';?></h5>
          <div class="ss_qstudy_list_bottom tab-pane active" id="all_list" role="tabpanel">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Module Name</th>
                    <th>Tracker Name</th>
                    <th>Individual Name</th>
                    <?php if ($tutor_id == 2 && $module_type == 2) { ?>
                    
                    <?php  }else{ ?>
                      <th>Subject</th>
                      <th>Chapter</th>
                    <?php } ?>
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
    var tutorId  = <?php echo $tutorInfo[0]['id']; ?>;
    var moduleType = <?php echo $moduleType; ?>;
    $.ajax({
      url: 'Student/studentsModuleByQStudy',
      method: 'POST',
      data: {
        chapterId: chapterId, 
        subjectId: subjectId, 
        tutorId: tutorId, 
        moduleType: moduleType
      },
      success: function(data) {
        $('#moduleTable').html(data);
      }
    });
  });

</script>

<script>
  function getTutorials() {
    var tutorId  = <?php echo $tutorInfo[0]['id']; ?>;
    var moduleType = <?php echo $moduleType; ?>;

    $.ajax({
      url: 'Student/studentsModuleByQStudy',
      method: 'POST',
      data: {
        tutorId:tutorId, 
        moduleType:moduleType
      },
      success: function(data){
        $('#moduleTable').html(data);
      }
    });
  }

  function get_permission(module_id) {
    var moduleType = <?php echo $moduleType; ?>;
    var first_module_id = $("#first_module_id").val();

    var flag = 0;

    if(moduleType != 1) {
      if(module_id == first_module_id) {
        flag = 1;
      } else {
        alert('Please Complete First Lesson');
      }
    } else {
      flag = 1;
      //window.location.href = 'get_tutor_tutorial_module/'+module_id+'/1';
    }

    if(flag == 1) {
     $.ajax({
      type: 'POST',
      url: 'student/get_permission',
      data: {
        module_id : module_id
      },
      dataType: 'html',
      success: function (results) {

        if(results == 1) {
          alert('Please Complete Wrong Question Answer');
        } else {
          window.location.href = results;
        }
      }
    });
   }
 }

 $(document).on('click', '#subjectName', function(){
  var subjectId = $(this).attr('subjectId');
  var tutorId  = <?php echo $tutorInfo[0]['id']; ?>;
  var moduleType = <?php echo $moduleType; ?>;
  $.ajax({
    url: 'Student/studentsModuleByQStudy',
    method: 'POST',
    data: {
      //chapterId:chapterId,
      subjectId : subjectId, 
      tutorId : tutorId, 
      moduleType : moduleType
    },
    success: function(data){
      $('#moduleTable').html(data);
    }
  })
})
 

 $(document).ready(function(){
  $('.mySlick').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 1,
  centerMode: true,
  variableWidth: true,
  //slidesToShow: 3,
  //slidesToScroll:3,
});
});
</script>

<script>
    $(".courseName").click(function () {
        var courseId = $(this).attr('courseId');
        $.ajax({
            type: 'POST',
            url: 'Module/assign_subject_by_course_student',
            data: {course_id:courseId},
            dataType: 'html',
            success: function (results) {
                html = results;

                $(".mySlickSubject").slick('unslick');
                $(".mySlickSubject").html(html);
                $('.mySlickSubject').slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    adaptiveHeight: true,
                });

            }
        });
    });

    // $('.mySlick').on('click', function (e){
    //     let slideClicked = $(e.currentTarget).attr("data-slick-index");
    //     console.log(slideClicked);
    // });
</script>

<script>
    $(document).on('click', '#subjectNameQ', function(){
        var courseId = $(this).attr('courseId');
        var subjectId = $(this).attr('subjectId');
        var tutorId  = <?php echo $tutorInfo[0]['id']; ?>;
        var moduleType = <?php echo $moduleType; ?>;
        $.ajax({
            url: 'Student/studentsModuleByQStudyNew',
            method: 'POST',
            data: {
                //chapterId:chapterId,
                subjectId : subjectId,
                tutorId : tutorId,
                moduleType : moduleType,
                courseId : courseId,
            },
            success: function(data){
                $('#moduleTable').html(data);
            }
        })
    });

</script>

<?php if ($tutor_id == 2 && $module_type == 2) { ?>

  <script type="text/javascript">
  $(".courseName").click(function () {
    var courseId = $(this).attr('courseId');
        var subjectId = $(this).attr('subjectId');
        var tutorId  = <?php echo $tutorInfo[0]['id']; ?>;
        var moduleType = <?php echo $moduleType; ?>;
        $.ajax({
            url: 'Student/studentsModuleByQStudyNew',
            method: 'POST',
            data: {
                //chapterId:chapterId,
                subjectId : subjectId,
                tutorId : tutorId,
                moduleType : moduleType,
                courseId : courseId,
            },
            success: function(data){

                $('#moduleTable').html(data);
            }
        })
  });
</script>

<?php } ?>
