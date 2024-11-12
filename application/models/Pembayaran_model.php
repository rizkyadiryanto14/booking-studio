<?php

/**
 * @property $db
 */

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


	/**
	 * @return void
	 */
	public function make_query(): void
	{
		$this->db->select('laporan_pembayaran.*, pemesanan.*')
			->from('laporan_pembayaran')
			->join('pemesanan', 'pemesanan.id_pemesanan = laporan_pembayaran.id_pemesanan', 'left');

		$search_value = $_POST['search']['value'] ?? null;

		if (!empty($search_value)) {
			$this->db->group_start()
				->like('nama_pengguna', $search_value)
				->or_like('transaction_status', $search_value)
				->group_end();
		}

		$order_column = $_POST['order'][0]['column'] ?? null;
		$order_dir = $_POST['order'][0]['dir'] ?? 'DESC';

		if (!empty($order_column)) {
			$this->db->order_by($order_column, $order_dir);
		} else {
			$this->db->order_by('id_pembayaran', 'DESC');
		}
	}

	public function make_datatables()
	{
		$this->make_query();

		$length = $_POST['length'] ?? -1;
		$start = $_POST['start'] ?? 0;

		if ($length != -1) {
			$this->db->limit($length, $start);
		}

		$query = $this->db->get();

		if ($query === false) {
			log_message('error', 'Query failed: ' . $this->db->last_query());
			return false;
		}

		return $query->result();
	}

	public function get_filtered_data()
	{
		$this->make_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_all_data()
	{
		return $this->db->count_all('laporan_pembayaran');
	}

	public function get_laporan_listing_pemesanan()
	{
		$this->db->select('*');
		$this->db->from('laporan_pembayaran');
		$this->db->join('pemesanan', 'pemesanan.id_pemesanan = laporan_pembayaran.id_pemesanan', 'left');
		return $this->db->get()->result();
	}
}
