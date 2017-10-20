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
								<?php echo $value['message']; ?>
							</blockquote>
						</div>
					<?php
						}
					}
					?>
					<?php if($view_response_form){ ?>
					<div class="box col-md-8">
						<form class="form-vertical" action="{action}" id="" method="post"  name="insert_product" enctype="multypart/formdata">
							<div class="box-content">
								<div class="form-group has-primary col-md-12">
									<label class="control-label" for="inputSuccess1">Response Details*
										<?php if (isset($error_response_details)) { ?>
											<span style="color:red;font-size:11px;"><?php echo $error_response_details; ?></span>
										<?php } ?>
									</label>
									<textarea class="form-control" rows="10" name="response_details" placeholder="Response Details"><?php if (isset($response_details_value)) { echo $response_details_value; } ?></textarea>
								</div>
								<div class="form-group has-primary col-md-12">
									<label class="control-label" for="inputError1"> Send as *
										<?php if (isset($error_send_type)) { ?>
											<span style="color:red;font-size:11px;"><?php echo $error_send_type; ?></span>
										<?php } ?>
									</label>
									<select class="form-control" name="send_type" >
										<option value="" >Select send as</option>
										<option value="3" <?php if(isset($send_type_value) && $send_type_value =="1"){ echo "selected='selected'"; } ?> >Open</option>
										<option value="2" <?php if(isset($send_type_value) && $send_type_value =="2"){ echo "selected='selected'"; } ?> >On going</option>
										<option value="1" <?php if(isset($send_type_value) && $send_type_value =="3"){ echo "selected='selected'"; } ?> >Done</option>
									</select>
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
					<div class="box col-md-4">&nbsp;</div>
					<br>
					<div class="input-group col-md-12">
						&nbsp;
					</div>
					<br/>
					
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


