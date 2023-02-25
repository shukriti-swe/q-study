<input type="hidden" name="questionType" value="3">
<form action="Question/saveDictionaryWord" method="POST" class="form-horizontal ss_image_add_form">
  <div class="row" >
    <div class="col-sm-12 ">
      <?php if ($this->session->flashdata('success_msg')) : ?>
      <div class="alert alert-success alert-dismissible fade in" role="alert"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <?php echo $this->session->flashdata('success_msg') ?>
      </div>
    <?php endif; ?>

      <div class="ss_question_add_top text-center">
        <button class="ss_q_btn btn" type="submit">Save</button>
        <a class="ss_q_btn btn" href="#"><i class="fa fa-remove" aria-hidden="true"></i> Cancel</a>
        <?php if (isset($get_url)): ?>
          <a class="ss_q_btn btn" href="<?= base_url('/preview-dictionary?word='.$get_url.'') ?>"><i class="fa fa-file-o" aria-hidden="true"></i> Preview</a>
        <?php endif ?>
      </div>

    </div>
  </div>
  <br>
  <div class="col-sm-2"></div>
  <div class="col-sm-4">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">

        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body form-horizontal ss_image_add_form">
            
            <div class="form-group">
              <label for="inputwordl3" class="col-sm-4 control-label">Word</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputword3" name="answer" placeholder="Word" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputDefinitionl3" class="col-sm-4 control-label">Definition</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputDefinitionl3" name="definition" placeholder="Definition">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPartsofspeech3" class="col-sm-4 control-label">Parts of speech</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPartsofspeech3" name="parts_of_speech" placeholder="Parts of speech">
              </div>
            </div>
            <div class="form-group">
              <label for="inputSynonym3" class="col-sm-4 control-label">Synonym</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputSynonym3" name="synonym" placeholder="Synonym">
              </div>
            </div>
            <div class="form-group">
              <label for="inputAntonym3" class="col-sm-4 control-label">Antonym</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputAntonym3" name="antonym" placeholder="Antonym">
              </div>
            </div>

            <div class="form-group">
              <label for="inputYourSentence3" class="col-sm-4 control-label">Your Sentence</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputYourSentence3" name="sentence" placeholder="Your Sentence">
              </div>
            </div>
            <div class="form-group">
              <label for="inputNearAntonym3" class="col-sm-4 control-label">Near Antonym</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputNearAntonym3" name="near_antonym" placeholder="Near Antonym">
              </div>
            </div>
            <div class="form-group">
              <label for="spchToTxt" class="col-sm-4 control-label">Speech to text</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="spchToTxt" name="speech_to_text" placeholder="Speech to text">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Audio File</label>
              <div class="col-sm-8">
                <input type="file" id="exampleInputFile" name="audioFile">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Video file</label>
              <div class="col-sm-8">
                <input type="file" id="exampleInputFilevideo" name="videoFile">
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
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">  Image</a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body ss_imag_add_right">

            <div class="text-center">

              <div class="form-group ss_h_mi" style="display: inline-block !important;">
                <label for="nameField" class="col-xs-6">How many images</label>
                <div class="col-xs-6">
                  <input class="form-control" type="number" value="1" id="box_qty" onclick="getImageBox(this)">
                </div>

              </div>
            </div>

            <div class="image_box_list" id="image_box_list">
              <div class="row editor_hide" id="list_box_1" style="">
                <div class="col-xs-2">
                  <p class="ss_lette" style="min-height: 136px; line-height: 137px;">A</p>
                </div>
                <div class="col-xs-10">
                  <div class="box">
                    <textarea class="form-control vocubulary_image" id="vocubulary_image" name="vocubulary_image_1[]"></textarea>
                  </div>
                </div>

              </div>
              <?php
              $lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');
              $desired_i = 2;
                ?>
                <?php for ($desired_i; $desired_i <= 20; $desired_i++) { ?>         
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
            </div>
            <input type="hidden" id="question">
          </div>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" name="image_quantity" id="image_quantity" value="">
</form>
<script>


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
</script>

