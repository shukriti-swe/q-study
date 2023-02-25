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
            
            <div class="row">
                <div class="ss_s_b_main" style="min-height: 100vh">
                    <div class="col-sm-4">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <span><img src="assets/images/icon_draw.png"> Instruction</span> Question
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

                                    <div class="panel-body">
                                        <div class=" math_plus">
                                            <?php echo $question_info['questionName']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4" style="text-align: center">
                        
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
                                                                <th>Description</th>                                                    
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
                                                                    <td style="<?php if ($question_info_s[0]['question_order'] == $ind['question_order']) {
                                                                        echo 'background-color: #99D9EA;';
                                                                    }?>">
                                                                    <?php echo $ind['question_order']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    echo $ind['questionMarks'];
                                                                    $total = $total + $ind['questionMarks'];
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $ind['questionMarks']; ?></td>
                                                                <td><a  class="text-center" onclick="showModalDes(<?php echo $i; ?>);"><img src="assets/images/icon_details.png"></a></td>
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

                    <div class="col-sm-12">
                        <div class="row">
                            
                            <div class="col-sm-6" style="padding: 10px;">
                                <?php $i = 1;foreach ($question_info['sentence'] as $sentence) {?>
                                <div class="input-group" style="display: flex;margin: 10px 0px;">
                                    <input type="text" class="form-control" id="order_sentence<?php echo $i;?>" value="<?php echo $sentence;?>" placeholder="<?php echo $sentence;?>" style="padding: 18px 12px;font-size: 13px;">
                                    <span class="input-group-addon" onclick="choose_sentence('<?=$i?>')" style="width: 100px;background-color: #2d91c8;color: #fff;cursor: pointer;">
                                        <strong style="line-height: 25px;">Choose</strong>
                                    </span>
                                    <button class="btn btn-info" type="button" onclick="redo_sentence('<?=$i?>')" style="padding: 8px 12px;background-color: #2d91c8;border: 1px solid #2d91c8;display: table;font-weight: bolder;margin-left: 10px;border-radius: 0px;">Redo</button>
                                </div>
                                <?php $i++;}?>
                            </div>
                            
                            <div class="col-sm-6">
                                <div id="set_sentence" style="font-size: 13px;line-height: 2;">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12" style="text-align: center">
                        <button class="btn btn_next" type="submit" id="answer_matching">Submit</button>
                    </div>

                </div>

            </div>
            
            
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
    function choose_sentence(order) {
        var sentence = $("#order_sentence"+order).val();
        if (!$('#order_'+order).length){
            var html = '';
            html = '<span id="order_'+order+'">'+sentence+'</span>\n\
                    <input type="hidden" id="student_ans_'+order+'" value="'+order+'" name="student_ans[]"> ';
            $('#set_sentence').append(html);
            $("#order_sentence"+order).val('');
        }
        
    }
    
    function redo_sentence(order) {
        if($('span#order_'+order).text() != ''){
            $("#order_sentence"+order).val($('span#order_'+order).text());
            $('#set_sentence').find('span#order_'+order).remove();
            $('#set_sentence').find('input#student_ans_'+order).remove();
        }
        
    }

    $("input").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $("form").submit();
        }
    });
    
//    $('#answer_matching').click(function () {
    $("#answer_form").on('submit', function (e) {
        e.preventDefault();
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
                $('#ss_info_worng').modal('show');
                } if (results == 2) {
                    var next_question = $("#next_question").val();
                    if(next_question != 0) {
                        var question_order_link = $('#question_order_link').attr('href');
                    } if(next_question == 0) {
                        var question_order_link = 'Preview/show_tutorial_result/'+$("#module_id").val();
                    }

                    $("#next_qustion_link").attr("href", question_order_link);
                    $('#ss_info_sucesss').modal('show');
                }

            }
        });

    });

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

<?php $this->load->view('module/preview/drawingBoard'); ?>
