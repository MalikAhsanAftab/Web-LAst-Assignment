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


	<div id="slider_wrapper">
	<div id="bg_slider" class="carousel slide" data-ride="carousel">
    	<div class="carousel-inner">
    	<div class="item active">
        	<img src="<?php echo base_url();?>web-assets/images/slide_image.jpg" class="img-responsive" alt="slider">
            <!--<div class="slider">
            	<div class="slider_inner">
            		<div class="txt1"><span>Welcome To Our</span></div>
            		<div class="txt2"><span>MAX TRAVEL AGENCY</span></div>
            		<div class="txt3"><span>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod.</span></div>
            	</div>
            </div>-->
        </div>
        <div class="item">
        	<img src="<?php echo base_url();?>web-assets/images/sydney.jpg" class="img-responsive" alt="slider">
            <!--<div class="slider">
            	<div class="slider_inner">
            		<div class="txt1"><span>Welcome To Our</span></div>
            		<div class="txt2"><span>MAX TRAVEL AGENCY</span></div>
            		<div class="txt3"><span>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod.</span></div>
            	</div>
            </div>-->
        </div>
        <div class="item">
        	<img src="<?php echo base_url();?>web-assets/images/brooklyn1.jpg" class="img-responsive" alt="slider">
            <!--<div class="slider">
            	<div class="slider_inner">
            		<div class="txt1"><span>Welcome To Our</span></div>
            		<div class="txt2"><span>MAX TRAVEL AGENCY</span></div>
            		<div class="txt3"><span>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod.</span></div>
            	</div>
            </div>-->
        </div>
         <div class="item">
        	<img src="<?php echo base_url();?>web-assets/images/london.jpg" class="img-responsive" alt="slider">
            <!--<div class="slider">
            	<div class="slider_inner">
            		<div class="txt1"><span>Welcome To Our</span></div>
            		<div class="txt2"><span>MAX TRAVEL AGENCY</span></div>
            		<div class="txt3"><span>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod.</span></div>
            	</div>-->
            </div>
        </div>
    </div>
     <!-- Controls -->
            <a class="left carousel-control" href="#bg_slider" data-slide="prev">
                <span><i class="fa fa-angle-left"></i></span>
            </a>
            <a class="right carousel-control" href="#bg_slider" data-slide="next">
                <span><i class="fa fa-angle-right"></i></span>
            </a>
</div>

