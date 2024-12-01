<?php

class Studio_populer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @return void
	 */
	public function index(): void
	{
		$this->load->view('backend/admin/studio_populer/list');
	}
}
