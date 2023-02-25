<style>
  .color-box {
  float: left;
  width: 20px;
  height: 20px;
  margin: 5px;
  border: 1px solid rgba(0, 0, 0, .2);
}
</style>
<strong>Question Info</strong>
<br><br>
<div class="row">
    <div class="col-md-1">
        <p style="color:red !important">Question:</p>
    </div>
    <div class="col-md-10">
        <?php echo  $additionalInfo['questionName']; ?>
    </div>
</div>
<br>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Column A</th>
      <th scope="col">Matching Color A</th>
      <th scope="col">Matching Color B</th>
      <th scope="col">Column B</th>
    </tr>
  </thead>
  <tbody>
        <?php  //$siz=count($additionalInfo->left_side);?>
        <?php for ($a=0; $a<$siz; $a++) : ?>
        <tr>
          <td><?php echo  $left_side[$a][0];?></td>
          <td><div class="color-box" style="background:<?php echo $colorA[$a]; ?>"></div></td>
          <td><div class="color-box" style="background:<?php echo $colorB[$a]; ?>"></div></td>
          <td><?php echo  $right_side[$a][0];?></td>
        </tr>

        <?php endfor; ?>
  </tbody>
</table>
