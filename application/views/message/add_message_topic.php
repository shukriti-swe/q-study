<style>
  td {
    border: 2px solid #f68d20 !important;
  }
  
</style>
<div class="" style="margin-left: 15px;">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-10 user_list">
      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title text-center">
              <img style="float:left;" src="assets/images/email-read.png" alt="" width="45px" height="45px;">
              <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                <strong><span style="font-size : 18px; ">  Set Message </span></strong>
              </a>
            </h4>
          </div>
           <form action="message/topics/add" method="POST"> 
          <div class="row panel-body">
            <div class="col-sm-12 text-right"> 
              <button type="button" onclick="window.location.reload()" class="btn btn_next" id=""><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
              <button type="submit"  class="btn btn_next" id=""><i class="fa fa-check" style="padding-right: 5px;"></i>Save</button>
            </div> 
          </div>
          <div class="row panel-body">
            <div class="col-sm-12"> 
              <div class="form-group row">
                <label for="title" class="col-sm-2 control-label">Message Topic</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="title" name="messageTopic"  required>
                  
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
