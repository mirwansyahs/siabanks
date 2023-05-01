<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sampah extends CI_Model {

	public function select_all() {

		$data = $this->db
						 ->where('tb_pengumpulansampah.MemberID = tb_members.MemberID')
						 ->where('tb_members.MemberID = tb_detailmembers.MemberID')
						 ->where('tb_pengumpulansampah.id_jenis = tb_jenissampah.id_jenis')
						 ->order_by('tb_pengumpulansampah.tanggal_lapor', 'DESC')
						 ->get('tb_pengumpulansampah, tb_members, tb_detailmembers, tb_jenissampah');

		return $data->result();
	}

	public function select_jenis_sampah($ID = '', $Nama = '', $Harga = ''){
		if ($ID != ''){
			$this->db->where('tb_jenissampah.id_jenis', $ID);
		}
		if ($Nama != ''){
			$this->db->where('tb_jenissampah.nama_jenis', $Nama);
		}
		if ($Harga != ''){
			$this->db->where('tb_jenissampah.harga', $Harga);
		}
			$this->db->where('tb_jenissampah.nama_jenis != "Organik"');
			$this->db->where('tb_jenissampah.nama_jenis != "Anorganik"');
			
		$data =	$this->db->get('tb_jenissampah');
		return $data;
	}

	public function select_memberid($id) {

		$data = $this->db
						 ->where('tb_pengumpulansampah.MemberID = tb_members.MemberID')
						 ->where('tb_members.MemberID = tb_detailmembers.MemberID')
						 ->where('tb_pengumpulansampah.id_jenis = tb_jenissampah.id_jenis')
						 ->where('tb_pengumpulansampah.MemberID', $id)
						 ->order_by('tb_pengumpulansampah.tanggal_lapor', 'DESC')
						 ->get('tb_pengumpulansampah, tb_members, tb_detailmembers, tb_jenissampah');

		return $data->result();
	}

	public function select_kangsampah() {

		$data = $this->db
						 ->where('tb_pengumpulansampah.MemberID = tb_members.MemberID')
						 ->where('tb_members.MemberID = tb_detailmembers.MemberID')
						 ->where('tb_pengumpulansampah.id_jenis = tb_jenissampah.id_jenis')
						 ->where('tb_pengumpulansampah.status_sampah = "0"')
						 ->order_by('tb_pengumpulansampah.tanggal_lapor', 'ASC')
						 ->get('tb_pengumpulansampah, tb_members, tb_detailmembers, tb_jenissampah');

		return $data->result();
	}

	public function select_kangsampah_all() {

		$data = $this->db->where('tb_pengumpulansampah.id_sampah = tb_pengambilansampah.id_sampah')
						 ->where('tb_pengumpulansampah.MemberID = tb_members.MemberID')
						 ->where('tb_members.MemberID = tb_detailmembers.MemberID')
						 ->where('tb_pengumpulansampah.status_sampah != "0"')
						 ->where('tb_pengambilansampah.MemberID', $this->userdata->MemberID)
						 ->group_by('tb_pengumpulansampah.id_sampah')
						 ->order_by('tb_pengumpulansampah.tanggal_lapor', 'ASC')
						 ->get('tb_pengumpulansampah, tb_members, tb_detailmembers, tb_pengambilansampah');

		return $data->result();
	}

	public function validateDay(){
				$this->db->where('date(tanggal_lapor) = curdate()');
				$this->db->where('MemberID', $this->userdata->MemberID);
		$data = $this->db->get('tb_pengumpulansampah');

		return $data->result();
	}


	public function simpan($data) {
		date_default_timezone_set('asia/jakarta');

		$array = array(
	        	'id_sampah'			=> $this->id_sampahGenerate(),
	        	'MemberID'			=> $this->userdata->MemberID,
	        	'id_jenis'			=> $data['id_jenis'],
	        	'jumlah_sampah'		=> $data['jumlah_sampah'],
	        	'bukti_photo'		=> $data['image'],
	        	'tanggal_lapor'		=> date('Y-m-d H:i:s'),
	        	'status_sampah'		=> '0'
	       	); 
		$data = $this->db->insert('tb_pengumpulansampah', $array);
		// $this->aritmatika($this->userdata->MemberID, "min" , 2500, 0);
		return $data;
	}

	public function update($data) {
		date_default_timezone_set('asia/jakarta');

		$array = array(
	        	$data['Prefix']		=> $data['value']
			   ); 
			   
	  	$result = $this->db->where('id_sampah', $data['ID'])
			   			   ->update('tb_pengumpulansampah', $array);
		return $result;
	}

	public function diambil($id){
		date_default_timezone_set('asia/jakarta');

		$member = $this->db->select('tb_pengumpulansampah.*')
						   ->select('tb_members.*')
						   ->select('tb_jenissampah.nama_jenis, tb_jenissampah.deskripsi_jenis, tb_jenissampah.harga')
						   ->where('tb_pengumpulansampah.id_sampah', $id)
						   ->where('tb_members.MemberID = tb_pengumpulansampah.MemberID')
						   ->where('tb_pengumpulansampah.id_jenis = tb_jenissampah.id_jenis')
						   ->get('tb_members, tb_pengumpulansampah, tb_jenissampah')->row();

		$this->adding_commission($member->MemberID, $member->harga*$member->jumlah_sampah, 0);

		$status_sampah	= array(
				'status_sampah'			=> '1'
			);
		$update .= $this->db->where('id_sampah', $id)
						    ->update('tb_pengumpulansampah', $status_sampah);

		$array = array(
	        	'id_pengambilan'			=> $this->id_ambilGenerate(),
	        	'id_sampah'					=> $id,
	        	'MemberID'					=> $this->userdata->MemberID,
	        	'tanggal_pengambilan'		=> date('Y-m-d H:i:s')
	       	); 
		$data = $this->db->insert('tb_pengambilansampah', $array);
		return $data;

	}

	public function fraud($id){
		date_default_timezone_set('asia/jakarta');
		
		$member = $this->db->where('tb_pengumpulansampah.id_sampah', $id)
						   ->where('tb_members.MemberID = tb_pengumpulansampah.MemberID')
						   ->get('tb_members, tb_pengumpulansampah')->row();

		// $this->aritmatika($member->MemberID, "min" , 0, 100);
		// $this->aritmatika($this->userdata->MemberID, "plus" , 2500, 150);

		$status_sampah	= array(
				'status_sampah'			=> '2'
			);
		$update .= $this->db->where('id_sampah', $id)
						    ->update('tb_pengumpulansampah', $status_sampah);

		$array = array(
	        	'id_pengambilan'			=> $this->id_ambilGenerate(),
	        	'id_sampah'					=> $id,
	        	'MemberID'					=> $this->userdata->MemberID,
	        	'tanggal_pengambilan'		=> date('Y-m-d H:i:s')
	       	); 
		$data = $this->db->insert('tb_pengambilansampah', $array);
		return $data;

	}

	public function id_sampahGenerate(){
		$data = $this->db->select('id_sampah')
						 ->order_by('id_sampah', 'DESC')
						 ->get("tb_pengumpulansampah")->row();
		if (!empty($data->id_sampah)){
			$angka = substr($data->id_sampah, 9) +1;
			$nol   = "";
			if (strlen($angka) == 1){
				$nol = "0000";
			}else if (strlen($angka) == 2){
				$nol = "000";
			}else if (strlen($angka) == 3){
				$nol = "00";
			}else if (strlen($angka) == 4){
				$nol = "0";
			}else if (strlen($angka) == 5){
				$nol = "";
			}
			$autonum = "S".date("Ymd").$nol.$angka;
		}else{
			$autonum = "S".date("Ymd")."00001";
		}
		return $autonum;
	}


	public function id_ambilGenerate(){
		$data = $this->db->select('id_pengambilan')
						 ->order_by('id_pengambilan', 'DESC')
						 ->get("tb_pengambilansampah")->row();
		if (!empty($data->id_pengambilan)){
			$angka = substr($data->id_pengambilan, 9) +1;
			$nol   = "";
			if (strlen($angka) == 1){
				$nol = "0000";
			}else if (strlen($angka) == 2){
				$nol = "000";
			}else if (strlen($angka) == 3){
				$nol = "00";
			}else if (strlen($angka) == 4){
				$nol = "0";
			}else if (strlen($angka) == 5){
				$nol = "";
			}
			$autonum = "P".date("Ymd").$nol.$angka;
		}else{
			$autonum = "P".date("Ymd")."00001";
		}
		return $autonum;
	}

	public function aritmatika($id_member, $type, $saldo = 0, $point = 0){
		$member = $this->db->where('tb_members.MemberID', $id_member)
						   ->get('tb_members')->row();

		switch ($type) {
		   	case 'plus':
		   		$hasil = $member->Points + $point;
		   		$hasilsaldo = $member->Saldo + ($saldo - $this->admin_comission($saldo));
		   		break;
		   	case 'min':
		   		$hasil = $member->Points - $point;
		   		$hasilsaldo = $member->Saldo - $saldo;
		   		break;
						   	
		   	default:
		   		$hasil = $member->Points - $point;
		   		$hasilsaldo = $member->Saldo - $saldo;
		   		break;
	   }

		    if ($hasil <= 0){
		   		$hasil = 0;
		   	}
		    if ($hasilsaldo <= 0){
		   		$hasilsaldo = 0;
		    }


		if ($saldo != 0){
			if ($point != 0){
		   		$Points = array(
					'Points'	=> $hasil,
					'Saldo'		=> $hasilsaldo
				);
	   		}else{
		   		$Points = array(
					'Saldo'		=> $hasilsaldo
				);
	   		}
		}else{
		   	$Points = array(
				'Points'		=> $hasil
			);
		}
		

		$update_points = $this->db->where('MemberID', $member->MemberID)
						    	  ->update('tb_members', $Points);

	}

	public function adding_commission($id_member, $saldo = 0, $point = 0){
		$Points = array(
			'Saldo'			=> $saldo,
			'Points'		=> $point
		);
		$update_points = $this->db->where('MemberID', $id_member)
						    	  ->update('tb_members', $Points);
	}

	public function admin_comission($total = 0){
		//Admin 20%
		$hasil = ($total * 20) / 100;

		$member = $this->db->where('tb_members.Email = tb_admin.username')
						   ->where('tb_admin.user_status = "0"')
						   ->get('tb_members, tb_admin')->row();
		$Saldo = array(
			'Saldo'		=> $member->Saldo + $hasil
		);
		$this->db->where('MemberID', $member->MemberID)
						    	  ->update('tb_members', $Saldo);
		return $hasil;

	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */