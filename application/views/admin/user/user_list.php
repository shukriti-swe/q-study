<style>
.parent {
    border: 1px solid #ddd;
    margin: 10px;
    min-height: 30px;
    line-height: 28px;
    border-radius: 4px;
}

.child1 {
    float: left;width: 60%;
    text-align: center;
    background: #7FBED8;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
}

.child2 {
    width: 40%;float: left;
    text-align: center;
    background: #2F91BA;
    color: #fff;
}

.form-group{
    display: inline-block;
}

.select2-container .select2-selection--single {
    height: 34px;
    font-size: 13px;
}

label {
    font-size: 13px;
}

.user_list {
    border-color: #2F91BA;
}

.panel-heading{
    background-color: #2F91BA !important;
} 
.panel-title a {
    text-decoration: none;
    color: #fff !important;
}



</style>
<!-- flash message -->
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-8">
    <?php $this->load->view('flash_message_section'); ?>
  </div>
</div>


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
                                <strong><span style="font-size : 18px; color:white;">  User List </span></strong>
                            </a>
                        </h4>
                    </div>
                    
                    <div class="row panel-body">
                        <div class="col-sm-12 text-right">
                            <a type="button" href="<?php echo base_url('Admin/notification') ?>" class="btn btn_next" id=""><i class="fa fa-bell" style="padding-right: 5px;"></i>Notification</a>
                            <button class="btn btn_next" id=""><i class="fa fa-home" style="padding-right: 5px;"></i>Home</button>
                            <a type="button" href="user_add" class="btn btn_next" id=""><i class="fa fa-user-plus" style="padding-right: 5px;"></i>Add New</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-md-12" style="padding: 20px 0;">
                                <table class="table table-striped" style="border: 2px solid;width: 60%;margin-left: 120px;">
                                    <tbody>
                                      <tr>
                                        <td>Expenditure</td>
                                        <td>3000</td>
                                      </tr>
                                      <tr>
                                        <td>To-day income</td>
                                        <td>$<?= $daily_income ?></td>
                                      </tr>
                                      <tr>
                                        <td>Total income</td>
                                        <td>$<?= $total_income ?></td>
                                      </tr>
                                      <tr>
                                        <td>Developer Percentage</td>
                                        <td>5000</td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </div>

                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="parent">
                                                <div class="child1">Total registration</div>
                                                <div class="child2"><?php echo $total_registeredCount;?></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="parent">
                                                <div class="child1">Trail</div>
                                                <div class="child2"><?php echo $trial ;?></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="parent">
                                                <div class="child1">Guest</div>
                                                <div class="child2"><?php echo $guest ;?></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="parent">
                                                <div class="child1">
                                                    <a href="tutor_create_50_vocabulary" style="color: #fff;">50 number of vocabulary creator</a>
                                                </div>
                                                <div class="child2"><?php echo count($tutor_with_50_vocabulary);?></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="parent">
                                                <div class="child1">
                                                    <a href="tutor_with_10_students" style="color: #fff;">Those tutor got 10 students</a>
                                                </div>
                                                <div class="child2"><?php echo count($tutor_with_10_student);?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="parent">
                                                <div class="child1">Today's registration</div>
                                                <div class="child2"><?php echo $today_registeredCount;?></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="parent">
                                                <div class="child1">Direct deposit </div>
                                                <div class="child2"><?php echo $pending ;?></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="parent">
                                                Groupboard 
                                                <div class="child1" style="font-size: 10px;" >Groupboard's Tutor/School/Corporate </div>
                                                <div class="child2"><?php echo $groupboard_require ;?></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> -->

                            <div id="search_option">
                                <form id="user_search_form" style="margin: 20px 0px;">
                                    <div class="form-group col-md-3">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>User Type</label>
                                        <select class="form-control select2" name="user_type">
                                            <option value="">Choose User Type</option>
                                            <?php foreach ($user_type as $type) {?>
                                                <option value="<?php echo $type['id']?>"><?php echo $type['userType']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Country</label>
                                        <select class="form-control select2" name="country_id">
                                            <option value="">Choose Country</option>
                                            <?php foreach ($all_country as $country) {?>
                                                <option value="<?php echo $country['id']?>"><?php echo $country['countryName']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-default" style="margin-top: 13px;" onclick="search_user()">Search</button>
                                    </div>
                                </form>
                            </div>

                            <div id="userList">
                                <?php $this->load->view('admin/user/user_div');?>
                            </div>    

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

<input type="hidden" id="accToDel" value="">
<script>
    function search_user(){
        $.ajax({
            url: '<?php echo site_url('save_theme'); ?>',
            type: 'POST',
            data: $("#user_search_form").serialize(),
            success: function (data) {
                console.log(data);
                var res = jQuery.parseJSON(data);
                console.log(res);
                $('#theme_div').html(res.themeDiv);
            }
        });
    }

    function search_user(){
        $.ajax({
          url: '<?php echo site_url('save_theme'); ?>',
          type: 'POST',
          data: $("#user_search_form").serialize(),
          success: function (data) {
            console.log(data);
            var res = jQuery.parseJSON(data);
            console.log(res);
            $('#theme_div').html(res.themeDiv);
        }
    });
    }

    /*delete icon click*/
    $('.delAcc').on('click', function(){
        var uId = $(this).closest('tr').attr('id');
        $('#accToDel').val(uId);
    })

</script>


