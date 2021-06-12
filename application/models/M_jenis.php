<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jenis extends CI_Model {

	public function select($id_jenis = '') {
		if ($id_jenis != '')
		{ 
			$this->db->where('tb_jenissampah.id_jenis', $id_jenis);
		}

		$data = $this->db->get('tb_jenissampah');

		return $data;
	}

	public function simpan($data) {
		date_default_timezone_set('asia/jakarta');

		$array = array(
				'id_jenis'			=> '',
	        	'nama_jenis'		=> $data['nama_jenis'],
	        	'harga'				=> $data['harga'],
	        	'deskripsi_jenis'	=> @$data['deskripsi_jenis'],
	        	'gambar_jenis'		=> $data['gambar_jenis']
	       	); 
		$data = $this->db->insert('tb_jenissampah', $array);
		return $data;
	}

	public function update($data) {
		date_default_timezone_set('asia/jakarta');

		$array = array(
	        	'nama_jenis'		=> $data['nama_jenis'],
	        	'harga'				=> $data['harga'],
	        	'deskripsi_jenis'	=> @$data['deskripsi_jenis'],
	        	'gambar_jenis'		=> @$data['gambar_jenis']
	       	); 
		$data = $this->db->where('id_jenis', $data['id_jenis'])->update('tb_jenissampah', $array);
		return $data;
	}

	public function delete($data){
		$data = $this->db->where('id_jenis', $data)->delete('tb_jenissampah');
		return $data;
	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */