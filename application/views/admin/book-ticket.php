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
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							
							<?php if($this->session->flashdata('msg')){
								
								echo $this->session->flashdata('msg');
							}
							?>
							
							<div class="widget-box">
									<div class="widget-header widget-header-blue widget-header-flat">
										<h4 class="widget-title lighter">Book A Ticket</h4>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<!-- #section:plugins/fuelux.wizard -->
											<div id="fuelux-wizard-container">
												<div>
													<!-- #section:plugins/fuelux.wizard.steps -->
													<ul class="steps">
														<li data-step="1" class="active">
															<span class="step">1</span>
															<span class="title">Select Schedule</span>
														</li>

														<li data-step="2">
															<span class="step">2</span>
															<span class="title">Choose Route</span>
														</li>

														<li data-step="3">
															<span class="step">3</span>
															<span class="title">Choose Seats</span>
														</li>

														<li data-step="4">
															<span class="step">4</span>
															<span class="title">Confirm Ticket</span>
														</li>
													</ul>

													<!-- /section:plugins/fuelux.wizard.steps -->
												</div>

												<hr />

												<!-- #section:plugins/fuelux.wizard.container -->
												<div class="step-content pos-rel">
													<div class="step-pane active" data-step="1">
														<h3 class="lighter block green">Enter the following information</h3>
														
														<div class="alert alert-warning">* Means Required</div>
																
														<div class="col-md-4">
															<label><b>Select Departure City*</b></label>
															<select name="departure" id="depart" onChange="fetchArrivals(this.value);" class="form-control">
																	<option value="">---SELECT---</option>
																	<?php 
																	$query = $this->db->select('DISTINCT(departure)')->from('routes')->get()->result_array();
																	
																	foreach($query as $q){
																		
																		echo "<option value='".$q['departure']."'>".$q['departure']."</option>";
																	}
																	?>
																</select>
															
														</div>	
														
														<div class="col-md-4">
															<label><b>Select Arrival City*</b></label>
															<select name="arrival" id="arrival" class="form-control" required>
																	<option value="">---SELECT---</option>
															</select>
														</div>
														
														<div class="col-md-4">
														<label><b>Booking Date</b></label>
														<input type="text" class="form-control date-picker-booking" id="date" value="dd/mm/yy">
													</div>
												</div>
													
													<!-- Step 2 : Choose Route -->

											<div class="step-pane" data-step="2">
														<table class="table table-striped table-bordered table-hover" role="grid">
															<thead>
																<tr role="row">
																	<th>SR #</th>
																	<th>Time</th>
																	<th>Route</th>
																	<th>Type</th>
																	<th>Fare</th>
																	<th>Seats</th>
																	<th>Reserved</th>
																	<th>Available</th>
																	<th>Action</th>
																</tr>
															</thead>

														<tbody id="routeList">
														<tr>
															<td align="center" colspan="10">
														<i class="fa fa-spinner fa-pulse fa-5x fa-fw fa-spin"></i>
														<span class="sr-only">Loading...</span>
														</td>
														</tr>
														</tbody>
												</table>
											</div>

													<div class="step-pane" data-step="3">
													<input id="booked" value="" type="hidden">
														<div class="center">
															<h3 class="blue lighter">Choose Seats</h3>
															
															<!-- Load Vehicle Design-->
															
															<div class="col-md-6">
															<div class="col-md-12">
															<h3>
															SEAT QTY: <span id="qty" style="color:green"></span>
															</h3>		
															</div>
															
															<hr>
															
															<div class="col-md-12">
																<h3>
																SEAT NO : <span id="seats" style="color:green"></span>
																</h3>
															</div>
															
															<hr>
															
															<div class="col-md-12">
															<h3>
																PRICE : <span id='price' style="color:green"></span>
															</h3>
															</div>
														</div>
															
														<div class="col-md-6" id="vehicleDesign"><i class="fa fa-spinner fa-spin fa-5x"></i></div>
														<br><br>	
															
															
														</div>
													</div>

													<div class="step-pane" data-step="4">
														<div class="center">
															<h3 class="green">Finally! Fill Passenger Details and book ticket</h3>
															<div class="col-md-4">
																<label><b>Passenger Name*</b></label>
																<input type="text" id="pName" class="form-control" placeholder="Type Passenger Full Name">
															</div>
															<div class="col-md-4">
																<label><b>Contact No. *</b></label>
																<input type="number" id="pContact" class="form-control" placeholder="Type Contact Number ">
															</div>
															<div class="col-md-4">
																<label><b>CNIC No. * </b></label>
																<input type="number" id="pCnic"  class="form-control" placeholder="e.g XXXXX-XXXXXXX-X">
															</div>
															
															<div class="col-md-6">
																<label><b>Pickup Address* </b></label>
																<textarea class="form-control" id="pickup_address" placeholder="Please Type Complete Address"></textarea>
															</div>
															
															<div class="col-md-6">
																<label><b>Drop Address* </b></label>
																<textarea class="form-control" id="drop_address" placeholder="Please Type Complete Address"></textarea>
															</div>
															
															<div class="col-md-12">
																<label><b>Remarks </b></label>
																<textarea class="form-control" id="remarks" placeholder="Please Type Any  Extra Info About This Passenger...."></textarea>

															</div>
														
																
															<div class="col-md-12 pull-right">
																<br><br>
																<button class="btn btn-success" onClick="bookTicket();">CONFIRM TICKET NOW <i class="fa fa-check fa-2x"></i></button>
															</div>
														</div>
													</div>
												</div>

												<!-- /section:plugins/fuelux.wizard.container -->
											</div>

											<hr />
											<div class="wizard-actions">
												<!-- #section:plugins/fuelux.wizard.buttons -->
												<button class="btn btn-prev">
													<i class="ace-icon fa fa-arrow-left"></i>
													Prev
												</button>

												<button class="btn btn-success btn-next" onClick="fetchRoutes(); " data-last="Finish">
													Next
													<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
												</button>

												<!-- /section:plugins/fuelux.wizard.buttons -->
											</div>

											<!-- /section:plugins/fuelux.wizard -->
										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div>
								
	
								
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
		
		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url();?>assets/js/fuelux/fuelux.wizard.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootbox.js"></script>
		<script src="<?php echo base_url();?>assets/js/dataTables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url();?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
		<script src="<?php echo base_url();?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
		<script src="<?php echo base_url();?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>

		<!-- inline scripts related to this page -->
		
		<script type="text/javascript">	
		
				$(".date-picker-booking").datepicker({
					autoclose: true,
					todayHighlight: false,
					startDate: new Date()

				});

					
			/* Global Variables */
				
				var route_id = 0;
				var departDate = "";
				var departTime = "";
				var vehicleId =  0;
				var date = "";
				var listSelectedSeats = 0;
				var seatsQty = 0
				var totalFare = 0;
				
				/*---------------*/
		
			jQuery(function($) {
			
				var $validation = false;
				$('#fuelux-wizard-container')
				.ace_wizard({
					//step: 2 //optional argument. wizard will jump to step "2" at first
					//buttons: '.wizard-actions:eq(0)'
				})
				.on('actionclicked.fu.wizard' , function(e, info){
					if(info.step == 1 && $validation) {
						if(!$('#validation-form').valid()) e.preventDefault();
					}
				})
				.on('finished.fu.wizard', function(e) {
					bootbox.dialog({
						message: "Thank you! Your information was successfully saved!", 
						buttons: {
							"success" : {
								"label" : "OK",
								"className" : "btn-sm btn-primary"
							}
						}
					})
					
				}).on('stepclick.fu.wizard', function(e){
					e.preventDefault(); //this will prevent clicking and selecting steps
				})
				
					
				$('#modal-wizard-container').ace_wizard();
			
			
						})
			
				
			function fetchArrivals(departure){
				
				if(departure != "")
				{
					$.post("<?php echo base_url('Ajax/ajax')?>",{action:"fetchArrivals",depart:departure},function(data){
						
						$("#arrival").html(data);
						
					});
					
				}
				else
				{			
					return false;
				}

			}
				
			function fetchRoutes(){
				
				$(".btn-next").removeAttr('onClick');
				
				var depart = $("#depart").val();
				var arrival = $("#arrival").val();
				date = $("#date").val();

				if(date != "dd/mm/yy" && arrival != "" && depart != "")
				{
					$.post("<?php echo base_url('Ajax/ajax')?>",{action:'fetchRoutes',depart:depart,arrival:arrival,date:date},function(data){
						
						if(data != ""){
							
							$("#routeList").html(data);
							$(".btn-next").hide();
						}	
						else{
						$("#routeList").html("<tr><td colspan='10' class='danger'>No Routes Found</td></tr>");	
						$(".btn-next").attr("disabled","");
						}
					});
				}
				else
				{
					<?php echo $this->Functions->gritterMsg('Required Fields * ','All Fields Are Required, Please Fill All Fields','gritter-error')?>
					var wizard = $('#fuelux-wizard-container').data('fu.wizard')
					wizard.currentStep = 0;
					wizard.setState();
				}
				
					
				
			}

			function validateVehicle(){
				
				if(listSelectedSeats == ""){
					
				<?php echo  $this->Functions->gritterMsg("Required Seat","Please Select At Least One Seat To Proceed","gritter-error")?>
				
				var wizard = $('#fuelux-wizard-container').data('fu.wizard')
				
				wizard.currentStep = 3;
				wizard.setState();
				
				return false;	
				}
				else
				{
					$(".btn-next").hide();
					return true;
				}
				
			}
			
			$(".btn-prev").click(function(){
				
				var wizard = $('#fuelux-wizard-container').data('fu.wizard')
				 
				 if(wizard.currentStep == 1)
				 {
					 $(".btn-next").attr('onClick','fetchRoutes();');
					 $(".btn-next").show();
				 }
				 else if (wizard.currentStep == 2)
				 {
						$(".btn-next").attr('onClick','fetchRoutes();');
						$(".btn-next").show();
				 }
				 else if(wizard.currentStep == 3)
				 {

					 $(".btn-next").hide();
				 } 
				 else if(wizard.currentStep == 4){
					 
					 $(".btn-next").show();
				 }
				 
			});
			
			
			function fetchBookedSeats(btn_id){
				
				
			
		}
		
			// Function To select seats
			function selectSeats(btn_id){
				
				$(".btn-next").removeAttr('onClick');
				$(".btn-next").attr('onClick','validateVehicle();');
				
				// Fetch Vehicle Design
				
				var vType = $("#vType"+btn_id).attr('vType');
				route_id = $("#row"+btn_id).attr('route-id');
				
				/* Fetch Booked Seats */
				departDate = $("#date").val();
				departTime = $("#depart"+btn_id).html();
				vehicleId = $("#row"+btn_id).attr('vehicle-id');
				
				$.post("<?php echo base_url('Ajax/Ajax')?>",{action:"fetchBookedSeats", depart_date:departDate, depart_time:departTime, vehicle_id:vehicleId},function(data,status){
					
					if(data != "[]"){
						
						$("#booked").val(data);
						
					}
					else
					{
						$("#booked").val("");
					}
					
					if(status == "success"){
						
						$.post("<?php echo base_url('Ajax/Ajax')?>",{action:"fetch"+vType+"Design",bookedSeats:data},function(data2){
					
					$("#vehicleDesign").html(data2);
						});
		
					}
					else
					{
						$("#vehicleDesign").html("Error Fetching Vehicle Design");
					}
									
				
			});

				var wizard = $('#fuelux-wizard-container').data('fu.wizard')
					wizard.currentStep = 3;
					wizard.setState();
					
				$('.btn-next').show();	
			}
			
			
			
			
			// Seat Selection Process
			
			 // To format number
        function formatNumber (num) {
           return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        }

        // To Select Seat For Male/Female
        function seatCheck(btn)
        {
            // btn id
            var id = $(btn).attr("id");

            // btn value  
            var value = $(btn).val();


            // Check if selected seat no is greater than 9
            if(value > 9) {
                // get btn status value
                var status = $(btn).attr("status");

                // get value i.e status=substring("10M") status=10
                var status = status.substring(2,3);    
            } 
            else
            {
                var status = $(btn).attr("status");

                // get value i.e status=substring("8M") status=8
                var status = status.substring(1,2);
            }

            // Find no of btn i.e 31,40,41,45
            var length = $(".seat").length;
            
            // if selected seat status is for male change to female
            if(status == "M")
            {
                // change btn attr status value to seat no female i.e 4F,3F
                $("#"+id).attr("status",value+"F");

                // change btn icon to female
                $("#"+value).html("<i class='fa fa-female fa-3x' style='color:orange'></i>");
                
            }

            // if selected seat status is for female change to default user
            else if(status == "F")
            {
                // change btn attr status value to empty
                $("#"+id).attr("status","");

                // change btn icon to user
                $("#"+value).html("<i class='fa fa-user fa-3x'></i>");
            }   

            // if selected seat status is empty change to male
            else if (status == "")
            {
                 // change btn attr status value to Male i.e 10M, 20M
                $("#"+id).attr("status",value+"M");

                // change btn icon to Male
                $("#"+value).html("<i class='fa fa-male fa-3x' style='color:#FF5733'></i>");
				
				listSelectedSeats = "";
            }


            // get value for btn status and join them with comma
            var final_selected_seats = $('.seat').map(function() {
                
                var all_seats = $(this).attr("status");
            
                return all_seats;
                
            }).get().join(",");

            // Remove extra commmas  
            final_selected_seats = final_selected_seats.replace(/^,+|,(?=,+|$)/g, "");

            // write selected Seats No i.e 4F,3M to td
            $("#seats").html(final_selected_seats);
            $("#selected_seats").html(final_selected_seats);

            if(final_selected_seats != "")
            {
                // total No of Seats i.e 2,3
                var tSeats = final_selected_seats.split(',');
                tSeats = tSeats.length;
				
				seatsQty = tSeats;
				listSelectedSeats = final_selected_seats;

                // write total No of Seats i.e 2,3 to td
                $("#qty").html(tSeats);
                $("#selected_seats_no").html(tSeats);

                // Per Seat Fare i.e 1250
                var farePerSeat = $("#fare").val();

                // total no of seats * fare per seat i.e 3*1250
                var t_Fare = tSeats * farePerSeat;

                // format no i.e 1,250
                tFare = formatNumber(t_Fare);

                // write total Fare Amount i.e 2,500 to td
                $("#price").html(tFare);
				totalFare = t_Fare;
            }
            else
            {
                $("#qty").html(0);
                $("#selected_seats_no").html(0);

                $("#price").html(0);
                $("#total_fare").html(0);
            }
            $("#selected_seats_no").val(tSeats);
            $("#selected_seats").val(final_selected_seats);
            $("#total_fare").val(t_Fare);
        }
		
		function bookTicket(){
		
			
				var pName = $("#pName").val();
				var pCnic = $("#pCnic").val();
				var pContact = $("#pContact").val();
				var pickupAddress = $("#pickup_address").val();
				var dropAddress = $("#drop_address").val();
				var remarks = $("#remarks").val();
				
				if(pName == "" || pCnic == "" || pContact == "" || pickupAddress == "" || dropAddress == "")
				{	
					<?php echo $this->Functions->gritterMsg('Required Fields * ','All Fields Are Required, Please Fill All Fields To Complete Your Transaction.','gritter-error')?>
			
					return false;

				}
				
				else
				{
					
				bootbox.confirm("Are Your Sure To Book This Ticket", function(result) {
						if(result) {

						
							$.post("<?php echo base_url('Ajax/Ajax')?>",{
								
								
									action : "bookTicket",
									route_id : route_id,
									vehicle_id : vehicleId,
									pName : pName,
									pCnic : pCnic,
									no_of_seats : seatsQty,
									selected : listSelectedSeats,
									contact : pContact,
									totalFare : totalFare,
									departDate : date,
									departTime : departTime,
									pickupAddress :pickupAddress,
									dropAddress : dropAddress,
									remarks : remarks
								
							},function(data,status){
							
								
							if(status == "success")
							{
								location.reload();
							}
							else
							{
								alert("System Error While Booking Ticket");
							}
								

								});
								
						}	
						
						else
						{
							return false;
						}
				
				});
		}
		
		}


		</script>	
		
	</body>
</html>
