<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class uApi extends CI_MODEL {

	public function __construct(){

		parent :: __construct();

		$this->load->model('Functions');
		$this->load->model('PageLoadingFtns');

	}

	public function index()
	{
		echo show_404();
	}

	public function getApiDetails($name){

		switch($name){

			case 'TARGET_BRANCH':
				return "P7090934";
			break;

			case 'CREDENTIALS':
				return 'Universal API/uAPI3237225337-4524b830:t%5NM4d?$x';
			break;

			case 'PROVIDER':
				return "1G";
			break;

			case 'PRE_PROD_URL':
				return 'https://apac.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/AirService';
			break ;


			case 'PROD_URL' :
				return 'https://apac.universal-api.travelport.com/B2BGateway/connect/uAPI/AirService';
			break ;

			case 'PRE_PROD_URL_SESSIONED' :
				return 'https://apac.universal-api.pp.travelport.com/B2BGateway/connect/uProfile/UProfileSharedService';
				break ;

			case 'PROD_URL_SESSIONED' :
				return 'https://apac.universal-api.travelport.com/B2BGateway/connect/uProfile/UProfileSharedService';
			break;

			default: return "CONSTANT NOT FOUND";

			}
		}

	public function searchFlights($dataArray = array(),$rawXml = false){

		//Minimum Requirements
		$from = $dataArray['from'];
		$to = $dataArray['to'];


		//getting the information from array
		$adultsCount= $dataArray["adult"];
		$childCoun= $dataArray["child"];
		$infantCount = $dataArray["infant"] ;

		//getting the age of each child
		$children = isset($dataArray["child_"]) ? $dataArray["child_"] : array();

		//getting the infant array
		$infants = isset($dataArray["infant_"]) ? $dataArray["infant_"] : array();

		//infant xml
		$infXML="";
		//child XML
		$childXML="";
		//adultXML
		$adtXML = "";
		//calculating the ages
		$childrenAge = array();
		$infantAge = array();

		//print;
		$index=1;
		foreach ($children as $key => $value) {
			$tmp='<com:SearchPassenger xmlns:com="http://www.travelport.com/schema/common_v42_0" BookingTravelerRef="'.($index++).'" Code="CNN" Age="'.$value.'" DOB="'.date ("Y-m-d"  ,strtotime("-".$value." years" , time($dataArray['departOn']) )  ).'" />';
			$childXML.=$tmp;
		}
		foreach ($infants as $key => $value) {
			$infXML.='<com:SearchPassenger xmlns:com="http://www.travelport.com/schema/common_v42_0" BookingTravelerRef="'.($index++).'" Code="INF" Age="'.$value.'" DOB="'.date ("Y-m-d"  ,strtotime("-".$value." years" , time($dataArray['departOn']) )  ).'" />';
		}
		for ( $i=0 ; $i<$dataArray['adult']; $i++) {
			$adtXML.='<com:SearchPassenger xmlns:com="http://www.travelport.com/schema/common_v42_0" BookingTravelerRef="'.($index++).'" Code="ADT" />';
		}
		//initial data that is from , to and departure time xml is developed
		// var_dump($departOn);die;

		//setting the session data specifically the passenger information
		$sessArray = array('adultXML'=>$adtXML , 'childXML'=>$childXML , 'infantXML'=>$infXML);
		$this->session->set_userdata($sessArray);

		$Route= '';
		$key=0;
		if(is_array($from))
		foreach ($from as $key => $value) {
			$Route.= $this->getTemplateXML($from[$key] , $to[$key] ,  $dataArray['departOn'][$key]);
		}
		else
			$Route.= $this->getTemplateXML($from , $to ,  $dataArray['departOn'][$key]);

		//incase we have a return flight
		//print_r($dataArray);
		if(isset($dataArray['returnOn']) )
			$Route .= $this->getTemplateXML($to[$key] , $from[0] , $dataArray['returnOn']);

		$message = '
		<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
		   <soap:Header/>
		   <soap:Body>
			  <air:LowFareSearchReq TraceId="trace" AuthorizedBy="user" SolutionResult="true" TargetBranch="'.$this->uApi->getApiDetails('TARGET_BRANCH').'" xmlns:air="http://www.travelport.com/schema/air_v42_0" xmlns:com="http://www.travelport.com/schema/common_v42_0">
				 <com:BillingPointOfSaleInfo OriginApplication="UAPI"/>
				 '.$Route.'
				 <air:AirSearchModifiers>
					<air:PreferredProviders>
					   <com:Provider Code="'.$this->uApi->getApiDetails('PROVIDER').'"/>
					</air:PreferredProviders>
				 </air:AirSearchModifiers>
				 	'
				 .$adtXML.$childXML.$infXML.
				 '
			  </air:LowFareSearchReq>
		   </soap:Body>
		</soap:Envelope>
		';

		$auth = base64_encode($this->uApi->getApiDetails('CREDENTIALS'));
		$soap_do = curl_init($this->uApi->getApiDetails('PRE_PROD_URL'));
		$header = array(
		"Content-Type: text/xml;charset=UTF-8",
		"Accept: gzip,deflate",
		"Cache-Control: no-cache",
		"Pragma: no-cache",
		"SOAPAction: \"\"",
		"Authorization: Basic $auth",
		"Content-length: ".strlen($message),
		);


		// Sending CURL Request To Fetch Data From API
		curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($soap_do, CURLOPT_TIMEOUT, 120);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($soap_do, CURLOPT_POST, true );
		curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);
		curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
		curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
		$resp = curl_exec($soap_do);
		curl_close($soap_do);
		//write to file
		$this->logger('Req:\r\n\t'.$message.'\r\nResp:'.$resp , time());

		if(!$rawXml){
		//Loads the XML
		$xml = simplexml_load_string($resp);

		return $xml;
		}
		else{
			return $resp;
		}

	}
	//its just a function which alters the xml string as per arguments
	//and then returns the string
	public function getTemplateXML($from , $to , $departOn){
		$departureOn = date_format(date_create($departOn),'Y-m-d');

		return '<air:SearchAirLeg>
		 <air:SearchOrigin>
				<com:Airport Code="'.$from.'"/>
		 </air:SearchOrigin>
		 <air:SearchDestination>
				<com:Airport Code="'.$to.'"/>
		 </air:SearchDestination>
		 <air:SearchDepTime PreferredTime="'.$departureOn.'">
		 </air:SearchDepTime>
		</air:SearchAirLeg>';
	}
	public function bookTicket($priceResult , $allSegments){

		$dateOfBirth = "1981-12-24";
		$gender = "M";
		$travelerInfo = array(
			"gender" => "M",
			"dateOfBirth" => "1996-03-15" ,
			"travelerType" => "ADT" ,
			"nationality" => "PK" ,
			"first" => "Malik" ,
			"last" =>  "Ahsan" ,
			"prefix" => "Mr" ,
			"email" => "malikahsan@gmail.com" ,
			"phone" => "+923450345645" ,
			"areaCode" => "92" ,
			"countryCode" => "35" ,
			"location" => "CCU" ,
			"type" => "Home"

		);
		$travelerInfo["shipping"] = array(
			"addressName"=> "Home"
			,"street"=> "Hillkart"
			, "city"=> "Darjeeling"
			, "state"=> "WB"
			,"postalCode"=> "721124"
			, "country"=> "PK"
		);
		$travelerInfo["address"] = $travelerInfo["shipping"];
		$bookingDetail = array(
			"ticketDate" => "2020-05-29T00:09:13"

		);

		$pricingXML= '';
		$pricingSolutions = $priceResult->children('air' , true )->AirPricingSolution;
		foreach($pricingSolutions as $sol)
		{
			//for all the pring soltions
			// var_dump($sol->asXML());
			$dom = dom_import_simplexml($sol);

			//getting the segment references list in this solution
			$refList = $dom->getElementsByTagName('AirSegmentRef') ;

			while ($refList ->length ) {
				$ref = $refList[0];
				$key = $ref->getAttribute("Key");
				// echo $allSegments[''.$key]->asXML();continue ;
				$newSegment = dom_import_simplexml($allSegments[''.$key]);
				$ref->ownerDocument->importNode($newSegment , true );
				$ref->parentNode->replaceChild($newSegment  , $ref);
			}

			$pricingXML .= str_replace('common_v42_0' , 'common_v34_0' ,simplexml_import_dom($dom)->asXML() );

		}

		$message = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
		<soapenv:Header/>
		<soapenv:Body>
				<univ:AirCreateReservationReq	xmlns:air="http://www.travelport.com/schema/air_v34_0"
					xmlns:common_v34_0="http://www.travelport.com/schema/common_v34_0" xmlns:univ="http://www.travelport.com/schema/universal_v34_0"
					AuthorizedBy="user" RetainReservation="Both" TargetBranch="'.$this->uApi->getApiDetails('TARGET_BRANCH').'" TraceId="trace">
					<com:BillingPointOfSaleInfo	xmlns:com="http://www.travelport.com/schema/common_v34_0" OriginApplication="UAPI"/>

						<com:BookingTraveler xmlns:com="http://www.travelport.com/schema/common_v34_0" DOB="'.$travelerInfo['dateOfBirth'].'" Gender="'.$travelerInfo['gender'].'"
						Key="gr8AVWGCR064r57Jt0+8bA==" Nationality="'.$travelerInfo['nationality'].'" TravelerType="'.$travelerInfo['travelerType'].'">
							<com:BookingTravelerName First="'.$travelerInfo['first'].'" Last="'.$travelerInfo['last'].'" Prefix="'.$travelerInfo['prefix'].'"/>
							<com:DeliveryInfo>
								<com:ShippingAddress>
									<com:AddressName>'.$travelerInfo['shipping']['addressName'].'</com:AddressName>
									<com:Street>'.$travelerInfo['shipping']['street'].' Road</com:Street>
									<com:City>'.$travelerInfo['shipping']['city'].'</com:City>
									<com:State>'.$travelerInfo['shipping']['state'].'</com:State>
									<com:PostalCode>'.$travelerInfo['shipping']['postalCode'].'</com:PostalCode>
									<com:Country>'.$travelerInfo['shipping']['country'].'</com:Country>
								</com:ShippingAddress>
							</com:DeliveryInfo>
							<com:PhoneNumber AreaCode="'.$travelerInfo['areaCode'].'" CountryCode="'.$travelerInfo['countryCode'].'" Location="'.$travelerInfo['location'].'" Number="'.$travelerInfo['phone'].'" Type="'.$travelerInfo['type'].'"/>

							<com:Email EmailID="'.$travelerInfo['email'].'" Type="Home"/>

							<com:SSR Carrier="FZ" FreeText="P/US/F1234567/US/27Mar20/M/27Mar20/Muhammad/Nouman"  Status="HK" Type="DOCS"/>
							<com:Address>
								<com:AddressName>'.$travelerInfo['address']['addressName'].'</com:AddressName>
								<com:Street>'.$travelerInfo['address']['street'].' Road</com:Street>
								<com:City>'.$travelerInfo['address']['city'].'</com:City>
								<com:State>'.$travelerInfo['address']['state'].'</com:State>
								<com:PostalCode>'.$travelerInfo['address']['postalCode'].'</com:PostalCode>
								<com:Country>'.$travelerInfo['address']['country'].'</com:Country>
							</com:Address>
						</com:BookingTraveler>
						<com:FormOfPayment xmlns:com="http://www.travelport.com/schema/common_v34_0" Key="a3UzhM7Q2BKAegmOCAAAAA==" Type="Cash"/>

						'.$pricingXML.'
						<com:ActionStatus
							xmlns:com="http://www.travelport.com/schema/common_v34_0" ProviderCode="1G" TicketDate="'.$bookingDetail['ticketDate'].'" Type="TAW"/>
						</univ:AirCreateReservationReq>
						</soapenv:Body>
				</soapenv:Envelope>';
		// die ($message);
		$message1 = '
			<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
				  	<soapenv:Header/>
				  <soapenv:Body>
				    <univ:AirCreateReservationReq xmlns:air="http://www.travelport.com/schema/air_v34_0" xmlns:common_v34_0="http://www.travelport.com/schema/common_v34_0" xmlns:univ="http://www.travelport.com/schema/universal_v34_0" AuthorizedBy="user" RetainReservation="Both" TargetBranch="'.$this->uApi->getApiDetails('TARGET_BRANCH').'" TraceId="trace">
				      <com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v34_0" OriginApplication="UAPI"/>
				      <com:BookingTraveler xmlns:com="http://www.travelport.com/schema/common_v34_0" Gender="M" Key="a3UzhM7Q2BKAegmOCAAAAA==" TravelerType="ADT">
				        <com:BookingTravelerName First="Muhammad" Last="Nouman" Prefix="Mr"/>
				        <com:DeliveryInfo>
				          <com:ShippingAddress>
				            <com:AddressName>Test address</com:AddressName>
				            <com:Street>St # 14</com:Street>
				            <com:City>ISB</com:City>
				            <com:State>Punjab</com:State>
				            <com:PostalCode>44000</com:PostalCode>
				            <com:Country>PK</com:Country>
				          </com:ShippingAddress>
				        </com:DeliveryInfo>
								<com:PhoneNumber AreaCode="'.$travelerInfo['areaCode'].'" CountryCode="'.$travelerInfo['countryCode'].'" Location="'.$travelerInfo['location'].'" Number="'.$travelerInfo['phone'].'" Type="'.$travelerInfo['type'].'"/>

								<com:Address>
				          <com:AddressName>dffsdf</com:AddressName>
				          <com:Street>dsd</com:Street>
				          <com:City>sda</com:City>
				          <com:State>sd</com:State>
				          <com:PostalCode>45533</com:PostalCode>
				          <com:Country>PK</com:Country>
				        </com:Address>
				      </com:BookingTraveler>
				      <com:FormOfPayment xmlns:com="http://www.travelport.com/schema/common_v34_0" Key="a3UzhM7Q2BKAegmOCAAAAA==" Type="Cash"/>
							'.$pricingXML.'
				      <com:ActionStatus xmlns:com="http://www.travelport.com/schema/common_v34_0" ProviderCode="'.$this->uApi->getApiDetails('PROVIDER').'" TicketDate="2020-05-29T16:00:00.000+05:00" Type="TAW"/>
				    </univ:AirCreateReservationReq>
				  </soapenv:Body>
				</soapenv:Envelope>
						';

		$auth = base64_encode($this->uApi->getApiDetails('CREDENTIALS'));
		$soap_do = curl_init(		$this->uApi->getApiDetails('PRE_PROD_URL'));
		$header = array(
		"Content-Type: text/xml;charset=UTF-8",
		"Accept: gzip,deflate",
		"Cache-Control: no-cache",
		"Pragma: no-cache",
		"SOAPAction: \"\"",
		"Authorization: Basic $auth",
		"Content-length: ".strlen($message),
		);


		// Sending CURL Request To Fetch Data From API
		curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($soap_do, CURLOPT_TIMEOUT, 120);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($soap_do, CURLOPT_POST, true );
		curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);
		curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
		curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
		$resp = curl_exec($soap_do);
		curl_close($soap_do);
		$this->logger('Req:\r\n\tURL::['.$this->uApi->getApiDetails('PRE_PROD_URL').']'.$message.'\r\nResp:'.$resp , time());

		echo $resp;
		echo "here";
		//Loads the XML
		//$xml = simplexml_load_string($resp);

		//return $xml;

	}
	public function endSession(){
		$message = '
			<?xml version="1.0" encoding="UTF-8"?>
			<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:shar="http://www.travelport.com/schema/sharedBooking_v34_0" xmlns:com="http://www.travelport.com/schema/common_v34_0">
			  <soapenv:Header>
			    <h:SessionContext xmlns:h="http://www.travelport.com/soa/common/security/SessionContext_v1" xmlns="http://www.travelport.com/soa/common/security/SessionContext_v1">
			      <SessTok id="4a5fa17b-3cd0-46f4-b33f-af4d24a541c2"/>
			    </h:SessionContext>
			  </soapenv:Header>
			  <soapenv:Body>
			    <shar:BookingEndReq AuthorizedBy="TVPT" TraceId="c7e2d212-0e77-458e-87e9-e4b361ffdd3d" SessionKey="4a5fa17b-3cd0-46f4-b33f-af4d24a541c2">
			      <com:BillingPointOfSaleInfo OriginApplication="UAPI"/>
			      <shar:SessionActivity>End</shar:SessionActivity>
			    </shar:BookingEndReq>
			  </soapenv:Body>
			</soapenv:Envelope>
		';
	}
	//This function will initiate a section with traveport also
	//that a session canot exceed 15 minutes
	public function startReqSession(){

			$message = '
			<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
			xmlns:shar="http://www.travelport.com/schema/sharedBooking_v34_0"
			xmlns:com="http://www.travelport.com/schema/common_v34_0">
			<soapenv:Header/>
			<soapenv:Body>
				<shar:BookingStartReq TraceId="c7e2d212-0e77-458e-87e9-e4b361ffdd8"
				 TargetBranch="'.$this->uApi->getApiDetails('TARGET_BRANCH').'" ProviderCode="'.$this->uApi->getApiDetails('PROVIDER').'">
				<com:BillingPointOfSaleInfo OriginApplication="UAPI"/>
				</shar:BookingStartReq>
			</soapenv:Body>
			</soapenv:Envelope>
			';


			$auth = base64_encode($this->uApi->getApiDetails('CREDENTIALS'));
			$soap_do = curl_init(		$this->uApi->getApiDetails('PRE_PROD_URL_SESSIONED'));
			$header = array(
			"Content-Type: text/xml;charset=UTF-8",
			"Accept: gzip,deflate",
			"Cache-Control: no-cache",
			"Pragma: no-cache",
			"SOAPAction: \"\"",
			"Authorization: Basic $auth",
			"Content-length: ".strlen($message),
			);


			// Sending CURL Request To Fetch Data From API
			curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 120);
			curl_setopt($soap_do, CURLOPT_TIMEOUT, 120);
			curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($soap_do, CURLOPT_POST, true );
			curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);
			curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
			curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
			$resp = curl_exec($soap_do);
			curl_close($soap_do);

			//write to file
					$this->logger('Req:\r\n\t'.$message.'\r\nResp:'.$resp , time());
			//Loads the XML
			$xml = simplexml_load_string($resp);
			return $xml;
	}
	public function fetchAirportsList(){

		$message = '
		<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:util="http://www.travelport.com/schema/util_v37_0" xmlns:com="http://www.travelport.com/schema/common_v37_0">
	   <soapenv:Header/>
	   <soapenv:Body>
	      <util:ReferenceDataRetrieveReq TraceId="trace" AuthorizedBy="user" TargetBranch="'.$this->uApi->getApiDetails('TARGET_BRANCH').'" TypeCode="Airport">
	         <com:BillingPointOfSaleInfo OriginApplication="uAPI"/>
	         <util:ReferenceDataSearchModifiers MaxResults="20000" StartFromResult="0" ProviderCode="1G"/>
	      </util:ReferenceDataRetrieveReq>
	   </soapenv:Body>
	 	</soapenv:Envelope>

		';


		$auth = base64_encode($this->uApi->getApiDetails('CREDENTIALS'));
		$soap_do = curl_init(		$this->uApi->getApiDetails('PRE_PROD_URL'));
		$header = array(
		"Content-Type: text/xml;charset=UTF-8",
		"Accept: gzip,deflate",
		"Cache-Control: no-cache",
		"Pragma: no-cache",
		"SOAPAction: \"\"",
		"Authorization: Basic $auth",
		"Content-length: ".strlen($message),
		);


		// Sending CURL Request To Fetch Data From API
		curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($soap_do, CURLOPT_TIMEOUT, 120);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($soap_do, CURLOPT_POST, true );
		curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);
		curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
		curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
		$resp = curl_exec($soap_do);
		curl_close($soap_do);

		//Loads the XML
		$xml = simplexml_load_string($resp);

		return $xml;
	}
	protected function getAllItineraries($sol ){
		//get info of
		$template ='';
		$template .= '<air:AirItinerary>';

		$sessData = $this->session->userdata();
		@$xmlRaw = $sessData['flightDetails'];
		$xml = simplexml_load_string($xmlRaw);
		//Confirming if we have info in the session
		if(!($xml===false) && $xml->children("SOAP" , true)->Body->count() ){
				$LowFareSearchRsp = $xml->children("SOAP" , true)->Body->children('air' , true)->LowFareSearchRsp;
				$FlightDetails = $LowFareSearchRsp->AirSegmentList->children('air' , true);
				$allSegments = $this -> getAllSegementsArray($FlightDetails);

		foreach($sol->Journey as $key => $singleJourney)
		{
				//Foreach journey the loop runs
				//Sub Groups on the basis of the journey
				$tempSegmentsRef = array();
				$this->iterate($singleJourney , $tempSegmentsRef);
				//now we have references of all related segments
				foreach ($tempSegmentsRef as $reference) {

						$segment = $allSegments[(string)$reference->attributes()['Key']];
						//start
						$segment->addAttribute('ProviderCode' , "1G");
						$dom= dom_import_simplexml($segment);
						$this->removeChildren($dom);
						$segmentSanitized = simplexml_import_dom($dom)->asXML();

						$template.= $segmentSanitized;

				}

		}
		}

		$template .= '</air:AirItinerary>';
		return $template;
	}


	//Get Solution Node
	private function getSolutionNode($solKey= ''){
		$sessData = $this->session->userdata();
		$xmlRaw = $sessData['flightDetails'];
		$xml = simplexml_load_string($xmlRaw);
			//Confirming if we have info in the session
		if(!($xml===false) && $xml->children("SOAP" , true)->Body->count() ){
				$LowFareSearchRsp = $xml->children("SOAP" , true)->Body->children('air' , true)->LowFareSearchRsp;
				$FlightDetails = $LowFareSearchRsp->AirSegmentList->children('air' , true);
				$allSegments = $this -> getAllSegementsArray($FlightDetails);

				//template string to contain xml of all itineraries

				foreach ($LowFareSearchRsp->AirPricingSolution as $ke => $sol)
					if($solKey == (string)$sol->attributes()["Key"] )
						{
							return $sol;
						}

		}
		return null;
	}
	//Air pricing request
	public function getPricing($solutionKey ){
		$session = $this->session->userdata();
		//getting the solution node
		$solNode =  $this->getSolutionNode($solutionKey) ;

		//setting the soltion node to the sesion
		//while setting the errors to be handled by user
		if($solNode === null )
		{
			var_dump($solNode);
			die;
		}
		$tempArr = array('airPricingSol'  => '<meta xmlns:air="http://www.travelport.com/schema/air_v42_0">'.$solNode-> asXML().'</meta>' );
		$this->session->set_userdata($tempArr);


		if(isset($session['adultXML']) && isset($session['childXML']) && isset($session['infantXML']) && $solNode )
		{
			$allPassengers = $session['adultXML'].$session['childXML'].$session['infantXML'];
			$allItineraries = $this->getAllItineraries($solNode);
			$message = '
				<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
					<soapenv:Header/>
					<soapenv:Body>
						<air:AirPriceReq xmlns:air="http://www.travelport.com/schema/air_v42_0" AuthorizedBy="user" TargetBranch="'.$this->uApi->getApiDetails('TARGET_BRANCH').'" TraceId="trace">
							<com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v42_0" OriginApplication="UAPI"/>
								'.$allItineraries.$allPassengers.'
							<air:AirPricingCommand CabinClass="Economy"/>
						</air:AirPriceReq>
					</soapenv:Body>
				</soapenv:Envelope>';
				// $handle = fopen("PricingReq.txt" , 'a');
				//	fwrite($handle , $message);

			$auth = base64_encode($this->uApi->getApiDetails('CREDENTIALS'));
			$soap_do = curl_init(		$this->uApi->getApiDetails('PRE_PROD_URL'));
			$header = array(
			"Content-Type: text/xml;charset=UTF-8",
			"Accept: gzip,deflate",
			"Cache-Control: no-cache",
			"Pragma: no-cache",
			"SOAPAction: \"\"",
			"Authorization: Basic $auth",
			"Content-length: ".strlen($message),
			);

			// Sending CURL Request To Fetch Data From API
			curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 120);
			curl_setopt($soap_do, CURLOPT_TIMEOUT, 120);
			curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($soap_do, CURLOPT_POST, true );
			curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);
			curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
			curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
			$resp = curl_exec($soap_do);
			curl_close($soap_do);

			//write the req resp to file
			$this->logger('Req:\r\n\t'.$message.'\r\nResp:'.$resp , time());
			//Loads the XML
			// fwrite($handle , "Response  :/r/n/t".$resp);
			$xml = simplexml_load_string($resp);

			//setting the session data for the further processing and booking and so on

			return $xml;
		}
		return false;
	}
	function bookReservedTicket(){
		$message = '
		<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
			<soapenv:Header/>
			<soapenv:Body>
				<air:AirTicketingReq xmlns:air="http://www.travelport.com/schema/air_v34_0" AuthorizedBy="user" BulkTicket="false" ReturnInfoOnFail="true" TargetBranch="'.$this->getApiDetails('TARGET_BRANCH').'" TraceId="trace">
					<com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v34_0" OriginApplication="UAPI"/>
					<air:AirReservationLocatorCode>0TE2EO</air:AirReservationLocatorCode>
					<air:AirPricingInfoRef  Key="IZyVkD4R2BKAFUNLAAAAAA==" />
				</air:AirTicketingReq>
			</soapenv:Body>
		</soapenv:Envelope>';
		$auth = base64_encode($this->uApi->getApiDetails('CREDENTIALS'));
		$soap_do = curl_init(		$this->uApi->getApiDetails('PRE_PROD_URL'));
		$header = array(
				"Content-Type: text/xml;charset=UTF-8",
				"Accept: gzip,deflate",
				"Cache-Control: no-cache",
				"Pragma: no-cache",
				"SOAPAction: \"\"",
				"Authorization: Basic $auth",
				"Content-length: ".strlen($message),
		);

	// Sending CURL Request To Fetch Data From API
		curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($soap_do, CURLOPT_TIMEOUT, 120);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($soap_do, CURLOPT_POST, true );
		curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);
		curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
		curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
		$resp = curl_exec($soap_do);

	//writing to file
	$this->logger('Req:\r\n\t'.$message.'\r\nResp:'.$resp , time());
	curl_close($soap_do);
	var_dump($resp);
	die;
	$xml = simplexml_load_string($resp);
	}
	function confirmSegmentBookability($allSegments){
		//getting the sesion details which has been developed with the travelport
		$sessData = $this->session->userdata();
		$sessionIdTP= $sessData["sessionKey"];
		$traceId = $sessData["traceId"];

		//$this ->getBookingSegments($sol);
		$total = $sessData['searchData']['adult']+$sessData['searchData']['child']+$sessData['searchData']['infant'];
		$allSegmentsXML ="";
		foreach ($allSegments as $key => $segment) {
			// code...
			//Adjusting segment such that adding the number in party attribute
			$segment->addAttribute('NumberInParty' , $total);
			//Also Adjusting for the segment so that it's all
			//children are removed and availinfo child is added
			$dom = dom_import_simplexml($segment);
		  while ($dom->firstChild) {
		    $dom->removeChild($dom->lastChild);
		  }
			$newElement = $dom->ownerDocument->createElement('air:AirAvailInfo');
			$newElement->setAttribute('ProviderCode' , (string)$segment->attributes()['ProviderCode']);
			$dom->appendChild($newElement);
			$allSegmentsXML.=$segment->asXML();

		}


		$message = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:air="http://www.travelport.com/schema/air_v34_0">
				<soapenv:Header>
						<h:SessionContext xmlns:h="http://www.travelport.com/soa/common/security/SessionContext_v1" xmlns="http://www.travelport.com/soa/common/security/SessionContext_v1">
							<SessTok id="'.$sessionIdTP.'"/>
							</h:SessionContext>
				</soapenv:Header>

			<soapenv:Body>
				<shar:BookingAirSegmentReq xmlns:shar="http://www.travelport.com/schema/sharedBooking_v34_0" TraceId="'.$traceId.'" AuthorizedBy="user" SessionKey="'.$sessionIdTP.'">
				<com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v34_0" OriginApplication="UAPI"/>
					<shar:AddAirSegment>

					'.$allSegmentsXML.'

					</shar:AddAirSegment>
				</shar:BookingAirSegmentReq>
			</soapenv:Body>
			</soapenv:Envelope>';


			$auth = base64_encode($this->uApi->getApiDetails('CREDENTIALS'));
			$soap_do = curl_init(		$this->uApi->getApiDetails('PRE_PROD_URL_SESSIONED'));
			$header = array(
					"Content-Type: text/xml;charset=UTF-8",
					"Accept: gzip,deflate",
					"Cache-Control: no-cache",
					"Pragma: no-cache",
					"SOAPAction: \"\"",
					"Authorization: Basic $auth",
					"Content-length: ".strlen($message),
			);

		// Sending CURL Request To Fetch Data From API
		curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($soap_do, CURLOPT_TIMEOUT, 120);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($soap_do, CURLOPT_POST, true );
		curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);
		curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
		curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
		$resp = curl_exec($soap_do);

		//writing to file
		$this->logger('Req:\r\n\t'.$message.'\r\nResp:'.$resp , time());
		curl_close($soap_do);
		var_dump($resp);
		die;
		$xml = simplexml_load_string($resp);
	}
	//
	//The Booking Pricing request enables the
	//addition of Stored Fare and Branded Fare information to the PNR/UR
	public function BookingPricingReq($pricingInfoArr ){
		$session = $this->session->userdata();

		//making the pricing Info xml
		$xmlPricingInfo = '';
		foreach ($pricingInfoArr as $info) {
			// code...
			$info->addAttribute('xmlns:xmlns:air' , 'http://www.travelport.com/schema/air_v34_0');
			$xmlPricingInfo .= str_replace('common_v42_0:Endorsement' ,  'com:Endorsement xmlns:com="http://www.travelport.com/schema/common_v34_0"  ' , $info->asXML() ) ;
		}

		// print_r($session);die;
		if(isset($session['adultXML']) && isset($session['childXML']) && isset($session['infantXML']) )
		{
			$allPassengers = $session['adultXML'].$session['childXML'].$session['infantXML'];
			$message = '
				<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
				<soapenv:Header>
				<h:SessionContext xmlns:h="http://www.travelport.com/soa/common/security/SessionContext_v1" xmlns="http://www.travelport.com/soa/common/security/SessionContext_v1">
				<SessTok id="'.$session['sessionKey'].'"/>
				</h:SessionContext>
				</soapenv:Header>
				<soapenv:Body>
				<shar:BookingPricingReq xmlns:shar="http://www.travelport.com/schema/sharedBooking_v34_0" TraceId="'.$session['traceId'].'" AuthorizedBy="user" SessionKey="'.$session['sessionKey'].'"  >
				<com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v34_0" OriginApplication="UAPI"/>
				<shar:AddPricing>
				'.$xmlPricingInfo.'
				</shar:AddPricing>
				</shar:BookingPricingReq>
				</soapenv:Body>
				</soapenv:Envelope>
				';
				$handle = fopen("PricingReq.txt" , 'a');
					fwrite($handle , "\r\n\t-----".$message);

			$auth = base64_encode($this->uApi->getApiDetails('CREDENTIALS'));
			$soap_do = curl_init(		$this->uApi->getApiDetails('PRE_PROD_URL_SESSIONED'));
			$header = array(
			"Content-Type: text/xml;charset=UTF-8",
			"Accept: gzip,deflate",
			"Cache-Control: no-cache",
			"Pragma: no-cache",
			"SOAPAction: \"\"",
			"Authorization: Basic $auth",
			"Content-length: ".strlen($message),
			);

			// Sending CURL Request To Fetch Data From API
			curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 120);
			curl_setopt($soap_do, CURLOPT_TIMEOUT, 120);
			curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($soap_do, CURLOPT_POST, true );
			curl_setopt($soap_do, CURLOPT_POSTFIELDS, $message);
			curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);
			curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
			$resp = curl_exec($soap_do);
			curl_close($soap_do);
			echo "here";
			die($resp);
			//Loads the XML
			// fwrite($handle , "Response  :/r/n/t".$resp);
			$xml = simplexml_load_string($resp);
			//get to know f we have a fault in the response use try catch
			$fault = $xml->children('SOAP-ENV' , true)->Body->children('SOAP-ENV', true)->Fault->asXML();
			if($fault === null)
				return $xml;
			else {
				echo $resp ;
				die;
			}

		}
		return false;
	}
	public function logger($msg , $tim)
	{
		$t = date("F d, Y h:i:s A", $tim);
		$handler = fopen('tpCommunication.txt' , 'a');
		fwrite($handler , '\r\nTime :'.$t.'\r\n\t'.$msg);
		fclose($handler);
	}
	//get the list of carriers
	public function getCarriers(){

			$this->db->select('*')->from('carriers');

			$query = $this->db->get();

			return $query->result_array();
	}
	//get Equipment codes
	public function getEquipmentCodes(){

			$this->db->select('*')->from('equipments');

			$query = $this->db->get();

			return $query->result_array();
	}
	//getting all the segments and placing the Key as key
	private function getAllSegementsArray($segList)
	{
		$temp = array();
		foreach ($segList as $key => $seg) {
			$temp[(string)$seg->attributes()["Key"]] = $seg;
		}
		return $temp;
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
	private function removeChildren(&$node){
		while($node->firstChild)
		{
			$this->removeChildren($node->firstChild);
			$node->removeChild($node->firstChild);
		}
	}

}
?>
