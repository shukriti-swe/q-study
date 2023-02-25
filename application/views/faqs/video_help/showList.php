
     <ul class="video_help">
     	<?php  foreach ($title as $key => $value) { ?>
     		<li onclick="videoShow('<?= $videos[$key]['Audio'] ?>')"  > <?= $value["title"]; ?></li>
     	<?php } ?>
    </ul>