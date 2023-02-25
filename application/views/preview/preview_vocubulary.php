<style>
  
  @media screen and (min-width: 768px) {
    .space_reduce{
    padding-left: 8px;
    max-width: 111px;

  }
  }
  .calculator-trigger {
    width: 30px;
    height: 35px;
  }
  .ss_timer h1 {
  border: 1px solid #a8a2a2;
  font-size: 17px;
  margin: 0;
  line-height: 28px;
  padding: 3px 0px;
  color: #222;
  }
  .workout_menu ul li {
    display: inline-block;

    margin-right: 5px;
  }
  .ss_timer {
      margin-left: 5px;
      display: inline-block;
      background: #eeeef0;
      border: 0;
      min-width: 110px;
      text-align: center;
  }
  .ss_timer h1 {
    font-size: 17px;
    margin: 0;
    line-height: 20px !important;
    padding: 7px 10px;
    color: #222;
    }
    .workout_menu img.calculator-trigger{
        margin-top:0;
        margin-bottom:0;
        width: 30px;
        height: 39px;
    }
</style>
<?php
date_default_timezone_set($this->site_user_data['zone_name']);
$module_time = time();

        //    For Question Time
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

$question_time_in_second = ($hour * 3600) + ($minute * 60) + $second ;

//    End For Question Time
// echo "<pre>";print_r(json_decode($question_info_s[0]['question_video']));die();
?>
<input type="hidden" id="exam_end" value="" name="exam_end" />
<input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
<input type="hidden" id="optionalTime" value="<?php echo $question_time_in_second;?>" name="optionalTime" />
<input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />

