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
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							
							<?php if($this->session->flashdata('msg')){
								
								echo $this->session->flashdata('msg');
							}
							?>
							
							<h1>SYSTEM BACKUPS</h1>
							<br><br>
							
							<form method="POST">
							
							<div class="col-md-6">
		
								<label><b>Choose Data To Backup</b></label>
								<select name="toBackup" required class="form-control">
									<option value="">----SELECT TYPE OF BACKUP----</option>
									<option value="all">BACKUP *WHOLE* DATABASE</option>
									<?php
									$tables = $this->db->list_tables();

									foreach ($tables as $table)
									{
									   echo "<option value='".$table."'>BACKUP << ".strtoupper($table)." >> ONLY </option>";
									}									
									?>
								</select>
								
							</div>
							<div class="col-md-6">
								<label><b>Download File?</b></label>
								<br>
								<input type="checkbox" name="download" value="1" checked> Check This Box To Download File After Backup
							</div>
							
							<div class="col-md-3">
								<br>
								<button type="submit" class="btn btn-success">PROCEED TO BACKUP <i class="fa fa-arrow-right"></i></button>
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
