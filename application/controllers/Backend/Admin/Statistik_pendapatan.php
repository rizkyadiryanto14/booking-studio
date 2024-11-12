<?php

/**
 * @property $input
 * @property $Statistik_model
 */

class Statistik_pendapatan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Statistik_model');
	}

	public function index()
	{
		$year = $this->input->get('year') ?: date('Y');

		$data['monthly_revenue'] = $this->Statistik_model->get_yearly_revenue($year);
		$data['year'] = $year;

		$this->load->view('backend/admin/statistik_pendapatan/list', $data);
	}
}
