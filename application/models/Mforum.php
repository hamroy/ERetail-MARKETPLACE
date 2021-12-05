<?php



class Mforum extends CI_Model {



	function __construct()

	{

		parent::__construct();

	}

	

	function sipankirimpesan($add){

		$this->db->insert('tbl_forum',$add);
		
	}	
	
	function sipankirimsaran($add){

		$this->db->insert('tbl_saran',$add);
		
	}	
	///UPDATE
	function update_plusqty($id,$id_prod,$t) { ///id_pembeli //produk /iddata{
		$this->db->where('id_pembeli',$id);
		$this->db->where('id_produk',$id_prod);
		$this->db->where('buy','ya');
		$this->db->update('tbl_transaksi',$t);
		
	}	




	

	
	
	function get_semua_pesan(){

		//$this->db->where('id',$id);
		$this->db->order_by('id','DESC');
		return $this->db->get('tbl_forum');

	}
	function get_ditbl_user($id){

		$this->db->where('idlog',$id);

		return $this->db->get('ueu_tbl_user');

	}

	//====================================================update_qty 

	

	//====================================================del_id_transaksi

	function del_id_produk($id,$id_p){

		$this->db->where('id_produk',$id);

		$this->db->where('id_pembeli',$id_p);
		$this->db->where('buy','ya');

		$this->db->delete('tbl_transaksi');

	}	

	

}///class