<!-- Search Box -->
<div id="front_tabs">
  <div class="container">
    <div class="tabs_wrapper tabs1_wrapper">
      <div class="tabs tabs1">
        <div class="tabs_tabs tabs1_tabs">
            <ul>
              <li class="active flights"><a href="#tabs-1">Flights</a></li>
              <li class="hotels"><a href="#tabs-2">Hotels</a></li>
              <li class="cars"><a href="#tabs-3">Cars</a></li>
              <li class="cruises"><a href="#tabs-4">Cruises</a></li>
            </ul>

        </div>
        <div class="tabs_content tabs1_content">

            <div id="tabs-1">
              <form method="POST" class="form1" action="<?php echo base_url("Page/flightsList")?>">
                <div class="row">
									<!--Start of From to departure section Section -->
									<div class="col-sm-12 col-md-6">
                  <div class="col-sm-4 col-md-4 tempJourney_1">
                      <label>Flying from:</label>
                        <input type="text" class="form-control" name="from[]" id="from" list="allCountries1"  onkeyup="javascript:fetchCountries(this.value);" placeholder="Flying From" value="KHI" required />
												<datalist id="allCountries1" class="allCountries">
												</datalist>
								  </div>
                  <div class="col-sm-4 col-md-4 tempJourney_1">

                      <label>To:</label>

                     <input type="text" class="form-control" id="to" name="to[]" list="allCountries2"  onkeyup="javascript:fetchCountries(this.value);" placeholder="Flying To" required  value="LHE" />
										 <datalist id="allCountries2" class="allCountries">
										 </datalist>

                    </div>

					 <script>
						function fetchCountries(value){

						if(value.length >= 3){

						$.post("<?php echo base_url("admin/Ajax/Ajax")?>",{action:"fetchCountries", keyword:value},function(data){

							$(".allCountries").html(data);

							//$("#load").hide();

						});

						}
					}
			  </script>
                  <div class="col-sm-4 col-md-3 tempJourney_1">
                    <div class="input1_wrapper">
                      <label>Departing:</label>
                      <div class="input1_inner">
                        <input type="date" class="input datepicker" name="departOn[]" value="" required>

											</div>
                    </div>
                  </div>
                    		<button type="button" id="btnInitial_1" style="margin-top:30px;" onclick="addRemoveRow(this)">+</button>

								</div>
								<!--End of from to departure section !-->
								<!--Start of other info section  -->
								<div class="col-sm-12 col-md-6" >
                  <div class="col-sm-4 col-md-12">
                    <div class="input1_wrapper">
                      <label>Returning:</label>
                      <div class="input1_inner">
                        <input type="text" class="input datepicker" value="Mm/Dd/Yy" name="returnOn">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-4">
                    <div class="select1_wrapper">
                      <label>Adult:</label>
                      <div class="select1_inner">
                        <select class="select2 select select3" style="width: 100%" name="adult">
													<option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                        </select>
                      </div>
                    </div>
                  </div>
									<div class="col-sm-4 col-md-4">
                    <div class="select1_wrapper">
                      <label>Child:</label>
                      <div class="select1_inner">
                        <select class="select2 select select3" style="width: 100%" name="child" onchange="preferncesChanged(this)">
													<option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                        </select>
                      </div>
                    </div>
                  </div>
									<div class="col-sm-4 col-md-4">
                    <div class="select1_wrapper">
                      <label>Infant:</label>
                      <div class="select1_inner">
                        <select class="select2 select select3" style="width: 100%" name="infant" onchange="preferncesChanged(this)">
													<option value="0">0</option>
													<option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                        </select>
                      </div>
                    </div>
                  </div>
								</div>
								<!--End of othjer info section -->
								</div>
									<div class="row" id="children"></div>
									<div class="row" id="infants"></div>

                  <div class="col-sm-4 col-md-2">
                    <div class="button1_wrapper">
                      <button type="submit" class="btn-default btn-form1-submit">Search <i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>

              </form>
							<script type="text/javascript">
							var child,infant = 0;
								function preferncesChanged(obj){
									console.log(obj.value);
									var label="child";
									if(obj.name=="infant")
									{
										label="infant";
									}
									var htm="";
									for(var i=0;  i< obj.value ;i++)
									{
										flag= obj.name=='infant' ? false: true;
										htm+=getHtml( obj.name+" "+(i+1), obj.name+"_" , flag) ;
									}
									if(obj.name == "infant")
									{
										//infants
										document.getElementById("infants").innerHTML =htm;
									}else {
										//children
										document.getElementById("children").innerHTML = htm;
									}

								}
								function getHtml(label , type , flag){
									if(flag)
									return `<div class="col-sm-4 col-md-1">
                    <div class="select1_wrapper ml-20">
                      <label>Age of ${label}</label>
                      <div class="select1_inner">
                        <select class="select2 select select3 " style="width: 100%" name="${type}[]" tabindex="-1" aria-hidden="true">
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11" selected>11</option>

												</select>
                      </div>
                    </div>
                  </div>`;
									return `<div class="col-sm-4 col-md-1">
                    <div class="select1_wrapper ml-20">
                      <label>Age of ${label}</label>
                      <div class="select1_inner">
                        <select class="select2 select select3 " style="width: 100%" name="${type}[]" tabindex="-1" aria-hidden="true">
                          <option value="0">0</option>
                          <option value="1" selected>1</option>
                        </select>
                      </div>
                    </div>
                  </div>`;

								}
							</script>

            </div>
			</form>
            <div id="tabs-2">
              <form action="javascript:;" class="form1">
                <div class="row">
                  <div class="col-sm-4 col-md-4">
                    <div class="select1_wrapper">
                      <label>City or Hotel Name:</label>
                      <div class="select1_inner">
                        <select class="select2 select" style="width: 100%">
                          <option value="1">Enter a destination or hotel name</option>
                          <option value="2">Lorem ipsum dolor sit amet</option>
                          <option value="3">Duis autem vel eum</option>
                          <option value="4">Ut wisi enim ad minim veniam</option>
                          <option value="5">Nam liber tempor cum</option>
                          <option value="6">At vero eos et accusam et</option>
                          <option value="7">Consetetur sadipscing elitr</option>
                          <option value="8">Sed diam nonumy</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-2">
                    <div class="input1_wrapper">
                      <label>Check-In:</label>
                      <div class="input1_inner">
                        <input type="text" class="input datepicker" value="Mm/Dd/Yy">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-2">
                    <div class="input1_wrapper">
                      <label>Check-Out:</label>
                      <div class="input1_inner">
                        <input type="text" class="input datepicker" value="Mm/Dd/Yy">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-2">
                    <div class="select1_wrapper">
                      <label>Adult:</label>
                      <div class="select1_inner">
                        <select class="select2 select" style="width: 100%">
                          <option value="1">Room  for  1  adult</option>
                          <option value="2">Room  for  2  adult</option>
                          <option value="3">Room  for  3  adult</option>
                          <option value="4">Room  for  4  adult</option>
                          <option value="5">Room  for  5  adult</option>
                          <option value="6">Room  for  6  adult</option>
                          <option value="7">Room  for  7  adult</option>
                          <option value="8">Room  for  8  adult</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-2">
                    <div class="button1_wrapper">
                      <button type="submit" class="btn-default btn-form1-submit">Search</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div id="tabs-3">
              <form action="javascript:;" class="form1">
                <div class="row">
                  <div class="col-sm-4 col-md-2">
                    <div class="select1_wrapper">
                      <label>Country:</label>
                      <div class="select1_inner">
                        <select class="select2 select" style="width: 100%">
                          <option value="1">Please Select</option>
                          <option value="2">Alaska</option>
                          <option value="3">Bahamas</option>
                          <option value="4">Bermuda</option>
                          <option value="5">Canada</option>
                          <option value="6">Caribbean</option>
                          <option value="7">Europe</option>
                          <option value="8">Hawaii</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-2">
                    <div class="select1_wrapper">
                      <label>City:</label>
                      <div class="select1_inner">
                        <select class="select2 select" style="width: 100%">
                          <option value="1">Please Select</option>
                          <option value="2">Alaska</option>
                          <option value="3">Bahamas</option>
                          <option value="4">Bermuda</option>
                          <option value="5">Canada</option>
                          <option value="6">Caribbean</option>
                          <option value="7">Europe</option>
                          <option value="8">Hawaii</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-2">
                    <div class="select1_wrapper">
                      <label>Location:</label>
                      <div class="select1_inner">
                        <select class="select2 select" style="width: 100%">
                          <option value="1">Please Select</option>
                          <option value="2">Alaska</option>
                          <option value="3">Bahamas</option>
                          <option value="4">Bermuda</option>
                          <option value="5">Canada</option>
                          <option value="6">Caribbean</option>
                          <option value="7">Europe</option>
                          <option value="8">Hawaii</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-2">
                    <div class="input1_wrapper">
                      <label>Pick up Date:</label>
                      <div class="input1_inner">
                        <input type="text" class="input datepicker" value="Mm/Dd/Yy">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-2">
                    <div class="input1_wrapper">
                      <label>Drop off Date:</label>
                      <div class="input1_inner">
                        <input type="text" class="input datepicker" value="Mm/Dd/Yy">
                      </div>
                    </div>
                  </div>


                  <div class="col-sm-4 col-md-2">
                    <div class="button1_wrapper">
                      <button type="submit" class="btn-default btn-form1-submit">Search</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div id="tabs-4">
              <form action="javascript:;" class="form1">
                <div class="row">
                  <div class="col-sm-4 col-md-2">
                    <div class="select1_wrapper">
                      <label>Sail To:</label>
                      <div class="select1_inner">
                        <select class="select2 select" style="width: 100%">
                          <option value="1">All destinations</option>
                          <option value="2">Alaska</option>
                          <option value="3">Bahamas</option>
                          <option value="4">Bermuda</option>
                          <option value="5">Canada</option>
                          <option value="6">Caribbean</option>
                          <option value="7">Europe</option>
                          <option value="8">Hawaii</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-2">
                    <div class="select1_wrapper">
                      <label>Sail From:</label>
                      <div class="select1_inner">
                        <select class="select2 select" style="width: 100%">
                          <option value="1">All ports</option>
                          <option value="2">Alaska</option>
                          <option value="3">Bahamas</option>
                          <option value="4">Bermuda</option>
                          <option value="5">Canada</option>
                          <option value="6">Caribbean</option>
                          <option value="7">Europe</option>
                          <option value="8">Hawaii</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-4 col-md-2">
                    <div class="input1_wrapper">
                      <label>Start Date:</label>
                      <div class="input1_inner">
                        <input type="text" class="input datepicker" value="From any month">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-2">
                    <div class="input1_wrapper">
                      <label>End of Date:</label>
                      <div class="input1_inner">
                        <input type="text" class="input datepicker" value="To any month">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-2">
                    <div class="select1_wrapper">
                      <label>Cruise Ship:</label>
                      <div class="select1_inner">
                        <select class="select2 select" style="width: 100%">
                          <option value="1">All Ships</option>
                          <option value="2">Alaska</option>
                          <option value="3">Bahamas</option>
                          <option value="4">Bermuda</option>
                          <option value="5">Canada</option>
                          <option value="6">Caribbean</option>
                          <option value="7">Europe</option>
                          <option value="8">Hawaii</option>
                        </select>
                      </div>
                    </div>
                  </div>


                  <div class="col-sm-4 col-md-2">
                    <div class="button1_wrapper">
                      <button type="submit" class="btn-default btn-form1-submit">Search</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

        </div>
      </div>
    </div>
  </div>
