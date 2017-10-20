<div class="row">
	<div class="box col-md-12">

        <div class="box-content">
            <div class="form-group has-success col-md-12">
                <center style="color:#ff6707;font-weight: bold">Cellex Limited</center>
                <a class="pull-right" style="color:#ff0000;" data-dismiss="modal" href="#"> &times Close</a>
            </div>
        </div>
		<form class="form-vertical" action="<?php echo $action; ?>" id="" method="post"  name="insert_product" enctype="multypart/formdata">
			<div class="box-content">	
				<div class="form-group has-success col-md-6">
					<label class="control-label" for="inputSuccess1">Estimate time	</label>
					<input type="text" class="form-control" name="estimate_time" id="inputSuccess1" value="<?php if(isset($estimate_time)){ echo $estimate_time; } ?>" placeholder="Enter estimate time">
				</div>
				<div class="form-group has-success col-md-6">
					<label class="control-label" for="inputSuccess1">
						&nbsp;
					</label>
					<button type="submit" class="btn btn-success pull-right" style="margin-top:23px;">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>
