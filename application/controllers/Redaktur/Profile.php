<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends AUTH_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
	}

	public function index()
	{
		$data['userdata'] = $this->userdata;

		$data['judul']		= "My Profile";
		$data['deskripsi']		= "Manage Data Profile";

		$data['data']		= $this->M_admin->select($this->userdata->ID);

		$this->backend->views("_backend/profile", $data);
	}

	public function updateimage()
	{
		$data = $this->input->post();

		$dir = './assets/images/Members/'.$this->userdata->MemberID;

		if (!is_dir($dir)) {
			mkdir($dir);
		}

		$config['upload_path']		= $dir; //path folder
		$config['allowed_types']	= 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name']		= TRUE; //nama yang terupload nantinya


		$this->upload->initialize($config);
		
		if($this->upload->do_upload("image")){
		    $image = $this->upload->data();
		    $data['user_image'] =  $image['file_name'];

			$gmb = $dir.'/'.@$this->userdata->Image;
			
			$result = $this->M_admin->update_image($data);
			if ($result){
				if (file_exists($gmb)){
					unlink($gmb);
				}
			}
		}else{
			$this->session->set_flashdata("msg", $this->alert->failed($this->upload->display_errors()));
			redirect("Redaktur/Profile");
	    }
		
		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Update", "Photo berhasil diubah."));
			redirect("Redaktur/Profile");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Update"));
			redirect("Redaktur/Profile");
		}
	}

	public function updateprofile()
	{
		$data = $this->input->post();

		$result = $this->M_admin->update($data);
		
		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Update"));
			redirect("Redaktur/Profile");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Update"));
			redirect("Redaktur/Profile");
		}
	}

	public function updateprofiledetail()
	{
		$data = $this->input->post();

		$result = $this->M_admin->updatedetail($data);
		
		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Update"));
			redirect("Redaktur/Profile");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Update"));
			redirect("Redaktur/Profile");
		}
	}

	public function updatelocation()
	{
		$data = $this->input->post();

		$result = $this->M_admin->updatelocation($data);
		
		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Update"));
			redirect("Redaktur/Profile");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Update"));
			redirect("Redaktur/Profile");
		}
	}

	public function updatepassword()
	{
		$data = $this->input->post();

		$lama = sha1(md5($data['pass_lama']));
		$baru = sha1(md5($data['pass_baru']));
		$konfirmasi = sha1(md5($data['konfirmasi']));

		if ($lama == $this->userdata->user_pass){
			if ($baru == $konfirmasi){
				$result = $this->M_admin->update_password($baru);
		
				if ($result){
					$this->session->set_flashdata("msg", $this->alert->success("Update"));
					redirect("Redaktur/Profile");
				}else{
					$this->session->set_flashdata("msg", $this->alert->error("Update"));
					redirect("Redaktur/Profile");
				}
			}else{
				$this->session->set_flashdata("msg", $this->alert->failed("Konfirmasi tidak sesuai!"));
				redirect("Redaktur/Profile");
			}
		}else{
			$this->session->set_flashdata("msg", $this->alert->failed("Password lama tidak sesuai!"));
			redirect("Redaktur/Profile");
		}

		
	}
}