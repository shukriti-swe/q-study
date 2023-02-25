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

        <?php if (!empty( $this->session->flashdata('error') )) { ?>
          <div class="row">
            <div class="col-md-2"></div>
            <div class="alert alert-danger col-md-9" style="margin-left: 56px;"><?php echo $this->session->flashdata('error'); ?> </div>
          </div>
        <?php  } ?>
        <form action="admin/edit_product_submit" method="post" enctype="multipart/form-data">
            <div class="button_schedule text-right" >
                <button type="submit" class="btn btn_next" ><i class="fa fa-save"></i> Save</button>
                <a href="" class="btn btn_next"><i class="fa fa-home"></i> Home</a>
            </div>
            <div class="sign_up_menu" id="product_div">
                <input type="hidden" name="id" value="<?= $product->id ?>">
                <div class="row">
                    <div class="col-md-2">
                        <label>Product Title</label>                    
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="product_title" value="<?= $product->product_title ?>" required>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-2">
                        <label>Product Details</label>                    
                    </div>
                    <div class="col-md-8">
                        <textarea class="form-control" name="product_details" required rows="5"><?= $product->product_details ?></textarea>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-2">
                        <label>Product Point</label>                    
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="product_point" value="<?= $product->product_point ?>" required>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-2">
                        <label>Product Image</label>                    
                    </div>
                    <div class="col-md-8">
                        <input type="file" class="form-control" name="image">
                        <?php if (isset($product->image)): ?>
                            <img src="./img/product/<?=$product->image ?>">
                        <?php endif ?>
                    </div>
                </div><br>
            </div>
        </form>
    </div>
</div>


<script>
    
    
</script>
