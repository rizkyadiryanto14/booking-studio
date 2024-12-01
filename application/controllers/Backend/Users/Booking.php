<?php

/**
 * @property $booking_model
 * @property $session
 */
class Booking extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Booking_model', 'booking_model');
		$this->load->library('session');
		$this->load->helper('url');
	}

	/**
	 * @return void
	 */
	public function index(): void
	{
		$data['list_studio'] = $this->booking_model->get_all_booked_studio();
		$this->load->view('backend/users/studio/list', $data);
	}

	/**
	 * @param $id_studio
	 *
	 * @return void
	 */
	public function available_studios_with_slots($id_studio): void
	{
		$studio = $this->booking_model->get_studio_by_id($id_studio);

		if (empty($studio)) {
			show_404();
			return;
		}

		$bookedTimeSlots = $this->booking_model->get_booked_slots($id_studio);

		$slots = $this->generate_time_slots($studio['waktu_mulai'], $studio['waktu_selesai'], 30, $bookedTimeSlots);

		$data['studio'] = $studio;
		$data['slots'] = $slots;
		$this->load->view('backend/users/studio/booking', $data);
	}

	/**
	 * @param $start_time
	 * @param $end_time
	 * @param $interval
	 * @param $bookedTimeSlots
	 *
	 * @return array
	 */
	private function generate_time_slots($start_time, $end_time, $interval, $bookedTimeSlots): array
	{
		$start = strtotime($start_time);
		$end = strtotime($end_time);
		$slots = [];

		while ($start < $end) {
			$next_slot = $start + ($interval * 60); // Interval dalam detik
			$slot_time = date('H:i', $start) . ' - ' . date('H:i', $next_slot);

			$is_booked = $this->is_slot_booked($start, $bookedTimeSlots);

			$slots[] = [
				'time' => $slot_time,
				'is_booked' => $is_booked
			];

			$start = $next_slot;
		}

		return $slots;
	}

	/**
	 * @param $start_time
	 * @param $bookedTimeSlots
	 *
	 * @return bool
	 */
	private function is_slot_booked($start_time, $bookedTimeSlots): bool
	{
		$start_time_formatted = date('H:i', $start_time);
		return in_array($start_time_formatted, $bookedTimeSlots);
	}

	/**
	 * @param $id_studio
	 * @param $slot_time
	 *
	 * @return void
	 */
	public function pesan_slot($id_studio, $slot_time): void
	{
		$id_pengguna = $this->session->userdata('id_pengguna');

		if (!$id_pengguna || !$id_studio || !$slot_time) {
			$this->session->set_flashdata('error', 'Data tidak valid untuk melakukan pemesanan');
			redirect(base_url('users/studio_detail/' . $id_studio));
		}

		$slot_time = str_replace(['_', '-'], [':', ' '], $slot_time);
		$harga_per_jam = $this->booking_model->get_harga_per_jam($id_studio);

		$data_pemesanan = [
			'id_pengguna' => $id_pengguna,
			'id_studio' => $id_studio,
			'tanggal_pemesanan' => date('Y-m-d'),
			'waktu_pemesanan' => urldecode($slot_time),
			'total_harga' => $harga_per_jam,
			'status_pembayaran' => 'pending'
		];

		$insert = $this->booking_model->insert_pemesanan($data_pemesanan);

		if ($insert) {
			$this->session->set_flashdata('success', 'Pemesanan berhasil, harap selesaikan pembayaran pada bagian Riwayat Pemesanan!');
		} else {
			$this->session->set_flashdata('error', 'Pemesanan gagal, silakan coba lagi.');
		}
		redirect(base_url('users/studio_detail/' . $id_studio));
	}

}
