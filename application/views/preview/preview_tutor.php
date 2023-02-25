
<style type="text/css">
    .abc{

    }
	.tutorial-point{
        width: 300px;
        margin: 130px 290px;
        padding: 10px;
        box-shadow: 0px 1px 5px -1px;
        background: #f0f0f0;
    }
    .tutorial-point img{
        width:70px;
    }
    .tutorial-point h4{
        text-align: center;
        font-size: 25px;
        font-weight: 600;
        line-height: 20px;
    }
    .tutorial-point a{
        text-align: center;
        margin: 20px;
        font-size: 20px;
        font-weight: 600;
        text-decoration: underline;
        color: #ff7f27;
        cursor: pointer;
    }
    .calculator-trigger {
    width: 30px;
    height: 35px;
    }
    .ss_timer h1 {
    border: 1px solid #a8a2a2;
    font-size: 17px;
    margin: 0;
    line-height: 27px;
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
$question_time = explode(':', $question_info[0]['questionTime']);
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
?>
<?php
$countTutorial = 0;
$countTutorial = count($tutorialInfo);
?>

<?php 
    $question_instruct = isset($question_info_s[0]['question_video']) ? json_decode($question_info_s[0]['question_video']):'';
?>
<style type="text/css">
  #img_show .row{
    padding: 20px;
  }  
</style>
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
            <a class="btn btn_next" href="javascript:void(0)" onclick="showDrawBoard()">Draw <img src="assets/images/icon_draw.png"></a>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="ss_s_b_main" style="min-height: 100vh">
                <div class="col-sm-8">

                        <div class="workout_menu" style="margin-bottom: 30px;">
                          <ul>
                              <li>
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_draw.png"> Instruction</span></a>
                              </li>
                               
                                <?php if ($question_time_in_second != 0) { ?>

                                    <li><div class="ss_timer" id="demo"><h1>00:00:00 </h1></div></li>

                                <?php }?>

                                <?php if ($question_info[0]['isCalculator']) : ?>
                                    <li> <input type="hidden" name="" id="scientificCalc"></li>
                                <?php endif; ?>  
                              
                              
                          </ul>
                        </div>
                    <div class="tutorial-point">
                        <img src="<?php echo base_url('/')?>assets/images/99.png">
                        <h4>Tutorial</h4>
                        <a class="start-tutorial">Start</a>
                    </div>
                </div>
				 <!-- Modal -->
                <div class="modal fade tutorialModal" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="width:70%">
                        <div class="modal-content" style="height: 94vh;">
                            <div class="modal-header" style="padding: 5px;border-bottom: none;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding:0px 30px;">
                                <div id="img_show" >
                                    <div id="myCarousel" class="carousel" data-ride="carousel" style="border: none;">
                                        <!-- Indicators -->
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner">
                                            <?php foreach($tutorialInfo as $info){?>
                                                <div class="item " id="<?php echo $info['speech']?>">
                                                    <img width="100%" height="100%" style="max-height: 78vh;" src="<?php echo base_url('/')?>assets/uploads/<?php echo $info['img']?>" alt="Chania">
                                                    <input type="hidden" id="wordToSpeak" value="<?php echo $info['speech']?>">
                                                </div>
                                            <?php }?>
                                        </div>

                                        <!-- Left and right controls -->
                                        <div style="text-align: center;">
                                            <!--                            <button class="sound_play" style="position: relative;bottom: -25px;left: 28%;background: transparent;border: none;color: #2198c5;"></button>-->
                                            <a class=""  style="width:90px;display:inline-block;opacity: 1;position:relative;margin: 10px auto;">
                                                <span class=" icon-change sound_play" style="line-height: 30px;text-shadow: none;left:-13px;color: #6e6a6a;font-size: 17px;"><img src="<?php base_url('/')?>assets/images/icon_sound.png"></span>
                                                <!--                            <span class="glyphicon glyphicon-chevron-left icon-change" style="line-height: 30px;text-shadow: none;left:-13px;color: #2198c5;font-size: 17px;">Prev</span>-->
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="left carousel-control prev-btn-c" href="#myCarousel" data-slide="prev" style="width:90px;border:1px solid #62b1ce;border-radius: 4px;display:inline-block;opacity: 1;position:relative;margin: 10px auto;">
                                                <span class=" icon-change" style="line-height: 30px;text-shadow: none;left:-13px;color: #6e6a6a;font-size: 17px;">Previous</span>
                                                <!--                            <span class="glyphicon glyphicon-chevron-left icon-change" style="line-height: 30px;text-shadow: none;left:-13px;color: #2198c5;font-size: 17px;">Prev</span>-->
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control next-btn-c" href="#myCarousel" data-slide="next" style="width:90px;border:1px solid #62b1ce;border-radius: 4px;display:inline-block;opacity: 1;position:relative;margin: 10px auto;margin-right: 52px;">
                                                <span class=" icon-change" style="line-height: 30px;text-shadow: none;right:-13px;color: #6e6a6a;font-size: 17px;">Next</span>
                                                <!--                            <span class="glyphicon glyphicon-chevron-right icon-change" style="line-height: 30px;text-shadow: none;right:-13px;color: #2198c5;font-size: 17px;">Next</span>-->
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="padding: 15px;border-top:none;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default abc">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  
                                    <span>Module Name: Every Sector</span></a>
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
                                                        <!-- <th>Obtained</th> -->
                                                        <th>Description / Video</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td><?php echo $question_info[0]['questionMarks']; ?></td>
                                                        <!-- <td><?php // echo $question_info[0]['questionMarks']; ?></td> -->
                                                          <td class="text-center">
                                                            <a onclick="showDescription()" style="display: inline-block;">
                                                              <img src="assets/images/icon_details.png">
                                                            </a>
                                                          <?php if (isset($question_instruct[0]) && $question_instruct[0] != null ){ ?>
                                                            <a onclick="showQuestionVideo()" class="text-center" style="display: inline-block;"><img src="http://q-study.com/assets/ckeditor/plugins/svideo/icons/svideo.png"></a>
                                                          <?php } ?>
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

        <div class="col-sm-6 ss_next_pre_top_menu text-left">
                <a class="btn btn_next click click_bk" bk="1" >
                    <i class="fa fa-caret-left" aria-hidden="true"></i> Back
                </a>
                <a class="btn btn_next click click_nxt" nxt="1"  ><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
                </div>
    </div>
