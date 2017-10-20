<div class="row">
    <div class="box col-md-12">
		<div class="box-inner" style="overflow:auto;">
			<div class="box-header well" data-original-title="">
				<h2>Add new role</h2>
			</div>
			<div class="box-content">
				<form action="<?=base_url()?>role/add_role" id="add_role" method="post"  name="add_role" enctype="multypart/formdata">
					<div class="form-group" style='width:50%;'>
						<label class="form-label">Role name:</label>
						<input type="text" placeholder="Role name" class="form-control" id="role_name" name="role_name" />
					</div>
					<fieldset class="fifty-percent">
						<legend class="form-label">Set permissions</legend>
					<p>
					{permissions}
					</p>
					</fieldset>
					<div class="box col-md-12">
						<div class="form-actions">
							<input type="submit" id="add-role" class="btn btn-primary btn-lg pull-right" name="add-role" value="Save" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

 