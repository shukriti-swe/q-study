<div class="form-group row trial_list">

<?php 
$i = 0;
foreach ($trial_user_info as $key => $value): ?>
	<?php if ($i % 10 == 0 ): ?>
		<?php if ($i > 0): ?>
			</div>
		<?php endif ?>
		<div class="col-md-4">
	<?php endif ?>
	<div style="border: 1px solid lightblue;padding: 3px 10px">
		<?php if ($value['parent_id'] != null) { ?>
			<a href="edit_user/<?php echo $value['id'];?>"><p style="color: green;font-weight: bold"><?= $value['name']; ?></p></a>
		<?php }else if($value['user_type'] == 1){ ?>
			<a href="edit_user/<?php echo $value['id'];?>"><p style="color: green;font-weight: bold"><?= $value['name']; ?> (Parent)</p></a>
		<?php }else{ ?>
			<a href="edit_user/<?php echo $value['id'];?>"><p><?= $value['name']; ?></p></a>
		<?php } ?>
	</div>
	<?php $i++;?>
<?php endforeach ?>
<?php if ($i % 10 != 0): ?>
	</div>
<?php endif ?>
</div>