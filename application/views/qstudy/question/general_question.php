<style>
    .ss_q_btn {
        margin-top: 16px;
    }
</style>

<form class="form-inline" id="question_form">
    
    <input type="hidden" name="questionType" value="1">
    
    <div class="row" >
        <div class="col-sm-1"></div>
        <div class="col-sm-11 ">
            <div class="ss_question_add_top">

                    <div class="form-group" style="float: left;margin-right: 10px;">
                        <label for="exampleInputName2">Grade/Year/Level</label>
                        <select class="form-control" name="studentgrade">
                            <option value="">Select Grade/Year/Level</option>
                            <?php foreach ($all_grade as $grade){?>
                                <option value="<?php echo $grade['id']?>">
                                    <?php echo $grade['grade'];?>
                                </option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="form-group" style="float: left;margin-right: 10px;">
                        <label>Subject <span data-toggle="modal" data-target="#add_subject"><img src="assets/images/icon_new.png"> New</span> </label>
                        <select class="form-control" name="subject" id="subject" onchange="getChapter(this)">
                            <option>Select ...</option>
                            <?php foreach ($all_subject as $subject) {?>
                            <option value="<?php echo $subject['subject_id']?>">
                                    <?php echo $subject['subject_name'];?>
                                </option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="form-group" style="float: left;margin-right: 10px;">
                        <label>Chapter <span data-toggle="modal" data-target="#add_chapter"><img src="assets/images/icon_new.png"> New</span></label>
                        <select class="form-control" name="chapter" id="subject_chapter">
                            <option>Select Chapter</option>
                        </select>
                    </div>


                <a class="ss_q_btn btn btn_red pull-left" onclick="open_question_setting()">
                    Question setting
                </a>
                
                <a class="ss_q_btn btn pull-left" onclick="save_question_data()">
                    <i class="fa fa-save" aria-hidden="true"></i> Save
                </a>
                <!--<a class="ss_q_btn btn pull-left" href="#" data-toggle="modal" data-target="#ss_sucess_mess"><i class="fa fa-save" aria-hidden="true"></i> Save</a>-->
                <a class="ss_q_btn btn pull-left" href="#"><i class="fa fa-remove" aria-hidden="true"></i> Cancel</a>
                <a class="ss_q_btn btn pull-left" href="#"><i class="fa fa-file-o" aria-hidden="true"></i> Preview</a>
            </div>

        </div>

    </div>
    <div class="row">
        <div class="ss_question_add">
            <div class="ss_s_b_main" style="min-height: 100vh">
                <div class="col-sm-4">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_solution.png"> Solution</span> Question</a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <textarea id="mytextarea" name="questionName"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-4">
                    <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">   Answer</a>
                                </h4>
                            </div>
                            <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <textarea name="answer"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="panel-group ss_edit_q" id="raccordion" role="tablist" aria-multiselectable="true" style="display: none;">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a> 
                                        <label class="form-check-label" for="">Question Time</label> 
                                        <input type="checkbox" id="question_time" name="">  
                                        Calculator Required <input type="checkbox" name="isCalculator" value="1"> 
                                        Score <input type="checkbox" name="">
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsethree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class=" ss_module_result">
                                        <p>Module Name:</p>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>    
                                                    <tr>
                                                        <th></th>
                                                        <th>SL</th>
                                                        <th>Mark</th>
                                                        <th>Obtained</th>
                                                        <th>Description </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td> </td>
                                                        <td>1</td>
                                                        <td><img src="assets/images/icon_mark.png"></td>
                                                        <td>5.0</td>
                                                        <td><a href="" data-toggle="modal" data-target="#ss_description_model" class="text-center"><img src="assets/images/icon_details.png"></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade ss_modal ew_ss_modal" id="ss_description_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea class="form-control" name="questionDescription"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <p><strong> Total Mark:</strong></p>
                                        <!--<form class="form-inline ss_common_form" id="set_time" style="display: none">-->
                                            <div class="form-group">
                                                <select class="form-control" name="hour">
                                                    <option>HH</option>
                                                    <?php for ($i = 1;$i < 24; $i++){?>
                                                    <option>
                                                        <?php 
                                                        $value = $i;
                                                            if ($i < 24) {
                                                                echo str_pad($i, 2, "0", STR_PAD_LEFT);
                                                        }?>
                                                    </option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" name="minute">
                                                    <option>MM</option>
                                                    <?php for ($i = 1;$i < 60; $i++){?>
                                                    <option>
                                                        <?php 
                                                            if ($i < 60) {
                                                                echo str_pad($i, 2, "0", STR_PAD_LEFT);
                                                        }?>
                                                    </option>
                                                    <?php }?>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" name="second">
                                                    <option>SS</option>
                                                    <?php for ($i = 1;$i < 60; $i++) { ?>
                                                    <option>
                                                        <?php 
                                                            if ($i < 60) {
                                                                echo str_pad($i, 2, "0", STR_PAD_LEFT);
                                                        }?>
                                                    </option>
                                                    <?php }?>

                                                </select>
                                            </div>
                                            <br/>
                                            <!--<button type="submit" class="btn btn_next">Save</button>-->
                                        <!--</form>-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</form>


<div class="modal fade ss_modal" id="ss_sucess_mess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
                <img src="assets/images/icon_info.png" class="pull-left"> <span class="ss_extar_top20">Save Sucessfully</span> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Ok</button>

            </div>
        </div>
    </div>
</div>

<!--Add Chapter Modal-->

<div class="modal fade ss_modal" id="add_chapter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Chapter</h4>
            </div>
            <div class="modal-body">
                <form class="">
                    <div class="form-group">
                        <label>Add Chapter</label>
                        <input class="form-control" name="chapter">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>

<!--Add Subject Modal-->

<div class="modal fade ss_modal" id="add_subject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add New Subject</h4>
            </div>
            <form class="" id="add_subject_name">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Add Subject</label>
                        <input type="text" class="form-control" name="subject_name">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" onclick="add_subject()" class="btn btn_blue">Save</button>
                    <button type="button" class="btn btn_blue" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function save_question_data() {
        var form = $("#question_form");
        tinyMCE.triggerSave();
        $.ajax({
            url: "save_question_data",
            method: "POST",
            data: form.serialize(),
            success: function(response){
//                console.log(response);
                tinyMCE.activeEditor.setContent('');
                $("#ss_sucess_mess").modal('show');
            }
        });
    }
    
    function add_subject() {
        $.ajax({
            url: "add_subject_name",
            method: "POST",
            data: $("#add_subject_name").serialize(),
            success: function(response){
                $('#add_subject').modal('hide');
//                console.log(response);
                $('#subject').html(response);
            }
        });
    }
    
    function getChapter(e) {
        var subject_id = e.value;
        $.ajax({
            url: "get_chapter_name",
            method: "POST",
            data: {
                subject_id: subject_id
            },
            success: function(response){
//                $('#add_subject').modal('hide');
//                console.log(response);
                $('#subject_chapter').html(response);
            }
        });
    }
    
    function open_question_setting() {
        $("#raccordion").show();
    }
    
    
</script>