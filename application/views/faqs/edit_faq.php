<style>
  label {
    font-size: 13px;
  }

  .user_list {
    border-color: #2F91BA;
  }

  .panel-default > .panel-heading{
    background-color: #FCF8E3 !important;
  }

</style>


<input type="hidden" id="maxSL" value="<?php echo $maxSL; ?>">
<div class="" style="margin-left: 15px;">
  <div class="row">
    <div class="col-md-4">
        <?php echo $leftnav ?>
    </div>
    <?php if ($this->session->flashdata('success_msg')) :?>
    <div class="col-md-8" id="flashmsg">
      <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('success_msg'); ?>
      </div>
    </div>
    <?php endif; ?>
    <div class="col-md-8 user_list">
      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title text-center">
              <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                <strong><span style="font-size : 18px; ">  Edit FAQ </span></strong>
              </a>
            </h4>
          </div>

          <form class="form-horizontal" id="editFaqForm" action="faq/edit/<?php echo $faq['id']; ?>" method="POST">
            <div class="row panel-body">
              <div class="col-sm-12 text-right">
                <button type="button" class="btn btn_next" id="" onclick = "location.reload(true)"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                <button type="submit" class="btn btn_next" id=""><i class="fa fa-plus" style="padding-right: 5px;"></i>Save</button>
              </div>
            </div>

            <!-- faq submit form -->  
            <div class="row panel-body">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Topic Name:</label>
                  <div class="col-sm-10">
                  <input type="text" minimum="1" class="form-control" id="" placeholder="Faq Title" name="faq_title" value="<?php echo $faq['title']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Topic Details:</label>
                  <div class="col-sm-10">
                    <textarea class="form-control mytextarea" rows="3" name="faq_body"><?php echo strlen($faq['body']) ? $faq['body']: ''; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="show_in_home" value="1" <?php echo $faq['show_in_home'] ? 'checked':''; ?>> Show In Home
                      </label>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </form>


        </div>

      </div>

    </div>
  </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script>
  var maxSL = parseInt($('#maxSL').val())+1;
  $('#addFaqForm').validate({
    rules:{
      serial_num:{
        required:true,
        max:maxSL,
      }
    }
  });

  $('#flashmsg').fadeOut(5000);
</script>
