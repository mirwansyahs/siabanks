<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends AUTH_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_users");
		$this->load->library('upload');
		
		if ($this->userdata->user_status == "1"){
			$this->session->set_flashdata("msg", $this->alert->failed("Anda bukan administrator"));
			redirect('Redaktur/Home');
		}
	}

	public function index()
	{
		$data['userdata']	= $this->userdata;

		$data['judul']		= "Members";
		$data['deskripsi']  = "Manage Data Members";

		$data['data']	= $this->M_users->select_all();

		$this->backend->views('_backend/users/list', $data);
	}

	public function add()
	{

		$data['userdata']	= $this->userdata;

		$data['judul']		= "Members";
		$data['deskripsi']  = "Add Members";

		$data['data']	= $this->M_users->select_all();

		$this->backend->views('_backend/users/add', $data);
	}

	public function prosesadd()
	{
		date_default_timezone_set('asia/jakarta');
		$data = $this->input->post();
		$data['MemberID']  = $this->M_users->autonumber();
		$data['user_pass']  = $this->M_users->random_pass();

		if (!is_dir('./assets/images/Members/'.$data['MemberID'])) {
			mkdir('./assets/images/Members/'.$data['MemberID']);
		}

		$config['upload_path']		= './assets/images/Members/'.$data['MemberID']; //path folder
		$config['allowed_types']	= 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name']		= TRUE; //nama yang terupload nantinya


		$this->upload->initialize($config);
		
		if($this->upload->do_upload("image")){
		    $image = $this->upload->data();
		    $data['user_image'] =  $image['file_name'];

			$result = $this->M_users->simpan_with_image($data);
			
		}else{
			$result = $this->M_users->simpan_without_image($data);
	    }

		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Tambah","Password default '".$data['user_pass']."'"));
			redirect("Redaktur/users");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Tambah"));
			redirect("Redaktur/users");
		}
	}

	public function update($id)
	{

		$data['userdata']	= $this->userdata;

		$data['judul']		= "Users";
		$data['deskripsi']  = "Update User";

		$data['data']	= $this->M_users->select_id($id);

		$this->backend->views('_backend/users/update', $data);
	}

	public function prosesupdate()
	{
		$data = $this->input->post();

		$dir = './assets/images/Members/'.$data['MemberID'];

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
			
			$gmb = $dir.'/'.@$this->M_users->select_id($data['MemberID'])->Image;

			$result = $this->M_users->update_with_image($data);
			if ($result){
				if (file_exists($gmb)){
					unlink($gmb);
				}
			}
		}else{
			$result = $this->M_users->update_without_image($data);
	    }

		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Update"));
			redirect("Redaktur/users");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Update"));
			redirect("Redaktur/users");
		}
	}

	public function reset($id)
	{
		$pass = $this->M_users->random_pass();
		$result = $this->M_users->reset($id,$pass);


		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Reset", "Password '".$pass."'."));
			redirect("Redaktur/users");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Reset"));
			redirect("Redaktur/users");
		}
	}

	public function delete($id)
	{
		if (is_dir('./assets/images/Members/'.$id)) {
			$dir = './assets/images/Members/'.$id;
			foreach (scandir($dir) as $file) {
				if ('.' === $file || '..' === $file){
					continue;
				}


				if (is_dir("$dir/$file")) {
					rmdir_recursive("$dir/$file");
				}else{
					unlink("$dir/$file");
				}
				rmdir($dir);

			}
		}
		

		$result = $this->M_users->delete($id);

		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Delete"));
			redirect("Redaktur/users");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Delete"));
			redirect("Redaktur/users");
		}
	}

	public function deleteall()
	{
		$result = $this->M_users->delete_all();

		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Delete All"));
			redirect("Redaktur/users");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Delete All"));
			redirect("Redaktur/users");
		}
	}

	public function validation_nik(){

		$nik = htmlentities($_POST['nik']);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,'https://www.marlboro.id/auth/search-person');
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$x = curl_exec($ch);	

		$result = json_decode($x, true);
		//$data = $result['aaData'][0];
		  
		var_dump($result);
		echo $x;
	}

	public function showJSON(){
		header('Content-Type: application/javascript');
		$data = $this->M_users->select_all();
		echo json_encode($data);
	}

	
}
