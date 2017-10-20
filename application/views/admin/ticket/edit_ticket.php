<div class="box col-md-4">
	<div class="box-inner">
		<div class="box-header well" data-original-title="">
			<h2>Instructions</h2>
		</div>
		<div style="height:652px;">			
			<div class="form-group has-warning col-md-12">
				<span style="color:red;">Star marks field are mandatory.</span>
			</div>
		</div>
	</div>
</div>
<div class="box col-md-8">
	<div class="box-inner" style="overflow:auto;">
		<div class="box-header well" data-original-title="">
			<h2><i class="glyphicon glyphicon-edit"></i> Edit Customer Complain</h2>
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
								<option <?php if(isset($ticket_type_value) && $ticket_type_value == $value['id']){echo "selected='selected'";}?> value="<?php echo $value['id'];  ?>"><?php echo $value['details']; ?></option>
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
					<textarea class="form-control txtEditor" rows="10" name="customer_query" placeholder="Customer Query"><?php if (isset($customer_query_value)) { echo $customer_query_value; } ?></textarea>
				</div>
				<?php if ($previous_attached !="") { ?>
					<div class="form-group has-primary col-md-12">
						<label class="control-label" for="inputSuccess1">Previous Attach file</label>
						<br>
						<a href='<?php echo base_url()."uploads/ticket_attachments/".$previous_attached; ?>'> <?php echo $previous_attached; ?> </a>
					</div>
				<?php } ?>
				<div class="form-group has-primary col-md-12">
					<label class="control-label" for="inputSuccess1">New Attach file <span style="font-size:11px;color:red;">New attachment will overwrite with Previous Attachment <span></label>
					<input type="file" name="userfile" class="input-block-level">
				</div>
				<div class="form-group has-success col-md-12">
					<button type="submit" class="btn btn-info btn-lg pull-right">Save Chnages</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
    $('.txtEditor').jqte();
</script>