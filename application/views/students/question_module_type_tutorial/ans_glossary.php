<script src="<?php echo base_url(); ?>assets/ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>

<style type="text/css">
  .ss_q_btn {
    margin-top: 21px;
  }

  .checkbox,
  .form-group {
    display: block !important;
    margin-bottom: 10px !important;
  }

  .form-control {
    width: 100% !important;
  }

  .createQuesLabel {
    margin-top: 5px;
  }

  .select2-container .select2-selection--single {
    height: 33px;
    margin-top: 6px;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 30px;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px;
  }

  .question_tutorial:hover {
    background: transparent !important;
  }

  .sss_ans_set {
    position: absolute;
    bottom: -158px;
    width: 30%;
    margin-top: 16px;
  }

  .created_name {
    background: #66afe9;
    color: #fff;
    font-size: 16px;
    padding: 10px 20px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
  }

  .created_name a {
    color: #fff;
  }

  .created_name img {
    max-width: 30px;
    margin-right: 10px;
  }

  .flex-end {
    justify-content: flex-end;
  }

  .d-flex {
    display: flex;
  }

  .w-50 {
    width: 50px !important;
  }

  .idea_setting_mid_bottom {
    margin-top: 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: flex-end;
    flex-wrap: wrap;
  }

  .ss_question_add_top {
    flex-wrap: wrap;
    display: flex;
    align-items: end;
    justify-content: center;
  }

  .ss_question_add_top label,
  .idea_setting_mid label,
  .idea_setting_mid_bottom label {
    margin-bottom: 6px;
  }

  .idea_setting_mid {
    margin-top: 20px;
    display: flex;
    align-items: flex-end;
    flex-wrap: wrap;
  }

  .ss_q_btn {
    margin-top: 22px;
    margin-bottom: 10px;
  }

  .btn-select {
    background: #a9a8a8;
    color: #fff;
    box-shadow: none !important;
    border-radius: 0;
  }

  .btn-select:hover,
  .btn-select.active {
    background: #00a2e8;
    color: #fff;
  }

  .btn-select-border {
    background: #fff;
    color: #000;
    box-shadow: none !important;
    border-radius: 0;
    border: 1px solid #ddd9c3;
  }

  .btn-select-border:hover,
  .btn-select-border.active {
    background: #ddd9c3;
    color: #fff;
  }

  .idea_setting_mid_bottom .btn-select:hover,
  .idea_setting_mid_bottom .btn-select.active {
    background: #ff7f27;
    color: #fff;
  }

  .top_word_limt {
    background: #d9edf7;
    padding: 8px 10px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
  }

  .m-auto {
    margin-left: auto;
  }

  .b-btn {
    background: #9c4d9e;
    padding: 5px 10px;
    border-radius: 5px;
    color: #fff;
  }

  .btm_word_limt .content_box_word {
    border-radius: 5px;
    border: 1px solid #82bae6;
    margin: 10px 0;
    padding: 10px;
    width: 100%;
    box-shadow: 0px 0px 10px #d9edf7;
  }

  .btm_word_limt .content_box_word u {
    color: #888;
  }

  .btm_word_limt .content_box_word span {
    color: #888;
  }

  .btm_word_limt .content_box_word p {
    margin-top: 10px;
  }

  #shot_question .modal-content,
  .ss_modal .modal-content {
    border: 1px solid #a6c9e2;
    padding: 5px;
  }

  .ss_modal .form-group label {
    margin-bottom: 5px;
  }

  .ss_modal .modal-dialog {
    max-width: 100%;
  }

  .ss_modal .form-group input {
    height: 34px;
  }

  .ss_modal .modal-header {
    background: url(assets/images/login_bg.png) repeat-x;
    color: #fff;
    padding: 0;
    border-radius: 5px;
  }

  #advance_searc_op {
    cursor: pointer;
  }

  #advance_searc_content {
    display: none;
  }

  .content_box_word {
    min-height: 300px;
  }

  .serach_list .input-group {
    width: 100%;
  }

  .d-flex {
    display: flex;
    align-items: center;
  }

  .ss_modal .form-group {
    width: 100%;
  }

  #checkbox_titlelimit_alert,
  #checkbox_titlelimitidea_alert {
    display: none;
  }

  #checkbox_titlelimit_alert>div,
  #checkbox_titlelimitidea_alert>div {
    flex-wrap: wrap;
    align-items: center;
    padding: 15px 0px;
    color: #ff0000;
    display: flex;
    justify-content: flex-end;
  }

  #checkbox_titlelimit_alert,
  #checkbox_titlelimit_large_alert {
    display: none;
  }

  #checkbox_titlelimit_alert>div,
  #checkbox_titlelimit_large_alert>div {
    flex-wrap: wrap;
    align-items: center;
    padding: 15px 0px;
    color: #ff0000;
    display: flex;
    justify-content: flex-end;
  }

  #shot_question_details {
    overflow: auto;
  }

  #shot_question_details .col-sm-4 {
    width: 100%;
  }

  #shot_question_details.ss_modal .modal-dialog {
    margin-top: 6%;
  }

  .color_list {
    display: flex;
  }

  .color_list .color_choose {
    position: relative;

  }

  .color_list .color_choose .color_set {
    position: relative;
    height: 20px;
    margin: 2px;
    width: 20px;
    cursor: pointer;
  }

  .color_list .color_choose input {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    opacity: 0;

  }

  .hint_color_list {
    display: flex;
  }

  .hint_color_list .hint_color_choose {
    position: relative;

  }

  .hint_color_list .hint_color_choose .hint_color_set {
    position: relative;
    height: 20px;
    margin: 2px;
    width: 20px;
    cursor: pointer;
  }

  .hint_color_list .hint_color_choose input {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
  }

  .hint_color_list .hint_chosen_color {
    position: relative;

  }

  .hint_color_list .hint_chosen_color .hint_color_set {
    position: relative;
    height: 20px;
    margin: 2px;
    width: 20px;
    cursor: pointer;
  }

  .hint_color_list .hint_chosen_color input {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
  }

  .round_box {
    margin-top: 10px;
    height: 17px;
    width: 30px;
    border: 2px solid #27baf1;
    border-radius: 40%;
  }

  .hint_box {
    color: #000;
    font-size: 30px;
    margin-left: 4%;
  }

  .comprehension_image {
    height: 40px;
    width: 40px;
  }

  .com_hint_image {
    /* margin-left: 20px; */
    height: 38px;
    width: 35px;
  }

  .com_option_image {
    margin-left: 10px;
    height: 38px;
    width: 35px;
  }

  .customcheckbox {
    display: block;
    margin-top: 7px;
    position: relative;
    padding-left: 55px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }


  .customcheckbox input {
    position: absolute;

    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
  }

  .customcheckbox .checkmark {
    position: absolute;
    border: 2px solid #2196F3;
    top: 0;
    left: 0;
    height: 25px;
    text-align: center;
    width: 45px;
    border-radius: 20px;
    background-color: #fff;
  }


  .customcheckbox:hover input~.checkmark {
    background-color: #2196F3;
  }


  .customcheckbox input:checked~.checkmark {
    background-color: #2196F3;
  }


  .customcheckbox .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }


  .customcheckbox input:checked~.checkmark:after {
    display: block;
  }
  .add_hint_question {
    /* margin-left: 20px; */
    height: 25px;
    width: 25px;
    cursor: pointer;
  }

  .set_color_section{
    display:flex;
    justify-content: center;
    max-width: 400px;
    margin: 20px auto;
    gap:10px;
  }
  .set_color_list{
    border:1px solid #c3c3c3;
  }
  .hint_selection_content{
    border:1px solid #c3c3c3;
    margin: 20px 0px;
    padding: 10px;
    word-break: break-all;
  }
  .btn-sm {
    padding: 1px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
    text-align: center;
  }
  .sugg_box{
    padding-top: 14px;
    display: block;
    width: 150px;
   }
   .image-editor{
      height:150px;
   }

   .row-eq-height {
   display: -webkit-box;
   display: -webkit-flex;
   display: -ms-flexbox;
   display:         flex;
   }
   .two_hint_wrap , .one_hint_wrap{
     display: inline;
     position: relative;
   }
   .tooltip_rs{
      position: absolute;
    background: #00a2e8;
    z-index: 10;
    padding: 5px 10px 5px 10px;
    color: #fff;
    right: 0;
    width: 80%;
    max-width: 250px;
    height: fit-content;
    top:0;
   }
   .tooltip_rs::after {
      width: 0;
      height: 0;
      border-left: 5px solid transparent;
      border-right: 5px solid transparent;
      border-top: 50px solid #00a2e8;
      content: '';
      position: absolute;
      top: -14px;
      left: -30px;
      transform: rotate(90deg);
   }
   .all_options{
      margin-top:5px;
      margin-left:5px;
   }

