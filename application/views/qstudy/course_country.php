<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-6">
   <div class="form-group row">
    <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Country:</label>
    <form action="qstudy/view_course/" method="get">
    <div class="col-sm-5">
      <select class="form-control" id="colFormLabelLg" name="country">
        <?php foreach ($countries as $country) : ?>
          <option value="<?php echo $country['id']; ?>"><?php echo $country['countryName']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="col-sm-6 col-sm-offset-4" style="margin-left: 39%;"> 
    <button class="btn btn_next" type="submit">
      <img src="<?php echo base_url(); ?>assets/images/arrow_next.png"/>Next
    </button>
  </div>
  </form>
</div>
</div>
