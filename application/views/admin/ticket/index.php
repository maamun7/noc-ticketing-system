<div class="row">
    <div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2>Ticket list</h2>
			</div>
			<div class="box-content">	
				<?php
				if(!empty($ticket_lists)){
				?>
				<table class="table table-striped table-bordered responsive">
					<thead>
						<tr>
							<th>#</th>
							<th>Date</th>
							<th>Ticket ID</th>
							<th>Ticket Type</th>
							<th>Description</th>
							<th><center>Status</center></th>
							<th><center>Action</center></th>
							<th><center>Attachment</center></th>
						</tr>
					</thead>
					<tbody>
					{ticket_lists}
						<tr>
							<td>{sl}</td>
							<td>{final_date}</td>
							<td>{ticket_number}</td>
							<td>{details}</td>
							<td>{customer_query}</td>
							<td>
								<center>
									<span class="btn btn-sm btn-{sts_class}" title="{done_and_received} ,Estimate Time:{estimate_time} Minute" data-placement="top" data-toggle="tooltip">{sts_text}</span>
								</center>
							</td>
							<td>
								{user_notifications}
								<center>
									<a href="<?php echo base_url(); ?>query/response/{id}" class="btn btn-info btn-sm "><i class="glyphicon glyphicon-search"></i>  {access_status}</a>
									<a class="btn btn-sm btn-primary" href="<?php echo base_url().'query/edit_ticket/{id}'; ?>"><i class="glyphicon glyphicon-edit glyphicon-white"></i> Edit</a>
								</center>
							</td>							
							<td>
								<center>
									{attachment}
								</center>
							</td>
						</tr>
					{/ticket_lists}
					</tbody>
				</table>
				<center><?php if(isset($links)){echo $links;} ?></center>
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
	$(document).ready(function(){
		setInterval(function() {
			window.location.reload();
		}, 60000); //30 Second
	});
</script>