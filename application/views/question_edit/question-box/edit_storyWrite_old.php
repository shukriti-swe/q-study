<style type="text/css">
    .storyWriteBody .storyWritePartsImage {
        display: flex;
        overflow: auto;
        width: 1210px!important;
    }
    .err{
        color: red;
    }

    .custom-file-input::-webkit-file-upload-button {
      visibility: hidden;
    }
    .custom-file-input::before {
      content: 'Upload Image Here';
      display: inline-block;
      background: linear-gradient(top, #f9f9f9, #e3e3e3);
      border: 1px solid #999;
      border-radius: 3px;
      padding: 5px 8px;
      outline: none;
      white-space: nowrap;
      -webkit-user-select: none;
      cursor: pointer;
      text-shadow: 1px 1px #fff;
      font-weight: 700;
      font-size: 10pt;
    }
    .custom-file-input:hover::before {
      border-color: black;
    }
    .custom-file-input:active::before {
      background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
    }

    .past{
        background: #ababab;
    }

    .present{
        background: #fbffaa;
    }
    #successfull_msg{
        padding: 2px 0;
        color: #030303;
        background: #e9ffe9;
    }
    span#click_nxt {
        background: whitesmoke;
    }

    #Picture_answer img {
        max-width: 100%;
        height: 150px!important;
    }

    input[type=text] {
    border: 1px solid #353535!important;
}
</style>


<input type="hidden" name="questionType" value="9">
<input type="hidden" id="Sl_part" value="2">
<input type="hidden" id="presentBtn" value="">
<input type="hidden" id="decision" value="">
<input type="hidden" id="wrongDescriptionMoal" value="">

<input type="hidden" id="remainPlus" value="">
<input type="hidden" id="ParagraphSerial" value="1" >
<hr>

<p id="answe_err" class="err" ></p>

<div class="sol_class">
    <span onclick="setSolution()" style="display: inline-flex;">
        <img src="assets/images/icon_solution.png"> Solution
    </span> 
</div>

<div class="description_button_StoryWrite">
    <p class="parts" onclick="thisTitle('Next')" style="width: 3%" > <img src="<?= base_url('/assets/build/Next.ico') ?>" style="width: 100%;
    height: 83%;" > </p>
    <p class="parts" onclick="thisTitle('Previous')" style="width: 3%"> <img src="<?= base_url('/assets/build/button_previous_100860.jpg') ?>" style="width: 100%;
    height: 83%;"> </p>

    <p class="Title" onclick="thisTitle('Title')">Title</p>
    <p class="Picture" onclick="thisTitle('Picture')">Picture</p>
    <p class="Introduction" onclick="thisTitle('Introduction')">Introduction</p>
    <p class="Body" onclick="thisTitle('Body')">Body</p>
    <p class="plus" onclick="thisTitle('plus')" class="plusShowHide">+</p>
    <input type="text" id="puls_increment" value="1" readonly style="width: 3%;margin: 5px 0;" >
    <p class="Conclusion" onclick="thisTitle('Conclusion')">Conclusion</p>
</div>

<div class="inputStoryWrite">
    <p id="serial">SL.1</p>
    <input type="text" id="answer">
    <p class="RightAnswer decision_btn" onclick="thisDecision('RightAnswer')"  id="DecisionEm">Right Answer</p>
    <p class="WrongAnswer decision_btn" onclick="thisDecision('WrongAnswer')"  id="DecisionEm2">Wrong Answer</p>
    <p class="Paragraph decision_btn" onclick="thisDecision('Paragraph')" style="display: none;" id="bodyEm">Paragraph</p>
    <p class="PuzzleParagraph decision_btn" onclick="thisDecision('PuzzleParagraph')" style="display: none;" id="bodyEm2">Puzzle Paragraph</p>
</div>
<div class="nextStoryWrite" onclick="nextButton()">
    <p >Next</p>
</div>
<br>
<span id="successfull_msg"></span>
<span class="click_RightWrong"></span>
<span id="click_nxt"></span>

<br>
<br>
<br>


