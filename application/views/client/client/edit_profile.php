<div class="row">
    <div class="box col-md-12">
		<div class="box-inner" style="overflow:auto;">
			<div class="box-header well" data-original-title="">
				<h2>Edit user profile</h2>
			</div>
			<div class="box-content">
				<form action="<?=base_url()?>client/update_profile" id="edit_profile" method="post"  name="edit_profile" enctype="multypart/formdata">
					<div class="col-md-12 well">
						<div class="col-md-6 well">
							<div class="form-group">
								<label class="form-label">First name:</label>
								<input type="text" placeholder="First name" class="form-control" id="first_name" name="first_name" value="{first_name}" calss="required" required />
							</div>
							<div class="form-group">
								<label class="form-label">Last name:</label>
								<input type="text" placeholder="Last name" class="form-control" id="last_name" name="last_name" value="{last_name}" calss="required" required  />
							</div>						
						</div>
						<div class="col-md-6 well">
							<div class="form-group">
								<label class="form-label">Address:</label>
								<textarea class="form-control" name="address" calss="required" placeholder="Address" required/>{address}</textarea>
							</div>	
							<div class="form-actions">
								<input type="submit" id="edit-profile" class="btn btn-primary pull-right" name="edit-profile" value="Update profile" />
							</div>							
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>