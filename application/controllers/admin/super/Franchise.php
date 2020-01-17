<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Franchise extends CI_Controller {
	
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
	
	public function addFranchise(){
		
		$this->load->view('super/add-franchise');
		
		if($_POST){
			
			$dataArray = array(
							
							'fname' => $_POST['name'],
							'femail' => $_POST['email'],
							'flocation' => $_POST['location'],
							'faddress' => $_POST['address'],
							);
							
		if($this->db->insert('franchises',$dataArray)){
			
			$this->session->set_flashdata('msg',$this->Functions->msg('Franchise Added Successfully','success'));
			redirect('super/Franchise/addFranchise');
		}	
			
				
		}
	}
	
	public function viewFranchises(){
		
		$this->load->view('super/view-franchises');
	}
}
