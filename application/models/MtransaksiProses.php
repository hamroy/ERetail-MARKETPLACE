<?php



class MtransaksiProses extends CI_Model {



	function __construct()

	{

		parent::__construct();

	}

	

	function simpan_tablTransaksi_proses($add){

		$this->db->insert('tbl_transaksi_proses',$add);
		
	}	
	
	

}///class