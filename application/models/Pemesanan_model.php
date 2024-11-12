<?php

/**
 * @property $db
 */

class Pemesanan_model extends CI_Model
{
	public function get_pemesanan_by_user($id_pengguna)
	{
		$this->db->select('p.id_pemesanan, p.id_studio, p.tanggal_pemesanan, p.waktu_pemesanan, p.total_harga, p.status_pembayaran, s.nama as nama_studio');
		$this->db->from('pemesanan p');
		$this->db->join('studio s', 'p.id_studio = s.id_studio', 'left');
		$this->db->where('p.id_pengguna', $id_pengguna);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get_all_pemesanan()
	{
		$this->db->select('p.id_pemesanan, p.id_studio, p.id_pengguna, p.tanggal_pemesanan, p.waktu_pemesanan, p.total_harga, p.status_pembayaran, s.nama as nama_studio, u.nama as nama_pengguna');
		$this->db->from('pemesanan p');
		$this->db->join('studio s', 'p.id_studio = s.id_studio', 'left');
		$this->db->join('users u', 'p.id_pengguna = u.id_pengguna', 'left');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function update_status_pembayaran($id_pemesanan, $status)
	{
		$this->db->where('id_pemesanan', $id_pemesanan);
		return $this->db->update('pemesanan', ['status_pembayaran' => $status]);
	}

	/**
	 * @author Rizky Adi Ryanto
	 * @link github.com/rizkyadiryanto14
	 * Model untuk laporan pemesanan
	 */

	public function get_all_laporan_pemesanan()
	{
		return $this->db->get('laporan_pemesanan')->result();
	}

	/**
	 * @return void
	 */
	public function make_query(): void
	{
		$this->db->select('laporan_pemesanan.*')
			->from('laporan_pemesanan');

		$search_value = $_POST['search']['value'] ?? null;

		if (!empty($search_value)) {
			$this->db->group_start()
				->like('nama_pengguna', $search_value)
				->or_like('nama_studio', $search_value)
				->group_end();
		}

		$order_column = $_POST['order'][0]['column'] ?? null;
		$order_dir = $_POST['order'][0]['dir'] ?? 'DESC';

		if (!empty($order_column)) {
			$this->db->order_by($order_column, $order_dir);
		} else {
			$this->db->order_by('id_pemesanan', 'DESC');
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
		return $this->db->count_all('laporan_pemesanan');
	}
}
