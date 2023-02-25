<style>
  .hr{margin:5px 0;}
  .accordion-group{margin-bottom:10px;border-radius:0;}
  .accordion-toggle{
    background:rgb(248, 251, 252);
    
  }

  .accordion-toggle:hover{
    text-decoration: none;
    
  }

  .accordion-heading .accordion-toggle {
    display: block;
    padding: 8px 15px;
  }



  .selectStyle{
    width:46%; float: left; margin-right: 8%;
  }


  .accordion-group{
    margin-bottom:20px;
  }

</style>

<div class="today_task">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-10">
        <div class="row">
          <div class="col-sm-4">


          </div>
          <div class="col-sm-4">
            <h3>Today Task</h3>
          </div>
          <div class="col-sm-4 ss_qstudy_list_mid_right">

          </div>
        </div>
      </div>
    </div>

    <div class="ss_alltask_list">
      <div class="panel-group" id="task_accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
              <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                <span>  Tutor Name </span>
              </a>
            </h4>
          </div>
          <div class="row">
            <div class="col-sm-12">
              
              <?php $i=0; ?> 
                <?php if (isset($module_info)) : ?>
                    <?php foreach ($module_info as $tutorName => $tutorsModule) : ?>
                  <div class="accordion-group">
                    <div class="accordion-heading">
                      <a id="tutorName" tutorId="<?php echo $tutorsModule[0]['user_id'] ?>" class="accordion-toggle" data-toggle="collapse" data-parent="toggle" href="#collapse<?php echo $i?>">
                        <i class="fa fa-caret-right"></i> <?php echo $tutorName;?>
                      </a>
                    </div>
                  </div>
                  
                  
                  <div id="collapse<?php echo $i?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <table class="table table-bordered" id="moduleTable">
                        <tbody>
                          <tr>moduleName</tr>
                          <tr>creatorName</tr>
                          <tr>trackerName</tr>
                          <tr>individualName</tr>
                          <tr>subject_name</tr>
                          <tr>chapterName</tr>
                        </tbody>
                        
                        <!-- <tr>
                          <td>Module Name</td>
                          <td>Tracker Name</td>
                          <td>Individual Name</td>
                          <td>Subject</td>
                          <td>Chapter</td>
                        </tr>
                        <?php $j=0; ?>
                        
                        <?php foreach ($tutorsModule as $module) :  ?>
                          <tr>
                            <td>
                              <a href="get_tutor_tutorial_module/1">
                                <?php echo $module['moduleName']; ?>
                              </a>
                            </td>
                            <td><?php echo $module['trackerName']; ?></td>
                            <td><?php echo $module['individualName']; ?></td>
                            <td><?php echo $module['subject_name']; ?></td>
                            <td><?php echo $module['chapterName']; ?></td>
                          </tr>
                            <?php $j++; ?>
                        <?php  endforeach; ?> -->
                        </table>
                      </div>
                    </div>  
                    
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>
    jQuery('.accordion-toggle').click(function(){
      
      var has = jQuery(this);
      if(has.hasClass('collapsed')){
        jQuery(this).find('i').removeClass('fa-caret-right');
        jQuery(this).find('i').addClass('fa-caret-down');
      }
      else{
        jQuery(this).find('i').removeClass('fa-caret-down');
        jQuery(this).find('i').addClass('fa-caret-right');
      }
    })


  //get repeated module on clicking tutor name
  $('#tutorName').on('click', function(){
    var tutorId = $(this).attr('tutorId');
    var tutorType  = <?php echo $tutorType; ?>;
    var moduleType = <?php echo $moduleType; ?>;
    $.ajax({
      url: 'Student/studentsModuleByQStudy',
      method: 'POST',
      data: {
        tutorId:tutorId, 
        tutorType:tutorType, 
        moduleType:moduleType
      },
      success: function(data){
        $('#moduleTable').html(data);
        //console.log(data);
      }
    })
  })
</script>
