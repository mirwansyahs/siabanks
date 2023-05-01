<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends AUTH_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('M_sampah');
	}

	public function index()
	{
		$data['userdata'] 	= $this->userdata;

		$data['judul']		= "Sudah dikerjakan.";
		$data['deskripsi']	= "Sudah dikerjakan.";

		$data['data']		= $this->M_admin->select($this->userdata->ID);

		$data['dataSampah']	= $this->M_sampah->select_kangsampah_all();
	
		$this->backend->views("_backend/task/list", $data);
	}

}