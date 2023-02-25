<div class="form-group row trial_list">
<?php 
$i = 0;
foreach ($next_user_info as $key => $value): ?>
	<?php if ($i % 10 == 0 ): ?>
		<?php if ($i > 0): ?>
			</div>
		<?php endif ?>
		<div class="col-md-4">
	<?php endif ?>
	<div style="border: 1px solid lightblue;padding: 3px 10px">
		<a href="edit_user/<?php echo $value['id'];?>"><p><?= $value['name']; ?></p></a>
	</div>
	<?php $i++;?>
<?php endforeach ?>
<?php if ($i % 10 != 0): ?>
	</div>
<?php endif ?>
</div>