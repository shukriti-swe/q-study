<style>
strong{
    color:#007AC9;
    }
</style>

<strong>Question Info</strong>
<br><br>
<div class="row">
    <div class="col-md-1">
        <p style="color:red !important">Question:</p>
    </div>
    <div class="col-md-10">
        <?php echo  $additionalInfo['questionName']; ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-1" style="margin-right:4px;">
        <p style="color:red !important">Options:</p>
        <br>
    </div>
    <div class="col-md-4">
        <?php if (isset($additionalInfo['vocubulary_image'])) : ?>
            <?php
            $cnt=1;
            $answerOption = json_decode($quesInfo['answer']);
            $answerOption = (int)$answerOption[0]-1;
            $answer=$additionalInfo['vocubulary_image'];
            $answer = count($answer[$answerOption])?$answer[$answerOption][0]:''; //array index from 0
            ?>

            <ol style="list-style: inherit !important;">
                <?php foreach ($additionalInfo['vocubulary_image'] as $option) : ?>
                    <li style="list-style: decimal !important;"><?php echo $option[0]; ?></li>
                <?php endforeach; ?>
            </ol>
            
        <?php endif; ?>
    </div>
</div>

<br><br>

<strong>Answer</strong>
<div class="row">
    <div class="col-md-1">

    </div>
    <div class="col-md-8">
        <p style="float:left; width:2%;"><?php echo ($answerOption+1).'.'; ?></p><?php echo $answer; ?>
    </div>
</div>
<br>
