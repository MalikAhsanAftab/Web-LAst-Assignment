<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function index()
	{
		$this->load->model('PageLoadingFtns');
		$this->load->model('Functions');
		
		if(!($this->Functions->isLoggedIn()) || !($this->Functions->isUser()))
		{	
			redirect('Login');
		}
		else
		{
			$this->load->view($this->session->userdata('user_role').'/Home');
		}
	}
}
