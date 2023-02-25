<div class="table-responsive">
    <table class="table table-bordered c_shcedule" id="themeTable" style="width:99%">
        <thead>
            <tr>
                <th>Sl.No</th>
                <th>Title</th>
                <th>Details</th>
                <th>Point</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($products as $product) { ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                        <span  class="text">
                            <?php echo $product['product_title']; ?>
                        </span>
                    </td>
                    <td>
                        <span class="text">
                            <?php echo $product['product_details']; ?>
                        </span>
                    </td>
                    <td>
                        <span class="text">
                            <?php echo $product['product_point']; ?>
                        </span>
                    </td>
                    <td>
                        <span class="text">
                            <img src="./img/product/<?= $product['image'] ?>" style="width: 100px;">
                        </span>
                    </td>
                    <td>
                        <a href="edit_product/<?php echo $product['id']; ?>" >
                        <i class="fa fa-pencil"  style="color:#4c8e0c;"></i>
                        </a>
                    </td>
                    <td>
                        <a href="admin/delete_product/<?php echo $product['id']; ?>" onclick="return chkDelete()">
                            <i class="fa fa-times" style="color:#4c8e0c;"></i>
                        </a>
                        
                    </td>
                </tr>
            <?php $i++;} ?>
        </tbody>
    </table>
</div>
<script>

//data table on user list    
$(document).ready( function () {
    $('#themeTable').DataTable();
});
</script>