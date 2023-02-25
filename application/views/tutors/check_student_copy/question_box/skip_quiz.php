<style>
    .form-control {
        width: 100% !important;
    }
</style>

<input type="hidden" name="questionType" value="6">

<div class="workout_menu" style="margin-bottom: 30px;">
    <ul>
        <li><a style="cursor:pointer" id="show_question">Question<i>(Click Here)</i></a></li>
        <li>
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><span><img src="assets/images/icon_draw.png"> Instruction</span></a>
        </li>
    </ul>
</div>
        <div class="col-md-8 question_module" style="display: none;">
            <div class="col-sm-8">
                <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne1">
                            <h4 class="panel-title">
                                Question
                                <button type="button" class="woq_close_btn" id="woq_close_btn">&#10006;</button>

                            </h4>
                        </div>
                        <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne1">
                            <div class="panel-body" id="quesBody">
                                <div class="math_plus">
                                    <?php echo $questionBody; ?>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-md-5"></div>
        </div>
        <div class="col-md-8 answer_module">
            <div class="col-sm-12" id="draggable">
                <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
                    <?php echo $skp_box; ?>
                </div>

                <div class="col-sm-12">
                    <div class="skip_box">
                        <div class="table-responsive">
                            <table class="dynamic_table_skpi table table-bordered">
                                <tbody class="dynamic_table_skpi_tbody">

                                </tbody>
                            </table>
                            <!-- may be its a draggable modal -->
                            <div id="skiping_question_answer" style="display:none">
                                <input type="text" name="set_skip_value" class="input-box form-control rs_set_skipValue">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>




<script>

    $(function() {
        $( "#draggable" ).draggable();
    });

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
                    inpt_clck.siblings('#obj').val(obj);
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
                    inpt_clck.siblings('#ans_obj').val(obj);
                    
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
