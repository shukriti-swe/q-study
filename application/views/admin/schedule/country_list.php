<style>
  .countries{
    margin-right: 15px;
    float: left;
  }

  ul.country{
    width: 260px;
  }

  .modal-footer{
    text-align: center;
  }
</style>

<div class="row">
  <div class="col-md-4">
    <?php echo $leftnav ?>
  </div>
  <div class="col-md-8">
    <div class="button_schedule text-right" >
      <a class="btn btn_next" id="save_country"><i class="fa fa-save"></i> Save</a>
      <a href="" class="btn btn_next"><i class="fa fa-home"></i> Home</a>
      <a class="btn btn_next" id="add_theme_row"><i class="fa fa-file"></i> Add New</a>
    </div>

    <!-- <div class="schedule_country"> -->
      <div class="row">
        <div class="col-4"></div>
        <div class="col-8">
            <?php $this->load->view('session_msg'); ?>
        </div>
      </div>
      
      <div class="row" style="margin-top: 10px">
        <div class="col-md-4"></div>
        <div class="col-md-6">
          <h5>Country Duplicate</h5>
        </div>
      </div>

      <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-6">
          <ul class="country">
            <?php foreach ($all_country as $country) {?>
              <li>
                <a href="javascript:;" onClick="updateDeleteURL(<?php echo $country['id'] ?>)" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash countries" style="color:red;"></i></a>
                <a href="javascript:;"  data-toggle="modal" data-target="#duplicateModal" onClick="counNameToModal('<?php echo  $country['countryName'];?>')"><i class="fa fa-clipboard countries" style="color:#4c8e0c;"></i></a>
                <a href="course_schedule/<?php echo $country['id'];?>"> 
                  <i class="fa fa-file countries" ></i> <?php echo $country['countryName'];?>
                </a>
              </li>
            <?php }?>
          </ul>
        </div>
      </div>

      <div class="row" style="margin-top: 10px">
        <div class="col-md-4"></div>
        <div class="col-md-6">
          <h5>Grade Duplicate</h5>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-6">
          <ul class="country">
            <?php foreach ($all_country as $country) {?>
              <li>
                <a href="javascript:;"  data-toggle="modal" data-target="#gradeDuplicateModal" onClick="counNameToModal('<?php echo  $country['countryName'];?>')"><i class="fa fa-clipboard countries" style="color:#4c8e0c;"></i></a>
                
                <a href="course_schedule/<?php echo $country['id'];?>"> 
                  <i class="fa fa-file countries" ></i> <?php echo $country['countryName'];?>
                </a>
              </li>
            <?php }?>
          </ul>
        </div>
      </div>
    </div>
  </div>


  <!-- delete modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title">Really want to delete country</h5>
        </div>
        <div class="modal-footer text-center">
          <form action="javascript:;" id="deleteModalForm">
            <button type="submit" class="btn btn-danger" >YES</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <!--country duplicate modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="duplicateModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title">Really want to duplicate country</h5>
        </div>
        <form class="form-horizontal" action="Admin/duplicateCountry" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label  class="col-sm-4 control-label">Country Name</label>
              <div class="col-sm-6">
                <input type="text" class="form-control oldCountry" placeholder="Country" name="oldCountry" readonly>
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-4 control-label">New Country Name</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Country" id="newCountry" name="newCountry">
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-4 control-label">New Country Code</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Country" id="newCountryCode" name="newCountryCode" title="eg: BD">
              </div>
            </div>
          </div>
          <div class="modal-footer text-center">
            <button type="submit" class="btn btn-danger" >YES</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!--grade duplicate modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="gradeDuplicateModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title">Really want to duplicate grade</h5>
        </div>
        <form class="form-horizontal" action="Admin/duplicateGrade" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label  class="col-sm-4 control-label">Year/Grade</label>
              <div class="col-sm-6">
                <select name="oldGrade" id="" class="form-control">
                    <?php foreach (range(1, 12) as $grade) : ?>
                    <option value="<?php echo $grade ?>"><?php echo $grade ?></option>
                    <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-4 control-label">Duplicate to</label>
              <div class="col-sm-6">
                <select name="newGrade" id="" class="form-control">
                    <?php foreach (range(1, 12) as $grade) : ?>
                    <option value="<?php echo $grade ?>"><?php echo $grade ?></option>
                    <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer text-center">
            <input type="hidden" class="form-control oldCountry" placeholder="Country"  name="oldCountry" >
            <button type="submit" class="btn btn-danger" >YES</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <script>
    $(document).ready(function () {
      var addcounter = <?php echo count($all_country);?>;
      $("#add_theme_row").on("click", function () {
        addcounter++;
        var newRow = $('<tr extraattra="'+addcounter+'">');
        var cols = "";

        cols = '<td>'+addcounter+'</td>';
        cols += '<td><input class="form-control" id="countryName" type="text" name="countryName"></td>';
        cols += '<td><input class="form-control" id="countryCode" type="text" name="countryCode"></td>';
        cols += '<td><i class="fa fa-pencil" style="color:#4c8e0c;"></i></td>';
        cols += '<td><i class="fa fa-times" style="color:#4c8e0c;"></i></td>';

        newRow.append(cols);

        $("table#themeTable").append(newRow);

      });

      $("#save_country").on("click", function () {
        $.ajax({
          url: '<?php echo site_url('save_country'); ?>',
          type: 'POST',
          data: {
            countryName: $("#countryName").val(),
            countryCode: $("#countryCode").val()
          },
          success: function (data) {
            var res = jQuery.parseJSON(data);
            $('#country_div').html(res.countryDiv);
          }
        });
      });
    });

    function edit_country(country_id){
      $(".target").hide();
      $(".text").show();
      $(".fa-edit").hide();
      $(".fa-pencil").show();


      $("#name_text"+country_id).hide();
      $("#code_text"+country_id).hide();
      $("#edit_name"+country_id).show();
      $("#edit_code"+country_id).show();

      $("#edit"+country_id).hide();
      $("#update"+country_id).show();
    }

    function updateCountry(country_id) {
      $.ajax({
        url: '<?php echo site_url('update_country'); ?>',
        type: 'POST',
        data: {
          id: country_id,
          countryName: $("#edit_name"+country_id).val(),
          countryCode: $("#edit_code"+country_id).val()
        },
        success: function (data) {
          var res = jQuery.parseJSON(data);
          $('#country_div').html(res.countryDiv);
        }
      });
    }

    function chkDelete(){
      var chk = confirm('Are You Sure To Delete This?');
      if(chk){
        return true;
      }else{
        return false;
      }
    }

    function counNameToModal(countryName) {
      console.log('oldie:'+countryName);
      $('.oldCountry').val(countryName);
    }

    function updateDeleteURL(conId) {
      $('#deleteModalForm').attr('action', 'Admin/delete_country/'+conId);
    }
  </script>
