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


    select{
      -webkit-appearance: listbox !important;
    }

</style>


    <input type="hidden" value="<?= $question_info[0]['question_name_type']; ?>" name="question_name_type" id="question_name_type" >

    



    <div class="col-sm-8">
      <div class="row">
        <div class="col-sm-12">
        <div>
        <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-10">
        <div style="display: flex;">
            <button type="button" id="create_sentence" class="btn btn-default" style="border:3px solid #3a86a8;">Create Sentence</button>
            <!-- &nbsp;&nbsp;&nbsp;&nbsp;
            <div>margin-top: 22px;height: 40px;
              <p style="text-align: center;font-size:large;">Shuffle</p>
            <button type="button" id="create_sentence" class="btn btn-default" style="border:3px solid #3a86a8;">1</button>
            <button type="button" id="create_sentence" class="btn btn-default" style="border:3px solid #3a86a8;">2</button>
            <button type="button" id="create_sentence" class="btn btn-default" style="border:3px solid #3a86a8;">3</button>
            </div> -->
        </div> 
        <br>
        <table class="dynamic_table_skpi table" id="wordTable" style="display: none;">
          <tbody class="dynamic_table_skpi_tbody">
            
            <tr class="rw" 1="">

              <td class="question_name1" style="border:none;" data-index="1">
               <!-- <div style="display: flex;"><a style="color: black;font-size:22px;text-decoration: underline;">Edit</a> &nbsp;&nbsp;<b style="color: black;font-size:22px;">A</b></div> -->
              </td>
              <?php for($i=1;$i<=12;$i++){ ?>
              <td>
                <input type="text" value="" name="" class="form-control input-box word_common word_row1 ques_word<?=$i;?>"  style="min-width:50px;" readonly="" data-index="1" data-value="">
              </td>
              <?php }?>

            </tr>

            <tr class="rw" 1="">
              <td class="question_name2" style="border:none;" data-index="1">
              </td>

              <?php for($i=13;$i<=24;$i++){ ?>
              <td>
                <input type="text" value="" name="" class="form-control input-box word_common word_row2 ques_word<?=$i;?>"  style="min-width:50px;" readonly="" data-index="2" data-value="">
              </td>
              <?php }?>
            </tr>

            <tr class="rw" 1="">
              <td class="question_name3" style="border:none;" data-index="1">
              </td>

              <?php for($i=25;$i<=36;$i++){ ?>
              <td>
                <input type="text" value="" name="" class="form-control input-box word_common word_row3 ques_word<?=$i;?>"  style="min-width:50px;" readonly="" data-index="3" data-value="">
              </td>
              <?php }?>
            </tr>

            <tr class="rw" 1="">
              <td class="question_name4" style="border:none;" data-index="4">
              </td>

            <?php for($i=37;$i<=48;$i++){ ?>
              <td>
                <input type="text" value="" name="" class="form-control input-box word_common word_row4 ques_word<?=$i;?>"  style="min-width:50px;" readonly="" data-index="4" data-value="">
              </td>
              <?php }?>
            </tr>

            <tr class="rw" 1="">
              <td class="question_name5" style="border:none;" data-index="4">
              </td>
              <?php for($i=49;$i<=60;$i++){ ?>
              <td>
                <input type="text" value="" name="" class="form-control input-box word_common word_row5 ques_word<?=$i;?>"  style="min-width:50px;" readonly="" data-index="5" data-value="">
              </td>
              <?php }?>
            </tr>

          </tbody>
        </table>
        

          <div id="skiping_question_answer" style="width: auto; min-height: 31px; max-height: none; height: auto;display:none;" class="ui-dialog-content ui-widget-content">
            <div id="dailogBox">
              <input id="sentenceBox" type="text" name="set_skip_value" class="input-box form-control rs_set_skipValue" value="">
            </div>
            <div id="dailogBoxTwo">
            </div>

          </div>



          <div id="all_question">
             <div class="set_question">
                <input type="hidden" class="question_number" value="">
                <input type="hidden" class="answer_details" value="">
             </div>
          </div>


          <div id="question_list" style="display: block;">
            <?php
                    $all_questions = json_decode($question_info[0]['questionName'],true);
                    $answers = json_decode($question_info[0]['answer']);
                    $letter = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];

                    $questions = $all_questions['questions'];
                    $wrong_questions = $all_questions['wrong_questions'];
                    foreach($questions as $key => $question){
                        $ques_no = $key+1;
            ?>
            <div style="display:flex">
                <a style="font-size: 25px;color: black;padding-top: 10px;text-decoration: underline; cursor:pointer;" data-id="<?=$ques_no?>" class="question_edit edit_ques_no<?=$ques_no?>">Edit </a>
                &nbsp;&nbsp;
                <span style="font-size: 25px;color: black;padding-top: 10px;"><?=$letter[$key]?></span>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <div style="background-color: #0000000f;padding: 15px;font-size:20px;">
                <?php 
                   $replace_html = '<span style="color:#fb8836;">'.$answers[$key].'</span>';                 
                   $make_question = str_replace($answers[$key],$replace_html,$question);
                ?>
                    <?=$make_question?>
                  
                </div>
            </div>
            <br>
            <?php }?>
          </div>


        </div>
        </div>
                
        </div>
        <div id="all_answer" style="display:none;">
          <?php foreach($questions as $key => $question){
            $ques_no = $key+1;
            ?>
           <input type="text" class="question qes_no<?=$ques_no?>" value="<?=$question?>" name="question[]" data-value="<?=$answers[$key]?>" data-id="<?=$ques_no?>"><input type="text" class="answer ans_no<?=$ques_no?>" value="<?php echo $question.',,'.$answers[$key];?>" name="answer[]" data-value="" data-id="<?=$ques_no?>">
           <?php }?>
        </div>
      <div id="wrong_question" style="display:none;">
          <?php foreach($wrong_questions as $key => $wrong_question){
            $ques_no = $key+1;
            ?>
           <input type="text" class="wrong_question wrong_question_no<?=$ques_no?>" value="<?=$wrong_question?>" name="wrong_question[]" data-value="" data-id="<?=$ques_no?>">
          <?php }?>
      </div>
        </div>
      </div>





    </div>


    <div class="modal fade ss_modal " id="idea_question_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="max-width: 600px;">
      <div class="modal-content"> 
      <div style="background-color: #eee;" class="modal-body">

          <h6 style="text-align:center;font-weight:bold;">Question </h6>
            <div class="row">
              <textarea class="form-control mytextarea" name="question_instruct"><?= $question_info[0]['question_instruction']; ?></textarea>
            </div> 
            <div style="text-align: right;">
            <button style="margin-top:5px;" type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
            </div>
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


