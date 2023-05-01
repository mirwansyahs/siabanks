<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_topup extends CI_Model {


	public function done($data) {
		$member = $this->db->where('tb_members.MemberID', $data['MemberID'])
						   ->get('tb_members')->row();

		$hasil = $member->Saldo + $data['saldo'];

		$array = array(
	        	'Saldo'			=> $hasil
	       	); 
		$data = $this->db->where('MemberID', $data['MemberID'])
						 ->update('tb_members', $array);
		return $data;
	
	}

	public function reset($id) {
		$member = $this->db->where('tb_members.MemberID', $id)
						   ->get('tb_members')->row();

		$array = array(
	        	'Saldo'			=> 0
	       	); 
		$data = $this->db->where('MemberID', $id)
						 ->update('tb_members', $array);
		return $data;
	
	}
}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */