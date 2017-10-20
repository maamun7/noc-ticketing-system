<script src="<?php echo base_url(); ?>my-assets/js/admin_js/users.js" type="text/javascript"></script>
<div class="row">
    <div class="box col-md-12">
		<div class="box-inner" style="overflow:auto;">
			<div class="box-header well" data-original-title="">
				<h2>Edit User</h2>
			</div>
			<div class="box-content">
				<form class="form-horizontal" action="<?=base_url()?>user/user_update" id="user" method="post"  name="user" enctype="multypart/formdata">
					<div class="col-md-12 well">
						<div class="col-md-6 well">
							<div class="col-md-8">
								<h4>Basic info</h3>
								<div class="form-group">
									<label class="form-label" for="first_name">First name</label>
									<div class="controls">
										<input type="text" placeholder="First name" class="form-control" id="first_name" name="first_name" value="{first_name}" />
									</div>
								</div>
								<div class="form-group">
									<label class="form-label" for="last_name">Last name</label>
									<div class="controls">
										<input type="text" placeholder="Last name" class="form-control" id="last_name" name="last_name" value="{last_name}" />
									</div>
								</div>
								<div class="form-group">
									<label class="form-label" for="designation">Designation</label>
									<div class="controls">
										<input type="text" placeholder="Designation" class="form-control" id="designation" name="designation" value="{designition}" />
									</div>
								</div>
								<div class="form-group">
									<label class="form-label" for="address">Address</label>
									<div class="controls">
										<textarea id="address" name="address" class="form-control" placeholder="Address">{address}</textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 well">
							<div class="col-md-8">
								<h4>Login info</h4>
								<div class="form-group">
									<label class="form-label" for="email">Email</label>
									<div class="controls">
										<input type="text" placeholder="User's email address" class="form-control" id="email" name="email" value="{email}" />
									</div>
								</div>
								<div class="form-group">
									<label class="form-label" for="">Can login</label>
									<div class="controls">
										<input type="radio" <?php if(isset($can_login) && $can_login ==1){echo 'checked="checked"';} ?> name="can_login" value="1" checked="checked">&nbsp; Yes.
										<input type="radio" <?php if(isset($can_login) && $can_login ==0){echo 'checked="checked"';} ?> name="can_login" value="0">&nbsp; No.
									</div>
								</div>
								<div class="form-group">
									<label class="form-label" for="is_active">Active status</label>
									<div class="controls">
										<select id="is_active" name="is_active" class="form-control">
											<option value="1" <?php if(isset($is_active) && $is_active ==1){echo "selected='selected'";} ?> >Active</option>
											<option value="0" <?php if(isset($is_active) && $is_active ==0){echo "selected='selected'";} ?> >Deactive</option>
										</select>
									</div>
								</div>
								<?php if(isset($user_type) && $user_type ==1){ ?>
								<div class="form-group">
									<label class="form-label" for="role_id">Set role</label>
									<div class="controls">
										<select id="role_id" name="role_id" class="form-control">
											<option value="0" {selected} >Register User</option>
										</select>
									</div>
								</div> 
								<?php }else{?>
								<div class="form-group">
									<label class="form-label" for="role_id">Set role</label>
									<div class="controls">
										<select id="role_id" name="role_id" class="form-control">
											{roles}
											<option value="{role_id}" {selected} >{role}</option>
											{/roles}
										</select>
									</div>
									 <input type="hidden" name="user_id" value="{user_id}" />
								</div>
								<?php } ?>
								<div class="form-actions">
									<input type="submit" id="add-new-user" class="btn btn-primary pull-right" name="add-new-user" value="Save Changes" />
								</div>
								<br/><br/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>