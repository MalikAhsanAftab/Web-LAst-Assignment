<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backups extends CI_Controller {
	
	function __construct(){
		
		parent :: __construct();
		
		$this->load->model('Functions');
		$this->load->model('PageLoadingFtns');
		
		if(!($this->Functions->isLoggedIn()) && !$this->Functions->isSuper())
		{	
			redirect('Login');
		}
	}
	
	public function index()
	{	
		if(!$_POST)
		{
			$this->load->view('super/backups');
		}
		else
		{
			$download = (isset($_POST['download']))?1:0;
			
			if($_POST['toBackup'] == "all"){
				
				if($this->Functions->backupWholeDb($download))
					$this->session->set_flashdata('msg',$this->Functions->msg('Backup Success','success'));
				else
					$this->session->set_flashdata('msg',$this->Functions->msg('Backup Error','error'));
			}
			else
			{
				if($this->Functions->backupUsingQuery("SELECT * FROM ".$_POST['toBackup'],$download))
					$this->session->set_flashdata('msg',$this->Functions->msg('Backup Success','success'));
				else
					$this->session->set_flashdata('msg',$this->Functions->msg('Backup Error','error'));
			}
			
			redirect("./super/Backups");
		}
	}
	
}
