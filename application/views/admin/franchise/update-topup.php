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
			
				<div class="page-header">
							<h1>
								Topup
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Grant Credit To User
								</small>
							</h1>
						</div>
						
				<div class="page-content"> 
				<?php if($this->session->flashdata('msg')){
								
								echo $this->session->flashdata('msg');
							}
				?>			
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<form method="POST">
								<div class="col-md-6">
									<label>Enter Topup Amount</label>
									<input type="number" name="topupAmount" class="form-control" max="<?php echo $this->Functions->getTopUp()?>">
								</div>
								<div class="col-md-6">
									<br>
									<button type="submit" name="button" class="btn btn-success">Grant Now</button>
								</div>
							<form>
							
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
