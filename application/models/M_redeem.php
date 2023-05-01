<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_redeem extends CI_Model {

	public function select_all() {

		$data = $this->db->where('tb_item.id_item = tb_detailitem.itemid')
						 ->where('tb_item.categoryitemid = tb_categoryitem.id')
						 ->get('tb_item, tb_categoryitem, tb_detailitem');

		return $data->result();
	}
	public function select_redeem($id = '') {
						if ($id != ''){
						 	$this->db->where('tb_redeem.MemberID', $id);
						 }
		$data = $this->db->where('tb_redeem.id_detailitem = tb_detailitem.id_detailitem')

						 ->where('tb_redeem.MemberID = tb_members.MemberID')
						 ->where('tb_item.id_item = tb_detailitem.itemid')
						 ->where('tb_item.categoryitemid = tb_categoryitem.id')
						 ->get('tb_redeem, tb_item, tb_categoryitem, tb_detailitem, tb_members');

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

	public function diterima($id){
		$array = array(
	        	'status_admin'	=> '1'
	       	); 
		$data = $this->db->where('id_redeem', $id)
						 ->update('tb_redeem', $array);
		return $data;
	
	}

	public function ditolak($id){
		$array = array(
	        	'status_admin'	=> '2'
	       	); 
		$data = $this->db->where('id_redeem', $id)
						 ->update('tb_redeem', $array);

		$ItemPrice = $this->db->where('tb_redeem.id_detailitem = tb_detailitem.id_detailitem')
							  ->where('tb_redeem.id_redeem', $id)
							  ->get('tb_redeem, tb_detailitem')->row();
		$this->aritmatika($ItemPrice->MemberID, 'plus', $ItemPrice->price, 0);
		return $data;
	
	}

	public function redeem_item($data){
		date_default_timezone_set('asia/jakarta');
		
		$itemprice = $this->db->where('id_detailitem', $data)
							  ->get('tb_detailitem')->row();
		$this->M_sampah->aritmatika($this->userdata->MemberID, "min" , $itemprice->price, 0);
		$array = array(
				'id_redeem' => $this->generateRedeemID(),
	        	'MemberID'	=> $this->userdata->MemberID,
	        	'id_detailitem' => $data,
	        	'tgl_redeem' => date("Y-m-d H:i:s")
	       	); 
		$data = $this->db->insert('tb_redeem', $array);

		return $data;
	}

	public function generateRedeemID(){
		date_default_timezone_set('asia/jakarta');
		$data = $this->db->select('id_redeem')
						 ->order_by('id_redeem', 'DESC')
						 ->get("tb_redeem")->row();
		$angka = substr($data->id_redeem, 9) +1;
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
		$autonum = "RED".date("Ym").$nol.$angka;
		return $autonum;
	}

	public function validateDay(){
		$data = $this->db->query("SELECT * FROM `tb_redeem` WHERE date(tgl_redeem) = curdate() AND MemberID='".$this->userdata->MemberID."'");

		return $data->result();
	}

	public function aritmatika($id_member, $type, $saldo = 0, $point = 0){
		$member = $this->db->where('tb_members.MemberID', $id_member)
						   ->get('tb_members')->row();

		switch ($type) {
		   	case 'plus':
		   		$hasil = $member->Points + $point;
		   		$hasilsaldo = $member->Saldo + $saldo;
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
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */