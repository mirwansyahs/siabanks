<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sampah extends AUTH_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_sampah');
		$this->load->library('upload');

	}

	public function index()
	{
		$data['userdata']	= $this->userdata;

		$data['judul']		= "Artikel";
		$data['deskripsi']  = "Manage Data Artikel";

		$data['data']	= $this->M_artikel->select_all();

		$this->backend->views('_backend/artikel/list', $data);
	}

	public function add()
	{

		$data['userdata']	= $this->userdata;

		$data['judul']		= "Artikel";
		$data['deskripsi']  = "Add Artikel";

		$data['kategori']    = $this->M_kategori->select_all();

		$this->backend->views('_backend/artikel/add', $data);
	}

	public function prosesadd()
	{
		$data = $this->input->post();

		$config['upload_path']		= './assets/images/bukti/'; //path folder
		$config['allowed_types']	= 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name']		= TRUE; //nama yang terupload nantinya


		$this->upload->initialize($config);
		
		if($this->upload->do_upload("image")){
		    $image = $this->upload->data();
		    $data['image'] =  $image['file_name'];

			$result = $this->M_sampah->simpan($data);
		}else{
			$this->session->set_flashdata("msg", $this->alert->failed($this->upload->display_errors()));
			redirect("Redaktur/Home");
	    }
		
		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Setor sampah"));
			redirect("Redaktur/Home");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Setor sampah"));
			redirect("Redaktur/Home");
		}
	}


	public function diambil($id)
	{
		$result = $this->M_sampah->diambil($id);

		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Ambil"));
			redirect("Redaktur/Home");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Ambil"));
			redirect("Redaktur/Home");
		}
	}

	public function fraud($id)
	{
		$result = $this->M_sampah->fraud($id);

		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Fraud"));
			redirect("Redaktur/Home");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Fraud"));
			redirect("Redaktur/Home");
		}
	}

	public function update($id)
	{

		$data['userdata']	= $this->userdata;

		$data['judul']		= "Artikel";
		$data['deskripsi']  = "Update Artikel";

		$data['data']	= $this->M_artikel->select_id($id);

		$this->backend->views('_backend/artikel/update', $data);
	}

	public function prosesupdate()
	{
		$data = $this->input->post();

		$config['upload_path']		= './assets/images/artikel/'; //path folder
		$config['allowed_types']	= 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name']		= TRUE; //nama yang terupload nantinya


		$this->upload->initialize($config);
		
		if($this->upload->do_upload("image")){
		    $image = $this->upload->data();
		    $data['artikel_image'] =  $image['file_name'];

			$result = $this->M_artikel->update_with_image($data);
		}else{
			$result = $this->M_artikel->update_without_image($data);
	    }
		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Update"));
			redirect("Redaktur/Home");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Update"));
			redirect("Redaktur/Home");
		}
	}


	public function delete($id)
	{
		$result = $this->M_artikel->delete($id);

		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Delete"));
			redirect("Redaktur/Home");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Delete"));
			redirect("Redaktur/Home");
		}
	}

	public function deleteall()
	{
		$result = $this->M_artikel->delete_all();

		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Delete All"));
			redirect("Redaktur/Home");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Delete All"));
			redirect("Redaktur/Home");
		}
	}

	public function notification(){
		$akhir = $_GET['akhir'];
		$json = '{"messages": {';
		$query = $this->db
						 ->where('tb_pengumpulansampah.MemberID = tb_members.MemberID')
						 ->where('tb_members.MemberID = tb_detailmembers.MemberID')
						 ->where('tb_pengumpulansampah.status_sampah = "0"')
						 ->where('tb_pengumpulansampah.id_sampah > ',$akhir)
						 ->order_by('tb_pengumpulansampah.tanggal_lapor', 'ASC')
						 ->get('tb_pengumpulansampah, tb_members, tb_detailmembers');
		$json .= '"pesan":[ ';
		    foreach ($query->result() as $key) {
		        $json .= '{';
		        $json .= '"id_sampah": "'. $key->id_sampah . '", "Nama": "' . $key->Nama_Depan. " " .$key->Nama_Belakang.'", "tanggal": "' . $key->tanggal_lapor.'"},';
		    }
		$json = substr($json,0,strlen($json)-1);
		$json .= ']';


		$json .= '}}';
		echo $json;
	}
}
