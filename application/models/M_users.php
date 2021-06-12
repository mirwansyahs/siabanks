<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {
	public function select($id = '', $Admin = '') {
		if ($id != ''){
			$this->db->where('tb_members.MemberID', $id);
		}
		if ($Admin != ''){
			$this->db->where('tb_admin.user_status NOT LIKE "2"');
		}
				$this->db->where('tb_admin.ID NOT LIKE '.$this->session->userdata('userdata')->ID);
				$this->db->where('tb_admin.username = tb_members.email');
				$this->db->where('tb_detailmembers.MemberID = tb_members.MemberID');
				$this->db->order_by('tb_members.user_registered', 'DESC');
		$data = $this->db->get("tb_admin, tb_members, tb_detailmembers");

		return $data;
	}

	public function cek($NIK = '', $Email = '') {
		if ($NIK != ''){
			$this->db->where('tb_members.NIK', $NIK);
		}
		if ($Email != ''){
			$this->db->where('tb_members.Email', $Email);
		}
		$data = $this->db->get("tb_members");

		return $data;
	}

	public function getDistance($data){
		$result = $this->db->select('(6371 * acos( cos( radians('.$data['Latitude2'].') ) * cos( radians( '.$data['Latitude1'].' ) ) * cos( radians( '.$data['Longitude1'].' ) - radians('.$data['Longitude2'].') ) + sin( radians('.$data['Latitude2'].') ) * sin( radians( '.$data['Latitude1'].' ) ) ) ) as Distance')->where('tb_members.MemberID', $data['MemberID'])->get('tb_members')->row()->Distance;
		return $result;
	}

	public function select_all() {
		$data = $this->db->where('tb_admin.ID NOT LIKE '.$this->session->userdata('userdata')->ID)
						 ->where('tb_admin.username = tb_members.email')
						 ->where('tb_detailmembers.MemberID = tb_members.MemberID')
						 ->order_by('tb_members.user_registered', 'DESC')
						 ->get("tb_admin, tb_members, tb_detailmembers");

		return $data->result();
	}
	public function select_all_json() {
		$data = $this->db
						 ->where('tb_admin.username = tb_members.email')
						 ->where('tb_detailmembers.MemberID = tb_members.MemberID')
						 ->get("tb_admin, tb_members, tb_detailmembers");

		return $data->result();
	}

	public function autonumber(){
		date_default_timezone_set('asia/jakarta');
		$data = $this->db->select('MemberID')
						 ->order_by('MemberID', 'DESC')
						 ->get("tb_members")->row();
		$angka = substr($data->MemberID, 7) +1;
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
		$autonum = "M".date("Ym").$nol.$angka;
		return $autonum;
	}

	public function select_id($id) {
		$data = $this->db->where('tb_members.MemberID',$id)
						 ->where('tb_admin.username = tb_members.email')
						 ->where('tb_detailmembers.MemberID = tb_members.MemberID')
						 ->get("tb_admin, tb_members, tb_detailmembers");

		return $data->row();
	}

	public function simpan_with_image($data) {
		date_default_timezone_set('asia/jakarta');

		$members = array(
			'MemberID'			=> $data['MemberID'],
			'NIK'				=> $data['NIK'],
			'Nama_Depan'		=> $data['Nama_Depan'],
			'Nama_Belakang'		=> $data['Nama_Belakang'],
			'Email'				=> $data['Email'],
			'user_registered'	=> date('Y-m-d h:i:s')
		);

		$detailmembers = array(
			'MemberID'			=> $data['MemberID'],
			'tempat_lahir'		=> $data['Tempat_Lahir'],
			'tanggal_lahir'		=> $data['Tanggal_Lahir'],
			'Image'				=> $data['user_image']
		);

		$admin = array(
			'username' 			=> $data['Email'],
			'user_pass' 		=> sha1(md5($data['user_pass'])),
			'user_status' 		=> $data['user_status']
		);

		$array = array(
			'members' 			=> $members,
			'detailmembers' 	=> $detailmembers,
			'admin' 			=> $admin
		);

		$data = $this->db->insert('tb_members', $array['members']);
		$data = $this->db->insert('tb_detailmembers', $array['detailmembers']);
		$data = $this->db->insert('tb_admin', $array['admin']);
		return $data;
	}

	public function simpan_without_image($data) {
		date_default_timezone_set('asia/jakarta');

		$members = array(
			'MemberID'			=> $data['MemberID'],
			'NIK'				=> $data['NIK'],
			'Nama_Depan'		=> $data['Nama_Depan'],
			'Nama_Belakang'		=> $data['Nama_Belakang'],
			'Email'				=> $data['Email'],
			'user_registered'	=> date('Y-m-d h:i:s')
		);

		$detailmembers = array(
			'MemberID'			=> $data['MemberID'],
			'tempat_lahir'		=> $data['Tempat_Lahir'],
			'tanggal_lahir'		=> $data['Tanggal_Lahir']
		);

		$admin = array(
			'username' 			=> $data['Email'],
			'user_pass' 		=> sha1(md5($data['user_pass'])),
			'user_status' 		=> $data['user_status']
		);

		$array = array(
			'members' 			=> $members,
			'detailmembers' 	=> $detailmembers,
			'admin' 			=> $admin
		);

		$data = $this->db->insert('tb_members', $array['members']);
		$data = $this->db->insert('tb_detailmembers', $array['detailmembers']);
		$data = $this->db->insert('tb_admin', $array['admin']);
		return $data;
	}

	public function update_with_image($data) {

		$members = array(
			'Nama_Depan'		=> $data['Nama_Depan'],
			'Nama_Belakang'		=> $data['Nama_Belakang'],
			'Email'				=> $data['Email']
		);

		$detailmembers = array(
			'tempat_lahir'		=> $data['Tempat_Lahir'],
			'tanggal_lahir'		=> $data['Tanggal_Lahir'],
			'Image'				=> $data['user_image']
		);

		$admin = array(
			'user_status' 		=> $data['user_status']
		);

		$array = array(
			'members' 			=> $members,
			'detailmembers' 	=> $detailmembers,
			'admin' 			=> $admin
		);

		// $data = $this->db->where('MemberID', $data['MemberID'])
		// 				 ->update('tb_members', $array['members']);
		$data1 = $this->db->where('MemberID', $data['MemberID'])
						 ->update('tb_detailmembers', $array['detailmembers']);
		$data2 = $this->db->where('username', $data['Email'])
						 ->update('tb_admin', $array['admin']);
		return $data2;
	}

	public function update_without_image($data) {

		$members = array(
			'Nama_Depan'		=> $data['Nama_Depan'],
			'Nama_Belakang'		=> $data['Nama_Belakang'],
			'Email'				=> $data['Email']
		);

		$detailmembers = array(
			'tempat_lahir'		=> $data['Tempat_Lahir'],
			'tanggal_lahir'		=> $data['Tanggal_Lahir']
		);

		$admin = array(
			'user_status' 		=> $data['user_status']
		);

		$array = array(
			'members' 			=> $members,
			'detailmembers' 	=> $detailmembers,
			'admin' 			=> $admin
		);

		$data = $this->db->where('MemberID', $data['MemberID'])
						 ->update('tb_members', $array['members']);
		$data1 = $this->db->where('MemberID', $data['MemberID'])
						 ->update('tb_detailmembers', $array['detailmembers']);
		$data2 = $this->db->where('username', $data['Email'])
						 ->update('tb_admin', $array['admin']);
		return $data2;
	}

	public function reset($data, $pass) {

		$array = array(
			'user_pass'		=> sha1(md5($pass))
		);

		$data = $this->db->where('ID', $data)
						 ->update('tb_admin', $array);
		return $data;
	}

	public function delete($id) {
		$data = $this->db->where('MemberID', $id)
						 ->delete('tb_members');
		return $data;

	}

	public function delete_all() {
		$data = $this->db->where('ID NOT LIKE '.$this->session->userdata('userdata')->ID)
						 ->delete('smk_users');
		return $data;
	}

	public function random_pass($jumlah = 8){ //INI JUMLAH TERGANTUNG ARA MAU BERAPA BANYAK DIGIT TOKENNYA
		$data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$string = '';
		for($i=0;$i < $jumlah;$i++){
			$random = rand(0, strlen($data)-1);
			$string .= $data{$random};
		}
		
		return strtolower($string);
	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */