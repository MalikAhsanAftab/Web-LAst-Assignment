<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	
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
		echo $this->Functions->backupUsingQuery("SELECT * FROM franchises");
	}
	
}
