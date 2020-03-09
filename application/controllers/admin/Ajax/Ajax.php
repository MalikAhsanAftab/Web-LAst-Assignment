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

			$qry = "airport_code";
			if(strlen($keyword) > 3)
			{
				$qry = "meta_city_title";
				$keyword = metaphone($keyword);
			}
			$airportList = $this->db->select("*")->from("opt_select_ap")->where($qry,$keyword)->limit(5)->get()->result_array();
			$recCount = $airportList ? count($airportList) : 0;

			if($recCount > 0){
				foreach($airportList as $c){
					$data .= "<option class=\"flag-icon flag-icon-".strtolower($c['country_code'])."\" value='".$c['airport_code']."'>".$c['airport_title']." , ".$c['city_title']." </option>";
				}

				echo $data;
			}
			else
			{
				$qry = "airport_code";
				if(strlen($keyword) > 3)
					{
						$qry = "meta_city_title";
						$keyword = metaphone($keyword);
					}
				$nameQuery = $this->db->select("*")->from("opt_select_ap")->where($qry." LIKE '%".$keyword."%'")->limit(5)->get()->result_array();
				foreach($nameQuery as $n){
					$data .= "<option class=\"flag-icon flag-icon-".strtolower($n['country_code'])."\" value='".$n['airport_code']."'>".$n['airport_title']." , ".$n['city_title']."</option>";
				}
				if(strlen($data) == 0)
					echo "No Data:".$qry." LIKE '%".trim($_POST['keyword'])."%'";
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
