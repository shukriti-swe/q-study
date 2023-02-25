<style>
strong{
    color:#007AC9;
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
<?php

if (isset($additionalInfo['item'])) {
    end($additionalInfo['item']);
    $last_item_index = key($additionalInfo['item']);
}

?>
<strong>Question Info</strong>
<br><br>
<div class="row">
    <div class="col-md-1">
        <p style="color:red !important">Question:</p>
    </div>
    <div class="col-md-10">
        <!-- <?php echo  $quesInfo['questionName']; ?> -->
        <div class="row">
            <strong class="text-center">
                <a href="javascript:void(0)" style="text-decoration: underline;padding:10px;" onclick="showDrawBoard()">Workout</a>
            </strong>
            <div class="col-sm-12 times_table_div" style="<?php if ($additionalInfo['operator'] != '/') {
                ?>text-align: center<?php
            }?>">
            <div style="font-size: 30px;">
                <?php if ($additionalInfo['operator'] != '/') {?>
                    <div style="border-bottom: 2px solid black;text-align: right;margin-bottom: 10px;">
                        <?php $i = 1;foreach ($additionalInfo['item'] as $row) {
                            if ($i == $last_item_index) {?>
                                <div class="operator_div"><span><?php echo $additionalInfo['operator']?></span></div>
                            <?php }
                            foreach ($row as $key_data) {?>
                                <span><?php echo $key_data;?></span>
                                <?php }?><br>
                                <?php $i++;
                            }?>
                        </div>
                        <input type="text" class="form-control" id="" name="result" autocomplete="off" autofocus style="font-size: 30px;" readonly>
                    <?php } if ($additionalInfo['operator'] == '/') {?>
                        <div style="display: block;margin-top: 55px;">
                            <div class="form-group" style="float: left;">
                                <input type="text" class="form-control" id="" name="result" autocomplete="off" autofocus style="font-size: 30px;max-width: 160px !important" readonly>
                            </div>
                            <div class="form-group" style="float: left;margin-left: 30px;">
                                <label>R</label>
                                <input type="text" class="form-control" id="" name="result" autocomplete="off" autofocus style="font-size: 30px;" readonly="">
                            </div>

                        </div>

                        <div>
                            <div id="quesBody" style="float: left;padding: 5px;">
                                <?php foreach ($additionalInfo['divisor'] as $divisor) {
                                    echo $divisor;
                                }?><span class="dividend"><?php foreach ($additionalInfo['dividend'] as $dividend) {
                                    echo $dividend;
                                }?></span>
                            </div>

                        </div>

                    <?php }?>
                </div>

            </div>

        </div>
    </div>
</div>

<br><br>
<strong>Answer</strong>
<p><?php echo json_decode($quesInfo['answer'])[0]; ?></p>
<br>
