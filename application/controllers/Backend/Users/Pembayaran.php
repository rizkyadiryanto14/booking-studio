<?php

use Midtrans\Snap;
use Midtrans\Config;

/**
 * @property $pembayaran_model
 * @property $config
 * @property $session
 */
class Pembayaran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pembayaran_model', 'pembayaran_model');
		$this->load->library('session');

		// Set Midtrans Configuration
		$this->config->load('midtrans');
		Config::$serverKey = $this->config->item('midtrans_server_key');
		Config::$isProduction = $this->config->item('midtrans_is_production');
		Config::$isSanitized = true;
		Config::$is3ds = true;
	}

	/**
	 * @param $id_pemesanan
	 *
	 * @return void
	 */
	public function get_snap_token($id_pemesanan): void
	{
		$pemesanan = $this->pembayaran_model->get_pemesanan_by_id($id_pemesanan);

		if (!$pemesanan) {
			$response = ['status' => 'error', 'message' => 'Pemesanan tidak ditemukan.'];
			echo json_encode($response);
			return;
		}

		$transaction_details = array(
			'order_id' => $pemesanan['id_pemesanan'] . '-' . time(),
			'gross_amount' => $pemesanan['total_harga'],
		);

		$item_details = array(
			array(
				'id' => $pemesanan['id_studio'],
				'price' => $pemesanan['total_harga'],
				'quantity' => 1,
				'name' => $pemesanan['nama_studio']
			)
		);

		$customer_details = array(
			'first_name' => $this->session->userdata('nama'),
			'email' => $this->session->userdata('email'),
		);

		$transaction = array(
			'transaction_details' => $transaction_details,
			'item_details' => $item_details,
			'customer_details' => $customer_details,
		);

		try {
			$snapToken = Snap::getSnapToken($transaction);
			$response = ['status' => 'success', 'snap_token' => $snapToken];
		} catch (Exception $e) {
			log_message('error', 'Gagal mendapatkan token pembayaran: ' . $e->getMessage());
			$response = ['status' => 'error', 'message' => 'Gagal mendapatkan token pembayaran.'];
		}

		echo json_encode($response);
	}

	/**
	 * @return void
	 */
	public function callback(): void
	{
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result, true);

		if ($result) {
			$order_id = $result['order_id'];
			$transaction_status = $result['transaction_status'];
			$payment_type = $result['payment_type'];
			$gross_amount = $result['gross_amount'];
			$transaction_time = $result['transaction_time'];
			$signature_key = $result['signature_key'];

			$data_pembayaran = array(
				'order_id' => $order_id,
				'payment_type' => $payment_type,
				'transaction_status' => $transaction_status,
				'gross_amount' => $gross_amount,
				'transaction_time' => $transaction_time,
				'signature_key' => $signature_key,
				'status' => ($transaction_status == 'settlement') ? 'sukses' : 'pending',
				'tanggal' => date('Y-m-d')
			);

			$this->pembayaran_model->insert_pembayaran($data_pembayaran);

			if ($transaction_status == 'settlement') {
				$id_pemesanan = explode('-', $order_id)[0];
				$this->pembayaran_model->update_status_pembayaran($id_pemesanan, 'sukses');
			}

			$this->pembayaran_model->update_pembayaran_status($order_id, $transaction_status);

			log_message('info', 'Pembayaran untuk order_id ' . $order_id . ' telah diperbarui.');
		}
	}
}
