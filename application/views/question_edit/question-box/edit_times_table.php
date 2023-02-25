<input type="hidden" name="questionType" value="10">
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
                <textarea class="mytextarea" name="questionName"><?php echo $question_info_ind['questionName']?></textarea>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-4">
    <div class="col-xs-3">
        <?php foreach ($question_info_ind['factor1'] as $row) {?>
        <div class="form-group">
            <input type="text" class="form-control" id="factor1" name="factor1[]" value="<?php echo $row;?>" style="font-size: 30px;">
        </div>
        <?php }?>
    </div>
    <div class="col-xs-2">
        <span style="font-size: 30px;">X</span>
    </div>
    <div class="col-xs-3">
        <?php foreach ($question_info_ind['factor2'] as $row) {?>
        <div class="form-group">
            <input type="text" class="form-control" id="factor2" name="factor2[]" value="<?php echo $row;?>" style="font-size: 30px;">
        </div>
        <?php }?>
    </div>
    <div class="col-xs-1">
        <span style="font-size: 30px;">=</span>
    </div>
    <div class="col-xs-3">
        <?php foreach($question_answer as $row){?>
        <div class="form-group">
            <input type="text" class="form-control" id="" name="result[]" value="<?php echo $row;?>" style="font-size: 30px;">
        </div>
        <?php }?>
    </div>
</div>


<script>
    $('body').on('keydown', 'input', function(e) {
        var self = $(this)
          , form = self.parents('form:eq(0)')
          , focusable
          , next
          ;
        if (e.keyCode == 13) {
            focusable = form.find('input').filter(':visible');
            next = focusable.eq(focusable.index(this)+1);
            if (next.length) {
                next.focus();
            } else {
                form.submit();
            }
            return false;
        }
    });
//    $('#factor1').keypress(function (e) {
//        alert();
//    }); 
</script>