</style>

<?php 
foreach ($total_question as $ind) {

if ($ind["question_type"] == 14) {
  $chk = $ind["question_order"];
 }

} 
  ?>

<?php

    //$answerCount = count(json_decode($question_info_s[0]['answer']));
    // echo "<pre>";print_r($answerCount);die();

    $question_order_array = array_column($total_question, 'question_order');
    $last_question_order = end($question_order_array);

    $key = $question_info_s[0]['question_order'];
    date_default_timezone_set($this->site_user_data['zone_name']);
    $module_time = time();
    
if ($tutorial_ans_info) {
    $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'], true);
    $desired = $temp_table_ans_info;
} else {
    $desired = $this->session->userdata('data');
}

      // Question Time

    $question_time = explode(':', $question_info_s[0]['questionTime']);
    $hour = 0;
    $minute = 0;
    $second = 0;
if (is_numeric($question_time[0])) {
    $hour = $question_time[0];
} if (is_numeric($question_time[1])) {
    $minute = $question_time[1];
} if (is_numeric($question_time[2])) {
    $second = $question_time[2];
}

$question_time_in_second = 0;
$question_time_in_second = ($hour * 3600) + ($minute * 60) + $second ;
$moduleOptionalTime = 0;
if ($question_info_s[0]['moduleType'] == 2 && $question_info_s[0]['optionalTime'] != 0)
{
    $moduleOptionalTime = $question_info_s[0]['optionalTime'];
}

