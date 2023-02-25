<?php //echo '<pre>';print_r($question_info_ind);die;?>
<style>
  .ss_s_b_main{
    min-height: 100vh;
  }
  #letter_button_box{
    position: absolute;
    z-index: 1;
    margin-left:3%;
    background: gray;
    padding-top: 15px;
    padding-bottom: 15px;
    padding-left:15px;
    padding-right:5px;
    display:none;
    flex-wrap: wrap;
    width: auto;
  }
  #red_button{
    height: 20px;
    width: 47px;
    background: red;
    color: red;
  }
  #blue_button{
    height: 20px;
    width: 47px;
    margin-left:6px;
    background: blue;
    color: blue;
  }
  .letter_box{
    text-align: center;
    width: 100px !important;
    height: 45px;
    background-color: #fff;
    border-radius: 5px;
  }
  .box_with_button{
    display: flex;
    padding-bottom:5px;
    padding-right:10px;
  }
  #set_question{
    padding-top: 10px;
    padding-left: 15px;
    padding-right: 15px;
    margin-top: 35px;
    color: white;
    background: #ff6a00;
    border-radius: 5px;
    text-decoration: none;
  }
</style>
<style>
  .form-group{
    display: block !important;
    margin-bottom: 10px !important;
  }
</style>
<style>
  
  @media screen and (min-width: 768px) {
    .space_reduce{
    padding-left: 8px;
    max-width: 111px;

  }
  }
</style>
<div id="vocabulary_new">
    <div class="row">
      <div class="col-sm-2">
        
      </div>
    <div class="col-sm-10">
        <div id="sentence_view" style="display: none;">
            <button type="button" id="create_sentence" class="btn btn-default" style="border:3px solid #3a86a8;">Create Sentence</button>
        </div> 
        <br>
        
        <table class="dynamic_table_skpi table" id="wordTable" style="display: none;">
          <tbody class="dynamic_table_skpi_tbody">
            
            <tr class="rw" 1="">

              <td class="question_name1" style="border:none;" data-index="1">
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
          </tbody>
        </table>
        <div id="letter_button_box" >
          
        </div>
        <div id="all_answer" style="display:none;">

        </div>
        <br>
        

        <div id="skiping_question_answer" style="width: auto; min-height: 31px; max-height: none; height: auto;display:none;" class="ui-dialog-content ui-widget-content">
          <div id="dailogBox">
            <input id="sentenceBox" type="text" name="set_skip_value" class="input-box form-control rs_set_skipValue" value="">
          </div>
          <div id="dailogBoxTwo">
          </div>

        </div>
    </div>
    </div>

