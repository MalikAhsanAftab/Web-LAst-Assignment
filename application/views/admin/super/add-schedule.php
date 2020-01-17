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
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-multiselect.css")?>"/>


	</head>

	<body class="no-skin">
		<!-- #section:basics/navbar.layout -->
			
			<!-- Get Navigation Bar -->
			<?php echo $this->PageLoadingFtns->getNavBar();?>
			
			
			<div class="main-content">
			
				<div class="page-content">
				
					<div class="page-header">
							<h1>
								Schedules
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add New Schedule
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
									<label><b>Select Vehicle</b></label>
									<select name="vehicle_id" class="form-control" required >
										<option value="">----SELECT----</option>
										<?php
										
										$this->db->select(array('vehicle_id','vehicle_no','vehicle_type','vehicle_class'))->from('vehicles');
										$query = $this->db->get();
										
										foreach($query->result_array() as $q){
											
											echo "<option value='".$q['vehicle_id']."'>".$q['vehicle_no']." - ".$q['vehicle_type']." (".$q['vehicle_class'].")</option>";
										}
										?>
									</select>
								</div>
								
								<div class="col-md-6">
									<label><b>Select Route</b></label>
									<select name="route_id" class="form-control" required >
										<option value="">----SELECT----</option>
										<?php 
										$routes = $this->db->get('routes')->result_array();
										
										foreach($routes as $row){
											
											echo "<option value='".$row['route_id']."'>".$row['departure']." - ".$row['arrival']."</option>";
										}
										?>
									</select>
								</div>
								
								<div class="col-md-6">
									<label><b>Days</b></label>
									<br>
									<select name="days[]" class="multiselect form-control" multiple="" required>
												<option value="Monday">Monday</option>
												<option value="Tuesday">Tuesday</option>
												<option value="Wednesday">Wednesday</option>
												<option value="Thursday">Thursday</option>
												<option value="Friday">Friday</option>
												<option value="Saturday">Saturday</option>
												<option value="Sunday">Sunday</option>
											</select>
								</div>
								
								<div class="col-md-6">
									<label><b>Schedule Time</b></label>
									<input type="text" id="timepicker" name="time" class="form-control" required />
								</div>
								
								<div class="col-md-12">
									<br>
									<button class="btn btn-success" type="submit">Add Schedule <i class="fa fa-plus fa-fw"></i></button>
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
		<script src="<?php echo base_url("assets/js/bootstrap-multiselect.js")?>"></script>

		
		<script>
			$('#timepicker').timepicker({
					minuteStep: 1,
					defaultTime : "00:00",
					showSeconds: false,
					showMeridian: false
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
			$('.multiselect').multiselect({
				 enableFiltering: false,
				 buttonClass: 'btn btn-white btn-primary',
				 templates: {
					button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"></button>',
					ul: '<ul class="multiselect-container dropdown-menu"></ul>',
					filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
					filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
					li: '<li><a href="javascript:void(0);"><label></label></a></li>',
					divider: '<li class="multiselect-item divider"></li>',
					liGroup: '<li class="multiselect-item group"><label class="multiselect-group"></label></li>'
				 }
				});
	

		</script>
	</body>
</html>
