<?php

/**
 * @property $session
 * @property $input
 * @property $model
 * @property $form_validation
 */

class Jadwal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jadwal_model', 'model');
	}

	public function index()
	{
		$this->load->view('backend/admin/jadwal/list');
	}

	public function listing_studio()
	{
		$data = $this->model->listing_studio();
		echo json_encode($data);
	}

	public function get_jadwal_by_id()
	{
		$id_jadwal = $this->input->post('id_jadwal');
		$jadwal = $this->model->get_jadwal_by_id($id_jadwal);
		echo json_encode($jadwal);
	}
	
	public function insert()
	{
		$this->form_validation->set_rules('id_studio', 'Studio', 'required');
		$this->form_validation->set_rules('tanggal_jadwal', 'Tanggal Jadwal', 'required');
		$this->form_validation->set_rules('waktu_mulai', 'Waktu Mulai', 'required');
		$this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', 'required');

		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('error', validation_errors());
		} else {
			$data = array(
				'id_studio' => $this->input->post('id_studio'),
				'tanggal_jadwal' => $this->input->post('tanggal_jadwal'),
				'waktu_mulai' => $this->input->post('waktu_mulai'),
				'waktu_selesai' => $this->input->post('waktu_selesai'),
				'status_ketersediaan' => 'tersedia'
			);
			$insert = $this->model->insert($data);
			if ($insert) {
				$this->session->set_flashdata('success', 'Jadwal studio berhasil ditambahkan');
			} else {
				$this->session->set_flashdata('error', 'Jadwal studio gagal ditambahkan');
			}
			redirect(base_url('admin/jadwal_studio'));
		}
		redirect(base_url('admin/jadwal_studio'));
	}

	public function update()
	{
		$this->form_validation->set_rules('id_studio', 'Studio', 'required');
		$this->form_validation->set_rules('tanggal_jadwal', 'Tanggal Jadwal', 'required');
		$this->form_validation->set_rules('waktu_mulai', 'Waktu Mulai', 'required');
		$this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', 'required');

		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('error', validation_errors());
		} else {
			$data = array(
				'id_studio' => $this->input->post('id_studio'),
				'tanggal_jadwal' => $this->input->post('tanggal_jadwal'),
				'waktu_mulai' => $this->input->post('waktu_mulai'),
				'waktu_selesai' => $this->input->post('waktu_selesai'),
				'status_ketersediaan' => $this->input->post('status_ketersediaan')
			);
			$insert = $this->model->update($this->input->post('id_jadwal'), $data);
			if ($insert) {
				$this->session->set_flashdata('success', 'Jadwal studio berhasil diubah');
			} else {
				$this->session->set_flashdata('error', 'Jadwal studio gagal diubah');
			}
			redirect(base_url('admin/jadwal_studio'));
		}
		redirect(base_url('admin/jadwal_studio'));
	}

	public function get_data_jadwal()
	{
		// Panggil data dari model
		$jadwalData = $this->model->make_datatables();

		if (!is_array($jadwalData)) {
			log_message('error', 'Data fetched is not an array');
			return;
		}

		$data = [];
		$startIndex = $this->input->post('start') ?? 0;
		$counter = $startIndex + 1;

		foreach ($jadwalData as $jadwal) {
			$data[] = $this->prepare_jadwal_row($jadwal, $counter++);
		}

		// Siapkan hasil untuk DataTables
		$output = [
			"draw" => intval($this->input->post("draw")),
			"recordsTotal" => $this->model->get_all_data(),
			"recordsFiltered" => $this->model->get_filtered_data(),
			"data" => $data
		];

		echo json_encode($output);
	}

	private function prepare_jadwal_row($jadwal, $counter)
	{
		return [
			$counter,
			$jadwal->nama_studio,
			$jadwal->jenis_studio,
			$this->format_rupiah($jadwal->harga_per_jam),
			$this->generate_status_badge($jadwal->status_ketersediaan),
			$this->format_jadwal_waktu($jadwal->tanggal_jadwal, $jadwal->waktu_mulai, $jadwal->waktu_selesai),
			$this->generate_foto_studio($jadwal->foto_studio),
			$this->generate_action_buttons($jadwal->id_jadwal)
		];
	}

	private function format_rupiah($angka)
	{
		return 'Rp.' . number_format($angka, 0, ',', '.');
	}

	private function generate_status_badge($status)
	{
		if ($status === "tersedia") {
			return '<span class="badge badge-success">Tersedia</span>';
		} else {
			return '<span class="badge badge-danger">Terpakai</span>';
		}
	}

	private function format_jadwal_waktu($tanggal, $waktu_mulai, $waktu_selesai)
	{
		$formattedDate = date('d-m-Y', strtotime($tanggal));
		$formattedStartTime = date('H:i', strtotime($waktu_mulai));
		$formattedEndTime = date('H:i', strtotime($waktu_selesai));

		return $formattedDate . ' | ' . $formattedStartTime . ' - ' . $formattedEndTime;
	}

	private function generate_foto_studio($foto_studio)
	{
		return '<img src="' . base_url('uploads/foto_studio/' . $foto_studio) . '" alt="Foto Studio" style="width: 100px; height: auto;" />';
	}

	private function generate_action_buttons($id_jadwal)
	{
		$editButton = '<a href="javascript:void(0);" data-id="' . $id_jadwal . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>';
		$deleteButton = '<a href="' . site_url('admin/jadwal/delete/' . $id_jadwal) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';

		return $editButton . ' ' . $deleteButton;
	}


	public function delete($id)
	{
		if ($id) {
			$delete = $this->model->delete($id);
			if ($delete) {
				$this->session->set_flashdata('success', 'Jadwal studio berhasil dihapus');
			} else {
				$this->session->set_flashdata('error', 'Jadwal studio gagal dihapus');
			}
			redirect(base_url('admin/jadwal_studio'));
		} else {
			$this->session->set_flashdata('error', 'Terjadi Kesalahan Saat Menghapus Data');
		}
		redirect(base_url('admin/jadwal_studio'));
	}


}