<script>
    $(document).ready(function(){
        $("#create_sentence").click(function(){
      $('#wordTable').css('display','block');
      $('#dailogBox').css('display','block');
      $('#dailogBoxTwo').css('display','none');
      $('.word_common').css('background-color','#eeeeee');
      $('.word_common').val('');
      $('#sentenceBox').val('');
      $(this).css('background-color','yellow');
      $("#wordTable").css('display','block');
      $("#question_list").css('display','none');
      
      $( "#skiping_question_answer" ).dialog({
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
                Question: function() {
                //$( this ).dialog( "close" ); 
                },
                Answer: function() {
                    var getSentence = $('#sentenceBox').val();
                    var words = getSentence.split(/\s+/);

                    var allInputs = $('.word_common').length;
                    var total_rows = allInputs/12;
                    var letter = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];

                    for(var z=1;z<=total_rows;z++){
                      var quesRow =[];
                      $(".word_row"+z).each(function() {
                        quesRow.push($(this).val());
                      });
                      if(quesRow[1]==''){
                        var word_length = words.length;
                        var zz =z-1;
                        var start = (zz*12)+1;
                        var end = start+words.length;
                        var k = 0;
                        var question_length = $('.question').length; 
                        var question_no = question_length+1;
                        for(var i=start;i<end;i++){
                          $('.ques_word'+i).val(words[k]);
                          $('.ques_word'+i).attr('data-value',question_no);
                          $('.ques_word'+i).css('background-color','#bee131');
                          k++;
                        }
                        
                        
                        var html = '<div style="display: flex;"><a style="color: black;font-size:22px;cursor: pointer;" class="question_no" data-id="'+question_no+'"><b style="color: black;font-size:22px;">'+letter[question_length]+'</b></a></div>';
                        $('.question_name'+z).html(html);

                        var ques_set = '<div class="set_question'+question_no+'"><input type="hidden" class="question_number'+question_no+'" value=""><input type="hidden" class="answer_details'+question_no+'" value=""></div>';

                        var html2 ='<input type="text" class="question qes_no'+question_no+'" value="'+getSentence+'" name="question[]" data-value="" data-id="'+question_no+'"><input type="text" class="answer ans_no'+question_no+'" value="" name="answer[]" data-value="" data-id="'+question_no+'">';

                      

                        $("#all_answer").append(html2);
                        
                        $( this ).dialog("close");
                        
                        return false;
                      }
                    }  
                    
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                },

            }
        });
      });

      $('.word_common').click(function(){
        var question_no = $(this).attr('data-value');
        var row_no = $(this).attr('data-index');
        $('.word_row'+row_no).css('background-color','#eee');
        $(this).css('background-color','#f39660');
        var ans = $(this).val();
        $('.qes_no'+question_no).attr('data-value',ans);

        var question = $('.qes_no'+question_no).val();
        var ans = $('.qes_no'+question_no).attr('data-value');
        var ans_with_ques = question+',,'+ans;
        $('.ans_no'+question_no).val(ans_with_ques);
        var ques_with_ans_selected = question.replace(ans,'<span data-id="'+question_no+'" id="set_wrong_ans" >______</span> ');
        $('#dailogBox').css('display','block');
        // $('#dailogBoxTwo').css({ 'display':'block','border-radius': '5px', 'border': '1px solid #05b1cd', 'padding': '7px'});
        $('#dailogBoxTwo').html(ques_with_ans_selected);
        var get_custom_sentence = $('#dailogBoxTwo').text();
        $('#sentenceBox').val(get_custom_sentence);
        

        $("#skiping_question_answer").dialog({
            resizable: false,
            modal: true,
            closeOnEscape: false,
            title : 'Create Question',
            open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
            height:'auto',
            width:'500',
            left:'520',
            id:'sentenceCreate',
            buttons: {
                Question: function() {

                  var wrong_sentence = $('#sentenceBox').val();
                  
                  html2 = '<input type="text" class="wrong_question wrong_question_no'+question_no+'" value="'+wrong_sentence+'" name="wrong_question[]" data-value="" data-id="'+question_no+'">';

                  var check_question_length = $('.wrong_question_no'+question_no).length;
                  if(check_question_length==1){
                     $('.wrong_question_no'+question_no).val(wrong_sentence);
                  }else{
                    $("#wrong_question").append(html2);
                  }
                  $( this ).dialog( "close" );
                  $('.word_common').val('');
                  $('#wordTable').css('display','none');

                  var letter = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];

                  var question_length = $('.question').length; 
                  var html='';

                  
                  
                  for(var a=1;a<=question_length;a++){
                  var letter_no = a-1;
                  var question = $('.qes_no'+a).val();
                  var ans = $('.qes_no'+a).attr('data-value');

                  var options = '<option ></option>';
                  var q_length = $('.question').length;

                  var shuffle_answer = [];
                  for(var p=1;p<=q_length;p++){
                    var ansers = $('.qes_no'+p).attr('data-value');
                    shuffle_answer.push(ansers);
                    //options += '<option value="'+ansers+'" style="color:#fb8836">'+ansers+'</option>';
                  }

                  var shuffle_match = shuffleArray(shuffle_answer);
                  for(var q=0;q<shuffle_match.length;q++){
                     options += '<option value="'+shuffle_match[q]+'" style="color:#fb8836">'+shuffle_match[q]+'</option>';
                  }

                  var select_box = '&nbsp;<span class="student_ans'+a+'" data-id="'+a+'" style="border:1px solid black;padding-right:60px;background-color:white;"></span>';
                  
                  var make_question = question.replace(ans,select_box);

                  html += '<div style="display:flex"><a style="font-size: 25px;color: black;padding-top: 10px;text-decoration: underline; cursor:pointer;" data-id="'+a+'" class="question_edit edit_ques_no'+a+'">Edit </a>&nbsp;&nbsp;<span style="font-size: 25px;color: black;padding-top: 10px;">'+letter[letter_no]+'</span>&nbsp;&nbsp;&nbsp;&nbsp;<div style="background-color: #0000000f;padding: 15px;font-size:20px;">&nbsp'+make_question+'</div></div><br>';
                  
                  }
                  $("#question_list").html(html);
                  $("#question_list").css('display','block');
                },
                Answer: function() {
                  
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                },

            }
        });
        
      });


      $(document).on('click','.question_no',function(){
        
        var question_no = $(this).attr('data-id');
        var question = $('.qes_no'+question_no).val();
        var ans = $('.qes_no'+question_no).attr('data-value');
        var ques_with_ans_selected = question.replace(ans,'<span style="background-color:#f39660;"> '+ans+' </span>');

      });

      $(document).on('click','.question_edit',function(){
        var ques_no = $(this).attr('data-id');
        var question = $('.qes_no'+ques_no).val();
        $('#dailogBox').css('display','block');
        $('#dailogBoxTwo').css('display','none');
        $('#sentenceBox').val(question);
        $('#wordTable').css('display','block');
        $('#question_list').css('display','block');
        $('.word_common').val('');
        $('.word_common').css('background-color','#eeeeee');

        $("#skiping_question_answer").dialog({
            resizable: false,
            modal: true,
            closeOnEscape: false,
            title : 'Edit Question',
            open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
            height:'auto',
            width:'500',
            left:'520',
            id:'sentenceCreate',
            buttons: {
                Question: function() {
                  
                },
                Answer: function() {
                  var getSentence = $('#sentenceBox').val();
                  var words = getSentence.split(/\s+/);

                  var allInputs = $('.word_common').length;
                  var total_rows = allInputs/12;
                  var letter = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];

                    for(var z=1;z<=total_rows;z++){
                      var quesRow =[];
                      $(".word_row"+z).each(function() {
                        quesRow.push($(this).val());
                      });
                      if(quesRow[1]==''){
                        var word_length = words.length;
                        var zz =z-1;
                        var start = (zz*12)+1;
                        var end = start+words.length;
                        var k = 0;
                        var question_length = $('.question').length; 
                        for(var i=start;i<end;i++){
                          $('.ques_word'+i).val(words[k]);
                          $('.ques_word'+i).attr('data-value',ques_no);
                          $('.ques_word'+i).css('background-color','#bee131');
                          k++;
                        }
                        
                        var letter_no = ques_no-1;
                        var html = '<div style="display: flex;"><a style="color: black;font-size:22px;cursor: pointer;" class="question_no" data-id="'+ques_no+'"><b style="color: black;font-size:22px;">'+letter[letter_no]+'</b></a></div>';
                        $('.question_name'+z).html(html);
                        

                        $('.qes_no'+ques_no).val(getSentence);
                       

                        $('.edit_question_text'+ques_no).text(getSentence);
                        
                        $( this ).dialog("close");
                        return false;
                      }
                    }
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                },

            }
        });

      });


        $(document).on('change','.all_ans', function(){  
          var get_ans = $(this).val();
          var ques_no = $(this).attr('data-id');
          var html = '<span style="color:#fb8836;font-size:20px;">'+get_ans+'</span>';
          $('.student_ans'+ques_no).html(html);
        });

        $(document).on('click','#dailogBoxTwo', function(){
            var question_no = $('#set_wrong_ans').attr('data-id');
            var get_sentence = $('.qes_no'+question_no).val();
            //alert(get_sentence);
            $('#dailogBoxTwo').css('display','none');
            $('#dailogBox').css('display','block');
            $('#sentenceBox').val(get_sentence);
           
        });

    });

      function shuffleArray(array) {
        for (var i = array.length - 1; i > 0; i--) {
        
            // Generate random number
            var j = Math.floor(Math.random() * (i + 1));
                        
            var temp = array[i];
            array[i] = array[j];
            array[j] = temp;
        }
            
        return array;
      }
    //  $("#show_answer_box").click(function () {
    //      $("#answer_box").show();
    //  });
    //  $("#woq_close_btn").click(function () {
    //      $("#answer_box").hide();
    //  });
    // $("#show_question").click(function () {
    //     $("#question_box").show();
    // });
    // $("#wotwoq_close_btn").click(function () {
    //     $("#question_box").hide();
    // });
</script>
