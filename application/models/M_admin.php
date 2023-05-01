<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function update($data) {
		$array = array(
			'Nama_Depan'	=> $data['user_nickname'],
			'Nama_Belakang'	=> $data['display_name'],
			'PhoneNumber'	=> $data['PhoneNumber'],
			'Email'	=> $data['user_email']
		);

		$this->db->where("MemberID", $this->userdata->MemberID)
			 	 ->update("tb_members", $array);

		return $this->db->affected_rows();
	}

	public function updatedetail($data) {
		$array = array(
			'tempat_lahir'	=> $data['tempat_lahir'],
			'tanggal_lahir'	=> $data['tanggal_lahir'],
			'jenis_kelamin'	=> $data['jenis_kelamin'],
			'alamat'	=> $data['alamat']
		);

		$this->db->where("MemberID", $this->userdata->MemberID)
			 	 ->update("tb_detailmembers", $array);

		return $this->db->affected_rows();
	}

	public function updatelocation($data) {
		$array = array(
			'latitude'	=> $data['latitude'],
			'longitude'	=> $data['longitude']
		);

		$this->db->where("MemberID", $this->userdata->MemberID)
			 	 ->update("tb_detailmembers", $array);

		return $this->db->affected_rows();
	}

	public function select($id = '') {
		if ($id != '') {
			$this->db->where('tb_admin.ID', $id);
		}

		$this->db->where('tb_members.email = tb_admin.username');
		$this->db->where('tb_members.MemberID = tb_detailmembers.MemberID');
		$data = $this->db->get('tb_admin, tb_members, tb_detailmembers');

		return $data->row();
	}

	public function update_image($data) {
		$array = array(
			'Image'	=> $data['user_image']
		);

		$data = $this->db->where('MemberID', $this->userdata->MemberID)
						 ->update('tb_detailmembers', $array);
		return $data;
	}

	public function update_password($data) {
		$array = array(
			'user_pass'	=> $data
		);

		$this->db->where("ID", $this->userdata->ID)
			 	 ->update("tb_admin", $array);

		return $this->db->affected_rows();
	}

}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */