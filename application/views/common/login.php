<div class="row">
    <div class="box col-md-12">
		<div class="box-inner" style="overflow:auto;">
			<div class="box-content">
				<form action="<?=base_url()?>dashboard/do_login" id="edit_profile" method="post"  name="edit_profile" enctype="multypart/formdata">
					<div class="col-md-12 well">
						<div class="col-md-3">
							<img src="<?php echo base_url(); ?>assets/img/cellex_logo.png" class="img-rounded" width="245" height="180">
						</div>
						<div class="col-md-5">
							<h3>Welcome to Cellex Ltd ticketing portal </h3>
							<span>Sign in to manage your account </span><br>
							Direct customer <a href="<?php echo base_url(); ?>customer/complain"> complain</a>	
						</div>
						<div class="col-md-4">
							<!-- <div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-list blue"></i></span>
								<select class="form-control"  name="user_type" >
									<option value="" disabled selected="selected">Select User Type</option>
									<option value="1" >Client</option>
									<option value="2" >Others</option>
								</select>
							</div> -->
							<div class="clearfix"></div><br/>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user blue"></i></span>
								<input type="text" name="username" class="form-control" placeholder="Username">
							</div>	
							<div class="clearfix"></div><br/>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock blue"></i></span>
								<input type="password" name="password" class="form-control" placeholder="Password">
							</div>		
							<div class="clearfix"></div><br/>
							<div class="form-actions">
								<input type="submit" class="btn btn-info" name="edit-profile" value="Login" style="width:100%"/>
							</div>
						</div>
					</div>			
				</form>
			</div>
		</div>
	</div>
</div>