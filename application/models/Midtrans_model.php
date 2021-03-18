<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Midtrans_model extends CI_Model {

	public function getallproduct()
	{
		return $this->db->get('m_product')->result_array();
	}

	public function insert($data)
	{
		$this->db->insert('tr_cart', $data);
		return $this->db->affected_rows();
	}

	public function getallkeranjang()
	{
		$this->db->select('a.*,b.produk, b.harga');
		$this->db->join('m_product as b', 'a.produk_id=b.id');
		return $this->db->get_where('tr_cart as a', ['a.status' => 0])->result_array();
	}

	public function getalltransaction()
	{
		$this->db->order_by('id', 'DESC');
		return $this->db->get('tr_cart_to_checkout')->result_array();
		
	}

	public function update($dataupdate, $where)
	{
		$this->db->update('tr_cart_to_checkout', $dataupdate, $where);
		return $this->db->affected_rows();
	}

}

/* End of file ModelName.php */