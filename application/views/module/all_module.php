<style>
  .sign_up_menu ul {
    display: none !important;
  }

  .select2-container {
    display: initial;
  }

  .select,
  .select input {
    width: 100px !important;
  }
</style>

<!-- <div class="container top100"> -->


<div>
  <div class="row">
    <div class="col-md-12 text-center">
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
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

    </div>
    <?php if ($_SESSION['userType'] == 7) { ?>
      <div class="col-md-12 upperbutton" style="text-align: center;margin-bottom: 10px;">
        <a href="view-course" style="font-size:22px;color:#8e9295;display: inline-block;">Module Inbox</a>
      </div>
    <?php } ?>
    <div class="col-md-12 upperbutton" style="text-align: center;margin-bottom: 10px;">
      <a href="create-module" style="font-size:22px;color:#8e9295;text-decoration:underline;display: inline-block;">Create Module</a>
      <a href="details-module" style="font-size:22px;color:#8e9295;text-decoration:underline;display: inline-block;margin-left:10px;">Module Details</a>
    </div>
  </div>





  <div class="ss_q_list_top" style="display:none;">
    <div class="ss_student_progress" >
      <div class="search_filter">
        <form class="form-inline" method="post" action="javascript:;">
          <div class="form-group">
            <label for="exampleInputName2">Module Name</label>
            <div class="select">
              <?php $modName = isset($_SESSION['modInfo']['moduleName']) ? $_SESSION['modInfo']['moduleName'] : ''; ?>
              <input type="text" value="<?php echo $modName; ?>" class="form-control" name="moduleName" id="moduleName">
            </div>
          </div>

          <?php if ($_SESSION['userType'] == 7) :
            if ($this->session->userdata('selCountry') != 1) {
          ?>
              <!-- <div class="form-group">
                  <label for="exampleInputName2">Country</label>
                  <div class="select">
                    <?php //$disabled = isset($_SESSION['selCountry'])||isset($_SESSION['modInfo']['country']) ? 'style="pointer-events:none;"' : '';
                    //$selCountry = isset($_SESSION['modInfo']['country']) ? $_SESSION['modInfo']['country'] : (isset($_SESSION['selCountry']) ? $_SESSION['selCountry'] : '');
                    ?>
                    <select class="form-control" name="country" id="moduleCountry" onChange="moduleSearch()" >
                      <option value="" > Select Country </option>
                      <?php //foreach ($allCountry as $country) : 
                      ?>
                            <?php //$sel = strlen($selCountry)&&($country['id']==$selCountry) ? 'selected' : ''; 
                            ?>
                        <option value="<?php //echo $country['id'] 
                                        ?>" <?php //echo $sel; 
                                            ?>><?php //echo $country['countryName'] 
                                                                            ?></option>
                        <?php //endforeach; 
                        ?>
                    </select>
                  </div>
                </div> -->
          <?php }
          endif; ?>

          <div class="form-group">
            <label for="exampleInputName2">Grade</label>
            <div class="select">
              <select class="form-control select-hidden" name="grade" id="moduleGrade" onChange="moduleSearch()">
                <option value="" name="studentGrade">Select Grade/Year/Level</option>
                <?php $grades = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; ?>
                <?php foreach ($grades as $stGrade) { ?>
                  <?php $sel = isset($_SESSION['modInfo']['studentGrade']) && ($stGrade == $_SESSION['modInfo']['studentGrade']) ? 'selected' : ''; ?>
                  <option value="<?php echo $stGrade; ?>" <?php echo $sel; ?>>
                    <?php echo $stGrade; ?>
                  </option>
                <?php } ?>
                <option value="13">Upper Level</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail2">Module Type</label>
            <div class="select">
              <select class="form-control select-hidden" name="moduleType" name="studentGrade" id="moduleType" onChange="moduleSearch()">
                <option value="">Select....</option>
                <?php foreach ($all_module_type as $module_type) { ?>
                  <?php $sel = isset($_SESSION['modInfo']['moduleType']) && ($module_type['id'] == $_SESSION['modInfo']['moduleType']) ? 'selected' : ''; ?>
                  <option value="<?php echo $module_type['id'] ?>" <?php echo $sel; ?>>
                    <?php echo $module_type['module_type']; ?>
                  </option>
                <?php } ?>
              </select>

            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail2">Subject</label>
            <div class="select">
              <select class="form-control select-hidden" id="moduleSubject" name="subject" onChange="moduleSearch()">
                <option value="">Select....</option>
                <?php foreach ($all_subject as $subject) { ?>
                  <?php $sel = isset($_SESSION['modInfo']['subject']) && ($subject['subject_id'] == $_SESSION['modInfo']['subject']) ? 'selected' : ''; ?>
                  <option value="<?php echo $subject['subject_id'] ?>" <?php echo $sel; ?>>
                    <?php echo $subject['subject_name']; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail2">Chapter</label>
            <div class="select">
              <select class="form-control select-hidden" name="chapter" id="moduleChapter" onChange="moduleSearch()">
                <option value="">Select....</option>
                <?php if (isset($_SESSION['modInfo']['chapter'])) : ?>
                  <?php echo $_SESSION['modInfo']['chapter']; ?>
                <?php endif; ?>
              </select>
            </div>
          </div>

          <?php if ($_SESSION['userType'] == 7) :
            if ($this->session->userdata('selCountry') != 1) {
          ?>
              <!-- <div class="form-group">
                  <label for="exampleInputEmail2">Course</label>
                  <div class="select">
                    <select class="form-control select-hidden" id="moduleCourse" name="course" onChange="moduleSearch()">
                      <option value="">Select....</option>
                      <?php //foreach ($all_course as $course) {
                      ?>
                            <?php //$sel = isset($_SESSION['modInfo']['course_id'])&&($course['id']==$_SESSION['modInfo']['course_id']) ? 'selected' : '';
                            ?>
                        <option value="<?php //echo $course['id']
                                        ?>" <?php //echo $sel; 
                                            ?>>
                            <?php //echo $course['courseName'];
                            ?>
                        </option>
                        <?php //}
                        ?>
                    </select>
                  </div>
                </div> -->
          <?php }
          endif; ?>

          <div class="form-group" style="width:80px !important;">
            <button type="button" id="modSearchBtn" onClick="moduleSearch()" class="btn btn-primary" style="margin-top:20px !important">search</button>
          </div>

          <div class="form-group">
            <a href="add-module">
              <button type="button" class="btn btn_orange">
                <i class="fa fa-file"></i> Add New
              </button>
            </a>
          </div>

          <div class="form-group">
            <a href="reorder-module" class="btn btn_green">Re-Order</a>
          </div>

        </form>

      </div>
    </div>

  </div>


  <div class="row" style="display:none;">
    <div class="sign_up_menu">
      <div class="table-responsive">
        <table class="table table-bordered" id="module_setting">
          <thead>
            <tr>
              <th>Date</th>
              <th>Module Name</th>
              <th>Country</th>
              <th>Grade</th>
              <th>Module Type</th>
              <th>Subject</th>
              <th>Chapter</th>
              <?php
              if ($this->session->userdata('selCountry') != 1) {
              ?>
                <!-- <th>Course</th> -->
              <?php } ?>
              <th>Duplicate</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody id="allModuleTable">
            <?php $moduleTypes = ['', 'Tutorial', 'Everyday Study', 'Special Exam', 'Assignment'] ?>

            <?php foreach ($all_module as $module) : ?>
              <tr id="<?php echo $module['id']; ?>" studentGrade="<?php echo $module['studentGrade']; ?>" subject="<?php echo $module['subject']; ?>" country="<?= $module['country']; ?>" course="<?= $module['course_id']; ?>">
                <td><?php echo date('d-M-Y', $module['exam_date']) ?></td>
                <td id="modName">
                  <a href="edit-module/<?php echo $module['id']; ?>"><?php echo $module['moduleName']; ?></a>
                </td>
                <td><?php echo $module['countryName'] ?></td>
                <td><?php echo $module['studentGrade'] ?></td>
                <td>
                  <?php echo $moduleTypes[$module['moduleType']]; ?>
                </td>
                <td><?php echo $module['subject_name'] ?></td>
                <td><?php echo $module['chapterName'] ?></td>
                <?php
                if ($this->session->userdata('selCountry') != 1) { ?>
                  <td><?php echo $module['courseName'] ?></td>
                <?php } ?>
                <td>
                  <i class="fa fa-clipboard" id="modDuplicateIcon" data-toggle="modal" data-target="#moduleDuplicateModal" style="color:#4c8e0c;"></i>
                </td>
                <td>
                  <a href="edit-module/<?php echo $module['id']; ?>">
                    <i class="fa fa-pencil" style="color:#4c8e0c;"></i>
                  </a>
                </td>
                <td>
                  <i data-toggle="modal" <?php if ($_SESSION['userType'] != 7) { ?> data-target="#moduleDelModal" <?php   }  ?> <?php if ($_SESSION['userType'] == 7 && count($checkNullPw) == 0) { ?> data-target="#moduleDelModal" <?php   }  ?> <?php if ($_SESSION['userType'] == 7 && count($checkNullPw) != 0) { ?> data-target="#ss_info_sucesss" <?php   }  ?> class="fa fa-trash" id="dltModOpnIcon" style="color:red;"></i>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- qstudyPassword -->

<div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <label>Enter your q-study password</label> <br>
        <input type="password" id="qPassword" class="form-control" placeholder="Enter your q-study password">
        <div id="qPasswordErr" style="color: red;font-weight: 800"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" onclick="qPassword()">Submit</button>
      </div>
    </div>
  </div>
</div>

<!-- delete module -->
<div class="modal fade" tabindex="-1" role="dialog" id="moduleDelModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Really want to delete module?</h5>
      </div>
      <div class="modal-body text-center">
        <input type="hidden" value="" id="moduleToDel">
        <button type="button" class="btn btn-danger" id="moduleDltBtn">YES</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- duplicate module -->
<div class="modal fade" tabindex="-1" role="dialog" id="moduleDuplicateModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">Really want to duplicate module?</h5>
      </div>

      <div class="modal-body text-center">


        <div class="row">

          <form class="form-horizontal" id="moduleDuplicateForm">
            <div class="col-md-10">
              <input type="hidden" name="origModId" id="origModId" val="">
              <!-- <input type="hidden" name="subject" id="subject" val=""> -->
              <input type="hidden" name="course" id="course" val="">
              <input type="hidden" name="country" id="country" val="">

              <input type="hidden" name="startTime" id="modStartTime" value="">
              <input type="hidden" name="endTime" id="modEndTime" value="">
              <input type="hidden" name="optTime" id="modOptTime" value="">

              <div class="form-group row">
                <label for="exampleInputEmail1" class="col-sm-4">Module Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="moduleName" id="duplicateModName" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputEmail1" class="col-sm-4">Subject</label>
                <div class="col-sm-6">
                  <select class="form-control select-hidden" id="dup_moduleSubject" name="subject" onChange="dup_moduleSearchSub()" style="width: 250px;">
                    <option value="">Select....</option>
                    <?php foreach ($all_subject as $subject) { ?>
                      <?php $sel = isset($_SESSION['modInfo']['subject']) && ($subject['subject_id'] == $_SESSION['modInfo']['subject']) ? 'selected' : ''; ?>
                      <option value="<?php echo $subject['subject_id'] ?>" <?php echo $sel; ?>>
                        <?php echo $subject['subject_name']; ?>
                      </option>
                    <?php } ?>
                  </select>
                  <input type="text" class="form-control" name="subject_name" id="duplicateModSubName" style="display: none">
                </div>
                <div class="col-sm-2">
                  <button type="button" class="btn btn-sm btn-danger" id="showduplicateModSubName" value="new">New</button>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputEmail1" class="col-sm-4">Chapter</label>
                <div class="col-sm-6">
                  <div class="select">
                    <select class="form-control select-hidden" name="chapter" id="dup_moduleChapter" onChange="dup_moduleSearch()" style="width: 250px;">
                      <option value="">Select....</option>
                      <?php if (isset($_SESSION['modInfo']['chapter'])) : ?>
                        <?php echo $_SESSION['modInfo']['chapter']; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                  <input type="text" class="form-control" name="chapterName" id="duplicateModChapName" style="display: none">
                </div>
                <div class="col-sm-2">
                  <!-- <button type="button" class="btn btn-sm btn-danger" id="showduplicateModChapName">New</button> -->
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-4">Grade/Year/Level</label>
                <div class="col-sm-8">
                  <!--<input type="text" class="form-control" id="studentGrade" name="studentGrade" required readonly>-->
                  <select class="form-control" id="studentGrade" name="studentGrade">
                    <?php foreach ($grades as $stGrade) { ?>
                      <option value="<?php echo $stGrade; ?>" <?php echo $sel; ?>>
                        <?php echo $stGrade; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4">Date</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="enterDate" name="examDate" autocomplete="off" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-4">Module Type</label>
                <div class="col-sm-8">
                  <select id="select_module_type" class="form-control" name="moduleType" required>
                    <option value="">SELECT MODULE TYPE</option>
                    <?php echo $allRenderedModType; ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-4"></label>
                <div class="col-sm-4">
                  <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox1" value="1" name="respToSMS"> Respond to SMS
                  </label>
                </div>
                <div class="col-sm-4">
                  <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox2" value="1" name="isAllStudent"> For all student
                  </label>
                </div>
              </div>

              <div class="form-group row" id="time" style="display: none;">
                <label for="exampleInputName2">Time</label>
                <i class="fa fa-clock-o" style="font-size:20px;" data-toggle="modal" data-target="#setTime"></i>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-4">For individual student</label>
                <div class="col-sm-8">
                  <select id="individualStudent" class="form-control select2" name="indivStIds[]" multiple="">
                    <?php echo $allStudents; ?>
                  </select>
                  <!--                    <select id="indivStIds" class="form-control select2" name="indivStIds[]" multiple="">
                       <?php //echo $allStudents; 
                        ?> 
                      <option value="">--Student--</option>
                    </select>-->
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-4"></label>
                <div class="col-sm-2">
                  <button type="submit" class="btn btn-primary btn-sm">YES</button>
                </div>
                <div class="col-sm-2">
                  <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">NO</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div><!-- /.modal-content -->

    <div class="modal-footer">
    </div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--modal add time optional and specific-->
<div class="modal fade" id="setTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Set Time</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group row" id="time_ranger">
            <label for="recipient-name" class="control-label col-md-3">Time Range:</label>
            <div class="col-md-3">
              <div class="input-group date" id="datetimepicker1">

                <input type="text" class="form-control enterDate" id="timeStart" name="startTime" autocomplete="off" value="">

                <span class="input-group-addon">
                  <span class="fa fa-clock-o"></span>
                </span>
              </div>
            </div>
            <label class="control-label small text-muted col-md-1">To</label>
            <div class="col-md-3">
              <div class="input-group date" id="datetimepicker1">

                <input type="text" class="form-control enterDate" id="timeEnd" name="endTime" autocomplete="off" value="">

                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="recipient-name" class="control-label col-md-3">Optional Time:</label>
            <div class="col-md-4">
              <div class="input-group date" id="datetimepicker1">

                <input type="text" class="form-control enterDate" id="optTime" name="optTime" autocomplete="off" value="">

                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modTimeSetBtn">OK</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).on('click', '#modTimeSetBtn', function() {
    var timeStart = $('#timeStart').val();
    var timeEnd = $('#timeEnd').val();
    var optTime = $('#optTime').val();
    $('#modStartTime').val(timeStart);
    $('#modEndTime').val(timeEnd);
    $('#modOptTime').val(optTime);
    // console.log(timeStart);
    $('#setTime').modal('toggle');
  })

  //time picker
  var startTimeTextBox = $('#timeStart');
  var endTimeTextBox = $('#timeEnd');




  $.timepicker.timeRange(
    startTimeTextBox,
    endTimeTextBox, {
      // 1hr
      minInterval: (1000 * 60),
      //timeFormat: 'HH:mm',
      timeFormat: 'hh:mm tt',
      start: {}, // start picker options
      end: {} // end picker options
    },
  );

  $('#optTime').timepicker();


  //set module id to modal for deletion
  $(document).on('click', '#dltModOpnIcon', function() {
    var moduleTodel = $(this).closest('tr').attr('id');
    $('#moduleToDel').val(moduleTodel);

  })

  //module delete functionality
  $('#moduleDltBtn').on('click', function() {
    var moduleId = $(this).siblings('#moduleToDel').val();
    $.ajax({
      url: 'Module/deleteModule',
      method: 'post',
      data: {
        moduleId: moduleId
      },
      success: function(data) {
        if (data == 'true') {
          alert('Module deleted successfully');
        } else {
          alert('Something is wrong');
        }
        $('#moduleDelModal').modal('toggle');
        $('tr#' + moduleId).fadeOut('500');
      }
    })
  });

  //set original module id on module duplicate modal
  $(document).on('click', '#modDuplicateIcon', function() {
    var origModId = $(this).closest('tr').attr('id');
    var origModStGrade = $(this).closest('tr').attr('studentGrade');


    var origModName = $(this).closest('tr').find('#modName a').html();
    // console.log(origModName);
    $('#origModId').val(origModId);
    $("#studentGrade").val(origModStGrade);

    $("#country").val($(this).closest('tr').attr('country'));
    $("#subject").val($(this).closest('tr').attr('subject'));
    $("#course").val($(this).closest('tr').attr('course'));
    //      $('#studentGrade').val(origModStGrade);
    $('#duplicateModName').val(origModName);

    individual_student();
  });

  $("#studentGrade").change(function() {
    individual_student();
  })

  function individual_student() {
    var studentGrade = $("#studentGrade :selected").val();
    var subject = $("#subject").val();
    var country_id = $("#country").val();
    var tutor_type = '<?php echo $this->loggedUserType ?>';
    <?php if ($this->loggedUserType == 7) { ?>
      var course_id = $("#course").val();;
    <?php } ?>

    $.ajax({

      url: 'getIndividualStudent',
      method: 'POST',
      data: {
        studentGrade: studentGrade,
        country_id: country_id,
        subject: subject,
        tutor_type: tutor_type,
        <?php if ($this->loggedUserType == 7) { ?>
          course_id: course_id
        <?php } ?>
      },
      success: function(data) {
        //console.log(data);
        $('#individualStudent').html(data);
      }
    });
  }

  //module duplicate form submit
  $(document).on('submit', '#moduleDuplicateForm', function(event) {
    event.preventDefault();
    var subjectName = $('#duplicateModSubName').val();
    var chapterName = $('#duplicateModChapName').val();
    if (subjectName == '' && chapterName != '') {
      alert('Please Enter Subject !!');
      return false;
    }
    if (subjectName != '' && chapterName == '') {
      alert('Please Enter Chapter !!');
      return false;
    }
    var data = $(this).serialize();

    $.ajax({
      url: 'Module/moduleDuplicate',
      method: 'POST',
      data: data,
      success: function(data) {
        if (data == 'false') {
          alert('To keep same module name please change student grade.');
        } else if (data == 'true') {
          alert('Module duplication complete.');
        } else {
          alert(data);
        }

        $('#moduleDuplicateModal').modal('toggle');
        location.reload();
      }
    })
    //console.log(data);
  });


  //get student on grade change
  $('#studentGrade').change(function() {
    var grade = $('#studentGrade :selected').val();
    $.ajax({
      url: 'Module/getStudentByGrade',
      type: 'POST',
      data: {
        grade: grade
      },
      success: function(data) {
        $('#indivStIds').html(data);
      }
    })

  })

  //module search 
  function moduleSearch() {
    var moduleName = $('#moduleName').val();
    var country = $('#moduleCountry :selected').val();
    var grade = $('#moduleGrade :selected').val();
    var type = $('#moduleType :selected').val();
    var subject = $('#moduleSubject :selected').val();
    var chapter = $('#moduleChapter :selected').val();
    var course = $('#moduleCourse :selected').val();
    $.ajax({
      'url': 'module/search',
      'method': 'POST',
      'data': {
        'moduleName': moduleName,
        'country': country,
        'studentGrade': grade,
        'moduleType': type,
        'subject': subject,
        'chapter': chapter,
        'course_id': course,
      },
      beforeSend: function() {
        $.LoadingOverlay("show");
      },
      success: function(data) {
        $(".table").dataTable().fnDestroy();
        $('#allModuleTable').html(data);
        $.LoadingOverlay("hide");

        $('.table').dataTable({
          searching: false,
          lengthChange: false,
          select: false,
          "aaSorting": []
        });
      }
    })
  }


  //date picker on duplicate module modal
  $('#enterDate').datepicker({});
  //datatable
  $('.table').dataTable({
    searching: false,
    lengthChange: false,
    select: true,
    "aaSorting": []
  });

  //get chapter on subject change
  $(document).on('change', '#moduleSubject', function() {
    var subject = $(this).val();
    $.ajax({
      url: 'Tutor/get_chapter_name',
      method: 'post',
      data: {
        'subject_id': subject
      },
      success: function(response) {
        $('#moduleChapter').html(response);
      }
    })
  });

  $('#select_module_type').on('change', function() {
    if (this.value == 3 || this.value == 2) {
      $("#time").show();
    } else {
      $("#time").hide();
    }
  });