<div class="ss_student_board">
  <div class="ss_s_b_top">
    <div class="ss_index_menu">
      <a href="<?php echo base_url().$userType.'/view_course'; ?>">Question/Module</a>
    </div>
    
    
    
    <div class="col-sm-6 ss_next_pre_top_menu">
        
      <a class="btn btn_next" href="question_edit/<?php echo $question_item; ?>/<?php echo $question_id; ?>">
        <i class="fa fa-caret-left" aria-hidden="true"></i> Back
      </a>
      <a class="btn btn_next" href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
      <a class="btn btn_next" href="javascript:void(0)" onclick="showDrawBoard()">Draw <img src="<?php echo base_url();?>assets/images/icon_draw.png"></a>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="ss_s_b_main" style="min-height: 100vh">
        <div class="col-sm-4">
            <div class="workout_menu" style=" padding-right: 15px;">
                <ul>
                <li><a style="cursor:pointer" id="show_question"> <img src="assets/images/icon_draw.png"/> Instruction </a></li>

                <?php if ($question_time_in_second != 0) { ?>
                  <li><div class="ss_timer" id="demo"><h1>00:00:00 </h1></div></li>
                <?php }?>

                <?php if ($question_info_s[0]['isCalculator']) : ?>
                  <li><input type="hidden" name="" id="scientificCalc"></li>
                <?php endif; ?>
                </ul>
            </div>
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Question</a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  <div class="image_q_list" style="font-size: 16px;">

                    <div class="row">
                      <div class="col-xs-5 text-right  col-lg-4">Word</div>
                      <div class="col-xs-1" style="padding-left: 0;">: </div>
                      <div class="col-xs-5 col-lg-6">?</div>
                    </div>
                    <?php 
                      if(!empty($question_info->definition)){
                    ?>
                    <div class="row">
                      <div class="col-xs-5 text-right  col-lg-4">Definition</div>
                      <div class="col-xs-1" style="padding-left: 0;">: </div>
                      <div class="col-xs-5 col-lg-6"> <?php echo $question_info->definition;?></div>
                    </div>
                    <?php }?>

                    <?php 
                      if(!empty($question_info->parts_of_speech)){
                    ?>
                    <div class="row">
                      <div class="col-xs-5 text-right  col-lg-4">Parts of speech</div>
                      <div class="col-xs-1"style="padding-left: 0;">: </div>
                      <div class="col-xs-5 col-lg-6"><?php echo $question_info->parts_of_speech;?></div>
                    </div>
                    <?php }?>
                    <?php 
                      if(!empty($question_info->synonym)){
                    ?>
                    <div class="row">
                      <div class="col-xs-5 text-right  col-lg-4">Synonym </div>
                      <div class="col-xs-1"style="padding-left: 0;">: </div>
                      <div class="col-xs-5 col-lg-6"><?php echo $question_info->synonym;?></div>
                    </div>
                    <?php }?>
                    <?php 
                      if(!empty($question_info->antonym)){
                    ?>
                    <div class="row">
                      <div class="col-xs-5 text-right  col-lg-4">Antonym</div>
                      <div class="col-xs-1"style="padding-left: 0;">: </div>
                      <div class="col-xs-5 col-lg-6"><?php echo $question_info->antonym;?></div>
                    </div>
                    <?php }?>
                    <!-- <div class="row">
                      <div class="col-xs-5 text-right">Hint</div>
                      <div class="col-xs-1">: </div>
                      <div class="col-xs-5">
                        <?php //echo $question_info->sentence;?>
                        <a href="javascript:;" id="hintPopover" class="text-center" style="display: inline-block;">
                          <img src="assets/images/icon_details.png">
                        </a>
                      </div>
                      
                    </div> -->
                    <?php 
                      if(!empty($question_info->near_antonym)){
                    ?>
                    <div class="row">
                      <div class="col-xs-5 text-right  col-lg-4">Category</div>
                      <div class="col-xs-1"style="padding-left: 0;">: </div>
                      <div class="col-xs-5 col-lg-6"><?php echo $question_info->near_antonym;?></div>
                    </div>
                    <?php }?>
                    <div class="row">
                      <div class="col-xs-5 text-right  col-lg-4"></div>

                        <?php if ($question_info->speech_to_text) {?>
                        <div class="col-xs-2" style="font-size: 18px; padding-right:0px">
                          <i class="fa fa-volume-up" onclick='MySpeak()'></i>
                          <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                          <input type="hidden" id="wordToSpeak" value="<?php echo isset($question_info->speech_to_text) ? $question_info->speech_to_text:''; ?>">
                        </div>

                        <div class="col-xs-5 col-lg-6" style="padding-left:0px;">
                          <small  style="font-size:12px !important;color:red; float:left;">Listening to audio will deduct 2 number</small>
                        </div>
                        <?php }?>

                    </div>


                    <div class="row">
                        <?php if (isset($question_info->audioFile)&& file_exists($question_info->audioFile)) : ?>
                        <div class="col-xs-5 text-right  col-lg-4">Audio File</div>
                      <div class="col-xs-2" onclick="showAudio()" style="font-size: 18px; padding-right:0px">
                        <i class="fa fa-volume-up"></i>
                        <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                      </div>
                      <div class="col-xs-5 col-lg-6" style="padding-left:0px;">
                        <small  style="font-size:12px !important;color:red; float:left;">
                         Listening to audio will deduct 1 number
                       </small>
                     </div>
                        <?php endif; ?>
                 </div>
                 <div class="row">
                  <?php if (isset($question_info->ytLinkInput) && strlen($question_info->ytLinkInput)>10) : ?>
                  <div class="col-xs-5 text-right  col-lg-4">Video file</div>
                  <?php endif;?>
                  <div class="col-xs-7 col-lg-8">
                    <?php if (isset($question_info->ytLinkInput) && strlen($question_info->ytLinkInput)>10) : ?>
                    <label id="ytIcon" class="ytIcon"><i class="fa fa-youtube"></i></label>
                    <input type="hidden" id="hiddenYtLink" value="<?php echo $question_info->ytLinkInput; ?>">
                    <input type="hidden"  id="hiddenYtTitle" value="<?php echo isset($question_info->ytLinkTitle) ? $question_info->ytLinkTitle:''; ?>">
                    <?php elseif (isset($question_info->videoFile)) : ?>
                      <label id="vidIcon" for="exampleInputFilevideo"><i class="fa fa-youtube-play"></i></label>
                    <?php endif;?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <audio controls style="display: none;">
            <source src="<?php if (isset($question_info->audioFile)) {
                echo $question_info->audioFile;
                         } ?>" type="audio/ogg">
            <source src="<?php if (isset($question_info->audioFile)) {
                echo $question_info->audioFile;
                         } ?>" type="audio/mpeg">
            <source src="<?php if (isset($question_info->audioFile)) {
                echo $question_info->audioFile;
                         } ?>" type="audio/webm">
            <source src="<?php if (isset($question_info->audioFile)) {
                echo $question_info->audioFile;
                         } ?>" type="audio/wav">
            <source src="<?php if (isset($question_info->audioFile)) {
                echo $question_info->audioFile;
                         } ?>" type="audio/flac">
          </audio>


        </div>

      </div>
      <div class="col-sm-4">
        <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">   Answer</a>
              </h4>
            </div>
            <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                <div class="image_box_list_result result">
                  <form id="answer_form">
                    <div class="image_box_list" style="overflow: visible;">
                      <div class="row">
                        <div class="">
                          <div class="">
                            <?php foreach ($question_info->vocubulary_image as $row) {?>
                              <div class="result_board">
                                <?php echo $row[0]?>
                              </div>
                              <br/>
                            <?php }?>
                            <div class="form-group" style="padding: 0px 12px;">
                              <input type="text" autofill="off" class="form-control" autocorrect="off" spellcheck="false" autocomplete="off" name="answer">
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                    <input type="hidden" value="<?php echo $question_id;?>" name="question_id" id="question_id">
                    <div class="text-center">
                      <button class="btn btn_next" type="submit" id="answer_matching">Submit</button>
                    </div> 
                  </form>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  <span>Module Name: Every Sector</span></a>
              </h4>
            </div>
            <div id="collapsethree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                <div class=" ss_module_result">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>    
                        <tr>

                          <th>SL</th>
                          <th>Mark</th>

                          <th>Description / Video</th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr>

                          <td>1</td>
                          <td><?php echo $question_info_s[0]['questionMarks']; ?></td>

                          <td class="text-center">
                            <a onclick="showDescription()" style="display: inline-block;">
                              <img src="assets/images/icon_details.png">
                            </a>
                            <a onclick="showQuestionVideo()" class="text-center" style="display: inline-block;"><img src="http://q-study.com/assets/ckeditor/plugins/svideo/icons/svideo.png"></a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4 pull-right" id="draggable" style="display: none;">
        <div class="panel-group" id="waccordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#waccordion" href="#collapseworkout" aria-expanded="true" aria-controls="collapseworkout">  Workout</a>
              </h4>
            </div>
            <div id="collapseworkout" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                <textarea name="workout" class="mytextarea"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</div>