<div class="answerStoryWrite">
    <div class="row">
        <div style="padding: 10px 5px;">
            <div class="col-md-2"> <div style="padding: 15px 5px;" id="Picture_answer"> <img src="<?= base_url("/assets/uploads/").json_decode($question_info[0]['questionName'])->lastpictureSelected ?>" height="250px" weight="250px" > </div> </div>
            <div class="col-md-10">
                <div style="padding: 15px 5px; text-decoration: underline; margin-left: -131px; color: salmon;" id="right_StoryWrite"> <h4><?=  json_decode($question_info[0]['questionName'])->rightTitle; ?></h4>  </div><br>
                <br>
            </div>
        </div>
    </div>

    <div class="other_parts">
        <div class="StoryWritePartTitles">Introduction  </div><br>
        <div style="padding: 0 5px;" id="right_StoryWriteIntroduction"> <?= json_decode($question_info[0]['questionName'])->rightIntro; ?> </div><br>
        <div class="StoryWritePartTitles">Body  </div><br>
        <div style="padding: 5px 5px;" id="right_StoryWriteBody">
            <?php foreach ($question['paragraph'] as $key => $value) {  ?>
                <?php foreach ($value as $key_2 => $val) { ?>
                    <?php foreach ($val as $key => $value) { ?>
                        <?php  if ($key_2 == "Paragraph") { ?>
                            <span><?= $value; ?></span>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <br>
            <?php } ?>
        </div><br>
        <div class="StoryWritePartTitles">Conclusion  </div><br>
        <div style="padding: 0 5px;" id="right_StoryWriteConslution"> <?= json_decode($question_info[0]['questionName'])->rightConclution; ?></div>
    </div>
</div>

<div class="storyWriteBody">

<div class="StoryWritePartTitlesTwo">Title  </div>
<div class="storyWriteBodyTitleeeee">
    <?php foreach ($question['titles'] as $key => $val){ ?>
        <div class="">
            <div class="firstElementStoryWrite titleBtn_<?= $key; ?>" id="titleBtn_<?= $key; ?>" > <?= $val[0]; ?> </div>
            <div class="chooseBtnStoryWrite"> <button type="button" id="titleBtn_<?= $key; ?>" class=" titleBtn 1 btn btn-primary titleBtn_<?= $key; ?>" onclick="rightOrWrong('<?= $val[1]; ?>' , '<?= $val[0]; ?>' , 'titleBtn_<?= $key; ?>' , 'titleBtn' , '<?= $val[2]; ?>')">Edit</button> 
                <?php if ($val[1] != "right_ones_xxx" ) { ?>
                    <button  type="button" id="titleBtn" class="titleBtn 1 btn btn-danger titleBtn_<?= $key; ?>" onclick="RemovePart('<?= $val[1]; ?>' , '<?= $val[0]; ?>' , 'titleBtn_<?= $key; ?>' , 'titleBtn' , '<?= $val[2]; ?>')">Remove</button> 
                <?php } ?>
              </div>
        </div>
    <?php } ?>

    <div class="storyWritePartsTitle"></div>

</div>

<br>
<div class="StoryWritePartTitlesTwo">Picture  </div>
<div class="storyWritePartsImage">
    <?php foreach ($question['picture'] as $key => $val)  { ?>
            <div class="firstElementStoryWrite pictureBtn_<?= $key; ?>" id="pictureBtn_<?= $key; ?>"> <img src="<?= base_url('/assets/uploads/').$val[0]; ?>" height="150px" width="150px"> </div><br> 
            <div class="chooseBtnStoryWriteImg"> <button type="button" id="pictureBtn" class=" pictureBtn 2 btn btn-primary pictureBtn_<?= $key; ?>" onclick="rightOrWrong('<?= $val[1]; ?>' , '<?= base_url('/assets/uploads/').$val[0]; ?>' , 'pictureBtn_<?= $key; ?>' , 'pictureBtn' , '<?= $val[2]; ?>')">Edit</button> <br>

                <?php if ($val[1] != "right_ones_xxx" ) { ?>
                    <button style="margin-left: -85px;margin-top: -55px;" type="button" id="pictureBtn" class=" pictureBtn 2 btn btn-danger pictureBtn_<?= $key; ?>" onclick="RemovePart('<?= $val[1]; ?>' , '<?= base_url('/assets/uploads/').$val[0]; ?>' , 'pictureBtn_<?= $key; ?>' , 'pictureBtn' , '<?= $val[2]; ?>')">Remove</button> 
                <?php } ?>

             </div>
    <?php } ?>
</div>
<br>
<div class="StoryWritePartTitlesTwo">Introduction  </div>

<div class="storyWriteBodyTitleeeee">
<?php foreach ($question['Intro'] as $key => $val)  { ?>
    <div class="storyWriteParts">
        <div class="firstElementStoryWrite" id="introBtn_<?= $key; ?>" > <?= $val[0]; ?> </div>
        <div class="chooseBtnStoryWrite"> <button type="button" id="introBtn" class=" introBtn 3 btn btn-primary introBtn_<?= $key; ?>" onclick="rightOrWrong('<?= $val[1]; ?>', '<?= $val[0]; ?>' , 'introBtn_<?= $key; ?>' , 'introBtn' , '<?= $val[2]; ?>')">Edit</button> 
            <?php if ($val[1] != "right_ones_xxx" ) { ?>
                <button type="button" id="introBtn" class="introBtn 3 btn btn-danger introBtn_<?= $key; ?>" onclick="RemovePart('<?= $val[1]; ?>', '<?= $val[0]; ?>' , 'introBtn_<?= $key; ?>' , 'introBtn' , '<?= $val[2]; ?>')">Remove</button> 
            <?php } ?>

         </div>
    </div>
<?php } ?>
<div class="storyWriteParts_intro"></div>
</div>


<br>
<div class="StoryWritePartTitlesTwo"> Body  </div>

<div class="storyWriteBodyParagrapheeeee">

<?php $i = 0; foreach ($question['paragraph'] as $index => $val) {  ?>
    <div class="storyWriteParts">
        <?php foreach ($val as $index_name => $value2) { ?>
             <?php foreach ($value2 as $index_num => $val_3) { $i++; ?>
            <div class="firstElementStoryWrite paragraphBtn_<?= $i; ?>" id="paragraphBtn_<?= $i; ?>" > <?= $val_3; ?> </div>

            <div class="chooseBtnStoryWrite"> <button type="button" id="paragraphBtn" class="paragraphBtn_<?= $i; ?>paragraphBtn btn btn-primary  " onclick="rightOrWrongParagraph('<?= $index; ?>' , '<?= $val_3; ?>', '<?= $i; ?>' , '<?= $index_name; ?>' , 4 , '<?= $index_num; ?>')">Edit</button> 

                <button type="button" id="paragraphBtn" class="paragraphBtn_<?= $i; ?>paragraphBtn btn btn-danger ?>" onclick="RemovePartParagraph('<?= $index; ?>' , '<?= $val_3; ?>', '<?= $i; ?>' , '<?= $index_name; ?>' , 4 , '<?= $index_num; ?>')">Remove</button>

             </div>
        <?php } ?>
        <?php } ?>
    </div>
<?php } ?>
<div class="storyWriteParts_paragraph"></div>
</div>


<br>
<div class="StoryWritePartTitlesTwo">Conclusion  </div>
<div class="storyWriteBodyTitleeeee">
<?php foreach ($question['conclution'] as $key => $val)  { ?>
    <?php if (!empty($val)) { ?>
        <div class="storyWriteParts">
            <div class="firstElementStoryWrite conclutionBtn_<?= $key; ?>" id="conclutionBtn_<?= $key; ?>" > <?= $val[0]; ?> </div>
            <div class="chooseBtnStoryWrite"> <button type="button" id="conclutionBtn" class="conclutionBtn 5 btn btn-primary conclutionBtn_<?= $key; ?>" onclick="rightOrWrong('<?= $val[1]; ?>' , '<?= $val[0]; ?>', 'conclutionBtn_<?= $key; ?>' , 'conclutionBtn' , '<?= $val[2]; ?>')">Edit</button>  

                <?php if ($val[1] != "right_ones_xxx"  ) { ?>
                    <button type="button" id="conclutionBtn" class="conclutionBtn 5 btn btn-danger conclutionBtn_<?= $key; ?>" onclick="RemovePart('<?= $val[1]; ?>' , '<?= $val[0]; ?>', 'conclutionBtn_<?= $key; ?>' , 'conclutionBtn' , '<?= $val[2]; ?>')">Remove</button>
                <?php } ?>
             </div>
        </div>
    <?php   } ?>
<?php } ?>
<div class="storyWriteParts_conclusion"></div>
</div>
<br>
</div>


<div class="modal fade" id="update_submit_modal" role="dialog">
    <div class="modal-dialog ui-draggable" style=" width: 48%;">

        <!-- Modal content-->
        <div class="modal-content" style="width: 100%;height: 64%;">
            <div class="modal-header ui-draggable-handle">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Update Data</h4>
            </div>
            <div class="modal-body">
                
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" id="textarea_2">

                   <input type="text" id="input_Field" class="form-control"> </span> 

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal" onclick="update_submit()" >Save</button>   
                <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>   
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="updatePicture_submit_modal" role="dialog">
    <div class="modal-dialog ui-draggable" style=" width: 48%;">

        <!-- Modal content-->
        <div class="modal-content" style="width: 100%;height: 64%;">
            <div class="modal-header ui-draggable-handle">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Update Data</h4>
            </div>
            <div class="modal-body">
                
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" id="textarea_2">

                    <div class="row" style="overflow: scroll;height: 300px;">
                        <div class="col-md-6"><div id="img_attach"></div></div>
                        <div class="col-md-6"><div id='myId' class='custom-file-input' style='width:150px; height:150px;border: 1px solid #d4cfcf;' ></div></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal" onclick="update_submit()" >Save</button>   
                <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>   
            </div>
        </div>

    </div>
</div>

<!--Solution Modal-->
<div class="modal fade ss_modal" id="ss_info_remove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
            </div>
            <div class="modal-body row">
                <span class="ss_extar_top20">
                    <button type="button" class="btn btn-danger" onclick="sureRemove()" data-dismiss="modal">Delete Sure ?</button>
                </span>
            </div>
            <div class="modal-footer">
                       
            </div>
        </div>
    </div>
</div>

<!-- Remove js -->
<script type="text/javascript">

    var ans_;
    var title_;
    var orderBtn_;
    var groupBtn_;
    var classOder_;
    var imgOrder_;
    var paragrapIndex_;
    var index_;
    var paragrapIndex_;

    function rightOrWrongParagraph(index , title , orderBtn , groupBtn , classOder , paragrapIndex) {
        $("#input_Field").val(title);
        $('#update_submit_modal').modal('show');
         paragrapIndex_ = paragrapIndex;
         index_ = index;
         title_ = title;
         orderBtn_ = orderBtn;
         groupBtn_ = groupBtn;
         classOder_ = classOder;
    }

    function RemovePart(ans , title , orderBtn , groupBtn , classOder){

         ans_ = ans;
         title_ = title;
         orderBtn_ = orderBtn;
         groupBtn_ = groupBtn;
         classOder_ = classOder;
         $('#ss_info_remove').modal('show');
            
    }

    function RemovePartParagraph (ans , title , orderBtn , groupBtn , classOder , paragrapIndex){

         ans_ = ans;
         title_ = title;
         orderBtn_ = orderBtn;
         groupBtn_ = groupBtn;
         classOder_ = classOder;
         paragrapIndex_ = paragrapIndex;
         $('#ss_info_remove').modal('show');
            
    }

    function sureRemove(){
        question_id = '<?= $question_id ?>';

        if (paragrapIndex_ !="" && paragrapIndex_ != undefined) {
            $.ajax({
                type: 'POST',
                url: 'remove_storyWriteParts',
                data: {
                    index: ans_,
                    data: title_,
                    type: groupBtn_,
                    orderBtn_: orderBtn_,
                    question_id: question_id,
                    paragrapIndex_: paragrapIndex_,
                    classOder_: classOder_,
                },
                dataType: 'html',
                success: function (results) {

                    submit_data = "";
                    if (groupBtn_ == "titleBtn" ) {
                        if (ans_ == "right_ones_xxx") {
                            $("."+orderBtn_+"").hide(submit_data);
                            $("#right_StoryWrite").hide(submit_data);
                        }
                        else{
                        $("."+orderBtn_+"").hide(submit_data);
                        }
                    }
                    if ( groupBtn_ == "pictureBtn" ) {
                        if (ans_ == "right_ones_xxx") {
                            img_url = '<?= base_url('/assets/uploads/') ?>'+submit_data;
                            $("."+orderBtn_+"").hide( '<img src='+JSON.stringify(img_url)+' height="250px" width="250px" />');
                            $("#Picture_answer").hide('<img src='+JSON.stringify(img_url)+' height="250px" width="250px" />');
                        }else{
                            img_url = '<?= base_url('/assets/uploads/') ?>'+submit_data;
                            $("."+orderBtn_+"").hide( '<img src='+JSON.stringify(img_url)+' height="250px" width="250px" />');
                        }
                    }

                    if (groupBtn_ == "conclutionBtn" ) {
                        if (ans_ == "right_ones_xxx") {
                            $("."+orderBtn_+"").hide();
                            $("#right_StoryWriteConslution").hide();
                        }
                        else{
                            $("."+orderBtn_+"").hide();
                        }
                    }

                    if (classOder_ == 4 ) {
                        $("."+"paragraphBtn_"+orderBtn_+"paragraphBtn").hide();
                        $("#"+"paragraphBtn_"+orderBtn_).hide();
                    }
                    
                }
            });
        }else{
            $.ajax({
                type: 'POST',
                url: 'remove_storyWriteParts',
                data: {
                    ans: ans_,
                    data: title_,
                    type: groupBtn_,
                    orderBtn_: orderBtn_,
                    question_id: question_id,
                    classOder_: classOder_,
                },
                dataType: 'html',
                success: function (results) {

                    submit_data = "";
                    if (groupBtn_ == "titleBtn" ) {
                        if (ans_ == "right_ones_xxx") {
                            $("."+orderBtn_+"").hide(submit_data);
                            $("#right_StoryWrite").hide(submit_data);
                        }
                        else{
                        $("."+orderBtn_+"").hide(submit_data);
                        }
                    }
                    if ( groupBtn_ == "pictureBtn" ) {
                        if (ans_ == "right_ones_xxx") {
                            img_url = '<?= base_url('/assets/uploads/') ?>'+submit_data;
                            $("."+orderBtn_+"").hide( '<img src='+JSON.stringify(img_url)+' height="250px" width="250px" />');
                            $("#Picture_answer").hide('<img src='+JSON.stringify(img_url)+' height="250px" width="250px" />');
                        }else{
                            img_url = '<?= base_url('/assets/uploads/') ?>'+submit_data;
                            $("."+orderBtn_+"").hide( '<img src='+JSON.stringify(img_url)+' height="250px" width="250px" />');
                        }
                    }

                    if (groupBtn_ == "introBtn" ) {
                        console.log(orderBtn_)
                        if (ans_ == "right_ones_xxx") {
                            $("."+orderBtn_+"").hide();
                            $("#"+orderBtn_+"").hide();
                            $("#right_StoryWriteIntroduction").hide();
                        }
                        else{
                            $("#"+orderBtn_+"").hide();
                            $("."+orderBtn_+"").hide();
                        }
                    }

                    
                    if (groupBtn_ == "conclutionBtn" ) {
                        if (ans_ == "right_ones_xxx") {
                            $("."+orderBtn_+"").hide(submit_data);
                            $("#right_StoryWriteConslution").hide();
                        }
                        else{
                            $("."+orderBtn_+"").hide(submit_data);
                        }
                    }

                }
            });

        }
        
    }
    
</script>
<!-- Remove js end -->

<!-- Edit Js -->
<script type="text/javascript">
    
var myDropzone = new Dropzone("div#myId", { url: "<?= base_url('story_Upload'); ?>" });

myDropzone.on("complete", function(file) {
    img_attach(file.name)
});
</script>


<script type="text/javascript">

    var ans_;
    var title_;
    var orderBtn_;
    var groupBtn_;
    var classOder_;
    var imgOrder_;
    var paragrapIndex_;

    function rightOrWrongParagraph(index , title , orderBtn , groupBtn , classOder , paragrapIndex) {
        $("#input_Field").val(title);
        $('#update_submit_modal').modal('show');
         paragrapIndex_ = paragrapIndex;
         index_ = index;
         title_ = title;
         orderBtn_ = orderBtn;
         groupBtn_ = groupBtn;
         classOder_ = classOder;
    }

    function img_attach(file_name){
        imgOrder_ = file_name;
    }

    function rightOrWrong(ans , title , orderBtn , groupBtn , classOder){

         ans_ = ans;
         title_ = title;
         orderBtn_ = orderBtn;
         groupBtn_ = groupBtn;
         classOder_ = classOder;
         
         if ( groupBtn_ == "titleBtn" || groupBtn_ =="introBtn" || groupBtn_ =="conclutionBtn") {
            $("#input_Field").val(title_);
            $('#update_submit_modal').modal('show');

        }

        if ( groupBtn_ == "pictureBtn" ) {
            $("#img_attach").html('<img src='+JSON.stringify(title)+' height="250px" width="250px" />');
            $("#img_attach").html('<img src='+JSON.stringify(title)+' height="250px" width="250px" />');
            $('#updatePicture_submit_modal').modal('show');
        }
    }

    function update_submit(){
        question_id = '<?= $question_id ?>';
        submit_data = $("#input_Field").val();

        if (imgOrder_ !="" && imgOrder_ != undefined) {
            submit_data = imgOrder_;
        }


        if (paragrapIndex_ !="") {
            $.ajax({
                type: 'POST',
                url: 'edit_storyWriteParts',
                data: {
                    ans: ans_,
                    index: index_,
                    data: title_,
                    type: groupBtn_,
                    question_id: question_id,
                    submit_data: submit_data,
                    paragrapIndex_: paragrapIndex_,
                    orderBtn_: orderBtn_,
                    classOder_: classOder_,
                },
                dataType: 'html',
                success: function (results) {

                    if (results == 1) {
                        alert("Successful Updated")
                    }else{
                        alert("Failed to Update")
                    }
                    
                    if (groupBtn_ == "titleBtn" ) {
                        if (ans_ == "right_ones_xxx") {
                            $("#"+orderBtn_+"").html(submit_data);
                            $("#right_StoryWrite").html(submit_data);
                            $( "#rightTitle" ).val("");
                        }
                        else{
                        $("#"+orderBtn_+"").html(submit_data);
                        }
                    }
                    if ( groupBtn_ == "pictureBtn" ) {
                        console.log(submit_data)
                        if (ans_ == "right_ones_xxx") {
                            img_url = '<?= base_url('/assets/uploads/') ?>'+submit_data;
                            $("#"+orderBtn_+"").html( '<img src='+JSON.stringify(img_url)+' height="250px" width="250px" />');
                            $("#Picture_answer").html('<img src='+JSON.stringify(img_url)+' height="250px" width="250px" />');
                            $( "#lastpictureSelected" ).val("");
                        }else{
                            img_url = '<?= base_url('/assets/uploads/') ?>'+submit_data;
                            $("#"+orderBtn_+"").html( '<img src='+JSON.stringify(img_url)+' height="250px" width="250px" />');
                        }
                    }

                    if (groupBtn_ == "introBtn" ) {
                        if (ans_ == "right_ones_xxx") {
                            $("#"+orderBtn_+"").html(submit_data);
                            $("#right_StoryWriteIntroduction").html(submit_data);
                            $( "#rightIntro" ).val("");
                        }
                        else{
                            $("#"+orderBtn_+"").html(submit_data);
                        }
                    }

                    if (groupBtn_ == "conclutionBtn" ) {
                        if (ans_ == "right_ones_xxx") {
                            $("#"+orderBtn_+"").html(submit_data);
                            $("#right_StoryWriteConslution").html(submit_data);
                            $( "#rightConclution" ).val("");
                        }
                        else{
                            $("#"+orderBtn_+"").html(submit_data);
                        }
                    }

                    if (classOder_ == 4 ) {
                        console.log(orderBtn_);
                        $("#paragraphBtn_"+orderBtn_+"").html(submit_data);
                    }
                }
            });
        }
        
    }
</script>

<!-- Edit Js end -->

<div id="All_StoryPicture" style="display: flex;"></div>

<br><br>

<!-- value -->
<div id="all_values" ></div>
<div id="pic_right_one" ></div>
<div id="pic_right_one_selected" ></div>

<br>

<div class="modal fade" id="WrongAnswerModel" role="dialog">
    <div class="modal-dialog ui-draggable" style=" width: 48%;">

        <!-- Modal content-->
        <div class="modal-content" style="width: 100%;height: 64%;">
            <div class="modal-header ui-draggable-handle">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Save Description</h4>
            </div>
            <div class="modal-body">
                
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" id="textarea_2">

                   <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <textarea class="mytextarea" id="wrongDescription"></textarea>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal" onclick="wrongDesSave()" >Save</button>   
                <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>   
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
     var storyPart = "xxxxx";
    partMatch = 1;
    function thisTitle(id) {
        if (storyPart == id) {
            storyPart = id;
            partMatch = 1;
        }else{
            partMatch = 0;
        }

        $("#bodyEm").hide();
        $("#bodyEm2").hide();
        $("#DecisionEm").show();
        $("#DecisionEm2").show();
        $("#decision").val('');
        $("#wrongDescriptionMoal").val('');
        $("#answer").val('');

        $("#serial").html('SL.1');

        $('p').removeClass('present');
        $("."+id+"").addClass("present");

        $("#Sl_part").val(2);

        if (id == "plus") {
            var plusPoint = $("#puls_increment").val();
            plusPoint++;
            var remainPlus = $("#remainPlus").val();
            $("#remainPlus").val(plusPoint);

            $("#puls_increment").val(plusPoint);
            $("#bodyEm").show();
            $("#bodyEm2").show();

            // $("#DecisionEm").hide();
            // $("#DecisionEm2").hide();
        }else{
            $("#puls_increment").val(1);
            $("#remainPlus").val(1);
        }

        if (id =="Body") {
            $("#bodyEm").show();
            $("#bodyEm2").show();
            // $("#DecisionEm").hide();
            // $("#DecisionEm2").hide();
        }
        document.getElementById("presentBtn").value = id;
    }

    function thisDecision(id) {

        $('.decision_btn').removeClass('present');
        $("."+id+"").addClass("present");

        document.getElementById("decision").value = id;
        presentBtn = $("#presentBtn").val();
        
        if (id == "WrongAnswer" && (presentBtn == "Title" || presentBtn == "Introduction") ) {
            $("#wrongDescription").val('');
            $('#WrongAnswerModel').modal('show');
        }

        if (presentBtn == "plus" || presentBtn == "Body" ) {
            if (id=="WrongAnswer") {
                $("#bodyEm").hide();
                $("#bodyEm2").hide();
            }else{
                $("#bodyEm").show();
                $("#bodyEm2").show();
            }
        }

        decision = $("#decision").val();
        if (presentBtn == "Picture" && decision !="" ) {
            console.log("nxt button")
            $(".nextStoryWrite").show();
            $(".click_RightWrong").hide();
            $("#click_nxt").html("Click Next Button");
            $("#successfull_msg").html("");
        }
    }

    function nextButton() {
        $("#successfull_msg").html("");
        presentBtn = $("#presentBtn").val();
        answer = $("#answer").val();
        decision = $("#decision").val();

        if (presentBtn == "Picture" && decision !="" ) {
            pictureUploaded = $("#lastpicture").val();
            if (pictureUploaded) {
                console.log("nxt Added Picture ")
                $("#successfull_msg").html("Successful Added Picture");
                $("#click_nxt").html("");
            }
        }

        var title_increment = 0;

        var d = new Date();
        var sec = d.getTime();

        if (presentBtn =='') {
            alert('Select a part of the story')
        }

        if (presentBtn =='Conclusion') {
            if (answer) {
                $("#answe_err").html('');
                if (decision) {

                    if (decision == "RightAnswer") {
                        $("#right_StoryWriteConslution").html( "<p style='' >"+answer+"</p><br>");
                    }

                    $(".storyWriteParts_conclusion").append( "<p style='' >"+answer+"</p><br>");
                    Sl_part = $("#Sl_part").val();
                    

                    $("#serial").html( '<span>SL.'+Sl_part+' </span>');
                    Sl_part++;
                    $("#Sl_part").val(Sl_part);

                    if (presentBtn == "Conclusion") {
                        if (decision == "RightAnswer") {
                            $("#all_values").append("<input type='hidden' name='rightConclution' id='rightConclution' value="+JSON.stringify(answer)+"> ");
                        }
                        if (decision == "WrongAnswer") {
                            $("#all_values").append( '<input type="hidden" name="wrongConclution[]" value='+JSON.stringify(answer)+' > ');
                            $("#all_values").append( '<input type="hidden" name="wrongConclutionIncrement[]" value='+JSON.stringify($("#wrongDescriptionMoal").val())+' > ');
                            // $("#wrongDescription").val("");
                        }
                    }

                    $("#answer").val('');
                    $('.decision_btn').removeClass('present');
                    $('#decision').val('');

                    if (partMatch == 0) {
                        $("."+presentBtn+"").addClass("past");
                    }
                    $("#successfull_msg").html("Successful Added Conclusion");
                }else{
                    $("#answe_err").html('Decision Button can not be empty!');
                }
            }else{
                $("#answe_err").html('Input field cant not be empty');
            }
        }

        if (presentBtn =='Body' || presentBtn =='plus') {
            $("#answe_err").html('');
            if (answer) {
                if (decision != "RightAnswer") {
                    if ($("#puls_increment").val() != 1) {
                        var flag = 0;
                        remainPlus = $("#remainPlus").val();
                        Paragraph_serial = $("#ParagraphSerial").val();

                        if (remainPlus>1) {
                            remainPlus--;
                            $("#remainPlus").val(remainPlus);
                            $(".plusShowHide").hide();
                        }else{
                            var flag = 1;
                            $("#puls_increment").val(1);
                            $(".plusShowHide").show();
                        }

                        $("#All_StoryWrite").append( "<p style='border: 1px solid black;padding: 8px;' >"+answer+"</p><br>");

                        Sl_part = $("#Sl_part").val();

                        $("#serial").html( '<span>SL.'+Sl_part+' </span>');
                        Sl_part++;
                        $("#Sl_part").val(Sl_part);

                        if (decision == "Paragraph" || decision == "RightAnswer" ) {
                            $("#right_StoryWriteBody").append( "<span>"+answer+"</span> ");

                            if (flag) {
                                $("#right_StoryWriteBody").append( "<span><br><br></span> ");
                            }

                            $("#all_values").append( '<input type="hidden" name="Paragraph['+Paragraph_serial+'][Paragraph][]" value='+JSON.stringify(answer)+' > ');
                        }if (decision == "PuzzleParagraph"  ) {
                            $("#all_values").append( '<input type="hidden" name="Paragraph['+Paragraph_serial+'][PuzzleParagraph][]" value='+JSON.stringify(answer)+' > ');
                        }

                        if (decision == "WrongAnswer"  ) {
                            $("#all_values").append( '<input type="hidden" name="Paragraph['+Paragraph_serial+'][WrongAnswer][]" value='+JSON.stringify(answer)+' > ');
                        }

                        if (flag) {
                            Paragraph_serial++;
                            $("#ParagraphSerial").val(Paragraph_serial);
                        }

                        $("#answer").val('');

                        $('.decision_btn').removeClass('present');
                        $('#decision').val('');

                        if (partMatch == 0) {
                            $(".Body").addClass("past");
                            $(".plus").addClass("past");
                        }
                        $(".storyWriteParts_paragraph").append( "<p style='' >"+answer+"</p><br>");
                        $("#successfull_msg").html("Successful Added Paragraph");

                    }else{
                        $("#Sl_part").val(2);
                        $("#answe_err").html('Paragraph Sentence number can not be Singal.');
                    }

                }else{
                    $("#answe_err").html('Select Paragraph or Puzzle Paragraph first');
                }
                
            }else{
                $("#answe_err").html('Input field cant not be empty');
            }
        }



        // if (presentBtn =='Body' || presentBtn =='plus') {
        //     $("#answe_err").html('');
        //     if (answer) {
        //         if (decision =='Paragraph' || decision =='PuzzleParagraph' ) {
        //             if ($("#puls_increment").val() != 1) {
        //                 var flag = 0;
        //                 remainPlus = $("#remainPlus").val();
        //                 Paragraph_serial = $("#ParagraphSerial").val();

        //                 if (remainPlus>1) {
        //                     remainPlus--;
        //                     $("#remainPlus").val(remainPlus);
        //                     $(".plusShowHide").hide();
        //                 }else{
        //                     var flag = 1;
        //                     $("#puls_increment").val(1);
        //                     $(".plusShowHide").show();
        //                 }

        //                 $(".storyWriteParts_paragraph").append( "<p style='' >"+answer+"</p><br>");

        //                 Sl_part = $("#Sl_part").val();

        //                 $("#serial").html( '<span>SL.'+Sl_part+' </span>');
        //                 Sl_part++;
        //                 $("#Sl_part").val(Sl_part);

        //                 if (decision == "Paragraph") {
        //                     $("#right_StoryWriteBody").append( "<span>"+answer+"</span> ");

        //                     if (flag) {
        //                         $("#right_StoryWriteBody").append( "<span><br><br></span> ");
        //                     }

        //                     $("#all_values").append( '<input type="hidden" name="Paragraph['+Paragraph_serial+'][]" value='+JSON.stringify(answer)+' > ');
        //                 }else{
        //                     $("#all_values").append( '<input type="hidden" name="PuzzleParagraph['+Paragraph_serial+'][]" value='+JSON.stringify(answer)+' > ');
        //                 }

        //                 if (flag) {
        //                     Paragraph_serial++;
        //                     $("#ParagraphSerial").val(Paragraph_serial);
        //                 }

        //                 $("#answer").val('');

        //                 $(".Body").addClass("past");
        //                 $(".plus").addClass("past");
        //                 $("#successfull_msg").html("Successful Added Paragraph");

        //             }else{
        //                 $("#answe_err").html('Paragraph Sentence number can not be Singal.');
        //                 $("#Sl_part").val(2);
        //             }

        //         }else{
        //             $("#answe_err").html('Select Paragraph or Puzzle Paragraph first');
        //         }
                
        //     }else{
        //         $("#answe_err").html('Input field cant not be empty');
        //     }
        // }
        
        if (presentBtn =='Introduction') {
            if (answer) {
                $("#answe_err").html('');
                if (decision) {

                    if (decision == "RightAnswer") {
                        $("#right_StoryWriteIntroduction").html( "<p >"+answer+"</p><br>");
                    }

                    $(".storyWriteParts_intro").append( "<p style='padding: 10px;' >"+answer+"</p><br>");

                    Sl_part = $("#Sl_part").val();

                    $("#serial").html( '<span>SL.'+Sl_part+' </span>');
                    Sl_part++;
                    $("#Sl_part").val(Sl_part);

                    if (presentBtn == "Introduction") {
                        if (decision == "RightAnswer") {
                            $("#all_values").append( "<input type='hidden' name='rightIntro' id='rightIntro' value="+JSON.stringify(answer)+"> ");
                        }
                        if (decision == "WrongAnswer") {
                            
                            $("#all_values").append( '<input type="hidden" name="wrongIntro[]" value='+JSON.stringify(answer)+' > ');
                            $("#all_values").append( '<input type="hidden" name="wrongIntroIncrement[]" value='+JSON.stringify($("#wrongDescriptionMoal").val())+' > ');
                            // $("#wrongDescription").val("");
                        }
                    }

                    $("#answer").val('');

                    $('.decision_btn').removeClass('present');
                    $('#decision').val('');

                    if (partMatch == 0) {
                        $("."+presentBtn+"").addClass("past");
                    }
                    $("#successfull_msg").html("Successful Added Introduction");
                }else{
                    $("#answe_err").html('Decision Button can not be empty!');
                }
            }else{
                $("#answe_err").html('Input field cant not be empty');
            }
        }

        if (presentBtn == "Picture") {

            $("#answer").val('');
                if (decision == "RightAnswer") {

                    $("#pic_right_one_selected").html( '<input type="hidden" id="lastpictureSelected" name="lastpictureSelected" value='+JSON.stringify($("#lastpicture").val())+' > ');

                    img_url = '<?= base_url('/assets/uploads/') ?>'+$("#lastpicture").val();

                    $("#Picture_answer").html( '<img src='+JSON.stringify(img_url)+' height="250px" width="250px" />');
                }else{
                    $("#all_values").append( '<input type="hidden" name=wrongPictureIncrement[] value='+JSON.stringify($("#wrongDescriptionMoal").val())+' > ');
                    $("#wrongDescription").val("");

                }


                $(".storyWritePartsImage").append( " <div id='myId"+sec+"' class='custom-file-input' style='width:150px; height:150px;border: 1px solid #d4cfcf;' ></div> ");

                 Sl_part = $("#Sl_part").val();
                 SLss = Sl_part - 1;

                $("#serial").html( '<span>SL.'+SLss+' </span>');
                Sl_part++;
                $("#Sl_part").val(Sl_part);

                var myDropzone = new Dropzone("div#myId"+sec+"", { url: "<?= base_url('story_Upload'); ?>" });

                myDropzone.on("complete", function(file) {
                  $("#all_values").append( '<input type="hidden" name=pictureList[] value='+JSON.stringify(file.xhr.response)+' > ');
                    $("#pic_right_one").html( '<input type="hidden" id="lastpicture" value='+JSON.stringify(file.xhr.response)+' > ');
                    $(".nextStoryWrite").hide();
                    $(".click_RightWrong").html("Click wheather This picture is Right Or Wrong.");
                    $("#successfull_msg").html("");
                    $("#click_nxt").html("");
                    $(".click_RightWrong").show();

                });

                $("#answer").val('');
                $('.decision_btn').removeClass('present');
                    $('#decision').val('');

                if (partMatch == 0) {
                    $("."+presentBtn+"").addClass("past");
                }
                
            
        }

        if (presentBtn == "Title") {

            if (answer) {
                $("#answe_err").html('');
                if (decision) {

                    if (decision == "RightAnswer") {
                        $("#right_StoryWrite").html( "<h4 style='padding: 17px;text-align: center;' >"+answer+"</h4><br>");
                    }

                    $(".storyWritePartsTitle").append( "<p style='padding: 8px 0;margin: 10px 0;' >"+answer+"</p><br>");

                    Sl_part = $("#Sl_part").val();

                    $("#serial").html( '<span>SL.'+Sl_part+' </span>');
                    Sl_part++;
                    $("#Sl_part").val(Sl_part);

                    if (presentBtn == "Title") {
                        if (decision == "RightAnswer") {
                            $("#all_values").append( "<input type='hidden' name='rightTitle' id='rightTitle' value="+JSON.stringify(answer)+"> ");
                        }
                        if (decision == "WrongAnswer") {
                            $("#all_values").append( '<input type="hidden" name="wrongTitles[]" value='+JSON.stringify(answer)+' > ');
                            $("#all_values").append( '<input type="hidden" name="wrongTitlesIncrement[]" value='+JSON.stringify($("#wrongDescriptionMoal").val())+' > ');
                            // $("#wrongDescription").val("");
                        }
                    }

                    $("#answer").val('');

                    $('.decision_btn').removeClass('present');
                        $('#decision').val('');

                    if (partMatch == 0) {
                        $("."+presentBtn+"").addClass("past");
                    }
                    $("#successfull_msg").html("Successful Added Title");
                }else{
                    $("#answe_err").html('Decision Button can not be empty!');
                }
            }else{
                $("#answe_err").html('Input field cant not be empty');
            }

        }
    }

    function wrongDesSave() {
       var val =  $("#wrongDescription").val();
       document.getElementById("wrongDescriptionMoal").value = val;
    }
    

</script>