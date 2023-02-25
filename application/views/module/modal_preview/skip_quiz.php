<style>
    strong{
        color:#007AC9;
    }
    
    .color-box {
        float: left;
        width: 20px;
        height: 20px;
        margin: 5px;
        border: 1px solid rgba(0, 0, 0, .2);
    }
</style>
<strong>Question Info</strong>
<br><br>
<div class="row">
    <div class="col-md-1">
        <p style="color:red !important">Question:</p>
    </div>
    <div class="col-md-10">
        <?php echo  $additionalInfo['question_body']; ?>
    </div>
</div>
<br>


<!-- <div class="row">
    <div class="col-md-10">
        
        <table class="dynamic_table_skpi table table-bordered">
            <tbody class="dynamic_table_skpi_tbody">
                <?php echo $skipQuizBox; ?>
            </tbody>
        </table>
    </div>
</div> -->
<br><br>
<strong>Answer</strong>
<br><br>
<div class="row">
    <div class="col-md-1">
        <p>Answer:</p>
        <div class="color-box" style="background-color:rgb(186, 255, 186);?>"></div>
    </div>
    <div class="col-md-1">
        <p>Question:</p>
        <div class="color-box" style="background-color: rgb(255, 183, 197);?>"></div> 
    </div>
</div>

<div class="row">
    <div class="col-sm-10">
        <div class="panel-group" id="saccordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#saccordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseOne">Skip Counting</a>
                    </h4>
                </div>
                <div id="collapseTow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="image_box_list_result result">
                            <form id="answer_form">

                                <div class="row">
                                    <table class="dynamic_table_skpi table table-bordered table-responsive">
                                        <tbody class="dynamic_table_skpi_tbody">
                                            <?php echo $skipQuizBox; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
