<style>
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

  .newtable tr th {
    font-weight: normal;
    text-align: center;
    font-size: 16px;
    padding-bottom: 10px;
  }

  .newtable tr th a {
    display: inline;
  }

  .newtable .ss_q_btn {
    margin-top: 0;
    margin-right: 5px;
  }

  .actionbutton {
    display: flex;
    flex-wrap: wrap;
  }

  .newtable .form-group {
    margin-bottom: 0;
  }

  .parent_class td {
    padding: 2px;
    padding-bottom: 10px;
  }

  .ss_question_add_top {
    overflow: hidden;
    margin-top: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .ss_question_add_top .ss_q_btn {
    margin-top: 0;
  }

  .select2-container .select2-selection--single {
    height: 33px;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 30px;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px;
  }
  .container-fluid {
    width: 99%;
}

</style>


<?php
 //  echo "<pre>";print_r($all_course);
?>

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
      <a href="create-module" style="font-size:22px;color:#8e9295;text-decoration:underline;display: inline-block;margin-left:10px;">Create Module</a>
      <a href="details-module" style="font-size:22px;color:#4bbcc0;text-decoration:underline;display: inline-block;">Module Details</a>
    </div>
  </div>

  <div class="">
    <!--============================================
                  new module start
    ==============================================-->

    <div class="row">
      <div class="col-sm-12">
        <div class="ss_question_add_top text-center">
          <p id="error_msg" style="color:red"></p>

          <div class="form-group" style="float: left;margin-right: 10px;">
            <label style="text-align: left ; display: block;"> Module Name</label>

            <?php $modName = isset($_SESSION['modInfo']['moduleName']) ? $_SESSION['modInfo']['moduleName'] : ''; ?>
            <input type="text" value="" class="form-control" style="width: 120px;" name="moduleName" id="searchbyModuleName">
          </div>

          <div class="form-group" style="float: left;margin-right: 10px;">
            <label for="exampleInputName2">Grade</label>
            <select class="form-control createQuesLabel" name="studentgrade" id="searchstudentGrade">
              <option value="">Grade</option>
              <?php $grades = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]; ?>
              <?php foreach ($grades as $grade) { ?>
                <option value="<?php echo $grade ?>" <?php if(!empty($this->session->userdata('search_student_grade'))){if($this->session->userdata('search_student_grade')==$grade){echo "selected";}}?>>
                  <?php echo $grade; ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group" style="float: left;margin-right: 10px;">
            <label>Module Type</label>

            <select class="form-control createQuesLabel  searchModule" style="width: 120px;" name="subject" id="subject" >
              <option value="">---Select---</option>
              <?php foreach ($all_modules as $all_module) { ?>
                <option class="option" value="<?php echo $all_module['id'] ?>" <?php if(!empty($this->session->userdata('search_module_type'))){if($this->session->userdata('search_module_type')==$all_module['id']){echo "selected";}}?>>
                  <?php echo $all_module['module_type']; ?>
                </option>
              <?php } ?>
            </select>
          </div>
        
          <?php if($_SESSION['userType'] != 3){?>
            <div class="form-group" style="float: left;margin-right: 10px;">
              <label>Course Name<span id="get_subject"></label>
              <select class="form-control createQuesLabel" name="chapter" style="width: 120px;" id="search_course">
                <option value="">---Select---</option>
                <?php foreach ($all_course as $course) { ?>
                  <option class="option" value="<?php echo $course['id'] ?>" <?php if(!empty($this->session->userdata('search_course_name'))){if($this->session->userdata('search_course_name')==$course['id']){echo "selected";}}?>>
                    <?php echo $course['courseName']; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          <?php } ?>
          <a class="ss_q_btn btn pull-left module_search" href="javascript:void(0)"> Search</a>
          <a class="ss_q_btn btn pull-left clear_search" href="javascript:void(0)"><i class="fa fa-remove" aria-hidden="true"></i> Clear</a>

        </div>
      </div>
      <div class="col-sm-12" style="margin-top: 50px;">

        <div class="panel panel-default panel-box">
          <div class="panel-body">
            <div class="ss_question_add_top">

              <p id="error_msg" style="color:red"></p>
              <table class="newtable">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th>Module Name <span href="javascript:void(0)" id="get_subject"><img src="assets/images/icon_new.png"> New</span> </th>
                    <th>Subject</th>
                    <th>Chapter</th>
                    <th>Grade</th>
                    <th>Module Type</th>
                    <?php if($_SESSION['userType'] != 3){?>
                    <th> Course Name <a href="javascript:void(0)" id="get_subject"><img src="assets/images/icon_new.png"> New</a> </th>
                    <?php }?>
                    <th> </th>
                    <th> </th>
                  </tr>
                </thead>
                <tbody class="row_position addMoreModuleList">
                  <?php $moduleTypes = ['', 'Tutorial', 'Everyday Study', 'Special Exam', 'Assignment'] ?>
                  



                </tbody>
              </table>

            </div>


            <div class="row">
              <div class="col-sm-2">
                <div class="panel panel-default panel-box" style="display: none;">
                  <div class="panel-heading"><a href="">Edit</a>
                    <span class="pull-right">Q
                      <select name="" id="">
                        <option value="">1</option>
                        <option value="">1</option>
                        <option value="">1</option>
                      </select>
                    </span>
                  </div>
                  <div class="panel-body">
                    <img src="assets/images/question.png" class="pull-right">
                  </div>
                  <div class="panel-footer">
                    <button class="btn btn-primary">Vocubulary</button>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>

        <?php if(isset($links)){ ?>
          <div class="pagination-class text-center">
              
          </div>
        <?php } ?>

      </div>

    </div>

  </div>

  <!--============================================
                  new module end
    ==============================================-->



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
            <div class="col-md-10 module_duplicate_append">

            </div>
          </form>
        </div>
      </div>

    </div><!-- /.modal-content -->

    <div class="modal-footer">
    </div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

<div class="modal fade ss_modal" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <label>Add Subject</label> <br><br>
        <input type="text" id="subjectName" class="form-control" placeholder="Enter your Subject Name">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" onclick="saveSubject()">Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade ss_modal" id="addChapterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <label>Add Chapter</label> <br><br>
        <input type="text" id="chapterName" class="form-control" placeholder="Enter your Chapter Name">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue"  onclick="saveChapter()">Submit</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
    function get_all_module(index){

        if(index==undefined){
          page_index= 0;
        }else{
          page_index= index-1;
        }

        var studentGrade = $('#searchstudentGrade').val();
        localStorage.setItem("student_grade", studentGrade);

        var module_type = $('.searchModule').val();
        var course_id = $('#search_course').val();
        var module_name = $('#searchbyModuleName').val();
      

        $.ajax({
          url: "<?php echo base_url(); ?>searchModuleByOptions",
          method: 'POST',
          data: {
            studentGrade: studentGrade,
            module_type: module_type,
            course_id:course_id,
            module_name:module_name,
            page_index:page_index,
          },
          success: function(data) {
            
            var all_module = JSON.parse(data);
            var modules = all_module.modules;
            var pagination = all_module.links;
            var html = '';
            for(var i=0; i<modules.length;i++){
              var show_checked = '';
              if(modules[i].show_student==1){
                var show_checked = 'checked';
              }else{
                var show_checked = '';
              }
              const mod_types = ['', 'Tutorial', 'Everyday Study', 'Special Exam', 'Assignment'];
              var url = "window.location.href = 'new-edit-module/"+modules[i].id+"/2'";
              // alert(url);

              html+= '<tr class="parent_class" id="'+modules[i].serial+'" data-id="'+modules[i].id+'" data-grade="'+modules[i].studentGrade+'" data-moduleType="'+modules[i].moduleType+'" data-courseId="'+modules[i].course_id+'"><td><div class="form-group"><button type="button" class="btn btn-default"><label for="formInputButton">Show <span><input type="checkbox" name="show_student" id="formInputButton" value="1" '+show_checked+'></span> </label></button></div></td><td><div class="form-group"><button type="button" class="btn btn-default bluebutton"><label for="formInputButton1" style="width: 80px">SL<input type="text" data-index="'+modules[i].course_id+'" value="'+modules[i].serial+'" data-id="'+modules[i].id+'" data-course="'+modules[i].course_id+'" data-grade = "'+modules[i].studentGrade+'" data-modType="'+modules[i].moduleType+'" class="form-control assign_serial serial_'+i+'"></label></button></div></td><td><div class="form-group"><input type="button" value="'+modules[i].moduleName+'" onclick="'+url+'" class="form-control" name="moduleName" id="moduleName"></div></td><td><div class="form-group"><input type="text" style="max-width:120px" class="form-control" id="grade" value="'+modules[i].subject_name+'"></div></td><td><div class="form-group"><input type="text" style="max-width:120px" class="form-control" id="grade" value="'+modules[i].chapterName+'"></div></td><td style="width: 60px;"><div class="form-group"><input type="text" style="max-width:120px" class="form-control" id="grade" value="'+modules[i].studentGrade+'"></div></td><td><div class="form-group"><input style="max-width:120px" type="text" class="form-control" value="'+mod_types[modules[i].moduleType]+'"></div></td><td><div class="form-group"><input type="text" class="form-control" value="'+$(modules[i].courseName).text()+'"></div></td><td class="actionbutton"><a class="ss_q_btn btn pull-left duplicate-module" type="button" data-countryname="'+modules[i].countryName+'" data-modulename="'+modules[i].moduleName+'" data-moduletype="'+modules[i].moduleType+'" data-course="'+modules[i].courseName+'" data-grade="'+modules[i].studentGrade+'" data-moduleid="'+modules[i].id+'" data-courseId="'+modules[i].course_id+'" data-moduleTypeId="'+modules[i].moduleType+'" data-subjectId="'+modules[i].subject+'" data-chapterId="'+modules[i].chapter+'"><i class="fa fa-clipboard" aria-hidden="true"></i></a><a class="ss_q_btn btn pull-left deleteModule" href="delete_new_module/'+modules[i].id+'"><i class="fa fa-trash" aria-hidden="true"></i></a><a class="ss_q_btn btn pull-left" href="<?= base_url()?>module_preview/'+modules[i].id+ '/1" id="preview_btn"><i class="fa fa-file-o" aria-hidden="true"></i> Preview</a><input type="submit" name="submit" class="ss_q_btn btn btn-danger" value="Save" /><img style="height:33px" src="assets/images/image-plus.png"></td></tr>';
            }  
            $('.addMoreModuleList').html(html);
            $('.pagination-class').html(pagination);
            localStorage.clear();

          }
        });
      
    }

    $(function(){
      // alert('hello');
      get_all_module();

      

    });

    $(".row_position").sortable({
        delay: 150,
        stop: function() {

            var allSerial = new Array();
            var moduleIds = new Array();
            var grades = new Array();
            var moduleTypes = new Array();
            var courseIds = new Array();

            $(".row_position>tr").each(function() {
              allSerial.push($(this).attr("id"));
              moduleIds.push($(this).attr("data-id"));
              grades.push($(this).attr("data-grade"));
              moduleTypes.push($(this).attr("data-moduleType"));
              courseIds.push($(this).attr("data-courseId"));
            });
            updateOrder(allSerial,moduleIds,grades,moduleTypes,courseIds);
        }
    });
    

    function updateOrder(allSerial,moduleIds,grades,moduleTypes,courseIds) {
       
      $.ajax({
      url: "<?php echo base_url(); ?>update_serial_to_module",
      method: 'POST',
      data: {
        allSerial: allSerial,
        moduleIds: moduleIds,
        grades:grades,
        moduleTypes:moduleTypes,
        courseIds:courseIds
      },
      success: function(data) {
        location.reload();
      }
      });

    }

    $('.module_search').click(function(){
      get_all_module();

    });

    $('.clear_search').click(function(){
      $('#searchstudentGrade').val('');
      $('.searchModule').val('');
      $('#search_course').val('');
      $('#searchbyModuleName').val('');
      location.reload();
    });
</script>

<script>

  <?php  if($this->session->flashdata('delete_success')){ ?>

  alert('Successfully Deleted !!');

  <?php }?>

  $('.assign_serial').on('change', function(){
    var serial = $(this).val();
    var module_id = $(this).attr('data-id');
    var serial_no = $(this).attr('data-index');
    var course_id = $(this).attr('data-course');
    var grade_id = $(this).attr('data-grade');
    var modType = $(this).attr('data-modType');

    $.ajax({
      url: "<?php echo base_url(); ?>assign_serial_to_module",
      method: 'POST',
      data: {
        serial: serial,
        module_id: module_id,
        course_id:course_id,
        grade_id:grade_id,
        modType:modType
      },
      success: function(data) {
        if(data==1){
          alert('Serial Assigned Successfully !!');
          location.reload();
        }else{
          $('.serial_'+serial_no).val(0);
          alert('Sorry, This serial already exits !!');
        }
      }
    });
  });

  $(document).on('click','.duplicate-module',function(e){
  // $('.duplicate-module').click(function(e) {
    e.preventDefault();

    // moduleDuplicateForm kkkkkk
    $('.module_duplicate_append').html('');
    $('#moduleDuplicateModal').modal('show');

    var module_id = $(this).attr('data-moduleid');
    var countryname = $(this).data('countryname');
    var modulename = $(this).data('modulename');
    var moduleTypeId = $(this).attr('data-moduleTypeId');
    var course_id = $(this).attr('data-courseId');
    var subject_id = $(this).attr('data-subjectId');
    var chapter_id = $(this).attr('data-chapterId');
    var grade_id = $(this).attr('data-grade');

    
    
    var grade = $(this).data('grade');
    var allModules = '<?php echo json_encode($all_modules); ?>';
    var allModule = JSON.parse(allModules);
    var moduleType = '';
    for (var i = 0; i < allModule.length; i++) {
      if(allModule[i].id==moduleTypeId){
        var select='selected';
        moduleType += '<option value="' + allModule[i].id + '" '+select+'>' + allModule[i].module_type + '</option>';
      }else{
        moduleType += '<option value="' + allModule[i].id + '">' + allModule[i].module_type + '</option>';
      }
    }
    

    var all_Country = '<?php echo json_encode($allCountry); ?>';
    var allCountry = JSON.parse(all_Country);
    // console.log(allCountry);
    var countryName = '';
    for (var i = 0; i < allCountry.length; i++) {
      countryName += '<option value="' + allCountry[i].id + '">' + allCountry[i].countryName + '</option>';
    }

   
    //var course = '<?//php echo json_encode($courses); ?>';
    // console.log('<?php echo $courses;?>');
    var courses = JSON.parse('<?php echo $courses;?>');
   
    var courseName = '';

    for (var i = 0; i < courses.length; i++) {
      if(courses[i].id==course_id){
        select="selected";
        courseName += '<option value="' + courses[i].id + '" '+select+'>' + courses[i].courseName + '</option>';
      }else{
        select="";
        courseName += '<option value="' + courses[i].id + '" '+select+'>' + courses[i].courseName + '</option>';
      }
    }

    var grades = <?php echo json_encode($grades)?>;
    var gradeAll = '';

    for (var i = 0; i < grades.length; i++) {
      if(grades[i]==grade_id){
        select="selected";
        gradeAll += '<option value="' + grades[i] + '" '+select+'>' + grades[i] + '</option>';
      }else{
        select="";
        gradeAll += '<option value="' + grades[i] + '" '+select+'>' + grades[i] + '</option>';
      }
    }

    var subjects = <?php echo json_encode($allsubjects);?>;
    var subjects_options = '';

    for (var i = 0; i < subjects.length; i++) {
      if(subjects[i].subject_id==subject_id){
        select="selected";
        subjects_options += '<option value="' + subjects[i].subject_id + '" '+select+'>' + subjects[i].subject_name + '</option>';
      }else{
        select="";
        subjects_options += '<option value="' + subjects[i].subject_id + '" '+select+'>' + subjects[i].subject_name + '</option>';
      }
    }

    var chapters = <?php echo json_encode($allchapters);?>;
    var chapters_options = '';

    for (var i = 0; i < chapters.length; i++) {
      if(chapters[i].id==chapter_id){
        select="selected";
        chapters_options += '<option value="' + chapters[i].id + '" '+select+'>' + chapters[i].chapterName + '</option>';
      }else{
        select="";
        chapters_options += '<option value="' + chapters[i].id + '" '+select+'>' + chapters[i].chapterName + '</option>';
      }
    }

    var html = '<input type="hidden" name="module_id" value="' + module_id + '"><div class="form-group row"><label for="" class="col-sm-4">Country</label><div class="col-sm-6"><select class="form-control" name="country" required>' + countryName + '</select></div><div class="col-sm-2"><button type="button" class="btn btn-danger">New</button></div></div><div class="form-group row"><label for="" class="col-sm-4">Module Name</label><div class="col-sm-6"><input type="text" class="form-control" name="moduleName" value="' + modulename + '" required></div><div class="col-sm-2"><button type="button" class="btn btn-danger">New</button></div></div><div class="form-group row"><label for="" class="col-sm-4">Module Type</label><div class="col-sm-6"><select id="select_module_type_duplicate" class="form-control" name="moduleType" required>' + moduleType + '</select></div><div class="col-sm-2"><button type="button" class="btn btn-danger">New</button></div></div><div class="form-group row"><label for="" class="col-sm-4">Course Name</label><div class="col-sm-8"><select class="form-control" name="course_id" required>' + courseName + '</select></div></div><div class="form-group row"><label for="" class="col-sm-4">Grade/Year/Level</label><div class="col-sm-8"><select class="form-control" id="studentGrade" name="studentGrade">'+gradeAll+'</select></div></div><div class="form-group row d_subject"><label for="" class="col-sm-4"> Subject<span id="addNewSubject"><img src="assets/images/icon_new.png"> New </span></label><div class="col-sm-8"><select class="form-control" id="subject_id" name="subject">'+subjects_options+'</select></div></div><div class="form-group row d_chapter"><label for="" class="col-sm-4"> Chapter<span id="addNewChapter"><img src="assets/images/icon_new.png"> New </span></label><div class="col-sm-8"><select class="form-control" id="chapter_id" name="chapter">'+chapters_options+'</select></div></div><div class="form-group row"><label for="" class="col-sm-12"></label><div class="col-sm-6"><label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox1" value="1" name="with_question"> Duplicate With Question</label></div><div class="col-sm-6"><label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox2" value="1" name="without_question"> Without Question</label></div></div><div class="form-group row"><label for="" class="col-sm-12"></label><div class="col-sm-6 pull-right"><label class="checkbox-inline"><button type="button" class="btn btn-primary" id="duplicate">Duplicate</button></label></div></div>';
    
    $('.module_duplicate_append').append(html);

    if(moduleTypeId==1){
      $('.d_subject').show();
      $('.d_chapter').show(); 
    }else{
      $('.d_subject').hide();
      $('.d_chapter').hide(); 
    }

  });

  $(document).delegate('#select_module_type_duplicate', "change", function() {
     var mod_type = $(this).val();
     if(mod_type==1){
      $('.d_subject').show();
      $('.d_chapter').show(); 
     }else{
      $('.d_subject').hide();
      $('.d_chapter').hide(); 
     }
  });
//==================================
  

  $(document).delegate('#addNewSubject', "click", function() {
    $("#addSubjectModal").modal('show');
  });
  
  function saveSubject(){
      var subject_name = $('#subjectName').val();
  
      if(subject_name != ''){
        $.ajax({
        url: 'Module/addNewSubject',
        method: 'post',
        data: {
          subject_name: subject_name
        },
        success: function(data) {
          var subject = JSON.parse(data);
          
          var html = '<option class="subject'+subject['subject_id']+'" value="'+subject['subject_id']+'">'+subject['subject_name']+'</option>';
          $("#subject_id").append(html);
          $("#addSubjectModal").modal('hide');
        }
        });
      }else{
        alert('Please write subject name');
      }
  }

    $(document).delegate('#addNewChapter', "click", function() {
      $("#addChapterModal").modal('show');
    });

    function saveChapter(){
      var chapter_name = $('#chapterName').val();
      var subject_id = $('#subject_id').val();
   
      if(subject_id != ''){
      if(chapter_name != ''){
        $.ajax({
        url: 'Module/addNewChapter',
        method: 'post',
        data: {
          chapter_name: chapter_name,subject_id:subject_id
        },
        success: function(data) {
          var chapter = JSON.parse(data);
          
          var html = '<option class="chapter'+chapter['id']+'" value="'+chapter['id']+'">'+chapter['chapterName']+'</option>';
          $("#chapter_id").append(html);
          $("#addChapterModal").modal('hide');
        }
        });
      }else{
        alert('Please write subject name');
      }
    }else{
      alert('please Select Subject first');
    }
    }

    //==================================

  $(document).delegate('#duplicate', "click", function() {
    // alert('hello');
    var serialize = $('#moduleDuplicateForm').serialize();
    $.ajax({
      url: 'new_module_duplicate',
      method: 'post',
      data: serialize,
      success: function(data) {
        location.reload();
      }
    })
  });

  $('.deleteModule').click(function(e) {
    e.preventDefault();
    $('#moduleDelModal').modal('show');

    var href = $(this).attr('href');
    $('#moduleToDel').val(href);
  });

  $('#moduleDltBtn').click(function() {
    var href = $('#moduleToDel').val();
    window.location.href = href;
  });

  $(document).on('click', '#questionSetting', function() {
    $('.panel-box').toggle();
  });

  $(document).on('click', '#modTimeSetBtn', function() {
    var timeStart = $('#timeStart').val();
    var timeEnd = $('#timeEnd').val();
    var optTime = $('#optTime').val();
    $('#modStartTime').val(timeStart);
    $('#modEndTime').val(timeEnd);
    $('#modOptTime').val(optTime);
    console.log(timeStart);
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

  //set original module id on module duplicate modal
  $(document).on('click', '#modDuplicateIcon', function() {
    var origModId = $(this).closest('tr').attr('id');
    var origModStGrade = $(this).closest('tr').attr('studentGrade');


    var origModName = $(this).closest('tr').find('#modName a').html();
    console.log(origModName);
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
      var course_id = $("#course").val();
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
    // $('#moduleName').val('')
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
    $(document).on('click','.module_pg li a',function(e){
      e.preventDefault();
      var page_index = $(this).attr('data-ci-pagination-page');
      // alert(page_index);
      // var chk_next_prev = $(this).attr('rel');
      // if(chk_next_prev=='prev'){
      //   page_index = parseInt(page_index)-1;
      // }else if(chk_next_prev=='next'){
      //   page_index = parseInt(page_index)+1;
      // }
      // alert(page_index);
      get_all_module(page_index);
    })
    moduleSearchAll();
  })
</script>