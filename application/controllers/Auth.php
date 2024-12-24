<?php
/**
 * @property $session
 * @property $form_validation
 * @property $model
 * @property $input
 */

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'model');
	}

	/**
	 * @return void
	 */
	public function index(): void
	{
		$this->load->view('auth/login');
	}

	/**
	 * @return void
	 */
	public function registrasi(): void
	{
		$this->load->view('auth/registrasi');
	}

	/**
	 * @return void
	 */
	public function login(): void
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$cek_email = $this->model->get_by_username($email);

		if ($cek_email) {
			if (password_verify($password, $cek_email['password'])) {
				$usersession = [
					'id_pengguna' => $cek_email['id_pengguna'],
					'email' => $cek_email['email'],
					'nama' => $cek_email['nama'],
					'role' => $cek_email['role']
				];
				$this->session->set_userdata($usersession);
				redirect(base_url('dashboard'));
			} else {
				$this->session->set_flashdata('error', 'Username atau Password salah');
			}
		} else {
			$this->session->set_flashdata('error', 'Email tidak terdaftar');
		}
		redirect(base_url('auth/login'));
	}

	public function register()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[pengguna.email]');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('no_telepon', 'Nomor Telepon', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('error', strip_tags(validation_errors()));
		} else {
			$data = [
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'alamat' => $this->input->post('alamat'),
				'no_telepon' => $this->input->post('no_telepon'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role' => 2,
			];

			$insert = $this->model->insert($data);

			if ($insert) {
				$this->session->set_flashdata('success', 'Registrasi Berhasil');
			} else {
				$this->session->set_flashdata('error', 'Registrasi Gagal');
			}
			redirect(base_url('auth/login'));
		}
		redirect(base_url('auth/login'));
	}

	/**
	 * @return void
	 */
	public function logout(): void
	{
		$this->session->sess_destroy();

		redirect(base_url('auth/login'));
	}
}
