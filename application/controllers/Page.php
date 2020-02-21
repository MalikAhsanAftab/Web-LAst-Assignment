<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 300);

class Page extends CI_Controller {

	public function __construct(){

		parent :: __construct();

		$this->load->model('Functions');
		$this->load->model('PageLoadingFtns');
		$this->load->model('AdminPageLoadingFtns');
		$this->load->model('uApi');

	}

	public function index()
	{
		$this->load->view("home");
	}

	public function home()
	{
		$this->load->view("home");
	}

	public function about()
	{
		$this->load->view("about");
	}

	public function manage()
	{
		redirect("admin/Login");
	}
	public static function validateDate($date , $format = 'm/d/Y'){
		$d = DateTime::createFromFormat($format , $date);
		//The Y ( 4 digits year) returns TRUE for any integer with any number of digits
		//so changing the comparison from == to === fixes the issue
		return $d && $d->format($format) === $date;
	}
	public function flightsList(){
		//die(ini_get('max_execution_time'));
		//sanitize / validate  posted data

		if($_POST && isset($_POST['adult']) && isset($_POST['child']) && isset($_POST['infant'])
		&& is_numeric($_POST['adult']) && is_numeric($_POST['child']) && is_numeric($_POST['infant'])
		&& ($_POST['adult']>0 ||
		 ($_POST['child']>0 && count($_POST['child_']) == $_POST['child']) ||
		($_POST['infant']>0 && count($_POST['infant_']) == $_POST['infant']) )
		)
	{



		//validate departure of returning flight if available
		if(isset($_POST['returnOn']) )
		{
			 if(empty($_POST['returnOn']) || !Page::validateDate($_POST['returnOn']))
			 		unset($_POST['returnOn']);
		}

		$list = $this->uApi->getCarriers();
		$carriers =array();
		if($list)
		foreach ($list as $key => $value) {
			$carriers[$value['Code']] = $value['Name'];
		}

		$xmlRaw = $this->uApi->searchFlights($_POST,true);


		$xml = simplexml_load_string($xmlRaw);

		//in case of fault no backup plans
		// Grabs the tickets
		//checking if we have a valid xml
		// var_dump(empty($xml) );die;
		if($xml === null)
			{
				echo "<h1>Something went wrong while connecting to the server redirecting...</h1><script>window.location.reload(true);</script>";
				die ;
			}
		$flightData = $xml->children('SOAP',true)->Body->children('air', true)->LowFareSearchRsp;

		if($flightData->asXML() )
		{		//get sorted array
				$sortedSegments = $this->getRoutesData($flightData);

				// print_r($sortedSegments);die;
				$journey = array();
				$journey[] = array("origin"=>$_POST['from'] , "destination"=>$_POST['to']);
				if(isset($_POST['returnOn']))
					$journey[] = array('origin' => $_POST['to'], "destination"=>$_POST['from'] );

				$sessionData = array('flightDetails' => $xmlRaw , 'journeys' => $journey , 'searchData' => $_POST);

				$this->session->set_userdata($sessionData);
				// echo $xml->asXML();die;
				$data['flights'] = $sortedSegments;
				$data['carriers'] = $carriers;
				$data['searchData'] = $journey;
				$this->load->view("flights-list",$data);
		} else{
			$data['flights'] = array();
			$data['carriers'] = array();
			$data['searchData'] = array();

			$this->load->view("flights-list",$data);
			}
		}
		else
		{
			echo "<h1>NO POST</h1>";
		}

	}

