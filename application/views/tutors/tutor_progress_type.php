
<style>
ul.personal_ul li:first-child {
    margin-right: 5px;
}

ul.personal_ul li {
    margin-right: 5px;
}
.presonal2 a {
    color:#fff !important;
}
.presonal2 {
    background-color: #EB1F28 !important;
}
.presonal {
    background-color: #006F8C !important;
}
.ss_shudule li img{
max-height: 51px
}
.ss_shudule li{
    background: #fff !important;
    border:1px solid #cbbebe;
    border-radius: 20px;
    padding: 20px;
    min-height: 106px;
    min-width: 176px;
}

.presonal:hover {
    background-color: yellow;
}

.ss_shudule li a{
    color: #000 !important;
}
.ss_shudule li h5 {
font-size: 19px;
}
.btnChngByHover {
  color: #333!important;
}
.btnChngByHover:hover {
    background-color: #0078ae;
}
</style>


<div class="">

    <ul class="personal_ul personal_ul_course schedule ss_shudule">

        <li class="presonal2">
            <a href="<?php echo base_url('tutor_student_progress')?>"> 
                <h5>Q-Study</h5>
                <img src="<?= base_url('/assets/images/37_Qstudy.jpg') ?>"  height="40">
            </a>
        </li>
        <li class="presonal2">
            <a href="<?php echo base_url('student_progress')?>"> 
                <h5>Tutor</h5>
                <img src="<?= base_url('/assets/images/38_Tutor.png') ?>"  height="40">
            </a>
        </li>
    </ul>
</div>

