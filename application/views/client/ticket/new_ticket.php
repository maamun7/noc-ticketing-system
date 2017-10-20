<div class="box col-md-4">
	<div class="box-inner">
		<div class="box-header well" data-original-title="">
			<h2>Instructions</h2>
		</div>
		<div style="height:464px;">			
			<div class="form-group has-warning col-md-12">
				Star marks field are mandatory.
			</div>
		</div>
	</div>
</div>
<div class="box col-md-8">
	<div class="box-inner">
		<div class="box-header well" data-original-title="">
			<h2><i class="glyphicon glyphicon-edit"></i> Customer Complain Form</h2>
		</div>
		<form class="form-vertical" action="{action}" id="" method="post"  name="insert_product" enctype="multipart/form-data">
			<div class="box-content">	
				<div class="form-group has-success col-md-12">
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
				<div class="form-group has-primary col-md-12">
					<label class="control-label" for="inputSuccess1">Attach file</label>
					<input type="file" name="userfile" class="input-block-level">
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