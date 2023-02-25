<input type="hidden" name="questionType" value="4">
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
                <textarea class="mytextarea" name="questionName"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">  Image</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body ss_imag_add_right">

                    <div class="text-center">
                        <div class="form-group ss_h_mi">
                            <label for="exampleInputiamges1">How many images</label>

                            <div class="select">
                                <input class="form-control" type="number" value="4" id="box_qty" onclick="getImageBox(this)">
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_1" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">A</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_1[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="1">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_2" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">B</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_2[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="2">							
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_3" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">C</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_3[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="3">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row editor_hide" id="list_box_4" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">D</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_4[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="4">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_5" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">E</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_5[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="5">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_6" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">F</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_6[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="6">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_7" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">G</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_7[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="7">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_8" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">H</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_8[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="8">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_9" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">I</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_9[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="9">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_10" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">J</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_10[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="10">
                        </div>
                    </div>




                    <br>
                    <div class="row editor_hide" id="list_box_11" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">K</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_11[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="11">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_12" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">L</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_12[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="12">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_13" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">M</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_13[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="13">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_14" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">N</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_14[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="14">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_15" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">O</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_15[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="15">
                        </div>
                    </div>

                    <br>
                    <div class="row editor_hide" id="list_box_16" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">P</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_16[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="16">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_17" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">Q</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_17[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="17">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_18" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">R</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_18[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="18">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_19" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">S</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_1[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="19">
                        </div>
                    </div>
                    <br>
                    <div class="row editor_hide" id="list_box_20" style="display:none;">
                        <div class="col-xs-2">
                            <p class="ss_lette">T</p>
                        </div>
                        <div class="col-xs-9">
                            <div class="box">
                                <textarea class="form-control vocubulary_image" name="vocubulary_image_20[]"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-1">							
                            <input type="radio" name="response_answer" value="20">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="image_quantity" id="image_quantity" value="">	
<script>
    var qtye = $("#box_qty").val();
    document.getElementById("image_quantity").value = qtye;
    common(qtye)
    function getImageBox() {
        var qty = $("#box_qty").val();
        if (qty < 4) {
            $("#box_qty").val(4);
        } else if (qty > 20) {
            $("#box_qty").val(20);
        } else {
            $('.editor_hide').hide();
            document.getElementById("image_quantity").value = qty;
            common(qty);
        }

    }
    function common(quantity)
    {
        for (var i = 1; i <= quantity; i++)
        {
            $('#list_box_' + i).show();
        }
    }
</script>