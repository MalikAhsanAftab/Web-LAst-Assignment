<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	function __construct(){
		
		parent :: __construct();
		
		$this->load->model('Functions');
		$this->load->model('PageLoadingFtns');
		
		if(!($this->Functions->isLoggedIn()) || !($this->Functions->isFranchise()))
		{	
			redirect('Login');
		}
	}
	
	public function index()
	{		
		if(!($this->Functions->isLoggedIn()) || !($this->Functions->isFranchise()))
		{	
			redirect('Login');
		}
		
	}
	
	public function addUser(){
		
		$this->load->view('franchise/add-user');
		
		if($_POST){
			
			$topupWithComission = 0;
			$com = 0;
			
			if($_POST['topup'] < $this->Functions->getTopUp()){
				
			if($_POST['role'] == "retailer"){
				
				// Calculate Amount Adding Comission
				$topupWithComission = $this->Functions->calculateAmountWithComission($_POST['topup'],$_POST['comission']);
				
				//Set Comission
				$com = $_POST['comission'];
				
				// Deduct Credit From Franchise Account
				$newTopup = ($this->Functions->getTopUp()) - $topupWithComission;
				$replaceData = array('topup' => $newTopup);
				$this->db->update('users',$replaceData,"user_id=".$this->session->userdata('user_id'));
			
			}
				

			$dataArray = array(
							
							'franchise_id' => $this->session->userdata('franchise_id'),
							'full_name' => $_POST['name'],
							'shop_name' => $_POST['shop_name'],
							'shop_address' => $_POST['shop_address'],
							'username' => $_POST['username'],
							'password' => SHA1(md5($_POST['password'])),
							'user_role' => $_POST['role'],
							'email' => $_POST['email'],
							'contact' => $_POST['contact'],
							'cnic' => $_POST['cnic'],
							'topup' => $topupWithComission,
							'comission' => $com,
							'status' => 1
							);
							
		
							
		$userSql = 	$this->db->insert('users',$dataArray);
			
		if($userSql){
			
				if($_POST['role'] == "retailer"){
					
					// Insert Transaction History
				$transArray = array(
				
							
							'trans_from' => $this->session->userdata('user_id'),
							'trans_to'   => $this->db->insert_id(),
							'franchise_id' => $this->session->userdata('franchise_id'),
							'previous_balance' => 0,
							'trans_amount' => $topupWithComission,
							'trans_type' => 'GRANT',
							'remarks' => 'Initial Retailer Credit Granted'
					
						);
				
								
				$this->db->insert('transactions',$transArray);	
				}
				
				$mailMsg = "Hello ".$_POST['name'].", \n\nWelcome To Explore Cab, Please Find Your Login Credentials Below\n\nLogin Link : https://explore.cab/partner \nUser ID : ".$_POST['username']."\nPassword: ".$_POST['password']."\nRegistered Email: ".$_POST['email']."\nCnic: ".$_POST['cnic'];
				if($_POST['role'] == "retailer"){
					$mailMsg .="\nYour Comission: ".$_POST['comission']."%";
				}
				$mailMsg .="\nTopup: ".$topupWithComission." rs.\n\nThanks for joining us.";
				
				$mailErrorMsg = "";
				if(!$this->Functions->sendEmail($_POST['email'],"User Registration Credentials",$mailMsg)){
					$mailErrorMsg = ", But Unfortunately Cannot Send E-Mail To User's Email.";
				}
								
				$this->session->set_flashdata('msg',$this->Functions->msg('User Added Successfully'.$mailErrorMsg,'success'));
			}
			else
			{
				$error =  $this->db->error();
	
				if($error['code']== 1062) // Check Duplicate
				{
					$this->session->set_flashdata('msg',$this->Functions->msg('User "'.$_POST['username'].'" OR Email "'.$_POST['email'].'" Already Exists In Database','warning'));
				} 
				else // Show DB Error
 				{
					$this->session->set_flashdata('msg',$this->Functions->msg('Cannot Add User','error'));
				}
				
				redirect('franchise/Users/addUser');
			}
		}
		else
		{
			$this->session->set_flashdata('msg',$this->Functions->msg('Assigned Topup exceeds your current topup limit.','error'));
		}
			
			
			redirect('franchise/Users/addUser');
			
				
		}
	}
	
	public function viewUsers(){
		
		$this->load->view('franchise/view-users');
	}
	
	public function trash(){
		
		$data['trash'] = "trash";
		$this->load->view('franchise/view-users',$data);
	}
	
	public function editUser($id){
		
		if(!isset($id)){
			
			redirect('franchise/Users/viewUsers');
		}
		else
		{
			if($_POST)
			{
				$dataArray = array(				
							'full_name' => $_POST['name'],
							'password' => SHA1(md5($_POST['password'])),
							'email' => $_POST['email'],
							'contact' => $_POST['contact'],
							'cnic' => $_POST['cnic'],
							'shop_name' => $_POST['shop_name'],
							'shop_address' => $_POST['shop_address'],
							'comission' => $_POST['comission']
							);
							
				$logoutMsg = ", Use NEW PASSWORD to login next time !";			
							
				if(empty($_POST['password']))
				{
					$dataArray = array(				
							'full_name' => $_POST['name'],
							'email' => $_POST['email'],
							'contact' => $_POST['contact'],
							'cnic' => $_POST['cnic'],
							'shop_name' => $_POST['shop_name'],
							'shop_address' => $_POST['shop_address'],
							'comission' => $_POST['comission']
							);
						
					$logoutMsg = "";	
				}
				
							
			if($this->db->update('users',$dataArray,'user_id='.$id)){
			
			$this->session->set_flashdata('msg',$this->Functions->msg('User Updated Successfully'.$logoutMsg,'success'));
			redirect('franchise/Users/editUser/'.$id);
			}	
			else
			{	
				$this->session->set_flashdata('msg',$this->Functions->msg('While Updating User','error'));
				redirect('franchise/Users/editUser/'.$id);
				
			}			
							
			}
			else
			{
				
				$data['user'] = $this->db->select('*')->from('users')->where('user_id',$id)->get()->row();
				$this->load->view('franchise/edit-user',$data);
			}	
		}
	}
	
	public function delUser($id){
	
		if($this->db->update('users', array('status' => '-1'),"user_id = ".$id)){
			$this->session->set_flashdata('msg',$this->Functions->msg('User Trashed Successfully <a class="btn btn-primary" href="'.base_url('franchise/Users/trash').'">View Trash <i class="fa fa-trash fa-fw"></i></a>','success'));
			redirect('franchise/Users/viewUsers');
		}
		
		
	}
	
	public function restoreUser($id){
		
		if($this->db->update('users', array('status' => '1'),"user_id = ".$id)){
			$this->session->set_flashdata('msg',$this->Functions->msg('User Restored Successfully','success'));
			redirect('franchise/Users/viewUsers');
		}
		else
		{
			$this->session->set_flashdata('msg',$this->Functions->msg('Cannot Restore User','error'));
			redirect('franchise/Users/viewUsers');
		}
	}
	
	function updateTopup($id=""){
		
		if($_POST){
			
			$topupWithComission = $_POST['topupAmount'] + $this->Functions->calculateComission($_POST['topupAmount']);
			
			if ($topupWithComission <= $this->Functions->getTopUp())
			{
				
				$newMainTopup = $this->Functions->getTopUp() - $topupWithComission;
				
				$uTopup = $this->db->select('topup')->from('users')->where('user_id',$id)->get()->row();
				
				$newUserTopup = $uTopup->topup + $topupWithComission;
				
				if($this->db->update('users',array('topup' => $newMainTopup),"user_id=".$this->session->userdata('user_id')) && $this->db->update('users',array('topup' => $newUserTopup),"user_id=".$id)){
					
					// Insert Record For Transaction
					$transArray = array(
				
							
							'trans_from' => $this->session->userdata('user_id'),
							'trans_to'   => $id,
							'franchise_id' => $this->session->userdata('franchise_id'),
							'previous_balance' => 0,
							'trans_amount' => $topupWithComission,
							'trans_type' => 'GRANT',
							'remarks' => 'Topup Granted'
					
						);
				$this->db->insert('transactions',$transArray);	
					
				// Print Final Message	
				$this->session->set_flashdata('msg',$this->Functions->msg('Topup Granted','success'));
				}
				else
				{
					$this->session->set_flashdata('msg',$this->Functions->msg('System Error','error'));
				}
			}
			else
			{
				$this->session->set_flashdata('msg',$this->Functions->msg('Topup Amount Exceeds Current Balance','warning'));
			}
			
			redirect('franchise/Users/updateTopup');
		}
		else
		{
			$this->load->view('franchise/update-topup');
		}
		
		
	}
	
}
