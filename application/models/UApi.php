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

		//print
		$index=1;
		foreach ($children as $key => $value) {
			$tmp='<com:SearchPassenger xmlns="http://www.travelport.com/schema/common_v42_0" BookingTravelerRef="'.($index++).'" Code="CNN" Age="'.$value.'" DOB="'.date ("Y-m-d"  ,strtotime("-".$value." years" , time($dataArray['departOn']) )  ).'" />';
			$childXML.=$tmp;
		}
		foreach ($infants as $key => $value) {
			$infXML.='<com:SearchPassenger xmlns="http://www.travelport.com/schema/common_v42_0" BookingTravelerRef="'.($index++).'" Code="INF" Age="'.$value.'" DOB="'.date ("Y-m-d"  ,strtotime("-".$value." years" , time($dataArray['departOn']) )  ).'" />';
		}
		for ( $i=0 ; $i<$dataArray['adult']; $i++) {
			$adtXML.='<com:SearchPassenger xmlns="http://www.travelport.com/schema/common_v42_0" BookingTravelerRef="'.($index++).'" Code="ADT" />';
		}
		//initial data that is from , to and departure time xml is developed
		// var_dump($departOn);die;
		$Route = $this->getTemplateXML($from , $to ,  $dataArray['departOn']);

		//incase we have a return flight
		if(isset($dataArray['returnOn']) )
			$Route .= $this->getTemplateXML($to , $from , $dataArray['returnOn']);

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
		// die($message);
		//<com:SearchPassenger BookingTravelerRef="1" Code="ADT" xmlns:com="http://www.travelport.com/schema/common_v42_0"/>
		$msg=`<LowFareSearchReq xmlns="http://www.travelport.com/schema/air_v42_0" TraceId="5362d11b-7c79-4b34-923d-a2633e300e95" TargetBranch="P3088249" ReturnUpsellFare="true">
  <BillingPointOfSaleInfo xmlns="http://www.travelport.com/schema/common_v42_0" OriginApplication="uAPI" />
  <SearchAirLeg>
    <SearchOrigin>
      <CityOrAirport xmlns="http://www.travelport.com/schema/common_v42_0" Code="KHI" PreferCity="true" />
    </SearchOrigin>
    <SearchDestination>
      <CityOrAirport xmlns="http://www.travelport.com/schema/common_v42_0" Code="LHR" PreferCity="true" />
    </SearchDestination>
    <SearchDepTime PreferredTime="2020-01-23" />
  </SearchAirLeg>
  <AirSearchModifiers>
    <PreferredProviders>
      <Provider xmlns="http://www.travelport.com/schema/common_v42_0" Code="1G" />
    </PreferredProviders>
  </AirSearchModifiers>
  <SearchPassenger xmlns="http://www.travelport.com/schema/common_v42_0" Code="ADT" />
  <AirPricingModifiers>
    <AccountCodes>
      <AccountCode xmlns="http://www.travelport.com/schema/common_v42_0" Code="-" />
    </AccountCodes>
  </AirPricingModifiers>
</LowFareSearchReq>`;


		$auth = base64_encode($this->uApi->getApiDetails('CREDENTIALS'));
		$soap_do = curl_init("https://emea.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/AirService");
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
	public function bookTicket(){

		$message = '
			<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
  <soapenv:Header/>
  <soapenv:Body>
    <univ:AirCreateReservationReq xmlns:air="http://www.travelport.com/schema/air_v34_0" xmlns:common_v34_0="http://www.travelport.com/schema/common_v34_0" xmlns:univ="http://www.travelport.com/schema/universal_v34_0" AuthorizedBy="user" RetainReservation="Both" TargetBranch="'.$this->uApi->getApiDetails('TARGET_BRANCH').'" TraceId="trace">
      <com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v34_0" OriginApplication="UAPI"/>
      <com:BookingTraveler xmlns:com="http://www.travelport.com/schema/common_v34_0" DOB="1998-02-28" Gender="M" Key="a3UzhM7Q2BKAegmOCAAAAA==" TravelerType="ADT">
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
        <com:SSR Carrier="FZ" FreeText="P/US/F1234567/US/17Sep69/M/24Sep15/Muhammad/Nouman" SegmentRef="a3UzhM7Q2BKAegmOCAAAAA==" Status="HK" Type="DOCS"/>
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

	<air:AirPricingSolution Key="a3UzhM7Q2BKAcgmOCAAAAA==" TotalPrice="PKR12844" BasePrice="AED230" ApproximateTotalPrice="PKR12844" ApproximateBasePrice="PKR6950" EquivalentBasePrice="PKR6950" Taxes="PKR5894" ApproximateTaxes="PKR5894">

	<air:AirSegment Key="a3UzhM7Q2BKAdgmOCAAAAA==" Group="0" Carrier="FZ" FlightNumber="335" Origin="DXB" Destination="KHI" DepartureTime="2018-05-30T10:20:00.000+04:00" ArrivalTime="2018-05-30T13:25:00.000+05:00" FlightTime="125" Distance="746" ETicketability="Yes" Equipment="73H" ChangeOfPlane="false" ParticipantLevel="Secure Sell" LinkAvailability="true" PolledAvailabilityOption="No polled avail exists" OptionalServicesIndicator="false" AvailabilitySource="A" AvailabilityDisplayType="Fare Shop/Optimal Shop">
	<air:AirAvailInfo ProviderCode="1G">
	<air:BookingCodeInfo BookingCounts="J4|C4|Z4|Y7|A7|I7|E7|O7|W7|T7|M7|N7|R7|B7|U7|V7|K7|Q7|L7|X4"/>
	</air:AirAvailInfo>
	<air:FlightDetails Key="a3UzhM7Q2BKAegmOCAAAAA==" Origin="DXB" Destination="KHI" DepartureTime="2018-05-30T10:20:00.000+04:00" ArrivalTime="2018-05-30T13:25:00.000+05:00" FlightTime="125" TravelTime="125" Equipment="73H" OriginTerminal="2" DestinationTerminal="M"/>
	</air:AirSegment>

	<air:AirPricingInfo Key="a3UzhM7Q2BKAggmOCAAAAA==" TotalPrice="PKR12844" BasePrice="AED230" ApproximateTotalPrice="PKR12844" ApproximateBasePrice="PKR6950" EquivalentBasePrice="PKR6950" Taxes="PKR5894" ApproximateTaxes="PKR5894" LatestTicketingTime="2018-05-30T23:59:00.000+05:00" PricingMethod="Guaranteed" Refundable="true" ETicketability="Yes" PlatingCarrier="FZ" ProviderCode="1G">
	<air:FareInfo Key="a3UzhM7Q2BKAngmOCAAAAA==" FareBasis="UOWBGAE1" PassengerTypeCode="ADT" Origin="DXB" Destination="KHI" EffectiveDate="2018-05-04T19:08:00.000+05:00" DepartureDate="2018-05-30" Amount="PKR6950" NegotiatedFare="false">
	<air:BookingInfo BookingCode="U" CabinClass="Economy" FareInfoRef="a3UzhM7Q2BKAngmOCAAAAA==" SegmentRef="a3UzhM7Q2BKAdgmOCAAAAA=="/>
	<air:TaxInfo Category="AE" Amount="PKR2364"/>
	<air:TaxInfo Category="F6" Amount="PKR1103"/>
	<air:TaxInfo Category="TP" Amount="PKR158"/>
	<air:TaxInfo Category="ZR" Amount="PKR158"/>
	<air:TaxInfo Category="YQ" Amount="PKR1261"/>
	<air:TaxInfo Category="YR" Amount="PKR850"/>
	<air:FareCalc>DXB FZ KHI 61.24UOWBGAE1 NUC61.24END ROE3.673637</air:FareCalc>
	<air:PassengerType Code="ADT"/>
	<air:ChangePenalty>
	<air:Percentage>0.00</air:Percentage>
	</air:ChangePenalty>
	<air:CancelPenalty>
	<air:Amount>PKR11020</air:Amount>
	</air:CancelPenalty>
	</air:AirPricingInfo>
        </air:AirPricingSolution>
      <com:ActionStatus xmlns:com="http://www.travelport.com/schema/common_v34_0" ProviderCode="'.$this->uApi->getApiDetails('PROVIDER').'" TicketDate="2018-05-29" Type="TAW"/>
    </univ:AirCreateReservationReq>
  </soapenv:Body>
</soapenv:Envelope>

		';

		$auth = base64_encode($this->uApi->getApiDetails('CREDENTIALS'));
		$soap_do = curl_init("https://emea.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/AirService");
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

		echo $resp;

		//Loads the XML
		//$xml = simplexml_load_string($resp);

		//return $xml;

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
		$soap_do = curl_init("https://emea.universal-api.pp.travelport.com/B2BGateway/connect/uAPI/AirService");
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

	//get the list of carriers
	public function getCarriers(){

			$this->db->select('*')->from('carriers');

			$query = $this->db->get();

			return $query->result_array();
	}

}
?>
