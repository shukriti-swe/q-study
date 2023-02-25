<?php foreach ($products as $key => $value): ?>
<div class="col-md-1 product-img">
    <button class="product_price_button" value="<?= $value['id'];?>">
        <img src="<?= base_url()?>img/product/<?= $value['image'] ?>" style="">
    </button>
</div>
<?php endforeach ?>