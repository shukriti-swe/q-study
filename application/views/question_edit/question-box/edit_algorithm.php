<style>
    .form-control {
        width: 100% !important;
    }
</style>


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
                    <textarea class="form-control mytextarea" name="question_body"><?php echo $question_info_ind['questionName']; ?></textarea>
                </div>
            </div>
        </div>


    </div>
</div>

<div class="col-sm-4">
    <div class="row">
<!--        <ul class="list list-inline list-unstyled">
            <li>
                <button class="btn btn-default"> + </button>
            </li>
            <li>
                <button class="btn btn-default"> - </button>
            </li>
            <li>
                <button class="btn btn-default"> X </button>
            </li>
            <li>
                <button class="btn btn-default"> / </button>
            </li>
            
        </ul>-->
        
        
        <div class="col-xs-3">
            <div class="form-group">
                <input type="button" class="form-control" value="+" onclick="show_div('plus')" style="font-size: 30px;text-align: center;cursor: pointer;line-height: 0px;">
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <input type="button" class="form-control" value="-" onclick="show_div('minus')" style="font-size: 30px;text-align: center;cursor: pointer;line-height: 0px;">
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <input type="button" class="form-control" value="X" onclick="show_div('multiplication')" style="font-size: 30px;text-align: center;cursor: pointer;line-height: 0px;">
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <input type="button" class="form-control" value="/" onclick="show_div('divide')" style="font-size: 30px;text-align: center;cursor: pointer;line-height: 0px;">
            </div>
        </div>

        <input type="hidden" name="operator" id="operator">

    </div>
    <div id="draggable" style="display: none;margin-left: 0;">
        <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne1">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne">  Insert Box</a>
                    </h4>
                </div>
                <div id="collapseOne2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne1">
                    <div class="panel-body" >
                        <div class="form-group">

                            <div class="form-group row">
                                <label for="inputncl3" id="num_col" class="col-sm-7 control-label">Number of colums</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="number" name="numOfCols" id="tcolumns_number" min="1" value="<?php echo $question_info_ind['numOfCols'];?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputncl3" id="num_row" class="col-sm-7 control-label">Number of rows</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="number" name="numOfRows" id="trows_number" min="1" value="<?php echo $question_info_ind['numOfRows'];?>">
                                </div>
                            </div>
                            
                            <br/>
                            <div class="form-group text-center">
                                
                                <button type="button" class="btn btn_next" id="operate_sign" style="font-size: 30px;"></button>
                                <button type="submit" class="btn btn_next make_table">Ok</button>
                                <button type="reset" class="btn btn_next">Cancel</button>
                                <!-- <button type="submit" class="btn btn_next">Edit</button> -->

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
    



<script>
    
    $(document).ready(function (){
        
        var operator = '<?php echo $question_info_ind['operator'];?>';
        if(operator == '/'){
            show_div('divide');
        }
        if(operator == 'X'){
            show_div('multiplication');
        }
        if(operator == '-'){
            show_div('minus');
        }
        if(operator == '+'){
            show_div('plus');
        }
        
        //process_column_rows();
        
    });
    
    function show_div(input_value) {
        
        $("#num_col").html('Number of colums');
        $("#num_row").html('Number of rows');
        
        if(input_value == 'divide'){
            $("#num_col").html('Divisor');
            $("#num_row").html('Dividend');
            
            $('#operator').val('/');
            $("#operate_sign").html('/');
        } if(input_value == 'plus') {
            $('#operator').val('+');
            $("#operate_sign").html('+');
        } if(input_value == 'minus') {
            $('#operator').val('-');
            $("#operate_sign").html('-');
        } if(input_value == 'multiplication') {
            $('#operator').val('X');
            $("#operate_sign").html('X');
        }
        
        $("#draggable").show();
    }

    $(function() {
        $( "#draggable" ).draggable();
    });

    $('.make_table').click(function(e){
        e.preventDefault();

        $('.dynamic_table_skpi_tbody').html('');
        $('.dynamic_table_dividend_tbody').html('');
        $('.htm_r').hide();
        var htm = '';
        var htm1 = '';
        var numOfrow = $('#trows_number').val();//Dividend for division
        var numOfcol = $('#tcolumns_number').val();//Divisor for division
        if($('#operator').val() != '/'){    
            for(i=1;i<=numOfrow;i++){
                htm += '<tr class="rw"'+i+'>';
                for(j=1;j<=numOfcol;j++){
                    htm += '<td><input type="text" data_q_type="0" data_num_colofrow="'+i+'_'+j+'" value="" name="item['+i+'][]" class="form-control input-box rsskpin rsskpinpt'+i+'_'+j+'" readonly style="min-width:50px;">';
                    htm += '<input type="hidden" value="" name="ques_ans[]" id="obj">';
                    htm += '<input type="hidden" value="" name="ans[]" id="ans_obj">';
                    htm += '</td>';
                }
                htm += '</tr>';
            }
            htm +='<tr>\n\
                        <td colspan="'+numOfcol+'">\n\
                            <input type="text" data_q_type="0" value="" name="result" class="form-control input-box rsskpin" readonly style="min-width:50px;">\n\
                        </td>\n\
                    </tr>';       
                                
        } if($('#operator').val() == '/') {   
            $('.htm_r').show();
            for(i=1;i<=1;i++){
                htm += '<tr class="rw"'+i+'>';
                //Divisor
                for(j=1;j<=numOfcol;j++){
                    htm += '<td><input type="text" data_q_type="0" data_num_colofrow="'+i+'_'+j+'" value="" name="divisor[]" class="form-control input-box rsskpin rsskpinpt'+i+'_'+j+'" readonly style="min-width:50px;">';
                    htm += '<input type="hidden" value="" name="ques_ans[]" id="obj">';
                    htm += '<input type="hidden" value="" name="ans[]" id="ans_obj">';
                    htm += '</td>';
                }
                htm += '</tr>';
            }

            //Remainder
            var htm_r ='<div class="col-sm-10"></div>\n\
                    <div class="col-sm-1 col-xs-3" style="text-align: right;font-size: 30px;line-height: 40px;padding-right: 0px;">\n\
                        <span>R</span>\n\
                    </div>\n\
                    <div class="col-sm-1 col-xs-4">\n\
                        <div class="pull-right" style="padding: 8px;min-width: 18%;border: 1px solid #ddd">\n\
                            <input type="text" readonly="" name="remainder" class="form-control rsskpin" >\n\
                        </div>\n\
                    </div>';
                                
            for(i=1;i<=1;i++){      //Dividend
                htm1 += '<tr class="rw"'+i+'>';
                for(j=1;j<=numOfrow;j++){
                    htm1 += '<td><input type="text" data_q_type="0" data_num_colofrow="'+i+'_'+j+'" value="" name="dividend[]" class="form-control input-box rsskpin rsskpinpt'+i+'_'+j+'" readonly style="min-width:50px;">';
                    htm1 += '<input type="hidden" value="" name="ques_ans[]" id="obj">';
                    htm1 += '<input type="hidden" value="" name="ans[]" id="ans_obj">';
                    htm1 += '</td>';
                }
                htm1 += '</tr>';
            }
            
            $('.htm_r').html(htm_r);
            $('.dynamic_table_dividend_tbody').html(htm1);
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
