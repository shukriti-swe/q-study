<style>
  .sign_up_menu ul {
    display: none !important;
  }
  
  .select2-container{
    display: initial;
  }

  .form-group{
    width:135px !important;
  }

  .search_filter{
    margin-left: 85px;
    margin-bottom: 0px; 
  }

  .abc{
    background-color: E3AB16 !important;
  }

  <?php  if (!empty($edit_has)) { ?>
  .ss_question_menu li a {
    color: #fff;
    text-decoration: none;
    height: 42px;
    width: 54px;
    text-align: center;
    line-height: 42px;
    font-size: 13px;
}
<?php  }else{ ?>
    .ss_question_menu li a {
      color: #fff;
      text-decoration: none;
      height: 42px;
      width: 35px;
      text-align: center;
      line-height: 42px;
      font-size: 13px;
  }
 <?php } ?>
 .question-list-header{
    color: #888;
    text-decoration: underline;
    margin-right: 20px;
  font-size: 18px;
 }
 
 .ss_q_list_top span{
     display: inline-block;
 }
 .ss_q_list_top input{
     display: inline-block;
     width:53%;
 }
 #search_vocubulary_word{
     display: inline-block;
 }
</style>

<div class="row"> 
  <?//php if($_SESSION['userType']== 7 ){?>
  <!-- <div class="col-md-12 upperbutton" style="text-align: center;margin-bottom: 10px;">
     <a href="all-module" style="font-size:20px;font-weight: bold;">Module Inbox</a>
  </div> -->
  <?//php }?>
    <div class="col-md-12 upperbutton" style="text-align: center;margin-bottom: 10px;">
      <a href="create-module" style="font-size:22px;color:#8e9295;text-decoration:underline;display: inline-block;">Module Inbox</a>
      <a href="details-module" style="font-size:22px;color:#8e9295;text-decoration:underline;display: inline-block;margin-left:10px;">Question Inbox</a>
    </div>
  <div class="col-md-4"></div>
  <div class="col-md-6">
    <div style=" margin-top: 2px;padding: 0 55px">
      <?php if ($subscription_type != 'data_input') { ?>
            <!--<a class="ss_q_link pull-left" href="q-dictionary/search">Q- Dictionary</a>
            <a style="color:#4BBCC0; background-color: #fff; font-size: 15px;" class="ss_q_link pull-left" href="subject/all">Delete Subject & Chapter</a> -->
      
       <a  class="pull-left question-list-header" href="q-dictionary/search">Q- Dictionary</a>
            <!-- <a  class="pull-left question-list-header" href="subject/all">Delete Subject & Chapter</a> -->
      <?php if($_SESSION['userType']== 7 ){?>
            <a  class="pull-left question-list-header" href="question-store">Question Store</a>
      <?php }?>
      <?php  } ?>

      
    </div>
  </div>
</div>

