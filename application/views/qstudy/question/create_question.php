<style>
    .ss_q_btn {
        margin-top: 16px;
    }
    
    .checkbox,.form-group{
        display: block !important;
        margin-bottom: 10px !important;
    }
    
    .form-control {
        width: 100% !important;
    }
</style>
<div id="add_ch_success" style="text-align:center;">
</div>
<form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data">
    <input type="hidden" id="question_item" name="questionType" value="<?php echo $question_item; ?>">
    <div class="row" >
        <div class="col-sm-1"></div>
        <div class="col-sm-11 ">
            <div class="ss_question_add_top">
                <div class="form-group" style="float: left;margin-right: 10px;">
                    <label for="exampleInputName2">Grade/Year/Level</label>
                    <select class="form-control" name="studentgrade">
                        <option value="">Select Grade/Year/Level</option>
                        <?php $grades = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; ?>
                        <?php foreach ($grades as $grade) { ?>
                            <option value="<?php echo $grade ?>">
                                <?php echo $grade; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group" style="float: left;margin-right: 10px;">
                    <label>Subject 
                        <span data-toggle="modal" data-target="#add_subject" style="color: #c82a2a;font-size: 12px;">
                            <img src="assets/images/icon_new.png"> New
                        </span> 
                    </label>
                    <select class="form-control" name="subject" id="subject" onchange="getChapter(this)">
                        <option value="">Select ...</option>
                        <?php foreach ($all_subject as $subject) { ?>
                            <option value="<?php echo $subject['subject_id'] ?>">
                                <?php echo $subject['subject_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group ee" style="float: left;margin-right: 10px;">
                    <label>Chapter 
                        <span id="get_subject" style="color: #c82a2a;font-size: 12px;">
                            <img src="assets/images/icon_new.png"> New
                        </span>
                    </label>
                    
                    <select class="form-control" name="chapter" id="subject_chapter">
                        <option value="">Select Chapter</option>
                    </select>
                </div>


                <a class="ss_q_btn btn btn_red pull-left" onclick="open_question_setting()">
                    Question setting
                </a>
                <input type="submit" name="submit" class="btn btn-danger ss_q_btn" value="Save"/>
<!--                <a class="ss_q_btn btn pull-left" onclick="">
                    <i class="fa fa-save" aria-hidden="true"></i> Save
                </a>-->
                <!--<a class="ss_q_btn btn pull-left" href="#" data-toggle="modal" data-target="#ss_sucess_mess"><i class="fa fa-save" aria-hidden="true"></i> Save</a>-->
                <a class="ss_q_btn btn pull-left" href="#"><i class="fa fa-remove" aria-hidden="true"></i> Cancel</a>
                
                <a class="ss_q_btn btn pull-left" href="" id="preview_btn" style="display: none;">
                    <i class="fa fa-file-o" aria-hidden="true"></i> Preview
                </a>
            </div>

        </div>

    </div>
    <div class="row">
        <div class="ss_question_add">
            <div class="ss_s_b_main" style="min-height: 100vh">
                
                <?php echo $question_box; ?>
                
                <div class="col-sm-4">
                    <div class="panel-group ss_edit_q" id="raccordion" role="tablist" aria-multiselectable="true" style="display: none;">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a> 
                                        <label class="form-check-label" for="question_time" style="font-weight: 600;">Question Time</label> 
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
                                                        <td onclick="setMark()" class="inner">
                                                            <img src="assets/images/icon_mark.png" id="mark_icon">
                                                            <input type="text" class="form-control" id="marks" name="questionMarks" value="" readonly="" style="display: none;">
                                                        </td>
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
                                        <div class="form-inline" id="set_time" style="display: none">
                                            <div class="form-group" style="display: inline-block !important;">
                                                <select class="form-control" name="hour">
                                                    <option>HH</option>
                                                    <?php for ($i = 1; $i < 24; $i++) { ?>
                                                        <option>
                                                            <?php
                                                            $value = $i;
                                                            if ($i < 24) {
                                                                echo str_pad($i, 2, "0", STR_PAD_LEFT);
                                                            }
                                                            ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group" style="display: inline-block !important;">
                                                <select class="form-control" name="minute">
                                                    <option>MM</option>
                                                        <?php for ($i = 1; $i < 60; $i++) { ?>
                                                        <option>
                                                            <?php
                                                            if ($i < 60) {
                                                                echo str_pad($i, 2, "0", STR_PAD_LEFT);
                                                            }
                                                            ?>
                                                        </option>
                                                        <?php } ?>

                                                </select>
                                            </div>
                                            <div class="form-group" style="display: inline-block !important;">
                                                <select class="form-control" name="second">
                                                    <option>SS</option>
                                                        <?php for ($i = 1; $i < 60; $i++) { ?>
                                                        <option>
                                                            <?php
                                                            if ($i < 60) {
                                                                echo str_pad($i, 2, "0", STR_PAD_LEFT);
                                                            }
                                                            ?>
                                                        </option>
                                                        <?php } ?>

                                                </select>
                                            </div>
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



<!--Set Question Marks-->
<div class="modal fade ss_modal" id="set_marks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <div class="modal-body row">
                <form id="marksValue">
                    <input type="number" class="form-control" name="first_digit">
                    <input type="number" class="form-control" name="second_digit">
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" onclick="markData()">Save</button>
            </div>
        </div>
    </div>
</div>


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
            <div id="chapter_error"></div>
            
            <div class="modal-body">
                <form class="" id="add_subject_wise_chapter">
                    
                    <div class="form-group">
                        <label for="attached_subject"></label>
                        <input type="hidden" class="form-control" name="attached_subject" id="attached_subject">
                    </div>
                    <div class="form-group">
                        <label for="chapter">Chapter Name</label>
                        <input class="form-control" name="chapter" id="chapter">
                    </div>

                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" onclick="add_chapter()" class="btn btn_blue">Save</button>
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

<!--Set Question Solution-->

<div class="modal fade ss_modal" id="set_solution" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Solution</h4>
            </div>
            <div class="modal-body row">
                <form id="marksValue">
                    <textarea class="mytextarea" name="question_solution"></textarea>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>


<script>
    function setSolution() {
        $("#set_solution").modal('show');
    }
</script>


<script>
    $(document).ready(function(e){
        // Variable to store your files
        var files;

        // Add events
        $('input[type=file]').on('change', prepareUpload);

        // Grab the files and set them to our variable
        function prepareUpload(event) {
          files = event.target.files;
        }
        
        $("#question_form").on('submit', function(e){
            e.preventDefault();
            
            var pathname = '<?php echo base_url(); ?>';
            var question_item = document.getElementById('question_item').value;
            
            CKupdate();
            $.ajax({
                url: "save_question_data",
                type: "POST",
                data: new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                success: function (response) {
//                    console.log(response);
                    $("#preview_btn").show();
                    $("#preview_btn").attr("href", pathname+'question_preview/'+question_item+'/'+response);//today 20/7/18
                    $("#ss_sucess_mess").modal('show');
                }
            });
        });
    });

    function CKupdate() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }

    function add_subject() {
        $.ajax({
            url: "add_subject_name",
            method: "POST",
            data: $("#add_subject_name").serialize(),
            success: function (response) {
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
            success: function (response) {
//                $('#add_subject').modal('hide');
//                console.log(response);
                $('#subject_chapter').html(response);
            }
        });
    }

    function open_question_setting() {
        $("#raccordion").show();
    }
    
    $('#get_subject').click(function () {
        
        var subject_id = document.getElementById('subject').value;
        document.getElementById("attached_subject").value = subject_id;
        $('#add_chapter').modal('show');
    });
    function add_chapter() {
        var data = $("#add_subject_wise_chapter").serialize();
        $.ajax({
            url: "add_chapter",
            method: "POST",
            dataType: 'html',
            data: data,
            success: function (response) {
                if (response == 1) {
                    $('#add_ch_success').html('Chapter added successfully');
                    $('#add_chapter').modal('hide');
                } else {
                    $('#chapter_error').html(response);

                }
            }
        });
    }
    
    
    function setMark(){
        $("#set_marks").modal('show');
    }
    
    function markData(){
        var marks = $("#marksValue").serializeArray();
//        console.log(marks);
        var first_digit = (marks[0].value);
        var second_digit = (marks[1].value);
        $("#marks").val(first_digit+second_digit) ;
        $("#mark_icon").hide() ;
        $("#marks").show() ;
        
        $('#set_marks').modal('hide');
    }
</script>