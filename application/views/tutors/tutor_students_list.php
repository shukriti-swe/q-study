 

 <div class="text-center">
   <button  class="btn btn-primary">Student List</button>
   <ul class="st_btn_list">
     <li><a href="<?php echo base_url();?>tutor/tutor_my_student_list">My Student</a></li>
     <li><a href="javascript:void(0)" class="alertd_icon"><img src="assets/images/alertd_icon.png"> </a><a href="<?php echo base_url();?>tutor/tutor_qstudy_students_list">Q-Study Student</a></li>
   </ul>
 </div>

 <style type="text/css">
   .st_btn_list{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    padding-top: 80px;
   }
   .st_btn_list li{
    margin: 5px;
    position: relative;
   }
   .st_btn_list li a{
    padding: 15px 30px;
    border: 1px solid #c3c3c3;
    color: #7f7f7f;
   }
   .alertd_icon{
      position: absolute;
            top: -50px;
            left: 0;
            right: 0;
            margin: auto;
            border: none !important;
   }
   .alertd_icon img{
    width: 30px;
   }
 </style>