</div>
</form>

<div id="why1">
  <div class="container">

    <h2 class="animated" data-animation="fadeInUp" data-animation-delay="100">WHY WE ARE THE BEST</h2>

   <!-- <div class="title1 animated" data-animation="fadeInUp" data-animation-delay="200">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod <br>tincidunt ut laoreet dolore magna aliquam erat volutpat.</div>-->

    <br><br>

    <div class="row">
      <div class="col-sm-3">
        <div class="thumb2 animated" data-animation="flipInY" data-animation-delay="200">
          <div class="thumbnail clearfix">
            <a href="#">
              <figure class="">
                <i class="fa fa-plane fa-4x"></i>
              </figure>
              <div class="caption">
                <div class="txt1">Amazing Travel</div>
                <div class="txt2">Travel to make memories all around the world.</div>
                <!--<div class="txt3">Read More</div>-->
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="thumb2 animated" data-animation="flipInY" data-animation-delay="300">
          <div class="thumbnail clearfix">
            <a href="#">
              <figure class="">
                 <i class="fa fa-globe fa-4x"></i>
              </figure>
              <div class="caption">
                <div class="txt1">Discover</div>
                <div class="txt2">Discover the world with Max International Travels.</div>
                <!--<div class="txt3">Read More</div>-->
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="thumb2 animated" data-animation="flipInY" data-animation-delay="400">
          <div class="thumbnail clearfix">
            <a href="#">
              <figure class="">
                <i class="fa fa-flag-o fa-4x"></i>
              </figure>
              <div class="caption">
                <div class="txt1">Book Your Trip</div>
                <div class="txt2">Make a plan of your dream journey by exploring best prices we offer. </div>
                <!--<div class="txt3">Read More</div>-->
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="thumb2 animated" data-animation="flipInY" data-animation-delay="500">
          <div class="thumbnail clearfix">
            <a href="#">
              <figure class="">
               <i class="fa fa-comments fa-4x"></i>
              </figure>
              <div class="caption">
                <div class="txt1">Nice Support</div>
                <div class="txt2">We are available 24/7 for our valuable customers.</div>
                <!--<div class="txt3">Read More</div>-->
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--<div class="container1">
  <h2 class="animated" data-animation="fadeInUp" data-animation-delay="100">Umra Packages</h2>
  <div class="title1 animated" data-animation="slideInLeft" data-animation-delay="200">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod <br>tincidunt ut laoreet dolore magna aliquam erat volutpat.</div>
  <br/>

  <div id="popular_wrapper1">
     <div id="popular_inner">
          <div id="popular1">
          	<div class="inner">
          		    <div class="row">
                      <div class="col-md-4 col-sm-4 col-lg-4 animated" data-animation="slideInLeft" data-animation-delay="200">
                        <div class="popular">
                          <div class="popular_inner">
                            <figure>
                              <img src="<?php echo base_url();?>web-assets/images/kabba123.jpg" alt="" class="img-responsive">
                              <div class="over">
                                <div class="v1">Umra Package <span>15 Days</span></div>
                                <div class="v2"></div>
                              </div>
                            </figure>
                            <div class="caption embed-responsive-item">
                              <div class="txt1"><span>Umra Package</span> 15 Days</div>
                              <div class="txt2"></div>
                              <div class="txt3 clearfix">
                                <div class="left_side">
                                  <div class="stars1">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star2.png" alt="">
                                  </div>
                                  <div class="nums">- 18 Reviews</div>
                                </div>
                                <div class="right_side"><a href="umra_details.html" class="btn-default btn1">Details</a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>

                     <div class="col-md-4 col-sm-4 col-lg-4 animated" data-animation="slideInDown" data-animation-delay="200">
                      <div class="popular">
                          <div class="popular_inner">
                            <figure>
                              <img src="<?php echo base_url();?>web-assets/images/umrah1.jpg" alt="" class="img-responsive">
                              <div class="over">
                                <div class="v1">Umra Package<span>21 Days</span></div>
                                <div class="v2"></div>
                              </div>
                            </figure>
                            <div class="caption embed-responsive-item">
                              <div class="txt1"><span>Umra Package</span>21 Days</div>
                              <div class="txt2"></div>
                              <div class="txt3 clearfix">
                                <div class="left_side">
                                  <div class="stars1">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                  </div>
                                  <div class="nums">- 168 Reviews</div>
                                </div>
                                <div class="right_side"><a href="umra_details1.html" class="btn-default btn1">Details</a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                      <div class="col-md-4 col-sm-4 col-lg-4 animated" data-animation="slideInRight" data-animation-delay="200">
                        <div class="popular">
                          <div class="popular_inner">
                            <figure>
                              <img src="<?php echo base_url();?>web-assets/images/umrah.jpg" alt="" class="img-responsive">
                              <div class="over">
                                <div class="v1">Umra Package<span>28 Days</span></div>
                                <div class="v2"> </div>
                              </div>
                            </figure>
                            <div class="caption embed-responsive-item">
                              <div class="txt1"><span>Umra Package</span>28 Days</div>
                              <div class="txt2"></div>
                              <div class="txt3 clearfix">
                                <div class="left_side">
                                  <div class="stars1">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star2.png" alt="">
                                  </div>
                                  <div class="nums">- 16 Reviews</div>
                                </div>
                                <div class="right_side"><a href="umra_details2.html" class="btn-default btn1">Details</a></div>
                              </div>
                            </div>
                          </div>
                         </div>
                        </div>
                    </div>
					<div class="row">
                      <div class="col-md-4 col-sm-4 col-lg-4 animated" data-animation="slideInLeft" data-animation-delay="200">
                        <div class="popular">
                          <div class="popular_inner">
                            <figure>
                              <img src="<?php echo base_url();?>web-assets/images/makka12.jpg" alt="" class="img-responsive">
                              <div class="over">
                                <div class="v1">Ramadan 4-Star Package <span>15 Days</span></div>
                                <div class="v2">Last Ashra of Ramadan in Madina.</div>
                              </div>
                            </figure>
                            <div class="caption embed-responsive-item">
                              <div class="txt1"><span>Ramadan 4-Star Package</span>15 Days</div>
                              <div class="txt2">Spend Last Ashra in the Holy month of Ramadan in Madina.</div>
                              <div class="txt3 clearfix">
                                <div class="left_side">
                                  <div class="stars1">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star2.png" alt="">
                                  </div>
                                  <div class="nums">- 18 Reviews</div>
                                </div>
                                <div class="right_side"><a href="umra_details3.html" class="btn-default btn1">Details</a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                       </div>
                       <div class="col-md-4 col-sm-4 col-lg-4 animated" data-animation="slideInUp" data-animation-delay="200">
                      <div class="popular">
                          <div class="popular_inner">
                            <figure>
                              <img src="<?php echo base_url();?>web-assets/images/mos1.jpg" alt="" class="img-responsive">
                              <div class="over">
                                <div class="v1">Ramadan 3-Star Package <span>15 Days</span></div>
                                <div class="v2">Last Ashra of Ramadan in Makkah.</div>
                              </div>
                            </figure>
                            <div class="caption embed-responsive-item">
                              <div class="txt1"><span>Ramadan 3-Star Package</span>15 Days</div>
                              <div class="txt2">Spend Last Ashra in the Holy month of Ramadan in Makkah.</div>
                              <div class="txt3 clearfix">
                                <div class="left_side">
                                  <div class="stars1">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                  </div>
                                  <div class="nums">- 168 Reviews</div>
                                </div>
                                <div class="right_side"><a href="umra_details4.html" class="btn-default btn1">Details</a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                      <div class="col-md-4 col-sm-4 col-lg-4 animated" data-animation="slideInRight" data-animation-delay="200">
                        <div class="popular">
                          <div class="popular_inner">
                            <figure>
                              <img src="<?php echo base_url();?>web-assets/images/madina1.jpg" alt="" class="img-responsive">
                              <div class="over">
                                <div class="v1">Ramadan 4-Star Package <span>21 Days</span></div>
                                <div class="v2">4-Star Package in the Holy month of Ramadan</div>
                              </div>
                            </figure>
                            <div class="caption embed-responsive-item">
                              <div class="txt1"><span>Ramadan 4-Star Package </span>21 Days</div>
                              <div class="txt2">4-Star Umrah Package in the Holy month of Ramadan.</div>
                              <div class="txt3 clearfix">
                                <div class="left_side">
                                  <div class="stars1">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star2.png" alt="">
                                  </div>
                                  <div class="nums">- 16 Reviews</div>
                                </div>
                                <div class="right_side"><a href="umra_details5.html" class="btn-default btn1">Details</a></div>
                              </div>
                            </div>
                          </div>
                         </div>
                        </div>
                        </div>
  					  </div>
					</div>
				</div>
			</div>
		</div>-->

