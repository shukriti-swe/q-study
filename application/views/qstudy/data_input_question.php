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
</style>

<div class="row"> 
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <div style="float: right;margin-right: 0px; margin-top: 20px;">
            <a class="ss_q_link pull-left" href="q-dictionary/search">Q- Dictionary</a>
            <a style="color:#4BBCC0; background-color: #fff; font-size: 15px;" class="ss_q_link pull-left" href="subject/all">Delete Subject & Chapter</a>
      

      
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
          <span>Quiz</span>    
        </div>

      </div>

    </div>
    <div class="ss_question_list">
     <!--  <ul class="add_duplicate"> </ul> -->
        <?php foreach ($all_question_type as $key) { $a = $key["id"]; ?>
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
              foreach ($key['all_question']  as $row) {

                // print_r($key['id']); echo "string"; print_r($row['id']); 

                  
                  $color = "#7f7f7f";?>


                <li class="main_li" style="background-color: <?php echo $color; ?>

                <?php if ($i > 5) { ?>;

                  display: none;<?php }?>" data-id="<?=$key['id']?>_<?=$row['tbl_question_id']?>" id="q_<?=$i?>_<?=$key['id']?>" >
                  <a href="question_edit/<?=$key['id']?>/<?=$row['tbl_question_id']?>">Q<?=$i?></a>

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
                  <li class="ss_q_last" data-id="<?=$key['id']?>_<?=$row['tbl_question_id']?>" id="q_<?=$i?>_<?=$key['id']?>">
                    <a href="question_edit/<?=$key['id']?>/<?=$row['tbl_question_id']?>">Q<?=$i-1?></a>
                  </li>
                  <li class="ss_q_total">
                    <a onclick="lastTenquestion(<?=$key['id']?>,<?=$i-1?>)" >Q<?=$i-1?></a>
                  </li>
                <?php }?>
              </ul>
      

            </div>
          </div>

        <?php }?>
      </div>
    </div>

  </div>

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

      <script type="text/javascript">
        /*context menu (right click on question menu)*/
      

      for (var i = 1; i <= 16; i++) {
			if(i != 13 ) {
        $('#quesType_'+i).contextMenu({
          selector: 'li.main_li', 
          callback: function(key, options) {
            var li_item = $(this);
            var qType_qId = $(this).attr('data-id');
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

              $.ajax({
                url: "question_delete/"+qId,
                method : 'POST',
                success: function(data){
                  if(data=='true'){ alert('Question deleted successfully.'); li_item.fadeOut("slow"); }
                  else{ alert('Somethings wrong.'); }
                }
              })

            }else if(key='duplicate'){
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
           }
         },
         items: {
          "preview": {name: "Preview", icon: "fa-eye"},
            "delete": {name: "Delete", icon: "cut"},
          
          "duplicate": {name: "Duplicate", icon: "copy"},
        }

      });
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

    