$passTime = time() - $_SESSION['exam_start'] ;
$setTime = 0;
if($moduleOptionalTime <= 0)
{
    if ($question_time_in_second > 0)
    {
        $setTime = $question_time_in_second;
    }

}else{
    $moduleOptionalTime = $moduleOptionalTime - $passTime;
    if ($question_time_in_second <= 0)
    {
        $setTime = $moduleOptionalTime;
    }else{
        if ($question_time_in_second > $moduleOptionalTime)
        {
            $setTime = $moduleOptionalTime;
        }else{
            $setTime = $question_time_in_second;
        }

    }
}

      // End Question Time

    $link_next = "javascript:void(0);";
    $link = "javascript:void(0);";

if (is_array($desired)) {
    $link_key = $key - 1;
    if (array_key_exists($link_key, $desired)) {
        $link = $desired[$link_key]['link'];
    }
        $link_key_next = $key;
    if (array_key_exists($link_key_next, $desired)) {
        $question_id = $question_info_s[0]['question_order'] + 1;
        $link1 = base_url();
        $link_next = $link1 . 'get_tutor_tutorial_module/' . $question_info_s[0]['module_id'] . '/' . $question_id;
    }
}

    $module_type = $question_info_s[0]['moduleType'];

     $videoName = strlen($module_info[0]['video_name'])>1 ? $module_info[0]['video_name'] : 'Subject Video';
?>

<form id="answer_form">
    
<?php if ($module_type == 3) { ?>
  <input type="hidden" id="exam_end" value="<?php echo strtotime($module_info[0]['exam_end']);?>" name="exam_end" />
  <input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
  <input type="hidden" id="optionalTime" value="<?php echo $module_info[0]['optionalTime'];?>" name="optionalTime" />
  <input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />
<?php }?>

<!--         ***** For Tutorial & Everyday Study *****         -->    
<?php if ($module_type == 2 || $module_type == 1) { ?>
  <input type="hidden" id="exam_end" value="" name="exam_end" />
  <input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
  <!--  <input type="hidden" id="optionalTime" value="--><?php //echo $question_time_in_second;?><!--" name="optionalTime" />-->
  <input type="hidden" id="optionalTime" value="<?php echo $setTime;?>" name="optionalTime" />
 
  <input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />
<?php }?>

<input type="hidden" value="<?php echo $question_info_s[0]['question_id']; ?>" name="id" id="question_id">
<?php // if (array_key_exists($key, $total_question) && !$tutorial_ans_info) { ?>
<?php if (($last_question_order != $key) && !$tutorial_ans_info) {?>
    <input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] + 1; ?>" name="next_question" />
