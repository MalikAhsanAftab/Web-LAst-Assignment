<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
 
class PageLoadingFtns extends CI_MODEL {
	
	public function index(){
		
		parent :: __construct();
		
	}

	
	public function getPageTitle($page){
		
		$page = basename($page,".php");
		
		$page = ucwords(str_replace("-"," ",$page));
		
		return $this->getConstants('site_title')." | ".$page;
		
	}
	
	public function getHeadScripts(){
		
		return '
		
		<!-------------------------------------------------------------------*
		* '.$this->PageLoadingFtns->getConstants('site_title').' 			
		*====================================================================*
		* '.$this->PageLoadingFtns->getConstants('version').'			
		*====================================================================*
		* Developer : Muhammad Nouman - https://www.facebook.com/cracker.py 
		*====================================================================*
		* Contact : +92 346 5024709											
		*====================================================================*
		* Email : nomi922411@gmail.com										
		--------------------------------------------------------------------->
		
		<!-- Owl Carosuel Style Sheets -->
		<link href="'.base_url("web-assets/css/owl.carousel.css").'" rel="stylesheet">
		<link href="'.base_url("web-assets/css/owl.carousel.min.css").'" rel="stylesheet">
		<link href="'.base_url("web-assets/css/owl.theme.default.css").'" rel="stylesheet">
		<link href="'.base_url("web-assets/css/owl.theme.default.min.css").'" rel="stylesheet">
		<link href="'.base_url("web-assets/css/owl.theme.green.css").'" rel="stylesheet">
		<link href="'.base_url("web-assets/css/owl.theme.green.min.css").'" rel="stylesheet">

		<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">-->
		 
		<!--Slick slider -->
		<link rel="stylesheet" href="'.base_url("web-assets/libs/slick-slider/slick.css").'">
		<link rel="stylesheet" href="'.base_url("web-assets/libs/slick-slider/slick-theme.css").'">


		<!--Theme Style Sheets -->

		<link href="'.base_url("web-assets/css/bootstrap.css").'" rel="stylesheet">
		<link href="'.base_url("web-assets/css/font-awesome.css").'" rel="stylesheet">
		<link href="'.base_url("web-assets/css/animate.css").'" rel="stylesheet">
		<link href="'.base_url("web-assets/css/select2.css").'" rel="stylesheet">
		<link href="'.base_url("web-assets/css/smoothness/jquery-ui-1.10.0.custom.css").'" rel="stylesheet">
		<link href="'.base_url("web-assets/css/style.css").'" rel="stylesheet">
		<style>
		  /* Note: Try to remove the following lines to see the effect of CSS positioning */
		  .affix {
			  top: 0;
			  width: 100%;
		  }
		  .affix + .container-fluid {
			  padding-top: 70px;
		  }
		  .loader {
			position: fixed;
			left: 0px;
			top: 0px;
			margin-right:0px;
			margin-left:0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url('.base_url().'web-assets/images/air3.gif) 50% 50% no-repeat rgb(249,249,249);
			background-size:cover;
		  }
		.video
		{
			margin-top:-90px;
		}

		.testimonial{
			background: #55bd50;
			padding: 3px 4px 0px 37px;
			margin: 29px 40px 40px 156px;
			border-radius: 0 13px 80px 0;
			color: #fff;
			position: relative;
		}
		.testimonial .pic{
			width: 152px;
			height: 152px;
			line-height: 200px;
			border-radius: 50%;
			border: 9px solid #55bd50;
			position: absolute;
			top: -16px;
			left: -95px;
			overflow: hidden;
		}
		.testimonial .testimonial-title{
			display: inline-block;
			width: 35%;
			float: left;
			font-size: 20px;
			font-weight: 700;
			color: #fff;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			padding: 28px 20px;
			margin: 0;
			border-right: 1px solid rgba(255,255,255,0.5);
		}
		.testimonial .testimonial-title small{
			display: block;
			font-size: 12px;
			color: #fff;
			margin-top: 5px;
		}
		.testimonial .description{
			display: inline-block;
			width: 65%;
			font-size: 15px;
			color: #fff;
			letter-spacing: 0.5px;
			margin-bottom: 0;
			padding: 28px 0 28px 28px;
			position: relative;
		}
		.testimonial .description:before{
			content: "\f10d";
			font-family: fontawesome;
			position: absolute;
			top: 0;
			left: 10px;
			font-size: 20px;
			color: rgba(255,255,255,0.5);
		}
		.testimonial .description:after{
			content: "\f10e";
			font-family: fontawesome;
			font-size: 20px;
			color: rgba(255,255,255,0.5);
			position: absolute;
			bottom: 5px;
		}
		/*.owl-theme .owl-controls .owl-page.active span,
		.owl-theme .owl-controls .owl-page span{
			width: 7px;
			height: 7px;
			background: #2b9464;
			border: 4px solid #7ccba7;
			box-sizing: content-box;
		}
		.owl-theme .owl-controls .owl-page span{
			border: 4px solid transparent;
			background: #bcbcbc;*/
		}
		@media only screen and (max-width: 767px){
			.testimonial{
				border-radius: 40px;
				margin: 90px 15px 0;
				padding: 100px 40px 30px 40px;
			}
			.testimonial .pic{
				position: absolute;
				top: -85px;
				left: 0;
				right: 0;
				margin: 0 auto;
			}
			.testimonial .testimonial-title{
				width: 100%;
				float: none;
				border-right: none;
				text-align: center;
				border-bottom: 1px solid rgba(255, 255, 255, 0.5);
			}
			.testimonial .description{
				width: 100%;
			}
		}
		@media only screen and (max-width: 480px){
			.testimonial{ 
				padding: 70px 30px 30px; 
				margin: 90px auto;
				border-radius:60px;
			}
			.testimonial .pic{
				position: absolute;
				top: -85px;
				left: 0;
				right: 0;
				margin: 0 auto;
			}
			.testimonial .testimonial-title{
				width: 100%;
				float: none;
				border-right: none;
				text-align: center;
				border-bottom: 1px solid rgba(255, 255, 255, 0.5);
			}
			.testimonial .description{
				width: 100%;
			}
		}
		.padding-0{
			padding-right:0;
			padding-left:0px;
			/*padding-bottom:14px;*/
			/*padding-top:10px;*/
			}
		/* Image Zoom on Hover */
		/** {
		  -moz-box-sizing: border-box;
		  -webkit-box-sizing: border-box;
		  box-sizing: border-box;
		  margin: 0;
		  padding: 0;
		}*/

		.item1 {
		  position: relative; 
		  border: 0px solid;
		  overflow: hidden;
		}
		.item1 img {
		  max-width: 100%;
		  -moz-transition: all 0.6s;
		  -webkit-transition: all 0.6s;
		  transition: all 0.6s;
		}
		.item1:hover img {
		  -moz-transform: rotate(15deg) scale(1.4);
		  -webkit-transform:  rotate(15deg) scale(1.4);
		  transform:  rotate(15deg) scale(1.4);
		}

		.item2 {
		  position: relative; 
		  border: 0px solid;
		  overflow: hidden;
		}
		.item2 img {
		  max-width: 100%;
		  -moz-transition: all 0.7s;
		  -webkit-transition: all 0.7s;
		  transition: all 0.7s;
		}
		.item2:hover img {
		  -moz-transform:scale(1.2);
		  -webkit-transform: scale(1.2);
		  transform: scale(1.2);
		}

		</style>

		<script src="'.base_url("web-assets/js/jquery.js").'"></script>
		<script src="'.base_url("web-assets/js/jquery-ui.js").'"></script>
		<script src="'.base_url("web-assets/js/jquery-migrate-1.2.1.min.js").'"></script>
		<script src="'.base_url("web-assets/js/jquery.easing.1.3.js").'"></script>
		<script src="'.base_url("web-assets/js/superfish.js").'"></script>

		<script src="'.base_url("web-assets/js/select2.js").'"></script>
		<!--Owl Carousel JS -->
		<script src="'.base_url("web-assets/js/owl.carousel.js").'"></script>
		<script src="'.base_url("web-assets/js/owl.carousel.min.js").'"></script>

