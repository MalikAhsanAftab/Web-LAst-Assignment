<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $this->PageLoadingFtns->getPageTitle(basename(__FILE__,".php"))?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- Get Header Scripts -->
		<?php echo $this->PageLoadingFtns->getHeadScripts();?>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-timepicker.css")?>" />

	</head>

	<body class="no-skin">
		<!-- #section:basics/navbar.layout -->
			
			<!-- Get Navigation Bar -->
			<?php echo $this->PageLoadingFtns->getNavBar();?>
			
			
			<div class="main-content">
			
				<div class="page-content">
				
					<div class="page-header">
							<h1>
								Routes
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add New Route
								</small>
							</h1>
						</div>
				
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<?php 
							
							if($this->session->flashdata('msg')){
								
								echo $this->session->flashdata('msg');
							}
							?>
							<form method="POST">
								
								<div class="col-md-6">
									<label><b>Departure City</b></label>
									<select name="departure" class="form-control" required>
										<option value="">----SELECT----</option>
										<?php 
										echo $this->Functions->getCities();
										?>
									</select>
								</div>
								
								<div class="col-md-6">
									<label><b>Arrival City</b></label>
									<select name="arrival" class="form-control" required>
										<option value="">----SELECT----</option>
										<?php 
										echo $this->Functions->getCities();
										?>
									</select>
								</div>
								
								<div class="col-md-6">
									<label><b>Route Duration</b></label>
									<input type="text" name="duration" id="timepicker" class="form-control"/>
								</div>
								
								<div class="col-md-6">
									<label><b>Route Fare</b></label>
									<input type="number" name="fare" min=0 value=0 class="form-control"/>
								</div>
								
								<div class="col-md-12">
									<br>
									<button class="btn btn-success" type="submit">Add Route <i class="fa fa-plus fa-fw"></i></button>
								</div>
							</form>
							
							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div><!-- /.main-content -->
			
			<!-- Get Footer -->
			<?php echo $this->PageLoadingFtns->getFooter();?>
			
		</div><!-- /.main-container -->

		
		<!-- Get Footer Scripts -->
		<?php echo $this->PageLoadingFtns->getFootScripts();?>
		
		<!-- Page Specific Scripts -->
		<script src="<?php echo base_url("assets/js/date-time/bootstrap-timepicker.js")?>"></script>
		
		<script>
			$('#timepicker').timepicker({
					minuteStep: 1,
					defaultTime : "00:00",
					showSeconds: false,
					showMeridian: false
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});

		</script>
	</body>
</html>
