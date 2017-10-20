<div class="row">
    <div class="box col-md-12">
		<div class="box-inner" style="overflow:auto;">
			<div class="box-header well" data-original-title="">
				<h2>Change password</h2>
			</div>
			<div class="box-content">
				<form action="<?=base_url()?>dashboard/change_password" id="change_password" method="post"  name="change_password" enctype="multypart/formdata">
					<div class="col-md-12 well">
						<div class="col-md-6 well">
							<h4>Old info.</h4>
							<div class="form-group">
								<label class="">Email:</label>
								<input type="text" placeholder="E-mail" class="form-control" id="email" name="email" value="" />
							</div>
							<div class="form-group">
								<label class="">Old password:</label>
								<input type="password" placeholder="Old password" class="form-control" id="old_password" name="old_password" value="" />
							</div>
						</div>
						<div class="col-md-6 well">
							<h4>New info.</h4>
							<div class="form-group">
								<label class="">New password:</label>
								<input type="password" placeholder="New password" class="form-control" id="password" name="password" value="" />
							</div>
							<div class="form-group">
								<label class="">Retype new password:</label>
								<input type="password" placeholder="Retype new password" class="form-control" id="repassword" name="repassword" value="" />
							</div>
						</div>	
						<div class="form-actions">
							<input type="submit" id="change-password" class="btn btn-primary  pull-right" name="change-password" value="Change password" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
