<div class="row">
    <div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2>Ticket type list</h2>
			</div>
			<div class="box-content">	
			<?php
			if(!empty($ticket_types_list)){
			?>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Ticket type details</th>
						<th>Ordering</th>
						<th><center>Actions</center></th>
					</tr>
				</thead>
				<tbody>
				{ticket_types_list}
					<tr>
						<td>{sl}</td>
						<td>{details}</td>
						<td>{ordering}</td>
						<td>
							<center>
								<a class="btn btn-sm btn-info" href="<?php echo base_url().'ticket_type/edit/{id}'; ?>"><i class="glyphicon glyphicon-edit glyphicon-white"></i> Edit</a>
								<span class="deleteTicketType btn btn-sm btn-danger" name="{id}"><i class="glyphicon glyphicon-trash glyphicon-white"></i> Delete</span>
							</center>
						</td>
					</tr>
				{/ticket_types_list}
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
<script>
$(document).ready(function(){ 	
	var baseUrl = "<?php echo base_url(); ?>";
	//Delete 
	$(".deleteTicketType").click(function()
	{	
		var id=$(this).attr('name');
		var dataString = 'ticket_type_id='+ id;
		var x = confirm("Are You Sure,want to delete ?");
		if (x==true){
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"ticket_type/delete",
			data: dataString,
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});
		}
	});
});
</script>