<div class="container">
	 <h2 class="animated" data-animation="fadeInUp" data-animation-delay="100">Top Destinations</h2>
    <div class="row">
        <div class="col-md-12">
       		<div class="popular">
            <div class="popular_inner">
        	<div class="row">
            <div class="col-md-8 padding-0 animated" data-animation="zoomIn" data-animation-delay="200">
            <figure class="item2">
            	<img src="<?php echo base_url();?>web-assets/images/ny.jpg" alt="ny" class="img-responsive">
                <div class="over1">
                <div class="v1">New York</div>
                <div class="v2"></div>
              </div>
              </figure>
            </div>
            <div class="col-md-4 padding-0 animated"  data-animation="zoomIn" data-animation-delay="800">
             <figure class="item2">
            	<img src="<?php echo base_url();?>web-assets/images/london1.jpg" alt="locations" class="img-responsive">
                <div class="over1">
                <div class="v1">London</div>
                <div class="v2"></div>
              </div>
             </figure>
            </div>
            <!--</div>

            <div class="row">-->
			<div class="col-md-4 padding-0 animated" data-animation="zoomIn" data-animation-delay="1000">
            	<figure class="item2">
            	<img src="<?php echo base_url();?>web-assets/images/paris.jpg" alt="locations" class="img-responsive">
                <div class="over1">
                <div class="v1">Paris</div>
                <div class="v2"></div>
              </div>
             </figure>
            </div>

            <div class="col-md-4 padding-0 animated" data-animation="zoomIn" data-animation-delay="1200">
            	<figure class="item2">
            	<img src="<?php echo base_url();?>web-assets/images/amsterdam.jpg" alt="locations" class="img-responsive">
                <div class="over1">
                <div class="v1">Amsterdam</div>
                <div class="v2"></div>
              </div>
             </figure>
            </div>

            <div class="col-md-4 padding-0 animated" data-animation="zoomIn" data-animation-delay="1400">
            	<figure class="item2">
            	<img src="<?php echo base_url();?>web-assets/images/rome.jpg" alt="locations" class="img-responsive">
                <div class="over1">
                <div class="v1">Rome</div>
                <div class="v2"></div>
              </div>
             </figure>
            </div>

            <div class="col-md-8 padding-0 animated" data-animation="zoomIn" data-animation-delay="1500">
            	<figure class="item2">
            	<img src="<?php echo base_url();?>web-assets/images/prague.jpg" alt="locations" class="img-responsive">
                <div class="over1">
                <div class="v1">Prague</div>
                <div class="v2"></div>
              </div>
             </figure>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
