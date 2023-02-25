<div class="row">
    <?php if ($this->session->flashdata('success_msg')) : ?>
      <div class="col-md-2"></div>
      <div class="col-md-10">
        <div class="alert alert-success alert-dismissible" role="alert" style="margin-top:10px;"> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong><?php echo $this->session->flashdata('success_msg') ?></strong>
        </div>
      </div>
    <?php elseif ($this->session->flashdata('error_msg')) : ?>
      <div class="col-md-2"></div>
      <div class="col-md-10">
        <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:10px;"> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong><?php echo $this->session->flashdata('error_msg') ?></strong>
        </div>
      </div>
    <?php endif; ?>
  </div>
