<style>
    .form-control {
        width: 100% !important;
    }
    .ss_lette{
        min-height: 138px !important;
        line-height: 138px !important;
    }
</style>

<div class="col-md-12"> 
    <div class="text-center">
        <div class="form-group ss_h_mi" style="margin-bottom: 10px">
            <label for="exampleInputiamges1">Question</label>

            <div class="select">
                <input class="form-control" type="text" value="" name="questionName">
            </div>
            <label for="exampleInputiamges1">How many images</label>

            <div class="select">
                <input class="form-control" type="number" value="4" id="box_qty" onclick="getImageBox(this)">
            </div>

        </div>
    </div>
</div>

<div class="col-sm-4">	
    <div class="image_box_list ss_m_qu">
        <div class="row editor_hide" id="list_box_1_1" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">1</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_1[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_1">
                    <input type="radio" id='left_side_1' name="left_side_1" value="1" data-id="1" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>

        <div class="row editor_hide" id="list_box_1_2" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">2</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_2[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1" >
                <p class="ss_lette" id="color_left_side_2">
                    <input type="radio" value="2" name="left_side_2" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>

        <div class="row editor_hide" id="list_box_1_3" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">3</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_3[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_3">
                    <input type="radio" value="3" name="left_side_3" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_1_4" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">4</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_4[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_4">
                    <input type="radio" value="4" name="left_side_4" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>

        <div class="row editor_hide" id="list_box_1_5" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">5</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_5[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_5">
                    <input type="radio" value="5"name="left_side_5" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>

        <div class="row editor_hide" id="list_box_1_6" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">6</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_6[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_6">
                    <input type="radio" value="6" name="left_side_6" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_1_7" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">7</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_7[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_7">
                    <input type="radio" value="7" name="left_side_7" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_1_8" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">8</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_8[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_8">
                    <input type="radio" value="8" name="left_side_8" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>

        <div class="row editor_hide" id="list_box_1_9" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">9</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_9[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_9">
                    <input type="radio" value="9" name="left_side_9" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_1_10" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">10</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_10[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_10">
                    <input type="radio" value="10" name="left_side_10" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>

        <div class="row editor_hide" id="list_box_1_11" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">11</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_11[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_11">
                    <input type="radio" value="11" name="left_side_11" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>

        <div class="row editor_hide" id="list_box_1_12" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">12</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_12[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_12">
                    <input type="radio" value="12" name="left_side_12" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_1_13" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">13</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_13[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_13">
                    <input type="radio" value="13" name="left_side_13" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>

        <div class="row editor_hide" id="list_box_1_14" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">14</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_14[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_14">
                    <input type="radio" value="14" name="left_side_14" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_1_15" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">15</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_15[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_15">
                    <input type="radio" value="15" name="left_side_15" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>

        <div class="row editor_hide" id="list_box_1_16" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">16</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_16[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_16">
                    <input type="radio" value="16" name="left_side_16" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>

        <div class="row editor_hide" id="list_box_1_17" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">17</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_17[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_17">
                    <input type="radio" value="17" name="left_side_17" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_1_18" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">18</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_18[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_18">
                    <input type="radio" value="18" name="left_side_18" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>

        <div class="row editor_hide" id="list_box_1_19" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">19</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_19[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_19">
                    <input type="radio" value="19" name="left_side_19" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>

        <div class="row editor_hide" id="list_box_1_20" style="display:none;">					
            <div class="col-xs-2">
                <p class="ss_lette">20</p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_1_20[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-1">
                <p class="ss_lette" id="color_left_side_20">
                    <input type="radio" value="20" name="left_side_20" class="left" onclick="getLeftVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
        </div>
    </div> 
</div>
<div class="col-sm-4">	
    <div class="image_box_list ss_m_qu">
        <div class="row editor_hide" id="list_box_2_1" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_1">
                    <input type="radio" name="right_side_1"  value="1" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_1[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" class="form-control" name="answer_1" id="answer_1" data="1" onclick="getAnswer();">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_2" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_2">
                    <input type="radio" name="right_side_2"  value="2" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_2[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" class="form-control" id="answer_2" name="answer_2">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_3" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_3">
                    <input type="radio" value="3" name="right_side_3" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_3[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" class="form-control"  id="answer_3" name="answer_3">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_4" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_4">
                    <input type="radio" name="right_side_4" value="4" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_4[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" class="form-control" id="answer_4" name="answer_4">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_5" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_5">
                    <input type="radio" value="5" name="right_side_5" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_5[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" class="form-control" id="answer_5" name="answer_5">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_6" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_6">
                    <input type="radio" value="6" name="right_side_6" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_6[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_6" class="form-control" name="answer_6">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_7" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_7">
                    <input type="radio" value="7" name="right_side_7" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_7[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_7" class="form-control" name="answer_7">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_8" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_8">
                    <input type="radio" value="8" name="right_side_8" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_8[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_8" class="form-control" name="answer_8">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_9" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_9">
                    <input type="radio" value="9" name="right_side_9" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_9[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_9" class="form-control" name="answer_9">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_10" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_10"> 
                    <input type="radio" value="10" name="right_side_10" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_10[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_10"  class="form-control" name="answer_10">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_11" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_11">
                    <input type="radio" value="11" name="right_side_11" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_11[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_11" class="form-control" name="answer_11">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_12" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_12">
                    <input type="radio" value="12" name="right_side_12" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_12[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_12" class="form-control" name="answer_12">
                </p>
            </div>
        </div>
        <div class="row editor_hide"id="list_box_2_13" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_13">
                    <input type="radio" value="13" name="right_side_13" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_13[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_13" class="form-control" name="answer_13">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_14" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_14">
                    <input type="radio" value="14" name="right_side_14" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_14[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_14" class="form-control" name="answer_14">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_15" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_15">
                    <input type="radio" value="15" name="right_side_15" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_15[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_15" class="form-control" name="answer_15">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_16" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_16">
                    <input type="radio" value="16" name="right_side_16" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_16[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_16" class="form-control" name="answer_16">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_17" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_17">
                    <input type="radio" value="17" name="right_side_17" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_17[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_17" class="form-control" name="answer_17">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_18" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_18">
                    <input type="radio" value="18" name="right_side_18" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_18[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_18" class="form-control" name="answer_18">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_19" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_19">
                    <input type="radio"  value="19" name="right_side_19" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_19[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_19" class="form-control" name="answer_19">
                </p>
            </div>
        </div>
        <div class="row editor_hide" id="list_box_2_20" style="display:none;">					
            <div class="col-xs-1">
                <p class="ss_lette" id="color_right_side_20">
                    <input type="radio" value="20" name="right_side_20" class="right" onclick="getRightVal(this);" style="line-height: 138px;min-height: 138px;">
                </p>
            </div>
            <div class="col-xs-9">
                <div class=" ">
                    <div class="text-center">
                        <textarea class="vocubulary_image" name="match_image_2_20[]"></textarea>
                    </div>

                </div>
            </div>

            <div class="col-xs-2">
                <p class="ss_lette" style="display: table-cell;vertical-align: middle;height: 138px;">
                    <input type="number" id="answer_20" class="form-control" name="answer_20">
                </p>
            </div>
        </div>

    </div> 
</div>
<input type="hidden" name="image_quantity" id="image_quantity" value="">
<script>
    $('.right').attr('disabled', true);
    var left_arr = new Array();
    var right_arr = new Array();
    var color_array = new Array('red', 'green', 'blue', '#00BFFF', '#FF6347', '#708090', '#2F4F4F', '#C71585', '#8B0000', '#808000', '#FF6347', '#FF4500', '#FFD700', '#FFA500', '#228B22', '#808000', '#00FFFF', '#66CDAA', '#7B68EE', '#FF69B4');
    function getLeftVal(e)
    {
        var left_ans_val = e.value;

        left_arr.push(left_ans_val);
        /*if(left_arr.length == 0)
         {
         left_arr.push(left_ans_val);
         //$('.right').attr('disabled', false);
         $('.left').attr('disabled', true);
         }else
         {
         var temp = 0;
         for(var i = 0; i < left_arr.length; i++) 
         {
         
         if(left_arr[i] === left_ans_val)
         {
         temp = 1;
         }
         }
         if(temp == 0)
         {
         left_arr.push(left_ans_val);
         //$('.right').attr('disabled', false);
         $('.left').attr('disabled', true);
         }
         }*/
        $('.right').attr('disabled', false);
        $('.left').attr('disabled', true);
        //var last = left_arr.slice(-1)[0];
        var color_left = color_array[left_ans_val - 1];
        //document.getElementById("color_left_side_1").style.backgroundColor = color_left;
        document.getElementById("color_left_side_" + left_ans_val).setAttribute('style', 'background-color:' + color_left + ' !important');
        //console.log(last);
    }

    function getRightVal(e)
    {
        var last = left_arr.slice(-1)[0];

        var right_ans_val = e.value;

        document.getElementById("answer_" + right_ans_val).value = last;
        /*if(right_arr.length == 0)
         {
         right_arr.push(right_ans_val);
         $('.right').attr('disabled', true);
         $('.left').attr('disabled', false);
         }else
         {
         var temp = 0;
         for(var i = 0; i < right_arr.length; i++) 
         {
         
         if(right_arr[i] === right_ans_val)
         {
         temp = 1;
         }
         }
         if(temp == 0)
         {
         right_arr.push(right_ans_val);
         //$('.right').attr('disabled', true);
         //$('.left').attr('disabled', false);
         }
         }*/
        $('.right').attr('disabled', true);
        $('.left').attr('disabled', false);
        var color_right = color_array[last - 1];
        document.getElementById("color_right_side_" + right_ans_val).setAttribute('style', 'background-color:' + color_right + ' !important');
        console.log(right_arr);
    }


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
            $('#list_box_1_' + i).show();
            $('#list_box_2_' + i).show();
        }
    }
    function getAnswer()
    {
        //alert(this.attr('data'));
    }
</script>