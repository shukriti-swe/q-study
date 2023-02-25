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
<?php
if(isset($settins_Api_key[0]['setting_type']) && $settins_Api_key[0]['setting_type']== 'sms_api_settings' ){
	$api_key = $settins_Api_key[0]['setting_value'];
}
$sms_1 = '';
$sms_2 = '';
$sms_3 = '';
foreach($settins_sms_messsage as $data_msg){
	if($data_msg['setting_type'] == 'sms_message_settings' ){
		
		if($sms_1 == ''){
			
			$sms_1 = $data_msg['setting_value'];
		}elseif($sms_2 == ''){
			$sms_2 = $data_msg['setting_value'];
		}elseif($sms_3 == ''){
			$sms_3 = $data_msg['setting_value'];
		}
	}
}

?>
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
                <strong><span style="font-size : 18px; ">  SMS Configuration </span></strong>
              </a>
            </h4>
          </div>

          <form class="form-horizontal" id="editFaqForm" action="sms_api/add" method="POST">
           <!---- <div class="row panel-body">
              <div class="col-sm-12 text-right">
                <button type="button" class="btn btn_next" id="" onclick = "location.reload(true)"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                <button type="submit" class="btn btn_next" id=""><i class="fa fa-plus" style="padding-right: 5px;"></i>Save</button>
              </div>
            </div>----->

            <!-- faq submit form -->  
            <div class="row panel-body">
              <div class="col-sm-9">
                <div class="form-group">
                  <label for="sms_api_key" class="col-sm-3 control-label">API Key:</label>
                  <div class="col-sm-9">
                  <input type="text" minimum="1" class="form-control" id="sms_api_key"  name="sms_api_key" value="<?php if(isset($api_key)){echo $api_key;}?>">
                  </div>
                </div>
              </div>
			  <div class="col-sm-3">
                <div class="form-group">                  
                  <button type="submit" class="btn btn_next" id=""><i class="fa fa-plus" style="padding-right: 5px;"></i>Update Api Key</button>
                </div>
              </div>
			  
			  
			 
            </div>
          </form>
		  
		  <form class="form-horizontal" id="editFaqForm" action="sms_message/add" method="POST">           
            <div class="row panel-body">
               <div class="col-sm-9">
                <div class="form-group">
                  <label for="register_sms" class="col-sm-3 control-label">Register Sms:</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" id="register_sms" name="register_sms"><?php echo $sms_1;?></textarea>
                  </div>
                </div>
              </div>
			  <div class="col-sm-3">
                <div class="form-group">                  
                  <button type="submit" class="btn btn_next" id=""><i class="fa fa-plus" style="padding-right: 5px;"></i>Update Message</button>
                </div>
              </div>
			  
			  <div class="col-sm-9">
                <div class="form-group">
                  <label for="9_pm_Sms" class="col-sm-3 control-label">9 pm Sms:</label>
                  <div class="col-sm-9">
                    <textarea name="9_pm_Sms" class="form-control" id="9_pm_Sms"><?php echo $sms_2;?></textarea>
                  </div>
                </div>
              </div>
			  <div class="col-sm-9">
                <div class="form-group">
                  <label for="user_adds_sms" class="col-sm-3 control-label">User Adds Sms:</label>
                  <div class="col-sm-9">
                    <textarea name="user_adds_sms" class="form-control" id="user_adds_sms"><?php echo $sms_3;?></textarea>
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
</script>
