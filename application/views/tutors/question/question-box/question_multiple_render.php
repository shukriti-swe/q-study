<?php
$lettry_array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'k', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');

foreach ($img as $key => $value)  { ?>
<div class="row editor_hide" >
    <div class="col-xs-2">
        <p class="ss_lette"><?php echo $lettry_array[$key]; ?></p>
    </div>
    <div class="col-xs-9">
        <div class="box">
            <textarea class="form-control mytextarea" id="img_insert_<?= $key; ?>" name="vocubulary_image_<?php echo $key+1; ?>[]">
            	<elem><img class="image-editor" data-height="729" data-width="1482" height="295.1417004048583" src="<?= base_url('/assets/uploads/'.$value) ?>" width="600" /></elem>
            </textarea>
        </div>
    </div>
    <div class="col-xs-1">
        <p class="ss_lette">
            <input type="radio" name="response_answer" value="<?php echo $key+1;?>" style="min-height: 158px;">
        </p>
    </div>
</div>
<?php }?>

<script type="text/javascript">
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
</script>