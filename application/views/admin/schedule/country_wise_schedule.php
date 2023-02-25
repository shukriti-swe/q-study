<div class="row">
    <div class="col-md-4">
        <?php echo $leftnav ?>
    </div>
    <div class="col-md-8">
        <div class="button_schedule text-right" >
            <a href="" class="btn btn_next"><i class="fa fa-home"></i> Home</a>
        </div>

        <form action="admin/add_course_schedule" method="post">
            <input type="hidden" name="country_id" value="<?php echo $country_info[0]['id']?>">
            <div class="row schedule_country_details">
                <div class="col-md-3">
                    <P style=" color: #000; "><i class="fa fa-file" style=" color: #fbea71; "></i> <?php echo $country_info[0]['countryName']?></P>
                </div>
                <div class="col-md-9">
                    <!-- <label class="checkbox-inline">-->
                    <!--    <input type="checkbox" name="subscription_type" value="2">Trial Subscription-->
                    <!--</label>-->
                    <!--<label class="checkbox-inline">-->
                    <!--    <input type="checkbox" name="subscription_type" value="1">Full Subscription-->
                    <!--</label>-->
                    <a href="directDepositSetting/<?= $country_info[0]['id']?>"><u>Direct Deposit Payment</u></a>
                </div>

                <div class="col-md-12 checkbox_n">

                    <div class="checkbox">
                        <!--Actually Parent treated as 1 but  here for student we use 1 
                            because in registering page we use parent--> 
                            <label><input type="checkbox" value="1" name="user_type">Student</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="2" name="user_type">Upper Label Student</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="3" name="user_type">Tutor</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="4" name="user_type">School</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="5" name="user_type">Corporate</label>
                        </div>
                        
                    </div>
                    
                    
                </div>
                <div class="row">
                    <div style="text-align: right;" class="col-md-12">
                        <button class="btn btn_next" type="submit">Next</button>
                    </div>
                </div>
            </form>
            
            
            
        </div>
    </div>

