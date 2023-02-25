<div class="row" style="justify-content: center;display: flex ; margin-top: 30px; margin-bottom: 30px;">
  <div class="col-md-3"> 
    <div class="text-center">Grade/Year/lavel</div>
    <br>
    <table class="rs_n_table table table-bordered" ccellspacing="30">
          <tbody>
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
              <?php 
              foreach($my_student as $student){
                if($student['student_grade'] == 1){
                   $allow1=1;
                }
                ?>
                  
              <?php 
              }
              if($allow1){?><a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a><?php }
              ?>  
              </td>
              <td>
                <a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list_student/1"> 1 </a> 
              </td>  
            </tr>
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
              <?php 
              foreach($my_student as $student){
                if($student['student_grade'] == 2){
                   $allow2=2;
                }
                ?>
                  
              <?php 
              }
              if($allow2){?><a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a><?php }
              ?>  
              </td>
              <td>
                 <a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list_student/2">2 </a>
              </td>  
            </tr> 
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
              <?php 
              foreach($my_student as $student){
                if($student['student_grade'] == 3){
                   $allow3=1;
                }
                ?>
                  
              <?php 
              }
              if($allow3){?><a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a><?php }
              ?>
              </td>
              <td>
                 <a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list_student/3"> 3 </a>
              </td>  
            </tr> 
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
              <?php 
              foreach($my_student as $student){
                if($student['student_grade'] == 4){
                   $allow4=4;
                }
                ?>
                  
              <?php 
              }
              if($allow4){?><a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a><?php }
              ?> 
              </td>
              <td>
                 <a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list_student/4"> 4 </a>
              </td>  
            </tr> 
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
              <?php 
              foreach($my_student as $student){
                if($student['student_grade'] == 5){
                   $allow5=5;
                }
                ?>
                  
              <?php 
              }
              if($allow5){?><a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a><?php }
              ?> 
              </td>
              <td>
                 <a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list_student/5"> 5 </a>
              </td>  
            </tr> 
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
              <?php 
              foreach($my_student as $student){
                if($student['student_grade'] == 6){
                   $allow6=6;
                }
                ?>
                  
              <?php 
              }
              if($allow6){?><a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a><?php }
              ?> 
              </td>
              <td>
                 <a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list_student/6"> 6 </a>
              </td>  
            </tr> 
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
              <?php 
              foreach($my_student as $student){
                if($student['student_grade'] == 7){
                   $allow7=7;
                }
                ?>
                  
              <?php 
              }
              if($allow7){?><a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a><?php }
              ?> 
              </td>
              <td>
                 <a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list_student/7"> 7 </a>
              </td>  
            </tr> 
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
              <?php 
              foreach($my_student as $student){
                if($student['student_grade'] == 8){
                   $allow8=8;
                }
                ?>
                  
              <?php 
              }
              if($allow8){?><a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a><?php }
              ?>   
              </td>
              <td>
                 <a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list_student/8"> 8 </a>
              </td>  
            </tr> 
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
              <?php 
              foreach($my_student as $student){
                if($student['student_grade'] == 9){
                   $allow9=9;
                }
                ?>
                  
              <?php 
              }
              if($allow10){?><a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a><?php }
              ?>   
              </td>
              <td>
                 <a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list_student/9"> 9 </a>
              </td>  
            </tr> 
            
           
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
              <?php 
              foreach($my_student as $student){
                if($student['student_grade'] == 10){
                   $allow10=10;
                }
                ?>
                  
              <?php 
              }
              if($allow10){?><a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a><?php }
              ?>   
              </td>
              <td>
                 <a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list_student/10"> 10 </a>
              </td>  
            </tr> 
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
              <?php 
              foreach($my_student as $student){
                if($student['student_grade'] == 11){
                   $allow11=11;
                }
                ?>
                  
              <?php 
              }
              if($allow11){?><a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a><?php }
              ?>  
              </td>
              <td>
                 <a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list_student/11"> 11 </a>
              </td>  
            </tr> 
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
              <?php 
              foreach($my_student as $student){
                if($student['student_grade'] == 12){
                   $allow12=12;
                }
                ?>
                  
              <?php 
              }
              if($allow12){?><a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a><?php }
              ?>  
              </td>
              <td>
                 <a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list_student/12"> 12 </a>
              </td>  
            </tr> 
            <tr>
              <td style="border:0;width: 35px;text-align: center;">
                  
              </td>
              <td>
                                                                             <!-- 22 = Upper level -->
                 <a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list_student/22"> Upper Level </a>
              </td>  
            </tr> 
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