<style>
    .success_view_details{
     display: flex;
     width: 100%;
     align-items: center;
    }
    .success_view_details .ss_top_s_course li{
        max-width: 100%;
    }
</style>
<div id="course_content<?php echo $box_num;?>" class="success_view_details">

    <div class="col-md-4">

        <div class ="form-group">
            <button class="btn btn-info" type="button" id="<?php echo $course_details[0]['id'];?>" 
                    onclick="delete_course('<?php echo $course_details[0]['id'];?>','<?php echo $box_num;?>')">Delete</button>                                         
        </div> 
    </div>

    <div class="col-md-8">
        <div class="ss_top_s_course">
            <ul>

                <?php
                if ($course_details) {
                    $i = 0;
                    foreach ($course_details as $course) {
                        $i++;
                        ?>
                        <li class="text-left" style="width: 100%">
                            <p style="line-height: 18px;">
                                <?php echo $course['courseName'] ?><br/> 

                                <?php if($course['courseCost']){?>
                                    <!--<span>$</span>--><?php // echo $course['courseCost'] ?> 
                                <?php }?>

                                <!--(<?php //echo $course['year/grade'] ?>)-->
                            </p>
                            <p class="text-right filled-in">
                                <input class="form-check-input" id="course_<?php echo $i; ?>"type="checkbox" name="course[]" value="<?php echo $course['id'] ?>" 
                                       data='<?php echo $course['courseCost'] ?>' <?php if($course['is_enable'] == 1){echo 'checked';}?>>
                            </p>
                        </li>
                    <?php }
                } ?>
            </ul>
        </div>
    </div>
</div>