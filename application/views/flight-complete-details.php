<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $this->PageLoadingFtns->getPageTitle(__FILE__);?></title>
  <?php
// $seg = $airSegment[0]['CodeshareInfo'];
//   var_dump ( $seg->attributes()['Origin'] );
//  die;
// ->AirPricingSolution->attributes(['TotalPrice'])s

?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">

	<!-- Header Scripts-->
	<?php echo $this->PageLoadingFtns->getHeadScripts();?>
	<body class="front">
	<div class="loader"></div>
	<div id="main" >
		<script type="text/javascript">
		$(window).load(function() {
			$(".loader").fadeOut("slow");
		})
		</script>
	<!-- Tobbar -->
	<?php echo $this->PageLoadingFtns->getTopBar();?>

	<!-- Navigation -->
	<?php echo $this->PageLoadingFtns->getNavBar();


	//<!-- Page Content -->
	//this function defines a template for each flight section so that
	//for each section we dont uhave to write the html
	//thus this method will return the htmlas per requirements
	function makeFlightHtml($origin , $destination ,$departureTime  , $arrivalTime , $transitTime ,  $flightNumber , $cabinClass , $carrierCode){
		// $time =array();
		// $time[] =date_format(date_create($arrivalTime),"h:i");
		// $time[] =date_format(date_create($arrivalTime),"D, d M");
    //
		// $time[] =date_format(date_create($departureTime),"h:i");
		// $time[] =date_format(date_create($departureTime),"D, d M");
		// $baseUrl = base_url('web-assets/images/saudia.jpg');
// 		return <<<HTML
// 		<div class="panel panel-default">
// 			<div class="panel-body">
// 				<div class="row">
//
// 					<div class="col-xs-12 col-sm-12 col-md-2 col-lg-offset-1 col-lg-1">
// 						<img src="{$baseUrl}" class="img-rounded"  width="100" height="60" alt='{$carrierCode}'>
// 					</div>
//
// 			<div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
// 						<h4 class="text-center"><i class="fa fa-plane" aria-hidden="true"></i>&nbsp;$origin $time[2]</h4>
// 					<p class="text-center"><b>$time[3]</b></p>
// 					<!--<p class="text-center"><b>ISLAMABAD BENAZIR BHUTTO INTL</b></p>-->
// 			</div>
//
// 			<div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
// 					<b><h4 class="text-center">Aircraft: BOEING $flightNumber</h4></b>
// 									<b><h4 class="text-center">$cabinClass(T-)</h4></b>
// 									<b><h4 class="text-center">$transitTime</h4></b>
// 			</div>
//
// 			<div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
// 						<h4 class="text-center"><i class="fa fa-plane fa-rotate-90" aria-hidden="true"></i>&nbsp;$destination $time[0]</h4>
// 					<p class="text-center"><b>$time[1]</b></p>
// 					<!--<p class="text-center"><b>ISLAMABAD BENAZIR BHUTTO INTL</b></p>-->
// 			</div>
//
// 			</div> <!--panel-body-->
// 			<div class="panel-footer">
// 				 <span class="refund"><i class="fa fa-undo"></i>Refundable</span>&nbsp;&nbsp;&nbsp;
// 							 <!--<span><i class="fa fa-clock-o"></i> Transit Time 11 Hour(s) 25 Minute(s)</span>-->
// 					</div>
// 			</div><!--panel-footer-->
//
// 		</div><!--panel-default-->
// HTML;
	}
function makeTimeString($time){
	//calculating transit time we have so far is total amount of mionutes
	//so we have to u know that calculat days , hour s , minutes
	$transitTime = (int)$time;
	$transitTimeStr="";
	$transitDays = floor($transitTime/2400);
	$transitTime-=floor($transitDays * 2400);
	$transitHours = floor($transitTime /60);
	$transitTime-=floor($transitHours * 60);
	$transitMinutes = floor($transitTime);

	//making the str which has to be shown
	return $transitDays."d ".$transitHours."h ".$transitMinutes."m ";
}



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
			<!-- <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">itenarary</a></li>
    <li><a data-toggle="tab" href="#menu1">Fare Details</a></li>
    <li><a data-toggle="tab" href="#menu2">Baggage</a></li>
  </ul> -->

