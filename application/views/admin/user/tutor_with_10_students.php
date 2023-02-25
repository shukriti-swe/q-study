<div class="" style="margin-left: 15px;">
    <div class="row">
        <div class="col-md-4">
            <?php echo $leftnav ?>
        </div>

        <div class="col-md-8">
            <div class="panel-group" id="task_accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#task_accordion" href="#collapseOnetask" aria-expanded="true" aria-controls="collapseOne"> 
                                <span>  Tutor Name </span>
                            </a>
                        </h4>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="table-responsive" >
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Country Name</td>
                                            <td>User Type</td>
                                            <td>User Name</td>
                                            <td>Action</td>
                                        </tr>
                                        <?php foreach ($tutor_with_10_student as $row) {?>
                                        <tr>
                                            <td>
                                                <a>
                                                    <?php echo $row['countryName'];?>                                                    
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $row['userType'];?>
                                            </td>
                                            <td>
                                                <?php echo $row['name'];?>
                                            </td>
                                            <td>

                                            </td>

                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>    

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>


