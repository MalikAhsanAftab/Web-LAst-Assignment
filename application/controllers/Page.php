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

	public function flightsList(){

		if($_POST){

		$xmlRaw = $this->uApi->searchFlights($_POST,true);

		$xml = simplexml_load_string($xmlRaw);
		// Grabs the tickets

		$flightData = $xml->children('SOAP',true)->Body->children('air', true)->LowFareSearchRsp;

		//get sorted array
		$sortedSegments = $this->getRoutesData($flightData,$_POST);

		$sessionData = array('flightDetails' => $xmlRaw , 'origin' => $_POST['from']);

		$this->session->set_userdata($sessionData);

		$data['flights'] = $sortedSegments;

		$data['searchData'] = $_POST;
		$this->load->view("flights-list",$data);

		}
		else
		{
			echo "<h1>NO POST</h1>";
		}

	}

	public function flightDetails($key = ""){
		if(empty($key) ){

			show_404();
		}
		else{
			$flightsXml = simplexml_load_string($this->session->flightDetails);

			// Grabs the tickets
			if($flightsXml->children("SOAP" , true)->Body->count() )
			{
			$LowFareSearchRsp = $flightsXml->children('SOAP',true)->Body->children('air', true)->LowFareSearchRsp;
			//echo $LowFareSearchRsp->asXML();die;
			$FlightDetails = $LowFareSearchRsp->AirSegmentList;
			//segment 2 contains all the keys of all the segments
			$pricingKey= urldecode($key);

			//find the air pricing solution against our itinerary
			foreach ($LowFareSearchRsp->AirPricingSolution as $ke => $value) {
				// code...
				if($pricingKey == $value->attributes()["Key"] )
					{

						$AirPricingSol = $value;
				  }
			}

			//fill a copy to data
			$data['pricing']=$AirPricingSol;

			//calculation of fare info
			//getting the reference key
			$fareInfoKey = ($AirPricingSol->AirPricingInfo->FareInfoRef->attributes()["Key"]);
			$fareInfoList = $LowFareSearchRsp->FareInfoList->children("air", true);

			foreach ($fareInfoList as $key => $value) {
				// code...
				if((string)$fareInfoKey == (string)$value->attributes()["Key"])
						$data['fareInfo'] = $value;
						// var_dump($value->asXML());

			}
			//echo $AirPricingSol->asXML();die;
			//develop a list of segment references
			$allSegmentsRef=array();
			$allSegmentsRefKeys=array();
			$this->iterate($AirPricingSol->Journey , $allSegmentsRef);

			foreach($allSegmentsRef as $k=>$v)
				{
					$allSegmentsRefKeys[]=(string)$v->attributes()["Key"] ;
				}
			//we have all segments reference keys
			$allRelatedSegments = $this->findRelatedSegments($FlightDetails->children('air' , true) , $allSegmentsRefKeys );
			$sortedInOrder = array();

			//get the starting element from the array
			$start = $this->session->origin;

			//sort the array and put it in an array let's say sortedayyarRef
			$this->sortPathOrder($start , $allRelatedSegments , $sortedInOrder);

			//now we have all segments
			$data['flights']=$sortedInOrder;

			$this->load->view("flight-details", $data);
		}//end of inner if
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

			  //find all air segment references string $query
			  $queryX = "./air:airsegmentref";

			  //recursively iterate to get segment refereneces and fill $allSegmentsRef
			  $this->iterate($value->Journey, $allSegmentsRef );

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
	private function iterate($children , &$all )
	{
		//in case of arrau has some elements
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