<!-- strat of class jumpotron -->

  <div class="tab-content jumbotron">
    <div id="home" class="tab-pane fade in active">
			<!--A Flight Section -->
      <div class="well well-sm">


      <div class="row">
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-0">

         <table class="table table-striped numeric-align">
           <?php
            if (is_array($airSegment) && count($airSegment) > 0) {
             for ($i=0; $i < count($airSegment); $i++) {?>
               <thead class="outbound " style="background-color:#2ca526; color:white;">
                 <!-- <i class="fa fa-plane"></i> -->
                 <th colspan="4"> <?=$airSegment[$i]['AirSegment']->attributes()['Origin']?> &nbsp; <img src="<?php echo base_url("web-assets/images/airportIcon.png")?>" alt=" -> " width="25px" height="25px" style="filter: brightness(4.25); "> &nbsp; <?=$airSegment[$i]['AirSegment']->attributes()['Destination']?> </th>
               </thead>
               <thead>
                 <th> Airline </th>
                 <th> Departure </th>
                 <th> Details </th>
                 <th> Arrivel </th>
               </thead>
               <tbody>
                 <tr>
                   <td> <?=$airSegment[$i]['textCotnet'][0]?> </td>
                   <td> <i class="fa fa-plane mr-2"> </i> &nbsp; <?= $airSegment[$i]['AirSegment']->attributes()['Origin'] ." ". date_format(date_create($airSegment[$i]['AirSegment']->attributes()['DepartureTime']),"h:i")?> <br>
                        <?= date_format(date_create($airSegment[$i]['AirSegment']->attributes()['DepartureTime']),"D, d M") ?> </td>
                   <td> Aircraft: BOEING <?= $airSegment[$i]['AirSegment']->attributes()['FlightNumber'] ?> <br>
                        <?= $airSegment[$i]['AirSegment']->attributes()['FlightNumber'] ?> <br>
                       <?=  makeTimeString($airSegment[$i]['AirSegment']->attributes()['TravelTime']) ?></td>
                   <!--  -->
                   <td> <i class="fa fa-plane fa-rotate-90 mr-2" aria-hidden="true"></i> &nbsp;<?=  $airSegment[$i]['AirSegment']->attributes()['Destination'] ." ". date_format(date_create($airSegment[$i]['AirSegment']->attributes()['ArrivalTime']),"h:i") ?> <br>
                        <?= date_format(date_create($airSegment[$i]['AirSegment']->attributes()['ArrivalTime']),"D, d M")?></td>

                 </tr>
               </tbody>


             <?php }

           }else{
             echo "hello mateen";
           } ?>


      </table>
    </div>
    </div>
