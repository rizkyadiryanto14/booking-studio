<?php

/**
 * @property $db
 */

class Users_model extends CI_Model
{
	public function get_by_id($id)
	{
		return $this->db->get_where('pengguna', ['id_pengguna' => $id])->row_array();
	}

	public function get_pengguna_by_id($id_pengguna)
	{
		$this->db->where('id_pengguna', $id_pengguna);
		$query = $this->db->get('pengguna');
		return $query->row();
	}

	public function insert($data)
	{
		return $this->db->insert('pengguna', $data);
	}

	public function delete($id)
	{
		$this->db->where('id_pengguna', $id);
		return $this->db->delete('pengguna');
	}

	public function update($id, $data)
	{
		$this->db->where('id_pengguna', $id);
		return $this->db->update('pengguna', $data);
	}

	function make_query()
	{
		$this->db->select('*')
			->from('pengguna');

		$search_value = $_POST['search']['value'] ?? null;

		if (!empty($search_value)) {
			$this->db->group_start()
				->like('nama', $search_value)
				->or_like('email', $search_value)
				->group_end();
		}

		$order_column = $_POST['order'][0]['column'] ?? null;
		$order_dir = $_POST['order'][0]['dir'] ?? 'DESC';

		if (!empty($order_column)) {
			$this->db->order_by($order_column, $order_dir);
		} else {
			$this->db->order_by('id_pengguna', 'DESC');
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
		return $this->db->count_all('pengguna');
	}
}
