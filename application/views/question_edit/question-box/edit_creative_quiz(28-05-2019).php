<style>
    .input-group-prepend {
        position: absolute;
        right: 20px;
        top: 2px;
        bottom: 10px;
        z-index: 9;
    }
</style>

<input type="hidden" name="questionType" value="9">

<div class="col-sm-4">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" aria-expanded="true" aria-controls="collapseOne">
                        <span onclick="setSolution()">
                            <img src="assets/images/icon_solution.png"> Solution
                        </span> Question
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <textarea class="mytextarea" name="questionName"><?php echo $question_info_ind['questionName'];?></textarea>
            </div>
        </div>
    </div>
</div>

<?php 
	$max_paragraph_order = 0;
	
    if(isset($question_info_ind['paragraph_order'])){
		//$max_paragraph_order = $question_info_ind['paragraph_order'][0];
		foreach($question_info_ind['paragraph_order'] as $row){
			if($max_paragraph_order < $row){
				$max_paragraph_order = $row;
			}
		}
	}
    
    $answer = array_combine(range(1, count($question_answer)), array_values($question_answer));
    $question_info_ind['sentence'] = array_combine(range(1, count($question_info_ind['sentence'])), array_values($question_info_ind['sentence']));
    $ques_description = array_combine(range(1, count($question_description)), array_values($question_description));
    $ques_answer = array_flip($answer);
//      echo '<pre>';print_r(array_flip($answer));
//      echo '<pre>';print_r($question_info[0]['answer']);
?>

