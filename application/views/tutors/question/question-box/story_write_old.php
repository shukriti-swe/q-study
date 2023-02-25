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
        <div style="padding: 10px 25px;">
            <div class="col-md-2"> <div style="padding: 15px 5px;" id="Picture_answer"></div> </div>
            <div class="col-md-10">
                <div style="margin-left: 384px; text-decoration: underline;color: salmon"><h4>Title</h4> </div>
                <div style="padding: 15px 5px;margin-left: -131px;" id="right_StoryWrite"></div>
            </div>
        </div>
    </div>

    <div class="other_parts">
        <div style="text-decoration: underline;color: salmon">Introduction </div>
        <div style="padding: 0 5px;" id="right_StoryWriteIntroduction"></div>
        <div style="text-decoration: underline;color: salmon">Body</div>
        <div style="padding: 0 5px;" id="right_StoryWriteBody"></div>
        <div style="text-decoration: underline;color: salmon">Conclusion</div>
        <div style="padding: 0 5px;" id="right_StoryWriteConslution"></div>
    </div>
    
</div>

<div id="All_StoryPicture" style="display: flex;"></div>

<div style="padding: 5px 5px;" id="All_StoryWrite"></div>

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

                    $("#All_StoryWrite").append( "<p style='border: 1px solid black;padding: 8px;' >"+answer+"</p><br>");

                    Sl_part = $("#Sl_part").val();

                    $("#serial").html( '<span>SL.'+Sl_part+' </span>');
                    Sl_part++;
                    $("#Sl_part").val(Sl_part);

                    if (presentBtn == "Conclusion") {
                        if (decision == "RightAnswer") {
                            $("#all_values").append("<input type='hidden' name='rightConclution' value="+JSON.stringify(answer)+"> ");
                        }
                        if (decision == "WrongAnswer") {
                            $("#all_values").append( '<input type="hidden" name="wrongConclution[]" value='+JSON.stringify(answer)+' > ');
                            $("#all_values").append( '<input type="hidden" name="wrongConclutionIncrement[]" value='+JSON.stringify($("#wrongDescriptionMoal").val())+' > ');
                            // $("#wrongDescription").val("");
                        }
                    }

                    $('.decision_btn').removeClass('present');
                    $('#decision').val('');

                    $("#answer").val('');
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
                if (decision) {
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

                            
                            $("#successfull_msg").html("Successful Added Paragraph");

                        }else{
                            $("#Sl_part").val(2);
                            $("#answe_err").html('Paragraph Sentence number can not be Singal.');
                        }

                    }else{
                        $("#answe_err").html('Select Paragraph or Puzzle Paragraph first');
                    }
                }else{
                    $("#answe_err").html('Decision Button can not be empty!');
                }
                
                
            }else{
                $("#answe_err").html('Input field cant not be empty');
            }
        }
        
        if (presentBtn =='Introduction') {
            if (answer) {
                $("#answe_err").html('');
                if (decision) {

                    if (decision == "RightAnswer") {
                        $("#right_StoryWriteIntroduction").html( "<p >"+answer+"</p><br>");
                    }

                    $("#All_StoryWrite").append( "<p style='border: 1px solid black;padding: 8px;' >"+answer+"</p><br>");

                    Sl_part = $("#Sl_part").val();

                    $("#serial").html( '<span>SL.'+Sl_part+' </span>');
                    Sl_part++;
                    $("#Sl_part").val(Sl_part);

                    if (presentBtn == "Introduction") {
                        if (decision == "RightAnswer") {
                            $("#all_values").append( "<input type='hidden' name='rightIntro' value="+JSON.stringify(answer)+"> ");
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

                    $("#pic_right_one_selected").html( '<input type="hidden" name="lastpictureSelected" value='+JSON.stringify($("#lastpicture").val())+' > ');

                    img_url = '<?= base_url('/assets/uploads/') ?>'+$("#lastpicture").val();

                    $("#Picture_answer").html( '<img src='+JSON.stringify(img_url)+' height="250px" width="250px" />');
                    

                }else{
                    $("#all_values").append( '<input type="hidden" name=wrongPictureIncrement[] value='+JSON.stringify($("#wrongDescriptionMoal").val())+' > ');
                    $("#wrongDescription").val("");


                }


                $("#All_StoryPicture").append( " <div id='myId"+sec+"' class='custom-file-input' style='width:150px; height:150px;border: 1px solid #d4cfcf;' ></div> ");

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
                        $("#right_StoryWrite").html( "<h5 style='text-align: center;' >"+answer+"</h5>");
                    }

                    $("#All_StoryWrite").append( "<p class='right_StoryWrite' >"+answer+"</p><br>");

                    Sl_part = $("#Sl_part").val();

                    $("#serial").html( '<span>SL.'+Sl_part+' </span>');
                    Sl_part++;
                    $("#Sl_part").val(Sl_part);

                    if (presentBtn == "Title") {
                        if (decision == "RightAnswer") {
                            $("#all_values").append( "<input type='hidden' name='rightTitle' value="+JSON.stringify(answer)+"> ");
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