	//the purpose of this method is to
	//allow the user to view the flights that
	//were loaded before
	public function changeFlight(){
			//we might have raw xml data in session
			//we can use it
			$sessData = 		$this->session->userdata();
			if(empty($sessData["flightDetails"])  || empty($sessData["flightDetails"]) )
			{
				$data["error"] = "Either invalid request or request timed out.Error Code :mo23iu4#";
				$this->load->view('home' , $data);
			}else{
				//develop a list of flights with basic information
				$xmlRaw = $sessData["flightDetails"];

				$list = $this->uApi->getCarriers();
				$carriers =array();
				if($list)
				foreach ($list as $key => $value) {
					$carriers[$value['Code']] = $value['Name'];
				}

				$xml = simplexml_load_string($xmlRaw);

				//in case of fault no backup plans
				// Grabs the tickets

				$flightData = $xml->children('SOAP',true)->Body->children('air', true)->LowFareSearchRsp;

				// echo ($flightData->asXML() );die ;
				//get sorted array
				//we need origin to sort the segments provided in the API
				$sortedSegments = $this->getRoutesData($flightData);

				$data['flights'] = $sortedSegments;
				$data['carriers'] = $carriers;
				$data['searchData'] = $_POST;
				$this->load->view("flights-list",$data);
			}
	}
	public static function customeMapper($listArr){
		//this method is intended for fair info list
		//in this way we have an array where theier key is actually a key to an array
		//the purpose is to use this method witha array map function for the purpose of ease
		$arrTemp = array();

		foreach ($listArr as $key => $value) {
			// code...

			$arrTemp[(string)$value->attributes()["Key"]] = $value;
		}

		return $arrTemp;
	}
	public function flightDetails($key = ""){
		if(empty($key) ){

			show_404();
		}
		else{
			$flightsXml = simplexml_load_string($this->session->flightDetails);

			// Grabs the info
			if(!($flightsXml===false) && $flightsXml->children("SOAP" , true)->Body->count() )
			{
			$LowFareSearchRsp = $flightsXml->children('SOAP',true)->Body->children('air', true)->LowFareSearchRsp;
			//echo $LowFareSearchRsp->asXML();die;

			// echo $LowFareSearchRsp->asXML();die;
			$FlightDetails = $LowFareSearchRsp->AirSegmentList;

			//fare info list
			$fareInfoList = Page::customeMapper($LowFareSearchRsp->FareInfoList->children("air", true) ) ;
			 //($fareInfoList);die;

			//segment 2 contains all the keys of all the segments
			$pricingKey= str_replace("__" ,"/" ,urldecode($key) );
			//echo "Key Posted : ".$pricingKey;
			//Air pricing array which will be grand array
			//[pricingsol_key_1]->|
			//										|[Air_pricing_info_key_1]->|
			//																							 |[PASSENGER_TYPE_CODE]
			//																							 |[PASSENGER_AGE(optional)]
			//																							 |[FareInfoRef] (direct flight)

			//										|[Air_pricing_info_key_2]->|
			//																							 |[PASSENGER_TYPE_CODE]
			//																							 |[FareInfoRef] -
			//																							 |[FareInfoRef]  |
			//																							 |[FareInfoRef]  | Connecting flights
			//																							 |[FareInfoRef]  |
			//																							 |[FareInfoRef]  |
			//																							 |[FareInfoRef] -

			//										|[Air_pricing_info_key_3]
			//[pricingsol_key_2]->|
			//										|
			//[pricingsol_key_3]->|
			//										|

			//get all the bookings
			//the key will be the segment reference
			$bookings = array();

			// var_dump($LowFareSearchRsp->asXML());die;
			//find all the air pricing solutions against our itinerary
			foreach ($LowFareSearchRsp->AirPricingSolution as $ke => $value)
				if($pricingKey == (string)$value->attributes()["Key"] )
					{

					//for all the pricing info tags nested in airpricingsolution
					//GRoup Huge
					//**Air Pricing SOlutions **Fare INFO LIST
					//GROUP LArge in AIR PRICING SOLUTIONS
					//**AIR PRICING INFO  has fare info references
					//get all the references
					//find fares having these keys
					$tempArr= array();
					$airPricingArrayLevel1 = array();
					//air pricing info could be between 1-3
					//for either one /any/all infants , childeren , adults

					foreach($value->AirPricingInfo as $k => $v)
					{
						$airPricingArrayLevel2 = array("Passenger"=>array() , "FareInfoSets"=>array() );

						//for all passengers of this type
						foreach ($v->PassengerType as $pk => $passsengerType) {
							$airPricingArrayLevel2["Passenger"][]=$passsengerType->attributes() ;
						}
						$taxes = array();
						//get a sum of taxes
						foreach ($v->TaxInfo as $TaxInfo) {
							$taxes[]= $TaxInfo->attributes();
						}
						foreach($v->BookingInfo as $booking){
							// var_dump($booking->attributes());
							$bookings[(string)$booking->attributes()["SegmentRef"]] = $booking->attributes();
						}

						$pricingKey = (string) $v->attributes()["Key"];
						//forall the fare info reference tags nested inside airpricinginfo
						foreach ($v->FareInfoRef as $key => $val) {
							// Now we have fare info referenece key
							//we just have to find fare info which has key we have here
							// var_dump($val->asXML());die;

							//check if the key is in fare info list
							$fareInfoKeyTemp = (string)$val->attributes()["Key"];
								if( array_key_exists( $fareInfoKeyTemp , $fareInfoList ) )
										{
											$airPricingArrayLevel2["FareInfoSets"][$fareInfoKeyTemp]['FareInfo'] =$fareInfoList[$fareInfoKeyTemp] ->attributes();
											$airPricingArrayLevel2["FareInfoSets"][$fareInfoKeyTemp]['NoOfPieces'] =$fareInfoList[$fareInfoKeyTemp] ->BaggageAllowance ->NumberOfPieces;
											$airPricingArrayLevel2["FareInfoSets"][$fareInfoKeyTemp]['MaxWeight'] =$fareInfoList[$fareInfoKeyTemp]->BaggageAllowance ->MaxWeight->attributes();
										}


						}
						$airPricingArrayLevel2["FareInfoSets"][$fareInfoKeyTemp]['Taxes'] =$taxes;
						// $airPricingArrayLevel2["FareInfoSets"][$fareInfoKeyTemp]['Bookings'] =$taxes;

						$airPricingArrayLevel1[(string)$v->attributes()["Key"]] = $airPricingArrayLevel2;
					} //end of airpricinginfo foreach loop

				$airPricingArrayLevel0= $airPricingArrayLevel1;
				break;
			}//end of airpricing solution if

			//fill a copy to data
			$data['pricing']=$AirPricingSol = $value;
			$data['fares'] = $airPricingArrayLevel0;
			$data['bookings'] = $bookings;
			// print_r( $data);die;
			//develop a list of segment references
			//**Grouped by journey

			//fetching all segments
			$allSegments = $FlightDetails->children('air' , true);
			$allSegments = $this->getAllSegementsArray($allSegments);



			$allSegmentsRef=array();
			$allSegmentsRefKeys=array();

			foreach ($AirPricingSol->Journey as $singleJourney) {
				//Foreach journey the loop runs
				//Sub Groups on the basis of the journey
				$tempSegmentsRef = array();
				$this->iterate($singleJourney , $tempSegmentsRef);
				$allSegmentsRef[] = $tempSegmentsRef;
			}
			foreach($allSegmentsRef as $key=>$group)
				{
					foreach ($group as $segment) {
						$allSegmentsRefKeys[$key][]=(string)$segment->attributes()["Key"] ;
					}

				}
			//we have all segments reference keys
			//now we have to develop groups of related segments
			foreach ($allSegmentsRefKeys as $key => $keysGroup) {
				// for each group of segment referenece keys
								$allRelatedSegments[] = $this->findRelatedSegments($allSegments , $keysGroup);
			}


			$sortedInOrder = array();
			//get the starting element from the array

			//sort the array and put it in an array let's say sortedayyarRef
			//do to get groupd of degments
			foreach ($allRelatedSegments as $key => $group)
				{
 					$temp = array( );
					$journey = $this->sortPathOrder($group , $temp);
					$sortedInOrder[$key]["Segments"] = $temp;
					$sortedInOrder[$key]["Journey"] = $journey;
				}
				//Now sorted In order is an array of groups of segments which are interrelated
				//develop a list of flights with basic information
				$list = $this->uApi->getCarriers();
				$carriers =array();
				if($list)
				foreach ($list as $key => $value) {
					$carriers[$value['Code']] = $value['Name'];
				}

			//now we have all segments
			$data['flights']=$sortedInOrder;
			$data['carriers']=$carriers;

			$this->load->view("flight-details", $data);
		}//end of inner if
		else{
			$data['error'] = "Something went wrong while processing your request";
			$this->load->view('home');
		}
		}//end of 404 else
	}

