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

	<div id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="sidebar-block">
                        <form action="javascript:void(0);">
                            <div class="col-sm-12 no-padding">
                                <div class="input1_wrapper">
                                    <label>Flying from:</label>
                                    <div class="input2_inner">
                                        <input type="text" class="input" value="Prague, Vaclav Havel ">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12 no-padding margin-top">
                                <div class="input1_wrapper">
                                    <label>To:</label>
                                    <div class="input2_inner">
                                        <input type="text" class="input" value="New-York, John F. Kennedy Intl.">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12 no-padding margin-top">
                                <div class="input1_wrapper">
                                    <label>Departing:</label>
                                    <div class="input1_inner">
                                        <input type="text" class="input datepicker" value="16/07/2014">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12 no-padding margin-top">
                                <div class="input1_wrapper">
                                    <label>Returning:</label>
                                    <div class="input1_inner">
                                        <input type="text" class="input datepicker" value="26/07/2014">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12 no-padding margin-top">
                                <div class="input2_wrapper">
                                    <label class="col-md-6" style="padding-left:0;padding-top:12px;">Adults:</label>
                                    <div class="input2_inner col-md-6" style="padding-right:0;padding-left:0;">
                                        <input type="text" class="form-control" value="2">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12 no-padding margin-top">
                                <div class="input1_wrapper">
                                    <label class="col-md-6" style="padding-left:0;padding-top:12px;">Children:</label>
                                    <div class="input2_inner col-md-6" style="padding-right:0;padding-left:0;">
                                        <input type="text" class="input" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12 no-padding margin-top">
                                <div class="select1_wrapper">
                                    <label>Cabin:</label>
                                    <div class="select1_inner">
                                        <select class="select2 select" style="width: 100%">
                                            <option value="1">Economy</option>
                                            <option value="2">Premium Economy</option>
                                            <option value="3">Business</option>
                                            <option value="4">First</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <label class="col-md-6" style="padding-left:0;padding-top:12px;"></label>
                            <div class="no-padding margin-top col-md-6 text-right" style="margin-top:30px;">
                                <button class="btn btn-default btn-cf-submit" style="width:100%;">SEARCH</button>
                            </div>
                            <div class="clearfix"></div>

                        </form>

                    </div>
                    <div class="clearfix"></div>
                    <div class="margin-top"></div>

                    <div class="star_rating_wrapper">
                    <div class="title">Top Filters</div>
                    <div class="content">
                        <div class="star_rating">
                            <form>
                                <div>
                                    <input id="checkbox-1" class="checkbox1-custom" name="checkbox-1" type="checkbox" checked>
                                    <label for="checkbox-1" class="checkbox1-custom-label"><span>nonstop</span></label>
                                </div>
                                <div>
                                    <input id="checkbox-2" class="checkbox1-custom" name="checkbox-2" type="checkbox">
                                    <label for="checkbox-2" class="checkbox1-custom-label"><span>1 Stop</span></label>
                                </div>
                                <div>
                                    <input id="checkbox-3" class="checkbox1-custom" name="checkbox-3" type="checkbox">
                                    <label for="checkbox-3" class="checkbox1-custom-label"><span>2+ Stops</span></label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                    <div class="clearfix"></div>
                    <div class="margin-top"></div>
                    <div class="sm_slider sm_slider1">
                        <a class="sm_slider_prev" href="#"></a>
                        <a class="sm_slider_next" href="#"></a>
                        <div class="">
                            <div class="carousel-box">
                                <div class="inner">
                                    <div class="carousel main">
                                        <ul>
                                            <li>
                                                <div class="sm_slider_inner">
                                                    <div class="txt1">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam.</div>
                                                    <div class="txt2">George Smith</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="sm_slider_inner">
                                                    <div class="txt1">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam.</div>
                                                    <div class="txt2">Adam Parker</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
								<!--Start of booking details-->
                <div class="col-sm-9">

                    <form action="javascript:;" class="form3 clearfix">
                        <div class="select1_wrapper txt">
                            <label>Sort by:</label>
                        </div>
                        <div class="select1_wrapper sel2">
                            <div class="select1_inner">
                                <select class="select2 select" style="width: 100%">
                                    <option value="1">Name</option>
                                    <option value="2">Name2</option>
                                    <option value="2">Name3</option>
                                </select>
                            </div>
                        </div>
                        <div class="select1_wrapper sel2">
                            <div class="select1_inner">
                                <select class="select2 select" style="width: 100%">
                                    <option value="1">Price (low)</option>
                                    <option value="1">Price (high)</option>
                                </select>
                            </div>
                        </div>
                        <div class="select1_wrapper sel2">
                            <div class="select1_inner">
                                <select class="select2 select" style="width: 100%">
                                    <option value="1">Top Seller</option>

                                    <option value="2">Down</option>
                                </select>
                            </div>
                        </div>
                    </form>
        <?php
		//$flightDetails = $flights->AirSegmentList;
		//$airPricingSol = $flights->AirPricingSolution;
		echo ($flights -> asXML() );
		print_r($flights);
		die ;
		// echo ($airPricingSol ? $airPricingSol : "<h2>No data</h2>")->asXML();
		// die ;
			//$arr = $flightDetails -> children("air", true);
			//echo $flightDetails->asXML()."::".$arr[0]->asXML()."-----".$arr[1]->asXML()."======count :".count($arr );
			//		echo "total :".count($flightDetails -> children("air", true) );
		  //die ;
			//Malik
			//Three cases
			//*****1. No Flights
			//*****2. Direct Flights
			//*****3. Indirect Flights

		//handling case 1
		if(count($flights ) ==0){

			echo $this->Functions->msg("Sorry, Flights for the required criteria were not found, please <button title='CLICK THIS BUTTON TO CHANGE DETAILS' onclick='javascript:history.go(-1)' class='btn' style='background:#ffae42; color:white'>CHANGE DETAILS</button>","error");
		}

		else
		{
		//start of foreach
		//("air",true) find all the children nodes which have air as prefix
		// echo $flightDetails->asXML();
		// die ;
		// echo "<pre>";
		// print_r($flights);
		// echo "</pre>";
		//I will be using this last code so that
		//i will be able to make group of airlines
		$lastCode = '';
		foreach($flights as $k=>$f){
			// var_dump($f);die;
			//in case we have a direct flight
			$details = array();

			//lets say we need total transit time i.e total flight time
			$transitTime= 0;
			//getting the carrier details
			if(count($f["segment"]) ==1)
			{
				$details = $f["segment"][0]->attributes();
				$carrierCode = (string)$details['Carrier'];
				$transitTime+=(int)$details['FlightTime'];

			}elseif(count($f["segment"]) > 1)
			{
							foreach ($f["segment"] as $key => $value) {
								$details[] = $value->attributes();
								$transitTime+=(int)$value->attributes()["FlightTime"];
							}
							$carrierCode = (string)$details[0]['Carrier'];
			}
			//for same airline grouping
			$sameAirLine =false;
			if($lastCode == $carrierCode)
				$sameAirLine = true;

			$price = $f["pricing"]->attributes();

			$departureTime = is_array($details) ? $details[0]["DepartureTime"] :$details["DepartureTime"];
			$arrivalTime = is_array($details) ? $details[count($details)-1]["ArrivalTime"] : $details["ArrivalTime"];

			$origin = is_array($details) ? $details[0]["Origin"] :$details["Origin"];
			// // var_dump($f["segment"][0]->attributes());
			 // var_dump(is_array($details)? $details[count($details)-1]["Destination"]:$details["Destination"] );
			$destination = is_array($details) && count($details) > 0 ? $details[count($details)-1]["Destination"] : $details["Destination"];
			//print_r($searchData);
			// echo (($details['Origin'] ."||". $details['Destination'])."--     <br>");
			// continue ;
			// echo ":>>>";
			// print_r($details);
			// echo ":------:";
			// print_r($price);
			// continue;

			//Handling case 2
			// Manipulating the travel time string
			$travelTime = str_replace("T","", str_replace("P" ,"" , (string)$f["TravelTime"]) );
			$travelTimeArr = preg_split("/[DHMS]+/" , $travelTime);

			//calculating transit time we have so far is total amount of mionutes
			//so we have to u know that calculat days , hour s , minutes
			$transitTimeStr="";
			$transitDays = floor($transitTime/2400);
			$transitTime-=floor($transitDays * 2400);
			$transitHours = floor($transitTime /60);
			$transitTime-=floor($transitHours * 60);
			$transitMinutes = floor($transitTime);

			//making the str which has to be shown
			$transitTimeStr =$transitDays."d ".$transitHours."h ".$transitMinutes."m ";
		?>



			<div class="flight-list-view fadeInUp animated" <?=($sameAirLine ? 'style="margin-top:0px;"': '')?> >
        <div class="col-md-12 col-sm-12 col-xs-12 text-center clear-padding flight-desc">
            <div class="col-md-12 pd main_col col-xs-12">
							<?php if(!$sameAirLine){ ?>
                <div class="outbound"><img src="https://www.checkin.pk/frontend/images/AirLineImages/airlinelogo-WY.png" alt="<?=($carrierCode)?>"><?=($carriers[(string)$carrierCode])?>
                </div>
							<?php } ?>
                <table class="table table-condensed outbound">
                    <thead>
                    <tr class="list_heading">
                        <th class="green">Depart</th>
                        <th class="green">Arrive</th>
                        <th class="">Duration</th>
                    </tr>
                    </thead>

                    <tbody>
  						<tr>

                            <td>
                                <input value="pk" name="oPK_31568" class="nw_check" checked="" type="radio">
                                <strong><?php echo date_format(date_create($departureTime),'h:i')?></strong>
                                <br>
                                <sup><?php echo date_format(date_create($departureTime),'d M')?></sup><br>
								<?php echo $origin;?>
                            </td>
                            <td><strong><?php echo date_format(date_create($arrivalTime),'h:i')?></strong><br>
                                <sup><?php echo date_format(date_create($arrivalTime),'d M')?></sup><br>
                                <?php echo $destination;?>
                            </td>

                            <td class=""><?=($travelTimeArr[0] ."d ". $travelTimeArr[1]."h " . $travelTimeArr[2]."m")?>
                                <br>
                                <small><?php
																		echo (is_array($details) ? (count($details)-1)." Stop".(count($details)>2 ?"s":"") :"Direct" );
																?><br>
																		(<?php
																		$arrStops= array();
																		$arrStops[]=$origin;
																		if(is_array($details) && (count($details)>1) )
																		for ($i=1; $i < count($details) ; $i++) {
																			// code...
																			$arrStops[]=$details[$i]["Origin"];
																		}
																		$arrStops[]=$destination;
																		echo join(" , ",$arrStops);
																		?>)
                                </small>
                            </td>
                        </tr>
 							<tr class="trnsit">
                                <td colspan="3">Transit Time : <?=$transitTimeStr?>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>

            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12  clear-padding">
            <div class="flight-list-footer">
                <div class="col-md-8 col-sm-6 col-xs-12">

                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 ">
                	<span class="price"><?php echo $price['ApproximateTotalPrice']?></span>
                    <div class="pull-right">
                       <div class="right_side"><a href="<?php echo base_url("Page/flightDetails/". urlencode(str_replace("/","__",$price['Key']) ) )  ?>" class="btn-default btn1">Details</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <span style="display:none" class="totalPriceInfo">31568</span>
    </div>

			<?php
				$lastCode = $carrierCode;
		} //end of foreach
		// die ;

	}	//end of else
		?>


    	<!--
                    <div class="pager_wrapper">
                        <ul class="pager clearfix">
                            <li class="prev"><a href="#">Previous</a></li>
                            <li class="li"><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li class="li"><a href="#">3</a></li>
                            <li class="li"><a href="#">4</a></li>
                            <li class="li"><a href="#">5</a></li>
                            <li class="li"><a href="#">6</a></li>
                            <li class="li"><a href="#">7</a></li>
                            <li class="li"><a href="#">8</a></li>
                            <li class="li"><a href="#">9</a></li>
                            <li class="li"><a href="#">10</a></li>
                            <li class="next"><a href="#">Next</a></li>
                        </ul>
                    </div>


                </div>
            </div>-->

        </div>
				<!--End of booking details-->
    </div>

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