		<!--<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>-->
		 

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		</head>
		
		
		';
		
	}
	
	public function getTopBar(){
		
		return '<div class="top1_wrapper container-fluid">
			  <div class="container">
				<div class="top1 clearfix">
				  <div class="email1"><a href="#">maxumrah2013@gmail.com</a></div>
				  <div class="phone1">+92-51-5511395</div>
				  <div class="phone3">+92-333-5111330</div>
				  <div class="social_wrapper">
					<ul class="social clearfix">
						<li class="log"><a href="#"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Login</a></li>
						<li><a href="#"><i class="fa fa-user" ></i>&nbsp;&nbsp;Register</a></li>
					</ul>
				  </div>
				  <div class="lang1">
					<div class="dropdown">
					  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">English<span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li><a class="ge" href="#">German</a></li>
						<li><a class="ru" href="#">Russian</a></li>
					  </ul>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		';
	}
	
	public function getNavBar(){
		
		$nav = "";
		
			$nav .='
			
			<div class="top2_wrapper" data-spy="affix" data-offset-top="197">
				<div class="container">
				<div class="top2 clearfix">
			  <header>
				<div class="logo_wrapper img-responsive">
				  <a href="'.base_url().'" class="logo">
					<img src="'.base_url("web-assets/images/max12.png").'" alt="logo" class="img-responsive" style="margin-top:-2px; margin-bottom:0px; width:200px; height:71px;">
				  </a>
				</div>
			  </header>
			  <div class="navbar navbar_ navbar-default">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" data-spy="affix" data-offset-top="197">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<div class="navbar-collapse navbar-collapse_ collapse">
				  <ul class="nav navbar-nav sf-menu clearfix">
					<li><a href="'.base_url("Page/home").'">Home</a></li>
					<li><a href="'.base_url("Page/about").'">About Us</a></li>
					<li class="sub-menu sub-menu-1 testing"><a href="'.base_url("Page/umrah").'">Umra<em></em></a>
						<ul>
							<li><a href="'.base_url("Page/umrahPackages").'">Umra Packages</a></li>
							<li><a href="'.base_url("Page/umrahGallery").'">Umra 2017</a></li>
						</ul>
					 </li>   
					
					<li class="sub-menu sub-menu-1"><a href="'.base_url("Page/hajj").'">Hajj<em></em></a>
					<ul>
							<li><a href="'.base_url("Page/hajj").'">Hajj Packages</a></li>
							<li><a href="'.base_url("Page/hajjGallery").'">Hajj 2017</a></li>
						</ul>
					</li>
					
					
					<li><a href="'.base_url("Page/gallery").'">Gallery</a></li>
				   
					<!--<li class="sub-menu sub-menu-1"><a href="#">Pages<em></em></a>
					  <ul>
						<li><a href="flights.html">Flights</a>
						<ul>
							<li><a href="search-flights.html">Search Flights</a></li>
							<li><a href="booking-flights.html">Booking Flights</a></li>
							<li><a href="booking-flights-page.html">Flights Checkout</a></li>
						</ul>
						</li>


						<li><a href="hotels.html">Hotels</a>
							<ul>
								<li><a href="search-hotel.html">Search Hotels</a></li>
								<li><a href="booking-hotel.html">Booking Hotel</a></li>
								<li><a href="booking-hotel-page.html">Hotel Reservation</a></li>
							</ul>
						</li>

						<li><a href="cars.html">Rent a Car</a>
							<ul>
								<li><a href="search-cars.html">Search Cars</a></li>
								<li><a href="booking-cars.html">Booking Car</a></li>
								<li><a href="booking-cars-page.html">Car Reservation</a></li>
							</ul>
						</li>
						<li><a href="cruises.html">Cruises</a>
							<ul>
								<li><a href="search-cruise.html">Search Cruise</a></li>
								<li><a href="booking-cruise.html">Booking Cruise</a></li>
								<li><a href="booking-cruise-page.html">Cruise Checkout</a></li>
							</ul>
						</li>
					  </ul>
					</li>
				   
					<li class="sub-menu sub-menu-1"><a href="#">Blog<em></em></a>
					  <ul>
						<li><a href="blog.html">Right Blog</a></li>
						<li><a href="left-blog.html">Left Blog</a></li>
						<li><a href="post.html">Right Post</a></li>
						<li><a href="left-post.html">Left Post</a></li>
						<li><a href="full-post.html">Full Post</a></li>
					  </ul>
					</li>-->
					<li><a href="'.base_url("Page/contact").'">Contacts</a></li>
				  </ul>
				</div>
			  </div>
			</div>
		  </div>
		</div>';
		
		return $nav;
	}
	
	public function getFooter(){
		
		return '
			
			<div class="bot1_wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <div class="logo2_wrapper">
          <a href="Travel-agency/index.html" class="logo2">
            <img src="'.base_url().'web-assets/images/max1.png" alt="" class="img-responsive" style="margin-top:0px; margin-left:-36px; width:400px; height:150px;">
          </a>
        </div>
        <p align="justify">Max International travels is the pioneer in providing Hajj and Umrah services. With our vast 20 years experience in the field, we specialize in providing first class and hassle free services to our customers. Our customers have always been our first priority and we make sure that we make your journey worth travelling.
          </p>
        <p>
          <a href="about.html" class="btn-default btn2">Read More</a>
        </p>
      </div>
      <div class="col-sm-3">
        <div class="bot1_title">Follow Us </div>
        <ul class="ul1">
          <li><a href="#"><img src="'. base_url().'web-assets/images/fb.png" alt="fb">&nbsp;&nbsp;Facebook</a></li>
          <li><a href="#"><img src="'. base_url().'web-assets/images/google.png" alt="google">&nbsp;&nbsp;Google</a></li>
          <li><a href="#"><img src="'. base_url().'web-assets/images/twitter.png" alt="twitter">&nbsp;&nbsp;Twitter</a></li>
        </ul>
      </div>
      
      <div class="col-sm-3">
        <div class="bot1_title">Payments</div>
        <div class="img-responsive">
        <img src="'. base_url().'web-assets/images/visa3.png" alt="visa">&nbsp;&nbsp;
        <img src="'. base_url().'web-assets/images/mastercard.png" alt="mastercard">&nbsp;&nbsp;
        <img src="'. base_url().'web-assets/images/hbl.jpg" alt="hbl">
        </div>
     	<hr>
       <div class="bot1_title">Affiliations</div>
        <div class="img-responsive"> 
        <img src="'. base_url().'web-assets/images/iata.png" alt="iata" width="51" height="32">&nbsp;&nbsp;    
         <img src="'. base_url().'web-assets/images/taap.png" alt="taap" width="51" height="32">&nbsp;&nbsp;
         <img src="'. base_url().'web-assets/images/ssl.png" alt="ssl" width="51" height="32">
        </div>
      </div>
      
      <div class="col-sm-3">
        <div class="bot1_title">Contact Us</div>
        <div class="newsletter_block">
          <div class="txt1"><a href="#"><i class="fa fa-globe"></i></a>: 8-Cantt Plaza , Near GPO , The Mall Rawalpindi</div>
          <br>
        </div>
        <div class="txt1"><a href="#"><i class="fa fa-phone"></i></a>:  +92 51 5522330</div>
        <div class="txt1"><a href="#"><i class="fa fa-mobile"></i></a>:  +92 333 5111330, +92 334 5454906</div>
        <br>
        <div class="txt1"><a href="#"><i class="fa fa-envelope"></i></a>:  maxumrah2013@gmail.com <br><a href="#"><i class="fa fa-envelope"></i></a>: rwp_max_int@hotmail.com</div>
        <br>
        <div class="txt1"><a href="#"><i class="fa fa-globe"></i></a>:  www.maxinttravels.com</div>
      </div>
    </div>
  </div>
</div>

<div class="bot2_wrapper">
  <div class="container">
    <div class="left_side">
      Copyright © 2017 <a href="#" target="_blank"><strong>Max International Travels</strong></a><span>|</span> <a href="'.base_url("Page/privacy").'">Privacy Policy</a><span>|</span>  <a href="'.base_url("Page/termsandconditions").'">Terms &amp; Conditions</a>
            </div>
            <div class="right_side">Developed by <a href="http://creatorsol.com/" target="_blank"><strong>CreatorSol (Pvt.) Ltd.</strong></a></div>
  </div>
</div>

		
		';
		
	}
	
	public function getFootScripts(){
		
		
		return '
			<script src="'.base_url("web-assets/js/bootstrap.min.js").'"></script>
			<script src="'.base_url("web-assets/js/jquery.parallax-1.1.3.resize.js").'"></script>
			<script src="'.base_url("web-assets/js/SmoothScroll.js").'"></script>
			<script src="'.base_url("web-assets/js/jquery.appear.js").'"></script>
			<script src="'.base_url("web-assets/js/jquery.caroufredsel.js").'"></script>
			<script src="'.base_url("web-assets/js/jquery.touchSwipe.min.js").'"></script>
			<script src="'.base_url("web-assets/js/jquery.ui.totop.js").'"></script>
			<script src="'.base_url("web-assets/libs/slick-slider/slick.min.js").'"></script>
			<script src="'.base_url("web-assets/js/script.js").'"></script>
		';
	}
	
	public static function getConstants($name){
		
		switch($name){
			
			case 'site_title':
				return "TRAVEL SYSTEM";
			break;
			
			case 'version':
				return "1.0";
			break;
			
			case 'company_name':
				return "CREATER SOL";
			break;
			
			case 'year':
				return "2017-2018";
			break;
			
			default: return "CONSTANT NOT FOUND";
		}
	}
		
		
}

?>