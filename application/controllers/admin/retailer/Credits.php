<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credits extends CI_Controller {
	
	function __construct(){
		
		parent :: __construct();
		
		$this->load->model('Functions');
		$this->load->model('PageLoadingFtns');
		
		if(!($this->Functions->isLoggedIn()) || !($this->Functions->isRetailer()))
		{	
			redirect('Login');
		}
	}
	
	public function index()
	{		
		if(!($this->Functions->isLoggedIn()) || !($this->Functions->isRetailer()))
		{	
			redirect('Login');
		}
		
	}
	
	public function topupHistory(){
		
		$this->load->view('retailer/topup-history');
	}
	
}
