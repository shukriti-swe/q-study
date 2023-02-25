<style>
strong{
    color:#007AC9;
    },
</style>

<strong>Question Info</strong>
<br><br>

<br>
<div class="row">
    <div class="col-md-2" style="margin-right:4px;">
        <p style="color:red !important">Options:</p>
    </div>
    <div class="col-md-9">
<!--        <div class="row">-->
            <div class="col-md-12">
                <h4>Speech to text</h4>
                <?php if (isset($speech_to_text)) : ?>

                    <?php
                $i=1;
                    foreach ($speech_to_text as $option) : ?>
                        <p><?php echo $i;?>. <?php echo $option?></p>
                    <?php $i++?>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <div class="col-md-12">
                <h4>Image</h4>
                <?php if (isset($image)) : ?>

                    <?php foreach ($image as $option) : ?>
                        <p style="margin: 10px;display: inline-block;"><img style="width:200px;" src="<?php echo base_url()?>assets\images\<?php echo $option?>"></p>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <div class="col-md-12">
                <h4>Audio</h4>
                <?php if (isset($audio)) : ?>
                    <?php foreach ($audio as $option) : ?>
                        <p><?php echo $option?></p>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
<!--        </div>-->
    </div>
</div>

<br><br>
<br>
