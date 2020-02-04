<!DOCTYPE html>
<html lang="en">
<head>

<title><?php echo $this->PageLoadingFtns->getPageTitle(__FILE__);?></title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">

	<!-- Header Scripts-->
	<?php echo $this->PageLoadingFtns->getHeadScripts();?>
	<body class="front">
	<div class="loader"></div>
	<div id="main">
		<script type="text/javascript">
		$(window).load(function() {
			$(".loader").fadeOut("slow");
		})
		</script>
	<!-- Tobbar -->
	<?php echo $this->PageLoadingFtns->getTopBar();?>

	<!-- Navigation -->
	<?php echo $this->PageLoadingFtns->getNavBar();?>

	<!-- Page Content -->

	<?php


	//develop a list of segment references

	//develop a list of segments
	// foreach($flights->children('air',true) as $eachFlight){
	//
	// 		$eachFlightAttributes = $eachFlight->attributes();
	//
	// 		if(in_array($eachFlightAttributes['Key'] , $segmentKeys ) ){
	//
	// 			$flights[0]->attributes()[] = $eachFlightAttributes;
	// 		}
	//
	// 		if( in_array($eachFlightPriceAttributes['Key'] , $segmentKeys)){
	//
	// 			$PricingArray[] = $eachFlightPriceAttributes;
	// 			$BookingArray[] = $eachFlightBookingAttributes;
	//
	// 		}
	//
	// }
	//$BookingInfo = $AirPricingSol->AirPricingInfo->BookingInfo;

	$DetailsArray  = Array();
	$PricingArray = Array();
	$BookingArray = Array();

	//getting an array of segment keys
	// $segmentKeys = explode("&",$segmentKeys );
	// foreach($FlightDetails->children('air',true) as $eachFlight){
	//
	// 		$eachFlightAttributes = $eachFlight->attributes();
	//
	// 		$eachFlightPriceAttributes = $AirPricingSol->attributes();
	//
	// 		$eachFlightBookingAttributes = $BookingInfo->attributes();
	//
	// 		if(in_array($eachFlightAttributes['Key'] , $segmentKeys ) ){
	//
	// 			$flights[0]->attributes()[] = $eachFlightAttributes;
	// 		}
	//
	// 		if( in_array($eachFlightPriceAttributes['Key'] , $segmentKeys)){
	//
	// 			$PricingArray[] = $eachFlightPriceAttributes;
	// 			$BookingArray[] = $eachFlightBookingAttributes;
	//
	// 		}
	//
	// }
	//we have details of all flights so far
	// print_r($DetailsArray);
	// echo "------";
	// print_r($PricingArray);
	// echo "======";
	// print_r($BookingArray);
	// die;
	//if we have a direct flight

	?>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">itenarary</a></li>
    <li><a data-toggle="tab" href="#menu1">Fare Details</a></li>
    <li><a data-toggle="tab" href="#menu2">Baggage</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h4>Departure</h4>
			<!--A Flight Section -->
			<?php
			if(count($flights) == 1){
				$infoArray = Array(

								'Departure' => $flights[0]->attributes()['Origin'],
								'Arrival' 	=> $flights[0]->attributes()['Destination'],
								'Time'		=> $flights[0]->attributes()['ArrivalTime'],
								'FlightNumber' => $flights[0]->attributes()['FlightNumber'],
								'TotalPrice' => $pricing->attributes()['TotalPrice']
								);
								$BookingArray=$pricing->AirPricingInfo->BookingInfo->attributes();

				$this->session->set_userdata($infoArray);
				//calculating transit time we have so far is total amount of mionutes
				//so we have to u know that calculat days , hour s , minutes
				$transitTime = (int)$value->attributes()["FlightTime"];
				$transitTimeStr="";
				$transitDays = floor($transitTime/2400);
				$transitTime-=floor($transitDays * 2400);
				$transitHours = floor($transitTime /60);
				$transitTime-=floor($transitHours * 60);
				$transitMinutes = floor($transitTime);

				//making the str which has to be shown
				$transitTimeStr =$transitDays."d ".$transitHours."h ".$transitMinutes."m ";


			 ?>
      <div class="panel panel-default">
		    <div class="panel-body">
		    	<div class="row">

		    		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-offset-1 col-lg-1">
		    			<img src="<?php echo base_url('image/airlinelogo-SV.png');?>" class="img-rounded" alt="Saudi-Airline" width="100" height="60">
		    		</div>

		    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
		    	    <h4 class="text-center"><i class="fa fa-plane" aria-hidden="true"></i>&nbsp;<?php echo $flights[0]->attributes()['Origin'].' '. date_format(date_create($flights[0]->attributes()['DepartureTime']),"h:i");?></h4>
		    		<p class="text-center"><b><?php echo date_format(date_create($flights[0]->attributes()['DepartureTime']),"D, d M")?></b></p>
		    		<!--<p class="text-center"><b>ISLAMABAD BENAZIR BHUTTO INTL</b></p>-->
		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
		    		<b><h4 class="text-center">Aircraft: BOEING <?php echo $flights[0]->attributes()['FlightNumber']?></h4></b>
                    <b><h4 class="text-center"><?php echo $BookingArray['CabinClass']?>(T-)</h4></b>
                    <b><h4 class="text-center"><?=$transitTimeStr?></h4></b>
		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
		    	    <h4 class="text-center"><i class="fa fa-plane fa-rotate-90" aria-hidden="true"></i>&nbsp;<?php echo $flights[0]->attributes()['Destination'].' '. date_format(date_create($flights[0]->attributes()['ArrivalTime']),"h:i");?></h4>
		    		<p class="text-center"><b><?php echo date_format(date_create($flights[0]->attributes()['ArrivalTime']),"D, d M")?></b></p>
		    		<!--<p class="text-center"><b>ISLAMABAD BENAZIR BHUTTO INTL</b></p>-->
		    </div>

		    </div> <!--panel-body-->
		    <div class="panel-footer">
		    	 <span class="refund"><i class="fa fa-undo"></i>Refundable</span>&nbsp;&nbsp;&nbsp;
                 <!--<span><i class="fa fa-clock-o"></i> Transit Time 11 Hour(s) 25 Minute(s)</span>-->
            </div>
		    </div><!--panel-footer-->

      </div><!--panel-default-->
			<!--End of A flihght section -->
			<?php
			//end of if for direct flights
		}else if(count($flights) > 1){


			$tempArray = array();
				foreach ($flights as $key => $value) {
				$infoArray = Array(

								'Departure' => $value->attributes()['Origin'],
								'Arrival' 	=> $value->attributes()['Destination'],
								'Time'		=> $value->attributes()['ArrivalTime'],
								'FlightNumber' => $value->attributes()['FlightNumber'],
								'TotalPrice' => $pricing->attributes()['TotalPrice']
								);

				$bookingInfo = $bookings[(string)$value->attributes()["Key"]];
				$tempArray[]=$infoArray;
								// print_r($value->attributes());

				//calculating transit time we have so far is total amount of mionutes
				//so we have to u know that calculat days , hour s , minutes
				$transitTime = (int)$value->attributes()["FlightTime"];
				$transitTimeStr="";
				$transitDays = floor($transitTime/2400);
				$transitTime-=floor($transitDays * 2400);
				$transitHours = floor($transitTime /60);
				$transitTime-=floor($transitHours * 60);
				$transitMinutes = floor($transitTime);

				//making the str which has to be shown
				$transitTimeStr =$transitDays."d ".$transitHours."h ".$transitMinutes."m ";
			?>
			<!--For multiple flights -->
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">

						<div class="col-xs-12 col-sm-12 col-md-2 col-lg-offset-1 col-lg-1">
							<img src="<?php echo base_url('web-assets/images/saudia.jpg');?>" class="img-rounded" alt="Saudi-Airline" width="100" height="60">
						</div>

				<div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
							<h4 class="text-center"><i class="fa fa-plane" aria-hidden="true"></i>&nbsp;<?php echo $value->attributes()['Origin'].' '. date_format(date_create($value->attributes()['DepartureTime']),"h:i");?></h4>
						<p class="text-center"><b><?php echo date_format(date_create($value->attributes()['DepartureTime']),"D, d M")?></b></p>
						<!--<p class="text-center"><b>ISLAMABAD BENAZIR BHUTTO INTL</b></p>-->
				</div>

				<div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
						<b><h4 class="text-center">Aircraft: BOEING <?php echo $value->attributes()['FlightNumber']?></h4></b>
										<b><h4 class="text-center"><?php echo $bookingInfo['CabinClass']?></h4></b>
										<b><h4 class="text-center"><?=$transitTimeStr?></h4></b>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
							<h4 class="text-center"><i class="fa fa-plane fa-rotate-90" aria-hidden="true"></i>&nbsp;<?php echo $value->attributes()['Destination'].' '. date_format(date_create($value->attributes()['ArrivalTime']),"h:i");?></h4>
						<p class="text-center"><b><?php echo date_format(date_create($value->attributes()['ArrivalTime']),"D, d M")?></b></p>
						<!--<p class="text-center"><b>ISLAMABAD BENAZIR BHUTTO INTL</b></p>-->
				</div>

				</div> <!--panel-body-->
				<div class="panel-footer">
					 <span class="refund"><i class="fa fa-undo"></i>Refundable</span>&nbsp;&nbsp;&nbsp;
								 <!--<span><i class="fa fa-clock-o"></i> Transit Time 11 Hour(s) 25 Minute(s)</span>-->
						</div>
				</div><!--panel-footer-->

			</div><!--panel-default-->
			<!--End of A flihght section for multiple flights -->

		<?php
		//Foreach flight loop
		}
		//setting the session value
		$this->session->set_userdata($tempArray);
	 }//end of continous flights
			 ?>


       <div class="well well-sm">
		 	<div class="row">
		 		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-2 col-lg-4">
		  <h5><i class="fa fa-bookmark"></i> Total Price (Inclusive All Taxes)</h5>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-3 col-lg-3">
		   <h5><?php echo $pricing->attributes()['TotalPrice']?></h5>
		</div>

	</div>
		 </div><!--well end-->

 <div class="row">
		 	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-4 col-lg-1">
    <button type="button" class="btn btn-success btn-lg"><i class="fa fa-arrow-left"></i> CHANGE FLIGHT</button>
    		</div>

    		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-1 col-lg-5">
				<a class="btn btn-success btn-lg" href="<?php echo base_url("Page/bookNow")."?		". http_build_query($infoArray)?>">CONTINUE <i class="fa fa-arrow-right"></i></a>
    		</div>
    	</div>
