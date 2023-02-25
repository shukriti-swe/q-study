<style>
    strong{
        color:#007AC9;
    }
</style>

<strong>Question Info</strong>
<br><br>
<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-2">
        <p style="color:red !important">Question:</p>
    </div>
    <div class="col-md-9">
        <?php echo  $question->questionName; ?>
    </div>
</div>
<?php if (isset($question->pattern_type) && $question->pattern_type ==1){
    ?>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">
            <table class="table table-hover">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Left</th>
                    <th scope="col">Right</th>
                </tr>
                <?php
                $i = 1;
                foreach ($question->left_memorize_p_one as $key=>$left_memorize_p_one){?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $left_memorize_p_one;?></td>
                    <td><?php echo $question->right_memorize_p_one[$key];?></td>
                </tr>
                    <?php $i++; }?>
            </table>
        </div>
    </div>
<?php }?>
<?php if (isset($question->pattern_type) && $question->pattern_type ==2){
    ?>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">
            <table class="table table-hover">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Left</th>
                    <th scope="col">Right</th>
                </tr>
                <?php
                $i = 1;
                foreach ($question->left_memorize_p_two as $key=>$left_memorize_p_two){?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $left_memorize_p_two[0];?></td>
                        <td><?php echo $question->right_memorize_p_two[$key][0];?></td>
                    </tr>
                    <?php $i++; }?>
            </table>
        </div>
    </div>
<?php }?>
<?php if (isset($question->pattern_type) && $question->pattern_type == 3){
//    echo '<pre>';
//    print_r($question);
    ?>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">
            <table class="table table-hover">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Left</th>
                    <th scope="col">Right</th>
                </tr>
                <?php
                $i = 1;
                foreach ($question->left_memorize_p_three as $key=>$left_memorize_p_three){?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><img height="100;" width="100" src="<?php echo base_url('/').'assets/uploads/'?><?php echo $left_memorize_p_three;?>"></td>
                        <td><img height="100;" width="100" src="<?php echo base_url('/').'assets/uploads/'?><?php echo $question->right_memorize_p_three[$key];?>"></td>
                    </tr>
                    <?php $i++; }?>
            </table>
        </div>
    </div>
<?php }?>

