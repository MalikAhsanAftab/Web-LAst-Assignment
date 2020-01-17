<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct(){
		
		parent :: __construct();
		
		$this->load->model('Functions');
		$this->load->model('AdminPageLoadingFtns');
		
	}
	
	public function index()
	{

		if(!($this->Functions->isLoggedIn())){
		
			if($_POST)
			{
				
				$data['result'] = $this->Functions->verifyLogin($_POST['username'],$_POST['password']);
				
				if($data['result']) // If Login Details Are Valid
				{
					if($data['result'][0]['status']) // If User Is Active
					{
						$sessionData = array(
						   'username'  => $data['result'][0]['username'],
						   'user_id'  => $data['result'][0]['user_id'],
						   'user_role'  => $data['result'][0]['user_role'],
						   'franchise_id' => $data['result'][0]['franchise_id'],
						   'logged_in' => TRUE
					   );

						$this->session->set_userdata($sessionData);
						redirect($data['result'][0]['user_role'].'/Home');
					}
					else // Else Show Warning Of Not Active User
					{
						$this->session->set_flashdata('msg',$this->Functions->msg('Your Account Is Not Active Yet, Please Contact Your Administrator','warning'));
						redirect('Login');
					}
				}
				else // Else Show Error For Invalid Login
					{
						$this->session->set_flashdata('msg',$this->Functions->msg('Invalid Login Credentials','error'));
						redirect('Login');
					}
			}
			else
			{
				
				$this->load->view('admin/Login');
			}
		
			}		
			else 
			{
				redirect($this->session->userdata('user_role').'/Home');
			}

		
	}
	
	public function forgotPassword(){
		
		if($_POST){
			
			$query = $this->db->select('user_id')->from('users')->where('email',$_POST['email'])->get();
			
			if($query->num_rows()){
				
				$mailMsg = "Hello, \n\nDear User please click the link below to reset your password,\n\n";
				$mailMsg.= base_url('Login/resetPassword?email='.$_POST['email'].'&hash='.SHA1(md5(SHA1(base64_encode($_POST['email'])."Explor3C@b".date('d')))));
				$mailMsg .= "\n\n--> Note: Please Note that this Link is valid only for today.";
				
				if($this->Functions->sendEmail($_POST['email'],"Forgot Password",$mailMsg)){
					$this->session->set_flashdata('msg',$this->Functions->msg('Password Reset Link Has Been Sent To Your Email, Please Follow Instructions in email. <b>(It Can Take Upto 5-10 Minutes To Get Email)</b>','success'));
				}
				else
				{
					$this->session->set_flashdata('msg',$this->Functions->msg('Cannot Send Email, System Error','error'));
				}
			}	
			else
			{
				$this->session->set_flashdata('msg',$this->Functions->msg('This email address in not registered with us, please verify & type email that you entered at time of registration.','warning'));
			}
			
			redirect('Login');
			
		}
		else
		{
			redirect('Login');
		}
	}
	
	function resetPassword(){
		
		
		if($_GET){
						
			$oldHash = $_GET['hash'];
			$newHash = SHA1(md5(SHA1(base64_encode($_GET['email'])."Explor3C@b".date('d'))));
			
			if($oldHash == $newHash)
			{
				$data['email'] = $_GET['email'];
				$this->load->view('reset-password',$data);				
			}
			else
			{
				$this->session->set_flashdata('msg',$this->Functions->msg('Invalid Hash, May Be Its Expired','error'));
				redirect('Login');
			}
						
		}
		else if($_POST){
				
		
				if($this->db->update('users',array('password' => SHA1(md5($_POST['newPass']))),"email='".$_POST['email']."'"))
				{
					
					$this->session->set_flashdata('msg',$this->Functions->msg('Password has been reset','success'));
				}
				else
				{
					$this->session->set_flashdata('msg',$this->Functions->msg('Error Cannot Reset Password','error'));	
				}

			
			redirect('Login');
			
		}
	
		else
		{
			$this->session->set_flashdata('msg',$this->Functions->msg('Invalid Request','error'));
			redirect('Login');
		}
	}
}
?>
