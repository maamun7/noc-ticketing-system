<div class="row">
    <div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2>Ticket list</h2>
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
							<th>Estimate time</th>
							<th><center>Status</center></th>
							<th><center>Action</center></th>
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
							<td>{customer_query}</td>
							<td>{complained_by}</td>
							<td>
								<center>
									<a class="btn btn-sm btn-success" data-target="#myModal" data-toggle="modal" href="<?php echo base_url(); ?>complain/receive/{id}"> <i class="glyphicon glyphicon-time"></i>  {mod_estimate_time} </a>
								</center>
							</td>
							<td>
								<center>
									<span class="btn btn-sm btn-{sts_class}" title="Received By: {noc_first_name} {noc_last_name} ,Estimate Time:{estimate_time} Minute" data-placement="top" data-toggle="tooltip">{sts_text}</span>
								</center>
							</td>
							<td>
								{support_notifications}
								<center>
									<a href="<?php echo base_url(); ?>complain/response/{id}" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-search"></i> View & Reply</a>
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