<!--Description Modal-->
<div class="modal fade ss_modal" id="ss_info_description" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <span class="ss_extar_top20"><?php echo $question_info_s[0]['questionDescription']?></span> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

      </div>
    </div>
  </div>
</div>


<!--Success Modal-->
<div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <img src="assets/images/icon_sucess.png" class="pull-left"> <span class="ss_extar_top20">Your answer is correct</span> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

      </div>
    </div>
  </div>
</div>

<!--Success Modal-->
<?php 
    $question_instruct = isset($question_info_s[0]['question_video']) ? json_decode($question_info_s[0]['question_video']):'';
?>
<div class="modal fade" id="ss_question_video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Question Video</h4>
            </div>
            <div class="modal-body">

                <?php if (isset($question_instruct[0]) && $question_instruct[0] != null ){ ?>
                    <video controls style="width: 100%">
                      <source src="<?php echo isset($question_instruct[0]) ? trim($question_instruct[0]) : '';?>" type="video/mp4">
                    </video>
                    <?php if (isset($question_instruct[1]) && $question_instruct[1] != null ): ?>
                        
                        <video controls style="width: 100%">
                          <source src="<?php echo isset($question_instruct[1]) ? trim($question_instruct[1]) : '';?>" type="video/mp4">
                        </video>
                    <?php endif ?>
                <?php }else{ ?>
                    <P>No question video</P>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <img src="assets/images/icon_sucess.png" class="pull-left"> <span class="ss_extar_top20">Your answer is correct</span> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

      </div>
    </div>
  </div>
</div>

<!--Solution Modal-->
<div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body row">
        <i class="fa fa-close" style="font-size:20px;color:red"></i><br> 
        <span class="ss_extar_top20">
            <?php echo $question_info_s[0]['question_solution']?>
        </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
      </div>
    </div>
  </div>
</div>

<!--Times Up Modal-->
<div class="modal fade ss_modal" id="times_up_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Times Up</h4>
      </div>
      <div class="modal-body row">
        <i class="fa fa-close" style="font-size:20px;color:red"></i> 
        <!--<span class="ss_extar_top20">Your answer is wrong</span>-->
        <br><?php echo $question_info_s[0]['question_solution']?>
      </div>
      <div class="modal-footer">
        <button type="button" id="question_reload" class="btn btn_blue" data-dismiss="modal">close</button>         
      </div>
    </div>
  </div>
</div>

<!-- video player -->
<div id="ytPlayer" title="Reference video" style="display: none">
  <div id="P1" class="player" style="margin-top: 30px"></div>
</div>

<script>
  $(document).ready(function (){
    $("input[name='answer']").focus();
  });


//    $('#answer_matching').click(function () {
  $("#answer_form").on('submit', function (e) {
//        alert('');
e.preventDefault();
var form = $("#answer_form");

$.ajax({
  type: 'POST',
  url: 'Preview/answer_matching_vocabolary',
  data: form.serialize(),
  dataType: 'html',
  success: function (results) {
    if(results==1) {
      alert('write your answer');
    } else if(results==2) {
      $('#ss_info_sucesss').modal('show');
    } else if(results==3) {
      $('#ss_info_worng').modal('show');        
    }
  }
});

});

  function getLetter(letter)
  {
    var val = document.getElementById('exampleInputl1').value;
    var total = val + letter;
    $('#exampleInputl1').val(total);
  }
  function delLetter(){
    var val = document.getElementById('exampleInputl1').value;
    var sillyString = val.slice(0, -1);
    $('#exampleInputl1').val(sillyString);
  }

  function showAudio(){
    $("audio").show();
  }

  function showDescription(){
    $('#ss_info_description').modal('show');
  }
    function showQuestionVideo(){
        $('#ss_question_video').modal('show');
    }
</script>

<!--  text to speec -->
<!--<script src='https://code.responsivevoice.org/responsivevoice.js'></script> -->
<!-- <script src="https://code.responsivevoice.org/responsivevoice.js?key=RCb3gYkz"></script> -->
<script>
  function MySpeak() {
    var word = $('#wordToSpeak').val();
    responsiveVoice.speak(word);
  }
</script>


<script>
  var remaining_time;
  var clear_interval;
  var h1 = document.getElementsByTagName('h1')[0];

  function circulate1() {

    remaining_time = remaining_time - 1;
    
    var v_hours = Math.floor(remaining_time / 3600);
    var remain_seconds = remaining_time - v_hours * 3600;       
    var v_minutes = Math.floor(remain_seconds / 60);
    var v_seconds = remain_seconds - v_minutes * 60;
    
    if (remaining_time > 0) {
      h1.textContent = v_hours + " : "  + v_minutes + " : " + v_seconds + "  " ;          
    } else {
      var form = $("#answer_form");
      $.ajax({
        type: 'POST',
        url: 'IDontLikeIt/answer_matching_vocabolary',
        data: form.serialize(),
        dataType: 'html',
        success: function (results) {
          if (results == 1) {
            $('#times_up_message').modal('show');
            $('#question_reload').click(function () {
              location.reload(); 
            });
          }
          if (results == 3) {
            $('#times_up_message').modal('show');
            $('#question_reload').click(function () {
              location.reload(); 
            });
          }
        }
      });
      h1.textContent = "EXPIRED";
    }
  }
  
  function takeDecesionForQuestion() {

    var exact_time = $('#exact_time').val();
    
    var now = $('#now').val();
    var opt = $('#optionalTime').val();
    
    
    var countDownDate =  parseInt (now) + parseInt($('#optionalTime').val());
    
    var distance = countDownDate - now;  
    var hours = Math.floor( distance/3600 );

    var x = distance % 3600;

    var minutes = Math.floor(x/60); 

    var seconds = distance % 60;

    var t_h = hours * 60 * 60;
    var t_m = minutes * 60;
    var t_s = seconds;

    var total = parseInt(t_h) + parseInt(t_m) + parseInt(t_s);


    var end_depend_optional = parseInt(exact_time) + parseInt(opt);

    if(opt > total) {
      remaining_time = total;
    } else {    
      remaining_time = parseInt(end_depend_optional) - parseInt(now);
    }

    clear_interval = setInterval(circulate1,1000);

  }


    <?php if ($question_time_in_second != 0) { ?>
    takeDecesionForQuestion();
    <?php }?>

  //yt icon click action
  $('.ytIcon').on('click', function(){
    //convert yt url to embed link
    var videoUrl = $('#hiddenYtLink').val();
    var videoTitle = $('#hiddenYtTitle').val();
    //generate data
    var data= "{videoURL:'"+videoUrl+"',containment:'self',startAt:0,mute:false,autoPlay:false,loop:false,opacity:.8, ratio:'auto'}"
    $('#P1').attr('data-property', data);
    //var videoId = getYtId(url);
    
    $( "#ytPlayer" ).dialog({
      minWidth: 600,
      title: videoTitle,
      buttons: [
      {
        text: "Close",
        icon: "ui-icon ui-icon-heart",
        click: function() {
          jQuery('#P1').YTPPause()
          $( this ).dialog( "close" );
        }
      }
      ]
    });
    jQuery("#P1").YTPlayer();
  })

  function getYtId(url) {
    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    var match = url.match(regExp);

    if (match && match[2].length == 11) {
      return match[2];
    } else {
      return 'error';
    }
  }


  $('#hintPopover').webuiPopover({
    content:"<?php echo '<br>'.$question_info->sentence;?>",
    width:350,
    height:250,
    closeable:true
  });
</script>

<?php $this->load->view('module/preview/drawingBoard'); ?>