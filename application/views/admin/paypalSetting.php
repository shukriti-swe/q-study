<div class="" style="margin-left: 15px;">
  <div class="row">
    <div class="col-md-4">
        <?php echo $leftnav ?>
    </div>

    <div class="col-md-8 user_list">
      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">

        <?php if (!empty( $this->session->flashdata('paypal-success') )) { ?>
          <div class="row">
            <div class="col-md-2"></div>
            <div class="alert alert-success col-md-9" style="margin-left: 56px;"><?php echo $this->session->flashdata('paypal-success'); ?> </div>
          </div>
        <?php  } ?>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title text-center">
              <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                <strong><span style="font-size : 18px; ">  Paypal Setting </span></strong>
              </a>
            </h4>
          </div>

          <?php if (!empty( $this->session->flashdata('Failed') )) { ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('Failed'); ?></div>
          <?php  } ?>



          <form class="form-horizontal" action="<?= base_url('admin/paypalDetailsUpdate') ?>" method="POST" enctype="multipart/form-data" id="myform_add" onsubmit="return validate()">
            <div class="row panel-body">
              <div class="col-sm-12 text-right">
                <button type="button" class="btn btn_next" id="" onclick = "location.reload(true)"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                <button type="submit"  class="btn btn_next" name="submit" id="" value="submit"><i class="fa fa-plus" style="padding-right: 5px;"></i>Save</button>
              </div>
            </div>

            <!-- faq submit form -->  
            <div class="row panel-body">
              <h4 style="padding: 13px;font-size: 18px;font-weight: 700;">Test Account Details</h4>
              <div class="col-sm-6">
                <label for="exampleInputiamges1"> Test URL</label>
                <div class="select">
                    <input class="form-control" type="text" name="test_url" value="<?= $paypal_info[0]['setting_value']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>
              <div class="col-sm-6">
                <label for="exampleInputiamges1">Test Business Account</label>
                <div class="select">
                    <input class="form-control" type="text" name="test_business_account" value="<?= $paypal_info[1]['setting_value']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>

            </div>
            <div class="row panel-body">
              <div class="col-sm-6">
                <label for="exampleInputiamges1">Test Paypal Secret </label>
                <div class="select">
                    <input class="form-control" type="text" name="test_paypal_secret" value="<?= $paypal_info[3]['setting_value']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>
              <div class="col-sm-6">
                <label for="exampleInputiamges1">Test Paypal Signature </label>
                <div class="select">
                    <input class="form-control" type="text" name="test_paypal_signature" value="<?= $paypal_info[4]['setting_value']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>
            </div>

            <div class="row panel-body">
              <h4 style="padding: 13px;font-size: 18px;font-weight: 700;">Live Account Details</h4>
              <div class="col-sm-6">
                <label for="exampleInputiamges1">Live URL</label>
                <div class="select">
                    <input class="form-control" type="text" name="live_url" value="<?= $paypal_info[5]['setting_value']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>
              <div class="col-sm-6">
                <label for="exampleInputiamges1">Live Business Account </label>
                <div class="select">
                    <input class="form-control" type="text" name="live_business_account" value="<?= $paypal_info[6]['setting_value']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>
            </div>
            <div class="row panel-body">
              <div class="col-sm-6">
                <label for="exampleInputiamges1">Live Paypal Secret</label>
                <div class="select">
                    <input class="form-control" type="text" name="live_paypal_secret" value="<?= $paypal_info[7]['setting_value']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>
              <div class="col-sm-6">
                <label for="exampleInputiamges1">Live Paypal Signature </label>
                <div class="select">
                    <input class="form-control" type="text" name="live_paypal_signature" value="<?= $paypal_info[8]['setting_value']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>
            </div>
            <div class="row panel-body">
              <h4 style="padding: 13px;font-size: 18px;font-weight: 700;"> Account Mode</h4>
              <div class="col-sm-6">
                <label for="exampleInputiamges1">Mode</label>
                <div class="select">
                    <input class="form-control" type="text" name="mode" value="<?= $paypal_info[2]['setting_value']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>
				<div class="col-sm-6">
                <label for="exampleInputiamges1">Notification URL</label>
                <div class="select">
                    <input class="form-control" type="text" value=" https://q-study.com/qStudy/paypal_notify" readonly="readonly">
                    <span id="room_id" style="color: red;" ></span>
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