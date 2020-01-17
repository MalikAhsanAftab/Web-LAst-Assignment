<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedules extends CI_Controller {
	
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
	
	public function addSchedule(){
		
		if($_POST){
			
			$query = $this->db->select('schedule_id')->from('schedules')->where('vehicle_id',$_POST['vehicle_id'])->where('route_id',$_POST['route_id'])->where('schedule_time',$_POST['time'])->get();
			
			if(!($query->num_rows()))
			{
				$dataArray = array(
							
							'route_id' => $_POST['route_id'],
							'vehicle_id' => $_POST['vehicle_id'],
							'days' => implode(",",$_POST['days']),
							'schedule_time' => $_POST['time']
							);
							
				if($this->db->insert('schedules',$dataArray)){
			
					$this->session->set_flashdata('msg',$this->Functions->msg('Schedule Added Successfully.','success'));
				}
				else 
				{
					$this->session->set_flashdata('msg',$this->Functions->msg('Cannot Add Schedule, System encountered an unexpected error.','error'));
				}

				
			}
			else
			{
				$this->session->set_flashdata('msg',$this->Functions->msg('This Schedule Already Exists.','warning'));
			}
			
		redirect('super/Schedules/addSchedule');
					
		}
		
		else{
			
			$this->load->view('super/add-schedule');
		}
	}
	
	public function viewSchedules(){
		
		$this->load->view('super/view-schedules.php');
	}
}
