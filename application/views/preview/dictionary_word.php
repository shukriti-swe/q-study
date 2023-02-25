
<div class="container ss_s_b_main">

  <div class="dictionary_word_details">
    <div class="text-center" style="padding: 30px 0px;">
      <?php if($this->session->userdata('user_id')) : ?>
        <strong><a href="" id="wordSave" type="button" style="font-size: 20px;">Save to your quiz area</a></strong>
      <?php endif; ?> 
    </div>  

    <!-- pagination -->

    <?php if ( !isset($pagination) ): ?>
      <?= $word ?> was found in this dictionary
    <?php else: ?>
    <div class="row">
      <div class="col-md-6">
        <nav class="" aria-label="...">
          <ul class="pagination pagination-lg">
            <?php echo $pagination; ?>
          </ul>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class=""> Word Info</a>

              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true" style="">
              <div class="panel-body">
                <div class="image_q_list">

                  <div class="row">
                    <div class="col-xs-4">Word:</div>
                    <div class="col-xs-8" id="word"><?php echo isset($word)?$word:''; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4">Definition</div>
                    <div class="col-xs-8" id="definition"><?php echo isset($word_info->definition)?$word_info->definition:''; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4">Parts of speech</div>
                    <div class="col-xs-8" id="parts_of_speech"><?php echo isset($word_info->parts_of_speech)?$word_info->parts_of_speech:''; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4">Synonym </div>
                    <div class="col-xs-8" id="synonym"><?php echo isset($word_info->synonym)?$word_info->synonym:''; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4">Antonym</div>
                    <div class="col-xs-8" id="antonym"><?php echo isset($word_info->antonym)?$word_info->antonym:''; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4">Your Sentence</div>
                    <div class="col-xs-8" id="sentence"><?php echo isset($word_info->sentence)?$word_info->sentence:''; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4">Near Antonym</div>
                    <div class="col-xs-8" id="near_antonym"><?php echo isset($word_info->near_antonym)?$word_info->near_antonym:''; ?></div>
                  </div>
                  
                  <div class="row">
                    <div class="col-xs-4">Speech to text</div>
                    
                    <div class="col-xs-8">
                      <input onclick='speak("<?php echo isset($word_info->speech_to_text) ? $word_info->speech_to_text:''; ?>")' type='button' value='🔊 Play' />
                      <!-- <input type="hidden" id="wordToSpeak" value="<?php echo isset($word_info->speech_to_text) ? $word_info->speech_to_text:''; ?>"> -->
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-4">Audio File</div>
                    <?php if (isset($word_info->audioFile)&& file_exists($word_info->audioFile)) : ?>
                    <div class="col-xs-2" onclick="showAudio()" style="font-size: 18px; padding-right:0px">
                      <i class="fa fa-volume-up"></i>
                      <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                    </div>
                    <div class="col-xs-5" style="padding-left:0px;">
                      <small  style="font-size:15px !important;color:red; float:left;">Listening to audio will deduct 1 number</small>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="row">
                  <div class="col-xs-4">Video file</div>
                  <div class="col-xs-8"></div>
                </div>
                
                <!--  audio player -->
                <div class="row">
                  <div class="col-xs-4"></div>
                  <audio controls style="display: none;">
                    <source src="<?php if (isset($word_info->audioFile)) {
                      echo $word_info->audioFile;
                    } ?>" type="audio/ogg">
                    <source src="<?php if (isset($word_info->audioFile)) {
                      echo $word_info->audioFile;
                    } ?>" type="audio/mpeg">
                    <source src="<?php if (isset($word_info->audioFile)) {
                      echo $word_info->audioFile;
                    } ?>" type="audio/webm">
                    <source src="<?php if (isset($word_info->audioFile)) {
                      echo $word_info->audioFile;
                    } ?>" type="audio/wav">
                    <source src="<?php if (isset($word_info->audioFile)) {
                      echo $word_info->audioFile;
                    } ?>" type="audio/flac">
                  </audio>

                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
      

      <div class="panel-group" id="accordionk" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
              <a role="button" data-toggle="collapse" data-parent="#accordionk" href="#collapseOnek" aria-expanded="true" aria-controls="collapseOnek" class=""> <!-- <span><img src="assets/images/icon_draw.png"> Word Creator</span> --> Word Creator (creating with visualization) </a>
            </h4>
          </div>
          <div id="collapseOnek" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true" style="">
            <div class="panel-body">
              <div class="ss_tutor_p_list">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-xs-3 text-center" id="creator_image">
                      <?php if (isset($creator_info['image']) && file_exists('assets/uploads/'.$creator_info['image'])) : ?>
                      <img src="<?php echo base_url();?>assets/uploads/<?php echo $creator_info['image'];?>" alt="User Image"  width="80" height="60" class="img-responsive"><br> 
                      <?php else : ?>
                        <img src="assets/images/default_user.jpg" alt="User Image" width="80" height="60" class="img-responsive"><br>   
                      <?php endif; ?>
                      <a href="tutor/profile/<?php echo $creator_info['id']; ?>" class="btn btn-profile">View Profile</a>
                    </div>
                    <div class="col-xs-9">
                      <h4 id="creator_name"><?php echo $creator_info['name']; ?></h4>
                      <p>
                        <?php
                        if (isset($creator_info['short_bio'])) {
                          if (strlen($creator_info['short_bio'])>200) {
                            echo substr($creator_info['short_bio'], 0, 200).'...';
                          } else {
                            echo $$creator_info['short_bio'];
                          }
                        }
                        ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>

    </div>
    <div class="col-sm-6">
      <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
              <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">Images</a>
            </h4>
          </div>
          <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
              <div class="image_box_list_result result">
                <form id="answer_form">
                  <div class="image_box_list" style="overflow: visible;">
                    <div class="row">

                      <div class="">
                        <div class="" id="word_images">
                          <?php foreach ($word_info->vocubulary_image as $row) {?>
                            <div class="result_board">
                              <?php echo $row[0]?>
                            </div>
                            <br/>
                          <?php }?>

                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <input type="hidden" name="" id="total_items" value="<?php echo $total_items; ?>">
    <input type="hidden" name="" id="word_id" value="<?php echo $word_id; ?>">

    <?php endif ?>
  </div>


