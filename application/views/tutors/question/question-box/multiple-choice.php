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
  .image_click{
      border:none;
      background:none;
  }
</style>

<style>
    .ss_lette {
        min-height: 158px;
        line-height: 158px;
    }

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

    input[type=checkbox], input[type=radio] {
        margin: 0px 0 0;
        margin-top: 1px\9;
        line-height: normal;
    }

    .question_tutorial:hover {
      background-color: #d43f3a!important;
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
        width: 35px;
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


<input type="hidden" name="questionType" value="4">

<div class="uploadBtnChoose" style="display: none;">
  <div style="overflow-x: scroll;width: 90%; border: 1px solid #9e9a9a;overflow-y: hidden;">
    <button type="button" class="btn Prepare_Question" style="margin: 0 445px;margin-top: 3px;background: #c0f1c8;" onclick="start_upload()" >Save Tutorial Question</button>

    <div class="uploadsMsg"> </div>
    <div class="ErrorMsg"></div>
    <br><br>

    <div id="myId" class='custom-file-input'>  </div>
  </div>
</div>

<br><br>

<div class="col-sm-4">

    <div class="ques_solution">
        <input class="questionName_1_class" id="questionName_1_checkbox" type="checkbox" name="questionName_1_checkbox" value="1">
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
        <input class="questionName_2_class" type="checkbox" name="questionName_2_checkbox" id="questionName_2_checkbox" value="1">
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
                    <a role="button" aria-expanded="true" aria-controls="collapseOne" id="edit_word_button" style="display:none;">
                        <span style="text-decoration: underline;margin-left:10px;">
                            Edit
                        </span>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <textarea class="mytextarea" id="questionName_1" name="questionName"></textarea>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="1" name="question_name_type" id="question_name_type" >
<div class="question_tutorial_input">
    
</div>


<div class="col-sm-8">
    <div class="text-center">
        <div class="form-group ss_h_mi">
            <label for="exampleInputiamges1">How many images</label>
            <div class="select">
                <input class="form-control" type="number" value="2" id="box_qty" onclick="getImageBox(this)">
            </div>
            <button style="background-color: #7f7f7f;height: 30px;margin-left: 10px;">Enlarge multipule option</button>
        </div>
    </div>
    
    <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default" style="border:none;">

            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body ss_imag_add_right" style="padding: 7px;">
                    <div class="image_box_list ss_m_qu">
                       
                        <?php
                        $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
                        for ($i = 1; $i <= 2; $i++) { ?>
                        <div class="col-md-6" style="">
                            <div class="row editor_hide" id="list_box_<?php echo $i;?>" style="border:1px solid #565656;margin-right:10px">
                                <div class="col-md-12 text-center">
                                    <div class="ssss_class">
                                        <p><?php echo $lettry_array[$i - 1]; ?></p>
                                        <div class="checkbox_class">
                                            <input class="response_answer_class" id="response_answer_id<?php echo $i; ?>" type="checkbox" name="response_answer[]" value="<?php echo $i;?>">
                                            <!--<input type="radio" name="response_answer" value="<?php echo $i;?>" style="">-->
                                            <div class="ans_image" id="ans_image<?php echo $i?>">
                                                <button class="image_click" id="image_click<?php echo $i?>" value="<?php echo $i?>"><img src="assets/images/images/answer_img.PNG"></button>
                                                <!-- <span >Answer</span> -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <button class="btn uploadsImgBtn" type="button" disabled onclick="insertUrlModal('<?= $i; ?>')"> Add Image</button>  -->
                                    <div class="box">
                                        <textarea class="form-control mytextarea" id="img_insert_<?= $i; ?>" name="vocubulary_image_<?php echo $i?>[]"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    
                    <?php for ($desired_i = $i; $desired_i <= 20; $desired_i++) { ?>
                    <div class="col-md-6" style="">
                        <div class="row editor_hide" id="list_box_<?php echo $desired_i?>" style="display:none;border:1px solid #565656;margin-right:10px">
                            <div class="col-md-12">
                                <div class="ssss_class">
                                    <p><?php echo $lettry_array[$desired_i -1]; ?></p>
                                    <div class="checkbox_class">
                                        <input class="response_answer_class" id="response_answer_id<?php echo $desired_i; ?>" type="checkbox" name="response_answer[]" value="<?php echo $desired_i?>">
                                        <!--<input type="radio" name="response_answer" value="<?php echo $desired_i?>">-->
                                        <div class="ans_image" id="ans_image<?php echo $desired_i?>">
                                            <button type="button" class="image_click" id="image_click<?php echo $desired_i?>" value="<?php echo $desired_i?>"><img src="assets/images/images/answer_img.PNG"></button><span >Answer</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <button class="btn uploadsImgBtn" type="button" disabled onclick="insertUrlModal('<?= $i; ?>')"> Add Image</button>  -->
                                <div class="box">
                                    <textarea class="form-control mytextarea" id="img_insert_<?= $desired_i; ?>" name="vocubulary_image_<?php echo $desired_i?>[]"></textarea>
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
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <textarea class="mytextarea" id="questionName_2" name="questionName_2"></textarea>
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
    var flag = 1;
    var imgdata = [];
    var imgBoxdata = [];


    var myDropzone = new Dropzone("div#myId", { url: "story_Upload"});
      myDropzone.on("complete", function(file) {
      filename = file.name;
      z = filename.replace(filename.split('.').pop(), "");

      x++;

      imgdata.push(parseInt(z));
      img_url = (file.xhr.response);
      imgBoxdata.push(img_url);

      $(".uploadsMsg").html("<div class='uploads"+x+"' style='padding: 10px;background: darkseagreen;'>Uploaded Successfully</div>");
      $(".uploads"+x+"").fadeOut(5000);

      // img_url = '<?= base_url('/assets/uploads/') ?>'+(file.xhr.response);
      // $(".all_picList").append("<div class='col-sm-2' style='border: 1px solid #8c8c8c;cursor: pointer;' data-dismiss='modal' onclick='img_urlFunction("+JSON.stringify(img_url)+")' > <img src="+JSON.stringify(img_url)+" /> </div>")
	console.log(imgdata);
    });

    function start_upload() {
      if (x) {
        flag = 1;
        imgdata.sort(function(a, b){return a-b});
		console.log(imgdata);
		console.log(imgdata.length);
		  var len = imgdata.length;
        for (var i = 1; i <= imgdata.length; i++) {
          if (imgdata[i-1] != i) {
            var flag = 0;
          }
        }
		console.log(flag);
        if (flag) {
		  
          $(".ErrorMsg").html("");
          $(".upload_allFile").hide();
          $(".uploadBtnChoose").hide();
          $(".question_tutorial_input").html("<input type='hidden' name='question_tutorial_input' value="+imgBoxdata+" />");
	     $(".uploadsMsg_").html('('+len+')');
          // getImageBoxTwo(x , imgBoxdata);
        }else{
          $(".ErrorMsg").html("<div class='uploads' style='padding: 10px;background: #ff6565;color: #fdfdfd;'> Picture serial at number "+i+" is empty. </div>");
        }

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

    function getImageBoxTwo(qty , imgdata) {
        document.getElementById("image_quantity").value = qty;
        $.ajax({
          url:"<?php echo base_url(); ?>Tutor/multiple_choose_q_render",
          type:"post",
          dataType:'html',
          data:{qty:qty ,imgdata:imgdata },
          success:function(data){

            $('.ss_m_qu').html("");
            $('.ss_h_mi').html('');
            $('.uploadBtnChoose').hide();
            $('.ss_m_qu').html(data);
            
          }
        });
    }
    
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
