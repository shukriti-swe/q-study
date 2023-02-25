
<div class="container ss_s_b_main">

  <div class="dictionary_word_details">
    <div class="text-center" style="padding: 30px 0px;">
      <?php if (!$approvalStatus) : ?>
        <a class="ss_q_btn btn word_approve" href="#" data-toggle="modal" data-target="#"><i class="fa fa-check" aria-hidden="true"></i> Approve</a>
      <?php else : ?>
          <a class="ss_q_btn btn word_reject" href="#" data-toggle="modal" data-target="#"><i class="fa fa-times" aria-hidden="true"></i> Reject/Unapprove </a>
        <?php endif; ?>e
      </div>  e
      <div class="row">e
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
                <a role="button" data-toggle="collapse" data-parent="#accordionk" href="#collapseOnek" aria-expanded="true" aria-controls="collapseOnek" class=""> <!-- <span><img src="assets/images/icon_draw.png"> Word Creator</span> --> Word Creator </a>
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
    </div>
  </div>
</div>
</section>
<input type="hidden" id="wordId" value="<?php echo $wordId; ?>">
<script src="assets/js/sweet_alert.js"></script>
<script>
  //word approve by admin
  $(document).on('click', '.word_approve', function(e){
    e.preventDefault();
    var wordId = $('#wordId').val();
    $.ajax({
      url: 'Admin/wordApprove/'+wordId,
    })
    .done(function(data) {
      console.log(data);
      swal('Word approved successfully!');
      window.location.reload();
    })
    .fail(function() {
      console.log("error");
    })
  });

  //word reject by admin
  $(document).on('click', '.word_reject', function(e){
    e.preventDefault();
    var wordId = $('#wordId').val();
    $.ajax({
      url: 'Admin/wordReject/'+wordId,
    })
    .done(function(data) {
      console.log(data);
      swal('Word rejectd!');
      window.location.reload();
    })
    .fail(function() {
      console.log("error");
    })
  })

  //audio play
  function showAudio(){
    $("audio").show();
  }
</script>
