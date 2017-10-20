<!-- topbar Starts -->
<div class="navbar navbar-default" role="navigation">
	<div id="main" class="col-md-11">
		<div class="navbar-inner">
			<a style="float:left;" href="<?php echo base_url(); ?>"> 
				{logo}
			</a>
			
			<!--Main Menu-->
			<?php
			if($top_menu_items){			
			?>					
				{logindata}
				{mainmenu}
			<?php
			}
			?>
		
		</div>
	</div>
</div>
<!-- topbar ends -->