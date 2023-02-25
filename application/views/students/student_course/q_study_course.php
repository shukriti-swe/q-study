<style>
    .presonal2{
        background-color:#A349A4 !important;
    }
    .presonal2 a{
        color:#fff !important;
    }
</style>
<div class="container">
    <div class="row s_personal_ul_course s_personal_ul_qstudycourse">
        <div class="col-sm-2"></div>
        <div class="col-sm-7">
            <ul class="personal_ul personal_ul_course schedule">

                <?php  if (isset($tutor_list)) { ?>
                    <li class="presonal2"><a href="module/tutor_list/1">Tutorial</a></li>
                    <li class="presonal2"><a href="module/tutor_list/2">Everyday Study</a></li>
                    <li class="presonal2"><a href="module/tutor_list/3">Special Exam</a></li>
                    <li class="presonal2"><a href="module/tutor_list/4">Assignment</a></li>
                <?php }else{ ?>
                    <li class="presonal2"><a href="all_tutors_by_type/2/1">Tutorial</a></li>
                    <li class="presonal2"><a href="all_tutors_by_type/2/2">Everyday Study</a></li>
                    <li class="presonal2"><a href="all_tutors_by_type/2/3">Special Exam</a></li>
                    <li class="presonal2"><a href="all_tutors_by_type/2/4">Assignment</a></li>
                <?php  } ?>

            </ul>
            <div ><img style="margin:20px auto;" src="assets/images/personal_n1.png" class="img-responsive"></div>
        </div>
        <div class="col-sm-3">
            <ul class="ss_nenu_right_side">
                <li><a href="#">Find Tutor <img src="assets/images/icon_find_tutorial.png"></a></li>
                <li><a href="#">White Board <img src="assets/images/icon_w_board.png"></a></li>
            </ul>
        </div>
    </div>
</div>
