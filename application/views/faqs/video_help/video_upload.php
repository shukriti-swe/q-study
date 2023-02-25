<style>
  /* .parent {
    border: 1px solid #ddd;
    margin: 10px;
    min-height: 30px;
    line-height: 28px;
    border-radius: 4px;
  }
  
  .child1 {
    float: left;width: 60%;
    text-align: center;
    background: #7FBED8;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
  }
  
  .child2 {
    width: 40%;float: left;
    text-align: center;
    background: #2F91BA;
    color: #fff;
  }
  
  label {
    font-size: 13px;
  }
  
  .user_list {
    border-color: #2F91BA;
  }
  
  .panel-default > .panel-heading{
    background-color: #FCF8E3 !important;
  } */

</style>

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
                <strong><span style="font-size : 18px; ">  ADD VIDEO </span></strong>
              </a>
            </h4>
          </div>


          <?php if (!empty( $this->session->flashdata('Failed') )) { ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('Failed'); ?></div>
          <?php  } ?>

          <?php if (!empty( $this->session->flashdata('message') )) { ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('message'); ?> </div>
          <?php  } ?>


          <form class="form-horizontal" action="faq/video" method="POST" enctype="multipart/form-data" id="myform_add" onsubmit="return validate()">
            <div class="row panel-body">
              <div class="col-sm-12 text-right">
                <button type="button" class="btn btn_next" id="" onclick = "location.reload(true)"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                <button type="submit"  class="btn btn_next" id=""><i class="fa fa-plus" style="padding-right: 5px;"></i>Save</button>
              </div>
            </div>

            <!-- faq submit form -->  
            <div class="row panel-body">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Serial NO:</label>
                  <div class="col-sm-6">

                  <input type="number" minimum="1" class="form-control"  placeholder="serial number" name="serial_num">
                  <b><span id="serial_num" class="required"></span></b>
                  </div>
                </div>
              </div>

              <div class="col-sm-6" style="margin: -14px;">
                <label for="exampleInputiamges1">How many Videos</label>
                <div class="select">
                    <input class="form-control" type="number" id="box_qty" onclick="getImageBox(this)">
                </div>
              </div>

              

              <span id="XXxx"></span>

            </div>
          </form>


        </div>

      </div>

    </div>
  </div>
</div>

<script>

    function getImageBox() {
      
        var qty = $("#box_qty").val();

        console.log(qty)
        common(qty);
    }
    function common(quantity)
    {
      $('#XXxx').html('');

        for (var i = 1; i <= quantity; i++)
        {
            $('#XXxx').append('<tr><td> <input class="form-control" type="file" name="video_file[]" accept=".mp4" required style="margin: 5px 0;" /> </td><td> <input class="form-control" type="text" name = title[] required style="margin: 0 93px;" /> </td></tr>');
        }
    }
</script>


<script>
  function validate() {
    var serial_num = document.forms["myform_add"]["serial_num"].value;
    var myFileInput = document.getElementById("myFileInput").value;

    if (serial_num == "" ) {

      document.getElementById("serial_num").innerHTML = "Serial number Can not be empty!";
      return false;
    }

    if (myFileInput == "" ) {
      document.getElementById("userfile").innerHTML = "Video Can not be empty!";
      return false;
    }

    
  }
  </script>



<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<!-- <script>
  var maxSL = parseInt($('#maxSL').val())+1;
  $('#addFaqForm').validate({
    rules:{
      serial_num:{
        required:true,
        max:maxSL,
      }
    }
  });
</script>
 -->