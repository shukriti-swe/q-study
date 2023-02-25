<style type="text/css">

    .addedEditbutton {
        margin-left: 95%!important;
        margin-top: -24px;
        margin-bottom: 4px;
        padding: 1px 8px;
    }

    .dz-error-mark {
        display: none;
    }

    .dz-success-mark {
        display: none;
    }

    .dz-details {
        display: none;
    }

    .storyWriteBody .storyWritePartsImage {
        display: flex;
        overflow: auto;
        width: 1210px!important;
    }
    .err{
        color: red;
    }

    .card {
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
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
<input type="hidden" id="nxtPrevious" value="0">
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
    <p class="parts" onclick="thisNxtPre('Next')" style="width: 3%" > <img src="<?= base_url('/assets/build/Next.ico') ?>" style="width: 100%;
    height: 83%;" > </p>
    <p class="parts" onclick="thisNxtPre('Previous')" style="width: 3%"> <img src="<?= base_url('/assets/build/button_previous_100860.jpg') ?>" style="width: 100%;
    height: 83%;"> </p>

    <p class="Title" onclick="thisTitle('Title')">Title</p>
    <p class="Picture" onclick="thisTitle('Picture')">Picture</p>
    <p class="Introduction" onclick="thisTitle('Introduction')">Introduction</p>
    <p class="Body" onclick="thisTitle('Body')">Body</p>
    <p class="plus" onclick="thisTitle('plus')" class="plusShowHide">+</p>
    <p class="minus" onclick="thisTitle('minus')" class="minusShowHide">-</p>
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
    <p class="decision_btn forUpdateShow" style="display: none;">Puzzle Paragraph</p>
</div>
<div class="nextStoryWrite" onclick="nextButton()">
    <p >Next</p>
</div>

<div class="updateStoryWrite" onclick="updateButton()" style="display: none;">
    <p >Update</p>
</div>

<div class="BodyPartStoryWrite" style="display: none;">
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
                <div style="margin-left: -131px;" id="right_StoryWrite"></div>
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

<div style="padding: 5px 5px;" id="All_StoryWrite">

    <div class="StoryWritePartTitlesTwo" style="display: none;" >Title  </div>
    <div class="storyWritePartsTitle"></div>
    
    <div class="StoryWritePicture" style="display: none;" >Picure  </div>
    <div id="All_StoryPicture" style="display: flex;"></div>

    <div class="StoryWritePartTitlesIntroduction" style="display: none;" >Introduction  </div>
    <div class="storyWriteParts_intro"></div>

    <div class="StoryWritePartParagraph" style="display: none;" > Paragraph  </div>
    <div class="storyWriteParts_paragraph"></div>

    <div class="StoryWritePartConclusion" style="display: none;" > Conclusion  </div>
    <div class="storyWrite_conclusion"></div>

</div>

<br><br>

<!-- value -->
<div id="all_values" ></div>
<div id="all_values_title" ></div>
<div id="all_right_values_intro" ></div>
<div id="all_right_conclution_intro" ></div>
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
    var titleIncrement = 0;
    var introIncrement = 0;
    var conclusionIncrement = 0;
    var PgSL = 1;
    var firstPgSL = 1;
    var ApprovePicModal = 0;
    var paraOrder = 1;
    var pictureClicked = 0;
    var hasRightAns = 0;

    var paratype_;
    var paraindex_;
    var partno_;
    var paranum_;
    var SubmitParaData_;
    var addNew_;
    var AddedNew = 0;
</script>

<script type="text/javascript">
    var nxtPreviousBtnCount = $("#nxtPrevious").val();
    var classOderForUpdate;
    var typeForUpdate;
    var orderBtnForUpdate;
    var AddedNew = 0;

    function thisNxtPre(argument) {
        if (argument == 'Next' ) {
            nxtPreviousBtnCount++;
        }else{
            nxtPreviousBtnCount--;
        }
        var presentBtn = $("#presentBtn").val();
        if (presentBtn) {
            $("#answe_err").html('');

            if (presentBtn == "Body" || presentBtn == "plus" ) {
                y = nxtPreviousBtnCount;
                if (y <= 1) {
                    y = 1;
                }
                var txt = $("#paragraphBtn_"+y+"").text();

                var paratype = $("#paragraphBtn_"+y+"").attr('paratype');
                var paraindex = $("#paragraphBtn_"+y+"").attr('paraindex');
                var partno = $("#paragraphBtn_"+y+"").attr('partno');
                var paranum = $("#paragraphBtn_"+y+"").attr('paranum');
                var AddedNew__ = $("#paragraphBtn_"+y+"").attr('addNew');

                addNew_ = AddedNew__;

                AddedNew = addNew_;

                paratype_      = paratype;
                paraindex_     = paraindex;
                partno_        = partno;
                paranum_       = paranum;

                $(".BodyPartStoryWrite").show();
                $(".BodyPartStoryWrite").html(' <p> Part  '+ partno +' </p> ');

                $('.RightAnswer').removeClass('present');
                $('.WrongAnswer').removeClass('present');
                $('.Paragraph').removeClass('present');
                $('.PuzzleParagraph').removeClass('present');

                if (paratype == "PuzzleParagraph" ) {
                    $(".forUpdateShow").show();
                    $("#bodyEm2").hide();
                    $(".forUpdateShow").addClass("present");
                }else{
                    $(".forUpdateShow").hide();
                }

                $("."+paratype+"").addClass("present");

                if (txt) {
                    $("#answer").val(txt);
                    typeForUpdate = "paragraphBtn";
                }else{
                    $(".BodyPartStoryWrite").hide();
                    $("#answer").val('');
                }
                
            }

            if (presentBtn == "Title") {
                y = nxtPreviousBtnCount;
                y--;
                if (y <= 0) {
                    y = 0;
                }
                var txt = $("#titleBtn_"+y+"").text();
                var right_wrongStatus = $("#titleBtn_"+y+"").attr("class");

                if (txt) {
                    if (right_wrongStatus == undefined) {
                        $('#DecisionEm').removeClass('present');
                        $("#DecisionEm2").addClass("present");
                    }
                }else{
                    $('#DecisionEm').removeClass('present');
                    $('#DecisionEm2').removeClass('present');
                }

                if (right_wrongStatus) {
                    if ( right_wrongStatus.includes("rightTitle" ) ) {
                        console.log("rightIntro")
                        $('#DecisionEm2').removeClass('present');
                        $("#DecisionEm").addClass("present");
                    }else{
                        console.log("wrongintro")
                        $('#DecisionEm').removeClass('present');
                        $("#DecisionEm2").addClass("present");
                    }
                }

                if (txt) {
                    AddedNew = 1;
                    AddedNumber = y;
                    typeForUpdate = "titleBtn";
                    
                    $("#answer").val(txt);
                }else{
                    $('#DecisionEm').removeClass('present');
                    $('#DecisionEm2').removeClass('present');
                    $("#answer").val("");
                }
            }

            if (presentBtn == "Introduction") {
                y = nxtPreviousBtnCount;
                y--;
                if (y <= 0) {
                    y = 0;
                }
                var txt = $("#introBtn_"+y+"").text();
                var right_wrongStatus = $("#introBtn_"+y+"").attr("class");

                if (txt) {
                    if (right_wrongStatus == undefined) {
                        $('#DecisionEm').removeClass('present');
                        $("#DecisionEm2").addClass("present");
                    }
                }else{
                    $('#DecisionEm').removeClass('present');
                    $('#DecisionEm2').removeClass('present');
                }

                if (right_wrongStatus) {
                    if ( right_wrongStatus.includes("rightIntro" ) ) {
                        console.log("rightIntro")
                        $('#DecisionEm2').removeClass('present');
                        $("#DecisionEm").addClass("present");
                    }else{
                        console.log("wrongintro")
                        $('#DecisionEm').removeClass('present');
                        $("#DecisionEm2").addClass("present");
                    }
                }

                if (txt) {

                    AddedNew = 1;
                    AddedNumber = y;
                    typeForUpdate = "introBtn_";

                    typeForUpdate = "introBtn";
                    orderBtnForUpdate  = "introBtn_"+y+"";
                    $("#answer").val(txt);
                }else{
                    $("#answer").val("");
                }

            }

            if (presentBtn == "Conclusion") {
                y = nxtPreviousBtnCount;
                y--;
                if (y <= 0) {
                    y = 0;
                }
                var txt = $("#conclutionBtn_"+y+"").text();
                if (txt) { 

                    var right_wrongStatus = $("#conclutionBtn_"+y+"").attr("class");

                    if (right_wrongStatus) {
                        if ( right_wrongStatus.includes("rightConclusion" ) ) {
                            $('#DecisionEm2').removeClass('present');
                            $("#DecisionEm").addClass("present");
                        }else{
                            $('#DecisionEm').removeClass('present');
                            $("#DecisionEm2").addClass("present");
                        }
                    }

                    if (right_wrongStatus == undefined) {
                        $('#DecisionEm').removeClass('present');
                        $("#DecisionEm2").addClass("present");
                    }

                    AddedNew = 1;
                    AddedNumber = y;
                    typeForUpdate = "conclutionBtn_";

                    typeForUpdate = "conclutionBtn";
                    orderBtnForUpdate  = "conclutionBtn_"+y+"";
                    $("#answer").val(txt);
                }else{
                    $('#DecisionEm').removeClass('present');
                    $('#DecisionEm2').removeClass('present');
                    $("#answer").val("");
                }

            }

            if (nxtPreviousBtnCount <= 0) {
                nxtPreviousBtnCount = 0 ;
                x = nxtPreviousBtnCount;
                slButton = x++;
                $("#serial").html("SL.1");
            }else{
                x = nxtPreviousBtnCount;
                slButton = x++;
                $("#serial").html("SL."+slButton+"");
            }

            $(".updateStoryWrite").show();

        }else{
            $("#answe_err").html('Select a part of the story');
        }
    }
</script>

<script type="text/javascript">
    function updateButton() {
        $(".forUpdateShow").hide();
        submit_data = $("#answer").val();

        if (submit_data.trim()) {

            if (typeForUpdate == "paragraphBtn") {
                $("#paraAddednew_"+paranum_+"").val(submit_data)
                $("#paragraphBtn_"+paranum_+"").html(submit_data)
                $("#successfull_msg").html("Successful Updated")
            }

            if (typeForUpdate == "conclutionBtn") {
                var RightOrWrong_2 = $(".conclutionClassAdded_"+AddedNumber+"").attr('id');

                if (RightOrWrong_2 == "rightConclution") {
                    $('.rightConclusion').val(submit_data);
                    $(".rightConclusion").html(submit_data)
                    $("#right_StoryWriteConslution").html( "<p >"+submit_data+"</p><br>" );

                }else{
                    $(".conclutionClassAdded_"+AddedNumber+"").val(submit_data)
                    $("#conclutionBtn_"+AddedNumber+"").html(submit_data)
                }
            }

            if (typeForUpdate == "introBtn") {
                var RightOrWrong_2 = $(".introClassAdded_"+AddedNumber+"").attr('id');
                if (RightOrWrong_2 == "rightIntro") {
                    $(".rightIntro").val(submit_data)
                    $(".rightIntro").html(submit_data)
                    $("#right_StoryWriteIntroduction").html( "<p >"+submit_data+"</p>" );
                }else{
                    $(".introClassAdded_"+AddedNumber+"").val(submit_data)
                    $("#introBtn_"+AddedNumber+"").html(submit_data)
                }
            }

            if (typeForUpdate == "titleBtn") {
                var RightOrWrong_2 = $(".titleClassAdded_"+AddedNumber+"").attr('id');
                if (RightOrWrong_2 == "rightTitle") {
                    var lastIdRightElem_2 = $('#all_values_title').children().last().attr('class');

                    $(".rightTitle").val(submit_data)
                    $(".rightTitle").html(submit_data)
                    
                    $("#right_StoryWrite").html( "<h5 style='text-align: center;' >"+submit_data+"</h5><br>");
                }else{
                    $(".titleClassAdded_"+AddedNumber+"").val(submit_data)
                    $("#titleBtn_"+AddedNumber+"").html(submit_data)
                }
            }

            $("#successfull_msg").html("Successful Updated")
        }else{
            $("#answe_err").html('Input field cant not be empty');
        }
    }
</script>

<script type="text/javascript">
    var storyPart = "xxxxx";
    partMatch = 1;
    var paraaddednumber = 0;
    var paragraphPart = 0;

    function thisTitle(id) {
        $(".forUpdateShow").hide();
        $(".BodyPartStoryWrite").hide();
        $(".updateStoryWrite").hide();
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

        if (id == "plus" ) {
            var plusPoint = $("#puls_increment").val();
            plusPoint++;
            var remainPlus = $("#remainPlus").val();
            $("#remainPlus").val(plusPoint);

            $("#puls_increment").val(plusPoint);
            $("#bodyEm").show();
            $("#bodyEm2").show();
        }

        if (id == "minus" ) {
            var plusPoint = $("#puls_increment").val();
            if (plusPoint > 1) {
                plusPoint--;
            }
            
            var remainPlus = $("#remainPlus").val();
            $("#remainPlus").val(plusPoint);

            $("#puls_increment").val(plusPoint);
            $("#bodyEm").show();
            $("#bodyEm2").show();

            id ="plus";
        }

        if (id != "minus" && id != "plus" ) {
            $("#puls_increment").val(1);
            $("#remainPlus").val(1);
        }

        if (id =="Body") {
            $("#bodyEm").show();
            $("#bodyEm2").show();
        }

        if (id == "plus" || id == "Body" || id == "minus" ) {
            if ( $("#remainPlus").val() == $("#puls_increment").val() ) {
                $(".PuzzleParagraph").hide();
            }else{
                $(".PuzzleParagraph").show();
            }
        }

        document.getElementById("presentBtn").value = id;
    }

    function thisDecision(id) {
        $(".forUpdateShow").hide();
        $('.decision_btn').removeClass('present');
        $("."+id+"").addClass("present");

        document.getElementById("decision").value = id;
        presentBtn = $("#presentBtn").val();

        if (presentBtn == "Picture") {
            pictureClicked = 1;

        }else{
            pictureClicked = 0;
            ApprovePicModal = 0;
        }

        if (id == "WrongAnswer" && (presentBtn == "Body" || presentBtn == "plus" || presentBtn == "Conclusion")  ) {
            $('#WrongAnswerModel').modal('show');
        }

        if (presentBtn == "plus" || presentBtn == "Body" ) {
            if (id=="WrongAnswer") {
                $("#bodyEm").hide();
                $("#bodyEm2").hide();
                $(".Paragraph").hide();
                $(".RightAnswer").hide();
                $(".PuzzleParagraph").hide();
            }

            if (id=="RightAnswer") {
                $(".WrongAnswer").hide();
            }

            if (id == "Paragraph" || id == "PuzzleParagraph" ) {
                $(".RightAnswer").addClass("present");
                $(".WrongAnswer").hide();
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
        $(".forUpdateShow").hide();
        $(".BodyPartStoryWrite").hide();
        pictureClicked = 0;
        $(".updateStoryWrite").hide();
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

        if (presentBtn == "Picture") {

            pictureClicked = 1;

            $("#answer").val('');

            if (decision == "RightAnswer") {

                var lastpictureElem = $('#lastpicture').attr('class');
                $("#pic_right_one_selected").html('<input type="hidden" class="'+lastpictureElem+'" name="lastpictureSelected" value='+JSON.stringify($("#lastpicture").val())+' > ');
                img_url = '<?= base_url('/assets/uploads/') ?>'+$("#lastpicture").val();

                $("#Picture_answer").html( '<img class="'+lastpictureElem+'" src='+JSON.stringify(img_url)+' height="250px" width="250px" />');
            }else{
                if (ApprovePicModal) {
                    if ($("#wrongDescriptionMoal").val()) {
                        $("#all_values").append( '<input type="hidden" name="wrongPictureIncrement[]" value='+JSON.stringify($("#wrongDescriptionMoal").val())+' > ');
                        $("#wrongDescriptionMoal").val("");
                    }else{
                        $("#all_values").append( '<input type="hidden" name="wrongPictureIncrement[]" value="noInput" > ');
                    }

                    $("#wrongDescription").val('');

                }
            }
            $(".StoryWritePicture").show();
            $("#All_StoryPicture").append( " <div class='storyImageAdded'> <button type='button' style='margin: 2px 44px;padding: 4px;' class='btn btn-danger myId"+sec+"' pictureID = 'myId"+sec+"' onclick='addedRemovePicture(this)' >Remove</button>  <div id='myId"+sec+"' class='custom-file-input' style='width:150px; height:150px;border: 1px solid #d4cfcf;' ></div><div> ");
            Sl_part = $("#Sl_part").val();
            SLss = Sl_part - 1;

            $("#serial").html( '<span>SL.'+SLss+' </span>');
            Sl_part++;
            $("#Sl_part").val(Sl_part);

            var myDropzone = new Dropzone("div#myId"+sec+"", { url: "<?= base_url('story_Upload'); ?>" });

            myDropzone.on("complete", function(file) {
              $("#all_values").append( '<input type="hidden" class="myId'+sec+'" name=pictureList[] value='+JSON.stringify(file.xhr.response)+' > ');
                $("#pic_right_one").html( '<input type="hidden" class="myId'+sec+'" id="lastpicture" value='+JSON.stringify(file.xhr.response)+' > ');
                $(".nextStoryWrite").hide();

                $(".click_RightWrong").html("Click wheather This picture is Right Or Wrong.");
                ApprovePicModal = 1;
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
                    $(".StoryWritePartTitlesTwo").show();
                    if (decision == "RightAnswer") {
                        $("#right_StoryWrite").html( "<h4 style='padding: 17px;text-align: center;' >"+answer+"</h4><br>");
                    }

                    $(".storyWritePartsTitle").append( "<p style='' id='titleBtn_"+titleIncrement+"'  >"+answer+"</p> <button type='button' class='btn btn-primary addedEditbutton' partNo = 'titleClassAdded' id='"+titleIncrement+"' onclick='addedEditbutton(this)' > Edit </button> <br>");
                    $(".storyWritePartsTitle").addClass("card");

                    Sl_part = $("#Sl_part").val();
                    $("#serial").html( '<span>SL.'+Sl_part+' </span>');
                    Sl_part++;
                    $("#Sl_part").val(Sl_part);
                    if (presentBtn == "Title") {
                        if (decision == "RightAnswer") {
                            $( "#titleBtn_"+titleIncrement+"" ).addClass( "rightTitle" );
                            $("#all_values_title").append( "<input type='hidden' class='rightTitle titleClassAdded_"+titleIncrement+"' name='rightTitle' id='rightTitle' value="+JSON.stringify(answer)+"> ");
                        }
                        if (decision == "WrongAnswer") {
                            $("#all_values").append( '<input type="hidden" class="titleClassAdded_'+titleIncrement+'" name="wrongTitles[]" value='+JSON.stringify(answer)+' > ');
                            if ($("#wrongDescriptionMoal").val()) {
                                $("#all_values").append( '<input type="hidden" name="wrongTitlesIncrement[]" value='+JSON.stringify($("#wrongDescriptionMoal").val())+' > ');
                                $("#wrongDescriptionMoal").val("");
                            }else{
                                $("#all_values").append( '<input type="hidden" name="wrongTitlesIncrement[]" value="noInput" > ');
                            }

                            $("#wrongDescription").val('');
                        }
                    }

                    titleIncrement++;

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

        if (presentBtn =='Body' || presentBtn =='plus' || presentBtn =='minus') {
            $("#answe_err").html('');
            if (answer) {
                if (decision) {
                    if (decision) {
                        $(".WrongAnswer").show();
                        $(".Paragraph").show();
                        $(".RightAnswer").show();
                        $(".PuzzleParagraph").show();

                        if ($("#puls_increment").val() != 1) {
                            hasRightAns_2 = 1;

                            if ($("#remainPlus").val() == 1) {
                                if (decision == "WrongAnswer" ) {
                                    if (hasRightAns == 1) {
                                        hasRightAns_2 = 1;
                                        hasRightAns = 0;
                                    }else{
                                        hasRightAns_2 = 0;
                                    }
                                }
                            }

                            if ( $("#remainPlus").val() == $("#puls_increment").val() && $("#remainPlus").val() != 1) {
                                hasRightAns = 0;
                            }

                            if (hasRightAns_2) {
                                $("#answe_err").html('');
                                var flag = 0;
                                remainPlus = $("#remainPlus").val();
                                Paragraph_serial = $("#ParagraphSerial").val();

                                if (remainPlus>1) {
                                    remainPlus--;
                                    $("#remainPlus").val(remainPlus);
                                    $(".plusShowHide").hide();
                                }else{
                                    hasRightAns = 0;
                                    var flag = 1;
                                    $("#puls_increment").val(1);
                                    $(".plusShowHide").show();
                                }

                                paraaddednumber++;

                                $(".StoryWritePartParagraph").show();

                                if (firstPgSL) {
                                    paragraphPart++;
                                    PgSL = paragraphPart;

                                    $("#right_StoryWriteBody").append(" <p style='text-decoration: underline;color: #1721f9;' > Part "+PgSL+" </p>");
                                    $(".storyWriteParts_paragraph").append( "<p style='padding: 10px;' class='itsparaClass_"+paraOrder+"' paraType='"+decision+"'  partno='"+PgSL+"' addnew= 1 paranum='"+paraaddednumber+"' id='paragraphBtn_"+paraaddednumber+"'   >"+answer+"</p>    <button type='button' class='btn btn-primary addedEditbutton'   id='paraClass_"+paraOrder+"' onclick='addedEditPicture(this)' > Edit </button>");
                                    $('.storyWriteParts_paragraph').addClass('card');
                                    firstPgSL = 0;
                                }else{

                                    $(".storyWriteParts_paragraph").append( "<p style='padding: 10px;' class='itsparaClass_"+paraOrder+"' paraType='"+decision+"' partno='"+PgSL+"' addnew= 1 paranum='"+paraaddednumber+"' id='paragraphBtn_"+paraaddednumber+"'   >"+answer+"</p>  <button type='button' class='btn btn-primary addedEditbutton' partNo = '"+PgSL+"' id='paraClass_"+paraOrder+"' onclick='addedEditPicture(this)' > Edit </button>");
                                }

                                Sl_part = $("#Sl_part").val();

                                $("#serial").html( '<span>SL.'+Sl_part+' </span>');
                                Sl_part++;
                                $("#Sl_part").val(Sl_part);

                                if (decision == "Paragraph" ) {
                                    hasRightAns = 1;
                                    $("#right_StoryWriteBody").append( "<span>"+answer+"</span> ");

                                    if (flag) {
                                        $("#right_StoryWriteBody").append( "<span><br></span> ");
                                    }
                                    $("#all_values").append( '<input type="hidden" id="paraAddednew_'+paraaddednumber+'" class="paraClass_'+paraOrder+'"  name="Paragraph['+Paragraph_serial+'][Paragraph][]" value='+JSON.stringify(answer)+' > ');
                                }if (decision == "PuzzleParagraph"  ) {
                                    hasRightAns = 1;
                                    $("#right_StoryWriteBody").append( "<span>"+answer+"</span> ");
                                    $("#all_values").append( '<input type="hidden" id="paraAddednew_'+paraaddednumber+'" class="paraClass_'+paraOrder+'" name="Paragraph['+Paragraph_serial+'][PuzzleParagraph][]" value='+JSON.stringify(answer)+' > ');
                                }

                                if (decision == "RightAnswer"  ) {
                                    hasRightAns = 1;
                                    $("#right_StoryWriteBody").append( "<span>"+answer+"</span> ");
                                    $("#all_values").append( '<input type="hidden" id="paraAddednew_'+paraaddednumber+'" class="paraClass_'+paraOrder+'" name="Paragraph['+Paragraph_serial+'][RightAnswer][]" value='+JSON.stringify(answer)+' > ');
                                }

                                if (decision == "WrongAnswer"  ) {
                                    $("#all_values").append( '<input type="hidden" id="paraAddednew_'+paraaddednumber+'" class="paraClass_'+paraOrder+'" name="Paragraph['+Paragraph_serial+'][WrongAnswer][]" value='+JSON.stringify(answer)+' > ');

                                    if ($("#wrongDescriptionMoal").val()) {
                                        $("#all_values").append( '<input type="hidden" name="wrongParagraphIncrement['+Paragraph_serial+'][WrongAnswer][]" value='+JSON.stringify($("#wrongDescriptionMoal").val())+' > ');
                                        $("#wrongDescriptionMoal").val("");
                                    }else{
                                        $("#all_values").append( '<input type="hidden" name="wrongParagraphIncrement['+Paragraph_serial+'][WrongAnswer][]" value="noInput" > ');
                                    }

                                    $("#wrongDescription").val('');
                                }

                                if (flag) {
                                    paragraphPart++;
                                    PgSL = paragraphPart;
                                    
                                    $("#right_StoryWriteBody").append(" <p style='text-decoration: underline;color: #1721f9;' > Part "+PgSL+" </p>");
                                    $(".storyWriteParts_paragraph").append( "<p style='border:1px solid #c2c1c1;margin: 4px;' > </p>");
                                }

                                paraOrder++;

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
                                $("#answe_err").html('All part can not be wrong.');
                            }
                            

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

        if (presentBtn =='Conclusion') {
            if (answer) {
                $("#answe_err").html('');
                if (decision) {
                    $(".StoryWritePartConclusion").show();
                    if (decision == "RightAnswer") {
                        $("#right_StoryWriteConslution").html( "<p style='' >"+answer+"</p><br>");
                    }

                    $(".storyWrite_conclusion").append( "<p style='' id='conclutionBtn_"+conclusionIncrement+"'  >"+answer+"</p>  <button type='button' class='btn btn-primary addedEditbutton' id='"+conclusionIncrement+"' onclick='addedEditbutton(this)' partNo = 'conclutionClassAdded' > Edit </button> <br>");

                    $(".storyWrite_conclusion").addClass("card");
                    
                    Sl_part = $("#Sl_part").val();

                    $("#serial").html( '<span>SL.'+Sl_part+' </span>');
                    Sl_part++;
                    $("#Sl_part").val(Sl_part);

                    if (presentBtn == "Conclusion") {
                        if (decision == "RightAnswer") {
                            $( "#conclutionBtn_"+conclusionIncrement+"" ).addClass( "rightConclusion" );
                            $("#all_right_conclution_intro").append("<input type='hidden' class='rightConclusion conclutionClassAdded_"+conclusionIncrement+"' name='rightConclution' id='rightConclution' value="+JSON.stringify(answer)+"> ");
                        }
                        if (decision == "WrongAnswer") {
                            $("#all_values").append( '<input type="hidden" class="conclutionClassAdded_'+conclusionIncrement+'" name="wrongConclution[]" value='+JSON.stringify(answer)+' > ');
                            if ($("#wrongDescriptionMoal").val()) {
                                $("#all_values").append( '<input type="hidden" name="wrongConclutionIncrement[]" value='+JSON.stringify($("#wrongDescriptionMoal").val())+' > ');
                                $("#wrongDescriptionMoal").val("");
                            }else{
                                $("#all_values").append( '<input type="hidden" name="wrongConclutionIncrement[]" value="noInput" > ');
                            }

                            $("#wrongDescription").val('');

                        }
                    }

                    $("#answer").val('');
                    $('.decision_btn').removeClass('present');
                    $('#decision').val('');

                    if (partMatch == 0) {
                        $("."+presentBtn+"").addClass("past");
                    }
                    conclusionIncrement++;

                    $("#successfull_msg").html("Successful Added Conclusion");
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
                    $(".StoryWritePartTitlesIntroduction").show();

                    if (decision == "RightAnswer") {
                        $("#right_StoryWriteIntroduction").html( "<p >"+answer+"</p>");
                    }

                    $(".storyWriteParts_intro").append( "<p style='padding: 10px;' id='introBtn_"+introIncrement+"' >"+answer+"</p> <button type='button' class='btn btn-primary addedEditbutton' id='"+introIncrement+"' onclick='addedEditbutton(this)' partNo = 'introClassAdded' > Edit </button>");

                    $(".storyWriteParts_intro").addClass("card");

                    Sl_part = $("#Sl_part").val();

                    $("#serial").html( '<span>SL.'+Sl_part+' </span>');
                    Sl_part++;
                    $("#Sl_part").val(Sl_part);

                    if (presentBtn == "Introduction") {
                        if (decision == "RightAnswer") {
                            $( "#introBtn_"+introIncrement+"" ).addClass( "rightIntro" );
                            $("#all_right_values_intro").append( "<input type='hidden' class='rightIntro introClassAdded_"+introIncrement+"' name='rightIntro' id='rightIntro' value="+JSON.stringify(answer)+"> ");
                        }
                        if (decision == "WrongAnswer") {
                            $("#all_values").append( '<input type="hidden" class="introClassAdded_'+introIncrement+'" name="wrongIntro[]" value='+JSON.stringify(answer)+' > ');
                            if ($("#wrongDescriptionMoal").val()) {
                                $("#all_values").append( '<input type="hidden" name="wrongIntroIncrement[]" value='+JSON.stringify($("#wrongDescriptionMoal").val())+' > ');
                                $("#wrongDescriptionMoal").val("");
                            }else{
                                $("#all_values").append( '<input type="hidden" name="wrongIntroIncrement[]" value="noInput" > ');
                            }

                            $("#wrongDescription").val('');
                        }
                    }

                    $("#answer").val('');
                    $('.decision_btn').removeClass('present');
                    $('#decision').val('');

                    if (partMatch == 0) {
                        $("."+presentBtn+"").addClass("past");
                    }
                    introIncrement++;
                    $("#successfull_msg").html("Successful Added Introduction");
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

    var partType;
    var partTypeid;

    function addedEditbutton(elem) {
        var id = $(elem).attr("id");
        var partNo = $(elem).attr("partNo");
        var value =  $('.'+partNo+'_'+id+'').val();

        $('#input_FieldSubmited').val(value);
        $('#update_submit_data').modal('show');

        partType = partNo;
        partTypeid = id;

    }
</script>

<div class="modal fade" id="update_submit_data" role="dialog">
    <div class="modal-dialog ui-draggable" style=" width: 48%;">

        <!-- Modal content-->
        <div class="modal-content" style="width: 100%;height: 64%;">
            <div class="modal-header ui-draggable-handle">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Update Data</h4>
            </div>
            <div class="modal-body">
                
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" id="textarea_2">

                   <input type="text" id="input_FieldSubmited" class="form-control"> </span> 

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal" onclick="update_addedFile()" >Save</button>   
                <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>   
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    function update_addedFile() {
        submit_data = $('#input_FieldSubmited').val();

        if (submit_data.trim()) {
            if (partType == "conclutionClassAdded") {
                var RightOrWrong = $('.'+partType+'_'+partTypeid+'').attr('id');

                if (RightOrWrong == "rightConclution") {
                    var lastIdRightElem = $('#all_right_conclution_intro').children().last().attr('class');
                    $('.rightConclusion').val(submit_data);
                    $(".rightConclusion").html(submit_data)
                    $("#right_StoryWriteConslution").html( "<p >"+submit_data+"</p><br>" );
                }else{
                    $('.'+partType+'_'+partTypeid+'').val(submit_data);
                    $("#conclutionBtn_"+partTypeid+"").html(submit_data)
                }
                
                $("#successfull_msg").html("Successfully Updated Introduction");
            }
            if (partType == "titleClassAdded") {
                var RightOrWrong = $('.'+partType+'_'+partTypeid+'').attr('id');

                if (RightOrWrong == "rightTitle") {
                    var lastIdRightElem = $('#all_values_title').children().last().attr('class');
                    $('.rightTitle').val(submit_data);
                    $(".rightTitle").html(submit_data)
                    $("#right_StoryWrite").html( "<h4 style='padding: 17px;text-align: center;' >"+submit_data+"</h4><br>");
                }else{
                    $('.'+partType+'_'+partTypeid+'').val(submit_data);
                    $("#titleBtn_"+partTypeid+"").html(submit_data)
                }

                $("#successfull_msg").html("Successfully Updated Title");
            }

            if (partType == "introClassAdded") {
                var RightOrWrong = $('.'+partType+'_'+partTypeid+'').attr('id');

                if (RightOrWrong == "rightIntro") {
                    var lastIdRightElem = $('#all_right_values_intro').children().last().attr('class');

                    $('.rightIntro').val(submit_data);
                    $(".rightIntro").html(submit_data)
                    $("#right_StoryWriteIntroduction").html( "<p >"+submit_data+"</p>" );
                }else{
                    $('.'+partType+'_'+partTypeid+'').val(submit_data);
                    $("#introBtn_"+partTypeid+"").html(submit_data)
                }
                $("#successfull_msg").html("Successfully Updated Introduction");
            }
        }else{
            $("#answe_err").html('Input field cant not be empty');
        }
    }
</script>

<script type="text/javascript">
    function addedRemovePicture(argument) {
        id = $(argument).attr("pictureID");
        $('.'+id+'').val("");
        $('#'+id+'').hide();
        $('.'+id+'').hide();
    }

    var paraValueOrder; 

    function addedEditPicture(argument) {
        id = $(argument).attr("id");
        paraValueOrder = id;

        value = $("."+id+"").val();
        $('#input_FieldSubmitedPic').val(value);
        $('#update_paragraph_data').modal('show');
    }
</script>

<div class="modal fade" id="update_paragraph_data" role="dialog">
    <div class="modal-dialog ui-draggable" style=" width: 48%;">

        <!-- Modal content-->
        <div class="modal-content" style="width: 100%;height: 64%;">
            <div class="modal-header ui-draggable-handle">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Update Data</h4>
            </div>
            <div class="modal-body">
                
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" id="textarea_2">

                   <input type="text" id="input_FieldSubmitedPic" class="form-control"> </span> 

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal" onclick="update_addedParagraph()" >Save</button>   
                <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>   
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    function update_addedParagraph(argument) {
        submit_data = $('#input_FieldSubmitedPic').val();
        $("."+paraValueOrder+"").val(submit_data);
        $(".its"+paraValueOrder+"").html(submit_data);

        if (pictureClicked) {

        }
    }
</script>