<input type="hidden" name="questionType" value="6">
<div class="col-sm-4">
    <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne1">
                <h4 class="panel-title">
                    <a role="button" aria-expanded="true" aria-controls="collapseOne">
                        <span onclick="setSolution()">
                            <img src="assets/images/icon_solution.png"> Solution
                        </span> Question
                    </a>
                </h4>
            </div>
            <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne1">
                <div class="panel-body">
                    <textarea class="mytextarea form-control" name="question_body"><?php echo $questionBody; ?></textarea>
                </div>
            </div>
        </div>


    </div>
</div>


<div class="col-sm-3 myNewDivHeight" >
    <div class="skip_box">
        <form action="Tutor/checkSkpboxAnswer" method="post" name="ansForm">
            <input type="hidden" id="questionId" name="questionId" value="<?php echo $question_id; ?>">
            <input type="hidden" id="questionId" name="numOfRows" value="<?php echo $numOfRows; ?>">
            <input type="hidden" id="questionId" name="numOfCols" value="<?php echo $numOfCols; ?>">
            <div class="table-responsive">
                <table class="dynamic_table_skpi table table-bordered">
                    <tbody class="dynamic_table_skpi_tbody">
                        <?php echo $skp_box; ?>
                    </tbody>
                </table>
                <!-- may be its a draggable modal -->
                <div id="skiping_question_answer" style="display:none">
                   <input type="text" name="set_skip_value" class="input-box form-control rs_set_skipValue">
                </div>
            </div>
            
        </form>
    </div>
</div>

<!-- Modal -->
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



<script>
    
    $(function() {
        $( "#draggable" ).draggable();
    });
    //Create table
    $('.make_table').click(function(e){
        e.preventDefault();

        $('.dynamic_table_skpi_tbody').html('');
        var htm = '';
        var numOfrow = $('#trows_number').val();
        var numOfcol = $('#tcolumns_number').val();
        for(i=1;i<=numOfrow;i++){
            htm += '<tr class="rw"'+i+'>';
            for(j=1;j<=numOfcol;j++){
                htm += '<td><input type="text" data_q_type="0" data_num_colofrow="'+i+'_'+j+'" value="" name="skip_counting[]" class="form-control input-box rsskpin rsskpinpt'+i+'_'+j+'" readonly style="min-width:50px;">';
                htm += '<input type="hidden" value="" name="ques_ans[]" id="obj">';
                htm += '<input type="hidden" value="" name="ans[]" id="ans_obj">';
                htm += '</td>';
            }
            htm += '</tr>';
        }
        $('.dynamic_table_skpi_tbody').html(htm);
    });

    $(document).on('click','.rsskpin',function(){
        var inpt_clck = $(this);
        var colOfRow = $(this).attr('data_num_colofrow'); 
        var inputed_val = inpt_clck.val();

        $('.rs_set_skipValue').val(inputed_val);
        $( "#skiping_question_answer" ).dialog({
            resizable: false,
            modal: true,
            closeOnEscape: false,
            title : 'Insert Question or Answer value',
            open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
            height:'auto',
            width:'auto',
            buttons: {
                Question: function() {
                    var skp_vl = $('.rs_set_skipValue').val();
                    
                    var obj = JSON.stringify({cr:colOfRow, val:skp_vl, type:'q'});
                    inpt_clck.siblings('#ans_obj').val(''); // blank the ans_obj
                    inpt_clck.siblings('#obj').val(obj); // both ques and ans will store
                    inpt_clck.val(skp_vl);
                    inpt_clck.addClass('skp_q_type');
                    inpt_clck.removeClass('skp_a_type');
                    inpt_clck.css({
                        'background-color':'#ffb7c5',
                    });
                    $( this ).dialog( "close" );
                },
                Answer: function() {
                    var skp_vl = $('.rs_set_skipValue').val();

                    var obj = JSON.stringify({cr:colOfRow, val:skp_vl, type:'a'});
                    inpt_clck.siblings('#obj').val(obj);
                    
                    inpt_clck.siblings('#ans_obj').val(obj); // only answers will store
                    
                    inpt_clck.val(skp_vl);
                    inpt_clck.addClass('skp_a_type');
                    inpt_clck.removeClass('skp_q_type');
                    inpt_clck.css({
                        'background-color':'#baffba',
                    });
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                },

            }
        });        
    });
    
    function fn_check(aval){
        $("#answer").val(aval);
    }
</script>
