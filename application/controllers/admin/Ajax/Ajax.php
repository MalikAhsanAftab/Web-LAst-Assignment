<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
	function __construct(){
		
		parent :: __construct();
		
		$this->load->model('Functions');
	}
	
	public function index()
	{	
		if($_POST){
			
		switch($_POST['action']){
			
		case 'fetchCountries':
		
		$keyword = trim($_POST['keyword']);
		
		$data = "";
		
		if(!empty($keyword)){
			
			$records = array();
			
			$query = $this->db->select("*")->from("countries")->where("country_code",trim($_POST['keyword']));
			
			$recCount = $query->get()->num_rows();
			
			if($recCount > 0){
				
				$countryList = $this->db->select("*")->from("countries")->where("country_code",trim($_POST['keyword']))->get()->result_array();
				
				foreach($countryList as $c){
					
					$data .= "<option value='".$c['country_code']."'>".$c['country_name']."</option>";
				}
				
				echo $data;
			}
			else
			{
				$nameQuery = $this->db->select("*")->from("countries")->where("country_name LIKE '%".trim($_POST['keyword'])."%'")->get()->result_array();
				
				foreach($nameQuery as $n){
					
					$data .= "<option value='".$n['country_code']."'>".$n['country_name']."</option>";
				}
				
				echo $data;
			}
				
				
				
			}
			
		break;
	
	default : echo "Wrong Parameter To Fetch Data";
		
	}
	}
	else
	{
		echo "Direct Script Access Not Allowed To This Page ( Security Error !)";
	}
}	
	
}
