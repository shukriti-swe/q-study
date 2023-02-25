<?php
    date_default_timezone_set($this->site_user_data['zone_name']);
    $module_time = time();
	$question_order_array = array_column($total_question, 'question_order');
    $last_question_order = end($question_order_array);
    
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


foreach ($total_question as $ind) {

if ($ind["question_type"] == 14) {
  $chk = $ind["question_order"];
 }

} 
  ?>
  

<?php 
    $question_instruct = isset($question_info_s[0]['question_video']) ? json_decode($question_info_s[0]['question_video']):'';
    $question_instruct_id = $question_info_s[0]['id'];
?>

<!--         ***** For Tutorial & Everyday Study *****         -->    
<?php // if ($module_type == 2 || $module_type == 1) { ?>
    <input type="hidden" id="exam_end" value="" name="exam_end" />
    <input type="hidden" id="now" value="<?php echo $module_time;?>" name="now" />
    <input type="hidden" id="optionalTime" value="<?php echo $question_time_in_second;?>" name="optionalTime" />
    <input type="hidden" id="exact_time" value="<?php echo $this->session->userdata('exact_time');?>" />
<?php // }?>

<style>
    input::placeholder {
        font-size: 13px;
	color: #cecccc !important;
    }
    
    .paragraph_sequence {
        display: inline-block;
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

<div class="ss_student_board">
    <div class="ss_s_b_top">
        <div class="ss_index_menu">
            <a href="#">Module Setting</a>
        </div>
		
		<?php if ($question_time_in_second != 0) { ?>
            <div class="col-sm-4" style="text-align: right">
                <div class="ss_timer" id="demo"><h1>00:00:00 </h1></div>
            </div>
        <?php }?>
		
        <div class="col-sm-6 ss_next_pre_top_menu">
            <?php if ($question_info_s[0]['isCalculator']) : ?>
                <input type="hidden" name="" id="scientificCalc">
            <?php endif; ?>
            
            <?php if ($question_info_s[0]['question_order'] == 1) { ?>                                                      
                <a class="btn btn_next" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/1"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
            <?php } else { ?>
                <a class="btn btn_next" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/<?php echo ($question_info_s[0]['question_order'] - 1); ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
            <?php } ?> 
            
            <?php if (array_key_exists($key, $total_question)) { ?>
                <a class="btn btn_next" id="question_order_link" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/<?php echo $question_info_s[0]['question_order'] + 1; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
            <?php } ?>                                                                              
            <a class="btn btn_next" id="draw" onClick="showDrawBoard()" data-toggle="modal" data-target=".bs-example-modal-lg">
                Draw <img src="assets/images/icon_draw.png">
            </a>
        </div>
    </div>
    
    <div class="container-fluid">
        <form id="answer_form">
            
            <input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id'] ?>" name="module_id">
            <?php if (array_key_exists($key, $total_question)) { ?>
                <input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] + 1; ?>" name="next_question" />
            <?php } else { ?>
                <input type="hidden" id="next_question" value="0" name="next_question" />
            <?php } ?>
            <input type="hidden" value="<?php echo $question_info_s[0]['question_id']; ?>" name="question_id" id="question_id">
            <input type="hidden" id="current_order" value="<?php echo $key; ?>" name="current_order">
            <input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType']; ?>" name='module_type'>
			<input type='hidden' id="last_question_order" value="<?php echo $last_question_order; ?>" name='last_question_order'>
            
            <div class="row">
                <div class="ss_s_b_main" style="min-height: 100vh">
                    <div class="col-sm-7">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <div class="preview-menu">
                                            <ul>
                                                <li><button type="button" id="Question">Question(<i>click here</i>)</button></li>
                                                <li><button type="button" class="" id="Choose_slide">Choose</button>
                                                    <input type="hidden" id="content_input" name="content_input" value="">
                                                    <input type="hidden" id="clue_inc"  value="0">
                                                </li>
                                                <li><button type="button" id="content_Redo">Remove</button></li>
                                                <!-- <li><button style="background: #4dd64d;color: #000;" type="button" paragraph="0" class="" id="Create_Paragraph">Create Paragraph</button></li> -->
                                                <li><button style="background: #f5f586;color: #000" type="button" id="Clear_all">Clear All</button></li>
                                                <li><button style="color: #fff;background: #9e9e9e;" type="button" disabled="disabled" id="clue_answer">Clue Answer</button></li>
                                            </ul>

                                            <!-- Tab panes -->
                                        </div>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

                                    <div class="panel-body tab-slide-relative">
                                        <div class="tab-slide-view" id="tab_slide_view" style="display: none;">
                                            <button type="button" class="slide-close-btn" id="slide_close_btn">&#10006;</button>
                                            <h3>Choose the sentence in correct order</h3>

                                            <?php $i = 1;foreach ($question_info['sentence'] as $sentence) {?>

                                                <div class="col-md-12" style="margin-bottom: 10px;">
                                                    <div class="row">
                                                        <label for="staticEmail" style="padding-right: 0px" class="col-sm-2 col-form-label"><?php echo $i;?></label>
                                                        <div class="col-sm-10" style="padding-left: 0px">
                                                            <div class="slide_content_style"><?php echo $sentence; ?></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php $i++;}?>
                                        </div>
                                        <div class="ans_report" style="display: none;">
                                            <button type="button" class="slide-close-btn" id="report_close_btn">&#10006;</button>
                                            <div>
                                                

                                            </div>
                                            <div style="margin-top: 20px;">
                                                <h3 style="margin-bottom: 20px">incorrect Answer:</h3>
                                                <?php foreach($incorrect_results as $message){?>
                                                    <p style="margin: 3px 0px;"><?php echo $message?></p>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="clue_ans_div_one" id="clue_ans_div_one" style="display: none;background: #fff;">
                                                <button type="button" class="slide-close-btn" id="att_close_btn">&#10006;</button>
                                                <?php if (isset($question_attempt[0]['first_atmp_text'])){?>
<!--                                                <h5>See</h5>-->
                                                <h5><?php echo $question_attempt[0]['first_atmp_text']?></h5>
                                                <?php }?>
                                                <p>Clues and Answers</p>
                                                <div style="margin-top: 20px;width:100%;">
                                                    <?php foreach($first_attempts as $first_attempt){?>
                                                        <span class="result">
                                                    <?php echo $first_attempt?>
                                                </span>
                                                    <?php }?>
                                                </div>

                                            </div>
                                            <div class="clue_ans_div_one"  id="clue_ans_div_two" style="display: none;background: #fff;">
                                                <button type="button" class="slide-close-btn" id="atttwo_close_btn">&#10006;</button>
                                                 <?php if (isset($question_attempt[0]['second_atmp_text'])){?>
                                                    <!--                                                <h5>See</h5>-->
                                                    <h5><?php echo $question_attempt[0]['second_atmp_text']?></h5>
                                                <?php }?>
                                                <p>Clues and Answers</p>
                                                <div style="margin-top: 20px;width:100%;">
                                                    <?php foreach($second_attempts as $second_attempt){?>
                                                        <span class="result">
                                                    <?php echo $second_attempt?>
                                                </span>
                                                    <?php }?>
                                                </div>

                                            </div>
                                            <div class="clue_ans_div_one" id="clue_ans_div_three" style="display: none;background: #fff;">
                                                <button type="button" class="slide-close-btn" id="attthree_close_btn">&#10006;</button>
                                                <?php if (isset($question_attempt[0]['three_atmp_text'])){?>
                                                    <!--                                                <h5>See</h5>-->
                                                    <h5><?php echo $question_attempt[0]['three_atmp_text']?></h5>
                                                <?php }?>
                                                <p>Clues and Answers</p>
                                                <div style="margin-top: 20px;width:100%">
                                                    <?php foreach($third_attempts as $third_attempt){?>
                                                        <span class="result">
                                                    <?php echo $third_attempt?>
                                                </span>
                                                    <?php }?>
                                                </div>

                                            </div>
                                            <div class="slide_content">


                                            </div>
                                            <div class="creatParagraph" style="margin-top: 40px;">

                                            </div>
                                        </div>

                                        <div class=" math_plus" style="width: 100%;">
                                            <div class="question_view" id="question_view" style="display: none;position: relative">
                                                <button type="button" class="slide-close-btn" id="q_close_btn">&#10006;</button>
                                                <div style="margin: 10px;"><?php echo $question_info['questionName']; ?></div>
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="margin-bottom: 20px;padding: 0px;">


                                            <div class="pag" id="pag_content" style="border: 1px solid #c3c3c3;padding: 10px;width: 400px;position: absolute;z-index: 20;left: 16%;bottom: 118%;display: none;">
                                                <button type="button" class="slide-close-btn" id="pg_close_btn">&#10006;</button>
                                                
                                                        <?php foreach ($question_info['sentence'] as $key => $value) {  ?>
                                                            <div style="padding-top:5px;" class="tab_1 tabdata_1<?php echo $key ?>">
                                                                
                                                                    <p style="line-height: 18px;" id="pg_single_content_<?php echo $key ?>"><?php echo $value?></p>
                                                                
                                                            </div>
                                                        <?php  } ?>
                                            </div>

                                            <div class="col-md-2"><button type="button" style="border: none;color: #fff;padding: 5px 10px;background: #2D91C8;" id="tab_slide">Slide</button></div>
                                            <div class="col-md-10" style="padding: 0px;">
                                                <div class="ss_pagination">
                                                    <div>
													<div style="background:#fff;z-index:200;height: 30px;position:absolute;left: 34%;top:-33px;display: none;margin: 5px auto;padding: 7px 15px;border-radius: 60px;border: 1px solid #ccc;font-size: 13px;" id="title_show"></div>
                                                        <button class="btn_work" style="color: #4c4a4a;background:#fff;border: none; padding: 2px;font-weight: 500;font-size: 13px;" type="button"
                                                                id="prevBtn1" onclick="nextPrev_1(-999)" >Previous</button>

                                                        <?php foreach ($question_info['sentence']  as $key => $sentence) { ?>
                                                            <button style="background: #fff; border: 1px solid #c5c4c4;padding:5px 10px;font-weight: 500;font-size: 13px;" class="steprs_1 number_11<?php echo
                                                            $key; ?>" style="width:45px;" id="qty2" value="<?php echo
                                                            count($question_info['sentence']); ?>" type="button" contentIndex="<?php echo $key ?>" onclick="showFixSlide_1(<?php
                                                            echo $key; ?> )"><?php echo $key+1; ?></button>
                                                        <?php } ?>

                                                        <button type="button" style="color: #4c4a4a;background:#fff;border: none; padding: 2px;font-weight: 500;font-size: 13px;" class="btn_work"
                                                                id="nextBtn1" onclick="nextPrev_1(99999)">Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12" style="text-align: center">
                                            <button class="btn btn_next" type="button" id="answer_matching">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-sm-1" style="text-align: center">

                    </div>


                    <div class="col-sm-4">
                        <div class="panel-group" id="raccordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
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
            
            <input type="hidden" name="para_sequence" id="para_sequence" value="">
            
        </form>
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
                    <video controls style="width: 100%" id="videoTag<?php echo $i; ?>">
                      <source src="<?php echo isset($question_instruct_vid[0]) ? trim($question_instruct_vid[0]) : '';?>" type="video/mp4">
                    </video>
                    <?php if (isset($question_instruct_vid[1]) && $question_instruct_vid[1] != null ): ?>
                        
                        <video controls style="width: 100%" id="videoTag<?php echo $i; ?>">
                          <source src="<?php echo isset($question_instruct_vid[1]) ? trim($question_instruct_vid[1]) : '';?>" type="video/mp4">
                        </video>
                    <?php endif ?>
                <?php }else{ ?>
                    <P>No question video</P>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue closeVideoModal" value="<?php echo $i; ?>" id="closeVideoModalId<?php echo $i; ?>" onclick="videoCloseWithModal(<?php echo $i; ?>);">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $i++; } ?>
<script>
    function showQuestionVideo(id){
      $('#ss_question_video'+id).modal('show');
    }
    function videoCloseWithModal(id){
      $('#ss_question_video'+id).modal('hide');
      var video = $('#videoTag'+id).get(0);
      if (video.paused === false) {
        video.pause();
      } 
    }
</script>

<!--Solution Modal-->
<div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="left: 5%;right: unset;">
    <div class="modal-dialog" role="document" style="max-width: 100%;">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
                <i class="fa fa-close" style="font-size:20px;color:red"></i> <span class="ss_extar_top20">Your answer is wrong</span>
                <br><?php echo $question_info_s[0]['question_solution']; ?>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
            </div>
        </div>
    </div>
</div>
        
<!--Times Up Modal-->
<div class="modal fade ss_modal" id="times_up_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="max-width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Times Up</h4>
            </div>
            <div class="modal-body row">
                <i class="fa fa-close" style="font-size:20px;color:red"></i> 
                <br><?php echo $question_info_s[0]['question_solution'] ?>
            </div>
            <div class="modal-footer">
                <button type="button" id="question_reload" class="btn btn_blue" data-dismiss="modal">close</button>         
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


<script>

    var array = [];
//    var another_array = {};
    function choose_sentence(order) {
        var sentence = $("#order_sentence" + order).val();
        var para_sequence = $("#para_sequence").val();

        if (!$('#order_' + order).length) {
            var html = '';
            $('#paragraphOrder_'+para_sequence).remove('');
            
            html = '<span id="order_' + order + '">' + sentence + '</span>\n\
                    <input type="hidden" id="student_ans_' + order + '" value="' + order + '" name="answer[]"> ';
                
            if(para_sequence) {
                
                var html1 = '';
                var concat_string = '';

                array[parseInt(para_sequence)-1].push(html.trim());
//                another_array.push(order);
                console.log(array.length);
                
                rearrange_sentence();
                
//                for(var i = 0; i < array[parseInt(para_sequence)-1].length; i++) {
//                    concat_string += array[parseInt(para_sequence)-1][i];
//                }
//                
                $("#ans_paragraph_"+order).val(para_sequence);
//                
                $("#redo_span"+order).attr('data-id', para_sequence);
////                console.log($("#redo_span"+order));
//                html1='<div style="display: block;margin-top: 20px;" id="paragraphOrder_' + para_sequence + '">\
//                           '+concat_string+'\
//                    </div>';
//                            
//                $('#set_sentence').append(html1);
            } else {
                $('#set_sentence').append(html);
            }
            
            $("#order_sentence" + order).val('');
        }
        console.log(array);
    }

    function redo_sentence(order) {
        if ($('span#order_' + order).text() != '') {
            var html = '<span id="order_' + order + '">' + $('span#order_' + order).text().trim() + '</span>\n\
                        <input type="hidden" id="student_ans_' + order + '" value="' + order + '" name="answer[]"> ';
            
            $("#order_sentence" + order).val($('span#order_' + order).text());
            $('#set_sentence').find('span#order_' + order).remove();
            $('#set_sentence').find('input#student_ans_' + order).remove();
            
            $("#ans_paragraph_"+order).val('');
            
            var array_index = $("#redo_span"+order).attr("data-id");
            
//            var index =  array[parseInt(array_index)-1].indexOf(html.trim());
            var index =  isItemInArray(array[parseInt(array_index)-1], html.trim());
            
            if (index !== -1) {
                array[parseInt(array_index)-1].splice(index, 1);
            }
            $("#redo_span"+order).attr('data-id', '');
            
//            console.log(array);
        }

    }
    
    function isItemInArray(arr, value){
        for(var i = 0; i < arr.length; i++){
            var name = arr[i].trim();
            
            if(name.replace(/\s/g, '') === value.replace(/\s/g, '')){
                return i;
            }
        }

        return false;
    }

    $("input").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $("form").submit();
        }
    });
    
    var btn_click = 0;
    
    $("#create_paragraph").click(function () {
        btn_click++;
        var add_btn = '\
                        <div class="paragraph_sequence" id="para_sequence'+btn_click+'">\n\
                            <button class="btn btn-default" style="margin: 0px 5px 5px 5px;" type="button" onclick="set_senetence_paragraph('+btn_click+')">'+btn_click+'</button>\n\
                            <button type="button" onclick="redo_paragraph('+btn_click+')">Redo</button>\n\
                        </div>';
        var inputs = $(".questionOrder");
        $("#para_sequence").val(btn_click);
        array[parseInt(btn_click-1)] = [];
        console.log(array);
//        array = [];
        
        $('.order').append(add_btn);
    });
    
    function set_senetence_paragraph(btn_click) {
        $("#para_sequence").val(btn_click);
    }
    
    function redo_paragraph(redo_btn_click) {
        var new_array = [];
        if(array[parseInt(redo_btn_click) - 1] && array[parseInt(redo_btn_click) - 1].length > 0){
//            alert(array[redo_btn_click].length);
            $("#paragraphOrder_"+redo_btn_click+" :input").each(function() {
                $("#order_sentence" + $(this).val()).val($('span#order_' + $(this).val()).text());
                $("#redo_span" + $(this).val()).attr('data-id', '');

                $("#ans_paragraph_" + $(this).val()).val('');


                $('#set_sentence').find('span#order_' + $(this).val()).remove();
                $('#set_sentence').find('input#student_ans_' + $(this).val()).remove();

            });
            
            
    //        array.splice(btn_click, 1);
    //        delete array[redo_btn_click];
            
            for(var i = 0; i < array.length; i++){
                if(i != parseInt(redo_btn_click) - 1){
                    new_array.push(array[i]);
                }

            }
            $("#para_sequence").val(new_array.length);
    //        console.log(array);
            array = new_array;
            console.log(array);
            $('#set_sentence').html('');
            
            
            rearrange_sentence();
        }
        btn_click = parseInt(new_array.length);
        $('#para_sequence').removeAttr('value');
        $('#paragraphOrder_' + redo_btn_click).remove();
        
        $("#para_sequence"+redo_btn_click).remove();
        var count = 1;

        $(".paragraph_sequence").each(function() {
            $(this).attr('id','para_sequence' + count);
            $(this).find( "button:first-child" ).html(count);
            $(this).find( "button:first-child" ).attr("onclick", "set_senetence_paragraph("+count+")");

            $(this).find( "button:first-child" ).next().attr("onclick", "redo_paragraph("+count+")");

            count++;

        });
        
        
    }
    
    function rearrange_sentence() {
        $('#set_sentence').html('');
        for(var i = 0; i < array.length; i++){
            var new_html = '';
            var html1 = '';
            for(j = 0; j < array[i].length; j++){
                new_html+= array[i][j];
            }
//            
            html1='<div style="display: block;margin-top: 20px;" id="paragraphOrder_' + parseInt(i + 1) + '">\
                           '+new_html+'\
                    </div>';

            $('#set_sentence').append(html1);

        }
    }
    
