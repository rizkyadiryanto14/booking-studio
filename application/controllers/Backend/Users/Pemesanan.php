<?php
/**
 * @property $pemesanan_model
 * @property $session
 */

class Pemesanan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pemesanan_model', 'pemesanan_model');
	}

	public function index()
	{
		$id_pengguna = $this->session->userdata('id_pengguna');
		// Ambil daftar pemesanan dari model
		$data['pemesanan'] = $this->pemesanan_model->get_pemesanan_by_user($id_pengguna);

		// Load view dengan data pemesanan pengguna
		$this->load->view('backend/users/pemesanan/list', $data);
	}
}
