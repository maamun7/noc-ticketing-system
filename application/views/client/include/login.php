	<div class="row">
        <div class="col-md-12 center login-header">
            <h2>Welcome to Cellex Support</h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                Please login with your Username and Password.
            </div>
            <form class="form-horizontal" action="index.html" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list red"></i></span>
						<select class="form-control" >
                            <option value="" disabled selected="selected">-- Select User Type --</option>
                            <option>Client</option>
                            <option>Others</option>
                        </select>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="clearfix"></div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Remember me 
                        </label>
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </p>
                </fieldset>
            </form>		
			<div class="checkbox">				
				<a href="<?php echo base_url(); ?>customer/complain" class="pull-right">Customer Complain</a>				
			</div>
        </div>
        <!--/span-->
    </div><!--/row-->