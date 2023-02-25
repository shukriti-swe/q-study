            <div class="top100">
                <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                

                <div class="ss_enrollment_list">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          My Enrollment list
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <div class="button_schedule text-right" >
             
                <a href="c.schedule.php" class="btn btn_next"><i class="fa fa-home"></i> Home</a>
                <a href="" class="btn btn_next"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                </div>
       <div class="ss_enrollment_list_content">
            <div class="ss_enrollment_list_top">
                <div class="col-sm-7">Tutor/School</div>
                <div class="col-sm-3">Ref.Link Number</div>
                <div class="col-sm-2">Set Link</div>
            </div>
            <div class="ss_enrollment_list_mid">
                <ul>
                    <li class="dropdown">
                          <div class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        <div class="col-sm-7"><i class="fa fa-caret-right" aria-hidden="true"></i> <i class="fa fa-caret-down" aria-hidden="true"></i> Tutor</div>
                        <div class="col-sm-3"> </div>
                        <div class="col-sm-2 text-center"><a href="" class="enrollment_modal_id" data='3'><i class="fa fa-file-o" aria-hidden="true"></i></a></div>
                        </div>
                        <ul class="dropdown-menu">
                            <?php foreach ($get_involved_teacher as $single_tutor_ref) { ?>
                                <li>
                                    <div class="col-sm-7"><div style="padding-left:20px"><?php echo $single_tutor_ref['name'];?></div></div>
                                    <div class="col-sm-3"><?php echo $single_tutor_ref['SCT_link'];?></div>
                                    <div class="col-sm-2 text-center"></div>
                                </li>
                            <?php } ?>                          
                        </ul>
                    </li>
                    <li class="dropdown">
                          <div class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        <div class="col-sm-7"><i class="fa fa-caret-right" aria-hidden="true"></i> <i class="fa fa-caret-down" aria-hidden="true"></i> School</div>
                        <div class="col-sm-3"> </div>
                        <div class="col-sm-2 text-center"><a href="" class="enrollment_modal_id" data="4"><i class="fa fa-file-o" aria-hidden="true"></i></a></div>
                        </div>
                        <ul class="dropdown-menu">
                            <?php foreach ($get_involved_school as $single_school_ref) { ?>
                                <li>
                                    <div class="col-sm-7"><div style="padding-left:20px"><?php echo $single_school_ref['name'];?></div></div>
                                    <div class="col-sm-3"><?php echo $single_school_ref['SCT_link'];?></div>
                                    <div class="col-sm-2 text-center"></div>
                                </li>
                            <?php } ?>  
                        </ul>
                    </li>
                    <li class="dropdown">
                          <div class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        <div class="col-sm-7"><i class="fa fa-caret-right" aria-hidden="true"></i> <i class="fa fa-caret-down" aria-hidden="true"></i> Corporate</div>
                        <div class="col-sm-3"> </div>
                        <div class="col-sm-2 text-center"><a href="" class="enrollment_modal_id" data="5"><i class="fa fa-file-o" aria-hidden="true"></i></a></div>
                        </div>
                        <ul class="dropdown-menu">
                            <?php foreach ($get_involved_corporate as $single_corporate_ref) { ?>
                                <li>
                                    <div class="col-sm-7"><div style="padding-left:20px"><?php echo $single_corporate_ref['name'];?></div></div>
                                    <div class="col-sm-3"><?php echo $single_corporate_ref['SCT_link'];?></div>
                                    <div class="col-sm-2 text-center"></div>
                                </li>
                            <?php } ?>  
                        </ul>
                    </li>
                    
                </ul>
            </div>
       </div>
      </div>
    </div>
  </div>
  
   
</div>
                
                </div>
             </div>
             </div>
             </div>
        </div>
</section>

<div id="ss_enrollment_model_3"  class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div id="error_3"></div>
        <form id="add_link_ref_form_3">
            <div id="error_3"></div>
      <div class="modal-header"> 
        <h4 class="modal-title" id="myModalLabel">Link Ref. Number</h4>
      </div>
      <div class="modal-body" id="modal_body_3">          
      </div>
        <input type="hidden" class="form-control" id="inputPassword3" value="3" name="userType">
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue" id="add_link_button_3">Ok </button>
      </div>
            </form>
    </div>
  </div>
</div>