</div>
</div>
</section>


<script>
  var offset = 1;
  var tot_items = $('#total_items').val();
  var word  = $('#word').html();
  
  //prev next button disable on condition
  //if(offset==0){
    $('#prev').parent('li').addClass('disabled');
    $('#prev').attr('disabled', 'true');
  //} 
  /*if(offset>tot_items-1){
    $('#next').parent('li').addClass('disabled');
  } */

  //ajax call on prev button
  /*$(document).on('click','#prev', function(e){
    e.preventDefault();
    
    if(offset>0){
      $.ajax({
        url: 'CommonAccess/wordInfoByAjaxCall',
        method: 'POST',
        dataType:'json',
        data:{'word':word,'offset':offset},
        success:function(data){
          var b=updateFields(data);
          if(b==1) offset--;
        }
      })
    } // end if
  });*/

  //ajax call on next button
  $(document).on('click','#next', function(e){
    e.preventDefault();
    if(offset<tot_items-1){

      $.ajax({
        url: 'CommonAccess/wordInfoByAjaxCall/'+offset,
        method: 'POST',
        dataType:'json',
        data:{'word':word,'offset':offset},
        success:function(data){
          //console.log(data);
          var a=updateFields(data);
          if(a==1) offset++;
        }
      })
    } //end if

  });

  function  updateFields(data){
    if(data=='0'){
      console.log('item not found');
      return 0;
    }
    $('#word').html(data.word);
    $('#definition').html(data.word_info.definition);
    $('#parts_of_speech').html(data.word_info.parts_of_speech);
    $('#synonym').html(data.word_info.synonym);
    $('#antonym').html(data.word_info.antonym);
    $('#sentence').html(data.word_info.sentence);
    $('#near_antonym').html(data.word_info.near_antonym);
    
    $('#word_id').val(data.word_id); //set current word id

    for(var a=0;a<(data.word_info.vocubulary_image).length; a++){
      var wordImages = '<div class="result_board">';
      wordImages += data.word_info.vocubulary_image[a];
      wordImages += '</div>';
    }
    $('#word_images').html(wordImages);

    $('#creator_name').html(data.creator_info.name);
    var creatorImage = '<img src="'+data.creator_info.image+'"width="80" height="60" class="img-responsive"><br>';
    creatorImage += '<a href="tutor/profile/'+data.creator_info.id+'" class="btn btn-profile">View Profile</a>';
    $('#creator_image').html(creatorImage);

    if(offset==0){
      $('#prev').parent('li').addClass('disabled');
    } else{
      $('#prev').parent('li').removeClass('disabled');
    }

    if(offset>=tot_items-1){
      $('#next').parent('li').addClass('disabled');
    } else {
      $('#next').parent('li').removeClass('disabled');
    }
    return 1;
  }

  $(document).on('click', '.myclass', function(e){
    e.preventDefault();
    var link = $(this).attr('href');
    var offset = parseInt($(this).attr('data-ci-pagination-page'));
    $.ajax({
      url: link,
      method: 'POST',
      dataType:'json',
      data:{'word':word, offset:offset-1},
      success:function(data){
        updateFields(data);
      }
    })

    //change the next button link
    $('.next').attr('href', 'CommonAccess/wordInfoByAjaxCall/'+(offset+1));
    $('.next').attr('data-ci-pagination-page', offset+1);

  })//end function


    //dic word duplicate from others acc to yourself
    $(document).on('click', '#wordSave', function(e){
      e.preventDefault();
      var currentWordId = $('#word_id').val();
      $.ajax({
        url: 'Question/duplicateDictionaryItem/'+currentWordId,
      })
      .done(function(data) {
        if(data=='true'){
          //alert('item added to your list successfully');
          swal({
            text: 'Item added to your list successfully',
          });
        } else {
          //alert('Something is wrong.');
          swal({
            text: 'Something is wrong.',
          });
        }
      })

    })


  //audio play
  function showAudio(){
    $("audio").show();
  }

</script>

<!--  text to speech -->
<script src='assets/js/responsivevoice.js'></script> 
<script>
  function speak(id) {
    // var word = $('#wordToSpeak').val();
    responsiveVoice.speak(id);
  }
</script>
