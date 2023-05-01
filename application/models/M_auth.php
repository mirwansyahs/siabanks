<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {
	public function login($user, $pass) {
		$this->db->select('*');
		$this->db->from('tb_admin');
		$this->db->from('tb_members');
		$this->db->where('tb_members.email = tb_admin.username');
		$this->db->where('tb_admin.username', $this->db->escape_str($user));
		$this->db->where('tb_admin.user_pass', $this->db->escape_str(sha1(md5($pass))));

		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}
}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */