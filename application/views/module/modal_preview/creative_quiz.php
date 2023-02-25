<style>
strong{
    color:#007AC9;
    },
</style>

<strong>Question Info</strong>
<br><br>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-2">
            <p style="color:red !important">Question:</p>
        </div>
        <div class="col-md-10">
            <?php echo  $additionalInfo['questionName']; ?>
        </div>
    </div>
</div>
<br>
<div class="col-md-12" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-2">
            <p style="color:red !important">Sentence:</p>
        </div>
        <div class="col-md-10">
            <?php if (isset($additionalInfo['sentence'])) : ?>

                <ol style="list-style: inherit !important;">
                    <?php foreach ($additionalInfo['sentence'] as $option) : ?>
                        <li style="line-height: 20px; list-style: decimal !important;"><?php echo $option; ?></li>
                    <?php endforeach; ?>
                </ol>

            <?php endif; ?>
        </div>
    </div>
</div>

<br><br>

<strong>Paragraph Order</strong>
<div class="">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-10">
                    <?php  foreach($additionalInfo['paragraph_order'] as $paragraph_order){?>
                        <div style="height: 40px;width: 40px; border: 1px solid #8c8c8c;margin-right: 5px;margin-bottom:10px;float: left;"><?php echo $paragraph_order?></div>
            <?php }?>
        </div>
    </div>
</div>
<br>
