<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Midtrans extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Midtrans_model');
		
	}
	
	public function index()
	{
		$data = [
			'semuaproduk' => $this->Midtrans_model->getallproduct(),
			'datacart' => $this->Midtrans_model->getallkeranjang()
		];
		$this->load->view('midtrans/index', $data);
		
	}

	public function simpan()
	{
		$produk = $this->input->post('produk');
		$jumlah = $this->input->post('jumlah');

		$datainsert = [
			'produk_id' => $produk,
			'jumlah' => $jumlah,
			'status' => 0,
		];
		$datainsert = $this->Midtrans_model->insert($datainsert);
		if($datainsert > 0) {
			$this->session->set_flashdata('pesan', 'data berhasil disimpan');
		}else{
			$this->session->set_flashdata('pesan', 'server sedang sibuk, silahkan coba kembali');
		}
		redirect('midtrans');
	}
}