</div><!--row end here-->

    <div id="menu1" class="tab-pane fade">
         <h4>Fare Details</i></h4>

     <div class="row">
     	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
     		<table class="table table-striped numeric-align">
        <tr>
            <td><strong>Fare Summary</strong></td>
            <td><strong>ADT X 1</strong></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Base Fare</td>
            <td><?=($pricing->attributes()["ApproximateBasePrice"])?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Fee & Tax</td>
            <td><?=($pricing->attributes()["Taxes"])?></td>
            <td></td>
            <td></td>
        </tr>
        <tr class="grand-total bg-success">
            <td>Grand Total</td>
            <td></td>
            <td></td>
            <td><?=($pricing->attributes()["TotalPrice"])?></td>
        </tr>
    </table>
</div><!-- col-xs-12 col-sm-12 col-md-6 col-lg-6-->

     	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 " style="display:none">

        <table class="table table-bordered">
          <thead>
            <tr class="active ">
               <th colspan="4"><span class="fr bold">ISB <i class="fa fa-long-arrow-right"></i> LHR</span></th>
            </tr>
          </thead>
          <tbody>
           <tr>
            <td></td>
            <td>Adult</td>
            <td>Child</td>
            <td>Infant</td>
           </tr>

          <tr class="active">
            <td class="bg-success" colspan="4"><strong>Exchange Penality</strong></td>
          </tr>
              <tr>
                <td class="">Before Departure</td>
                <td>PKR 0</td>
                 <td>0</td>
                 <td>0</td>
             </tr>
          <tr>
                 <td class="">After Departure</td>
                <td>PKR 0</td>
                <td>0</td>
                <td>0</td>
           </tr>

           <tr class="active">
		            <td class="" colspan="4"><strong>Refund Penality</strong><br>
		                <span>(modification of date/flight no./same city airports or transporting airlines)</span>
		            </td>
            </tr>
            <tr>
               <td class="">Before Departure</td>
                        <td>PKR 7740</td>
                        <td>0</td>
                        <td>0</td>
            </tr>
            <tr>
               <td class="">After Departure</td>
                <td>PKR 7740</td>
                <td>0</td>
                <td>0</td>
            </tr>

            <tr class="active">
                  <td class="" colspan="4"><strong>Checkin Service Fee(CSF)</strong> <br>
                    <span class=""> (charged per passenger in addition to airline fee as applicable) </span>
                  </td>
            </tr>
            <tr>
                <td class="" colspan="3">Offline Cancellation Service Fee</td>
                <td>1000</td>
            </tr>
            <tr>
               <td class="" colspan="3">Online Cancellation Service Fee</td>
               <td>1000</td>
            </tr>
            <tr>
	            <td class="" colspan="3">Rescheduling Service Fee</td>
	            <td>1000</td>
	        </tr>
        </tbody>
        <tbody>
        <tr>
            <td colspan="4">
                <p>
                    We would recommend that you reschedule/cancel your tickets
                    at least 72 hours prior to the flight departure.
                </p>
                <div class="alert alert-danger" role="alert"> <strong>Note:</strong> Fare rules may be changed by airline without prior notice. </div>
            </td>
        </tr>
        </tbody>
    </table>
     	</div><!-- col-xs-12 col-sm-12 col-md-6 col-lg-6-->
     </div><!-- row end-->

      <div class="well well-sm">
		 	<div class="row">
		 		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-2 col-lg-4">
		  <h5><i class="fas fa-bookmark"></i>Total Price (Inclusive All Taxes)</h5>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-3 col-lg-3">
		   <h5><?=($pricing->attributes()["TotalPrice"])?></h5>
		</div>

	</div>
		</div><!--well end-->

		 <div class="row">
		 	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-4 col-lg-1">
    <button type="button" class="btn btn-success btn-lg"><i class="fas fa-pencil-alt"></i>CHANGE FLIGHT</button>
    		</div>

    		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-1 col-lg-5">
    <button type="button" class="btn btn-success btn-lg"><i class="fas fa-arrow-alt-circle-right"></i>CONTINUE</button>
    		</div>
    	</div>


    </div><!-- menu1 -->
