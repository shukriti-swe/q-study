<style type="text/css">
    .panel-title > a {
        text-decoration: none;
        color: #ab8d00 !important;
    }
</style>

<div class="" style="margin-left: 15px;">
    <div class="row">
        <div class="col-md-4">
            <?php echo $leftnav?>
        </div>
        
        <div class="col-md-8">
            <div class="sign_up_menu" id="theme_div">
                
                <table id ='myTable' class="table table-bordered">
				   <thead>
				    <tr>
				      <th>Type</th>
				      <th>Templete</th>
				      <th style="width: 95px;">Action</th>
					  </tr>
					</thead>

					<tbody>

						<?php  foreach ($templets as $key => $value) { ?>
							<tr>
								<td> <?= $value['setting_key'] ?> </td>
								<td> <?= $value['setting_value'] ?> </td>
								<td> <a  style="display: inline;" href="<?php echo base_url('edit-templete/').$value['setting_id']; ?>"><i style="padding:0px 2px 0px 2px" data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a>
							    </td>
							</tr>
					    <?php } ?>

					</tbody>
				</table>

            </div>
        </div>
        
    </div>
</div>

<script type="text/javascript">
	$(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>