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
<?php if (isset($question->question_hint)){?>
<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-2">
        <p style="color:red !important">Question Hint:</p>
    </div>
    <div class="col-md-9" style="line-height: 1.3">
        <?php echo  $question->question_hint; ?>
    </div>
</div>
<?php }?>
<?php if (isset($question->solution)){?>
<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-2">
        <p style="color:red !important">Question Solution:</p>
    </div>
    <div class="col-md-9">
        <?php echo  $question->solution; ?>
    </div>
</div>
<?php }?>
<br><br>
<strong>Answer</strong>
<p><?php echo $answer; ?></p>
<br>
