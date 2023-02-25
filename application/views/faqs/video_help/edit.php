<style>
  .required{
    color: red;
  }

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

          


          <form class="form-horizontal" action="faq/videoupdate" method="POST" enctype="multipart/form-data" id="myform_add" onsubmit="return validate()">
          	<input type="hidden" name="id" value="<?= $data[0]['id'] ?>">
          	<input type="hidden" name="serial" value="<?= $data[0]['serial_num'] ?>">
            <div class="row panel-body">
              <div class="col-sm-12 text-right">
                <button type="button" class="btn btn_next" id="" onclick = "location.reload(true)"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                <button type="submit"  class="btn btn_next" id=""><i class="fa fa-plus" style="padding-right: 5px;"></i>Save</button>
              </div>
            </div>

            <!-- faq submit form -->  
            <div class="row panel-body">
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="col-sm-6">
                    <label for="inputEmail3" class="col-sm-4 control-label">Serial NO:</label> <br>
                    <input type="number" minimum="1" class="form-control" value="<?= $data[0]['serial_num'] ?>" placeholder="serial number" name="serial_num">
                    <b><span id="serial_num" class="required"></span></b>
                  </div>
                  <div class="col-sm-6">
                    <label for="inputEmail3" class="col-sm-6 control-label">How many videos</label> <br>
                    <input type="number" minimum="1" class="form-control" id="box_qty" onclick="getImageBox(this)">
                    <b><span id="serial_num" class="required"></span></b>
                  </div>

                </div>

                <table>
                  <tr>
                    <th>Video</th>
                    <th>Title</th>
                    <th>Action</th>
                  </tr>
                

                <?php foreach ($video as $key => $value) { ?>
                  <tr>
                      <td class="show<?= $key; ?>">
                        <video id="myVideo" controls preload="auto" width="190" height="180">
                          <source src="<?= base_url('/'.$value) ?>" type="video/mp4">
                        </video>
                      </td>
                      <td>
                        <p style="padding: 5px 4px;color: saddlebrown;" class="show<?= $key; ?>"> <b><?= $title[$key]; ?></b> </p>
                      </td>
                      <td>
                        <button type="button" onclick="removeFile('<?= $key; ?>')" class="btn btn-danger show<?= $key; ?>">Remove</button>
                      </td>
                  </tr>
                <?php } ?>

                </table>


                <div id="XXxx" style="margin: 18px 0;"></div>
                
              </div>
            </div>
          </form>


        </div>

      </div>

    </div>
  </div>
</div>

<script>
  function removeFile(argument) {
    serial_num = '<?= $id; ?>';
    FileSL = argument;

    $.ajax({
      url:'faq/removeFile/'+serial_num+"/"+FileSL,
      mehtod:'GET',
      success: function(data){
        if (data == 1) {
          $(".show"+FileSL+"").hide();
        }
      }
    })

  }

  function getImageBox() {
      
        var qty = $("#box_qty").val();
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
    
  function validate() {
    var serial_num = document.forms["myform_add"]["serial_num"].value;

    if (serial_num == "" ) {

      document.getElementById("serial_num").innerHTML = "Serial number Can not be empty!";
      return false;
    }

    
  }
  </script>