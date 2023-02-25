<div class="" style="margin-left: 15px;">
  <div class="row">
    <div class="col-md-4">
        <?php echo $leftnav ?>
    </div>

    <div class="col-md-8 user_list">
      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">

        <?php if (!empty( $this->session->flashdata('stripe-success') )) { ?>
          <div class="row">
            <div class="col-md-2"></div>
            <div class="alert alert-success col-md-9" style="margin-left: 56px;"><?php echo $this->session->flashdata('stripe-success'); ?> </div>
          </div>
        <?php  } ?>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title text-center">
              <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                <strong><span style="font-size : 18px; ">  Stripe Setting </span></strong>
              </a>
            </h4>
          </div>

          <?php if (!empty( $this->session->flashdata('Failed') )) { ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('Failed'); ?></div>
          <?php  } ?>



          <form class="form-horizontal" action="<?= base_url('admin/stripeDetailsUpdate') ?>" method="POST" enctype="multipart/form-data" id="myform_add" onsubmit="return validate()">
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
                <label for="exampleInputiamges1"> Test Publish  Key</label>
                <div class="select">
                    <input class="form-control" type="text" name="test_publish_key" value="<?= $stripe_info[0]['setting_value']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>
              <div class="col-sm-6">
                <label for="exampleInputiamges1">Test Seccreet Key</label>
                <div class="select">
                    <input class="form-control" type="text" name="test_seccreet_key" value="<?= $stripe_info[1]['setting_value']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>

            </div>
            <div class="row panel-body">
              <h4 style="padding: 13px;font-size: 18px;font-weight: 700;">Live Account Details</h4>
              <div class="col-sm-6">
                <label for="exampleInputiamges1">Live Publish  Key</label>
                <div class="select">
                    <input class="form-control" type="text" name="live_publish_key" value="<?= $stripe_info[2]['setting_value']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>
              <div class="col-sm-6">
                <label for="exampleInputiamges1">Live Seccreet  Key</label>
                <div class="select">
                    <input class="form-control" type="text" name="live_seccreet_key" value="<?= $stripe_info[3]['setting_value']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>
            </div>

            <div class="row panel-body">
              <h4 style="padding: 13px;font-size: 18px;font-weight: 700;"> Account Mode</h4>
              <div class="col-sm-6">
                <label for="exampleInputiamges1">Mode</label>
                <div class="select">
                    <input class="form-control" type="text" name="mode" value="<?= $stripe_info[4]['setting_value']  ?>" >
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