	//get the air pricinhng detail of an itenireary
	public function getPricing($key = ""){
		if(empty($key))
		{
			show_404();
			die;
		}
		//sanitize the key provided
		$solutionKey = str_replace("__" ,"/" ,urldecode($key) );

		//getting the info from model
		$xmlResp = $this->uApi->getPricing($solutionKey);

		//get info of
		$sessData = $this->session->userdata();
		if(isset($sessData) && isset($sessData['airPricingSol']))
		{
			$xmlRaw = $sessData['airPricingSol'];
			// die($xmlRaw);
			$xml = simplexml_load_string($xmlRaw);

			//Confirming if we have info in the session
			if(!($xml===false) && $xml->children("SOAP" , true)->Body->count() ){
					$AirPriceRsp = $xml->children("SOAP" , true)->Body->children('air' , true)->AirPriceRsp;
					$FlightDetails = $AirPriceRsp->AirItinerary;

					//gettimng all segments
					$allSegments = $this->getAllSegementsArray($FlightDetails->AirSegment);

					//getting the main pricing details now
					$airPricingSol = $AirPriceRsp->AirPriceResult->AirPricingSolution;

					foreach($airPricingSol->AirSegmentRef as $key => $ref)
					{
						$dom->getElementBy
						$dom->replaceChild($allSegments[(string)$ref->attributes()["Key"]] );
					}

					$dom= dom_import_simplexml($airPricingSol);
					$allRef = $dom->getElementsByTagName('AirSegmentRef');
					foreach ($allRef as $key => $value) {
						// code...
						var_dump($value);
					}
					die ;
					$segmentSanitized = simplexml_import_dom($dom)->asXML();

				echo "Here";
			}
		}else{
			$error = "SEssion has invalid info ";
			$this->load->view("home");
		}
	}