<div id="menu2" class="tab-pane fade" style="">
<!--Start of fair info and baggage info -->
<?php
	//types against strings
	$passengerTypes = array(
		"ADT"=>"Adult",
		"CNN"=>"Child",
		"INF"=>"Infant",
		"INS"=>"Infant",
		"UNN"=>"Unaccompanied child"
	);

	foreach ($fares as $k => $fare) {
		$passenger = ($fare['Passenger'][0]);



		//fare information set
		$fareInfoSets = $fare['FareInfoSets'];
		$iteration =0 ;


		foreach ($fareInfoSets as $singleFare) {
			$fareInfo = $singleFare["FareInfo"] ;

				?>

<!--End of baggage info -->

				 <?php
				 $countOfPassengers = count($fare['Passenger'] );
				 $extraStr = "";
				 $iconStr = "male";
				 //handling singular / plurals
				 switch ((string)$passenger['Code'] ) {
					 case 'INF':
					 $extraStr = ($countOfPassengers > 1 ? "s ": "" )." without a seat";
					 $iconStr ="wheelchair";
				 	 		break;
					case 'CNN':
					 $extraStr = ($countOfPassengers > 1 ? "ren ": "" )." ";
					 $iconStr = "child";
							break;
					case 'ADT':
					 $extraStr = ($countOfPassengers > 1 ? "s ": "" );
						 		break;
					case 'INS':
					 $extraStr = ($countOfPassengers > 1 ? "s ": "" )." with a seat";
							 		break;
					case 'UNN':
					 $extraStr = ($countOfPassengers > 1 ? "ren ": "" )." without a seat";
								 		break;
				 }
				 $passType = $passengerTypes[(string)$passenger['Code'] ].$extraStr;

				 $age = (isset($passenger['Age']) ? " of Age " . $passenger['Age'] : '' ) ;
				 if($iteration == 0)
				 {?>
		     <h4><i class="fa fa-<?=$iconStr?>" aria-hidden="true"><?=($countOfPassengers." ".$passType.$age)?> </i></h4>
			 <?php } ?>
		     <div class="row">
		     	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		     	<table class="table table-bordered">
		    <thead>
		      <tr>
		        <th class="bg-success">
							<?=$fareInfo["Origin"]?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							<?=$fareInfo["Destination"]?></th>
		        <th class="bg-success">Cabin</th>
		        <th class="bg-success">Check-in</th>
						<th class="bg-success">Charges </th>
						<th class="bg-success">Tax Amount</th>
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <td></td>
		        <td><?=($singleFare['MaxWeight']["Value"]."  ".$singleFare['MaxWeight']["Unit"])?></td>
		        <td><?=((strlen((string)$singleFare["NoOfPieces"][0])>0 ) ? ((string)$singleFare["NoOfPieces"][0].' Pieces (20KG+20KG)' ): '' )?> </td>
						<td > <?=$fareInfo["Amount"]?><b>  x<?=$countOfPassengers?></b></td>
						<td><?php
						$totalTaxes = 0;
						if(isset($singleFare['Taxes']) )
						foreach ($singleFare['Taxes'] as $value) {
								$totalTaxes+=( (int)(str_replace("PKR" ,"" ,$value["Amount"])));
						}

							echo $totalTaxes;
						?><b>  x<?=$countOfPassengers?></b></td>
					</tr>
		    </tbody>
		  </table>
    </div>
	</div>
		<?php
						$iteration++;
	}

	?>

<?php
}

?>


<!-- menu2 -->

		</div>
	</div>
	</div>
	</div>
	</div>

	<br><br>

	<!-- Page Content Ends -->


 <!-- Footer -->
 <?php echo $this->PageLoadingFtns->getFooter();?>

<!-- Footer Scripts-->
	<?php echo $this->PageLoadingFtns->getFootScripts();?>
	<!-- Page Related Scripts -->

</body>
</html>
