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
								Credits
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Grant History
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
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-info">
										<div class="panel-heading">Grant Credit To User</div>
										<div class="panel-body">
										
											<form method="POST" action="<?php echo base_url('franchise/Credits/grantCredit')?>">
											
												<div class="col-md-2">
													<label><b>Grant Amount*</b></label>
													<input type="number" name="amount" class="form-control input-sm" required min="0"  value="" max="<?php echo $this->Functions->getTopUp();?>">
												</div>
												
												<div class="col-md-3">
													<label><b>Select User*</b></label>
													<select class="form-control input-sm" name="user" required>
														<option value="">---SELECT---</option>
														<?php 
														$getUsersList = $this->db->select(array('user_id','username','full_name'))->from('users')->where('franchise_id',$this->session->userdata('franchise_id'))->where('user_id !=',$this->session->userdata('user_id'))->where('user_role','retailer')->get();
														
														if($getUsersList->num_rows()){
															
															foreach($getUsersList->result_array() as $user){
															
																echo "<option value='".$user['user_id']."'>".$user['full_name']." - ".$user['username']."</option>";
															
															}
														}
														else
														{
															echo "<option value=''>No Users Exist</option>";
														}
														?>
													</select>
												</div>
												
												<div class="col-md-5">
													<label>Remarks</label>
													<input type="text" name="remarks" class="form-control input-sm">
												</div>
												
												<div class="col-md-2">
													<br>
													<button type="submit" class="btn btn-success btn-sm">GRANT NOW <i class="fa fa-check fa-fw ace-icon"></i></button>
												</div>
											
											</form>
										</div>
									</div>

								</div>
							</div><!--./Row-->
							<table class="table table-striped table-bordered table-hover dataTable no-footer DTTT_selectable" id="data-table">
								<thead>
									<tr>
										<td>Sr #</td>
										<td>Date/Time</td>
										<td>Previous Credit</td>
										<td>Trasacted Credit</td>
										<td>Current</td>
										<td>Trasacted To</td>
										<td>Remarks</td>
									</tr>
								</thead>
								
								<tbody>
									<?php 
									
									$query = $this->db->select('*')->from('transactions')->where('franchise_id',$this->session->userdata('franchise_id'))->where('trans_from',$this->session->userdata('user_id'))->where('trans_type','GRANT')->order_by('trans_id','desc')->get();
									
									if($query->num_rows())
									{
										foreach($query->result_array() as $id=>$row){
											
											$usr = $this->db->select('username')->from('users')->where('user_id',$row['trans_to'])->get()->row();
											echo "<tr>";
											echo "<td>".($id+1)."</td>";
											echo "<td>".$row['trans_datetime']."</td>";
											echo "<td>".$row['previous_balance']."</td>";
											echo "<td>".$row['trans_amount']."</td>";
											echo "<td>".($row['previous_balance'] + $row['trans_amount'])."</td>";
											echo "<td>".$usr->username."</td>";
											echo "<td>".$row['remarks']."</td>";
											echo "</tr>";
										}
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

		<!-- basic scripts -->
		
		<!-- Get Footer Scripts -->
		<?php echo $this->PageLoadingFtns->getFootScripts();?>
		
		<!--Page Specific Scripts -->
		<script src="<?php echo base_url('assets/js/dataTables/jquery.dataTables.js')?>"></script>
		<script src="<?php echo base_url('assets/js/bootbox.js')?>"></script>
		<script src="<?php echo base_url('assets/js/dataTables/jquery.dataTables.bootstrap.js')?>"></script>
		<script src="<?php echo base_url('assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js')?>"></script>
		<script src="<?php echo base_url('assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js')?>"></script>
		<script>$("#data-table").dataTable();</script>

		
	</body>
</html>
