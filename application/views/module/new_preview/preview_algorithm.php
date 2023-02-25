<?php
$key = $question_info_s[0]['question_order'];
$desired = $this->session->userdata('data');

if (isset($question_info['item'])) {
    end($question_info['item']);
    $last_item_index = key($question_info['item']);

    $i = 1;

    foreach ($question_info['item'][1] as $key => $value) {
        if (!empty($value)) {
            $index_q = $i;
            $i++;
        }
    }

    $i = 1;

    foreach ($question_info['item'][2] as $key => $value) {
        if (!empty($value)) {
            $index_ans = $i;
            $i++;
        }
    }

    $index = $index_q - $index_ans;

    if ($index > 1 ) {
        $px = -18 - ( 25 * ( $index - 1) );
    }else{
        $px = -18;
    }
}
//    print_r($desired);
?>


<style>
    .operator_div{
        display: inline-block;
        position: relative;
        width: 0;
    }

    .operator_div span{
        position: absolute;
        bottom: -2px;
        left: <?= $px ?>px;
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
    $question_instruct = isset($question_info_s[0]['question_video']) ? json_decode($question_info_s[0]['question_video']):'';
    $question_instruct_id = $question_info_s[0]['id'];
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
            <?php if (array_key_exists($key, $total_question)) { ?>
                <a class="btn btn_next" id="question_order_link" href="<?php echo base_url(); ?>module_preview/<?php echo $question_info_s[0]['module_id']; ?>/<?php echo $question_info_s[0]['question_order'] + 1; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Next</a>
            <?php } ?>          
            <a class="btn btn_next" id="draw" onClick="test()" data-toggle="modal" data-target=".bs-example-modal-lg">
                Workout <img src="assets/images/icon_draw.png">
            </a>
        </div>
    </div>
    <div class="container-fluid">
        <form id="preview_algorithm">
            <div class="row">
                <div class="ss_s_b_main" style="min-height: 100vh">
                    <div class="col-sm-4">
                        <span style="background: #959292;color: white; border: 5px solid #959292;"><img src="assets/images/icon_draw.png"> Instruction</span>
                    </div>
                    <div class="col-sm-4">

                      <div style="border:1px solid #dfdfdf;margin-bottom: 5px;">
                        <div class="math_plus">
                            <?php echo $question_info['questionName']; ?>
                        </div>
                        <input type="hidden" id="module_id" value="<?php echo $question_info_s[0]['module_id'] ?>" name="module_id">
                        <?php if (array_key_exists($key, $total_question)) { ?>
                            <input type="hidden" id="next_question" value="<?php echo $question_info_s[0]['question_order'] + 1; ?>" name="next_question" />
                        <?php } else { ?>
                            <input type="hidden" id="next_question" value="0" name="next_question" />
                        <?php } ?>
                        <input type="hidden" value="<?php echo $question_info_s[0]['question_id']; ?>" name="question_id" id="question_id">
                        <input type="hidden" id="current_order" value="<?php echo $key; ?>" name="current_order">
                        <input type='hidden' id="module_type" value="<?php echo $question_info_s[0]['moduleType']; ?>" name='module_type'>

                        <div class="row">

                            <div class="col-sm-12 times_table_div" style="<?php if ($question_info['operator'] != '/') { ?>text-align: center<?php } ?>">
                                <div style="font-size: 30px;">
                                    <?php if ($question_info['operator'] != '/') { ?>
                                        <div id="quesBody" style="padding: 0px 10px;border-bottom: 2px solid black;text-align: right;margin-bottom: 10px;">
                                            <?php $i = 1;
                                            foreach ($question_info['item'] as $row) {
                                                if ($i == $last_item_index) {
                                                    ?>
                                                    <div class="operator_div">
                                                        <span><?php echo $question_info['operator'] ?></span>
                                                    </div>
                                                <?php }
                                                foreach ($row as $key_data) {
                                                    ?>
                                                    <span><?php echo $key_data; ?></span>
                                            <?php } ?><br>
                                            <?php $i++;
                                        } ?>
                                        </div>
                                        
                                    <?php } if ($question_info['operator'] == '/') { ?>
                                        <div style="display: block;margin-top: 55px;">
                                            <div class="form-group" style="float: left;">
                                                <input type="text" class="form-control" id="" name="answer[]" autocomplete="off" autofocus style="font-size: 30px;max-width: 160px !important">
                                            </div>
                                            <div class="form-group" style="float: left;margin-left: 30px;">
                                                <label>R</label>
                                                <input type="text" class="form-control" id="" name="answer[]" autocomplete="off" autofocus style="font-size: 30px;">
                                            </div>

                                        </div>

                                        <div>
                                            <div id="quesBody" style="float: left;padding: 5px;">
                                                <?php
                                                foreach ($question_info['divisor'] as $divisor) {
                                                    echo $divisor;
                                                }
                                                ?><span class="dividend">
                                                    <?php
                                                    foreach ($question_info['dividend'] as $dividend) {
                                                        echo $dividend;
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <!--<div style="float: left;padding: 5px;background-image: url('assets/images/44.png');padding: 3px 5px 6px 17px;background-repeat: no-repeat;background-position: 0px 0px;min-height: 41px;">
                                            <?php
                                            foreach ($question_info['dividend'] as $dividend) {
                                                echo $dividend;
                                            }
                                            ?>
                                            </div>-->
                                        </div>

                                    <?php } ?>
                                </div>

                                <?php if ($question_info['operator'] != '/') { ?>
                                  <input type="text" class="form-control" id="" name="answer" autocomplete="off" autofocus style="font-size: 30px; margin-bottom: 10px;">
                                <?php } ?>

                            </div>

                        </div>
                      </div>

                        <div class="col-sm-12" style="text-align: center;margin-top: 30px;">
                            <button class="btn btn_next" id="answer_matching" type="submit">Submit</button>
                        </div> 

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

                    <div class="col-sm-4" id="draggable" style="display: none;">
                        <div class="panel-group" id="waccordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#waccordion" href="#collapseworkout" aria-expanded="true" aria-controls="collapseworkout">  Workout</a>
                                    </h4>
                                </div>
                                <div id="collapseworkout" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body" id="setWorkoutHere">
                                        <textarea name="workout" class="mytextarea"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--<div class="col-sm-12" style="text-align: center;">
                        <button class="btn btn_next" id="answer_matching" type="submit">Submit</button>
                    </div> -->              
                </div>

            </div>
        </form>
    </div>
</div>


<div class="modal fade ss_modal" id="ss_info_sucesss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
                <img src="assets/images/icon_sucess.png" class="pull-left"> 
        <span class="ss_extar_top20">Your answer is correct</span>

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


<div class="modal fade ss_modal" id="ss_info_worng" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
                <i class="fa fa-close" style="font-size:20px;color:red"></i> <span class="ss_extar_top20">Your answer is wrong</span>
                <br>
                <?php echo $question_info_s[0]['question_solution']; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
            </div>
        </div>
    </div>
</div>
<?php $i = 1;
foreach ($total_question as $ind) {
    ?>
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
<?php $i++; } ?>
<script>

//    $('#answer_matching').click(function () {
    $("#preview_algorithm").on('submit', function (e) {
        e.preventDefault();
        var workout_val = document.querySelector('[name="workout"]').value;
        
        if(workout_val == ''){
            alert('You have to do workout first');
        } else {
            var form = $("#preview_algorithm");
            $.ajax({
                type: 'POST',
                url: 'answer_algorithm',
                data: form.serialize(),
                dataType: 'html',
                success: function (results) {
                    var next_question = $("#next_question").val();
                    if (next_question != 0) {
                        var question_order_link = $('#question_order_link').attr('href');
                    }
                    if (next_question == 0) {
                        var question_order_link = 'Preview/show_tutorial_result/' + $("#module_id").val();
                    }

                   if (results == 6) {
                       window.location.href = 'Preview/show_tutorial_result/'+$("#module_id").val();
                   }
                   if (results == 5) {
                       window.location.href = 'module_preview/'+$("#module_id").val()+'/'+$('#next_question').val();
                   }
                   if (results == 2) {
                       $("#next_qustion_link").attr("href", question_order_link);
                       $('#ss_info_sucesss').modal('show');
                   } if (results == 3) {
                       $('#ss_info_worng').modal('show');
                   }
                }
            }); 
        }
        
        

    });

    function showModalDes(e)
    {
        $('#show_description_' + e).modal('show');
    }
</script>

<?php $this->load->view('students/question_module_type_tutorial/drawingBoard'); ?>