<?php

class Booking_model extends CI_Model
{
	public function get_all_booked_studio()
	{
		return $this->db->get('ketersediaan_studio')->result();
	}

	public function get_studio_by_id($id_studio)
	{
		$this->db->select('s.id_studio, s.nama, s.jenis_studio, s.foto_studio, s.harga_per_jam, js.waktu_mulai, js.waktu_selesai');
		$this->db->from('studio s');
		$this->db->join('jadwal_studio js', 's.id_studio = js.id_studio', 'left');
		$this->db->where('s.id_studio', $id_studio);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function get_booked_slots($id_studio)
	{
		$this->db->select('p.waktu_pemesanan');
		$this->db->from('pemesanan p');
		$this->db->where('p.id_studio', $id_studio);
		$this->db->where('p.status_pembayaran', 'sukses');
		$query = $this->db->get();

		$booked_slots = [];
		foreach ($query->result() as $row) {
			$booked_slots[] = date('H:i', strtotime($row->waktu_pemesanan));
		}

		return $booked_slots;
	}

	public function insert_pemesanan($data_pemesanan)
	{
		return $this->db->insert('pemesanan', $data_pemesanan);
	}

	public function get_harga_per_jam($id_studio)
	{
		$this->db->select('harga_per_jam');
		$this->db->from('studio');
		$this->db->where('id_studio', $id_studio);
		$query = $this->db->get();

		$result = $query->row_array();
		return $result['harga_per_jam'] ?? 0;
	}
}
