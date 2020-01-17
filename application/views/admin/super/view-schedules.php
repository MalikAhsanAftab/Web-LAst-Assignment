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
								Schedules
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View Schedules
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
							
							<table class="table table-striped table-bordered table-hover dataTable no-footer DTTT_selectable" id="data-table">
								<thead>
									<tr>
										<th>Sr #</th>
										<th>Vehicle</th>
										<th>Route</th>
										<th>Days</th>
										<th>Time</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$this->db->select('*')->from('schedules');
									$this->db->join('vehicles','vehicles.vehicle_id = schedules.vehicle_id ');
									$this->db->join('routes','routes.route_id = schedules.route_id');
									$query = $this->db->get()->result_array();
									
									
									
									foreach($query as $key=>$row){
										
										echo "<tr>";
										echo "<td>".($key + 1)."</td>";
										echo "<td>".$row['vehicle_no']."</td>";
										echo "<td>".$row['departure']." - ".$row['arrival']."</td>";
										echo "<td>".$row['days']."</td>";
										echo "<td>".$row['schedule_time']."</td>";
										echo "<td>";
										echo "<a href='editSchedule/".$row['schedule_id']."' class='btn btn-primary btn-xs' title='Edit Schedule'><i class='ace-icon fa fa-edit bigger-150'></i></a>";
										echo "&nbsp;&nbsp;";
										echo "<a href='delSchedule/".$row['schedule_id']."' class='btn btn-danger btn-xs' title='Delete Schedule' onClick='return confirm(\" Are You Sure? \")'><i class='ace-icon fa fa-trash bigger-150'></i></a>";
										echo "</td>";
										echo "</tr>";

										}
									?>
								</tbody>
							</table>
							
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
		
		<!--Page Specific Scripts -->
		<script src="<?php echo base_url('assets/js/dataTables/jquery.dataTables.js')?>"></script>
		<script src="<?php echo base_url('assets/js/dataTables/jquery.dataTables.bootstrap.js')?>"></script>
		<script src="<?php echo base_url('assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js')?>"></script>
		<script src="<?php echo base_url('assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js')?>"></script>
		<script>$("#data-table").dataTable();</script>
	</body>
</html>
