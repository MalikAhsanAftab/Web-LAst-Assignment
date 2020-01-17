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
									View Users
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
										<th>Full Name</th>
										<th>Username</th>
										<th>Email</th>
										<th>Contact</th>
										<th>Cnic</th>
										<th>Topup</th>
										<th>Comission</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query =  $this->db->get_where('users',array('user_role !=' => 'super','user_role !=' => 'user','user_id !=' => $this->session->userdata('franchise_id')));
									foreach($query->result_array() as $key=>$row){
										
										echo "<tr>";
										echo "<td>".($key + 1)."</td>";
										echo "<td>".$row['full_name']."</td>";
										echo "<td>".$row['username']."</td>";
										echo "<td>".$row['email']."</td>";
										echo "<td>".$row['contact']."</td>";
										echo "<td>".$row['cnic']."</td>";
										echo "<td>".$row['topup']." Rs</td>";
										echo "<td>".$row['comission']."%</td>";
										echo "<td>";
										
										echo "<a href='editUser/".$row['user_id']."' class='btn btn-primary btn-xs' title='Edit User'><i class='ace-icon fa fa-edit bigger-150'></i></a>";
										if($this->session->userdata('user_id') != $row['user_id']){
										echo "&nbsp;&nbsp;";
										echo "<a href='delUser/".$row['user_id']."' class='btn btn-danger btn-xs' title='Delete User' onClick='return confirm(\" Are You Sure? \")'><i class='ace-icon fa fa-trash bigger-150'></i></a>";
										echo "&nbsp;&nbsp;";
										echo "<a href='updateTopup/".$row['user_id']."' class='btn btn-success btn-xs' title='Update Topup'><i class='ace-icon fa fa-money bigger-150'></i></a>";
										}
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
