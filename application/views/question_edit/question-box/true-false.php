<input type="hidden" name="questionType" value="2">
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
				<textarea class="mytextarea" name="questionName"><?php echo $question_info[0]['questionName']; ?></textarea>
			</div>
		</div>
	</div>
</div>
<div class="col-sm-4">
	<div class="t_f_button">
		<div class="checkbox">
			<label class="radio-inline control-label">
				<span class="btn btn_yellow btn-lg" style="width: 90px;">TRUE</span> <input type="radio" name="answer" value="1" <?php if ($question_info[0]['answer'] == 1) {
				  echo 'checked';
				} ?>> 
			</label>
		</div>
		<div class="checkbox">
			<label class="radio-inline control-label">
				<span class="btn btn_yellow btn-lg">FALSE</span> 
				<input type="radio" name="answer" value="0" <?php if ($question_info[0]['answer'] == 0) {
				  echo 'checked';
				} ?>> 
			</label>
		</div>

	</div>
</div>


