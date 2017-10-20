<script src="<?php echo base_url(); ?>my-assets/js/admin_js/json/supplier.js.php" ></script>
<div class="row">
    <div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2>New Ticket type</h2>
			</div>
			<div class="row">
				<div class=" pull-right box col-md-8">	
					<div class="box-inner">				
						<div class="box-content">		
							<form action="{action}" id="" method="post"  name="insert_product" enctype="multypart/formdata">
								<div class="form-group">
									<label for="ticket_type">Ticket Type</label>
									<input type="text" class="form-control" id="ticket_type" name="ticket_type" value="<?php if (isset($ticket_type_value)) { echo $ticket_type_value; } ?>" placeholder="Enter Ticket Type">
									
									<?php if (isset($error_ticket_type)) { ?>
										<span style="color:red;font-size:11px;"><?php echo $error_ticket_type; ?></span>
									<?php } ?>
								</div>
								<div class="form-group">
									<label for="ordering">Ordering</label>
									<input type="text" class="form-control" id="ordering" name="ordering" value="<?php if (isset($ordering_value)) { echo $ordering_value; } ?>" placeholder="Enter Ordering">
								</div>
								<button type="submit" class="btn btn-success">Save</button>	
							</form>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>