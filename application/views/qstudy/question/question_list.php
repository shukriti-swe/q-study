<div class="row" >
    <div class="col-sm-2"></div>
    <div class="col-sm-10 ">
        <div class="ss_q_list_top">
            <form class="form-inline">

                <span>Quiz</span>

                <div class="form-group">
                    <select class="form-control" >
                        <option>Select Question type</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group">

                    <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
                </div>
                <button type="submit" class="btn btn_gray">To Go</button>
            </form>
            <a class="ss_q_link pull-left" href="#">Q- Dictionary</a>
        </div>
        <div class="ss_question_list">
                <?php foreach ($all_question_type as $key) {?>
            <div class="row">
                <div class="col-sm-3">
                    <ul class="ss_q_left"> 
                        <li><a href="<?php echo base_url();?>create-question/<?=$key['id']?>"><?php echo $key['questionType'];?></a></li>
<!--                        <li><a href="<?php echo base_url();?>create-question/2">True/False</a></li>
                        <li><a href="<?php echo base_url();?>create-question/3">Vocabulary</a></li>
                        <li><a href="#">Multiple Choice</a></li>
                        <li><a href="#">Multiple Response</a></li>
                        <li><a href="<?php echo base_url();?>create-question/6">Skip</a></li>
                        <li><a href="#">Matching</a></li>
                        <li><a href="#">Assignment</a></li>-->
                    </ul>
                </div>
                
                    <div class="col-sm-9">
                        <ul class="ss_question_menu">
                            <?php $i = 1;foreach ($all_question[$key['id']] as $row){?>
                            <li data-id="<?=$key['id']?>_<?=$i?>" id="q_<?=$i?>_<?=$key['id']?>" <?php if($i > 10){?>style="display: none;"<?php }?>>
                                <a href="question_edit/<?=$key['id']?>/<?=$row['id']?>">Q<?=$i?></a>
                            </li>
                            <?php $i++;}?>

                            <li class="ss_q_u_d" <?php if($i < 10){?>style="display: none;"<?php }?>>
                                <a id="upbutton_<?=$key['id']?>" onclick="fn_show_upper(1, <?=$key['id']?>,<?=$i-1?>)">
                                    <i class="fa fa-caret-up" aria-hidden="true"></i>
                                </a>
                                <span id="spinner_val_<?=$key['id']?>">1[49]</span>
                                <a id="downbutton_6" onclick="fn_show_upper(0, <?=$key['id']?>,<?=$i-1?>)">
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                </a>
                            </li>
                            <?php if($i > 10) {?>
                            <li class="ss_q_last">
                                <a href="question-edit/<?=$key['id']?>/<?=$row['id']?>">Q<?=$i-1?></a>
                            </li>
                            <li class="ss_q_total"><a onclick="lastTenquestion(<?=$key['id']?>,<?=$i-1?>)" >Q<?=$i-1?></a></li>
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

        //alert('div:' + vr + ' mod:' + vd + ' inter:' + vinterval);

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
        }

        if (spinnerval == 1) {
            for (var i=1;i <= 10;i++){
                $("#q_" + i + "_" + acat).show();
            }
        } else {
            var vstart = 10 * spinnerval;
            vstart = (vstart - 10) + 1;

            for (var i = vstart;i <= (10 * spinnerval);i++) {
                $("#q_" + i + "_" + acat).show();
            }
        }
    }
    
    function lastTenquestion(acat, acount){
	var vinterval = acount / 10;
	vinterval = Math.ceil(vinterval) - 1;
	$("#spinner_val_" + acat +"").html(vinterval + '[' + acount + ']');
	fn_show_upper(1,acat, acount);
    }
</script>