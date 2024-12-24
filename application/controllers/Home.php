<?php

class Home extends CI_Controller
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
		$this->load->view('frontend/landing');
	}
}
