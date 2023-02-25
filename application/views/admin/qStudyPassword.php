<div class="" style="margin-left: 15px;">
  <div class="row">
    <div class="col-md-4">
        <?php echo $leftnav ?>
    </div>

    <div class="col-md-8 user_list">
      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
        <?php if (!empty( $this->session->flashdata('success') )) { ?>
          <div class="row">
            <div class="col-md-2"></div>
            <div class="alert alert-success col-md-9" style="margin-left: 56px;"><?php echo $this->session->flashdata('success'); ?> </div>
          </div>
        <?php  } ?>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title text-center">
              <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                <strong><span style="font-size : 18px; ">  ADD Password </span></strong>
              </a>
            </h4>
          </div>

          <?php if (!empty( $this->session->flashdata('Failed') )) { ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('Failed'); ?></div>
          <?php  } ?>


          <form class="form-horizontal" action="<?= base_url('admin/qStudyPassword') ?>" method="POST" enctype="multipart/form-data" id="myform_add" onsubmit="return validate()">
            <div class="row panel-body">
              <div class="col-sm-12 text-right">
                <button type="button" class="btn btn_next" id="" onclick = "location.reload(true)"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                <button type="submit"  class="btn btn_next" name="submit" id="" value="submit"><i class="fa fa-plus" style="padding-right: 5px;"></i>Save</button>
              </div>
            </div>

            <!-- faq submit form -->  
            <div class="row panel-body">
              <div class="col-sm-4">
                <label for="exampleInputiamges1">Q-study Password</label>
                <div class="select">
                    <input class="form-control" type="text" name="qStudyPassMain" value="<?= $user_info_main[0]['setting_type']  ?>" >
                    <span id="room_id" style="color: red;" ></span>
                </div>
              </div>
              <div class="col-sm-4">
                <label for="exampleInputiamges1">Question/Module Password</label>
                <div class="select">
                    <input class="form-control" type="text" name="qStudyPass" value="<?= $user_info[0]['setting_type']  ?>" >
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