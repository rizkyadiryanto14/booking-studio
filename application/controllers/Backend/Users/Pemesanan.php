<?php
/**
 * @property $pemesanan_model
 * @property $session
 * @property $input
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
	public function index(): void
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
	public function get_data_riwayat($id_pengguna): void
	{
		$studioData = $this->pemesanan_model->make_datatables_riwayat($id_pengguna);

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

		$output = [
			"draw" => intval($this->input->post("draw")),
			"recordsTotal" => $this->pemesanan_model->get_all_data_riwayat(),
			"recordsFiltered" => $this->pemesanan_model->get_filtered_data_riwayat(),
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
			$studio->nama_pengguna,
			$studio->nama_studio,
			$this->format_rupiah($studio->total_harga),
			$studio->tanggal_pemesanan . $studio->waktu_pemesanan,
			$studio->status_pembayaran,
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
}
