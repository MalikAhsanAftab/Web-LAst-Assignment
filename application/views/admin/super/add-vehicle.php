<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $this->PageLoadingFtns->getPageTitle(basename(__FILE__,".php"))?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- Get Header Scripts -->
		<?php echo $this->PageLoadingFtns->getHeadScripts();?>
	</head>

	<body class="no-skin">
		<!-- #section:basics/navbar.layout -->
			
			<!-- Get Navigation Bar -->
			<?php echo $this->PageLoadingFtns->getNavBar();?>
			
			
			<div class="main-content">
			
				<div class="page-content">
				
					<div class="page-header">
							<h1>
								Vehicles
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add New Vehicle
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
									<label><b>Reg No</b></label>
									<input type="text" name="vehicle_no" class="form-control" placeholder="Type Reg # Of Vehicle e.g. RIN-9097" required>
								</div>
								
								
								<div class="col-md-6">
									<label><b>Vehicle Type </b></label>
									<br>
									<select name="vehicle_type" class="form-control" required>
										<option value="">----SELECT----</option>
										<option value="Cab">Cab</option>
									</select>	
								</div>
								
								<div class="col-md-6">
									<label><b>Vehicle Class</b></label>
									<select name="vehicle_class" class="form-control" required>
										<option value="">----SELECT----</option>
										<option value="Luxury">Luxury</option>
									</select>	
								</div>
								
								<div class="col-md-6">
									<label><b>Vehicle Make</b></label>
									<select name="vehicle_make" class="form-control" required>
										<option value="">----SELECT----</option>
										<option value="Toyota">Toyota</option>
										<option value="Honda">Honda</option>
										<option value="Suzuki">Suzuki</option>
									</select>	
								</div>
								
								<div class="col-md-3">
									<label><b>Vehicle Model</b></label>
									<input type="number" min="1900" class="form-control" max="<?php echo date("Y")?>" name="vehicle_model">
								</div>
								
								<div class="col-md-3">
									<label><b>Vehicle Color</b></label>
									<select name="vehicle_color" class="form-control" required>
										<option value="">----SELECT----</option>
										<option value="White">White</option>
										<option value="Black">Black</option>
										<option value="Gray">Gray</option>
										<option value="Maroon">Maroon</option>
										<option value="Silver">Silver</option>
										
									</select>	
								</div>
								
								<div class="col-md-6">
									<label><b>No Of Seats</b></label>
									<input type="number" min="0"  value="3" name="no_of_seats" class="form-control" required>
								</div>
									
								
								<div class="col-md-12">
									<br>
									<button class="btn btn-success">Add Vehicle <i class="fa fa-plus fa-fw"></i></button>
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

		<!-- basic scripts -->
		
		<!-- Get Footer Scripts -->
		<?php echo $this->PageLoadingFtns->getFootScripts();?>

		
	</body>
</html>
