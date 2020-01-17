<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
 
class AdminPageLoadingFtns extends CI_MODEL {
	
	public function index(){
		
		parent :: __construct();
		
	}

	
	public function getPageTitle($page){
		
		$page = ucwords(str_replace("-"," ",$page));
		
		return $this->getConstants('site_title')." / ".$page;
		
	}
	
	public function getHeadScripts(){
		
		return '
		
		<!-------------------------------------------------------------------
		* TRAVEL     														*
		*===================================================================*
		* Version 1.0														*
		*===================================================================*
		* Developer : Muhammad Nouman - https://www.facebook.com/cracker.py *
		*===================================================================*
		* Contact : +92 346 5024709											*
		*===================================================================*
		* Email : nomi922411@gmail.com										*
		--------------------------------------------------------------------->
		
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="'.base_url("admin-assets/css/bootstrap.css").'"/>
		<link rel="stylesheet" href="'.base_url("admin-assets/css/font-awesome.css").'" />

		<!-- text fonts -->
		<link rel="stylesheet" href="'.base_url("admin-assets/css/ace-fonts.css").'" />

		<!-- ace styles -->
		<link rel="stylesheet" href="'.base_url("admin-assets/css/ace.css").'" />
		
		<!-- Date Picker-->
		<link rel="stylesheet" href="'.base_url("admin-assets/css/datepicker.css").'" />
	
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="'.base_url("admin-assets/css/jquery-ui.custom.css").'" />
		<link rel="stylesheet" href="'.base_url("admin-assets/css/jquery.gritter.css").'" />


		<!--[if lte IE 9]>
			<link rel="stylesheet" href="'.base_url("admin-assets/css/ace-part2.css").'" />
		<![endif]-->
		<link rel="stylesheet" href="'.base_url("admin-assets/css/ace-rtl.css" ).'"/>

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="'.base_url("admin-assets/css/ace-ie.css" ).'"/>
		<![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="'.base_url("admin-assets/js/html5shiv.js").'"></script>
		<script src="'.base_url("admin-assets/js/respond.js").'"></script>
		<![endif]-->
		
		
		';
		
	}
	
	public function getNavBar(){
		
		$nav = "";
		
			$nav .='
			
			<div id="navbar" class="navbar navbar-default">

			<div class="navbar-container" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-car"></i>
							'.$this->PageLoadingFtns->getConstants('site_title').'
						</small>
						<small>
						<a href="http://faiz.solutions" target="_BLANK" style="display:inline-block; margin-top:10px;font-size:15px; color:white;">(Powered By FAIZ SOLUTIONS)</a>
						</small>
					</a>
					

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>
				

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
					
						<!-- #section:basics/navbar.user_menu -->
						
						<li class="light-blue">';
						
						if($this->Functions->isRetailer() || $this->Functions->isFranchise()){
						
							$nav .= '
									<div class="infobox infobox-green infobox-small infobox-dark" style="position: relative; top: -6px;">
									<!-- #section:pages/dashboard.infobox.sparkline -->
									<div class="infobox-icon" style="left: 7px;font-size: 21px;position: relative;top: 2px;">
										<i class="fa fa-money" aria-hidden="true"></i>
									</div>
									
										
										<!-- /section:pages/dashboard.infobox.sparkline -->
										<div class="infobox-data">
											<div id="user_credit" class="infobox-content" style="position: relative;left: 0px;top:0;">
												'.number_format($this->Functions->getTopUp()).'Rs.
										</div>
									</div></div>
						</li>';}
										
							$nav .= '
						
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<i class="fa fa-user fa-2x fa-fw"></i>
								<span class="user-info">
									<small>Welcome,</small>
									'.$this->session->userdata('username').'
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li class="divider"></li>
								

								<li>
									<a href="'.base_url("/Logout").'">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
						

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>';
		
		// Navigation Bar For Super
		if($this->Functions->isSuper())
		{
			$nav .= '
				
				<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive">
			
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<a  class="btn btn-success" href="'.base_url("super/view-profile").'">
							<i class="ace-icon fa fa-user"></i>
						</a>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<a href="'.base_url("./Logout").'" title="Logout" class="btn btn-danger">
							<i class="ace-icon fa fa-sign-out"></i>
						</a>

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="">
						<a href="'.base_url('super/Home').'">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					
					<li class="">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-building"></i>
							<span class="menu-text"> Manage Franchises </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="'.base_url("super/Franchise/addFranchise").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Franchise
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="'.base_url("super/Franchise/viewFranchises").'">
									<i class="menu-icon fa fa-caret-right"></i>
									View Franchises
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> Manage Users </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="'.base_url("super/Users/addUser").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Add User
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="'.base_url("super/Users/viewUsers").'">
									<i class="menu-icon fa fa-caret-right"></i>
									View Users
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<li class="">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-car"></i>
							<span class="menu-text"> Manage Vehicles </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="'.base_url("super/Vehicles/addVehicle").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Vehicle
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="'.base_url("super/Vehicles/viewVehicles").'">
									<i class="menu-icon fa fa-caret-right"></i>
									View Vehicles
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					
					<li class="">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-road"></i>
							<span class="menu-text"> Manage Routes </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="'.base_url("super/Routes/addRoute").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Route
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="'.base_url("super/Routes/viewRoutes").'">
									<i class="menu-icon fa fa-caret-right"></i>
									View Routes
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					
					<li class="">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-calendar"></i>
							<span class="menu-text"> Manage Schedules </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="'.base_url("super/Schedules/addSchedule").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Schedule
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="'.base_url("super/Schedules/viewSchedules").'">
									<i class="menu-icon fa fa-caret-right"></i>
									View Schedules
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<li class="">
						<a href="'.base_url('/Tickets/viewTickets').'">
							<i class="menu-icon fa fa-ticket"></i>
							<span class="menu-text"> View Bookings </span>
						</a>

						<b class="arrow"></b>
					</li>
					
					
					<li class="">
						<a href="'.base_url('/super/Backups').'">
							<i class="menu-icon fa fa-hdd-o"></i>
							<span class="menu-text"> Backups </span>
						</a>

						<b class="arrow"></b>
					</li>
					
					<li class="">
						<a href="'.base_url('/Logout').'">
							<i class="menu-icon fa fa-sign-out"></i>
							<span class="menu-text"> Logout </span>
						</a>

						<b class="arrow"></b>
					</li>
					
				</ul><!-- /.nav-list -->
				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
			</div>

			<!-- /section:basics/sidebar -->
				
			';
			
		}
		
		// Navigation Bar For Franchise
			
			else if ($this->Functions->isFranchise()){
				
				$nav .= '
				
				<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive">
			
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<a  class="btn btn-success" href="'.base_url("super/view-profile").'">
							<i class="ace-icon fa fa-user"></i>
						</a>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<a href="'.base_url("./Logout").'" title="Logout" class="btn btn-danger">
							<i class="ace-icon fa fa-sign-out"></i>
						</a>

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="">
						<a href="'.base_url('super/Home').'">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					
					<li class="'.(($this->uri->segment(2) == "Users")?"active":"").'">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> Users </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="'.((current_url() == base_url("franchise/Users/addUser"))?"active":"").'">
								<a href="'.base_url("franchise/Users/addUser").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Add User
								</a>

								<b class="arrow"></b>
							</li>

							<li class="'.((current_url() == base_url("franchise/Users/viewUsers"))?"active":"").'">
								<a href="'.base_url("franchise/Users/viewUsers").'">
									<i class="menu-icon fa fa-caret-right"></i>
									View Users
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<li class="'.(($this->uri->segment(1) == "Tickets")?"active":"").'">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-ticket"></i>
							<span class="menu-text"> Tickets </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="'.((current_url() == base_url("/Tickets/bookTicket"))?"active":"").'">
								<a href="'.base_url("/Tickets/bookTicket").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Book Ticket
								</a>

								<b class="arrow"></b>
							</li>

							<li class="'.((current_url() == base_url("/Tickets/viewTickets"))?"active":"").'">
								<a href="'.base_url("/Tickets/viewTickets").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Sold Tickets
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<li class="'.(($this->uri->segment(2) == "Credits")?"active":"").'">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-money"></i>
							<span class="menu-text"> Credits </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="'.((current_url()	== base_url("franchise/Credits/topupHistory"))?"active":"").'">
								<a href="'.base_url("franchise/Credits/topupHistory").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Topup History
								</a>

								<b class="arrow"></b>
							</li>

							<li class="'.((current_url()	== base_url("franchise/Credits/grantHistory"))?"active":"").'">
								<a href="'.base_url("franchise/Credits/grantHistory").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Grant History
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<li class="">
						<a href="'.base_url('/Logout').'">
							<i class="menu-icon fa fa-sign-out"></i>
							<span class="menu-text"> Logout </span>
						</a>

						<b class="arrow"></b>
					</li>
					
				</ul><!-- /.nav-list -->
				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
			</div>

			<!-- /section:basics/sidebar -->
				
			';
			}
			else if ($this->Functions->isUser()){
				
				$nav .= '
				
				<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive">
			
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<a  class="btn btn-success" href="'.base_url("super/view-profile").'">
							<i class="ace-icon fa fa-user"></i>
						</a>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<a href="'.base_url("./Logout").'" title="Logout" class="btn btn-danger">
							<i class="ace-icon fa fa-sign-out"></i>
						</a>

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="">
						<a href="'.base_url('super/Home').'">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
				
					
					<li class="'.(($this->uri->segment(1) == "Tickets")?"active":"").'">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-ticket"></i>
							<span class="menu-text"> Tickets </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="'.((current_url() == base_url("/Tickets/bookTicket"))?"active":"").'">
								<a href="'.base_url("/Tickets/bookTicket").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Book Ticket
								</a>

								<b class="arrow"></b>
							</li>

							<li class="'.((current_url() == base_url("/Tickets/viewTickets"))?"active":"").'">
								<a href="'.base_url("/Tickets/viewTickets").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Sold Tickets
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					
					<li class="">
						<a href="'.base_url('/Logout').'">
							<i class="menu-icon fa fa-sign-out"></i>
							<span class="menu-text"> Logout </span>
						</a>

						<b class="arrow"></b>
					</li>
					
				</ul><!-- /.nav-list -->
				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
			</div>

			<!-- /section:basics/sidebar -->
				
			';
			}
			
			
			
			else if ($this->Functions->isRetailer()){
				
				$nav .= '
				
				<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive">
			
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<a  class="btn btn-success" href="'.base_url("super/view-profile").'">
							<i class="ace-icon fa fa-user"></i>
						</a>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<a href="'.base_url("./Logout").'" title="Logout" class="btn btn-danger">
							<i class="ace-icon fa fa-sign-out"></i>
						</a>

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="">
						<a href="'.base_url('super/Home').'">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
				
					
					<li class="'.(($this->uri->segment(1) == "Tickets")?"active":"").'">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-ticket"></i>
							<span class="menu-text"> Tickets </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="'.((current_url() == base_url("/Tickets/bookTicket"))?"active":"").'">
								<a href="'.base_url("/Tickets/bookTicket").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Book Ticket
								</a>

								<b class="arrow"></b>
							</li>

							<li class="'.((current_url() == base_url("/Tickets/viewTickets"))?"active":"").'">
								<a href="'.base_url("/Tickets/viewTickets").'">
									<i class="menu-icon fa fa-caret-right"></i>
									Sold Tickets
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<li class="">
						<a href="'.base_url('retailer/Credits/topupHistory').'">
							<i class="menu-icon fa fa-money"></i>
							<span class="menu-text"> Topup History </span>
						</a>

						<b class="arrow"></b>
					</li>
					
					<li class="">
						<a href="'.base_url('/Logout').'">
							<i class="menu-icon fa fa-sign-out"></i>
							<span class="menu-text"> Logout </span>
						</a>

						<b class="arrow"></b>
					</li>
					
				</ul><!-- /.nav-list -->
				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
			</div>

			<!-- /section:basics/sidebar -->
				
			';
			}
		
		
		
			return $nav;
	}
	
	public function getFooter(){
		
		return '
			
			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">'.$this->getConstants("site_title").'</span>
							Copyrights &copy; '.$this->getConstants("year").'
							 Powered & Marketed By <a target="_BLANK" href="http://faiz.solutions">FAIZ SOLUTIONS</a>
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">

							<a href="https://www.facebook.com/Faiz.Solutions/" target="_BLANK">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>
						</span>
					</div>

					<!-- /section:basics/footer -->

		
		';
		
	}
	
	public function getFootScripts(){
		
		
		return '
		
		<script src="'.base_url("admin-assets/js/jquery.js").'"></script>
		<script src="'.base_url("admin-assets/js/bootstrap.js").'"></script>

		<!-- ace scripts -->
		<script src="'.base_url("admin-assets/js/ace/elements.wizard.js").'"></script>
		<script src="'.base_url("admin-assets/js/ace/ace.js").'"></script>
		<script src="'.base_url("admin-assets/js/ace/ace.sidebar.js").'"></script>
		<script src="'.base_url("admin-assets/js/jquery-ui.custom.js").'"></script>
		<script src="'.base_url("admin-assets/js/jquery.gritter.js").'"></script>
		<script src="'.base_url("admin-assets/js/date-time/bootstrap-datepicker.js").'"></script>
		<script>$(".date-picker").datepicker({
					autoclose: true,
					todayHighlight: true
				})
		</script>

	
		';
	}
	
	public static function getConstants($name){
		
		switch($name){
			
			case 'site_title':
				return "TRAVEL";
			break;
			
			case 'version':
				return "1.0";
			break;
			
			case 'company_name':
				return "ABFA GROUP";
			break;
			
			case 'year':
				return "2017-2018ss";
			break;
			
			default: return "CONSTANT NOT FOUND";
		}
	}
}

?>