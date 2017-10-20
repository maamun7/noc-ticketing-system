<div class="row">
    <div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2>Details</h2>
			</div>
			<div class="box-content">
			
				<?php
				if(!empty($detail_datas)){
				?>				
					<blockquote>
						<h5><span style="color:#000;">Date:</span> <?php echo $detail_datas[0]['final_date']; ?></h5>
						<h5><span style="color:#000;">Complained by:</span> <?php echo $detail_datas[0]['complained_by']; ?></h5>
					</blockquote>
					<div class="page-header">
						<h4>Ticket type: 
							<small><?php echo $detail_datas[0]['details']; ?></small>
						</h4>						
					</div>
					<h4>Complain Details:</h4><br/>
					<?php echo $detail_datas[0]['complain_details']; ?>
					<div class="page-header"></div>
					<?php
					if(!empty($response_datas)){						
						foreach ($response_datas as $key => $value) {						
					?>		
						<div class="col-md-12">
							<blockquote class=" <?php if($detail_datas[0]['user_id'] != $value['response_by_id']){ echo 'pull-right'; } ?>" >
								<h5><span style="color:#000;">Response at:</span> <?php echo $value['final_date']; ?></h5>
								<h5><span style="color:#000;">Response by:</span> <?php echo $value['responsed_by']; ?></h5>
								</br>
								<small><?php echo $value['message']; ?></small>
							</blockquote>
						</div>
					<?php
						}
					}
					?>
					<div class="input-group col-md-12">
						&nbsp;
					</div>
					<br/>
					
				<?php
				}else{
				?>
					<div class="NoDataFound"><center>No data found</center></div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>


