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
			<div class="col-md-12">
		<?php 
		$hashRequest = '';
		$hashKey = 'XP7L9N0BR5LXV7OB'; // generated from easypay account
		$storeId="4911";
		$amount= $details->ticket_price;
		$postBackURL= "http://localhost".base_url("Page/handshake");
		$orderRefNum= $details->booking_id;
		$expiryDate="20190721 112300";
		$autoRedirect=1 ;
		$paymentMethod='CC_PAYMENT_METHOD';
		$emailAddr= $details->email;
		$mobileNum= $details->contact_no;


		///starting encryption///
		$paramMap = array();
		$paramMap['amount']  = $amount;
		$paramMap['autoRedirect']  = $autoRedirect;
		$paramMap['emailAddr']  = $emailAddr;
		$paramMap['expiryDate'] = $expiryDate;
		$paramMap['mobileNum'] =$mobileNum;
		$paramMap['orderRefNum']  = $orderRefNum;
		$paramMap['paymentMethod']  = $paymentMethod;
		$paramMap['postBackURL'] = $postBackURL;
		$paramMap['storeId']  = $storeId;

		//Creating string to be encoded
		$mapString = '';
		foreach ($paramMap as $key => $val) {
			  $mapString .=  $key.'='.$val.'&';
		}
		$mapString  = substr($mapString , 0, -1);

		$alg = MCRYPT_RIJNDAEL_128; // AES
		$mode = MCRYPT_MODE_ECB; // ECB

		$iv_size = mcrypt_get_iv_size($alg, $mode);
		$block_size = mcrypt_get_block_size($alg, $mode);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);

		// Encrypting mapString
		function pkcs5_pad($text, $blocksize) {
			  $pad = $blocksize - (strlen($text) % $blocksize);
			  return $text . str_repeat(chr($pad), $pad);
		}

		$mapString = pkcs5_pad($mapString, $block_size);
		$crypttext = mcrypt_encrypt($alg, $hashKey, $mapString, $mode, $iv);
		$hashRequest = base64_encode($crypttext);

		?>


		<form action=" https://easypaystg.easypaisa.com.pk/easypay/Index.jsf" method="POST" target="_blank">
		
		<h2>Booking Details </h2>
		
		<div class="col-md-6">
			<label>Email: </label>
			<?php echo $details->email?>
		</div>
		
		<div class="col-md-6">
			<label>Contact: </label>
			<?php echo $details->contact_no?>
		</div>
		
		<div class="col-md-6">
			<label>Origin: </label>
			<?php echo $details->origin?>
		</div>
		
		<div class="col-md-6">
			<label>Destination: </label>
			<?php echo $details->destination?>
		</div>
		
		<div class="col-md-6">
			<label>Depart Time: </label>
			<?php echo $details->departure_datetime?>
		</div>
		
		<div class="col-md-6">
			<label>Arrival Time : </label>
			<?php echo $details->arrival_datetime?>
		</div>
	
		
		<br/><br/>

		<!-- Amount of Transaction from merchant’s website -->
		<input name="amount" value="<?php echo $amount?>" hidden = "true"/>
		<!-- Store Id Provided by Easypay-->
		<input name="storeId" value="<?php echo $storeId?>" hidden = "true"/>
		<!-- Post back URL from merchant’s website -->
		<input name="postBackURL" value="<?php echo $postBackURL?>" hidden = "true"/>
		<!-- Order Reference Number from merchant’s website -->
		<input name="orderRefNum" value="<?php echo $orderRefNum?>" hidden = "true"/>
		<!-- Merchant Hash Value -->
		<input type ="hidden" name="merchantHashedReq" value="<?php echo $hashRequest;?>">
		<!-- When merchant wants to redirect their customers to Easypay secure Checkout screen for Credit Card Transactions -->
		<input type ="hidden" name="paymentMethod" value="<?php echo $paymentMethod?>">
		<!-- Expiry Date from merchant’s website (Optional) -- > always pass a future date value for this parameter-->
		<input type ="hidden" name="expiryDate" value="<?php echo $expiryDate?>"> 
		<!-- If Merchant wants to redirect to Merchant website after payment completion (Optional) -->
		<input type ="hidden" name="autoRedirect" value="<?php echo $autoRedirect?>">
		<!-- If the merchant wants to pass the customer’s entered email address it would be pre populated on Easypay checkout screen.-->
		<input type ="hidden" name="emailAddr" value="<?php echo $emailAddr?>">
		<!-- If the merchant wants to pass the customer’s entered mobile number it would be pre populated on Easypay checkout screen-->
		<input type ="hidden" name="mobileNum" value="<?php echo $mobileNum?>">
		<!-- If merchant wants to post specific Bank Identifier (Optional) ->
		<input type ="hidden" name="bankIdentifier" value="UBL456">
		<!-- This is the button of the form which submits the form -->
		<button type ="submit" class="btn btn-success btn-lg" name= "pay"> PAY NOW <i class="fa fa-money"></i></button>
		</form>
			</div>		
				</div>

                </div>
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