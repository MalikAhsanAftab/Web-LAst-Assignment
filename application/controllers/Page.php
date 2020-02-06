<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 60);

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

		//sanitize / validate  posted data
		if($_POST && isset($_POST['adult']) && isset($_POST['child']) && isset($_POST['infant'])
		&& is_numeric($_POST['adult']) && is_numeric($_POST['child']) && is_numeric($_POST['infant'])
		&& ($_POST['adult']>0 ||
		 ($_POST['child']>0 && count($_POST['child_']) == $_POST['child']) ||
		($_POST['infant']>0 && count($_POST['infant_']) == $_POST['infant']) ) &&
		Page::validateDate($_POST['departOn'])
	){



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

		$flightData = $xml->children('SOAP',true)->Body->children('air', true)->LowFareSearchRsp;

		// echo ($flightData->asXML() );die ;
		//get sorted array
		$sortedSegments = $this->getRoutesData($flightData,$_POST);
		// print_r($sortedSegments);die;
		$journey = array();
		$journey[] = array("origin"=>$_POST['from'] , "destination"=>$_POST['to']);
		if(isset($_POST['returnOn']))
			$journey[] = array('origin' => $_POST['to'], "destination"=>$_POST['from'] );

		$sessionData = array('flightDetails' => $xmlRaw , 'journeys' => $journey);

		$this->session->set_userdata($sessionData);
		// echo $xml->asXML();die;
		$data['flights'] = $sortedSegments;
		$data['carriers'] = $carriers;
		$data['searchData'] = $journey;
		$this->load->view("flights-list",$data);
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
			$xmlRaw = $sessData["flightDetails"];
			$origin = $sessData["origin"];
			$destination = $sessData["destination"];
			if(empty($sessData["flightDetails"])  || empty($sessData["flightDetails"]) )
			{
				$data["error"] = "Either invalid request or request timed out.Error Code :mo23iu4#";
				$this->load->view('home' , $data);
			}else{
				//develop a list of flights with basic information
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
				$sortedSegments = $this->getRoutesData($flightData,array("from"=> $origin, "to"=>$destination));

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
			$allJourney = $this->session->journeys;

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
				if($pricingKey == $value->attributes()["Key"] )
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
								$allRelatedSegments[] = $this->findRelatedSegments($FlightDetails->children('air' , true) , $keysGroup);
			}


			$sortedInOrder = array();

			//get the starting element from the array
			$start = $this->session->origin;

			//sort the array and put it in an array let's say sortedayyarRef
			// var_dump($allRelatedSegments->asXML());die;

			foreach ($allRelatedSegments as $key=> $group)
				{
					$sortedInOrder[$key] = array( );
					$this->sortPathOrder($start , $group , $sortedInOrder[$key]);

				}
				die;
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

	public function bookNow(){

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

	public function getRoutesData($xmlObj ,$search)
	{
		//echo gettype($xmlObj);
		//all pricing solutions
		//Al journeys are in pricing solutions array
		//var_dump($xmlObj->asXML());
		$grandSortedSegments=array();
		$pricingSolutions = $xmlObj->AirPricingSolution ;

		// echo $pricingSolutions->asXML();die;
		//all segments
		$allSegmentsList = $xmlObj->AirSegmentList;
		//will be used for keys
		$index=0;

		if($allSegmentsList && $allSegmentsList->count() > 0)
			{

				$allSegments=$allSegmentsList->children("air" , true);
				foreach ($pricingSolutions as $key => $value) {
		  	//find all segments related /children to this journey
			  $allSegmentsRef = array ();

			  //recursively iterate to get segment refereneces and fill $allSegmentsRef
				// var_dump($value->Journey);die;
			  $this->iterate($value->Journey, $allSegmentsRef );
				// var_dump ($allSegmentsRef );die;
				//we have all segment references in $allSegmentsRef

				//array of all reference keys
			  $refArrays = array();
				foreach ($allSegmentsRef as $k => $segRef) {
			    //All segments references will be iterated
				  $refArrays[] = ((string)$segRef->attributes()["Key"] )  ;
				}

			  //All segments for this itinerary
			  $allRelatedSegments = $this->findRelatedSegments($allSegments , $refArrays);

			  //if we have a segments array
			  if(is_array($allRelatedSegments) && count($allRelatedSegments ) >0  )
			  {
			    $sortedInOrder = array();

			    //get the starting element from the array
			    $start = $search["from"];
			    $end = $search["to"];

			    //sort the array and put it in an array let's say sortedayyarRef
			    $this->sortPathOrder($start , $allRelatedSegments , $sortedInOrder);

					//get the first and the last $allSegments
			    //we already have first and last

			    //iterate over $allSegments
					$grandSortedSegments[$index]["segment"] = $sortedInOrder;
					$grandSortedSegments[$index]["pricing"] = $value;
					$grandSortedSegments[$index]["TravelTime"] = $value->Journey->attributes()["TravelTime"];
					//$this->showFlights($sortedInOrder);
				}//end of if
				++$index;
		  }
		}
		return $grandSortedSegments;
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
	private function sortPathOrder( $end , &$arr , &$sorted)
	{

			// echo "0-0-0-0";
			// var_dump($arr);
			// echo "[======]";
			// var_dump($sorted);

			foreach ($arr as $key => $elem) {
				if($end ==(string) $elem->attributes()["Origin"] )
				{
					//Adding element to sorted array so that we have the origin and destonation all sorted
					$sorted[] = $elem;

					//remove element from source array
					unset($arr[$key]);

					//keep iterating until the termination condition is met
					$this->sortPathOrder($elem->attributes()["Destination"] , $arr , $sorted);
				}
			}
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

			foreach ($allSegments as $key => $segment) {
				if( in_array($segment->attributes()["Key"],$refArrays)  )
					$arrTemp[]=$segment;
			}
			return $arrTemp;
	}


}
?>