</div>
<!-- manupulate the pricinginfo data -->
  <?php
  $PrcingDtailDta = array();
    // if (is_array($pricingInfoArray) && count($pricingInfoArray) > 0 ) {
    //
    //
    //     for ($i=0; $i < count($FareInfo); $i++) {
    //       // $PrcingDtailDta[] =
    //     }
    // }
  ?>
    <div class="well well-sm">
   <div class="row">
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-0">
   <h5 class="text-center" style="background-color:#2ca526; color:white;"><i class="fa fa-bookmark"></i>  PricingDetails </h5>
 </div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-0">
 <table class="table table-bordered table-striped numeric-align bordered">
   <thead>
     <th> TravellerType </th>
     <th> Fare Type </th>
     <th> Fare Basis </th>
     <th> Base Fare </th>
     <th> Surcharges </th>
     <th> Taxes </th>
     <th> Fees </th>
     <th> Fare </th>
     <th> Quantity </th>
     <th> Total Fare </th>

   </thead>
   <tbody>

       <?php if(is_array($pricingInfoArray) && count($pricingInfoArray) > 0 ) {
$totalFinalFare = 0;
         for ($i=0; $i < count($pricingInfoArray); $i++) {?>
           <tr>
             <td colspan="10"> <strong><?php $passengerType = $pricingInfoArray[$i]['PassengerType'][0];
                  if($passengerType == 'ADT'){
                      echo "Adult";
                  }elseif($passengerType == 'CNN'){
                      echo "Children";
                  }elseif($passengerType == 'INF'){
                    echo "Infant";
                  }else{
                    echo "unknown";
                  }?> </strong></td>
           </tr>
<!-- // && count($pricingInfoArray > 0)
// for count the no of passenenger -->
      <?php    $noofpassenger[$i] = count($pricingInfoArray[$i]['PassengerType']);
        for ($j=0; $j < count($pricingInfoArray[$i]['FareInfo']) ; $j++) {

          $FareAmount = (trim($pricingInfoArray[$i]['FareInfo'][$j]->attributes()['Amount'] , "PKR"))+(trim($pricingInfoArray[$i]['FareInfo'][$j]->attributes()['TaxAmount'] , "PKR"));
          $totalFare  = ($FareAmount)*($noofpassenger[$i]);
          $totalFinalFare += $totalFare;

           ?>
          <tr class="hover-change">



       <td> <?php //$pricingInfoArray[$i]['PassengerType'][0]->attributes()['code'] ?></td>
       <td>  <?php echo $pricingInfoArray[$i]['FareInfo'][$j]->attributes()['Origin']; ?> to  <?php echo $pricingInfoArray[$i]['FareInfo'][$j]->attributes()['Destination']; ?> </td>
       <td> Fare Basis </td>
       <td> <?php echo trim($pricingInfoArray[$i]['FareInfo'][$j]->attributes()['Amount'] , "PKR"); ?> </td>
       <td> Surcharges </td>
       <td> <?php echo trim($pricingInfoArray[$i]['FareInfo'][$j]->attributes()['TaxAmount'] , "PKR") ; ?> </td>
       <td> 0 </td>
       <td> <?= number_format($FareAmount) ?> </td>
       <td> x &nbsp;&nbsp;  <?php echo $noofpassenger[$i] ?> &nbsp;&nbsp; = </td>
       <td> <?= number_format($totalFare) ?> </td>

       </tr>

       <?php
       // }

       }
     }

     }else {
       echo "try again";} ?>
     </tr>
     <tr>
       <td colspan="9"> </td>
       <td> <strong> PKR &nbsp;&nbsp;<?= number_format($totalFinalFare) ?> </strong></td>
     </tr>
   </tbody>
 </table>
</div>
 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-3 col-lg-3">
    <h5><?php //echo $pricing->attributes()['TotalPrice']?></h5>
 </div>

</div>
  </div><!--well end-->

  <!--  terms and condition  -->
  <div class="well well-sm ml-2">
 <div class="row ml-2">
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-0">
 <h5 class="text-center " style="background-color:#2ca526; color:white"><i class="fa fa-bookmark"></i> Terms And Conditions </h5>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-0">

<br>
<p class="ml-2">
  Tickets are non-transferable and non-endorsable, and are subject to the following terms and conditions (which are subject to change):
</p>
<p class="ml-2">
  <h6><strong> REPORTING TIME:  </strong></h6>
</p>
<p class="ml-2">
  Flights open for check-in 2 1/2 hours before scheduled departure time
  on domestic flights and 4 hours before scheduled departure time on international flights.
  Passengers must check-in 2 hours before flight departure.
  Check-in counters close 45 min before flight departure for domestic,
  and 90 minutes before the scheduled departure for international flights.
