<style>
.lg-icon {
    font-size: 50px;
}
.panel-info{border:1px solid #033C73;}
.panel-success{border:1px solid #73A839;}
.panel-warning{border:1px solid #DD5600;}
.panel-danger{border:1px solid #C71C22;}
.panel,.panel-heading,.panel-footer{border-radius:0 !important}
</style>
<div class=" row">
	<div class="col-lg-3 col-md-6">
		<h1>Dashboard</h1>
	</div>
</div>
<div class=" row">	
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<span class="lg-icon"><i class="glyphicon glyphicon-home"></i></span>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">Home</div>
						<div></div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">Dashboard</span>
					<span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<span class="lg-icon"><i class="glyphicon glyphicon-list-alt"></i></span>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{total_complain}</div>
						<div>Query</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url('complain'); ?>">
				<div class="panel-footer">
					<span class="pull-left">View details</span>
					<span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<span class="lg-icon"><i class="glyphicon glyphicon-folder-close"></i></span>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{total_history}</div>
						<div>History</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url('qhistory'); ?>">
				<div class="panel-footer">
					<span class="pull-left">View details</span>
					<span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<span class="lg-icon"><i class="glyphicon glyphicon-plus"></i></span>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{total_query}</div>
						<div>Ticket</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url('query'); ?>">
				<div class="panel-footer">
					<span class="pull-left">View details</span>
					<span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<!---------- Half Page --------->
	
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<span class="lg-icon"><i class="glyphicon glyphicon-th-large"></i></span>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{total_ticket_type}</div>
						<div>Ticket Type</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url('ticket_type'); ?>">
				<div class="panel-footer">
					<span class="pull-left">View details</span>
					<span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>	
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<span class="lg-icon"><i class="glyphicon glyphicon-user"></i></span>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{total_users}</div>
						<div>Users</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url('user'); ?>">
				<div class="panel-footer">
					<span class="pull-left">View details</span>
					<span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<span class="lg-icon"><i class="glyphicon glyphicon-edit"></i></span>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"></div>
						<div>Edit Profile</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url('dashboard/edit_profile'); ?>">
				<div class="panel-footer">
					<span class="pull-left">Go for edit</span>
					<span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<span class="lg-icon"><i class="glyphicon glyphicon-lock"></i></span>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"></div>
						<div>Change Password</div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url('dashboard/change_password_form'); ?>">
				<div class="panel-footer">
					<span class="pull-left">Go for edit</span>
					<span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>		
</div>