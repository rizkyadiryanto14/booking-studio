<?php

class Jadwal_model extends CI_Model
{

	public function get()
	{
		$this->db->select('jadwal_studio.id_jadwal, 
                       jadwal_studio.tanggal_jadwal, 
                       jadwal_studio.waktu_mulai, 
                       jadwal_studio.waktu_selesai, 
                       jadwal_studio.status_ketersediaan, 
                       studio.id_studio, 
                       studio.nama AS nama_studio, 
                       studio.jenis_studio, 
                       studio.harga_per_jam, 
                       studio.foto_studio')
			->from('jadwal_studio')
			->join('studio', 'jadwal_studio.id_studio = studio.id_studio', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_jadwal_by_id($id_jadwal) {
		$this->db->select('jadwal_studio.id_jadwal, 
                       jadwal_studio.tanggal_jadwal, 
                       jadwal_studio.waktu_mulai, 
                       jadwal_studio.waktu_selesai, 
                       jadwal_studio.status_ketersediaan, 
                       studio.id_studio, 
                       studio.nama AS nama_studio, 
                       studio.jenis_studio, 
                       studio.harga_per_jam, 
                       studio.foto_studio')
			->from('jadwal_studio')
			->join('studio', 'jadwal_studio.id_studio = studio.id_studio', 'left')
			->where('jadwal_studio.id_jadwal', $id_jadwal);
		return $this->db->get()->row();
	}

	function make_query()
	{
		$this->db->select('jadwal_studio.id_jadwal, 
                       jadwal_studio.tanggal_jadwal, 
                       jadwal_studio.waktu_mulai, 
                       jadwal_studio.waktu_selesai, 
                       jadwal_studio.status_ketersediaan, 
                       studio.id_studio, 
                       studio.nama AS nama_studio, 
                       studio.jenis_studio, 
                       studio.harga_per_jam, 
                       studio.foto_studio')
			->from('jadwal_studio')
			->join('studio', 'jadwal_studio.id_studio = studio.id_studio', 'left');

		$search_value = $_POST['search']['value'] ?? null;

		if (!empty($search_value)) {
			$this->db->group_start()
				->like('studio.nama', $search_value)
				->or_like('studio.jenis_studio', $search_value)
				->group_end();
		}

		$order_column = $_POST['order'][0]['column'] ?? null;
		$order_dir = $_POST['order'][0]['dir'] ?? 'DESC';

		if (!empty($order_column)) {
			$this->db->order_by($order_column, $order_dir);
		} else {
			$this->db->order_by('jadwal_studio.id_jadwal', 'DESC');
		}
	}

	function make_datatables()
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

	function get_filtered_data()
	{
		$this->make_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_all_data()
	{
		return $this->db->count_all('jadwal_studio');
	}

	function insert($data)
	{
		return $this->db->insert('jadwal_studio', $data);
	}

	function get_by_id($id_jadwal)
	{
		$this->db->select('jadwal_studio.*, studio.nama AS nama_studio, studio.jenis_studio')
			->from('jadwal_studio')
			->join('studio', 'jadwal_studio.id_studio = studio.id_studio', 'left')
			->where('jadwal_studio.id_jadwal', $id_jadwal);
		$query = $this->db->get();
		return $query->row();
	}

	function update($id_jadwal, $data)
	{
		$this->db->where('id_jadwal', $id_jadwal);
		return $this->db->update('jadwal_studio', $data);
	}

	function delete($id_jadwal)
	{
		$this->db->where('id_jadwal', $id_jadwal);
		return $this->db->delete('jadwal_studio');
	}

	function listing_studio()
	{
		$this->db->select('id_studio, nama, jenis_studio, harga_per_jam, ketersediaan')
			->from('studio');
		$query = $this->db->get();
		return $query->result();
	}
}
