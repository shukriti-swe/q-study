<div class="alert alert-success alert-dismissible" role="alert">
    You must check your currection by cliking cach of the link
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="text-center">
    <a href="#" class="btn btn-primary">Report</a>
</div>
<div class="report_menu_top">
    <div class="idea_menu">
        <a href="javascript:;" data-toggle="modal" data-target="#students_qs">Idea 19</a>
    </div>
    <a href="javascript:;" data-toggle="modal" data-target="#tutor_checks">Teacher’s Corrections</a>
    <a href="javascript:;" data-toggle="modal" data-target="#teacherscommentss">Teacher’s Comment</a>
    <div class="idea_point">
        Points
        <button><?=$specific_std_report['total_point']?></button>
    </div>
</div>
<br>
<?php if($specific_std_report['significant_checkbox'] == 1) : ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-4" style="margin-top: 40px;">
            <div class="significant_box">
                <a class="btn btn-danger" name="" id="significant_checkbox">Significant plagiarism found</a>
                <img src="<?php echo base_url();?>/assets/images/std_report.png" alt="">
                
                <a href="javascript:;" id="plagiarism" class="text-decoration-underline text-danger">What is plagiarism?</a>

                <div class="row">
                    <div id="plagiarism-text" class="alert alert-warning alert-dismissible plagiarism_text" role="alert">
                        <button type="button" class="close show_plag" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Warning!</strong> Plagiarism can take many forms, from deliberate cheating to accidentally coping from a source without acknowledgemnet. Consequently. whenever you use the words or ideas of another person in your work. you must acknowledge where they came from..
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>
<br>
<br>

<br>
<br>

