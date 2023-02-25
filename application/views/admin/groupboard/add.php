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
                <strong><span style="font-size : 18px; ">  ADD Groupboard </span></strong>
              </a>
            </h4>
          </div>

          <?php if (!empty( $this->session->flashdata('Failed') )) { ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('Failed'); ?></div>
          <?php  } ?>

          <?php if (!empty( $this->session->flashdata('message') )) { ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('message'); ?> </div>
          <?php  } ?>


          <form class="form-horizontal" action="store-groupboard" method="POST" enctype="multipart/form-data" id="myform_add" onsubmit="return validate()">
            <div class="row panel-body">
              <div class="col-sm-12 text-right">
                <button type="button" class="btn btn_next" id="" onclick = "location.reload(true)"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                <button type="submit"  class="btn btn_next" id=""><i class="fa fa-plus" style="padding-right: 5px;"></i>Save</button>
              </div>
            </div>

            <!-- faq submit form -->  
            <div class="row panel-body">

              <div class="col-sm-6">
                <label for="exampleInputiamges1">Groupboard ID</label>
                <div class="select">
                    <input class="form-control" type="number" name="room_id" >
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

<script>
  function validate() {
    var room_id = document.forms["myform_add"]["room_id"].value;

    if (room_id == "" ) {

      document.getElementById("room_id").innerHTML = "Groupboard Number Can not be empty";
      return false;
    }

    
  }
  </script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>