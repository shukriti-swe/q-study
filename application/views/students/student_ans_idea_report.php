<style>
   .tooltip_rs {
      bottom: 100%;
      position: absolute;
      background: #00a2e8;
      z-index: 10;
      padding: 7px;
      color: #fff;
      font-size: 12px;
      margin-bottom: 15px;
      left: 0;
      width: max-content;
      display: block;
      max-width: 400px;
      height: fit-content;
   }

   .tooltip_rs::after {
      width: 0;
      height: 0;
      border-left: 20px solid transparent;
      border-right: 20px solid transparent;
      border-top: 15px solid #00a2e8;
      content: '';
      position: absolute;
      bottom: -15px;
      left: 10%;
   }

   .tooltip_rs_new {
      bottom: 100%;
      position: absolute;
      background: #ED1C24;
      z-index: 10;
      padding: 7px;
      color: #fff;
      font-size: 12px;
      margin-bottom: 15px;
      left: 0;
      width: max-content;
      display: block;
      max-width: 400px;
      height: fit-content;
   }

   .tooltip_rs_new::after {
      width: 0;
      height: 0;
      border-left: 20px solid transparent;
      border-right: 20px solid transparent;
      border-top: 15px solid #ED1C24;
      content: '';
      position: absolute;
      bottom: -15px;
      left: 10%;
   }
   .one_hint_wrap {
      display: inline;
      position: relative;
   }
   .btn-select {
    background: #a9a8a8;
    color: #fff;
    box-shadow: none !important;
    border-radius: 0;
    padding: 4px 8px;
    
  }
</style>
<?php 
    // echo "oooooo<pre>";print_r($idea_infos);die();
    $ans_info =  $idea_infos[0]; 

?> 

