<?php
date_default_timezone_set($this->site_user_data['zone_name']);
$module_time = time();

$key = $question_info_s[0]['question_order'];
$desired = $this->session->userdata('data');

//    For Question Time
$question_time = explode(':',$question_info_s[0]['questionTime']);
$hour = 0;
$minute = 0;
$second = 0;
if(is_numeric($question_time[0])) {
  $hour = $question_time[0];
} if(is_numeric($question_time[1])) {
  $minute = $question_time[1];
} if(is_numeric($question_time[2])) {
  $second = $question_time[2];
}

$question_time_in_second = ($hour * 3600) + ($minute * 60) + $second ;
$module_type = $question_info_s[0]['moduleType'];
//    End For Question Time
?>


<?php 
    $question_instruct = isset($question_info_s[0]['question_video']) ? json_decode($question_info_s[0]['question_video']):'';
    $question_instruct_id = $question_info_s[0]['id'];
?>

<style type="text/css">
    .ss_student_board {
    background: #0079bc;
    padding: 40px 0px;
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
.description_video{
   position: relative;
}
.description_class{
    position: absolute;
    left: 45px;
}
.question_video_class{
    position: absolute;
    left: 70px;
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
$countTutorial = 0;
$countTutorial = count($tutorialInfo);
?>
<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="col-sm-6 ss_index_menu">
            <a href="#">Module Setting</a>
        </div>
        <div class="col-sm-6 ss_next_pre_top_menu">
            <?php if ($question_info_s[0]['question_order'] == 1) { ?>                            
                <a class="btn btn_next" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/1"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
            <?php } else { ?>
                <a class="btn btn_next" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/<?php echo ($question_info_s[0]['question_order'] - 1); ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
            <?php } ?> 
            <?php $key = $question_info_s[0]['question_order']; ?>  
            <?php if (array_key_exists($key, $total_question)) { ?>
                <a class="btn btn_next" id="question_order_link" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/<?php echo $question_info_s[0]['question_order'] + 1; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
            <?php } ?>                                        
            <a class="btn btn_next" href="#">Draw <img src="assets/images/icon_draw.png"></a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="ss_s_b_main" style="min-height: 100vh">
                <div class="col-md-8">
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
                                            <?php foreach($tutorialInfo as $key=>$info){?>
											<?php 
                                                    $item_active = '';
                                                    if ($key == 0)
                                                    {
                                                        $item_active ='active';
                                                    }
                                                ?>
                                                <div class="item <?php echo $item_active ;?>" id="<?php echo $info['speech']?>">
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
                  

                <input type="hidden" value="<?php echo $question_info_s[0]['question_id']; ?>" name="question_id" id="question_id">

                <div class="col-md-4">
                    <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  
                                        <span>Module Name: <?php echo $question_info_s[0]['module_type'] ?></span></a>
                                </h4>
                            </div>
                            <div id="collapsethree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class=" ss_module_result">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                              <thead>    
                                                <tr>
                                                  <th></th>
                                                  <th>SL</th>
                                                  <th>Mark</th>
                                                  <th>Obtained</th>
                                                  <th>Description / Video</th>                                                  
                                                </tr>
                                              </thead>
                                              <tbody>
                                                  <?php $i = 1;
                                                  $total = 0;
                                                  foreach ($total_question as $ind) { ?>
                                                  <tr>
                                                    <td>
                                                        <?php if (isset($desired[$i]['ans_is_right'])) {
                                                              if ($desired[$i]['ans_is_right'] == 'correct') {?>
                                                          <span class="glyphicon glyphicon-ok" style="color: green;"></span>
                                                              <?php } else {?>
                                                          <span class="glyphicon glyphicon-remove" style="color: red;"></span>
                                                              <?php }
                                                        }?>
                                                    </td> 

                                                    
                                                           <?php  if ( ($ind["question_type"] !=14) && ($question_info_s[0]['question_order'] == $ind['question_order']) ) { ?>
                                                                <td style="background-color:lightblue">
                                                                    <?php echo $ind['question_order']; ?>
                                                                </td>
                                                           <?php } 

                                                            elseif ( ($ind["question_type"] ==14) && $order >= $chk ) { ?>
                                                                <td style="background-color:#FFA500">
                                                                  <a href="<?php echo site_url('/module_preview/').$ind['module_id'].'/'.$ind['question_order'] ?>"><?php echo $ind['question_order']; ?></a>
                                                                 </td>
                                                           <?php } 

                                                           elseif ( ($ind["question_type"] ==14) && $order < $chk ) { ?>
                                                                <td style="background-color:#FFA500">
                                                                  <?php echo $ind['question_order']; ?>
                                                                 </td>
                                                           <?php } 

                                                            else{  ?>

                                                              <td>
                                                                  <?php echo $ind['question_order']; ?>
                                                              </td>
                                                              
                                                           <?php } ?>
                                                            

                                                  <td>
                                                      <?php
                                                      echo $ind['questionMarks'];
                                                      $total = $total + $ind['questionMarks'];
                                                      ?>
                                                  </td>
                                                  <td><?php echo $ind['questionMarks']; ?></td>
                                                   <td class="description_video">
                    
                                                        <?php if (isset($ind['questionDescription']) && $ind['questionDescription'] != null ){ ?>
                                                            <a  class="description_class" onclick="showModalDes(<?php echo $i; ?>);" style="display: inline-block;"><img src="assets/images/icon_details.png"></a>
                                                        <?php } ?>
                                                        <?php 
                                                            $question_instruct_vid = isset($ind['question_video']) ? json_decode($ind['question_video']):'';
                                                        ?>
                                                        <?php if (isset($question_instruct_vid[0]) && $question_instruct_vid[0] != null ){ ?>
                                                          <a onclick="showQuestionVideo(<?php echo $i; ?>)" class="question_video_class" style="display: inline-block;"><img src="http://q-study.com/assets/ckeditor/plugins/svideo/icons/svideo.png"></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                      <?php $i++;
                                                  } ?>
                                              <tr>
                                                <td colspan="2">Total</td>
                                                <td colspan="3"><?php echo $total?></td>
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


            </div>
        </div>
    </div>
</div>
</div>  
</section>

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
                <a id="next_qustion_link" href="">
                    <button type="button" class="btn btn_blue" >Ok</button>
                </a>
                
            </div>
        </div>
    </div>
</div>


<?php $i = 1;
$total = 0;
foreach ($total_question as $ind) { ?>
<!--Question Video Modal-->
<div class="modal fade" id="ss_question_video<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Question Video</h4>
            </div>
            <div class="modal-body">
                <?php 
                    $question_instruct_vid = isset($ind['question_video']) ? json_decode($ind['question_video']):'';
                ?>
                <?php if (isset($question_instruct_vid[0]) && $question_instruct_vid[0] != null ){ ?>
                    <video controls style="width: 100%">
                      <source src="<?php echo isset($question_instruct_vid[0]) ? trim($question_instruct_vid[0]) : '';?>" type="video/mp4">
                    </video>
                    <?php if (isset($question_instruct_vid[1]) && $question_instruct_vid[1] != null ): ?>
                        
                        <video controls style="width: 100%">
                          <source src="<?php echo isset($question_instruct_vid[1]) ? trim($question_instruct_vid[1]) : '';?>" type="video/mp4">
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
<?php $i++; } ?>
<script>
    function showQuestionVideo(id){
      $('#ss_question_video'+id).modal('show');
    }
</script>



<div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
                <i class="fa fa-close" style="font-size:20px;color:red"></i> <span class="ss_extar_top20">Your answer is wrong</span>
                <br><?php echo strip_tags($question_info_s[0]['answer']); ?>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
            </div>
        </div>
    </div>
</div>
<?php $i = 1;
foreach ($total_question as $ind) { ?>
    <div class="modal fade ss_modal ew_ss_modal" id="show_description_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" name="questionDescription"><?php echo $ind['questionDescription']; ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php $i++;
} ?>
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
	$(".sound_play").click(function () {
        var word =  $("#tutorialModal #myCarousel .item.active").attr("id");
        console.log(word);
        if (word =='none')
        {
            return true;
        }
        speak(word);
    });
    function speak(word) {
        responsiveVoice.speak(word);
    }
    $('#myCarousel').on('slide.bs.carousel', function onSlide (ev) {
        var word = ev.relatedTarget.id;
		if (word =='none')
        {
            $(".sound_play").hide();
            return true;
        }else {
            $(".sound_play").show();
        }
        speak(word);
    });
    var count = 1;
    var countTutorial = '<?php echo $countTutorial;?>';
    var module_id =  '<?php echo $question_info_s[0]["module_id"]?>';
    var question_order = '<?php echo $question_info_s[0]["question_order"] ?>';
    var question_id = $('#question_id').val();
	
	$(".close").click(function () {
        $.ajax({
            type: 'POST',
            url: 'Module/tutorial_check_order_module_next',
            data: {module_id:module_id,question_order:question_order,question_id:question_id},
            dataType: 'json',
            success: function (results) {
                if (results)
                {
                    window.location = results;
                }

            }
        });
    });
	
    $(".prev-btn-c").click(function () {
        count--;
        if (count < 1)
        {
            count = 1;
            $.ajax({
                type: 'POST',
                url: 'Module/tutorial_check_order_module_prev',
                data: {module_id:module_id,question_order:question_order,question_id:question_id},
                dataType: 'json',
                success: function (results) {
					console.log(results);
					if(results)
					{
						window.location = results;
					}
                    
                }
            });
        }
    });
    $(".next-btn-c").click(function () {
        count++;
        if (count > countTutorial)
        {
            count = countTutorial;
            $.ajax({
                type: 'POST',
                url: 'Module/tutorial_check_order_module_next',
                data: {module_id:module_id,question_order:question_order,question_id:question_id},
                dataType: 'json',
                success: function (results) {
					console.log(results);
					if(results)
					{
						window.location = results;
					}
                }
            });
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
            url: 'answer_matching',
            data: {
                user_answer: user_answer,
                id: id
            },
            dataType: 'html',
            success: function (results) {
                if (results == 0) {
                    $('#ss_info_worng').modal('show');
                } else if (results == 1) {
                    var question_order_link = $('#question_order_link').attr('href');
                    $("#next_qustion_link").attr("href", question_order_link);
                    $('#ss_info_sucesss').modal('show');
                }
            }
        });



    });
    function showModalDes(e)
    {
        $('#show_description_' + e).modal('show');
    }
</script>