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

	public function index()
	{
		$this->load->view('auth/login');
	}

	public function registrasi()
	{
		$this->load->view('auth/registrasi');
	}

	public function login()
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

	}

	public function logout()
	{
		$this->session->sess_destroy();

		redirect(base_url('auth/login'));
	}
}
