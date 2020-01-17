<?php
ob_start();
class Logout extends CI_CONTROLLER{
	
	public function index(){
		
		$sessionData = array(
                   'username',
				   'user_id',
				   'user_role',
				   'franchise_id',
				   'logged_in' );
		
		$this->session->unset_userdata($sessionData);
		redirect('Login');
	}
}
    
?>	 