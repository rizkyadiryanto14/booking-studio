<?php

/**
 * @author Rizky Adi Ryanto
 * @link github.com/rizkyadiryanto14
 *
 * @property $Auth_model
 * @property $input
 * @property $session
 * @property $form_validation
 */

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
	}

	/**
	 * @return void
	 */
	public function index(): void
	{
		$data['users'] = $this->Auth_model->get_by_id($this->session->userdata('id_pengguna'));
		$this->load->view('backend/admin/profile/list', $data);
	}

	/**
	 * @return void
	 */
	public function update_profile(): void
	{
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('no_telepon', 'no_telepon', 'required|trim');
		$this->form_validation->set_rules('alamat', 'alamat', 'required|trim');

		$id_user = $this->session->userdata('id_pengguna');

		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('error', strip_tags(validation_errors()));
		} else {
			$data = [
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'no_telepon' => $this->input->post('no_telepon'),
				'alamat' => $this->input->post('alamat')
			];

			$update = $this->Auth_model->update($id_user, $data);
			if ($update) {
				$this->session->set_flashdata('success', 'Berhasil Mengupdate Data Profile');
			} else {
				$this->session->set_flashdata('error', 'Gagal Mengupdate Data Profile');
			}
			redirect(base_url('admin/profile'));
		}
		redirect(base_url('admin/profile'));
	}

	/**
	 * @return void
	 */
	public function update_password(): void
	{
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|trim');
		$this->form_validation->set_rules('password_baru', 'Password_Baru', 'required|trim');

		$id_user = $this->session->userdata('id_pengguna');

		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('error', strip_tags(validation_errors()));
		} else {

			$password = $this->input->post('password');
			$password_baru = $this->input->post('password_baru');
			$konfirmasi_password = $this->input->post('konfirmasi_password');

			//pengecekan apakah password sama dengan password sebelumnya
			if ($password == $password_baru) {
				$this->session->set_flashdata('error', 'Password baru sama dengan password lama');
				redirect(base_url('admin/profile'));
			}

			//pengecekan apakah password sama dengan konfirmasi password
			if ($password_baru != $konfirmasi_password) {
				$this->session->set_flashdata('error', 'Password dan Konfirmasi Password Tidak Sama');
				redirect(base_url('admin/profile'));
			}
		}
	}
}
