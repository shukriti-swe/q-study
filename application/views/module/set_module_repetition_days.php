<style>
  #repday{
    border: 1px solid #4995b5;
  }
  #repDayLabel{
    margin-bottom: 1px;
  }
</style>

<div class="container top100">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <?php if($this->session->flashdata('success_msg')): ?>
        <div class="alert alert-success" role="alert">
          <?php echo $this->session->flashdata('success_msg'); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <form action="module/repetition/<?php echo $module_info['id'] ?>" method="POST">
    <input type="hidden" name="formInput" value="1">
    <div class="row">
      <div class="col-md-6 text-right">
        <strong><a>Choose repetition for wrong days</a></strong>
      </div>

      <div class="col-md-6 upperbutton text-left">
        <div class="blue_photo bottom10">
          <button class="btn btn-primary" type="submit">Save</button>

          <button class="btn btn-primary" type="button" style="margin-left: 3px;">Auto</button>
          <div class="form-check" style="margin-left: 3px;margin-top: 5px;"> <input class="form-check-input" type="checkbox" name="auto_checkbox" id="auto_checkbox"> </div>

        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
      <?php $moduleCreated= date('Y-m-d', $module_info['exam_date']);?>
        <?php for ($a=1; $a<=365; $a++) : ?>
          <?php $checked = in_array($a, $selectedSl) ? "checked":""; ?>
          <label id="repDayLabel">
            <input type="number" min="1" style="max-width: 54px;margin-left: 65px;" autocomplete="off" class="questionOrder" disabled="disabled" value="<?php echo $a ?>" id="repDay">
            <input type="checkbox" name="sl_date[]" id="<?= $a; ?>" value="<?php echo $a.'_'.date('Y-m-d', strtotime($moduleCreated.' +'.$a .' days')); ?>" <?php echo $checked; ?> >

          </label>
        <?php endfor; ?>
      </div>
    </div>
  </form>
</div>

<script>
  $('.alert').fadeOut(5000);
</script>

<script type="text/javascript">
 var  m = 1;
 var  n = 2;
  $('#auto_checkbox').click(function() {
    if($(this).is(':checked')) {
      for (var i = 1; i <= 365; i++) {
        if (m == i) {
          document.getElementById(m).checked = true;
          m = m + 30;
        }

        if (n == i) {
          document.getElementById(n).checked = true;
          n = n + 30;
        }

      }

      m = 1;
      n = 2;
    }
      
    else{

      for (var i = 1; i <= 365; i++) {
        if (m == i) {
          document.getElementById(m).checked = false;
          m = m + 30;
        }

        if (n == i) {
          document.getElementById(n).checked = false;
          n = n + 30;
        }

      }

      m = 1;
      n = 2;

    }
});
</script>