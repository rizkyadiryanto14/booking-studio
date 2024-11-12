<?php

/**
 * @property $model
 * @property $input
 * @property $form_validation
 * @property $session
 */

class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model', 'model');
	}

	public function index()
	{
		$this->load->view('backend/admin/users/list');
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[pengguna.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('role', 'Role', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim');

		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('error', validation_errors());
		} else {
			$data = [
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role' => $this->input->post('role'),
				'alamat' => $this->input->post('alamat'),
				'no_telepon' => $this->input->post('no_telepon'),
			];

			$insert = $this->model->insert($data);

			if ($insert) {
				$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
			} else {
				$this->session->set_flashdata('error', 'Data gagal ditambahkan');
			}
			redirect(base_url('admin/users'));
		}
		redirect(base_url('admin/users'));
	}

	public function update()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[pengguna.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('role', 'Role', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim');

		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('error', validation_errors());
		} else {
			$data = [
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role' => $this->input->post('role'),
				'alamat' => $this->input->post('alamat'),
				'no_telepon' => $this->input->post('no_telepon'),
			];

			$insert = $this->model->update($data);

			if ($insert) {
				$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
			} else {
				$this->session->set_flashdata('error', 'Data gagal ditambahkan');
			}
			redirect(base_url('admin/users'));
		}
		redirect(base_url('admin/users'));
	}

	public function delete($id)
	{
		if ($id) {
			$delete = $this->model->delete($id);
			if ($delete) {
				$this->session->set_flashdata('success', 'Data berhasil dihapus');
			} else {
				$this->session->set_flashdata('error', 'Data gagal dihapus');
			}
			redirect(base_url('admin/users'));
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
		}
		redirect(base_url('admin/users'));
	}

	public function get_pengguna_by_id()
	{
		$id_pengguna = $this->input->post('id_pengguna');
		$data = $this->model->get_pengguna_by_id($id_pengguna);

		echo json_encode($data);
	}


	public function get_data_users()
	{
		$userData = $this->model->make_datatables();

		if (!is_array($userData)) {
			log_message('error', 'Data fetched is not an array');
			return;
		}

		$data = [];
		$startIndex = $this->input->post('start') ?? 0;
		$counter = $startIndex + 1;

		foreach ($userData as $user) {
			$data[] = $this->prepare_user_row($user, $counter++);
		}

		// Menyiapkan hasil untuk DataTables
		$output = [
			"draw" => intval($this->input->post("draw")),
			"recordsTotal" => $this->model->get_all_data(),
			"recordsFiltered" => $this->model->get_filtered_data(),
			"data" => $data
		];

		echo json_encode($output);
	}

	private function prepare_user_row($user, $counter)
	{
		// Mendapatkan role dari user
		$roleText = $this->get_role_text($user->role);

		// Menyiapkan array data untuk satu user
		return [
			$counter,
			$user->nama,
			$user->email,
			$user->no_telepon ?? 'N/A',
			$user->alamat ?? 'N/A',
			$roleText,
			$this->generate_action_buttons($user->id_pengguna)
		];
	}

	private function get_role_text($role)
	{
		// Mengubah role ID menjadi teks yang deskriptif
		return $role == "1" ? 'admin' : 'user';
	}

	private function generate_action_buttons($userId)
	{
		$editButton = '<a href="javascript:void(0);" data-id="' . $userId . '" class="btn btn-info btn-xs btn-edit"><i class="fa fa-edit"></i></a>';
		$deleteButton = '<a href="' . site_url('admin/users/delete/' . $userId) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';

		return $editButton . ' ' . $deleteButton;
	}
}
