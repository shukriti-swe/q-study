<?php 
    $question_info = $question_info_s[0]['questionName'];
    $st_ans = json_decode($tutorial_ans_info[0]['st_ans'],TRUE);
    $question_order = $question_info_s[0]['question_order'];
//    echo '<pre>';print_r($question_info);die;
?>


<!-- <div class="col-sm-2">
    <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">   Answer</a>
                </h4>
            </div>
            <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div class="math_plus">
                        <?php echo json_decode($st_ans[$question_order]['student_ans']);?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->



<div class="col-sm-8">

    <div class="storyWriteAnsBox">
         <div class="row">
            <div class="col-sm-4">
                <div id="ansPicture"></div>
            </div>
            <div class="col-sm-8">
                <div id="ansTitle"></div>
                <div id="ansIntro"></div>
                <div id="ansParagraph"></div><br>
                <div id="ansConclusion"></div><br>
            </div>
         </div>
    </div>

    <div class="storyWriteBody">

        <?php foreach ($question['titles'] as $key => $val)  { ?>
            <div class="storyWriteParts">
                <div class="firstElementStoryWrite"> <?= $val[0]; ?> </div>
                <div class="chooseBtnStoryWrite"> <button type="button" disabled id="titleBtn" class="titleBtn_<?= $key; ?> titleBtn 1 btn" onclick="rightOrWrong('<?= $val[1]; ?>' , '<?= $val[0]; ?>' , 'titleBtn_<?= $key; ?>' , 'titleBtn' , 1)">Choose</button>  </div>
            </div>
        <?php } ?>

        <br>

        <div class="storyWritePartsImage">
            <?php foreach ($question['picture'] as $key => $val)  { ?>
                    <div class="firstElementStoryWrite"> <img src="<?= base_url('/assets/uploads/').$val[0]; ?>" height="150px" width="150px"> </div><br> 
                    <div class="chooseBtnStoryWriteImg"> <button type="button" id="pictureBtn" class="pictureBtn_<?= $key; ?> pictureBtn 2 btn" style="display: none;" onclick="rightOrWrong('<?= $val[1]; ?>' , '<?= base_url('/assets/uploads/').$val[0]; ?>' , 'pictureBtn_<?= $key; ?>' , 'pictureBtn' , 2)">Choose</button>  </div>
            <?php } ?>
        </div>

        <br>

        <?php foreach ($question['Intro'] as $key => $val)  { ?>
            <div class="storyWriteParts">
                <div class="firstElementStoryWrite"> <?= $val[0]; ?> </div>
                <div class="chooseBtnStoryWrite"> <button type="button" id="introBtn" class="introBtn_<?= $key; ?> introBtn 3 btn" style="display: none;" onclick="rightOrWrong('<?= $val[1]; ?>', '<?= $val[0]; ?>' , 'introBtn_<?= $key; ?>' , 'introBtn' , 3)">Choose</button>  </div>
            </div>
        <?php } ?>

        <br>

        <?php $i=0; foreach ($question['paragraph'] as $key_2 => $val) { $paragraph_count = isset($val['Paragraph']) ? count($val['Paragraph']) : 0; $PuzzleParagraph = isset($val['PuzzleParagraph']) ? count($val['PuzzleParagraph']) : 0;  $RightAnswer = isset($val['RightAnswer']) ? count($val['RightAnswer']) : 0; $totalCount  = $RightAnswer + $paragraph_count + $PuzzleParagraph; $sl_no = $key_2;  ?>
            <div class="storyWriteParts">
                <?php foreach ($val as $key_3 => $value) {  ?>
                <?php foreach ($value as $key_4 => $values) { $i++;  ?>
                   <div class="firstElementStoryWrite paragraphFirstEm<?= $key_2; ?>"> <?= $values; ?> </div>

                   <?php if ($key_3 =="Paragraph") { $val[1] = "right_ones_xxx"; ?>
                       <div class="chooseBtnStoryWrite"> <button type="button" id="paragraphBtn" class="paragraphBtn_<?= $key_4; ?> paragraphBtn 4 btn offparagraph_<?= $key_2; ?> disabledButton<?= $i; ?>" style="display: none;" onclick="rightOrWrongParagraph('<?= $val[1]; ?>' , '<?= $values; ?>', 'paragraphBtn_<?= $key_4; ?>' , 'paragraphBtn' , 4 , '<?= $key_2; ?>' , '<?= $totalCount; ?>' , '<?= $i; ?>')">Choose</button></div>
                   <?php } ?>

                   <?php if ($key_3 =="RightAnswer") { $val[1] = "rightOne"; ?>
                       <div class="chooseBtnStoryWrite"> <button type="button" id="paragraphBtn" class="paragraphBtn_<?= $key_4; ?> paragraphBtn 4 btn offparagraph_<?= $key_2; ?> disabledButton<?= $i; ?>" style="display: none;" onclick="rightOrWrongParagraph('<?= $val[1]; ?>' , '<?= $values; ?>', 'paragraphBtn_<?= $key_4; ?>' , 'paragraphBtn' , 4 , '<?= $key_2; ?>' , '<?= $totalCount; ?>' , '<?= $i; ?>')">Choose</button></div>
                   <?php } ?>

                   <?php if ($key_3 =="PuzzleParagraph") { $val[1] = "wrong_ones_xxx"; ?>
                       <div class="chooseBtnStoryWrite"> <button type="button" id="paragraphBtn" class="paragraphBtn_<?= $key_4; ?> paragraphBtn 4 btn offparagraph_<?= $key_2; ?> disabledButton<?= $i; ?>" style="display: none;" onclick="rightOrWrongParagraph('<?= $val[1]; ?>' , '<?= $values; ?>', 'paragraphBtn_<?= $key_4; ?>' , 'paragraphBtn' , 4 , '<?= $key_2; ?>' , '<?= $totalCount; ?>' , '<?= $i; ?>')">Choose</button></div>
                   <?php } ?>

                   <?php if ($key_3 =="WrongAnswer") { $val[1] = $question['wrongParagraphIncrement'][$key_2]['WrongAnswer'][$key_4];  ?>
                       <div class="chooseBtnStoryWrite"> <button type="button" id="paragraphBtn" class="paragraphBtn_<?= $key_4; ?> paragraphBtn 4 btn offparagraph_<?= $key_2; ?> disabledButton<?= $i; ?>" style="display: none;" onclick="rightOrWrongParagraph('<?= $val[1]; ?>' , '<?= $values; ?>', 'paragraphBtn_<?= $key_4; ?>' , 'paragraphBtn' , 4 , '<?= $key_2; ?>' , '<?= $totalCount; ?>' , '<?= $i; ?>')">Choose</button></div>
                   <?php } ?>

                <?php } ?>
                <?php } ?>
            </div>
        <?php } ?>

        <br>

        <?php foreach ($question['conclution'] as $key => $val)  { ?>
            <div class="storyWriteParts">
                <div class="firstElementStoryWrite"> <?= $val[0]; ?> </div>
                <div class="chooseBtnStoryWrite"> <button type="button" id="conclutionBtn" class="conclutionBtn_<?= $key; ?> conclutionBtn 5 btn" style="display: none;" onclick="rightOrWrong('<?= $val[1]; ?>' , '<?= $val[0]; ?>', 'conclutionBtn_<?= $key; ?>' , 'conclutionBtn' , 5)">Choose</button>  </div>
            </div>
        <?php } ?>

        <br>
    </div>

</div>

<!--Solution Modal-->
<div class="modal fade ss_modal" id="msg_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body row">
                
                <span class="ss_extar_top20">
                    
                    <div id="question_msgShow"></div>
                    
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">close</button>         
            </div>
        </div>
    </div>
</div>
