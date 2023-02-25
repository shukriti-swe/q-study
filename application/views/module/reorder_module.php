    
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      $( function() {
        $( "#moduleList" ).sortable();
        $( "#moduleList" ).disableSelection();

        $( "#moduleList_2" ).sortable();
        $( "#moduleList_2" ).disableSelection();
      } );
    </script>
<div class="container top100">
    <div class="row">

        <div class="col-md-10 text-center">
            <?php if ($this->session->userdata('success_msg')) : ?>
                <div class="alert alert-success alert-dismissible show" role="alert">
                    <strong><?php echo $this->session->userdata('success_msg'); ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php elseif ($this->session->userdata('error_msg')) : ?>
                <div class="alert alert-danger alert-dismissible show" role="alert">
                    <strong><?php echo $this->session->userdata('error_msg'); ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div> <!-- end row -->
    <form action="" method="post" id="reorderModuleForm">
        <div class="row text-center">
            <button class="btn btn-primary" type="submit" id="save_btn">Save</button>
            <button class="btn btn-primary" type="button" disabled="true">Preview</button>
            <button class="btn btn-primary" type="button" onclick="subject_order()" >Subject Order</button>
        </div> <!-- end save preview btn row -->

        <div class="row">
            <br>
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleInputName2">Country</label>
                    <div class="select country">
                        <select class="form-control" name="" id="">
                            <?php echo $all_country; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-2">

                <div class="form-group">
                    <label for="exampleInputEmail2">Module Type</label>
                    <div class="select">
                        <select class="form-control select-hidden moduleType">
                            <option value="">Select....</option>
                            <?php foreach ($all_module_type as $module_type) { ?>
                                <option value="<?php echo $module_type['id'] ?>">
                                    <?php echo $module_type['module_type']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div> -->
            <div class="col-md-2">
            <div class="form-group color_btn">
              <label for="exampleInputEmail2">Grade/Year/Level</label>
              <div class="select">
                <select class="form-control " id="studentGrade" name="studentGrade" required >
                <?php for ($a = 1; $a <= 13; $a++) : ?>
                  <?php if ($a >= 13) : ?>
                    <option value="<?php echo $a ?>">Upper Level</option>
                    <?php else : ?>
                      <option value="<?php echo $a ?>"><?php echo $a; ?></option>
                    <?php endif; ?>
                  <?php endfor; ?>
                </select>

              </div>
            </div>

          </div>
          <div class="col-md-2">
            <div class="form-group color_btn">
              <label for="exampleInputEmail2">Subject</label>
              <div class="select">
                <select class="form-control" required="required" id="std_subject" name="std_subject" >
                    <?php foreach($all_subject as $subject){?>
                        <?php if($subject['subject_name'] != '') {?>
                        <option value="<?php echo $subject['subject_id']?>"><?php echo $subject['subject_name']?></option>
                         <?php }?>
                    <?php }?>
                </select>

              </div>
            </div>

          </div>

            <div class="col-md-2">
                <div class="form-group">
                    <br>
                    <button type="button" class="btn btn_green" id="moduleSearch"><i class="fa fa-search"></i>Choose Module</button>
                </div>
            </div>
            <div class="col-md-2"></div>

        </div> <!-- row -->
        <div class="row"  >
            <div class="progress" id="progress" style="display: none;">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="">
                  </div>
            </div>
        </div>
        <div class="sign_up_menu non_subjects">
            <div class="table-responsive">
                <table class="table table-bordered" id="module_setting">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Module Name</th>
                            <th>Module Type</th>
                            <th>Subject</th>
                            <th>Chapter</th>
                            <th>Reorder</th>
                        </tr>
                    </thead>
                    <tbody id="moduleList">
                        <!-- <?php echo $row; ?> -->

                    </tbody>
                </table>
            </div>
        </div>

        <div class="sign_up_menu subjects" style="display: none;">
            <div class="table-responsive">
                <table class="table table-bordered" id="module_setting">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Reorder</th>
                        </tr>
                    </thead>
                    <tbody id="moduleList_2">

                    </tbody>
                </table>
            </div>
        </div>

    </form>
</div>


<script>
    function subject_order() {
        $(".non_subjects").hide();
        $(".subjects").show();
        $.ajax({
            url: 'Module/renderReorderModuleSubject',
            method: 'POST',
            dataType: 'html'
        })
        .done(function(data) {
            $('#moduleList_2').html(data)
        })
    }
  /*prevent duplicate ordering for module*/
  $('.moduleOrder').on('change', function(e){
        //e.stopPropagation();
        var temp=0;
        var inp = this.value;

        $('.moduleOrder').not(this).each(function(){
          if(inp==this.value){
            temp=this.value;
          }
        });
        
        if(temp){
          Overlaping(temp);
        }else{
          var modId = $(this).siblings('#modId').val();
          $(this).siblings('input#modId_ordr').val(modId+'_'+inp);
        }

      })

  function Overlaping(order_id) {
      var number=document.getElementById("moduleNames_"+order_id+"").value; 
      var subject_name_=document.getElementById("subject_name_"+order_id+"").value; 
      alert('Order Overlaping, Please fix this module name = '+number+' , Subject = '+subject_name_+' ');
      
  }

    //checkbox check functionality on module ordering
    var maxOrder = $('#maxOrder').val();
    $(document).on('change', '#moduleChecked', function(){
        var x = $(this).siblings('#modOrdr');  
        var modId = $(this).siblings('#modId').val();
        if(this.checked){
            $(this).siblings('#modOrdr').prop('disabled', false);
            $(this).siblings('#modOrdr').prop('required', true);

            x.val(++maxOrder);
            
            $(this).siblings('input#modId_ordr').val(modId+'_'+maxOrder);
        } else {
            $(this).siblings('#modOrdr').prop('disabled', true);
            x.val('');
            --maxOrder;
            $(this).siblings('input#modId_ordr').val(modId+'_'+'0');//0 -> order removed
        }
    })

    //module ordering form submit & preview button enable
    $(document).on('submit', '#reorderModuleFormdddd', function(e){
        e.preventDefault();

        var all_module_order = $('.moduleOrder');
        var tempOrderArray = [];
        var max_module_order = 0;
        $.each(all_module_order,function(index, object) {
            max_module_order = Math.max(max_module_order, object.value);
            if(!isNaN(parseInt(object.value))){
                tempOrderArray.push(parseInt(object.value));
            }
       });

        tempOrderArray.sort();

        var flag=0;

        // for(var a=1; a<=max_module_order; a++){
        //     if($.inArray(a,tempOrderArray)==-1){
        //         flag = 1;
        //         console.log(a);
        //     }
        // }
        if(flag){
            alert('You Need to Maintain the Sequence of Module Order And Order Can not be Overlapped');
        } else {
            $.ajax({
                url : 'Module/saveModuleOrdering',
                method : 'POST',
                data : $(this).serialize(),
                success : function(data){
                    if(data=='true') {
                        alert('Module Order Updated Successfully.');
                    }else if(data=='empty') {
                        alert('No order can be kept empty.');
                    }else{
                        alert('Something went wrong.')
                    } //end else
                } //end success
            });
        }
      
    })
    $(document).on('submit', '#reorderModuleForm', function(e){
        e.preventDefault();
        $("#progress").show();
        $.ajax({
            type:"POST",
            url: 'module/save_module_order',
            dataType:'json',
            data:$("#reorderModuleForm").serialize(),
            beforeSend:function()
             {
              $('#save_btn').attr('disabled', 'disabled');
              $('#progress').css('display', 'block');
             },
            success:function(data){

                var percentage = 0;

                var timer = setInterval(function(){
                   percentage = percentage + 20;
                   progress_bar_process(percentage, timer,data);
                  }, 1000); 
            }
        });
    });
function progress_bar_process(percentage, timer,data){

   $('.progress-bar').css('width', percentage + '%');
   if(percentage > 100)
   {
        clearInterval(timer);
        $('#process').css('display', 'none');
        $('.progress-bar').css('width', '0%');
        $('#save_btn').attr('disabled', false);
        $("#progress").hide();
        if(data.success == 1)
        {   
            alert(data.msg);
            

        }else{
            alert(data.msg);
            
        }    
   }
  }

//    function get_order_value(e,serial){
////        alert(serial);
//        $(this).siblings('input#modId').val('')
//        $("#modId_ordr"+serial).val($("#modId").val()+'_'+e.value);
//    }

    //module search
    $(document).on('click keyup','.moduleOrder', function(e){ 
        var module_id = $(this).siblings('input#modId').val();
        var order_id = $(this).val();
        
        $(this).siblings("input#modId_ordr").val(module_id + '_' + order_id);
    });
    
    $(document).on('click','#moduleSearch', function(e){
        e.preventDefault();
        $(".non_subjects").show();
        $(".subjects").hide();

        var country    = $('.country :selected').val();
        var studentGrade = $('#studentGrade').val();
        var std_subject = $('#std_subject').val();
        if(country == '')
        {
            alert('country is required');
            return false;
        }if(studentGrade == '')
        {
            alert('Grade is required');
            return false;
        }
        if(std_subject == '')
        {
            alert('Subject is required');
            return false;
        }
        
        $.ajax({
            url: 'Module/moduleSearchFromReorder',
            method: 'POST',
            data: {
                'country': country,
                'studentGrade':studentGrade,
                'subject':std_subject,
            },
        })
        .done(function(data) {
            $('#moduleList').html(data)
        })
      
    })
  </script>
