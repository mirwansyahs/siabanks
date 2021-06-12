<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disclaimer extends AUTH_Controller {
	public function __construct()
	{
		parent::__construct();
		if ($this->userdata->user_status == "1"){
			$this->session->set_flashdata("msg", $this->alert->failed("Anda bukan administrator"));
			redirect('Redaktur/Home');
		}
	}

	public function index()
	{
		$data['userdata']	= $this->userdata;

		$data['judul']		= "Disclaimer";
		$data['deskripsi']  = "Disclaimer";

		$this->backend->views('_backend/jenissampah/list', $data);
	}

}
