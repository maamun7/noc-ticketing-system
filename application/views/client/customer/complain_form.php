<div class="box col-md-4">
	<div class="box-inner">
		<div class="box-header well" data-original-title="">
			<h2>Instructions</h2>	
		</div>
		<div style="height:465px;">			
			<div class="form-group has-warning col-md-12">
				Star marks field are mandatory.
				<br>
				Direct  <a href="<?php echo base_url(); ?>dashboard/login"> Login</a>
			</div>
		</div>
	</div>
</div>
<div class="box col-md-8">
	<div class="box-inner">
		<div class="box-header well" data-original-title="">
			<h2><i class="glyphicon glyphicon-edit"></i> Customer Complain Form</h2>
		</div>
		<form class="form-vertical" action="{action}" id="" method="post"  name="insert_product" enctype="multypart/formdata">
			<div class="box-content">	
				<div class="form-group has-success col-md-6">
					<label class="control-label" for="inputSuccess1">Email*
						<?php if (isset($error_customer_email)) { ?>
							<span style="color:red;font-size:11px;"><?php echo $error_customer_email; ?></span>
						<?php } ?>					
					</label>
					<input type="text" class="form-control" name="customer_email" value="<?php if (isset($customer_email_value)) { echo $customer_email_value; } ?>" id="inputSuccess1" placeholder="Email">
				</div>
				<div class="form-group has-success col-md-6">
					<label class="control-label" for="inputError1"> Choose a ticket type*
						<?php if (isset($error_complain_type)) { ?>
							<span style="color:red;font-size:11px;"><?php echo $error_complain_type; ?></span>
						<?php } ?>
					</label>
					<select class="form-control" name="complain_type" >
						<option value="">Select</option>
						<?php 
						if (!empty($ticket_templates)) {
						
							foreach ($ticket_templates as $key => $value) {
							?>
								<option <?php if(isset($complain_type_value) && $complain_type_value == $value['id']){echo "selected='selected'";}?> value="<?php echo $value['id'];  ?>"><?php echo $value['details']; ?></option>
							<?php
							}
						}
						?>
					</select>
				</div>
				<div class="form-group has-success col-md-12">
					<label class="control-label" for="inputSuccess1">Query Details*
						<?php if (isset($error_customer_query)) { ?>
							<span style="color:red;font-size:11px;"><?php echo $error_customer_query; ?></span>
						<?php } ?>
					</label>
					<textarea class="form-control" rows="10" name="customer_query" placeholder="Customer Query"><?php if (isset($customer_query_value)) { echo $customer_query_value; } ?></textarea>
				</div>
				
				<div class="input-group col-md-8">
					&nbsp;
				</div>
				<div class="form-group has-success col-md-4">
					<button type="submit" class="btn btn-success">Send</button>
				</div>
				<br>
				<div class="input-group col-md-12">
					&nbsp;
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
			</div>
		</div>
	</div>
</div>