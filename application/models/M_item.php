<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_item extends CI_Model {

	public function select_all() {

		$data = $this->db->where('tb_item.id_item = tb_detailitem.itemid')
						 ->where('tb_item.categoryitemid = tb_categoryitem.id')
						 ->get('tb_item, tb_categoryitem, tb_detailitem');

		return $data->result();
	}

	public function select_item_pag($offset, $limit) {

		$data = $this->db->where('tb_item.id_item = tb_detailitem.itemid')
						 ->where('tb_item.categoryitemid = tb_categoryitem.id')
						 ->limit($limit, $offset)
						 ->get('tb_item, tb_categoryitem, tb_detailitem');

		return $data->result();
	}

	public function get_item() {

		$data = $this->db->where('tb_item.id_item = tb_detailitem.itemid')
						 ->where('tb_item.categoryitemid = tb_categoryitem.id')
						 ->get('tb_item, tb_categoryitem, tb_detailitem');

		return $data->num_rows();
	}

	public function simpan_sambutan($data){
		$array = array(
	        	'instance_sambutan'	=> $data['instance_sambutan']
	       	); 
		$data = $this->db->where('ID', 1)
						 ->update('smk_instance', $array);
		return $data;
	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */