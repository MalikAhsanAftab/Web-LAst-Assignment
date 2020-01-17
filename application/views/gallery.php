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
	<link href="<?php echo base_url("web-assets/")?>css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url("web-assets/")?>css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo base_url("web-assets/")?>css/touchTouch.css" rel="stylesheet">
	<link href="<?php echo base_url("web-assets/")?>css/isotope.css" rel="stylesheet">
	<link href="<?php echo base_url("web-assets/")?>css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url("web-assets/")?>css/select2.css" rel="stylesheet">
	<link href="<?php echo base_url("web-assets/")?>css/smoothness/jquery-ui-1.10.0.custom.css" rel="stylesheet">
	<link href="<?php echo base_url("web-assets/")?>css/style.css" rel="stylesheet">
	
	<script src="<?php echo base_url("web-assets/")?>js/jquery.caroufredsel.js"></script>
	<script src="<?php echo base_url("web-assets/")?>js/jquery.touchSwipe.min.js"></script>

	<script src="<?php echo base_url("web-assets/")?>js/jquery.ui.totop.js"></script>

	<script src="<?php echo base_url("web-assets/")?>js/touchTouch.jquery.js"></script>
	<script src="<?php echo base_url("web-assets/")?>js/isotope.pkgd.min.js"></script>
	<script src="<?php echo base_url("web-assets/")?>js/imagesloaded.pkgd.js"></script>
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
				
			  <div id="options" class="clearfix">
        <ul id="filters" class="pagination option-set clearfix" data-option-key="filter">
          <li><a href="#filter" data-option-value="*" class="selected">All</a></li>
          <li><a href="#filter" data-option-value=".isotope-filter1">Certifications</a></li>
          <li><a href="#filter" data-option-value=".isotope-filter2">2017</a></li>
          <li><a href="#filter" data-option-value=".isotope-filter3">2018</a></li>
        </ul>
      </div><!-- #options -->

      <div class="isotope-box">
        <div id="container" class="clearfix">
          <ul class="thumbnails clearfix" id="isotope-items">
            <div class="grid-sizer col-sm-4"></div>
            <div class="gutter-sizer"></div>

            <li class="element isotope-filter2 col-sm-4 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="<?php echo base_url("web-assets/images")?>/hajj/001.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="<?php echo base_url("web-assets/images")?>/hajj/001.jpg" width="500" height="250" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">Max Internation Travels</div>
                      <div class="txt2">Hajj 2017</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li class="element isotope-filter2 col-sm-4 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="<?php echo base_url("web-assets/images")?>/hajj/005.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="<?php echo base_url("web-assets/images")?>/hajj/005.jpg" width="500" height="250" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">Package</div>
                      <div class="txt2">Hajj 2017</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li class="element isotope-filter3 isotope-filter2 col-sm-4 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="<?php echo base_url("web-assets/images")?>/hajj/006.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="<?php echo base_url("web-assets/images")?>/hajj/006.jpg" width="500" height="250" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">Form</div>
                      <div class="txt2">Hajj 2017</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li class="element isotope-filter3 isotope-filter2 col-sm-4 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="<?php echo base_url("web-assets/images")?>/hajj/007.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="<?php echo base_url("web-assets/images")?>/hajj/007.jpg" width="500" height="250" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">Form</div>
                      <div class="txt2">Hajj 2017</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li class="element isotope-filter2 col-sm-4 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="<?php echo base_url("web-assets/images")?>/hajj/002.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="<?php echo base_url("web-assets/images")?>/hajj/002.jpg" width="500" height="250" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">Post Hajj Meeting</div>
                      <div class="txt2">2017</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li class="element isotope-filter2 col-sm-4 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="<?php echo base_url("web-assets/images")?>/hajj/003.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="<?php echo base_url("web-assets/images")?>/hajj/003.jpg" width="500" height="250" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">Post Hajj Meeting</div>
                      <div class="txt2">2017</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li class="element isotope-filter2 col-sm-4 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="<?php echo base_url("web-assets/images")?>/hajj/004.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="<?php echo base_url("web-assets/images")?>/hajj/004.jpg" width="500" height="250" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">Post Hajj Meeting</div>
                      <div class="txt2">2017</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
<!--            <li class="element isotope-filter1 col-sm-4 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery05.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery05.jpg" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">cannes, france</div>
                      <div class="txt2">hotel carlton</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li class="element isotope-filter3 isotope-filter2 col-sm-4 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery07.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery07.jpg" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">cannes, france</div>
                      <div class="txt2">hotel carlton</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li class="element isotope-filter1 col-sm-4 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery06.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery06.jpg" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">cannes, france</div>
                      <div class="txt2">hotel carlton</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li class="element isotope-filter2 col-sm-12 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery08.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery08.jpg" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">cannes, france</div>
                      <div class="txt2">hotel carlton</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li class="element isotope-filter3 col-sm-4 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery09.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery09.jpg" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">cannes, france</div>
                      <div class="txt2">hotel carlton</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li class="element isotope-filter5 col-sm-8 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery11.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery11.jpg" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">cannes, france</div>
                      <div class="txt2">hotel carlton</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>
            <li class="element isotope-filter1 isotope-filter3 col-sm-4 col-xs-12">
              <div class="thumb-isotope">
                <div class="thumbnail clearfix">
                  <a href="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery10.jpg" rel="prettyPhoto[mix]" title="Photo">
                    <figure>
                      <img src="https://demo.gridgum.com/bootstrap/Travel-agency/Travel-agency/images/gallery10.jpg" alt=""><em></em>
                    </figure>
                    <div class="caption">
                      <div class="txt1">cannes, france</div>
                      <div class="txt2">hotel carlton</div>
                    </div>
                  </a>
                </div>
              </div>
            </li>-->

          </ul>
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