<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_carousel extends CI_Model {

	public function select_all() {

		$data = $this->db->get('smk_carousel');

		return $data->result();
	}

	public function select_aktif() {

		$data = $this->db->where('carousel_status = 1')
						 ->get('smk_carousel');

		return $data->result();
	}


	public function select_awal() {

		$data = $this->db->where('carousel_awal = 1')
						 ->get('smk_carousel');

		return $data->row();
	}

	public function select_id($id) {

		$data = $this->db->where('ID', $id)
						 ->get('smk_carousel');

		return $data->row();
	}

	public function simpan($data) {
		$array = array(
	        	'carousel_caption'	=> $data['carousel_caption'],
	        	'carousel_deskripsi'=> $data['carousel_deskripsi'],
	        	'carousel_image'	=> $data['carousel_image'],
	        	'carousel_awal'		=> $data['carousel_awal'],
	        	'carousel_status'	=> '1'
	       	); 
		$data = $this->db->insert('smk_carousel', $array);
		return $data;
	}

	public function update_with_image($data) {
		$array = array(
	        	'carousel_caption' => $data['carousel_caption'],
	        	'carousel_deskripsi' => $data['carousel_deskripsi'],
	        	'carousel_image' => $data['carousel_image']
	       	); 
		$data = $this->db->where('ID', $data['ID'])
						 ->update('smk_carousel', $array);
		return $data;
	}

	public function update_without_image($data) {
		$array = array(
	        	'carousel_caption' => $data['carousel_caption'],
	        	'carousel_deskripsi' => $data['carousel_deskripsi']
	       	); 
		$data = $this->db->where('ID', $data['ID'])
						 ->update('smk_carousel', $array);
		return $data;
	}

	public function aktifkan($id) {
		$data = $this->db->set('carousel_status', 1)
						 ->where('ID', $id)
						 ->update('smk_carousel');
		return $data;
	}

	public function nonaktifkan($id) {
		$data = $this->db->set('carousel_status', 0)
						 ->where('ID', $id)
						 ->update('smk_carousel');
		return $data;
	}

	public function delete($id) {
		$data = $this->db->where('ID', $id)
						 ->delete('smk_carousel');
		return $data;
	}

	public function delete_all() {
		$data = $this->db->empty_table('smk_carousel');
		return $data;
	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */