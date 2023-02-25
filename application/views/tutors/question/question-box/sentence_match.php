<style>
  .ques_class{
        background-color: #7f7f7f;
        padding: 5px 10px;
    }
</style>
 <div class="row">
   <div class="col-sm-12">
    <div>
    <div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-10">
        <div style="display: flex;">
            <button type="button" id="create_sentence" class="btn btn-default" style="border:3px solid #3a86a8;">Create Sentence</button>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="ques_class">
              <a style="cursor:pointer" id="show_question" > <span style="color: white;" > Question<i>(Click Here)</i></span></a>
            </div>
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

          <div id="question_list">
            <!-- <div style="display:flex">
              <a style="font-size: 25px;color: black;padding-top: 10px;text-decoration: underline;">Edit </a>&nbsp;&nbsp;<span style="font-size: 25px;color: black;padding-top: 10px;">A</span>&nbsp;&nbsp;&nbsp;&nbsp;
              <p style="background-color: #0000000f;padding: 15px;">This is good  jyk yik yiuo o io 79o79 sfr g dg fgdh gd hdg h</p>
            </div> -->
          </div>
  
            </div> 
    </div>
  </div>
            
    </div>
      <div id="all_answer" style="display:none;">

      </div>
      <div class="modal fade ss_modal " id="idea_question_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="max-width: 600px;">
      <div class="modal-content"> 
      <div style="background-color: #eee;" class="modal-body">

          <h6 style="text-align:center;font-weight:bold;">Question </h6>
            <div class="row">
              <textarea class="form-control mytextarea" name="question_instruct"></textarea>
            </div> 
            <div style="text-align: right;">
            <button style="margin-top:5px;" type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
            </div>
          </div> 
      </div>
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
        var ques_with_ans_selected = question.replace(ans,'<span style="background-color:#f39660;"> '+ans+'</span> ');
        $('#dailogBox').css('display','none');
        $('#dailogBoxTwo').css({ 'display':'block','border-radius': '5px', 'border': '1px solid #05b1cd', 'padding': '7px'});
        $('#dailogBoxTwo').html(ques_with_ans_selected);

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

                  var select_box = '<span class="student_ans'+a+'" data-id="'+a+'">&nbsp;<select style="width: 75px;" data-id="'+a+'" class="all_ans question_select'+a+'">'+options+'</select>&nbsp;</span>';
                  
                  var make_question = question.replace(ans,select_box);

                  html += '<div style="display:flex"><a style="font-size: 25px;color: black;padding-top: 10px;text-decoration: underline; cursor:pointer;" data-id="'+a+'" class="question_edit edit_ques_no'+a+'">Edit </a>&nbsp;&nbsp;<span style="font-size: 25px;color: black;padding-top: 10px;">'+letter[letter_no]+'</span>&nbsp;&nbsp;&nbsp;&nbsp;<div style="background-color: #0000000f;padding: 15px;font-size:20px;">'+make_question+'</div></div><br>';

                  
                  }
                  $("#question_list").html(html);
                  $("#question_list").css('display','block');
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

        var words = question.split(/\s+/);
        var allInputs = $('.word_common').length;
        var total_rows = allInputs/12;
        var letter = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
        for(var z=1;z<2;z++){
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
            
              $('.qes_no'+ques_no).val(question);
              $('.edit_question_text'+ques_no).text(question);
              
            }
          }
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
                  $('.word_common').val('');
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
                Answer: function() {

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
          var html = '<span data-id="'+ques_no+'" class="ans_change" style="color:#fb8836;font-size:20px;">'+get_ans+'</span>';
          $('.student_ans'+ques_no).html(html);
        });

        $(document).on('click','.ans_change',function(){ 
            var ques_no = $(this).attr('data-id');

            var options = '<option ></option>';
            var answers = <?php echo json_encode($answers)?>;
            for(var p=0;p<answers.length;p++){
              options += '<option value="'+answers[p]+'" style="color:#fb8836">'+answers[p]+'</option>';
            }
            var select_box = '<div style="display: flex;" class="student_ans'+ques_no+'" data-id="'+ques_no+'">&nbsp;<select data-id="'+ques_no+'" style="width: 100px;" class="all_ans question'+ques_no+'">'+options+'</select>&nbsp;</div>';

            $('.student_ans'+ques_no).html(select_box);
        });
        $(document).on('click','.ques_class',function(){
           $('#idea_question_details').modal('show');
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
 </script>
 
 <style>
  #ui-id-1{
    text-align: center !important;
  }
  .ui-dialog-buttonpane{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
  select{
      -webkit-appearance: listbox !important;
    }
 </style>