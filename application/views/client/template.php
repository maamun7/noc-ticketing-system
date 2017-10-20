<!DOCTYPE html>
<html lang="en">
<head>   
	<title><?php echo (isset($title)) ? $title :"Ticketing" ?></title>
	<?=$this->load->view('client/include/head')?>
    <link rel="shortcut icon" href="img/favicon.ico">	
	<style>
		#main {float: none; margin-left: auto;  margin-right: auto;padding:0 !important;}
	</style>
</head>
<body>	
	 <script type="text/javascript">
        $('body').on('hidden.bs.modal', '.modal', function () {
		    $(this).removeData('bs.modal');
		});
    </script>
	<div class="ch-container">
		<div class="row">
			<?=$this->load->view('client/include/header')?>
			<div id="main" class="col-md-11" style="min-height:450px;">
				{msg_content}
				{sub_menu}
				{content}
			</div>
		</div><!--/fluid-row-->
		<?=$this->load->view('client/include/footer')?>
	</div><!--/.fluid-container-->
	<!-- external javascript -->
	<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- library for cookie management -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>
	<!-- calender plugin -->
	<script src='<?php echo base_url(); ?>assets/bower_components/moment/min/moment.min.js'></script>
	<script src='<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js'></script>

	<!-- select or dropdown enhancer -->
	<script src="<?php echo base_url(); ?>assets/bower_components/chosen/chosen.jquery.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="<?php echo base_url(); ?>assets/bower_components/colorbox/jquery.colorbox-min.js"></script>
	<!-- notification plugin -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.noty.js"></script>
	<!-- library for making tables responsive -->
	<script src="<?php echo base_url(); ?>assets/bower_components/responsive-tables/responsive-tables.js"></script>
	<!-- tour plugin -->
	<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
	<!-- star rating plugin -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="<?php echo base_url(); ?>assets/js/charisma.js"></script>

	<?php //Google Analytics code for tracking my demo site, you can remove this.
	if ($_SERVER['HTTP_HOST'] == 'usman.it') {
		?>
		<script>
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-26532312-1']);
			_gaq.push(['_trackPageview']);
			(function () {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
			})();
		</script>
	<?php } ?>
</body>
</html>