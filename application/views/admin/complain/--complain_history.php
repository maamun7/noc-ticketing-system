<div class="row">
    <div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2>Completed Ticket List</h2>
			</div>
			<div class="box-content">	
				<form class="well form-inline">
					<div class="form-group">
						<label for="to_date">To</label>	
						<?php $today = date('Y-m-d'); ?>
						<input  type="text" class="form-control datePicker" value="<?php echo $today; ?>" id="from_date" data-date-format="yyyy-mm-dd"  />						
					</div>
					<div class="form-group">
						<label for="to_date">To</label>
						<input type="text" class="form-control datePicker" value="<?php //echo $end_date; ?>" id="to_date" data-date-format="yyyy-mm-dd" />
					</div>
					<div class="form-group">
						<label for="to_date">Ticket type</label>
						<select class="form-control" name="send_type" >
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
					<button type="submit" class="btn btn-default">Search</button>
				</form>
			</div>
			<div class="box-content">	
				<?php
				if(!empty($complains_list)){
				?>
				<table class="table table-striped table-bordered responsive">
					<thead>
						<tr>
							<th>#</th>
							<th>Date</th>
							<th>Ticket ID</th>
							<th>Ticket Type</th>
							<th>Description</th>
							<th>Complain By</th>
							<th><center>Status</center></th>
							<th><center>View Details</center></th>
							<th><center>Attachment</center></th>
						</tr>
					</thead>
					<tbody>
					{complains_list}
						<tr>
							<td>{sl}</td>
							<td>{final_date}</td>
							<td>{ticket_number}</td>
							<td>{details}</td>
							<td>{complain_details}</td>
							<td>{complained_by}</td>
							<td>
								<center>
									<span class="btn btn-sm btn-success" >Done by {done_by}</span>
								</center>
							</td>							
							<td>
								<center>
									<a href="<?php echo base_url(); ?>complain/details/{id}" class="btn btn-info btn-sm "><i class="glyphicon glyphicon-search"></i> View</a>
								</center>
							</td>						
							<td>
								<center>
									{attachment}
								</center>
							</td>
						</tr>
					{/complains_list}
					</tbody>
				</table>
				<div id="pagin"><center><?php if(isset($links)){echo $links;} ?></center></div>
				<?php
				}else{
				?>
					<div class="NoDataFound"><center>No Data Found</center></div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function($) {
	$('.datePicker').datepicker();
});
</script>