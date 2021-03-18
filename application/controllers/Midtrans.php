<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Midtrans extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Midtrans_model');
		$params = array('server_key' => 'SB-Mid-server-QmUxKFQm6POflDKMsPI-lpZz', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
	}
	
	public function index()
	{
		$data = [
			'semuaproduk' => $this->Midtrans_model->getallproduct(),
			'datacart' => $this->Midtrans_model->getallkeranjang(),
			'semuatransaksi' => $this->Midtrans_model->getalltransaction()
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

	public function cekstatus()
	{
		$orderid = $this->input->post('order_id');
		if($orderid) {
			$this->status($orderid);
		}else{
			echo 'order id tidak ada';
		}
	}
	private function status($orderid)
	{
		$result = $this->veritrans->status($orderid);
		$dataupdate = [
			'transaction_status' => $result->transaction_status,
			'date_modified' => time()
		];
		$where = [
			'order_id' => $orderid
		];
		$update = $this->Midtrans_model->update($dataupdate, $where);
		if($update > 0){
			$this->session->set_flashdata('messagetransaksi', 'data transaksi berhasil di update');
		}else{
			$this->session->set_flashdata('messagetransaksi', 'server sedang sibuk');
		}
		redirect('midtrans');
	}
}