</p>
<p class="ml-2">
  <h6> <strong> CARRY-ON BAGGAGE ALLOWANCE: </strong> </h6>
</p>
<p>

</p>
<p class="ml-2">
  <h6> <strong> CHECKED-BAGGAGE ALLOWANCE: </strong> </h6>
</p>
<p class="ml-2">

</p>
<p class="ml-2">
  <h6> <strong> EXCESS BAGGAGE FEES: </strong> </h6>
</p>
<p class="ml-2">
</p>

<p class="ml-2">
  <h6> <strong> OVERSIZED BAGS POLICY (EX- UAE & KSA PASSENGERS): </strong> </h6>
</p>
<p class="ml-2">
</p>

<p class="ml-2">
  <h6> <strong> LOST/DAMAGED BAG COMPENSATION: </strong> </h6>
</p>
<p class="ml-2">
</p>

<p class="ml-2">
  <h6> <strong> TICKET CHANGES </strong> </h6>
</p>
<p class="ml-2"> Passengers pay the change fee indicated on the e-ticket display,
  PLUS the difference in the fare. Same fare is not guaranteed.
  Exchanges are allowed for the same sector only.
  Fees apply for each passenger.  Change Fees are NON-REFUNDABLE</p>

<p class="ml-2">
  <h6> <strong> TICKET REFUNDS: </strong> </h6>
</p>
<p class="ml-2"> Passengers pay the refund fee indicated on the e-ticket display.
  For refunds, NIC must be provided for all passengers.
  NOTICE:  Partial Refunds are NOT ALLOWED on connecting flight bookings.</p>

<p class="ml-2"> <h6> <strong> TICKET EXPIRATION: </strong> </h6> </p>
<p class="ml-2"> Tickets expire 30 days after flight date. Expired tickets have no value,
    cannot be refunded, cancelled or changed </p>

<p class="ml-2"> <h6> <strong> LIMITED LIABILITY: </strong>  </h6> </p>
<p class="ml-2"> The maximum airline liability in the event of denied boarding,
    delayed or cancelled flight is limited to the price paid for the ticket. </p>

<p class="ml-2"> <h6> <strong> FOR CREDIT/DEBIT CARD PURCHASES - VERIFICATION REQUIRED: </strong> </h6> </p>
<p class="ml-2"> The passenger(s) will NOT be allowed to travel, until the credit/debit card has been verified.
    The card holder must present (in person) the Credit/Debit Card and Photo ID (NIC or passport) of
    the country from which the credit/debit is issued.
    The card holder name must appear on the credit/debit card for the Verification purposes.
    This can be done at the airport at the time of Check-In.
    Any refunds will be done within 30 business days. </p>


</div>
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-3 col-lg-3">
  <h5><?php //echo $pricing->attributes()['TotalPrice']?></h5>
</div>

</div>
</div><!--well end-->
			<?php
