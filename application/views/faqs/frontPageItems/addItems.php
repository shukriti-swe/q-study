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
  }
   */
</style>

<div class="row">
  <div class="col-md-4"></div>
  <?php if ($this->session->flashdata('success_msg')) :?>
    <div class="col-md-8" id="flashmsg">
      <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('success_msg'); ?>
      </div>
    </div>
    <?php endif; ?>
</div>
<div class="" style="margin-left: 15px;">
  <div class="row">
    <div class="col-md-4">
        <?php echo $leftnav ?>
    </div>
    <!-- flash message -->
    
    <div class="col-md-8 user_list">
      <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title text-center">
              <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                <strong><span style="font-size : 18px; " id="header">Pricing</span></strong>
              </a>
            </h4>
          </div>

          <form class="form-horizontal" id="addFaqForm" action="faq/add/other" method="POST">
            <input type="hidden" name="itemType" id="itemType" value="pricing">
            <div class="row panel-body">
              <div class="col-sm-12 text-right">
                <button type="button" class="btn btn_next" id="" onclick = "location.reload(true)"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                <button type="submit"  class="btn btn_next" id=""><i class="fa fa-plus" style="padding-right: 5px;"></i>Save</button>
              </div>
            </div>

            <!-- faq submit form -->  
            <div class="row panel-body">
              <div class="col-sm-12">
                <!-- <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Serial NO:</label>
                  <div class="col-sm-2">
                  <input type="number" minimum="1" class="form-control" id="" placeholder="serial number" name="serial_num">
                  </div>
                </div> -->
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="title" placeholder="FAQ Title" name="title" required>
                  </div>
                </div>

                <div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Body</label>
					<div class="col-sm-10">
						<textarea class="faq_textarea" name="body" id="body" cols="30" rows="3"></textarea>
					</div>
                </div>
                <!-- <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="show_in_home" value="1"> Show In Home
                      </label>
                    </div>
                  </div>
                </div> -->
                
              </div>
            </div>
          </form>


        </div>

      </div>

    </div>
  </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script>

	

  //initially get item info of pricing
  $(document).ready(function(){
    $.ajax({
      url:'Faq/getItemInfo',
      method:'post',
      data: {itemType:"pricing"},
      success: function(data){
        if(data!='false'){
          data = JSON.parse(data);
          $('#title').val(data.title);
          $('#body').val(data.body);
        }
      }
    });
  });

  $(document).on('click','.fPageItems', function(e){
    e.preventDefault();
    var txt = $(this).children('a').html();
    var itemId = $(this).attr('id');
    $(header).html(txt); //card title
    $('#itemType').val(itemId); //set item type ex: pricing,disclaimer etc

    /*if item recorded then fetch and show changes*/
    $.ajax({
      url:'Faq/getItemInfo',
      method:'post',
      data: {itemType:itemId},
      success: function(data){
        if(data!='false'){
          data = JSON.parse(data);
          $('#title').val(data.title);
          $('#body').val(data.body);
        } else{
           $('#title').val("");
          $('#body').val("");
        }
      }
    })
  })
</script>