<?php if($specific_std_report['significant_checkbox'] == 0) : ?>
<div class="row" id="result_tables">
    <div class="col-md-8 col-md-offset-2 table-responsive">
        <div>
            <?php
                $report = json_decode($specific_std_report['checked_checkbox']);
            ?>
            <table class="table">
                <thead>
                    <tr>               
                        <th></th>
                        <th class="red">Poor</th>
                        <th class="blue">Average</th>
                        <th class="gold">Good</th>
                        <th class="green">Very Good</th>
                        <th class="orange">Excellent!</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($report as $relevances){
                    $relevance = explode (",", $relevances);
                    if($relevance[1]=='relevance'){
                    ?> 
                    <tr>
                        <td>Relevance</td>
                        <td>
                            
                            <input type="checkbox" value="1" class="report_box relevance" id="Rel_poor" name="Rel_poor" <?php if($relevance[2]==1){echo "checked";}?>><span id="Rel_poor_span"><?php if($relevance[2]==1){echo 1;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="2" class="report_box relevance" id="Rel_average" name="Rel_average" <?php if($relevance[2]==2){echo "checked";}?>><span id="Rel_average_span"><?php if($relevance[2]==2){echo 2;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="3" class="report_box relevance" id="Rel_good" name="Rel_good" <?php if($relevance[2]==3){echo "checked";}?>><span id="Rel_good_span"><?php if($relevance[2]==3){echo 3;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="4" class="report_box relevance" id="Rel_very_good" name="Rel_very_good"<?php if($relevance[2]==4){echo "checked";}?>><span id="Rel_very_good_span"><?php if($relevance[2]==4){echo 4;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="5" class="report_box relevance" id="Rel_excellent" name="Rel_excellent"<?php if($relevance[2]==5){echo "checked";}?>><span id="Rel_excellent_span"><?php if($relevance[2]==5){echo 5;}?></span>
                        </td>
                    </tr>
                    <?php }}
                    ?> 
                <?php
                    foreach($report as $creativity){
                    $creative = explode (",", $creativity);
                    if($creative[1]=='creativity'){
                    ?>  
                    <tr>
                        <td>Creativity</td>
                        <td>
                            <input type="checkbox" value="1" class="report_box creativity" id="cre_poor" name="cre_poor" <?php if($creative[2]==1){echo "checked";}?>><?php if($creative[2]==1){echo 1;}?><span id="cre_poor_span"></span>
                        </td>
                        <td>
                            <input type="checkbox" value="2" class="report_box creativity" id="cre_average" name="cre_average" <?php if($creative[2]==2){echo "checked";}?>><span id="cre_average_span"><?php if($creative[2]==2){echo 2;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="3" class="report_box creativity" id="cre_good" name="cre_good" <?php if($creative[2]==3){echo "checked";}?>><span id="cre_good_span"><?php if($creative[2]==3){echo 3;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="4" class="report_box creativity" id="cre_very_good" name="cre_very_good" <?php if($creative[2]==4){echo "checked";}?>><span id="cre_very_good_span"><?php if($creative[2]==4){echo 4;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="5" class="report_box creativity" id="cre_excellent" name="cre_excellent" <?php if($creative[2]==5){echo "checked";}?>><span id="cre_excellent_span"><?php if($creative[2]==5){echo 5;}?></span>
                        </td>
                    </tr>
                    <?php }}
                    ?> 
                    <?php
                    foreach($report as $grammars){
                    $grammar = explode (",", $grammars);
                    if($grammar[1]=='grammar'){
                    ?> 
                    <tr>
                        <td>Grammar/Spelling</td>
                        <td>
                            <input type="checkbox" value="1" class="report_box grammar" id="grammar_poor" name="grammar_poor" <?php if($grammar[2]==1){echo "checked";}?>><span id="grammar_poor_span"><?php if($grammar[2]==1){echo 1;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="2" class="report_box grammar" id="grammar_average" name="grammar_average"<?php if($grammar[2]==2){echo "checked";}?>><span id="grammar_average_span"><?php if($grammar[2]==2){echo 2;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="3" class="report_box grammar" id="grammar_good" name="grammar_good" <?php if($grammar[2]==3){echo "checked";}?>><span id="grammar_good_span"><?php if($grammar[2]==3){echo 3;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="4" class="report_box grammar" id="grammar_very_good" name="grammar_very_good" <?php if($grammar[2]==4){echo "checked";}?>><span id="grammar_very_good_span"><?php if($grammar[2]==4){echo 4;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="5" class="report_box grammar" id="grammar_excellent" name="grammar_excellent" <?php if($grammar[2]==5){echo "checked";}?>><span id="grammar_excellent_span"><?php if($grammar[2]==5){echo 5;}?></span>
                        </td>
                    </tr>
                    <?php }}
                    ?> 
                    <?php
                    foreach($report as $vocabularies){
                    $vocabulary = explode (",", $vocabularies);
                    if($vocabulary[1]=='vocabulary'){
                    ?> 
                    <tr>
                        <td>Vocabulary</td>
                        <td>
                            <input type="checkbox" value="1" class="report_box vocabulary" id="vocabulary_poor" name="vocabulary_poor"<?php if($vocabulary[2]==1){echo "checked";}?>><span id="vocabulary_poor_span"><?php if($vocabulary[2]==1){echo 1;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="2" class="report_box vocabulary" id="vocabulary_average" name="vocabulary_average" <?php if($vocabulary[2]==2){echo "checked";}?>><span id="vocabulary_average_span"><?php if($vocabulary[2]==1){echo 2;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="3" class="report_box vocabulary" id="vocabulary_good" name="vocabulary_good" <?php if($vocabulary[2]==3){echo "checked";}?>><span id="vocabulary_good_span"><?php if($vocabulary[2]==3){echo 3;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="4" class="report_box vocabulary" id="vocabulary_very_good" name="vocabulary_very_good" <?php if($vocabulary[2]==4){echo "checked";}?>><span id="vocabulary_very_good_span"><?php if($vocabulary[2]==4){echo 4;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="5" class="report_box vocabulary" id="vocabulary_excellent" name="vocabulary_excellent"<?php if($vocabulary[2]==5){echo "checked";}?>><span id="vocabulary_excellent_span"><?php if($vocabulary[2]==5){echo 5;}?></span>
                        </td>
                    </tr>
                    <?php }}
                    ?> 
                    <?php
                    foreach($report as $clarities){
                    $clarity = explode (",", $clarities);
                    if($clarity[1]=='clarity'){
                    ?> 
                    <tr>
                        <td>Clarity</td>
                        <td>
                            <input type="checkbox" value="1" class="report_box clarity" id="clarity_poor" name="clarity_poor" <?php if($clarity[2]==1){echo "checked";}?>><span id="clarity_poor_span"><?php if($clarity[2]==1){echo 1;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="2" class="report_box clarity" id="clarity_average" name="clarity_average"<?php if($clarity[2]==2){echo "checked";}?>><span id="clarity_average_span"><?php if($clarity[2]==2){echo 2;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="3" class="report_box clarity" id="clarity_good" name="clarity_good"<?php if($clarity[2]==3){echo "checked";}?>><span id="clarity_good_span"><?php if($clarity[2]==3){echo 3;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="4" class="report_box clarity" id="clarity_very_good" name="clarity_very_good" <?php if($clarity[2]==4){echo "checked";}?>><span id="clarity_very_good_span"><?php if($clarity[2]==4){echo 4;}?></span>
                        </td>
                        <td>
                            <input type="checkbox" value="5" class="report_box clarity" id="clarity_excellent" name="clarity_excellent" <?php if($clarity[2]==5){echo "checked";}?>><span id="clarity_excellent_span"><?php if($clarity[2]==5){echo 5;}?></span>
                        </td>
                    </tr>
                    <?php }}
                    ?> 
                </tbody>
            </table> 
        </div>
    </div>
</div>
<?php endif;
 
?>
<br>
<div class="text-center"> <a href="<?php echo base_url()?>all_tutors_by_type/2/1" class="btn btn_next" id="gotits">Got It</a></div>


<!-- modal teacher comm -->
<div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="students_qs">
    <!-- Modal -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="mclose" data-dismiss="modal">x</div>
            <div class="tutor_question" style="display: block;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="workout_menu" style="padding-left: 15px;padding-right: 15px;">
                            <ul>
                                <li><a style="cursor:pointer" id="show_question">Question<i>(Click Here)</i></a></li>
                            </ul>
                        </div>

                        <div class="rs_word_limt">
                            <div class="top_word_limt">
                                <span><?php echo $specific_std_report['total_word']; ?> Words</span>
                                <span class="m-auto"><input class="form-control text-center" type="text" value="00:05:00" name=""></span>
                                <span class="m-auto"> Word Limit</span>
                                <span class="m-auto b-btn">100</span>
                            </div>
                            <div class="btm_word_limt">
                                <div class="content_box_word">
                                    <p><?php echo $specific_std_report['idea_correction']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal tutor_checks -->
<div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="tutor_checks">
    <!-- Modal -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" method="post">
                <div class="mclose" data-dismiss="modal">x</div>
                <div class="btm_word_limt">
                    <div class="content_box_word">
                        <div class="row">
                            <img src="<?php echo $specific_std_report['teacher_correction']; ?>" class="img-responsive">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal teacher comm -->
<div class="modal fade ss_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="teacherscommentss">
    <!-- Modal -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" method="post">
                <div class="mclose" data-dismiss="modal">x</div>
                <div class="btm_word_limt">
                    <div class="content_box_word">
                        <textarea class="form-control" rows="4"><?php echo $specific_std_report['teacher_comment']; ?></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--  -->
<style type="text/css">
    .significant_box{
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
    }
    .plagiarism_text{
        margin-left: 23px;
        border: 2px solid #4ABDEF;
    }
    .mclose {
        position: absolute;
        right: 10px;
        top: 10px;
        font-size: 20px;
        z-index: 10;
        cursor: pointer;
    }

    .b-btn {
        background: #0079bc;
        padding: 5px 10px;
        border-radius: 5px;
        color: #fff;
    }

    .top_word_limt {
        background: #d9edf7;
        padding: 8px 10px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }

    .m-auto {
        margin-left: auto;
    }

    .btm_word_limt .content_box_word {
        border-radius: 5px;
        border: 1px solid #82bae6;
        margin: 10px 0;
        padding: 10px;
        width: 100%;
        box-shadow: 0px 0px 10px #d9edf7;
        margin-top: 0 !important;
    }

    #login_form .modal-dialog,
    .ss_modal .modal-dialog {
        max-width: 100%;
    }

    .report_menu_top {
        display: flex;
        align-items: flex-end;
        justify-content: center;
    }

    .report_menu_top>a {
        margin: 0px 10px;
        text-decoration: underline;
    }

    .report_menu_top .idea_menu a:hover,
    .report_menu_top .idea_menu a.active {
        background: #ff0000;
    }

    .report_menu_top .idea_point {
        text-align: center;
        margin-left: 10px;
    }

    .report_menu_top .idea_menu a {
        margin: 5px 0px 0px 5px;
        display: inline-block;
        background: #a349a4;
        color: #fff;
        padding: 10px 20px;
    }

    .report_menu_top .idea_point button {
        border: 0;
        display: block;
        background: #e85c00;
        color: #fff;
        padding: 10px;
        margin: auto;
        margin-top: 10px;
    }

    .table-responsive>div {
        border: 2px solid #e6eed5;
    }

    .table tbody tr {
        background: #e6eed5;
        border-bottom: 20px solid #fff;
    }

    .table-responsive input {
        margin-bottom: 0;
    }

    .table thead tr>th {
        text-align: center;
        padding: 5px 10px;
    }

    .table tbody tr>td {
        text-align: center;
        padding: 4px 10px;
        color: #ed1c24;
    }

    .table tbody tr>td:first-child {
        text-align: left;
        color: #76923c;
        font-weight: bold;
    }

    .table>thead>tr>th {
        border-bottom: 2px solid #e6eed5;
    }

    .table .red {
        color: #ff0000;
    }

    .table .blue {
        color: #00b0f0;
    }

    .table .gold {
        color: #e36c09;
    }

    .table .green {
        color: #00b050;
    }

    .table .orange {
        color: #953734;
    }

    .table input[type=checkbox]:focus {
        outline: none;
    }

    .table input[type=checkbox] {
        background-color: #fff;
        border-radius: 2px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 14px;
        height: 14px;
        cursor: pointer;
        position: relative;
        border: 1px solid #959595;
    }

    .table input[type=checkbox]:checked {
        border: 1px solid #ed1c24;
        background-color: #ed1c24;
        background: #ed1c24 url("data:image/gif;base64,R0lGODlhCwAKAIABAP////3cnSH5BAEKAAEALAAAAAALAAoAAAIUjH+AC73WHIsw0UCjglraO20PNhYAOw==") 3px 3px no-repeat;
        background-size: 8px;
    }
</style>
<script type="text/javascript">

    $('#plagiarism-text').hide();
    $('#plagiarism').click(function() {
        $(this).hide();
        $('#plagiarism-text').show();
    });
    $('.show_plag').click(function() {
        $('#plagiarism').show();
    });

    $(".alert-dismissible").hide();
    $("#gotits").click(function() {
        $(".alert-dismissible").show();
    })


    $(".report_box").change(function() {
        var all_class = $(this).attr('class').split(' ');
        var className = all_class[1];

        $(this).removeAttr('checked');
        $('.' + className).each(function() {
            if ($(this).is(':checked')) {
                // var name = $( this ).attr('name'); 
                // alert(name);
                var pre_point = $(this).val();
                var total_point = $("#my_grade").val();
                var total = parseInt(total_point) - parseInt(pre_point);
                $("#my_grade").val(total);
            }
        });


        $('.' + className).removeAttr('checked');

        $(this).attr('checked', true);
        var point = $(this).val();
        $('.span_' + className).remove();
        $(this).after("<span class='span_" + className + "'>" + point + "<span>");

        var total_point = $("#my_grade").val();
        var total = parseInt(total_point) + parseInt(point);

        $("#my_grade").val(total);

    });
</script>