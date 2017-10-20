<div class="row">
    <div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2>Users list</h2>
		</div>
			<div class="box-content">	
				<?php
				if(!empty($lists)){
				?>
				<table class="table table-striped table-condensed table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Email</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Role</th>
							<th>Status</th>
							<th>Can Login</th>
							<th>User Type</th>
							<th><center>Actions</center></th>
						</tr>
					</thead>
					<tbody>
					{lists}
						<tr>
							<td>{sl}</td>
							<td>{username}</td>
							<td>{first_name}</td>
							<td>{last_name}</td>
							<td>{role}</td>
							<td>{is_active}</td>
							<td>{can_login}</td>
							<td>{user_type}</td>
							<td>
								<center>
									{can_edit}
								</center>
							</td>
						</tr>
					{/lists}
					</tbody>
				</table>
				<div id="pagin"><center><?php if(isset($links)){echo $links;} ?></center></div>

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