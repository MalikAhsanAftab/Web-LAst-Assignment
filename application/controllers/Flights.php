<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flights extends CI_Controller {
	
	public function __construct(){
		
		parent :: __construct();
		
		$this->load->model('Functions');
		$this->load->model('PageLoadingFtns');
		
	}
	
	public function index()
	{
		echo show_404();
	}
	
	
	
}
?>
