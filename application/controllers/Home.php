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
		$this->form_validation->set_rules('kotaasalrajaongkir', 'Kabupaten/Kota Asal', 'trim|required');
		$this->form_validation->set_rules('kotatujuanrajaongkir', 'Kabupaten/Kota Tujuan', 'trim|required');
		$this->form_validation->set_rules('beratkirim', 'Berat Pengiriman', 'trim|required|numeric');

		
		if ($this->form_validation->run() == FALSE) {
			# code...
			$this->load->view('index');
		} else {
			# code...
			$berat = $this->input->post('beratkirim');
			$beratkirim = $berat * 1000;
			if($beratkirim > 30000) {
				$this->session->set_flashdata('pesan', 'berat maksimal 30 kg');
				redirect('home');
			} else {
				$datarajaongkir = json_decode(file_get_contents($this->kabupatenrajaongkir));

				$kotaasal = $this->input->post('kotaasalrajaongkir');
				$kabnamakabupatendarikotaasal = str_replace('KAB. ', '', $kotaasal);
				$kotapisahkabupaten = str_replace('KOTA ', '', $kabnamakabupatendarikotaasal);
				$kabupatenbaruasal = ucwords(strtolower($kotapisahkabupaten));
				
				$kotatujuan = $this->input->post('kotatujuanrajaongkir');
				$kabnamakabupatendarikotatujuan = str_replace('KAB. ', '', $kotatujuan);
				$kotapisahkabupatentujuan = str_replace('KOTA ', '', $kabnamakabupatendarikotatujuan);
				$kabupatenbarutujuan = ucwords(strtolower($kotapisahkabupatentujuan));

				$semuakabupatenrajaongkir =$datarajaongkir->rajaongkir->results;

				foreach($semuakabupatenrajaongkir as $row){
					if($kabupatenbaruasal == $row->city_name){
						$origin = $row->city_id;
					}
					if($kabupatenbarutujuan == $row->city_name){
						$destination = $row->city_id;
					}
				}
				if ($origin == null || $destination == null) {
					$this->session->set_flashdata('pesan', 'kabupaten tidak ada');
					redirect('home');
				}
				var_dump($origin, $destination);
				die;
			}
		}
		
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
			echo "<pre>";
			print_r($row->city_name);
			echo "</pre>";
		}
		
		die;
	}
	public function getDataKabupatenDB()
	{
		$semuakabupaten = $this->db->get('m_kabupaten')->result_array();
		foreach($semuakabupaten as $kabupaten){
			$namakabupaten = $kabupaten['name'];
			$pisahkabnamakabupaten = str_replace('KAB. ', '', $namakabupaten);
			$pisahkotapisahkabupaten = str_replace('KOTA ', '', $pisahkabnamakabupaten);
			$namakabupatenbaru = ucwords(strtolower($pisahkotapisahkabupaten));
			echo "<pre>";
			print_r($namakabupatenbaru);
			echo "</pre>";
		}
		die;
	}
}