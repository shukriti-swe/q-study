<input type="hidden" name="questionType" value="3">
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
                            <div class="panel-body form-horizontal ss_image_add_form">
                                <!--  <form class="form-horizontal ss_image_add_form"> -->
                                <div class="form-group">
                                    <label for="inputwordl3" class="col-sm-4 control-label">Word</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputword3" name="answer" placeholder="Word" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDefinitionl3" class="col-sm-4 control-label">Definition</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputDefinitionl3" name="definition" placeholder="Definition" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPartsofspeech3" class="col-sm-4 control-label">Parts of speech</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputPartsofspeech3" name="parts_of_speech" placeholder="Parts of speech" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSynonym3" class="col-sm-4 control-label">Synonym</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputSynonym3" name="synonym" placeholder="Synonym" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAntonym3" class="col-sm-4 control-label">Antonym</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputAntonym3" name="antonym" placeholder="Antonym" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputYourSentence3" class="col-sm-4 control-label">Your Sentence</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputYourSentence3" name="sentence" placeholder="Your Sentence" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNearAntonym3" class="col-sm-4 control-label">Near Antonym</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputNearAntonym3" name="near_antonym" placeholder="Near Antonym">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Audio File</label>
                                    <div class="col-sm-8">
                                        <input type="file" id="exampleInputFile" name="audioFile">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Video file</label>
                                    <div class="col-sm-8">
                                        <input type="file" id="exampleInputFilevideo" name="videoFile">
                                    </div>
                                </div>

                                <!--  </form> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>

<!--             <div class="col-sm-4">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Image</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <table width:"30%">
                                                <tbody>
                                                    <tr>
                                                        <td>How many images</td>
                                                        <td><input type="number" min="1" style="height:30px;width:60px;" class="form-control"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        
                        
                            </div>
                        </div>
            --> 
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
                                            <input class="form-control" type="number" value="1" id="box_qty" onclick="getImageBox(this)">
<!--                                            <select class="form-control select-hidden" onchange="getImageBox(this)">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                            <div class="select-styled">01</div>
                                            <ul class="select-options" style="display: none;"><li rel="01">01</li><li rel="02">02</li><li rel="03">03</li><li rel="04">04</li></ul>-->
                                        </div>
                                    </div>
                                </div>

                                <div class="image_box_list" id="image_box_list">
<!--                                    <div class="row">
                                        <div class="col-xs-2">
                                            <p class="ss_lette"> A </p>
                                        </div>
                                        <div class="col-xs-10">
                                            <div class="box">
                                                <textarea class="form-control vocubulary_image" name="vocubulary_image[]"></textarea>
                                            </div>
                                        </div>
                                    </div> -->

                                </div>
                                <input type="hidden" id="question">
                            </div>
                        </div>
                    </div>


                </div>
            </div>

<script>
    $("#saveQuestion").on('click', function () {
        console.log('hit');
    });
</script>



<script>
    $( document ).ready(function() {
        getImageBox();
    });
    
    function getImageBox(){
        var qty = $("#box_qty").val();
        var container = document.getElementById("image_box_list");
        container.innerHTML = '';
        for (var i = 0; i < qty; i++) {
            
            container.innerHTML += '<div class="row">\n\
                                                <div class="col-xs-2"> <p class="ss_lette"> A </p></div> <div class="col-xs-10"><div class="box"><textarea class="form-control" id="vocubulary_image" name="vocubulary_image[]"></textarea></div></div></div>';
//            $( "div.image_box_list" ).html('<div class="row">\n\
//                                                <div class="col-xs-2"> <p class="ss_lette"> A </p></div> <div class="col-xs-10"><div class="box"><textarea class="form-control vocubulary_image" name="vocubulary_image[]"></textarea></div></div></div> ');
        }
        $('.vocubulary_image').ckeditor({
            height: 80,
            filebrowserBrowseUrl: '/assets/uploads?type=Images',
            filebrowserUploadUrl: 'imageUpload',
            allowedContent: true,
        });
    }
</script>

