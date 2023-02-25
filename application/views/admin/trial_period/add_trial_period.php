<style>
    label {
        font-size: 13px;
    }

    .user_list {
        border-color: #2F91BA;
    }

    .panel-default > .panel-heading{
        background-color: #FCF8E3 !important;
    }

</style>

<div class="" style="margin-left: 15px;">
    <div class="row">
        <div class="col-md-4">
            <?php echo $leftnav ?>
        </div>
        
        <?php if ($this->session->flashdata('success_msg')) : ?>
            <div class="col-md-8" id="flashmsg">
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success_msg'); ?>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="col-md-8 user_list">
            <div class="panel-group " id="task_accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title text-center">
                            <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                                <strong><span style="font-size : 18px;">  Add Trial Period </span></strong>
                            </a>
                        </h4>
                    </div>

                    <form class="form-horizontal" action="trial_period" method="POST">
                        <div class="row panel-body">
                            <div class="col-sm-12 text-right">
                                <button type="button" class="btn btn_next" id="" onclick = "location.reload(true)"><i class="fa fa-times" style="padding-right: 5px;"></i>Cancel</button>
                                <button type="submit" class="btn btn_next" id="">
									<i class="fa fa-plus" style="padding-right: 5px;"></i>Save
								</button>
                            </div>
                        </div>

                        <!-- faq submit form -->  
                        <div class="row panel-body">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Days:</label>
                                    <div class="col-sm-4">
                                        <input type="text" minimum="1" class="form-control" placeholder="Days" name="days" value="<?php if(isset($trial_configuration[1])) {echo $trial_configuration[1]['setting_value'];}?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Unlimited:</label>
                                    <div class="col-sm-4">
                                        <!--<input type="text" minimum="1" class="form-control" id="year" placeholder="Date" name="year" value="">-->
                                         <div class="checkbox">
                                          <label>
                                            <input type="checkbox" name="unlimited" value="1" <?php if(isset($trial_configuration[0]) && $trial_configuration[0]['setting_value'] == 1){echo 'checked';}?>>
                                          </label>
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



<!-- 
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
<script>

    $('#flashmsg').fadeOut(5000);
    $('#date').datepicker({
        multidate: true,
        todayHighlight: true,
    });
    $('#year').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        defaultViewDate: 'year',
        autoclose: true,
    });
</script>