<div class="row" >
  <!-- <div class="col-sm-2"></div> -->
  <div class="col-sm-12 ">
    <?php if ($this->session->flashdata('success_msg')) : ?>
      <div class="alert alert-warning alert-dismissible fade in" role="alert"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <?php echo $this->session->flashdata('success_msg') ?>
      </div>
    <?php endif; ?>
    <div class="ss_q_list_top">

      <div class="ss_student_progress">
        <div class="search_filter">
          <form class="form-inline" method="post" action="question-list">
            <input type="hidden" name="list_submit" value="1">
            <div class="form-group">
              <label for="exampleInputName2">Module Name</label>
              <div class="select">
                <?php $modName = isset($_SESSION['modInfo']['moduleName']) ? $_SESSION['modInfo']['moduleName']:'';?>
                <input type="text" value="<?php echo $modName; ?>" class="form-control" name="moduleName" style="width:130px;" id="moduleName">
              </div>
            </div>
            
            <?php if ($_SESSION['userType']==7) : ?>                 
            <div class="form-group">
              <label for="exampleInputName2">Country</label>
               <div class="select">
                <?php $disabled = isset($_SESSION['selCountry'])||isset($_SESSION['modInfo']['country']) ? 'style="pointer-events:none;"' : '';
                  $selCountry = isset($_SESSION['modInfo']['country']) ? $_SESSION['modInfo']['country'] : (isset($_SESSION['selCountry']) ? $_SESSION['selCountry'] : '');
                ?>
                <select class="form-control" name="country" id="country" <?php echo $disabled; ?>>
                  <option value="">Select Country</option>
                  <?php foreach ($allCountry as $country) : ?>
                        <?php $sel = strlen($selCountry)&&($country['id']==$selCountry) ? 'selected' : ''; ?>
                    <option value="<?php echo $country['id'] ?>" <?php echo $sel; ?>><?php echo $country['countryName'] ?></option>
                    <?php endforeach ?>
                </select>
              </div>
            </div>
            <?php endif; ?>

            <div class="form-group">
              <label for="exampleInputName2">Grade/Year/Level</label>
              <div class="select">
                <select class="form-control select-hidden" name="grade">
                  <option value="">Select Grade/Year/Level</option>
                    <?php $grades = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; ?>
                    <?php foreach ($grades as $stGrade) { ?>
                        <?php $sel = isset($_SESSION['modInfo']['studentGrade'])&&($stGrade==$_SESSION['modInfo']['studentGrade']) ? 'selected' : '';?>
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
                <select class="form-control select-hidden" name="moduleType">
                  <option value="">Select....</option>
                    <?php foreach ($all_module_type as $module_type) {?>
                        <?php $sel = isset($_SESSION['modInfo']['moduleType'])&&($module_type['id']==$_SESSION['modInfo']['moduleType']) ? 'selected' : '';?>
                    <option value="<?php echo $module_type['id']?>" <?php echo $sel; ?>>
                        <?php echo $module_type['module_type'];?>
                    </option>
                    <?php }?>
                </select>

              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail2">Subject</label>
              <div class="select">
                <select class="form-control select-hidden" id="subject" name="subject">
                  <option value="">Select....</option>
                    <?php foreach ($all_subject as $subject) {?>
                        <?php $sel = isset($_SESSION['modInfo']['subject'])&&($subject['subject_id']==$_SESSION['modInfo']['subject']) ? 'selected' : '';?>
                    <option value="<?php echo $subject['subject_id']?>" <?php echo $sel; ?>>
                        <?php echo $subject['subject_name'];?>
                    </option>
                    <?php }?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail2">Chapter</label>
              <div class="select">
                <select class="form-control select-hidden" name="chapter" id="chapter">
                  <option value="">Select....</option>
                    <?php if (isset($_SESSION['modInfo']['chapter'])) : ?>
                        <?php echo $_SESSION['modInfo']['chapter']; ?>
                    <?php endif; ?>
                </select>
              </div>
            </div>

            <?php if ($_SESSION['userType']==7) : ?>     
            <div class="form-group">
              <label for="exampleInputEmail2">Course</label>
              <div class="select">
                <select class="form-control select-hidden" id="course" name="course">
                  <option value="">Select....</option>
                  <?php foreach ($all_course as $course) {?>
                        <?php $sel = isset($_SESSION['modInfo']['course'])&&($course['id']==$_SESSION['modInfo']['course']) ? 'selected' : '';?>
                    <option value="<?php echo $course['id']?>" <?php echo $sel; ?>>
                        <?php echo $course['courseName'];?>
                    </option>
                    <?php }?>
                </select>
              </div>
            </div>
            <?php endif; ?>
            
            <div class="form-group"  style="width:0px !important">
              <button type="submit" class="btn btn-primary" style="margin-top:20px !important">search</button>
            </div>
          </form>

        </div>

        <div class="row ss_q_list_top">
          <div class="col-md-5" id="">
              <span>Quiz</span>    
              <?php if($_SESSION['userType']== 7 ){?>
                  <input type="text" name="search" id="search" class="form-control search_input">
                  <button class="btn btn-primary" type="button" id="search_vocubulary_word">Search</button>
              <?php }?>
          </div>
          <div  class="col-md-6" id="search_vocubulary_list">
          </div>
        </div>

      </div>

    </div>
    <div class="ss_question_list">
     <!--  <ul class="add_duplicate"> </ul> -->
     <?php  if (!empty($edit_has)) { ?>
        <?php foreach ($all_question_type as $key) { $a = $key["id"]; 
          if($a!=5 || $a!=7 || $a!=8 || $a!=9){
          ?>

        <div class="row">
          <div class="col-sm-3">
            <ul class="ss_q_left"> 
              <li>
                <a href="<?php echo base_url();?>create-question/<?=$key['id']?>"><?php echo $key['questionType'];?></a>
              </li>
            </ul>
          </div>

          <div class="col-sm-9">

          
              <ul class="ss_question_menu" id="quesType_<?php echo $key['id'];?>">
              <?php $i = 1; $b =1;
              
              foreach ($all_question[$key['id']] as $row) {

                // print_r($key['id']); echo "string"; print_r($row['id']); 

                  $color = $row['dictionary_item']?'#ED1C24':'';?>

                <li class="main_li" style="background-color: <?php echo $color; ?>

                <?php if ($i > 5) { ?>;

                  display: none;<?php }?>" data-id="<?=$key['id']?>_<?=$row['id']?>" id="q_<?=$i?>_<?=$key['id']?>" >
                  <a href="question_edit/<?=$key['id']?>/<?=$row['id']?>">Q<?=$i?></a>

                </li> 
                    <?php $i++; }
                    
                    if (!empty($old_ques_order)) { ?>
                     

                      <?php

                      foreach ($old_ques_order as $key2 => $val) {

                        foreach ($val as $key2 => $val3) {  ?>

                         <?php if ($a == $val3["question_type"] ) { ?>

                            <div class="add_duplicated_<?php echo $val3["question_type"]; echo "_"; echo $b; ?>" ></div>

                            <li class="abc" <?php if ($b >5) { ?> style="display: none; <?php } ?>" style="background-color:#E3AB16;" datas-id="<?=$a ?>_<?=$val3['id']?>" id="q1_<?=$b?>_<?=$key['id']?>"> 
                              <a href="question_edit/<?=$a?>/<?=$val3['id']?>" style="position: relative;">Q<?=($val3["order"]+1); ?> <span style="left:0; color: red;position: absolute;top:-27px; font-size: 12px; width: 100%;"><?php echo $b; ?></span></a> 
                             </li>
                            </li>
                          <?php $b++;
                          }
                        }

                        $b =1;

                      }
                    }

                     ?>

                <li class="ss_q_u_d" <?php if ($i < 6) {
                    ?>style="display: none;"<?php }?> >
                  <a id="upbutton_<?=$key['id']?>" onclick="fn_show_upper(1, <?=$key['id']?>,<?=$i-1?>)">
                    <i class="fa fa-caret-up" aria-hidden="true"></i>
                  </a>
                  <span id="spinner_val_<?=$key['id']?>">1[<?php echo $i-1;?>]</span>
                  <a id="downbutton_6" onclick="fn_show_upper(0, <?=$key['id']?>, <?=$i-1?> )">
                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                  </a>
                </li>
                <?php if ($i > 5) {?>
                  <li class="ss_q_last" data-id="<?=$key['id']?>_<?=$row['id']?>" id="q_<?=$i?>_<?=$key['id']?>">
                    <a href="question_edit/<?=$key['id']?>/<?=$row['id']?>">Q<?=$i-1?></a>
                  </li>
                  <li class="ss_q_total">
                    <a onclick="lastTenquestion(<?=$key['id']?>,<?=$i-1?>)" >Q<?=$i-1?></a>
                  </li>
                <?php }?>
              </ul>
      

            </div>
          </div>

        <?php } }?>
      <?php }else {
        
        ?>
        <?php foreach ($all_question_type as $key) { $a = $key["id"]; 
          if($key['id'] !=5 && $key['id'] !=7 && $key['id'] !=8 && $key['id'] !=9){

          ?>
          <?php if($key['id'] != 12){?>
        <div class="row">
          <div class="col-sm-3">
            <ul class="ss_q_left">  
              <li>
                
                <a href="<?php echo base_url();?>create-question/<?=$key['id']?>"><?php echo $key['questionType'];?></a>
                
              </li>
            </ul>
          </div>

          <div class="col-sm-9">

          
              <ul class="ss_question_menu" id="quesType_<?php echo $key['id'];?>">
              <?php $i = 1; $b =1;
              //////////////// echo "<pre>";print_r($all_question[3]);die();
              foreach ($all_question[$key['id']] as $row) {
                $permission_check_id = $row['id'];
                $qus_check = $this->db->where('qustion_id',$permission_check_id)->get('send_qustion_by_tutor')->result_array();

                // print_r($key['id']); echo "string"; print_r($row['id']); 

                  $color = $row['dictionary_item']?'#ED1C24':';';?>

                <li class="main_li" style="background-color: <?php echo $color; ?><?=(count($qus_check) > 0) ? "background:blue" : "";?>

                <?php if ($i > 10) { ?>;

                  display: none;<?php }?>" data-id="<?=$key['id']?>_<?=$row['id']?>" id="q_<?=$i?>_<?=$key['id']?>" >
                  <a href="question_edit/<?=$key['id']?>/<?=$row['id']?>">Q<?=$i?></a>

                </li> 
                    <?php $i++; }
                    
                    if (!empty($old_ques_order)) { ?>
                     

                      <?php

                      foreach ($old_ques_order as $key2 => $val) {

                        foreach ($val as $key2 => $val3) {  ?>

                         <?php if ($a == $val3["question_type"] ) { ?>

                            <div class="add_duplicated_<?php echo $val3["question_type"]; echo "_"; echo $b; ?>" ></div>

                            <li class="abc" <?php if ($b >10) { ?> style="display: none; <?php } ?>" style="background-color:#E3AB16;" datas-id="<?=$a ?>_<?=$val3['id']?>" id="q1_<?=$b?>_<?=$key['id']?>"> 
                              <a href="question_edit/<?=$a?>/<?=$val3['id']?>" style="position: relative;">Q<?=($val3["order"]+1); ?> <span style="left:0; color: red;position: absolute;top:-27px; font-size: 12px; width: 100%;"><?php echo $b; ?></span></a> 
                             </li>
                            </li>
                          <?php $b++;
                          }
                        }

                        $b =1;

                      }
                    }

                     ?>

                <li class="ss_q_u_d" <?php if ($i < 11) {
                    ?>style="display: none;"<?php }?> >
                  <a id="upbutton_<?=$key['id']?>" onclick="fn_show_upper(1, <?=$key['id']?>,<?=$i-1?>)">
                    <i class="fa fa-caret-up" aria-hidden="true"></i>
                  </a>
                  <span id="spinner_val_<?=$key['id']?>">1[<?php echo $i-1;?>]</span>
                  <a id="downbutton_6" onclick="fn_show_upper(0, <?=$key['id']?>, <?=$i-1?> )">
                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                  </a>
                </li>
                <?php if ($i > 10) {?>
                  <li class="ss_q_last" data-id="<?=$key['id']?>_<?=$row['id']?>" id="q_<?=$i?>_<?=$key['id']?>">
                    <a href="question_edit/<?=$key['id']?>/<?=$row['id']?>">Q<?=$i-1?></a>
                  </li>
                  <li class="ss_q_total">
                    <a onclick="lastTenquestion(<?=$key['id']?>,<?=$i-1?>)" >Q<?=$i-1?></a>
                  </li>
                <?php }?>
              </ul>
      

            </div>
          </div>
          <?php }?>
        <?php } }?>
    <?php  } ?>  
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
          <input type="password" id="qPassword" class="form-control"  placeholder="Enter your q-study password">
          <div id="qPasswordErr" style="color: red;font-weight: 800"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn_blue" onclick="qPassword()">Submit</button>        
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    // qstudyPassword
        var li_item__;
        var qType_qId___;
  </script>

  <?php  if (!empty($edit_has)) { ?>

   <script>
    function fn_show_upper(aval, acat, acount){
      var vspinnerval = $("#spinner_val_" + acat +"").html();
      var spinnerval = vspinnerval.substr(0, vspinnerval.indexOf('['));

      var vinterval = acount / 5;
      vinterval = Math.round(vinterval);

      var vmod = acount % 5;

      if (aval == 1) {
        spinnerval++;
      } else {
        spinnerval--;
      }
      if (spinnerval < 1) {
        spinnerval = 1;
      }
      if (spinnerval > 500) {
        spinnerval = 500;
      }

      var vr = Math.round(6 / 6);
      var vd = 6 % 6;


      if (vmod == 0){
        vinterval = vinterval;
      } else {
        if (vmod >= 5){
          vinterval = vinterval;
        } else {
          vinterval = vinterval + 1;
        }
      }
      if (spinnerval > vinterval) {
        spinnerval = vinterval;
      }

        //alert(vmod);

        $("#spinner_val_" + acat +"").html(spinnerval + '[' + acount + ']');

        for (var i=1;i <= acount;i++) {
          $("#q_" + i + "_" + acat).hide();
          $("#q1_" + i + "_" + acat).hide();
        }

        if (spinnerval == 1) {
          for (var i=1;i <= 5;i++){
            $("#q_" + i + "_" + acat).show();
            $("#q1_" + i + "_" + acat).show();
          }
        } else {
          var vstart = 5 * spinnerval;
          vstart = (vstart - 5) + 1;

          for (var i = vstart;i <= (5 * spinnerval);i++) {
            $("#q_" + i + "_" + acat).show();
            $("#q1_" + i + "_" + acat).show();
          }
        }
      }

      function lastTenquestion(acat, acount){
        var vinterval = acount / 5;
        vinterval = Math.ceil(vinterval) - 1;
        $("#spinner_val_" + acat +"").html(vinterval + '[' + acount + ']');
        fn_show_upper(1,acat, acount);
      }
    </script>

  <?php  } ?>

  <?php  if (empty($edit_has)) { ?>

  <script>
    function fn_show_upper(aval, acat, acount){
      var vspinnerval = $("#spinner_val_" + acat +"").html();
      var spinnerval = vspinnerval.substr(0, vspinnerval.indexOf('['));

      var vinterval = acount / 10;
      vinterval = Math.round(vinterval);

      var vmod = acount % 10;

      if (aval == 1) {
        spinnerval++;
      } else {
        spinnerval--;
      }
      if (spinnerval < 1) {
        spinnerval = 1;
      }
      if (spinnerval > 500) {
        spinnerval = 500;
      }

      var vr = Math.round(10 / 10);
      var vd = 10 % 10;


      if (vmod == 0){
        vinterval = vinterval;
      } else {
        if (vmod >= 5){
          vinterval = vinterval;
        } else {
          vinterval = vinterval + 1;
        }
      }
      if (spinnerval > vinterval) {
        spinnerval = vinterval;
      }

        //alert(vmod);

        $("#spinner_val_" + acat +"").html(spinnerval + '[' + acount + ']');

        for (var i=1;i <= acount;i++) {
          $("#q_" + i + "_" + acat).hide();
          $("#q1_" + i + "_" + acat).hide();
        }

        if (spinnerval == 1) {
          for (var i=1;i <= 10;i++){
            $("#q_" + i + "_" + acat).show();
            $("#q1_" + i + "_" + acat).show();
          }
        } else {
          var vstart = 10 * spinnerval;
          vstart = (vstart - 10) + 1;

          for (var i = vstart;i <= (10 * spinnerval);i++) {
            $("#q_" + i + "_" + acat).show();
            $("#q1_" + i + "_" + acat).show();
          }
        }
      }

      function lastTenquestion(acat, acount){
        var vinterval = acount / 9;
        vinterval = Math.ceil(vinterval) - 1;
        $("#spinner_val_" + acat +"").html(vinterval + '[' + acount + ']');
        fn_show_upper(1,acat, acount);
      }
    </script>

  <?php  } ?>



    <?php  if (!empty($edit_has)) { ?>
      <script type="text/javascript">
        for (var i = 1; i <= 12; i++) {
          $('#quesType_'+i).contextMenu({
            selector: 'li.abc', 
            callback: function(key, options) {
               // qstudyPassword
             var li_item = $(this);
             li_item__ = $(this);
             var qType_qId = $(this).attr('data-id');
             qType_qId___ = $(this).attr('data-id');
              // console.log(qType_qId);
              temp = qType_qId.split('_');
              // console.log(temp);
              qId = temp[1];
              qType = temp[0]
              // console.log(qType);
              var user_id = <?php print_r($user_id); ?>;
              if(key=='preview'){
                window.location.href = "question_preview/"+qType+"/"+qId;
              }else if(key=='delete'){

                <?php  if ($user_info[0]['user_type'] ==7 ) { ?>
                  $('#ss_info_sucesss').modal('show');
                <?php }else{ ?>

                  // qstudyPassword
      
                $.ajax({
                  url: "question_delete/"+qId,
                  method : 'POST',
                  success: function(data){
                    if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                    else{ alert('Somethings wrong.'); }
                  }
                })

                <?php } ?>

              }else if(key=='duplicate'){
               $.ajax({
                url:"<?php echo base_url(); ?>question_duplicate",
                method : 'POST',
                data:{qId:qId , user_id:user_id },
                success: function(data){
                  
                  data = JSON.parse(data);


                  $(".add_duplicated_"+data[0]["questionType"]+"_1").append("<div> "+data[0]["element"]+"</div>");
                    // alert('Question duplicated successfully.');
    
                  
                 //  if(data=='true'){
                 //   // alert('Question duplicated successfully.');
                 //   // location.reload();
                 //   }
                 //  else{
                 // alert('Somethings wrong.');
                 //  }
                }
              })
             }else if(key=='send_to_qStudy'){
               $.ajax({
                url:"<?php echo base_url(); ?>send_to_qStudy",
                method : 'POST',
                data:{qId:qId , user_id:user_id },
                success: function(data){

                  alert('Question Send Successfully.'); location.reload();
                  
                }
              })
             }
           },
           items: {
          "preview": {name: "Preview", icon: "fa-eye"},
          <?php if ($subscription_type != 'data_input') { ?>
            "delete": {name: "Delete", icon: "cut"},
          <?php  } ?>
          "duplicate": {name: "Duplicate", icon: "copy"},
          <?php if ($tutor_permission_check->tutor_permission == 1) { ?>
            "send_to_qStudy": {name: "Send To Q-Study", icon: "fa-paper-plane"},
          <?php  } ?>
        }

        });

        }
      </script>
      <script>
      //get chapter on subject change
      $(document).on('change', '#subject', function(){
        var subject = $(this).val();
        $.ajax({
          url:'Tutor/get_chapter_name',
          method:'post',
          data:{'subject_id':subject},
          success: function(response){
            $('#chapter').html(response);
          }
        })
      });
    </script>
    <?php }else{ ?>

      <script type="text/javascript">
        /*context menu (right click on question menu)*/
      
      for (var i = 1; i <= 22; i++) {
       
      if( i !=12) {
        if( i !=13) {
        if($('#quesType_'+i).length){
        $('#quesType_'+i).contextMenu({
          selector: 'li.main_li', 
          callback: function(key, options) {
            // qstudyPassword
            var li_item = $(this);
             li_item__ = $(this);
            var qType_qId = $(this).attr('data-id');
             qType_qId___ = $(this).attr('data-id');
            // console.log(qType_qId);
            temp = qType_qId.split('_');
            // console.log(temp);
            qId = temp[1];
            qType = temp[0]
            // console.log(qType);
            var user_id = <?php print_r($user_id); ?>;
            if(key=='preview'){
              window.location.href = "question_preview/"+qType+"/"+qId;
            }else if(key=='delete'){

              <?php  if ($user_info[0]['user_type'] ==7 ) { ?>

                  <?php if(count($checkNullPw) == 0) { ?>
                 
                    $.ajax({
                      url: "question_delete/"+qId,
                      method : 'POST',
                      success: function(data){
                        if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                        else{ alert('Somethings wrong.'); }
                      }
                    })
                  <?php }else{ ?>
                    $('#ss_info_sucesss').modal('show');
                  <?php } ?>
                <?php }else{ ?>

                  // qstudyPassword
           
                $.ajax({
                  url: "question_delete/"+qId,
                  method : 'POST',
                  success: function(data){
                    if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                    else{ alert('Somethings wrong.'); }
                  }
                })

                <?php } ?>

            }else if(key=='duplicate'){
             $.ajax({
              url:"<?php echo base_url(); ?>question_duplicate",
              method : 'POST',
              data:{qId:qId , user_id:user_id },
              success: function(data){

                alert('Question duplicated successfully.'); location.reload();
                
                // data = JSON.parse(data);


                // $(".add_duplicated_"+data[0]["questionType"]+"_1").append("<div> "+data[0]["element"]+"</div>");
                  // alert('Question duplicated successfully.');
  
                
               //  if(data=='true'){
               //   // alert('Question duplicated successfully.');
               //   // location.reload();
               //   }
               //  else{
               // alert('Somethings wrong.');
               //  }
              }
            })
           }else if(key=='send_to_qStudy'){
             $.ajax({
              url:"<?php echo base_url(); ?>send_to_qStudy",
              method : 'POST',
              data:{qId:qId , user_id:user_id },
              success: function(data){

                alert('Question Send Successfully.'); location.reload();
                
              }
            })
           }
         },
         items: {
          "preview": {name: "Preview", icon: "fa-eye"},
          <?php if ($subscription_type != 'data_input') { ?>
            "delete": {name: "Delete", icon: "cut"},
          <?php  } ?>
          "duplicate": {name: "Duplicate", icon: "copy"},
          <?php if ($tutor_permission_check->tutor_permission == 1) { ?>
            "send_to_qStudy": {name: "Send To Q-Study", icon: "fa-paper-plane"},
          <?php  } ?>
        }
        

      });
    }
    }
    }
      }
      </script>
      <script>
      //get chapter on subject change
      $(document).on('change', '#subject', function(){
        var subject = $(this).val();
        $.ajax({
          url:'Tutor/get_chapter_name',
          method:'post',
          data:{'subject_id':subject},
          success: function(response){
            $('#chapter').html(response);
          }
        })
      });
    </script>

  <?php  } ?>

  <!-- qstudyPassword -->


  <script type="text/javascript">
    function qPassword() {
      var qPassword = $("#qPassword").val();
      if (qPassword == '') {
        $("#qPasswordErr").html("Please Input Password");
        return false;
      }else{
        $("#qPasswordErr").html("")
      }
      $.ajax({
        url:'Tutor/qstudyPassword/'+qPassword,
        method:'GET',
        success: function(response){
          if (response == 0) {
            $("#qPasswordErr").html("Wrong Password")
          }
          else{
            deleteQuestion()
            $("#qPasswordErr").html("")
            $("#ss_info_sucesss").modal("toggle")
            
          }
        }
      })

    }


    function deleteQuestion() {
             console.log(qType_qId___)
             console.log(li_item__)
              temp = qType_qId___.split('_');
              // console.log(temp);
              qId = temp[1];
              qType = temp[0]
              // console.log(qType);
              var user_id = <?php print_r($user_id); ?>;
          

      $.ajax({
          url: "question_delete/"+qId,
          method : 'POST',
          success: function(data){
            if(data=='true'){ alert('Question deleted successfully.'); li_item__.fadeOut("slow"); }
            else{ alert('Somethings wrong.'); }
          }
        })
    }
    
     $(document).ready(function(){
        $('#search_vocubulary_word').click(function(){
            var search = $('#search').val();
            $.ajax({
              url: "Tutor/search_vocubulary_word",
              method : 'POST', 
              data:{'search':search},
              success: function(data){
                $('#search_vocubulary_list').html(data);
                
                $('#v_quesType_3').contextMenu({
                      selector: 'li.main_li', 
                      callback: function(key, options) {
                        // qstudyPassword
                        var li_item = $(this);
                         li_item__ = $(this);
                        var qType_qId = $(this).attr('datas-id');
                         qType_qId___ = $(this).attr('datas-id');
                        //console.log(qType_qId);
                        temp = qType_qId.split('_');
                        // console.log(temp);
                        qId = temp[1];
                        qType = temp[0]
                        // console.log(qType);
                        var user_id = <?php print_r($user_id); ?>;
                        if(key=='preview'){
                          window.location.href = "question_preview/"+qType+"/"+qId;
                        }else if(key=='delete'){
                          <?php  if ($user_info[0]['user_type'] ==7 ) { ?>
                              <?php if(count($checkNullPw) == 0) { ?>
                             
                                $.ajax({
                                  url: "question_delete/"+qId,
                                  method : 'POST',
                                  success: function(data){
                                    if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                                    else{ alert('Somethings wrong.'); }
                                  }
                                })
                              <?php }else{ ?>
                                $('#ss_info_sucesss').modal('show');
                              <?php } ?>
                            <?php }else{ ?>
                              // qstudyPassword
                              
                            $.ajax({
                              url: "question_delete/"+qId,
                              method : 'POST',
                              success: function(data){
                                if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                                else{ alert('Somethings wrong.'); }
                              }
                            })
            
                            <?php } ?>
            
                        }else if(key=='duplicate'){
                         $.ajax({
                          url:"<?php echo base_url(); ?>question_duplicate",
                          method : 'POST',
                          data:{qId:qId , user_id:user_id },
                          success: function(data){
                            alert('Question duplicated successfully.'); location.reload();
                          }
                        })
                       }else if(key=='send_to_qStudy'){
                         $.ajax({
                          url:"<?php echo base_url(); ?>send_to_qStudy",
                          method : 'POST',
                          data:{qId:qId , user_id:user_id },
                          success: function(data){
                            alert('Question Send Successfully.'); location.reload();
                          }
                        })
                       }
                     },
                     items: {
                      "preview": {name: "Preview", icon: "fa-eye"},
                      <?php if ($subscription_type != 'data_input') { ?>
                        "delete": {name: "Delete", icon: "cut"},
                      <?php  } ?>
                      "duplicate": {name: "Duplicate", icon: "copy"},
                      <?php if ($tutor_permission_check->tutor_permission == 1) { ?>
                        "send_to_qStudy": {name: "Send To Q-Study", icon: "fa-paper-plane"},
                      <?php  } ?>
                    }
            
                  });
              }
            })
        })
        
        
    })
  </script>
