<style>
  .ss_q_btn {
    margin-top: 21px;
  }
  
  .checkbox,.form-group{
    display: block !important;
    margin-bottom: 10px !important;
  }
  
  .form-control {
    /*width: 100% !important;*/
  }

  .createQuesLabel{
    margin-top: 5px;
  }

  .select2-container .select2-selection--single {
    height: 33px;
    margin-top: 6px;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 30px;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px;
  }
</style>

<div id="add_ch_success" style="text-align:center;"></div>


<form class="form-inline" id="question_form" method="POST" enctype="multipart/form-data">
	<input type="hidden" id="question_item" name="questionType" value="8">
	<input type="hidden" id="country" name="country" value="<?php echo $country; ?>">
	<input type="hidden" id="ansSequence" name="answer" value="none">
	<div class="row" >
		<div class="col-sm-1"></div>
		<div class="col-sm-11 ">
			<div class="ss_question_add_top">
				<p id="error_msg" style="color:red"></p>
			
				<div class="form-group" style="float: left;margin-right: 10px;">
					<label for="exampleInputName2">Grade/Year/Level</label>
					<select class="form-control createQuesLabel" name="studentgrade">
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
						<span data-toggle="modal" data-target="#add_subject">
							<img src="assets/images/icon_new.png"> New
						</span> 
					</label>
					<select class="form-control createQuesLabel select2" name="subject" id="subject" onchange="getChapter(this)">
						<option value="">Select ...</option>
						<?php foreach ($all_subject as $subject) { ?>
						<option value="<?php echo $subject['subject_id'] ?>">
							<?php echo $subject['subject_name']; ?>
						</option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group" style="float: left;margin-right: 10px;">
					<label>Chapter 
					  <span id="get_subject">
					   <img src="assets/images/icon_new.png"> New
					 </span>
				   </label>
				   <select class="form-control createQuesLabel select2" name="chapter" id="subject_chapter">
					<option value="">Select Chapter</option>
				  </select>
				</div>


				<a class="ss_q_btn btn btn_red pull-left" onclick="open_question_setting()">
				  Question setting
				</a>
				<input type="submit" name="submit" class="btn btn-danger ss_q_btn" value="Save"/>

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

				<div class="col-sm-4">
					<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
					  <div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne1">
						  <h4 class="panel-title">
							<a role="button" aria-expanded="true" aria-controls="collapseOne">
							  <!-- <span onclick="setSolution()">
								<img src="assets/images/icon_solution.png"> Solution
							  </span> -->
							   Question
							</a>
						  </h4>
						</div>
						<div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne1">
						  <textarea class="form-control" id="assignment_textarea" name="question_body" ></textarea>
						</div>
					  </div>


					</div>
				</div>

				<!-- <div class="col-sm-4">
					<div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
					  <div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
						  <h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">   Answer</a>
						  </h4>
						</div>
						<div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						  <textarea name="answer" class="mytextarea"></textarea>
						</div>
					  </div>
					</div>
				</div> -->

				<div class="col-sm-4">

					<div class="panel-group ss_edit_q" id="raccordion" role="tablist" aria-multiselectable="true" style="display: none;">
						<div class="form-inline" style="border: 1px solid #ddd;">
							<div class="form-group" style="line-height: 43px;min-height: 46px;text-align: center;">
								<label>How many rows</label>
								<input type="number" id="tblRowsInput" class="form-control" min="1"  value="1">
							</div>
						</div>


						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<a> 
									  <label class="form-check-label" for="question_time">Question Time</label> 
									  <input type="checkbox" name="" disabled="">  
									  Calculator Required <input type="checkbox" name="isCalculator" value="1" disabled=""> 
									  Score <input type="checkbox" name="">
									</a>
								</h4>
							</div>
							<div id="collapsethree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="ss_module_result">
									<p>Module Name:</p>
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>    
											  <tr>
												<th>SL</th>
												<th>Mark</th>
												<!--<th>Obtained</th>-->
												<th>Description </th>
											  </tr>
											</thead>
											<tbody id="assListTbl">
												<tr id="1">
													<td>1</td>
													<td onclick="setMark()" class="marksModal" id="marks1">
													  <img src="assets/images/icon_mark.png" id="mark_icon">
													  <input type="text" class="form-control" id="marks" name="qMark[]" value="" readonly="" style="display: none;">
													</td>
													<td style="display: none;"><input type="text" class="form-control" id="marks_hid_1" name="qMark[]" value="" readonly="" style="display: none;"></td>
													<td><a href="" data-toggle="modal" data-target="#ss_description_model" class="text-center descModOpenBtn"><img src="assets/images/icon_details.png"></a></td>
													<input type="hidden" value="" name="descriptions[]" class="hiddenQuesDesc" required>
												</tr>
											</tbody>
										</table>

									</div>

									<p><strong> Total Mark:</strong></p>
								<!--<form class="form-inline ss_common_form" id="set_time" style="display: none">-->
									<div class="form-inline" id="set_time" style="display: none">
										<div class="form-group" style="display: inline-block !important;">
											<select class="form-control" name="hour">
											  <option>HH</option>
												<?php for ($i = 0; $i < 24; $i++) { ?>
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
												<?php for ($i = 0; $i < 60; $i++) { ?>
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
												<?php for ($i = 0; $i < 60; $i++) { ?>
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


<!--Set Question Solution-->

	<div class="modal fade ss_modal" id="set_solution" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document" style="max-width: 400px;">
			<div class="modal-content">
			  <div class="modal-header">

				<h4 class="modal-title" id="myModalLabel">Solution</h4>
			  </div>
			  <div class="modal-body row">
				<textarea class="mytextarea" name="question_solution"></textarea>

			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn_blue" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn_blue" data-dismiss="modal">Save</button>
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
          <div class="row">
            <div class="col-xs-4 sh_input">
              <!-- <input type="number" class="form-control" name="first_digit"> -->
              <input type="hidden" class="form-control" name="first_digit" value="0">
              <input type="hidden" id="mark_serial" value="">
            </div>
            <div class="col-xs-4 sh_input">
              <input type="number" class="form-control" name="second_digit">
            </div>
            <div class="col-xs-4">
              <input type="number" class="form-control" name="second_digit">
              <input type="number" class="form-control" name="second_digit">
            </div>
          </div>
          
          
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_blue" onclick="markData()">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- question save success modal -->
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

<!-- question details modal -->
<div class="modal fade ss_modal ew_ss_modal" id="ss_description_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Question Description </h4>
      </div>
      <div class="modal-body">
        <form>

          <div class="form-group">
            <label for="quesDesc" class="text-muted">Description</label>
            <textarea class="form-control mytextarea" id="quesDescFromMod" ></textarea>
            <input class="form-control" type="hidden" id="quesSlOnMod" value="">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="quesDescSubmitBtn" class="btn btn-primary">OK</button>
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
              var data = jQuery.parseJSON(response);
              console.log(data.flag);
              $("#error_msg").text('');
              if(data.flag == 1){
                $("#preview_btn").show();
                        $("#preview_btn").attr("href", pathname+'question_preview/'+question_item+'/'+data.question_id);//today 20/7/18
                        $("#ss_sucess_mess").modal('show');
                      }if(data.flag == 0){
                        $("#error_msg").text(data.msg);
                      }
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
		var data = $("#add_subject_wise_chapter").serializeArray();
		console.log(data[0].value);
		if(data[0].value == ''){
			var response = '<p style="color: red;">Please Select Subject</p>';
			$('#chapter_error').html(response);
		} else if(data[1].value == '') {
			var response = '<p style="color: red;">Chapter Field Can Not Be Empty</p>';
			$('#chapter_error').html(response);
		} else {
			$.ajax({
				url: "add_chapter",
				method: "POST",
				dataType: 'html',
				data: data,
				success: function (response) {
					$('#add_ch_success').html('Chapter added successfully');
					$('#add_chapter').modal('hide');
					$('#subject_chapter').html(response);
				}
			});
		}
	}
  
  
	function setMark(){
		$("#set_marks").modal('show');
	}
  
    function markData(){
        var marks = $("#marksValue").serializeArray();
        var serial = $("#mark_serial").val();
        var first_digit = marks[0].value;
        var second_digit = marks[1].value;
        first_digit = first_digit.length ? first_digit : 0;
        second_digit = second_digit.length ? second_digit : 0;
        var number = "" + first_digit + second_digit;

        var first_fraction_digit = marks[2].value;
        var second_fraction_digit = marks[3].value;
        first_fraction_digit = first_fraction_digit.length ? first_fraction_digit : 1;
        second_fraction_digit = second_fraction_digit.length ? second_fraction_digit : 1;
        
        if(first_fraction_digit > second_fraction_digit) {
            alert('Numerator can not be bigger than denominator');
        } else {
            var decimal_digit = parseInt(number) + parseFloat(first_fraction_digit / second_fraction_digit);
            if(first_fraction_digit == second_fraction_digit){
                decimal_digit = parseInt(number) * parseFloat(first_fraction_digit / second_fraction_digit);
            }
            decimal_digit = decimal_digit.toFixed(2);
            $("#marks"+serial).html(decimal_digit) ;
            $("#marks_hid_"+serial).val(decimal_digit);//hidden marks value(qMark);
            $("#mark_icon"+serial).hide() ;
            $("#marks"+serial).show() ;

            $('#set_marks').modal('hide');
        }
    }
</script>

<script>
    $(document).ready(function () {

        CKEDITOR.replace('assignment_textarea',{
			extraPlugins : 'simage,spdf,sdoc,ckeditor_wiris,sppt',
			filebrowserBrowseUrl: '/assets/uploads?type=Images',
			filebrowserUploadUrl: 'imageUpload',
			toolbar: [
				{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
				{ name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage','SPdf','SDoc','SPpt' ] },
				'/',
					{ name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'Image', 'addFile'] }, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
				// Line break - next group will be placed in new line.
				'/',
				{ name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
				{ name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
            ]
        });
        
        
    });

    //number of assignment(input rows functionality)
    $('#tblRowsInput').on('input', function () {
		var inptRows = $(this).val();
		var tblRows = '';
		for (var a = 1; a <= inptRows; a++) {
			tblRows += '<tr id="' + a + '">';
			tblRows += '<td>' + a + '</td>';
			tblRows += '<td onclick="setMark('+ a +')" id="marks'+a+'" class="marksModal">\n\
			<img src="assets/images/icon_mark.png" id="mark_icon'+ a +'"></td>';
			tblRows += '<td style="display:none;"><input type="number" class="form-control" id="marks_hid_'+a+'" name="qMark[]" value="" readonly="" style="display: none;"></td>';
			
				//tblRows += '<td><input name="obtnMark[]" class="form-control col-2 input-sm obtnMarkInp" type="" step="0.1"></td>';
				//tblRows += '<td></td>';
				tblRows += '<td>\n\
				<a data-toggle="modal" data-target="#ss_description_model" class="text-center descModOpenBtn">\n\
				<img src="assets/images/icon_details.png">\n\
				</a>\n\
			</td>';
			tblRows += '<input type="hidden" value="" name="descriptions[]" class="hiddenQuesDesc" required>';
			tblRows += '</tr>';
        }

        $('#assListTbl').html(tblRows);
    });

    $(document.body).on('input', '.markInp', function () {
      var inputVal = $(this).val();
      var hiddenItem = $(this).closest('tr').children('.valToIns');
      var hiddenVal = hiddenItem.val();
      var newField = inputVal;
      hiddenItem.val(hiddenVal + 'mark:' + newField);
    });

    /*set question serial on description modal*/
    $(document).on('click', '.descModOpenBtn', function () {
      var quesSl = $(this).closest('tr').attr('id');
      console.log(quesSl);
      var hiddenQuesDesc = $('tr#' + quesSl).find('input.hiddenQuesDesc').val();
      $('#quesDescFromMod').val(hiddenQuesDesc);

      $('#quesSlOnMod').val(quesSl);
    });
    
    /*set question description on hidden input field*/
    $(document.body).on('click', '#quesDescSubmitBtn', function () {
      var quesSlFromMod = $('#quesSlOnMod').val();
      var quesDescFromMod = $('#quesDescFromMod').val();
      var hiddenQuesDesc = $('tr#' + quesSlFromMod).find('input.hiddenQuesDesc').val(quesDescFromMod);
      $('#ss_description_model').modal('toggle');
    })
    
    /*set question serial on description modal*/
    $(document.body).on('click', '.marksModal', function () {
      var markSerial = $(this).closest('tr').attr('id');

      $('#mark_serial').val(markSerial);
    });


</script>
