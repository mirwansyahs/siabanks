<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListRedeem extends AUTH_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('M_redeem');
		$this->load->model('M_sampah');
		$data['data']		= $this->M_admin->select($this->userdata->ID);
		if ($data['data']->latitude == "" || $data['data']->longitude == ""){
			$this->session->set_flashdata("msg", $this->alert->info("Silahkan ubah lokasi anda di menu <b>Location</b> dan alamat anda di menu <b>Detail Profile</b> terlebih dahulu!"));
			redirect("Redaktur/Profile");
		}
	}

	public function index()
	{
		$data['userdata'] 	= $this->userdata;

		$data['judul']		= "List Redeem.";
		$data['deskripsi']	= "List Redeem.";

		$data['data']		= $this->M_admin->select($this->userdata->ID);

		if ($this->userdata->user_status == "1" || $this->userdata->user_status == "2"){
			$data['dataRedeem']	= $this->M_redeem->select_redeem($this->userdata->MemberID);
		}

		if ($this->userdata->user_status == "0"){
			$data['dataRedeem']	= $this->M_redeem->select_redeem();
		}

		$this->backend->views("_backend/listredeem/list", $data);
	}

	public function diterima($id){
		$result = $this->M_redeem->diterima($id);

		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Kirim", "Pulsa telah dikirim."));
			redirect("Redaktur/ListRedeem");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Kirim"));
			redirect("Redaktur/ListRedeem");
		}
	}

	public function ditolak($id){
		$result = $this->M_redeem->ditolak($id);

		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Tolak"));
			redirect("Redaktur/ListRedeem");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Tolak"));
			redirect("Redaktur/ListRedeem");
		}
	}
}