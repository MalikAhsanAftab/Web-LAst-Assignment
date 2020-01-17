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
								Tickets
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View Tickets
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
							
							<?php
							
							$role_id = ($this->Functions->isFranchise())?"franchise_id":"user_id";
							
							$this->db->select('*')->from('tickets')->join('routes','routes.route_id = tickets.route_id')->join('vehicles','vehicles.vehicle_id = tickets.vehicle_id');
							if(!$this->Functions->isSuper()){
							$this->db->where("tickets.".$role_id,$this->session->userdata($role_id));
							}
							// Apply Filter If Any
							if(isset($filters)){
								
								if($filters['dateFrom'] && $filters['dateTo']){
									
									$this->db->where('DATE(created_on) BETWEEN "'.date_format(date_create($filters['dateFrom']),'Y-m-d').'" AND "'.date_format(date_create($filters['dateTo']),"Y-m-d").'"');
								}
								
								if($filters['agentFilter']){
									
									$this->db->where('user_id',$filters['agentFilter']);
								}
								
							}
							
							// User Role Check
							if(!$this->Functions->isSuper()){
								
								if($this->Functions->isFranchise())
								{
									$this->db->where('franchise_id',$this->session->userdata('franchise_id'));
								}
								else
								{
									$this->db->where('user_id',$this->session->userdata('user_id'));
								}
							}
							
							$this->db->order_by('ticket_id','desc');
							
							$query = $this->db->get();
							?>
							
							<div class="col-md-12">
							
							<form method="POST">
								<div class="col-md-3">
									<label>Start Date</label>
									<input type="text" class="form-control date-picker input-sm" placeholder="dd/mm/yyyy" value="<?php echo ((isset($filters))?$filters['dateFrom']:"")?>" name="from" required >
								</div>
								<div class="col-md-3">
									<label>End Date</label>
									<input type="text" class="form-control date-picker input-sm" name="to" placeholder="dd/mm/yyyy" value="<?php echo ((isset($filters))?$filters['dateTo']:"")?>" required >
								</div>
								<?php if($this->Functions->isFranchise()){?>
								<div class="col-md-3">
									<label>Agent</label>
									<select name="agentFilter" class="form-control input-sm">
										<option value="">---Select---</option>
										<?php 
										$agents = $this->db->select(array('user_id','username','full_name','user_role'))->from('users')->where('franchise_id',$this->session->userdata('franchise_id'))->get();
										
										if($agents->num_rows()){
											
											foreach($agents->result_array() as $a){
												
												echo  "<option ".((isset($filters['agentFilter']) && $a['user_id'] == $filters['agentFilter'])?"selected":"")." value='".$a['user_id']."'>".$a['full_name']." - ".$a['username']." (".ucFirst($a['user_role']).")</option>";
											}												
										}
										?>
									</select>
								</div>
								<?php } ?>
								<div class="col-md-3">
									<br>
									<button type="submit" class="btn btn-success btn-sm">Filter <i class="fa fa-filter"></i></button>
							        <a type="button" class="btn btn-danger btn-sm" href="<?php echo current_url()?>">Clear <i class="fa fa-times"></i></a>									
								</div>
								
							</form>
							</div>
							
							<br><br><br><br>

							<table class="table table-striped table-bordered table-hover dataTable">
								<thead>
									<tr>
										<th>Sr #</th>
										<th>PNR</th>
										<th>P.Name</th>
										<th>Contact</th>
										<th>Route</th>
										<th>Depart Time</th>
										<th>Seats</th>
										<th>Fare</th>
										<th>CM.</th>
										<th>Sold By</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$totalAmountWithoutComission = 0;
									$totalComission = 0;
									$totalAmountWithComission = 0;
									
									if($query->num_rows()){
										
									foreach($query->result_array() as $key=>$row){
										
										$soldBy = $this->db->select(array('username','user_id'))->from('users')->where('user_id',$row['user_id'])->get()->row();
										
										echo "<tr>";
										echo "<td>".($key + 1)."</td>";
										echo "<td>".$row['pnr']."</td>";
										echo "<td>".$row['passenger_name']."</td>";
										echo "<td>".$row['contact_no']."</td>";
										echo "<td>".$row['departure']." - ".$row['arrival']."</td>";
										echo "<td>".$row['depart_datetime']."</td>";
										echo "<td>".$row['selected_seats_no']."</td>";
										echo "<td>".$row['total_fare']." Rs.</td>";
										echo "<td>".$this->Functions->calculateComission($row['total_fare'],$soldBy->user_id)." Rs</td>";
										echo "<td>".$soldBy->username."</td>";
										echo "<td>";
										echo "<a href='printTicket/".$row['ticket_id']."' target='_BLANK' class='btn btn-primary btn-xs' title='Print This Ticket'><i class='ace-icon fa fa-print bigger-150'></i></a>";
										echo "&nbsp;&nbsp;";
										//echo "<a href='cancelTicket/".$row['ticket_id']."' class='btn btn-warning btn-xs' title='Cancel This Ticket (Percentage Will Be Deducted)'  onClick='return confirm(\"Are You Sure? WARNING This Action is IRREVERSABLE NOTE: Ticket Will be reversed with some percentage deduction. Press OK TO CONTINUE.\")'><i class='ace-icon fa fa-times bigger-150'></i></a>";
										echo "</td>";
										echo "</tr>";
										
										$totalAmountWithoutComission += $row['total_fare'] ;
										$totalComission += $this->Functions->calculateComission($row['total_fare'],$soldBy->user_id);
										$totalAmountWithComission += $row['total_fare'] + $this->Functions->calculateComission($row['total_fare'],$soldBy->user_id);

									}
								}
									?>
								</tbody>
								
								<tfoot>
									<tr class="success">
										<td colspan="7"><b>TOTALS</b></td>
										<td><?php echo $totalAmountWithoutComission; ?> Rs. + </td>
										<td><?php echo $totalComission; ?> Rs. = </td>
										<td><?php echo $totalAmountWithComission; ?> Rs.</td>
										<td colspan="2"></td>
									</tr>
								</tfoot>
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
		<script>$(".dataTable").dataTable();</script>
	</body>
</html>