<div class="col-sm-8">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-5">
                <div class="form-group ss_h_mi">
                    <label for="exampleInputiamges1">How many sentences</label>

                    <div class="select" style="max-width: 100px;">
                        <input class="form-control" type="number" value="<?php echo count($question_info_ind['sentence']); ?>" min="1" id="box_qty">
                    </div>
                </div>
            </div>
            <div class="col-md-7 ">
                <div class="form-group ss_h_mi pull-left">
                    <button class="btn btn-info" id="create_paragraph" type="button">Create Paragraph</button>
                </div>
                <div class="order">
                    <?php for($i = 1; $i <= $max_paragraph_order; $i++){?>
                        <button class="btn btn-default" style="margin: 0px 5px 5px 5px;" type="button" onclick="set_senetence_paragraph('<?php echo $i?>')">
                            <?php echo $i?>
                        </button>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body" id="questionBody">
            
            <?php $i = 1;foreach ($question_info_ind['sentence'] as $sentence) {?>
            <div class="row sentence" style="margin-bottom:10px" serial="<?php echo $i;?>"> 
                <div class="col-md-8" style="display: inline-block;position: relative;">
                    <input type="text" class="form-control" value="<?php echo $sentence ?>" name="sentence[]">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-primary btn-sm" id="paragraph_order<?php echo $i; ?>" onclick="paragraph_order(<?php echo $i; ?>)">
                            P<?php if(isset($question_info_ind['paragraph_order'])) {
								echo $question_info_ind['paragraph_order'][$i - 1]; 
							}?>
                        </button>
                        <input type="hidden" name="paragraph_order[]" id="para_order_<?php echo $i; ?>" value="<?php if(isset($question_info_ind['paragraph_order'])) {echo $question_info_ind['paragraph_order'][$i - 1];} ?>">
                    </div>
                </div>
<!--                    <div class="col-md-8">
                        <input type="text" class="form-control" value="<?php echo $sentence ?>" name="sentence[]">
                    </div>-->
                <div class="col-md-1">
                    <input checkboxId="<?php echo $i;?>" type="checkbox" class="quesChecked" <?php if(isset($ques_answer[$i]) && $ques_answer[$i]){echo 'checked';}?>>
                </div>
                <div class="col-md-2">
                    <input  type="text" class="form-control questionOrder" name="answer_value[]" onkeypress="set_answer('<?=$i?>')" value="<?php if(isset($ques_answer[$i])){echo $ques_answer[$i];}?>" min="1" id="qOrdr<?php echo $i;?>">
                </div>
                <div class="col-md-1">
                    <a data-toggle="modal" data-target="#description_modal<?php echo $i;?>" class="text-center addDescIcon">
                        <img src="assets/images/icon_details.png">
                    </a>
                    <!--<input style="display:none;" name="description[]" id="hiddenDesc_<?php echo $i;?>" value="<?php echo $ques_description[$i];?>">-->
                </div>
            </div>
            <?php $i++;}?>
        </div>
    </div>

</div>

<!-- <div class="col-sm-2">
  <div class="text-right">
    <div class="form-group ss_h_mi">
      <label for="exampleInputiamges1">Description</label>
    </div>
  </div>
</div> -->

<!-- add description modal -->
<?php $desc_count = 1;foreach ($ques_description as $description) {?>

<div class="modal fade" id="description_modal<?php echo $desc_count;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Save Description</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="message-text" class="control-label mb-2">Description:</label>
                    <textarea class="form-control" id="description" name="description[]"><?php echo $description;?></textarea>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" id="descSaveBtn">Save</button>
            </div>
        </div>
    </div>
</div>

<?php $desc_count++;}?>

<input type="hidden"  id="modalOpenFor" value="">
<input type="hidden" name="ansSequence" id="ansSequence" value="<?php echo $question_info[0]['answer']?>">
<input type="hidden" name="para_sequence" id="para_sequence" value="">
<input type="hidden" name="sequence_sequence" id="sequence_sequence" value="">

<script>
    $('#box_qty').on('input', function(){
        ordr = 1;
        var previous_box = '<?php echo count($question_info_ind['sentence']);?>';
        var boxes = $('#box_qty').val() - previous_box;
        var html = '';
        for (var i=1; i <=boxes ; i++) {
            html += `
            <div class="row sentence" style="margin-bottom:10px" serial="`+`+$('#box_qty').val()+`+`"> 
            <div class="col-md-8">
            <input type="text" class="form-control" value="" name="sentence[]">
            </div>
            <div class="col-md-1">
            <input checkboxId="`+i+`" type="checkbox" id="quesChecked">
            </div>
            <div class="col-md-2">
            <input  type="text" class="form-control questionOrder" value="" min="1" id="qOrdr`+i+`">
            </div>
            <div class="col-md-1">
            <a data-toggle="modal" data-target="#exampleModal" class="text-center addDescIcon"><img src="assets/images/icon_details.png"></a>
            <input style="display:none;" name="description[]" id="hiddenDesc_`+i+`" value="">
            </div>
            </div>`;
        }
		
        $('#questionBody').append(html);

    })

    $(document).ready(function () {
        
        //question checkbox check functionality
        //generate order automatically
        var ordr = 1;
        var rightAnsSequence = [];
        $(document).on('change', '.quesChecked', function () {
            
          //var x = $(this).closest('div#sentence').children('#qOrdr');
            var id= $(this).attr("checkboxId");
            var qOrdr =  $("#qOrdr"+id);

//            if (this.checked) {
//                qOrdr.prop('disabled', true);
//                qOrdr.val(ordr++);
//                rightAnsSequence.push(id); //push the right ans index
//            } else {
//                qOrdr.prop('disabled', false);
//                ordr--;
//                qOrdr.val('');
//
//            //remove the index from right ans item
//                rightAnsSequence = jQuery.grep(rightAnsSequence, function(value) {
//                    return value != id;
//                });
//            }
            
            var seq = (JSON.stringify(rightAnsSequence));
            $('#ansSequence').val(seq);
        });

    });
	
	var btn_click = <?php echo $max_paragraph_order;?>;
    $("#create_paragraph").click(function (){
        btn_click++;
        var add_btn = '<button class="btn btn-default" style="margin: 0px 5px 5px 5px;" type="button" onclick="set_senetence_paragraph('+btn_click+')">'+btn_click+'</button>';
        var inputs = $(".questionOrder");
        $("#para_sequence").val(btn_click);
        console.log(inputs);
        
        $('.order').append(add_btn);
    })

  //save description on hidden field
    $('#descSaveBtn').on('click', function(){
//        $('#exampleModal').modal('toggle');
//        var descValue = $('#description').val();
//        var descForId = $('#modalOpenFor').val();
//        $('#hiddenDesc_'+descForId).val(descValue);
    });

  //clear description modal text
    $(document).on('click','.addDescIcon', function(){

//        $('#description').val('');
//        var id = $(this).closest('div.sentence').attr('serial');
//        $('#modalOpenFor').val(id);
    });
    
    function set_answer(serial){
//        alert(serial);
    }
	
	function paragraph_order(sentence_list_order){
        $("#para_sequence").val();
        $("#para_order_"+sentence_list_order).val($("#para_sequence").val());
        $("#paragraph_order"+sentence_list_order).html('P'+$("#para_sequence").val());
    }
    
    function set_senetence_paragraph(btn_click){
        $("#para_sequence").val(btn_click);
    }
    
</script>
