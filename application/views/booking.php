<!DOCTYPE html>
<?php
function numToOrdinalWord($num)
		{
			$first_word = array('eth','First','Second','Third','Fouth','Fifth','Sixth','Seventh','Eighth','Ninth','Tenth','Elevents','Twelfth','Thirteenth','Fourteenth','Fifteenth','Sixteenth','Seventeenth','Eighteenth','Nineteenth','Twentieth');
			$second_word =array('','','Twenty','Thirty','Forty','Fifty');

			if($num <= 20)
				return $first_word[$num];

			$first_num = substr($num,-1,1);
			$second_num = substr($num,-2,1);

			return $string = str_replace('y-eth','ieth',$second_word[$second_num].'-'.$first_word[$first_num]);
		}

function makeFormHTML($title, $id){
	$title = numToOrdinalWord($id+1)." ".$title;
	return <<<htm
	<div class="panel panel-info">
		<div class="panel-heading">$title Info</div>
			<div class="panel-body">

				<form method="POST" action="" id="{$title}_{$id}">

				<br/>

				<div class="col-md-4">
					<label for="customer_name">Full Name</label>
					<input type="text" name="customer_name" class="form-control" id="customer_name" required>
				</div>

				<div class="col-md-4">
				 <label for="pwd">Father Name:</label>
				 <input type="text" name="father_name" class="form-control" id="father_name" required>
				</div>


				<div class="col-md-4">
					<label for="gender">Gender</label>
					<select class="form-control" id="gender" name="gender" required>
						<option>Select</option>
						<option>Male</option>
						<option>Female</option>
					</select>
				</div>

				 <div class="col-md-4">
					 <label for="cnic">CNIC</label>
					 <input type="number" name="cnic" class="form-control" id="cnic" required>
				</div>

				 <div class="col-md-4">
					<label for="nationality">Nationality:</label>
					<select class="form-control" id="nationality" name="nationality" >
						<option>Select Country</option>
						<option>Pakistan</option>
						<option>India</option>
					</select>
				</div>

				<div class="col-md-4">
					 <label for="contact_no">Contact Number:</label>
					 <input type="number" name="contact_no" class="form-control" id="contact_no" required>
				</div>

				<div class="col-md-4">
					 <label for="date_of_birth">Date of Birth:</label>
					 <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" required>
				</div>

				 <div class="col-md-4">
					 <label for="passport_no">Passport Number:</label>
					 <input type="number" name="passport_no" class="form-control" id="passport_no" required>
				</div>

				<div class="col-md-4">
					 <label for="email">Email:</label>
					 <input type="email" name="email" class="form-control" id="email" required>
				</div>

				 <div class="col-md-12">
					 <label for="pwd">Address:</label>
					<input type="text" name="address" class="form-control" id="address" required>
				</div>
			</form>
		</div><!--Panel Body Ends-->
	</div>
htm;
}
?>
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

	<div id="content">
        <div class="container">
			<div class="row">

				<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
					<div class="panel panel-success">
						<div class="panel-heading">Ads Here </div>
						<div class="panel-body">

						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
					<form name="passengerForm">
					<?php
						$passengers = array("Adult"=>$adult , "Child"=>$child , "Infant"=>$infant);

						foreach($passengers as $k => $passenger)
								for($i=0 ; $i<(int)$passenger ; $i++)
									@$html .= makeFormHTML($k , $i);
						echo $html;
					 ?>
					 <div class="col-md-12 col-md-offset-5">
	 					<br/><br/>
	 					<button type="submit" name="signup" class="btn btn-primary btn-lg" style="border-radius:0px;">Sign Up Now <i class="fa fa-text"></i></button>
	 				</div>
					</form>
				</div>
			</div><!--Row End Here-->

	</div><!--Container Ends Here-->
	</div><!--Content Ends Here-->

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
