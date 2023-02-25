<!-- <style>
    /* bhugi jugi */
    .presonal2 a {
        color:#fff !important;
    }
    .presonal2 {
        background-color: #EB1F28 !important;
    }
    .presonal {
        background-color: #006F8C !important;
    }
</style>


<div class="">
    <div class="progress_step">
        <ul>
            <li><a href="<?php echo base_url('student_progress/7')?>">Q-study</a></li>
            <li><a href="<?php echo base_url('student_progress/3')?>">Tutor</a></li>
            <li><a href="<?php echo base_url('student_progress_step')?>" onclick="myFunction()">School</a></li>
            <li><a href="<?php echo base_url('student_progress_step')?>" onclick="myFunction()">Corporate</a></li>
        </ul>
    </div>
</div>

<script type="text/javascript">
    function myFunction() {
      alert('The Privilege access is not assign.')
    }
</script> -->



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
            <a href="<?php echo base_url('student_progress/7')?>"> 
                <h5>Q-Study</h5>
         <img src="<?= base_url('/assets/images/37_Qstudy.jpg') ?>"  height="40">
        </a></li>

        <?php foreach ($types as $key => $value) { ?>

            <?php if ($value['sct_type'] == 3) { ?>
                
                <li class="presonal2">
                    <a href="<?php echo base_url('student_progress/3')?>"> 
                        <h5>Tutor</h5>
                 <img src="<?= base_url('/assets/images/38_Tutor.png') ?>"  height="40">
                </a></li>

            <?php } ?>


            <?php if ($value['sct_type'] == 4) { ?>
                
                <li class="presonal2" onclick="Whiteboard()">
                    <a > 
                        <h5>School</h5>
                 <img src="<?= base_url('/assets/images/39_School.jpg') ?>"  height="40">
                </a></li>

            <?php } ?>

            <?php if ($value['sct_type'] == 5) { ?>
                
                <li class="presonal2" onclick="Whiteboard()">
                    <a > 
                        <h5>Corporate</h5>
                 <img src="<?= base_url('/assets/images/40_Corporate.jpg') ?>"  height="40">
                </a></li>
            
            <?php } ?>
            
        <?php }  ?>
    </ul>

    <script type="text/javascript">
        function Whiteboard(){
            alert('The Privilege access is not assign.')
            location.reload();
        }
    </script>


</div>

