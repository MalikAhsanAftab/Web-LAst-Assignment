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