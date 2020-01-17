<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routes extends CI_Controller {
	
	function __construct(){
		
		parent :: __construct();
		
		$this->load->model('Functions');
		$this->load->model('PageLoadingFtns');
		
		if(!($this->Functions->isLoggedIn()) || !($this->Functions->isSuper()))
		{	
			redirect('Login');
		}
	}
	
	public function index()
	{	
		
		if(!($this->Functions->isLoggedIn()) || !($this->Functions->isSuper()))
		{	
			redirect('Login');
		}
	}
	
	public function addRoute(){
		
		$this->load->view('super/add-route');
		
		if($_POST){
			
			$dataArray = array(
							
							'departure' => $_POST['departure'],
							'arrival' => $_POST['arrival'],
							'duration' => $_POST['duration'],
							'fare' => $_POST['fare']
							);
							
		if($this->db->insert('routes',$dataArray)){
			
			$this->session->set_flashdata('msg',$this->Functions->msg('Route Added Successfully','success'));
			redirect('super/Routes/addRoute');
		}	
			
				
		}
	}
	
	public function viewRoutes(){
		
		$this->load->view('super/view-routes');
	}
}
