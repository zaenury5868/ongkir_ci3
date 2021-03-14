<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');	
	}
	

	public function index()
	{
		$this->load->view('index');
	}

	public function getDataKabupaten()
	{
		$kabupaten = $this->input->get('term');
		if($kabupaten){
			$getDataKabupaten = $this->Home_model->getDataKabupaten($kabupaten);
			// var_dump($getDataKabupaten);
			// die;
			foreach ($getDataKabupaten as $row) {
				$results[] = array(
					'label' =>$row['provinsi'].','.$row['kabupaten'].', kecamatan '. $row['kecamatan'],
					'kabupaten' => $row['kabupaten']
				);
				
				$this->output->set_content_type('application/json')->set_output(json_encode($results));
				
			}
		}
	}
}