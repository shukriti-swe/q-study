<style>
    .panel-heading{
        background-color: #2F91BA !important;
    }
    
    .panel-title a {
        text-decoration: none;
        color: #fff !important;
    }
</style>

<div class="" style="margin-left: 15px;">
    <div class="row">
        <div class="col-md-4">
            <?php echo $leftnav ?>
        </div>


        <div class="col-md-8 user_list">
            <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title text-center">
                            <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                                <strong><span style="font-size : 18px; color:white;">  Edit User </span></strong>
                            </a>
                        </h4>
                    </div>
                    
                    <form autocomplete="off" action="user_add" method="POST">
                        <div class="row panel-body">
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button class="btn btn_next" id="cancelBtn"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                                    <button type="submit" class="btn btn_next" id="saveBtn">
                                        <i class="fa fa-check" style="padding-right: 5px;"></i>Update
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="row panel-body">
                            <div class="row" style="padding:0px 5px 0px 5px;">

                                <div class="col-sm-6">

                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $user_info[0]['name']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="emailFieldNakiUserNameHobe" class="form-control" id="email" name="email" value="<?php echo $user_info[0]['user_email']?>">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Login Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="loginName" name="loginName" required>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Mobile No</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $user_info[0]['user_mobile']?>">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Subrub</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="subrub" name="subrub">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Postal Code</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="postal_code" name="postalCode">
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Ref Link</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="ref_link" name="refLink" value="<?php echo $user_info[0]['SCT_link']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Guest User</label>
                                        <div class="col-sm-8">
                                            <input class="form-check-input" type="checkbox" name="isGuest" value="trial" id="isGuest" <?php if($user_info[0]['subscription_type'] == 'trial'){echo 'checked';}?>>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-sm-6">
                                    <!-- <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Last Name</label>
                                        <div class="col-sm-8">
                                            <input  type="text" class="form-control" id="last_name" name="lastName">
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">User Type</label>
                                        <div class="col-sm-8">
                                            <select id="userType" class="form-control" name="userType" required>
                                                <option selected>Choose...</option>
                                                <?php foreach ($user_type as $userType) : ?>
                                                    <option value="<?php echo $userType['id'] ?>" 
                                                        <?php if($user_info[0]['user_type'] == $userType['id']){echo 'selected';}?>>
                                                        <?php echo $userType['userType'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="grade" style="display:none">
                                        <label for="" class="col-sm-4 col-form-label">Grade/Year/Level</label>
                                        <div class="col-sm-8">
                                            <select  class="form-control" name="grade">
                                                <option selected value="">Choose...</option>
                                                <?php for ($a=1; $a<=12; $a++) : ?>
                                                    <option value="<?php echo $a;?>"><?php echo $a; ?></option>
                                                <?php endfor; ?>
                                                <option value="13">Upper Level</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="parent" style="display:none">
                                        <label for="" class="col-sm-4 col-form-label">Parent</label>
                                        <div class="col-sm-8">
                                            <select  class="form-control" name="parentId">
                                                <option selected value="">Choose...</option>
                                                <?php foreach ($parents as $parent) : ?>
                                                    <option value="<?php echo $parent['id'] ?>">
                                                        <?php echo $parent['name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="numOfChild" style="display:none">
                                        <label for="" class="col-sm-4 col-form-label">Number of children</label>
                                        <div class="col-sm-8">
                                            <select  class="form-control" name="numOfChild">

                                                <option selected value="">Choose...</option>
                                                <?php for ($a=1; $a<=10; $a++) : ?>
                                                    <option value="<?php echo $a;?>"><?php echo $a; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Active</label>
                                        <div class="col-sm-8">
                                            <input class="form-check-input" type="checkbox" name="isActive" value="1" id="isActive">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Canceled</label>
                                        <div class="col-sm-8">
                                            <input class="form-check-input" type="checkbox" name="isCanceled" value="1" id="isCanceled">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Extend Trial Period</label>
                                        <div class="col-sm-8">
                                            <input class="form-check-input" type="checkbox" name="isExtendTrialPeriod" value="1" 
                                                <?php if($user_info[0]['trial_end_date']){echo 'checked';}?> id="isExtendTrialPeriod">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Country</label>
                                        <div class="col-sm-8">
                                            <select name="country" id="country" class="form-control" name="country">
                                                <option value="">Choose...</option>
                                                <?php foreach ($all_country as $country) : ?>
                                                    <option value="<?php echo $country['id'] ?>"<?php if($user_info[0]['country_id'] == $country['id']){echo 'selected';}?>>
                                                        <?php echo $country['countryName'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    //add/hide form fields based on user type selection
    $(document).on('change', '#userType', function(){
        var userType = this.value;
        if(userType == 1) { 
            $('#numOfChild').css('display', 'block');

            //hide other types
            $('#parent').css('display', 'none');
            $('#grade').css('display', 'none');

        }else if(userType == 2 || userType == 6){
            $('#parent').css('display', 'block');
            $('#grade').css('display', 'block');
            
            //hide other types
            $('#numOfChild').css('display', 'none');
            $('.childInfo').remove();

        } else { //else hide all custom
            $('#parent').css('display', 'none');
            $('#grade').css('display', 'none');
            $('#numOfChild').css('display', 'none');
            $('.childInfo').remove();
        }

    });

    $(document).on('change', "#numOfChild select", function(){
        var numOfChild = this.value;
        var html='';


        for(var a=0; a<numOfChild; a++){

            html +='<div class="form-group childInfo row">';
            html += '<label for="" class="col-sm-4 col-form-label">Student Name</label>';
            html += '<div class="col-sm-8">';
            html += '<input class="form-check-input form-control" type="text" name="childName[]"  required>';
            html += '</div></div>';


            html +='<div class="form-group childInfo row">';
            html += '<label for="" class="col-sm-4 col-form-label">Year/Grade</label>';
            html += '<div class="col-sm-8">';
            html += '<input class="form-check-input form-control" type="number" min="1" max="12" name="childGrade[]" required>';
            html += '</div></div>';


            html +='<div class="form-group childInfo row">';
            html += '<label for="" class="col-sm-4 col-form-label">School/Tutor Link</label>';
            html += '<div class="col-sm-8">';
            html += '<input class="form-check-input form-control" type="text" name="childSCTLink[]" required>';
            html += '<hr>';
            html += '</div></div>';
        }

        $('#numOfChild').after(html);


    })


</script>