</div>
<div id="vocabulary_old">
<div class="col-sm-4">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
          <a role="button" aria-expanded="true" aria-controls="collapseOne">
            <span onclick="setSolution()">
              <img src="assets/images/icon_solution.png"> Solution
            </span> Question
          </a>
        </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body form-horizontal ss_image_add_form">
          <!--  <form class="form-horizontal ss_image_add_form"> -->
            <div class="form-group">
              <label for="inputwordl3" class="col-sm-4 space_reduce control-label">Word </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputword3" name="answer" value="<?php echo $question_info[0]['answer']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputDefinitionl3" class="col-sm-4 space_reduce control-label">Definition</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputDefinitionl3" name="definition" value="<?php echo $question_info_ind->definition; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPartsofspeech3" class="col-sm-4 space_reduce control-label">Parts of speech</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPartsofspeech3" name="parts_of_speech" value="<?php echo $question_info_ind->parts_of_speech; ?>" >
              </div>
            </div>
            <div class="form-group">
              <label for="inputSynonym3" class="col-sm-4 space_reduce control-label">Synonym</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputSynonym3" name="synonym" value="<?php echo $question_info_ind->synonym; ?>" >
              </div>
            </div>
            <div class="form-group">
              <label for="inputAntonym3" class="col-sm-4 space_reduce control-label">Antonym</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputAntonym3" name="antonym" value="<?php echo $question_info_ind->antonym; ?>" >
              </div>
            </div>

            <div class="form-group">
              <label for="inputYourSentence3" class="col-sm-4 space_reduce control-label">Hint</label>
              <div class="col-sm-8">
                <a data-toggle="modal" data-target="#questionHint" class="text-center" style="display: inline-block;">
                  <img src="assets/images/icon_details.png">
                </a>
                <input type="hidden" class="form-control" id="sentence" name="sentence" value="" placeholder="Your Sentence">
                <!-- <input type="text" class="form-control" id="inputYourSentence3" name="sentence" value="<?php echo $question_info_ind->sentence; ?>" > -->
              </div>
            </div>
            <div class="form-group">
              <label for="inputNearAntonym3" class="col-sm-4 space_reduce control-label">Category</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputNearAntonym3" name="near_antonym" value="<?php echo $question_info_ind->near_antonym; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputNearAntonym3" class="col-sm-4 space_reduce control-label">Speech To Text</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="spchToTxt" name="speech_to_text" value="<?php echo isset($question_info_ind->speech_to_text)?$question_info_ind->speech_to_text:''; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 space_reduce control-label">Audio File</label>
              <div class="col-sm-8">
                <input type="file" id="exampleInputFile" name="audioFile">
                <input type="hidden" name="existed_audio_File" value="<?php echo isset($question_info_ind->audioFile)?$question_info_ind->audioFile:''; ?>">
              </div>
              <div class="row">
                
                <?php  if (isset($question_info_ind->audioFile)) { ?>
                <audio controls class="col-sm-10">
                  <source src="<?= $question_info_ind->audioFile; ?>" >
                </audio>
                <button class="col-sm-2" type="button" id="delete_audio_file" style="border: none;background: none;padding: 10px;font-size: 24px" question_item="<?= $question_item?>" question_id="<?= $question_id?>"><i class="fa fa-close"></i></button>
                
                <?php } ?>
            
              </div>
            </div>
            
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 space_reduce control-label">Video file</label>
              <div class="col-sm-8">
                <?php if ($this->session->userdata('userType')==7) : ?>
                  <input type="file" id="exampleInputFilevideo" name="videoFile">
                  <label id="upload-photo-label" for="exampleInputFilevideo"><i class="fa fa-youtube-play"></i></label>
                <?php endif; ?>
                <label id="upload-photo-label" class="ytLink"><i class="fa fa-youtube"></i></label>
              </div>
            </div>

            <!--  </form> -->
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="col-sm-4">
    <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
          <a style="float:left;text-decoration:underline;display:none;" href="javascript:;" data-id="1" id="sentence_make">Sentence</a>
            
            <a style="float:left;text-decoration:underline; margin-left:10px;display:block;" href="javascript:;" data-id="1" id="sentence_edit">Edit</a>
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">  Image</a>
          </h4>
        </div> 
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body ss_imag_add_right">

            <div class="text-center">
              <div class="form-group ss_h_mi">
                <label for="exampleInputiamges1">How many images</label>
                <div class="select">
                  <input class="form-control" type="number" value="<?php if(isset($question_info_ind->vocubulary_image)){ echo sizeof($question_info_ind->vocubulary_image); }else{ echo 1;} ?>" id="box_qty" onclick="getImageBox(this)">
                </div>
              </div>
            </div>

            <div class="image_box_list" id="image_box_list">
                <?php
                $i = 1;
                $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T'); 
                //echo "okkkkk<pre>";print_r($question_info_ind->vocubulary_image);die();
                if(isset($question_info_ind->vocubulary_image)){

                //foreach ($question_info_ind->vocubulary_image as $row) {
                    ?>
                <div class="row editor_hide" id="list_box_1" style="display:none; margin-bottom:5px">
                  <div class="col-xs-2">
                    <p class="ss_lette" style="min-height: 136px; line-height: 137px; ">
                      <?php echo $lettry_array[0]; ?>
                    </p>
                  </div>
                  <div class="col-xs-10">
                    <div class="box">
                      <textarea class="form-control vocubulary_image getsentence<?=$i?>" name="vocubulary_image_1[]"><?php echo $question_info_ind->vocubulary_image[0][0]; ?></textarea>
                    </div>
                  </div>
                </div>
                    <?php $i++;
                //} ?>

                  <?php for ($desired_i = $i; $desired_i <= 20; $desired_i++) { ?>                    
                  <div class="row editor_hide" id="list_box_<?php echo $desired_i; ?>" style="display:none; margin-bottom:5px">
                    <div class="col-xs-2">
                      <p class="ss_lette" style="min-height: 136px; line-height: 137px; ">
                        <?php echo $lettry_array[$desired_i - 1]; ?>
                      </p>
                    </div>
                    <div class="col-xs-10">
                      <div class="box">
                        <textarea class="form-control vocubulary_image" name="vocubulary_image_<?php echo $desired_i; ?>[]"></textarea>
                      </div>
                    </div>
                  </div>                      
                  <?php } ?>
                  <input type="hidden" name="image_quantity" id="image_quantity">

                <?php }else{ ?>
                <div class="row editor_hide" id="list_box_1" >
                  <div class="col-xs-2">
                    <p class="ss_lette" style="min-height: 136px; line-height: 137px;">A</p>
                  </div>
                  <div class="col-xs-10">
                    <div class="box">
                    <textarea class="form-control vocubulary_image getsentence1" name="vocubulary_image_1[]"></textarea>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="image_quantity" id="image_quantity" value="1"> 
                <?php } ?>


                
            </div>  
                     

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- vocabulary hint modal -->
  <div class="modal fade ss_modal ew_ss_modal" id="questionHint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"> Question Hint </h4>
        </div>
        <div class="modal-body">
          <textarea class="form-control" id="questionHintText" name="questionHint"><?php echo $question_info_ind->sentence; ?></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
          <button type="button" id="hintSaveBtn" class="btn btn_blue" data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>

  <div id="ytLinkDialog" title="Set youtube link" style="display: none">
    <input class="form-control" type="text" name="" id="dialogLink" value="<?php echo isset($question_info_ind->ytLinkInput) ? $question_info_ind->ytLinkInput:''; ?>">
    <hr>
    <div class="well" style="padding:10px;"><strong>Put Reference</strong></div>
    <input class="form-control" type="text" name="" id="dialogTitle" value="<?php echo isset($question_info_ind->ytLinkTitle) ? $question_info_ind->ytLinkTitle:''; ?>">
  </div>

  <input type="hidden" name="ytLinkInput" id="ytLinkInput" value="<?php echo isset($question_info_ind->ytLinkInput) ? $question_info_ind->ytLinkInput:''; ?>">
  <input type="hidden" name="ytLinkTitle" id="ytLinkTitle" value="<?php echo isset($question_info_ind->ytLinkTitle) ? $question_info_ind->ytLinkTitle:''; ?>">

  <script>
    $(document).ready(function(){
      $('#sentence_make').click(function(){
        $('#sentence_view').css('display','flex');
        $("#vocabulary_old").css('display','none');
        $("#vocabulary_new").css('display','block');
      });

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
                    $('#letter_button_box').css('display','none');
                    var getSentence = $('#sentenceBox').val();
                    $("#sentence").val(getSentence);
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
                Answer: function() {
                    
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                },

            }
        });
      });


      $('.word_common').click(function(){
        var ans = $(this).val();
        var ans_word = ans.split('');
        var html = '';
        var html2 = '<a type="button;" href="javascript:;" id="set_question">Set</a>';
        for(var i=0;i<ans_word.length;i++){
          class_no = i+1;
          html += '<div style="width: auto;display: inline-flex;"><div><div class="box_with_button" style=""><a id="red_button" data-id="'+class_no+'" class="button_red red_color'+class_no+'" type="button;" href="javascript:;">o</a><a id="blue_button" data-id="'+class_no+'" class="button_blue blue_color'+class_no+' type="button;" href="javascript:;">o</a></div><input type="text" class="letter_box letter_input'+class_no+'" value="'+ans_word[i]+'" data-index="'+ans_word[i]+'"></div></div>';
        }
        $('#letter_button_box').css('display','flex');
        $('#letter_button_box').html(html);
        $('#letter_button_box').append(html2);

        //$('#letter_button_box').html(html);
        // $("#skiping_question_answer").dialog({
        //     resizable: false,
        //     modal: true,
        //     closeOnEscape: false,
        //     title : 'Edit Question',
        //     open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
        //     height:'auto',
        //     width:'500',
        //     left:'520',
        //     id:'sentenceCreate',
        //     buttons: {
        //         Question: function() {
                
        //         },
        //         Answer: function() {
                  
        //         },
        //         Cancel: function() {
        //             $( this ).dialog( "close" );
        //         },

        //     }
        // });
        
      });

      $(document).on('click','.button_red',function(){
        var class_no = $(this).attr('data-id');
        var last_class_no = $('.button_red').length; 

        if(class_no == 1){
          $('.letter_input'+class_no).css('color','red');
          $('.letter_input'+class_no).attr('data-value','red');
        }else{
          $('.letter_input'+class_no).css('color','red');
          $('.letter_input'+class_no).val('_ ');
          $('.letter_input'+class_no).attr('data-value','red');
        }
      });

      $(document).on('click','.button_blue',function(){
        var class_no = $(this).attr('data-id');
        var last_class_no = $('.button_blue').length; 
        var get_char = $('.letter_input'+class_no).attr('data-index');
        var check_char = $('.letter_input'+class_no).val('');
        if(get_char != check_char){
          $('.letter_input'+class_no).val(get_char);
        }
        $('.letter_input'+class_no).css('color','blue');
        $('.letter_input'+class_no).attr('data-value','blue');
        // if(class_no == 1){
        //   $('.letter_input'+class_no).css('color','blue');
        //   $('.letter_input'+class_no).attr('data-value','blue++');
        // }else if(class_no == last_class_no){
        //   $('.letter_input'+class_no).css('color','blue');
        //   $('.letter_input'+class_no).attr('data-value','blue++');
        // }else{
        //   $('.letter_input'+class_no).css('color','blue');
        //   $('.letter_input'+class_no).val('-');
        //   $('.letter_input'+class_no).attr('data-value','blue++');
        // }
      });

      $(document).on('click','#set_question',function(){
        //$('#letter_button_box').css('display','none');
         //$('.getsentence1').val('gggg');
        var letter_length = $('.letter_box').length;

        $('#vocabulary_old').css('display','block');
        $('#vocabulary_new').css('display','none');
        var get_ans = '';
        var get_color = '';
        var get_ans_html = '';

        for(var i=1;i<=letter_length;i++){
          get_ans += $('.letter_input'+i).attr('data-index');
          single_char = $('.letter_input'+i).val();
          single_color = $('.letter_input'+i).attr('data-value');

          if($('.letter_input'+i).attr('data-value')==undefined){
            get_color += '??++';
            get_ans_html += '<b style="color:none;">'+single_char+'</b>';
          }else{
            get_color += $('.letter_input'+i).attr('data-value')+'++';
            get_ans_html += '<b style="color:'+single_color+';">'+single_char+'</b>';
          }
        }
       
        $('.ans_no1').val(get_ans);
        $('.ans_no1').attr('data-index',get_color);
        var sentence = $('#sentenceBox').val();
        var make_sentence = sentence.replace(get_ans,get_ans_html);
        // alert(sentence);
        // alert(make_sentence)
        $('.getsentence1').val('<p style="font-size: 20px;margin-bottom:20px;">'+make_sentence+'</p>');
        $('#sentence_edit').css('display','block');
      });


      $('#sentence_edit').click(function(){
        $('.word_common').val('');
        $('.letter_box').val('');
        $('#sentence_view').css('display','flex');
        $('#vocabulary_old').css('display','none');
        $('#vocabulary_new').css('display','block');
        $('#wordTable').css('display','block');
        //$('#letter_button_box').css('display','flex');
        var sentence = '<?php echo $question_info_ind->sentence; ?>';
        
        var ans = '<?php echo $question_info[0]['answer']; ?>';
        $('#sentenceBox').val(sentence);
        var ques_no = 1;

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
                  var get_sentence = $('#sentenceBox').val();
                  $("#sentence").val(get_sentence);
                  var words = get_sentence.split(/\s+/);
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
                        

                        $('.qes_no'+ques_no).val(get_sentence);
                       

                        $('.edit_question_text'+ques_no).text(get_sentence);
                        
                        $( this ).dialog("close");
                        return false;
                      }
                    }
                },
                Answer: function() {
                  
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                },

            }
        });
      });

    });



    var qtye = $("#box_qty").val();

    document.getElementById("image_quantity").value = qtye;
    common(qtye);
    function getImageBox() {
      var qty = $("#box_qty").val();
      if (qty < 1) {
        $("#box_qty").val(1);
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


  //save yt link on hidden field
  $('.ytLink').on('click', function(){
    $( "#ytLinkDialog" ).dialog({
      minWidth: 600,
      title: 'Set youtube link',
      buttons: [
      {
        text: "Cancel",
        icon: "ui-icon ui-icon-heart",
        click: function() {
          $( this ).dialog( "close" );
        }
      },
      {
        text: "Save",
        icon: "ui-icon-heart",
        click: function() {
          var link = $('#dialogLink').val();
          var title = $('#dialogTitle').val();
          $('#ytLinkInput').val(link);
          $('#ytLinkTitle').val(title);
          $( this ).dialog( "close" );
        }
      }
      ]
    });
  });

  //hint save on hidden input
  $('#hintSaveBtn').on('click', function(){
    var hint = $('#questionHintText').val();
    $('#sentence').val(hint);
  })


  $('#delete_audio_file').click(function(){

    var question_id = $(this).attr('question_id');
    var question_item = $(this).attr('question_item');

    $.ajax({
       url:"<?php echo base_url(); ?>Tutor/question_audio_delete",
       type:"post",
       data:{question_id:question_id,question_item:question_item},
       success:function(data){
        if (data == 'success') {
          alert('Remove audio file succesffully!!');
          location.reload();
        }
       }
   });
  })
</script>