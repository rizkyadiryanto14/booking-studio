<?php

class Pembayaran_model extends CI_Model
{
	public function get_pemesanan_by_id($id_pemesanan)
	{
		$this->db->select('p.id_pemesanan, p.id_pengguna, p.id_studio, p.total_harga, s.nama as nama_studio');
		$this->db->from('pemesanan p');
		$this->db->join('studio s', 'p.id_studio = s.id_studio', 'left');
		$this->db->where('p.id_pemesanan', $id_pemesanan);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function update_status_pembayaran($id_pemesanan, $status)
	{
		$this->db->where('id_pemesanan', $id_pemesanan);
		return $this->db->update('pemesanan', ['status_pembayaran' => $status]);
	}

	public function update_pembayaran_status($order_id, $transaction_status)
	{
		$data_update = [
			'transaction_status' => $transaction_status,
			'status' => ($transaction_status == 'settlement') ? 'sukses' : 'pending'
		];

		$this->db->where('order_id', $order_id);
		return $this->db->update('pembayaran', $data_update);
	}

	public function insert_pembayaran($data_pembayaran)
	{
		return $this->db->insert('pembayaran', $data_pembayaran);
	}
}
