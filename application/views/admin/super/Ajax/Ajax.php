<?php 
switch(isset($_POST['action'])) {

	case 'get_arrival_city':
  
    $arrival = mysqli_fetch_array(mysqli_query("SELECT route_id,arrival FROM routes WHERE depart = '".$_POST['depart']));
	
	echo "<option value=''>---SELECT----</option>";
	
    foreach ($arrival as $value) 
    {
        echo '<option value="'.$value['route_id'].'">'.$value['arrival'].'</option>';       
    }

	break;
  
	default: echo "Direct Script Access is forbidden";
 
 }

 ?>