<div class="container-fluid">
   <div class="row">
       <div class="col-md-6">
 
       </div> 
       <div class="col-md-5" style="margin-left:3%;">
          <div style="text-align:center;">
            <a class="btn btn-select"  id="title_menu_button">Title</a>
            <a class="btn btn-select" style="display:none;" id="spelling_error_menu_button">Spelling Error</a>
            <a class="btn btn-select" style="display:none;" id="creative_sentence_menu_button">Metaphor</a>
            <a class="btn btn-select" style="display:none;" id="introduction_menu_button">Introduction</a>
            <a class="btn btn-select" style="display:none;" id="body_paragraph_menu_button">Body Paragraph</a>
            <a class="btn btn-select" style="display:none;" id="conclution_menu_button">Conclution</a>
          </div>
           
       </div>
   </div>
   <br>
   <div class="row" style="padding:0px 5px; display: flex;">

    <div class="col-md-6" style="border: 1px solid #82bae6;padding: 5px;box-shadow: 0px 0px 4px #82bae6;border-radius: 5px;">
      
      <div class="student_idea_text">
        <?= $idea_infos[0]['idea_ans']; ?>
      </div>
      <div class="spelling_idea_text" style="display:none;">
      </div>
      <div class="creative_sentence_text" style="display:none;">
      </div>
      <div class="introduction_answer_paragraph" style="display:none;">
      </div>
      <div class="body_answer_paragraph" style="display:none;">
      </div>
      <div class="conclusion_sentense_paragraph" style="display:none;">
      </div>
    </div>


    <div class="col-md-5" style="border:1px solid gray;padding:5px;margin-left:3%;overflow: hidden;">
        <div style="display:" id="title_box">
            <br>
            <div class="row">
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/poor_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Poor
                  <input type="radio" style="margin-left:5px;" name="title_mark" class="average_check student_marking" value="5" <?php if($ans_info['total_title_mark']==5){echo 'checked';}?>></p>
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/average_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Average
                  <input type="radio" style="margin-left:5px;" name="title_mark" class="average_check student_marking" value="10" <?php if($ans_info['total_title_mark']==10){echo 'checked';}?>> </p>
                  
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/good_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Good
                  <input type="radio" style="margin-left:5px;" name="title_mark" class="good_check student_marking" value="15" <?php if($ans_info['total_title_mark']==15){echo 'checked';}?>></p>
                  
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/excelent_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Excelent
                  <input type="radio" style="margin-left:5px;" name="title_mark" class="excelent_check student_marking" value="20" <?php if($ans_info['total_title_mark']==20){echo 'checked';}?>></p>
                  
                </div>
            </div>

            <div style="padding: 32px 60px;margin: 30px 50px;background: #7c7c7c;text-align: center;border-radius: 20px;">
                <?php 
                    if($ans_info['total_title_mark']==5){
                        $get_status = 'Poor';
                    }else if($ans_info['total_title_mark']==10){
                        $get_status = 'Average';
                    }else if($ans_info['total_title_mark']==15){
                        $get_status = 'Good';
                    }else if($ans_info['total_title_mark']==20){
                        $get_status = 'Excellent';
                    }
                   
                ?>
                <p style="color:white;">Your story ts title is <?=$get_status?> Keep it up,</p>
            </div>


            <h6 style="text-align:center;margin-top: 30px;">Your Point : 
            <a class="btn btn-danger" style="width:30px;"><?=$ans_info['total_title_mark']?></a></h6>

            <br><br>
            <div style="text-align:center;">
                <a href="javascript:;" type="button" class="btn btn-primary ans_submit" style="background-color: #ffc90e;color:#000;margin-left:10px;">Next</a>
            </div>
        </div>

        <div style="display:none;" id="spelling_box">
            <div style="padding: 32px 60px;margin: 30px 50px;background: #7c7c7c;text-align: center;border-radius: 20px;">
                <p style="color:white;">Look at your spelling error, Try to improve more !</p>
            </div>
            
            <h6 style="text-align:center;margin-top: 30px;">Your Point : 
            <a class="btn btn-danger" style="width:30px;"><?=$ans_info['total_spelling_mark']?></a></h6>

            <br><br>
            <div style="text-align:center;">
                <a href="javascript:;" type="button" class="btn btn-primary spelling_next_submit" style="background-color: #ffc90e;color:#000;margin-left:10px;">Next</a>
            </div>
        </div>

        <div style="display:none;" id="creative_sentence_box">
            <div style="padding: 32px 60px;margin: 30px 50px;background: #7c7c7c;text-align: center;border-radius: 20px;">
                    <p style="color:white;">You have 2 Metaphor which excelent</p>
                </div>
                
                <h6 style="text-align:center;margin-top: 30px;">Your Point : 
                <a class="btn btn-danger" style="width:30px;"><?=$ans_info['creative_sentence_mark']?></a></h6>
                <br><br>
                <div style="text-align:center;">
                    <a href="javascript:;" type="button" class="btn btn-primary creative_next_submit" style="background-color: #ffc90e;color:#000;margin-left:10px;">Next</a>
            </div>
        </div>
        
        <div style="display:none;" id="introduction_box">
            <div class="row">
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/poor_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Poor
                  <input type="radio" style="margin-left:5px;" name="intro_mark" class="average_check student_marking" value="5" <?php if($ans_info['introduction_point']==5){echo 'checked';}?>></p>
                  
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/average_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Average
                  <input type="radio" style="margin-left:5px;" name="intro_mark" class="average_check student_marking" value="10" <?php if($ans_info['introduction_point']==10){echo 'checked';}?>> </p>
                  
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/good_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Good
                  <input type="radio" style="margin-left:5px;" name="intro_mark" class="good_check student_marking" value="15" <?php if($ans_info['introduction_point']==15){echo 'checked';}?>></p>
                 
                </div>
                <div class="col-md-3">
                  <div style="text-align:center;">
                    <img src="assets/images/excelent_img.png" style="height:75px;">
                  </div>
                  <p class="text-center" style="font-weight:bold;color:#87551c;">Excelent
                  <input type="radio" style="margin-left:5px;" name="intro_mark" class="excelent_check student_marking" value="20" <?php if($ans_info['introduction_point']==20){echo 'checked';}?>></p>
                  
                </div>
            </div>
            <div style="padding: 32px 60px;margin: 30px 50px;background: #7c7c7c;text-align: center;border-radius: 20px;">
                    <p style="color:white;font-size:22px;">Excelent !</p>
            </div>

            <h6 style="text-align:center;margin-top: 30px;">Your Point : 
                <a class="btn btn-danger" style="width:30px;"><?=$ans_info['introduction_point']?></a>
            </h6>

            <br><br>
            <div style="text-align:center;">
                <a href="javascript:;" type="button" class="btn btn-primary introduction_next_submit" style="background-color: #ffc90e;color:#000;margin-left:10px;">Next</a>
            </div>
        </div>

        <div style="display:none;" id="body_paragraph_box">
        <div class="row">
            <div class="col-md-3">
                <div style="text-align:center;">
                <img src="assets/images/poor_img.png" style="height:75px;">
                </div>
                <p class="text-center" style="font-weight:bold;color:#87551c;">Poor
                <input type="radio" style="margin-left:5px;" name="b_p_mark" class="average_check student_marking" value="5" <?php if($ans_info['body_paragraph_point']==5){echo 'checked';}?>></p>
                
            </div>
            <div class="col-md-3">
                <div style="text-align:center;">
                <img src="assets/images/average_img.png" style="height:75px;">
                </div>
                <p class="text-center" style="font-weight:bold;color:#87551c;">Average
                <input type="radio" style="margin-left:5px;" name="b_p_mark" class="average_check student_marking" value="10" <?php if($ans_info['body_paragraph_point']==10){echo 'checked';}?>> </p>
                
            </div>
            <div class="col-md-3">
                <div style="text-align:center;">
                <img src="assets/images/good_img.png" style="height:75px;">
                </div>
                <p class="text-center" style="font-weight:bold;color:#87551c;">Good
                <input type="radio" style="margin-left:5px;" name="b_p_mark" class="good_check student_marking" value="15" <?php if($ans_info['body_paragraph_point']==15){echo 'checked';}?>></p>
                
            </div>
            <div class="col-md-3">
                <div style="text-align:center;">
                <img src="assets/images/excelent_img.png" style="height:75px;">
                </div>
                <p class="text-center" style="font-weight:bold;color:#87551c;">Excelent
                <input type="radio" style="margin-left:5px;" name="b_p_mark" class="excelent_check student_marking" value="20" <?php if($ans_info['body_paragraph_point']==20){echo 'checked';}?>></p>
                
            </div>
            </div>
            <div style="padding: 32px 60px;margin: 30px 50px;background: #7c7c7c;text-align: center;border-radius: 20px;">
                    <p style="color:white;font-size:22px;">Excelent !</p>
            </div>

            <h6 style="text-align:center;margin-top: 30px;">Your Point : 
                <a class="btn btn-danger" style="width:30px;"><?=$ans_info['body_paragraph_point']?></a>
            </h6>

            <br><br>
            <div style="text-align:center;">
                <a href="javascript:;" type="button" class="btn btn-primary paragraph_next_submit" style="background-color: #ffc90e;color:#000;margin-left:10px;">Next</a>
            </div>
        </div>

        <div style="display:none;" id="conclusion_paragraph_box">
            <div class="row">
            <div class="col-md-3">
                <div style="text-align:center;">
                <img src="assets/images/poor_img.png" style="height:75px;">
                </div>
                <p class="text-center" style="font-weight:bold;color:#87551c;">Poor
                <input type="radio" style="margin-left:5px;" name="st_mark" class="average_check student_marking" value="5" <?php if($ans_info['conclusion_point']==5){echo 'checked';}?>></p>
                
            </div>
            <div class="col-md-3">
                <div style="text-align:center;">
                <img src="assets/images/average_img.png" style="height:75px;">
                </div>
                <p class="text-center" style="font-weight:bold;color:#87551c;">Average
                <input type="radio" style="margin-left:5px;" name="st_mark" class="average_check student_marking" value="10" <?php if($ans_info['conclusion_point']==10){echo 'checked';}?>> </p>
                
            </div>
            <div class="col-md-3">
                <div style="text-align:center;">
                <img src="assets/images/good_img.png" style="height:75px;">
                </div>
                <p class="text-center" style="font-weight:bold;color:#87551c;">Good
                <input type="radio" style="margin-left:5px;" name="st_mark" class="good_check student_marking" value="15" <?php if($ans_info['conclusion_point']==15){echo 'checked';}?>></p>
            </div>
            <div class="col-md-3">
                <div style="text-align:center;">
                <img src="assets/images/excelent_img.png" style="height:75px;">
                </div>
                <p class="text-center" style="font-weight:bold;color:#87551c;">Excelent
                <input type="radio" style="margin-left:5px;" name="st_mark" class="excelent_check student_marking" value="20" <?php if($ans_info['conclusion_point']==20){echo 'checked';}?>></p>
                
            </div>
            </div>
            <div style="padding: 32px 60px;margin: 30px 50px;background: #7c7c7c;text-align: center;border-radius: 20px;">
                    <p style="color:white;font-size:22px;">Excelent !</p>
            </div>

            <h6 style="text-align:center;margin-top: 30px;">Your Point : 
                <a class="btn btn-danger" style="width:30px;"><?=$ans_info['conclusion_point']?></a>
            </h6>
            <br><br>
            <div style="text-align:center;">
                <a href="javascript:;" type="button" class="btn btn-primary conclusion_next_submit" style="background-color: #ffc90e;color:#000;margin-left:10px;">Next</a>
            </div>
        </div>

        <div style="display:none;" id="total_point_box">
           
            <div style="position:relative;text-align:center;">
               <img src="assets/images/total_point.png" style="height:200px;">
               <?php 
                   $total_point =  $ans_info['total_title_mark']+$ans_info['total_spelling_mark']+$ans_info['creative_sentence_mark']+$ans_info['introduction_point']+$ans_info['body_paragraph_point']+$ans_info['conclusion_point'];
               ?>
                   <a class="btn btn-danger" style="top: 140px;position: absolute;width: 45px;left: 245px;"><?=$total_point?></a>
            </div>
            <br>
            <div style="text-align:center;">
                <a href="javascript:;" type="button" class="btn btn-primary total_next_submit" style="background-color: #bee131;color:#000;margin-left:10px;">Next</a>
            </div>
        </div>


    </div>

  </div>


