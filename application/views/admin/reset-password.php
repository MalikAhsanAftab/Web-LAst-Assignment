<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $this->PageLoadingFtns->getPageTitle(basename(__FILE__,".php"))?></title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<?php echo $this->PageLoadingFtns->getHeadScripts();?>
	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-bus green"></i>
									<span class="red"><?php echo $this->PageLoadingFtns->getConstants('site_title')?></span>
									<span class="white" id="id-text2">v<?php  echo $this->PageLoadingFtns->getConstants('version')?></span>
								</h1>
								<h4 class="blue" id="id-company-text">&copy; <?php  echo $this->PageLoadingFtns->getConstants('company_name')?></h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Reset Your Password
												<?php if($this->session->flashdata('msg'))
												{
													echo $this->session->flashdata('msg');
												}
												?>
											</h4>

											<div class="space-6"></div>

											<form method="POST" name="resetForm" action="./resetPassword">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="newPass" class="form-control" placeholder="New Password" required />
															<input type="hidden" name="email" value="<?php echo $email?>">
															<i class="ace-icon fa fa-key"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<!--<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> Remember Me</span>
														</label>-->

														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Reset</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

							
										</div><!-- /.widget-main -->
								</div><!-- /.login-box -->

							
	
							</div><!-- /.position-relative -->

						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->
		
			
	</body>
</html>
