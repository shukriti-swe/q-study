<style>
    .presonal2{
        background-color:#A349A4 !important;
    }
    .presonal2 a{
        color:#fff !important;
    }
	@media only screen and (min-width: 992px) and (max-width: 1200px) {
	.s_personal_ul_course ul.personal_ul li.presonal2{
		width:110px;
		
	}
	.s_personal_ul_course ul.personal_ul li.presonal2{
		font-size:12px;
	}
	}
</style>
<div class="container">
    <div class="row s_personal_ul_course s_personal_ul_qstudycourse">
        <div class="col-sm-2"></div>
        <div class="col-sm-7">
            <ul class="personal_ul personal_ul_course schedule">

                <li class="presonal2"><a href="module/tutor_list/1">Tutorial</a></li>
                <li class="presonal2"><a href="module/tutor_list/2">Everyday Study</a></li>
                <li class="presonal2"><a href="module/tutor_list/3">Special Exam</a></li>
                <li class="presonal2"><a href="module/tutor_list/4">Assignment</a></li>
            </ul>
            <div ><img style="margin:20px auto;" src="assets/images/personal_n1.png" class="img-responsive"></div>
        </div>
        <div class="col-sm-3">
            <ul class="ss_nenu_right_side">
                <li><a href="tutor/search">Find Tutor <img src="assets/images/icon_find_tutorial.png"></a></li>
                <li><a href="#" class="white_board">White Board <img src="assets/images/icon_w_board.png"></a></li>
                 <!-- <li><a href="<?= base_url('/module/types/#') ?>">White Board <img src="assets/images/icon_w_board.png" onclick="myFunction()"></a></li> -->
            </ul>
        </div>
    </div>
</div>

<script>
    $(".white_board").click(function (e) {
        e.preventDefault();
        alert("This feature is working in progress.");
    })
</script>
