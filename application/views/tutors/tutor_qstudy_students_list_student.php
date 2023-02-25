<div class="row" style="justify-content: center;display: flex ; margin-top: 30px; margin-bottom: 30px;">
  <div class="col-md-3"> 

    <table class="rs_n_table table table-bordered" ccellspacing="30">
          <tbody>
            
            <tr>
              <td style="border:0;width: 35px;text-align: center;"></td>
              <td style="border:0;width: 35px;text-align: center;">
                <h4 class="  text-center">  
                  <button class="btn btn-success">Student List</button>
              </h4>
              <br>
              </td>
            </tr>
            
            <?php 
            foreach($get_students as $student){
            ?>
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
                  <?php
                  if(!empty($student['student_ans'])){ ?>
                   <a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a>
                 <?php }
                  ?>
              </td>
              <td>
                <a href="<?php echo base_url();?>tutor/idea_create_tutor/<?=$student['student_id']?>/<?=$student['student_grade']?>"><?=$student['name'];?> </a> 
              </td>  
            </tr>
            <?php }?>
            
          </tbody>
      </table>
  </div> 
</div>
<style type="text/css">
.rs_n_table {
    border: none;
    border-collapse: separate;
    border-spacing: 10px 0px;
}
.rs_n_table td {
    border-color: #b7dde9 !important;
}
.alertd_icon img{
  width: 30px;
 }
 .rs_n_table a{
  color: #000;
 }
</style>