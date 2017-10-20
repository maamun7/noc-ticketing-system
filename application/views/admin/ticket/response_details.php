<div class="row">
    <div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2>Details</h2>
			</div>
			<div class="box-content"  style="overflow:auto;">
			
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
								<?php echo $value['message']; ?>
							</blockquote>
						</div>
					<?php
						}
					}
					?>
					<?php if($can_reply){ ?>
					<div class="box col-md-8">
						<form class="form-vertical" action="{action}" id="" method="post"  name="insert_product" enctype="multypart/formdata">
							<div class="box-content">
								<div class="form-group has-primary col-md-12">
									<label class="control-label" for="inputSuccess1">Response Details*
										<?php if (isset($error_response_details)) { ?>
											<span style="color:red;font-size:11px;"><?php echo $error_response_details; ?></span>
										<?php } ?>
									</label>
									<textarea class="form-control txtEditor" rows="10" name="response_details" placeholder="Response Details"><?php if (isset($response_details_value)) { echo $response_details_value; } ?></textarea>
								</div>
								
								<div class="input-group col-md-8">
									&nbsp;
									<input type="hidden" name="complain_id" value="{complain_id}">
								</div>
								<div class="form-group has-success col-md-12">
									<button type="submit" class="btn btn-primary btn-lg pull-right">Send</button>
								</div>
								<br>
								<div class="input-group col-md-12">
									&nbsp;
								</div>
							</div>
						</form>
					</div>	
					<?php } ?>					
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
    $('.txtEditor').jqte();
</script>

