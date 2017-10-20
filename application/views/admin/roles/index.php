<script src="<?php echo base_url(); ?>my-assets/js/admin_js/json/product.js.php" ></script>
<div class="row">
    <div class="box col-md-12">
		<div class="box-inner" style="overflow:auto;">
			<div class="box-header well" data-original-title="">
				<h2>Users Role List</h2>
			</div>
			<div class="box-content">
				<?php
				if(!empty($role_lists)){
				?>
				<table class="table table-striped table-condensed table-bordered">
					<thead>
						<tr>
							<th>Serial No</th>
							<th>Role Name</th>
							<th><center>Actions</center></th>
						</tr>
					</thead>
					<tbody>
					{role_lists}
						<tr>
							<td>{sl}</td>
							<td>{role}</td>
							<td>
								<center>
									<a href="<?php echo base_url().'crole/edit_role/{role_id}'; ?>"> <i class="glyphicon glyphicon-edit glyphicon-white"></i> </a>&nbsp; | &nbsp;
									<a title="Permission change" href="<?=base_url()?>crole/permission/{role_id}">Change permissions</a>
								</center>
							</td>
						</tr>
					{/role_lists}
					</tbody>
				</table>

				<?php
				}else{
				?>
				<div class="NoDataFound"><center>No Data Found</center></div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