	public function bookNow(){
		$this->uApi->bookTicket();
		die;
		if(!$_POST){
			$this->load->view("booking");
		}
		else
		{
			if(isset($_POST['signup'])){

				$dataArray = array(

							'customer_name' => $_POST['customer_name'],
							'father_name' => $_POST['father_name'],
							'gender' => $_POST['gender'],
							'date_of_birth' => $_POST['date_of_birth'],
							'cnic' => $_POST['cnic'],
							'passport_no' => $_POST['passport_no'],
							'nationality' => $_POST['nationality'],
							'email' => $_POST['email'],
							'contact_no' => $_POST['contact_no'],
							'address' => $_POST['address'],
							);

    		$this->db->insert('customers',$dataArray);

			  $time = explode("T",$_GET['Time'][0]);

    		$bookingArray = array(

    				'customer_id' => $this->db->insert_id(),
					'departure_datetime' => $time[0],
					'arrival_datetime' => $time[1],
					'origin' => $_GET['Departure'][0],
					'destination' => $_GET['Arrival'][0],
					'ticket_price' => substr($_GET['TotalPrice'][0],3)

    			);



			if($this->db->insert('bookings',$bookingArray)){

						redirect('Page/checkout/'.$this->db->insert_id());
			}

			}
			else{

				 redirect(base_url("Page/index"));


			}
		}

	}

