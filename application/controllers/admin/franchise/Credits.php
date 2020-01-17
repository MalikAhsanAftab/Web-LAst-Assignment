<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credits extends CI_Controller {
	
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
	
	public function topupHistory(){
		
		$this->load->view('franchise/topup-history');
	}
	
	public function grantHistory(){
			
			$this->load->view('franchise/grant-history');
	
	}
	
	public function grantCredit(){
		
		if($_POST){

			
			$topupWithComission = $this->Functions->calculateAmountWithComission($_POST['amount'],$this->Functions->getUserComission($_POST['user']));
			
			if($topupWithComission <= $this->Functions->getTopUp()){
			
				$oldCredit = $this->db->select('topup')->from('users')->where('user_id',$_POST['user'])->get()->row();
				
				$newCredit = $oldCredit->topup + $topupWithComission;
				
				$mainNewCredit = $this->Functions->getTopUp() - $topupWithComission; // Deduct Credit From Franchise Who has assigned credit
			
				if($this->db->update('users',array('topup' => $newCredit),"user_id = ".$_POST['user']) && $this->db->update('users',array('topup' => $mainNewCredit),"user_id = ".$this->session->userdata('user_id'))){
					
					$transArray = array (
								
								'trans_from' => $this->session->userdata('user_id'),
								'trans_to'   => $_POST['user'],
								'franchise_id' => $this->session->userdata('franchise_id'),
								'previous_balance' => $oldCredit->topup,
								'trans_amount'  => $topupWithComission,
								'trans_type' => 'GRANT',
								'remarks'  =>  $_POST['remarks']
				
								);
								
					$this->db->insert('transactions',$transArray);	
				
					$this->session->set_flashdata('msg',$this->Functions->msg('Credit Granted Successfully, For Details Check The Table Below','success'));
				}
				else // Throw Error For Not Inserting Data
				{
					$this->session->set_flashdata('msg',$this->Functions->msg('System Error While Granting Credit','error'));
				}
			}	
			else // Throw Error If Assigned Amount Exceeds Current Credit Limit
			{
				$this->session->set_flashdata('msg',$this->Functions->msg('Granted Credit Exceeds Current Credit Limit','warning'));
			}
			
			redirect('franchise/Credits/grantHistory');
		}
		else
		{
			
		}
	}
	
}
