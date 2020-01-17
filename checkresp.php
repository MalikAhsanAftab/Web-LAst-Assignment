<?php


$xmMsg = "<h1>hello world</h1>" ;

$xmlObj= simplexml_load_string($xmMsg);
//echo gettype($xmlObj);
//all pricing solutions
$pricingSolutions = $xmlObj->xpath("//air:airpricingsolution") ;

//all Journeys
$allJourneys = $xmlObj->xpath("//air:journey");

//all segments
$allSegments = $xmlObj->xpath("//air:airsegment");

foreach ($allJourneys as $key => $value) {
  //var_dump($value->asXML() );

  //find all segments related /children to this journey
  $allSegmentsRef = array ();

  //find all air segment references string $query
  $queryX = "./air:airsegmentref";

  //recursively iterate to get segment refereneces and fill $allSegmentsRef
  iterate($value->xpath($queryX) , $allSegmentsRef , $queryX);

  //array of all reference keys
  $refArrays = array();
  foreach ($allSegmentsRef as $k => $segRef) {
    //All segments references will be iterated
    $refArrays[] = $segRef->attributes()["key"]  ;

  }

  //All segments for this itinerary
  $allRelatedSegments = array();
  foreach ($refArrays as $ke => $refKey) {
    // find the segment
    $allRelatedSegments[] = ( $xmlObj->xpath("//air:airsegment[@key='".$refKey."']") )[0] ;
  }

  //if we have a segments array
  if(is_array($allRelatedSegments) && count($allRelatedSegments ) >0  )
  {
    $sortedInOrder = array();

    //get the starting element from the array
    $start = "KHI";
    $end = "LHR";

    //sort the array and put it in an array let's say sortedayyarRef
    sortPathOrder($start , $allRelatedSegments , $sortedInOrder);

    //get the first and the last $allSegments
    //we already have first and last

    //iterate over $allSegments
    showFlights($sortedInOrder);

    echo "<br><br><br>";
  }
}




function showFlights($arr =  array())
{
  $arrLen =count($arr);
  if($arrLen > 0 )
  {
    //start of journey
    $start = $arr[0]->attributes()["origin"];
    //end of journey
    $end = $arr[$arrLen-1]->attributes()["destination"];
    echo "starting from :".$start;
    for ($i=1; $i <$arrLen ; $i++) {
      // code...
      echo " to ".$arr[$i]->attributes()["origin"];
    }
    echo " to final destiniation ".$end;
  }
}


//sort array elements as per the itienerary path defined
function sortPathOrder( $end , &$arr , &$sorted)
{

    foreach ($arr as $key => $elem) {
      if($end ==(string) $elem->attributes()["origin"] )
      {
        //Adding element to sorted array so that we have the origin and destonation all sorted
        $sorted[] = $elem;

        //remove element from source array
        unset($arr[$key]);

        //keep iterating until the termination condition is met
        sortPathOrder($elem->attributes()["destination"] , $arr , $sorted);
      }
    }
}
//iterate in depth
function iterate($children , &$all ,$query)
{
  //in case of arrau has some elements
  if(is_array($children) && count($children) > 0)
  {
    foreach ($children as $key => $child) {
      $all[] = $child;
      iterate($child->xpath($query) , $all , $query);
    }
  }
}


































?>
