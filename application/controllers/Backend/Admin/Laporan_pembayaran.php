<?php

/**
 * @property $Pembayaran_model
 * @property $input
 */

class Laporan_pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pembayaran_model');
    }

    /**
     * @return void
     */
    public function index(): void
    {
        $this->load->view('backend/admin/laporan_pembayaran/list');
    }

    public function get_data_laporanpembayaran(): void
    {
        // Panggil data dari model
        $studioData = $this->Pembayaran_model->make_datatables();

        if (!is_array($studioData)) {
            log_message('error', 'Data fetched is not an array');
            return;
        }

        $data = [];
        $startIndex = $this->input->post('start') ?? 0;
        $counter = $startIndex + 1;

        foreach ($studioData as $laporan) {
            $data[] = $this->prepare_laporanpembayaran_row($laporan, $counter++);
        }

        //  hasil untuk DataTables
        $output = [
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => $this->Pembayaran_model->get_all_data(),
            "recordsFiltered" => $this->Pembayaran_model->get_filtered_data(),
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
    private function prepare_laporanpembayaran_row($laporan, $counter): array
    {
        return [
            $counter,
            $laporan->nama_pengguna,
            $laporan->id_pemesanan,
            $laporan->payment_type,
            $laporan->transaction_status,
            $laporan->gross_amount,
            $laporan->transaction_time,
            $this->generate_action_buttons($laporan->id_pembayaran)
        ];
    }

    /**
     * @param $id_pembayaran
     *
     * @return string
     */
    private function generate_action_buttons($id_pembayaran): string
    {
        $editButton = '<a href="' . site_url('admin/laporan_pembayaran/edit/' . $id_pembayaran) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>';
        $deleteButton = '<a href="' . site_url('admin/laporan_pembayaran/delete/' . $id_pembayaran) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';

        return $editButton . ' ' . $deleteButton;
    }

    /**
     * @return void
     */
    public function unduh(): void
    {
        $data['laporan_pembayaran'] = $this->Pembayaran_model->get_laporan_listing_pemesanan();
        $this->load->view('backend/admin/laporan_pembayaran/download', $data);
    }
}
