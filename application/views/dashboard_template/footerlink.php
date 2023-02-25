
<!-- Modal -->
<div class="modal fade qstudy_module_video_modal" id="qstudy_module_video_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qstudy_module_video_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div> 
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/lib/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/lib/css3-animate-it.js"></script>
<script src="<?php echo base_url(); ?>assets/js/lib/counter.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/main.js"></script> -->

<script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/config.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/styles.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/lightbox.js"></script>



<script>
	$('.modal-dialog').draggable({
        "handle":".modal-header"
    });

	$('.faq_textarea').ckeditor({
		height: 200,
		extraPlugins : 'simage, ckeditor_wiris,svideo,youtube',
		filebrowserBrowseUrl: '/assets/uploads?type=Images',
		filebrowserUploadUrl: 'imageUpload',
		toolbar: [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
		'/',
		{ name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'addFile','SVideo', 'Youtube'] },
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
		{ name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
		],
		allowedContent: true
	});

	$('.mytextarea').ckeditor({
		height: 200,
		extraPlugins : 'simage, ckeditor_wiris',
		filebrowserBrowseUrl: '/assets/uploads?type=Images',
		filebrowserUploadUrl: 'imageUpload',
		toolbar: [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
		'/',
		{ name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'addFile'] },
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
		{ name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
		],
		allowedContent: true
	});

	$('.mytextareanew').ckeditor({
		height: 50,
		extraPlugins : 'simage, ckeditor_wiris',
		filebrowserBrowseUrl: '/assets/uploads?type=Images',
		filebrowserUploadUrl: 'imageUpload',
		toolbar: [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
		'/',
		{ name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'addFile'] },
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
		{ name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
		],
		allowedContent: true
	});
	

	$('.mytextarea_patern_two').ckeditor({
		height: 90,
		extraPlugins : 'simage, ckeditor_wiris',
		filebrowserBrowseUrl: '/assets/uploads?type=Images',
		filebrowserUploadUrl: 'imageUpload',
		toolbar: [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
		'/',
		{ name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'addFile'] },
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
		{ name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
		],
		allowedContent: true
	});
	$('.mytextareaQuestion').ckeditor({
		height: 200,
		extraPlugins : 'simage, ckeditor_wiris',
		filebrowserBrowseUrl: '/assets/uploads?type=Images',
		filebrowserUploadUrl: 'imageUpload',
		toolbar: [
		//{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		//{ name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
		'/',
		//{ name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'addFile'] },
		'/',
		//{ name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
		{ name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
		],
		allowedContent: true
	});
  
	$('.vocubulary_image').ckeditor({
		height: 60,
		extraPlugins : 'simage',
		filebrowserBrowseUrl: '/assets/uploads?type=Images',
		filebrowserUploadUrl: 'imageUpload',
		toolbar: [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
		'/',
		{ name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'addFile'] }, 
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] }
		],
		allowedContent: true
	});
  
	$('.assignment_textarea').ckeditor({
		extraPlugins : 'spdf,simage,sdoc,ckeditor_wiris',
		filebrowserBrowseUrl: '/assets/uploads?type=Images',
		filebrowserUploadUrl: 'imageUpload',
		toolbar: [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage','SPdf','SDoc' ] },
		'/',
		{ name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'addFile'] },
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
		{ name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
		],
		allowedContent: true
	});
  
	$('.multiple_choice_textarea').ckeditor({
		height: 80,
		extraPlugins : 'simage,ckeditor_wiris',
		filebrowserBrowseUrl: '/assets/uploads?type=Images',
		filebrowserUploadUrl: 'imageUpload',
		toolbar: [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview','Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
		'/',
		{ name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','-', 'Templates','Link', 'addFile'] },
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
		{ name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
		],
		allowedContent: true
	});
  
	$('.my_preview_textarea').ckeditor({
		height: 115,
		extraPlugins : 'simage,ckeditor_wiris',
		filebrowserBrowseUrl: '/assets/uploads?type=Images',
		filebrowserUploadUrl: 'imageUpload',
		toolbar: [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
		'/',
		{ name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','Table','-', 'Templates','Link', 'addFile'] },
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
		{ name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
		],
		allowedContent: true
	});
  
	$('.course_textarea').ckeditor({
		height: 50,
		extraPlugins : 'simage,ckeditor_wiris',
		filebrowserBrowseUrl: '/assets/uploads?type=Images',
		filebrowserUploadUrl: 'imageUpload',
		toolbar: [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'NewPage', 'Preview', 'Print','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic','Underline','Strike','Subscript', 'Superscript', '-', 'SImage' ] },
		'/',
		{ name: 'document', items: [ 'RemoveFormat','Maximize', 'ShowBlocks','TextColor', 'BGColor','Table','-', 'Templates','Link', 'addFile'] },  
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format','Font','FontSize'] },
		{ name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry'] }
		],
		allowedContent: true
	});
	
	$('.student_assignment_textarea').ckeditor({
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
        ],
        allowedContent: true
    });

	$('.imageQuiztextarea').ckeditor({
		customConfig: '<?= base_url()?>/assets/ckeditor/custom_config.js',
		height: 200,
		extraPlugins : 'simage, ckeditor_wiris',
		filebrowserBrowseUrl: '/assets/uploads?type=Images',
		filebrowserUploadUrl: 'imageUpload',
		toolbar: [
		{ name: 'wiris', items: [ 'ckeditor_wiris_formulaEditor'] }
		],
		allowedContent: true
	});
  
    // $('.vocubulary_image').ckeditor({
        // height: 80,
        // filebrowserBrowseUrl: '/assets/uploads?type=Images',
        // filebrowserUploadUrl: 'imageUpload',
        // allowedContent: true,
    // });

    $(document).ready(function () {
		
		$('.no_instruction_click').click(function(){
    		$('.no_instruction').show();

		     setTimeout(function() {
		         $(".no_instruction").hide('blind', {}, 500)
		     }, 3000);
    	});
    	$('.qstudy_module_video .header span').click(function(){

    		$(".qstudy_module_video").hide();
    	});
    	$('.qstudy_Instruction_click').click(function(){

    		$(".qstudy_module_video").show();
    	});
    	$('.qmv_show').click(function(){
    		var video_id = $(this).attr('video_id');
    		if (video_id)
	        {
	        	$('.progress').show();
	        	$.ajax({
	                url:"<?php echo base_url(); ?>Module/qstudy_module_video_preview",
	                type:"post",
	                dataType:'json',
	                data:{video_id:video_id},
	                success:function(data){
	                    $('.progress').hide();
	                    $("#qstudy_module_video_title").html(data.title);
	                    $("#qstudy_module_video_modal .modal-body").html(data.content);
	                    $(".qstudy_module_video_modal").modal('show');
	                }
            	});
	        }
    		
    	});
    	$('#qstudy_module_video_modal').on('hidden.bs.modal', function (e) {
			var x = document.getElementById("qsi_video");
			if ( x ) {
				x.pause();
			}
		});
		
		$('#question_time').click(function () {
			if ($(this).is(':checked'))
				$("#set_time").show();
			else
				$("#set_time").hide();
		});
		$('.ss_bottom_s_course .select').on('click', function () {
			$(this).parent().find('div.active').removeClass('active');
			$(this).addClass('active');
		});
      
		if($('.select2').length){
					$('.select2').select2({

		});
	}
    });
</script>
<script>
    function chkLoginAccess() {

		var pathname = '<?php echo base_url(); ?>';
		var user_name = $("#user_name").val();
		var password = $("#password").val();
		$.ajax({
			type: 'POST',
			url: 'loginChk',
			data: {
			user_name: user_name,
			password: password
			},
			dataType: 'html',
			success: function (results) {
			if (results == 0) {
				$("#error_msg").show();
			}
			if (results == 1) {
				window.location.href = pathname + "dashboard";
			}
			if (results == 2) {
				window.location.href = pathname + "dashboard";
			}
	
			}
		});

    }

    $('#flashmsg').fadeOut(5000);

    /*calculator*/
    $(window).load(function(){
		console.log($.calculator);

		$('#scientificCalc').calculator({
		//layout: $.calculator.scientificLayout,
		showOn: 'button',
		buttonImageOnly: true, 
		buttonImage: 'img/calculator.jpg'
		});
	})

		

  </script>
  <!--<script src="https://code.responsivevoice.org/responsivevoice.js"></script>-->
  <script src="https://code.responsivevoice.org/responsivevoice.js?key=Hc1ClBY9"></script>
<script>
    var question_id ;
    $(".show_tutorial_modal").click(function () {
        var modalId = $(this).attr('modalId');
        var Order = $(this).attr('Order');
        question_id = $(this).attr('question_id');
        var url = '<?php echo base_url(); ?>Module/tutorial_master_view/'+question_id;
        console.log(question_id);
        console.log(url);
        $.ajax({
            url:url,
            type:"post",
            dataType:'html',
            success:function(data){
                // console.log(data);
                $('#img_show').html(data);
                $("#myCarousel .carousel-inner .item:first").addClass( 'active' );
                $('.tutorialModalMaster').modal('show');
                $('#myCarousel').carousel({
                    pause: true,
                    interval: false
                });
                var word =  $("#myCarousel .item.active").attr("id");
                speak(word);
                console.log(word);
            }
        });
    });
    function speak(word) {
		if (word =='none')
        {
            return true;
        }
        responsiveVoice.speak(word);
    }
	
	$('.question_tutorial_master_modal #myCarousel').carousel({
        pause: true,
        interval: false
    });

    $(".question_tutorial_view").click(function () {
       var question_id = $(this).attr('question_id');
        console.log(question_id);
        if (question_id)
        {
            $.ajax({
                url:"<?php echo base_url(); ?>Student/question_tutorial_preview",
                type:"post",
                dataType:'html',
                data:{question_id:question_id},
                success:function(data){
                    console.log(data);
                    $(".question_tutorial_master_modal .carousel-inner").html(data);
                    $(".question_tutorial_master_modal").modal('show');
                    $('.question_tutorial_master_modal #myCarousel').carousel({
                        pause: true,
                        interval: false
                    });
                    var word =  $(".question_tutorial_master_modal #myCarousel .item.active").attr("id");
                    if (word =='none')
                   {
                       $(".sound_play").hide();
                       return true;
                   }else {
                       $(".sound_play").show();
                   }
                    speak(word);
                }
            });
        }
    });

    $('.question_tutorial_master_modal #myCarousel').on('slide.bs.carousel', function onSlide (ev) {
        var word = ev.relatedTarget.id;
		console.log('footer');
		console.log(word);
        if (word =='none')
                   {
                       $(".sound_play").hide();
                       return true;
                   }else {
                       $(".sound_play").show();
                   }
        speak(word);
    });
    $(".sound_play").click(function () {
        var word =  $(".question_tutorial_master_modal #myCarousel .item.active").attr("id");
        console.log(word);
        if (word =='none')
                   {
                       $(".sound_play").hide();
                       return true;
                   }else {
                       $(".sound_play").show();
                   }
        speak(word);
    });
	$(".module_sound_play").click(function () {
        var word =  $(".tutorialModalMaster #myCarousel .item.active").attr("id");
        console.log(word);
        if (word =='none')
                   {
                       $(".sound_play").hide();
                       return true;
                   }else {
                       $(".sound_play").show();
                   }
        speak(word);
    });
</script>