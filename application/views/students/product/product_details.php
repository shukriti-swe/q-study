<?php if ($productPoint->total_point >=  $product->product_point ) { ?>
<div class="product-point" style="background: orange;margin-bottom: 10px;">
	Yes you can get this one. Make sure address is correct & saved properly.
</div>	

<?php }else{ ?>
<div class="product-point" style="margin-bottom: 10px;">
	You need to have <span><?= $product->product_point?></span> point to get this prize. Choose another one.
</div>	
<?php } ?>
<div class="products_image" style="margin-bottom: 10px;">
    <div class="product_point text-left">
        Point:<?= $product->product_point?>
    </div>
    <a href="<?= base_url()?>">
        <img src="<?= base_url()?>img/product/<?= $product->image?>" style="">
    </a>
    <a class="close_icon" >
        <i class="fa fa-close"></i>
    </a>
</div>
<div class="product_details" style="margin-bottom: 10px;">
    <span class="product_details_title">Product Details</span>
    <div class="product_details_scroll" ><?= $product->product_details ?></div>
</div>
<input type="hidden" id="product-id" value="<?= $product->id ?>">
<input type="hidden" id="product-point" value="<?= $product->product_point ?>">
    <!--<br><button class="btn btn-success save_product_prize" product-id="<?= $product->id?>" product-point="<?= $product->product_point ?>">Submit</button>-->
<!--<?php if ($productPoint->total_point >=  $product->product_point ) { ?>-->
<!--<?php }?>-->