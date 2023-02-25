<style>
    .panel-title > a {
        text-decoration: none;
        color: #ab8d00 !important;
    }
</style>
<div class="row">
    <div class="col-md-4">
        <?php echo $leftnav ?>
    </div>
    <div class="col-md-8">
        
        <?php if (!empty( $this->session->flashdata('success') )) { ?>
          <div class="row">
            <div class="col-md-2"></div>
            <div class="alert alert-danger col-md-9" style="margin-left: 56px;"><?php echo $this->session->flashdata('success'); ?> </div>
          </div>
        <?php  } ?>
        <form action="admin/update_product_point" method="post" enctype="multipart/form-data">
            <div class="button_schedule text-right" >
                <button type="submit" class="btn btn_next" ><i class="fa fa-save"></i> Save</button>
                <a href="" class="btn btn_next"><i class="fa fa-home"></i> Home</a>
            </div>
            <div class="sign_up_menu" id="product_div">
                <div class="row">
                    <div class="col-md-4">
                        <label style="margin-bottom: 10px">Start Default Target Point:</label>
                        <input class="form-control" type="text" name="target_point" style="width:70%" value="<?= $point->target_point ?>">                  
                    </div>
                    <div class="col-md-4">
                        <label style="margin-bottom: 10px">Referral Point Per Person:</label>
                        <input class="form-control" type="text" name="referral_point" style="width:70%"  value="<?= $point->referral_point ?>">                  
                    </div>
                    <div class="col-md-4">
                        <label style="margin-bottom: 10px">Referral Point taken Person:</label>
                        <input class="form-control" type="text" name="ref_taken_point" style="width:70%"  value="<?= $point->ref_taken_point ?>">                  
                    </div>
                </div><br>
            </div>
        </form>
    </div>
</div>