</div>
<br>
<br>

<div id="parallax1" class="parallax">
  <div class="bg1 parallax-bg">
  </div>
  <div class="overlay"></div>
  <div class="parallax-content">
    <div class="container">

      <div class="row">
        <div class="col-sm-10 animated" data-animation="fadeInLeft" data-animation-delay="100">
          <div class="txt1">Lets Travel With Us </div>
          <div class="txt2">The journey of a thousand miles begins with a single step. Start your travel planning here Search Flights, Hotels & Rental Cars.</div>
          <!--<div class="txt3">From: Khazbegi (Goergia) <strong>$159.00</strong><span>person</span></div>-->
        </div>
        <div class="col-sm-2 animated" data-animation="fadeInRight" data-animation-delay="400">
          <a href="#" class="btn-default btn0">Search</a>
        </div>

        <!--<div class="col-sm-2 animated" data-animation="slideInLeft" data-animation-delay="600" data-animation-speed="10">
          <img src="<?php echo base_url();?>web-assets/images/etihad.png" alt="etihad" class="img-responsive">
        </div>-->
      </div>

    </div>
  </div>
</div>

<div id="popular_cruises1">
  <div class="container">

    <h2 class="animated" data-animation="fadeInUp" data-animation-delay="100">Hajj & Umra Packages</h2>

