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
                    <textarea class="form-control mytextarea" name="question_body" ></textarea>
                </div>
            </div>
        </div>


    </div>
</div>

<div class="col-sm-4">
    <div class="panel-group" id="" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#taccordion" href="#collapsethree" aria-expanded="true" aria-controls="collapseOne">  <span>Module Name: Will Dynamic Later</span></a>
                </h4>
            </div>
            <div id="collapsethree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div class="form-group">

                        <label class="col-sm-6 control-label">How many tasks</label>
                        <div class="col-sm-6">
                            <input type="number" id="tblRowsInput" class="form-control" min="1"  value="">
                        </div>
                    </div>

                </div>

                <div class="panel-body">

                    <div class=" ss_module_result">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>    
                                    <tr>

                                        <th>SL</th>
                                        <th>Mark</th>
                                        <th>Obtain</th>
                                        <th>Description</th>

                                    </tr>
                                </thead>
                                <tbody id="assListTbl">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- </form> -->

            </div>
        </div>


    </div>
</div>



<script>
    $('#tblRowsInput').on('input', function () {
        var inptRows = $(this).val();
        var tblRows = '';
        for (var a = 1; a <= inptRows; a++) {
            tblRows += '<tr id="' + a + '">';
            tblRows += '<td>' + a + '</td>';
            tblRows += '<td><input name="qMark[]" class="form-control col-2 input-sm markInp"  type="number" step="0.1" required></input></td>';
            tblRows += '<td><input name="obtnMark[]" class="form-control col-2 input-sm obtnMarkInp" type="number" step="0.1" required></input></td>';
            tblRows += '<td><a data-toggle="modal" data-target="#qDtlsModal"  class="text-center descModOpenBtn"><img src="assets/images/icon_details.png"></a></td>';

            tblRows += '<input type="hidden" value="" name="descriptions[]" class="hiddenQuesDesc" required>';
            tblRows += '</tr>';
        }

        $('#assListTbl').html(tblRows);
    });

    $(document.body).on('input', '.markInp', function () {
        var inputVal = $(this).val();
        var hiddenItem = $(this).closest('tr').children('.valToIns');
        var hiddenVal = hiddenItem.val();
        var newField = inputVal;
        hiddenItem.val(hiddenVal + 'mark:' + newField);
    });

    /*set question serial on description modal*/
    $(document.body).on('click', '.descModOpenBtn', function () {
        var quesSl = $(this).closest('tr').attr('id');
        var hiddenQuesDesc = $('tr#' + quesSl).find('input.hiddenQuesDesc').val();
        $('#quesDescFromMod').val(hiddenQuesDesc);

        $('#quesSlOnMod').val(quesSl)
    });
    /*set question description on hidden input field*/
    $(document.body).on('click', '#quesDescSubmitBtn', function () {
        var quesSlFromMod = $('#quesSlOnMod').val();
        var quesDescFromMod = $('#quesDescFromMod').val();
        var hiddenQuesDesc = $('tr#' + quesSlFromMod).find('input.hiddenQuesDesc').val(quesDescFromMod);
        $('#qDtlsModal').modal('toggle');
    })

</script>
