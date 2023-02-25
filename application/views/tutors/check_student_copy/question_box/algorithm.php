<?php 
//    $question_info = $question_info_s[0]['questionName'];
    $st_ans = json_decode($tutorial_ans_info[0]['st_ans'],TRUE);
    $question_order = $question_info_s[0]['question_order'];
//    echo '<pre>';print_r($st_ans);die;
    
//    For Algorithm only
    if(isset($question_info['item'])) {
        end($question_info['item']);
        $last_item_index = key($question_info['item']);
    }
?>

<style>
    .abc{
        overflow: hidden;
    }
    .abc > div{
        float: right;
    }
    
    .operator_div{
        display: inline-block;
        position: relative;
        width: 0;
    }
    
    .operator_div span{
        position: absolute;
        bottom: -2px;
        left: -23px;
    }
</style>

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
                    <div class="math_plus">
                        <?php echo $question_info['questionName']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-4" style="text-align: center">
    <div class="row">

        <!--<strong class="text-center">
            <a onClick="show_workout()" style="text-decoration: underline;padding:10px;" >Workout</a>
        </strong>-->
        
        <div class="col-sm-12 times_table_div" style="text-align: center">
            <div style="font-size: 30px;">
                <?php if($question_info['operator'] != '/') {?>

                    <div style="border-bottom: 2px solid black;text-align: right;margin-bottom: 10px;">
                    <?php $i = 1;foreach ($question_info['item'] as $row) {
                        if($i == $last_item_index) {?>
                        <div class="operator_div"><span><?php echo $question_info['operator']?></span></div>
                        <?php }
                        foreach ($row as $key_data) {?>
                            <span><?php echo $key_data;?></span>
                        <?php }?>
                        <br>
                    <?php $i++; }?>
                    </div>
                
                    <input type="text" class="form-control" id="" name="answer" autocomplete="off" autofocus style="font-size: 30px;" readonly="" value="<?php echo json_decode($st_ans[$question_order]['student_ans']);?>">

                <?php } if($question_info['operator'] == '/') { 
                    $student_answer = json_decode($st_ans[$question_order]['student_ans']);?>
            
                    <div style="display: block;margin-top: 55px;">

                        <div class="form-group" style="float: left;">
                            <input type="text" class="form-control" id="" name="answer[]" autocomplete="off" autofocus style="font-size: 30px;max-width: 160px !important" readonly="" value="<?php echo $student_answer[0];?>">
                        </div>
                        <div class="form-group" style="float: left;margin-left: 30px;">
                            <label>R</label>
                            <input type="text" class="form-control" id="" name="answer[]" autocomplete="off" autofocus style="font-size: 30px;" readonly="" value="<?php echo $student_answer[1];?>">
                        </div>
                    </div>

                    <div style="float: left;padding: 5px;">
                        <?php foreach ($question_info['divisor'] as $divisor){
                            echo $divisor; 
                        }?>
                    </div>
                    <div style="float: left;padding: 5px;background-image: url('assets/images/44.png');padding: 3px 5px 6px 17px;background-image: url('assets/images/44.png');background-repeat: no-repeat;background-position: 0px 0px;min-height: 41px;">
                        <?php foreach ($question_info['dividend'] as $dividend){
                            echo $dividend; 
                        }?>
                    </div>

                <?php }?>
            </div>

        </div>

    </div>
</div>


