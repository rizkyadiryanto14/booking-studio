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

	/**
	 * @return void
	 */
	public function index()
	{
		$id_pengguna = $this->session->userdata('id_pengguna');
		$data['pemesanan'] = $this->pemesanan_model->get_pemesanan_by_user($id_pengguna);

		$this->load->view('backend/users/pemesanan/list', $data);
	}

	/**
	 * @param $id_pengguna
	 *
	 * @return void
	 */
	public function pembayaran_saya($id_pengguna): void
	{
		if ($id_pengguna) {
			
		} else {
			$this->session->set_flashdata('error', 'Terjadi Kesalahan, Harap Menghubungi Customer Service');
		}
		redirect(base_url('dashboard'));
	}
}
