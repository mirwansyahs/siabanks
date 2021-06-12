<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup extends AUTH_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_users");
		$this->load->model("M_topup");
		$this->load->library('upload');
		
		if ($this->userdata->user_status == "1"){
			$this->session->set_flashdata("msg", $this->alert->failed("Anda bukan administrator"));
			redirect('Redaktur/Home');
		}
	}

	public function index()
	{
		$data['userdata']	= $this->userdata;

		$data['judul']		= "Top up saldo";
		$data['deskripsi']  = "Manage saldo";

		$data['data']	= $this->M_users->select_all();

		$this->backend->views('_backend/topup/list', $data);
	}

	public function reset($id)
	{
		$result = $this->M_topup->reset($id);


		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Reset", "Saldo kembali 0"));
			redirect("Redaktur/Topup");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Reset"));
			redirect("Redaktur/Topup");
		}
	}


	public function done($id)
	{

		$data = $this->input->post();
		$data['MemberID'] = $id;
		$result = $this->M_topup->done($data);


		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Menambahkan", "Saldo telah ditambahkan sebesar Rp.".number_format($data['saldo']).",-"));
			redirect("Redaktur/Topup");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Menambahkan"));
			redirect("Redaktur/Topup");
		}
	}

	
}
