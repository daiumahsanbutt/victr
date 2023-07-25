<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RouterController extends CI_Controller {

	public function index(){
		$this->load->model('RouterModal');
		$data = array(
			"page_data" => array(
				"settings" => json_encode($this->RouterModal->index()),  
			),
			"script_file" => "dashboard"
		);
		$this->basic_functions->render('dashboard', "Dashboard", $data);
	}
	public function page_not_found(){
		$data = array(
			"page_data" => array(
				
			),
			"script_file" => ""
		);
		$this->basic_functions->render('page_not_found', "Page Not Found", $data);
	}
	public function getProjects(){
		$this->load->model('RouterModal');
		$data = json_encode($this->RouterModal->getProjects());
		echo $data;
		return;
	}
	public function syncProjects(){
		$this->load->model('RouterModal');
		$data = json_encode($this->RouterModal->syncProjects());
		echo $data;
		return;
	}
}