<div id="ss_enrollment_model_4"  class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div id="error_4"></div>
        <form id="add_link_ref_form_4">
            <div id="error_4"></div>
      <div class="modal-header"> 
        <h4 class="modal-title" id="myModalLabel">Link Ref. Number</h4>
      </div>
      <div class="modal-body" id="modal_body_4">             
      </div>
        <input type="hidden" class="form-control" id="inputPassword3" value="4" name="userType">    
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue" id="add_link_button_4">Ok </button>
      </div>
            </form>
    </div>
  </div>
</div>
<div id="ss_enrollment_model_5"  class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div id="error_5"></div>
        <form id="add_link_ref_form_5">
            <div id="error_5"></div>
      <div class="modal-header"> 
        <h4 class="modal-title" id="myModalLabel">Link Ref. Number</h4>
      </div>
      <div class="modal-body" id="modal_body_5">             
      </div>
    <input type="hidden" class="form-control" id="inputPassword3" value="5" name="userType">
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn_blue" id="add_link_button_5">Ok </button>
      </div>
            </form>
    </div>
  </div>
</div>
<div id="ss_enrollment_add_link"  class="modal fade ss_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h4 class="modal-title" id="myModalLabel">Adding Link</h4>
      </div>
      <div class="modal-body">
            <div class="row">
             <br/>
          <img src="assets/images/icon_info.png" class="pull-left"><span class="ss_extar_top20">See Your result in enrollment list</span>   

<br/><br/>
                    </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue success">Close</button>
        <button type="button" class="btn btn_blue success" >Ok </button>
      </div>
    </div>
  </div>
</div>
<script>
    $('.enrollment_modal_id').click(function(){
        var modal_id = $(this).attr("data");
        $.ajax({
            type: 'ajax',
            method: 'post',
            async: false,
            dataType:'json',
            url: 'get_ref_link',
            data:{
                user_type: modal_id
            },
            success: function(msg){
                var i;
                var html='';
                if(msg.length >0 ){
                    for (i = 0; i < msg.length; i++) {                  
                    html += '<div class="form-group  row"><label for="inputPassword3" class="col-sm-6 control-label">ref. Link Number</label><div class="col-sm-6"> <input type="text" class="form-control" id="inputPassword3" value="'+msg[i]['SCT_link']+'" name="link[]"><i class="fa fa-times removeLinkIcon" style="color:red; float:right;" sct_link="'+msg[i]['id']+'"></i></div></div>';
                }
                html += '<div class="form-group  row"><label for="inputPassword3" class="col-sm-6 control-label"></label><div class="col-sm-6"> <input type="text" class="form-control" id="inputPassword3" name="link[]"></div></div>';                
                }else{
                    html += '<div class="form-group  row"><label for="inputPassword3" class="col-sm-6 control-label">ref. Link Number</label><div class="col-sm-6"> <input type="text" class="form-control" id="inputPassword3" name="link[]"></div></div>';
                }
                $('#modal_body_' + modal_id).html(html);
            }
        }); 
        $('#ss_enrollment_model_' + modal_id).modal('show');
        
        $('#add_link_button_' + modal_id ).click(function(){
        
            var data=$('#add_link_ref_form_' + modal_id).serialize();
            $.ajax({
                type: 'ajax',
                method: 'post',
                async: false,
                //dataType:'json',
                url: 'save_ref_link',
                data:data,
                success: function(msg){
                    if(msg==1){
                        $('#ss_enrollment_model_' + modal_id).modal('hide');
                        $('#ss_enrollment_add_link').modal('show'); 
                        $('.success').click(function(){
                            location.reload();
                        });
                    }else if(msg==0){
                        $('#error_'+ modal_id).html('Enter a link');
                    }else if(msg==2){
                        $('#error_'+ modal_id).html('Enter a correct  link');
                    }
                }
            });
        
            
        });
        
    });
    
$(document).on('click','.removeLinkIcon', function(){
    var sct_link = $(this).attr('sct_link');
    swal("Really want to remove reference link?", {
      buttons: {
        yes: "Yes",
        no: "No",
      },
    })
    .then((value) => {
      switch (value) {

        case "yes":
        $.ajax({
          url: "Student/removeRefLink",
          method:'POST',
          data:{sct_link:sct_link},
          success: function(response) {
            console.log(response);
            swal({
              title: 'Success', 
              text: 'Link removed successfully',
              icon: 'success',
            })
            .then(name=>{
              window.location.reload();
            });
          }
        });
       
        break;

        case "no":
        swal("Abort", "Link not removed", "warning");
        break;

        default:
        swal("Abort", "Link not removed", "warning");
      }
    });

})

</script>