// 			$html = "";
// 			if(is_array($airSegment) && count($airSegment) == 1){
//         var_dump($airSegment);
// // die;
// }

			//It's a one way flight not return nor multicity
			//It means we have
			//Now check if it's a direct OR connecting flight
			// if(is_array($flights[0]))
			// 	if(count($flights[0]["Segments"]) == 1)
			// 	{
			// 		$segmentTemp= $flights[0]["Segments"][0];
			// 		$html=`<h4>Departure `.$segmentTemp->attributes()['Origin']."->".$segmentTemp->attributes()['Destination']."</h4>";
			// 		$flights = $segmentTemp;
			// 		//its a direct flight
			// 		$infoArray = Array(
			// 				'Departure' => $flights->attributes()['Origin'],
			// 				'Arrival' 	=> $flights->attributes()['Destination'],
			// 				'Time'		=> $flights->attributes()['ArrivalTime'],
			// 				'FlightNumber' => $flights->attributes()['FlightNumber'],
			// 				'TotalPrice' => $pricing->attributes()['TotalPrice']
			// 				);
			// 		$BookingArray=$pricing->AirPricingInfo->BookingInfo->attributes();
      //
			// $this->session->set_userdata($infoArray);
			// //calculating transit time we have so far is total amount of mionutes
			// //so we have to u know that calculat days , hour s , minutes
			// //making the str which has to be shown
			// $transitTimeStr =makeTimeString($flights->attributes()["FlightTime"]);
			// $carrierCode = $flights->attributes()["Carrier"];
			// $html .= makeFlightHtml($flights->attributes()['Origin'], $flights->attributes()['Destination'] ,
			// $flights->attributes()['DepartureTime']  , $flights->attributes()['ArrivalTime'] ,
			// $transitTimeStr , $flights->attributes()['FlightNumber'] , $BookingArray['CabinClass'] , $carriers[(string)$carrierCode]);

		//End of direct flight if
		// else if(count($flights[0]["Segments"]) > 1)
		// 	{
		// 		$headerHtm='<h4>Departure ';
		// 		//we are here beacuse our journey is one way not return nor multicity
		// 		//Also it is a connecting flight
		// 		foreach ($flights[0]["Segments"] as $key => $value) {
		// 								$headerHtm.=$value->attributes()['Origin']."->";
    //
		// 								$infoArray = Array(
    //
		// 												'Departure' => $value->attributes()['Origin'],
		// 												'Arrival' 	=> $value->attributes()['Destination'],
		// 												'Time'		=> $value->attributes()['ArrivalTime'],
		// 												'FlightNumber' => $value->attributes()['FlightNumber'],
		// 												'TotalPrice' => $pricing->attributes()['TotalPrice']
		// 												);
    //
		// 								$bookingInfo = $bookings[(string)$value->attributes()["Key"]];
		// 								$tempArray[]=$infoArray;
		// 												// print_r($value->attributes());
    //
		// 								//calculating transit time we have so far is total amount of mionutes
		// 								//so we have to u know that calculat days , hour s , minutes
		// 								//making the str which has to be shown
		// 								$transitTimeStr =makeTimeString($value->attributes()["FlightTime"]);
    //
		// 								$attributeArr= $value->attributes();
		// 								$carrierCode = $attributeArr["Carrier"];
		// 								$html.=makeFlightHtml($attributeArr["Origin"] , $attributeArr["Destination"] ,
		// 																		 $attributeArr["DepartureTime"] , $attributeArr["ArrivalTime"] ,
		// 																		 $transitTimeStr , $attributeArr["FlightNumber"] , $bookingInfo["CabinClass"] , $carriers[(string)$carrierCode]);
    //
		// 					}
		// 				$headerHtm.="".$value->attributes()['Destination']."</h4>";
		// 				$html = $headerHtm.$html;
		// 	}//end of if for connecting flights
		// 	echo $html;
		// }else if(count($flights) > 1){
			//Now we have multi Journeys Either return or Multicity so
			// print_r($flights);
			// die;
			//here group means journey
			//to know if its a return flight
		// 	$stops = array();
   //
		// 	foreach($flights as $key => $Journey)
		// 	{
		// 		// echo "here";
		// 		// var_dump($Journey);die;
		// 		$tempHTML = '';
		// 		$headerHtm = '';
		// 		foreach ($Journey["Segments"] as $key => $singleFlight) {
		// 			 $origin =((string)$singleFlight->attributes()['Origin']);
		// 			 array_push($stops ,(string)$singleFlight->attributes()['Origin']);
   //
		// 			 $headerHtm.=	 $origin."->";
		// 		$infoArray = Array(
   //
		// 						'Departure' => $singleFlight->attributes()['Origin'],
		// 						'Arrival' 	=> $singleFlight->attributes()['Destination'],
		// 						'Time'		=> $singleFlight->attributes()['ArrivalTime'],
		// 						'FlightNumber' => $singleFlight->attributes()['FlightNumber'],
		// 						'TotalPrice' => $singleFlight->attributes()['TotalPrice']
		// 						);
   //
		// 		$bookingInfo = $bookings[(string)$singleFlight->attributes()["Key"]];
		// 		$tempArray[]=$infoArray;
		// 						// print_r($value->attributes());
   //
		// 		//calculating transit time we have so far is total amount of mionutes
		// 		//so we have to u know that calculat days , hour s , minutes
   //
		// 		//making the str which has to be shown
		// 		$transitTimeStr =makeTimeString($singleFlight->attributes()["FlightTime"]);
		// 		$attributeArr= $singleFlight->attributes();
		// 		$carrierCode = $attributeArr["Carrier"];
		// 		$tempHTML .=makeFlightHtml($attributeArr["Origin"] , $attributeArr["Destination"] ,
		// 												 $attributeArr["DepartureTime"] , $attributeArr["ArrivalTime"] ,
		// 												 $transitTimeStr , $attributeArr["FlightNumber"] , $bookingInfo["CabinClass"] , $carriers[(string)$carrierCode]);
   //
		// 	}//foreach group
		// 	$stops[] = ((string)$singleFlight->attributes()['Destination']);
		// 	if($stops[0] == $stops[count($stops)-1])
		// 		$headerHtm = "<h4>RETURN ".$headerHtm;
		// 	else
		// 		$headerHtm = "<h4>DEPARTURE ".$headerHtm;
		// 	$headerHtm .= $singleFlight->attributes()['Destination']."</h4>";
		// 	$html.=$headerHtm.$tempHTML;
		// //Foreach flight loop
		// }
		// echo $html;
		// //setting the session value
		// $this->session->set_userdata($tempArray);
		// // var_dump($tempArray);die;
	 // }//end of continous flights
			 ?>
      <!-- agree dic parrt -->

      <div class="well well-sm">
     <div class="row">
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-0 col-lg-12 text-center align-center">
       <form class="text-center">
         <div class="form-check text-center" >
         <input type="checkbox" class="form-check-input" id="exampleCheck1">
         <label class="form-check-label" for="exampleCheck1">I agree to the above terms and conditions</label>
       </div>
     </form>
   </div>

   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-3 col-lg-3">
      <h5><?php //echo $pricing->attributes()['TotalPrice']?></h5>
   </div>

 </div>
    </div><!--well end-->



       <div class="well well-sm">
		 	<div class="row">
		 		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-2 col-lg-12">
		  <h5><i class="fa fa-bookmark"></i> Total Price (Inclusive All Taxes)  <span class="ml-5 text-center">  <?php echo $pricingSolution['TotalPrice'] ?> </span> </h5>

		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-3 col-lg-3">
		   <h5><?php //echo $pricing->attributes()['TotalPrice']?></h5>
		</div>

	</div>
		 </div><!--well end-->

 <div class="row">
		 	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-4 col-lg-1">
    <button type="button" class="btn btn-success btn-lg" ><a href="<?php //echo base_url('Page/changeFlight')?>" style="text-decoration:none;color:white;"><i class="fa fa-arrow-left"></i> CHANGE FLIGHT</a></button>
    		</div>

    		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-1 col-lg-5">
				<a class="btn btn-success btn-lg" href="<?php //echo base_url("Page/getPricing/".urlencode(str_replace("/" , "__" ,$pricing->attributes()['Key'] ) ) ) ?>">CONTINUE <i class="fa fa-arrow-right"></i></a>
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
            <td><?php//($pricing->attributes()["ApproximateBasePrice"])?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Fee & Tax</td>
            <td><?php//($pricing->attributes()["Taxes"])?></td>
            <td></td>
            <td></td>
        </tr>
        <tr class="grand-total bg-success">
            <td>Grand Total</td>
            <td></td>
            <td></td>
            <td><?php//($pricing->attributes()["TotalPrice"])?></td>
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
		   <h5><?php//($pricing->attributes()["TotalPrice"])?></h5>
		</div>

	</div>
		</div><!--well end-->

		 <div class="row">
		 	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-4 col-lg-1">
    <button type="button" class="btn btn-success btn-lg"><a href="<?php //echo base_url('Page/changeFlight')?>" style="text-decoration:none;color:white;"><i class="fas fa-pencil-alt"></i>CHANGE FLIGHT</a></button>
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
// 	$passengerTypes = array(
// 		"ADT"=>"Adult",
// 		"CNN"=>"Child",
// 		"INF"=>"Infant",
// 		"INS"=>"Infant",
// 		"UNN"=>"Unaccompanied child"
// 	);
//
// 	foreach ($fares as $k => $fare) {
// 		$passenger = ($fare['Passenger'][0]);
//
//
//
// 		//fare information set
// 		$fareInfoSets = $fare['FareInfoSets'];
// 		$iteration =0 ;
//
//
// 		foreach ($fareInfoSets as $singleFare) {
// 			$fareInfo = $singleFare["FareInfo"] ;
//
// 				?>
//
// <!--End of baggage info -->
//
// 				 <?php
// 				 $countOfPassengers = count($fare['Passenger'] );
// 				 $extraStr = "";
// 				 $iconStr = "male";
// 				 //handling singular / plurals
// 				 switch ((string)$passenger['Code'] ) {
// 					 case 'INF':
// 					 $extraStr = ($countOfPassengers > 1 ? "s ": "" )." without a seat";
// 					 $iconStr ="wheelchair";
// 				 	 		break;
// 					case 'CNN':
// 					 $extraStr = ($countOfPassengers > 1 ? "ren ": "" )." ";
// 					 $iconStr = "child";
// 							break;
// 					case 'ADT':
// 					 $extraStr = ($countOfPassengers > 1 ? "s ": "" );
// 						 		break;
// 					case 'INS':
// 					 $extraStr = ($countOfPassengers > 1 ? "s ": "" )." with a seat";
// 							 		break;
// 					case 'UNN':
// 					 $extraStr = ($countOfPassengers > 1 ? "ren ": "" )." without a seat";
// 								 		break;
// 				 }
// 				 $passType = $passengerTypes[(string)$passenger['Code'] ].$extraStr;
//
// 				 $age = (isset($passenger['Age']) ? " of Age " . $passenger['Age'] : '' ) ;
// 				 if($iteration == 0)
				 {?>
		     <h4><i class="fa fa-<?pph//$iconStr?>" aria-hidden="true"><?php//($countOfPassengers." ".$passType.$age)?> </i></h4>
			 <?php //} ?>
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
		        <td><?php//=($singleFare['MaxWeight']["Value"]."  ".$singleFare['MaxWeight']["Unit"])?></td>
		        <td><?php//=((strlen((string)$singleFare["NoOfPieces"][0])>0 ) ? ((string)$singleFare["NoOfPieces"][0].' Pieces (20KG+20KG)' ): '' )?> </td>
						<td > <?php//=$fareInfo["Amount"]?><b>  x<?php//=$countOfPassengers?></b></td>
						<td><?php
						$totalTaxes = 0;
						// if(isset($singleFare['Taxes']) )
						// foreach ($singleFare['Taxes'] as $value) {
						// 		$totalTaxes+=( (int)(str_replace("PKR" ,"" ,$value["Amount"])));
						// }
            //
						// 	echo $totalTaxes;
						?><b>  x<?php//=$countOfPassengers?></b></td>
					</tr>
		    </tbody>
		  </table>
    </div>
	</div>
		<?php
						//$iteration++;
	//}

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
 <?php //echo $this->PageLoadingFtns->getFooter();?>

<!-- Footer Scripts-->
	<?php //echo $this->PageLoadingFtns->getFootScripts();?>
	<!-- Page Related Scripts -->

</body>
</html>
