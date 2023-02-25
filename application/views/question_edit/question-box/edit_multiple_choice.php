<style type="text/css">
    div#myId {
        display: flex;
        width: 150px;
        height: 150px;
        padding: 12px 11px;
    }
.dz-details{
  display: none;
}


.dz-error-mark{
  display: none;
}

.dz-image {
    border: 1px solid;
    width: 125px;
    margin: 0 20px;
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
</style>

<style>
    .ques_solution{
        display: flex;
        padding: 9px 17px;
    }
    .ques_class{
        background-color: #7f7f7f;
        padding: 5px 10px;
    }

    .sol_class{
        padding: 5px 5px;
        background-color: #eeeeee;
        cursor: pointer;
    }

    input[type=radio] {
        margin: 50px 0 0!important;
        margin-top: 1px\9;
        line-height: normal;
    }
    .ssss_class{
        margin-bottom: 8px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 6px;
    }
    .checkbox_class{
        display: inline-block;
        width: 53px;
        position: relative;
    }
    .ssss_class p{
        font-size: 23px;
        display: inline-block;
        margin-top: 0;
    }
    
    .ssss_class input[type=checkbox] {
        transform: scale(1.4);
        margin-left: 3px;
        position: relative;
        top: 2px;
        left: -13px;
        margin-top: 0;
    }
    
    
    .ans_image{
        position: absolute;
        display: none;
        top: -5px;
        left: -2px;
    
    }
    
    .ans_image img{
        width: 30px;
    }
    .ans_image button{
        border: none;
        background:none;
    }
    .ans_image span{
        font-family: berlin Sans FB;
        font-size: 25px;
        font-weight: bold;
        color: #92d050;
        position: absolute;
        top: 4px;
    }
    .questionName_2_class{
        position: absolute;
        left: 0;
    }
    .questionName_1_class{
        position: absolute;
        left: 0;
    }
</style>
<input type="hidden" value="<?= $question_info[0]['question_name_type']; ?>" name="question_name_type" id="question_name_type" >

<!-- <div class="uploadBtnChoose">
    <button class="btn btn-success" type="button" onclick="all_file()" >Upload all files</button>
    <button type="button" class="btn Prepare_Question" style="display: none;margin: 0 661px;margin-top: -55px;background: yellowgreen;" onclick="start_upload()" >Prepare Question</button>
    <br><br>

    <div class="upload_allFileMulChoose" style="display: none;">
    <div style="overflow-x: scroll;width: 700px;">
      <div id="myId" style="width: 150px ; height: 150px;" class='custom-file-input'>  </div>
    </div>
    
    </div>
</div> -->

<div class="uploadBtnChoose" style="display: none;">
  <div style="overflow-x: scroll;width: 90%; border: 1px solid #9e9a9a;overflow-y: hidden;">
    <button class="btn btn-success" type="button" onclick="all_file()" >Upload all files</button>
    <button type="button" class="btn Prepare_Question" style="margin: 0 445px;margin-top: -64px;background: #c0f1c8;" onclick="start_upload()" >Prepare Question</button>

    <div class="uploadsMsg"> </div>
    <br><br>

    <div id="myId" class='custom-file-input'>  </div>
  </div>
</div>

    <div class="col-sm-4">
        <div class="ques_solution">
            <input class="questionName_1_class" id="questionName_1_checkbox" type="checkbox" name="questionName_1_checkbox" value="1" <?= $question_info[0]['question_name_type'] == 2 ?'checked': '';  ?> >
            <div class="ques_class" >
                <a style="cursor:pointer" id="show_question" > <span style="color: white;" > Question<i>(Click Here)</i></span></a>
            </div>
            <div class="sol_class">
                <span onclick="setSolution()" style="display: inline-flex;">
                    <img src="assets/images/icon_solution.png"> Solution
                </span> 
            </div>
        </div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <input class="questionName_2_class" type="checkbox" name="questionName_2_checkbox" id="questionName_2_checkbox" value="1" <?= $question_info[0]['question_name_type'] == 2 ?'checked': '';  ?> >
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" aria-expanded="true" aria-controls="collapseOne">
                            <span onclick="setSolution()" style="text-decoration: underline;">
                            Short Question
                        </span> 
                        </a>
                        <a role="button" aria-expanded="true" aria-controls="collapseOne">
                        <span onclick="setSolution2()" style="text-decoration: underline;margin-left:10px;">
                            Auto Question
                        </span> 
                        </a>
                        <a role="button" aria-expanded="true" aria-controls="collapseOne" id="edit_word_button">
                            <span style="text-decoration: underline;margin-left:10px;">
                                Edit
                            </span>
                        </a>
                    </h4>
                </div>  
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" id="textarea_1">
                    
                    <?php if($question_info[0]['question_name_type'] == 2) { ?>
                        <textarea class="mytextarea" id="questionName_1" name="questionName"><?= $question_info[0]['question_name_type'] == 2 ? $question_info_ind->questionName : '';  ?></textarea>
                    <?php }else{ ?>
                        <textarea class="mytextarea" id="questionName_1" name="questionName"><?= $question_info[0]['question_name_type'] == 1 ? $question_info_ind->questionName : '';  ?></textarea>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


<div class="col-sm-8">
    <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default" style="border:none;">
            <div class="panel-heading" role="tab" id="headingOne" >
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">  Image</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body ss_imag_add_right">

                    <div class="text-center">
                        <div class="form-group ss_h_mi">
                            <label for="exampleInputiamges1">How many images</label>

                            <div class="select">
                                <input class="form-control" type="number" value="<?php echo sizeof($question_info_ind->vocubulary_image); ?>" id="box_qty" onclick="getImageBox(this)">
                            </div>

                        </div>
                    </div>
                    <br>
                    <?php
                    $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
                    ?>
                    <?php $i = 1;
                    $question_ans = json_decode($question_info[0]['answer']);
                    //echo "<pre>";print_r($question_info_ind->vocubulary_image);die();
                    foreach ($question_info_ind->vocubulary_image as $row) { ?>
                    
                        
                        
                        <div class="col-md-6">
                            <div class="row editor_hide" id="list_box_<?php echo $i; ?>" style="display:none; margin-bottom:5px;border:1px solid #565656;margin-right:10px">
                                <div class="col-md-12">
                                    <div class="ssss_class">
                                        <p><?php echo $lettry_array[$i - 1]; ?></p>
                                        <div class="checkbox_class">
                                            <input type="checkbox" class="response_answer_class" id="response_answer_id<?php echo $i; ?>" name="response_answer[]" value="<?php echo $i; ?>" <?php foreach ($question_ans as $ans) {if($ans == $i){echo 'checked'; }} ?> >
                                            <!--<input type="radio" name="response_answer" value="<?php echo $i;?>" style="">-->
                                            <div class="ans_image" id="ans_image<?php echo $i?>">
                                                <button type="button" class="image_click" id="image_click<?php echo $i?>" value="<?php echo $i?>"><img src="assets/images/images/answer_img.PNG"></button>
                                                <!-- <span >Answer</span> -->
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- <button class="btn uploadsImgBtn" type="button" disabled onclick="insertUrlModal('<?= $i; ?>')"> Add Image</button>  -->
                                    <div class="box">
                                    <?//php echo print_r($row); ?>
                                        <textarea class="form-control mytextarea" id="img_insert_<?= $i; ?>" name="vocubulary_image_<?php echo $i; ?>[]"> <?php echo $row[0]; ?></textarea>
                                    </div>
                                </div>                         
                            </div>
                        </div>
                        
                        
                        
                        <?php foreach ($question_ans as $ans) { ?>
                                <?php if($ans == $i){ ?>
                                <script>
                                    var value = <?php echo $i; ?>;
                                    $('#ans_image'+value).show();
                                </script>
                                <?php }?>
                        <?php } ?>
                        <?php $i++;
                    } ?>
                    <?php //die();
                    $counter = sizeof($question_info_ind->vocubulary_image);
                    $desired_i = $counter + 1;
                    ?>
                    <?php for ($desired_i; $desired_i <= 20; $desired_i++) { ?>   
                        <div class="col-md-6" >
                            <div class="row editor_hide" id="list_box_<?php echo $desired_i; ?>" style="display:none; margin-bottom:5px;border:1px solid #565656;margin-right:10px">
                                <div class="col-md-12">
                                    <div class="ssss_class">
                                        <p><?php echo $lettry_array[$desired_i - 1]; ?></p>
                                        <div class="checkbox_class">
                                            <input type="checkbox" class="response_answer_class" id="response_answer_id<?php echo $i; ?>" name="response_answer[]" value="<?php echo $i; ?>" <?php foreach ($question_ans as $ans) {if($ans == $i){echo 'checked'; }} ?> >
                                            <!--<input type="radio" name="response_answer" value="<?php echo $i;?>" style="">-->
                                            <div class="ans_image" id="ans_image<?php echo $i?>">
                                                <button type="button" class="image_click" id="image_click<?php echo $i?>" value="<?php echo $i?>"><img src="assets/images/images/answer_img.PNG"></button><span >Answer</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="box">
                                        <textarea class="form-control mytextarea" id="img_insert_<?= $desired_i; ?>" name="vocubulary_image_<?php echo $desired_i; ?>[]"></textarea>
                                    </div>
                                </div>                         
                            </div>
                        </div> 
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
    <div id="setSolution2" style="width: auto; min-height: 31px; max-height: none; height: auto;display:none;" class="ui-dialog-content ui-widget-content">
        
            <input id="sentenceBox" type="text" name="set_skip_value" class="input-box form-control rs_set_skipValue" value="Choose the picture that best describe the word ">
        
    </div>
<input type="hidden" name="image_quantity" id="image_quantity" value="">  

<div id="answer_box" class="col-sm-6" style="position: absolute;left: 20%;z-index: 3;display: none">
    <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                   <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">   </a>
                    <button type="button" class="woq_close_btn" id="woq_close_btn">&#10006;</button>
                </h4>
            </div>

            <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <textarea name="question_solution" class="mytextarea"></textarea>
            </div>

        </div>
    </div>
</div>  

    <div id="question_box" class="col-sm-6" style="position: absolute;left: 6%;z-index: 3;display: none">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" aria-expanded="true" aria-controls="collapseOne">
                             Question
                            <button type="button" class="woq_close_btn" id="wotwoq_close_btn">&#10006;</button>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" id="textarea_2">
                    <?php if($question_info[0]['question_name_type'] == 2) { ?>
                        
                        <textarea class="mytextarea" id="questionName_2" name="questionNameClick"><?= $question_info[0]['question_name_type'] == 2 ? $question_info_ind->questionName_2 : '';  ?></textarea>
                    <?php }else{ ?>
                        <textarea class="mytextarea" id="questionName_2" name="questionNameClick"><?= $question_info[0]['question_name_type'] == 0 ? $question_info_ind->questionName : '';  ?></textarea>
                    <?php } ?>
                    <!--<textarea class="mytextarea" id="questionName_2" name="questionNameClick"><?= $question_info[0]['question_name_type'] == 0 ? $question_info_ind->questionName : '';  ?></textarea>-->
                </div>
            </div>
        </div>
    </div>  

    <div class="modal fade" id="PicList" role="dialog">
        <div class="modal-dialog ui-draggable" style=" width: 48%;">
            <div class="modal-content" style="width: 100%;height: 64%;">
                <div class="modal-header ui-draggable-handle">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Uploaded Temporary Picture</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                      <div class="all_picList"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>   
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(".question_tutorial").click(function(){
            console.log("vvvvv")
          $(".uploadBtnChoose").show();
        });
        
        
        $(".response_answer_class").click(function(){
           if($('.response_answer_class').is(":checked")) {  
                var value = $(this).val();
                $('#ans_image'+value).show();
            }else{
            }
        });
        $(".image_click").click(function(){
           var value = $(this).val();
           $('#response_answer_id'+value).prop('checked',false);
           $('#ans_image'+value).hide();
        });

        function setSolution2() {
    
    $("#setSolution2").dialog({
            resizable: false,
            modal: true,
            closeOnEscape: false,
            title : 'Insert Question',
            open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
            height:'auto',
            width:'500',
            left:'520',
            id:'sentenceCreate',
            buttons: {
                Set: function() {
                   var get_sentence = $('#sentenceBox').val();
                   var words = get_sentence.split('Choose the picture that best describe the word ');
                   var sentence = 'Choose the picture that best describe the word ';
                   var myWord = words[1];
                   var make_word = '<p style="font-size:20px;">'+sentence+'<b style="color:#f38805;">"'+myWord+'"</b></p>';
                   $('#questionName_1').val(make_word);
                   $('#edit_word_button').css('display','block');
                   $( this ).dialog( "close" );
                },
            }
        });
  }
   $('#edit_word_button').click(function(){
    var get_text = $('#questionName_1').val();
    var make_text = get_text.replace(/(<([^>]+)>)/ig,"");
    var sentence = make_text.replaceAll("&quot;","");
    $('#sentenceBox').val(sentence);
    
    
    $("#setSolution2").dialog({
            resizable: false,
            modal: true,
            closeOnEscape: false,
            title : 'Insert Question',
            open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
            height:'auto',
            width:'500',
            left:'520',
            id:'sentenceCreate',
            buttons: {
                Set: function() {
                   var get_sentence = $('#sentenceBox').val();
                   var words = get_sentence.split('Choose the picture that best describe the word ');
                   var sentence = 'Choose the picture that best describe the word ';
                   var myWord = words[1];
                   var make_word = '<p style="font-size:20px;">'+sentence+'<b style="color:#f38805;">"'+myWord+'"</b></p>';
                   $('#questionName_1').val(make_word);
                   $('#edit_word_button').css('display','block');
                   $( this ).dialog( "close" );
                },
            }
        });
   });
    </script>

    <script type="text/javascript">
        var x = 0;
        var img_id = 0;

        var myDropzone = new Dropzone("div#myId", { url: "story_Upload"});
        myDropzone.on("complete", function(file) {
          x++;

          $(".uploadsMsg").html("<div class='uploads"+x+"' style='padding: 10px;background: darkseagreen;'>Uploaded Successfully</div>");
          $(".uploads"+x+"").fadeOut(5000);

          img_url = '<?= base_url('/assets/uploads/') ?>'+(file.name);
          $(".all_picList").append("<div class='col-sm-2' style='border: 1px solid #8c8c8c;cursor: pointer;' data-dismiss='modal' onclick='img_urlFunction("+JSON.stringify(img_url)+")' > <img src="+JSON.stringify(img_url)+" /> </div>")

        });

          function start_upload(argument) {
          if (x) {
             $(".upload_allFileMulChoose").hide();
             $('.uploadsImgBtn').prop('disabled', false);
          }else{
            alert("Upload picture First")
          }
        }

        function insertUrlModal(argument) {
          img_id = argument;
          $('#PicList').modal('show');
        }

        function img_urlFunction(argument) {
            var argument = '<elem><img class="image-editor" data-height="729" data-width="1482" height="295.1417004048583" src="'+argument+'" width="600" /></elem>';

          $("#img_insert_"+img_id+"").val(argument)
        }


        function all_file() {
            $(".upload_allFileMulChoose").show();
            $(".Prepare_Question").show();
          }
    </script>

<script>
    var qtye = $("#box_qty").val();
    document.getElementById("image_quantity").value = qtye;
    
    common(qtye);
    function getImageBox() {
        var qty = $("#box_qty").val();
        if (qty < 3) {
            $("#box_qty").val(2);
        } else if (qty > 20) {
            $("#box_qty").val(20);
        } else {
            $('.editor_hide').hide();
            document.getElementById("image_quantity").value = qty;
            common(qty);
        }

    }
    function common(quantity)
    {
        for (var i = 1; i <= quantity; i++)
        {
            $('#list_box_' + i).show();
        }
    }

    $(document).on('click','#box_qty',function(){

        var qty = $("#box_qty").val();
        if (qty < 3) {
            $("#box_qty").val(2);
        } else if (qty > 20) {
            $("#box_qty").val(20);
        } else {
            $('.editor_hide').hide();
            document.getElementById("image_quantity").value = qty;
            common(qty);
        }
        
    })
</script>

<script>
     $("#show_answer_box").click(function () {
         $("#answer_box").show();
     });
     $("#woq_close_btn").click(function () {
         $("#answer_box").hide();
     });
    $("#show_question").click(function () {
        $("#question_box").show();
    });
    $("#wotwoq_close_btn").click(function () {
        $("#question_box").hide();
    });
</script>
