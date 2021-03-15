<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
		$this->keyrajaongkir = '521bb93421967c1103c9470cb76ec77e';
		$this->kabupatenrajaongkir = 'https://api.rajaongkir.com/starter/city?key='.$this->keyrajaongkir;
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

	public function getDataKabupatenRajaOngkir()
	{
		$kabupaten = json_decode(file_get_contents($this->kabupatenrajaongkir));
		$semuadatakabupaten = $kabupaten->rajaongkir->results;
		foreach($semuadatakabupaten as $row){
			var_dump($row->city_name);

		}
		
		die;
	}
}