<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AUTH_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('M_sampah');
		$this->load->model('M_item');
		$this->load->model('M_redeem');
		$this->load->model('M_users');
		$this->load->library('pagination');
		$data['data']		= $this->M_admin->select($this->userdata->ID);
		if ($data['data']->latitude == "" || $data['data']->longitude == "" || $data['data']->alamat == ""){
			$this->session->set_flashdata("msg", $this->alert->info("Silahkan ubah lokasi anda di menu <b>Location</b> dan alamat anda di menu <b>Detail Profile</b> terlebih dahulu!"));
			redirect("Redaktur/Profile");
		}
		date_default_timezone_set('asia/jakarta');
	}

	public function index()
	{
		$data['userdata'] = $this->userdata;
		$data['judul']		= "Dashboard";
		$data['deskripsi']		= "Dashboard";

		$data['data']		= $this->M_admin->select($this->userdata->ID);
			
		$data['validateDayRedeem'] = $this->M_redeem->validateDay();
		if ($this->userdata->user_status == "2"){
			$data['dataSampah']		= $this->M_sampah->select_memberid($this->userdata->MemberID);
			$data['validateDay'] = $this->M_sampah->validateDay();
		}elseif ($this->userdata->user_status == "1"){
			$data['dataSampah']		= $this->M_sampah->select_kangsampah();
		}elseif ($this->userdata->user_status == "0"){
			$data['dataSampah']		= $this->M_sampah->select_all();
		}

		$jum=$this->M_item->get_item();
		$page=$this->uri->segment(4);
		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$limit=4;
			$config['base_url'] = base_url() . 'Redaktur/Home/index/';
			$config['total_rows'] = $jum;
			$config['per_page'] = $limit;
			$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['page'] =$this->pagination->create_links();
		$data['item']		= $this->M_item->select_item_pag($offset, $limit);
			

		$jumr=$this->M_item->get_item();
		$pager=$this->uri->segment(4);
		if(!$pager):
			$offsetr = 0;
		else:
			$offsetr = $pager;
		endif;
		$limitr=4;
			$config['base_url'] = base_url() . 'Redaktur/Home/index/';
			$config['total_rows'] = $jumr;
			$config['per_page'] = $limitr;
			$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['pager'] =$this->pagination->create_links();
		$data['redeem']		= $this->M_item->select_item_pag($offset, $limit);
		if ($this->userdata->user_status == 2){
			$Admin = $this->M_users->select('', 'Yes')->result();
			$temp = 0;
			$i = 1;
			foreach ($Admin as $key) {
				$arr = array(
					'MemberID' 		=> $this->userdata->MemberID,
					'Latitude1'		=> $this->userdata->latitude,
					'Longitude1'	=> $this->userdata->longitude ,
					'Latitude2'		=> (@$key->latitude)?$key->latitude:0 ,
					'Longitude2'	=> (@$key->longitude)?$key->longitude:0 
				);

				$result = $this->M_users->getDistance($arr);
				if ($result < $temp){
					$Near = $result;
				}elseif ($result > $temp){
					$Near = $temp;
					$temp = $result;
				}
				$data['AdminName'] = $key->Nama_Depan." ".$key->Nama_Belakang;
			}
			// $data['Near'] = $Near;
			if (round($Near) == 0){
				$data['Distance'] = round($Near,2);
				$data['Satuan'] = "m";
			}else{
				$data['Distance'] = round($Near);
				$data['Satuan'] = "km";
			}
		}else{
			$data['AdminName'] = $this->userdata->Nama_Depan." ".$this->userdata->Nama_Belakang;
			$data['Distance'] = 0;
			$data['Satuan'] = "m";
		}
		$this->backend->views("_backend/home", $data);
		
	}

	public function getImagePrice(){
		$data = $this->input->post();

		$jenis = $this->M_sampah->select_jenis_sampah($data['ID'])->row();
		// $result = new stdClass();
		$result['gambar_jenis'] = "data:image/jpg;base64,".base64_encode($jenis->gambar_jenis);
		$result['max'] = 10000/$jenis->harga;
		echo json_encode($result);
	}

	public function getEstimate(){
		$data = $this->input->post();

		$result = ($this->M_sampah->select_jenis_sampah($data['ID'])->row()->harga * @$data['total']);
		if ($result){
			if ($result < 0){
				$result = 0;
			}elseif($result > 10000){
				$result = 10000;
			}else{
				$result = $result;
			}
		}else{
			$result = 0;
		}
		echo 'Rp'.number_format($result, 2, ',', '.').',-';
	}

	public function getDistance(){
		$Admin = $this->M_users->select('', 'Yes')->result();
		foreach ($Admin as $key) {
			$data = array(
				'MemberID' 		=> $this->userdata->MemberID,
				'Latitude1'		=> $this->userdata->latitude,
				'Longitude1'	=> $this->userdata->longitude ,
				'Latitude2'		=> $key->latitude ,
				'Longitude2'	=> $key->longitude 
			);
			$result = $this->M_users->getDistance($data);
			echo $result;
		}
	}

	public function saveUpdate(){
		$data = $this->input->post();

		$result = $this->M_sampah->update($data);

		echo ($result)?'{succ:1},{pwd:mirwansyahs}':'{succ:0},{pwd:mirwansyahs}';
	}

	public function redeem($data){

		$result = $this->M_redeem->redeem_item($data);


		if ($result){
			$this->session->set_flashdata("msg", $this->alert->success("Request reward", "Silahkan tunggu konfirmasi admin."));
			redirect("Redaktur/Home");
		}else{
			$this->session->set_flashdata("msg", $this->alert->error("Request reward"));
			redirect("Redaktur/Home");
		}
	}
}