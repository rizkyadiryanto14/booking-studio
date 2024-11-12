<?php

class Studio_model extends CI_Model
{

	public function get()
	{
		return $this->db->get('studio')->result();
	}

	public function get_by_id($id)
	{
		return $this->db->get_where('studio', ['id_studio' => $id])->row();
	}

	public function insert($data)
	{
		if ($this->db->insert('studio', $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function update($id, $data)
	{
		return $this->db->where('id_studio', $id)->update('studio', $data);
	}

	public function delete($id)
	{
		return $this->db->where('id_studio', $id)->delete('studio');
	}

	function make_query()
	{
		$this->db->select('studio.id_studio, 
                       studio.nama AS nama_studio, 
                       studio.jenis_studio, 
                       studio.harga_per_jam, 
                       studio.ketersediaan, 
                       studio.foto_studio')
			->from('studio'); // Tabel studio

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
			$this->db->order_by('studio.id_studio', 'DESC');
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
		return $this->db->count_all('studio');
	}

}