<?php } else { ?>
    <input type="hidden" id="next_question" value="0" name="next_question" />
<?php } ?>
<input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id'] ?>" name="module_id">
<input type="hidden" id="current_order" value="<?php echo $key; ?>" name="current_order"> 
<input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType']; ?>" name='module_type'>

<input type='hidden' id="student_question_time" value="" name='student_question_time'>

<div class="ss_student_board">
  <div class="ss_s_b_top">
  </div>
 
  <div class="container-fluid">
        <?php 
            $question = $question_info_s[0]['questionName'];
            $answer = $question_info_s[0]['answer'];
            $question_description = json_decode($question_info_s[0]['questionDescription'],true);
            // echo "<pre>";print_r($question_description);die();
        ?>
        <h2 style="font-weight:bold;font-family: 'Comic Sans MS';text-align:center;color:<?=$question_description['title_color']?>"><?=$question_description['question_title_description']?></h2>

        <div style="display:flex;height:55vh;min-height:90px;align-items:center;justify-content:center;">
        <?=$question_description['image_ques_body']?>
        </div>

        <div style="text-align:center;padding-bottom: 100px !important;">
            <a class="btn ans_submit" type="button" style="padding:7px 22px;border:1px solid #62b1ce;background-color:#99d9ea;color:black;">Next</a>
        </div>

  </div> 

</div>
</form>


<script>
     $(window).on('load',function(){
      <?php 
        foreach ($total_question as $ind) {
          if ( ($ind["question_type"] !=14) && ($question_info_s[0]['question_order'] == $ind['question_order']) ) { ?>

          var id= <?php echo $ind['question_order']; ?>;  
          <?php 
          if($ind['question_video']!='' && $ind['question_video']!="[]"){ ?>
        showQuestionVideo(id);
        <?php }}}?>
    });

function showQuestionVideo(id){

//$('#ss_question_video'+id).modal('show');
}
    
    
    function videoCloseWithModal(id){
      $('#ss_question_video'+id).modal('hide');
      var video = $('#videoTag'+id).get(0);
      if (video.paused === false) {
        video.pause();
      } 
    }
</script>


    <!--Success Modal-->
    <div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="height: 265px">  
                <div class="modal-header" >

                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body row" style="height: 87%;">
                    <img src="assets/images/icon_sucess.png" class="pull-left"> <br> <span class="">Your answer is correct</span> 

                </div>
                <div class="modal-footer">
                 <button id="get_next_question" type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

 
  


<script>

    $(document).ready(function(){
        $('.ans_submit').click(function () {
            
            var form = $("#answer_form");

            $.ajax({
                type: 'POST',
                url: 'st_answer_glossary',
                data: form.serialize(),
                dataType: 'html',
                success: function (results) {
                        
                            commonCall();
                      
                
                }
            });

        });
    });
</script>







<script type="text/javascript">
      function show_questionModal() {
        $('#myModal_2222').modal('show');
      }
      


    $('body').on('click','.rsclose',function(){
        $('.response_answer_class').prop('checked', false);
        $('.ans_image').hide(); 
    })
    $(".image_click").click(function(){
       var value = $(this).val();
       $('#response_answer_id'+value).prop('checked',false);
       $('#ans_image'+value).hide();
    });

   
    </script>