	public function checkout($id){

		$data['details'] = $this->db->select(array("bookings.*","customers.email","customers.contact_no"))->from("bookings")->join("customers","customers.customer_id = bookings.customer_id")->where("booking_id",$id)->get()->row();

		$this->load->view("checkout",$data);

	}

	public function handshake(){

		?>

		<form action="https://easypaystg.easypaisa.com.pk/easypay/Confirm.jsf" method="POST" id="handshake" target="_self">
		<input name="auth_token" value="<?php echo $_GET['auth_token'] ?>" hidden = "true"/>
		<input name="postBackURL" value="http://localhost<?php echo base_url("Page/thanks")?>" hidden ="true"/>

		</form>

		<script type="text/javascript">
			document.getElementById('handshake').submit(); // SUBMIT FORM
		</script>

		<?php
	}

	 public function thanks(){

    	$this->load->view("thanks");
    }

	public function privacy(){

		$this->load->view("privacy");
	}

	public function gallery(){

		$this->load->view("gallery");
	}

	public function umrah(){

		$this->load->view("umrah");
	}

	public function hajj(){

		$this->load->view("hajj");
	}

	public function hajjGallery(){

		$this->load->view("hajj-gallery");
	}

	public function termsandconditions(){

		$this->load->view("terms-and-conditions");
	}

	public function umrahPackages(){

		$this->load->view("umrah-packages");
	}

	public function umrahGallery(){

		$this->load->view("umrah-gallery");
	}

	public function contact(){

		$this->load->view("contact");
	}