<!--    <div class="title1 animated" data-animation="fadeInUp" data-animation-delay="200">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod <br>tincidunt ut laoreet dolore magna aliquam erat volutpat.</div>
-->
    <br><br>

    <div id="popular_wrapper" class="animated" data-animation="fadeIn" data-animation-delay="300">
      <div id="popular_inner">
        <div class="">
          <div id="popular">
            <div class="">
              <div class="carousel-box">
                <div class="inner">
                  <div class="carousel main">
                    <ul>
                      <li>
                        <div class="popular">
                          <div class="popular_inner">
                            <figure>
                              <img src="<?php echo base_url();?>web-assets/images/k11.jpg" alt="" class="img-responsive" width="100%" height="100%">
                              <div class="over">
                                <div class="v1">Hajj Short Package <span>21-25 Days</span></div>
                                <div class="v2"></div>
                              </div>
                            </figure>
                            <div class="caption">
                              <div class="txt1"><span>Hajj Short Package </span> 21-25 Days</div>
                              <div class="txt2"></div>
                              <div class="txt3 clearfix">
                                <div class="left_side">
                                  <div class="stars1">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star2.png" alt="">
                                  </div>
                                  <div class="nums">- 18 Reviews</div>
                                </div>
                                <div class="right_side"><a href="#" class="btn-default btn1">Details</a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="popular">
                          <div class="popular_inner">
                            <figure>
                              <img src="<?php echo base_url();?>web-assets/images/hajj1.jpg" alt="" class="img-responsive">
                              <div class="over">
                                <div class="v1">Hajj Long Package <span>38-40 Days</span></div>
                                <div class="v2"></div>
                              </div>
                            </figure>
                            <div class="caption">
                              <div class="txt1"><span>Hajj Long Package</span>38-40 Days</div>
                              <div class="txt2"></div>
                              <div class="txt3 clearfix">
                                <div class="left_side">
                                  <div class="stars1">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                  </div>
                                  <div class="nums">- 168 Reviews</div>
                                </div>
                                <div class="right_side"><a href="#" class="btn-default btn1">Details</a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="popular">
                          <div class="popular_inner">
                            <figure>
                              <img src="<?php echo base_url();?>web-assets/images/kabba123.jpg" alt="" class="img-responsive">
                              <div class="over">
                                <div class="v1">Umra Package<span>15 Days</span></div>
                                <div class="v2"></div>
                              </div>
                            </figure>
                            <div class="caption">
                              <div class="txt1"><span>Umra Package</span> 15 Days</div>
                              <div class="txt2"></div>
                              <div class="txt3 clearfix">
                                <div class="left_side">
                                  <div class="stars1">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star2.png" alt="">
                                  </div>
                                  <div class="nums">- 16 Reviews</div>
                                </div>
                                <div class="right_side"><a href="umra_details.html" class="btn-default btn1">Details</a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="popular">
                          <div class="popular_inner">
                            <figure>
                              <img src="<?php echo base_url();?>web-assets/images/umrah1.jpg" alt="" class="img-responsive">
                              <div class="over">
                                <div class="v1">Umra Package <span>21 Days</span></div>
                                <div class="v2"></div>
                              </div>
                            </figure>
                            <div class="caption">
                              <div class="txt1"><span>Umra Package</span>21 Days</div>
                              <div class="txt2"></div>
                              <div class="txt3 clearfix">
                                <div class="left_side">
                                  <div class="stars1">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                  </div>
                                  <div class="nums">- 168 Reviews</div>
                                </div>
                                <div class="right_side"><a href="umra_details1.html" class="btn-default btn1">Details</a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="popular">
                          <div class="popular_inner">
                            <figure>
                              <img src="<?php echo base_url();?>web-assets/images/umrah.jpg" alt="" class="img-responsive">
                              <div class="over">
                                <div class="v1">Umra Package <span>28 Days</span></div>
                                <div class="v2"></div>
                              </div>
                            </figure>
                            <div class="caption">
                              <div class="txt1"><span>Umra Package</span>28 Days</div>
                              <div class="txt2"></div>
                              <div class="txt3 clearfix">
                                <div class="left_side">
                                  <div class="stars1">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star2.png" alt="">
                                  </div>
                                  <div class="nums">- 18 Reviews</div>
                                </div>
                                <div class="right_side"><a href="umra_details2.html" class="btn-default btn1">Details</a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <!--<li>
                        <div class="popular">
                          <div class="popular_inner">
                            <figure>
                              <img src="<?php echo base_url();?>web-assets/images/hajj5.jpg" alt="" class="img-responsive">
                              <div class="over">
                                <div class="v1">Hajj Premium Package <span>28 Days</span></div>
                                <div class="v2"></div>
                              </div>
                            </figure>
                            <div class="caption">
                              <div class="txt1"><span>Hajj Premium Package </span>28 Days</div>
                              <div class="txt2"></div>
                              <div class="txt3 clearfix">
                                <div class="left_side">
                                  <div class="stars1">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                                    <img src="<?php echo base_url();?>web-assets/images/star2.png" alt="">
                                  </div>
                                  <div class="nums">- 16 Reviews</div>
                                </div>
                                <div class="right_side"><a href="#" class="btn-default btn1">Details</a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>-->
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="popular_pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="happy1">
  <div class="container">
    <h2 class="animated" data-animation="slideInRight" data-animation-delay="100" style="color:#FFFFFF;">Hotels</h2>
    <div class="row">
   <!-- <div class="col-md-4">
        <div class="popular animated" data-animation="slideInRight" data-animation-delay="200">
          <div class="popular_inner">
            <figure>
              <img src="<?php echo base_url();?>web-assets/images/hotel1.jpg" alt="" class="img-responsive">
            </figure>
            <div class="caption2">
              <div class="txt1"><span>Rome</span> 6 Night Tour</div>
              <div class="txt2">Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming.</div>
              <div class="txt3 clearfix">
               <div class="left_side">
                  <div class="stars1">
                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                    <img src="<?php echo base_url();?>web-assets/images/star2.png" alt="">
                  </div>
                  <div class="nums">- 16 Reviews</div>
                </div>
                <div class="right_side"><a href="#" class="btn-default btn1">See All</a></div>
              </div>
              </div>
            </div>
           </div>
          </div>-->
        </div>
    <div class="row">
        <!--<div class="col-md-4 col-centered">
        <div class="popular animated" data-animation="slideInLeft" data-animation-delay="400">
          <div class="popular_inner">
        <figure>
        <img src="<?php echo base_url();?>web-assets/images/hotel2.jpg" class="img-responsive" alt="carlton">
        </figure>
        <div class="caption2">
              <div class="txt1"><span>New York</span> 6 Night Tour</div>
              <div class="txt2">Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming.</div>
               <div class="txt3 clearfix">
                <div class="left_side">
                  <div class="stars1">
                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                    <img src="<?php echo base_url();?>web-assets/images/star2.png" alt="">
                  </div>
                  <div class="nums">- 16 Reviews</div>
                </div>
                <div class="right_side"><a href="#" class="btn-default btn1">See All</a></div>
              </div>
            </div>
    	</div>
   	 </div>
    </div>-->
    </div>
    <div class="row">
     <!--<div class="col-md-4">
    	<div class="popular animated" data-animation="slideInRight" data-animation-delay="600">
          <div class="popular_inner">
            <figure>
              <img src="<?php echo base_url();?>web-assets/images/hotel1.jpg" alt="" class="img-responsive">
            </figure>
            <div class="caption2">
              <div class="txt1"><span>London</span> 6 Night Tour</div>
              <div class="txt2">Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming.</div>
                <div class="txt3 clearfix">
                <div class="left_side">
                  <div class="stars1">
                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                    <img src="<?php echo base_url();?>web-assets/images/star1.png" alt="">
                    <img src="<?php echo base_url();?>web-assets/images/star2.png" alt="">
                  </div>
                  <div class="nums">- 16 Reviews</div>
                </div>
                <div class="right_side"><a href="#" class="btn-default btn1">See All</a></div>
              </div>
			</div>
            </div>
           </div>
          </div>-->
         </div>

    <div class="popular">
      <div class="popular_inner animated" data-animation="rotateInDownRight" data-animation-delay="200">
    		<div class="col-md-4">
     		  <figure class="item1">
              <img src="<?php echo base_url();?>web-assets/images/hayat.jpg" alt="" class="img-responsive">
              <div class="over1">
                <div class="v1">United States</div>
                <div class="v2">Hyatt Hotels</div>
              </div>
            </figure>
            <br>
            <br>
            <br>
            <figure class="item1">
              <img src="<?php echo base_url();?>web-assets/images/bellevue.jpg" alt="" class="img-responsive">
              <div class="over1">
                <div class="v1">Philippines</div>
                <div class="v2">The Bellevue Hotels</div>
              </div>
            </figure>
    </div>
   </div>
  </div>
    <div class="popular">
    <div class="popular_inner animated" data-animation="rotateInDownLeft" data-animation-delay="200">
     <div class="col-md-8">
      <figure class="item1">
          <img src="<?php echo base_url();?>web-assets/images/thread.jpg" alt="" class="img-responsive">
          <div class="over1">
            <div class="v1">United Kingdom</div>
            <div class="v2">Threadneedles Hotel</div>
          </div>
      </figure>
    </div>
    </div>
    </div>
  </div>
