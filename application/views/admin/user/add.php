<script src="<?php echo base_url(); ?>my-assets/js/admin_js/users.js" type="text/javascript"></script>
<div class="row">
    <div class="box col-md-12">
		<div class="box-inner" style="overflow:auto;">
			<div class="box-header well" data-original-title="">
				<h2>Add new user</h2>
			</div>
			<div class="box-content">
				<form class="form-horizontal" action="<?=base_url()?>user/insert_user" role="form" id="user" method="post"  name="user" enctype="multypart/formdata">
					<div class="col-md-12 well">
						<div class="col-md-6 well">
							<div class="col-md-8">
								<h4>Basic info</h3>
								<div class="form-group">
									<label class="control-label" for="first_name">First name</label>
									<div class="controls">
										<input type="text" placeholder="First name" class="form-control" id="first_name" name="first_name" value="" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label" for="last_name">Last name</label>
									<div class="controls">
										<input type="text" placeholder="Last name" class="form-control" id="last_name" name="last_name" value="" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label" for="designation">Designation</label>
									<div class="controls">
										<input type="text" placeholder="Designation" class="form-control" id="designation" name="designation" value="" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label" for="address">Address</label>
									<div class="controls">
										<textarea id="address" class="form-control" name="address" placeholder="Address"></textarea>
									</div>
								</div>
								<br/><br/><br/><br/>
							</div>
						</div>
						<div class="col-md-6 well">	
							<div class="col-md-8">
								<h4>Login info</h4>
								<div class="form-group">
									<label class="control-label" for="email">Email</label>
									<div class="controls">
										<input type="text" placeholder="User's email address" class="form-control" id="email" name="email" value="" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label" for="password">Password</label>
									<div class="controls">
										<input type="password" placeholder="Password" class="form-control" id="password" name="password" value="" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label" for="">Can login</label> <br>
									<label class="radio-inline">
										<input type="radio" class="" name="can_login" value="1" checked="checked">&nbsp; Yes.
									</label>								
									<label class="radio-inline">
										<input type="radio" class="" name="can_login" value="0">&nbsp; No.
									</label>
								</div>
								<div class="form-group">
									<label class="control-label" for="is_active">Active status</label>
									<div class="controls">
										<select id="is_active" name="is_active" class="form-control">
											<option value="1">Active</option>
											<option value="0">Deactive</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label" for="role_id">Set role</label>
									<div class="controls">
										<select id="role_id" name="role_id" class="form-control">
											{roles}
											<option value="{role_id}">{role}</option>
											{/roles}
										</select>
									</div>
								</div>							
								<div class="form-actions">
									<input type="submit" id="add-new-user" class="btn btn-primary pull-right" name="add-new-user" value="Add user" />
								</div>
								<br/>
								<br/>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>