	public function getRoutesData($xmlObj )
	{
		//echo gettype($xmlObj);
		//all pricing solutions
		//Al journeys are in pricing solutions array






		$grandSortedSegments=array();
		$pricingSolutions = $xmlObj->AirPricingSolution ;
		$count =$ch =0;

		// echo $pricingSolutions->asXML();die;
		//all segments
		$allSegmentsList = $xmlObj->AirSegmentList;
		$allSegments =  $allSegmentsList->children("air" , true);
		$allSegments = $this->getAllSegementsArray($allSegments);

		//will be used for keys
		$index=0;
		if($allSegmentsList && $allSegmentsList->count() > 0)
			{


				foreach ($pricingSolutions as $key => $solution) {

		  	//find all segments related /children to this journey
			  $allSegmentsRef = array ();
				$allSegmentsRefKeys=array();
				$allRelatedSegments = array();

				//recursively iterate to get segment refereneces and fill $allSegmentsRef
				//in the form of groups
				$allJourney=array();

			  foreach ($solution->Journey as $singleJourney) {
					//Foreach journey the loop runs
					//Sub Groups on the basis of the journey
					$tempSegmentsRef = array();
					$this->iterate($singleJourney , $tempSegmentsRef);
					$allSegmentsRef[] = $tempSegmentsRef;
					$allJourney[]=$singleJourney->attributes()["TravelTime"];
				}

				//we have all segment references in $allSegmentsRef
				//in the form of the groups

				//array of all reference keys
			 	foreach ($allSegmentsRef as $k => $segGroup) {
			    //All segments references will be iterated
					$keysGroup = array();
					foreach ($segGroup as $segRef) {
						// code...
				  	$keysGroup[] = ((string)$segRef->attributes()["Key"] )  ;
					}
					$allRelatedSegments[] = $this->findRelatedSegments($allSegments , $keysGroup);
				}


			  //if we have a segments array
			  if(is_array($allRelatedSegments) && count($allRelatedSegments ) >0  )
			  {
			    $sortedInOrder = array();

			    //get the starting element from the array
			   	//sort the array and put it in an array let's say sortedayyarRef
					//do to get groupd of degments
					// echo "Outer Loop is running for :".(++$ch)." count :".count($allRelatedSegments)."=====";
					foreach ($allRelatedSegments as $key => $group)
						{

							if(is_array($group) && count($group) == 1)
								{
									$tempAttr = $group[0]->attributes();

									$temp = array($group[0]);
									$journeyArr = array("departure" => (string)$tempAttr["Origin"], "arrival" => (string)$tempAttr["Destination"] ,
									  "departureTime"=>(string)$tempAttr["DepartureTime"] ,
									  "arrivalTime"=>(string)$tempAttr["ArrivalTime"] ,
										"transitTime"=>(string)$tempAttr["FlightTime"] );
								}else{
									$temp = array( );
									$journeyArr = $this->sortPathOrder($group , $temp);

								}

								$sortedInOrder[$key]["Segments"] = $temp;
								$sortedInOrder[$key]["Journey"] = $journeyArr;
								$sortedInOrder[$key]["TravelTime"] = (string)$allJourney[$key];

						}

					//get the first and the last $allSegments
			    //we already have first and last

			    //iterate over $allSegments
					$grandSortedSegments[$index]["segment"] = $sortedInOrder;
					$grandSortedSegments[$index]["pricing"] = $solution;
					$grandSortedSegments[$index]["TravelTime"] = array();
					foreach($solution->Journey as $singleJourney)
						 $grandSortedSegments[$index]["TravelTime"] = $singleJourney->attributes()["TravelTime"];

					//$this->showFlights($sortedInOrder);
				}//end of if
				++$index;
  		}//Foreach pricing solution
		}
		// echo "gonna print";
		// print_r($grandSortedSegments);die;
		return $grandSortedSegments;
	}
	private function getAllSegementsArray($segList)
	{
		$temp = array();
		foreach ($segList as $key => $seg) {
			$temp[(string)$seg->attributes()["Key"]] = $seg;
		}
		return $temp;
	}
	private function showFlights($arr =  array())
	{
		$arrLen =count($arr);
		if($arrLen > 0 )
		{
			//start of journey
			$start = $arr[0]->attributes()["Origin"];
			//end of journey
			$end = $arr[$arrLen-1]->attributes()["Destination"];
			echo "starting from :".$start;
			for ($i=1; $i <$arrLen ; $i++) {
				// code...
				echo " to ".$arr[$i]->attributes()["Origin"];
			}
			echo " to final destiniation ".$end;
		}
	}


