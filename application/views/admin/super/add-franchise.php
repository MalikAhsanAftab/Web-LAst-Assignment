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
								Franchises
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add New Franchise
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
									<label><b>Enter Franchise Name</b></label>
									<input type="text" name="name" class="form-control" placeholder="Type Full Name" required>
								</div>
								
								<div class="col-md-6">
									<label><b>Enter Email</b></label>
									<input type="email" name="email" class="form-control" placeholder="Type Email" required>
								</div>
								
								<div class="col-md-6">
									<label><b>Enter Location</b></label>
									<input type="text" name="location" class="form-control" placeholder="Type Location e.g. Islamabad" required>
								</div>
								
								<div class="col-md-6">
									<label><b>Enter Address</b></label>
									<textarea class="form-control" name="address" placeholder="Complete Franchise Address" required></textarea>
								</div>
								
								<div class="col-md-12">
									<br>
									<button class="btn btn-success">Add Franchise <i class="fa fa-plus fa-fw"></i></button>
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