</div>
</div>

<div id="partners1">
<div class="container2">
 <div class="row">
        <div class="col-md-12">
        <h2 class="animated" data-animation="slideInLeft" data-animation-delay="100">"What Our Users Are Saying"</h2>
                <div class="row">
                    <div class="col-md-6 padding-0 animated" data-animation="slideInRight" data-animation-delay="100">
                        <div id="testimonial-slider" class="owl-carousel owl-theme">
                        <div class="item active">
                            <div class="testimonial">
                                <div class="pic">
                                    <img src="<?php echo base_url();?>web-assets/images/img-1.jpg" alt="" class="img-responsive">
                                </div>
                                <h3 class="testimonial-title">
                                    Yasir Sharif
                                    <small></small>
                                </h3>
                                <p class="description">Best Umra and Hajj services offered by Max International Travels. </p>
                            </div>
             			</div>
                           <div class="item">
                            <div class="testimonial">
                                <div class="pic">
                                    <img src="<?php echo base_url();?>web-assets/images/img-2.jpg" alt="" class="img-responsive">
                                </div>
                                <h3 class="testimonial-title">
                                    Imran Malik
                                    <small></small>
                                </h3>
                                <p class="description">It was exciting to see the first air portal for ticket booking and purchase. </p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 padding-0 animated" data-animation="slideInLeft" data-animation-delay="100">
                        <div id="testimonial-slider1" class="owl-carousel owl-theme">
                        <div class="item active">
                            <div class="testimonial">
                                <div class="pic">
                                    <img src="<?php echo base_url();?>web-assets/images/img-21.jpg" alt="" class="img-responsive">
                                </div>
                                <h3 class="testimonial-title">
                                    Muhammad Haseeb
                                    <small></small>
                                </h3>
                                <p class="description">Really amazing and reasonable charges of Ramadan Umra Packages.</p>
                            </div>
                            </div>
                        <div class="item">
                            <div class="testimonial">
                                <div class="pic">
                                    <img src="<?php echo base_url();?>web-assets/images/img-12.jpg" alt="" class="img-responsive">
                                </div>
                                <h3 class="testimonial-title">
                                    Zile Muhammad
                                    <small></small>
                                </h3>
                                <p class="description">Brilliant serivces provided by Max International Travels during Hajj days.</p>
                            </div>
             			</div>

                        </div>
                    </div>
                </div>
            </div>
          </div>
    </div>
