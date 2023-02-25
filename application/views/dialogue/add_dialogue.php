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

<!-- flash message -->
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-8">
    <?php $this->load->view('flash_message_section'); ?>
  </div>
</div>

<div class="" style="margin-left: 15px;">
  <div class="row">
    <div class="col-md-4">
        <?php echo $leftnav ?>
    </div>
    
    <div class="col-md-8 user_list">
      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title text-center">
              <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                <strong><span style="font-size : 18px; ">  Add Dialogue </span></strong>
              </a>
            </h4>
          </div>

          <form class="form-horizontal" id="editFaqForm" action="dialogue/add" method="POST">
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
                  <label for="inputEmail3" class="col-sm-2 control-label">Date To Show:</label>
                  <div class="col-sm-4">
                  <input type="text" minimum="1" class="form-control" id="date" placeholder="Date" name="date" value="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Show Whole Year:</label>
                  <div class="col-sm-4">
                   <input type="text" minimum="1" data-toggle="tooltip" data-placement="bottom" title="Keep blank if you don't want to show this dialogue for whole year" class="form-control" id="year" placeholder="Date" name="year" value="">
                    <!-- <div class="checkbox">
                      <label>
                        <input type="checkbox" name="show_in_home" value="1" >
                      </label>
                    </div> -->
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Add link:</label>
                  <div class="col-sm-4">
                  <input type="url"  class="form-control" id="link" placeholder="Add Link" name="link" value="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Dialogue:</label>
                  <div class="col-sm-10">
                    <textarea class="form-control mytextarea" rows="3" name="dialogue_body"></textarea>
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



<!-- 
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
<script>

  $('#flashmsg').fadeOut(5000);
  $('#date').datepicker({
    multidate: true,
    todayHighlight: true,
  });
  $('#year').datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years",
    defaultViewDate:'year',
    autoclose:true,
  });

  $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });

</script>
