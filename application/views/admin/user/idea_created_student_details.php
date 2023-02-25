<div class="" style="margin-left: 15px;">
    <div class="row">
     
    <div class="col-md-12  ">
        <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true"> 
            <div class="top_headed">
              <div class="text-center"> 
                <label> &nbsp;</label> 
                
                    <button class="btn btn-success btn-block"><?=$student_info[0]['name']?></button>
              </div>
              <div>
                <label>Gread/Year/Level</label>
                <input type="text" name="grade" value="<?=$grade?>" class="form-control">
              </div>
              <div>
                <label>Rate</label>
                <input type="text" name="" value="1$" class="form-control w-100">
              </div>
              <div>
                <a class="btn btn-info" style="margin-top: 20px;" type="button">Admin Approve</a>
              </div>

            </div> 
        </div>
        <div class="row">
          <div class="col-md-12 table-responsive text-center">
             
            <table class="rs_n_table table table-bordered" ccellspacing="30">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Recive Date</th>
                        <th></th>
                        <th>Finish Date</th>
                        <th>Days</th>
                        <th>Words Limit</th> 
                        <th>Pyment Due</th>
                        <th>$</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($student_ideas as $student_idea){ 
                        // echo "<pre>";print_r($student_idea);die();
                        ?> 
                      <tr>
                        <td style="border:0;width: 35px;text-align: center;">
                            <input type="checkbox" name="" <?php if($student_idea['by_admin_or_tutor']==2){echo "checked";}?>> 
                        </td>
                        <td style="<?php if(!empty($student_idea['remake_info'])){echo "background-color: #c3c1c1";}?>">
                          <a href="<?php echo base_url('admin/idea_create_student_setting/'.$student_idea['idea_id'].'/'.$student_idea['idea_no'].'/'.$student_idea['question_id'].'/'.$student_idea['user_id'])?>"> <u> <?=$student_idea['submit_date'];?> </u> </a>
                        </td> 
                        <td style="<?php if(!empty($student_idea['remake_info'])){echo "background-color: #c3c1c1";}?>">
                          <!-- <a href="<?//php echo base_url('admin/admin_idea_correction_workout/');echo $student_idea['idea_id'].'/'.$student_idea['user_id']; ?>"> <img src="assets/images/icon_details.png"> </a> -->
                          <a href="<?php echo base_url('admin/student_idea_setting/');echo $student_idea['i_question_id'].'/'.$student_idea['idea_id'].'/'.$student_idea['user_id'].'/'.$student_idea['module_id']; ?>"> <img src="assets/images/icon_details.png"> </a>
                        </td>
                        <td style="<?php if(!empty($student_idea['remake_info'])){echo "background-color: #c3c1c1";}?>">
                        <?php if($student_idea['by_admin_or_tutor']==2){?> <img class="pull-left" src="assets/images/icon_sucess.png" width="24"> <?php }
                        $d1 = strtotime($student_idea['submit_date']);
                        $d2 = strtotime($student_idea['remake_info']['submit_date']);
                        
                        $totalSecondsDiff = abs($d1-$d2);
                        $days = $totalSecondsDiff/60/60/24;
                        echo $student_idea['remake_info']['submit_date'];?>
                     
                        </td>
                        <td>
                        <?php 
                          if(!empty($student_idea['remake_info'])){
                         echo $days; }?>
                        </td>
                        <td>
                          <?php 
                          if(!empty($student_idea['remake_info'])){
                         echo $student_idea['word_limit']; }?>
                        </td>
                        <td>
                           
                        </td>
                        <td>
                          
                        </td>
                      </tr>
                      <?php }?>
                      
                    </tbody>
                </table>
          </div>
           
          
        </div>
        <br>
        <br>
        <div class="form-group p2 text-center">
              <button class="btn btn-default" id="preview-button" value="">
                <i class="fa fa-arrow-circle-left"></i> Preview
              </button>
              <button class="btn btn-default" id="next-button" value="30">
                Next <i class="fa fa-arrow-circle-right"></i>
              </button>
          </div>
      </div>
  </div>
</div>
<style type="text/css">
  .w-100{
    max-width: 100px;
  }
  .top_headed{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
  .top_headed > div { 
    box-sizing: border-box;
    margin: 10px 10px 0 0; 
  }
  .top_headed label{
    margin-bottom: 5px;
  }
  .p2{
    padding: 10px;
  }
  .btn-text{
    background: #fff;
      color: #17a8e9;
      font-weight: bold;
      text-decoration: underline;
  }
  .rs_n_table{
    border: none;
     border-collapse: separate;
      border-spacing: 10px 0px;
  } 
  .rs_n_table a{
    color: #333;
  }
  .rs_n_table td{
    vertical-align: middle !important;
    border-color: #b7dde9 !important;
  }
  body .rs_n_table thead th{
    border: none !important;
    text-align: center;
    font-size: 14px;
      padding-left: 0;
      padding-right: 0;
  }
</style>
 