<?php

/**
 * @property $session
 * @property $input
 * @property $model
 * @property $form_validation
 * @property $upload
 */

class Studio extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Studio_model', 'model');
	}

	public function index()
	{
		$this->load->view('backend/admin/studio/list');
	}

	/**
	 * @return void
	 */
	public function get_data_studio(): void
	{
		// Panggil data dari model
		$studioData = $this->model->make_datatables();

		if (!is_array($studioData)) {
			log_message('error', 'Data fetched is not an array');
			return;
		}

		$data = [];
		$startIndex = $this->input->post('start') ?? 0;
		$counter = $startIndex + 1;

		foreach ($studioData as $studio) {
			$data[] = $this->prepare_studio_row($studio, $counter++);
		}

		//  hasil untuk DataTables
		$output = [
			"draw" => intval($this->input->post("draw")),
			"recordsTotal" => $this->model->get_all_data(),
			"recordsFiltered" => $this->model->get_filtered_data(),
			"data" => $data
		];

		echo json_encode($output);
	}

	/**
	 * @param $studio
	 * @param $counter
	 *
	 * @return array
	 */
	private function prepare_studio_row($studio, $counter): array
	{
		return [
			$counter,
			$studio->nama_studio,
			$studio->jenis_studio,
			$this->format_rupiah($studio->harga_per_jam),
			$this->generate_status_badge($studio->ketersediaan),
			$this->generate_foto_studio($studio->foto_studio),
			$this->generate_action_buttons($studio->id_studio)
		];
	}

	/**
	 * @param $angka
	 *
	 * @return string
	 */
	private function format_rupiah($angka): string
	{
		return 'Rp.' . number_format($angka, 0, ',', '.');
	}

	/**
	 * @param $ketersediaan
	 *
	 * @return string
	 */
	private function generate_status_badge($ketersediaan): string
	{
		if ($ketersediaan === "tersedia") {
			return '<span class="badge badge-success">Tersedia</span>';
		} else {
			return '<span class="badge badge-danger">Tidak Tersedia</span>';
		}
	}

	/**
	 * @param $foto_studio
	 *
	 * @return string
	 */
	private function generate_foto_studio($foto_studio): string
	{
		return '<img src="' . base_url('uploads/foto_studio/' . $foto_studio) . '" alt="Foto Studio" style="width: 300px; height: auto;" />';
	}

	/**
	 * @param $id_studio
	 *
	 * @return string
	 */
	private function generate_action_buttons($id_studio): string
	{
		$editButton = '<a href="' . site_url('admin/studio/edit/' . $id_studio) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>';
		$deleteButton = '<a href="' . site_url('admin/studio/delete/' . $id_studio) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';

		return $editButton . ' ' . $deleteButton;
	}

	/**
	 * @return void
	 */
	public function AddStudio(): void
	{
		$this->load->view('backend/admin/studio/tambah');
	}

	/**
	 * @param $id
	 *
	 * @return void
	 */
	public function edit($id): void
	{
		if ($id) {
			$data['studio'] = $this->model->get_by_id($id);
			$this->load->view('backend/admin/studio/edit', $data);
		} else {
			$this->session->set_flashdata('error', 'Data Tidak Ditemukan');
			redirect(base_url('admin/studio'));
		}

	}

	/**
	 * @return void
	 */
	public function insert(): void
	{
		// Validasi form
		$this->form_validation->set_rules('nama', 'Nama Studio', 'trim|required');
		$this->form_validation->set_rules('jenis_studio', 'Jenis Studio', 'trim|required');
		$this->form_validation->set_rules('harga_per_jam', 'Harga Per Jam', 'trim|required');
		$this->form_validation->set_rules('ketersediaan', 'Ketersediaan', 'trim|required');

		if (!$this->form_validation->run()) {
			echo json_encode(['status' => 'error', 'message' => validation_errors()]);
			return;
		} else {
			$config['upload_path'] = './uploads/foto_studio/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 2048; // 2MB maksimum
			$config['file_name'] = time() . '_' . $_FILES['foto_studio']['name'];

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('foto_studio')) {
				echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
				return;
			} else {
				$uploadData = $this->upload->data();
				$foto_studio = $uploadData['file_name'];

				$data = [
					'nama' => $this->input->post('nama'),
					'jenis_studio' => $this->input->post('jenis_studio'),
					'harga_per_jam' => $this->input->post('harga_per_jam'),
					'ketersediaan' => $this->input->post('ketersediaan'),
					'foto_studio' => $foto_studio
				];

				$insert = $this->model->insert($data);

				if ($insert) {
					echo json_encode(['status' => 'success', 'message' => 'Data studio berhasil ditambahkan']);
				} else {
					echo json_encode(['status' => 'error', 'message' => 'Data gagal ditambahkan']);
				}
			}
		}
	}

	/**
	 * @param $id
	 *
	 * @return void
	 */
	public function update($id): void
	{
		// Validasi form
		$this->form_validation->set_rules('nama', 'Nama Studio', 'trim|required');
		$this->form_validation->set_rules('jenis_studio', 'Jenis Studio', 'trim|required');
		$this->form_validation->set_rules('harga_per_jam', 'Harga Per Jam', 'trim|required');
		$this->form_validation->set_rules('ketersediaan', 'Ketersediaan', 'trim|required');

		if (!$this->form_validation->run()) {
			echo json_encode(['status' => 'error', 'message' => validation_errors()]);
		} else {

			$studio = $this->model->get_by_id($id);

			if (!empty($_FILES['foto_studio']['name'])) {
				$config['upload_path'] = './uploads/foto_studio/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = 2048; // 2MB
				$config['file_name'] = time() . '_' . $_FILES['foto_studio']['name'];

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('foto_studio')) {

					echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
					return;
				} else {

					if (!empty($studio->foto_studio) && file_exists('./uploads/foto_studio/' . $studio->foto_studio)) {
						unlink('./uploads/foto_studio/' . $studio->foto_studio);
					}

					// Foto baru berhasil di-upload
					$uploadData = $this->upload->data();
					$foto_studio = $uploadData['file_name'];
				}
			} else {
				$foto_studio = $studio->foto_studio;
			}

			$data = [
				'nama' => $this->input->post('nama'),
				'jenis_studio' => $this->input->post('jenis_studio'),
				'harga_per_jam' => $this->input->post('harga_per_jam'),
				'ketersediaan' => $this->input->post('ketersediaan'),
				'foto_studio' => $foto_studio
			];

			$update = $this->model->update($id, $data);

			if ($update) {
				echo json_encode(['status' => 'success', 'message' => 'Data studio berhasil ditambahkan']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Data gagal ditambahkan']);
			}
		}
	}

	/**
	 * @param $id
	 *
	 * @return void
	 */
	public function delete($id): void
	{
		$studio = $this->model->get_by_id($id);

		if (!$studio) {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(base_url('admin/studio'));
		}

		if (!empty($studio->foto_studio) && file_exists('./uploads/foto_studio/' . $studio->foto_studio)) {
			unlink('./uploads/foto_studio/' . $studio->foto_studio);
		}

		$delete = $this->model->delete($id);

		if ($delete) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('error', 'Data gagal dihapus');
		}

		redirect(base_url('admin/studio'));
	}


}
