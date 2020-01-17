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
									Topup History
								</small>
							</h1>
						</div>
						
				<div class="page-content">
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<table class="table table-striped table-bordered table-hover dataTable no-footer DTTT_selectable" id="data-table">
								<thead>
									<tr>
										<td>Sr #</td>
										<td>Date/Time</td>
										<td>Previous Credit</td>
										<td>Trasacted Credit</td>
										<td>Current</td>
										<td>Remarks</td>
									</tr>
								</thead>
								
								<tbody>
									<?php 
									
									$query = $this->db->select('*')->from('transactions')->where('trans_to',$this->session->userdata('user_id'))->order_by('trans_id','desc')->get();
									
									if($query->num_rows())
									{
										foreach($query->result_array() as $id=>$row){
											
											echo "<tr>";
											echo "<td>".($id+1)."</td>";
											echo "<td>".$row['trans_datetime']."</td>";
											echo "<td>".$row['previous_balance']."</td>";
											echo "<td>".$row['trans_amount']."</td>";
											echo "<td>".($row['previous_balance'] + $row['trans_amount'])."</td>";
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
