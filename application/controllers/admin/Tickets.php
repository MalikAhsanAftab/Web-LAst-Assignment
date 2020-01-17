<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {
	
	function __construct(){
		
		parent :: __construct();
		
		$this->load->model('Functions');
		$this->load->model('PageLoadingFtns');
		
		if(!($this->Functions->isLoggedIn()) && (!($this->Functions->isFranchise()) || !($this->Functions->isUser())))
		{	
			redirect('Login');
		}
	}
	
	public function index()
	{	
		
		if(!($this->Functions->isLoggedIn()) && (!($this->Functions->isFranchise()) || !($this->Functions->isUser())))
		{	
			redirect('Login');
		}
	}
	
	public function bookTicket(){
		
			$this->load->view('book-ticket');
	}
	
	public function viewTickets(){
		
		if($_POST){
			
			$agentFilter = (!empty($_POST['agentFilter']))?$_POST['agentFilter']:0;
			$data['filters'] = array('dateFrom' => $_POST['from'], 'dateTo' => $_POST['to'], 'agentFilter' => $agentFilter);
			$this->load->view('view-tickets',$data);
			
		}
		else{
			$this->load->view('view-tickets');
		}
	}
	
	public function printTicket($id){
		
		if(isset($id)){
			
			$data['ticketDetails'] = $this->db->select('*')->from('tickets')->join('routes','routes.route_id = tickets.route_id')->join('vehicles','vehicles.vehicle_id = vehicles.vehicle_id')->where('ticket_id',$id)->get()->row();
			$this->load->view('printTicket',$data);
		}
		
		else{
			
			redirect('Tickets/viewTickets');
		}
	}
}
