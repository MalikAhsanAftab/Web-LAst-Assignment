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

	<!-- Tobbar -->
	<?php echo $this->PageLoadingFtns->getTopBar();?>

	<!-- Navigation -->
	<?php echo $this->PageLoadingFtns->getNavBar();?>

	<!-- Page Content -->

	<?php

	$flightsXml = simplexml_load_string($this->session->flightDetails);
		
	// Grabs the tickets
	$LowFareSearchRsp = $flightsXml->children('SOAP',true)->Body->children('air', true)->LowFareSearchRsp;
	$FlightDetails = $LowFareSearchRsp->AirSegmentList;
	$AirPricingSol = $LowFareSearchRsp->AirPricingSolution;
	$BookingInfo = $AirPricingSol->AirPricingInfo->BookingInfo;

	$DetailsArray  = Array();
	$PricingArray = Array();
	$BookingArray = Array();

	$matchFound = 0;


	foreach($FlightDetails->children('air',true) as $eachFlight){

			$eachFlightAttributes = $eachFlight->attributes();

			$eachFlightPriceAttributes = $AirPricingSol->attributes();

			$eachFlightBookingAttributes = $BookingInfo->attributes();

			if($eachFlightAttributes['Key'] == $this->uri->segment(3)){

				$DetailsArray = $eachFlightAttributes;
			}

			if($eachFlightPriceAttributes['Key'] == $this->uri->segment(4)){

				$PricingArray = $eachFlightPriceAttributes;
				$BookingArray = $eachFlightBookingAttributes;

			}

	}

	$infoArray = Array(

					'Departure' => $DetailsArray['Origin'],
					'Arrival' 	=> $DetailsArray['Destination'],
					'Time'		=> $DetailsArray['ArrivalTime'],
					'FlightNumber' => $DetailsArray['FlightNumber'],
					'TotalPrice' => $PricingArray['TotalPrice']
					);

	$this->session->set_userdata($infoArray);

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
      <div class="panel panel-default">
		    <div class="panel-body">
		    	<div class="row">

		    		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-offset-1 col-lg-1">
		    			<img src="<?php echo base_url('image/airlinelogo-SV.png');?>" class="img-rounded" alt="Saudi-Airline" width="100" height="60">
		    		</div>

		    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
		    	    <h4 class="text-center"><i class="fa fa-plane" aria-hidden="true"></i>&nbsp;<?php echo $DetailsArray['Origin'].' '. date_format(date_create($DetailsArray['DepartureTime']),"h:m");?></h4>
		    		<p class="text-center"><b><?php echo date_format(date_create($DetailsArray['DepartureTime']),"D, d M")?></b></p>
		    		<!--<p class="text-center"><b>ISLAMABAD BENAZIR BHUTTO INTL</b></p>-->
		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
		    		<b><h4 class="text-center">Aircraft: BOEING <?php echo $DetailsArray['FlightNumber']?></h4></b>
                    <b><h4 class="text-center"><?php echo $BookingArray['CabinClass']?>(T)</h4></b>
                    <b><h4 class="text-center">5h 30m</h4></b>
		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
		    	    <h4 class="text-center"><i class="fa fa-plane" aria-hidden="true"></i>&nbsp;<?php echo $DetailsArray['Destination'].' '. date_format(date_create($DetailsArray['ArrivalTime']),"h:m");?></h4>
		    		<p class="text-center"><b><?php echo date_format(date_create($DetailsArray['ArrivalTime']),"D, d M")?></b></p>
		    		<!--<p class="text-center"><b>ISLAMABAD BENAZIR BHUTTO INTL</b></p>-->
		    </div>

		    </div> <!--panel-body-->
		    <div class="panel-footer">
		    	 <span class="refund"><i class="fa fa-undo"></i>Refundable</span>&nbsp;&nbsp;&nbsp;
                 <!--<span><i class="fa fa-clock-o"></i> Transit Time 11 Hour(s) 25 Minute(s)</span>-->
            </div>
		    </div><!--panel-footer-->

      </div><!--panel-default-->

           <div class="panel panel-default">
		    <div class="panel-body">
		    	<div class="row">

		    		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-offset-1 col-lg-1">
		    			<img src="<?php echo base_url('image/airlinelogo-SV.png');?>" class="img-rounded" alt="Saudi-Airline" width="100" height="60">
		    		</div>

		    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
		    	    <h4 class="text-center"><i class="fa fa-plane" aria-hidden="true"></i>&nbsp;ISB 22:15</h4>
		    		<p class="text-center"><b>Sat, 05 May</b></p>
		    		<p class="text-center"><b>ISLAMABAD BENAZIR BHUTTO INTL</b></p>
		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
		    		<b><h4 class="text-center">Aircraft: BOEING 777-300</h4></b>
                    <b><h4 class="text-center">Economy(T)</h4></b>
                    <b><h4 class="text-center">5h 30m</h4></b>
		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">
		    			<h4 class="text-center"><i class="fa fa-plane fa-rotate-90"></i>&nbsp; RUH 02:15</h4>
		    			<p class="text-center"><b>Sat, 05 May</b></p>
		    			<p class="text-center"><b>RUH KING KHALID INTL</b></p>
		    </div>

		    </div> <!--panel-body-->
		    <div class="panel-footer">
		    	 <span class="refund"><i class="fa fa-undo"></i>Refundable</span>&nbsp;&nbsp;&nbsp;
                 <span><i class="fa fa-clock-o"></i> Transit Time 11 Hour(s) 25 Minute(s)</span>
            </div>
		    </div><!--panel-footer-->

      </div><!--panel-default-->

       <div class="well well-sm">
		 	<div class="row">
		 		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-2 col-lg-4">
		  <h5><i class="fa fa-bookmark"></i> Total Price (Inclusive All Taxes)</h5>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-3 col-lg-3">
		   <h5><?php echo $PricingArray['TotalPrice']?></h5>
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
            <td>PKR 44,790</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Fee & Tax</td>
            <td>PKR 11,886 </td>
            <td></td>
            <td></td>
        </tr>
        <tr class="grand-total bg-success">
            <td>Grand Total</td>
            <td></td>
            <td></td>
            <td>PKR 56,676</td>
        </tr>
    </table>
