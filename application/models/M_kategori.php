<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategori extends CI_Model {

	public function select_all() {
		$data = $this->db->get('smk_kategori');

		return $data->result();
	}

	public function select_id($id) {
		$data = $this->db->where('ID', $id)
						 ->get('smk_kategori');

		return $data->row();
	}

	public function simpan($data) {
		$array = array(
			'kategori_nama' => $data['kategori_nama']
		);
		$data = $this->db->insert('smk_kategori', $array);

		return $data;
	}

	public function update($data) {
		$array = array(
			'kategori_nama' => $data['kategori_nama']
		);
		$data = $this->db->where('ID', $data['ID'])
						 ->update('smk_kategori', $array);
		return $data;
	}

	public function delete($id) {
		$data = $this->db->where('ID', $id)
						 ->delete('smk_kategori');
		return $data;
	}

	public function delete_all() {
		$data = $this->db->empty_table('smk_kategori');
		return $data;
	}
}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */