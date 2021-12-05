<?php







class M_tranumat extends CI_Model {







	var $table = 'ueu_tbl_user';



	



	function __construct()



	{



		parent::__construct();



	}



	



     //// //REV 221017 VOUCHER



    function get_rinciproduk_transaksi($id)
	{   
		return $this->db->get_where('tbl_transaksi_rinciproduk', array('id_t' => $id));
	}

	function get_rinciproduk_idtra($id)
	{   
		return $this->db->get_where('tbl_transaksi_rinciproduk', array('id_tra' => $id));
	}


}