<script>
    
    var time_count = 0;
    
      
      
      function showModalDes(e)
      {
        $('#show_description_' + e).modal('show');
      }
      
      
      function commonCall()
      {
        $question_order = $('#next_question').val();
        //alert($question_order);
        $module_id = $('#module_id').val();
        
        <?php if ($tutorial_ans_info) {?>
          window.location = 'show_tutorial_result/'+$module_id;
        <?php }?>
        
        if ($question_order == 0) {
          window.location.href = 'show_tutorial_result/' + $module_id ;
        }
        if ($question_order != 0) {
          window.location = 'get_tutor_tutorial_module/' + $module_id + '/' + $question_order;
        }
      }
    </script>

    <script>

      function takeDecesion(){
        var exact_time = $('#exact_time').val();
        
        var countDownDate =  $('#exam_end').val();

        var now = $('#now').val();
        var opt = $('#optionalTime').val();
        var h1 = document.getElementsByTagName('h1')[0];  
        
        var distance = countDownDate - now;  
        var hours = Math.floor(distance/3600);
        //alert(distance);
        var x = distance % 3600;
        
        var minutes = Math.floor(x/60); 
        var seconds = distance%60;

        var t_h = hours * 60 * 60;
        var t_m = minutes * 60;
        var t_s = seconds;
        
        var total = parseInt(t_h) + parseInt(t_m) + parseInt(t_s);
        
        var remaining_time;
        var end_depend_optional = parseInt(exact_time) + parseInt(opt);
//  alert(opt);
        // if(opt > total){
        //   remaining_time = total;
        // }else{  
        //   remaining_time = parseInt(end_depend_optional) - parseInt(now);
        // }

        if(opt > 0){
          remaining_time = parseInt(end_depend_optional) - parseInt(now);
        
        } else {  
          remaining_time = total;
        }

        setInterval(circulate,1000);

        function circulate(){
            time_count++;
            remaining_time = remaining_time - 1;
    
            var v_hours = Math.floor(remaining_time / 3600);
            var remain_seconds = remaining_time - v_hours * 3600;   
            var v_minutes = Math.floor(remain_seconds / 60);
            var v_seconds = remain_seconds - v_minutes * 60;
            
            $("#student_question_time").val(time_count);
    
            if (remaining_time > 0) {
                h1.textContent = v_hours + " : "  + v_minutes + " : " + v_seconds + "  " ;      
            }else{
                var form = $("#answer_form");
                $.ajax({
                  type: 'POST',
                  url: 'st_answer_matching_multiple_choice',
                  data: form.serialize(),
                  dataType: 'html',
                  success: function (results) {
                    window.location.href = 'show_tutorial_result/'+$('#module_id').val();
                  }
                });
            h1.textContent = "EXPIRED";
          }
        }

    }

<?php if ($module_type == 3  || ($module_type == 2 && $question_info_s[0]['optionalTime'] != 0 && ($question_time_in_second > $moduleOptionalTime || $question_time_in_second == 0))) { ?>
        takeDecesion();
        <?php }?>

</script>


<script>
  function takeDecesionForQuestion() {
    
    var exact_time = $('#exact_time').val();
    
    var now = $('#now').val();
    var opt = $('#optionalTime').val();
    var h1 = document.getElementsByTagName('h1')[0];
    
    var countDownDate =  parseInt (now) + parseInt($('#optionalTime').val());
    
    var distance = countDownDate - now;  
    var hours = Math.floor( distance/3600 );
//        alert(distance)
var x = distance % 3600;

var minutes = Math.floor(x/60); 

var seconds = distance % 60;

var t_h = hours * 60 * 60;
var t_m = minutes * 60;
var t_s = seconds;

var total = parseInt(t_h) + parseInt(t_m) + parseInt(t_s);

var remaining_time;
var end_depend_optional = parseInt(exact_time) + parseInt(opt);

if(opt > total) {
  remaining_time = total;
} else {  
  remaining_time = parseInt(end_depend_optional) - parseInt(now);
}

setInterval(circulate1,1000);

function circulate1() {

    time_count++;
  
  remaining_time = remaining_time - 1;
  
  var v_hours = Math.floor(remaining_time / 3600);
  var remain_seconds = remaining_time - v_hours * 3600;   
  var v_minutes = Math.floor(remain_seconds / 60);
  var v_seconds = remain_seconds - v_minutes * 60;
  
  $("#student_question_time").val(time_count);
  
  if (remaining_time > 0) {
    h1.textContent = v_hours + " : "  + v_minutes + " : " + v_seconds + "  " ;      
  } else {
    var form = $("#answer_form");
    $.ajax({
      type: 'POST',
      url: 'st_answer_matching_multiple_choice',
      data: form.serialize(),
      dataType: 'html',
      success: function (results) {
        if (results == 3) {
          $('#times_up_message').modal('show');
          $('#question_reload').click(function () {
            location.reload(); 
          });
        } if (results == 2) {
          $('#ss_info_sucesss').modal('show');
          
        }
      }
    });
    h1.textContent = "EXPIRED";
  }
}

}
$('#get_next_question').click(function () {
            commonCall();
          });
<?php if (($module_type == 1 || $module_type == 2) && $question_time_in_second != 0) { ?>
  takeDecesionForQuestion();
<?php }?>
</script>
<?php $this->load->view('students/question_module_type_tutorial/module_video'); ?>
<?php $this->load->view('students/question_module_type_tutorial/instruction_video'); ?>
<?php $this->load->view('students/question_module_type_tutorial/drawingBoardMultifule'); ?>