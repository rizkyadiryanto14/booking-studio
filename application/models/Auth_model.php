<?php
/**
 * @property $db
 */

class Auth_model extends CI_Model
{
	public function get()
	{
		return $this->db->get('pengguna')->result();
	}

	public function get_by_username($email)
	{
		return $this->db->get_where('pengguna', ['email' => $email])->row_array();
	}

	public function get_by_id($id_pengguna)
	{
		return $this->db->get_where('pengguna', ['id_pengguna' => $id_pengguna])->row_array();
	}

	public function insert($data)
	{
		return $this->db->insert('pengguna', $data);
	}

	public function update($id, $data)
	{
		return $this->db->where('id_pengguna', $id)->update('pengguna', $data);
	}

	public function delete($id)
	{
		return $this->db->where('id_pengguna', $id)->delete('pengguna');
	}
}
