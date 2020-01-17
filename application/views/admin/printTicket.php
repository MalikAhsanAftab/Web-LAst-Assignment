<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
<title>EDP-<?php echo $ticketDetails->pnr?></title>
<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo  base_url("assets/css/bootstrap.css")?>"/>
		<script>window.print()</script>
</head>
<body>

	<div class="col-md-12">
	
		<table align="center" border="3" style="border-top:none;" width="500">
		<tr style="border-top:3px solid #fff;border-left:3px solid #fff;border-right:3px solid #fff;border-bottom:3px solid #000;">
			<td align="center"><b>PNR</b></td>
		    <td align="center"><b>Issue Date/Time</b></td>
		    <td><b></b></td>
		</tr>
		<tr>
			<td align="center"><?php echo $ticketDetails->pnr;?></td>
			<td align="center"><?php echo $ticketDetails->created_on;?></td>
			<td rowspan="3" align="center"><b>UAN: 0304 1111 890<br />www.explore.cab</b></td>
		</tr>	

		<tr>
			<td align="center" style="border-left: 3px solid #fff;"><b>Fare(Rs)</b></td>
			<td rowspan="2" align="center">Current</td>
		</tr>	

		<tr>
			<td align="center"><?php echo $ticketDetails->total_fare;?></td>		
		</tr>	
    </table><br />

    <table align="center" border="3" width="500">
		<tr>
			<td align="center"><b>Name</b></td>
			<td align="center"><b>Contact</b></td>
			<td align="center"><b>CNIC</b></td>
		</tr>
			<td align="center"><?php echo ucfirst($ticketDetails->passenger_name);?></td>		
			<td align="center"><?php echo ucfirst($ticketDetails->contact_no);?></td>		
			<td align="center"><?php echo ucfirst($ticketDetails->cnic);?></td>		
		</tr>	
    </table><br />

    <table align="center" border="3" style="border-top:none;" width="500">
        <tr style="border-top:3px solid #fff;border-left:3px solid #fff;border-right:3px solid #fff;border-bottom:3px solid #000;">
			<td><b>Route</b></td>
		    <td><b>Depart DateTime</b></td>
		    <td><b>Seat(s)</b></td>
		</tr>	
		<tr>
			<td><?php echo $ticketDetails->departure ." - ".$ticketDetails->arrival;?></td>
			<td align="center"><?php echo $ticketDetails->depart_datetime;?></td>
			<td align="center"><?php echo $ticketDetails->selected_seats_no;?></td>	
		</tr>	
	</table>	
	
	<br/>
	<table align="center" border="3" style="border-top:none;" width="500">
        <tr style="border-top:3px solid #fff;border-left:3px solid #fff;border-right:3px solid #fff;border-bottom:3px solid #000;">
			<td><b>Pickup Address</b></td>
		</tr>	
		<tr>
			<td align="center"><?php echo wordwrap($ticketDetails->pickup_address,60,"<br>")?></td>
		</tr>
		</table>
		
		<table align="center" border="3" style="border-top:none;" width="500">
		<tr style="border-top:3px solid #fff;border-left:3px solid #fff;border-right:3px solid #fff;border-bottom:3px solid #000;">
					<td><b>Drop Address</b></td>
				</tr>	
				<tr>
					<td align="center"><?php echo wordwrap($ticketDetails->drop_address,60,"<br>");?></td>
		</tr>		
    </table>
	
	<table align="center" border="3" style="border-top:none;" width="500">
		<tr style="border-top:3px solid #fff;border-left:3px solid #fff;border-right:3px solid #fff;border-bottom:3px solid #000;">
					<td><b>Remarks</b></td>
				</tr>	
				<tr>
					<td align="center"><?php echo wordwrap($ticketDetails->remarks,60,"<br>");?></td>
		</td>
		</tr>
    </table>
	<br>
	
	<table align="center">
		<tr>
			<td>
				<p style="color:red;align:center; font-size:13px;">*Terms & Conditions Apply From -> https://explore.cab/terms-and-conditions</p>
			</td>
		</tr>
	</table>	
	
	</div>
	
</body>
</html>
