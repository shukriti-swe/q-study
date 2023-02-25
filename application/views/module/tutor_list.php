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
						  <ul>

							<?php foreach ($allTutors as $tutor) : ?>

                <?php if ($tutor['name'] !='Qstudy'  ) { ?>
                  <li style="margin-left:5px;">
                      <a href="all_tutors_by_type/<?php echo $tutor['id'];?>/<?php echo $module_type;?>" class="accordion-toggle collapsed">
                          <i class="fa fa-caret-right"></i>
                          <?php echo $tutor['name']; ?>
                      </a>
    
                      <ul style="margin-left: 20px;">
                          <?php if(isset($tutor['child_info'])){
                              foreach ($tutor['child_info'] as $child_info) : ?>
                              <li style="margin-left:5px;">
                                  <a href="all_tutors_by_type/<?php echo $child_info['id'];?>/<?php echo $module_type;?>" class="accordion-toggle collapsed">
                                      <i class="fa fa-caret-right"></i>
                                      <?php echo $child_info['name']; ?>
                                  </a>
                              </li>
                          <?php endforeach; }?>
                      </ul>
                  </li>
                <?php  } ?>
              <?php endforeach; ?>
							
						  </ul>

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
</script>
