<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicles extends CI_Controller {
	
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
	
	public function addVehicle(){
		
		$this->load->view('super/add-vehicle');
		
		if($_POST){
			
			$dataArray = array(
							
							'vehicle_no' => $_POST['vehicle_no'],
							'vehicle_type' => $_POST['vehicle_type'],
							'vehicle_class' => $_POST['vehicle_class'],
							'vehicle_make' => $_POST['vehicle_make'],
							'vehicle_model' => $_POST['vehicle_model'],
							'vehicle_color' => $_POST['vehicle_color'],
							'no_of_seats' => $_POST['no_of_seats']
							);
							
			$this->db->escape($dataArray);	
			
						
			if($this->db->insert('vehicles',$dataArray)){
				
				$this->session->set_flashdata('msg',$this->Functions->msg('Vehicle Added Successfully','success'));
			}
			else
			{
				$error =  $this->db->error();
	
				if($error['code']== 1062) // Check Duplicate
				{
					$this->session->set_flashdata('msg',$this->Functions->msg('Vehicle No "'.$_POST['vehicle_no'].'" Already Exists In Database','warning'));
				} 
				else // Show DB Error
 				{
					$this->session->set_flashdata('msg',$this->Functions->msg('Cannot Add Vehicle','error'));
				}
			}
			
			redirect('super/Vehicles/addVehicle');
			
		}
	}	
	
	public function viewVehicles(){
		
		$this->load->view('super/view-vehicles');
	}
	
	public function editVehicle($id){
		
		if(!isset($id)){
			
			redirect('super/Vehicles/viewVehicles');
		}
	}
	
}