</div>
<div id="partners">
  <div class="container">
    <div class="row">
    <div id="partner_slide">
          <div class="item">
            <a href="#">
              <figure>
                <img src="<?php echo base_url();?>web-assets/images/airlines/emirates.png" alt="" class="img-responsive">
              </figure>
            </a>
          </div>
          <div class="item">
            <a href="#">
              <figure>
                <img src="<?php echo base_url();?>web-assets/images/airlines/airblue.png" alt="" class="img-responsive">
              </figure>
            </a>
          </div>
          <div class="item">
            <a href="#">
              <figure>
                <img src="<?php echo base_url();?>web-assets/images/airlines/etihad.png" alt="" class="img-responsive">
              </figure>
            </a>
          </div>
          <div class="item">
            <a href="#">
              <figure>
                <img src="<?php echo base_url();?>web-assets/images/airlines/qatar.png" alt="" class="img-responsive">
              </figure>
            </a>
          </div>
          <div class="item">
            <a href="#">
              <figure>
                <img src="<?php echo base_url();?>web-assets/images/airlines/shaheen.png" alt="" class="img-responsive">
              </figure>
            </a>
          </div>
          <div class="item">
            <a href="#">
              <figure>
                <img src="<?php echo base_url();?>web-assets/images/airlines/saudiairline.png" alt="" class="img-responsive">
              </figure>
            </a>
          </div>
          <div class="item">
            <a href="#">
              <figure>
                <img src="<?php echo base_url();?>web-assets/images/airlines/klm.png" alt="" class="img-responsive">
              </figure>
            </a>
          </div>
          <div class="item">
            <a href="#">
              <figure>
                <img src="<?php echo base_url();?>web-assets/images/airlines/turkish.png" alt="" class="img-responsive">
              </figure>
            </a>
          </div>
    	</div>
    </div>
  </div>
 </div>

 <!-- Footer -->
 <?php echo $this->PageLoadingFtns->getFooter();?>

<!-- Footer Scripts-->
	<?php echo $this->PageLoadingFtns->getFootScripts();?>
	<!-- Page Related Scripts -->
<script>
  $(document).ready(function(){
    $('.carousel').carousel({
      interval: 3000
    })
  });
</script>
<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('#partner_slide').slick({
	  slidesToShow: 5,
  	  slidesToScroll: 1,
	  infinte : true,
	  draggable:true,
	  autoplay: true,
	  autoplaySpeed:700
  });
});
</script>
<script>
			$(document).ready(function(){
			$("#testimonial-slider").owlCarousel({
				items:1,
				margin: 10,
                responsiveClass: true,
				loop:true,
				dots:false,
				autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: false
    		});
		});

		$(document).ready(function(){
			$("#testimonial-slider1").owlCarousel({
				items:1,
				loop:true,
				margin: 10,
                responsiveClass: true,
				dots:false,
				autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: false
    		});
		});
		//id to track
		var inputId = 2;
		function addRemoveRow(btnObj){
			if(btnObj.innerText == "+")
			{
				//add a row
				btnObj.parentNode.innerHTML += developHTML();
				console.log(btnObj);
				document.getElementById(btnObj.id).innerText = "-";
				btnObj.style.display ="none";
				btnObj.remove();
			}else{
				//remove a row
				$(".tempJourney_"+btnObj.id.split("_")[1]).remove();
				document.getElementById(btnObj.id).remove();
			}
		}
		function developHTML(){
			++inputId;

			return `				<div class="col-sm-4 col-md-4 tempJourney_`+inputId+`">
			                      <label>Flying from:</label>
			                        <input type="text" class="form-control" name="from[]" list="allCountries`+inputId+`"  onkeyup="javascript:fetchCountries(this.value);" placeholder="Flying From" required />
															<datalist id="allCountries`+inputId+`" class="allCountries">
															</datalist>
											  </div>
			                  <div class="col-sm-4 col-md-4 tempJourney_`+inputId+`">

			                      <label>To:</label>

			                     <input type="text" class="form-control"  name="to[]" list="allCountries`+inputId+`"  onkeyup="javascript:fetchCountries(this.value);" placeholder="Flying To" required  />
													 <datalist id="allCountries`+inputId+`" class="allCountries">
													 </datalist>
			                  </div>
			                  <div class="col-sm-4 col-md-3 tempJourney_`+inputId+`">
			                    <div class="input1_wrapper">
			                      <label>Departing:</label>
			                      <div class="input1_inner">
			                        <input type="date" class="input datepicker" name="departOn[]" value="Mm/Dd/Yy" required>
														</div>
			                    </div>
			                  </div>
												<button type="button" style="margin-top:30px;" id="btn_`+inputId+`" onclick="addRemoveRow(this)">+</button>
											`;
		}
</script>


</body>
</html>
