<style>
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
    
    a {
        padding: 0 10px;
    }
</style>

<?php if (count($registered_courses) == 1) { ?>
    <style type="text/css">
        .progress_step {
        text-align: center;   
        text-decoration: underline;     }
    </style>
<?php }else{ ?>
    <style type="text/css">
        .progress_step {
            text-align: center;
            display: flex;
            margin: 0 25%;
            text-decoration: underline;
            }
    </style>
<?php } ?>


<div class="" style="margin-top: 20px;">
    <div class="progress_step">
            <?php if (isset($registered_courses)){?>
                <?php foreach ($registered_courses as $registered_course){?>
            <a style="font-size: 17px;" href="<?php echo base_url('student_progress_course/'.$registered_course['id'].'')?>"><?= $registered_course['courseName']?></a>
                <?php }?>
            <?php }?>
    </div>
</div>