</div>

<script>
  $(document).ready(function() {

    var tutor_ans = $('.student_idea_text').html();
    // console.log(tutor_ans);
    // alert(tutor_ans);

    /*===========new code=================*/
    if (tutor_ans != '') {
      var new_sentense = tutor_ans.match(/<p>([^\<]*?)<\/p>/g);
      var get_sentences = new_sentense.slice(1);
      var sentences = new Array();
      var all_answer = '';
      var spelling_answer = '';
      var all_sentense_answer = '';
      var all_introduction_answer = '';
      var all_body_answer='';
      var all_conclusion_answer='';
      var all_input = '';
      var html = '';
      var html2 = '<button type="button" class="btn btn_blue " data-dismiss="modal">Close</button>';
      var abc_arr = new Array();
      var sentense_store = new Array();

      for (var i = 0; i < get_sentences.length; i++) {

        var get_sentence = get_sentences[i].replace(/<[\/]{0,1}(p)[^><]*>/ig, "");
        var new_get_word = get_sentence.split(" ");
        var get_new_sentense = get_sentence.split(".");

        //for word----------------
        var j;
        for (j = 0; j < new_get_word.length; j++) {
          abc_arr.push(new_get_word[j]);
        }

        //for sentense----------------
        var m;
        for (m = 0; m < get_new_sentense.length; m++) {
          sentense_store.push(get_new_sentense[m]);
        }

        var index = i + 1;

        all_input += '<input type="hidden" name="option[]" value="' + get_sentence + '">';
        sentences.push(get_sentence);

        html += '<textarea class="form-control hint_textarea hint_textarea_no' + index + '" data-id="' + index + '" name="hint_text[]">' + get_sentence + '</textarea>';
        html2 += '<button type="button" class="btn btn_blue hint_save_button hint_save_button_no' + index + '" data-dismiss="modal" data-id ="' + index + '">Save</button>';
      }
      //alert(sentense_store);
      spelling_answer += '<p class="grammer_class_remove" style="display: flex;flex-wrap: wrap; gap:3px">';
      var k;
      for (k = 0; k < abc_arr.length; k++) {
        spelling_answer += '<span class="one_hint_wrap grammer_answer grammer_ans' + k + '" data-id="' + k + '">' + abc_arr[k] + '</span>';
      }
      spelling_answer += '</p>';


      all_answer += '<p class="grammer_class_remove" style="display: flex;flex-wrap: wrap; gap:3px">';
      var k;
      for (k = 0; k < abc_arr.length; k++) {
        all_answer += '<span class="one_hint_wrap" data-id="' + k + '">' + abc_arr[k] + '</span>';
      }
      all_answer += '</p>';

      //For Creative Sentence Part----------
      all_sentense_answer += '<p class="grammer_class_remove_new" style="flex-wrap: wrap; gap:3px">';
      var n;
      //console.log(get_new_sentense.length);
      for (n = 0; n < sentense_store.length - 1; n++) {

        all_sentense_answer += '<span class="one_hint_wrap grammer_answer_new grammer_ans_new' + n + '" data-id="' + n + '">' + sentense_store[n] + '.</span>';
      }
      all_sentense_answer += '</p>';

      //For Introduction Part----------
      all_introduction_answer += '<p class="grammer_class_remove_introduction" style="flex-wrap: wrap; gap:3px">';
      var n;
      //console.log(get_new_sentense.length);
      for (n = 0; n < sentense_store.length; n++) {

        all_introduction_answer += '<span class="one_hint_wrap grammer_answer_introduction grammer_ans_introduction' + n + '" data-id="' + n + '">' + sentense_store[n] + '.</span>';
      }
      all_introduction_answer += '</p>';

      //ALl body_paragraph_answer-----------------
      all_body_answer += '<p class="grammer_class_remove_body" style="flex-wrap: wrap; gap:3px">';
      var n;
      for (n = 0; n < sentense_store.length; n++) {

          all_body_answer += '<span class="one_hint_wrap grammer_answer_body grammer_ans_body' + n + '" data-id="' + n + '">' + sentense_store[n] + '.</span>';
      }
      all_body_answer += '</p>';

      //For Concluson Part----------
      all_conclusion_answer += '<p class="grammer_class_remove_news" style="flex-wrap: wrap; gap:3px">';
      var n;
      //console.log(get_new_sentense.length);
      for (n = 0; n < sentense_store.length; n++) {

          all_conclusion_answer += '<span class="one_hint_wrap grammer_answer_news grammer_ans_news' + n + '" data-id="' + n + '">' + sentense_store[n] + '.</span>';
      }
      all_conclusion_answer += '</p>';

      // console.log(get_sentences);
      $('.student_idea_text').html(all_answer);
      $('.spelling_idea_text').html(spelling_answer);
      $('.creative_sentence_text').html(all_sentense_answer);
      $('.introduction_answer_paragraph').html(all_introduction_answer);
      $('.body_answer_paragraph').html(all_body_answer);
      $('.conclusion_sentense_paragraph').html(all_conclusion_answer);

      $('#all_option_input').html(all_input);
      $('.hint_text_modal_body').html(html);
      $('.hint_text_modal_footer').html(html2);

    } else {
      alert('First You need to write Writing input');
    }

    $('.ans_submit').click(function(){
        var get_value = JSON.parse('<?=$ans_info['spelling_error_value']?>');
        console.log(get_value);
        // alert(get_value[0].word_index);
        $('.student_idea_text').hide();
        $('#title_box').hide();
        $('.spelling_idea_text').show();
        $('#spelling_box').show();

        $('#title_menu_button').hide();
        $('#spelling_error_menu_button').show();
        $('#creative_sentence_menu_button').hide();
        $('#introduction_menu_button').hide();
        $('#body_paragraph_menu_button').hide();
        $('#conclution_menu_button').hide();
               

        if (get_value.length > 0) {
            for (var i = 0; i < get_value.length; i++) {
                $('.grammer_ans' + get_value[i].word_index).css("background-color", "#b5e61d");
                $('.grammer_ans' + get_value[i].word_index).append('<span class="tooltip_one tooltip_rs">' + get_value[i].correct_words + '</span>');
            }
        }
    });

    $('.spelling_next_submit').click(function(){
        $('#title_menu_button').hide();
        $('#spelling_error_menu_button').hide();
        $('#creative_sentence_menu_button').show();
        $('#introduction_menu_button').hide();
        $('#body_paragraph_menu_button').hide();
        $('#conclution_menu_button').hide();

        var get_index = '<?=$ans_info['creative_sentence_index']?>';
        var creative_index = get_index.split(",");

        $('.student_idea_text').hide();
        $('#title_box').hide();
        $('.spelling_idea_text').hide();
        $('#spelling_box').hide();
        $('.creative_sentence_text').show();
        $('#creative_sentence_box').show();

        if (creative_index.length > 0) {
            for (var i = 0; i < creative_index.length; i++) {
                //$('.grammer_answer_new'+data.sentence_index[i]).css("background-color","#b5e61d"); 
                if (i == 0) {
                $('.grammer_ans_new' + creative_index[i]).css("background-color", "background-color: rgb(180, 231, 28)");
                $('.grammer_ans_new' + creative_index[i]).append('<span class="tooltip_one tooltip_rs">Creative Sentence</span>');
                } else {
                $('.grammer_ans_new' + creative_index[i]).css("background-color", "background-color: rgb(255, 171, 191)");
                $('.grammer_ans_new' + creative_index[i]).append('<span class="tooltip_one tooltip_rs">Creative Sentence</span>');
                }
            }
        }
    });

    $('.creative_next_submit').click(function(){
        $('#title_menu_button').hide();
        $('#spelling_error_menu_button').hide();
        $('#creative_sentence_menu_button').hide();
        $('#introduction_menu_button').show();
        $('#body_paragraph_menu_button').hide();
        $('#conclution_menu_button').hide();

        var introduction_index = '<?=$idea_infos[0]['introduction_sentence_index']?>';
        // var creative_index = get_index.split(",");
        $('.student_idea_text').hide();
        $('#title_box').hide();
        $('.spelling_idea_text').hide();
        $('#spelling_box').hide();
        $('.creative_sentence_text').hide();
        $('#creative_sentence_box').hide();
        $('.introduction_answer_paragraph').show();
        $('#introduction_box').show();

        $('.grammer_ans_introduction' + introduction_index).css("background-color", "background-color: #ffc107");
        $('.grammer_ans_introduction' + introduction_index).append('<span class="tooltip_one tooltip_rs">Correct Introduction</span>');

        $('.tooltip_rs_new').draggable({
            revert: 'invalid',
        });
        $('.tooltip_rs').draggable({
            revert: 'invalid',
        });
        
    });



    $('.introduction_next_submit').click(function(){
        $('#title_menu_button').hide();
        $('#spelling_error_menu_button').hide();
        $('#creative_sentence_menu_button').hide();
        $('#introduction_menu_button').hide();
        $('#body_paragraph_menu_button').show();
        $('#conclution_menu_button').hide();

        var paragraph_index = '<?=$idea_infos[0]['body_paragraph_sentence_index']?>';
        // var creative_index = get_index.split(",");
        $('.student_idea_text').hide();
        $('#title_box').hide();
        $('.spelling_idea_text').hide();
        $('#spelling_box').hide();
        $('.creative_sentence_text').hide();
        $('#creative_sentence_box').hide();
        $('.introduction_answer_paragraph').hide();
        $('#introduction_box').hide();
        $('.body_answer_paragraph').show();
        $('#body_paragraph_box').show();

        $('.grammer_ans_body' + paragraph_index).css("background-color", "background-color: #ffc107");
        $('.grammer_ans_body' + paragraph_index).append('<span class="tooltip_one tooltip_rs">Correct Body Paragraph</span>');

        $('.tooltip_rs_new').draggable({
            revert: 'invalid',
        });
        $('.tooltip_rs').draggable({
            revert: 'invalid',
        });
        
    });

    $('.paragraph_next_submit').click(function(){
        $('#title_menu_button').hide();
        $('#spelling_error_menu_button').hide();
        $('#creative_sentence_menu_button').hide();
        $('#introduction_menu_button').hide();
        $('#body_paragraph_menu_button').hide();
        $('#conclution_menu_button').show();

        var conclusion_index = '<?=$idea_infos[0]['conclution_sentence_index']?>';
        // var creative_index = get_index.split(",");
        $('.student_idea_text').hide();
        $('#title_box').hide();
        $('.spelling_idea_text').hide();
        $('#spelling_box').hide();
        $('.creative_sentence_text').hide();
        $('#creative_sentence_box').hide();
        $('.introduction_answer_paragraph').hide();
        $('#introduction_box').hide();
        $('.body_answer_paragraph').hide();
        $('#body_paragraph_box').hide();
        $('.conclusion_sentense_paragraph').show();
        $('#conclusion_paragraph_box').show();

        $('.grammer_ans_news' + conclusion_index).css("background-color",   "background-color: #ffc107");
        $('.grammer_ans_news' + conclusion_index).append('<span class="tooltip_one tooltip_rs">Correct Conclusion</span>');

        $('.tooltip_rs_new').draggable({
            revert: 'invalid',
        });
        $('.tooltip_rs').draggable({
            revert: 'invalid',
        });
        
    });

    $('.conclusion_next_submit').click(function(){ 
        $('.student_idea_text').show();
        $('#title_box').hide();
        $('.spelling_idea_text').hide();
        $('#spelling_box').hide();
        $('.creative_sentence_text').hide();
        $('#creative_sentence_box').hide();
        $('.introduction_answer_paragraph').hide();
        $('#introduction_box').hide();
        $('.body_answer_paragraph').hide();
        $('#body_paragraph_box').hide();
        $('.conclusion_sentense_paragraph').hide();
        $('#conclusion_paragraph_box').hide();
        $('#total_point_box').show();
    });

    $('.total_next_submit').click(function(){
      var url = '<?=$_SERVER['HTTP_REFERER']?>';
      window.location.href = url;
    });

    

  });
</script>