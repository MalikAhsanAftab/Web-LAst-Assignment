<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
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
	
	public function addUser(){
		
		$this->load->view('super/add-user');
		
		if($_POST){
				
			$franchise_id = ($_POST['role'] == 'super')?0:$_POST['franchise_id'];
			$topupWithComission = $this->Functions->calculateAmountWithComission($_POST['topup'],$_POST['comission']);
			
			$dataArray = array(
						
							'franchise_id' => $franchise_id,
							'full_name' => $_POST['name'],
							'username' => $_POST['username'],
							'password' => SHA1(md5($_POST['password'])),
							'user_role' => $_POST['role'],
							'email' => $_POST['email'],
							'contact' => $_POST['contact'],
							'cnic' => $_POST['cnic'],
							'topup' => $topupWithComission,
							'comission' => $_POST['comission'],
							'status' => 1
							);
		
		$userInsert = $this->db->insert('users',$dataArray);					
		
		if($userInsert){
			
			// Insert Record History In Transactions 
			$transArray = array (
							
							'trans_from' => $this->session->userdata('user_id'),
							'trans_to'   => $this->db->insert_id(),
							'franchise_id' => $franchise_id,
							'previous_balance' => 0,
							'trans_amount'  => $topupWithComission,
							'trans_type' => 'TOPUP',
							'remarks' => 'Initial Credit Granted'
			
							);
							
			$this->db->insert('transactions',$transArray);	
			
			// Print Mail Message
			$mailMsg = "Hello ".$_POST['name'].", \n\nWelcome To Explore Cab, Please Find Your Login Credentials Below\n\nLogin Link : https://explore.cab/partner \nUser ID : ".$_POST['username']."\nPassword: ".$_POST['password']."\nRegistered Email: ".$_POST['email']."\nCnic: ".$_POST['cnic']."\nYour Comission: ".$_POST['comission']."%\nTopup: ".$topupWithComission." rs.\n\nThanks for joining us.";
			$mailErrorMsg = "";
			if(!$this->Functions->sendEmail($_POST['email'],"User Registration Credentials",$mailMsg)){
				$mailErrorMsg = ", But Unfortunately Cannot Send E-Mail To User Email.";
			}
			
			// Print Final Message
			$this->session->set_flashdata('msg',$this->Functions->msg('User Added Successfully'.$mailErrorMsg,'success'));
			redirect('super/Users/addUser');
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
				
				redirect('super/Users/addUser');
			}
			
				
		}
	}
	
	public function viewUsers(){
		
		$this->load->view('super/view-users');
	}
	
	public function editUser($id){
		
		if(!isset($id)){
			
			redirect('super/Users/viewUsers');
		}
	}
	
	function updateTopup($id=""){
		
		if($_POST){
				
				$uTopup = $this->db->select(array('topup','franchise_id','comission'))->from('users')->where('user_id',$id)->get()->row();
				
				$newUserTopup = $uTopup->topup + $this->Functions->calculateAmountWithComission($_POST['topupAmount'],$uTopup->comission);
				
				if($this->db->update('users',array('topup' => $newUserTopup),"user_id=".$id)){
					
					$transArray = array (
								
								'trans_from' => $this->session->userdata('user_id'),
								'trans_to'   => $id,
								'franchise_id' => $uTopup->franchise_id,
								'previous_balance' => $uTopup->topup,
								'trans_amount'  => $this->Functions->calculateAmountWithComission($_POST['topupAmount'],$uTopup->comission),
								'trans_type' => 'TOPUP',
								'remarks'  => $_POST['remarks']
				
								);
								
					$this->db->insert('transactions',$transArray);	
					
					$this->session->set_flashdata('msg',$this->Functions->msg('Topup Granted','success'));
				}
				else
				{
					$this->session->set_flashdata('msg',$this->Functions->msg('System Error','error'));
				}
				
				redirect('super/Users/viewUsers');
			}
			
		else
		{
			$this->load->view('super/update-topup');
		}	

}
	
}