</script>
<?php unset($_SESSION['modInfo']); ?>

<!-- qstudyPassword -->


<script type="text/javascript">
  function qPassword() {
    var qPassword = $("#qPassword").val();
    if (qPassword == '') {
      $("#qPasswordErr").html("Input Password Please");
      return false;
    } else {
      $("#qPasswordErr").html(" ");
    }
    $.ajax({
      url: 'Tutor/qstudyPassword/' + qPassword,
      method: 'GET',
      success: function(response) {
        if (response == 0) {
          $("#qPasswordErr").html("Wrong Password")
        } else {
          $("#qPasswordErr").html("")
          $("#ss_info_sucesss").modal("toggle")

          $('#moduleDelModal').modal('toggle');
          $('tr#' + moduleId).fadeOut('500');
        }
      }
    })

  }


  function deleteQuestion() {
    var moduleId = $(this).siblings('#moduleToDel').val();
    $.ajax({
      url: 'Module/deleteModule',
      method: 'post',
      data: {
        moduleId: moduleId
      },
      success: function(data) {
        if (data == 'true') {
          alert('Module deleted successfully');
        } else {
          alert('Something is wrong');
        }

      }
    })
  }


  $(document).on('change', '#dup_moduleSubject', function() {
    var subject = $(this).val();
    $.ajax({
      url: 'Tutor/get_chapter_name',
      method: 'post',
      data: {
        'subject_id': subject
      },
      success: function(response) {
        $('#dup_moduleChapter').html(response);
      }
    })
  });

  $(document).on('click', '#showduplicateModChapName', function() {
    $('#duplicateModChapName').show();
    $('#dup_moduleChapter').hide();
  });

  $(document).on('click', '#showduplicateModSubName', function() {
    var val = $(this).val();
    if (val == 'new') {
      $('#duplicateModSubName').show();
      $('#dup_moduleSubject').hide();
      $('#duplicateModChapName').show();
      $('#dup_moduleChapter').hide();
      $('#dup_moduleSubject').val('');
      $('#dup_moduleChapter').val('');
      $(this).val('old');
    } else {
      $('#duplicateModSubName').hide();
      $('#dup_moduleSubject').show();
      $('#duplicateModChapName').hide();
      $('#dup_moduleChapter').show();
      $('#duplicateModSubName').val('');
      $('#duplicateModChapName').val('');
      $(this).val('new');
    }
  });

  function moduleSearchAll() {
    $('#moduleName').val('')
    var moduleName = '';
    var country = '';
    var grade = $('#moduleGrade :selected').val();
    var type = '';
    var subject = '';
    var chapter = '';
    var course = '';
    $.ajax({
      'url': 'module/search',
      'method': 'POST',
      'data': {
        'moduleName': moduleName,
        'country': country,
        'studentGrade': grade,
        'moduleType': type,
        'subject': subject,
        'chapter': chapter,
        'course_id': course,
      },
      // beforeSend: function() {
      //   $.LoadingOverlay("show");
      // },
      success: function(data) {
        $(".table").dataTable().fnDestroy();
        $('#allModuleTable').html(data);
        //   $.LoadingOverlay("hide");

        $('.table').dataTable({
          searching: false,
          lengthChange: false,
          select: false,
          "aaSorting": []
        });
      }
    })
  }

  $(document).ready(function() {
    moduleSearchAll();
  })
</script>