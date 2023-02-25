<div class="container top100">
    <div class="row">
        <div class="ss_student_progress">
            <div class="search_filter">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="exampleInputName2">Country</label>
                        <div class="select">
                            <input class="form-control" value="<?php echo $user_info[0]['countryName'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        
                        <label for="exampleInputName2">Grade/Year/Lavel</label>
                        <div class="select">
                            <select class="form-control select-hidden">
                                <option value="">Select Grade/Year/Level</option>
                                <?php $grades = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; ?>
                                <?php foreach ($grades as $grade) { ?>
                                    <option value="<?php echo $grade ?>">
                                        <?php echo $grade; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">Module Type</label>
                        <div class="select">
                            <select class="form-control select-hidden">
                                <option>Select....</option>
                                <?php foreach ($all_module_type as $module_type){?>
                                    <option value="<?php echo $module_type['id']?>">
                                        <?php echo $module_type['module_type'];?>
                                    </option>
                                <?php }?>
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">Subject</label>
                        <div class="select">
                            <select class="form-control select-hidden">
                                <option>Select....</option>
                                <?php foreach ($all_course as $course){?>
                                    <option value="<?php echo $course['id']?>">
                                        <?php echo $course['courseName'];?>
                                    </option>
                                <?php }?>
                            </select>

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn_green"><i class="fa fa-search"></i>  Search</button>
                    </div>
                    <div class="form-group">
                        <a href="add-module">
                            <button type="button" class="btn btn_orange">
                                <i class="fa fa-file"></i>  Add New
                            </button>
                        </a>
                    </div>
                    <button type="submit" class="btn btn_green">Re-Order</button>
                </form>
            </div>
        </div>

        <div class="sign_up_menu">
            <div class="table-responsive">
                <table class="table table-bordered" id="module_setting">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Module Name</th>
                            <th>Module Type</th>
                            <th>Duplicate</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_module as $module){?>
                        <tr>
                            <td>1</td>
                            <td>Austrolis</td>
                            <td>Everyday Study</td>
                            <td><i class="fa fa-pencil" style="color:#4c8e0c;"></i></td>
                            <td><i class="fa fa-pencil" style="color:#4c8e0c;"></i></td>
                            <td><i class="fa fa-times" style="color:#4c8e0c;"></i></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>