<?php



class M_monitor extends CI_Model {



	function __construct()

	{

		parent::__construct();

	}
	
	
    function get_all_transaksi_refresh(){

		$this->db->limit(20,0);
		$this->db->from('tbl_transaksi');
		$this->db->order_by('id','DESC'); ///yang di ambil beli ..
		
		return $this->db->get();

	}
	

	

}///class