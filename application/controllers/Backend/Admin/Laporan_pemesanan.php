<?php

/**
 *
 * @property $Pemesanan_model
 * @property $input
 */

class Laporan_pemesanan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pemesanan_model');
	}

	/**
	 * @return void
	 */
	public function index(): void
	{
		$this->load->view('backend/admin/laporan_pemesanan/list');
	}

	/**
	 * @return void
	 */
	public function get_data_laporanpemesanan(): void
	{
		// Panggil data dari model
		$studioData = $this->Pemesanan_model->make_datatables();

		if (!is_array($studioData)) {
			log_message('error', 'Data fetched is not an array');
			return;
		}

		$data = [];
		$startIndex = $this->input->post('start') ?? 0;
		$counter = $startIndex + 1;

		foreach ($studioData as $laporan) {
			$data[] = $this->prepare_laporanpemesanan_row($laporan, $counter++);
		}

		//  hasil untuk DataTables
		$output = [
			"draw" => intval($this->input->post("draw")),
			"recordsTotal" => $this->Pemesanan_model->get_all_data(),
			"recordsFiltered" => $this->Pemesanan_model->get_filtered_data(),
			"data" => $data
		];

		echo json_encode($output);
	}

	/**
	 * @param $laporan
	 * @param $counter
	 *
	 * @return array
	 */
	private function prepare_laporanpemesanan_row($laporan, $counter): array
	{
		return [
			$counter,
			$laporan->nama_pengguna,
			$laporan->nama_studio,
			$laporan->tanggal_pemesanan,
			$laporan->waktu_pemesanan,
			$laporan->total_harga,
			$this->generate_action_buttons($laporan->id_pemesanan)
		];
	}

	/**
	 * @param $id_pemesanan
	 *
	 * @return string
	 */
	private function generate_action_buttons($id_pemesanan): string
	{
		$editButton = '<a href="' . site_url('admin/laporan_pemesanan/edit/' . $id_pemesanan) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>';
		$deleteButton = '<a href="' . site_url('admin/laporan_pemesanan/delete/' . $id_pemesanan) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';

		return $editButton . ' ' . $deleteButton;
	}

	/**
	 * Controller untuk unduh laporan pembayaran
	 */

	/**
	 * @return void
	 */
	public function unduh(): void
	{
		$data['laporan_pemesanan'] = $this->Pemesanan_model->get_all_laporan_pemesanan();
		$this->load->view('backend/admin/laporan_pemesanan/download', $data);
	}
}
