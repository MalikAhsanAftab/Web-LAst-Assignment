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
								Users
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
								<div class="col-md-3">
									<label><b>Enter Full Name</b></label>
									<input type="text" name="name" class="form-control" placeholder="Type Full Name" required>
								</div>
								
								<div class="col-md-3">
									<label><b>Enter Email</b></label>
									<input type="email" name="email" class="form-control" placeholder="Type Email" required>
								</div>
								
								<div class="col-md-3">
									<label><b>Enter Username</b></label>
									<input type="text" name="username" class="form-control" value="<?php echo $this->Functions->genUserId($this->session->userdata('franchise_id'));?>" readonly required>
								</div>
								
								<div class="col-md-3">
									<label><b>Enter Password</b></label>
									<input type="text" name="password" class="form-control" placeholder="Type Password" required>
								</div>
								
								<div class="col-md-3">
									<label><b>Enter Contact No</b></label>
									<input type="number" name="contact" class="form-control" placeholder="Type Contact #" required>
								</div>
								
								<div class="col-md-3">
									<label><b>Enter CNIC #</b></label>
									<input type="number" name="cnic" class="form-control" placeholder="Type CNIC (Without Dashes)" required>
								</div>
								
								<div class="col-md-6">
									<label><b>User Role</b></label>
									<select name="role" onClick="checkRole(this.value)" class="form-control" required>
										<option value="">----SELECT----</option>
										<option value="user">User</option>
										<option value="retailer">Retailer</option>
									</select>
									
								</div>
								
								<div class="retailerFields" style="display:none">
																
								<div class="col-md-6">
									<label><b>Shop Name</b></label>
									<input type="text" name="shop_name" class="form-control retailerFieldsRequired" placeholder="Type Shop Name">
								</div>
								
								<div class="col-md-6">
									<label><b>Shop Address</b></label>
									<input type="text" name="shop_address" class="form-control retailerFieldsRequired" placeholder="Type Shop Address">
								</div>
								
								<div class="col-md-6">
									<label><b>Comission</b></label>
									<select name="comission" onChange="calculateAmount();" id="cm" class="form-control retailerFieldsRequired" >
										<option value="">----SELECT----</option>
										<option value="8">8%</option>
										<option value="10">10%</option>
									</select>
									
								</div>
								
								<div class="col-md-6">
									<label><b>Top Up</b> | Final Amount: <span id="finalAmount" style="color:blue"></span></label>
									<input type="number" id="topup" onChange="calculateAmount();" onKeyup="calculateAmount(this.value);" value="0" min="0" max="<?php echo $this->Functions->getTopUp()?>" name="topup" class="form-control retailerFieldsRequired">
								</div>
								
								<script>
									function calculateAmount(){
										
										var cm = parseInt($("#cm").val());
										
										var amount = parseInt($("#topup").val());
										
										var total = parseInt(((cm / 100) * amount) + amount);
										
										$("#finalAmount").html(total);
										
									}
								</script>
								</div>
								
								<script>
								function checkRole(role){
									
									if(role == "retailer"){
										$(".retailerFields").show();
										$(".retailerFieldsRequired").attr("required","required");
									}
									else{
										
										$(".retailerFields").hide();
										$(".retailerFieldsRequired").removeAttr("required");
									}

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