	//sort array elements as per the itienerary path defined
	private function sortPathOrder( &$arr , &$sorted)
	{

			$transitTime = 0;
			// foreach($arr as $a)
			// 	echo $a->asXML();
			// echo "[======]";
			// var_dump($sorted);
			// die;
			//Run the loop to get the Main origin and Destination
			//using indices hack
			//Key will be origin destination and value will be index
			$pathArr = array();
			$origin  = "";
			foreach ($arr as $key => $segment) {
				if(!$segment)
					{
						unset($arr[$key]);
						continue ;
					}
				// code...
				$attr=$segment->attributes();
				$transitTime +=(int)$attr["FlightTime"];
				//check for first $iteration
				if($key == 0)
				{
					$pathArr[(string)$attr["Origin"]]=array();
					$pathArr[(string)$attr["Destination"]] = array();

					$pathArr[(string)$attr["Origin"]]['Occurence'] = 1;
					$pathArr[(string)$attr["Origin"]]['type'] = "Origin";
					$pathArr[(string)$attr["Origin"]]['index']= $key;

					$pathArr[(string)$attr["Destination"]]['Occurence'] = 1;
					$pathArr[(string)$attr["Destination"]]['type']  = "Destination";
					$pathArr[(string)$attr["Destination"]]['index']= $key;
					$origin = $attr["Origin"];
					$destination = $attr["Destination"];
					$departureTime=$attr["DepartureTime"];
					$arrivalTime=(string)$attr["ArrivalTime"];

					continue ;
				}

				//check if origin exists
				if(array_key_exists((string)$attr["Origin"] , $pathArr) )
									{
										$pathArr[(string)$attr["Origin"]]['Occurence'] =  ($pathArr[(string)$attr["Origin"]]['Occurence']+1);
										$pathArr[(string)$attr["Origin"]]["type"] = "Origin";
										$pathArr[(string)$attr["Origin"]]["index"] = $key;
									}else{
										$pathArr[(string)$attr["Origin"]]=array();
										$pathArr[(string)$attr["Origin"]]['Occurence'] =  1;
										$pathArr[(string)$attr["Origin"]]["type"] = "Origin";
										$pathArr[(string)$attr["Origin"]]["index"] = $key;
									}
				//check if destination exists
				if(array_key_exists((string)$attr["Destination"] , $pathArr) )  {
										$pathArr[(string)$attr["Destination"]]['Occurence'] = ($pathArr[(string)$attr["Destination"]]['Occurence']+1) ;
										$pathArr[(string)$attr["Destination"]]['type'] = "Destination";
										$pathArr[(string)$attr["Destination"]]['index'] = $key;

									}else{
										$pathArr[(string)$attr["Destination"]]=array();
										$pathArr[(string)$attr["Destination"]]['Occurence'] =1 ;
										$pathArr[(string)$attr["Destination"]]['type'] = "Destination";
										$pathArr[(string)$attr["Destination"]]['index'] = $key;
									}

			}
			//indices to unset
			$indices = array();
			//No we know that an element with 1 occurence is either origin or destination
			foreach ($pathArr as $value) {
				// code...
				if( $value['Occurence'] == 1 && $value['type'] == "Origin")
				{
					$sorted[]= $arr[$value['index']];
					$indices[] =$value['index'];
					$origin = (string) $arr[$value['index']]->attributes()["Origin"];
					$departureTime =(string) $arr[$value['index']]->attributes()["DepartureTime"];

				}
				if( $value['Occurence'] == 1 && $value['type'] == "Destination")
				{
					if(!in_array($value['index'] , $indices))
						{
							$destination = (string) $arr[$value['index']]->attributes()["Destination"];
							$arrivalTime = (string) $arr[$value['index']]->attributes()["ArrivalTime"];
						}
				}
			}
			//unsetting the first segment
			foreach ($indices as $index) {
				// code...
				unset($arr[$index]);
			}


			while(count($arr) >0)
			foreach ($arr as $key => $elem) {
				if(
				(string)$sorted[count($sorted)-1]->attributes()["Destination"]
					==
				(string) $elem->attributes()["Origin"] )
				{
					//Adding element to sorted array so that we have the origin and destonation all sorted
					$sorted[] = $elem;

					//remove element from source array
					unset($arr[$key]);

				}
			}


			//return an array of origin/journey where in this group we have journey info
			return array("departure"=>$origin ,"arrival"=> $destination , "departureTime" =>$departureTime ,
			 "arrivalTime"=>$arrivalTime , "transitTime" => $transitTime );
	}
	//iterate in depth
	//to develop the array of all children
	private function iterate($children , &$all )
	{
		//in case of arrau has some elements
		// var_dump($children->attributes());echo " Is Array :".is_array($children->attributes()) ;die;
		//if($children->count()  )
		if($children)
			foreach ($children as $key => $child) {

				//check if a node has key
				if(($child->attributes()["Key"]) != null)
				{
					$all[] = $child;
					//echo "in iterate :".$child->attributes()["key"]."<br>";
				}
					$this->iterate($child->AirSegmentRef , $all );
		}
	}
	private function findRelatedSegments($allSegments , $refArrays){
			//each segment is actually qa flight from one point to another
			$arrTemp=array();

			foreach ($refArrays as $key => $ref) {
					$arrTemp[]=$allSegments[(string)$ref];
			}
			return $arrTemp;
	}


}
?>
