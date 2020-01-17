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
									<input type="text" name="name" value="<?php echo $user->full_name?>" class="form-control" placeholder="Type Full Name" required>
								</div>
								
								<div class="col-md-3">
									<label><b>Enter Email</b></label>
									<input type="email" name="email" value="<?php echo $user->email?>" class="form-control" placeholder="Type Email" required>
								</div>
								
								<div class="col-md-3">
									<label><b>Enter Username</b></label>
									<input type="text" name="username" class="form-control" value="<?php echo $user->username?>" readonly required>
								</div>
								
								<div class="col-md-3">
									<label><b>Enter Password</b></label>
									<input type="text" name="password" class="form-control" placeholder="Type New Password To Change Or Leave Empty To Keep Old Password">
								</div>
								
								<div class="col-md-3">
									<label><b>Enter Contact No</b></label>
									<input type="number" name="contact" class="form-control" value="<?php echo $user->contact?>"  placeholder="Type Contact #" required>
								</div>
								
								<div class="col-md-3">
									<label><b>Enter CNIC #</b></label>
									<input type="number" name="cnic" class="form-control" value="<?php echo $user->cnic?>" placeholder="Type CNIC (Without Dashes)" required>
								</div>
								
								<!--<div class="col-md-6">
									<label><b>User Role</b></label>
									<select name="role" onClick="checkRole(this.value)" class="form-control" required>
										<option value="">----SELECT----</option>
										<option value="user">User</option>
										<option value="retailer">Retailer</option>
									</select>
									
								</div>-->
								
								
								<?php $retailerFields = ($user->user_role == "retailer")?"":"display:none";?>
								<div class="retailerFields" style="<?php echo $retailerFields?>">
																
								<div class="col-md-6">
									<label><b>Shop Name</b></label>
									<input type="text" name="shop_name" value="<?php echo $user->shop_name?>" class="form-control retailerFieldsRequired" <?php echo $required?> placeholder="Type Shop Name">
								</div>
								
								<div class="col-md-6">
									<label><b>Shop Address</b></label>
									<input type="text" name="shop_address" value="<?php echo $user->shop_address?>" class="form-control retailerFieldsRequired" <?php echo $required?> placeholder="Type Shop Address">
								</div>
								
								<div class="col-md-6">
									<label><b>Comission</b></label>
									<select name="comission" id="cm" <?php echo $required?> class="form-control retailerFieldsRequired" >
										<option value="">----SELECT----</option>
										<option <?php echo (($user->comission == 8)?"selected":"");?> value="8">8%</option>
										<option <?php echo (($user->comission == 10)?"selected":"");?> value="10">10%</option>
									</select>
									
								</div>
							
								</div>

								<div class="col-md-12">
									<br>
									<button class="btn btn-success">Update User <i class="fa fa-plus fa-fw"></i></button>
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