//    $('#answer_matching').click(function () {
    // $("#answer_form").on('submit', function (e) {
        // e.preventDefault();
        // var form = $("#answer_form");
        
        // $.ajax({
            // type: 'POST',
            // url: 'answer_creative_quiz',
            // data: form.serialize(),
            // dataType: 'html',
            // success: function (results) {
                // if (results == 6) {
                    // window.location.href = 'Preview/show_tutorial_result/'+$("#module_id").val();
                // }
                // if (results == 5) {
                    // window.location.href = 'module_preview/'+$("#module_id").val()+'/'+$('#next_question').val();
                // }
                // if (results == 3) {
                    // var values = $("input[name='answer[]']").map(function(){
                        // return $(this).val();
                    // }).get();
                    // var term = [];
                    
                    // var total_sentence = <?php echo count($question_info['sentence']); ?>;
                    // var question_answer = <?php echo $question_info_s[0]['answer']; ?>;
                    // var question_description = <?php echo $question_info_s[0]['questionDescription']; ?>;
                    // var paragraph_order = <?php if(isset($question_info['paragraph_order'])){echo json_encode($question_info['paragraph_order']);} else {?> [] <?php } ?>;
                    // console.log(question_description);
                    // $(".wrong_span").empty();
                    // console.log(values);
                    // var j = 1;
                    
                    // for(var i = 0; i < values.length; i++){
                        // if(test_value_in_range(parseInt(i+1), values) == true) {
                            
                        // }
                        // $("#wrong_span"+values[i]).html(question_description[parseInt(values[i]) - 1] + " <i class='fa fa-times' style='font-size: 13px;'></i>");
                        
                        // if(paragraph_order[parseInt(values[i]) - 1] && $("#redo_span"+values[i]).data("id") != paragraph_order[parseInt(values[i]) - 1]){
                            // $("#wrong_span"+values[i]).html("Choose wrong paragraph <i class='fa fa-times' style='font-size: 13px;'></i>");
                        // }
                    // }
                    
                    // for(var i = 0; i < total_sentence; i++){
                        
                        // if (typeof question_answer[i] !== 'undefined') {
                            // $("#order_span"+question_answer[i]).html('SL:'+j);
                        // }
                        
                        // j++;
                    // }
                    
                    // $('#ss_info_worng').modal('show');
                // } if (results == 2) {
                    // var next_question = $("#next_question").val();
                    // if(next_question != 0) {
                        // var question_order_link = $('#question_order_link').attr('href');
                    // } if(next_question == 0) {
                        // var question_order_link = 'Preview/show_tutorial_result/'+$("#module_id").val();
                    // }

                    // $("#next_qustion_link").attr("href", question_order_link);
                    // $('#ss_info_sucesss').modal('show');
                // }

            // }
        // });

    // });
    
    function test_value_in_range(number, ranges) {
        for (var i = 0; i < ranges.length; ++i) {
            if (number == ranges[i]) {
                return true;
            }
        }
    }

    function showDescription(){
        $('#ss_info_description').modal('show');
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
                url: 'answer_creative_quiz',
                data: form.serialize(),
                dataType: 'html',
                success: function (results) {
                    if (results == 6) {
                        window.location.href = 'Preview/show_tutorial_result/'+$("#module_id").val();
                    }
                    if (results == 5) {
                        window.location.href = 'module_preview/'+$("#module_id").val()+'/'+$('#next_question').val();
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


<!--aftab script-->
<script>
    $("#tab_slide").click(function () {
        $("#tab_slide_view").show();
    });
    $("#slide_close_btn").click(function () {
        $("#tab_slide_view").hide();
    });

    $("#Question").click(function () {
        $("#question_view").show();
    });
    $("#q_close_btn").click(function () {
        $("#question_view").hide();
    });
    $("#pg_close_btn").click(function () {
        $("#pag_content").hide();
    });
    $("#report_close_btn").click(function () {
        $(".ans_report").hide();
    });

    $("#att_close_btn").click(function () {
        $("#clue_ans_div_one").hide();
    });
    $("#atttwo_close_btn").click(function () {
        $("#clue_ans_div_two").hide();
    });
    $("#attthree_close_btn").click(function () {
        $("#clue_ans_div_three").hide();
    });
</script>
<script>

    var DisplayContent = <?php echo json_encode($question_info['sentence']); ?>;

    $( document ).ready(function() {

    });
    // console.log(DisplayContent);
</script>


<script>
    var pid = 0;
    var ArrayIndex =0;
    var currentTab2 = 0;
    var ParagraphContent = [];
    var ParagraphContentId = [];
    ParagraphContent[pid] = [];
    ParagraphContentId[pid] = [];
    var ColorArray = [];
    ColorArray[0] = 'colorZero';
    ColorArray[1] = 'colorOne';
    ColorArray[2] = 'colorTwo';
    ColorArray[3] = 'colorThree';
    ColorArray[4] = 'colorFour';
    ColorArray[5] = 'colorFive';
    ColorArray[6] = 'colorSix';
    ColorArray[7] = 'colorSeven';
    ColorArray[8] = 'colorEight';
    ColorArray[9] = 'colorNine';
    // ColorArray[10] = 'colorTen';

    // $('.number_11'+0).addClass("activtab");
    // Current tab is set to be the first tab (0)
    showTab1(currentTab2); // Display the current tab
    // $('#pag_content').show();
    // $('.number_11'+currentTab2).css("background","#cccccc");

    var qty2 = $("#qty2").val();

    for (i = 0; i < 10; i++) {
        $('.number_11'+i).show();
    }
    for (i = 10; i < qty2; i++) {
        $('.number_11'+i).hide();
    }

    function showTab1(n) {
        $('.tab_1').hide();
        // $('#pag_content').show();
        $('.tabdata_1'+n).show();
    }

    // $(".steprs_1").click(function () {
    //     var classValue = $('.steprs_1').hasClass('activtab');
    //     if (classValue == true)
    //     {
    //         // $('.activtab').css("background","#cccccc");
    //     }
    // });
    function showFixSlide_1(n) {

        $('.number_11'+n).css("background","#cccccc");
        $('#pag_content').show();
        var tag_value = $('#pg_single_content_'+n).html();
        $('#content_input').val(tag_value);
        $("#content_input").attr("contentId",n);

        $(".steprs_1").each(function( index ) {
            $(this).removeClass("activtab");
        });
        $('.number_11'+n).addClass("activtab");

        ColorMethod(n);
        currentTab2 = n;
        showTab1(n);
        // fixStepIndicator1(n);
    }
    $("#Choose_slide").click(function () {
        var id = $("#content_input").attr("contentId");
        var contentValue = $('#content_input').val();
        var CPClass = $('#Create_Paragraph').hasClass('paragraphActive');

        if (id != undefined && id != '')
        {
            var ChooseResult = searchObject(id);
            if (ChooseResult != true)
            {
                if (CPClass == true)
                {
                    ParagraphIncrement();
                    // $('.activtab').css("background","#4dd64d");
                    $('.activtab').addClass(ColorArray[pid]);
                }else
                {
                    incrementInit(id,contentValue,ArrayIndex);
                    ArrayIndex++;

                    var classValue = $('.steprs_1').hasClass('activtab');
                    if(classValue == true)
                    {
                        // $(".activtab").css("background","yellow");
                        $('.activtab').addClass(ColorArray[pid]);
                    }
                }
            }else
            {
                alert('already added this item.')
            }


        }else
        {
            console.log('id is null');
        }
        console.log(ParagraphContentId);
    });

    function ShowContent(ParagraphContentId)
    {
        var html ='';
        var paraId = '';
        var tempParagraphId = 0;
        for(var x = 0;x<ParagraphContentId.length;x++)
        {
            if(tempParagraphId != x){
                html+='<p style="color: #fff;margin-bottom: 30px;clear: both"></p>';
                tempParagraphId = x;
            }
            for (var y=0;y<ParagraphContentId[x].length;y++)
            {
                  paraId = ParagraphContentId[x][y];

                if (DisplayContent[paraId])
                {
                    html +='<span style="background: #fff;line-height: normal" class="span_'+paraId+'">'+DisplayContent[paraId]+'</span>';
                }
            }
        }
        $(".slide_content").html(html);
    }
    function incrementInit(id,value,ArrayIndex) {
        var Exit = searchObject(id);
        if (Exit != true)
        {
            if (id != '') {
                ParagraphContentId[pid][ArrayIndex] = id;
            }

        }else
        {
            alert('already added this item.')
        }
        ShowContent(ParagraphContentId);

    };

    $("#Create_Paragraph").click(function () {

        var id = $("#content_input").attr("contentId");


            if (id !== undefined && id != '')
            {
                var pResult = searchObject(id);
                if (pResult != true)
                {
                    $('#Create_Paragraph').addClass("paragraphActive");

                    // $('.number_11'+id).css("background","#4dd64d");

                    ArrayIndex =0;
                    pid++;
                    ParagraphContentId[pid] = [];
                    ParagraphIncrement();
                    if (pid != 0)
                    {
                        $('.number_11'+id).addClass(ColorArray[pid]);
                    }
                }else
                {
                    alert('already added this item.')
                }
            }else
            {
                console.log('value is undefined');
            }
        // console.log(ParagraphContentId);

    });
    function ParagraphIncrement() {
        var id = $("#content_input").attr("contentId");
        var contentValue = $('#content_input').val();
        // ArrayIndex =0;
        incrementInit(id,contentValue,ArrayIndex);
        ArrayIndex++;
    }
    function searchObject(id){
        if (ParagraphContentId[0].length >0)
        {
            for (var i=0; i < ParagraphContentId.length; i++) {
                for(var j =0;j<ParagraphContentId[i].length;j++)
                {
                    // console.log('hi'+ParagraphContent[i][j]);
                    if (ParagraphContentId[i][j] === id) {
                        return true;
                    }
                }
            }
        }

    };

    function isPresentIdPop(idOfRedo) {
        for(var m=0; m<ParagraphContentId.length; m++){
            var MainIndex = m;
            for (var n=0;n<ParagraphContentId[m].length;n++)
            {
                var contentId = ParagraphContentId[m][n];
                var contentIndex = n;

                if(contentId == idOfRedo){
                    $('.number_11'+idOfRedo).removeClass(ColorArray[m]);
                    ParagraphContentId[m].splice((contentIndex), 1);

                    console.log(ParagraphContentId[m]);
                }else {
                    ParagraphContentId[m][n] = contentId;
                }
            }
            ParagraphContentId[m] = reindex_array_keys(ParagraphContentId[m]);
        }
        if (ParagraphContentId && ParagraphContentId[0].length > 0) {
                for (var i = 0;i<ParagraphContentId.length;i++)
                {
                    for(var j =0;j<ParagraphContentId[i].length;j++)
                    {
                        var n_value = ParagraphContentId[i][j];

                        if (i == 0)
                        {
                                $('.number_11'+n_value).css("background","#ffff00");
                                $('.number_11'+idOfRedo).css("background","#fff");
                        }else
                        {
                            $('.number_11'+n_value).css("background","#4dd64d");
                            $('.number_11'+idOfRedo).css("background","#fff");
                        }
                    }
                }
        }
        ShowContent(ParagraphContentId);
    }
    function reindex_array_keys(array, start){
        var temp = [];
        start = typeof start == 'undefined' ? 0 : start;
        start = typeof start != 'number' ? 0 : start;
        for(var i in array){
            temp[start++] = array[i];
        }
        return temp;
    }
    $("#content_Redo").click(function () {

        // $('#Create_Paragraph').removeClass("paragraphActive");
        var idOfRedo = $("#content_input").attr("contentId");
        $('.number_11'+idOfRedo).removeClass("activtab");
         isPresentIdPop(idOfRedo);
		 ArrayIndex--;
         console.log(idOfRedo);
    });
    $( ".steprs_1" ).mouseover(function () {
        var index = $(this).attr("contentIndex");

        if (ParagraphContentId.length>0)
        {
            for (var h=0;h<ParagraphContentId.length;h++)
            {
                for (var k = 0;k<ParagraphContentId[h].length;k++)
                {
                    var cId = ParagraphContentId[h][k];
                    if (cId == index)
                    {
                        if (h == 0)
                        {

                            $("#title_show").html('Choose');
                            $("#title_show").show();
                        }else
                        {
                            $("#title_show").html('paragraph'+h);
                            $("#title_show").show();
                        }
                    }
                }
            }
        }
    });
    $(".steprs_1").mouseout(function() {
        $("#title_show").hide();
    });

    $("#Clear_all").click(function () {

        if (ParagraphContentId.length>0)
        {
            console.log(ParagraphContentId);
            for (var x=0;x<ParagraphContentId.length;x++)
            {
                for (var y = 0;y<ParagraphContentId[x].length;y++)
                {
                    var dId  = ParagraphContentId[x][y];
                    $('.number_11'+dId).removeClass(ColorArray[x]);
                }
            }
        }
        pid = 0;
        ArrayIndex =0;
        ParagraphContent = [];
        ParagraphContentId =[];
        ParagraphContentId[pid] = [];
        $(".slide_content").html(ParagraphContent);
        $(".steprs_1").css("background","white");
        $('#Create_Paragraph').removeClass("paragraphActive");
        $(".steprs_1").each(function( index ) {
            $(this).removeClass("activtab");
        });
        $("#content_input").attr("contentId",'');


    });
    function ColorMethod(n) {
        var ActiveClass = $('.number_11'+n).hasClass('activtab');
        var CPClass = $('#Create_Paragraph').hasClass('paragraphActive');
        if (ParagraphContentId.length > 0) {
            if (ActiveClass == true)
            {
                for (var i = 0;i<ParagraphContentId.length;i++)
                {
                    for(var j =0;j<ParagraphContentId[i].length;j++)
                    {
                        var n_value = ParagraphContentId[i][j];
                        if (i == 0)
                        {
                            if (ParagraphContentId[i][j] == n)
                            {
                                $('.span_'+n).css("background","#ffff00");
                                $('.number_11'+n).css("background","#ffff00");
                            }else
                            {
                                $('.span_'+n_value).css("background","#fff");
                                $('.number_11'+n_value).css("background","#ffff00");
                            }
                        }else
                        {
                            if (ParagraphContentId[i][j] == n)
                            {
                                $('.span_'+n).css("background","#ffff00");
                                $('.number_11'+n).css("background","#4dd64d");
                            }else
                            {
                                $('.span_'+n_value).css("background","#fff");
                                $('.number_11'+n_value).css("background","#4dd64d");
                            }
                        }

                    }
                }
            }
        }
    }
    function nextPrev_1(n){



        //previous clicked
        if(n <0 ){

            currentTab2 = currentTab2 - 1;
            console.log(currentTab2);
            // return false;
            $('#pag_content').show();
            fixStepIndicator1(currentTab2);
            if (currentTab2 != -1)
            {
                $('.number_11'+currentTab2).css("background","#cccccc");
                var MinusId = currentTab2+1;
                $('.number_11'+MinusId).css("background","#fff");
                $("#content_input").attr("contentId",currentTab2);
                ColorMethod(currentTab2);
            }
            if(currentTab2<0) currentTab2 = 0;
        }
        //next clicked
        else{
            currentTab2 = currentTab2 + 1;
            console.log(currentTab2);
            $('#pag_content').show();
            fixStepIndicator1(currentTab2);
            if (currentTab2 != 10)
            {
                $('.number_11'+currentTab2).css("background","#cccccc");
                var MinusId = currentTab2-1;
                $('.number_11'+MinusId).css("background","#fff");
                $("#content_input").attr("contentId",currentTab2);
                ColorMethod(currentTab2);
            }
            if(currentTab2 >= qty2) currentTab2 = qty2 - 1;
        }


        fixStepIndicator1();
        showTab1(currentTab2);

    }


    function fixStepIndicator1(currentTab) {

        x = currentTab2;

        $('.number_11'+parseInt(currentTab2 -
            1)).removeClass("activtab");
        $('.number_11'+parseInt(currentTab2 +
            1)).removeClass("activtab");
        $('.number_11'+currentTab2).addClass("activtab");
        // return false;
        if(x>=10){

            s_1 = x+9;
            var s_2 =x;

            for (i = s_2; i < s_1 + 1; i++) {
                $('.number_11'+i).show();
            }
            for (i = 0; i < s_2; i++) {
                $('.number_11'+i).hide();
            }
            for (i = s_1+1; i < qty2; i++) {
                $('.number_11'+i).hide();
            }

        }
        if(x<10){

            for (i = 0; i < 10; i++) {
                $('.number_11'+i).show();
            }
            for (i = 10; i < qty2; i++) {
                $('.number_11'+i).hide();
            }

        }

        // if( x <= qty2 && x >= qty2-10){
        //     for (i = qty2-10; i < qty2; i++) {
        //         $('.number_11'+i).show();
        //     }
        //
        //     for (i = 0; i < qty2-10; i++) {
        //         $('.number_11'+i).hide();
        //     }
        //
        // }
    }
</script>

<script>
    $('#answer_matching').click(function (event) {
        event.preventDefault();
        var questionId = $("#question_id").val();
        // var  valueOfContent = ParagraphContent;
        var  idOfContent = ParagraphContentId;
        var clue_id = $("#clue_inc").val();
        var myJSON = JSON.stringify(idOfContent);
		var module_id = $("#module_id").val();
        var current_order = $("#current_order").val();
        var next_question = $("#next_question").val();
		var last_question_order = $("#last_question_order").val();
        // console.log(idOfContent);
        // console.log(myJSON);
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url("module_creative_quiz_ans_matching")?>',
            data: {questionId:questionId,idOfContent:myJSON,clue_id:clue_id,module_id:module_id,current_order:current_order,answer:myJSON},
            success: function(response){
                var obj = JSON.parse(response);
			
                if(obj.msg == 'success')
                {
                    alert('Your answer is correct.')
					if (last_question_order == current_order)
                    {
                        window.location.href = 'Preview/show_tutorial_result/'+module_id;
                    }else
                    {
                        window.location.href = 'module_preview/'+module_id+'/'+next_question;
                    }
                }else
                {
                    var Sequence = obj.array_sequence;
                    if(Sequence != '')
					{
						alert(Sequence);
					}
                    var msgObj = obj.data.ErrorMessage;
                    var msgArray = Object.entries(msgObj);
                    showResultContent(msgArray,idOfContent);
                    $('.ans_report').show();
                    $("#clue_answer").prop("disabled",false);
                    // console.log(html);
                    var clue_show_id = obj.clue_id;
                    $('#clue_inc').val(clue_show_id);
					if (clue_show_id >0)
                    {
                        $("#clue_answer").css('background','red');
                    }
                    if (clue_show_id == 1)
                    {
                        $('#clue_ans_div_two').hide();
                        $('#clue_ans_div_three').hide();
                        $("#clue_answer").click(function () {
                            $("#clue_ans_div_one").show();
                        });
                    }else if (clue_show_id == 2)
                    {
                        $('#clue_ans_div_one').hide();
                        $('#clue_ans_div_three').hide();
                        $("#clue_answer").click(function () {
                            $("#clue_ans_div_two").show();
                        });


                        // $('#clue_ans_div_two').show();

                    }else if(clue_show_id == 3)
                    {
                        $('#clue_ans_div_one').hide();
                        $('#clue_ans_div_two').hide();
                        $("#clue_answer").click(function () {
                            $("#clue_ans_div_three").show();
                        });

                        // $('#clue_ans_div_three').show();
                    }
                }

            },
            error: function(){
                alert('Could not add data');
            }
        });
    });

    function checkPresent(id,msgArray){

        for (var x=0;x<msgArray.length;x++)
        {
            var pid = msgArray[x][0];
            if (id == pid)
            {
                return msgArray[x][1];
            }
        }
        return false;
    }


    function showResultContent(msgArray,ParagraphContentId) {
        var html ='';
        var paraId = '';
        var tempParagraphId = 0;
        var message ='';
        for(var x = 0;x<ParagraphContentId.length;x++)
        {

            if(tempParagraphId != x){
                html+='<p style="color: #fff;margin-bottom: 30px;clear: both"></p>';
                tempParagraphId = x;
            }
            for (var y=0;y<ParagraphContentId[x].length;y++)
            {
                paraId = ParagraphContentId[x][y];
               if (message = checkPresent(paraId,msgArray))
               {

                   if (DisplayContent[paraId])
                   {
					   html +='<br>';
                       html +='<span style="position: relative;line-height: 2;" class="span_'+paraId+'"><small style="position: absolute;color: red;font-size: 10px;top: -17px;left: 5px;width: 500px;">'+message+'</small>'+DisplayContent[paraId]+'</span>';
                   }
               }else
               {
                   if (DisplayContent[paraId]) {

                       html += '<span style=";background: #fff;line-height: 2;" class="span_' + paraId + '">' + DisplayContent[paraId] + '</span>';
                   }
               }
            }
        }
        $(".slide_content").html(html);
    };
</script>

<?php $this->load->view('module/preview/drawingBoard'); ?>