</div>

<!--Description Modal-->
<div class="modal fade ss_modal" id="ss_info_description" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Question Description</h4>
            </div>
            <div class="modal-body row">
                <span class="ss_extar_top20"><?php echo $question_info[0]['questionDescription']?></span> 
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

<!--Solution Modal-->
<div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Solution</h4>
            </div>
            <div class="modal-body row">
                <i class="fa fa-times" style="font-size:20px;color:red"></i><br>
                <span class="ss_extar_top20">
                    <?php echo $question_info[0]['question_solution']?>
                    
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
                <br><?php echo $question_info[0]['question_solution']?>
            </div>
            <div class="modal-footer">
                <button type="button" id="question_reload" class="btn btn_blue" data-dismiss="modal">close</button>         
            </div>
        </div>
    </div>
</div>
<script src="https://code.responsivevoice.org/responsivevoice.js"></script>

<script>
    $(window).on('load', function () {
        
        $('#myCarousel').carousel({
            pause: true,
            interval: false,
            wrap: false,
        });
        $("#myCarousel .carousel-inner .item:first").addClass( 'active' );
         var word =  $("#myCarousel .item.active").attr("id");
		 if (word =='none')
            {
                $(".sound_play").hide();
                return true;
            }else{

                $(".sound_play").show();
            }
         speak(word);
    });
	$(".start-tutorial").click(function () {
        $('#tutorialModal').modal('show');
    });
	 var count = 1;
    var countTutorial = '<?php echo $countTutorial;?>';
    function speak(word) {
        responsiveVoice.speak(word);
    }
    $('#myCarousel').on('slide.bs.carousel', function onSlide (ev) {
        var word = ev.relatedTarget.id;
		if (word =='none')
            {
                $(".sound_play").hide();
                return true;
            }else{

                $(".sound_play").show();
            }
        speak(word);
    });
	$(".sound_play").click(function () {
        var word =  $("#tutorialModal #myCarousel .item.active").attr("id");
        console.log(word);
        if (word =='none')
        {
            return true;
        }
        speak(word);
    });
	$(".prev-btn-c").click(function () {
        count--;
        if (count < 1)
        {
            $("#tutorialModal").modal('hide');
        }
    });
	$(".next-btn-c").click(function () {
        count++;
        if (count > countTutorial)
        {
            count = countTutorial;
            $("#tutorialModal").modal('hide');
        }
    });

    // var pPage = '';
    // console.log(pPage);
</script>
<script>
    $('#answer_matching').click(function () {
        var user_answer = CKEDITOR.instances.answer.getData();
        var id = $('#question_id').val();
        $.ajax({
            type: 'POST',
            url: 'IDontLikeIt/answer_matching',
            data: {
                user_answer: user_answer,
                id: id
            },
            dataType: 'html',
            success: function (results) {
                if (results == 0) {
                    $('#ss_info_worng').modal('show');
                } else if (results == 1) {
                    clearInterval(clear_interval);
                    $('#ss_info_sucesss').modal('show');
                    
                }
            }
        });

    });
    
    function showDescription(){
        $('#ss_info_description').modal('show');
    }
    function showQuestionVideo(){
        $('#ss_question_video').modal('show');
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
            var user_answer = CKEDITOR.instances.answer.getData();
            var id = $('#question_id').val();
            
            $.ajax({
                type: 'POST',
                url: 'IDontLikeIt/answer_matching',
                data: {
                    user_answer: user_answer,
                    id: id
                },
                dataType: 'html',
                success: function (results) {
                    if (results == 0) {
                        $('#times_up_message').modal('show');
                        $('#question_reload').click(function () {
                            location.reload(); 
                        });
                    } else if (results == 1) {
                        $('#ss_info_sucesss').modal('show');
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
//        alert(distance)
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
</script>


<?php $this->load->view('module/preview/drawingBoard'); ?>
