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
								Users / Franchise
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add New User
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
									<label><b>Enter Full Name</b></label>
									<input type="text" name="name" class="form-control" placeholder="Type Full Name" required>
								</div>
								
								<div class="col-md-6">
									<label><b>Enter Email</b></label>
									<input type="email" name="email" class="form-control" placeholder="Type Email" required>
								</div>
								
								<div class="col-md-6">
									<label><b>Enter Username</b></label>
									<input type="text" name="username" value="<?php echo $this->Functions->genUserId();?>" class="form-control" readonly required>
								</div>
								
								<div class="col-md-6">
									<label><b>Enter Password</b></label>
									<input type="text" name="password" class="form-control" placeholder="Type Password" required>
								</div>
								
								<div class="col-md-6">
									<label><b>Enter Contact No</b></label>
									<input type="number" name="contact" class="form-control" min=0 placeholder="Type Contact #" required>
								</div>
								
								<div class="col-md-6">
									<label><b>Enter CNIC #</b></label>
									<input type="number" name="cnic" class="form-control" min=0 placeholder="Type CNIC (Without Dashes)" required>
								</div>
																
								<div class="col-md-3">
									<label><b>Franchise</b></label>
									<select name="franchise_id" class="form-control" required>
										<option value="">----SELECT----</option>
										<?php
										
										$this->db->select(array('franchise_id','fname','flocation'))->from('franchises');
										$query = $this->db->get();
										
										foreach($query->result_array() as $q){
											
											echo "<option value='".$q['franchise_id']."'>".$q['fname']." (".$q['flocation'].")</option>";
										}
										?>
									</select>
								</div>
								<div class="col-md-3">
									<label><b>User Role</b></label>
									<select name="role" class="form-control">
										<option value="franchise">Franchise</option>
										<!--<option value="user">User</option>-->
										<!--<option value="super">Super</option>-->
									</select>
								</div>
								
								<div class="col-md-3">
									<label><b>Comission (%)</b></label>
										<input type="number" id="cm" onChange="calculateAmount();" onKeyup="calculateAmount();" value="10" min="0" max="100" name="comission" class="form-control">							
								</div>
								
								<div class="col-md-3">
									<label><b>Top Up</b> | Final Amount: <span id="finalAmount" style="color:blue"></span></label>
									<input type="number" id="topup" onChange="calculateAmount();" onKeyup="calculateAmount();" value="0" min="0" name="topup" class="form-control">
								</div>
								
								<script>
									function calculateAmount(){
										
										var cm = parseInt($("#cm").val());
										
										var amount = parseInt($("#topup").val());
										
										var total = parseInt(((cm / 100) * amount) + amount);
										
										$("#finalAmount").html(total);
										
									}
								</script>
								
								<div class="col-md-12">
									<br>
									<button class="btn btn-success">Add User <i class="fa fa-plus fa-fw"></i></button>
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
