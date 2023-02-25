<style>
strong{
  color:#007AC9;
}
</style>

<strong>Question Info</strong>
<br><br>
<div class="row">
<div class="col-sm-4" style="text-align: center">
  <div class="row">
    <div class="col-sm-12 times_table_div">
      <div>
        <?php foreach ($question_info['factor1'] as $factor1) { ?>
          <div class="form-group" style="font-size: 30px;">
            <?php echo $factor1; ?>
          </div>
        <?php }?>
      </div>

      <div>
        <span style="font-size: 30px;">X</span>
      </div>

      <div>
        <?php foreach ($question_info['factor2'] as $factor2) { ?>
          <div class="form-group" style="font-size: 30px;">
            <?php echo $factor2; ?>
          </div>
        <?php }?>
      </div>

      <div>
        <span style="font-size: 30px;">=</span>
      </div>

      <div>
        <input type="text" class="form-control" id="" name="result[]" autocomplete="off" style="font-size: 30px;">
      </div>
    </div>
  </div>
</div>
</div>

<br><br>
<strong>Answer</strong>
<p><?php echo json_decode($quesInfo['answer'])[0]; ?></p>
<br>