</div><!-- col-xs-12 col-sm-12 col-md-6 col-lg-6-->

     	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

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
		   <h5>PKR 56,676</h5>
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


    <div id="menu2" class="tab-pane fade">
		     <h4><i class="fa fa-plane" aria-hidden="true">Departure</i></h4>

		     <div class="row">
		     	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		     	<table class="table table-bordered">
		    <thead>
		      <tr>
		        <th class="bg-success">ISLAMABAD BENAZIR BHUTTO INTL <i class="fa fa-long-arrow-right" aria-hidden="true"></i>  JEDDAH KING ABDULAZIZ INT</th>
		        <th class="bg-success">Cabin</th>
		        <th class="bg-success">Check-in</th>
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <td>Adult</td>
		        <td>5-7 kg</td>
		        <td>2 Pieces (20KG+20KG)</td>
		      </tr>
		    </tbody>
		  </table>

		  <h4><i class="fa fa-plane" aria-hidden="true">Departure</i></h4>

		     <div class="row">
		     	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		     	<table class="table table-bordered">
		    <thead>
		      <tr>
		        <th class="bg-success">ISLAMABAD BENAZIR BHUTTO INTL <i class="fa fa-long-arrow-right" aria-hidden="true"></i>  JEDDAH KING ABDULAZIZ INT</th>
		        <th class="bg-success">Cabin</th>
		        <th class="bg-success">Check-in</th>
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <td>Adult</td>
		        <td>5-7 kg</td>
		        <td>2 Pieces (20KG+20KG)</td>
		      </tr>
		    </tbody>
		  </table>
		   </div>
<br><br><br>
     </div><!-- row end-->
		 <div class="well well-sm">
		 	<div class="row">
		 		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-2 col-lg-4">
		  <h5><i class="fas fa-bookmark"></i>Total Price (Inclusive All Taxes)</h5>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-3 col-lg-3">
		   <h5>PKR 56,676</h5>
		</div>

	</div>
		 </div><!--well end-->

		 <div class="row">
		 	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-4 col-lg-1">
    <button type="button" class="btn btn-success btn-lg"><i class="fas fa-pencil-alt"></i>CHANGE FLIGHT</button>
    		</div>

    		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-offset-1 col-lg-5">
    <a href="" class="btn btn-success btn-lg"><i class="fa fa-arrow-alt-circle-right"></i>CONTINUE</a>
    		</div>
    	</div>
    </div><!-- menu2 -->
  </div>
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
	<script type="text/javascript">
	$(window).load(function() {
		$(".loader").fadeOut("slow");
	})
	</script>
</body>
</html>
