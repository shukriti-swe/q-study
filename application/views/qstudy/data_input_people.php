<table class="table table-bordered dataTable no-footer"  role="grid" aria-describedby="module_setting_info">
  <thead>
    <tr>
    	<th>Name</th>
    </tr>
  </thead>
  <tbody>

  <tr>
  	<?php foreach ($countries as $key => $value) { ?>
  		<td> <a href="<?= base_url('/course/data_input_personal/').$value['id'] ?>"> <?= $value['name'] ?> </a> </td>
    <?php } ?>
  </tr>

  </tbody>
</table>
                
                   