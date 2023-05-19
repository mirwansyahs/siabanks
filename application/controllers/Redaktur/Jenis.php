<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends AUTH_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_jenis");
		$this->load->library('upload');
		
		if ($this->userdata->user_status == "2"){
			$this->session->set_flashdata("msg", $this->alert->failed("Anda bukan administrator"));
			redirect('Redaktur/Home');
		}
	}

	public function index()
	{
		$data['userdata']	= $this->userdata;

		$data['judul']		= "Jenis Sampah";
		$data['deskripsi']  = "Jenis Sampah";

		$data['data']	= $this->M_jenis->select()->result();

		$this->backend->views('_backend/jenissampah/list', $data);
	}

	public function ProsesAdd(){
		$data = $this->input->post();

		$dir = './assets/images/resources/';

		$config['upload_path']		= $dir; //path folder
		$config['allowed_types']	= 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name']		= TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		
		if($this->upload->do_upload("image")){
		    $image = $this->upload->data();
		    $data['gambar_jenis'] =  file_get_contents($image['full_path']);

			$result = $this->M_jenis->simpan($data);
			unlink($dir.'/'.$image['file_name']);
		}else{
			$this->session->set_flashdata("msg", $this->alert->failed($this->upload->display_errors()));
			redirect("Redaktur/Jenis");
	    }
		
		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Menambah jenis sampah"));
			redirect("Redaktur/Jenis");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Menambah jenis sampah"));
			redirect("Redaktur/Jenis");
		}
	}

	public function ProsesUpdate($id = ''){
		$data = $this->input->post();
		$data['id_jenis']	= $id;

		$dir = './assets/images/resources/';

		$config['upload_path']		= $dir; //path folder
		$config['allowed_types']	= 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name']		= TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		
		if($this->upload->do_upload("image")){
		    $image = $this->upload->data();
		    $data['gambar_jenis'] =  file_get_contents($image['full_path']);

			unlink($dir.'/'.$image['file_name']);
		}else{
			$data['gambar_jenis'] = $this->M_jenis->select($data['id_jenis'])->row()->gambar_jenis;
	    }
		$result = $this->M_jenis->update($data);
		
		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Menambah jenis sampah"));
			redirect("Redaktur/Jenis");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Menambah jenis sampah"));
			redirect("Redaktur/Jenis");
		}
	}
	
	public function delete($id = ''){
		$result = $this->M_jenis->delete($id);

		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Menghapus jenis sampah"));
			redirect("Redaktur/Jenis");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Menghapus jenis sampah"));
			redirect("Redaktur/Jenis");
		}
	}
}
